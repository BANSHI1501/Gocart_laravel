<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;

class OrderController extends Controller
{
    public function placeOrderCOD(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'amount' => 'required|numeric',
            'items' => 'required|array',
        ]);

        $user = Auth::guard('api')->user();

        $order = Order::create([
            'userId' => $user->id,
            'items' => $request->items,
            'amount' => $request->amount,
            'address' => $request->address,
            'paymentType' => 'COD',
            'isPaid' => false,
            'status' => 'Order Placed'
        ]);

        // Clear cart
        $user->cartItems = [];
        $user->save();

        return response()->json(['success' => true, 'message' => 'Order Placed successfully', 'order' => $order]);
    }

    public function placeOrderRazorpay(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'amount' => 'required|numeric',
            'items' => 'required|array',
        ]);

        $user = Auth::guard('api')->user();

        $order = Order::create([
            'userId' => $user->id,
            'items' => $request->items,
            'amount' => $request->amount,
            'address' => $request->address,
            'paymentType' => 'Razorpay',
            'isPaid' => false,
            'status' => 'Order Placed'
        ]);

        try {
            $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
            $razorpayOrder = $api->order->create([
                'receipt' => (string) $order->id,
                'amount' => $request->amount * 100,
                'currency' => 'INR'
            ]);

            return response()->json([
                'success' => true,
                'order' => $razorpayOrder
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function verifyRazorpay(Request $request)
    {
        $request->validate([
            'razorpay_order_id' => 'required|string',
            'razorpay_payment_id' => 'required|string',
            'razorpay_signature' => 'required|string',
            'receipt' => 'required|string', // Original Order ID
        ]);

        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        $attributes = [
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature
        ];

        try {
            $api->utility->verifyPaymentSignature($attributes);
            
            $order = Order::find($request->receipt);
            if ($order) {
                $order->isPaid = true;
                $order->save();

                $user = Auth::guard('api')->user();
                $user->cartItems = [];
                $user->save();

                return response()->json(['success' => true, 'message' => 'Payment Successful']);
            }
            return response()->json(['success' => false, 'message' => 'Order not found']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Payment Verification Failed'], 400);
        }
    }

    public function getUserOrders()
    {
        $user = Auth::guard('api')->user();
        $orders = Order::where('userId', $user->id)->get();

        return response()->json(['success' => true, 'orders' => $orders]);
    }

    public function getAllOrders()
    {
        $orders = Order::all();
        return response()->json(['success' => true, 'orders' => $orders]);
    }

    public function changeOrderStatus(Request $request, $orderId)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $order = Order::find($orderId);
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }

        $order->status = $request->status;
        $order->save();

        return response()->json(['success' => true, 'message' => 'Status Updated']);
    }

    public function deleteOrderById($orderId)
    {
        $order = Order::find($orderId);
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }

        $order->delete();
        return response()->json(['success' => true, 'message' => 'Order Deleted']);
    }
}

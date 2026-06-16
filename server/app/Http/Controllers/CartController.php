<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function updateCart(Request $request)
    {
        $request->validate([
            'cartData' => 'required|array'
        ]);

        $user = Auth::guard('api')->user();
        $user->cartItems = $request->input('cartData');
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Cart updated'
        ]);
    }
}

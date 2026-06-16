<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function addAddress(Request $request)
    {
        $request->validate([
            'address.firstName' => 'required|string',
            'address.lastName' => 'required|string',
            'address.email' => 'required|email',
            'address.street' => 'required|string',
            'address.city' => 'required|string',
            'address.state' => 'required|string',
            'address.zipcode' => 'required|numeric',
            'address.country' => 'required|string',
            'address.phone' => 'required|string',
        ]);

        $user = Auth::guard('api')->user();

        $addressData = $request->input('address');
        $addressData['userId'] = $user->id;

        $address = Address::create($addressData);

        return response()->json([
            'success' => true,
            'message' => 'Address added successfully',
            'address' => $address
        ]);
    }

    public function getAddress(Request $request)
    {
        $user = Auth::guard('api')->user();
        $addresses = Address::where('userId', $user->id)->get();

        return response()->json([
            'success' => true,
            'addressList' => $addresses
        ]);
    }
}

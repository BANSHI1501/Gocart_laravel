<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'cartItems' => [],
        ]);

        $token = Auth::guard('api')->login($user);

        return $this->respondWithToken($token, 'Registration successful', $user);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (! $token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['success' => false, 'message' => 'Invalid Credentials'], 401);
        }

        return $this->respondWithToken($token, 'Login successful', Auth::guard('api')->user());
    }

    public function sellerLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (! $token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['success' => false, 'message' => 'Invalid Credentials'], 401);
        }

        $user = Auth::guard('api')->user();
        if ($user->role !== 'seller') {
            return response()->json(['success' => false, 'message' => 'Access Denied'], 403);
        }

        return $this->respondWithToken($token, 'Seller Login successful', $user);
    }

    public function me()
    {
        return response()->json(['success' => true, 'user' => Auth::guard('api')->user()]);
    }

    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json(['success' => true, 'message' => 'Successfully logged out'])
            ->withCookie(cookie()->forget('token'));
    }

    protected function respondWithToken($token, $message, $user)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'user' => $user,
        ])->withCookie(cookie('token', $token, 60 * 24 * 7, '/', null, false, true));
    }
}

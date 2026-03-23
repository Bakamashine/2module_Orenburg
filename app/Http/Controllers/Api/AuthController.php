<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoginRequest;
use App\Http\Requests\StoreRegisterRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function Register(StoreRegisterRequest $request)
    {
        /** @var User $user */
        $user = User::create($request->all());
        return response()->json([
            'success' => (bool)$user
        ]);

    }

    public function Login(StoreLoginRequest $request)
    {
        /** @var User $user */
        $user = User::where('email', $request->email)->firstOrFail();
        return response()->json([
            'token' => $user->createToken('user')->plainTextToken
        ]);
    }
}

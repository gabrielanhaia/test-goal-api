<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ApiLoginController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function login() {

        $credentials = request(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([

            'token' => $token,

            'expires' => auth('api')->factory()->getTTL() * 6000000,
        ]);

    }
}

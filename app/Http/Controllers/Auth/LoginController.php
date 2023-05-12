<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController
{
    public function login(Request $request)
    {
        if (!$token = auth()->attempt($request->only(['email', 'password']))) {
            return response()->json(['message' => 'Não Autorizado!'], 401);
        }

        return response()->json([
            'token' => $token
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Usuário deslogado!']);
    }
}

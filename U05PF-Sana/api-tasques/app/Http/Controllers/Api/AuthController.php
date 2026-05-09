<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Registre d’usuari
    public function register(Request $request)
    {
        // Validació de dades
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        // Crear usuari
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Retorn JSON
        return response()->json([
            'success' => true,
            'message' => 'Usuari registrat correctament',
            'data' => $user
        ], 201);
    }

    // Login d'usuari
    public function login(Request $request)
    {
        // Validem que arribin email i password.
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Busquem l'usuari pel seu email.
        $user = User::where('email', $request->email)->first();

        // Comprovem si l'usuari existeix i si la contrasenya és correcta.
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Credencials incorrectes'
            ], 401);
        }

        // Creem el token d'accés amb Sanctum.
        $token = $user->createToken('api-token')->plainTextToken;

        // Retornem el token en format JSON.
        return response()->json([
            'success' => true,
            'message' => 'Login correcte',
            'token' => $token
        ], 200);
    }
}
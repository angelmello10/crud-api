<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        //aquí aplico la validación
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',            
            'password' => 'required|string|min:8|confirmed',
        ]);

        //valida validator()
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error en la validación',
                'errors' => $validator->errors()
            ], 422);
        }

        //aquí se crea el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //token de acceso

        $token = $user->createToken('User Token - ' . $user->id)->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Usuario registrado con éxito',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
    
        $user = User::where('email', $credentials['email'])->first();
    
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'message' => 'Las credenciales no son válidas.',
            ], 401);
        }
    
        $token = $user->createToken("auth_token")->plainTextToken;
    
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }
    



    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logout exitoso']);
    }
}

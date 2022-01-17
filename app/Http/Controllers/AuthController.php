<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function auth (Request $request){

        $validatedData = $request->validate(
            [   
                'nombre'=> 'required',
                'apellido'=> 'required',
                'email'=> 'required|email|unique:users',
                'password' => 'required',
                'id_rol' => 'required'
            ]);
        
        if($user = User::find($request->email)){
            return "Se encontró el usuario: ". $user;
        }
        
        $validatedData['password'] = Hash::make($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'user' => $user,
            'access_token' => $accessToken
        ]);


    }

    public function login (Request $request){
        $loginData = $request->validate([
            'email'=>'email|required',
            'password'=> 'required'
        ]);

        if(!auth()->attempt($loginData)){
            return response([
                'message'=> 'Credenciales Invalidas'
            ]);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response([
            'user'=> auth()->user(),
            'access_token' => $accessToken
        ]);

    }
}

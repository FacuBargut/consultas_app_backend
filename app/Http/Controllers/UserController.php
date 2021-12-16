<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{   

    //Obtengo todos los usuarios
    public function index(){
        $usuarios = User::all();
        return $usuarios;
    }

    //Obtengo todos los docentes
    public function getDocentes(){
        $docentes = User::where('id_rol','2')->paginate(5);
        return $docentes;
    }

    //Obtengo todos los alumnos
    public function getAlumnos(){
        $alumnos = User::where('id_rol','3')->get();
        return $alumnos;
    }


    //Crear usuario
    public function store(Request $request){

        $validatedData = $request->validate(
        [
            'nombre'=> 'required',
            'apellido' => 'required',
            'email'=> 'required|email|unique:users',
            'password' => 'required',
            'id_rol' => 'required'
        ]);

        $user = new User();
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->id_rol = $request->id_rol;

        $user->save();

        return response([
            'message'=> "Se agregó el usuario correctamente",
            'user' => $user,
            'status' => 201
        ],201);



    }

    //Actualizo usuario
    public function update(Request $request){
        $user = User::findOrFail($request->id);
        $user->email = $request->email;
        $user->password = $request->password;
        $user->id_rol = $request->id_rol;

        $user->save();

        return $user;
    }

    //Elimino usuario
    public function delete(Request $request){
        $user =User::destroy($request->id);
        return $user;
    }
}

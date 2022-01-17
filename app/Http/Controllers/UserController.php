<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{   

    //Obtengo todos los usuarios
    public function index(){
        $usuarios = User::all();
        return $usuarios;
    }

    //Obtengo todos los docentes
    public function getDocentes(){
        $docentes = User::where('id_rol','2')->select('id','nombre','apellido','email','id_rol')->paginate(5);
        return $docentes;
    }

    //Obtengo todos los alumnos
    public function getAlumnos(){
        $alumnos = User::where('id_rol','3')->select('id','nombre','apellido','email','id_rol')->paginate(5);
        return $alumnos;
    }


    //Crear usuario
    public function store(Request $request){

        $validatedData = $request->validate(
        [
            'nombre'=> 'required',
            'apellido' => 'required',
            'email'=> 'required|email|unique:users',
            'email'=> 'required',
            'password' => 'required',
            'id_rol' => 'required'
        ]);

        $validatedData['password'] = Hash::make($request->password);

        $user = new User();
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->email = $request->email;
        $user->password = $validatedData['password'];
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
        $validatedData = $request->validate(
            [
                'id' => 'required',
                'nombre'=> 'required',
                'apellido' => 'required',
                'email'=> 'required|email',
                'id_rol' => 'required'
            ]);
            

        $user = User::findOrFail($request->id);
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->email = $request->email;
        $user->id_rol = $request->id_rol;

        $user->save();

        return response([
            'message'=> "El usuario se modificó correctamente",
            'user' => $user,
            'status' => 202
        ],202);
    }

    //Elimino usuario
    public function delete(Request $request){
        $user =User::destroy($request->id);
        return response([
            'message'=> "El usuario se eliminó exitosamente.",
            'user' => $user,
            'status' => 200
        ],200);
    }
}

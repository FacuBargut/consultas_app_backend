<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\User;
use Illuminate\Support\Facades\DB;



class ConsultaController extends Controller
{
    public function index(){
        $consulta = Consulta::all();
        return $consulta;
    }

    public function update(Request $request){
        return $this->buscarDocente($request->id_docente);
        $fecha_hora = date('Y-m-d H:i:s' , strtotime($request->fecha_hora));
        $consulta = Consulta::findOrFail($request->id);
        $consulta->estado = $request->estado;
        $consulta->fecha_hora = $request->$fecha_hora;
        $consulta->motivoBloqueo = $request->motivoBloqueo;
        $consulta->id_docente = $request->id_docente;
        $consulta->save();
        return $consulta;
    }

    public function grabar(Request $request){
        Consulta::query()->delete();
        $consultas = $request->all();
        
        foreach($consultas as $key => $value){
            
            $id_docente = User::select('id')
                              ->where('email',$value["mail"])
                              ->where('id_rol',2)
                              ->get();
            if(count($id_docente) != 0){
                $id_docente = $id_docente[0]['id'];
                DB::table('consultas')->insert([
                    'estado' => 'pendiente',
                    'fecha' => $value["dia"],
                    'hora_inicio' =>  $value["hora_inicio"],
                    'hora_fin' => $value["hora_fin"],
                    'motivoBloqueo' => '',
                    'id_docente' => $id_docente,
                ]);
            }
        }

        return response(
            [
                'consultas'=> "Se cargaron los horarios correctamente"
            ]
        );

        // return $this->buscarDocente($request->id_docente);
        // $consulta = new Consulta();
        // $fecha_hora = date('Y-m-d H:i:s' , strtotime($request->fecha_hora));
        // $consulta->estado = $request->estado;
        // $consulta->fecha_hora = $fecha_hora;
        // $consulta->motivoBloqueo = $request->motivoBloqueo;
        // $consulta->id_docente = $request->id_docente;
        // $consulta->save();
        // return $consulta;
    }

    public function delete(Request $request){
        $consulta = Consulta::destroy($request->id);
        return $consulta;
    }

    private function buscarDocente($id){
        $user = User::where('id',$id)
        ->where('id_rol',2)
        ->get();
        if($user->isEmpty()){
            return "El docente no existe";
        }
    }

}

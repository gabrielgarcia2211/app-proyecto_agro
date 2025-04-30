<?php

namespace App\Http\Controllers;

use App\Oferta;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
Use Alert;

class EmpresaController extends Controller
{

    //Servicio 1

    function viewOferta(){
        return view('dashboard.empresa.index');
    }

    function guardarOferta(Request $request){

        $this->validateData($request);
        $oferta = $request['horaInicio'] . '  ' . $request['horaFin'];

        Oferta::create([
            'empleo' => $request['empleo'],
            'jornada' => $oferta,
            'salario' => $request['salario'],
            'telefono' => $request['telefono'],
            'descripcion' => $request['descripcion'],
            'requerimientos' => $request['requerimientos'],
            'nitemprea' =>  auth()->user()->codigo
        ]);

        Alert::success('Oferta Guardada', 'informacion guardada');
        return back();

    }

    protected function validateData(Request $request){

        $request->validate([
            'horaInicio' => 'required',
            'horaFin' => 'required',
            'empleo' => 'required',
            'salario' => 'required',
            'telefono' => 'required|integer',
            'descripcion' => 'required',
            'requerimientos' => 'required'

        ]);

    }


    //Servicio 2

    function listarHojaEstudiante(){
        $data = User::join('estudiantes','estudiantes.documento','=' ,'users.documento')->join('hoja__vidas','users.codigo', '=', 'hoja__vidas.codigo')->join('personas','personas.documento','=','users.documento')->where('hoja__vidas.autorizar','=',1)->where('estudiantes.egresado','=',0)->get();
        $ruta = $this->traerRutas('vida');
        return view('dashboard.empresa.listarEstudiante')->with(compact('data','ruta'));
    }

    //Servicio 3

    function listarHojaEgresado(){
        $data = User::join('estudiantes','estudiantes.documento','=' ,'users.documento')->join('hoja__vidas','users.codigo', '=', 'hoja__vidas.codigo')->join('personas','personas.documento','=','users.documento')->where('hoja__vidas.autorizar','=',1)->where('estudiantes.egresado','=',1)->get();
        $ruta = $this->traerRutas('vida');
        return view('dashboard.empresa.listarEgresado')->with(compact('data','ruta'));
    }

    public function  traerRutas($folder)
    {
        // Get root directory contents...
        $contents = collect(Storage::disk('google')->listContents('/', false));

        // Find the folder you are looking for...
        $dir = $contents->where('type', '=', 'dir')
            ->where('filename', '=', $folder)
            ->first(); // There could be duplicate directory names!

        if ( ! $dir) {
            return 'No such folder!';
        }

        // Get the files inside the folder...
        $files = collect(Storage::disk('google')->listContents($dir['path'], false))
            ->where('type', '=', 'file');



        $data = $files->mapWithKeys(function($file) {
            return [ $file['name'] => Storage::disk('google')->url($file['path'])];
        });

        return $data;


    }


    //Servicio 4

    function viewlistarOferta(){
        $data  = DB::select('SELECT *  FROM ofertas');
        return view('dashboard.empresa.listarOfertas')->with(compact('data'));
    }

    function deleteOferta($id){
        $flight = Oferta::find($id);
        $flight->delete();
        Alert::success('Oferta Eliminada', 'satisfactoriamente');
        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Hoja_Vida;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->rol==1) {

            $dataEstudiante  = DB::select('SELECT p.documento, p.nombres, p.apellidos  FROM personas p INNER JOIN estudiantes e ON e.documento = p.documento INNER JOIN users u ON  u.documento = e.documento WHERE u.codigo NOT IN (SELECT et.codigoestudiante FROM tesis__estudiantes et)');
            return view('dashboard.director.index')->with(compact('dataEstudiante'));

        }else if(auth()->user()->rol==2){

            $codigo = auth()->user()->codigo;
            $name = Hoja_Vida::join('users', 'hoja__vidas.codigo','=','users.codigo')->where('users.codigo','=',$codigo)->get()->first();
            $dataEstudiante  = DB::select("SELECT * FROM users u INNER JOIN personas p ON u.documento=p.documento INNER JOIN  estudiantes e  ON e.documento=u.documento WHERE u.codigo = $codigo");

            if(isset($name)){
                $viewTesis = $this->traerArchivo($name);
                return view('dashboard.estudiante.index')->with(compact('dataEstudiante','viewTesis','name'));
            }else{
                return view('dashboard.estudiante.index')->with(compact('dataEstudiante','viewTesis','name'));
            }

        }else if(auth()->user()->rol==3){

            return view('dashboard.empresa.index');

        }
    }


    public function traerArchivo($name)
    {
        $filename = $name['archivo'];

        $dir = '/';
        $recursive = true; // Get subdirectories also?
        $contents = collect(Storage::disk('google')->listContents($dir, $recursive));

        $file = $contents
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
            ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
            ->first(); // there can be duplicate file names!


        return [$file['name'] => Storage::disk('google')->url($file['path'])];





    }
}

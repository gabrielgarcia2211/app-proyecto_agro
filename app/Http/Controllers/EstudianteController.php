<?php

namespace App\Http\Controllers;

use App\Empresa_Estudiante;
use App\Estudiante;
use App\Hoja_Vida;
use App\Noticia;
use App\Persona;
use App\Tesis_Estudiante;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
Use Alert;

class EstudianteController extends Controller
{
    //Servicio 1
    public $viewTesis;
    public function __construct()
    {
        $this->viewTesis = $this->traerRutas('public');
    }



    function viewPrincipal(){
        $codigo = auth()->user()->codigo;
        $empresa =  DB::select("SELECT  empresa__estudiantes.nitemprea FROM empresa__estudiantes WHERE empresa__estudiantes.codigoestudiante = $codigo ");
        $name = Hoja_Vida::join('users', 'hoja__vidas.codigo','=','users.codigo')->where('users.codigo','=',$codigo)->get()->first();
        $dataEstudiante  = DB::select("SELECT * FROM users u INNER JOIN personas p ON u.documento=p.documento INNER JOIN  estudiantes e  ON e.documento=u.documento WHERE u.codigo = $codigo");

        if(isset($name)){
            $viewTesis = $this->traerArchivo($name);
            return view('dashboard.estudiante.index')->with(compact('dataEstudiante','viewTesis','name','empresa'));
        }else{
            return view('dashboard.estudiante.index')->with(compact('dataEstudiante','viewTesis','name', 'empresa'));
        }
    }

    public function guardarHoja(Request $request){
        $files = $request->file('archivo');
        $hoja = Hoja_Vida::where('codigo','=', auth()->user()->codigo)->get()->first();

        if(empty($hoja)){
            $this->guardarFichero($files);
        }else{
            $this->eliminarFichero('1gaLiy33Ls3oKjYJUFC5JDtsvkn3op66R',$hoja['archivo']);
            $hoja->delete();
            $this->guardarFichero($files);
        }



        \RealRashid\SweetAlert\Facades\Alert::success('Archivo subido', 'Correctamente');
        return back();

    }

    function guardarFichero($files){


        $dir = '1qHTyQcXeZQakeWT4jfgPMoeWB1ubjhTS';
        $recursive = false; // Get subdirectories also?
        $contents = collect(Storage::disk('google')->listContents($dir, $recursive));

        $dir = $contents->where('type', '=', 'dir')
            ->where('filename', '=', 'vida')
            ->first(); // There could be duplicate directory names!
        if ( ! $dir) {
            return 'uno';
        }
        $name = time();
        Storage::disk('google')->put($dir['path'].'/'.$name, $files->get());

        Hoja_Vida::create([
            'codigo' => auth()->user()->codigo,
            'archivo' => $name,
            'autorizar' => 0,
        ]);
    }

    function eliminarFichero($carpeta, $filename){

        $dir = $carpeta;
        $recursive = false; // Get subdirectories also?
        $contents = collect(Storage::disk('google')->listContents($dir, $recursive));

        $file = $contents
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
            ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
            ->first(); // there can be duplicate file names!

        Storage::disk('google')->delete($file['path']);

        return 'File was deleted from Google Drive';
    }

    public function autorizar(Request $request){
        $hoja = Hoja_Vida::Where('codigo','=',auth()->user()->codigo)->get()->first();

        if($hoja->autorizar==0){
            $hoja->autorizar = 1;
        }else{
            $hoja->autorizar = 0;
        }


        $hoja->save();
        return back();

    }


    //Servicio 4

    function viewTesis(){
        $json = array();
        $codigo = auth()->user()->codigo;
        $user = User::join('tesis__estudiantes', 'users.codigo', '=', 'tesis__estudiantes.codigoestudiante')
            ->join('teses', 'teses.codigo', '=', 'tesis__estudiantes.id_tesis')
            ->join('personas', 'personas.documento', '=', 'users.documento')->where('users.codigo','=', $codigo )->get();

        foreach ($user as $est) {
            $unico = true;
            $id = $est['id_tesis'];
            $datos = Tesis_Estudiante::where('id_tesis', '=', $id)->get();
            $array_estudiantes = array();
            $fecha = "";
            foreach ($datos as $d) {
                array_push($array_estudiantes, $d['codigoestudiante']);
                $fecha = $d['created_at'];
            }

            if(!empty($json)){
                foreach ($json as $j){
                    if($id==$j['id']){
                        $unico = false;
                        break;
                    }
                }

            }
            if($unico){
                $json[] = array(
                    'id' => $est['id_tesis'],
                    'titulo' => $est['titulo'],
                    'archivo' => $est['archivo'],
                    'nombres' => $est['nombres'],
                    'apellidos' => $est['apellidos'],
                    'estudiantes' => $array_estudiantes,
                    'fecha' => $fecha
                );
            }


        }

        if(isset($json)) {
            $ruta =  $this->viewTesis;
        }
        return view('dashboard.estudiante.tesis')->with(compact('json','ruta'));
    }

    //Servicio 4

    function viewOferta(){
        $data  = DB::select('SELECT *  FROM ofertas');
        return view('dashboard.estudiante.listarOfertas')->with(compact('data'));
    }

    //Servicio 5

    function viewEventos(){
        $data  = DB::select('SELECT *  FROM eventos');
        if(isset($data)) {
            $ruta =  $this->traerNombre('evento');

        }
        return view('dashboard.estudiante.listarEvento')->with(compact('data','ruta'));
    }

    function traerNombre($folder){

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

        return $files->mapWithKeys(function($file) {
            return [$file['name'] => Storage::disk('google')->url($file['path'])];
        });
    }

    //Servicio 6


    function viewActualizar(){
        $codigo = auth()->user()->codigo;
        $name =  DB::select('SELECT *  FROM empresas');
        $empresa =  DB::select("SELECT  empresa__estudiantes.nitemprea FROM empresa__estudiantes WHERE empresa__estudiantes.codigoestudiante = $codigo ");
        $dataEstudiante  = DB::select("SELECT * FROM users u INNER JOIN personas p ON u.documento=p.documento INNER JOIN  estudiantes e  ON e.documento=u.documento WHERE u.codigo = $codigo");

        return view('dashboard.estudiante.actualizar')->with(compact('dataEstudiante','name', 'empresa'));
    }


    function actualizarData(Request $request){
        $this->validateDataUser($request);

        $codigo = auth()->user()->codigo;
        $estudiante = Persona::join('users', 'personas.documento', '=', 'users.documento')->join('estudiantes', 'personas.documento', '=', 'estudiantes.documento')->where('users.codigo', '=',  $codigo )->get()->first();


        $estudiante->celular = $request['celular'];
        $estudiante->telefono = $request['telefono'];
        $estudiante->direccion = $request['direccion'];
        $estudiante->correo = $request['correo'];

        if(!empty($request['emp'])){
            Empresa_Estudiante::create([
                'nitemprea' => $request['emp'],
                'codigoestudiante' =>$codigo,
            ]);
        }


        $estudiante->save();


        Alert::success('Actualizacion de datos', 'informacion guardada');
        return back();
    }

    protected function validateDataUser(Request $request){

        $request->validate([
            'telefono' => 'required|integer',
            'celular' => 'required|integer',
            'direccion' => 'required',
            'correo' => 'required',
        ]);

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

    //Servicio 7

    function viewListarNoticia(){
        $data =  DB::select('SELECT *  FROM noticia' );

        return view('dashboard.estudiante.listarNoticia')->with(compact('data'));
    }

}

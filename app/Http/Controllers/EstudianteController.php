<?php

namespace App\Http\Controllers;

use App\Empresa_Estudiante;
use App\Estudiante;
use App\Hoja_Vida;
use App\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
Use Alert;

class EstudianteController extends Controller
{
    //Servicio 1
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

    function viewOferta(){
        $data  = DB::select('SELECT *  FROM ofertas');
        return view('dashboard.estudiante.listarOfertas')->with(compact('data'));
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

}

<?php


namespace App\Http\Controllers;

Use Alert;
use App\Empresa;
use App\Evento;
use App\Noticia;
use App\Persona;
use App\Saber11;
use App\SaberPro;
use App\Tesis;
use App\Tesis_Estudiante;
use App\User;
use App\Estudiante;
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Mail\TestMail;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;
use Mail;


class DirectorController extends Controller
{
    //Servicio 1
    public $viewTesis;
    public function __construct()
    {

        $this->viewTesis = $this->traerRutas('public');
    }


    public function principal()
    {
        $dataEstudiante  = DB::select('SELECT p.documento, p.nombres, p.apellidos  FROM personas p INNER JOIN estudiantes e ON e.documento = p.documento INNER JOIN users u ON  u.documento = e.documento WHERE u.codigo NOT IN (SELECT et.codigoestudiante FROM tesis__estudiantes et)');
        return view('dashboard.director.index')->with(compact('dataEstudiante'));
    }


    //Servicio 2
    public function cargaEstudiante()
    {
        return view('dashboard.director.cargaEstudiante');
    }

    protected function downloadFile($src)
    {
        if(is_file($src)){
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $content_type = finfo_file($finfo, $src);
            finfo_close($finfo);
            $file_name = basename($src).PHP_EOL;
            $size = filesize($src);
            header("Content-Type: $content_type");
            header("Content-Disposition: attachment; filename=$file_name");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: $size");
            readfile($src);
            return true;
        } else{
            return false;
        }
    }

    public function formato(){
        if(!$this->downloadFile(app_path()."/Files/formato/egresados.xlsx")){
            return redirect()->back();
        }
    }

    public function guardarEstudiante(Request $request)
    {
        try {
            $file = $request->file('file');

            $import = new UsersImport;
            $import->import($file);

            if ($import->failures()->isNotEmpty()) {

                return back()->withFailures($import->failures()->sort());
            }
            Alert::success('Carga de datos excel', 'informacion guardada');
            return back();
        }catch (\Exception $e){
            Alert::error('Error', $e->getMessage());
            return back();
        }



    }


    //Servico 3

    public function viewActualizarEstudiante()
    {
        return view('dashboard.director.actualizar');
    }

    public function datosEstudiante(Request $request)
    {


        if(isset($_POST['codigo'])) {

            $codigo = $_POST['codigo'];

            $dataEstudiante = User::select('users.codigo', 'personas.nombres', 'personas.apellidos', 'estudiantes.promedio', 'estudiantes.fechaingreso', 'estudiantes.semestrecursado', 'estudiantes.materiasaprobadas', 'historials.idsaber11', 'historials.idsaberpro')
                ->join('estudiantes', 'users.documento', '=', 'estudiantes.documento')
                ->join('personas', 'personas.documento', '=', 'estudiantes.documento')
                ->join('historials', 'estudiantes.documento', '=', 'historials.documento')
                ->where('users.codigo', '=', $codigo)->where('users.rol', '=', '2')->get()->first();

            if ($dataEstudiante == null) {
                echo 0;
                return;
            }

            $json[] = array(
                'codigo' => $dataEstudiante['codigo'],
                'nombres' => $dataEstudiante['nombres'],
                'apellidos' => $dataEstudiante['apellidos'],
                'promedio' => $dataEstudiante['promedio'],
                'semestreCursado' => $dataEstudiante['semestrecursado'],
                'materiasAprobadas' => $dataEstudiante['materiasaprobadas'],
                'idSaber11' => $dataEstudiante['idsaber11'],
                'idSaberPro' => $dataEstudiante['idsaberpro'],
                'fechaIngreso' => $dataEstudiante['fechaingreso'],
            );

            $JString = json_encode($json);
            $request->session()->put('key', $codigo);
            echo $JString;
        }else{

            $codigo = $_POST['codigoEgre'];

            $data = User::select('users.codigo', 'personas.nombres', 'estudiantes.fechaingreso')
                ->join('estudiantes', 'users.documento', '=', 'estudiantes.documento')
                ->join('personas', 'personas.documento', '=', 'estudiantes.documento')
                ->where('users.codigo', '=', $codigo)->where('users.rol', '=', '2')->get()->first();

            if ($data == null) {
                echo 0;
                return;
            }

            $json[] = array(
                'codigo' => $data['codigo'],
                'nombres' => $data['nombres'],
                'fechaIngreso' => $data['fechaingreso'],
                'fechaEgreso' => $data['fechaegreso'],
            );
            $request->session()->put('key_egresado', $codigo);
            $JString = json_encode($json);
            echo $JString;


        }

    }

    public function actualizarEstudiante(Request $request)
    {
        $this->validateData($request);
        $value = $request->session()->get('key');

        try {

            $persona = Persona::join('users', 'personas.documento', '=', 'users.documento')->where('users.codigo', '=',  $value )->get()->first();
            $estudiante = Estudiante::join('users', 'estudiantes.documento', '=', 'users.documento')->where('users.codigo', '=',  $value )->get()->first();
            $icfes11 = Saber11::join('historials', 'historials.idsaber11', '=', 'saber11s.idsaber11')->join('users', 'users.documento', '=', 'historials.documento')->where('users.codigo', '=',  $value )->get()->first();
            $icfesPro = SaberPro::join('historials', 'historials.idsaberpro', '=', 'saber_pros.idsaberpro')->join('users', 'users.documento', '=', 'historials.documento')->where('users.codigo', '=',  $value )->get()->first();
            $user = User::Where('codigo', $value)->get()->first();

            $persona->nombres = $request['nombre'];
            $persona->apellidos = $request['apellidos'];


            $estudiante->promedio = $request['promedio'];
            $estudiante->semestrecursado = $request['semestre'];
            $estudiante->materiasaprobadas = $request['materias'];

            $user->codigo = $request['codigo'];

            $icfes11->idsaber11 =  $request['codigo11'];
            $icfesPro->idsaberpro =  $request['codigoPro'];

            $persona->save();
            $estudiante->save();
            $icfes11->save();
            $icfesPro->save();
            $user->save();

            Alert::success('Actualizacion de datos', 'informacion guardada');
            $request->session()->forget('key');
            return back();

        }catch (\Illuminate\Database\QueryException $e){
            Alert::error('Error', 'Recuerda que codigo estudiante, codigo de prueba saber Pro o codigo de saber 11 son unicos.');
            return back();
        }



    }

    protected function validateData(Request $request){

         $request->validate([
             'nombre' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
             'apellidos' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
             'codigo' => 'required|integer',
             'fechai' => 'required',
             'codigo11' => 'required|integer',
             'codigoPro' => 'required|integer',
             'promedio' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
             'semestre' => 'required|integer',
             'materias' => 'required|integer',

        ]);

    }

    public function actualizarEgresado(Request $request)
    {

        try {

            $this->validateDataEgresado($request);
            $value = $request->session()->get('key_egresado');

            $estudiante = Estudiante::join('users', 'estudiantes.documento', '=', 'users.documento')->where('users.codigo', '=',  $value )->get()->first();

            $estudiante->fechaegreso = $request['fechaEgreso'];
            $estudiante->egresado = 1;

            $estudiante->save();


            Alert::success('Actualizacion de datos egresado', 'informacion guardada');
            $request->session()->forget('key_egresado');
            return back();

        }catch (\Exception $e){
            auth()->logout();
            return redirect('/');
        }



    }

    protected function validateDataEgresado(Request $request){

        $request->validate([
            'nombreEgresado' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'codigoEgresado' => 'required|integer',
            'fechaIngreso' => 'required',
            'fechaEgreso' => 'required',
        ]);

    }


    //Servicio 4

    public function viewlistarEstudiante()
    {
        return view('dashboard.director.listarEstudiante');
    }

    public function listarEstudiantes()
    {

        $tipo = $_POST['search'];
        $estudiante = Estudiante::join('users', 'estudiantes.documento', '=', 'users.documento')->join('personas', 'personas.documento', '=', 'users.documento')->join('historials', 'personas.documento', '=', 'historials.documento')->join('saber11s', 'saber11s.idsaber11', '=', 'historials.idsaber11')->join('saber_pros', 'saber_pros.idsaberpro', '=', 'historials.idsaberpro')->where('estudiantes.egresado', '=', $tipo)->get();




        foreach ($estudiante as $est) {

            $c = 170;
            $u = $est['materiasAprobadas'];

                $json[] = array(
                    'codigo' => $est['codigo'],
                    'documento' => $est['documento'],
                    'nombre' => $est['nombres'],
                    'apellido' => $est['apellidos'],
                    'celular' => $est['celular'],
                    'email' => $est['email'],
                    'fechaIngreso' => $est['fechaingreso'],
                    'fechaEgreso' => (isset($est['fechaegreso'])) ? $est['fechaegreso'] : "No asignada",
                    'promedio' => $est['promedio'],
                    'fecha_pro' => $est['fecha_pro'],
                    'fecha_11' => $est['fecha_11'],
                    'porcentajeAprobado' => round((($u / $c) * 100),2)
                );
            }
            $JString = json_encode($json);
            echo $JString;
            return;

    }

    public function buscarEstudiantes()
    {

        try {
            $codigo = $_POST['search'];
            $estudiante = Estudiante::join('users', 'estudiantes.documento', '=', 'users.documento')
                ->join('personas', 'personas.documento', '=', 'users.documento')
                ->where('users.codigo', 'like',  $codigo.'%' )->get();

            foreach ($estudiante as $est) {
                $json[] = array(
                    'codigoEstudiante' => $est['codigo'],
                    'documento' => $est['documento'],
                    'nombres' => $est['nombres'],
                    'apellidos' => $est['apellidos'],
                    'celular' => $est['celular'],
                    'correoInstitucional' => $est['email'],
                    'fechaIngreso' => $est['fechaingreso'],
                    'fechaEgreso' => (isset($est['fechaegreso']))?$est['fechaegreso']:"No asignada",
                    'promedio' => $est['promedio'],
                );
            }
            $JString = json_encode($json);
            echo $JString;

        } catch (\Exception $e) {

            echo 0;
        }
    }

    public function reportePorcentaje()
    {
        $c = 170;//Total de creditos 100% "creo..."
        $dataEstudiante =Estudiante::join('users', 'estudiantes.documento', '=', 'users.documento')->join('personas', 'personas.documento', '=', 'users.documento')->get();
        $ingreso = array();

        foreach ($dataEstudiante as $est) {

            $c = 170;
            $u = $est['materiasaprobadas'];
            $total = (($u / $c) * 100);

            if($total>10){
                $ingreso[] = array(
                    "codigo" => $est['codigo'],
                    "apellidos" => $est['apellidos'],
                    "documento" => $est['documento'],
                    "email" => $est['email'],
                    "nombres" => $est['nombres']
                );
            }

        }

        $pdf = \PDF::loadView('pdfPro', compact('ingreso'));
        return $pdf->setPaper('A3','landscape')->stream();

    }

    //Servicio 5

    public function viewtesisEstudiante()
    {
            $json = array();
            $user = User::join('tesis__estudiantes', 'users.codigo', '=', 'tesis__estudiantes.codigoestudiante')
                ->join('teses', 'teses.codigo', '=', 'tesis__estudiantes.id_tesis')
               ->join('personas', 'personas.documento', '=', 'users.documento')->get();

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
            return view('dashboard.director.tesis')->with(compact('json','ruta'));



    }

    public function tesisEstudiante ()
    {

        $codigo = $_POST['codigo'];
        $user = User::join('personas','personas.documento', '=', 'users.documento')->Where('codigo', $codigo)->Where('rol', 2)->get()->first();
        if(empty($user)){
            echo 0;
            return;
        }
        $userT = User::join('tesis__estudiantes', 'users.codigo', '=', 'tesis__estudiantes.codigoestudiante')->where('users.codigo', '=', $codigo)->get()->first();
        if(!isset($userT)){

            $json[] = array(
                'codigo' => $user['codigo'],
                'nombre' => $user['nombres'],
                'apellido' => $user['apellidos'],
            );

        $JString = json_encode($json);
        echo $JString;
        }else{
            echo 1;
        }
    }

    public function  traerRutas($folder)
    {
        try{
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
        }catch(\Exception $ex){
            return view('error.index');
        }



    }

    public function guardarTesisEstudiante(Request $request)
    {
            $listCodigos = $_POST['listCodigos'];
            $titulo = $_POST['titulo'];
            $ruta = $_FILES['archivo']['tmp_name'];
            $nombre = $_FILES['archivo']['name'];

            //$files = $request->file('archivo');
           // echo filesize($files) . '.bytes';

            $array = explode("-", $listCodigos);

            $maxP = Tesis::max('codigo');

            if($maxP==0){
                $maxP = 1;
            }else{
                $maxP = $maxP + 1;
            }
            $files = $request->file('archivo');


            $dir = '1qHTyQcXeZQakeWT4jfgPMoeWB1ubjhTS';
            $recursive = false; // Get subdirectories also?
            $contents = collect(Storage::disk('google')->listContents($dir, $recursive));

            $dir = $contents->where('type', '=', 'dir')
                ->where('filename', '=', 'public')
                ->first(); // There could be duplicate directory names!
            if ( ! $dir) {
                return 'uno';
            }
            $name = time() . $maxP;
            Storage::disk('google')->put($dir['path'].'/'.$name, $files->get());

            Tesis::create([
                'codigo' => $maxP,
                'titulo' => $titulo,
                'archivo' => $name,
            ]);

            for ($i = 0; $i < count($array); $i++) {
                Tesis_Estudiante::create([
                    'id_tesis' => $maxP,
                    'codigoestudiante' => $array[$i],
                ]);
            }


    }


    //Servicio 6

    public function viewSeguimiento()
    {
        return view('dashboard.director.seguimiento');
    }

    public function getMail(Request $request)
    {
        $envio  = $request->input('envio');

        if($envio==2){
            $dataEstudiante = User::select('users.codigo', 'personas.nombres', 'personas.apellidos')
                ->join('estudiantes', 'users.documento', '=', 'estudiantes.documento')
                ->join('personas', 'personas.documento', '=', 'estudiantes.documento')
                ->get();
        }else{
            $dataEstudiante = User::select('users.codigo', 'personas.nombres', 'personas.apellidos')
                ->join('estudiantes', 'users.documento', '=', 'estudiantes.documento')
                ->join('personas', 'personas.documento', '=', 'estudiantes.documento')
                ->where('estudiantes.egresado', '=' , $envio)
                ->get();
        }



        foreach ($dataEstudiante as $info){
            $data = [
                'name' => $info['nombres'] . " " .  $info['apellidos'],
                'asunto' => $request->input('subject'),
                'messag' => $request->input('message')
            ];
            Mail::to('garciaquinteroga@gmail.com')->send(new TestMail($data));//aca se cambie por el remitente
        }


        \RealRashid\SweetAlert\Facades\Alert::success('Correo enviado', 'Egresados.Agroindustrial');
        return redirect('director/seguimiento');

    }

    //Servicio 7

    public function viewPrueba()
    {
        return view('dashboard.director.prueba');
    }

    public function datosPrueba(Request $request){
        $data = $request->input('search');
        $user = User::join('personas','personas.documento', '=', 'users.documento')->where('codigo', '=',  $data )->get()->first();
        if($user){
            $dataEstudiante  = DB::select("SELECT pp.lectura_critica , pp.razonamiento_cuantitativo , pp.competencias_ciudadana , pp.comunicacion_escrita , pp.ingles ,p11.lectura_critica AS lp11, p11.matematicas AS mp11, p11.sociales_ciudadanas AS sp11, p11.naturales AS np11, p11.ingles AS ip11 FROM saber_pros pp, saber11s p11 WHERE pp.idsaberpro =((SELECT h.idsaberpro FROM users u INNER JOIN estudiantes e ON u.documento=e.documento INNER JOIN historials h ON h.documento=u.documento WHERE u.codigo=$data LIMIT 1)) AND p11.idsaber11 =((SELECT h.idSaber11 FROM users u INNER JOIN estudiantes e ON u.documento=e.documento INNER JOIN historials h ON h.documento=u.documento WHERE u.codigo=$data LIMIT 1))");

            foreach ($dataEstudiante as $est) {
                $json[] = array(
                    'lectura_critica' => $est->lectura_critica,
                    'razonamiento_cuantitativo' => $est->razonamiento_cuantitativo,
                    'competencias_ciudadana' => $est->competencias_ciudadana,
                    'comunicacion_escrita' => $est->comunicacion_escrita,
                    'ingles' => $est->ingles,
                    'p11' => $est->lp11,
                    'p12' => $est->mp11,
                    'p13' => $est->sp11,
                    'p14' => $est->np11,
                    'p15' => $est->ip11,
                    'nombre' => $user['nombres'],
                    'apellido' => $user['apellidos']

                );
            }
            $JString = json_encode($json);
            echo $JString;
            return;
        }else{
            echo 0;
        }


    }

    //Servicio 8

    public function viewReporte()
    {
        return view('dashboard.director.reportes');
    }

    public function generarReporte(Request $request){
        $estudiante =  $request->input('estudiante');
        $reporte =  $request->input('reporte');
        $especifico =  $request->input('startReporteCodigo');
        $startReporteFecha =  $request->input('startReporteFecha');

        $fechaActual = date('Y-m-d');

        if(!empty($startReporteFecha)){
            if($reporte=="Notas pruebas Saber Pro"){
                if($estudiante=="Alumno"){
                    $dataPruebasPro  = DB::select("SELECT u.codigo, u.documento, ps.* , (ps.lectura_critica + ps.razonamiento_cuantitativo + ps.competencias_ciudadana + ps.comunicacion_escrita + ps.ingles)/5 AS promedio  FROM users u INNER JOIN estudiantes e ON e.documento=u.documento INNER JOIN personas p ON u.documento=p.documento INNER JOIN historials h ON h.documento=u.documento INNER JOIN saber_pros ps ON h.idsaberpro = ps.idsaberpro  WHERE  e.egresado=0 AND ps.fecha_pro Between '$startReporteFecha' AND '$fechaActual'");
                }else if($estudiante=="Egresado"){
                    $dataPruebasPro  = DB::select("SELECT u.codigo, u.documento, ps.*, (ps.lectura_critica + ps.razonamiento_cuantitativo + ps.competencias_ciudadana + ps.comunicacion_escrita + ps.ingles)/5 AS promedio  FROM users u INNER JOIN estudiantes e ON e.documento=u.documento INNER JOIN personas p ON u.documento=p.documento INNER JOIN historials h ON h.documento=u.documento INNER JOIN saber_pros ps ON h.idsaberpro = ps.idsaberpro   WHERE e.egresado=1 AND ps.fecha_pro Between '$startReporteFecha' AND '$fechaActual'");
                }
                $pdf = \PDF::loadView('pdf', compact('dataPruebasPro'));

            }else if($reporte=="Notas pruebas Saber 11"){
                if($estudiante=="Alumno"){
                    $dataPruebas11  = DB::select("SELECT u.codigo, u.documento , s11.*, (s11.lectura_critica + s11.matematicas + s11.sociales_ciudadanas + s11.naturales + s11.ingles)/5 AS promedio  FROM users u INNER JOIN estudiantes e ON e.documento=u.documento INNER JOIN personas p ON u.documento=p.documento INNER JOIN historials h ON h.documento=u.documento  INNER JOIN saber11s s11 ON s11.idsaber11=h.idsaber11 WHERE  e.egresado=0 AND S11.fecha_11 Between '$startReporteFecha' AND '$fechaActual'");

                }else if($estudiante=="Egresado"){
                    $dataPruebas11  = DB::select("SELECT u.codigo, u.documento, s11.*, (s11.lectura_critica + s11.matematicas + s11.sociales_ciudadanas + s11.naturales + s11.ingles)/5 AS promedio  FROM users u INNER JOIN estudiantes e ON e.documento=u.documento INNER JOIN personas p ON u.documento=p.documento INNER JOIN historials h ON h.documento=u.documento  INNER JOIN saber11s s11 ON s11.idsaber11=h.idsaber11 WHERE e.egresado=1 AND S11.fecha_11 Between '$startReporteFecha' AND '$fechaActual'");
                }
                $pdf = \PDF::loadView('pdf', compact('dataPruebas11'));

            }
            return $pdf->setPaper('A3','landscape')->stream();
        }



        if($especifico==null){
            if($reporte=="Datos Personal"){
                if($estudiante=="Alumno"){
                    $dataEstudiante  = DB::select('SELECT * FROM users u INNER JOIN personas  p ON u.documento=p.documento INNER JOIN estudiantes e ON e.documento=u.documento WHERE u.documento=p.documento AND e.egresado=0');

                }else if($estudiante=="Egresado"){
                    $dataEstudiante  = DB::select('SELECT * FROM users u INNER JOIN personas  p ON u.documento=p.documento INNER JOIN estudiantes e ON e.documento=u.documento WHERE u.documento=p.documento AND e.egresado=1');
                }
                $pdf = \PDF::loadView('pdf', compact('dataEstudiante'));

            }else if($reporte=="Notas pruebas Saber Pro"){
                if($estudiante=="Alumno"){
                    $dataPruebasPro  = DB::select('SELECT u.codigo, u.documento, ps.* , (ps.lectura_critica + ps.razonamiento_cuantitativo + ps.competencias_ciudadana + ps.comunicacion_escrita + ps.ingles)/5 AS promedio  FROM users u INNER JOIN estudiantes e ON e.documento=u.documento INNER JOIN personas p ON u.documento=p.documento INNER JOIN historials h ON h.documento=u.documento INNER JOIN saber_pros ps ON h.idsaberpro = ps.idsaberpro  WHERE  e.egresado=0');

                }else if($estudiante=="Egresado"){
                    $dataPruebasPro  = DB::select('SELECT u.codigo, u.documento, ps.*, (ps.lectura_critica + ps.razonamiento_cuantitativo + ps.competencias_ciudadana + ps.comunicacion_escrita + ps.ingles)/5 AS promedio  FROM users u INNER JOIN estudiantes e ON e.documento=u.documento INNER JOIN personas p ON u.documento=p.documento INNER JOIN historials h ON h.documento=u.documento INNER JOIN saber_pros ps ON h.idsaberpro = ps.idsaberpro   WHERE e.egresado=1');
                }
                $pdf = \PDF::loadView('pdf', compact('dataPruebasPro'));

            }else if($reporte=="Notas pruebas Saber 11"){
                if($estudiante=="Alumno"){
                    $dataPruebas11  = DB::select('SELECT u.codigo, u.documento , s11.*, (s11.lectura_critica + s11.matematicas + s11.sociales_ciudadanas + s11.naturales + s11.ingles)/5 AS promedio  FROM users u INNER JOIN estudiantes e ON e.documento=u.documento INNER JOIN personas p ON u.documento=p.documento INNER JOIN historials h ON h.documento=u.documento  INNER JOIN saber11s s11 ON s11.idsaber11=h.idsaber11 WHERE  e.egresado=0');

                }else if($estudiante=="Egresado"){
                    $dataPruebas11  = DB::select('SELECT u.codigo, u.documento, s11.*, (s11.lectura_critica + s11.matematicas + s11.sociales_ciudadanas + s11.naturales + s11.ingles)/5 AS promedio  FROM users u INNER JOIN estudiantes e ON e.documento=u.documento INNER JOIN personas p ON u.documento=p.documento INNER JOIN historials h ON h.documento=u.documento  INNER JOIN saber11s s11 ON s11.idsaber11=h.idsaber11 WHERE e.egresado=1');
                }
                $pdf = \PDF::loadView('pdf', compact('dataPruebas11'));

            }else if($reporte=="Promedio"){
                if($estudiante=="Alumno"){
                    $dataGrafica  = DB::select('SELECT AVG(s11.lectura_critica) AS lectura,  AVG(s11.matematicas) AS matematicas, AVG(s11.sociales_ciudadanas) AS sociales_ciudadanas, AVG(s11.naturales) AS naturales, AVG(s11.ingles) AS ingle,AVG(s.lectura_critica) AS lectura_critica,  AVG(s.razonamiento_cuantitativo) AS razonamiento, AVG(s.competencias_ciudadana) AS competencias_ciudadana, AVG(s.comunicacion_escrita) AS comunicacion_escrita, AVG(s.ingles) AS ingles FROM users u INNER JOIN estudiantes e ON e.documento=u.documento INNER JOIN personas p ON u.documento=p.documento INNER JOIN historials h ON h.documento=u.documento INNER JOIN saber_pros s ON s.idsaberpro=h.idsaberpro INNER JOIN saber11s s11 ON s11.idsaber11=h.idsaber11 WHERE  e.egresado=0');

                }else if($estudiante=="Egresado"){
                    $dataGrafica  = DB::select('SELECT AVG(s11.lectura_critica) AS lectura,  AVG(s11.matematicas) AS matematicas, AVG(s11.sociales_ciudadanas) AS sociales_ciudadanas, AVG(s11.naturales) AS naturales, AVG(s11.ingles) AS ingle,AVG(s.lectura_critica) AS lectura_critica,  AVG(s.razonamiento_cuantitativo) AS razonamiento, AVG(s.competencias_ciudadana) AS competencias_ciudadana, AVG(s.comunicacion_escrita) AS comunicacion_escrita, AVG(s.ingles) AS ingles FROM users u INNER JOIN estudiantes e ON e.documento=u.documento INNER JOIN personas p ON u.documento=p.documento INNER JOIN historials h ON h.documento=u.documento INNER JOIN saber_pros s ON s.idsaberpro=h.idsaberpro INNER JOIN saber11s s11 ON s11.idsaber11=h.idsaber11 WHERE  e.egresado=1');
                }
                $pdf = \PDF::loadView('pdf', compact('dataGrafica'));
                return $pdf->setPaper('A4','landscape')->stream();
            }
        }else if($especifico!=null){


            $user = User::where('codigo',$especifico)->get();
            $ingresoEspecifico = array();
            if(sizeof($user)!=0) {
                if ($reporte == "Datos Personal") {
                    $dataEstudiante = DB::select("SELECT * FROM users u INNER JOIN personas  p ON u.documento=p.documento INNER JOIN estudiantes e ON e.documento=u.documento WHERE u.codigo= '$especifico'");
                    $pdf = \PDF::loadView('pdf', compact('dataEstudiante'));
                } else if ($reporte == "Notas pruebas Saber Pro") {
                    $dataPruebasPro = DB::select("SELECT u.codigo, u.documento, ps.* , (ps.lectura_critica + ps.razonamiento_cuantitativo + ps.competencias_ciudadana + ps.comunicacion_escrita + ps.ingles)/5 AS promedio  FROM users u INNER JOIN estudiantes e ON e.documento=u.documento INNER JOIN personas p ON u.documento=p.documento INNER JOIN historials h ON h.documento=u.documento INNER JOIN saber_pros ps ON h.idsaberpro = ps.idsaberpro  WHERE  u.codigo='$especifico'");
                    $pdf = \PDF::loadView('pdf', compact('dataPruebasPro'));
                } else if ($reporte == "Notas pruebas Saber 11") {
                    $dataPruebas11 = DB::select("SELECT u.codigo, u.documento , s11.*, (s11.lectura_critica + s11.matematicas + s11.sociales_ciudadanas + s11.naturales + s11.ingles)/5 AS promedio  FROM users u INNER JOIN estudiantes e ON e.documento=u.documento INNER JOIN personas p ON u.documento=p.documento INNER JOIN historials h ON h.documento=u.documento  INNER JOIN saber11s s11 ON s11.idsaber11=h.idsaber11 WHERE   u.codigo='$especifico'");
                    $pdf = \PDF::loadView('pdf', compact('dataPruebas11'));
                }
            }else{
                array_push($ingresoEspecifico,"¡Codigo no registrado!");
                return view('dashboard.director.reportes')->with(compact('ingresoEspecifico'));
            }
        }


       return $pdf->setPaper('A3','landscape')->stream();

    }



    //Servicio 9

    function viewagregarEmpresa(){
        return view('dashboard.director.empresa');
    }

    function guardarEmpresa(Request $request){
        $nit = $request->input('nitEmpresa');

        $nitCor = $request->input('correoEmpresa');

        $userCor = User::where('email' , '=' , $nitCor)->first();
        if(isset($userCor)){
            echo 2;
            return;
        }

        $user = User::where('codigo' , '=' , $nit)->first();
            if(!isset($user)){
                $files = $request->file('archivo');
                $name = time();

                $dir = '1qHTyQcXeZQakeWT4jfgPMoeWB1ubjhTS';
                $recursive = false; // Get subdirectories also?
                $contents = collect(Storage::disk('google')->listContents($dir, $recursive));

                $dir = $contents->where('type', '=', 'dir')
                    ->where('filename', '=', 'convenio')
                    ->first(); // There could be duplicate directory names!
                if (!$dir) {
                    return 'uno';
                }
                $name = time();
                Storage::disk('google')->put($dir['path'] . '/' . $name, $files->get());

                User::create([
                    'codigo' => $request['nitEmpresa'],
                    'email' => $request['correoEmpresa'],
                    'email_verified_at' => now(),
                    'password' => md5($request['contraEmpresa']),
                    'remember_token' => Str::random(10),
                    'rol' => 3,
                ]);
                Empresa::create([
                    'nit' => $request['nitEmpresa'],
                    'nombre' => $request['nombreEmpresa'],
                    'telefono' => $request['telefonoEmpresa'],
                    'celular' => $request['celularEmpresa'],
                    'direccion' => $request['direccionEmpresa'],
                    'fecha' => $request['fecha'],
                    'ciudad' => strtoupper($request['ciudadEmpresa']),
                    'convenio' => $name
                ]);

                echo 1;
            }else{
                echo 0;
            }





        }


    //Servicio 9

    function viewEmpresa(){

        $data  = DB::select('SELECT *  FROM empresas e INNER JOIN users u ON u.codigo = e.nit ');
        if(isset($data)) {
            $ruta =  $this->traerRutas('convenio');
        }
        return view('dashboard.director.listarEmpresa')->with(compact('data','ruta'));

    }

    function deleteEmpresa($id, $nombre){
        $flight = User::find($id);
        $flight->delete();
        $flig = Empresa::find($id);
        $flig->delete();
        $this->eliminarFichero('1NhilB3z9MbmDyxMyLMA4txex0dfGGt0z', $nombre);
        \RealRashid\SweetAlert\Facades\Alert::success('Empresa Eliminada', 'Operacion exitosa');
        return back();

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

    //Servicio 11

    function viewEncuesta(){

        return view('dashboard.director.encuesta');

    }

    function enviarEncuesta(Request $request){
        $envio  = $request->input('envio');

        if($envio==2){
            $dataEstudiante = User::select('users.codigo', 'personas.nombres', 'personas.apellidos')
                ->join('estudiantes', 'users.documento', '=', 'estudiantes.documento')
                ->join('personas', 'personas.documento', '=', 'estudiantes.documento')
                ->where('estudiantes.egresado', '=' , $envio)
                ->get();
        }else {
            $dataEstudiante = User::select('users.codigo', 'personas.nombres', 'personas.apellidos')
                ->join('estudiantes', 'users.documento', '=', 'estudiantes.documento')
                ->join('personas', 'personas.documento', '=', 'estudiantes.documento')
                ->where('estudiantes.egresado', '=' , $envio)
                ->get();
        }



        foreach ($dataEstudiante as $info){
            $data = [
                'name' => $info['nombres'] . " " .  $info['apellidos'],
                'asunto' => "Encuesta",
                'messag' => $request->input('cuerpo') . "mediante: " . $request->input('url')
            ];
            Mail::to('garciaquinteroga@gmail.com')->send(new TestMail($data));
        }


        \RealRashid\SweetAlert\Facades\Alert::success('Correo enviado', 'Egresados.Agroindustrial');
        return back();
    }

    //Servicio 12

    function viewEvento(){

        return view('dashboard.director.eventos');

    }

    function guardarEvento(Request $request){
       $this->validateDataEvento($request);

        $files = $request->file('foto');

        $dir = '1qHTyQcXeZQakeWT4jfgPMoeWB1ubjhTS';
        $recursive = false; // Get subdirectories also?
        $contents = collect(Storage::disk('google')->listContents($dir, $recursive));

        $dir = $contents->where('type', '=', 'dir')
            ->where('filename', '=', 'evento')
            ->first(); // There could be duplicate directory names!
        if ( ! $dir) {
            return 'uno';
        }
        $name = time();
        Storage::disk('google')->put($dir['path'].'/'.$name, $files->get());

        Evento::create([
            'titulo' => $request['titulo'],
            'direccion' => $request['direccion'],
            'fecha' => $request['fecha'],
            'hora' => $request['hora'],
            'responsable' => $request['responsable'],
            'ciudad' => strtoupper($request['ciudad']),
            'descripcion' => $request['descripcion'],
            'destinatario' => $request['envio'],
            'foto' => $name
        ]);

        \RealRashid\SweetAlert\Facades\Alert::success('Evento creado', 'Satisfactoriamente');
        return back();
    }

    protected function validateDataEvento(Request $request){

        $request->validate([
            'titulo' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'direccion' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'ciudad' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'fecha' => 'required',
            'hora' => 'required',
            'responsable' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'descripcion' => 'required'


        ]);

    }

    //Servicio 13

    function viewListarEvento(){
        $data  = DB::select('SELECT *  FROM eventos');
        if(isset($data)) {
            $ruta =  $this->traerNombre('evento');

        }
        return view('dashboard.director.listarEvento')->with(compact('data','ruta'));

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

    function deleteEvento($id, $nombre){
        $flight = Evento::find($id);
        $flight->delete();
        $this->eliminarFichero('1JcJ2Z8zIDTTirkdqu3Bd78txp02hJslX', $nombre);
        \RealRashid\SweetAlert\Facades\Alert::success('Evento Eliminado', 'Operacion exitosa');
        return back();

    }

    function viewactualizarEvento($id){
        $flight = Evento::find($id);
        return view('dashboard.director.actualizarEvento')->with(compact('flight'));
    }

    function actualizarEvento($id, Request $request){
        $flight = Evento::find($id);
        $flight->titulo =  $request['titulo'];
        $flight->direccion =  $request['direccion'];
        $flight->fecha =  $request['fecha'];
        $flight->hora =  $request['hora'];
        $flight->responsable =  $request['responsable'];
        $flight->ciudad =  $request['ciudad'];
        $flight->descripcion =  $request['descripcion'];
        $flight->destinatario =  $request['destinatario'];
        $flight->save();
        \RealRashid\SweetAlert\Facades\Alert::success('Evento Actualizado', 'Operacion exitosa');
        return redirect('director/evento/listar');

    }


    //Servicio 14

    function viewNoticia(){
        return view('dashboard.director.noticia');
    }

    function agregarNoticia(Request $request){

        Noticia::create([
            'titulo' => $request['titulo'],
            'autor' => $request['autor'],
            'noticia' => $request['noticia'],
            'envio' =>  $request['envio']
        ]);
        \RealRashid\SweetAlert\Facades\Alert::success('Noticia agregada', 'Operacion exitosa');
        return back();

    }

    //Servicio 15

    function viewListarNoticia(){
        $data = Noticia::all();
        return view('dashboard.director.listarNoticia')->with(compact('data'));
    }

    function deleteNoticia($id){
        $flight = Noticia::find($id);
        $flight->delete();
        \RealRashid\SweetAlert\Facades\Alert::success('Noticia Eliminada', 'Operacion exitosa');
        return back();

    }






}

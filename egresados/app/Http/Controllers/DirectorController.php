<?php


namespace App\Http\Controllers;

Use Alert;
use App\User;
use Illuminate\Http\Request;
use App\Imports\UsersImport;


class DirectorController extends Controller
{
    //Servicio 1
    public function principal()
    {
        $dataEstudiante = User::select('personas.documento', 'personas.nombres', 'personas.apellidos')->join('estudiantes', 'users.documento', '=' , 'estudiantes.documento')->join('personas', 'personas.documento', '=', 'estudiantes.documento')->where('users.rol', '=', '2')->get();

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
        $file = $request->file('file');

        $import = new UsersImport;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {

            return back()->withFailures($import->failures()->sort());
        }
        Alert::success('Carga de datos excel', 'informacion guardada');
        return back();


    }


    //Servico 3

    public function actualizarEstudiante()
    {
        return view('dashboard.director.actualizar');
    }
}

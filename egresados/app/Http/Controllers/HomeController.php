<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
            $dataEstudiante = User::select('personas.documento', 'personas.nombres', 'personas.apellidos')->join('estudiantes', 'users.documento', '=' , 'estudiantes.documento')->join('personas', 'personas.documento', '=', 'estudiantes.documento')->where('users.rol', '=', '2')->get();
            return view('dashboard.director.index')->with(compact('dataEstudiante'));
        }else if(auth()->user()->rol==2){
            return view('dashboard.estudiante.index');
        }else if(auth()->user()->rol==3){
            return view('dashboard.empresa.index');
        }
    }
}

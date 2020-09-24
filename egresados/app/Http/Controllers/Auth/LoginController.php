<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function showLoginForm(){
        return view('login.index');
    }

    public function login(Request $request){
        $this->validateLogin($request);
        return $this->sendLoginResponse($request);
    }

    protected function validateLogin(Request $request){

        if(isset($request['tipo'])) {
            $request->validate([
                'codigo' => 'required|integer|digits:7',
                'documento' => 'required|integer|digits:10',
                'contraseña' => 'required',
            ]);
        }else{
            $request->validate([
                'codigo' => 'required|integer|digits:7',
                'contraseña' => 'required',
            ]);
        }
    }

    public function sendLoginResponse(Request $request){

        $ingresoError= array();


        if(isset($request['tipo'])){
            $user = User::where('codigo',$request['codigo'])
                ->where('documento',$request['documento'])
                ->where('password', md5($request['contraseña']))
                ->get();
        }else{
            $user = User::where('codigo',$request['codigo'])
                ->where('password', md5($request['contraseña']))
                ->get();
        }

        if(sizeof($user)==1){
            $this->guard()->login($user[0]);
            return redirect('/home');
        }else{
            array_push($ingresoError,"¡Los datos ingresados son incorrectos!");
            if(isset($request['tipo'])){
                return view('login.index')->with(compact('ingresoError'));
            }else{
                return view('login.empresa')->with(compact('ingresoError'));;
            }


        }

    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $ingresoError= array();
        $user = Socialite::driver('google')->stateless()->user();

        $user = User::where('email',$user->getEmail())->get();
        if(sizeof($user)==1){
            $this->guard()->login($user[0]);
            return redirect('/home');
        }
        array_push($ingresoError,"¡Email no registrado en Agro Industrial, tenga en cuenta que solo esta permitido el inicio con el correo institucional.!");
        return view('login.index')->with(compact('ingresoError'));


    }


    public function logout(Request $request){

        $this->guard()->logout();
        return $this->loggedOut($request) ?: redirect('/');

    }
}

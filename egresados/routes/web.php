<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//RUTAS PARA LOGIN
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/empresa', 'SesionController@showLoginEmpresa')->name('login.empresa');

//LOGIN POR GOOGLE
Route::get('login/google', [LoginController::class, 'redirectToProvider'])->name('login.google');
Route::get('login/google/callback', [LoginController::class, 'handleProviderCallback']);


//RUTAS PARA CONTRASEÑA
Route::get('routes/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('routes/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('routes/password/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('routes/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');


//Rutas de servicio de administrador

Route::group(['prefix' => 'director', 'middleware' => ['auth', 'rol']], function() {
    Route::get('/principal', 'DirectorController@principal')->name('admin.principal');
    Route::get('/cargaEstudiante', 'DirectorController@cargaEstudiante')->name('admin.carga');
    Route::get('/formato', 'DirectorController@formato')->name('admin.formato');
    Route::get('/actualizar', 'DirectorController@actualizarEstudiante')->name('admin.actualizar');


    Route::post('/cargaEstudiante', 'DirectorController@guardarEstudiante')->name('admin.carga');

});





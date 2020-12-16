<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Storage;

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


Route::get('test', function() {


});
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


//RUTAS DE SERVICIO ADMINISTRADOR

Route::group(['prefix' => 'director', 'middleware' => ['auth', 'rol:1']], function() {
    Route::get('/principal', 'DirectorController@principal')->name('admin.principal');
    Route::get('/cargaEstudiante', 'DirectorController@cargaEstudiante')->name('admin.carga');
    Route::get('/formato', 'DirectorController@formato')->name('admin.formato');
    Route::get('/actualizar', 'DirectorController@viewActualizarEstudiante')->name('admin.actualizar');
    Route::get('/listar/estudiante', 'DirectorController@viewlistarEstudiante')->name('admin.lista.estudiante');
    Route::get('/tesis/estudiante', 'DirectorController@viewtesisEstudiante')->name('admin.tesis.estudiante');
    Route::get('/seguimiento', 'DirectorController@viewSeguimiento')->name('admin.seguimiento');
    Route::get('/empresa', 'DirectorController@viewagregarEmpresa')->name('admin.empresa');
    Route::get('/empresa/listar', 'DirectorController@viewEmpresa')->name('admin.empresa.listar');
    Route::get('/estudiante/prueba', 'DirectorController@viewPrueba')->name('admin.prueba');
    Route::get('/reporte', 'DirectorController@viewReporte')->name('admin.reporte');
    Route::get('/evento', 'DirectorController@viewEvento')->name('admin.evento');
    Route::get('/evento/listar', 'DirectorController@viewListarEvento')->name('admin.evento.listar');
    Route::get('/evento/actualizar/{id}', 'DirectorController@viewactualizarEvento')->name('admin.evento.actualizar');
    Route::get('/encuesta', 'DirectorController@viewEncuesta')->name('admin.encuesta');
    Route::get('/noticia', 'DirectorController@viewNoticia')->name('admin.noticia');
    Route::get('/noticia/listar', 'DirectorController@viewListarNoticia')->name('admin.listar.noticia');

    //------------------------------//

    Route::post('/cargaEstudiante', 'DirectorController@guardarEstudiante')->name('admin.carga');
    Route::post('/actualizar/codigo', 'DirectorController@datosEstudiante')->name('admin.codigo');
    Route::post('/actualizar', 'DirectorController@actualizarEstudiante')->name('admin.actualizar.data');
    Route::post('/actualizar/egresado', 'DirectorController@actualizarEgresado')->name('admin.actualizar.egresado');
    Route::post('/listar', 'DirectorController@listarEstudiantes')->name('admin.estudiante');
    Route::post('/listar/codigo', 'DirectorController@buscarEstudiantes')->name('admin.estudiante.buscar');
    Route::post('/tesis/estudiante', 'DirectorController@tesisEstudiante')->name('admin.tesis.estudiante');
    Route::post('/tesis/estudiante/guardar', 'DirectorController@guardarTesisEstudiante')->name('admin.tesis.guardar');
    Route::post('/correo', 'DirectorController@getMail')->name('email');
    Route::post('/empresa/agregar', 'DirectorController@guardarEmpresa')->name('admin.empresa.agregar');
    Route::post('/empresa/eliminar/{id}/{nombre}', 'DirectorController@deleteEmpresa')->name('admin.empresa.eliminar');
    Route::post('/estudiante/prueba', 'DirectorController@datosPrueba')->name('admin.prueba');
    Route::post('/reporte', 'DirectorController@generarReporte')->name('admin.reporte');
    Route::post('/evento', 'DirectorController@guardarEvento')->name('admin.evento');
    Route::post('/evento/eliminar/{id}/{nombre}', 'DirectorController@deleteEvento')->name('admin.evento.eliminar');
    Route::post('/evento/actualizar/{id}', 'DirectorController@actualizarEvento')->name('admin.evento.actualizar');
    Route::post('/encuesta', 'DirectorController@enviarEncuesta')->name('admin.encuesta');
    Route::post('/noticia', 'DirectorController@agregarNoticia')->name('admin.noticia');

});



Route::group(['prefix' => 'estudiante', 'middleware' => ['auth', 'rol:2']], function() {
    Route::get('/principal', 'EstudianteController@viewPrincipal')->name('estudiante.principal');
    Route::get('/oferta', 'EstudianteController@viewOferta')->name('estudiante.oferta');
    Route::get('/actualizar', 'EstudianteController@viewActualizar')->name('estudiante.actualizar');
    Route::get('/eventos', 'EstudianteController@viewEventos')->name('estudiante.eventos');


    Route::get('/tesis', 'EstudianteController@viewTesis')->name('estudiante.tesis');



    Route::post('/hojadeVida', 'EstudianteController@guardarHoja')->name('estudiante.hoja');
    Route::post('/hojadeVida/autorizar', 'EstudianteController@autorizar')->name('estudiante.autorizar');
    Route::post('/actualizar', 'EstudianteController@actualizarData')->name('estudiante.actualizar');

});



Route::group(['prefix' => 'empresa', 'middleware' => ['auth', 'rol:3']], function() {

    Route::get('/hojaEstudiante', 'EmpresaController@listarHojaEstudiante')->name('empresa.estudiante.hoja');
    Route::get('/hojaEgresado', 'EmpresaController@listarHojaEgresado')->name('empresa.egresado.hoja');
    Route::get('/principal', 'EmpresaController@viewOferta')->name('empresa.oferta');
    Route::get('/ofertas', 'EmpresaController@viewlistarOferta')->name('empresa.oferta.listar');


    Route::post('/oferta/guardar', 'EmpresaController@guardarOferta')->name('empresa.oferta.guardar');
    Route::post('/oferta/eliminar/{id}', 'EmpresaController@deleteOferta')->name('empresa.oferta.eliminar');


});





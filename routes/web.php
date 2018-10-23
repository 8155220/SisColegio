<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
//Colegio
//AdmUsuario
Route::resource('admUsuario/gestionarUsuario','UsuarioController');
Route::resource('admUsuario/gestionarTipoUsuario','TipoUsuarioController');
Route::resource('admUsuario/bitacora','BitacoraController');
Route::resource('admUsuario/gestionarPrivilegios','PrivilegiosController');
//reportes
Route::get('admUsuario/gestionarReporte/','ReporteController@index');
Route::get('admUsuario/gestionarReporte/gestion','ReporteController@getReporteGestion');
Route::get('admUsuario/gestionarReporte/grado/{id}','ReporteController@getReporteGrado');
//Route::resource('admUsuario/gestionarReporte/grado','ReporteController');

//Perfil
Route::resource('perfil/cambiarFotoPerfil','CambiarFotoPerfilController');
Route::resource('perfil/cambiarPassword','CambiarPasswordController');
Route::resource('perfil/skin','SkinController');
//apertura
Route::resource('apertura/gestionarGrado','GradoController');
Route::resource('apertura/gestionarMateria','MateriaController');
Route::resource('apertura/gestionarAula','AulaController');
Route::resource('apertura/aperturaGestion','GestionController');
Route::resource('apertura/gestionarPeriodo','PeriodoController');
Route::resource('apertura/gestionarBloque','BloqueController');
Route::resource('apertura/gestionarGradoBloque','GradoBloqueController');
Route::resource('apertura/gestionarDocente','DocenteController');
Route::resource('apertura/gestionarAdministrativo','AdministrativoController');
Route::resource('apertura/gestionarProgramacionMateria','ProgramacionMateriaController');
Route::get('/greeting','AndroidController@index2');
//pruebas AndroidController
Route::resource('/android','AndroidController');
Route::get('/android/verificarUsuario/{id1}/{id2}','AndroidController@verificarUsuario');

//select dinamicos
Route::get('apertura/gestionarProgramacionMateria/bloque/{id}/gestionturno/{id2}','ProgramacionMateriaController@getBloque');
Route::get('apertura/gestionarProgramacionMateria/turno/{id}','ProgramacionMateriaController@getTurno');
Route::get('apertura/gestionarProgramacionMateria/iddetallegestionturno/{id}','ProgramacionMateriaController@getGrado');
Route::get('/obtenerPeriodo/{id}','PeriodoController@getPeriodo');

//boton verificar cuporestante
Route::get('apertura/gestionarGradoBloque/{id1}/{id2}/{id3}','GradoBloqueController@getCupo');
Route::resource('academico/gestionarEstudiante','EstudianteController');
Route::resource('academico/gestionarTutor','TutorController');
Route::resource('academico/gestionarInscripcion','InscripcionController');
Route::resource('academico/gestionarCuota','CuotaController');

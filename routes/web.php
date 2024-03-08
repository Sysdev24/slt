<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
 */

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/registro');
    } else {
        return view('auth/login');
    }
})->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\Registro\RegistroController::class, 'index'])->name('home')->middleware('auth');
Route::get('/consultar-usuario-ldap', [App\Http\Controllers\Controllers_Generic\LDAPController::class, 'consultarUsuarioLDAP'])->name('consultar-usuario-ldap');
Route::get('/consultar-datos-usuario-ldap', [App\Http\Controllers\Controllers_Generic\LDAPController::class, 'consultarDatosUsuarioLDAP'])->name('consultar-datos-usuario-ldap');

//FIXME: Eliminar esta ruta
Route::get('/consultar-datos-usuario-ldap-cedula/{cedula}', [App\Http\Controllers\Controllers_Generic\LDAPController::class, 'consultarDatosUsuarioLDAPXCedula'])->name('consultar-datos-usuario-ldap-cedula');

Route::get('/consultar', [App\Http\Controllers\Visitantes\VisitanteController::class, 'consultarVisitante'])->name('consultar-visitante');

Route::get('/reportes', [\App\Http\Controllers\Reportes\ReporteRegistroController::class, 'index'])->name('reportes');

Route::get('/consultar-registro', [\App\Http\Controllers\Reportes\ReporteRegistroController::class, 'getViewRegistersByFilters'])->name('consultar-registro');
Route::get('/export-excel', [\App\Http\Controllers\Reportes\ReporteRegistroController::class, 'exportToExcelOrOpenOffice'])->name('export-excel');
Route::get('/export-pdf', [\App\Http\Controllers\Reportes\ReporteRegistroController::class, 'exportToPDF'])->name('export-pdf');
Route::get('registro_pdf', [\App\Http\Controllers\Reportes\ReporteRegistroController::class, 'registro_pdf'])->name('registro_pdf');


Route::resource('/usuarios', App\Http\Controllers\Administracion\UserController::class)->except('create');
Route::resource('/estados', App\Http\Controllers\Administracion\EstadoController::class)->except('create');
Route::resource('/gerencia', App\Http\Controllers\Administracion\GerenciaController::class)->except('create');
Route::resource('/operadoras', App\Http\Controllers\Administracion\OperadorasController::class)->except('create');
Route::resource('/personal', App\Http\Controllers\Administracion\PersonalController::class)->except('create');
Route::resource('/estatus', App\Http\Controllers\Administracion\EstatusController::class)->except('create');
Route::resource('/usuarios', App\Http\Controllers\Administracion\UserController::class)->except('create');
Route::resource('/plan', App\Http\Controllers\Administracion\PlanController::class)->except('create');
Route::resource('/cargo', App\Http\Controllers\Administracion\CargoController::class)->except('create');
Route::resource('/equipo', App\Http\Controllers\Administracion\EquipoController::class)->except('create');
Route::resource('/equipo_componente', App\Http\Controllers\Administracion\Equipo_componenteController::class)->except('create');
Route::resource('/roles', App\Http\Controllers\Administracion\RolesController::class)->except('create');
Route::resource('/firmante', App\Http\Controllers\Administracion\FirmanteController::class)->except('create');

Route::resource('/registro', App\Http\Controllers\Registro\RegistroController::class)->except(['create']);
Route::resource('/visitantes', App\Http\Controllers\Visitantes\VisitanteController::class)->except(['destroy','create']);
Route::get('/getPerson', 'App\Http\Controllers\Registro\RegistroController@getPerson')->name('get.person');
Route::get('/getSerial', 'App\Http\Controllers\Registro\RegistroController@getSerial')->name('get.serial');

Route::get('/registro/preview-print/{id}',[App\Http\Controllers\Registro\RegistroController::class, 'imprimir'])->name('imprimir-acta');
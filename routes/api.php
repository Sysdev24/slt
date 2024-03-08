<?php


use App\Models\Registro\Registro;
use App\Models\Administracion\Gerencia;
use App\Models\Administracion\Estatus;
use App\Models\Administracion\Operadoras;
use App\Models\Administracion\Plan;
use App\Models\ViewRegistro;
use App\Models\Administracion\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Administracion\Estado;
use App\Models\Administracion\Cargo;
use App\Models\Administracion\Roles;
use App\Models\Administracion\Equipo;
use App\Models\Administracion\Firmante;
use App\Models\Administracion\Equipo_componente;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
 Route::get('registro', function () {
$data =DB::table('registro');
    
    $data = $data->select(['registro.id_registro',
    'registro.id_estatus as estatus_registro',
                                   'personal.id_personal',
                                   'personal.ci', 
                                   'personal.nombre', 
                                   'personal.apellido', 
                                   'personal.nro_empleado',
                                   'cargo.descripcion as cargo', 
                                   'gerencia.descripcion as gerencia',
                                   'estados.descripcion as estado',
                                   'operadoras.descripcion as operadora', 
                                   'plan.descripcion as plan',
                                   'plan.monto_credito as monto_plan',
                                   'estatus.descripcion as estatus', 
                                   'registro.nro_tlf', 
                                   'registro.cuenta_uso',
                                   'registro.observacion',
								   'view_equipo_componente.equipo',
                                   'view_equipo_componente.tipo',
                                   'view_equipo_componente.serial',
                                   'view_equipo_componente.accesorios', 
                                   'view_firmante.nombre_apellido'
                                ]);
    $data = $data->leftjoin('personal', 'personal.id_personal','registro.id_personal' );
    $data = $data->leftjoin('plan', 'plan.id_plan', 'registro.id_plan');
    $data = $data->leftjoin('operadoras', 'operadoras.id_operadora', 'registro.id_operadora');
    $data = $data->leftjoin('estatus', 'estatus.id_estatus', 'registro.id_estatus');
    $data = $data->leftjoin('estados', 'estados.id_estado', 'personal.id_estado');
    $data = $data->leftjoin('gerencia', 'gerencia.id_gergral', 'personal.id_gergral');
    $data = $data->leftjoin('cargo', 'cargo.id_cargo', 'personal.id_cargo');
	$data = $data->leftjoin('view_equipo_componente', 'view_equipo_componente.id_equipo_componente', 'registro.id_equipo_componente');
    $data = $data->leftjoin('view_firmante', 'view_firmante.id_firmante', 'registro.id_firmante');
    $data = $data->get();
    return compact('data');
});
 
 
/* Route::get('registro', function () {
    $data = ViewRegistro::all();
    return compact('data');
});*/
 
 
 Route::get('estados', function () {
    $data = Estado::where ('id_estatus','1')->get ();
    return compact('data');
}); 

Route::get('gerencia', function (Request $request) {
    $data = Gerencia::where ('id_estatus','1')->get ();
    return compact('data');
});

Route::get('estatus', function (Request $request) {
    $data = Estatus::all();
    return compact('data');
});

Route::get('operadoras', function (Request $request) {
    $data = Operadoras::where ('id_estatus','1')->get ();
    return compact('data');
});

Route::get('plan', function () {
    $data = Plan::where ('id_estatus','1')->get ();
    return compact('data'); 
}); //->middleware('auth');

/*Route::get('registro', function () {
    $data = Registro::all();
    return compact('data');
});*/

Route::get('personal', function () {
    //dd('estoy aqui');
    $data = Personal::where ('id_estatus', '1')
    ->with(['cargo', 'gerencia','estado','Estatus'])
    ->get();
    //dd($data[0]->cargo->descripcion);
    return  compact('data');
    return response()->json($data);
});

Route::get('cargo', function () {
    $data = Cargo::where ('id_estatus','1')->get ();
    return compact('data');
});

Route::get('equipo', function () {
    $data = Equipo::where ('id_estatus','1')->get ();
    return compact('data');
});

Route::get('roles', function () {
    $data = Roles::where ('id_estatus','1')->get ();
    return compact('data');
});

Route::get('firmante', function () {
    $data = Firmante::where ('id_estatus','1')
    ->with(['personal','Estatus'])
    ->get();
    return compact('data');
    return response()->json($data);
});

Route::get('usuario', function () {
    //dd('estoy aqui');
    $data = Personal::where ('id_estatus', '1')
    ->with(['gerencia','roles','Estatus'])
    ->get();
    return  compact('data');
    return response()->json($data);
});

Route::get('usuarios', function () {
    //dd('estoy aqui');
    $data = Personal::where ('id_estatus', '1')
    ->with(['gerencia','estatus'])
    ->get();
    //dd($data);
    return  compact('data');
    return response()->json($data); 
});
// Route::get('equipo_componente', function () {
    // $data =DB::table('equipo_componente');
        // 
        // $data = $data->select(['equipo.id_sede_equipo',
                                // 'equipo.descripcion as equipo',
                                // 'equipo_componente.modelo', 
                                // 'equipo_componente.serial',
                                // 'equipo_componente.accesorios']);
        // $data = $data->leftjoin('equipo', 'equipo.id_sede_equipo','equipo_componente.id_sede_equipo' );
        // $data = $data->get();
        // return compact('data');
    // });
    Route::get('equipo_componente', function () {
        $data = Equipo_componente::where ('id_estatus','1')
        ->with(['equipo','estatus'])
        ->get ();
        return compact('data');
        return response()->json($data);
    });
<?php

namespace App\Http\Controllers\Registro;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Personal;
use App\Models\Administracion\Operadoras;
use App\Models\Administracion\Plan;
use App\Models\Administracion\Estatus;
use App\Models\Administracion\Equipo;
use App\Models\Administracion\VEquipo_componente;
use App\Models\Administracion\VFirmante;
use App\Models\Registro\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;



class RegistroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            return response()->json(view('registro.listado')->render());
        }
        $personal = Personal::pluck('ci','nombre','apellido', 'id_personal');
        $operadoras =Operadoras::pluck('descripcion', 'id_operadora');
        $plan = Plan::pluck('descripcion','id_plan');
        $equipo = Equipo::pluck('descripcion','id_sede_equipo');
		$vequipo_componente = VEquipo_componente::pluck('tipo','serial','accesorios','id_equipo_componente');
        $vfirmante = VFirmante::pluck('nombre_apellido','id_firmante');

        //dd($operadoras, $personal, $plan);
        //dd($vfirmante);
        return view('registro.index', compact('personal', 'operadoras', 'plan','equipo','vequipo_componente','vfirmante'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        $rules = [

            'ci' => 'required|numeric',
            /* 'nro_tlf' => 'required|numeric|max:12|unique:registro',
            'cuenta_uso' => 'required|numeric', */
          
        ];

        $messages = [

            'ci.required' => 'La cédula es obligatoria.',
            'ci.numeric' => 'La cédula debe ser un valor numérico.',
            /* 'nro_tlf.required' => 'El numero de telefono es obligatorio',
            'nro_tlf.numeric' => 'El numero de telefono debe ser un valor numérico',
            'nro_tlf.unique' => 'El nro de telefono ya está registrado.',
            'nro_tlf.max' => 'El numero de tlf superó el máximo de caracteres permitidos.',
            'cuenta_uso.required' => 'La cuenta uso es obligatorio',
            'cuenta_numeric' => 'La cuenta uso debe ser un valor numérico', */

        ];

       $validator = Validator::make($request->all(), $rules, $messages)->validate();
       


       try {

            $registro = new Registro();
            $registro->id_personal = $request->get('id_personal');
            $registro->nro_tlf = ($request->get('nro_tlf'));
            $registro->cuenta_uso = ($request->get('cuenta_uso'));
            $registro->observacion = $request->get('observacion');
            $registro->id_plan = $request->get('id_plan');
	        $registro->id_operadora = $request->get('operadoras');
			$registro->id_equipo_componente = $request->get('id_equipo_componente');
            $registro->id_firmante = $request->get('id_firmante');
            $registro->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en registro.store: " . $th. today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
 

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $registro = Registro::find($id);
        return response()->json(view('registro.show', compact('registro'))->render());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $registro = Registro::find($id);
        $plan = Plan::pluck('descripcion','id_plan');
        $estatus = Estatus::pluck('descripcion', 'id_estatus');
        $operadoras = Operadoras::pluck('descripcion', 'id_operadora');
		$equipo = Equipo::pluck('descripcion', 'id_sede_equipo');
        $vfirmante = VFirmante::pluck('nombre_apellido', 'id_firmante');
        $personal = Personal::where('id_personal',$registro->id_personal)->get();//pluck('ci','nombre','apellido', 'id_personal'); 
        $vequipo_componente = VEquipo_componente::where('id_equipo_componente',$registro->id_equipo_componente)->get();//pluck('tipo','serial','accesorios', 'id_equipo_componente'); 
        
        return response()->json(view('registro.edit', compact('plan', 'estatus','operadoras','personal','registro','equipo','vequipo_componente','vfirmante' ))->render());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $rules = [

            'ci' => 'required',
            'cuenta_uso' => 'required|numeric',
          
        ];

        $messages = [

            'ci.required' => 'La cédula es obligatoria.',
            'cuenta_numeric' => 'La cuenta uso debe ser un valor numérico',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();
     
        try {

            $registro = Registro::find($id);

            $registro->id_personal = $request->get('id_personal');
            $registro->nro_tlf = Str::upper($request->get('nro_tlf'));
            $registro->cuenta_uso = Str::upper($request->get('cuenta_uso'));
            $registro->observacion = $request->get('observacion');
            $registro->id_operadora = $request->get('operadoras');
            $registro->id_plan = $request->get('plan');
			$registro->id_sede_equipo = $request->get('equipo');
            $registro->id_equipo_componente = $request->get('id_equipo_componente');
            $registro->id_firmante = $request->get('id_firmante');
            $registro->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en registro.edit: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $registro = Registro::find($id);

            if ($registro->id_estatus == 1) {
                $registro->id_estatus = 2;
            } else {
                $registro->id_estatus = 1;
            }

            $registro->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en registro.destroy: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function getPerson(Request $request){ 
        //dd($request->all());
        $personal = Personal::where('ci', $request->ci)->first();

        return response()->json($personal);
        
    }

    public function getSerial(Request $request){ 
        //dd($request->all());
        $vequipo_componente = VEquipo_componente::where('serial', $request->serial)->first();

        return response()->json($vequipo_componente);
        
    }


    public function imprimir($id){

        $registro = Registro::select('registro.id_registro',
                                   'registro.id_estatus as estatus_registro',
                                   'personal.id_personal',
                                   'registro.created_at as fecha',
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
                                   'view_equipo_componente.tipo as tipo',
                                   'view_equipo_componente.serial as serial',
                                   'view_equipo_componente.accesorios as accesorios',
                                   'view_equipo_componente.id_equipo_componente as id_equipo_componete',
                                   'view_firmante.nombre_apellido',
                                   'view_firmante.ci as cedula_firmante',
                                   'view_firmante.descripcion as descripcion_firmante',
                                   'view_firmante.resolucion as resolucion',
                                   'view_firmante.fecha_resolucion as fecha_resolucion'
                                )
        ->leftjoin('personal', 'personal.id_personal','registro.id_personal' )
        ->leftjoin('plan', 'plan.id_plan', 'registro.id_plan')
        ->leftjoin('operadoras', 'operadoras.id_operadora', 'registro.id_operadora')
        ->leftjoin('estatus', 'estatus.id_estatus', 'registro.id_estatus')
        ->leftjoin('estados', 'estados.id_estado', 'personal.id_estado')
        ->leftjoin('gerencia', 'gerencia.id_gergral', 'personal.id_gergral')
        ->leftjoin('cargo', 'cargo.id_cargo', 'personal.id_cargo')
        ->leftjoin('view_equipo_componente', 'view_equipo_componente.id_equipo_componente', 'registro.id_equipo_componente')
        ->leftjoin('view_firmante', 'view_firmante.id_firmante', 'registro.id_firmante')                        
        ->findOrFail($id);
        //dd($registro);

        return view('registro.preview-print', compact('registro'));
    }

  
}

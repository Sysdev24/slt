<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Personal;
use App\Models\Administracion\Estatus;
use App\Models\Administracion\Firmante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;



class FirmanteController extends Controller
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
            return response()->json(view('administracion.firmante.listado')->render());
        }
        $personal = Personal::pluck('ci','nombre','apellido', 'id_personal');
        $estatus =Estatus::pluck('descripcion', 'id_estatus');
        //dd($operadoras, $personal, $plan);
        return view('administracion.firmante.index', compact('personal', 'estatus'));
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

            $firmante = new Firmante();
            $firmante->id_personal = $request->get('id_personal');
            $firmante->resolucion = ($request->get('resolucion'));
            $firmante->fecha_resolucion = ($request->get('fecha_resolucion'));
            $firmante->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en firmante.store: " . $th. today());
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
        $firmante = Firmante::find($id);
        return response()->json(view('administracion.firmante.show', compact('firmante'))->render());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $firmante = Firmante::find($id);
        $estatus = Estatus::pluck('descripcion', 'id_estatus');
        $personal = Personal::where('id_personal',$firmante->id_personal)->get();//pluck('ci','nombre','apellido', 'id_personal'); 
        
        return response()->json(view('administracion.firmante.edit', compact('estatus','personal','firmante'))->render());
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
            
          
        ];

        $messages = [

            'ci.required' => 'La cédula es obligatoria.',
            
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();
     
        try {

            $firmante = Firmante::find($id);

            $firmante->id_personal = $request->get('id_personal');
            $firmante->resolucion = Str::upper($request->get('resolucion'));
            $firmante->fecha_resolucion = Str::upper($request->get('fecha_resolucion'));
            $firmante->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en firmante.edit: " . $th . today());
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
            $firmante = Firmante::find($id);

            if ($firmante->id_estatus == 1) {
                $firmante->id_estatus = 2;
            } else {
                $firmante->id_estatus = 1;
            }

            $firmante->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en firmante.destroy: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function getPerson(Request $request){ 
        //dd($request->all());
        $personal = Personal::where('ci', $request->ci)->first();

        return response()->json($personal);
        
    }


}

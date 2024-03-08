<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Equipo;
use App\Models\Administracion\Equipo_componente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Equipo_componenteController extends Controller
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

        $equipo = Equipo::where('id_estatus', 1)->orderBy('descripcion')->get();
        $equipo = $equipo->pluck('descripcion','id_sede_equipo');
        $equipo = json_decode(json_encode($equipo), true);
        $equipo = [" " => ""] + $equipo;

        return view('administracion.equipo_componente.index', compact('equipo'));
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
             'id_sede_equipo' => 'required',
             'serial' => 'required|unique:equipo_componente,serial,NULL,id_equipo_componente,id_sede_equipo,' . $request->input('id_sede_equipo') . '|max:50',
        ];

        $messages = [
             'id_sede_equipo.required' => 'El el equipo es obligatorio.',
             'serial.required' => 'El serial es obligatorio.',
             'serial.max' => 'El nombre superó el máximo de caracteres permitidos.',
             'serial.unique' => 'Ya existe un serial con el mismo numero para el equipo seleccionado.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {

            $equipo_componente = new Equipo_componente();

            $equipo_componente->id_sede_equipo = Str::upper($request->get('id_sede_equipo'));
            $equipo_componente->tipo = Str::upper($request->get('tipo'));
            $equipo_componente->serial = Str::upper($request->get('serial'));
            $equipo_componente->accesorios = Str::upper($request->get('accesorios'));
            $equipo_componente->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en componente.store: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipo_componente = Equipo_componente::find($id);
        return response()->json(view('administracion.equipo_componente.show', compact('equipo_componente'))->render());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipo_componente = Equipo_componente::find($id);
        $equipo = Equipo::where('id_estatus', 1)->orderBy('descripcion')->get();
        $equipo = $equipo->pluck('descripcion', 'id_sede_equipo');
        $equipo = json_decode(json_encode($equipo), true);
        $equipo = [" " => ""] + $equipo;
        return response()->json(view('administracion.equipo_componente.edit', compact('equipo_componente','equipo'))->render());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $rules = [
            'equipo' => 'required',
            'serial' => 'required|unique:equipo_componente,serial,' . $id . ',id_equipo_componente,id_sede_equipo,' . $request->input('equipo') . '|max:50',

        ];

        $messages = [
            'equipo.required' => 'El equipo es obligatorio.',
            'serial.required' => 'El serial es obligatorio.',
            'serial.max' => 'El nombre superó el máximo de caracteres permitidos.',
            'serial.unique' => 'Ya existe un serial con el mismo nombre para el equipo seleccionado.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();
        try {

            $equipo_componente = Equipo_componente::find($id);
            $equipo_componente->tipo = Str::upper($request->get('tipo'));
            $equipo_componente->serial = Str::upper($request->get('serial'));
            $equipo_componente->accesorios = Str::upper($request->get('accesorios'));
            $equipo_componente->id_sede_equipo = Str::upper($request->get('equipo'));
            $equipo_componente->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en equipo_componente.edit: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $equipo_componente = Equipo_componente::find($id);

            if ($equipo_componente->id_estatus == 1) {
                $equipo_componente->id_estatus = 2;
            } else {
                $equipo_componente->id_estatus = 1;
            }

            $equipo_componente->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en equipo_componente.destroy: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
}

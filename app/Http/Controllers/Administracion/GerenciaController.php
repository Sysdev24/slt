<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Gerencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GerenciaController extends Controller
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
			return response()->json(view('administracion.gerencia.listado')->render());
        }

        return view('administracion.gerencia.index');
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
            'descripcion' => 'required|unique:gerencia|max:25|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',
        ];

        $messages = [
            'descripcion.required' => 'El nombre de la gerencia es obligatorio.',
            'descripcion.unique' => 'La gerencia ya está registrada.',
            'descripcion.max' => 'El nombre superó el máximo de caracteres permitidos.',
			'descripcion.alpha' => 'La gerencia debe contener solo letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {

            $gergral = new Gerencia();
            $gergral->descripcion = Str::upper($request->get('descripcion'));
            $gergral->save();
            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en gerncia.store: " . $th);
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
        $gergral = Gerencia::find($id);
        return response()->json(view('administracion.gerencia.show', compact('gergral'))->render());
    }
	
	
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $gergral = Gerencia::find($id);
        return response()->json(view('administracion.gerencia.edit', compact('gergral'))->render());
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
            'descripcion' => 'required|unique:gerencia,descripcion,' . $id . ',id_gergral|max:25|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',
        ];

        $messages = [
            'descripcion.required' => 'El nombre de la gerencia es obligatorio.',
            'descripcion.unique' => 'La gerencia ya está registrado.',
            'descripcion.max' => 'El nombre superó el máximo de caracteres permitidos.',
			'descripcion.alpha' => 'La gerencia debe contener solo letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {
            $gergral = Gerencia::find($id);
            $gergral->descripcion = Str::upper($request->get('descripcion'));
            $gergral->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en gerencia.store: " . $th . today());
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
            $gergral = Gerencia::find($id);

            if ($gergral->id_estatus = 1) {
                $gergral->id_estatus = 2;
            } else {
                $gergral->id_estatus = 1;
            }

            $gergral->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en gerencia.destroy: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
}

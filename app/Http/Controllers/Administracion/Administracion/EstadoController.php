<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EstadoController extends Controller
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
            return response()->json(view('administracion.estados.listado')->render());
        }

        return view('administracion.estados.index');
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
            'descripcion' => 'required|unique:estados|max:25',
        ];

        $messages = [
            'descripcion.required' => 'El nombre del estado es obligatorio.',
            'descripcion.unique' => 'El estado ya está registrado.',
            'descripcion.max' => 'El nombre superó el máximo de caracteres permitidos.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {

            $estado = new Estado();
            $estado->descripcion = Str::upper($request->get('descripcion'));
            $estado->save();
            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en estados.store: " . $th);
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
        $estado = Estado::find($id);
        return response()->json(view('administracion.estados.show', compact('estado'))->render());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $estado = Estado::find($id);
        return response()->json(view('administracion.estados.edit', compact('estado'))->render());
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
            'descripcion' => 'required|unique:estados,descripcion,' . $id . ',id_estado|max:25',
        ];

        $messages = [
            'descripcion.required' => 'El nombre del estado es obligatorio.',
            'descripcion.unique' => 'El estado ya está registrado.',
            'descripcion.max' => 'El nombre superó el máximo de caracteres permitidos.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {
            $estado = Estado::find($id);
            $estado->descripcion = Str::upper($request->get('descripcion'));
            $estado->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en estados.edit: " . $th . today());
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
            $estado = Estado::find($id);

            if ($estado->id_estatus == 1) {
                $estado->id_estatus = 2;
            } else {
                $estado->id_estatus = 1;
            }

            $estado->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en estados.destroy: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EquipoController extends Controller
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
            return response()->json(view('administracion.equipo.listado')->render());
        }

        return view('administracion.equipo.index');
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
            'descripcion' => 'required|unique:equipo|max:25|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',
        ];

        $messages = [
            'descripcion.required' => 'El equipo es obligatorio.',
            'descripcion.max' => 'El equipo el máximo de caracteres permitidos.',
            'descripcion.unique' => 'El equipo ya esta registrado.',
			'descripcion.alpha' => 'El equipo debe contener solo letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {

            $equipo = new Equipo();
            $equipo->descripcion = Str::upper($request->get('descripcion'));
            $equipo->save();
			
             return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en equipo.store: " . $th);
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
        $equipo = Equipo::find($id);
        return response()->json(view('administracion.equipo.show', compact('equipo'))->render());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipo = Equipo::find($id);
        return response()->json(view('administracion.equipo.edit', compact('equipo'))->render());
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
            'descripcion' => 'required|unique:equipo,descripcion,' . $id . ',id_sede_equipo|max:100|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',

        ];

        $messages = [
            'descripcion.required' => 'El equipo es obligatorio.',
            'descripcion.max' => 'El tipo de equipo el máximo de caracteres permitidos.',
            'descripcion.unique' => 'El equipo ya esta registrado.',
			'descripcion.alpha' => 'El equipo debe contener solo letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {
            $equipo = Equipo::find($id);
            $equipo->descripcion = Str::upper($request->get('descripcion'));
            $equipo->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en equipo.edit: " . $th . today());
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
            $equipo = equipo::find($id);

            if ($equipo->id_estatus == 1) {
                $equipo->id_estatus = 2;
            } else {
                $equipo->id_estatus = 1;
            }

            $equipo->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en equipo.destroy: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
}

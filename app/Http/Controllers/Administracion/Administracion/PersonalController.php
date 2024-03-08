<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PersonalController extends Controller
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
            return response()->json(view('administracion.personal.listado')->render());
        }

        return view('administracion.personal.index');
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
            'descripcion' => 'required|unique:personal|max:25',
        ];

        $messages = [
            'descripcion.required' => 'El personal es obligatorio.',
            'descripcion.max' => 'El personal el máximo de caracteres permitidos.',
            'descripcion.unique' => 'El personal ya esta registrado.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {

            $personal = new Personal();
            $personal->descripcion = Str::upper($request->get('descripcion'));
            $personal->save();
            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en personal.store: " . $th);
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
        $personal = Personal::find($id);
        return response()->json(view('administracion.personal.show', compact('personal'))->render());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $personal = Personal::find($id);
        return response()->json(view('administracion.personal.edit', compact('personal'))->render());
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
            'personal' => 'required|unique:personal,descripcion,' . $id . ',id_personal|max:100',

        ];

        $messages = [
            'personal.required' => 'El personal es obligatorio.',
            'personal.max' => 'El tipo de personal el máximo de caracteres permitidos.',
            'personal.unique' => 'El personal ya esta registrado.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {
            $personal = Personal::find($id);
            $personal->descripcion = Str::upper($request->get('personal'));
            $personal->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en personal.edit: " . $th . today());
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
            $personal = Personal::find($id);

            if ($personal->id_status == 1) {
                $personal->id_status = 2;
            } else {
                $personal->id_status = 1;
            }

            $personal->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en personal.destroy: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
}

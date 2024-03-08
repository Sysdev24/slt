<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Gerencia;
use App\Models\Administracion\Estados;
use App\Models\User;
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

            'ci' => 'required|numeric|unique:ci',
            'nombre' => 'required|max:20',
            'apellido' => 'required|max:20',
            'nro_empleado' => 'required|max:10',
            'id_gergral' => 'required',
            'id_estado' => 'required',
            'id_estatus' => 'required',
            'id_cargo' => 'required',
        ];

        $messages = [
            'ci.required' => 'La cédula es obligatoria.',
            'ci.numeric' => 'La cédula debe ser un valor numérico.',
            'ci.unique' => 'La cédula ya está registrada.',
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.max' => 'El nombre superó el máximo de caracteres permitidos.',
            'apellido.required' => 'El apellido es obligatorio',
            'apellido.max' => 'El apellido superó el máximo de caracteres permitidos.',
            'cargo.required' => 'El cargo es obligatorio',

        ];



        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {

            $personal = new Personal();

            $personal->ci = $request->get('ci');
            $personal->nombre = Str::upper($request->get('nombre'));
            $personal->apellido = Str::upper($request->get('apellido'));
            $personal->nro_empleado = $request->get('nro_empleado');
            $personal->id_gergral = $request->get('gerencia');
			$personal->id_estado = $request->get('estado');
            $personal->id_estatus = $request->get('estatus');
			$personal->id_cargo = $request->get('cargo');

            $personal->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error personal.store: " . $th . today());
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
        $tipoPersonal = TipoPersonal::where('id_estatus', 1)->orderBy('descripcion')->get();
        $tipoPersonal = $tipoPersonal->pluck('perfil_personal', 'id_tipo_personal');
        $tipoPersonal = json_decode(json_encode($tipoUsuario), true);
        $tipoPersonal = [" " => ""] + $tipoUsuario;

        $centrosTrabajos = CentroTrabajo::where('id_estatus', 1)->orderBy('descripcion')->get();
        //$centroTrabajo = $centroTrabajo->pluck('descripcion', 'id_gergral');
        foreach ($centrosTrabajos as $centro) {
            $arrayCentroTrabajo[$centro->id_gergral] = $centro->descripcion;
        }

        $centroTrabajo = json_decode(json_encode($arrayCentroTrabajo), true);
        $centroTrabajo = [" " => ""] + $centroTrabajo;

        $usuario = User::find($id);

        return response()->json(view('administracion.usuarios.edit', compact('tipoUsuario', 'centroTrabajo', 'usuario'))->render());
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

            'ci' => 'required|numeric|unique:usuarios,ci,' . $request->get('ci') . ',ci',
            'usuario' => 'required|max:10|unique:,usuario,' . $request->get('usuario') . ',usuario',
            'nombre' => 'required|max:20',
            'apellido' => 'required|max:20',
            'email' => 'required|email',
            /**'carnet' => 'numeric|max:2147483647|unique:scv_t_usuarios,no_carnet,' . $id . ',id_usuario',*/
            'tipo-usuario' => 'required',
            'centro-trabajo' => 'required',

        ];

        $messages = [
            'ci.required' => 'La cédula es obligatoria.',
            'ci.numeric' => 'La cédula debe ser un valor numérico.',
            'ci.unique' => 'La cédula ya está registrada.',
            'usuario.required' => 'El usuario es obligatorio',
            'usuario.max' => 'El usuario superó el máximo de caracteres permitidos.',
            'usuario.unique' => 'El usuario ya está registrado.',
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.max' => 'El nombre superó el máximo de caracteres permitidos.',
            'apellido.required' => 'El apellido es obligatorio',
            'apellido.max' => 'El apellido superó el máximo de caracteres permitidos.',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'El correo electrónico no tiene un formato válido.',
            'email.email' => 'El correo electrónico no tiene un formato válido.',
            'tipo-usuario.required' => 'El tipo de usuario es obligatorio.',
            'centro-trabajo.required' => 'La Gerencia es obligatoria.',
            /**'carnet.unique' => 'Ya existe un usuario con este número de carnet.',
            'carnet.numeric' => 'El carnet debe ser un valor numérico.',
            'carnet.max' => 'El carnet excedió el valor máximo permitido.'*/
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();
        try {

            $usuario = User::find($id);

            $usuario->ci = $request->get('ci');
            $usuario->usuario = Str::upper($request->get('usuario'));
            $usuario->nombre = Str::upper($request->get('nombre'));
            $usuario->apellido = Str::upper($request->get('apellido'));
            $usuario->email = $request->get('email');
            /**$usuario->no_carnet = $request->get('carnet');*/
            $usuario->id_tipo_usuario = $request->get('tipo-usuario');
            $usuario->id_gergral = $request->get('centro-trabajo');

            $usuario->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en usuarios.update: " . $th . today());
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
            $usuario = User::find($id);

            if ($usuario->id_estatus = 1) {
                $usuario->id_estatus = 2;
            } else {
                $usuario->id_estatus = 1;
            }

            $usuario->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en usuarios.destroy: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
}

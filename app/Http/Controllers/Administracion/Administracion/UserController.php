<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Gerencia;
use App\Models\Administracion\TipoUsuario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
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
    public function index()
    {
        $tipoUsuario = TipoUsuario::where('id_estatus', 1)->orderBy('descripcion')->get();
        $tipoUsuario = $tipoUsuario->pluck('perfil_usuario', 'id_tipo_usuario');
        $tipoUsuario = json_decode(json_encode($tipoUsuario), true);
        $tipoUsuario = [" " => ""] + $tipoUsuario;

        $gergral = Gerencia::orderBy('descripcion')->pluck('descripcion', 'id_gergral');

        return view("administracion.usuarios.index", compact('tipoUsuario'));
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

            'ci' => 'required|numeric|unique:usuarios',
            'usuario' => 'required|max:10|unique:usuarios',
            'nombre' => 'required|max:20',
            'apellido' => 'required|max:20',
            'email' => 'required',
            'estatus' => 'required',
            /**'carnet' => 'numeric|max:2147483647|unique:usuarios,no_carnet',*/
            'tipo-usuario' => 'required',
            'gerencia' => 'required',

        ];

        $messages = [
            'ci.required' => 'La cédula es obligatoria.',
            'ci.numeric' => 'La cédula debe ser un valor numérico.',
            'ci.unique' => 'La cédula ya está registrada.',
            'usuario.required' => 'El usuario es obligatorio',
            'usuario.max' => 'El usuario superó el máximo de caracteres permitidos.',
            'usuario.unique' => 'El usuario ya esta registrado.',
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.max' => 'El nombre superó el máximo de caracteres permitidos.',
            'apellido.required' => 'El apellido es obligatorio',
            'apellido.max' => 'El apellido superó el máximo de caracteres permitidos.',
            'email.required' => 'El correo electrónico es obligatorio',
            'estatus.required' => 'El estatus es obligatorio',
            'tipo-usuario.required' => 'El tipo de usuario es obligatorio.',
            'gerencia.required' => 'La Gerencia es obligatoria.',
        ];


        if ($request->get('email') != "-") {
            $rules['email'] = 'required|email';
            $messages['email.email'] = 'El correo electrónico no tiene un formato válido.';
        }

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {

            $usuario = new User();

            $usuario->ci = $request->get('ci');
            $usuario->usuario = Str::upper($request->get('usuario'));
            $usuario->nombre = Str::upper($request->get('nombre'));
            $usuario->apellido = Str::upper($request->get('apellido'));
            $usuario->email = $request->get('email');
            $usuario->id_estatus = $request->get('estatus');
            $usuario->id_tipo_usuario = $request->get('tipo-usuario');
            $usuario->id_gergral = $request->get('gerencia');

            $usuario->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en usuarios.store: " . $th . today());
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
        $usuario = User::find($id);
        return response()->json(view('administracion.usuarios.show', compact('usuario'))->render());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoUsuario = TipoUsuario::where('id_estatus', 1)->orderBy('descripcion')->get();
        $tipoUsuario = $tipoUsuario->pluck('perfil_usuario', 'id_tipo_usuario');
        $tipoUsuario = json_decode(json_encode($tipoUsuario), true);
        $tipoUsuario = [" " => ""] + $tipoUsuario;

        $gergral = Gerencia::where('id_estatus', 1)->orderBy('descripcion')->get();
        foreach ($gergral as $gergral) {
            $arraygergral[$gergral->id_gergral] = $gergral->descripcion;
        }

        $gergral = json_decode(json_encode($arraygergral), true);
        $gergral = [" " => ""] + $gergral;

        $usuario = User::find($id);

        return response()->json(view('administracion.usuarios.edit', compact('tipoUsuario', 'gerencia', 'usuario'))->render());
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
            'estatus' => 'required',
            'tipo-usuario' => 'required',
            'gerencia' => 'required',

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
            'estatus.required' => 'El estatus es obligatorio.',
            'tipo-usuario.required' => 'El tipo de usuario es obligatorio.',
            'gerencia.required' => 'La Gerencia es obligatoria.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();
        try {

            $usuario = User::find($id);

            $usuario->ci = $request->get('ci');
            $usuario->usuario = Str::upper($request->get('usuario'));
            $usuario->nombre = Str::upper($request->get('nombre'));
            $usuario->apellido = Str::upper($request->get('apellido'));
            $usuario->email = $request->get('email');
            $usuario->estatus = $request->get('estatus');
            $usuario->id_tipo_usuario = $request->get('tipo-usuario');
            $usuario->id_gergral = $request->get('gerencia');

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

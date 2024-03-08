<div class="text-center mx-5">

    @if (!is_array($fotoVisitante))
        <div class="row m-4">
            <div class="col-12 text-center">
                <img src="{{ !is_null($fotoVisitante) ? 'data:image/png;base64,' . $fotoVisitante : '' }}"
                    alt="foto-visitante" onError="this.src='{{ asset('img/default.png') }}'" width="250px">
            </div>
        </div>
    @else
        <div class="row m-4">
            <div class="col-12 text-center">
                <img src="{{ 'data:image/png;base64,' . $fotoVisitante[0]['photo'] }}" alt="foto-visitante"
                    onError="this.src='{{ asset('img/default.png') }}'" width="250px">
            </div>
        </div>
    @endif


    <div class="row justify-content-center border-bottom">
        <div class="col-4 bg-dark text-white">
            CI
        </div>
        <div class="col-4 bg-dark text-white">
            NOMBRES
        </div>
        <div class="col-4 bg-dark text-white">
            APELLIDOS
        </div>
    </div>
    <div class="row justify-content-center border-bottom">
        <div class="col-4">
            {{ $visitante->ci_pasaporte }}
        </div>
        <div class="col-4">
            {{ $visitante->nombres }}
        </div>
        <div class="col-4">
            {{ $visitante->apellidos }}
        </div>
    </div>


    <div class="row justify-content-center border-bottom">
        <div class="col-4 bg-dark text-white">
            TELÉFONO
        </div>
        <div class="col-4 bg-dark text-white">
            PROCEDENCIA
        </div>
        <div class="col-4 bg-dark text-white">
            CARNET ASIGNADO
        </div>
    </div>
    <div class="row justify-content-center border-bottom">
        <div class="col-4">
            {{ $visitante->telefono }}
        </div>
        <div class="col-4">
            {{ $visitante->procedencia }}
        </div>
        <div class="col-4">
            {{ $visitante->carnet->carnet }}
        </div>
    </div>


    <div class="row justify-content-center border-bottom">
        <div class="col-4 bg-dark text-white">
            VISITADO
        </div>
        <div class="col-4 bg-dark text-white">
            MOTIVO
        </div>
        <div class="col-4 bg-dark text-white">
            DESTINO
        </div>
    </div>
    <div class="row justify-content-center border-bottom">
        <div class="col-4">
            {{ $visitante->nombres_apellidos_visitado }}
        </div>
        <div class="col-4">
            {{ $visitante->motivoVisita->descripcion }}
        </div>
        <div class="col-4">
            {{ $visitante->destino->destino }}
        </div>
    </div>


    <div class="row justify-content-center border-bottom">
        <div class="col-4 bg-dark text-white">
            TIPO DE VISITANTE
        </div>
        <div class="col-4 bg-dark text-white">
            FECHA/HORA DE ENTRADA
        </div>
        <div class="col-4 bg-dark text-white">
            AUTORIZADO POR
        </div>
    </div>
    <div class="row justify-content-center border-bottom">
        <div class="col-4">
            {{ $visitante->tipoVisitante->descripcion }}
        </div>
        <div class="col-4">
            {{ date('d/m/Y h:i a', strtotime($visitante->fecha_hora_entrada)) }}
        </div>
        <div class="col-4">
            {{ $visitante->nombres_apellidos_autoriza }}
        </div>
    </div>

    <div class="row justify-content-center border-bottom">
        <div class="col-4 bg-dark text-white">
            OPERADOR
        </div>
        <div class="col-8 bg-dark text-white">
            CENTRO DE TRABAJO
        </div>
    </div>
    <div class="row justify-content-center border-bottom">
        <div class="col-4">

            {{ $visitante->usuarioEntrada->nombres . ' ' . $visitante->usuarioEntrada->apellidos }}

        </div>
        <div class="col-8">
            {{ $visitante->centroTrabajo->nombre }}
        </div>
    </div>

    <div class="row justify-content-center border-bottom">
        <div class="col-12 bg-dark text-white">
            OBSERVACIÓN VISITA
        </div>
    </div>
    <div class="row justify-content-center border-bottom">
        <div class="col-12">
            {{ $visitante->observacion }}
        </div>
    </div>



    @if (count($visitante->equipo) > 0)
        <h3 class="mt-5">EQUIPOS INGRESADOS</h3>
        <table class="table table-hover" style="width:100%">

            <thead>
                <th>DESCRIPCIÓN</th>
                <th>SERIAL</th>
                <th>OBSERVACIÓN</th>
            </thead>

            @foreach ($visitante->equipo as $e)
                <tr>
                    <td>
                        {{ $e->descripcion_equipo }}
                    </td>
                    <td>
                        {{ $e->serial }}
                    </td>
                    <td>
                        {{ $e->observacion }}
                    </td>
                </tr>
            @endforeach

        </table>
    @endif
</div>


<div>

    {!! Form::open([
        'url' => '/visitantes/update',
        'method' => 'put',
        'id' => 'editar_vistante',
        'class' => 'm-4',
        'data-locked' => 'false',
        'data-crud' => 'edit',
    ]) !!}


    <div class="row">
        <div class="col-9  border-right">
            <h4>Datos del visitante</h4>
            {!! Form::hidden('id', $visitante->id_visitante, []) !!}
            <div class="row mb-4">
                <div class="col-4">

                    {!! Form::label('ci_pasaporte', 'CI / PASAPORTE:', ['class' => 'form-label font-weight-bold']) !!}
                    <small class="text-danger font-italic">Obligatorio</small>

                    <div class="d-flex justify-content-between">
                        <div class="pl-0 col-3">
                            {!! Form::text(
                                'tipo_dcumento',
                                $count === 1 || $count === 0 ? explode('-', $visitante->ci_pasaporte)[0] : null,
                                [
                                    'class' => 'form-control',
                                    'readonly' => 'readonly',
                                ],
                            ) !!}
                        </div>

                        <div>
                            {!! Form::text('ci_pasaporte', $count === 1 || $count === 0 ? explode('-', $visitante->ci_pasaporte)[1] : null, [
                                'class' => 'form-control',
                                'readonly' => 'readonly',
                            ]) !!}
                        </div>
                    </div>

                </div>

                <div class="col-4">
                    {!! Form::label('nombres', 'NOMBRES:', ['class' => 'form-label font-weight-bold']) !!}
                    <small class="text-danger font-italic">Obligatorio</small>
                    {!! Form::text('nombres', $visitante && $count === 1 ? Str::upper($visitante->nombres) : null, [
                        'class' => 'form-control',
                    ]) !!}
                </div>

                <div class="col-4">

                    {!! Form::label('apellidos', 'APELLIDOS:', ['class' => 'form-label font-weight-bold']) !!}
                    <small class="text-danger font-italic">Obligatorio</small>
                    {!! Form::text('apellidos', $visitante && $count === 1 ? Str::upper($visitante->apellidos) : null, [
                        'class' => 'form-control',
                    ]) !!}

                </div>

            </div>

            <div class="row mb-4">
                <div class="col-4">
                    {!! Form::label('telefono', 'TELÉFONO:', ['class' => 'form-label font-weight-bold']) !!}
                    <small class="text-danger font-italic">Obligatorio</small>

                    <div class="d-flex justify-content-between">

                        <div class="pr-1 col-4 p-0">
                            {!! Form::select(
                                'cod_telefono',
                                $codArea,
                                $count === 1 && $dataSource === 'DB' ? explode('-', $visitante->telefono)[0] : '0212',
                                ['class' => 'form-control', 'id' => 'cod_telefono'],
                            ) !!}
                        </div>

                        <div>
                            {!! Form::text('telefono', $count === 1 && $dataSource === 'DB' ? explode('-', $visitante->telefono)[1] : null, [
                                'class' => 'form-control',
                            ]) !!}
                        </div>

                    </div>
                </div>

                <div class="col-5">

                    {!! Form::label('tipo_visitante', 'TIPO DE VISITANTE:', ['class' => 'form-label font-weight-bold']) !!}
                    <small class="text-danger font-italic">Obligatorio</small>

                    {!! Form::select(
                        'tipo_visitante',
                        $tipoVisitante,
                        $count === 1 && $dataSource === 'DB' ? $visitante->id_tipo_visitante : null,
                        [
                            'class' => 'chosen-select form-control',
                            'data-placeholder' => 'Seleccione el tipo de visitante',
                        ],
                    ) !!}

                </div>

                <div class="col-3">

                    {!! Form::label('carnet', 'CARNET ASIGNADO:', ['class' => 'form-label font-weight-bold']) !!}
                    <small class="text-danger font-italic">Obligatorio</small>

                    {!! Form::select('carnet', $carnets, $visitante->no_carnet_asignado, [
                        'class' => 'chosen-select form-control',
                        'data-placeholder' => 'Seleccione el carnet',
                    ]) !!}

                </div>

            </div>

            <div class="row mb-4">
                <div class="col-12">
                    {!! Form::label('procedencia', 'PROCEDENCIA:', ['class' => 'form-label font-weight-bold']) !!}
                    {!! Form::text('procedencia', $visitante->procedencia, [
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </div>
            <h4>Persona a visitar</h4>
            <div class="row mb-4">
                <div class="col-6">
                    {!! Form::label('ci_pasaporte_visitado', 'CI / PASAPORTE DE LA PERSONA A VISITAR:', [
                        'class' => 'form-label font-weight-bold',
                    ]) !!}
                    <small class="text-danger font-italic">Obligatorio</small>

                    <div class="d-flex justify-content-start">

                        <div class="pr-1">
                            {!! Form::select(
                                'tipo_dcumento_visitado',
                                ['V' => 'V', 'E' => 'E', 'P' => 'P'],
                                explode('-', $visitante->ci_visitado)[0],
                                [
                                    'class' => 'form-control',
                                    'id' => 'tipo_dcumento_visitado',
                                ],
                            ) !!}
                        </div>

                        <div class="w-50">
                            {!! Form::text('ci_pasaporte_visitado', explode('-', $visitante->ci_visitado)[1], ['class' => 'form-control']) !!}
                        </div>

                    </div>
                </div>
                <div class="col-6">
                    {!! Form::label('visitado', 'NOMBRE Y APELLIDO DE LA PERSONA A VISITAR:', [
                        'class' => 'form-label font-weight-bold',
                    ]) !!}
                    <small class="text-danger font-italic">Obligatorio</small>
                    {!! Form::text('visitado', $visitante->nombres_apellidos_visitado, ['class' => 'form-control']) !!}
                </div>
            </div>
            <hr>
            <h4>Datos de la visita</h4>
            <div class="row mb-4">
                <div class="col-6">
                    {!! Form::label('motivo_visita', 'MOTIVO DE LA VISITA:', ['class' => 'form-label font-weight-bold']) !!}
                    <small class="text-danger font-italic">Obligatorio</small>

                    {!! Form::select('motivo_visita', $motivoVisita, $visitante->id_motivo_visita, [
                        'class' => 'chosen-select form-control',
                        'data-placeholder' => 'Seleccione el motivo de la visita',
                    ]) !!}
                </div>
                <div class="col-6">
                    {!! Form::label('destino_visitante', 'DESTINO DEL VISITANTE:', ['class' => 'form-label font-weight-bold']) !!}
                    <small class="text-danger font-italic">Obligatorio</small>

                    {!! Form::select('destino_visitante', $destinoVisitante, $visitante->id_destino, [
                        'class' => 'chosen-select form-control',
                        'data-placeholder' => 'Seleccione el destino de la visita',
                    ]) !!}
                </div>
            </div>
            <hr>
            <div class="row mb-4">
                <div class="col-12">
                    {!! Form::label('observacion', 'OBSERVACIÓN:', ['class' => 'form-label font-weight-bold']) !!}
                    {!! Form::textarea('observacion', $visitante->observacion, ['class' => 'form-control', 'rows' => '2']) !!}
                </div>
            </div>
            <hr>
            <h4>Autorización de ingreso</h4>
            <div class="row">
                <div class="col-12">
                    <div class="custom-control custom-radio custom-control-inline">
                        {!! Form::radio(
                            'autoriza_tipo',
                            'visitado',
                            $visitante->ci_autoriza === $visitante->ci_visitado ? true : false,
                            [
                                'class' => 'custom-control-input',
                                'id' => 'autoriza_tipo_visitado',
                            ],
                        ) !!}
                        {!! Form::label('autoriza_tipo_visitado', 'Visitado', [
                            'class' => 'form-label font-weight-bold custom-control-label',
                        ]) !!}
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                        {!! Form::radio('autoriza_tipo', 'otro', $visitante->ci_autoriza !== $visitante->ci_visitado ? true : false, [
                            'class' => 'custom-control-input',
                            'id' => 'autoriza_tipo_otro',
                        ]) !!}
                        {!! Form::label('autoriza_tipo_otro', 'Otro', ['class' => 'form-label font-weight-bold custom-control-label']) !!}
                    </div>

                </div>
            </div>

            <!-- FIXME: Colocar en una sola linea -->
            @if ($visitante->ci_autoriza === $visitante->ci_visitado)
                <div id="toggle_autoriza" class="row mb-4" style='display: none'">
                @else
                    <div id="toggle_autoriza" class="row mb-4">
            @endif
            <!--********************************************************************-->

            <div class="col-6">
                {!! Form::label('ci_autoriza', 'CI / PASAPORTE PERSONA QUE AUTORIZA:', [
                    'class' => 'form-label font-weight-bold',
                ]) !!}
                <small class="text-danger font-italic">Obligatorio</small>

                <div class="d-flex justify-content-start">

                    <div class="pr-1">
                        {!! Form::select(
                            'tipo_dcumento_autoriza',
                            ['V' => 'V', 'E' => 'E', 'P' => 'P'],
                            $visitante->ci_autoriza !== $visitante->ci_visitado ? explode('-', $visitante->ci_autoriza)[0] : null,
                            [
                                'class' => 'form-control',
                                'id' => 'tipo_dcumento_visitado',
                            ],
                        ) !!}
                    </div>

                    <div class="w-50">
                        {!! Form::text(
                            'ci_autoriza',
                            $visitante->ci_autoriza !== $visitante->ci_visitado ? explode('-', $visitante->ci_autoriza)[1] : null,
                            ['class' => 'form-control'],
                        ) !!}
                    </div>

                </div>
            </div>
            <div class="col-6">
                {!! Form::label('autoriza', 'NOMBRE Y APELLIDO DE LA PERSONA QUE AUTORIZA:', [
                    'class' => 'form-label font-weight-bold',
                ]) !!}
                <small class="text-danger font-italic">Obligatorio</small>
                {!! Form::text(
                    'autoriza',
                    $visitante->ci_autoriza !== $visitante->ci_visitado ? $visitante->nombres_apellidos_autoriza : null,
                    ['class' => 'form-control'],
                ) !!}
            </div>
        </div>
    </div>
    <div id="wrap-camera" class="col-3 text-center p-1">
        {!! Form::hidden('imagen', !is_null($pathImg) ? $pathImg : null, []) !!}
        {!! Form::hidden('img-base64', null, []) !!}

        <div id="wrap-image">

            <img src="{{ !is_array($photo) ? 'data:image/png;base64,' . $photo : '' }}"
                onError="this.src='{{ asset('img/default.png') }}'" alt="foto visitante" width="250px"
                class="px-3 py-1">

        </div>

        <div class="text-center">

            <a id="activarCamara" style="cursor:pointer" title="Activar cámara" class="bg-success border rounded m-1">
                <span class="icofont-play-alt-2"></span>
            </a>


            <a id="capturarCamara" style="cursor:pointer" title="Tomar foto"
                class="bg-info border rounded btn-disabled m-1">
                <span class="icofont-camera-alt"></span>
            </a>

        </div>

        <div id="msgCamera" class="mt-2">

        </div>

        <div id="btnWinEditEquipos" class="m-2">
            <a class=" btn btn-primary btn-disabled">
                <small
                    class="{{ !boolval(count($equiposVisitante)) ? 'icofont-ui-add' : 'icofont-ui-edit' }}"></small>&nbsp;{{ !boolval(count($equiposVisitante)) ? 'AGREGAR EQUIPOS' : 'EDITAR EQUIPOS' }}
            </a>
        </div>
        <div id="notificacion">
        </div>
    </div>
</div>

<div class="row mb-4 justify-content-center">
    {!! Form::submit('MODIFICAR', ['class' => 'btn btn-primary m-2']) !!}
</div>

<div id="foot-notificacion">

</div>
{!! Form::close() !!}
</div>

<script>
    /**
     * *---------------------------------------------------------------------------
     * *RUTINAS A EJECUTAR DESPUÉS DE QUE SE CARGA LA PÁGINA
     * *---------------------------------------------------------------------------
     */

    $(document).ready(function() {

        const _equiposVisitante = {!! $equiposVisitante !!};

        if (_equiposVisitante.length) {
            _equiposVisitante.forEach(element => {
                const {
                    id_equipo,
                    descripcion_equipo,
                    serial,
                    observacion,
                } = element;

                equiposVisitante.push({
                    id_equipo,
                    descripcion_equipo,
                    serial,
                    observacion,
                });

                equiposVisitanteOriginal.push({
                    id_equipo,
                    descripcion_equipo,
                    serial,
                    observacion,
                });

            });
        }

        $('#notificacion').append(`
            <div class="alert alert-info m-2" role="alert">
                <p class="display-4 m-0">
                    <small class="icofont-info-circle"></small>
                </p>
                <p class="display-5">
                    El vistante ingresó con ${equiposVisitante.length} equipo${equiposVisitante.length>1?'s.':'.'}
                </p>
            </div>
        `)

        $('#btnWinEditEquipos a').removeClass('btn-disabled');


    });

    /**
     * *--------------------------------------------------------------------------------------------------------
     * *PERMITE SELECCIONAR EL LA FOTO DE LA PERSONA A INGRESAR SI SE ENCUENTRA MÁS DE UN USUARIO LDAP
     * !APLICA SOLO EN EL CASO DE TRABAJDORES VISITANTES!
     * *--------------------------------------------------------------------------------------------------------
     */

    $(document).on('click', '#wrap-image .thumbail img', function() {

        $('#wrap-image > img').attr('src', $(this).attr('src'));

    });


    /**
     * *--------------------------------------------------------------------------------------------------------
     * *PERMITE SELECCIONAR EL LA FOTO DE LA PERSONA A INGRESAR SI SE ENCUENTRA MÁS DE UN USUARIO LDAP
     * !APLICA SOLO EN EL CASO DE TRABAJDORES VISITANTES!
     * *--------------------------------------------------------------------------------------------------------
     */

    $(document).on('click', '.table-visitante tr', function() {

        const datosVisitante = [];

        $(this).children('td').each(function(i) {
            datosVisitante.push($(this).text());
        });


        $(this).siblings().removeClass('bg-info text-white');
        $(this).addClass('bg-info text-white');

        $('input[name=tipo_dcumento]').val(datosVisitante[0].split('-')[0]);
        $('input[name=ci_pasaporte]').val(datosVisitante[0].split('-')[1]);
        $('input[name=nombres]').val(datosVisitante[1]);
        $('input[name=apellidos]').val(datosVisitante[2]);


        if (datosVisitante[3] != '') {

            $('#wrap-image img').attr('src', `data:image/png;base64,${datosVisitante[3]}`);

        } else {
            $('#wrap-image img').attr('src', '');
        }

        $('input[name=telefono]').trigger('focus');

    });


    /**
     * *-----------------------------------------------
     * * EDITAR EL VISITANTE
     * *-----------------------------------------------
     */

    $(document).on("submit", "#editar_vistante", function(e) {
        e.preventDefault();

        if (!$(this).data("locked")) {

            const ruta = $(this).attr("action");
            const id = $('input[name=id').val();
            const data = new Object();
            const campos = $(this).serializeArray();



            $(".invalid-feedback", this).remove();

            $(this).data("locked", true);
            $('input[type="submit"]', this).blur();
            $('input[type="submit"]', this).attr("disabled", "disabled");
            $("#foot-notificacion")
                .append(
                    `<div class="wait-notification"> <img src="./img/loading.gif" alt="Procesando formulario."
                    style="width: 100px;display: block;">
                  </div>`
                )
                .fadeIn(300);



            campos.forEach(function(val, key) {
                if (val.name === "_token") {
                    data[val.name] = val.value;
                } else {
                    data[val.name] = val.value;
                }

                $("#" + val.name).removeClass("is-invalid");
            });

            data._delEquipos = false;
            data._equipos = false;


            if (equiposVisitante.length !== 0) {

                data.equipos = equiposVisitante;
                data._equipos = true;

            }

            if (delEquipos.length !== 0) {

                data.delEquipos = delEquipos;
                data._delEquipos = true;

            }

            console.log(data);

            $.ajax({
                url: `${ruta}/${id}`,
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": data["_token"]
                },
                dataType: "json",
                data: data,

                beforeSend: function() {
                    $("#foot-notificacion").html(
                        '<p class="info-wait text-center w-100"><strong class="text-danger">Procesando formulario...</strong></p>'
                    );
                    $("#editar_vistante").data("locked", true);
                    $('#editar_vistante input[type="submit"]').blur();
                    $('#editar_vistante input[type="submit"]').attr(
                        "disabled",
                        "disabled"
                    );
                },

                success: function(res) {

                    $('.refresh-noticafion').append(
                        '<img src="img/loading.gif" style="width:32px"><strong>&nbsp;Actualizando...</strong>'
                    ).fadeIn(200);

                    $('#data-table').DataTable().ajax.reload();

                    setTimeout(function() {
                        $('.refresh-noticafion').children().fadeOut(200).empty();
                    }, 1000);

                    $(".modal").modal("hide");
                    equiposVisitante.length = 0;
                    equiposVisitanteOriginal.length = 0;
                    delEquipos.length = 0;
                },

                error: function(res) {
                    if (res.status == 422) {
                        for (let key in res.responseJSON.errors) {
                            if (
                                $(`#editar_vistante #${key}`).hasClass("chosen-select")) {
                                $(`#editar_vistante #${key} ~ .chosen-container`).after(
                                    `<span class="invalid-feedback position-absolute" role="alert"><strong>  ${res.responseJSON.errors[key][0]}</strong></span>`
                                );
                                $(`#editar_vistante #${key} ~ .chosen-container`).addClass(
                                    "is-invalid");
                            } else {
                                $(`#editar_vistante #${key}`).addClass("is-invalid");
                                $(`#editar_vistante #${key}`).after(
                                    `<span class="invalid-feedback position-absolute" role="alert"><strong>  ${res.responseJSON.errors[key][0]}</strong></span>`
                                );
                            }
                        }
                    } else {
                        $("form#editar_vistante").before(
                            `<div class="error-notification notification">${res.status}: Error al procesar su solicitud.</div>`
                        );
                    }
                    $("#foot-notificacion").empty();
                },
                complete: function() {
                    $("form#editar_vistante").data("locked", false);
                    $('form#editar_vistante input[type="submit"]').removeAttr(
                        "disabled"
                    );


                }
            });
        }
    });


    /**
     * *--------------------------------------------------------------------------------------------
     * *PERMITE SELECCIONAR SI LA PERSONA QUE AUTORIZA EL INGRESO O ES OTRA PERSONA O LA VISITADA.*
     * *-------------------------------------------------------------------------------------------
     */
    $(document).on('change', 'input[name="autoriza_tipo"]', function() {
        if ($(this).val() === "otro") {
            $('#toggle_autoriza').show(200);
        } else {
            $('#toggle_autoriza').hide(200);
            $('#tipo_dcumento_autoriza').val('V');
            $('#ci_autoriza').val('');
            $('#autoriza').val('');
        }
    })


    /**
     * *-----------------------------------------------------------------------------
     * *ABRE LA VENTANA PARA INGRESAR EL EQUIPO*
     * *-----------------------------------------------------------------------------
     */
    $(document).on('click', '#btnWinEditEquipos', function() {
        if (!$(this).find('a').hasClass('btn-disabled')) {
            const modal_equipos = window.open(
                `${window.location.protocol}//${location.host}/visitantes/equipos/${$("input[name=id]").val()}/edit?equiposVisitante=${encodeURIComponent(JSON.stringify(equiposVisitante))}`,
                "myWindow",
                "height=720,width=1024,menubar=no,status=no,toolbar=no,resizable=no'");
        }

    });



    /**
     * *-----------------------------------------------------------------------------
     * * FUNCION PARA CARGA LA VENTANA DE EQUIPOS
     * *-----------------------------------------------------------------------------
     */

    window.cargarEquipos = cargarEquipos = (equipos, delEquiposTemp) => {


        equiposVisitante.splice(0, equiposVisitante.length);

        equipos.forEach((val, key) => {
            equiposVisitante.push(val)
        });

        delEquiposTemp.forEach((val, key) => {
            delEquipos.push(val)
        });

        if (JSON.stringify(equiposVisitante) !== JSON.stringify(equiposVisitanteOriginal)) {

            console.log(`${JSON.stringify(equiposVisitante)} - ${JSON.stringify(equiposVisitanteOriginal)}`);

            $('#notificacion').html(`
            <div class="alert alert-warning m-2" role="alert">
                <p class="display-4 m-0">
                    <small class="icofont-warning"></small>
                </p>
                <p class="display-5">
                    La lista de equipos sufrió modificaciones. Pulse MODIFICAR para salvar los cambios.
                </p>
            </div>
        `)

        }


        if (equiposVisitante.length === 0) {
            $('#btnWinAddEquipos a').empty()
            $('#btnWinAddEquipos a').append('<small class="icofont-ui-add"></small>&nbsp;AGREGAR EQUIPOS');
        } else {
            $('#btnWinAddEquipos a').empty()
            $('#btnWinAddEquipos a').append('<small class="icofont-ui-edit"></small>&nbsp;EDITAR EQUIPOS');
        }
    }

    /**
     * Confugurar la librearía  Select2
     */
    $(".chosen-select").chosen({
        no_results_text: 'No hay resultados.',
    });
</script>

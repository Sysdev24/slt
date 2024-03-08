<div>

    {!! Form::open([
        'url' => '/visitantes',
        'method' => 'post',
        'id' => 'registrar_vistante',
        'class' => 'm-4',
        'data-locked' => 'false',
        'data-crud' => 'add',
    ]) !!}


    <div class="row">
        <div class="col-9  border-right">
            @if ($count > 1)

                <div class="alert alert-danger text-center">
                    <strong>Se encontró más de un registro con el campo "CI/Passporte" ingresado. Por favor selecciones
                        la persona a ingresar.</strong>

                    <table class="table table-visitante table-hover bg-white m-2">
                        @foreach ($datosVistante as $datos)
                            <tr>

                                <td>{{ $ciPasaporte }}</td>
                                <td>{{ $datos->nombres }}</td>
                                <td>{{ $datos->apellidos }}</td>
                                <td style="visibility:collapse; display:none">{{ $datos->photo }}</td>

                            </tr>
                        @endforeach
                    </table>
                </div>



            @endif
            <h4>Datos del visitante</h4>
            <div class="row mb-4">
                <div class="col-4">

                    {!! Form::label('ci_pasaporte', 'CI / PASAPORTE
                    :', ['class' => 'form-label font-weight-bold']) !!}
                    <small class="text-danger font-italic">Obligatorio</small>

                    <div class="d-flex justify-content-between">
                        <div class="pl-0 col-3">
                            {!! Form::text('tipo_dcumento', $count === 1 || $count === 0 ? explode('-', $ciPasaporte)[0] : null, [
                                'class' => 'form-control',
                                'readonly' => 'readonly',
                            ]) !!}
                        </div>

                        <div>
                            {!! Form::text('ci_pasaporte', $count === 1 || $count === 0 ? explode('-', $ciPasaporte)[1] : null, [
                                'class' => 'form-control',
                                'readonly' => 'readonly',
                            ]) !!}
                        </div>
                    </div>

                </div>

                <div class="col-4">
                    {!! Form::label('nombres', 'NOMBRES:', ['class' => 'form-label font-weight-bold']) !!}
                    <small class="text-danger font-italic">Obligatorio</small>
                    {!! Form::text('nombres', $datosVistante && $count === 1 ? Str::upper($datosVistante->nombres) : null, [
                        'class' => 'form-control',
                    ]) !!}
                </div>

                <div class="col-4">

                    {!! Form::label('apellidos', 'APELLIDOS:', ['class' => 'form-label font-weight-bold']) !!}
                    <small class="text-danger font-italic">Obligatorio</small>
                    {!! Form::text('apellidos', $datosVistante && $count === 1 ? Str::upper($datosVistante->apellidos) : null, [
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
                                $count === 1 && $dataSource === 'DB' ? explode('-', $datosVistante->telefono)[0] : '0212',
                                ['class' => 'form-control', 'id' => 'cod_telefono'],
                            ) !!}
                        </div>

                        <div>
                            {!! Form::text(
                                'telefono',
                                $count === 1 && $dataSource === 'DB' ? explode('-', $datosVistante->telefono)[1] : null,
                                ['class' => 'form-control'],
                            ) !!}
                        </div>

                    </div>
                </div>

                <div class="col-5">

                    {!! Form::label('tipo_visitante', 'TIPO DE VISITANTE:', ['class' => 'form-label font-weight-bold']) !!}
                    <small class="text-danger font-italic">Obligatorio</small>

                    {!! Form::select(
                        'tipo_visitante',
                        $tipoVisitante,
                        $count === 1 && $dataSource === 'DB' ? $datosVistante->id_tipo_visitante : null,
                        [
                            'class' => 'chosen-select form-control',
                            'data-placeholder' => 'Seleccione el tipo de visitante',
                        ],
                    ) !!}

                </div>

                <div class="col-3">

                    {!! Form::label('carnet', 'CARNET ASIGNADO:', ['class' => 'form-label font-weight-bold']) !!}
                    <small class="text-danger font-italic">Obligatorio</small>

                    {!! Form::select('carnet', $carnets, null, [
                        'class' => 'chosen-select form-control',
                        'data-placeholder' => 'Seleccione el carnet',
                    ]) !!}

                </div>

            </div>

            <div class="row mb-4">
                <div class="col-12">
                    {!! Form::label('procedencia', 'PROCEDENCIA:', ['class' => 'form-label font-weight-bold']) !!}
                    {!! Form::text('procedencia', $count === 1 && $dataSource === 'DB' ? $datosVistante->procedencia : null, [
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
                            {!! Form::select('tipo_dcumento_visitado', ['V' => 'V', 'E' => 'E', 'P' => 'P'], 'V', [
                                'class' => 'form-control',
                                'id' => 'tipo_dcumento_visitado',
                            ]) !!}
                        </div>

                        <div class="w-50">
                            {!! Form::text('ci_pasaporte_visitado', null, ['class' => 'form-control']) !!}
                        </div>

                    </div>
                </div>
                <div class="col-6">
                    {!! Form::label('visitado', 'NOMBRE Y APELLIDO DE LA PERSONA A VISITAR:', [
                        'class' => 'form-label font-weight-bold',
                    ]) !!}
                    <small class="text-danger font-italic">Obligatorio</small>
                    {!! Form::text('visitado', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <hr>
            <h4>Datos de la visita</h4>
            <div class="row mb-4">
                <div class="col-6">
                    {!! Form::label('motivo_visita', 'MOTIVO DE LA VISITA:', ['class' => 'form-label font-weight-bold']) !!}
                    <small class="text-danger font-italic">Obligatorio</small>

                    {!! Form::select('motivo_visita', $motivoVisita, null, [
                        'class' => 'chosen-select form-control',
                        'data-placeholder' => 'Seleccione el motivo de la visita',
                    ]) !!}
                </div>
                <div class="col-6">
                    {!! Form::label('destino_visitante', 'DESTINO DEL VISITANTE:', ['class' => 'form-label font-weight-bold']) !!}
                    <small class="text-danger font-italic">Obligatorio</small>

                    {!! Form::select('destino_visitante', $destinoVisitante, null, [
                        'class' => 'chosen-select form-control',
                        'data-placeholder' => 'Seleccione el destino de la visita',
                    ]) !!}
                </div>
            </div>
            <hr>
            <div class="row mb-4">
                <div class="col-12">
                    {!! Form::label('observacion', 'OBSERVACIÓN:', ['class' => 'form-label font-weight-bold']) !!}
                    {!! Form::textarea('observacion', null, ['class' => 'form-control', 'rows' => '2']) !!}
                </div>
            </div>
            <hr>
            <h4>Autorización de ingreso</h4>
            <div class="row">
                <div class="col-12">
                    <div class="custom-control custom-radio custom-control-inline">
                        {!! Form::radio('autoriza_tipo', 'visitado', true, [
                            'class' => 'custom-control-input',
                            'id' => 'autoriza_tipo_visitado',
                        ]) !!}
                        {!! Form::label('autoriza_tipo_visitado', 'Visitado', [
                            'class' => 'form-label font-weight-bold custom-control-label',
                        ]) !!}
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                        {!! Form::radio('autoriza_tipo', 'otro', false, [
                            'class' => 'custom-control-input',
                            'id' => 'autoriza_tipo_otro',
                        ]) !!}
                        {!! Form::label('autoriza_tipo_otro', 'Otro', ['class' => 'form-label font-weight-bold custom-control-label']) !!}
                    </div>

                </div>
            </div>
            <div id="toggle_autoriza" class="row mb-4" style="display: none">
                <div class="col-6">
                    {!! Form::label('ci_autoriza', 'CI / PASAPORTE PERSONA QUE AUTORIZA:', [
                        'class' => 'form-label font-weight-bold',
                    ]) !!}
                    <small class="text-danger font-italic">Obligatorio</small>

                    <div class="d-flex justify-content-start">

                        <div class="pr-1">
                            {!! Form::select('tipo_dcumento_autoriza', ['V' => 'V', 'E' => 'E', 'P' => 'P'], 'V', [
                                'class' => 'form-control',
                                'id' => 'tipo_dcumento_visitado',
                            ]) !!}
                        </div>

                        <div class="w-50">
                            {!! Form::text('ci_autoriza', null, ['class' => 'form-control']) !!}
                        </div>

                    </div>
                </div>
                <div class="col-6">
                    {!! Form::label('autoriza', 'NOMBRE Y APELLIDO DE LA PERSONA QUE AUTORIZA:', [
                        'class' => 'form-label font-weight-bold',
                    ]) !!}
                    <small class="text-danger font-italic">Obligatorio</small>
                    {!! Form::text('autoriza', null, ['class' => 'form-control']) !!}
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

                <a id="activarCamara" style="cursor:pointer" title="Activar cámara"
                    class="bg-success border rounded m-1">
                    <span class="icofont-play-alt-2"></span>
                </a>


                <a id="capturarCamara" style="cursor:pointer" title="Tomar foto"
                    class="bg-info border rounded btn-disabled m-1">
                    <span class="icofont-camera-alt"></span>
                </a>

            </div>

            <div id="msgCamera" class="mt-2">

            </div>

            <div id="btnWinAddEquipos" class="m-2">
                <a class=" btn btn-primary btn-block">
                    <small class="icofont-ui-add"></small>&nbsp;AGREGAR EQUIPOS
                </a>
            </div>

        </div>
    </div>

    <div class="row mb-4 justify-content-center">
        {!! Form::submit('GUARDAR', ['class' => 'btn btn-primary m-2']) !!}
    </div>

    <div id="foot-notificacion">

    </div>
    {!! Form::close() !!}
</div>

<script>
    /**
     * Permite seleccionar el la foto de la persona a ingresar si se encuentra más de un usuario LDAP
     * ¡ Aplica solo en el caso de trabajdores visitantes !
     */

    $(document).on('click', '#wrap-image .thumbail img', function() {

        $('#wrap-image > img').attr('src', $(this).attr('src'));

    });


    /**
     * Permite seleccionar el la persona a ingresar si se encuentra más de un usuario LDAP
     * ¡ Aplica solo en el caso de trabajdores visitantes !
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

        console.log(datosVisitante[3]);

        if (datosVisitante[3] != '') {

            $('#wrap-image img').attr('src', `data:image/png;base64,${datosVisitante[3]}`);

        } else {
            $('#wrap-image img').attr('src', '');
        }

        $('input[name=telefono]').trigger('focus');


    });


    /**
     * Permite registrar  el visitante
     */
    $(document).on("submit", "#registrar_vistante", function(e) {
        e.preventDefault();

        if (!$(this).data("locked")) {

            let ruta = $(this).attr("action");
            let data = new Object();
            let campos = $(this).serializeArray();

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


            if (addEquipos.length !== 0) {

                data.equipos = addEquipos;
                data._equipos = true;

            }

            console.log(data);

            $.ajax({
                url: ruta,
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
                    $("#registrar_vistante").data("locked", true);
                    $('#registrar_vistante input[type="submit"]').blur();
                    $('#registrar_vistante input[type="submit"]').attr(
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
                    addEquipos.length = 0;
                },

                error: function(res) {
                    if (res.status == 422) {
                        for (let key in res.responseJSON.errors) {
                            if (
                                $(`#registrar_vistante #${key}`).hasClass("chosen-select")) {
                                $(`#registrar_vistante #${key} ~ .chosen-container`).after(
                                    `<span class="invalid-feedback position-absolute" role="alert"><strong>  ${res.responseJSON.errors[key][0]}</strong></span>`
                                );
                                $(`#registrar_vistante #${key} ~ .chosen-container`).addClass(
                                    "is-invalid");
                            } else {
                                $(`#registrar_vistante #${key}`).addClass("is-invalid");
                                $(`#registrar_vistante #${key}`).after(
                                    `<span class="invalid-feedback position-absolute" role="alert"><strong>  ${res.responseJSON.errors[key][0]}</strong></span>`
                                );
                            }
                        }
                    } else {
                        $("form#registrar_vistante").before(
                            `<div class="error-notification notification">${res.status}: Error al procesar su solicitud.</div>`
                        );
                    }
                    $("#foot-notificacion").empty();
                },
                complete: function() {
                    $("form#registrar_vistante").data("locked", false);
                    $('form#registrar_vistante input[type="submit"]').removeAttr(
                        "disabled"
                    );


                }
            });
        }
    });


    /**
     * Permite seleccionar si la persona que autoriza el ingreso o es otra persona
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
     * Abre la ventana para ingresar el equipo
     */
    $(document).on('click', '#btnWinAddEquipos', function() {

        const modal_equipos = window.open(
            `${window.location.protocol}//${location.host}/visitantes/equipos/create?addEquipos=${encodeURIComponent(JSON.stringify(addEquipos))}`,
            "myWindow",
            "height=720,width=1024,menubar=no,status=no,toolbar=no,resizable=no'");
    });


    window.cargarEquipos = cargarEquipos = (equipos) => {

        addEquipos.splice(0, addEquipos.length);

        equipos.forEach((val, key) => {
            addEquipos.push(val)
        })

        if (addEquipos.length === 0) {
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

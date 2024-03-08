@extends('layouts.app')

@section('content')
    {{-- *VENTANA PARA AGRAGAR NUEVO REGISTRO --}}
    <div class="modal fade" id="winAgregarRegistro" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xxl">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title " id="exampleModalLongTitle">REGISTRAR LINEA TELEFONICA</h5>
                    <a type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true" class="icofont-close-squared-alt"></span>
                    </a>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    {{-- *========================================================================================================= --}}
    {{-- *VENTANA PARA EDITAR  REGISTRO --}}
    <div class="modal fade" id="winEditarVisitante" data-backdrop="static" data-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xxl">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title " id="exampleModalLongTitle">EDITAR VISITANTE</h5>
                    <a type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true" class="icofont-close-squared-alt"></span>
                    </a>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    {{-- *========================================================================================================= --}}
    {{-- *VENTANA PARA DETALLES DEL VISITANTE --}}
    <div class="modal fade" id="winDetalleVisitante" data-backdrop="static" data-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title " id="exampleModalLongTitle">DETALLES DE PERSONAL</h5>
                    <a type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true" class="icofont-close-squared-alt"></span>
                    </a>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    {{-- *========================================================================================================= --}}
    <div class="modal fade" id="winInfoDetalleRestringido" data-backdrop="static" data-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title " id="exampleModalLongTitle">VISITANTE RESTRINGIDO</h5>
                    <a type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true" class="icofont-close-squared-alt"></span>
                    </a>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    {{-- * ========================================================================================================= --}}
    {{-- * VENTANA PARA SALIDA DEL VISITANTE --}}
    <div class="modal fade" id="winSalidaVisitante" data-backdrop="static" data-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title " id="exampleModalLongTitle">REGISTRAR SALIDA DEL VISITANTE</h5>
                    <a type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true" class="icofont-close-squared-alt"></span>
                    </a>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    <div class="container">

        <div class="breadcrumbs">
            <h2 class="mb-3 ml-3 font-weight-bold"><a href="{{ route('visitantes.index') }}">
                    <span class="icofont-home"></span>
                </a> / REGISTRO DE LINEAS TELEFONICAS</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">

                    <div class="card-body">

                        <div class="d-flex mr-1 mb-2 justify-content-between">
                            <div class="refresh-noticafion" style="height: 32px;">

                            </div>
                            {{-- <div class="text-center mb-3 ">
                                <a id="openAddWin" href="#winAgregarRegistro" class="btn btn-primary btn-md d-md-flex px-4 "
                                    type="button" class="btn btn-primary zebra_tooltips" data-toggle="modal"
                                    data-target="#winAgregarRegistro" title="Agregar nuevo usuario">
                                    <span class="icofont-ui-add"></span>
                                </a>
                            </div> --}}
                        </div>

                        <form class="form-inline w-50">
                            <label for="ci_pasaporte" class="form-label font-weight-bold mr-2">CI:</label>

                            <select name="tipo_documento" id="tipo_documento" class="form-control mr-2">
                                <option value="V" selected>V</option>
                                <option value="E">E</option>
                                <option value="P">P</option>
                            </select>

                            <div>
                                <input name="ci_pasaporte" id="ci_pasaporte" type="text" class="form-control m-2">
                            </div>

                            <a id="btnBuscarVisitante" style="cursor:pointer"
                                data-href="{{--route('consultar-visitante')--}}" class="btn-primary p-2 border rounded">
                                <span class="icofont-sign-in"></span>
                            </a>

                        </form>

                        <div id="msg-restringido" class="mb-2"> </div>

                        <div id="tabla_registros" class="tabla_movimientos">
                            @include('visitantes.registrar-visitantes.listado')
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
    </div>
@endsection

@section('js-custom')
    <script>
        const addEquipos = [];
        const equiposRetirados = [];
        const equiposVisitante = []; //* Almacena los equipos del visitante.
        const equiposVisitanteOriginal = [];
        const delEquipos = [];




        /**
         * *--------------------------------
         * * CONSULTAR VISITANTE
         * *-------------------------------
         */

        $(document).on("click", "#btnBuscarVisitante", function(e) {
            e.preventDefault();

            let ciPasaporte = $("#ci_pasaporte").val();
            let tipoDocumento = $("#tipo_documento").val();

            const data = {
                ciPasaporte: ciPasaporte,
                tipoDocumento: tipoDocumento,
            };


            $(this).prop("disabled", true).addClass("btn-disabled");

            $("#msg-restringido").empty();
            $("#ci_pasaporte").removeClass("is-invalid");
            $("#ci_pasaporte~span").remove();


            if (ciPasaporte.trim() == "") {
                $("#ci_pasaporte").addClass("is-invalid");
                $("#ci_pasaporte").after(
                    '<span class="invalid-feedback position-absolute ml-2 my-0" role="alert"><strong>Ingresa la cédula o pasaporte.</strong></span>'
                );
                $(this).prop("disabled", false).removeClass("btn-disabled");
            } else {

                let expRegPasaporte = /^[a-zA-Z0-9]+$/;
                let expRegCI = /^[0-9]+$/;

                if (tipoDocumento === 'V' || tipoDocumento === 'E') {

                    if (!expRegCI.test(ciPasaporte)) {
                        $("#ci_pasaporte").addClass("is-invalid");
                        $("#ci_pasaporte").after(
                            '<span class="invalid-feedback position-absolute ml-2 my-0" role="alert"><strong>La CI debe ser un valor numérico.</strong></span>'
                        );
                        $(this).prop("disabled", false).removeClass("btn-disabled");
                        return;
                    }

                    if (ciPasaporte > 99999999) {
                        $("#ci_pasaporte").addClass("is-invalid");
                        $("#ci_pasaporte").after(
                            '<span class="invalid-feedback position-absolute ml-2 my-0" role="alert"><strong>La CI superó el valor máximo permitido.</strong></span>'
                        );
                        $(this).prop("disabled", false).removeClass("btn-disabled");
                        return;
                    }

                } else {

                    if (!expRegPasaporte.test(ciPasaporte)) {
                        $("#ci_pasaporte").addClass("is-invalid");
                        $("#ci_pasaporte").after(
                            '<span class="invalid-feedback position-absolute ml-2 my-0" role="alert"><strong>El campo no debe incluir caracteres especiales.</strong></span>'
                        );
                        $(this).prop("disabled", false).removeClass("btn-disabled");
                        return;
                    }

                    if (ciPasaporte.length > 13) {
                        $("#ci_pasaporte").addClass("is-invalid");
                        $("#ci_pasaporte").after(
                            '<span class="invalid-feedback position-absolute ml-2 my-0" role="alert"><strong>Excedió el máximo de caracteres permitidos.</strong></span>'
                        );
                        $(this).prop("disabled", false).removeClass("btn-disabled");
                        return;
                    }
                }


                $.get($(this).data("href"), data, function(res) {
                    if (res.status === 'restricted') {

                        $("#msg-restringido").html(
                            `<div class='p-1 bg-danger text-white text-center font-weight-bold'><span class='icofont-exclamation-tringle'></span> VISITANTE RESTRINGIDO.
                           <a id="detalle-restrigido" data-documento="${data.ciPasaporte}" data-tipo-documento="${data.tipoDocumento}"href="#winInfoDetalleRestringido" data-registro=""
                                class="text-white"
                                data-backdrop="static" data-target="#winInfoDetalleRestringido" data-toggle="modal" data-placement="bottom"
                                title="Ver detalles">
                                [Ver detalles]
                            </a>
                         </div>`
                        );

                        $("#btnBuscarVisitante")
                            .prop("disabled", false)
                            .removeClass("btn-disabled");

                    } else if (res.status === 'inside') {

                        $("#msg-restringido").html(
                            `<div class='p-1 bg-danger text-white text-center font-weight-bold'><span class='icofont-exclamation-tringle'></span> EL VISITANTE ESTA DENTRO DE LAS INSTALACIONES CON EL CARNET NÚMERO ${res.data.no_carnet_asignado}</div>`
                        );

                        $("#btnBuscarVisitante")
                            .prop("disabled", false)
                            .removeClass("btn-disabled");


                    } else if (res.status === 'duplicate') {

                        $('#tipo_documento').val('V');
                        $('#ci_pasaporte').val('');

                        $("#winAgregarRegistro").modal("show");
                        $("#winAgregarRegistro .modal-body").html(res);

                        $("#btnBuscarVisitante")
                            .prop("disabled", false)
                            .removeClass("btn-disabled");


                    } else {

                        $('#tipo_documento').val('V');
                        $('#ci_pasaporte').val('');

                        $("#winAgregarRegistro").modal("show");

                        $("#winAgregarRegistro .modal-body").html(res);

                        $("#btnBuscarVisitante")
                            .prop("disabled", false)
                            .removeClass("btn-disabled");
                    }

                }).fail(function() {
                    $("#ci_pasaporte").addClass("is-invalid");
                    $("#ci_pasaporte").after(
                        '<span class="invalid-feedback position-absolute ml-2 my-0" role="alert"><strong>Error inesperado al consultar el visitante.</strong></span>'
                    );

                    $("#btnBuscarVisitante")
                        .prop("disabled", false)
                        .removeClass("btn-disabled");
                });
            }
        });


        /**
         * *-----------------------------------------------------------------------------
         * * MOSTRAR LA VENTANA MODAL PARA VER EL DETALLE DEL VISITANTE RESTRINGIDO.
         * *-----------------------------------------------------------------------------
         */

        $(document).on("click", "#detalle-restrigido", function(e) {

            const data = {
                ciPasaporte: $(this).data('documento'),
                tipoDocumento: $(this).data('tipo-documento'),
            }


            $("#winInfoDetalleRestringido .modal-body").html(
                `<div id="mensaje_loading" class="text-center w-100">\
                 <img class="img-fluid" src="/img/loading.gif" width="32px" style="">\
                 <p><strong>Obteniendo el registro..</strong></p></div>`
            );

            $.get("api/visitantes/motivo-restrigido", data, function(res, status) {

                $("#winInfoDetalleRestringido .modal-body").html(res);
            });

        })


        /**
         * *-------------------------------------------------------------
         * * MOSTRAR LA VENTANAPARA VER EL DETALLE DEL VISITANTE.
         * *-------------------------------------------------------------
         */

        $(document).on("click", ".openDetalleVisitante", function(e) {

            e.preventDefault();

            $("#winDetalleVisitante .modal-body").html(
                `<div id="mensaje_loading" class="text-center w-100">\
                 <img class="img-fluid" src="/img/loading.gif" width="32px" style="">\
                 <p><strong>Obteniendo el registro..</strong></p></div>`
            );

            let url_record = $(this).data("registro");

            $.get(url_record, function(res) {
                $("#winDetalleVisitante .modal-body").html(res);
            });

        });

        /**
         * *-----------------------------------------------
         * * MOSTRAR LA VENTANA PARA EDITAR EL VISITANTE.
         * *-----------------------------------------------
         */

        $(document).on("click", ".openEditarVisitante", function(e) {

            e.preventDefault();

            $("#winEditarVisitante .modal-body").html(
                `<div id="mensaje_loading" class="text-center w-100">\
                 <img class="img-fluid" src="/img/loading.gif" width="32px" style="">\
                 <p><strong>Obteniendo el registro..</strong></p></div>`
            );

            let url_record = $(this).data("registro");

            $.get(url_record, function(res) {
                $("#winEditarVisitante .modal-body").html(res);
            });

        });

        /**
         * *---------------------------------------------------------
         * * MOSTRAR LA VENTANAPARA PARA DAR LA SALIDA AL VISITANTE.
         * *---------------------------------------------------------
         */


        $(document).on("click", ".openSalidaVisitanteWin", function(e) {

            e.preventDefault();

            $("#winSalidaVisitante .modal-body").html(

                `<div id="mensaje_loading" class="text-center w-100">\
                <img class="img-fluid" src="/img/loading.gif" width="32px" style="">\
                <p><strong>Obteniendo el registro..</strong></p></div>`

            );



            let url_record = $(this).data("registro");

            $.get(url_record, function(res) {
                $("#winSalidaVisitante .modal-body").html(res);
            });

        });


        /**
         * *------------------------------------------------------------------------
         * * PROCESAR LA SALIDA DEL VISITANTE
         * *------------------------------------------------------------------------
         */

        $(document).on('submit', '#salida_visitante', async function(e) {
            e.preventDefault();
            let equipos = $('table tr', this).length - 1;
            let conf = true;
            let retiraTodo = true;
            const data = {};


            if (equiposRetirados.length !== equipos && equipos > 0) {

                retiraTodo = false;

                conf = await Swal.fire({
                    icon: 'warning',
                    html: '<h1 style="text-align: center;color: red;font-weight: bold; padding-bottom:0.75em;"> ADVERTENCIA </h1>' +
                        '<h3 style="text-align: center;"> Faltan equipos por retirar. </h3>' +
                        '<p style="text-align: center;">¿Desea continuar y registrar la salida?</p>',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'Cancelar',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isDismissed) {
                        return false;
                    }
                    return true;
                })
            }

            if (conf) {
                data.retiraTodo = retiraTodo;
                data.equipos = equiposRetirados;

                $.ajax({
                    url: $(this).attr('action'),
                    type: "PUT",
                    headers: {
                        "X-CSRF-TOKEN": $('input[name="_token"]').val()
                    },
                    data: data,
                    context: this,
                    dataType: "json",

                    beforeSend: function() {

                        $("#foot-notificacion").html(
                            '<p class="info-wait text-center w-100"><strong class="text-danger">Procesando salida...</strong></p>'
                        );

                        $(this).data("locked", 'true');

                        $('input[type="submit"]', this).blur();
                        $('input[type="submit"]', this).attr(
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
                        equiposRetirados.length = 0;

                    },


                    complete: function() {

                        $(this).data("locked", 'false');
                        $('input[type="submit"]', this).removeAttr("disabled");
                        $('#foot-notificacion p').remove();

                    }
                });
            }

        });

        /**
         * *---------------------------------------------------------------
         * * SELECCIONAR O DESELECCIONAR EN LA LISTA DE EQUIPOS INGRESADOS*
         * *---------------------------------------------------------------
         */

        $(document).on('click', '.checkmark', function() {

            let idEquipo = $(this).attr('id');


            if (!$('#chkEquipo-' + idEquipo).prop('checked')) {

                equiposRetirados.push(idEquipo);

            } else {

                equiposRetirados.splice(equiposRetirados.indexOf(idEquipo), 1);

            }


        });

        /***------------------------------------------------------------------------
         * * LIMPIA EL FORMULARIO DE AGREGAR VISITES AL CERRAR EL LA VENTANA MODAL.
         * *------------------------------------------------------------------------
         */

        $('#winAgregarRegistro').on('hidden.bs.modal', function(e) {
            addEquipos.length = 0;
            $("#winAgregarRegistro .modal-body").empty();
        })


        /**
         * *------------------------------------------------------------------------
         * * LIMPIA EL FORMULARIO REGISTRAR SALIDA AL CERRAR EL LA VENTANA MODAL*
         * *------------------------------------------------------------------------
         */

        $('#winSalidaVisitante').on('hidden.bs.modal', function(e) {
            equiposRetirados.length = 0;
            $("#winSalidaVisitante .modal-body").empty();
        })

        /**
         * *-----------------------------------------------------------------------
         * * LIMPIA EL FORMULARIO EDITAR VISITANTE*
         * *----------------------------------------------------------------------
         */

        $('#winEditarVisitante').on('hidden.bs.modal', function(e) {
            equiposVisitante.length = 0;
            equiposVisitanteOriginal.length = 0;
            delEquipos.length = 0;
            $("#winEditarVisitante .modal-body").empty();
        })
    </script>
@endsection

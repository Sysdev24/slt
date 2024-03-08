@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="breadcrumbs">
            <h2 class="mb-3 ml-3 font-weight-bold">
                <a href="{{ route('reportes') }}">
                    <span class="icofont-home"></span>
                </a> / REPORTE DE LINEAS TELEFONICAS
            </h2>
        </div>

        <div class="row justify-content-center">

            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12 bg-dark text-white text-center p-2">
                                <p class=" font-weight-bold m-0">PARÁMETROS DE LA CONSULTA</p>
                            </div>
                        </div>

                        <div class="row mb-3">

                            <div class="col-9">
                                {!! Form::label('titulo_reporte', 'TÍTULO DEL REPORTE', ['class' => 'form-label font-weight-bold']) !!}
                                {!! Form::text('titulo_reporte', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="col-3">
                                {!! Form::label('registro_paginas', 'REGISTROS POR PÁGINA', ['class' => 'form-label font-weight-bold']) !!}
                                {!! Form::text('registro_paginas', '10', ['class' => 'form-control']) !!}
                            </div>

                        </div>


                        <div class="card ">

                            <div class="card-header">
                                COLUMNAS DEL REPORTE
                            </div>

                            <div class="card-body">

                                <div class="row columnas justify-content-between align-items-center">

                                    <div class="col-7 columna-incluir ">
                                        <h5 class="text-center">INCLUIR</h5>
                                        <ul class="waffle list-unstyled m-1 border border-dark rounded p-1">

                                             <li id="ci" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">CI</p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>

                                            <li id="nombre" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">NOMBRES </p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>

                                            <li id="apellido" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">APELLIDOS </p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>

                                            <li id="nro_empleado" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">NRO_EMPLEADO </p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>

                                            <li id="cargo"
                                                class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">CARGO</p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>

                                            <li id="gerencia" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">GERENCIA </p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>

                                            <li id="estado" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">ESTADO </p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>

                                            <li id="operadora" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">OPERADORA</p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>
                                            
                                            <li id="plan" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">PLAN</p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>

                                            <li id="monto_plan" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">MONTO_PLAN </p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>

                                            <li id="estatus" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">ESTATUS</p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>

                                            <li id="nro_tlf" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">NRO_TLF </p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>

                                            <li id="cuenta_uso" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">CUENTA_USO </p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>

                                            <li id="observacion" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">OBSERVACION </p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>

                                            <li id="equipo" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">EQUIPO</p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-1 arrow-button text-center">
                                        <span class="icofont-arrow-right arrow-button-excluir "></span>
                                        <span class="icofont-arrow-left arrow-button-incluir "></span>
                                    </div>

                                    <div class="col-4 columna-excluir">

                                        <h5 class="text-center">EXCLUIR</h5>
                                        <ul class="list-unstyled m-1 border border-dark rounded p-1">

{{--                                             <li id="estado" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-12">ESTADO</p>
                                            </li>

                                            <li id="gergral"
                                                class="row m-0 justify-content-between align-items-center">
                                                <p class="col-12">GERENCIA</p>
                                            </li>
                                            <li id="nro_tlf" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-12">NRO. TELÉFONO</p>
                                            </li>

                                            <li id="observacion"
                                                class="row m-0 justify-content-between align-items-center">
                                                <p class="col-12">OBSERVACIÓN</p>
                                            </li> --}}
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div>
                            <div class="card mt-3">

                                <div class="card-header">
                                    FILTRAR POR:
                                </div>
    
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            {!! Form::label('estados', 'ESTADOS', ['class' => 'form-label font-weight-bold']) !!}
                                            <div class="input-group">
                                                {!! Form::select('estados', $estado, null, ['class' => 'form-control reset', 'multiple']) !!}
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            {!! Form::label('gerencia', 'GERENCIA', ['class' => 'form-label font-weight-bold']) !!}
                                            <div class="input-group">
                                                {!! Form::select('gerencia', $gerencia, null, ['class' => 'form-control reset', 'multiple']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                      
                                        <div class="col-6">
                                            {!! Form::label('plan', 'PLAN', ['class' => 'form-label font-weight-bold']) !!}
                                            <div class="input-group">
                                                {!! Form::select('plan', $plan, null, ['class' => 'form-control reset', 'multiple']) !!}
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            {!! Form::label('operadoras', 'OPERADORAS', ['class' => 'form-label font-weight-bold']) !!}
                                            <div class="input-group">
                                                {!! Form::select('operadoras', $operadoras, null, [
                                                    'class' => 'form-control reset',
                                                    'multiple',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            {!! Form::label('cargo', 'CARGO', ['class' => 'form-label font-weight-bold']) !!}
                                            <div class="input-group">
                                                {!! Form::select('cargo', $cargo, null, [
                                                    'class' => 'form-control reset',
                                                    'multiple',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            {!! Form::label('estatus', 'ESTATUS', ['class' => 'form-label font-weight-bold']) !!}
                                            <div class="input-group">
                                                {!! Form::select('estatus', $estatus, null, [
                                                    'class' => 'form-control reset',
                                                    'multiple',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                    </div>
                    <div class="row justify-content-center p-2 m-3">
                        <a href="javascript:void(0)" id="consultar-registro" class="btn btn-primary m-1">
                            CONSULTAR
                        </a>
                        <a href="javascript:void(0)" id="limpiar" class="btn btn-primary m-1"> LIMPIAR</a>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('js')
        <script>
            /**
             * *------------------------------------------------
             * | Referencia a elementos HTML.
             * *------------------------------------------------
             * */

            const estados = $('select#estados');
            const gerencia = $('select#gerencia');
            const operadoras = $('select#operadoras');
            const plan = $('select#plan');
            const cargo = $('select#cargo');
            const estatus = $('select#estatus');
            const consultarRegistro = $('#consultar-registro');
            const columnasReportes = $('.columna-incluir ul');
            const columnasReportesExcluir = $('.columna-excluir ul');
            const tituloReporte = $('#titulo_reporte');
            const registrosXPagina = $('#registro_paginas');
            const limpiar = $('#limpiar');

            $(document).ready(function() {

                /**
                 * *----------------------------------------------------
                 * | Referecia a eventos asociados a sus elementos
                 * *----------------------------------------------------
                 **/

                $(document).on('click', '#consultar-registro', function(e) {
                    consultaRegistro()
                });

                $(document).on('click', '#limpiar', function(e) {
                    limpiarFormConsultaRegistro()
                });

                $(document).on('click', '.columna-incluir ul li p , .columna-excluir ul li p', function(e) {
                    toggleSeleccionarColumnas($(this))
                });


                $(document).on('click', '.arrow-button-incluir', function() {
                    incluirColumna();
                });


                $(document).on('click', '.arrow-button-excluir', function() {
                    excluirColumna();
                });

                /**
                 * *------------------------------------
                 * |Confifuraion de librerías
                 * *------------------------------------
                 * */



                /**
                 * # CONFIGURAR EL PLUGING DATE-TIME-PICKER-BOOSTRAP4
                 * ! Fuente:https://www.jqueryscript.net/time-clock/Date-Time-Picker-Bootstrap-4.html
                 */
                const opcionesDateTimePicker = {
                    ignoreReadonly: true,
                    format: 'DD/MM/YYYY',
                    locale: 'es',
                    useCurrent: true,
                    icons: {
                        time: 'icofont-clock-time',
                        date: 'icofont-calendar',
                        up: 'icofont-circled-up',
                        down: 'icofont-circled-down',
                        previous: 'icofont-arrow-left',
                        next: 'icofont-arrow-right',
                        today: 'icofont-focus',
                        clear: 'icofont-trash',
                        close: 'icofont-close-circled'
                    },

                    widgetPositioning: {
                        horizontal: 'auto',
                        vertical: 'auto'
                    },
                };

                // $(function() {
                //      $('#fecha_entrada_desde').datetimepicker(opcionesDateTimePicker);
                //      $('#fecha_entrada_desde').data("DateTimePicker").maxDate(new Date);
                //  });

                //  $(function() {
                //      $('#fecha_entrada_hasta').datetimepicker(opcionesDateTimePicker);
                //      $('#fecha_entrada_hasta').data("DateTimePicker").maxDate(new Date);
                //  });

            });


            const limpiarFormConsultaRegistro = () => {

                _columnasIncluir = {
                    ci: 'CI',
                    nombre: 'NOMBRES',
                    apellido: 'APELLIDOS',
                };

                _columnasExcluir = {
                    estado: 'ESTADO',
                    gerencia: 'GERENCIA',
                    nro_tlf: 'NRO. TELÉFONO',
                    operadora: 'OPERADORA',
                    observacion: 'OBSERVACIÓN',
                };

                columnasReportes.empty();
                columnasReportesExcluir.empty();


                for (const key in _columnasIncluir) {
                    columnasReportes.append(
                        `<li id="${key}" class="row m-0 justify-content-between align-items-center">
                            <p class="col-5">${_columnasIncluir[key]}</p>
                            <input type="text" class="col-6  form-control">
                            <span class=" col-1 icofont-drag "></span>
                        </li>`
                    );
                }

                for (const key in _columnasExcluir) {
                    columnasReportesExcluir.append(
                        `<li id="${key}"
                            class="row m-0 justify-content-between align-items-center">
                            <p class="col-12">${_columnasExcluir[key]}</p>
                        </li>`
                    );
                }

                //* Para referenciar con la librería waffler
                $(document).ready(function() {
                    $(document).waffler();
                });

                tituloReporte.val('');
                registrosXPagina.val('10');
                estados.val('').trigger('change.select2');
                gerencia.val('').trigger('change.select2');
                gerencia.prop('disabled', true);
                plan.val('').trigger('change.select2');
                operadoras.val('').trigger('change.select2');

                hoy = new Date();
                //fechaEntradaDesde.val(`01/01/${hoy.getFullYear()}`);
                //fechaEntradaHasta.val(moment().format('DD/MM/YYYY'));
            };



            const consultaRegistro = () => {

                const columnas = [];
                const fltrosConsulta = {};
                const param = {}

                const URL_BASE = window.location.protocol + '//' + window.location.host;

                columnasReportes.find('li').each(function(index) {

                    let alias = '';
                    let columna = $(this).attr('id');

                    if ($(this).find('input[type="text"]').val().trim().length > 0) {
                        alias = $(this).find('input[type="text"]').val().trim();
                    } else {
                        alias = $(this).find('p').text();
                    }

                    columnas.push({
                        columna,
                        alias
                    })
                });

                if (estados.val().length > 0) fltrosConsulta.estados = estados.val();
                if (cargo.val().length > 0) fltrosConsulta.cargo = cargo.val();
                if (gerencia.val().length > 0) fltrosConsulta.gerencia = gerencia.val();
                if (plan.val().length > 0) fltrosConsulta.plan = plan.val();
                if (operadoras.val().length > 0) fltrosConsulta.operadoras = operadoras.val();
                if (estatus.val().length > 0) fltrosConsulta.estatus = estatus.val();

                // fltrosConsulta.fechaEntradaDesde=fechaEntradaDesde.val();
                // fltrosConsulta.fechaEntradaHasta=fechaEntradaHasta.val();

                // fltrosConsulta.conSalida=conSalida.prop('checked')?true:false;
                // fltrosConsulta.sinSalida=sinSalida.prop('checked')?true:false;


                param.titulo = tituloReporte.val()|| 'LISTADO DE ASIGNACION DE LINEAS TELEFONICAS' ;
                param.paginado = registrosXPagina.val()
                param.columnas = columnas
                param.filtros = fltrosConsulta
                console.log(param);
                window.open(URL_BASE + '/consultar-registro?q=' + encodeURIComponent(JSON.stringify(param)),'_blank');
            }

            /**
             * *----------------------------------------------------
             * | Permite seleccionar o deseleccionar columnas.
             * *----------------------------------------------------
             */
            const toggleSeleccionarColumnas = (e) => {

                if (!e.parent().hasClass('selected')) {

                    e.parent().addClass('selected');

                } else {
                    e.parent().removeClass('selected');
                }

            }


            /**
             * *-----------------------------
             * | Incluir columna(as)
             * *-----------------------------
             **/
            const incluirColumna = () => {

                if ($('.columna-excluir ul li.selected').length > 0) {

                    $('.columna-excluir ul li.selected').each(function(index) {
                        $('.columna-incluir ul').append(

                            `<li id="${$(this).attr('id')}" class="row m-0 justify-content-between align-items-center">
                                <p class="col-5">${$('p', this).html()}</p>
                                <input type="text" class="col-6  form-control">
                                <span class=" col-1 icofont-drag "></span>
                            </li>`
                        );

                        $(this).remove();
                        $(document).ready(function() {
                            $(document).waffler();
                        });
                    });

                } else {

                    Swal.fire({
                        icon: 'warning',
                        title: 'Selecciona la(s) columna(s) que deseas incluir.',
                        showConfirmButton: true,
                        allowOutsideClick: false
                    })
                }
            }


            /**
             * *-----------------------------
             * | Excluir columna(as)
             * *-----------------------------
             **/
            const excluirColumna = () => {
                if ($('.columna-incluir ul li.selected').length > 0) {

                    $('.columna-incluir ul li.selected').each(function(index) {
                        $('.columna-excluir ul').append(

                            `<li id="${$(this).attr('id')}" class="row m-0 justify-content-between align-items-center">
                                <p class="col-12">${$('p', this).html()}</p>
                            </li>`
                        );
                        $(this).remove();
                    });

                } else {

                    Swal.fire({
                        icon: 'warning',
                        title: 'Selecciona la(s) columna(s) que deseas excluir.',
                        showConfirmButton: true,
                        allowOutsideClick: false
                    })
                }
            }
        </script>
    @endsection

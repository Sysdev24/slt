<table id="data-table" class="table table-hover" style="width:275%">
    <thead>
      {{--    <th style="text-align: center" width="8%">&nbsp;</th> --}}
      <th style="text-align: center" width="8%">CEDULA</th>
        <th style="text-align: center" width="8%">NOMBRES</th>
        <th style="text-align: center" width="15.8%">APELLIDOS</th>
        <th style="text-align: center" width="15.8%">OPERADORA</th>
        <th style="text-align: center" width="10%">TELEFONO</th>
         <th style="text-align: center" width="10%">CUENTA USO</th>
        <th style="text-align: center" width="10%">PLAN</th>
        <th style="text-align: center" width="10.8%">N° TELEFONO</th>
       {{-- <th style="text-align: center" width="10.8%">N° TELEFONO</th>
        <th style="text-align: center" width="17.8%">CUENTA USO</th>
        <th style="text-align: center" width="10%">N° EMPLEADO</th>
        <th style="text-align: center" width="12.8%">GERENCIA ADSCRITA</th>
        <th style="text-align: center" width="12.8%">MONTO CREDITO</th>
        <th style="text-align: center" width="10%">PLAN</th> --}}

    </thead>
</table>

@section('js')
    <script>
        $(document).ready(function() {

            const URL_BASE = window.location.protocol + '//' + window.location.host;

            let table = $('#data-table').DataTable({

                language: {
                    url: 'js/librerias/es-ES.json'
                },
                info: false,
                pageLength: 10,
                order: [
                    [1, "asc"]
                ],
                paging: true,
                lengthChange: false,
                columnDefs: [{
                        orderable: false,
                        targets: 0
                    },
                    {
                        type: 'natural',
                        targets: 1
                    },
                    {
                        type: 'date',
                        targets: 2
                    },
                    {
                        targets: [0, 1, 2, 3, 4,5,6,7],
                        className: 'dt-body-center'
                    },
                    {
                        type: "datetime-moment",
                        targets: 2
                    }

                ],
                ajax: URL_BASE + '/api/visitantes',
                columns: [/* {
                        data: "id_registro",
                        render: function(data, type, row) {

                            if (row.fecha_hora_salida == null) {
                                icon_estatus = `<a href="#winSalidaVisitante" data-registro="${URL_BASE}/visitantes/${data}/edit"
                            class="badge badge-primary p-2 openSalidaVisitanteWin zebra_tooltips_td border border-danger bg-danger rounded-circle"
                            data-backdrop="static" data-target="#winSalidaVisitante" data-toggle="modal" data-placement="bottom"
                            title="Registrar salida"><span class="icofont-exit text-white "></span></a>`

                            } else {
                                icon_estatus =
                                    `<a href="#winSalidaVisitante" data-registro="${URL_BASE}/visitantes/${data}/edit"
                            class="badge badge-primary p-2 openSalidaVisitanteWin zebra_tooltips_td border border-success bg-success rounded-circle"
                            data-backdrop="static" data-target="#winSalidaVisitante" data-toggle="modal" data-placement="bottom"
                            title="Hora de salida: ${row.fecha_hora_salida}"><span class="icofont-ui-check text-white "></span></a>`
                            }

                            return `<a href="#winDetalleVisitante" data-registro="${URL_BASE}/visitantes/${data}"
                            class="badge badge-primary p-2 openDetalleVisitante zebra_tooltips_td border border-primary rounded-circle"
                            data-backdrop="static" data-target="#winDetalleVisitante" data-toggle="modal" data-placement="bottom"
                            title="Ver detalles"><span class="icofont-eye-alt text-white "></span></a>

                            <a href="#winEditarVisitante" data-registro="${URL_BASE}/visitantes/edit/${data}"
                            class="badge badge-primary p-2 openEditarVisitante zebra_tooltips_td border border-primary rounded-circle"
                            data-backdrop="static" data-target="#winEditarVisitante" data-toggle="modal" data-placement="bottom"
                            title="Editar"><span class="icofont-ui-edit text-white "></span></a> ${icon_estatus}`


                        }
                    }, */
               
                    {
                        data: "personal.ci"
                    },

                    {
                        data: "personal.nombre"
                    },

                    {
                        data: "personal.apellido"
                    },
                    {
                        data: "operadora.descripcion"
                    },
                    
                    {
                        data: "nro_tlf"
                    },

                    {
                        data: "cuenta_uso"
                    },
                    {
                        data: "plan.descripcion"
                    },
                    {
                        data: "personal.id_cargo"
                    },
                  
                   

                ]
            });
        });
    </script>
@endsection

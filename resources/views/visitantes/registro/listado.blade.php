<table id="data-table" class="table table-hover" style="width:200%">
    <thead>
      {{--    <th style="text-align: center" width="8%">&nbsp;</th> --}}
      <th style="text-align: center" width="8%">CEDULA</th>
        <th style="text-align: center" width="8%">NOMBRES</th>
        <th style="text-align: center" width="15.8%">APELLIDOS</th>
        <th style="text-align: center" width="15.8%">OPERADORA</th>
        <th style="text-align: center" width="10%">TELEFONO</th>
         <th style="text-align: center" width="10%">CUENTA USO</th>
        <th style="text-align: center" width="10%">PLAN</th>
        <th style="text-align: center" width="10%">N° EMPLEADO</th>
        <th style="text-align: center" width="12.8%">GERENCIA ADSCRITA</th>
        <th style="text-align: center" width="12.8%">MONTO CREDITO</th>
    </thead>
</table>

@section('js')

<script>
    const URL_BASE = window.location.protocol + '//' + window.location.host;
let table= $('#data-table').DataTable({

    language: {
        url: 'js/librerias/es-ES.json'
    },
    info:false,
    pageLength: 10,
    order: [[ 2, "asc" ]],
    paging: true,
    lengthChange:false,
    columnDefs: [
        { orderable: false,targets: 0 },
        {
            targets: [0,1,2,3,4,5,6],
             className: 'dt-body-center'
        }
    ],
    ajax: URL_BASE+'/api/personal',
    columns:[
        {data:"id_registro",
            render:function(data, type, row){
                return `<a href="#winEdit" data-registro='${location.href}/${data}/edit'"
                            class="badge badge-primary p-2 openEditWin zebra_tooltips_td border border-success rounded-circle"
                            data-backdrop="static" data-target="#winEdit" data-toggle="modal" data-placement="bottom"
                            title="Editar"><span class="icofont-ui-edit text-white "></span></a>`
            }
        },

        {data:"id_status",render:function(data, type, row){console.log(data);
            if(data===1){
                icono='icofont-ui-check';
                style='bg-success'
            }else{
                icono='icofont-ui-close';
                style='bg-danger'
            }

            return `<label style="visibility: hidden;">${data}</label>
            <a href="#winEditEstatus" data-registro="${URL_BASE}/personal/${row.id_personal}"
                        class="badge p-2 openEditStatusWin zebra_tooltips_td border rounded-circle ${style}"
                        data-backdrop="static" data-target="#winEditEstatus" data-toggle="modal" data-placement="bottom"
                        title="Modificar estatus">
                        <span class="text-white ${icono}">
                        </span>
                    </a>`
            }
        },

        {data:"personal.ci"},
        {data:"personal.nombre"},
        {data:"personal.apellido"},
		{data:"personal.nro_empleado"},
       <// {data:"cargo.descripcion"},
        {data:"gerencia.descripcion"},
        {data:"estado.descripcion"},//>
		{data:"plan.descripcion"},
		{data:"plan.monto_credito"},
		{data:"operadora.descripcion"},
		{data:"estatus.descripcion"},
        ]
});
</script>
@endsection

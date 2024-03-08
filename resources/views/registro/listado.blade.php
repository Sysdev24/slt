<table id="data-table" class="table table-hover" style="width:60%">
    <thead>
        <th style="text-align: center" width="2%">MOD</th>
		<th style="text-align: center" width="2%">SUSP</th>
        <th style="text-align: center" width="2%">IMP</th>
        <th style="text-align: center" width="2%">ID</th>
        <th style="text-align: center" width="2%">C.I</th>
        <th style="text-align: center" width="5%">NOMBRES</th>
        <th style="text-align: center" width="5%">APELLIDOS</th>
        <th style="text-align: center" width="5%">OPERADORA</th>
        <th style="text-align: center" width="2%">TLF</th>
        <th style="text-align: center" width="5%">CUENTA USO</th>
        <th style="text-align: center" width="5%">PLAN</th>
        <th style="text-align: center" width="5%">EMPLEADO</th>
        <th style="text-align: center" width="5%">CARGO</th>
        <th style="text-align: center" width="5%">GERENCIA</th>
        <th style="text-align: center" width="5%">ESTADO</th>
		<th style="text-align: center" width="5%">OBSERVACION</th>
		<th style="text-align: center" width="5%">EQUIPO</th>
        <th style="text-align: center" width="5%">MODELO</th>
        <th style="text-align: center" width="5%">SERIAL</th>
        <th style="text-align: center" width="5%">ACCESORIOS</th>
        <th style="text-align: center" width="2%">FIRMANTE</th>
        <th style="text-align: center" width="5%">ESTATUS LINEA</th>
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
            targets: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21],
             className: 'dt-body-center'
        }
    ],
    ajax: URL_BASE+'/api/registro',
    columns:[
        {data:"id_registro",
            render:function(data, type, row){
                return `<a href="#winEdit" data-registro='${location.href}/${data}/edit'"
                            class="badge badge-primary p-2 openEditWin zebra_tooltips_td border border-success rounded-circle"
                            data-backdrop="static" data-target="#winEdit" data-toggle="modal" data-placement="bottom"
                            title="Editar"><span class="icofont-ui-edit text-white "></span></a>`
            }
        },

        {
                    data: "estatus_registro",
                    render: function(data, type, row) {
                        if (data === 1) {
                            icono = 'icofont-ui-check';
                            style = 'bg-success'
                        } else {
                            icono = 'icofont-ui-close';
                            style = 'bg-danger'
                        }

            return `<label style="visibility: hidden;">${data}</label>
            <a href="#winEditEstatus" data-registro="${URL_BASE}/registro/${row.id_registro}"
                        class="badge p-2 openEditStatusWin zebra_tooltips_td border rounded-circle ${style}"
                        data-backdrop="static" data-target="#winEditEstatus" data-toggle="modal" data-placement="bottom"
                        title="Desactivar">
                        <span class="text-white ${icono}">
                        </span>
                    </a>`
           }
        }, 
        {data:"id_registro",
            render:function(data, type, row){

                return `<a class="print" href="javascript:void(0)"  data-registro="${row.id_registro}" title="Imprimir acta"><span class="  icofont-print bg-info text-white border rounded-circle p-2 "></span> </a>`;
              
            }
        },

        {data:"id_personal"},
        {data:"ci"},
        {data:"nombre"},
        {data:"apellido"},
		{data:"operadora"},
		{data:"nro_tlf"},
		{data:"cuenta_uso"},
		{data:"plan"},
		{data:"nro_empleado"},
        {data:"cargo"},
        {data:"gerencia"},
        {data:"estado"},
		{data:"observacion"},
		{data:"equipo"},
        {data:"tipo"},
        {data:"serial"},
        {data:"accesorios"},
        {data:"nombre_apellido"}, 		
		{data:"estatus"},
        ]
});


$(document).on('click','.print', function(e){
    e.preventDefault();

    window.open(`${URL_BASE}/registro/preview-print/${$(this).data('registro')}`,'Imprimir Acta','_blank',"height=720,width=1024,menubar=no,status=no,toolbar=no,resizable=no"); 
})

$('#ci').on('change', function(){ 
        var ci =  $(this).val();

        $.ajax({
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    type: 'GET',
                    url: "{{ route('get.person') }}",
                    data: {
                        'ci': ci,
                    },
                    success: function(data) {
                        if(data.id_estatus===1){
                            $('#nombre').val(data.nombre);
                            $('#apellido').val(data.apellido);
                            $('#id_personal').val(data.id_personal);
                        }else{
                            alert ('El registro no existe')
                        }
                    },
        });

    });

    $('#serial').on('change', function(){ 
        var serial =  $(this).val();

        $.ajax({
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    type: 'GET',
                    url: "{{ route('get.serial') }}",
                    data: {
                        'serial': serial,
                    },
                    success: function(data) {
                        if(data.id_estatus===1){
                            $('#equipo').val(data.equipo);
                            $('#tipo').val(data.tipo);
                            $('#accesorios').val(data.accesorios);
                            $('#id_equipo_componente').val(data.id_equipo_componente);
                        }else{
                           alert ('El registro no existe')
                        }
                    },
        });

    }); 

</script>
@endsection

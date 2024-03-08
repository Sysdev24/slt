<div>
    {!!Form::open(['url'=>'/equipo_componente','method'=>'post','id'=>'agregar_registro','class'=>'m-4','data-locked'=>'false','data-crud'=>'add'])!!}
    <div class="row mb-4">
        <div class="col-6">
            {!! Form::label('id_sede_equipo', 'EQUIPO:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::select("id_sede_equipo", $equipo, null, ['class'=>'chosen-select
            form-control','data-placeholder'=>'Seleccione el equipo'])
            !!}
        </div>
        <div class="col-12 mt-4">
            {!! Form::label('tipo', 'MODELO:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'tipo',
            null,
            ['class'=>'form-control',
            'placeholder'=>'Ingresa el modelo del equipo']) !!}
        </div>
        <div class="col-12 mt-4">
            {!! Form::label('serial', 'SERIAL:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'serial',
            null,
            ['class'=>'form-control',
            'placeholder'=>'Ingresa el serial del equipo']) !!}
        </div>
        <div class="col-12 mt-4">
            {!! Form::label('accesorios', 'ACCESORIOS:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'accesorios',
            null,
            ['class'=>'form-control',
            'placeholder'=>'Ingresa el accesorios del equipo']) !!}
        </div>
    </div>

    <div class="row mb-4 justify-content-center">
        {!! Form::submit("GUARDAR", ['class'=>'btn btn-primary m-2']) !!}
        <input type="button" id="btnLimpiaFormulario" value="LIMPIAR" class="btn btn-primary m-2">
    </div>

    <div id="foot-notificacion">


    </div>
    {!! Form::close() !!}
</div>

<script>
    $(".chosen-select").chosen({
    no_results_text: 'No hay resultados.',
});
</script>

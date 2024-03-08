<div>
    {!!Form::open(['url'=>'/equipo_componente','method'=>'put','id'=>'editar_registro','class'=>'m-4','data-locked'=>'false','data-crud'=>'edit'])!!}
    {!! Form::hidden('id', $equipo_componente->id_equipo_componente) !!}
    <div class="row mb-4">
        <div class="col-6">
            {!! Form::label('equipo', 'EQUIPO:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::select("equipo", $equipo, $equipo_componente->id_sede_equipo,
            ['class'=>'chosen-select form-control','data-placeholder'=>'Seleccione el equipo'])
            !!}
        </div>
        <div class="col-12 pt-3">
            {!! Form::label('tipo', 'MODELO:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'tipo',
            $equipo_componente->tipo,
            ['class'=>'form-control',
            'placeholder'=>'Ingresa el nombre del modelo']) !!}
        </div>
        <div class="col-12 pt-3">
            {!! Form::label('serial', 'SERIAL:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'serial',
            $equipo_componente->serial,
            ['class'=>'form-control',
            'placeholder'=>'Ingresa el nombre del serial']) !!}
        </div>
        <div class="col-12 pt-3">
            {!! Form::label('accesorios', 'ACCESORIOS:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'accesorios',
            $equipo_componente->accesorios,
            ['class'=>'form-control',
            'placeholder'=>'Ingresa el nombre del accesorio']) !!}
        </div>
    </div>

    <div class="row mb-4 justify-content-center">
        {!! Form::submit("GUARDAR", ['class'=>'btn btn-primary m-2']) !!}
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

<div>
    {!!Form::open(['url'=>'/registro','method'=>'put','id'=>'editar_registro','class'=>'m-4','data-locked'=>'false','data-crud'=>'edit'])!!}
    {!! Form::hidden('id', $registro->id_registro) !!}
    <div class="row mb-4">
        <div class="col-6">
            {!! Form::label('id_personal', 'CÉDULA:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'id_personal',
            $registro->id_personal,
            ['class'=>'form-control',
            'readonly'=>'readonly']) !!}
        </div>
       
    </div>
    <hr />
    <div class="row mb-4">
        <div class="col-6">
            {!! Form::label('nro_telf', 'Nro. Telefono:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'nro_telf',
            $registro->nro_telf,
            ['class'=>'form-control','readonly'=>'readonly']) !!}
        </div>
        <div class="col-6">
            {!! Form::label('cuenta_uso', 'Cuenta Uso:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'cuenta_uso',
            $registro->cuenta_uso,
            ['class'=>'form-control','readonly'=>'readonly']) !!}
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            {!! Form::label('id_operadora', 'Operadora:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::select(
            'operadora',
            $operadora,
            $registro->operadora,
            ['class'=>'form-control chosen-select',
            'data-placeholder'=>'Seleccione la Operadora']) !!}
        </div>
    </div>
    <hr />

    <div class="row mb-4">
        <div class="col-4">
            {!! Form::label('observacion', 'Observacion:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'observacion',
            $registro->observacion,
            ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-6">
            {!! Form::label('plan', 'Plan:' , ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::select(
            'plan',
            $plan,
            $registro->id_plan,
            ['class'=>'form-control chosen-select',
            'data-placeholder'=>'Seleccione el Plan'])
            !!}
        </div>
		<div class="col-6">
            {!! Form::label('estatus', 'ESTATUS:' , ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::select(
            'estatus',
            $estatus,
            $registro->id_estatus,
            ['class'=>'form-control chosen-select',
            'data-placeholder'=>'Seleccione el estatus de la linea'])
            !!}
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

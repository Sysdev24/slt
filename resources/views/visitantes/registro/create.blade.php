<div>
    {!!Form::open(['url'=>'/registro','method'=>'post','id'=>'agregar_registro','class'=>'m-4','data-locked'=>'false','data-crud'=>'add'])!!}
    <div class="row mb-4">
        <div class="col-6">
            {!! Form::label('ci', 'CÉDULA:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'ci',
            null,
            ['class'=>'form-control',
            'placeholder'=>'Ingrese el numero de cedula']) !!}
        </div>
    </div>
  <hr />
    <div class="row mb-4">
        <div class="col-6">
            {!! Form::label('id_personal', 'cedula:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'id_personal',
            null,
            ['class'=>'form-control',
            'placeholder'=>'Cedula']) !!}
        </div>
  
    <div class="row mb-4">
        <div class="col-6">
            {!! Form::label('nro_telf', 'Nro. Telefono:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'nro_telf',
            null,
            ['class'=>'form-control',
            'placeholder'=>'Ingrese el numero de Telefono']) !!}
        </div>

        <div class="col-6">
            {!! Form::label('cuenta_uso', 'Cuenta Uso:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'cuenta_uso',
            null,
            ['class'=>'form-control', 
            'placeholder'=>'Ingrese la Cuenta Uso']) !!}
        </div>

        <div class="col-6">
             {!! Form::label('observacion', 'Observacion:', ['class'=>'form-label font-weight-bold']) !!}
             <small class="text-danger font-italic">Obligatorio</small>
             {!! Form::text(
                 'observacion',
                 null,
                 ['class'=>'form-control',
                 'placeholder'=>'Observacion']) !!}
        </div>

    </div>

  <hr />

        <div class="col-6">
                   
            {!! Form::label('operadora', 'Operadora:', ['class' => 'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>

            {!! Form::select('operadora', $operadora, null, [
                'class' => 'chosen-select form-control',
                'data-placeholder' => 'Seleccione la Operadora',]) !!}
        
        </div>
   
        <div class="col-6">
            {!! Form::label('plan', 'Plan:', ['class' => 'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>

            {!! Form::select('plan', $plan, null, [
                'class' => 'chosen-select form-control',
                'data-placeholder' => 'Seleccione el Plan',]) !!}        
        </div>

	    <div class="col-6">
            {!! Form::label('gerencia', 'Gerencia:', ['class' => 'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>

            {!! Form::select('gerencia', $gergral, null, [
                'class' => 'chosen-select form-control',
                'data-placeholder' => 'Seleccione la gerencia',]) !!}
        </div>

    
    <div class="row mb-4 justify-content-center">
        {!! Form::submit("GUARDAR", ['class'=>'btn btn-primary m-2']) !!}
        <input type="button" id="btnLimpiaFormulario" value="LIMPIAR" class="btn btn-primary m-2">
    </div>


    <div id="foot-notificacion">


    </div>
    {!! Form::close() !!}
</div>

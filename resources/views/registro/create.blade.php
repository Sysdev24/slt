<div>
    {!!Form::open(['url'=>'/registro','method'=>'post','id'=>'agregar_registro','class'=>'m-4','data-locked'=>'false','data-crud'=>'add'])!!}
    <div class="row mb-4">
        <div class="col-3">
            {!! Form::label('ci', 'CÉDULA:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'ci',
            null,
            ['class'=>'form-control',
            'placeholder'=>'Ingrese el numero de cedula', 'id' =>'ci']) !!}
        </div>

        <div class="col-4">
            {!! Form::label('id_personal', 'ID:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'id_personal',
            null,
            ['class'=>'form-control','readonly'=>'readonly']) !!}
        </div>

        <div class="col-4">
            {!! Form::label('nombre', 'Nombres:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'nombre',
            null,
            ['class'=>'form-control','readonly'=>'readonly']) !!}
        </div>
    
	
	        <div class="col-4">
            {!! Form::label('apellido', 'Apellidos', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'apellido',
            null,
            ['class'=>'form-control','readonly'=>'readonly']) !!}
        </div>
    </div>
	
  <hr />

    <div class="row mb-4">
        <div class="col-6">
            {!! Form::label('nro_tlf', 'Nro. Telefono:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'nro_tlf',
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
        <div class="col-6">
                   
            {!! Form::label('equipo', 'Equipo:', ['class' => 'form-label font-weight-bold']) !!}
            {!! Form::text(
                'equipo',
                null,
                ['class'=>'form-control','readonly'=>'readonly']) !!}
        
        </div>

      
        <div class="col-6">
                   
            {!! Form::label('serial', 'Serial:', ['class' => 'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
                'serial',
                null,
                ['class'=>'form-control',
                'data-placeholder'=>'Ingrese el numero de serial', 'id' =>'serial']) !!}
        
        </div>

        <div class="col-4">
            {!! Form::label('id_equipo_componente', 'ID:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'id_equipo_componente',
            null,
            ['class'=>'form-control','readonly'=>'readonly']) !!}
        </div>

        <div class="col-6">
                   
            {!! Form::label('tipo', 'Modelo:', ['class' => 'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
                'tipo',
                null,
                ['class'=>'form-control','readonly'=>'readonly']) !!}
        
        </div>
        <div class="col-6">
                   
            {!! Form::label('accesorios', 'Accesorios:', ['class' => 'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
                'accesorios',
                null,
                ['class'=>'form-control','readonly'=>'readonly']) !!}
        
        </div>
        <div class="col-6">
                   
            {!! Form::label('operadoras', 'Operadoras:', ['class' => 'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>

            {!! Form::select('operadoras', $operadoras, null, [
                'class' => 'chosen-select form-control',
                'data-placeholder' => 'Seleccione la Operadoras',]) !!}
        
        </div>
        <div class="col-6">
            {!! Form::label('id_plan', 'Plan:', ['class' => 'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>

            {!! Form::select('id_plan', $plan, null, [
                'class' => 'chosen-select form-control',
                'data-placeholder' => 'Seleccione el Plan',]) !!}        
        </div>
        
        <div class="col-6">
            {!! Form::label('id_firmante', 'Firmante:', ['class' => 'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>

            {!! Form::select('id_firmante', $vfirmante, null, [
                'class' => 'chosen-select form-control',
                'data-placeholder' => 'Seleccione el Firmante',]) !!}        
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

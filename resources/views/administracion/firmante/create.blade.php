<div>
    {!!Form::open(['url'=>'/firmante','method'=>'post','id'=>'agregar_registro','class'=>'m-4','data-locked'=>'false','data-crud'=>'add'])!!}
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
    </div>
	<div class="row mb-4">
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

	<div class="row mb-4">
        <div class="col-6">
            {!! Form::label('resolucion', 'RESOLUCION:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'resolucion',
            null,
            ['class'=>'form-control',
            'placeholder'=>'Ingrese el numero de la resolucion']) !!}
        </div>
	</div>
	<div class="row mb-4">
        <div class="col-6">
            {!! Form::label('fecha', 'FECHA:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'fecha',
            null,
            ['class'=>'form-control',
            'placeholder'=>'Ingrese la fecha de la resolucion']) !!}
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
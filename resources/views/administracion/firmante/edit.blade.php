<div>
    {!!Form::open(['url'=>'/firmante','method'=>'put','id'=>'editar_registro','class'=>'m-4','data-locked'=>'false','data-crud'=>'edit'])!!}
    {!! Form::hidden('id', $firmante->id_firmante,) !!}
    <div class="row mb-4">
        <div class="col-3">
            {!! Form::label('ci', 'CÉDULA:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'ci',
            $personal[0]->ci,
            ['class'=>'form-control','readonly'=>'readonly']) !!}
        </div>
        <div class="col-3">
            {!! Form::label('id_personal', 'ID:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'id_personal',
            $personal[0]->id_personal,
            ['class'=>'form-control','readonly'=>'readonly']) !!}
        </div>
        <div class="col-3">
            {!! Form::label('nombre', 'NOMBRES:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'nombre',
            $personal[0]->nombre,
            ['class'=>'form-control','readonly'=>'readonly']) !!}
        </div>
        <div class="col-3">
            {!! Form::label('apellido', 'APELLIDOS:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'apellido',
            $personal[0]->apellido,
            ['class'=>'form-control','readonly'=>'readonly']) !!}
        </div>
    </div>

       
    <hr />
    <div class="row mb-4">
       {{--  <div class="col-5">
            {!! Form::label('cargo', 'CARGO:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'cargo',    
            $cargo,
            $firmante->id_cargo,
            ['class'=>'form-control', 
            'placeholder'=>'Ingrese el cargo']) !!}
        </div> --}}
        
        <div class="col-5">
            {!! Form::label('resolucion', 'RESOLUCION:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'resolucion',
            $firmante->resolucion,
            ['class'=>'form-control', 
            'placeholder'=>'Ingrese la resolucion']) !!}
        </div>
        <div class="col-5">
            {!! Form::label('fecha', 'FECHA:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'fecha',
            $firmante->fecha,
            ['class'=>'form-control', 
            'placeholder'=>'Ingrese la fech']) !!}
        </div>
    </div>
	
    <div class="row mb-4 justify-content-center">
        {!! Form::submit("GUARDAR", ['class'=>'btn btn-primary m-2']) !!}
    </div>

    <div id="foot-notificacion">

    </div>
    {!! Form::close() !!}
</div>
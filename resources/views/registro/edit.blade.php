<div>
    {!!Form::open(['url'=>'/registro','method'=>'put','id'=>'editar_registro','class'=>'m-4','data-locked'=>'false','data-crud'=>'edit'])!!}
    {!! Form::hidden('id', $registro->id_registro) !!}
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
       
    
    <hr />
   
        <div class="col-5">
            {!! Form::label('nro_tlf', 'Nro. Telefono:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'nro_tlf',
            $registro->nro_tlf,
            ['class'=>'form-control', 
            'placeholder'=>'Ingrese el nuemro de telefono']) !!}
        </div>
        <div class="col-5">
            {!! Form::label('cuenta_uso', 'Cuenta Uso:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'cuenta_uso',
            $registro->cuenta_uso,
            ['class'=>'form-control', 
            'placeholder'=>'Ingrese la Cuenta Uso']) !!}
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            {!! Form::label('operadoras', 'Operadoras:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::select(
            'operadoras',
            $operadoras,
            $registro->id_operadora,
            ['class'=>'form-control chosen-select',
            'data-placeholder'=>'Seleccione la Operadoras']) !!}
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            {!! Form::label('equipo', 'Equipo:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'equipo',
            $vequipo_componente[0]->equipo,
            ['class'=>'form-control',
            'data-placeholder'=>'ingrese el equipo']) !!}
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            {!! Form::label('serial', 'Serial:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
                'serial',
                $vequipo_componente[0]->serial,
                ['class'=>'form-control', 
            'placeholder'=>'Ingrese el serial']) !!}
       </div> 
        <div class="col-3">
            {!! Form::label('id_equipo_componente', 'ID:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'id_equipo_componente',
            $vequipo_componente[0]->id_equipo_componente,
            ['class'=>'form-control','readonly'=>'readonly']) !!}
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            {!! Form::label('tipo', 'Modelo:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
                'tipo',
                $vequipo_componente[0]->tipo,
                ['class'=>'form-control','readonly'=>'readonly']) !!}
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            {!! Form::label('accesorios', 'Accesorios:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
                'accesorios',
                $vequipo_componente[0]->accesorios,
                ['class'=>'form-control','readonly'=>'readonly']) !!}
        </div>
    </div>

</div>
	
    <div class="row mb-4">
        <div class="col-12">
            {!! Form::label('vfirmante', 'Firmante:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::select(
            'vfirmante',
            $vfirmante,
            $registro->id_firmante,
            ['class'=>'form-control chosen-select',
            'data-placeholder'=>'Seleccione el Firmante']) !!}
        </div>
    </div>

    <hr />

    <div class="row mb-4">
        <div class="col-4">
            {!! Form::label('observacion', 'Observacion:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'observacion',
            $registro->observacion,
            ['class'=>'form-control', 
            'placeholder'=>'Ingrese alguna observacion']) !!}
        </div>
    </div>
    <div class="row mb-4">

        <div class="col-6">
            {!! Form::label('plan', 'Plan:' , ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::select(
            'plan',
            $plan,
            $registro->id_plan,
            ['class'=>'form-control chosen-select',
            'data-placeholder'=>'Seleccione el Plan'])
            !!}
        </div>
    </div>

    <div class="row mb-4 justify-content-center">
        {!! Form::submit("GUARDAR", ['class'=>'btn btn-primary m-2']) !!}
    </div>

    <div>
        <input type="button" value="Imprimir" id="print">
    </div>


    <div id="foot-notificacion">


    </div>
    {!! Form::close() !!}
</div>

<script>
    $(".chosen-select").chosen({
    no_results_text: 'No hay resultados.',
});


/**
 * Para activar la impresora se usa el método (window.print())
 * inner('<h1>Acta de entrega<h1>')
*/

$(document).on('click','#print', function(){window.print()})




</script>

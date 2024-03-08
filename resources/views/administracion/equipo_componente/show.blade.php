{!!Form::open(['url'=>'/equipo_componente','method'=>'post','id'=>'editar_estatus','class'=>'m-4','data-locked'=>'false','data-crud'=>'edit_status'])!!}

{!! Form::hidden('id',$equipo_componente->id_equipo_componente) !!}
<p class="text-center h4">¿Deseas modificar el estatus del componente {{$equipo_componente->descripcion}}?</p>
<p class="text-center display-4">
    {!! Form::submit("SÍ", ['class'=>'btn btn-primary btn-lg']) !!}
    <a class="btn btn-secondary btn-lg" data-dismiss="modal">NO</a>
</p>
<div id="foot-notificacion">

</div>
{!! Form::close() !!}
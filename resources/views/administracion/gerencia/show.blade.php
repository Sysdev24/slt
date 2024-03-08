{!!Form::open(['url'=>'/gerencia','method'=>'post','id'=>'editar_estatus','class'=>'m-4','data-locked'=>'false','data-crud'=>'edit_estatus'])!!}

{!! Form::hidden('id',$gergral->id_gergral) !!}
<p class="text-center h4">¿Deseas eliminar la gerencia {{$gergral->descricion}}?</p>
<p class="text-center display-4">
    {!! Form::submit("SÍ", ['class'=>'btn btn-primary btn-lg']) !!}
    <a class="btn btn-secondary btn-lg" data-dismiss="modal">NO</a>
</p>
<div id="foot-notificacion">

</div>
{!! Form::close() !!}
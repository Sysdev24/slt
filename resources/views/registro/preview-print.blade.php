<html>
<head>

<style type="text/css">
.d { display: inline-block; width: 100px; height: 50px;}

.letras-derecha{
      text-align: right;
    }
    </style>
</head>


<body>
    <img src="{{ asset('img/banner_corpoelec.png') }}" style="max-width:100%;height:10%;">
<table class="letras-derecha" style="width: 100%">
    
        <p class="letras-derecha">  <right> <strong><b>{{$registro->nombre}}</b>,</strong><strong><b>{{$registro->apellido}}</b></strong></right></p>
        <p class="letras-derecha">  <right><strong><b>{{$registro->ci}}</b></strong></right></p>
        <p class="letras-derecha">  <right><strong><b>{{$registro->gerencia}}</b></strong></right></p>
    
</table>
<table style="width: 100%">
    <tr>
        <td colspan="3"> <center><b><h4>ACTA DE ENTREGA</h4></b></center></td>
    </tr>
</table>

<p> En el día de hoy <strong>{{date('d-m-Y', strtotime ($registro->fecha ?? ''))}} </strong>, el ciudadano (a) <strong><b>ING. {{ $registro->nombre_apellido }}</b></strong>, 
titular de la Cédula de Identidad Nº <strong><b>{{$registro->cedula_firmante}}</b></strong>, <strong><b>{{$registro->descripcion_firmante}}</b></strong>. 
Designado mediante el N° <strong><b>{{$registro->resolucion}}</b></strong>, de fecha <strong><b>{{$registro->fecha_resolucion}}</b></strong>,, 
Corporación Eléctrica Nacional, S.A. (CORPOELEC), procedió a levantar acta con el objeto 
de dejar constancia de la entrega del siguiente equipo:
</p>
    <p>
        <strong><b>{{$registro->equipo}}</b></strong>, con el numero <strong><b>{{$registro->nro_tlf}}</b></strong>
    </p>


    <div class="container">
    <br>


<center><p> Entrega Conforme:, </p></center>
    <br><br>
    <center><p><strong>ING. {{ $registro->nombre_apellido }}</strong></p></center>
    <center><p><strong>{{$registro->descripcion_firmante}}</strong></p></center>
    <center><p><strong>Desigmado mediante el Nro.{{$registro->resolucion}}</strong><strong>de fecha {{$registro->fecha_resolucion}}</strong></p></center>

    
    <p>
      Recibe Conforme:
      <br> FIRMA:
      <br> NOMBRE:
      <br> C.I.:
      <br> CARGO:
    </p>
</div>

<header></header>
<img src="{{ asset('img/cintillo_reporte.png') }}" style="max-width:100%;height:5%;">

<footer>
    <table>
      <tr>
        <td>
            
        </td>
      </tr>
    </table>

  </footer>


    
    {{-- No Tocar --}}
   <center> <input type="button" value="Impirmir" id="print"></center>
    <script>
        const $impimirActa = document.querySelector('#print');


        $impimirActa.addEventListener('click', e => {
            window.print();
            window.close();
        });
    </script>
    {{--  --}}
</body>

</html>

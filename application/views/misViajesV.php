<?php if (! isset($_SESSION['email'])){redirect("start");} ?>
<!DOCTYPE html>
<html lang="en" dir="ltr" style="height: 100%">
  <style>
  .enlace.active {
      background-color: #f37277 !important;
  }

  .nav-link{
    color: white;
  }

  .nav-link:hover{
    color: #f37277;
  }

  </style>
  <?php require 'head.php' ?>
  <body style="background-image: url(<?php echo base_url() ?>assets/img/fondo1.png); background-repeat:repeat;height: 100%;">
    <div class="container" style="background: rgba(0,0,0,0.5); box-shadow: 0 0 10px 3px black; min-height: 100%;">
      <?php require 'barraSuperior.php' ?>
      <br>
      <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a style="color: white; background-color: #f37277; border-bottom-color: white" class="nav-link active" id="ofrecidos" data-toggle="tab" href="#listadoOfrecidos" role="tab" aria-controls="listadoOfrecidos" aria-selected="true">Viajes ofrecidos</a>
          </li>
          <li class="nav-item">
            <a style="color: white; background-color: #f37277; border-bottom-color: white" class="nav-link" id="reservas" data-toggle="tab" href="#listadoReservas" role="tab" aria-controls="listadoReservas" aria-selected="false">Viajes como copiloto</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent" style="padding: 5px; border-width: 0px 1px 1px 1px; border-style: solid; border-color: white">
          <!-- Contenido Viajes Ofrecidos -->
          <div class="tab-pane fade show active" id="listadoOfrecidos" role="tabpanel" aria-labelledby="ofrecidos">
            <!-- Filtros por activos o realizados -->
            <nav class="nav nav-pills nav-fill">
              <a class="nav-link active enlace" id="viajesActivos1" data-toggle="list" href="#contenidoViajesActivos1" role="tab" aria-controls="contenidoViajesActivos1">Viajes activos</a>
              <a class="nav-link enlace" id="viajesAnteriores1" data-toggle="list" href="#contenidoViajesAnteriores1" role="tab" aria-controls="contenidoViajesAnteriores1">Viajes anteriores</a>
            </nav>
            <br>
            <!-- Contenido De los filtros -->
            <div class="">
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="contenidoViajesActivos1" role="tabpanel" aria-labelledby="viajesActivos1"></div>
                <div class="tab-pane fade" id="contenidoViajesAnteriores1" role="tabpanel" aria-labelledby="viajesAnteriores1"></div>
              </div>
            </div>
          </div>

          <!-- Contenido Viajes Como Acompañante -->
          <div class="tab-pane fade" id="listadoReservas" role="tabpanel" aria-labelledby="reservas">
            <!-- Filtros por activos o realizados -->
            <nav class="nav nav-pills nav-fill">
              <a class="nav-link active enlace" id="viajesActivos2" data-toggle="list" href="#contenidoViajesActivos2" role="tab" aria-controls="contenidoViajesActivos2">Viajes activos</a>
              <a class="nav-link enlace" id="viajesAnteriores2" data-toggle="list" href="#contenidoViajesAnteriores2" role="tab" aria-controls="contenidoViajesAnteriores2">Viajes anteriores</a>
            </nav>
            <br>
            <!-- Contenido De los filtros -->
            <div class="">
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="contenidoViajesActivos2" role="tabpanel" aria-labelledby="viajesActivos2"></div>
                <div class="tab-pane fade" id="contenidoViajesAnteriores2" role="tabpanel" aria-labelledby="viajesAnteriores2"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script>
    function cargarViajesOfrecidosActivos(){
      $.ajax({
          url: "misViajesC/viajesOfrecidosActivos/",
          type: "POST",
          data: {},
          success: function(respuesta){
            $('#contenidoViajesActivos1').html(respuesta);
          }
      });
    }
  </script>
  <script>
    function cargarViajesOfrecidosRealizados(){
      $.ajax({
          url: "misViajesC/viajesOfrecidosRealizados/",
          type: "POST",
          data: {},
          success: function(respuesta){
            $('#contenidoViajesAnteriores1').html(respuesta);
          }
      });
    }
  </script>
  <script>
    function cargarViajesComoAcompañanteActivos(){
      $.ajax({
          url: "misViajesC/viajesComoAcompananteActivos/",
          type: "POST",
          data: {},
          success: function(respuesta){
            $('#contenidoViajesActivos2').html(respuesta);
          }
      });
    }
  </script>
  <script>
    function cargarViajesComoAcompañanteRealizados(){
      $.ajax({
          url: "misViajesC/viajesComoAcompananteRealizados/",
          type: "POST",
          data: {},
          success: function(respuesta){
            $('#contenidoViajesAnteriores2').html(respuesta);
          }
      });
    }
  </script>
  <script>
    window.addEventListener('load', cargarViajesOfrecidosActivos);
    window.addEventListener('load', cargarViajesOfrecidosRealizados);
    window.addEventListener('load', cargarViajesComoAcompañanteActivos);
    window.addEventListener('load', cargarViajesComoAcompañanteRealizados);
  </script>
  <?php require 'scripts.php' ?>
</html>

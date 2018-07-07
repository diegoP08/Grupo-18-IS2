<!DOCTYPE html>
<html lang="en" dir="ltr" style="height: 100%">
  <?php require 'head.php' ?>
  <body style="background-image: url(<?= base_url() ?>assets/img/fondo1.png); background-repeat:repeat;height: 100%;">
    <div class="container" style="background: rgba(0,0,0,0.5); box-shadow: 0 0 10px 3px black; min-height: 100%;">
      <?php require 'barraSuperior.php' ?>
      <br>
      <br>
      <div class="row justify-content-center" style="color:white">
        <div class="col justify-content-center">
          <h1 align="center">BUSCAS UN VIAJE?</h1>
          <h3 align="center">Encontrá Tu Lugar, Viaja De Forma Segura Y Económica</h3>
        </div>
      </div>
      <br>
      <div class="row justify-content-center" style="color:white">
        <div class="col">
          <div class="" id="alerta"></div>
          <form id="formularioBusqueda" method="post" action="return false" onsubmit="return false">
            <div class="form-row">
              <div class="col">
                <label for="origen">Desde:</label>
                <input style="height: 40px" id="origen" type="text" class="form-control" name="origen">
              </div>
              <div class="col">
                <label for="destino">Hasta:</label>
                <input style="height: 40px" id="destino" type="text" class="form-control" name="destino">
              </div>
              <div class="col" style="padding-bottom: 2px">
                <label for="origen">Fecha de salida:</label>
                <input style="height: 40px" id="fechaSalida" type="date" class="form-control" min="<?php echo date('Y-m-d') ?>" name="fechaSalida">
              </div>
              <div class="col">
                <label for="marca">Marca vehiculo:</label>
                <input placeholder="Ingrese una marca" style="height: 40px" id="marca" type="text" class="form-control" name="marca">
              </div>
              <div class="col">
                <label for="mdoelo">Modelo vehiculo:</label>
                <input placeholder="Ingrese un modelo" style="height: 40px" id="modelo" type="text" class="form-control" name="modelo">
              </div>
              <button type="button" style="margin-left: 5px; margin-top: 32px ;height: 40px; background-color: #f37277; border-color:#f37277" class="btn btn-primary" onclick="comprobar()">Buscar</button>
            </div>
          </form>
        </div>
      </div>
      <br>
      <div class="container" style="color: white">
        <h3 align="center">Viajes que podrian interesarte</h3>
        <br>
        <?php foreach ($viajes as $viaje): ?>
          <div style="cursor:pointer" onclick="location.href='<?= site_url('/verViajeC/cargarViaje/') , $viaje->id; ?>'" >
            <table class="table table-striped table-dark table-bordered" style="box-shadow: 0px 0px 10px 4px black;">
              <tbody href="">
                <tr>
                  <th scope="row"><img src=<?php echo base_url() ,  '/assets/img/locationSalida.png';?> style="height: 15px; margin-bottom: 4px">Desde</th>
                  <td colspan="5"><?php echo $viaje->salida; ?></td>
                </tr>
                <tr>
                  <th scope="row"><img src=<?php echo base_url() ,  '/assets/img/locationLlegada.png';?> style="height: 15px; margin-bottom: 4px">Hasta</th>
                  <td colspan="5"><?php echo $viaje->destino; ?></td>
                </tr>
                <tr>
                  <th scope="row"><img src=<?php echo base_url() ,  '/assets/img/calendarioFecha.png';?> style="height: 15px; margin-bottom: 4px; margin-right: 2px">Fecha de Salida</th>
                  <td><?php echo date( "d-m-Y", strtotime($viaje->fechaHoraSalida)); ?></td>
                  <th scope="row">Hora de salida</th>
                  <td><?php echo date( "H:i", strtotime( $viaje->fechaHoraSalida)).' hs'; ?></td>
                  <th scope="row">Duracion</th>
                  <td><?php  $duracion= (new DateTime($viaje->fechaHoraLlegada))->diff(new DateTime($viaje->fechaHoraSalida));
                          echo (($duracion->format("%a") * 24) + $duracion->format("%H")) . ":" . $duracion->format("%I"); ?></td>
                </tr>
                <tr>
                  <th scope="row"><img src=<?php echo base_url() ,  '/assets/img/simboloPesos.png';?> style="height: 15px; margin-bottom: 4px; margin-right: 2px">Costo del viaje</th>
                  <td colspan="5"><?php echo round($viaje->monto /(($viaje->cupo) + 1), 2); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        <?php endforeach; ?>
        <br>
      </div>
    </div>
  </body>
  <?php require 'scripts.php' ?>
  <script>
    var originAutocomplete
    var destinationAutocomplete
    // Carga autocompletado de los campos origen y destino
    function initMap() {
      var originInput = document.getElementById('origen');
      var destinationInput = document.getElementById('destino');
      var options = {
        types: ['(cities)'],
        componentRestrictions: {country: 'ar'}
      };

      originAutocomplete = new google.maps.places.Autocomplete(
          originInput,options);
      destinationAutocomplete = new google.maps.places.Autocomplete(
          destinationInput, options);
    }
    // Ejecuta la logica para buscar una publicacion
    // Controla antes de llamar si ingresaron origen, destino, fecha.
    function comprobar(){
      var origen = originAutocomplete.getPlace();
      var destino = destinationAutocomplete.getPlace();
      var fechaSalida = $("#fechaSalida").val();
      if(((origen) && (! destino)) || ((! origen) && (destino)) || ((! origen) && (! destino) && (fechaSalida))){
        $("#alerta").html('<div class="alert alert-danger">Ingrese los campos obligatorios</div>');
      }else{
        var nombreOrigen = null;
        var nombreDestino = null;
        if (origen && destino) {
          nombreOrigen = origen.formatted_address;
          nombreDestino = destino.formatted_address;
        }
        $("#origen").val(nombreOrigen);
        $("#destino").val(nombreDestino);
        $("#formularioBusqueda").attr({'action':'./buscarViajeC/buscar/1'});
        document.getElementById("formularioBusqueda").submit();
      }
    }
  </script>
  <script>

  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDZPHHY5uywExSQOzG0dEwv7ngg33WDEE&libraries=places&callback=initMap" async defer></script>
</html>

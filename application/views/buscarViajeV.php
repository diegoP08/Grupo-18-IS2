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
        <div class="col-8">
          <div class="" id="alerta"></div>
          <form class="" action="return false" method="post">
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
                <input id="fechaSalida" type="date" class="form-control" min="<?php echo date('Y-m-d') ?>" name="fechaSalida">
              </div>
              <button style="margin-left: 5px; margin-top: 32px ;height: 40px; background-color: #f37277; border-color:#f37277" class="btn btn-primary" onclick="comprobar()">Buscar</button>
            </div>
          </form>
        </div>
      </div>
      <br>
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
    // Ejecuta la logica para realizar una publicacion
    // Controla antes de llamar si ingresaron origen, destino, fecha, hora, duracionHrs y duracionMin para poder formatearlos.
    function comprobar(){
      var origen = originAutocomplete.getPlace();
      var destino = destinationAutocomplete.getPlace();
      var fecha = $("#fechaSalida").val();
      if(((origen) && (! destino)) || ((! origen) && (destino))){
        $("#alerta").html('<div class="alert alert-danger">Ingrese los campos obligatorios</div>');
      }else{
        var nombreOrigen = origen.formatted_address;
        var nombreDestino = destino.formatted_address;
        if(! fecha){ // si es diaria, la fecha sera la de Hoy
          var f = new Date();
          var m = f.getMonth() + 1;
          var mes = (m < 10) ? '0' + m : m;
          fecha = f.getFullYear() + "-" + mes + "-" + f.getDate();
        }
        var fechaHoraSalida = fecha + " " + hora + ":00";
        var descripcion = $('#descripcion').val();
        $.ajax({
            url: "publicarViajeC/publicar",
            type: "POST",
            data: {fechaHoraSalida: fechaHoraSalida, salida: nombreOrigen, destino: nombreDestino,
                   cupo: cupo, matricula: matricula, monto: monto, descripcion: descripcion,
                   duracionHrs: duracionHrs,duracionMin: duracionMin, lugaresDisponibles: cupo, tipo: tipo},
            success: function(respuesta){
              if (respuesta == 'exito') {
                $("#alerta").html('<div class="alert alert-success">Viaje publicado correctamente. Seras redirigido al inicio en 5 segundos</div>');
                window.setTimeout(function(){window.location.href = "http://localhost/unaventon/index.php/inicioC";}, 5000);
              }else{
                $("#alerta").html(respuesta);
              }
            }
        });
      }
    }
  </script>
  <script>

  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDZPHHY5uywExSQOzG0dEwv7ngg33WDEE&libraries=places&callback=initMap" async defer></script>
</html>

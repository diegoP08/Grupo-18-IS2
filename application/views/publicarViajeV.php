<?php if (! isset($_SESSION['email'])){redirect("start");} ?>
<!DOCTYPE html>
<html lang="en" dir="ltr" style="height:100%">
    <?php require "head.php" ?>
  <body style="background-image: url(<?php echo base_url() ?>assets/img/fondo1.png); background-repeat:repeat;height: 100%;">
    <div class="container" style="background: rgba(0,0,0,0.5); box-shadow: 0 0 10px 3px black; min-height: 100%;">
      <?php require "barraSuperior.php" ?>
      <div class="container clearfix">
        <h3 align="center" style="color: white">Ingrese los datos de su publicación</h3>
        <br>
        <div class="col" style="padding-right: 100px; padding-left: 100px; color:white">
          <form action="" method="post">
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="salida" class="mb-0">Desde:</label>
                  <small class="form-text mt-0">Seleccione una ciudad de las recomendadas en los campos de selección</small>
                  <input type="text" class="form-control" id="salida" name="salida" required>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="destino" class="mb-0">Hasta:</label>
                  <small class="form-text mt-0">Seleccione una ciudad de las recomendadas en los campos de selección</small>
                  <input type="text" class="form-control" id="destino" name="destino" required>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-3">
                <div class="form-group">
                  <label for="fecha">Fecha de salida:</label>
                  <input type="date" class="form-control" id="fecha" name="fecha" required>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label for="hora">Hora de salida:</label>
                  <input type="time" class="form-control" id="hora" name="hora" required>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Duracion:</label>
                  <div class="row">
                    <div class="col-5">
                      <input type="number" class="form-control" id="duracionHrs" name="duracionHrs" max="72" required>
                    </div>
                    <h6 class="align-self-center">hrs</h6>
                    <div class="col-5">
                      <input type="number" class="form-control" id="duracionMin" name="duracionMin" max="59" required>
                    </div>
                    <h6 class="align-self-center">min</h6>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-4">
                <label for="costo">Costo total del viaje:</label>
                <input type="number" class="form-control" id="costo" name="costo" required>
              </div>
              <div class="col-4">
                <label for="matricula">Vehiculo: </label>
                <select class="custom-select" id="matricula">
                  <option selected>Seleccione un vehiculo</option>
                  <!--<option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>-->
                  <div id="listaDeMatriculas"> </div>
                </select>
              </div>
              <div class="col-4" style="display: none">
                <label for="cupo">Lugares disponibles:</label>
                <input type="number" class="form-control" id="cupo" name="cupo" required>
              </div>
            </div>
            <br>
            <div class="form-group" style="color:white">
                <label for="descripcion" class="mb-0">Descripción de tu publicación:</label>
                <small class="form-text mt-0">Puede ingresar datos adicionales del vehiculo, si quiere que sus pasajeros sean puntuales, etc</small>
                <textarea name="descripcion" class="form-control"></textarea>
            </div>
            <br>
          </form>
          <div class="" id="notificacion"></div>
          <div class="row justify-content-center">
            <button  style="background-color: #f37277; border-color:#f37277" class="btn btn-primary" onclick="comprobar()" name="button">Publicar Viaje</button>
          </div>
          <br>
        </div>
      </div>

      <script>
        var originAutocomplete
        var destinationAutocomplete
        function initMap() {
          var originInput = document.getElementById('salida');
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
        function comprobar(){
          var origen = originAutocomplete.getPlace();
          var destino = destinationAutocomplete.getPlace();
          if((!origen) || (! destino)){
            window.alert("Ingrese destino y origen")
          }else{
            var nombreOrigen = origen.formatted_address;
            var nombreDestino = destino.formatted_address;
            var fecha = $("#fecha").val();
            var hora = $('#hora').val();
            var duracionHrs = $('#duracionHrs').val();
            var duracionMin = $('duracionMin').val();
            var costo = $('costo').val();
            var cupo = $('cupo').val();
            var matricual = $('matricual').val();
            var descripcion = $('descripcion').val();
            $.ajax({
                url: "publicarViajeC/publicar",
                type: "POST",
                data: {origen: nombreOrigen, destino: nombreDestino},
                success: function(respuesta){
                  if(respuesta){
                    window.alert("hay respuesta");
                  }else{
                    window.alert("no hay respuesta");
                  }
                  console.log(respuesta);
                }
            });
          }
        }
      </script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDZPHHY5uywExSQOzG0dEwv7ngg33WDEE&libraries=places&callback=initMap" async defer></script>
      <script>
        function cargarMatriculas(){
          $.ajax({
              url: "vehiculosC/listaDeMatriculas",
              type: "POST",
              data: {},
              success: function(respuesta){
                document.getElementById("listaDeMatriculas").innerHTML = respuesta;
              }
          });
        }
      </script>
      <script> //Carga la lista de matriculas cuando se carga la pagina
        window.onload = cargarMatriculas;
      </script>
      <?php require "scripts.php" ?>
    </div>
  </body>
</html>

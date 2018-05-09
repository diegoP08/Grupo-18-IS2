<!DOCTYPE html>
<html lang="en" dir="ltr">
    <?php require "head.php" ?>
  <body>
    <?php require "barraSuperior.php" ?>
    <br>
    <h3 align="center">Ingrese los datos de su publicación</h3>
    <div class="container">
      <br>
      <div class="col" style="padding-right: 100px; padding-left: 100px;">
        <form>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="salida" class="mb-0">Desde:</label>
                <small class="form-text text-muted mt-0">Seleccione una ciudad de las recomendadas en los campos de selección</small>
                <input type="text" class="form-control" id="salida" required>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="destino" class="mb-0">Hasta:</label>
                <small class="form-text text-muted mt-0">Seleccione una ciudad de las recomendadas en los campos de selección</small>
                <input type="text" class="form-control" id="destino" required>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-3">
              <div class="form-group">
                <label for="fecha">Fecha de salida:</label>
                <input type="date" class="form-control" id="fecha" required>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label for="hora">Hora de salida:</label>
                <input type="time" class="form-control" id="hora" required>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Duracion:</label>
                <div class="row">
                  <div class="col-5">
                    <input type="number" class="form-control" id="duracionHrs" max="72" required>
                  </div>
                  <h6 class="align-self-center">hrs</h6>
                  <div class="col-5">
                    <input type="number" class="form-control" id="duracionMin" max="59" required>
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
              <input type="number" class="form-control" id="costo" required>
            </div>
            <div class="col-4">
              <label for="cupo">Lugares disponibles:</label>
              <input type="number" class="form-control" id="cupo" required>
            </div>
            <div class="col-4">
              <label for="matricula">Matricula del vehículo:</label>
              <input type="text" class="form-control" id="matricula" required>
            </div>
          </div>
        </form>
        <br>
        <div class="" id="notificacion"></div>
        <div class="row justify-content-center">
            <button  class="btn btn-primary" onclick="comprobar()" name="button">Publicar Viaje</button>
        </div>
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
          window.alert("todo bien hasta aca " + origen.formatted_address + " " + destino.formatted_address)
        }
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDZPHHY5uywExSQOzG0dEwv7ngg33WDEE&libraries=places&callback=initMap" async defer></script>
  </body>
</html>

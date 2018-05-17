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
          <form id="formulario" action="return false" method="post" onsubmit="return false">
            <div class="row">
              <div class="col-4">
                <div style="color: #FF0000; display:inline-block">*</div>
                <label for="tipo">Regularidad: </label>
                <select class="custom-select" id="tipo" onchange="extenderFormulario(value)">
                  <option value="" disabled selected>Seleccione Regularidad</option>
                  <option value="diaria">Diaria</option>
                  <option value="ocasional">Ocasional</option>
                </select>
              </div>
            </div>
            <br>
            <div id="extensionDelFormulario"></div>
          </form>
        </div>
      </div>

      <script>
        var originAutocomplete
        var destinationAutocomplete
        // Carga autocompletado de los campos origen y destino
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
        // Ejecuta la logica para realizar una publicacion
        // Controla antes de llamar si ingresaron origen, destino, fecha, hora, duracionHrs y duracionMin para poder formatearlos.
        function comprobar(){
          var origen = originAutocomplete.getPlace();
          var destino = destinationAutocomplete.getPlace();
          var fecha = $("#fecha").val();
          var hora = $('#hora').val();
          var duracionHrs = $('#duracionHrs').val();
          var duracionMin = $('#duracionMin').val();
          var tipo = $("#tipo").val();
          var monto = $('#costo').val();
          var matricula = $('#matricula').val();
          var cupo = $('#cupo').val();
          if((! origen) || (! destino) || ((tipo == "ocasional") && (! fecha)) || (! hora) || (! duracionHrs) || (! duracionMin) || (! monto) || (! matricula) || (! cupo)){
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
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDZPHHY5uywExSQOzG0dEwv7ngg33WDEE&libraries=places" async defer></script>
      <script>
      // carga la lista de matriculas en el selector del formulario
        function cargarMatriculas(){
          $.ajax({
              url: "vehiculosC/listaDeMatriculas",
              type: "POST",
              data: {},
              success: function(respuesta){
                $( "#matricula" ).append(respuesta);
              }
          });
        }
      </script>
      <script>
      // Habilita el campo de cupo y pone como maximo las asientos del vehiculo
        function hablilitarCupo(matricula){
          $.ajax({
              url: "vehiculosC/obtenerCapacidadVehiculo",
              type: "POST",
              data: {matricula: matricula},
              success: function(capacidad){
                $("#capacidad").css({display: "block"});
                $("#cupo").attr({max: capacidad});
              }
          });
        }
      </script>
      <script>
      //extiende el formulario segun el tipo de publicacion que se elija y habilita el autocompletado
        function extenderFormulario(tipoPublicacion){
          $.ajax({
              url: "publicarViajeC/obtenerFormulario",
              type: "POST",
              data: {tipoPublicacion: tipoPublicacion},
              success: function(formulario){
                $("#extensionDelFormulario").html(formulario);
                initMap();
                cargarMatriculas();
              }
          });
        }
      </script>
      <?php require "scripts.php" ?>
    </div>
  </body>
</html>

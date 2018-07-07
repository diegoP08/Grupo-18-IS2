<!DOCTYPE html>
<html lang="en" dir="ltr" style="height: 100%">
  <?php require 'head.php' ?>
  <body style="background-image: url(<?php echo base_url() ?>assets/img/fondo1.png); background-repeat:repeat;height: 100%;">
    <div class="container" style="background: rgba(0,0,0,0.5); box-shadow: 0 0 10px 3px black; min-height: 100%;">
      <?php require 'barraSuperior.php' ?>
      <div class="row justify-content-center" style="color:white">
        <div class="col">
          <div id="alerta"></div>
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
                <label for="modelo">Modelo vehiculo:</label>
                <input placeholder="Ingrese un modelo" style="height: 40px" id="modelo" type="text" class="form-control" name="modelo">
              </div>
              <button type="button" style="margin-left: 5px; margin-top: 32px ;height: 40px; background-color: #f37277; border-color:#f37277" class="btn btn-primary" onclick="comprobar()">Buscar</button>
            </div>
          </form>
        </div>
      </div>
      <div class="container">
        <div style="color: white">
          <form id="formularioFiltros" class="form-inline" style="margin-top: 10px" action="return false" method="post">
            <label for="porFecha">Ordenar por fecha salida: </label>
            <select class="form-control form-control-sm" style="margin-left: 10px" id="porFecha">
              <option <?= ($ordenPorFecha == 'Mayor') ? 'selected' : '' ; ?> >Mayor</option>
              <option <?= ($ordenPorFecha == 'Menor') ? 'selected' : '' ; ?> >Menor</option>
              <option <?= ($ordenPorFecha == 'Ninguna') ? 'selected' : '' ; ?> >Ninguna</option>
            </select>
            <label for="porCosto" style="margin-left: 10px">Ordenar por costo: </label>
            <select class="form-control form-control-sm" style="margin-left: 10px" id="porCosto">
              <option <?= ($ordenPorMonto == 'Mayor') ? 'selected' : '' ; ?> >Mayor</option>
              <option <?= ($ordenPorMonto == 'Menor') ? 'selected' : '' ; ?> >Menor</option>
              <option <?= ($ordenPorMonto == 'Ninguna') ? 'selected' : '' ; ?> >Ninguna</option>
            </select>
            <button onclick="filtrar()" type="button" class="btn btn-primary btn-sm" style="margin-left: 5px; background-color: #f37277; border-color:#f37277">Filtrar</button>
          </form>
        </div>
      </div>
      <br>
      <div class="container">
        <?php if (count($viajes) == 0): ?>
          <div class="alert alert-danger">No hay viajes disponibles</div>
        <?php endif; ?>
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
      </div>
      <div class="container">
        <div class="row justify-content-center">
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item">
                <a class="page-link" onclick="cambiarPagina(<?= (($pagina > 1) ? ($pagina - 1) : 1) ?>)" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Previous</span>
                </a>
              </li>
              <li class="page-item active"><a class="page-link" onclick="cambiarPagina(<?= $pagina ?>)"><?= $pagina ?></a></li>
              <li class="page-item <?= (($pagina + 1) > $maxPag) ? 'disabled' : '' ; ?>"><a class="page-link" onclick="cambiarPagina(<?= $pagina + 1 ?>)"><?= $pagina + 1 ?></a></li>
              <li class="page-item <?= (($pagina + 2) > $maxPag) ? 'disabled' : '' ; ?>"><a class="page-link" onclick="cambiarPagina(<?= $pagina + 2 ?>)"><?= $pagina + 2 ?></a></li>
              <li class="page-item">
                <a class="page-link" onclick="cambiarPagina(<?= (($pagina < $maxPag) ? ($pagina + 1) : $pagina) ?>)" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Next</span>
                </a>
              </li>
            </ul>
          </nav>
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
        $("#formularioBusqueda").attr({'action':"<?= site_url('/buscarViajeC/buscar/1')  ?>"});
        document.getElementById("formularioBusqueda").submit();
      }
    }
  </script>
  <script>
    //Ejecuta la logica para mostrar los resultados de la siguiente pagina
    function cambiarPagina(pagina){
      var fechaSalida = "<?= $fechaSalida  ?>";
      var nombreOrigen = "<?= $origen  ?>";
      var nombreDestino = "<?= $destino  ?>";
      var ordenPorFecha = "<?= $ordenPorFecha  ?>";
      var ordenPorMonto = "<?= $ordenPorMonto  ?>";
      var marca = "<?= $marca  ?>";
      var modelo = "<?= $modelo  ?>";
      $("#origen").val(nombreOrigen);
      $("#destino").val(nombreDestino);
      $("#fechaSalida").val(fechaSalida);
      $("#marca").val(marca);
      $("#modelo").val(modelo);
      $("#formularioBusqueda").attr({'action': "<?= site_url('/buscarViajeC/buscar/')?>" + pagina + "/" + ordenPorFecha + "/" + ordenPorMonto});
      document.getElementById("formularioBusqueda").submit();
    }
  </script>
  <script>
  // Ejecuta la logica para filtrar los resultados de una busqueda
    function filtrar(){
      var fechaSalida = "<?= $fechaSalida  ?>";
      var nombreOrigen = "<?= $origen  ?>";
      var nombreDestino = "<?= $destino  ?>";
      var ordenPorFecha = $('#porFecha').val();
      var ordenPorMonto = $('#porCosto').val();
      var marca = "<?= $marca  ?>";
      var modelo = "<?= $modelo  ?>";
      $("#origen").val(nombreOrigen);
      $("#destino").val(nombreDestino);
      $("#fechaSalida").val(fechaSalida);
      $("#marca").val(marca);
      $("#modelo").val(modelo);
      $("#formularioBusqueda").attr({'action': "<?= site_url('/buscarViajeC/buscar/' . $pagina) . '/' ?>" + ordenPorFecha + "/" + ordenPorMonto});
      document.getElementById("formularioBusqueda").submit();
    }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDZPHHY5uywExSQOzG0dEwv7ngg33WDEE&libraries=places&callback=initMap" async defer></script>
</html>

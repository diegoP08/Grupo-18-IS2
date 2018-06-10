<?php if (! isset($_SESSION['email'])){redirect("start");} ?>
<!DOCTYPE html>
<html lang="en" dir="ltr" style="height:100%">
  <?php require 'head.php' ?>
  <body style="background-image: url(<?php echo base_url() ?>assets/img/fondo1.png); background-repeat:repeat;height: 100%;">
    <div class="container" style="background: rgba(0,0,0,0.5); box-shadow: 0 0 10px 3px black; min-height: 100%;">
      <?php require 'barraSuperior.php' ?>
      <br>
      <div class="container" id="mensaje"></div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12" style="color: white">
            <!-- ENCABEZADO DE LA LISTA, OSEA PESTAÑAS -->
            <ul class="nav nav-tabs" style="border-bottom-width:0px" id="tab" role="tablist">

              <li class="nav-item">
                <a style="color: white; background-color: #f37277; border-bottom-color: white" class="nav-link active" id="vehiculos" data-toggle="tab" href="#listaVehiculos" role="tab" aria-selected="true">Vehiculos</a>
              </li>

              <li class="nav-item">
                <a style="color: white; background-color: #f37277; border-bottom-color: white" class="nav-link" id="anadirVehiculo" data-toggle="tab" href="#formulario" role="tab" aria-selected="false">Añadir Vehiculo</a>
              </li>

              <li class="nav-item" id="modificarVehiculo" style="display: none">
                <a id ="modificarVehi"style="color: white; background-color: #f37277; border-color: white" class="nav-link" data-toggle="tab" href="#modificacion" role="tab" aria-selected="false">Modificar Vehiculo</a>
              </li>
            </ul>

            <div class="tab-content" id="contenido">

              <div style="overflow-y:scroll; border-width: 1px; border-style: solid;height: 530px" class="tab-pane active" id="listaVehiculos" role="tabpanel" ></div>

              <div style="border-width: 1px; border-style: solid; height: 530px" class="tab-pane fade" id="formulario" role="tabpanel" aria-labelledby="profile-tab"></div>
              <br>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  <?php require 'scripts.php' ?>
  <script>
  //Actualiza la listaVehiculos cuando se da click a la pestaña y cierra pestaña modificar si esta abierta
    $('#tab li:nth-child(1) a').on('click', function (e) {
      e.preventDefault();
      $.ajax({
          url: "vehiculosC/listaDeVehiculos",
          type: "POST",
          data: {},
          success: function(respuesta){
            document.getElementById("listaVehiculos").innerHTML = respuesta;
            document.getElementById('modificarVehiculo').style.display = 'none';
            document.getElementById("listaVehiculos").style.overflowY = "scroll";
          }
      });
      //$(this).tab('show');
    })
  //Resetea/actualiza el formulario cuando se da click a la pestaña y cierra pestaña modificar si esta abierta.
    $('#tab li:nth-child(2) a').on('click', function (e) {
      e.preventDefault();
      $.ajax({
          url: "vehiculosC/obtenerFormularioAnadir",
          type: "POST",
          data: {},
          success: function(respuesta){
            document.getElementById('modificarVehiculo').style.display = 'none';
            document.getElementById("listaVehiculos").style.overflowY = "scroll";
            document.getElementById("formulario").innerHTML = respuesta;
          }
      });
      //$(this).tab('show');
    })
  </script>
  <script> //Muestra una alerta con el texto que recibe
    function mostrarMensaje(mensaje){
      $("#mensaje").html(mensaje);
      $(document).ready(function() {
          setTimeout(function() {
              $("#mensaje").fadeIn(0);
          },0001);
      });
      $(document).ready(function() {
          setTimeout(function() {
              $("#mensaje").fadeOut(1500);
          },3000);
      });
    }
  </script>
  <script> // Ejecuta la logica para añadir un vehiculo al usuario
    function anadirVehiculo(){
      var matricula = $("#matricula").val();
      var marca = $("#marca").val();
      var modelo = $("#modelo").val();
      var asientos = $('#asientos').val();
      $.ajax({
          url: "vehiculosC/anadir",
          type: "POST",
          data: {matricula: matricula, marca: marca, modelo: modelo, asientos: asientos},
          success: function(respuesta){
            if (respuesta == 'exito') {
              $('#tab li:first-child a').tab('show');
              recargarLista();
              mostrarMensaje('<div class="alert alert-success fixed-top" style="text-align: center">El vehiculo se añadio correctamente</div>');
            }else{
              document.getElementById("alerta").innerHTML = respuesta;
            }
          }
      });
    }
  </script>
  <script> // Recarga la listaVehiculos
    function recargarLista(){
      $.ajax({
          url: "vehiculosC/listaDeVehiculos",
          type: "POST",
          data: {},
          success: function(respuesta){
            document.getElementById("listaVehiculos").innerHTML = respuesta;
          }
      });
    }
  </script>
  <script> //modifica el boton del modal para eliminar el vehiculo correspondiente
    function modificarModal(id){
      document.getElementById("botonConfirmarEliminacion").onclick = function(){ eliminar(id) };
    }
  </script>
  <script> //Ejecuta la logica para eliminar un vehiculo al usuario
    function eliminar(id){
      $.ajax({
          url: "vehiculosC/eliminarVehiculo",
          type: "POST",
          data: {id: id},
          success: function(respuesta){
            if(respuesta == 'tieneViajesActivos'){
              mostrarMensaje('<div class="alert alert-danger fixed-top" style="text-align: center">El vehiculo posee viajes activos</div>');
            }else{
              recargarLista();
              mostrarMensaje('<div class="alert alert-success fixed-top" style="text-align: center">El vehiculo se elimino correctamente</div>');
            }
          }
      });
    }
  </script>
  <script> //Carga el formulario de modificacion
  function cargarFormularioModificacion(id){
    document.getElementById("vehiculos").classList.remove("active");
    document.getElementById('modificarVehiculo').style.display = 'block';
    $.ajax({
        url: "vehiculosC/obtenerFormularioModificacion/",
        type: "POST",
        data: {id: id},
        success: function(respuesta){
          document.getElementById("listaVehiculos").style.overflowY = "visible";
          document.getElementById("listaVehiculos").innerHTML = respuesta;
        }
    });
  }
  </script>
  <script> //Ejecuta la logica para modificar un vehiculo
    function modificarVehiculo(id){
      var matricula = $("#matriculaM").val();
      var marca = $("#marcaM").val();
      var modelo = $("#modeloM").val();
      var asientos = $("#asientosM").val();
      $.ajax({
          url: "vehiculosC/modificarVehiculo/",
          type: "POST",
          data: {id: id, matricula: matricula, marca: marca, modelo: modelo, asientos: asientos},
          success: function(respuesta){
            if (respuesta == "exito"){
              document.getElementById("vehiculos").classList.add("active");
              document.getElementById("modificarVehiculo").style.display = 'none';
              document.getElementById("listaVehiculos").style.overflowY = "scroll";
              recargarLista();
              mostrarMensaje('<div class="alert alert-success fixed-top" style="text-align: center">El vehiculo se modifico correctamente</div>');
            }else{
              document.getElementById("alertaM").innerHTML = respuesta;
            }
          }
      });

    }
  </script>
  <script> //Carga la lista de vehiculos cuando se carga la pagina
    window.onload = recargarLista;
  </script>
</html>

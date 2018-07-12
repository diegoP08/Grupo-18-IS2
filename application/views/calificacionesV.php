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
      <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a style="color: white; background-color: #f37277; border-bottom-color: white" class="nav-link active" id="copilotos" data-toggle="tab" href="#listadoCopilotos" role="tab" aria-controls="listadoCopilotos" aria-selected="true">Calificar copilotos</a>
          </li>
          <li class="nav-item">
            <a style="color: white; background-color: #f37277; border-bottom-color: white" class="nav-link" id="conductores" data-toggle="tab" href="#listadoConductores" role="tab" aria-controls="listadoConductores" aria-selected="false">Calificar conductores</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent" style="padding: 5px; border-width: 0px 1px 1px 1px; border-style: solid; border-color: white">
          <!-- Calificaciones para copilotos (Contenido) -->
          <div align="center" class="tab-pane fade show active" id="listadoCopilotos" role="tabpanel" aria-labelledby="copilotos"></div>

          <!-- Calificaciones para conductores (Contenido) -->
          <div align="center" class="tab-pane fade" id="listadoConductores" role="tabpanel" aria-labelledby="conductores">
        </div>
      </div>
    </div>
    <!-- Modal calificar usuario -->
    <div class="modal fade" style="color: black" id="mensajeCalificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title"style="margin-left: auto;">Calificar usuario</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body" align="center">
           Por favor confirme su calificación, puede añadir un comentario a la misma
           <br>
           <br>
           <textarea id="comentario" rows="8" style="resize: none; width: 100%; height: 143px;"></textarea>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-outline-success" data-dismiss="modal" id="botonCalificar">Confirmar</button>
         </div>
       </div>
     </div>
    </div>
    <div id="mensaje"></div>
  </body>
  <?php require 'scripts.php' ?>
  <script>
    function cargarCalificacionesParaCopilotos(){
      $.ajax({
          url: "calificacionesC/obtenerCalificacionesParaCopilotos/",
          type: "POST",
          data: {},
          success: function(respuesta){
            $('#listadoCopilotos').html(respuesta);
          }
      });
    }
  </script>
  <script>
    function cargarCalificacionesParaConductores(){
      $.ajax({
          url: "calificacionesC/obtenerCalificacionesParaConductores/",
          type: "POST",
          data: {},
          success: function(respuesta){
            $('#listadoConductores').html(respuesta);
          }
      });
    }
  </script>
  <script> //modifica el boton del modal para confirmar una calificacion
    function modificarModal(emailCalificado, idViaje, puntuacion){
      document.getElementById("botonCalificar").onclick = function(){ calificar(emailCalificado,idViaje,puntuacion) };
    }
  </script>
  <script>
    function calificar(emailCalificado,idViaje,puntuacion){ // ejecuta la logica para calificar un usuario
      var comentario = $("#comentario").val();
      $.ajax({
          url: "calificacionesC/calificarUsuario/",
          type: "POST",
          data: {emailCalificado: emailCalificado, idViaje: idViaje, puntuacion: puntuacion, comentario: comentario},
          success: function(respuesta){
            mensaje('<div class="alert alert-success fixed-top" style="text-align: center">Calificacion realizada correctamente</div>');
            cargarCalificacionesParaCopilotos();
            cargarCalificacionesParaConductores();
            $("#comentario").val('');
          }
      });
    }
  </script>
  <script> //Muestra una alerta con el texto que recibe
    function mensaje(mensaje){
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
  <script>
    window.addEventListener('load', cargarCalificacionesParaCopilotos);
    window.addEventListener('load', cargarCalificacionesParaConductores);
  </script>
</html>

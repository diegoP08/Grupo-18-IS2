<!DOCTYPE html>
<html lang="en" dir="ltr" style="height:100%">
  <?php require "head.php" ?>
  <body style="background-image: url(<?php echo base_url() ?>assets/img/fondo1.png); background-repeat:repeat;height: 100%;">
      <div class="container" style="background: rgba(0,0,0,0.5); box-shadow: 0 0 10px 3px black; min-height: 100%;">
        <?php require "barraSuperior.php" ?>
        <br>
        <?php
         date_default_timezone_set('America/Argentina/La_Rioja');
               $fechaViaje = new DateTime($fechaSalida);
               $tomorrow = (new DateTime())->add(new DateInterval('P1D'));
               $faltanMasDe24Horas = $fechaViaje > $tomorrow;
        if (!$faltanMasDe24Horas) {
           echo '<div class="alert alert-success" align="center">Al viaje le quedan menos de 24 hs para realizarse o ya fue realizado</div>';
        }elseif ($tieneInscripcion) {
           echo '<div class="alert alert-success" align="center">Bien hecho ! ya estas inscripto a este viaje</div>';
        }
         if ($hayCalificacionesPendientes){
         echo '<div class="alert alert-danger" align="center">No podras inscribirte ya que posees calificaciones pendientes de un viaje de mas de 30 dias</div>';
       }elseif ( $hayViajeSuperpuesto && !$tieneInscripcion) {
           echo '<div class="alert alert-danger" align="center">No podras inscribirte ya que posees viajes superpuestos</div>';
         } ?>

        <div class="container" style="width: 80%">
          <div class="row">
            <table class="table table-striped table-dark table-bordered" style="box-shadow: 0px 0px 10px 4px black">
              <tbody>
                <tr>
                  <th scope="row" style="width: 200px; height: 5px">Conductor</th>
                  <td colspan="5"><?php echo $nombreConductor . ' ' . $apellidoConductor ?></td>
                  <td colspan="2">
              <?php
               if(isset($_SESSION['email'])){
                      if((($_SESSION['email']) != $creador) && (! $tieneInscripcion) && ($faltanMasDe24Horas) && (! $hayCalificacionesPendientes) && (! $hayViajeSuperpuesto)) { ?>
                        <a href="<?php echo base_url() ,'index.php/verViajeC/enviar/', $idViaje ?>" class="btn btn-primary" style="box-shadow: 0px 0px 10px 2px black; background-color: #f37277; border-color:#f37277; " title="Editar">postularme para el viaje</a>
                <?php }else{ ?>
                        <a href="<?php echo base_url() ,'index.php/verViajeC/enviar/', $idViaje ?>" class="btn btn-primary disabled" style="box-shadow: 0px 0px 10px 2px black; background-color: #f37277; border-color:#f37277; " title="Editar">postularme para el viaje</a>
                <?php }
                    }else{ ?>
                      <a href="<?php echo base_url() ,'index.php/verViajeC/enviar/', $idViaje ?>" class="btn btn-primary disabled" style="box-shadow: 0px 0px 10px 2px black; background-color: #f37277; border-color:#f37277; " title="Editar">postularme para el viaje</a>
              <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th scope="row" style="height: 5px">Desde:</th>
                  <td colspan="3"><?php echo $salida; ?></td>
                  <th scope="row">Hasta:</th>
                  <td colspan="3"><?php echo $destino; ?></td>
                </tr>
                <tr>
                  <th scope="row">Fecha de Salida</th>
                  <td colspan="3"><?php echo date( "d-m-Y", strtotime($fechaSalida)); ?></td>
                  <th scope="row">Hora de salida</th>
                  <td><?php echo date( "H:i", strtotime( $fechaSalida)).' hs'; ?></td>
                  <th scope="row">Duracion:</th>
                  <td><?php  $duracion= (new DateTime($fechaLlegada))->diff(new DateTime($fechaSalida));
                          echo (($duracion->format("%a") * 24) + $duracion->format("%H")) . ":" . $duracion->format("%I"); ?></td>
                </tr>
                <tr>
                  <th scope="row">Costo del viaje</th>
                  <td colspan="7"><?php echo round( $monto/($cupo+1) , 2); ?></td>
                </tr>
                <tr>
                  <th scope="row">Patente</th>
                  <td><?php echo $matricula ?></td>
                  <th scope="row">Marca</th>
                  <td colspan="2"><?php echo $marca; ?></td>
                  <th scope="row">Modelo</th>
                  <td colspan="2"><?php echo $modelo; ?></td>
                </tr>
                <tr>
                  <th scope="row">Descripcion</th>
                  <td colspan="7" >
                    <div style="width: 700px; word-wrap: break-word; ">
                      <?php echo $descripcion; ?>
                    </div>
                    </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-9">
              <h3>Comentarios</h3>
              <div class="container" id="mensaje"></div>
              <div class="card card-info" style="background-color: #f37277">
                <div class="card-block" style="padding: 20px;">
                  <textarea id="comentario" <?= (isset($_SESSION['email'])) ? '' : 'disabled' ; ?> placeholder="Deja tu comentario aqui" style="resize: none; padding: 5px; height: 130px; width: 100%; border: 1px solid  #f37277;"></textarea>
                  <form class="form-inline float-right">
                    <button <?= (isset($_SESSION['email'])) ? 'onclick="guardarComentario()"' : 'disabled' ; ?> style="margin-top: 2px" class="btn btn-outline-light" type="button">Comentar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="container" id="listaDeComentarios">
          <?php foreach ($comentarios as $comentario): ?>
            <div class="row justify-content-center">
              <div class="col-9">
                <div class="comment mb-2 row">
                  <div class="comment-avatar col-md-1 col-sm-2 text-center pr-1" style="margin-top: 9px">
                    <img class="mx-auto rounded-circle img-fluid" src="<?= base_url() . 'assets/img/' . $comentario->fotoPerfil ?>">
                  </div>
                  <div class="comment-content col-md-11 col-sm-10">
                    <?php if (isset($_SESSION['email']) &&
                              (($comentario->idCreador == $_SESSION['email']) || ($creador == $_SESSION['email']))): ?>
                      <button type="button" class="close" data-toggle="modal" data-target="#mensajeEliminar" onclick="modificarModal(<?= $comentario->idComentario ?>)">
                        &times;
                      </button>
                    <?php endif; ?>
                    <h6 class="small comment-meta" style="margin-top: 9px">
                      <?= ($comentario->nombre) . ' ' . ($comentario->apellido) ?>,
                      <?= (new DateTime($comentario->fechaHora))->format('d-m-Y H:i') ?>
                    </h6>
                    <div class="comment-body">
                      <p>
                        <?= $comentario->texto ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <!-- Modal -->
        <div class="modal fade" style="color: black" id="mensajeEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
        	 <div class="modal-content">
        		 <div class="modal-header">
        			 <h5 class="modal-title" id="exampleModalLabel">Eliminar comentaio</h5>
        			 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        				 <span aria-hidden="true">&times;</span>
        			 </button>
        		 </div>
        		 <div class="modal-body">
        			 ¿Esta seguro de que desea eliminar este comentario?
        		 </div>
        		 <div class="modal-footer">
        			 <button type="button" class="btn btn-secondar" data-dismiss="modal">Cancelar</button>
        			 <button type="button" class="btn btn-danger" data-dismiss="modal" id="botonConfirmarEliminacion">Eliminar</button>
        		 </div>
        	 </div>
         </div>
        </div>
        <br>
      </div>
  </body>
  <script> //modifica el boton del modal para eliminar el comentario correspondiente
    function modificarModal(id){
      document.getElementById("botonConfirmarEliminacion").onclick = function(){ eliminarComentario(id) };
    }
  </script>
  <script> //Ejecuta la logica para eliminar un comentario de la publicacion
    function eliminarComentario(id){
      $.ajax({
          url: "<?= site_url('verViajeC/eliminarComentario') ?>",
          type: "POST",
          data: {idComentario: id},
          success: function(){
            recargarComentarios();
            mostrarMensaje('<div class="alert alert-success fixed-top" style="text-align: center">El comentario se elimino correctamente</div>');
          }
      });
    }
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
  <script> // Recarga los comentarios
    function recargarComentarios(){
      $.ajax({
          url: "<?= site_url('verViajeC/listaDeComentarios') ?>",
          type: "POST",
          data: {idViaje: <?= $idViaje ?> , creador: "<?= $creador ?>"},
          success: function(respuesta){
            document.getElementById("listaDeComentarios").innerHTML = respuesta;
          }
      });
    }
  </script>
  <script> // Guarda el comentario realizado por el usuario. Recarga la lista.
    function guardarComentario(){
      var texto = $("#comentario").val();
      if (! texto) {
        $("#mensaje").html('<div class="alert alert-danger" style="text-align: center"> Ingrese un texto </div>');
      }else{
        $.ajax({
            url: '<?= site_url('verViajeC/guardarComentario') ?>',
            type: "POST",
            data: {idViaje: <?= $idViaje ?> , texto: texto},
            success: function(respuesta){
              $("#comentario").val("");
              recargarComentarios();
              mostrarMensaje('<div class="alert alert-success fixed-top" style="text-align: center">Comentario realizado correctamente</div>');
            }
        });
      }
    }
  </script>
  <?php require 'scripts.php' ?>
</html>

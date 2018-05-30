<!DOCTYPE html>
<html lang="en" dir="ltr" style="height:100%">
  <?php require "head.php" ?>
  <body style="background-image: url(<?php echo base_url() ?>assets/img/fondo1.png); background-repeat:repeat;height: 100%;">
      <div class="container" style="background: rgba(0,0,0,0.5); box-shadow: 0 0 10px 3px black; min-height: 100%;">
        <?php require "barraSuperior.php" ?>
        <br>
        <div class="container" style="width: 80%">
          <div class="row">
            <table class="table table-striped table-dark table-bordered" style="box-shadow: 0px 0px 10px 4px black">
              <tbody>
                <tr>
                  <th scope="row" style="width: 200px; height: 5px">Conductor</th>
                  <td colspan="5"><?php echo $nombreConductor . ' ' . $apellidoConductor ?></td>
                  <td colspan="2">
                    <?php if(isset($_SESSION['email'])){ 
                       if((($_SESSION['email']) != $creador)||($yaRegistrado  != $_SESSION['email'])){ ?>
                        <button class="btn btn-primary" href="mandarSolicitud" style="background-color: #f37277; border-color:#f37277">Postularme para el viaje</button>
                  <?php }else{ ?>
                      <button class="btn btn-primary disabled" style="background-color: #f37277; border-color:#f37277">Postularme para el viaje</button>
                   <?php } 
                    }else{ ?>
                      <button class="btn btn-primary disabled" style="background-color: #f37277; border-color:#f37277">Postularme para el viaje</button>
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
                  <td colspan="7"><?php echo( $monto/($cupo+1)); ?></td>
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
              <div class="card card-info" style="background-color: #f37277">
                <div class="card-block" style="padding: 20px;">
                  <textarea placeholder="Deja tu comentario aqui" style="resize: none; padding: 5px; height: 130px; width: 100%; border: 1px solid  #f37277;"></textarea>
                  <form class="form-inline float-right">
                    <button style="" class="btn btn-outline-light" type="button">Comentar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="container">
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
                      <button type="button" class="close">
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
        <br>
      </div>
  </body>
  <?php require 'scripts.php' ?>
</html>
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
                  <td colspan="5"><?php echo $creador ?></td>
                  <td colspan="2">
                    <?php if(isset($_SESSION['email'])){ ?>
                      <button class="btn btn-primary" href="mandarSolicitud" style="background-color: #f37277; border-color:#f37277">Postularme para el viaje</button>
                   <?php }else{ ?>
                      <button class="btn btn-primary disabled" style="background-color: #f37277; border-color:#f37277">Postularme para el viaje</button>
                   <?php }?>
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
                  <td><?php  $duracion= (date( strtotime( $fechaLlegada))) - (date( strtotime( $fechaSalida)));
                          echo date("H:i" ,$duracion); ?></td>
                </tr>
                <tr>
                  <th scope="row">Costo del viaje</th>
                  <td colspan="7"><?php echo $monto; ?></td>
                </tr>
                <tr>
                  <th scope="row">Patente</th>
                  <td colspan="1"><?php echo $matricula ?></td>
                  <th scope="row">Marca</th>
                  <td><?php echo $marca; ?></td>
                  <th scope="row">Modelo</th>
                  <td colspan="3"><?php echo $modelo; ?></td>
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
      </div>
  </body>
  <?php require 'scripts.php' ?>
</html>
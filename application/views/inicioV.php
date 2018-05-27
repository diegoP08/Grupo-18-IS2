<?php
/* INTERFACE DE INICIO DEL USUARIO LOGUEADO. NO CONFUNDIR CON "START" EL CUAL ES EL INDEX(INICIO DE USUARIO NO LOGUEADO)*/
  if (! isset($_SESSION['email'])){redirect("start");}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" style="height: 100%">
  <?php require 'head.php' ?>
  <body style="background-image: url(<?php echo base_url() ?>assets/img/fondo1.png); background-repeat:repeat;height: 100%;">
    <div class="container" style="background: rgba(0,0,0,0.5); box-shadow: 0 0 10px 3px black; min-height: 100%">
      <?php require 'barraSuperior.php' ?>
      <br>
      <div class="container" style="color: white">
        <h3 align="center">Ultimos viajes</h3>
        <br>
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
        <br>
      </div>
    </div>
  </body>
  <?php require 'scripts.php' ?>
</html>

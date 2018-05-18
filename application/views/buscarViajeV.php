<!DOCTYPE html>
<html lang="en" dir="ltr" style="height: 100%">
  <?php require 'head.php' ?>
  <body style="background-image: url(<?= base_url() ?>assets/img/fondo1.png); background-repeat:repeat;height: 100%;">
    <div class="container" style="background: rgba(0,0,0,0.5); box-shadow: 0 0 10px 3px black; min-height: 100%;">
      <?php require 'barraSuperior.php' ?>
      <br>
      <br>
      <div class="row justify-content-center" style="color:white">
        <div class="col justify-content-center">
          <h1 align="center">BUSCAS UN VIAJE?</h1>
          <h3 align="center">Encontrá Tu Lugar, Viaja De Forma Segura Y Económica</h3>
        </div>
      </div>
      <br>
      <div class="row justify-content-center" style="color:white">
        <div class="col-8">
          <form class="" action="return false" method="post">
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
                <input id="fechaSalida" type="date" class="form-control" min="<?php echo date('Y-m-d') ?>" name="fechaSalida">
              </div>
              <button style="height: 40px; background-color: #f37277; border-color:#f37277" type="submit" class="btn btn-primary">Buscar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
  <?php require 'scripts.php' ?>
</html>

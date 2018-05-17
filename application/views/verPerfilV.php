<?php if (! isset($_SESSION['email'])){redirect("start");} ?>
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
                  <th scope="row" style="width: 200px; height: 5px">Nombre</th>
                  <td><?php echo $_SESSION['nombre']; ?></td>
                  <td rowspan="7" colspan="2" class="avatar-cell" style="width: 80px">
                    <div id="avatar-uploader" class="img-avatar pull-right">
                      <div>
                        <div class="qq-uploader-selector text-center">
                          <img src="<?php echo base_url() ?>assets/img/usuario.jpg" class="avatar-original img-thumbnail">
                        <div class="img-controls">
                          <div class="qq-upload-button-selector" style="position:relative; overflow: hidden; direction: ltr;">
                            <div class="btn btn-xxs btn-primary" style="background-color: #f37277; border-color:#f37277; margin-top: 10px">
                              <i class="fa fa-camera">Subir foto</i>
                            </div>
                            <?php // aca iria el input del boton?>
                          </div>
                        </div>
                        <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals"></ul>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row" style="height: 5px">Apellido</th>
                  <td><?php echo $_SESSION['apellido']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Email</th>
                  <td><?php echo $_SESSION['email']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Fecha de Nacimiento</th>
                  <td><?php echo $_SESSION['fechaDeNacimiento']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Sexo</th>
                  <td><?php echo $_SESSION['sexo']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Pais</th>
                  <td><?php echo $_SESSION['pais']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Provincia</th>
                  <td><?php echo $_SESSION['provincia']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Localidad</th>
                  <td><?php echo $_SESSION['localidad']; ?></td>
                  <td><strong>Calificacion</strong></td>
                  <td><?php echo $puntuacion; ?>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Celular</th>
                  <td><?php echo $_SESSION['celular']; ?></td>
                  <td><strong>Monedero</strong></td>
                  <td>0</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </body>
  <?php require 'scripts.php' ?>
</html>

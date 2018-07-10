<?php
  if (! isset($_SESSION['email'])){redirect("start");}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" style="height: 100%">
  <?php require 'head.php' ?>
  <body style="background-image: url(<?php echo base_url() ?>assets/img/fondo1.png); background-repeat:repeat;height: 100%;">
    <div class="container" style="background: rgba(0,0,0,0.5); box-shadow: 0 0 10px 3px black; min-height: 100%">
      <?php require 'barraSuperior.php' ?>
      <?php if(form_error('passwordActual')){
          echo '<div class="alert alert-danger" align="center" id="actual"> La contraseña actual debe  tener 8 o mas caracteres </div>';
      } ?>
      <?php if(form_error('passwordNueva')){
          echo '<div class="alert alert-danger" align="center" id="nueva"> La contraseña nueva debe  tener 8 o mas caracteres </div>';
      } ?>
      <?php if(form_error('confirmarPassword')){
          echo '<div class="alert alert-danger" align="center" id="confirmar"> La confirmacion debe  tener 8 o mas caracteres </div>';
      } ?>
      <?php if($bool=='exito'){
        echo '<div class="alert alert-success" align="center"> Contraseña cambiada correctamente, sera redireccionado en 5 segundos </div>';
        header( "refresh:5;url=".site_url('verPerfilC'));
      }else{
        if($bool=='fallo'){
          echo '<div class="alert alert-danger" align="center" id="fallo"> La contraseña no pudo ser cambiada, intente nuevamente. </div>';
        }else{
          if($bool == 'noCoincide'){
            echo '<div class="alert alert-danger" align="center" id="noCoincide"> Las contraseñas no coinciden, intente nuevamente. </div>';
          }else{
            if($bool == 'actualNoCoincide'){
              echo '<div class="alert alert-danger" align="center" id="actualNoCoincide"> Contraseña actual incorrecta, intente nuevamente. </div>';
            }
          }
        }
      }?>
      <br>
      <div class="container" style="background: rgba(0,26,26,0.5);width: 90%;box-shadow: 0px 0px 10px 4px black;">
        <h1 align='center' style="color:white; padding: 10px;">Cambiar contraseña</h1>
        <div class="container" align="center" id="cambiarPassword" style="padding: 6px;">
          <form action="<?php echo site_url('/CambiarPasswordC/cambiar') ?>" method="POST">
            <table class="table table-striped table-dark" style="box-shadow: 0px 0px 10px 4px black; width: 70%">
              <tbody>
                <tr>
                  <div class="form-group">
                    <th><label for="passwordActual"> Contraseña actual </label></th>
                    <td style="padding-right: 80px"><input style="background-color: rgba(89, 89, 89, 0.9); color:white; border-color:grey" type="password" class="form-control" placeholder="" name="passwordActual" id="passwordActual" ></td>
                  </div>
                </tr>
                <tr>
                  <div class="form-group">
                    <th><label for="passwordNueva"> Contraseña nueva </label></th>
                    <td style="padding-right: 80px"><input style="background-color: rgba(89, 89, 89, 0.9); color:white; border-color:grey" type="password" class="form-control" placeholder="" name="passwordNueva" id="passwordNueva" ></td>
                  </div>
                </tr>
                <tr>
                  <div class="form-group">
                    <th><label for="confirmarPassword"> Confirmar contraseña </label></th>
                    <td style="padding-right: 80px"><input style="background-color: rgba(89, 89, 89, 0.9); color:white; border-color:grey" type="password" class="form-control" placeholder="" name="confirmarPassword" id="confirmarPassword" ></td>
                  </div>
                </tr>
                <tr>
                  <td colspan="4">
                    <div class="row justify-content-center">
                      <button type="submit" class="btn btn-primary" style="margin-right: 4px;box-shadow: 0px 0px 10px 1px black; background-color: #f37277; border-color:#f37277; " id="cambiar">Cambiar</button>
                      <a href="<?=site_url('/verPerfilC')?>" class="btn btn-primary" style="margin-left: 4px;box-shadow: 0px 0px 10px 1px black; background-color: #ff3333; border-color:#f37277;" title="cancel"> Cancelar</a>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div>
  </body>
  <?php require 'scripts.php' ?>
  <script> //Muestra una alerta con el texto que recibe
    $(document).ready(function () {
      $("#actual").delay(3000).fadeOut("slow");
    });
    $(document).ready(function () {
      $("#nueva").delay(5000).fadeOut("slow");
    });
    $(document).ready(function () {
      $("#confirmar").delay(7000).fadeOut("slow");
    });
    $(document).ready(function () {
      $("#fallo").delay(3000).fadeOut("slow");
    });
    $(document).ready(function () {
      $("#noCoincide").delay(3000).fadeOut("slow");
    });
    $(document).ready(function () {
      $("#actualNoCoincide").delay(3000).fadeOut("slow");
    });
  </script>
</html>

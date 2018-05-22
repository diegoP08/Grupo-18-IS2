<?php
/* INTERFACE DE INICIO DEL USUARIO LOGUEADO. NO CONFUNDIR CON "START" EL CUAL ES EL INDEX(INICIO DE USUARIO NO LOGUEADO)*/
  if (! isset($_SESSION['email'])){redirect("start");}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <?php require 'head.php' ?>
  <body style="background-image: url(<?php echo base_url() ?>assets/img/fondo1.png); background-repeat:repeat;height: 100%;">
    <div class="container" style="background: rgba(0,0,0,0.5); box-shadow: 0 0 10px 3px black; min-height: 100%;">
      <?php require 'barraSuperior.php' ?>
      <?php if($bool=='exito'){
        echo '<div class="alert alert-success" align="center"> Perfil guardado correctamente </div>';
      }else{
        echo validation_errors('<div class="alert alert-danger" align="center">','</div>');
      }?>
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col col-md-10">
            <form action="<?php echo base_url() ?>index.php/editarPerfilC/editar" method="POST">
              <table class="table table-striped table-dark" style="box-shadow: 0px 0px 10px 4px black">
                <tbody>
                  <tr>
                    <div class="form-group">
        							<th style="width: 50px"><label for="nombre"> Nombre </label></th>
        							<td style="padding-right: 80px"><input style="background-color: rgba(89, 89, 89, 0.9); color:white; border-color:grey" type="text" class="form-control" placeholder="Nombre" name="nombre" value="<?php echo $_SESSION['nombre']; ?>" required></td>
      							</div>
                  </tr>
                  <tr>
                    <div class="form-group">
        							<th style="width: 50px"><label for="apellido"> Apellido </label></th>
        							<td style="padding-right: 80px"><input style="background-color: rgba(89, 89, 89, 0.9); color:white; border-color:grey" type="text" class="form-control" placeholder="Apellido" value="<?php echo $_SESSION['apellido']; ?>" name="apellido" required></td>
      							</div>
                  </tr>
                  <tr>
                    <div class="form-group">
        							<th style="width: 50px"><label for="fechaDeNacimiento"> Fecha de Nacimiento </label></th>
        							<td style="padding-right: 80px"><input style="background-color: rgba(89, 89, 89, 0.9); color:white; border-color:grey" type="text" class="form-control" placeholder="Fecha de Nacimiento" value="<?php echo $_SESSION['fechaDeNacimiento']; ?>" onfocus="(this.type='date')" onblur="(this.type='text')" max="<?php echo date('Y-m-d') ?>" name="fechaDeNacimiento" required></td>
      							</div>
                  </tr>
                  <tr>
                    <div class="form-group">
        							<th style="width: 50px"><label for="sexo"> Sexo </label></th>
        							<td style="padding-right: 80px"><select style="background-color: rgba(89, 89, 89, 0.9); color:white; border-color:grey" class="form-control" placeholder="Sexo" value="<?php echo $_SESSION['sexo']; ?>" name="sexo">
                        <option value"" selected><?php echo $_SESSION['sexo'];?></option>
                        <?php if($_SESSION['sexo'] == 'Femenino'){
                          echo "<option>Masculino</option>";
                        }else{
                          echo "<option>Femenino</option></select>";
                        } ?>
                      </td>
      							</div>
                  </tr>
                  <tr>
                    <div class="form-group">
        							<th style="width: 50px"><label for="pais"> Pais </label></th>
        							<td style="padding-right: 80px"><input style="background-color: rgba(89, 89, 89, 0.9); color:white; border-color:grey" type="text" class="form-control" placeholder="Pais" value="<?php echo $_SESSION['pais']; ?>"name="pais"></td>
      							</div>
                  </tr>
                  <tr>
                    <div class="form-group">
        							<th style="width: 50px"><label for="provincia"> Provincia </label></th>
        							<td style="padding-right: 80px"><input style="background-color: rgba(89, 89, 89, 0.9); color:white; border-color:grey" type="text" class="form-control" placeholder="Provincia" value="<?php echo $_SESSION['provincia']; ?>" name="provincia"></td>
      							</div>
                  </tr>
                  <tr>
                    <div class="form-group">
        							<th style="width: 50px"><label for="localidad"> Localidad </label></th>
        							<td style="padding-right: 80px"><input style="background-color: rgba(89, 89, 89, 0.9); color:white; border-color:grey" type="text" class="form-control" placeholder="Localidad" value="<?php echo $_SESSION['localidad']; ?>" name="localidad"></td>
      							</div>
                  </tr>
                  <tr>
                    <div class="form-group">
        							<th style="width: 50px"><label for="celular"> Celular </label></th>
        							<td style="padding-right: 80px"><input style="background-color: rgba(89, 89, 89, 0.9); color:white; border-color:grey" type="text" class="form-control" placeholder="Celular" value="<?php echo $_SESSION['celular']; ?>" name="celular"></td>
      							</div>
                  </tr>
                  <tr>
                    <td align="center"><button type="submit" class="btn btn-primary" style="box-shadow: 0px 0px 10px 1px black; background-color: #f37277; border-color:#f37277; " id="guardar">Guardar</button></td>
                    <td align="left"><a href="<?=site_url('/verPerfilC')?>" class="btn btn-primary" style="box-shadow: 0px 0px 10px 1px black; background-color: #ff3333; border-color:#f37277;" title="cancel"> Cancelar</a></td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </div>
      </div>
     <br>
    </div>
  </body>
  <?php require 'scripts.php' ?>
</html>

<?php
  if (! isset($_SESSION['email'])){redirect("start");}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" style="height: 100%">
  <?php require 'head.php' ?>
  <body style="background-image: url(<?php echo base_url() ?>assets/img/fondo1.png); background-repeat:repeat;height: 100%;">
    <div class="container" style="background: rgba(0,0,0,0.5); box-shadow: 0 0 10px 3px black; min-height: 100%">
      <?php require 'barraSuperior.php' ?>
      <br>
      <div class="container" style="background: rgba(0,26,26,0.5);width: 90%;box-shadow: 0px 0px 10px 4px black;">
        <h1 align='center' style="color:white; padding: 10px;">Peticiones pendientes</h1>
        <div class="container" align="center" id="listaPeticiones" style="overflow-y: auto; padding: 6px;">
        </div>
      </div>
    </div>
  </body>
  <?php require 'scripts.php' ?>
  <script>
      $.ajax({
          url: "peticionesC/mostrarPeticiones",
          type: "POST",
          data: {},
          success: function(respuesta){
            document.getElementById("listaPeticiones").innerHTML = respuesta;
          }
      });
  </script>
</html>

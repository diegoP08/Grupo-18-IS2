<!DOCTYPE html>
<html lang="en" style="height: 100%;">
<?php require "head.php" ?>
<body class="text-center" style="background-image: url(<?php echo base_url() ?>assets/img/fondo2.jpg); background-repeat:repeat;height: 100%;">
  <?php require "barraSuperior.php" ?>
  <div class="container" style="background-image:url(<?php echo base_url() ?>assets/img/fondo-translucido.png);height: 100%;">
    <div class="row justify-content-center">
      <div class="col-6">
        <br>
        <div class="" style="background-color: #f37277; padding: 30px">
      			<h1> Iniciar Sesión </h1>
      			<p>Ingresa tus datos de usuario para ingresar al sistema</p>
      			<?php if(isset($_SESSION['login'])){
      				echo $error;
            }
            ?>
      			<form action="<?php echo base_url() ?>index.php/ingresoC/login" method="POST">
      				<div class="form-group">
      					<label for="username">Email</label>
      					<input class="form-control" name="username" placeholder="email" id="username" type="text" required>
      				</div>
      				<div class="form-group">
      					<label for="password">Contraseña</label>
      					<input class="form-control" name="password" placeholder="contraseña" id="password" type="password" required>
      				</div>
      				<div class="boton">
      					<button class="btn btn-info btn-lg btn-responsive" name="login">Ingresar </button>
      				</div>
      			</form>
          </div>
    	 </div>
      </div>
    </div>
  <?php require "scripts.php" ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

</body>
</html>

<!DOCTYPE html>
<html style="height: 100%">
	<?php require "head.php" ?>
	<body style="background-image: url(<?php echo base_url() ?>assets/img/fondo2.jpg); background-repeat:repeat;height: 100%;">
		<?php require "barraSuperior.php" ?>
		<div class="container" style="background-image:url(<?php echo base_url() ?>assets/img/fondo-translucido.png)";height: 100%;"">
			<br>
			<div class="row justify-content-center">
				<div class="col-6" style="background-color: #f37277 ;color: black; padding: 30px" id="advanced-search-form">
					<h1 align="center">Registrarse</h1>
					<form action="index.php/Cregistro/guardar" method="POST">
						<div class="form-group">
							<label for="email">Email</label>
							<input type="Email" class="form-control" placeholder="Email" name="email">
						</div>
						<div class="form-group">
							<label for="nombre">Nombre</label>
							<input type="text" class="form-control" placeholder="Nombre" name="nombre">
						</div>
						<div class="form-group">
							<label for="apellido">Apellido</label>
							<input type="text" class="form-control" placeholder="Apellido" name="apellido">
						</div>
						<div class="form-group">
							<label for="contrasena">Contraseña</label>
							<input type="password" class="form-control" placeholder="Contraseña" name="contrasena">
						</div>
						<div class="form-group">
							<label for="fechaDeNacimiento">Fecha De Nacimiento</label>
							<input type="date" class="form-control" placeholder="fechaDeNacimiento" max="<?php echo date('Y-m-d') ?>" name="fechaDeNacimiento" >
						</div>
						<div class="row justify-content-center">
							<button type="submit" class="btn btn-info btn-lg btn-responsive" id="Registrarse" align="center"> Registrarse</button>
						</div>
					</form>
				</div>
			</div>
		<br>
		</div>
	</body>
</html>

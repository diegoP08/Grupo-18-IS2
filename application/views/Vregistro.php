<?php if (isset($_SESSION['email'])){redirect("inicioC");} ?>
<!DOCTYPE html>
<html style="height: 100%">
	<?php require "head.php" ?>
	<body style="background-image: url(<?php echo base_url() ?>assets/img/fondo2.jpg); background-repeat:repeat;height: 100%;">
		<div class="container" style="background: rgba(0,0,0,0.5); box-shadow: 0 0 10px 3px black; min-height: 100%;">
			<?php require "barraSuperior.php" ?>
			<div class="container">
				<br>
				<div class="row justify-content-center">
					<div class="col-6" style="background-color: #f37277 ;color: black; padding: 30px" id="advanced-search-form">
						<h1 align="center">Registrarse</h1>
	            <?php
		            if($bool=='exito'){
		              echo '<div class="alert alert-success" align="center"> Usuario registrado correctamente </div>';
		            }elseif($bool=='fracaso'){
		            	echo validation_errors('<div class="alert alert-danger" align="center">','</div>');
		            }elseif($bool == 'ya registrado'){
									echo '<div class="alert alert-danger" align="center"> El email ingresado ya esta registrado </div>';
								}
	            ?>
						<form action="<?php echo base_url() ?>index.php/Cregistro/guardar" method="POST">
							<div class="form-group">
								<label for="email">Email</label>
								<input type="Email" class="form-control" placeholder="Email" name="email" required>
							</div>
							<div class="form-group">
								<label for="nombre">Nombre</label>
								<input type="text" class="form-control" placeholder="Nombre" oninput="this.value=Letras(this.value)" + name="nombre" required>
							</div>
							<div class="form-group">
								<label for="apellido">Apellido</label>
								<input type="text" class="form-control" placeholder="Apellido" oninput="this.value=Letras(this.value)" name="apellido" required>
							</div>
							<div class="form-group">
								<label for="contrasena">Contraseña</label>
								<input type="password" class="form-control" placeholder="Contraseña" name="contrasena" required>
							</div>
							<div class="form-group">
								<label for="fechaDeNacimiento">Fecha De Nacimiento</label>
								<input type="date" class="form-control" placeholder="fechaDeNacimiento" max="<?php echo date('Y-m-d') ?>" name="fechaDeNacimiento" required>
							</div>
							<div class="row justify-content-center">
								<button type="submit" class="btn btn-info btn-lg btn-responsive" id="Registrarse" align="center">Registrarse</button>
							</div>
						</form>
					</div>
				</div>
			<br>
			</div>
		</div>
		<?php require "scripts.php" ?>
		<script>
			function Letras(string){//Solo numeros
   				var out = '';
		    	var filtro ='abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ ';//Caracteres validos
			    for (var i=0; i<string.length; i++)//Recorrer el texto y verificar si el caracter se encuentra en la lista de validos 
			       if (filtro.indexOf(string.charAt(i)) != -1) {
				     out += string.charAt(i);//Se añaden a la salida los caracteres validos
			    	}else{
			      alert('El campo actual no acepta caracteres numericos');
			  		}
			    return out;//Retornar valor filtrado
			} 
		</script>
	</body>
</html>

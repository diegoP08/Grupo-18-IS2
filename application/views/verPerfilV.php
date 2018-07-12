<?php if (! isset($_SESSION['email'])){redirect("start");} ?>
<!DOCTYPE html>
<html lang="en" dir="ltr" style="height:100%">
	<?php require "head.php" ?>
	<body style="background-image: url(<?php echo base_url() ?>assets/img/fondo1.png); background-repeat:repeat;height: 100%;">
			<div class="container" style="background: rgba(0,0,0,0.5); box-shadow: 0 0 10px 3px black; min-height: 100%;">
				<?php require "barraSuperior.php" ?>
				<br>
				<?php
					if ($deshabilito=='deshabilitar') {
						echo '<div class="alert alert-success" align="center">La cuenta se deshabilito correctamente</div>';
						header( "refresh:5;url=".site_url('start'));
						$this->session->sess_destroy();
					}elseif ($deshabilito=='tieneViajes') {
						echo '<div class="alert alert-success" align="center" id="tieneViajes"> La cuenta tiene viajes pendientes </div>';
						//	header( "refresh:5;url=".site_url('verPerfilC'));
					}
				?>
				<div class="container" style="width: 80%">
					<div class="row">
						<table class="table table-striped table-dark" style="box-shadow: 0px 0px 10px 4px black">
							<tbody>
								<tr>
									<td align="left"><h2 style="font-style: italic; color: white"><?php echo $_SESSION['nombre']; echo " "; echo $_SESSION['apellido'];?></h2></td>
									<td align="right">
										<a href="<?php echo base_url() ?>index.php/editarPerfilC" class="btn btn-primary" style="box-shadow: 0px 0px 10px 2px black; background-color: #f37277; border-color:#f37277;">Editar perfil</a>
										<a href="<?php echo base_url() ?>index.php/cambiarPasswordC" class="btn btn-primary" style="box-shadow: 0px 0px 10px 2px black; background-color: #b30059; border-color:#b30059;">Cambiar contraseña</a>
										<a href="<?php echo base_url() ?>index.php/verPerfilC/deshabilitar" class="btn btn-primary" style="box-shadow: 0px 0px 10px 2px black; background-color: #ad0000; border-color:#ad0000;" >Deshabilitar cuenta</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="row">
						<table class="table table-striped table-dark table-bordered" style="box-shadow: 0px 0px 10px 4px black">
							<tbody>
								<tr>
									<th scope="row" style="width: 200px; height: 5px">Nombre</th>
									<td><?php echo $_SESSION['nombre']; ?></td>
									<td rowspan="7" colspan="2" class="avatar-cell" style="width: 80px">
											<div>
												<div class="qq-uploader-selector text-center">
													<img style="width:266px; height:266px;" src="<?php echo base_url() ?>assets/img/<?= $_SESSION['fotoPerfil'] ?>" class="avatar-original img-thumbnail">
													<?php echo form_open_multipart('verPerfilC/upload_file'); ?>
														<div class="row">
															<input class="btn btn-primary" id="cargarImagen" style="visibility:hidden" onchange="this.form.submit()" type="file" name="userfile" size="20" />
														</div>
														<div class="row justify-content-center">
															<?php if($error == "imagenIncorrecta"){
																echo '<div class="alert alert-danger">Formato no valido</div>';
															} ?>
														</div>
														<div class="row justify-content-center">
														 <label for="cargarImagen" class="btn btn-primary" style="box-shadow: 0px 0px 10px 2px black;background-color: #f37277; border-color:#f37277">Cambiar imagen</label>
														</div>
													</form>
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
									<td><?php echo $puntuacion; ?></td>
								</tr>
								<tr>
									<th scope="row">Celular</th>
									<td><?php echo $_SESSION['celular']; ?></td>
									<td><strong>Monedero</strong></td>
									<td><?php echo $monedero; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<br>
			</div>
	</body>
	<?php require 'scripts.php' ?>
	<script> //Muestra una alerta con el texto que recibe
		$(document).ready(function () {
			$("#tieneViajes").delay(3000).fadeOut("slow")});
		</script>
</html>

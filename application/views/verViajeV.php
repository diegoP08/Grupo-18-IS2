<!DOCTYPE html>
<html lang="en">
<?php require "head.php" ?>
<body style="background-image: url(<?php echo base_url() ?>assets/img/fondo1.png); background-repeat:repeat;height: 100%;">
	<div class="container" style="background: rgba(0,0,0,0.5); box-shadow: 0 0 10px 3px black; min-height: 100%;">
		<?php require "barraSuperior.php" ?>
		<div class="container clearfix">
			<br>
			<div class="col" style="padding-right: 100px; padding-left: 100px; color:white">
				<form action="" method="post">
					<div class="row">
						<div class="col-5">
							<div class="form-group">
								<label for="desde" class="mb-0">Conductor:</label>
								<small class="form-control" href="#PONER URL DEL PERFIL DEL CONDUCTOR" ><?php echo $creador ?></small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label for="desde" class="mb-0">Desde: </label>
								<small class="form-control" ><?php echo $salida?> </small>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="hasta" class="mb-0">Hasta: </label>
								<small class="form-control" ><?php echo $destino?></small>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-3">
							<div class="form-group">
								<label for="Fecha de salida" class="mb-0">Fecha de salida: </label>
								<small class="form-control"> <?php echo date( "d-m-Y", strtotime($fechaSalida)) ?> </small>
							</div>
						</div>
						<div class="col-3">
							<div class="form-group">
								<label for="Hora de salida" class="mb-0">Hora de salida: </label>
								<small class="form-control" > <?php echo date( "H:i", strtotime( $fechaSalida)).' hs';?> </small>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<div class="row">
									<div class="col-5">
										<div class="form-group">
											<label for="duracion" class="mb-0">Duracion: </label>
											<small class="form-control" > <?php $duracion= (date( strtotime( $fechaLlegada))) - (date( strtotime( $fechaSalida)));
											echo date("H" ,$duracion);?> </small>
										</div>
									</div>
									<h6 class="align-self-center">hrs</h6>
									<div class="col-5">
										<div class="form-group">
											<label for="desde" class="mb-0"></label>
											<small class="form-control" ><?php echo date("i" ,$duracion) ?></small>
										</div>
									</div>
									<h6 class="align-self-center">min</h6>
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-4">
							<div class="form-group">
								<label for="costoTotal" class="mb-0">Costo total del viaje: </label>
								<small class="form-control" ><?php echo $monto?></small>
							</div>
						</div>
						<div class="col-4">
							<div class="form-group">
								<label for="patente" class="mb-0">Patente del vehiculo: </label>
								<small class="form-control" ><?php echo $matricula?></small>
							</div>
						</div>
						<div class="col-4">
							<div class="form-group">
								<label for="cupos" class="mb-0">Cupos disponible: </label>
								<small class="form-control" ><?php echo $lugaresDisponibles?></small>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php require "scripts.php" ?>
</body>
</html>

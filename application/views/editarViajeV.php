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
				echo '<div class="alert alert-success" align="center"> viaje modificado correctamente, sera redireccionado en 5 segundos </div>';
				header( "refresh:5;url=".site_url('/misViajesC'));
			}?>
			<div class="container">
				<div class="row justify-content-md-center">
					<div class="col col-md-10">
						<form action="<?php echo site_url('/editarViajeC/guardar/') , $idViaje; ?>" method="POST">
							<table class="table table-striped table-dark" style="box-shadow: 0px 0px 10px 4px black">
								<tbody>
									<tr>
										<div class="form-group">
											<th style="width: 50px"><label for="desde"> Desde: </label></th>
											<td style="padding-right: 80px" colspan="10">
												<?php echo $salida ?>
											</td>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th style="width: 50px"><label for="hasta"> Hasta: </label></th>
											<td style="padding-right: 80px" colspan="10">
											<?php echo $destino ?>
											</td>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th style="width: 50px"><label for="fechaSalida"> Fecha De  Salida </label></th>
											<td style="padding-right: 80px" colspan="10">
												<?php echo date( "d-m-Y", strtotime($fechaSalida)); ?>
											</td>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th style="width: 50px"><label for="horaSalida"> Hora De  Salida </label></th>
											<td style="padding-right: 80px" colspan="10">
												<?php echo date( "H:i", strtotime( $fechaSalida)).' hs'; ?>
											</td>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th style="width: 50px"><label for="duracion"> Duración </label></th>
											<td style="padding-right: 80px" colspan="10">
												<?php  $duracion= (new DateTime($fechaLlegada))->diff(new DateTime($fechaSalida));
												echo (($duracion->format("%a") * 24) + $duracion->format("%H")) . ":" . $duracion->format("%I"); ?>
											</td>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th style="width: 50px"><label for="costo"> Costo Del Viaje </label></th>
											<td style="padding-right: 80px" colspan="10">
												<input required name="monto" style="background-color: rgba(89, 89, 89, 0.9); color:white; border-color:grey" name="costo" type="text" class="form-control" placeholder="Costo Del Viaje" value="<?php echo $monto?>">
											</td>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th style="width: 50px"><label for="matricula"> Matricula </label></th>
											<td style="padding-right: 10px; width: 500px" colspan="3">
												<select style="background-color: rgba(89, 89, 89, 0.9); color:white; border-color:grey; min-width:120px"  class="form-control" id="matricula" onchange="cambiarDatos(this.value)" name="matricula">
											</td>
											<th style="width: 50px"><label for="marca"> Marca </label></th>
											<td style="padding-right: 40px" colspan="1" id="marca">
												<?php echo $marca?>
											</td>
											<th style="width: 50px"><label for="modelo"> Modelo </label></th>
											<td style="padding-right: 30px" colspan="1" id="modelo">
												<?php echo $modelo?>
											</td>
											<th style="width: 50px"><label for="lugaresDisponibles"> Cupos </label></th>
											<td style="padding-right: 80px" colspan="1">
												<input required max="<?= $asientosVehiculo ?>" style="width: 90px" type="number" min="1" class="form-control" value="<?php echo $cupo ?>" id="lugaresDisponibles" name="cupo">
											</td>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th style="width: 50px"><label for="descripcion"> Descripción </label></th>
											<td style="padding-right: 80px" colspan="10">
												<textarea id="descripcion" name="descripcion" style="resize: none; padding: 5px; height: 100px; width: 100%; border: 1px solid  #f37277;"><?php echo $descripcion; ?></textarea>
											</td>
										</div>
									</tr>
									<tr>
										<td align="left" colspan="10">
											<button type="submit" class="btn btn-primary" style="box-shadow: 0px 0px 10px 1px black; background-color: #f37277; border-color:#f37277; " id="guardar">Guardar</button>
											<a href="<?php echo site_url('/misViajesC') ?>" class="btn btn-primary" style="box-shadow: 0px 0px 10px 1px black; background-color: #ff3333; border-color:#f37277;" title="cancel" colspan="100"> Cancelar</a>
										</td>
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
		<script>
		// carga la lista de matriculas en el selector del formulario
		  function cargarMatriculas(){
		    $.ajax({
		        url: "<?= site_url('vehiculosC/listaDeMatriculas'); ?>",
		        type: "POST",
		        data: {},
		        success: function(respuesta){
		          $( "#matricula" ).append(respuesta);
		          $(document).find('option').filter(function(){return this.value=='<?= $matricula ?>'})[0].selected = true;
		        }
		    });
		  }
		</script>
		<script>
		// Cambia los datos de los inputs, en funcion de la matricula que se elige
		  function cambiarDatos(matricula){
		    $.ajax({
		        url: "<?= site_url('editarViajeC/obtenerDatosDelVehiculo') ?>",
		        type: "POST",
		        data: {'matricula' : matricula},
		        success: function(respuesta){
		          var vehiculo = JSON.parse(respuesta);
		          $('#marca').html(vehiculo.marca);
		          $('#modelo').html(vehiculo.modelo);
		          $('#lugaresDisponibles').val(0);
		          var max = vehiculo.asientos;
		          $('#lugaresDisponibles').attr({'max' : max});
		        }
		    });
		  }
		</script>
		<script>
		  window.addEventListener('load', cargarMatriculas);
		</script>
		<?php require 'scripts.php' ?>
</html>

<?php if (! isset($_SESSION['email'])){redirect("start");} ?>
<!DOCTYPE html>
<html lang="en" dir="ltr" style="height: 100%">
	<style>
	.enlace.active {
			background-color: #f37277 !important;
	}

	.nav-link{
		color: white;
	}

	.nav-link:hover{
		color: #f37277;
	}

	</style>
	<?php require 'head.php' ?>
	<body style="background-image: url(<?php echo base_url() ?>assets/img/fondo1.png); background-repeat:repeat;height: 100%;">
		<div class="container" style="background: rgba(0,0,0,0.5); box-shadow: 0 0 10px 3px black; min-height: 100%;">
			<?php require 'barraSuperior.php' ?>
			<br>
			<div class="container">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a style="color: white; background-color: #f37277; border-bottom-color: white" class="nav-link active" id="ofrecidos" data-toggle="tab" href="#listadoOfrecidos" role="tab" aria-controls="listadoOfrecidos" aria-selected="true">Viajes ofrecidos</a>
					</li>
					<li class="nav-item">
						<a style="color: white; background-color: #f37277; border-bottom-color: white" class="nav-link" id="reservas" data-toggle="tab" href="#listadoReservas" role="tab" aria-controls="listadoReservas" aria-selected="false">Viajes como copiloto</a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent" style="padding: 5px; border-width: 0px 1px 1px 1px; border-style: solid; border-color: white">
					<!-- Contenido Viajes Ofrecidos -->
					<div class="tab-pane fade show active" id="listadoOfrecidos" role="tabpanel" aria-labelledby="ofrecidos">
						<!-- Filtros por activos o realizados -->
						<nav class="nav nav-pills nav-fill">
							<a class="nav-link active enlace" id="viajesActivos1" data-toggle="list" href="#contenidoViajesActivos1" role="tab" aria-controls="contenidoViajesActivos1">Viajes activos</a>
							<a class="nav-link enlace" id="viajesAnteriores1" data-toggle="list" href="#contenidoViajesAnteriores1" role="tab" aria-controls="contenidoViajesAnteriores1">Viajes anteriores</a>
						</nav>
						<br>
						<!-- Contenido De los filtros -->
						<div class="">
							<div class="tab-content" id="nav-tabContent">
								<div class="tab-pane fade show active" id="contenidoViajesActivos1" role="tabpanel" aria-labelledby="viajesActivos1"></div>
								<div class="tab-pane fade" id="contenidoViajesAnteriores1" role="tabpanel" aria-labelledby="viajesAnteriores1"></div>
							</div>
						</div>
					</div>

					<!-- Contenido Viajes Como Acompañante -->
					<div class="tab-pane fade" id="listadoReservas" role="tabpanel" aria-labelledby="reservas">
						<!-- Filtros por activos o realizados -->
						<nav class="nav nav-pills nav-fill">
							<a class="nav-link active enlace" id="viajesActivos2" data-toggle="list" href="#contenidoViajesActivos2" role="tab" aria-controls="contenidoViajesActivos2">Viajes activos</a>
							<a class="nav-link enlace" id="viajesAnteriores2" data-toggle="list" href="#contenidoViajesAnteriores2" role="tab" aria-controls="contenidoViajesAnteriores2">Viajes anteriores</a>
						</nav>
						<br>
						<!-- Contenido De los filtros -->
						<div class="">
							<div class="tab-content" id="nav-tabContent">
								<div class="tab-pane fade show active" id="contenidoViajesActivos2" role="tabpanel" aria-labelledby="viajesActivos2"></div>
								<div class="tab-pane fade" id="contenidoViajesAnteriores2" role="tabpanel" aria-labelledby="viajesAnteriores2"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal Cancelar Solicitud -->
		<div class="modal fade" style="color: black" id="mensajeCancelarSolicitud" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		 <div class="modal-dialog" role="document">
			 <div class="modal-content">
				 <div class="modal-header">
					 <h5 class="modal-title" id="tituloMensajeCancelar">Cancelar solicitud</h5>
					 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						 <span aria-hidden="true">&times;</span>
					 </button>
				 </div>
				 <div id="textoMensajeCancelar" class="modal-body">
					 ¿Esta seguro de que desea cancelar?
				 </div>
				 <div class="modal-footer">
					 <button type="button" class="btn btn-danger" data-dismiss="modal" id="botonCancelar">Si, deseo cancelar</button>
				 </div>
			 </div>
		 </div>
		</div>
		<!-- Modal Eliminar Viaje -->
		<div class="modal fade" style="color: black" id="mensajeEliminarViaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		 <div class="modal-dialog" role="document">
			 <div class="modal-content">
				 <div class="modal-header">
					 <h5 class="modal-title">Eliminar viaje</h5>
					 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						 <span aria-hidden="true">&times;</span>
					 </button>
				 </div>
				 <div class="modal-body">
					 ¿Esta seguro de que desea eliminar este viaje?
				 </div>
				 <div class="modal-footer">
					 <button type="button" class="btn btn-secondar" data-dismiss="modal">Cancelar</button>
					 <button type="button" class="btn btn-danger" data-dismiss="modal" id="botonEliminar">Eliminar</button>
				 </div>
			 </div>
		 </div>
		</div>
		<!-- Panel administracion de copilotos -->
		<div class="modal fade bd-example-modal-lg" style="color: black" id="panelAdministracion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		 <div class="modal-dialog modal-lg" role="document">
			 <div class="modal-content">
				 <div class="modal-header">
					 <h5 class="modal-title">Administrar copilotos</h5>
					 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						 <span aria-hidden="true">&times;</span>
					 </button>
				 </div>
				 <div class="modal-body">
					 <div id="mensaje"></div>
					 <div id="mensajeConfirmacion" style="display: none">
						 <div class="alert alert-danger">
								¿Esta seguro de que desea quitar este acompañante?
								<button onclick="$('#mensajeConfirmacion').css({'display':'none'})" type="button" class="close">
									<span aria-hidden="true">&times;</span>
								</button>
								<button id="botonQuitarCopiloto" class="btn btn-danger float-right" style="margin-top: 5px; margin-right: 30px" type="button">Quitar</button>
								<br>
								<strong>Se le descontara un punto a su reputación</strong>
							</div>
					 </div>
					 <div id="cuerpoPanel"></div>
				 </div>
				 <div class="modal-footer">
					 <button type="button" class="btn btn-success" data-dismiss="modal" onclick="cargarViajesOfrecidosActivos()">Aceptar</button>
				 </div>
			 </div>
		 </div>
		</div>
		<div id="mensajeCabecera"></div>
	</body>
	<script>
		function cargarViajesOfrecidosActivos(){
			$.ajax({
					url: "misViajesC/viajesOfrecidosActivos/",
					type: "POST",
					data: {},
					success: function(respuesta){
						$('#contenidoViajesActivos1').html(respuesta);
					}
			});
		}
	</script>
	<script>
		function cargarViajesOfrecidosRealizados(){
			$.ajax({
					url: "misViajesC/viajesOfrecidosRealizados/",
					type: "POST",
					data: {},
					success: function(respuesta){
						$('#contenidoViajesAnteriores1').html(respuesta);
					}
			});
		}
	</script>
	<script>
		function cargarViajesComoAcompañanteActivos(){
			$.ajax({
					url: "misViajesC/viajesComoAcompananteActivos/",
					type: "POST",
					data: {},
					success: function(respuesta){
						$('#contenidoViajesActivos2').html(respuesta);
					}
			});
		}
	</script>
	<script>
		function cargarViajesComoAcompañanteRealizados(){
			$.ajax({
					url: "misViajesC/viajesComoAcompananteRealizados/",
					type: "POST",
					data: {},
					success: function(respuesta){
						$('#contenidoViajesAnteriores2').html(respuesta);
					}
			});
		}
	</script>
	<script> //modifica el boton del modal para cancelar el envio de una solicitud como copiloto
		function modificarModalParaCancelar(id){
			$("#tituloMensajeCancelar").html("Cancelar solicitud")
			$("#textoMensajeCancelar").html("¿Esta seguro de que desea cancelar su solicitud?")
			document.getElementById("botonCancelar").onclick = function(){ cancelarSolicitud(id) };
		}
	</script>
	<script>
		function cancelarSolicitud(idInscripcion){ // ejecuta la logica para cancelar el envio de una solicitud
			$.ajax({
					url: "misViajesC/cancelarSolicitud/",
					type: "POST",
					data: {idInscripcion : idInscripcion},
					success: function(respuesta){
						mensajeCabecera('<div class="alert alert-success fixed-top" style="text-align: center">Solicitud cancelada correctamente</div>');
						cargarViajesComoAcompañanteActivos();
					}
			});
		}
	</script>
	<script> //modifica el boton del modal para eliminar la participacion como copiloto
		function modificarModalParaEliminar(idInscripcion, idViaje){
			$("#tituloMensajeCancelar").html("Cancelar participacion")
			$("#textoMensajeCancelar").html("¿Esta seguro de que desea cancelar su participacion en este viaje? (Se le descontara un punto a su reputacion)")
			document.getElementById("botonCancelar").onclick = function(){ cancelarParticipacion(idInscripcion, idViaje) };
		}
	</script>
	<script>
		function cancelarParticipacion(idInscripcion, idViaje){ // ejecuta la logica para cancelar una participacion en un viaje
			$.ajax({
					url: "misViajesC/cancelarParticipacion/",
					type: "POST",
					data: {idInscripcion : idInscripcion , idViaje : idViaje},
					success: function(respuesta){
						cargarViajesComoAcompañanteActivos();
						mensajeCabecera('<div class="alert alert-success fixed-top" style="text-align: center">Participacion cancelada correctamente. Se desconto un punto a tu reputación</div>');
					}
			});
		}
	</script>
	<script> //modifica el boton del modal para eliminar un viaje
		function modificarModalEliminarViaje(idViaje){
			document.getElementById("botonEliminar").onclick = function(){ eliminarViaje(idViaje) };
		}
	</script>
	<script>
		function eliminarViaje(idViaje){ // ejecuta la logica para eliminar un viaje
			$.ajax({
					url: "eliminarViajeC/borrar/" + idViaje,
					type: "POST",
					data: {},
					success: function(respuesta){
						mensajeCabecera('<div class="alert alert-success fixed-top" style="text-align: center">Viaje eliminado correctamente</div>');
						cargarViajesOfrecidosActivos();
					}
			});
		}
	</script>
	<script> //modifica el cuerpo del panelDeAdministracion para mostrar los copilotos
		function modificarPanel(idViaje){
			$.ajax({
					url: "misViajesC/copilotosDeViaje/",
					type: "POST",
					data: {idViaje: idViaje},
					success: function(respuesta){
						$("#cuerpoPanel").html(respuesta);
					}
			});
		}
	</script>
	<script> // muestra un mensaje de confirmacion para eliminar al copiloto
		function mostrarMensaje(idInscripcion, idViaje){
			$("#mensajeConfirmacion").css({'display' : 'block'});
			document.getElementById("botonQuitarCopiloto").onclick = function(){ eliminarCopiloto(idInscripcion, idViaje) };
		}
	</script>
	<script>
		function eliminarCopiloto(idInscripcion, idViaje){ // ejecuta la logica para eliminar un copiloto de un viaje
			$.ajax({
					url: "misViajesC/eliminarCopiloto/",
					type: "POST",
					data: {idInscripcion : idInscripcion, idViaje: idViaje},
					success: function(idViaje){
						$("#mensajeConfirmacion").css({'display' : 'none'});
						mensajeTop('<div class="alert alert-success fixed-top" style="text-align: center">Copiloto quitado correctamente. Se desconto un punto a tu reputacion</div>');
						modificarPanel(idViaje);
						cargarViajesOfrecidosActivos();
					}
			});
		}
	</script>
	<script> //Muestra una alerta con el texto que recibe
		function mensajeTop(mensaje){
			$("#mensaje").html(mensaje);
			$(document).ready(function() {
					setTimeout(function() {
							$("#mensaje").fadeIn(0);
					},0001);
			});
			$(document).ready(function() {
					setTimeout(function() {
							$("#mensaje").fadeOut(1500);
					},3000);
			});
		}
	</script>
	<script> //Muestra una alerta con el texto que recibe
		function mensajeCabecera(mensaje){
			$("#mensajeCabecera").html(mensaje);
			$(document).ready(function() {
					setTimeout(function() {
							$("#mensajeCabecera").fadeIn(0);
					},0001);
			});
			$(document).ready(function() {
					setTimeout(function() {
							$("#mensajeCabecera").fadeOut(1500);
					},3000);
			});
		}
	</script>
	<script>
		window.addEventListener('load', cargarViajesOfrecidosActivos);
		window.addEventListener('load', cargarViajesOfrecidosRealizados);
		window.addEventListener('load', cargarViajesComoAcompañanteActivos);
		window.addEventListener('load', cargarViajesComoAcompañanteRealizados);
	</script>
	<?php require 'scripts.php' ?>
</html>

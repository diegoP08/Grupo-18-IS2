<?php
/**
*
*/
class VerViajeC extends CI_controller {

	public function index() {
	}

	public function cargarViaje($idViaje, $respuesta='') {
		$this->load->model('publicarViajeM');
		$this->load->model('verViajeM');
		$datosViaje = ($this->verViajeM->datosViaje($idViaje));
		$comentarios = ($this->verViajeM->comentariosDelViaje($idViaje));
		$datosConductor = ($this->verViajeM->datosDelConductor( $datosViaje->idCreador));

		$viaje = array(
			'idViaje' => $idViaje,
			'creador' => $datosViaje->idCreador,
			'fechaSalida' => $datosViaje->fechaHoraSalida,
			'fechaLlegada' => $datosViaje->fechaHoraLlegada,
			'salida' => $datosViaje->salida,
			'destino' => $datosViaje->destino,
			'cupo' => $datosViaje->cupo,
			'matricula' => $datosViaje->matricula,
			'marca' => $datosViaje->marca,
			'modelo' => $datosViaje->modelo,
			'monto' => $datosViaje->monto,
			'descripcion' => $datosViaje->descripcion,
			'estado' => $datosViaje->estado,
			'lugaresDisponibles' => $datosViaje->lugaresDisponibles,
			'comentarios' => $comentarios,
			'nombreConductor' => $datosConductor->nombre,
			'apellidoConductor' => $datosConductor->apellido,
			'tieneInscripcion' => false,
			'respuesta' => $respuesta,
			'hayCalificacionesPendientes' => false,
			'hayViajeSuperpuesto' => false,
			'cupo' => $datosViaje->cupo,
			'usuarioDeshabilitado' => $datosConductor->deshabilitado
		);
		if (isset($_SESSION['email'])) {
			$viaje['hayCalificacionesPendientes'] = ! empty($this->publicarViajeM->obtenerCalificacionesPendientesDe30Dias());
			$viaje['hayViajeSuperpuesto'] = $this->verViajeM->viajeSuperpuesto( $datosViaje->fechaHoraSalida,  $datosViaje->fechaHoraLlegada);
			if($this->verViajeM->tieneInscripcion($idViaje,$_SESSION['email'])){
				$viaje['tieneInscripcion'] = true;
			}
		}

		$this->load->view("verViajeV",$viaje);
	}

	function guardarComentario(){
		//texto del comentario y id del viaje en $_POST
		$this->load->model('verViajeM');
		$this->verViajeM->guardarComentario();
	}

	public function eliminarComentario() {
		// idComentario en $_POST
		$this->load->model('verViajeM');
		$this->verViajeM->eliminarComentario($_POST['idComentario']);
	}

	public function listaDeComentarios(){
		// id del creador del comentario y id del viaje del que quiero los comentarios estan en $_POST
		$this->load->model('verViajeM');
		$comentarios = $this->verViajeM->comentariosDelViaje($_POST['idViaje']);
		foreach ($comentarios as $comentario){
			echo '<div class="row justify-content-center">
				<div class="col-9">
					<div class="comment mb-2 row">
						<div class="comment-avatar col-md-1 col-sm-2 text-center pr-1" style="margin-top: 9px">
							<img class="mx-auto rounded-circle img-fluid" src="' . base_url() . 'assets/img/' . $comentario->fotoPerfil . '">
						</div>
						<div class="comment-content col-md-11 col-sm-10">';
							 if (isset($_SESSION['email']) && (($comentario->idCreador == $_SESSION['email']) || ($_POST['creador'] == $_SESSION['email']))){
								echo '<button type="button" class="close" data-toggle="modal" data-target="#mensajeEliminar" onclick="modificarModal(' . $comentario->idComentario . ')">
									&times;
								</button>';
								}
				 echo '<h6 class="small comment-meta" style="margin-top: 9px">' .
								($comentario->nombre) . ' ' . ($comentario->apellido) . ', ' .
								(new DateTime($comentario->fechaHora))->format('d-m-Y H:i') ,
					 		'</h6>
							<div class="comment-body">
								<p>' .
									$comentario->texto .
								'</p>
							</div>
						</div>
					</div>
				</div>
			</div>';
		}
	}
	public function enviar($idViaje)
	{
		$this->load->model('verViajeM');
		$dato=$this->verViajeM->enviar($idViaje);
		$this->cargarViaje($idViaje,$dato);
	}

}

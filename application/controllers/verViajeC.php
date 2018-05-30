<?php
/**
*
*/
class VerViajeC extends CI_controller {

	public function index() {
	}

	public function cargarViaje($idViaje) {
		$this->load->model('verViajeM');
		$datosViaje = ($this->verViajeM->datosViaje($idViaje));
		$comentarios = ($this->verViajeM->comentariosDelViaje($idViaje));
		$datosConductor = ($this->verViajeM->datosDelConductor( $datosViaje->idCreador));

		$viaje = array(
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
			'tieneInscripcion' => false
		);
		if (isset($_SESSION['email'])) {
			if($this->verViajeM->tieneIscripcion($idViaje,$_SESSION['email'])){
				$viaje['tieneInscripcion'] = true;
			}
		}

		$this->load->view("verViajeV",$viaje);
	}
}

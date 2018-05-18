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
			'lugaresDisponibles' => $datosViaje->lugaresDisponibles
		);
		$this->load->view("verViajeV",$viaje);
	}
}

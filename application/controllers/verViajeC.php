<?php
/**
* 
*/
class verViajeC extends CI_controller {
	
	public function index() {
		echo "trola";
	}

	public function cargarViaje($idViaje) {
		$this->load->model('verViajeM');
		$datosViaje = ($this->verViajeM->datosViaje($idViaje));

	foreach ($datosViaje as $dato) {
		$viaje = array(
		
		'creador' => $dato->idCreador,
		'fechaSalida' => $dato->fechaHoraSalida,
		'fechaLlegada' => $dato->fechaHoraLlegada,
		'salida' => $dato->salida,
		'destino' => $dato->destino,
		'cupo' => $dato->cupo,
		'matricula' => $dato->matricula,
		'marca' => $dato->marca,
		'modelo' => $dato->modelo,
		'monto' => $dato->monto,
		'descripcion' => $dato->descripcion,
		'estado' => $dato->estado,
		'lugaresDisponibles' => $dato->lugaresDisponibles);
	}
		$this->load->view("verViajeV",$viaje);
	}
}


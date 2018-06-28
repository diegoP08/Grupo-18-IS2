<?php

/**
* 
*/
class editarViajeM extends CI_model
{
	
	function __construct()
	{
		parent:: __construct();
	}

	public function datosViaje($idViaje){
		$this->db->select('*')->from('viaje')->where(array( 'id' => $idViaje));
		$query = $this->db->get();
		return $query->result()[0];
	}
	public function obtenerDatosDeVehiculo($matricula){ // En POST esta el id del vehiculo del cual quiero los datos
		$this->db->select('*')->from('vehiculo')->where(array('matricula' => $matricula));
		$query = $this->db->get();
		return ($query->result())[0];
	}
	public function guardar($idViaje)
	{
		$datosVehiculo = self::obtenerDatosDeVehiculo( $this->input->POST('matricula'));
		$campos = array(
			'monto' => $this->input->POST('monto'),
			'descripcion' => $this->input->POST('descripcion'),
			'matricula' => $this->input->POST('matricula'),
			'marca' => $datosVehiculo->marca,
			'modelo' => $datosVehiculo->modelo,
			'cupo' => $this->input->POST('cupo'),
			'lugaresDisponibles' => $this->input->POST('cupo')
		);
		$this->db->where('id', $idViaje);
		$this->db->update('viaje', $campos);
	}
}
?>
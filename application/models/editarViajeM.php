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
	public function guardar($idViaje)
	{
		$campos = array(
			'monto' => $this->input->POST('monto'),
			'descripcion' => $this->input->POST('descripcion'),
			'patente' => $this->input->POST('patente')
		);
		$this->db->where('id', $idViaje);
		$this->db->update('viaje', $campos);
	}
}
?>
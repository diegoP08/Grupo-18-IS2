<?php
/**
* 
*/
class eliminarViajeM extends CI_Model
{
	
	function __construct()
	{
		parent:: __construct();
	}

	public function borrar($idViaje)
	{
		$datos = array('estado' => "cancelado");
		$this->db->where('id', $idViaje);
		$this->db->update('inscripcion', $datos);
	}
}

?>
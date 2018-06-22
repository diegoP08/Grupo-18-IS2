<?php
/**
* 
*/
class eliminarViajeM extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
	}

	public function borrar($idViaje)
	{
		$this->db->where('id', $idViaje);
		$this->db->update('estado', 'cancelada');
	}
}

?>
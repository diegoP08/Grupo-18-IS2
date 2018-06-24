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
		$this->db->set('estado', 'inactiva')->where('id', $idViaje)->update('viaje');
	}
}

?>
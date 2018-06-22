<?php
/**
* 
*/
class eliminarViajeC extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('eliminarViajeM');
	}

	public function borrar($idViaje)
	{
		$this->eliminarViajeM->borrar($idViaje);
	}
}

?>
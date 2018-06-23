<?php
/**
* 
*/
class enviarSolicitudC extends CI_controller
{
	
	function __construct()
	{
		parent:: __construct();
	}

	public function enviar($idUsuario, $idViaje)
	{
		$this->load->model('enviarSolicitudM');
		$this->enviarSolicitudM->enviar($idUsuario,$idViaje);
	}
}

?>
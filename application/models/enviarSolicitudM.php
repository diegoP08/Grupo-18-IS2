<?php
/**
* 
*/
class enviarSolicitudM extends CI_model
{
	
	function __construct()
	{
		parent:: __construct;
	}

	public function enviar($idViaje,$idUsuario)
	{
		$campos = array(
			'idUsuario' => $idUsuario,
			'idViaje' => $idViaje,
			'estado' => 'inactiva'
		);
		$this->db->insert('inscripcion',$campos);	}
}
?>
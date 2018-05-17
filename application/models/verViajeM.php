<?php

/**
*
*/
class verViajeM extends CI_model{

	function __construct(){
		parent:: __construct();
	}

	public function datosViaje($idViaje){
		$this->db->select('*')->from('viaje')->where(array( 'id' => $idViaje));
		$query = $this->db->get();
		return $query->result()[0];
	}


}

?>

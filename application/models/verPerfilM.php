<?php
class VerPerfilM extends CI_model{

	function __construct(){
		parent:: __construct();
	}


  public function misPuntuaciones(){
    $this->db->select_sum('puntuacion');
    $this->db->from('calificacion');
		$this->db->where('idCalificado' , $_SESSION['email']);
    $query = $this->db->get();
		return $query->result()[0]->puntuacion;
  }
}

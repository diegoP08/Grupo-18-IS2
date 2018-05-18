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

	public function miMonedero(){
		$email=$_SESSION['email'];
		$query = $this->db->query("SELECT ((count(v.id) * (v.monto / (v.cupo + 1))) + (v.monto / (v.cupo + 1))) * 0.95 as monedero FROM `inscripcion` i INNER JOIN `viaje` v ON i.idViaje = v.id WHERE v.idCreador = '$email' AND i.estado = 'pagada' GROUP BY v.id, v.monto, v.cupo");
		$resultado= $query->result();
		return $resultado;
	}


}

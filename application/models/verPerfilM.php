<?php
class VerPerfilM extends CI_model{

	function __construct(){
		parent:: __construct();
	}


  public function misPuntuaciones(){
    $this->db->select_sum('puntuacion')->from('calificacion')->where('idCalificado' , $_SESSION['email']);
    $calificacionesDeUsuarios = $this->db->get()->result()[0]->puntuacion;

		$this->db->select_sum('puntuacion')->from('calificacionsistema')->where('idCalificado' , $_SESSION['email']);
		$calificacionesDelSistema = $this->db->get()->result()[0]->puntuacion;

		return $calificacionesDeUsuarios + $calificacionesDelSistema;
  }

	public function miMonedero(){
		$email=$_SESSION['email'];
		$query = $this->db->query(
			"SELECT ((count(v.id) * (v.monto / (v.cupo + 1))) + (v.monto / (v.cupo + 1))) * 0.95 as monedero
			FROM `inscripcion` i INNER JOIN `viaje` v ON i.idViaje = v.id
			WHERE v.idCreador = '$email'
						AND i.estado = 'pagada'
			GROUP BY v.id, v.monto, v.cupo");
		$resultado= $query->result();
		return $resultado;
	}


}

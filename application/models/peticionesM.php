<?php
class PeticionesM extends CI_model{

	function __construct()
	{
		parent:: __construct();
	}
  public function peticiones(){
    $email=$_SESSION['email'];
    $query = $this->db->query(
      "SELECT * , v.id as idViaje , v.estado as estadoViaje , u.id as idUsr
      FROM inscripcion i INNER JOIN viaje v ON i.idViaje = v.id
                  INNER JOIN usuario u ON i.idUsuario = u.email
      WHERE i.estado = 'pendiente'
                  AND v.idCreador = '$email'");
		return $query->result();
  }

	public function verReputacion($idCopiloto){
    $this->db->select_sum('puntuacion')->from('calificacion')->where('idCalificado' , $idCopiloto);
    $calificacionesDeUsuarios = $this->db->get()->result()[0]->puntuacion;

		$this->db->select_sum('puntuacion')->from('calificacionsistema')->where('idCalificado' , $idCopiloto);
		$calificacionesDelSistema = $this->db->get()->result()[0]->puntuacion;

		$resultado= $calificacionesDeUsuarios + $calificacionesDelSistema;
		if($resultado< 0){
			$resultado=0;
		}
		return $resultado;
  }

}

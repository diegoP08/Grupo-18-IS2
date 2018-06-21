<?php
class PeticionesM extends CI_model{

	function __construct()
	{
		parent:: __construct();
	}
  public function peticiones(){
		date_default_timezone_set('America/Argentina/La_Rioja');
		$tomorrow = (new DateTime())->add(new DateInterval('P1D'))->format('Y-m-d H:i:s');
    $email=$_SESSION['email'];
    $query = $this->db->query(
      "SELECT * , v.id as idViaje , v.estado as estadoViaje , u.id as idUsr
      FROM inscripcion i INNER JOIN viaje v ON i.idViaje = v.id
                  INNER JOIN usuario u ON i.idUsuario = u.email
      WHERE i.estado = 'pendiente'
									AND v.estado = 'activa'
                  AND v.idCreador = '$email'
								  AND v.fechaHoraSalida > '$tomorrow'");
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

	public function aceptarPeticion($idViaje,$idInscripcion){
		$datosViaje = $this->db->select('lugaresDisponibles')->from('viaje')->where('id',$idViaje)->get()->row();
		$lugaresDisponibles = $datosViaje->lugaresDisponibles; //obtengo lugares disponibles
		if ($lugaresDisponibles == 0){ //Pregunto si hay cupo, si no hay termino y devuelvo falso
			return FALSE;
		}
		$this->db->set('estado', 'aceptada')->where('id', $idInscripcion)->update('inscripcion');// acepto solicitud
		$this->db->query("UPDATE viaje SET lugaresDisponibles = lugaresDisponibles - 1 WHERE id = '$idViaje'")->result();
		//$this->db->set('lugaresDisponibles', 'lugaresDisponibles-1', FALSE)->where('id', $idViaje)->update('viaje');  actualizo lugares disponibles
		return TRUE;
	}

}

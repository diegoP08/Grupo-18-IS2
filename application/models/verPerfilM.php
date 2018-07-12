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
	
	 public function noTieneViajesComoConductor(){
		$idCreador = $_SESSION['email'];

		date_default_timezone_set('America/Argentina/La_Rioja');
			$hoy = (new DateTime())->format('Y-m-d H:i:s');

		$query = $this->db->query(
			"SELECT *
			FROM viaje
			WHERE estado = 'activa'
				AND idCreador = '$idCreador'
				AND fechaHoraLlegada > '$hoy'
				AND estado <> 'rechazada'
				AND estado <> 'cancelada'");
		return sizeof($query->result())==0;
		}

		public function noTieneViajesComoAcompañante(){
		$idUsuario = $_SESSION['email'];

		date_default_timezone_set('America/Argentina/La_Rioja');
			$hoy = (new DateTime())->format('Y-m-d H:i:s');

		$query = $this->db->query(
			"SELECT * , i.id as idInscripcion , i.estado as estadoInscripcion
			FROM inscripcion i INNER JOIN viaje v ON v.id = i.idViaje
			WHERE v.estado = 'activa'
				AND i.idUsuario = '$idUsuario'
				AND v.fechaHoraLlegada > '$hoy'
				AND i.estado <> 'rechazada'
				AND i.estado <> 'cancelada'");
		return sizeof($query->result())==0;
		}
		public function deshabilitar()
		{
			$this->db->set('deshabilitado', 'si', TRUE)->where('email', $_SESSION['email'])->update('usuario');
		}

}

<?php
class misViajesM extends CI_model{

	function __construct()
	{
		parent:: __construct();
	}

  public function viajesOfrecidosActivos(){
    $idCreador = $_SESSION['email'];

    date_default_timezone_set('America/Argentina/La_Rioja');
		$hoy = (new DateTime())->format('Y-m-d H:i:s');

    $query = $this->db->query(
      "SELECT *
      FROM viaje
      WHERE estado = 'activa'
						AND idCreador = '$idCreador'
            AND fechaHoraLlegada > '$hoy'");
    return $query->result();
  }

  public function viajesOfrecidosRealizados(){
    $idCreador = $_SESSION['email'];

    date_default_timezone_set('America/Argentina/La_Rioja');
		$hoy = (new DateTime())->format('Y-m-d H:i:s');

    $query = $this->db->query(
      "SELECT *
      FROM viaje
      WHERE estado = 'activa'
						AND idCreador = '$idCreador'
            AND fechaHoraLlegada < '$hoy'");
    return $query->result();
  }

  public function viajesComoAcompananteActivos(){
    $idUsuario = $_SESSION['email'];

    date_default_timezone_set('America/Argentina/La_Rioja');
		$hoy = (new DateTime())->format('Y-m-d H:i:s');

    $query = $this->db->query(
      "SELECT * , i.id as idInscripcion , i.estado as estadoInscripcion
      FROM inscripcion i INNER JOIN viaje v ON v.id = i.idViaje
      WHERE i.idUsuario = '$idUsuario'
            AND v.fechaHoraLlegada > '$hoy'");
    return $query->result();
  }

  public function viajesComoAcompananteRealizados(){
    $idUsuario = $_SESSION['email'];

    date_default_timezone_set('America/Argentina/La_Rioja');
    $hoy = (new DateTime())->format('Y-m-d H:i:s');

    $query = $this->db->query(
      "SELECT * , i.id as idInscripcion , i.estado as estadoInscripcion , v.id as idViaje
      FROM inscripcion i INNER JOIN viaje v ON v.id = i.idViaje
      WHERE i.idUsuario = '$idUsuario'
            AND v.fechaHoraLlegada < '$hoy'");
    return $query->result();
  }

	public function cancelarSolicitud(){
		$idInscripcion = $_POST['idInscripcion'];
		$this->db->where('id', $idInscripcion)->update('inscripcion', array('estado' => 'cancelada'));
	}

	public function cancelarParticipacion(){
		$idInscripcion = $_POST['idInscripcion'];
		$this->db->where('id', $idInscripcion)->update('inscripcion', array('estado' => 'cancelada'));

		$datos = array(
        'idCalificado' => $_SESSION['email'],
		);
		$this->db->insert('calificacionsistema', $datos);
	}

	public function copilotosDeViaje($idViaje){
		return $this->db->query("SELECT * FROM inscripcion WHERE idViaje = $idViaje AND (estado = 'aceptada' OR estado = 'pagada') ")->num_rows();
	}

	public function inscripcionesPendientesDeViaje($idViaje){
		return $this->db->query("SELECT * FROM inscripcion WHERE idViaje = $idViaje AND estado = 'pendiente' ")->num_rows();
	}

	public function copilotosViaje(){
		$idViaje = $_POST['idViaje'];
		return $this->db->query(
			"SELECT * , u.id as idUsr
			FROM usuario u INNER JOIN inscripcion i ON u.email = i.idUsuario
			WHERE idViaje = $idViaje
						AND (estado = 'pagada' OR estado = 'aceptada') "
		)->result();
	}

	public function eliminarCopiloto(){
		$idInscripcion = $_POST['idInscripcion'];
		$this->db->where('id', $idInscripcion)->update('inscripcion', array('estado' => 'rechazada'));

		$datos = array(
        'idCalificado' => $_SESSION['email'],
		);
		$this->db->insert('calificacionsistema', $datos);

		return $this->db->select('idViaje')->from('inscripcion')->where('id',$idInscripcion)->get()->row()->idViaje;
	}
}

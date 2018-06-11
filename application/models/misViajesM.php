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
      WHERE idCreador = '$idCreador'
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
      WHERE idCreador = '$idCreador'
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


}

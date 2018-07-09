<?php
class calificacionesM extends CI_model{

	function __construct()
	{
		parent:: __construct();
	}

  function obtenerCalificacionesParaCopilotos(){
		date_default_timezone_set('America/Argentina/La_Rioja');
		$hoy = (new DateTime())->format('Y-m-d H:i:s');

    $email = $_SESSION['email'];
    $query = $this->db->query(
      "SELECT * , i.id as idI, v.id as idV, u.id as idU, i.estado as estadoI, v.estado as estadoV
      FROM inscripcion i INNER JOIN viaje v ON i.idViaje = v.id
                         INNER JOIN usuario u ON i.idUsuario = u.email
      WHERE i.estado = 'pagada'
            AND v.idCreador = '$email'
						AND v.fechaHoraLlegada < '$hoy'
            AND NOT EXISTS(SELECT *
                           FROM calificacion c
                           WHERE c.idCalificado = i.idUsuario
                                 AND c.idViaje = v.id
                                 AND c.idCalificador = '$email' )");
		return $query->result();
  }

	function obtenerCalificacionesParaConductores(){
		date_default_timezone_set('America/Argentina/La_Rioja');
		$hoy = (new DateTime())->format('Y-m-d H:i:s');

    $email = $_SESSION['email'];
    $query = $this->db->query(
      "SELECT * , i.id as idI, v.id as idV, u.id as idU, i.estado as estadoI, v.estado as estadoV
      FROM inscripcion i INNER JOIN viaje v ON i.idViaje = v.id
                         INNER JOIN usuario u ON v.idCreador = u.email
      WHERE i.estado = 'pagada'
            AND i.idUsuario = '$email'
						AND v.fechaHoraLlegada < '$hoy'
            AND NOT EXISTS(SELECT *
                           FROM calificacion c
                           WHERE c.idCalificado = v.idCreador
                                 AND c.idViaje = v.id
                                 AND c.idCalificador = '$email' )");
		return $query->result();
  }

	function calificarUsuario(){ //En $_POST esta idViaje, emailCalificado, puntuacion
		$this->db->insert('calificacion', array('idCalificador' => $_SESSION['email'],
																						'idCalificado' => $_POST['emailCalificado'],
																						'idViaje' => $_POST['idViaje'],
																						'puntuacion' => $_POST['puntuacion']));
	}
}

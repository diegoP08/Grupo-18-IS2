<?php
class PublicarViajeM extends CI_model{

	function __construct()
	{
		parent:: __construct();
	}

  function guardar(){
    date_default_timezone_set('America/Argentina/La_Rioja');
    $minutos = $_POST['duracionHrs'] * 60 + $_POST['duracionMin'];
    $minutos = $minutos . " minutes";
    $minutos = date_interval_create_from_date_string($minutos);
    $miFechaHoraSalida = $_POST['fechaHoraSalida'];
    $miFechaHoraLlegada = date_add(new DateTime($miFechaHoraSalida) , $minutos)->format('Y-m-d H:i:s');;
    $email = $_SESSION['email'];
		$query = $this->db->query(
			"SELECT *
			FROM viaje
			WHERE idCreador = '$email'
				AND ((fechaHoraSalida BETWEEN '$miFechaHoraSalida' AND '$miFechaHoraLlegada')
				OR (fechaHoraLlegada BETWEEN '$miFechaHoraSalida' AND '$miFechaHoraLlegada')
				OR (fechaHoraSalida <= '$miFechaHoraSalida' AND fechaHoraLlegada >= '$miFechaHoraLlegada')
				)");
		if ($query->result()) {
      return false;
    }else {
      $matricula = $_POST['matricula'];
      $vehiculo = $this->db->select('*')->from('vehiculo')->where('matricula',$_POST['matricula'])->get()->row();
      $campos = array(
  			'idCreador' => $_SESSION['email'],
  			'fechaHoraSalida' => $miFechaHoraSalida,
  			'fechaHoraLlegada' => $miFechaHoraLlegada,
  			'salida' => $_POST['salida'],
  			'destino' => $_POST['destino'],
        'cupo' => $_POST['cupo'],
        'matricula' => $_POST['matricula'],
        'marca' => $vehiculo->marca,
        'modelo' => $vehiculo->modelo,
        'monto' => $_POST['monto'],
        'descripcion' => $_POST['descripcion'],
        'lugaresDisponibles' => $_POST['lugaresDisponibles']
  		);
  		$this->db->insert('viaje',$campos);
      return true;
    }
  }

	function obtenerCalificacionesPendientesDe30Dias(){
		$email = $_SESSION['email'];
		date_default_timezone_set('America/Argentina/La_Rioja');
		$hace30Dias = date_sub(new DateTime(), date_interval_create_from_date_string('30 days'))->format('Y-m-d H:i:s');
		$query = $this->db->query(
			"SELECT *
			FROM viaje v INNER JOIN inscripcion i ON v.id = i.idViaje
			WHERE i.idUsuario = '$email'
				AND i.estado = 'pagada'
				AND v.fechaHoraLlegada <= '$hace30Dias'
				AND NOT EXISTS(SELECT * FROM calificacion c WHERE idViaje = v.id AND c.idCalificador = '$email')");
		return $query->result();
	}



}

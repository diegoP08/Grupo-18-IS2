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
		$query = $this->db->query("SELECT * FROM viaje WHERE idCreador = '$email' AND ((fechaHoraSalida BETWEEN '$miFechaHoraSalida' AND '$miFechaHoraLlegada') OR (fechaHoraLlegada BETWEEN '$miFechaHoraSalida' AND '$miFechaHoraLlegada'))");
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



}

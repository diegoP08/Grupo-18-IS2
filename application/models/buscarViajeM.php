<?php
class BuscarViajeM extends CI_model{

	function __construct(){
		parent:: __construct();
	}

	//Devulve la cantidad de viajes a mostrar
	public function contarViajes(){
		$salida = $_POST['origen'];
		$destino = $_POST['destino'];
		$fechaSalida = $_POST['fechaSalida'];

		date_default_timezone_set('America/Argentina/La_Rioja');
		$tomorrow = (new DateTime())->add(new DateInterval('P1D'))->format('Y-m-d H:i:s');

		if ($salida){
			if ($fechaSalida){ //Busca por origen, destino y fecha
				$query =  $this->db->query(
		      "SELECT *
		      FROM viaje
		      WHERE estado = 'activa'
								AND fechaHoraSalida > '$tomorrow'
								AND salida = '$salida'
								AND destino = '$destino'
								AND fechaHoraSalida LIKE '$fechaSalida%'
		      ORDER BY fechaHoraSalida asc");
		    return $query->num_rows();
			}else{ //Busca solamente por origen y destino
				$query =  $this->db->query(
		      "SELECT *
		      FROM viaje
		      WHERE estado = 'activa'
								AND fechaHoraSalida > '$tomorrow'
								AND salida = '$salida'
								AND destino = '$destino'
		      ORDER BY fechaHoraSalida asc");
		    return $query->num_rows();
			}
		}else{// Busca todos los viajes
			$query =  $this->db->query(
				"SELECT *
				FROM viaje
				WHERE estado = 'activa'
				AND fechaHoraSalida > '$tomorrow'
				ORDER BY fechaHoraSalida asc");
			return $query->num_rows();
		}
	}

	// Devuelve los viajes para la correspondiente pagina
	public function buscar($pagina, $ordenPorFecha, $ordenPorMonto){
		$salida = $_POST['origen'];
		$destino = $_POST['destino'];
		$fechaSalida = $_POST['fechaSalida'];
		$inicio = ($pagina - 1) * 10;

		date_default_timezone_set('America/Argentina/La_Rioja');
		$tomorrow = (new DateTime())->add(new DateInterval('P1D'))->format('Y-m-d H:i:s');

		if ($salida){
			if ($fechaSalida){ //Busca por origen, destino y fecha
				$query =  $this->db->query(
		      "SELECT *
		      FROM viaje
		      WHERE estado = 'activa'
								AND fechaHoraSalida > '$tomorrow'
								AND salida = '$salida'
								AND destino = '$destino'
								AND fechaHoraSalida LIKE '$fechaSalida%'
		      $ordenPorFecha $ordenPorMonto
					LIMIT $inicio , 10");
		    return $query->result();
			}else{ //Busca solamente por origen y destino
				$query =  $this->db->query(
		      "SELECT *
		      FROM viaje
		      WHERE estado = 'activa'
								AND fechaHoraSalida > '$tomorrow'
								AND salida = '$salida'
								AND destino = '$destino'
		      $ordenPorFecha $ordenPorMonto
					LIMIT $inicio , 10");
		    return $query->result();
			}
		}else{// Busca todos los viajes
			$query =  $this->db->query(
				"SELECT *
				FROM viaje
				WHERE estado = 'activa'
							AND fechaHoraSalida > '$tomorrow'
				$ordenPorFecha $ordenPorMonto
				LIMIT $inicio , 10");
			return $query->result();
		}
	}

  public function proximos10viajes(){
    date_default_timezone_set('America/Argentina/La_Rioja');
		$tomorrow = (new DateTime())->add(new DateInterval('P1D'))->format('Y-m-d H:i:s');
    $query =  $this->db->query(
      "SELECT *
      FROM viaje
      WHERE fechaHoraSalida > '$tomorrow'
      ORDER BY id desc
      LIMIT 10");
    return $query->result();
  }

	public function obtener5ViajesAleatoriamente(){
		date_default_timezone_set('America/Argentina/La_Rioja');
		$tomorrow = (new DateTime())->add(new DateInterval('P1D'))->format('Y-m-d H:i:s');
    $query =  $this->db->query(
      "SELECT *
      FROM viaje
      WHERE fechaHoraSalida > '$tomorrow'
      ORDER BY RAND()
      LIMIT 5");
    return $query->result();
	}

}

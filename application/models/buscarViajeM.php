<?php
class BuscarViajeM extends CI_model{

	function __construct(){
		parent:: __construct();
	}

	//Funcion usada para filtrar por marca los resultados del array
	function filtrarPorMarca($viaje){
		return($viaje->marca == $_POST['marca']);
	}

	//Funcion usada para filtrar por modelo los resultados del array
	function filtrarPorModelo($viaje){
		return($viaje->modelo == $_POST['modelo']);
	}

	function filtrarPorMarcaModelo($viajes){
		//Logica para filtrar por marca o modelo (Si se especifico). Utilizo las funciones de arriba
		if ($_POST['marca']) {
			$viajes = array_filter($viajes, "self::filtrarPorMarca");
		}

		if ($_POST['modelo']) {
			$viajes = array_filter($viajes, "self::filtrarPorModelo");
		}
		return $viajes;
	}

	//Devuelve la cantidad de viajes a mostrar
	public function contarViajes(){
		$salida = $_POST['origen'];
		$destino = $_POST['destino'];
		$fechaSalida = $_POST['fechaSalida'];
		$marca = $_POST['marca'];
		$modelo = $_POST['modelo'];

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
		    $viajes = $query->result();
			}else{ //Busca solamente por origen y destino
				$query =  $this->db->query(
		      "SELECT *
		      FROM viaje
		      WHERE estado = 'activa'
								AND fechaHoraSalida > '$tomorrow'
								AND salida = '$salida'
								AND destino = '$destino'
		      ORDER BY fechaHoraSalida asc");
		    $viajes = $query->result();
			}
		}else{// Busca todos los viajes
			$query =  $this->db->query(
				"SELECT *
				FROM viaje
				WHERE estado = 'activa'
				AND fechaHoraSalida > '$tomorrow'
				ORDER BY fechaHoraSalida asc");
			$viajes = $query->result();
		}

		return count($this->filtrarPorMarcaModelo($viajes));
	}

	// Devuelve los viajes para la correspondiente pagina
	public function buscar($pagina, $ordenPorFecha, $ordenPorMonto){
		$salida = $_POST['origen'];
		$destino = $_POST['destino'];
		$fechaSalida = $_POST['fechaSalida'];
		$marca = $_POST['marca'];
		$modelo = $_POST['modelo'];
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
		    $viajes = $query->result();
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
		    $viajes = $query->result();
			}
		}else{// Busca todos los viajes
			$query =  $this->db->query(
				"SELECT *
				FROM viaje
				WHERE estado = 'activa'
							AND fechaHoraSalida > '$tomorrow'
				$ordenPorFecha $ordenPorMonto
				LIMIT $inicio , 10");
			$viajes = $query->result();
		}

		return $this->filtrarPorMarcaModelo($viajes);
	}

  public function proximos10viajes(){
    date_default_timezone_set('America/Argentina/La_Rioja');
		$tomorrow = (new DateTime())->add(new DateInterval('P1D'))->format('Y-m-d H:i:s');
    $query =  $this->db->query(
      "SELECT *
      FROM viaje
      WHERE estado = 'activa' AND fechaHoraSalida > '$tomorrow'
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
      WHERE estado = 'activa' AND fechaHoraSalida > '$tomorrow'
      ORDER BY RAND()
      LIMIT 5");
    return $query->result();
	}

}

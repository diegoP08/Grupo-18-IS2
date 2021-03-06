<?php
/**
*
*/
class editarViajeC extends CI_controller
{

	function __construct()
	{
		parent::__construct();
	}
	/*public function index()
	{
		$this->load->view("editarViajeV");
	}
*/
	public function editarViaje($idViaje)
	{
		$this->load->model('editarViajeM');
		$datosViaje = ($this->editarViajeM->datosViaje($idViaje));
		$datosVehiculo = $this->editarViajeM->obtenerDatosDeVehiculo($datosViaje->matricula);
		$viaje = array(
			'idViaje' => $idViaje,
			'creador' => $datosViaje->idCreador,
			'fechaSalida' => $datosViaje->fechaHoraSalida,
			'fechaLlegada' => $datosViaje->fechaHoraLlegada,
			'salida' => $datosViaje->salida,
			'destino' => $datosViaje->destino,
			'cupo' => $datosViaje->cupo,
			'matricula' => $datosViaje->matricula,
			'marca' => $datosViaje->marca,
			'modelo' => $datosViaje->modelo,
			'monto' => $datosViaje->monto,
			'descripcion' => $datosViaje->descripcion,
			'estado' => $datosViaje->estado,
			'lugaresDisponibles' => $datosViaje->lugaresDisponibles,
			'asientosVehiculo' => $datosVehiculo->asientos,
			'bool' => ' '
		);

		$this->load->view("editarViajeV",$viaje);
	}
	public function guardar($idViaje)
	{
		//Envio de los datos a guardar en $_POST
		$this->load->model('editarViajeM');
		$this->editarViajeM->guardar($idViaje);
		$datosViaje = ($this->editarViajeM->datosViaje($idViaje));
		$datosVehiculo = $this->editarViajeM->obtenerDatosDeVehiculo($datosViaje->matricula);
		$viaje = array(
			'idViaje' => $idViaje,
			'creador' => $datosViaje->idCreador,
			'fechaSalida' => $datosViaje->fechaHoraSalida,
			'fechaLlegada' => $datosViaje->fechaHoraLlegada,
			'salida' => $datosViaje->salida,
			'destino' => $datosViaje->destino,
			'cupo' => $datosViaje->cupo,
			'matricula' => $datosViaje->matricula,
			'marca' => $datosViaje->marca,
			'modelo' => $datosViaje->modelo,
			'monto' => $datosViaje->monto,
			'descripcion' => $datosViaje->descripcion,
			'estado' => $datosViaje->estado,
			'lugaresDisponibles' => $datosViaje->lugaresDisponibles,
			'asientosVehiculo' => $datosVehiculo->asientos,
			'bool' => 'exito'
		);
		$this->load->view('editarViajeV',$viaje);
	}

	public function obtenerDatosDelVehiculo(){ //en post la matricula
		$this->load->model('editarViajeM');
		$vehiculo = $this->editarViajeM->obtenerDatosDeVehiculo($_POST['matricula']);
		$datos = new \stdClass();
		$datos->marca = $vehiculo->marca;
		$datos->modelo = $vehiculo->modelo;
		$datos->asientos = $vehiculo->asientos;

		echo json_encode($datos);
	}

}
?>

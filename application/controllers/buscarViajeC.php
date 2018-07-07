<?php
class BuscarViajeC extends CI_controller {

	public function index() {
		$this->load->model('buscarViajeM');
		$datos['viajes'] = $this->buscarViajeM->obtener5ViajesAleatoriamente();
		$this->load->view('buscarViajeV', $datos);
	}

	public function buscar($pagina = 1, $ordenPorFecha = 'Mayor', $ordenPorMonto= 'Mayor'){
		// Guardo parametros para la vista
		$datos['ordenPorFecha'] = $ordenPorFecha;
		$datos['ordenPorMonto'] = $ordenPorMonto;
		$datos['origen'] = $_POST['origen'];
		$datos['destino'] = $_POST['destino'];
		$datos['fechaSalida'] = $_POST['fechaSalida'];
		$datos['marca'] = $_POST['marca'];
		$datos['modelo'] = $_POST['modelo'];
		$datos['pagina'] = $pagina;

		//Cargo parametros para la consulta (aplicar orden)
		if ($ordenPorFecha == 'Mayor'){
			$ordenPorFecha = 'fechaHoraSalida desc';
		}elseif ($ordenPorFecha == 'Menor'){
			$ordenPorFecha = 'fechaHoraSalida asc';
		}else{
			$ordenPorFecha = '';
		}

		if ($ordenPorMonto == 'Mayor'){
			$ordenPorMonto = 'monto desc';
		}elseif ($ordenPorMonto == 'Menor'){
			$ordenPorMonto = 'monto asc';
		}else{
			$ordenPorMonto = '';
		}

		if ( $ordenPorFecha != '') {
			($ordenPorMonto != '') ? $ordenPorMonto = ' ,' . $ordenPorMonto : '';
			$ordenPorFecha = ' ORDER BY ' . $ordenPorFecha;
		}elseif ($ordenPorMonto != ''){
			$ordenPorMonto = ' ORDER BY ' . $ordenPorMonto;
		}

		//Cargo los viajes para la pagina
		$this->load->model('buscarViajeM');
		$viajesTotales = $this->buscarViajeM->contarViajes();
		$datos['maxPag'] = ceil($viajesTotales / 10);
		$datos['viajes'] = $this->buscarViajeM->buscar($pagina, $ordenPorFecha, $ordenPorMonto);
		$this->load->view('listadoDeViajesV', $datos);
	}
}

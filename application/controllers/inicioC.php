<?php
class InicioC extends CI_Controller{

	public function index(){
		$this->load->model('buscarViajeM');
		$datos['viajes'] = $this->buscarViajeM->proximos10viajes();
		$this->load->view('inicioV',$datos);
	}
}

<?php
/**
* 
*/
class Cregistro extends CI_Controller
{
	
	function __construct(){
		parent:: __construct();
		$this->load->model('Mregistro');
	}
	public function index(){
		$this->load->view('Vregistro');
	}
	public function guardar(){
		if($this->Mregistro->guardar()){
			$datos = array('exito' => 'usuario registrado correctamente');
			$this->load->view('Vregistro', $datos);
		}
	}
}
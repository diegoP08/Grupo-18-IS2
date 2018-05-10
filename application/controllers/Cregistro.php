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
		$param['email'] = $this->input->post('email');
		$param['nombre'] = $this->input->post('nombre');
		$param['apellido'] = $this->input->post('apellido');
		$param['contrasena'] = $this->input->post('contrasena');
		$param['fechaDeNacimiento'] = $this->input->post('fechaDeNacimiento');
		$param['fotoPerfil'] = $this->input->post('fotoPerfil');
		$param['sexo'] = $this->input->post('sexo');
		$param['pais'] = $this->input->post('pais');
		$param['provincia'] = $this->input->post('provincia');
		$param['localidad'] = $this->input->post('localidad');
		$param['celular'] = $this->input->post('celular');

		$this->Mregistro->guardar($param);
		
	}
}
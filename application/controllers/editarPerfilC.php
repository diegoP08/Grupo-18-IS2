<?php

class EditarPerfilC extends CI_Controller{

	function __construct(){
		parent:: __construct();
    $this->load->model('editarPerfilM');
	}

  function index(){
  	$datos['bool']= ' ';
  	$this->load->view('editarPerfilV', $datos);
  }

public function editar(){
	if($this->editarPerfilM->editar()){
		$_SESSION['nombre'] = $this->input->POST('nombre');
		$_SESSION['apellido'] = $this->input->POST('apellido');
		$_SESSION['fechaDeNacimiento'] = $this->input->POST('fechaDeNacimiento');
		$_SESSION['sexo'] = $this->input->POST('sexo');
		$_SESSION['pais'] = $this->input->POST('pais');
		$_SESSION['provincia'] = $this->input->POST('provincia');
		$_SESSION['localidad'] = $this->input->POST('localidad');
		$_SESSION['celular'] = $this->input->POST('celular');
	  $datos['bool'] = 'exito';
		$this->load->view('editarPerfilV',$datos);
	}
}

}

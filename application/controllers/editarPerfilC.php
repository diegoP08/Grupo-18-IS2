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
		if($this->form_validation->run()== TRUE){
      $campos = array(
        'nombre' => $this->input->POST('nombre'),
        'apellido' => $this->input->POST('apellido'),
        'fechaDeNacimiento' => $this->input->POST('fechaDeNacimiento'),
        'sexo' => $this->input->POST('sexo'),
        'pais' => $this->input->POST('pais'),
        'provincia' => $this->input->POST('provincia'),
        'localidad' => $this->input->POST('localidad'),
        'celular' => $this->input->POST('celular')
      );
		  	if($this->editarPerfilM->editar($campos)){
          $datos['bool'] = 'exito';
  				$this->load->view('editarPerfilV',$datos);
        }
		}
	}

}

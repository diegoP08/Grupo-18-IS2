<?php
class EditarPerfilM extends CI_model
{

	function __construct()
	{
		parent:: __construct();
	}

  public function editar(){
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
    $this->db->where('email' , $_SESSION['email']);
    $this->db->update('usuario', $campos);
    return true;
  }
}

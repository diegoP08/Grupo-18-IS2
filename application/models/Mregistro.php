<?php
/**
*
*/
class Mregistro extends CI_model
{

	function __construct()
	{
		parent:: __construct();
		$this->load->database();
	}

	public function guardar(){
		$campos = array(
			'email' => $this->input->post('email'),
			'nombre' => $this->input->post('nombre'),
			'apellido' => $this->input->post('apellido'),
			'contrasena' => $this->input->post('contrasena'),
			'fechaDeNacimiento' => $this->input->post('fechaDeNacimiento'),
			'fotoPerfil' =>"mezasa"
		);
		$this->db->insert('usuario',$campos);
		return true ;
	}
}

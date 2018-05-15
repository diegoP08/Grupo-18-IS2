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
		$this->db->select('*');
		$this->db->from('usuario');
		$this->db->where(array('email' => ($this->input->post('email'))));
		$query = $this->db->get();
		$existeUsuario = $query->row();
		if($existeUsuario){
			return false;
		}
		$campos = array(
			'email' => $this->input->post('email'),
			'nombre' => $this->input->post('nombre'),
			'apellido' => $this->input->post('apellido'),
			'contrasena' => $this->input->post('contrasena'),
			'fechaDeNacimiento' => $this->input->post('fechaDeNacimiento')
		);
		$this->db->insert('usuario',$campos);
		return true ;
	}
}

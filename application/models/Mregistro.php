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

	public function guardar($param){
		$campos = array(
			'email' =>$param['email'],
			'nombre' =>$param['nombre'],
			'apellido' =>$param['apellido'],
			'contrasena' =>$param['contrasena'],
			'fechaDeNacimiento' =>$param['fechaDeNacimiento'],
			'fotoPerfil' =>"mezasa",
			'sexo' =>$param['sexo'],
			'pais' =>$param['pais'],
			'provincia' =>$param['provincia'],
			'localidad' =>$param['localidad'],
			'celular' =>$param['celular']
		);
		$this->db->insert('usuario',$campos);
		echo "Usuario registrado correctamente";
	}
}

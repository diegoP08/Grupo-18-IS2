<?php

/**
*
*/
class VerViajeM extends CI_model{

	function __construct(){
		parent:: __construct();
	}

	public function datosViaje($idViaje){
		$this->db->select('*')->from('viaje')->where(array( 'id' => $idViaje));
		$query = $this->db->get();
		return $query->result()[0];
	}

	public function comentariosDelViaje($idViaje){
		$query = $this->db->query(
			"SELECT * , c.id as idComentario
			 FROM comentario c INNER JOIN usuario u ON c.idCreador = u.email
			 WHERE c.estado = 'activo' AND c.idViaje = $idViaje");
		return $query->result();
	}

	public function datosDelConductor($idCreador){
		$query = $this->db->query(
			"SELECT *
			FROM usuario
			WHERE usuario.email = ('$idCreador')");
		return $query->result()[0];
	}

	public function tieneIscripcion($idViaje, $email)
	{
		$query = $this->db->query(
			"SELECT *
			FROM inscripcion
			WHERE inscripcion.idViaje = $idViaje AND inscripcion.idUsuario = '$email' AND inscripcion.estado <> 'cancelada'");
			return $query->result();
	}

	public function eliminarComentario($idComentario){
		$this->db->where('id', $idComentario)->delete('comentario');
	}

	public function guardarComentario(){
		$campos = array(
			'idCreador' => $_SESSION['email'],
			'idViaje' => $_POST['idViaje'],
			'texto' => $_POST['texto']
		);
		$this->db->insert('comentario',$campos);
	}

}

?>

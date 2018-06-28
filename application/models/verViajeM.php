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

	public function tieneInscripcion($idViaje, $email)
	{
		$query = $this->db->query(
			"SELECT *
			FROM inscripcion
			WHERE inscripcion.idViaje = $idViaje AND inscripcion.idUsuario = '$email' AND inscripcion.estado <> 'cancelada' AND estado<>'rechazada'");
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

	public function enviar($idViaje)
	{
		$campos = array(
			'idUsuario' => $_SESSION['email'],
			'idViaje' => $idViaje
		);
		$this->db->insert('inscripcion',$campos);
		return 'exito';
	}

	function viajeSuperpuesto($salida, $llegada){
		if(isset($_SESSION['email'])){return false;}
		date_default_timezone_set('America/Argentina/La_Rioja');
		$email=$_SESSION['email'];
		$query = $this->db->query(
			"SELECT *
			FROM viaje v INNER JOIN inscripcion i ON i.idViaje=v.id
			WHERE i.idUsuario = '$email'
				AND ((fechaHoraSalida BETWEEN '$salida' AND '$llegada')
					OR (fechaHoraLlegada BETWEEN '$salida' AND '$llegada')
					OR (fechaHoraSalida <= '$salida' AND fechaHoraLlegada >= '$llegada')
				)");
		if ($query->result()){
			return true;
		}
		return false;
	}

}

?>

<?php
class VehiculosM extends CI_model{

	function __construct()
	{
		parent:: __construct();
	}

	public function guardar(){
		$this->db->select('*');
		$this->db->from('vehiculo');
		$this->db->where(array('matricula' => ($this->input->post('matricula'))));
		$query = $this->db->get();
		$existeMatricula = $query->row();
		if(! $existeMatricula){
			$campos = array(
				'idConductor' => $_SESSION['email'],
				'matricula' => $this->input->post('matricula'),
				'marca' => $this->input->post('marca'),
				'modelo' => $this->input->post('modelo'),
				'asientos' => $this->input->post('asientos')
			);
			$this->db->insert('vehiculo',$campos);
			return true;
		}
		return false;
	}

	public function misVehiculos(){
		$this->db->select('*')->from('vehiculo')->where(array('idConductor' => $_SESSION['email'] ));
		$query = $this->db->get();
		return $query->result();
	}

	public function eliminarVehiculo(){
		$this->db->delete('vehiculo', array('id' => ($this->input->post('id'))));
	}

	public function obtenerDatosDeVehiculo(){
		$this->db->select('*')->from('vehiculo')->where(array('id' => ($this->input->post('id'))));
		$query = $this->db->get();
		return ($query->result()[0]);
	}

	public function modificarVehiculo(){
		$id = $this->input->post('id');
		$matricula = $this->input->post('matricula');
		$matriculaTomada = $this->db->query("SELECT * FROM vehiculo WHERE id != $id AND matricula = '$matricula'");
		if(is_null($matriculaTomada->row())){
			$datos = array(
	        'matricula' => $this->input->post('matricula'),
	        'marca'  => $this->input->post('marca'),
	        'modelo'  => $this->input->post('modelo'),
					'asientos' => $this->input->post('asientos')
			);
			$this->db->where('id', $id);
			$this->db->update('vehiculo', $datos);
			return true;
		}
		return false;
	}
}

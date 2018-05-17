<?php
class VehiculosM extends CI_model{

	function __construct()
	{
		parent:: __construct();
	}

	public function guardar(){ // en POST estan los datos del vehiculo a guardar en la BD
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

	public function misVehiculos(){ // los datos de los vehiculos del usuario en SESSION
		$this->db->select('*')->from('vehiculo')->where(array('idConductor' => $_SESSION['email'] ));
		$query = $this->db->get();
		return $query->result();
	}

	public function eliminarVehiculo(){ // en POST esta el id del vehiculo que quiero eliminar
		$this->db->delete('vehiculo', array('id' => ($this->input->post('id'))));
	}

	public function obtenerDatosDeVehiculo(){ // En POST esta el id del vehiculo del cual quiero los datos
		$this->db->select('*')->from('vehiculo')->where(array('id' => ($this->input->post('id'))));
		$query = $this->db->get();
		return ($query->result()[0]);
	}

	public function modificarVehiculo(){ //En POST estan los datos a modificar del vehiculo
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

	public function listaDeMatriculas(){ // Devuelve las matriculas del usuario en SESSION
		$this->db->select('matricula')->from('vehiculo')->where(array('idConductor' => $_SESSION['email']));
		$query = $this->db->get();
		return $query->result();
	}

	public function obtenerAsientosVehiculo(){ // En POST esta la matricula
		$matricula = $this->input->post('matricula');
		$this->db->select('asientos')->from('vehiculo')->where(array('matricula' => $matricula));
		$query = $this->db->get();
		$vehiculo = $query->result()[0];
		return $vehiculo->asientos;
	}
}

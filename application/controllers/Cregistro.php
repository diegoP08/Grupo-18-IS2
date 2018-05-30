<?php
/**
*
*/
class Cregistro extends CI_Controller
{

	function __construct(){
		parent:: __construct();
		$this->load->model('Mregistro');
	}
	public function index(){
		$datos['bool']= ' ';
		$this->load->view('Vregistro',$datos);
	}
	public function guardar(){
		$this->form_validation->set_rules('contrasena', 'Contrasena', 'required|min_length[8],',array('required' => 'Ingrese contraseña','min_length' => 'La contraseña debe tener como minimo 8 caracteres'));
		if($this->form_validation->run()== TRUE){
			if($this->Mregistro->guardar()){
				$datos['bool'] = 'exito';
				$this->load->view('Vregistro',$datos);
				return true;
			}else{
				 $datos['bool'] = 'ya registrado';
				 $this->load->view('Vregistro',$datos);
				 return false;
			}
		}
		$datos['bool'] = 'fracaso';	
		$this->load->view('Vregistro',$datos);
	}
}

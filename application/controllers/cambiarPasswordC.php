<?php

class CambiarPasswordC extends CI_Controller{

	function __construct(){
		parent:: __construct();
	}

  function index(){
    $datos['bool']= ' ';
  	$this->load->view('cambiarPasswordV', $datos);
  }

  public function cambiar(){
      $this->form_validation->set_rules('passwordActual', 'Contraseña actual', 'required|min_length[8],',array('required' => 'Ingrese contraseña actual','min_length' => 'La contraseña debe tener 8 o mas caracteres'));
      $this->form_validation->set_rules('passwordNueva', 'Contraseña nueva', 'required|min_length[8],',array('required' => 'Ingrese contraseña nueva','min_length' => 'La contraseña debe tener 8 o mas caracteres'));
      $this->form_validation->set_rules('confirmarPassword', 'Confirmar contraseña', 'required|min_length[8],',array('required' => 'Ingrese la confirmacion','min_length' => 'La contraseña debe tener 8 o mas caracteres'));
      if($this->form_validation->run()== TRUE){
        $passActual= $this->input->post('passwordActual');
        $passNueva= $this->input->post('passwordNueva');
        $confirmarPass= $this->input->post('confirmarPassword');
        $this->load->model('CambiarPasswordM');
        $userid = $_SESSION['id'];
        $contrasena = $this->CambiarPasswordM->obtenerPassword($userid);
        if($contrasena->contrasena == $passActual){
          if($passNueva == $confirmarPass){
            if($this->CambiarPasswordM->updatePassword($passNueva, $userid)){
              $datos['bool'] = 'exito';
            }else{
              $datos['bool'] = 'fallo';
            }
          }else{
            $datos['bool'] = 'noCoincide';
          }
        }else{
          $datos['bool'] = 'actualNoCoincide';
        }
        $this->load->view('cambiarPasswordV', $datos);
      }else{
        $datos['bool'] = 'error';
        $this->load->view('cambiarPasswordV', $datos);
      }
  }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VerPerfilC extends CI_Controller {
		public function __construct()
        {
            parent::__construct();
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
        }

		public function index($error = ' '){
			$this->load->model('verPerfilM');
			/////////////////// Monedero
			$puntuacion['error'] = $error;
			$viajes = $this->verPerfilM->miMonedero();
			$puntuacion['monedero'] = 0;
			foreach ($viajes as $viaje)
			{
				$puntuacion['monedero']  += $viaje->monedero;
			}
			$puntuacion['monedero'] = round($puntuacion['monedero'],2 );


			///////// Calificaciones
			$puntuacion['puntuacion'] = $this->verPerfilM->misPuntuaciones();
			if($puntuacion['puntuacion'] == NULL){
					$puntuacion['puntuacion'] = 0;
			}elseif($puntuacion['puntuacion'] < 0){
				$puntuacion['puntuacion'] = 0;
			}
			$puntuacion['deshabilito']=' ';

			$this->load->view('verPerfilV', $puntuacion);
		}

		public function upload_file(){
			// elimina y si la carga falla tira error la proxima vez (solucionar).
      $config['upload_path'] = './assets/img/';
			$config['overwrite'] = FALSE;
			$new_name = "usuario" . $_SESSION['id'] . "repe0";
			$config['file_name'] = $new_name;
      $config['allowed_types']        = 'jpg|png';
      $config['max_size']             = 100;
      $config['max_width']            = 1024;
      $config['max_height']           = 768;
      $this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (  $this->upload->do_upload('userfile')){
				if ($_SESSION['fotoPerfil'] != "usuario.jpg") {
					unlink('./assets/img/' . $_SESSION['fotoPerfil']);
				}
				$_SESSION['fotoPerfil'] = $this->upload->data('file_name');
        $data = array('upload_data' => $this->upload->data());
				$nuevo = array('fotoPerfil' => $this->upload->data('file_name'));
				$this->db->where('email', $_SESSION['email']);
				$this->db->update('usuario', $nuevo);
				redirect('/verPerfilC', 'refresh');
      }else {
				$this->index("imagenIncorrecta");
      }

    }
    	public function deshabilitar()
	{
		$this->load->model('verPerfilM');
		if (( $this->verPerfilM->noTieneViajesComoConductor())&&($this->verPerfilM->noTieneViajesComoAcompañante())) {
			$this->verPerfilM->deshabilitar();
			$puntuacion['error'] = ' ';
			$viajes = $this->verPerfilM->miMonedero();
			$puntuacion['monedero'] = 0;
			foreach ($viajes as $viaje)
			{
				$puntuacion['monedero']  += $viaje->monedero;
			}
			$puntuacion['monedero'] = round($puntuacion['monedero'],2 );


			///////// Calificaciones
			$puntuacion['puntuacion'] = $this->verPerfilM->misPuntuaciones();
			if($puntuacion['puntuacion'] == NULL){
					$puntuacion['puntuacion'] = 0;
			}elseif($puntuacion['puntuacion'] < 0){
				$puntuacion['puntuacion'] = 0;
			}
			$puntuacion['deshabilito']='deshabilitar';

			$this->load->view('verPerfilV', $puntuacion);
		}else{
			$puntuacion['error'] = ' ';
			$viajes = $this->verPerfilM->miMonedero();
			$puntuacion['monedero'] = 0;
			foreach ($viajes as $viaje)
			{
				$puntuacion['monedero']  += $viaje->monedero;
			}
			$puntuacion['monedero'] = round($puntuacion['monedero'],2 );


			///////// Calificaciones
			$puntuacion['puntuacion'] = $this->verPerfilM->misPuntuaciones();
			if($puntuacion['puntuacion'] == NULL){
					$puntuacion['puntuacion'] = 0;
			}elseif($puntuacion['puntuacion'] < 0){
				$puntuacion['puntuacion'] = 0;
			}
			$puntuacion['deshabilito']='tieneViajes';

			$this->load->view('verPerfilV', $puntuacion);
		}
		
	}



}

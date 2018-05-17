<?php
class VerPerfilC extends CI_Controller {

		public function index(){
			$this->load->model('verPerfilM');
			$puntuacion['puntuacion'] = $this->verPerfilM->misPuntuaciones();
			if($puntuacion['puntuacion'] == NULL){
					$puntuacion['puntuacion'] = 0;
			}elseif($puntuacion['puntuacion'] < 0){
				$puntuacion['puntuacion'] = 0;
			}
			$this->load->view('verPerfilV', $puntuacion);
		}
}

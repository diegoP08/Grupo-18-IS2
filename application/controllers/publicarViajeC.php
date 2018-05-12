<?php
class PublicarViajeC extends CI_Controller {

	public function index(){
		$this->load->view('publicarViajeV');
	}
	public function publicar(){
		echo $this->input->post('origen');
	}
}

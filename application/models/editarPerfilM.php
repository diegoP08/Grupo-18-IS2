<?php
class EditarPerfilM extends CI_model
{

	function __construct()
	{
		parent:: __construct();
	}

  public function editar($campos){
      $this->db->where('email' , $_SESSION['email']);
      $this->db->update('usuario', $campos);
      return true;
  }
}

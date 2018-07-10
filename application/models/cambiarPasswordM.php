<?php
class CambiarPasswordM extends CI_model
{

	function __construct()
	{
		parent:: __construct();
	}

  public function obtenerPassword($userid){
    $query = $this->db->where(['id' => $userid])
                      ->get('usuario');
    if($query->num_rows() > 0){
      return $query->row();
    }
  }

  public function updatePassword($passNueva, $userid){
    $data = array(
      'contrasena'=> $passNueva
    );
    return $this->db->where('id', $userid)
    ->update('usuario', $data);
  }
}

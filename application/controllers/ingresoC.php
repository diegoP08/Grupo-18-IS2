<?php
// En el controller va toda la funcionalidad que tendran las View
// y cargo las view a visualizar
class IngresoC extends CI_Controller{

	public function index(){
		$this->load->view('ingresoV');
	}

	public function login(){


		$this->form_validation->set_rules('email', 'Email','required',array('required' => 'Ingrese un email valido')); // los datos que requiero si o si para el login
		$this->form_validation->set_rules('contrasena', 'Contrasena', 'required|min_length[8],',array('required' => 'Ingrese contraseña','min_length' => 'La contraseña debe tener 8 o mas caracteres'));

		if($this->form_validation->run()== TRUE){ //chequea si los usuarios existen en la base de datos

			$email=$_POST['email'];// cargo el valor de username a la variable $username
			$contrasena=$_POST['contrasena'];

			$this->db->select('*'); //traigo toda la base de datos
			$this->db->from('usuario'); // desde la tabla users
			$this->db->where(array('email' => $email, 'contrasena' => $contrasena)); // donde se cumplen estos

			$query = $this->db->get();
			$user = $query->row();
			if(!is_null($user)){
				//setear las variables de sesion
				//$_SESSION['user_logged'] = TRUE; sirve para usar mas adelante en user.php para siaber si esta logeado o no
				$_SESSION['id'] = $user->id;
				$_SESSION['email'] = $user->email;
				$_SESSION['nombre'] = $user->nombre;
				$_SESSION['apellido'] = $user->apellido;
				$_SESSION['fechaDeNacimiento'] = $user->fechaDeNacimiento;
				$_SESSION['fotoPerfil'] = $user->fotoPerfil;
				$_SESSION['sexo'] = $user->sexo;
				$_SESSION['pais'] = $user->pais;
				$_SESSION['provincia'] = $user->provincia;
				$_SESSION['localidad'] = $user->localidad;
				$_SESSION['celular'] = $user->celular;

				redirect("inicioC", "refresh"); //redirecciona a la pagina de perfil
			}else{
				$this->form_validation->set_rules('email', 'Email', 'callback_error');
				$this->form_validation->run();
			}
		}
		$this->load->view('ingresoV');
	}

	public function cerrarSesion(){
		$this->session->sess_destroy();
		redirect('start');
	}

	public function error($str){
		$this->form_validation->set_message('error', 'Usuario o contraseña incorrectos');
		return FALSE;
	 }

}

<?php
// En el controller va toda la funcionalidad que tendran las View
// y cargo las view a visualizar
class IngresoC extends CI_Controller{

	public function logout(){
		unset($_SESSION); // deseteo la session actual
		session_destroy();
		redirect("auth/login", "refresh");
	}
	public function index(){
		$this->load->view('IngresoV');
	}

	public function login(){


		$this->form_validation->set_rules('username', 'Username','required'); // los datos que requiero si o si para el login
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');

		if($this->form_validation->run()== TRUE){ //chequea si los usuarios existen en la base de datos

			$username=$_POST['username'];// cargo el valor de username a la variable $username
			$password=md5($_POST['password']);

			$this->db->select('*'); //traigo toda la base de datos
			$this->db->from('users'); // desde la tabla users
			$this->db->where(array('username' => $username, 'password' => $password)); // donde se cumplen estos

			$query = $this->db->get();
			$user = $query->row();
			if(!is_null($user)){
				if($user->email){//si existe el usuario en base de datos
					$this->session->set_flashdata("success", "Logueado exitoso");// mensaje temporal si se logea

					//setear las variables de sesion
					$_SESSION['user_logged'] = TRUE; //sirve para usar mas adelante en user.php para siaber si esta logeado o no
					$_SESSION['username'] = $user->username;
					$_SESSION['gender'] = $user->gender;

					redirect("user/profile", "refresh"); //redirecciona a la pagina de perfil

				}
			}else{
				echo "<script type=\"text/javascript\">alert(\"Usuario o Contraseña incorrectos.\");</script>"; // muestra una alerta

			}
		}
		$error='<div class="alert alert-danger">Usuario o contraseña incorrectos</div>';
		$this->load->view('ingresoV',$error);// muestra una alerta

	}
	public function register(){

		if(isset($_POST['register'])){
			$this->form_validation->set_rules('username', 'Username','required');
			$this->form_validation->set_rules('email', 'Email', 'required'); //si quiero poner mas validaciones
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
			$this->form_validation->set_rules('password', 'Confirm Password', 'required|min_length[5]|matches[password]');
			$this->form_validation->set_rules('phone', 'Phone', 'required|min_length[5]');

			if($this->form_validation->run()== TRUE){// si la validacion del form es true
				echo "<script type=\"text/javascript\">alert(\"Usuario Registrado, Puedes Loguearte.\");</script>"; // Sirve para agregar un
				//echo 'form validated';                                                         // Alert de javaScript

				$data= array(//carga los datos de un usuario en data
					'username'=>$_POST['username'],
					'email'=>$_POST['email'],
					'password'=>md5($_POST['password']), //se pone md5 para encriptar el pw
					'gender'=>$_POST['gender'],
					'created_date'=>date('Y-m-d'),
					'phone'=>$_POST['phone']
				);
				$this->db->insert('users',$data); //cargo los datos de data(representa un usuario) a la base de datos

				//$this->session->set_flashdata("success","Su cuenta ha sido registrada. Puedes loguearte ahora."); Mete un mensaje cuando se refresh la pagina de registro.
																													//poner auth/register, refresh
				redirect("auth/login","refresh");
				//redirect("auth/register","refresh"); // redirecciona despues de registrarse exitosamente
			}
		}
		//carga la vista*/
		$this->load->view('register');
	}
}

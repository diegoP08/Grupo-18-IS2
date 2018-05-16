<?php
class VehiculosC extends CI_Controller {

	public function index(){
		$this->load->view('vehiculosV');
	}
	public function obtenerFormularioAnadir(){ // devuelve en html el formulario a ingresar para agregar un vehiculo
		echo 	'<div class="row justify-content-center" id="formularioAgregar">
						<div class="col-5">
							<br>
							<h3>Ingrese los datos del vehiculo</h3>
							<div id="alerta"></div>
							<form method="POST" action="return false" onsubmit="return false">
								<div class="form-group">
									<label for="matricula">Matricula</label>
									<input type="text" class="form-control" id="matricula">
								</div>
								<div class="form-group">
									<label for="marca">Marca</label>
									<input type="text" class="form-control" id="marca">
								</div>
								<div class="form-group">
									<label for="modelo">Modelo</label>
									<input type="text" class="form-control" id="modelo">
								</div>
								<div class="form-group">
									<label for="asientos">Numero de asientos</label>
									<input type="number" min="1" class="form-control" id="asientos">
								</div>
								<div class="row justify-content-center">
									<button type="submit" class="btn btn-primary" onclick="anadirVehiculo()">Añadir Vehiculo</button>
								</div>
								<br>
							</form>
						</div>
					</div>';
	}

  public function anadir(){ // En POST los datos a añadir del vehiculo
    $this->form_validation->set_rules('matricula', 'Matricula','required');
		$this->form_validation->set_rules('modelo', 'Modelo','required');
		$this->form_validation->set_rules('marca', 'Marca','required');
		$this->form_validation->set_rules('asientos', 'Asientos','required');

		if($this->form_validation->run()== TRUE){
			$this->load->model('vehiculosM'); // Cargo el modelo.
			if($this->vehiculosM->guardar()){ //Guardar del model toma los valores por $_POST[], es por eso que no creo un array
				echo '<div class="alert alert-success"> Se añadio el vehiculo correctamente </div>';
			}else{
				echo '<div class="alert alert-danger"> La matricula del vehiculo ya esta registrada </div>';
			}
		}else{
			echo '<div class="alert alert-danger"> Complete todos los campos </div>';
		}
  }

	public function listaDeVehiculos(){ // Vehiculos del usuario en SESSION
		$this->load->model('vehiculosM');
		$listaVehiculos = $this->vehiculosM->misVehiculos();
		if (! $listaVehiculos){
			echo '<div class="alert alert-primary">No tiene vehiculos cargados</div>';
		}else{
			foreach ($listaVehiculos as $vehiculo){
				$id = $vehiculo->id;
				$matricula = $vehiculo->matricula;
				$marca = $vehiculo->marca;
				$modelo = $vehiculo->modelo;
				$asientos = $vehiculo->asientos;
				echo 	'<div class="container" style="border-width: 1px; border-style: solid;">';
				echo 	'<br>';
				echo 		'<div class="row">';
				echo 			'<div class="col-5">';
				echo 				'<h4>Matricula: ',$matricula,'</h4>';
				echo 				'<h4>Marca: ', $marca, '<h4>';
				echo 			'</div>';
				echo 			'<div class="col-5">';
				echo 				'<h4>Asientos: ',$asientos,'</h4>';
				echo 				'<h4>Modelo: ', $modelo, '<h4>';
				echo 			'</div>';
				echo 			'<div class="col-1">';
				echo 				'<button style="margin-bottom: 10px" type="button" class="btn btn-primary btn-sm" onclick="cargarFormularioModificacion(',$id,')">Modificar</button>';
				echo 				'<button type="button" class="btn btn-danger btn-sm" onclick="eliminar(',$id,')">Eliminar</button>';
				echo 			'</div>';
				echo 		'</div>';
				echo 	'<br>';
				echo 	'</div>';
			}
		}
	}

	public function eliminarVehiculo(){ // eliminar el vehiculo, en POST esta el id
		$this->load->model('vehiculosM');
		$this->vehiculosM->eliminarVehiculo();
	}

	public function obtenerFormularioModificacion(){ // Retorna el formulario html a rellenar para modificar un vehiculo
		$this->load->model('vehiculosM');
		$vehiculo = $this->vehiculosM->obtenerDatosDeVehiculo();
		$id = $_POST['id'];
		$matricula = $vehiculo->matricula;
		$marca = $vehiculo->marca;
		$modelo = $vehiculo->modelo;
		$asientos = $vehiculo->asientos;
		echo '<div class="row justify-content-center" id="formularioModificar">
						<div class="col-5">
							<br>
							<h3>Ingrese los datos del vehiculo</h3>
							<div id="alertaM"></div>
							<form method="POST" action="return false" onsubmit="return false">
								<div class="form-group">
									<label for="matriculaM">Matricula</label>
									<input type="text" class="form-control" id="matriculaM" value="',$matricula,'">
								</div>
								<div class="form-group">
									<label for="marcaM">Marca</label>
									<input type="text" class="form-control" id="marcaM" value="',$marca,'">
								</div>
								<div class="form-group">
									<label for="modeloM">Modelo</label>
									<input type="text" class="form-control" id="modeloM" value="',$modelo,'">
								</div>
								<div class="form-group">
									<label for="asientosM">Numero de asientos</label>
									<input type="number" min="1" class="form-control" id="asientosM" value="',$asientos,'">
								</div>
								<div class="row justify-content-center">
									<button type="submit" class="btn btn-primary" onclick="modificarVehiculo(',$id,')">Guardar cambios</button>
								</div>
							</form>
						</div>
					</div>';
	}

	public function modificarVehiculo(){ // en POST estan los datos a ingresar
		$this->load->model('vehiculosM');
		$this->form_validation->set_rules('matricula', 'Matricula','required');
		$this->form_validation->set_rules('modelo', 'Modelo','required');
		$this->form_validation->set_rules('marca', 'Marca','required');
		$this->form_validation->set_rules('asientos', 'Asientos','required');

		if($this->form_validation->run()== TRUE){
			if($vehiculo = $this->vehiculosM->modificarVehiculo()){
				echo "exito";
			}else{
				echo '<div class="alert alert-danger"> La matricula del vehiculo ya esta registrada </div>';
			}
		}else{
			echo '<div class="alert alert-danger"> Complete todos los campos </div>';
		}
	}

	public function listaDeMatriculas(){ // obtener las matriculas de los vehiculos del usuario de la SESSION
		$this->load->model('vehiculosM');
		$vehiculos = $this->vehiculosM->listaDeMatriculas();
		foreach ($vehiculos as $vehiculo){
			$matricula = $vehiculo->matricula;
			echo '<option value="',$matricula,'">',$matricula,'</option>';
		}
	}

	public function obtenerCapacidadVehiculo(){ // en POST esta la matricula del vehiculo del cual busco su capacidad
		$this->load->model('vehiculosM');
		echo $this->vehiculosM->obtenerAsientosVehiculo();
	}

}

<?php
class PublicarViajeC extends CI_Controller {

	public function index(){
		$this->load->view('publicarViajeV');
	}

	public function publicar(){
		$this->load->model('vehiculosM');
		$this->load->model('publicarViajeM');

		// controlo valores negativos y cero
		if($_POST['cupo'] <= 0 || $_POST['duracionHrs'] < 0 || $_POST['duracionMin'] < 0 || $_POST['monto'] <= 0 || ($_POST['duracionHrs'] == 0 && $_POST['duracionMin'] == 0)){
			echo '<div class="alert alert-danger">Ingrese valores admitidos</div>';
			return 0;
		}

		// controlo que cupo este dentro del rango correspondiente
		if ($_POST['cupo'] > $this->vehiculosM->obtenerAsientosVehiculo() | $_POST['duracionMin'] > 59) {
			echo '<div class="alert alert-danger">Ingrese valores admitidos</div>';
			return 0;
		}

		//controlo que el usuario no poseea calificaciones pendientes con mas de 30 dias
		if ($this->publicarViajeM->obtenerCalificacionesPendientesDe30Dias()) {
			echo '<div class="alert alert-danger">Posee calificaciones pendientes de un viaje realizado hace 30 dias o mas</div>';
			return 0;
		}

		//empiezo con el alta de la/s publicacion/es
		if ($_POST['tipo'] == "ocasional") {
			date_default_timezone_set('America/Argentina/La_Rioja');
			// controlo que fecha no sea menor a la de mañana (24horas), si es ocasional
			if (new DateTime($_POST['fechaHoraSalida']) < date_add(new DateTime(), date_interval_create_from_date_string('1 days'))) {
				echo '<div class="alert alert-danger">Ingrese una fecha y hora de salida con antelacion de 24 horas</div>';
				return 0;
			}
			if($this->publicarViajeM->guardar()){ // datos a guardar estan en POST
				echo 'exito';
				return 0;
			}else{
				echo '<div class="alert alert-danger">El viaje se superpone con otros viajes</div>';
			}
		}else {
			/*ATENCION: EN ESTE CASO ESTOY IGNORANDO SI HAY INTERPOSICIONES, ES DECIR, NO LAS GUARDO PERO TAMPOCO INFORMO AL USUARIO*/
			date_default_timezone_set('America/Argentina/La_Rioja');
			// fechaSalida sera para incrementar en dias, sumo 1 dia
			$fechaSalida = date_add(new DateTime($_POST['fechaHoraSalida']), date_interval_create_from_date_string('1 days'));

			if ($fechaSalida > date_add(new DateTime(), date_interval_create_from_date_string('1 days'))) {
				$_POST['fechaHoraSalida'] = $fechaSalida->format('Y-m-d H:i:s'); // actualizo post
				$this->publicarViajeM->guardar();
			}
			for ($i=0; $i < 9; $i++) {
				$fechaSalida = date_add($fechaSalida, date_interval_create_from_date_string('1 days')); // sumo 1 dia
				$_POST['fechaHoraSalida'] = $fechaSalida->format('Y-m-d H:i:s'); // actualizo post
				$this->publicarViajeM->guardar();
			}
			echo "exito";
		}
	}

	public function obtenerFormulario(){ //tipo de publicacion para mostrar el formulario esta en $_POST['tipoPublicacion']
		echo '<div class="row">
            <div class="col-6">
              <div class="form-group">
                <div style="color: #FF0000; display:inline-block">*</div>
                <label for="salida" class="mb-0">Desde:</label>
                <small class="form-text mt-0">Seleccione una ciudad de las recomendadas en los campos de selección</small>
                <input type="text" class="form-control" id="salida" name="salida">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <div style="color: #FF0000; display:inline-block">*</div>
                <label for="destino" class="mb-0">Hasta:</label>
                <small class="form-text mt-0">Seleccione una ciudad de las recomendadas en los campos de selección</small>
                <input type="text" class="form-control" id="destino" name="destino">
              </div>
            </div>
          </div>
          <br>
          <div class="row">';
					//agrega input fecha salida si es ocacional
					if($_POST['tipoPublicacion'] == "ocasional"){
					echo
            '<div class="col-3">
              <div class="form-group">
                <div style="color: #FF0000; display:inline-block">*</div>
                <label for="fecha">Fecha de salida:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" min="',date('Y-m-d'),'">
              </div>
            </div> ';
					}

					echo '<div class="';

					//agrega col-3 si es ocacional o col-6 caso contrario
					if ($_POST['tipoPublicacion'] == "ocasional") {
						echo "col-3";
					}else{
						echo "col-6";
					}

					echo '">
              <div class="form-group">
                <div style="color: #FF0000; display:inline-block">*</div>
                <label for="hora">Hora de salida:</label>
                <input type="time" class="form-control" id="hora" name="hora">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <div style="color: #FF0000; display:inline-block">*</div>
                <label>Duracion:</label>
                <div class="row">
                  <div class="col-5">
                    <input type="number" class="form-control" id="duracionHrs" name="duracionHrs" min="0">
                  </div>
                  <h6 class="align-self-center">hrs</h6>
                  <div class="col-5">
                    <input type="number" class="form-control" id="duracionMin" name="duracionMin" min ="0" max="59">
                  </div>
                  <h6 class="align-self-center">min</h6>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-4">
              <div style="color: #FF0000; display:inline-block">*</div>
              <label for="costo">Costo total del viaje:</label>
              <input type="number" class="form-control" id="costo" name="costo" min="1">
            </div>
            <div class="col-4">
              <div style="color: #FF0000; display:inline-block">*</div>
              <label for="matricula">Vehiculo: </label>
              <select class="custom-select" id="matricula" onchange="hablilitarCupo(value)">
                <option value="" disabled selected>Seleccione una matricula</option>
              </select>
            </div>
            <div id="capacidad" class="col-4" style="display: none">
              <div style="color: #FF0000; display:inline-block">*</div>
              <label for="cupo">Lugares disponibles:</label>
              <input type="number" class="form-control" id="cupo" name="cupo" min="1">
            </div>
          </div>
          <br>
          <div class="form-group" style="color:white">
              <label for="descripcion" class="mb-0">Descripción de tu publicación:</label>
              <small class="form-text mt-0">Puede ingresar datos adicionales del vehiculo, si quiere que sus pasajeros sean puntuales, etc</small>
              <textarea id="descripcion" name="descripcion" class="form-control" style="resize: none"></textarea>
          </div>
          <br>
					<div id="alerta"></div>
          <div class="row justify-content-center">
            <button  style="background-color: #f37277; border-color:#f37277" class="btn btn-primary" onclick="comprobar()">Publicar Viaje</button>
          </div>
          <br>';
	}
}

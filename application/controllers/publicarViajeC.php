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
			//Realizo la operacion para guardar el viaje en la Base de Datos
			if($this->publicarViajeM->guardar()){ // datos a guardar estan en POST
				echo 'exito';
				return 0;
			}else{
				echo '<div class="alert alert-danger">El viaje se superpone con otros viajes</div>';
			}

		}else {
			$exito = true;
			date_default_timezone_set('America/Argentina/La_Rioja');
			$fechasCargadas= array();
			// fechaSalida sera para incrementar en dias, sumo 1 dia
			$miFechaHoraSalida = (new DateTime($_POST['fechaHoraSalida']))->add(new DateInterval('P1D'));

			//Comprueba que la primer publicacion exceda las 24 horas y que este disponible.
			if ($miFechaHoraSalida > (new DateTime())->add(new DateInterval('P1D'))){
				$_POST['fechaHoraSalida'] = $miFechaHoraSalida->format('Y-m-d H:i:s'); // actualizo post
				if (! $this->publicarViajeM->fechaDisponible()){
					$exito = false;
					echo '<div class="alert alert-danger">El viaje con fecha ',$_POST['fechaHoraSalida'],' se superpone con otros viajes</div>';
				}else{
					$fechasCargadas[0] = new DateTime($_POST['fechaHoraSalida']);
				}
			}

			$minutos = $_POST['duracionHrs'] * 60 + $_POST['duracionMin'];
			$minutos = $minutos . " minutes";
			$minutos = date_interval_create_from_date_string($minutos);

			//Evaluo disponibilidad de las siguientes 9 fechas.
			for ($i=1; $i < 10; $i++) {
				$miFechaHoraSalida->add(new DateInterval('P1D')); // sumo 1 dia
				$_POST['fechaHoraSalida'] = $miFechaHoraSalida->format('Y-m-d H:i:s'); // actualizo post
				//evaluo disponibilidad en la Base de Datos
				if (! $this->publicarViajeM->fechaDisponible()){
					$exito = false;
					echo '<div class="alert alert-danger">El viaje con fecha ',$_POST['fechaHoraSalida'],' se superpone con otros viajes</div>';
				}else{
					//evaluo disponibilidad en las fechas a guardar.
					$miFechaHoraLlegada = date_add(new DateTime($_POST['fechaHoraSalida']) , $minutos);
					$fechaDisponible = true;
					foreach ($fechasCargadas as $fechaHoraSalida) {
						$fechaHoraLlegada = date_add(new DateTime($fechaHoraSalida->format('Y-m-d H:i:s')) , $minutos);
						if ((($fechaHoraSalida >= $miFechaHoraSalida) && ($fechaHoraSalida <= $miFechaHoraLlegada))  ||
								(($fechaHoraLlegada >= $miFechaHoraSalida) && ($fechaHoraSalida <= $miFechaHoraLlegada)) ||
								(($fechaHoraSalida <= $miFechaHoraSalida) && ($fechaHoraLlegada >= $miFechaHoraLlegada))  ) {
							$fechaDisponible = false;
						}
					}
					if ($fechaDisponible){
						$fechasCargadas[$i] = new DateTime($_POST['fechaHoraSalida']);
					}else{
						$exito = false;
						echo '<div class="alert alert-danger">El viaje con fecha ',$_POST['fechaHoraSalida'],' se superpone con otros viajes</div>';
					}
				}
			}
			if($exito){
				echo "exito";
			}else{
				echo '<div id="mensajeDiaria"></div>
							<div class="row justify-content-center">
								<div>
									<button class="btn btn-success" onclick="realizarPublicacionDiaria()">Publicar omitiendo superpuestas</button>
									<a class="btn btn-danger" href="',site_url('publicarViajeC'),'">Cancelar</a>
								</div>
							</div>
							<br>';
			}
		}
	}

	public function publicarDiaria(){
		$this->load->model('publicarViajeM');
		date_default_timezone_set('America/Argentina/La_Rioja');
		// fechaSalida sera para incrementar en dias, sumo 1 dia
		$miFechaHoraSalida = (new DateTime($_POST['fechaHoraSalida']))->add(new DateInterval('P1D'));

		//Comprueba que la primer publicacion exceda las 24 horas y que este disponible.
		if ($miFechaHoraSalida > (new DateTime())->add(new DateInterval('P1D'))){
			$_POST['fechaHoraSalida'] = $miFechaHoraSalida->format('Y-m-d H:i:s'); // actualizo post
			$this->publicarViajeM->guardar();
		}
		for ($i=1; $i < 10 ; $i++) {
			$miFechaHoraSalida->add(new DateInterval('P1D')); // sumo 1 dia
			$_POST['fechaHoraSalida'] = $miFechaHoraSalida->format('Y-m-d H:i:s'); // actualizo post
			$this->publicarViajeM->guardar();
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
                <input type="date" class="form-control" id="fecha" name="fecha" min="',date('Y-m-d'),'" max="9999-12-31">
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
            <button  type="button" style="background-color: #f37277; border-color:#f37277" class="btn btn-primary" onclick="comprobar()">Publicar Viaje</button>
          </div>
          <br>';
	}
}

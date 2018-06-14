<?php
class MisViajesC extends CI_controller {

	public function index() {
		$this->load->view('misViajesV');
	}

  public function viajesOfrecidosActivos(){
    $this->load->model('misViajesM');
		$viajes = $this->misViajesM->viajesOfrecidosActivos();
		if (! $viajes) {
			echo '<div class="alert alert-primary" align="center">No posee viajes activos</div>';
		}
    foreach ($viajes as $viaje):
			$fechaHoraSalida = new DateTime($viaje->fechaHoraSalida);
			$tomorrow = (new DateTime())->add(new DateInterval('P1D'));
			$faltanMasDe24Horas = $fechaHoraSalida > $tomorrow;
      $duracion= (new DateTime($viaje->fechaHoraLlegada))->diff(new DateTime($viaje->fechaHoraSalida));
			$aceptados = $this->misViajesM->copilotosDeViaje($viaje->id);
			$pendientes = $this->misViajesM->inscripcionesPendientesDeViaje($viaje->id);
      echo  '<div>
              <table class="table table-striped table-dark table-bordered" style="box-shadow: 0px 0px 10px 4px black;">
                <tbody href="">
                  <tr>
                    <td colspan="6">
                      <div class="float-right">';
      echo             '<button onclick="modificarPanel(', $viaje->id ,')" data-toggle="modal" data-target="#panelAdministracion" class="btn btn-outline-info btn-sm" type="button">Administrar copilotos</button> ';
      echo 						 '<button onclick="modificarModalEliminarViaje(', $viaje->id ,')" data-toggle="modal" data-target="#mensajeEliminarViaje" class="btn btn-outline-danger btn-sm" ', ($aceptados | !$faltanMasDe24Horas) ? "disabled" : "" ,' type="button">Eliminar</button> ';
      echo             '<button class="btn btn-outline-light btn-sm"', ($pendientes | $aceptados | !$faltanMasDe24Horas) ? "disabled" : "" ,' type="button">Editar</button>
                        <button class="btn btn-outline-primary btn-sm" onclick="location.href=\'', site_url('/verViajeC/cargarViaje/') , $viaje->id ,'\'" type="button">Ver viaje</button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row"><img src="', base_url() ,  'assets/img/locationSalida.png"' ,'style="height: 15px; margin-bottom: 4px">Desde</th>
                    <td colspan="5">',  $viaje->salida ,'</td>
                  </tr>
                  <tr>
                    <th scope="row"><img src="', base_url() ,  'assets/img/locationLlegada.png"' ,'style="height: 15px; margin-bottom: 4px">Hasta</th>
                    <td colspan="5">', $viaje->destino ,'</td>
                  </tr>
                  <tr>
                    <th scope="row"><img src="', base_url() ,  '/assets/img/calendarioFecha.png"' ,'style="height: 15px; margin-bottom: 4px; margin-right: 2px">Fecha de Salida</th>
                    <td>', date( "d-m-Y", strtotime($viaje->fechaHoraSalida)) ,'</td>
                    <th scope="row">Hora de salida</th>
                    <td>', date( "H:i", strtotime( $viaje->fechaHoraSalida)) ,' hs' ,'</td>
                    <th scope="row">Duracion</th>
                    <td>', (($duracion->format("%a") * 24) + $duracion->format("%H")) , ':' , $duracion->format("%I") ,'</td>
                  </tr>
                  <tr>
                    <th scope="row"><img src="', base_url() ,  '/assets/img/simboloPesos.png"' ,'style="height: 15px; margin-bottom: 4px; margin-right: 2px">Costo del viaje</th>
                    <td colspan="5">', round($viaje->monto /(($viaje->cupo) + 1), 2) ,'</td>
                  </tr>
									<tr>
                    <th scope="row">Copilotos</th>
                    <td colspan="2"> Aceptados: ', $aceptados ,'</td>
										<td colspan="3"> Pendientes: ', $pendientes ,'</td>
                  </tr>
                </tbody>
              </table>
            </div>';
    endforeach;
  }

  public function viajesOfrecidosRealizados(){
    $this->load->model('misViajesM');
    $viajes = $this->misViajesM->viajesOfrecidosRealizados();
		if (! $viajes) {
			echo '<div class="alert alert-primary" align="center">No posee viajes realizados</div>';
		}
    foreach ($viajes as $viaje):
      $duracion= (new DateTime($viaje->fechaHoraLlegada))->diff(new DateTime($viaje->fechaHoraSalida));
      echo  '<div>
              <table class="table table-striped table-dark table-bordered" style="box-shadow: 0px 0px 10px 4px black;">
                <tbody href="">
                  <tr>
                    <td colspan="6">
                      <div class="float-right">
                        <button class="btn btn-outline-primary btn-sm" onclick="location.href=\'', site_url('/verViajeC/cargarViaje/') , $viaje->id ,'\'" type="button">Ver viaje</button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row"><img src="', base_url() ,  'assets/img/locationSalida.png"' ,'style="height: 15px; margin-bottom: 4px">Desde</th>
                    <td colspan="5">',  $viaje->salida ,'</td>
                  </tr>
                  <tr>
                    <th scope="row"><img src="', base_url() ,  'assets/img/locationLlegada.png"' ,'style="height: 15px; margin-bottom: 4px">Hasta</th>
                    <td colspan="5">', $viaje->destino ,'</td>
                  </tr>
                  <tr>
                    <th scope="row"><img src="', base_url() ,  '/assets/img/calendarioFecha.png"' ,'style="height: 15px; margin-bottom: 4px; margin-right: 2px">Fecha de Salida</th>
                    <td>', date( "d-m-Y", strtotime($viaje->fechaHoraSalida)) ,'</td>
                    <th scope="row">Hora de salida</th>
                    <td>', date( "H:i", strtotime( $viaje->fechaHoraSalida)) ,' hs' ,'</td>
                    <th scope="row">Duracion</th>
                    <td>', (($duracion->format("%a") * 24) + $duracion->format("%H")) , ':' , $duracion->format("%I") ,'</td>
                  </tr>
                  <tr>
                    <th scope="row"><img src="', base_url() ,  '/assets/img/simboloPesos.png"' ,'style="height: 15px; margin-bottom: 4px; margin-right: 2px">Costo del viaje</th>
                    <td colspan="5">', round($viaje->monto /(($viaje->cupo) + 1), 2) ,'</td>
                  </tr>
                </tbody>
              </table>
            </div>';
    endforeach;
  }

  public function viajesComoAcompananteActivos(){
    $this->load->model('misViajesM');
    $viajes = $this->misViajesM->viajesComoAcompananteActivos();
		if (! $viajes) {
			echo '<div class="alert alert-primary" align="center">No posee viajes activos</div>';
		}
    foreach ($viajes as $viaje):
      $duracion= (new DateTime($viaje->fechaHoraLlegada))->diff(new DateTime($viaje->fechaHoraSalida));
			$fechaHoraSalida = new DateTime($viaje->fechaHoraSalida);
			$tomorrow = (new DateTime())->add(new DateInterval('P1D'));
			$faltanMasDe24Horas = $fechaHoraSalida > $tomorrow;
      echo  '<div>
              <table class="table table-striped table-dark table-bordered" style="box-shadow: 0px 0px 10px 4px black;">
                <tbody href="">
                  <tr>
                    <td colspan="6">
                      <div class="float-right">';
											if ($faltanMasDe24Horas){ // imprimo botones para realizar las acciones
												if ($viaje->estadoInscripcion == "pendiente") {
													echo 	'<button type="button" class="btn btn-outline-danger btn-sm" onclick="modificarModalParaCancelar(', $viaje->idInscripcion ,')" data-toggle="modal" data-target="#mensajeCancelarSolicitud">Cancelar Solicitud </button> ';
												}elseif ($viaje->estadoInscripcion == "aceptada") {
													echo 	'<button type="button" class="btn btn-outline-danger btn-sm" onclick="modificarModalParaEliminar(', $viaje->idInscripcion ,')" data-toggle="modal" data-target="#mensajeCancelarSolicitud">Cancelar Participacion </button> ';
													echo 	'<button type="button" class="btn btn-outline-success btn-sm">Pagar Viaje </button> ';
												}elseif ($viaje->estadoInscripcion == "pagada") {
													echo '<div style="display: inline">¡Bien hecho! tu inscripción esta pagada</div> ';
												}else{
													echo '<div style="display: inline">Se cancelo o rechazo la inscripción</div> ';
												}
											}elseif($viaje->estadoInscripcion != "cancelada" & $viaje->estadoInscripcion != "rechazada"){
												echo '<div style="display: inline">Al viaje le quedan menos de 24 horas para realizarse</div> ';
											}else{
												echo '<div style="display: inline">Se cancelo o rechazo la inscripción</div> ';
											}
									echo 	'<button class="btn btn-outline-primary btn-sm" onclick="location.href=\'', site_url('/verViajeC/cargarViaje/') , $viaje->id ,'\'" type="button">Ver viaje</button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row"><img src="', base_url() ,  'assets/img/locationSalida.png"' ,'style="height: 15px; margin-bottom: 4px">Desde</th>
                    <td colspan="5">',  $viaje->salida ,'</td>
                  </tr>
                  <tr>
                    <th scope="row"><img src="', base_url() ,  'assets/img/locationLlegada.png"' ,'style="height: 15px; margin-bottom: 4px">Hasta</th>
                    <td colspan="5">', $viaje->destino ,'</td>
                  </tr>
                  <tr>
                    <th scope="row"><img src="', base_url() ,  '/assets/img/calendarioFecha.png"' ,'style="height: 15px; margin-bottom: 4px; margin-right: 2px">Fecha de Salida</th>
                    <td>', date( "d-m-Y", strtotime($viaje->fechaHoraSalida)) ,'</td>
                    <th scope="row">Hora de salida</th>
                    <td>', date( "H:i", strtotime( $viaje->fechaHoraSalida)) ,' hs' ,'</td>
                    <th scope="row">Duracion</th>
                    <td>', (($duracion->format("%a") * 24) + $duracion->format("%H")) , ':' , $duracion->format("%I") ,'</td>
                  </tr>
                  <tr>
                    <th scope="row"><img src="', base_url() ,  '/assets/img/simboloPesos.png"' ,'style="height: 15px; margin-bottom: 4px; margin-right: 2px">Costo del viaje</th>
                    <td colspan="5">', round($viaje->monto /(($viaje->cupo) + 1), 2) ,'</td>
                  </tr>
                  <tr>
                    <th scope="row">Estado de la inscripción</th>
                    <td colspan="5">', ucfirst($viaje->estadoInscripcion) ,'</td>
                  </tr>
                </tbody>
              </table>
            </div>';
    endforeach;
  }

  public function viajesComoAcompananteRealizados(){
    $this->load->model('misViajesM');
    $viajes = $this->misViajesM->viajesComoAcompananteRealizados();
		if (! $viajes) {
			echo '<div class="alert alert-primary" align="center">No posee viajes realizados</div>';
		}
    foreach ($viajes as $viaje):
      $duracion= (new DateTime($viaje->fechaHoraLlegada))->diff(new DateTime($viaje->fechaHoraSalida));
      echo  '<div>
              <table class="table table-striped table-dark table-bordered" style="box-shadow: 0px 0px 10px 4px black;">
                <tbody href="">
                  <tr>
                    <td colspan="6">
                      <div class="float-right">
                        <button class="btn btn-outline-primary btn-sm" onclick="location.href=\'', site_url('/verViajeC/cargarViaje/') , $viaje->id ,'\'" type="button">Ver viaje</button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row"><img src="', base_url() ,  'assets/img/locationSalida.png"' ,'style="height: 15px; margin-bottom: 4px">Desde</th>
                    <td colspan="5">',  $viaje->salida ,'</td>
                  </tr>
                  <tr>
                    <th scope="row"><img src="', base_url() ,  'assets/img/locationLlegada.png"' ,'style="height: 15px; margin-bottom: 4px">Hasta</th>
                    <td colspan="5">', $viaje->destino ,'</td>
                  </tr>
                  <tr>
                    <th scope="row"><img src="', base_url() ,  '/assets/img/calendarioFecha.png"' ,'style="height: 15px; margin-bottom: 4px; margin-right: 2px">Fecha de Salida</th>
                    <td>', date( "d-m-Y", strtotime($viaje->fechaHoraSalida)) ,'</td>
                    <th scope="row">Hora de salida</th>
                    <td>', date( "H:i", strtotime( $viaje->fechaHoraSalida)) ,' hs' ,'</td>
                    <th scope="row">Duracion</th>
                    <td>', (($duracion->format("%a") * 24) + $duracion->format("%H")) , ':' , $duracion->format("%I") ,'</td>
                  </tr>
                  <tr>
                    <th scope="row"><img src="', base_url() ,  '/assets/img/simboloPesos.png"' ,'style="height: 15px; margin-bottom: 4px; margin-right: 2px">Costo del viaje</th>
                    <td colspan="5">', round($viaje->monto /(($viaje->cupo) + 1), 2) ,'</td>
                  </tr>
                  <tr>
                    <th scope="row">Estado de la inscripción</th>
                    <td colspan="5">', ucfirst($viaje->estadoInscripcion) ,'</td>
                  </tr>
                </tbody>
              </table>
            </div>';
    endforeach;
  }

	public function cancelarSolicitud(){ // En $_POST esta el idInscripcion
		$this->load->model('misViajesM');
    $this->misViajesM->cancelarSolicitud();
	}

	public function cancelarParticipacion(){ // En $_POST esta el idInscripcion
		$this->load->model('misViajesM');
    $this->misViajesM->cancelarParticipacion();
	}

	public function copilotosDeViaje(){ // En $_POST esta el idViaje
		$this->load->model('misViajesM');
    $inscripciones = $this->misViajesM->copilotosViaje();
		if (! $inscripciones) {
			echo '<div class="alert alert-primary"> No hay copilotos aceptados </div>';
		}
		foreach ($inscripciones as $inscripcion) {
		echo		 '<div class="row" style="padding: 5px">
								<div class="col-6">
									<div class="row">
										<img class="rounded-circle" style="height: 100px; width: 100px" src="', base_url() , 'assets/img/' , $inscripcion->fotoPerfil ,'">
										<div class="col">
											', $inscripcion->nombre ,'  ', $inscripcion->apellido ,'
											<br>
											<br>
											Estado inscripcion: ', ucfirst($inscripcion->estado) ,'
										</div>
									</div>
								</div>
								<div class="col-6">
									<button ', ($inscripcion->estado == "pagada") ? 'disabled' : '' ,' onclick="mostrarMensaje(', $inscripcion->id ,')" class="btn btn-danger float-right">Quitar copiloto</button>
								</div>
							</div>
							<hr>';
		}
	}

	public function eliminarCopiloto(){ // En $_POST esta el idInscripcion
		$this->load->model('misViajesM');
		echo $this->misViajesM->eliminarCopiloto();
	}
}

<?php
class MisViajesC extends CI_controller {

	public function index() {
		$this->load->view('misViajesV');
	}

  public function viajesOfrecidosActivos(){
    $this->load->model('misViajesM');
		$viajes = $this->misViajesM->viajesOfrecidosActivos();
    foreach ($viajes as $viaje):
      $duracion= (new DateTime($viaje->fechaHoraLlegada))->diff(new DateTime($viaje->fechaHoraSalida));
      echo  '<div>
              <table class="table table-striped table-dark table-bordered" style="box-shadow: 0px 0px 10px 4px black;">
                <tbody href="">
                  <tr>
                    <td colspan="6">
                      <div class="float-right">
                        <button class="btn btn-outline-info btn-sm" type="button">Administrar copilotos</button>
                        <button class="btn btn-outline-danger btn-sm" type="button">Eliminar</button>
                        <button class="btn btn-outline-light btn-sm" type="button">Editar</button>
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

  public function viajesOfrecidosRealizados(){
    $this->load->model('misViajesM');
    $viajes = $this->misViajesM->viajesOfrecidosRealizados();
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

  public function viajesComoAcompananteRealizados(){
    $this->load->model('misViajesM');
    $viajes = $this->misViajesM->viajesComoAcompananteRealizados();
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

}

<?php
class calificacionesC extends CI_controller {

  public function index() {
		$this->load->view('calificacionesV');
	}

  public function obtenerCalificacionesParaCopilotos(){
    $this->load->model('calificacionesM');
		$calificaciones = $this->calificacionesM->obtenerCalificacionesParaCopilotos();
    if (! $calificaciones){
			echo '<div class="alert alert-primary" style="text-align: center">No tiene calificaciones pendientes</div>';
		}else{
			foreach ($calificaciones as $calif){
			 echo '<div class="row" style="margin-top:10px; width: 80%;">';
			 echo					'<table class="table table-striped table-dark table-bordered" style="box-shadow: 0px 0px 10px 4px black;">';
			 echo						'<tbody href="">';
       echo							'<tr>';
       echo								'<th><img class="mx-auto rounded-circle img-fluid" src="' . base_url() . 'assets/img/' . $calif->fotoPerfil . '" style="height: 100px;width: 100px; display: block"></th>';
       echo									'<td colspan=3 align="center" style="padding: 34px"> <h1>', $calif->nombre ,' ', $calif->apellido ,' </h1> </td>';
       echo							'</tr>';
			 echo							'<tr>';
			 echo								'<th><img class="mx-auto rounded-circle img-fluid" src="' . base_url() . 'assets/img/locationSalida.png" style="height: 15px; margin-bottom: 4px">Desde</th>';
			 echo									'<td colspan=3>', $calif->salida ,'</td>';
			 echo							'</tr>';
			 echo							'<tr>';
			 echo								'<th><img class="mx-auto rounded-circle img-fluid" src="' . base_url() . 'assets/img/locationLlegada.png" style="height: 15px; margin-bottom: 4px">Hasta</th>';
			 echo								'<td colspan=3>', $calif->destino ,'</td>';
			 echo							'</tr>';
			 echo							'<tr>';
			 echo								'<th><img class="mx-auto rounded-circle img-fluid" src="' . base_url() . 'assets/img/calendarioFecha.png" style="height: 15px; margin-bottom: 4px; margin-right: 4px">Fecha de Salida</th>';
			 echo								'<td colspan=1>',date( "d-m-Y", strtotime($calif->fechaHoraSalida)),'</td>';
			 echo               '<th>Hora de salida</th>';
			 echo               '<td colspan=1>',date( "H:i", strtotime($calif->fechaHoraSalida)),' ','hs','</td>';
			 echo							'</tr>';
       echo							'<tr>';
       echo               '<th>Dar calificación</th>';
			 echo								'<td colspan=4 align="center">
			 												<div>
                               <button data-toggle="modal" data-target="#mensajeCalificar" class="btn btn-outline-success" onclick="modificarModal(\'', $calif->email, '\',' , $calif->idV ,',1)">Positiva</button>
			  											 <button data-toggle="modal" data-target="#mensajeCalificar" class="btn btn-outline-primary" onclick="modificarModal(\'', $calif->email, '\',' , $calif->idV ,',0)">Neutral</button>
															 <button data-toggle="modal" data-target="#mensajeCalificar" class="btn btn-outline-danger" onclick="modificarModal(\'', $calif->email, '\',' , $calif->idV ,',-1)">Negativa</button>
															</div>
													</td>';
			 echo							'</tr>';
			 echo						'</tbody>';
			 echo					'</table>';
			 echo '</div>';
			}
		}
  }

  public function obtenerCalificacionesParaConductores(){
    $this->load->model('calificacionesM');
		$calificaciones = $this->calificacionesM->obtenerCalificacionesParaConductores();
    if (! $calificaciones){
			echo '<div class="alert alert-primary" style="text-align: center">No tiene calificaciones pendientes</div>';
		}else{
			foreach ($calificaciones as $calif){
			 echo '<div class="row" style="margin-top:10px; width: 80%;">';
			 echo					'<table class="table table-striped table-dark table-bordered" style="box-shadow: 0px 0px 10px 4px black;">';
			 echo						'<tbody href="">';
       echo							'<tr>';
       echo								'<th><img class="mx-auto rounded-circle img-fluid" src="' . base_url() . 'assets/img/' . $calif->fotoPerfil . '" style="height: 100px;width: 100px; display: block"></th>';
       echo									'<td colspan=3 align="center" style="padding: 34px"> <h1>', $calif->nombre ,' ', $calif->apellido ,' </h1> </td>';
       echo							'</tr>';
			 echo							'<tr>';
			 echo								'<th><img class="mx-auto rounded-circle img-fluid" src="' . base_url() . 'assets/img/locationSalida.png" style="height: 15px; margin-bottom: 4px">Desde</th>';
			 echo									'<td colspan=3>', $calif->salida ,'</td>';
			 echo							'</tr>';
			 echo							'<tr>';
			 echo								'<th><img class="mx-auto rounded-circle img-fluid" src="' . base_url() . 'assets/img/locationLlegada.png" style="height: 15px; margin-bottom: 4px">Hasta</th>';
			 echo								'<td colspan=3>', $calif->destino ,'</td>';
			 echo							'</tr>';
			 echo							'<tr>';
			 echo								'<th><img class="mx-auto rounded-circle img-fluid" src="' . base_url() . 'assets/img/calendarioFecha.png" style="height: 15px; margin-bottom: 4px; margin-right: 4px">Fecha de Salida</th>';
			 echo								'<td colspan=1>',date( "d-m-Y", strtotime($calif->fechaHoraSalida)),'</td>';
			 echo               '<th>Hora de salida</th>';
			 echo               '<td colspan=1>',date( "H:i", strtotime($calif->fechaHoraSalida)),' ','hs','</td>';
			 echo							'</tr>';
       echo							'<tr>';
       echo               '<th>Dar calificación</th>';
			 echo								'<td colspan=4 align="center">
			 												<div>
                                <button data-toggle="modal" data-target="#mensajeCalificar" class="btn btn-outline-success" onclick="modificarModal(\'', $calif->email, '\',' , $calif->idV ,',1)">Positiva</button>
                                <button data-toggle="modal" data-target="#mensajeCalificar" class="btn btn-outline-primary" onclick="modificarModal(\'', $calif->email, '\',' , $calif->idV ,',0)">Neutral</button>
                                <button data-toggle="modal" data-target="#mensajeCalificar" class="btn btn-outline-danger" onclick="modificarModal(\'', $calif->email, '\',' , $calif->idV ,',-1)">Negativa</button>
															</div>
													</td>';
			 echo							'</tr>';
			 echo						'</tbody>';
			 echo					'</table>';
			 echo '</div>';
			}
		}
  }

  function calificarUsuario(){ //En $_POST esta idViaje, emailCalificado, puntuacion
    $this->load->model('calificacionesM');
		$this->calificacionesM->calificarUsuario();
  }

}

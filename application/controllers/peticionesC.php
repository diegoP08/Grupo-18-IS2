<?php
class PeticionesC extends CI_Controller {

	public function index(){
		$this->load->view('peticionesV');
		}

	public function mostrarPeticiones(){
		$this->load->model('peticionesM');
		$peticiones= $this->peticionesM->peticiones();
		$imagenSalida= 'locationSalida.png';
		$imagenLlegada= 'locationLlegada.png';
		$imagenPersona= 'persona.png';
		$imagenCalendario= 'calendarioFecha.png';
		if (! $peticiones){
			echo '<div class="alert alert-primary" style="text-align: center">No tiene peticiones pendientes</div>';
		}else{
			foreach ($peticiones as $peticion){
				$idCopiloto= $peticion->email;
				$reputacion= $this->peticionesM->verReputacion($idCopiloto);
				$salida=$peticion->salida;
				$idViaje=$peticion->idViaje;
				$idIns=$peticion->id;
				$destino=$peticion->destino;
				$nombreUser= $peticion->nombre;
				$apellidoUser= $peticion->apellido;
				$horaSalida= $peticion->fechaHoraSalida;
				$asientos = $peticion->cupo;
				$pasajeros = $asientos - $peticion->lugaresDisponibles;
			 echo '<div class="row" style="margin-top:10px; width: 80%;">';
			 echo					'<table class="table table-striped table-dark table-bordered" style="box-shadow: 0px 0px 10px 4px black;">';
			 echo						'<tbody href="">';
			 echo							'<tr>';
			 echo								'<th><img class="mx-auto rounded-circle img-fluid" src="' . base_url() . 'assets/img/' . $imagenSalida . '" style="height: 15px; margin-bottom: 4px">Desde</th>';
			 echo									'<td colspan=3>', $salida,'</td>';
			 echo							'</tr>';
			 echo							'<tr>';
			 echo								'<th><img class="mx-auto rounded-circle img-fluid" src="' . base_url() . 'assets/img/' . $imagenLlegada . '" style="height: 15px; margin-bottom: 4px">Hasta</th>';
			 echo								'<td colspan=3>',$destino,'</td>';
			 echo							'</tr>';
			 echo							'<tr>';
			 echo								'<th><img class="mx-auto rounded-circle img-fluid" src="' . base_url() . 'assets/img/' . $imagenCalendario . '" style="height: 15px; margin-bottom: 4px; margin-right: 4px">Fecha de Salida</th>';
			 echo								'<td colspan=1>',date( "d-m-Y", strtotime($horaSalida)),'</td>';
			 echo               '<th>Hora de salida</th>';
			 echo               '<td colspan=1>',date( "H:i", strtotime($horaSalida)),' ','hs','</td>';
			 echo							'</tr>';
			 echo							'<tr>';
			 echo							  '<th><img class="mx-auto rounded-circle img-fluid" src="' . base_url() . 'assets/img/' . $imagenPersona . '" style="height: 15px; margin-bottom: 4px">Petición de</th>';
			 echo								'<td colspan=1>',$nombreUser,' ',$apellidoUser,'</td>';
			 echo 							'<th>Calificacion</th>';
			 echo               '<td colspan=1>',$reputacion,'</td>';
			 echo							'</tr>';
			 echo							'<tr>';
			 echo							'<tr>';
			 echo								'<th>Cupo del viaje</th>';
			 echo									'<td colspan=3>', $pasajeros ,'/', $asientos ,'</td>';
			 echo							'</tr>';
			 echo								'<td colspan=4>
			 												<div class="row justify-content-center">
			  											 <button class="btn btn-primary" style="background-color: #f37277; border-color:#f37277; margin-right: 4px" onclick="aceptarPeticion(', $peticion->id, ',' , $peticion->idViaje ,') ">Aceptar</button>
															 <button class="btn btn-primary" style="background-color: #DC143C; border-color:#f37277; margin-left: 4px" onclick="rechazarPeticion(', $peticion->id ,') ">Rechazar</button>
															</div>
													</td>';
			 echo							'</tr>';
			 echo						'</tbody>';
			 echo					'</table>';
			 echo '</div>';
			}
		}
	}

	public function aceptarPeticion(){ // en POST estan el idInscripcion y idViaje
		$this->load->model('peticionesM');
		if($this->peticionesM->aceptarPeticion()){
			echo 'exito';
		}else{
			echo 'falso';
		}
	}

	public function rechazarPeticion(){
		$this->load->model('peticionesM');
		$this->peticionesM->rechazarPeticion();
	}

}

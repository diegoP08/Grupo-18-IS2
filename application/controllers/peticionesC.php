<?php
class PeticionesC extends CI_Controller {

	public function index(){
		$this->load->view('peticionesV');
		}

	public function mostrarPeticiones(){
		$this->load->model('peticionesM');
		$peticiones= $this->peticionesM->peticiones();
		$imagenSalida= 'locationSalida';
		$imagenLlegada= 'locationLlegada';
		$imagenPersona= 'persona';
		$imagenCalendario= 'calendarioFecha';
		if (! $peticiones){
			echo '<div class="alert alert-primary" style="text-align: center">No tiene peticiones pendientes</div>';
		}else{
			foreach ($peticiones as $peticion){
				$idCopiloto= $peticion->email;
				$reputacion= $this->peticionesM->verReputacion($idCopiloto);
				$salida=$peticion->salida;
				$destino=$peticion->destino;
				$nombreUser= $peticion->nombre;
				$apellidoUser= $peticion->apellido;
				$horaSalida= $peticion->fechaHoraSalida;
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
			 echo								'<td colspan=3>',$horaSalida,'</td>';
			 echo							'</tr>';
			 echo							'<tr>';
			 echo							  '<th><img class="mx-auto rounded-circle img-fluid" src="' . base_url() . 'assets/img/' . $imagenPersona . '" style="height: 15px; margin-bottom: 4px">Petición de</th>';
			 echo								'<td colspan=1>',$nombreUser,' ',$apellidoUser,'</td>';
			 echo 							'<th>Calificacion</th>';
			 echo               '<td colspan=1>',$reputacion,'</td>';
			 echo							'</tr>';
			 echo						'</tbody>';
			 echo					'</table>';
			 echo '</div>';
			}
		}
	}
}

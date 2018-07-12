<!DOCTYPE html>
<html lang="en" dir="ltr" style="height: 100%">
<?php require 'head.php' ?>
<body style="background-image: url(<?php echo base_url() ?>assets/img/fondo1.png); background-repeat:repeat;height: 100%;">
  <div class="container" style="background: rgba(0,0,0,0.5); box-shadow: 0 0 10px 3px black; min-height: 100%">
    <?php require 'barraSuperior.php' ?>
    <br>
    <div class="container" style="background: rgba(0,26,26,0.5);width: 90%;box-shadow: 0px 0px 10px 4px black;">
      <h1 align='center' style="color:white; padding: 10px;">Ayuda</h1>
      <p><h5 style="color:white" align="center">En esta sección tendrás las respuestas a las preguntas más realizadas por los usuarios a través del centro de atencion al cliente, que servirán para
        tener una idea más clara de como funciona el sitio y las acciones que puedas realizar en el.</h5></p>
        <br>
        <div class="container">
          <div class="row">
            <div class="col">
              <div id="accordion">
                <div class="card" style="margin-bottom: 3px">
                  <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                      <button style="color: #f17475" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        ¿Como buscar un viaje?
                      </button>
                    </h5>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body" style="justify-content: center ">
                      <p align="justify">
                      A la hora de buscar un viaje, solo tenés que utilizar el buscador disponible en la página dandole click al boton "Buscar viaje". Introduce la ciudad de salida, la ciudad de llegada,
                      la fecha del viaje y luego hace click en “Buscar” y se mostrarán automáticamente todos los viajes que los conductores hayan publicado. Si no precisas la fecha del viaje, se mostrarán
                      todos los viajes que hay publicados entre esas dos ciudades e incluso, si lo deseas puedes buscar por marca o modelo de vehiculo que realice el viaje. Tambien puedes dejar los campos en blanco y la plataforma
                      buscará todos los viajes activos en el sistema.
                      </p>
                    </div>
                  </div>
                </div>

                <div class="card" style="margin-bottom: 3px">
                  <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                      <button style="color: #f17475" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        ¿Cómo contacto con un conductor?
                      </button>
                    </h5>
                  </div>
                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body" align="justify">
                      A veces es necesario hacerle algunas preguntas a un conductor, aun si la información principal (los lugares de salida y de llegada, la duración, etc.) están disponibles en el propio anuncio para poder reservar directamente.
                      Para enviar un mensaje a un conductor, cuando un viaje te interesa y tienes una pregunta específica o quieres saber más detalles sobre el viaje, solo tienes que iniciar sesión y hacer click en el viaje elegido.
                      Al final del anuncio publicado, verás que hay un espacio de Comentarios para poder escribir tu mensaje al conductor.
                      Tambien puedes contactarte con el conductor a través de los datos de contactos en el perfil del mismo.
                    </div>
                  </div>
                </div>

                <div class="card" style="margin-bottom: 3px">
                  <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                      <button style="color: #f17475" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        ¿Cómo reservo un viaje?
                      </button>
                    </h5>
                  </div>
                  <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body" align="justify">
                      Si encontraste tu viaje, no esperes más y reserva tu lugar directamente desde la web en forma muy rápida. Al ingresar al detalle del viaje, podés hacer click en “Postularme para el viaje”
                      y la reserva queda realizada. Recuerda que se debe esperar a que el conductor apruebe la reserva. El estado y datos de las reservas pueden verse en la sección de "Viajes" en el menu de usuario.
                    </div>
                  </div>
                </div>

                <div class="card" style="margin-bottom: 3px">
                  <div class="card-header" id="headingFour">
                    <h5 class="mb-0">
                      <button style="color: #f17475" class="btn btn-link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                        ¿Cuáles son los consejos para tener un buen viaje en auto compartido?
                      </button>
                    </h5>
                  </div>
                  <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                    <div class="card-body" align="justify">
                      Aunque el conductor puede tener más responsabilidad para que el viaje en auto compartido sea una buena experiencia, por la parte del pasajero también hay algunas reglas que hay que respetar.
                      El viaje es un intercambio entre personas, de modo que solo hace falta aplicar las reglas de convivencia elementales:
                      <br>
                      • No consideres el conductor como un taxi a disposición de los pasajeros.
                      <br>
                      • No llegues tarde al punto de encuentro.
                      <br>
                      • No pidas a los conductores que se adapten totalmente a tus necesidades (como, por ejemplo, hacer un desvío de 30 km).
                      <br>
                      • No intentes negociar el precio.
                      <br>
                      • No ensucies el coche.
                      <br>
                      Todos estos consejos pueden parecer evidentes, pero también está bien repetirlos para tenerlos siempre en mente.
                      <br>
                      - Por último, no olvides dejar una opinión a tu compañero de viaje después de compartir coche, siempre es agradable recibir una opinión positiva y permite que la comunidad funcione bien. Además, si dejas una opinión tendrás más posibilidades de recibir una vos también.
                    </div>
                  </div>
                </div>

                <div class="card" style="margin-bottom: 3px">
                  <div class="card-header" id="headingFive">
                    <h5 class="mb-0">
                      <button style="color: #f17475" class="btn btn-link" data-toggle="collapse" data-target="#collapsFive" aria-expanded="true" aria-controls="collapsFive">
                        ¿Cómo ofrecer un viaje?
                      </button>
                    </h5>
                  </div>
                  <div id="collapsFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                    <div class="card-body" align="justify">
                      En la página de la plataforma se encuentra en el sector superior derecho, un botón que dice "Publicar Viaje". Pulsando sobre el mismo conducirá a la planilla para completar los datos de dicho viaje. Seleccionando las ciudades de origen y destino, el costo del viaje, la descripción, y otros datos necesarios para enriquecer de información el detalle del mismo. Recuerda que existen 2 tipos de viajes. Con regularidad ocasional, que corresponde a un unico viaje
                      y la regularidad diaria. En este segundo tipo, se crean publicaciones para cada día.
                    </div>
                  </div>
                </div>

                <div class="card" style="margin-bottom: 3px">
                  <div class="card-header" id="headingSix">
                    <h5 class="mb-0">
                      <button style="color: #f17475" class="btn btn-link" data-toggle="collapse" data-target="#collapsSix" aria-expanded="true" aria-controls="collapsSix">
                        ¿Cómo agrego un auto a mi perfil?
                      </button>
                    </h5>
                  </div>
                  <div id="collapsSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                    <div class="card-body" align="justify">
                      Si quieres publicar un viaje, previamente debes cargar un auto en tu perfil de usuario. Puedes cargar el mismo, dandole click al boton "Vehiculos" del menu de usuario,
                      y seleccionando la opción "Añadir vehiculo" en donde deberás completar el formulario de datos del mismo para poder agregarlo
                      presionando el boton "Añadir vehiculo".
                    </div>
                  </div>
                </div>

                <div class="card" style="margin-bottom: 3px">
                  <div class="card-header" id="headingSeven">
                    <h5 class="mb-0">
                      <button style="color: #f17475" class="btn btn-link" data-toggle="collapse" data-target="#collapsSeven" aria-expanded="true" aria-controls="collapsSeven">
                        ¿Cómo administro mis viajes y/o peticiones?
                      </button>
                    </h5>
                  </div>
                  <div id="collapsSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                    <div class="card-body" align="justify">
                      Puedes administrar tus viajes ofrecidos (junto con los copilotos del mismo) y tus peticiones para viajes de otros usuarios, dandole click al boton "Viajes" en el menu del usuario.
                    </div>
                  </div>
                </div>

                <div class="card" style="margin-bottom: 3px">
                  <div class="card-header" id="headingEight">
                    <h5 class="mb-0">
                      <button style="color: #f17475" class="btn btn-link" data-toggle="collapse" data-target="#collapsEight" aria-expanded="true" aria-controls="collapsEight">
                        ¿Cómo califico a otros usuarios?
                      </button>
                    </h5>
                  </div>
                  <div id="collapsEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion">
                    <div class="card-body" align="justify">
                      Puedes calificar a otros usuarios con los que realizaste viajes dandole click al boton "Calificaciones" en el menu del usuario, recuerda que debes calificar
                      antes de que pasen 30 dias luego de finalizado el viaje, caso contrario no podas inscribirte a otros viajes u ofrecerlos.
                    </div>
                  </div>
                </div>

                <div class="card" style="margin-bottom: 3px">
                  <div class="card-header" id="headingNine">
                    <h5 class="mb-0">
                      <button style="color: #f17475" class="btn btn-link" data-toggle="collapse" data-target="#collapsNine" aria-expanded="true" aria-controls="collapsNine">
                        ¿Cómo acepto o rechazo a un copiloto?
                      </button>
                    </h5>
                  </div>
                  <div id="collapsNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordion">
                    <div class="card-body" align="justify">
                      Puedes administrar las peticiones de copilotos para tus viajes dandole al boton "Peticiones" en el menu de usuario.
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <br>
      </div>
    </div>
  </body>
  <?php require 'scripts.php' ?>
  </html>

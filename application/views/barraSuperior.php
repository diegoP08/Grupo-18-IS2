<?php
if (isset($_SESSION['email'])){
?>
<!-- Barra de que se muestra si esta logueado -->

<div class="container">
  <div class="row">
    <div class="col-2">
      <a href="<?= site_url('inicioC')?>" class="navbar-brand">
        <img src="<?php echo base_url() ?>assets/img/LogoA.png" style="width: 100px">
      </a>
    </div>
    <div class="col-10">
      <div class="row justify-content-end" style="padding-right:15px;padding-top: 12px">
        <a href="<?=site_url('/verPerfilC')?>"><img src="<?php echo base_url() ?>assets/img/<?= $_SESSION['fotoPerfil'] ?>" style="height: 40px; width: 40px"></a>
        <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #f37277">
            <?= ($_SESSION['nombre'] . " " . $_SESSION['apellido'])?>
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="<?=site_url('/verPerfilC')?>">Perfil</a>
            <a class="dropdown-item" href="<?=site_url('/misViajesC')?>">Viajes</a>
            <a class="dropdown-item" href="<?=site_url('/vehiculosC')?>">Vehiculos</a>
            <a class="dropdown-item" href="<?=site_url('/peticionesC')?>">Peticiones</a>
            <a class="dropdown-item" href="<?=site_url('/calificacionesC')?>">Calificaciones</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?=site_url('/ingresoC/cerrarSesion')?>">Cerrar Sesion</a>
          </div>
        </div>
      </div>
      <ul class="nav" style="margin-left: 67.575px">
        <li class="nav-item"><a href="<?=site_url('/inicioC') ?>" class="nav-link" style="color: #f37277"> <h5 >INICIO</h5></a> </li>
        <li class="nav-item"><a href="<?=site_url('/start/contacto') ?>" class="nav-link" style="color: #f37277"> <h5>CONTACTO</h5> </a> </li>
        <li class="nav-item"><a href="<?=site_url('/publicarViajeC') ?>" class="nav-link" style="color: #f37277"> <h5>PUBLICAR VIAJE</h5> </a> </li>
        <li class="nav-item"><a href="<?=site_url('/buscarViajeC') ?>" class="nav-link" style="color: #f37277"> <h5>BUSCAR VIAJE</h5> </a> </li>
        <li class="nav-item"></li>
      </ul>
    </div>
  </div>
</div>

<!-- Barra que se muestra si no esta logeado -->
<?php }else{ ?>
<div class="container">
  <div class="row">
    <div class="col-2">
      <a href="<?= site_url() ?>" class="navbar-brand">
        <img src="<?php echo base_url() ?>assets/img/LogoA.png" style="width: 100px">
      </a>
    </div>
    <div class="col-10">
      <div class="row justify-content-end">
        <div style="margin-top: 10px; margin-right: 10px">
          <a class="btn btn-primary" style="background-color: #f37277; border-color:#f37277" href="<?= site_url('Cregistro') ?>">REGISTRARSE</a>
          <a class="btn btn-primary" style="background-color: #f37277; border-color:#f37277" href="<?= site_url('ingresoC') ?>">INICIAR SESIÓN</a>
        </div>
      </div>
      <ul class="nav" style="margin-left: 67.575px">
        <li class="nav-item"> <a href="<?= site_url() ?>" class="nav-link" style="color: #f37277"> <h5>INICIO</h5></a> </li>
        <li class="nav-item"> <a href="<?=site_url('/start/sobreNosotros')?>" class="nav-link" style="color: #f37277"> <h5>SOBRE NOSOTROS</h5> </a> </li>
        <li class="nav-item"> <a href="<?=site_url('/start/contacto') ?>" class="nav-link" style="color: #f37277"> <h5>CONTACTO</h5> </a> </li>
        <li class="nav-item"> <a href="<?=site_url('/buscarViajeC') ?>" class="nav-link" style="color: #f37277"> <h5>BUSCAR VIAJE</h5> </a> </li>
      </ul>
    </div>
  </div>
</div>
<?php } ?>

<?php
  session_start();
  $_SESSION['email'] = 'asd';
  $_SESSION['nombre'] = 'Diego';
  $_SESSION['apellido'] = 'Prince';
  if (isset($_SESSION['email'])){
?>
<!-- Barra de que se muestra si esta logueado -->
<div class="container-fluid" style="background-color: #333333">
  <div class="container">
    <div class="row">
      <div class="col-2">
        <a href="<?php echo base_url() ?>inicio" class="navbar-brand">
          <img src="<?php echo base_url() ?>assets/img/LogoA.jpg" style="width: 100px">
        </a>
      </div>
      <div class="col-10">
        <div class="row justify-content-end" style="padding-right:15px;padding-top: 12px">
          <a href="#"><img src="<?php echo base_url() ?>assets/img/usuario.jpg" style="height: 40px; width: 40px"></a>
          <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #f37277">
              <?php echo($_SESSION['nombre'] . " " . $_SESSION['apellido']) ?>
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Perfil</a>
              <a class="dropdown-item" href="#">Viajes</a>
              <a class="dropdown-item" href="#">Pagos</a>
            </div>
          </div>
        </div>
        <ul class="nav" style="margin-left: 67.575px">
          <li class="nav-item"><a href="<?php echo base_url() ?>inicio" class="nav-link" style="color: #f37277"> <h5 >INICIO</h5></a> </li>
          <li class="nav-item"><a href="#" class="nav-link" style="color: #f37277"> <h5>CONTACTO</h5> </a> </li>
          <li class="nav-item"><a href="<?=site_url("/publicarViaje") ?>" class="nav-link" style="color: #f37277"> <h5>PUBLICAR VIAJE</h5> </a> </li>
          <li class="nav-item"><a href="#" class="nav-link" style="color: #f37277"> <h5>BUSCAR VIAJE</h5> </a> </li>
          <li class="nav-item"></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- Barra que se muestra si no esta logeado -->
<?php }else{ ?>
<div class="container" style="background-image:url(<?php echo base_url() ?>assets/img/fondo-translucido.png);">
  <div class="row">
    <div class="col-2">
      <a href="<?php echo base_url() ?>" class="navbar-brand">
        <img src="<?php echo base_url() ?>assets/img/LogoA.jpg" style="width: 100px">
      </a>
    </div>
    <div class="col-10">
      <div class="row justify-content-end">
        <div style="margin-top: 10px; margin-right: 10px">
          <a class="btn btn-primary" style="background-color: #f37277; border-color:#f37277" href="<?php echo base_url() ?>registro">REGISTRARSE</a>
          <a class="btn btn-primary" style="background-color: #f37277; border-color:#f37277" href="<?php echo base_url() ?>ingreso">INICIAR SESIÓN</a>
        </div>
      </div>
      <ul class="nav">
        <li class="nav-item"> <a href="<?php echo base_url() ?>" class="nav-link" style="color: #f37277"> <h5>INICIO</h5></a> </li>
        <li class="nav-item"> <a href="#" class="nav-link" style="color: #f37277"> <h5>SOBRE NOSOTROS</h5> </a> </li>
        <li class="nav-item"> <a href="#" class="nav-link" style="color: #f37277"> <h5>CONTACTO</h5> </a> </li>
        <li class="nav-item"> <a href="#" class="nav-link" style="color: #f37277"> <h5>BUSCAR VIAJE</h5> </a> </li>
      </ul>
    </div>
  </div>
</div>
<?php } ?>

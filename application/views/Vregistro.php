<!DOCTYPE html>
<html>
<?php require "head.php" ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/miscss.css">
<body style="background-image: url(<?php echo base_url() ?>assets/img/fondo2.jpg); background-repeat:repeat;height: 100%;">
	<?php require "barraSuperior.php" ?>
    <br>
    <div class="container mt-0" style="background-color: #f37277 ;color: black;height: 100%;" id="advanced-search-form">
        <h1 align="center">Registrarse</h1>
        <form action="index.php/Cregistro/guardar" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="Email" class="form-control" placeholder="Email" name="email">
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" placeholder="Nombre" name="nombre">
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" placeholder="Apellido" name="apellido">
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" class="form-control" placeholder="Contraseña" name="contrasena">
            </div>
            <div class="form-group">
                <label for="fotoPerfil">Foto De Perfil</label>
                <input type="text" class="form-control" placeholder="Foto De Perfil" name="fotoPerfil">
            </div>
            <div class="form-group">
                <label for="sexo">Sexo</label>
                <input type="text" class="form-control" placeholder="Sexo" name="sexo">
            </div>
            <div class="form-group">
                <label for="pais">País</label>
                <input type="text" class="form-control" placeholder="Pais" name="pais">
            </div>
            <div class="form-group">
                <label for="provincia">Provincia</label>
                <input type="text" class="form-control" placeholder="Provincia" name="provincia">
            </div>
            <div class="form-group">
                <label for="localidad">Localidad</label>
                <input type="text" class="form-control" placeholder="Localidad" name="localidad">
            </div>
            <div class="form-group">
                <label for="celular">Celular</label>
                <input type="text" class="form-control" placeholder="Celular" name="celular">
            </div>
             <div class="form-group">
                <label for="fechaDeNacimiento">Fecha De Nacimiento</label>
                <input type="date" class="form-control" placeholder="fechaDeNacimiento" name="fechaDeNacimiento">
            </div>
             <div class="clearfix"></div>
	             <button type="submit" class="btn btn-info btn-lg btn-responsive" id="Registrarse"> Registrarse</button>
        </form>
    </div>
    <br>
</body>
</html>

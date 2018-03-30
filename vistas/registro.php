<?php
	require('../php/controlador.php');

	$controlador = new Controlador() ;

	$row = array(
		'nombre' => '',
		'apellido' => '',
		'telefono' => '',
		'direccion' => ''
	);

	if (isset($_GET['ced'])) {
		$resultado = $controlador->infoPersonas($_GET['cedula']);
		$row = $resultado->fetch_array(MYSQLI_ASSOC);

		if (is_null($row)) {
			header("location: registro.php?msj=No existe esta persona");
		}
	}

	if (isset($_POST['reg'])) {
		$controlador->addUser($row['id'], $_POST['clave']);
		header("location: ../index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>REGISTRO</title>
	<link rel="stylesheet" href="../estaticos/libs/materialize/css/materialize.min.css">
	<link rel="stylesheet" href="../estaticos/libs/materialize/fonts/iconfont/material-icons.css">
	<link rel="stylesheet" href="../estaticos/estilos.css">
</head>
<body class="fondore fondo">
	
	<?php if (isset($_GET['msj'])):  ?>
		<div class="red white-text center err z-depth-2">
			<i class="material-icons">warning</i><span> <?php echo $_GET['msj']; ?>. Si cree que se trata de un error comuníquese con el adminisrador. 0000-000-00-00</span>
		</div>
	<?php endif; ?>

	<section class="card-panel z-depth-5" style="width: 800px; height: 400px">
		<h5 class="center">Registro de un nuevo usuario.</h5>
		<form action="" method="get">
			<div class="row">
				<div class="input-field col m4 offset-m3">
					<i class="material-icons prefix">fiber_pin</i>
					<input type="text" maxlength="8" name="cedula" >
					<label for="cedula">Cédula</label>
				</div>
				<input type="submit" name="ced" class="btn btn-waves-effect waves-light red p" value="consultar">
			</div>
		</form>
		<form action="" method="post">
			<div class="row">
				<div class="input-field col m4">
					<i class="material-icons prefix">face</i>
					<input type="text" value="<?php echo $row['nombre']; ?>" disabled>
					<label for="nombre">Nombre</label>
				</div>
				<div class="input-field col m4">
					<i class="material-icons prefix">face</i>
					<input type="text" value="<?php echo $row['apellido']; ?>" disabled>
					<label for="apellido">Apellido</label>
				</div>
				<div class="row">
					<div class="input-field col m4">
						<i class="material-icons prefix">phone</i>
						<input type="text" value="<?php echo $row['telefono']; ?>" disabled>
						<label for="telefono">Teléfono</label>
					</div>
					<div class="input-field col m8">
						<i class="material-icons prefix">place</i>
						<input type="text" value="<?php echo $row['direccion']; ?>" disabled>
						<label for="direccion">Dirección</label>
					</div>
					<div class="input-field col m4">
						<i class="material-icons prefix">lock</i>
						<input type="password" name="clave" required>
						<label for="clave">Clave</label>
					</div>
				</div>
				<div class="modal-footer">
					<a href="../index.php" class="waves-effect waves-green btn red ">volver</a>
					<input type="submit" class="waves-effect waves-green btn red right" name="reg" value="registrar"></input>
				</div>
			</div>
		</form>
	</section>	

	<script src="../estaticos/libs/jquery-3.2.1.js"></script>
	<script src="../estaticos/libs/materialize/js/materialize.min.js"></script>
</body>
</html>
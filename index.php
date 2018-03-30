<?php 
	include_once('php/login.php');

	$login = new Login();

	if (isset($_POST['login'])) {
		$login->validarLogin($_POST['cedula'], $_POST['clave']);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="estaticos/libs/materialize/css/materialize.min.css">
	<link rel="stylesheet" href="estaticos/libs/materialize/fonts/iconfont/material-icons.css">
	<link rel="stylesheet" href="estaticos/estilos.css">
</head>
<body class="fondo">
	
	<?php if (isset($_GET['msj'])):  ?>
		<div class="red white-text center err z-depth-2">
			<i class="material-icons left">warning</i>
			<span> <?php echo $_GET['msj']; ?></span>
			<i class="material-icons right">warning</i>
		</div>
	<?php endif; ?>
	
	<section class="card-panel hoverable z-depth-2">
		<form action="" method="post">
			<div class="input-field">
				<input type="text" name="cedula" required autofocus maxlength="8">
				<label for="cedula">Cédula</label>
			</div>
			<div class="input-field">
				<input type="password" name="clave" required>
				<label for="clave">Contraseña</label>
			</div>
			<div class="input-field">
				<a href="vistas/registro.php" class="btn waves-effect waves-light red">REGISTRO</a>
				<input name="login" type="submit" class="btn waves-effect waves-light red" value="Entrar">
			</div>
		</form>
	</section>

	<script src="estaticos/libs/jquery-3.2.1.js"></script>
	<script src="estaticos/libs/materialize/js/materialize.min.js"></script>
</body>
</html>
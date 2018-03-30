<?php
	include_once('../php/controlador.php');

	$controlador = new Controlador();

	if (isset($_GET['cedula'])) {
		$fila = $controlador->verInfoperUsu($_GET['cedula']);

		$row = $fila->fetch_array(MYSQLI_ASSOC);
	}
	else {
		header('Location: admin.php');
	}

	if (isset($_POST['enviar'])) {
		if ($_POST['clave'] == $row['clave']) {
			$controlador->cambiarClave($_POST['nclave'], $row['id']);
		}
		else {
			echo "<script>alert('La contraseña es invalida')</script>";
		}
	}

?>


<?php if (isset($_GET['msj'])):  ?>
	<div class="red white-text center err z-depth-2">
		<i class="material-icons">warning</i><span> <?php echo $_GET['msj']; ?></span>
	</div>
<?php endif; ?>
<div class="container-fluid">
	<div class="row">
		<div class="col">
			<h4 style="margin-top: 0px">Información personal</h4>
		</div>
		<div class="col right">
			<a class="btn waves-effect waves-light red" href="?load=editar&cedula=<?php echo $row['cedula']; ?>">editar</a>
		</div>
	</div>
	<div class="row card-panel">
		<div class="col m12">
			<p><b>Nombre: </b><?php echo $row['nombre']; ?></p>
			<p><b>Apellido: </b><?php echo $row['apellido']; ?></p>
			<p><b>Cédula: </b><?php echo $row['cedula']; ?></p>
			<p><b>Teléfono: </b><?php echo $row['telefono']; ?></p>
			<p><b>Dirección: </b><?php echo $row['direccion']; ?></p>
			<div class="col m3 clave">
				<b>Contraseña: </b>
				<span>es</span>
				<input type="password" id="pass" value="<?php echo $row['clave']; ?>" disabled>
				<i class="material-icons prefix" id="oculto">remove_red_eye</i>
			</div>
			<div class="col right">
				<a class="btn waves-effect waves-light red modal-trigger" href="#cclave">cambiar clave</a>
			</div>
		</div>
	</div>
</div>

<!-- MODAL -->
<div class="card-panel modal" id="cclave">
	<h5 class="center">Cambio de contraseña</h5>
	<form action="" method="post">
		<div class="input-field col s12">
			<input type="password" name="clave">
			<label for="clave">Ingresa tu clave actual</label>
		</div>
		<div class="input-field col s12">
			<input type="password" name="nclave">
			<label for="clave">Ingresa tu nueva clave</label>
		</div>
		<input type="submit" name="enviar" value="cambiar" class="btn waves-effect waves-light red center">
	</form>
</div>	
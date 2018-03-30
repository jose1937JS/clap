<?php 

	$controlador = new Controlador();

	if (isset($_GET['cedula'])) {

		$resultado = $controlador->verInfoperUsu($_GET['cedula']);
		$row = $resultado->fetch_array(MYSQLI_ASSOC);
	}
	else {
		header('Location: infoper.php') ;
	}

	if (isset($_POST['editar'])) {
		$controlador->editar($_GET['cedula'], $_POST['nombre'], $_POST['apellido'], $_POST['telefono'], $_POST['direccion']);

		$ced = $_GET['cedula'];
		header("Location: ?load=infoper&cedula=$ced");
	}
?>

<h4 class="center">Editando a <?php echo $row['nombre']. " ". $row['apellido'] ?> </h4>

<div class="container-fluid">
	<div class="card-panel">
		<form action="" method="post">
			<div class="row">
				<div class="input-field col m4">
					<i class="material-icons prefix">fiber_pin</i>
					<input type="text" name="cedula" disabled value="<?php echo $row['cedula']; ?>">
					<label for="cedula">Cédula</label>
				</div>
				<div class="input-field col m4">
					<i class="material-icons prefix">face</i>
					<input type="text" name="nombre" required value="<?php echo $row['nombre']; ?>">
					<label for="nombre">Nombre</label>
				</div>
				<div class="input-field col m4">
					<i class="material-icons prefix">face</i>
					<input type="text" name="apellido" required value="<?php echo $row['apellido']; ?>">
					<label for="apellido">Apellido</label>
				</div>
				<div class="row">
					<div class="input-field col m4">
						<i class="material-icons prefix">phone</i>
						<input type="text" maxlength="11" name="telefono" value="<?php echo $row['telefono']; ?>">
						<label for="telefono">Teléfono</label>
					</div>
					<div class="input-field col m8">
						<i class="material-icons prefix">place</i>
						<input type="text" name="direccion" required value="<?php echo $row['direccion']; ?>">
						<label for="direccion">Dirección</label>
					</div>
				</div>
				<div class="modal-footer">
					<input type="submit" class="waves-effect waves-green btn red" name="editar" value="editar"></input>
				</div>		
			</div>
		</form>
	</div>
</div>	
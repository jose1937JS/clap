<?php

	$controlador = new Controlador();

	$resultado = $controlador->listarUsers();
	$r = $controlador->listarUsers();

	if (isset($_POST['add'])) {
		$controlador->personas($_POST['nombre'], $_POST['apellido'], $_POST['cedula'], $_POST['telefono'], $_POST['direccion']);
	}

	if (isset($_POST['cedula'])) {
		$r = $controlador->verInfoperUsu($_POST['cedula']);
		$row = $r->fetch_array(MYSQLI_ASSOC);
	}

	if (isset($_POST['reg'])) {
		$controlador->addAdmin($_POST['user'] ,$_POST['clave']);
	}
 ?>

<div class="row">
	<div class="col">
		<h4 style="margin-top: 0px">Administración de usuarios</h4>
	</div>
	<div class="col right">
		<div class="fixed-action-btn horizontal click-to-toggle">
			<a class="btn-floating btn-large red tooltipped" data-position="bottom" data-tooltip="Añadir usuarios/personas"><i class="large material-icons">group_add</i></a>
			<ul>
				<li class="tooltipped" data-position="left" data-tooltip="Añadir usuario admin">
					<a href="#admin" class="btn-floating yellow darken-3 modal-trigger"><i class="material-icons">star</i></a>
				</li>
				<li class="tooltipped" data-position="bottom" data-tooltip="Añadir personas">
					<a href="#person" class="btn-floating blue darken-1 modal-trigger"><i class="material-icons">person</i></a>
				</li>
			</ul>
		</div>	
	</div>
</div>
<table class="striped centered hoverable">
	<thead>
		<th>CEDULA</th>
		<th>NOMBRE</th>
		<th>APELLIDO</th>
		<th>ADMIN</th>
		<th>ELIMINAR</th>
	</thead>
	<tbody>
		<?php while ($row = $resultado->fetch_array(MYSQLI_ASSOC)): ?>
			<tr>
				<td><?php echo $row['cedula']; ?></td>
				<td><?php echo $row['nombre']; ?></td>
				<td><?php echo $row['apellido']; ?></td>
				<td><?php echo $row['admin']; ?></td>
				<td>
					<a class="btn red waves-effect waves-light btn- modal-trigger" href="?load=eliminar&id=<?php echo $row['id_persona']; ?>" onclick="return confirm('¿Estás seguro?')">
						<i class="material-icons tooltipped" data-tooltip="Eliminar">delete</i>
					</a>
				</td>
			</tr>
		<?php endwhile; ?>
	</tbody>
</table>



<!--  MODAL AADIR ADMIN -->
<div class="card-panel modal modal-fixed-footer" id="admin" style="width: 800px; min-height: 250px">
	<h5 class="center" style="margin: 25px 25px">Añadir usuario admin</h5>
	<form action="" method="post">
		<div class="row">
			<div class="input-field col m6">
				<select id="select" name="user">
					<option value="" disabled selected>Choose your option</option>
					<?php while ($fila = $r->fetch_array(MYSQLI_ASSOC)): ?>
						<option value="<?php echo $fila['id'] ?>"><?php echo $fila['nombre'].' '.$fila['apellido'] ; ?></option>
					<?php endwhile; ?>
				</select>
				<label>Usuarios Registrados</label>
			</div>
			<div class="input-field col m6">
				<i class="material-icons prefix">vpn_key</i>
				<input type="password" name="clave" required>
				<label for="clave">Nueva clave de admin</label>
			</div>
			
			<div class="modal-footer">
				<input type="submit" class="waves-effect waves-green btn red" name="reg" value="registrar"></input>
			</div>
		</div>
	</form>
</div>	




 <!-- MODAL AÑDIR persona -->
<div class="modal " id="person">
	<form action="" method="post">
		<h4 class="center" style="margin: 25px 25px">Añadir persona de la comunidad</h4>
		<div class="row">
			<div class="input-field col m4">
				<i class="material-icons prefix">fiber_pin</i>
				<input type="text" name="cedula" maxlength="8" required>
				<label for="cedula">Cédula</label>
			</div>
			<div class="input-field col m4">
				<i class="material-icons prefix">face</i>
				<input type="text" name="nombre" required>
				<label for="nombre">Nombre</label>
			</div>
			<div class="input-field col m4">
				<i class="material-icons prefix">face</i>
				<input type="text" name="apellido" required>
				<label for="apellido">Apellido</label>
			</div>
			<div class="row">
				<div class="input-field col m4">
					<i class="material-icons prefix">phone</i>
					<input type="text" maxlength="11" name="telefono" >
					<label for="telefono">Teléfono</label>
				</div>
				<div class="input-field col m8">
					<i class="material-icons prefix">place</i>
					<input type="text" name="direccion" required>
					<label for="direccion">Dirección</label>
				</div>
			</div>
			<div class="modal-footer">
				<input type="submit" class="waves-effect waves-green btn red" name="add" value="añadir"></input>
			</div>		
		</div>
	</form>
</div>



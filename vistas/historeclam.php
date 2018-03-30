<!-- <?php 
	$controlador = new Controlador() ;
	$resultado = $controlador->listarReclamosId($_GET['cedula']);

?>
<?php while ($row = $resultado->fetch_array(MYSQLI_ASSOC)): ?>
	<div class="row">			
		<div class="card hoverable">
			<div class="card-title">
				<div class="header-title-left col s12 m6">
					<h5><?php echo $row['nombre']. " ".$row['apellido']." ". $row['fecha']; ?></h5>
				</div>
			</div>
			<div class="row">
				<div class="col s12">
					<div class="card-content">
						<div class="bodytext">
							<?php echo $row['reclamo']; ?>
						</div>
					</div>
					<div class="card-action">
						<form action="" method="post" >
							<div class="input-field ">
								<input type="hidden" name="id" value="<?php echo $row['id'] ?>">
								<input type="text" name="respuesta" placeholder="Responder. ENTER para enviar" required>
								<input type="submit" name="enviar" value="enviar">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php endwhile; ?> -->


<?php 
	$controlador = new Controlador() ;
	$resultado = $controlador->listarReclamosId($_GET['cedula']);

?>

<?php while ($row = $resultado->fetch_array(MYSQLI_ASSOC)): ?>
	<div class="row">			
		<div class="card hoverable">
			<div class="card-title">
				<div class="header-title-left col s12 m12">
					<h5><?php echo $row['nombre']." ".$row['apellido']; ?></h5>
					<span class="fecha"><?php echo $row['fecha']; ?></span>
				</div>
			</div>
			<div class="row">
				<div class="col s12">
					<div class="card-content">
						<div class="bodytext">
							<?php echo $row['reclamo']; ?>
						</div>
					</div>
					<div class="card-action ">
						<span class="header-title-left">Respondido el <?php echo $row['fecha_res']; ?></span>
						<p class="respuesta"><?php echo $row['respuesta']; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php endwhile; ?>
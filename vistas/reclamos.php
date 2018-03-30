<?php 
	$controlador = new Controlador() ;
	$resultado = $controlador->listarReclamos();

	if (isset($_POST['enviar'])) {
		$controlador->respuesta( $_POST['respuesta'], $_POST['id_reclamo'] );
	}
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
					<div class="card-action">
						<form action="" method="post" id="res">
							<input type="hidden" name="id_reclamo" value="<?php echo $row['id'] ?>">
							<div class="search-wrapper card">
								<input type="text" id="resp" name="respuesta" placeholder="Enviale una respuesta." required>

								<i id="respuesta" class="material-icons respuesta">comment</i>
								<input style="display: none" type="submit" name="enviar"> 
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php endwhile; ?>
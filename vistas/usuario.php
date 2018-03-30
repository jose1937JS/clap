<?php 
	$controlador = new Controlador() ;
	$resultado = $controlador->index();
?>

<?php while ($row = $resultado->fetch_array(MYSQLI_ASSOC)): ?>
	<div class="row">			
		<div class="card hoverable">
			<div class="card-title">	
				<div class="header-title-left col s12 m6">
					<h5><?php echo $row['titulo']; ?></h5>
				</div>
			</div>
			<div class="row">
				<div class="col s12">
					<div class="card-content">
						<div class="bodytext">
							<?php echo $row['contenido']; ?>
						</div>
					</div>
					<div class="card-action">
						<span><?php echo $row['fecha']; ?></span>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php endwhile; ?>
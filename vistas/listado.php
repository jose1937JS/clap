<?php

	$controlador = new Controlador() ;
	$resultado = $controlador->verReferencias();

?>
<div class="row">
	<div class="col">
		<h4>Números de Referencia Bancaria</h4>
	</div>
	<div class="col right">
		<button onclick="window.print()" style="margin-top: 10px" class="btn waves-effect waves-light red">PDF</button>
	</div>
</div>

<table class="striped centered hoverable">
	<thead>
		<th>CEDULA</th>
		<th>NOMBRE</th>
		<th>APELLIDO</th>
		<th>REFERENCIA</th>
		<th class="fechatd">FECHA</th>
		<th>RECIBIO</th>
	</thead>
	<tbody id="tbody">

		<?php while ($row = $resultado->fetch_array(MYSQLI_ASSOC)): ?>
			<tr>
				<td><?php echo $row['cedula']; ?></td>
				<td><?php echo $row['nombre']; ?></td>
				<td><?php echo $row['apellido']; ?></td>
				<td><?php echo $row['noreferencia']; ?></td>
				<td><?php echo $row['fecha']; ?></td>
				<td style="min-width: 120px">
					<div class="switch">
						<?php $row['recibio'] == 1 ? $check = 'checked' : $check = ''; ?>
						<label>
							NO
							<input type="checkbox" name="<?php echo $row['cedula'];?>" <?php echo $check ?>>
							<span class="lever"></span>
							SI
						</label>
					</div>
				</td>
			</tr>
		<?php endwhile; ?>
	</tbody>
</table>
<?php 

$controlador = new Controlador();


if (isset($_GET['id'])) {
	$controlador->eliminar($_GET['id']);
	header('Location: admin.php?load=adminusers');
}
<?php 

include 'controlador.php';

$controlador = new Controlador();
$data = $_POST['codigo'];

$controlador->traerid($data);
<?php 
	session_start();

	include_once('../php/rutas.php');
	include_once('../php/controlador.php');
	include_once('../php/login.php');

	$login = new Login();
	$controlador = new Controlador();

	if (!$_SESSION['cedula']) {	// && $_SESSION['admin']
		header('Location: ../index.php');
	}

	if (isset($_GET['salir'])) {
		$login->desconectar();
	}
	
	// Codigo para añadir un nuevo reclamo/nroreferencia;
	if (isset($_POST['enviarReclamo'])){
		$controlador->addReclamo( $_POST['reclamo'], $_SESSION['cedula']);

		header('Location: inicio.php');
	}
	else if (isset($_POST['noref'])) {
		$id = $controlador->infoPersonas($_SESSION['cedula']);
		$id_persona = $id->fetch_array(MYSQLI_ASSOC);

		$controlador->referencia($id_persona['id'], $_POST['referencia']);
		//header('Location: inicio.php'); 
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inicio</title>
	<link rel="stylesheet" href="../estaticos/libs/materialize/css/materialize.min.css">
	<link rel="stylesheet" href="../estaticos/libs/materialize/fonts/iconfont/material-icons.css">
	<link rel="stylesheet" href="../estaticos/main.css">
	<link rel="stylesheet" href="../estaticos/estilos.css">
</head>
<body>

	<!-- MODAL RECLAMO -->
	<div class="modal modal-fixed-footer" id="modal">
		<form action="" method="post" id="reclamo">
			<div class="modal-content">
				<h4 class="center">Reclamo u opinión</h4>
				<div class="input-field reclamo">
					<i class="material-icons prefix">warning</i>
					<input type="text" name="reclamo" required>
					<label for="reclamo">Reclamo, queja u opinión</label>
				</div>
			</div>
			<div class="modal-footer">
				<input type="submit" class="modal-action btn waves-effect waves-light red" value="enviar" name="enviarReclamo">
			</div>
		</form>
	</div>

	<!-- MODAL NoREFERANCIA -->
	<div class="modal modal-fixed-footer" id="modal2">
		<form action="" method="post" id="noreferencia">
			<div class="modal-content">
				<h4 class="center">Número de Referencia bancaria</h4>
				<div class="input-field reclamo">
					<i class="material-icons prefix">number</i>
					<input type="number" name="referencia" required>
					<label for="referencia">Número de referencia bancaria</label>
				</div>
			</div>
			<div class="modal-footer">
				<input type="submit" class="modal-action btn waves-effect waves-light red" value="enviar" name="noref">
			</div>
		</form>
	</div>

	<header>
		<aside id="slide-out" class="side-nav white fixed hide-on-med-and-down z-depth-2">
			<div class="side-nav-wrapper ">
				<div class="sidebar-header center">
					<h4 id="hora"></h4>
					<p id="fecha"></p>
				</div>
				<ul class="sidebar-menu collapsible collapsible-accordion " data-collapsible="accordion">
					<li title="Actualizar su Información Personal " class="no-padding ">
						<a href="?load=usuario" class="waves-effect waves-grey ">
							<i class="material-icons">home</i>Inicio
						</a>
					</li>
					<li title="Actualizar su Información Personal " class="no-padding ">
						<a href="?load=infoper&cedula=<?php echo $_SESSION['cedula']; ?>" class="waves-effect waves-grey ">
							<i class="material-icons">perm_identity</i>Información Personal
						</a>
					</li>
					<li title="Familia" class="no-padding ">
						<a href="?load=historeclam&cedula=<?php echo $_SESSION['cedula']; ?>" class="waves-effect waves-grey">
							<i class="material-icons">announcement</i>Reclamos
						</a>
					</li>
				</ul>
			</div>
		</aside> 
	</header>

	<div class="navbar-fixed">
		<nav>
			<div class="nav-wrapper red z-depth-2">
				<a href="#" data-activates="slide-out&quot;" class="button-collapse top-nav hide-on-large-only"><i class="material-icons">menu</i></a>
				<div class="container1">
					<ul id="nav-mobile" class="left hide-on-small-only">
						<li class="bold first"><img src="../estaticos/clap.jpeg" width="250" height="64px"></li>
					</ul>
				</div>
				<ul class="right">
					<li>
						<a href="?salir=true" class="tooltipped" data-position="bottom" data-tooltip="Cerrar sesión">
							<i class="material-icons left">perm_identity</i>V-<?php echo $_SESSION['cedula']; ?>
						</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
	
	<main>	
		<!-- BOTONES AÑADIR -->
		<div class="fixed-action-btn">
			<a href="#modal" class="btn-floating red modal-trigger tooltipped" data-position="left" data-tooltip="Reclamo"><i class="large material-icons">error</i></a>
		</div>
		<div class="fixed-action-btn" style="margin-bottom: 50px">
			<a href="#modal2" class=" modal-trigger btn-floating blue tooltipped" data-position="left" data-tooltip="Enviar número de referencia"><i class="material-icons">payment</i></a>
		</div>

		<div class="container1 conten">
			<div class="row">
				<div class="col s12 m12 l12 conten-body">
					<?php 
						$enrutador = new Enrutador();
						// el @ es para q no muestre errores ni advertencias
						if (@$enrutador->validar($_GET['load']))
							@$enrutador->cargarVista($_GET['load']);
					?>
				</div>
			</div>
		</div>

	</main>


	<script src="../estaticos/libs/jquery-3.2.1.js"></script>
	<script src="../estaticos/libs/materialize/js/materialize.min.js"></script>
	<script src="../estaticos/scripts.js"></script>
</body>
</html>
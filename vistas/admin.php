<?php 
	session_start();

	require('../php/rutas.php');
	require('../php/controlador.php');
	require('../php/login.php');

	$controlador = new Controlador() ;
	$login 		 = new Login();

	if (!$_SESSION['cedula']) {	
		header('Location: ../index.php');
	}

	if (isset($_GET['salir'])) {
		$login->desconectar();
	}

	if (isset($_POST['publicacionenviar'])) {
		$controlador->addPublicacion($_POST['titulo'], $_POST['publicacion']);
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inicio (admin)</title>
	<link rel="stylesheet" href="../estaticos/libs/materialize/css/materialize.min.css">
	<link rel="stylesheet" href="../estaticos/libs/materialize/fonts/iconfont/material-icons.css">
	<link rel="stylesheet" href="../estaticos/main.css">
	<link rel="stylesheet" href="../estaticos/estilos.css">
</head>
<body class="">
	<!-- DISPARADOR DE MODAL -->
	<div class="fixed-action-btn">
		<a href="#modall" class="btn-floating btn-large red modal-trigger tooltipped" data-position="left" data-tooltip="Publicar información"><i class="large material-icons">feedback</i></a>
	</div>

	<!-- MODAL PULICAIOCNES -->
	<div class="modal modal-fixed-footer" id="modall">
		<form action="" method="post">
			<div class="modal-content">
				<h4 class="center">Añadir nueva publicación</h4>
				<div class="input-field reclamo">
					<i class="material-icons prefix">description</i>
					<input type="text" name="titulo" required>
					<label for="titulo">Título</label>
				</div>
				<div class="input-field">
					<i class="material-icons prefix">feedback</i>
					<input type="text" name="publicacion" required>
					<label for="publicacion">¿Qué tienes que decir?</label>
				</div>
			</div>
			<div class="modal-footer">
				<input type="submit" class="modal-action btn waves-effect waves-light red" value="enviar" name="publicacionenviar">
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
						<a href="admin.php" class="waves-effect waves-grey ">
							<i class="material-icons">home</i>Inicio
						</a>
					</li>
					<li title="Actualizar su Información Personal " class="no-padding ">
						<a href="?load=infoper&cedula=<?php echo $_SESSION['cedula']; ?>" class="waves-effect waves-grey ">
							<i class="material-icons">perm_identity</i>Información Personal
						</a>
					</li>
					<li title="Familia" class="no-padding ">
						<a href="?load=adminusers" class="waves-effect waves-grey">
							<i class="material-icons">people</i>Administrar usuarios
						</a>
					</li>
					<li title="Familia" class="no-padding ">
						<a href="?load=respuestas" class="waves-effect waves-grey">
							<i class="material-icons">chat</i>Respuestas
						</a>
					</li>
					<li title="Familia" class="no-padding ">
						<a href="?load=listado" class="waves-effect waves-grey">
							<i class="material-icons">assignment</i>Listado
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
							<i class="material-icons left">grade</i>ADMINISTRADOR
						</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
	
	<main>

		<div class="container1 conten">
			<div class="row">
				<div class="col s12 m12 l12 conten-body">

					<?php 
						$enrutador = new Enrutador();
						// el @ es para q no muestre errores ni advertencias
						if (@$enrutador->validar($_GET['load'])){
							if (isset($_POST['codigo'])) {
								echo $_POST['codigo'];
							}
							@$enrutador->cargarVista($_GET['load']);
						}
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
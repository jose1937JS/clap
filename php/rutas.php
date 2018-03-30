<?php 

class Enrutador {

	public function cargarVista($vista){

		switch ($vista) {
			case 'usuario':
				include_once(dirname(__DIR__) .'/vistas/' . $vista . '.php');
				break;

			case 'editar':
				include_once(dirname(__DIR__) .'/vistas/' . $vista . '.php');
				break;

			case 'historeclam':
				include_once(dirname(__DIR__) .'/vistas/' . $vista . '.php');
				break;

			case 'adminusers':
				include_once(dirname(__DIR__) .'/vistas/' . $vista . '.php');
				break;

			case 'eliminar':
				include_once(dirname(__DIR__) .'/vistas/' . $vista . '.php');
				break;

			case 'infoper':
				include_once(dirname(__DIR__) .'/vistas/'. $vista . '.php');
				break;

			case 'listado':
				include_once(dirname(__DIR__) .'/vistas/'. $vista . '.php');
				break;

			case 'respuestas':
				include_once(dirname(__DIR__) .'/vistas/'. $vista . '.php');
				break;
			
			default:
				include_once('../vistas/error.php');
		}
	}

	public function validar($variable){
		if (empty($variable) && $_SESSION['admin'] == false){
			include_once('../vistas/usuario.php');
		}
		else if (empty($variable) && $_SESSION['admin'] == true) {
			
			include_once('../vistas/reclamos.php');
		}
		else {
			return true;
		}
	}
}
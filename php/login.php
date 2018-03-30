<?php 
include_once('conexion.php');

class Login {

	public $con;

	public function __construct(){
		$this->con = new Conexion();
	}

	// public function obtenerDatos($cedula){

	// 	$sql = "SELECT id FROM personas WHERE cedula = '$cedula' ";
	// 	$fila = $this->con->consultaRetorno($sql);
	// 	$id = $fila->fetch_array(MYSQLI_ASSOC);
	// 	$idd = $id['id'];


	// 	$sql2 = "SELECT personas.cedula, usuarios.clave, usuarios.admin, usuarios.id_persona, personas.id FROM usuarios INNER JOIN personas ON id_persona = personas.id WHERE id_persona = $idd ";

	// 	$datos = $this->con->consultaRetorno($sql2);
	
	// 	$row = $datos->fetch_array(MYSQLI_ASSOC);

	// 	// Para utilizar cuando el usuario sea incorrecto
	// 	//header('Location: index.php?msj=Cedula Incorrecta');

	// 	return $row;
	// }

	public function obtenerDatos($cedula){

		$sql = "SELECT id FROM personas WHERE cedula = '$cedula' ";
		$fila = $this->con->consultaRetorno($sql);
		$id = $fila->fetch_array(MYSQLI_ASSOC);
		
		if (count($id) == 0) {
			//header('Location: index.php?msj=Usuario Incorrecto');
		}
		else {
			$idd = $id['id'];
			$sql2 = "SELECT personas.cedula, usuarios.clave, usuarios.admin FROM usuarios INNER JOIN personas ON usuarios.id_persona = personas.id WHERE usuarios.id_persona = $idd ";
			
			$datos = $this->con->consultaRetorno($sql2);
			$row = $datos->fetch_array(MYSQLI_ASSOC);

			return $row;
		}
	}


	// comparar valores del formulario con el array de usuarios y claves
	public function validarLogin($cedula, $clave){

		$datos = $this->obtenerDatos($cedula);

		if ($cedula == $datos['cedula'] && $clave == $datos['clave'] && $datos['admin'] == 0) {
			session_start();
			$_SESSION['cedula'] = $datos['cedula'];
			$_SESSION['admin'] = false;
			header('Location: ./vistas/inicio.php');
		}
		else if ($cedula == $datos['cedula'] && $clave == $datos['clave'] && $datos['admin'] == 1) {
			session_start();
			$_SESSION['cedula'] = $datos['cedula'];
			$_SESSION['admin'] = true;
			header('Location: ./vistas/admin.php');
		}
		else { header('Location: index.php?msj=Usuario o clave incorrecto'); }

	}

	public function desconectar(){ 
		session_destroy();
		header('Location: ../index.php');
	}
}
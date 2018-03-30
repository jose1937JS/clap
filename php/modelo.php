<?php 
include_once('conexion.php');

/*
	*  MAKE A FUNCTION THAT BRING ME THE SISTEM DATE AND TIME
	*  MAKE A FUNCTION THAT BRING ME THE PERSON'S ID
	*  
*/
class Publicaciones {
	
	private $titulo;
	private $contenido;
	private $con;

	public function __construct(){
		$this->con = new Conexion();
	}

	public function set($attr, $valor){
		$this->$attr = $valor;
	}

	public function listar(){
		$sql = "SELECT * FROM publicaciones ORDER BY id DESC";
		
		$resultado = $this->con->consultaRetorno($sql);

		return $resultado;		
	}

	public function insertar($fecha){
		$sql = "INSERT INTO publicaciones (titulo, contenido, fecha) VALUES ('{$this->titulo}', '{$this->contenido}', '$fecha')";

		$this->con->consultaSimple($sql);
	}

}

class Reclamo {

	private $reclamo;
	private $fecha;

	private $con;

	public function __construct(){
		$this->con = new Conexion();
	}

	public function set($attr, $valor){
		$this->$attr = $valor;
	}

	public function listar(){
		$sql = "SELECT personas.nombre, personas.apellido, personas.cedula, reclamos.id, reclamos.id_respuesta, reclamos.reclamo, reclamos.fecha FROM reclamos INNER JOIN personas ON reclamos.id_persona = personas.id WHERE id_respuesta is NULL ORDER BY id DESC";

		$result = $this->con->consultaRetorno($sql);

		return $result;
	}

	public function listarRespondidos(){
		$sql = "select reclamos.id, personas.nombre, personas.apellido, reclamos.reclamo, reclamos.fecha, respuestas.respuesta, respuestas.fecha as fecha_resp from reclamos inner join personas on id_persona = personas.id inner JOIN respuestas on id_respuesta = respuestas.id";

		$result = $this->con->consultaRetorno($sql);

		return $result;
	}

	public function listarPorId($cedula){
		$resul = $this->con->consultaRetorno("SELECT id FROM personas WHERE cedula = $cedula");
		$r = $resul->fetch_array(MYSQLI_ASSOC);
		$id = $r['id'];

		$sql = "SELECT personas.nombre, personas.apellido, reclamos.id_respuesta, reclamos.reclamo, reclamos.fecha, respuestas.fecha as fecha_res, respuestas.respuesta FROM reclamos INNER JOIN personas ON reclamos.id_persona = personas.id INNER JOIN respuestas on id_respuesta = respuestas.id WHERE id_persona = $id ORDER BY reclamos.id DESC";

		$result = $this->con->consultaRetorno($sql);

		return $result;
	}

	public function insertar($cedula){

		$resul = $this->con->consultaRetorno("SELECT id FROM personas WHERE cedula = $cedula");
		$r = $resul->fetch_array(MYSQLI_ASSOC);
		$id = $r['id'];

		$sql = "INSERT INTO reclamos(id_persona, reclamo, fecha) VALUES($id, '{$this->reclamo}', '{$this->fecha}') ";

		$this->con->consultaSimple($sql);
	}
}

class Respuesta {

	private $respuesta;
	private $fecha;
	private $con;

	public function __construct(){
		$this->con = new Conexion();
	}

	public function set($attr, $valor){
		$this->$attr = $valor;
	}

	public function insertar($id_reclamo){
		// inserto la respuesta
		$sql = "INSERT INTO respuestas (respuesta, fecha) VALUES ('{$this->respuesta}', '{$this->fecha}')";
		$this->con->consultaSimple($sql);

		// recupero el id de la untima respuesta
		$r = $this->con->consultaRetorno("SELECT id FROM respuestas ORDER BY ID DESC limit 1");
		$asd = $r->fetch_array(MYSQLI_ASSOC);
		$id_respuesta = $asd['id'];

		// actualizo la tabla reclamos con el reclamo correspndoente y la ultima respuesta
		$sql2 = "UPDATE reclamos SET id_respuesta = $id_respuesta WHERE id = $id_reclamo";

		$this->con->consultaSimple($sql2);
	}
}

class Entregas {
	
	private $id_persona;
	private $noreferencia;
	private $recibio;
	private $con;

	public function __construct(){
		$this->con = new Conexion();
	}

	public function set($attr, $valor){
		$this->$attr = $valor;
	}

	public function listar(){
		$sql = "SELECT personas.cedula, personas.nombre, personas.apellido, entregas.noreferencia, entregas.fecha, entregas.recibio, entregas.id_persona FROM entregas INNER JOIN personas ON entregas.id_persona = personas.id";

		$query = $this->con->consultaRetorno($sql);

		return $query;
	}

	public function insertar(){
		$fecha = date("l d F Y G:i:s");
		$sql = "INSERT INTO entregas(id_persona, fecha, noreferencia) VALUES('{$this->id_persona}', '$fecha', '{$this->noreferencia}')";

		$this->con->consultaSimple($sql);
	}

	public function actualizarId($referencia){
		$id = $this->con->consultaRetorno("SELECT id_persona FROM entregas WHERE noreferencia = '$referencia' ");
		$idd = $id->fetch_array(MYSQLI_ASSOC);

		$asd = $idd['id_persona'];
		$this->con->consultaSimple("UPDATE entregas SET recibio = '1' WHERE id_persona = '$asd'");
	
	}
}

class Usuarios {

	private $admin;
	private $id_persona;
	private $clave;
	private $con;

	public function __construct(){
		$this->con = new Conexion();
	}

	public function set($attr, $valor){
		$this->$attr = $valor;
	}

	public function eliminar(){
		$sql = "DELETE FROM usuarios WHERE id_persona = '{$this->id_persona}'";

		$this->con->consultaSimple($sql);
	}

	public function mostrar(){
		$sql = "SELECT usuarios.id, usuarios.id_persona, personas.cedula, personas.nombre, personas.apellido, usuarios.admin FROM usuarios INNER JOIN personas ON usuarios.id_persona = personas.id";

		 $var = $this->con->consultaRetorno($sql);

		 return $var;
	}

	public function insertar(){
		$sql = "INSERT INTO usuarios(id_persona, clave, admin) VALUES('{$this->id_persona}', '{$this->clave}', '0')";

		$this->con->consultaSimple($sql);
	}

	public function insertarAdmin($id){
		$sql = "UPDATE usuarios SET admin = '1', clave = '{$this->clave}' WHERE id = '$id'";

		var_dump($sql);

		$this->con->consultaSimple($sql);
	}

	public function cambiarClave(){
		$sql = "UPDATE usuarios SET clave = '{$this->clave}' WHERE id_persona = '{$this->id_persona}'";
		$this->con->consultaSimple($sql);
	}

	// public function eliminar(){
	// 	$sql = "DELETE FROM usuarios WHERE cedula = '{$this->cedula}'";
	// 	$this->con->consultaSimple($sql);
	// }

}

class Personas {

	private $cedula;
	private $nombre;
	private $apellido;
	private $telefono;
	private $direccion;
	private $con;

	public function __construct(){
		$this->con = new Conexion();
	}

	public function set($attr, $valor){
		$this->$attr = $valor;
	}

	public function informacionPersonaUsuario(){

		$sql = "SELECT personas.id, personas.nombre, personas.apellido, personas.cedula, personas.telefono, personas.direccion, usuarios.clave FROM personas INNER JOIN usuarios ON personas.id = usuarios.id_persona WHERE personas.cedula = '{$this->cedula}' ";
		$resultado = $this->con->consultaRetorno($sql);

		return $resultado;

	}
	public function informacion(){

		$sql = "SELECT id, nombre, apellido, cedula, telefono, direccion FROM personas  WHERE cedula = '{$this->cedula}' ";
		$resultado = $this->con->consultaRetorno($sql);

		return $resultado;

	}

	public function editar() {

		$sql = "UPDATE personas SET nombre='{$this->nombre}', apellido='{$this->apellido}', telefono='{$this->telefono}', direccion='{$this->direccion}' WHERE cedula = '{$this->cedula}' ";

		return $this->con->consultaSimple($sql);
	}


	public function crear(){
		
		$sql2 = "SELECT * FROM personas WHERE cedula='{$this->cedula}'";
		$resultado = $this->con->consultaRetorno($sql2);
		$num = $resultado->num_rows;

		if ($num != 0) {
			return false;
		}
		else {
			$sql = "INSERT INTO personas(nombre, apellido, cedula, telefono, direccion) VALUES('$this->nombre', '$this->apellido', '$this->cedula', '$this->telefono', '$this->direccion')";
			
			$this->con->consultaSimple($sql);
		}
	}

	
	// public function ver(){
	// 	$sql = "SELECT personascedula, personas.nombre, personas.apellido, personas.telefono, personas.proyecto, personas.id_institucion, Liceos.serial, Liceos.liceo, Liceos.direccion FROM personas INNER JOIN Liceos ON personas.id_institucion = Liceos.id WHERE personas.cedula = '{$this->cedula}' ";

	// 	$resultado = Conexion::consultaRetorno($sql);

	// 	$row = $resultado->fetch_assoc();

	// 	// $this->id = $row['id'];
	// 	// $this->serial = $row['serial'];
	// 	// $this->nombre_liceo = $row['liceo'];
	// 	// $this->direccion = $row['direccion'];

	// 	return $row;
	// }

}
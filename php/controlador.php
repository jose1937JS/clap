<?php

include_once('modelo.php');

class Controlador {

	private $publicaciones;
	private $reclamo;
	private $respuesta;
	private $entregas;
	private $personas;
	private $usuarios;

	public function __construct(){

		$this->publicaciones = new Publicaciones();
		$this->reclamo 		 = new Reclamo();
		$this->respuesta 	 = new Respuesta();
		$this->entregas		 = new Entregas();
		$this->personas 	 = new Personas();
		$this->usuarios 	 = new Usuarios();
	}

	public function traerid($referencia){
		return $this->entregas->actualizarId($referencia);
	}

	public function index(){
		$resultado = $this->publicaciones->listar();
		
		return $resultado;
	}

	public function addPublicacion($titulo, $publicacion){
		$this->publicaciones->set("titulo", $titulo);
		$this->publicaciones->set("contenido", $publicacion);

		$fecha = date("l d F Y G:i:s");

		$this->publicaciones->insertar($fecha);
	}

	public function listado(){
		$listado = $this->entregas->listarPersonas();
		return $listado;
	}

	public function listarReclamos(){
		return $resultado = $this->reclamo->listar();
	}

	public function listarReclamosId($cedula){
		return $resultado = $this->reclamo->listarPorId($cedula);	
	}

	public function listarReclamosRespondidos(){
		return $resultado = $this->reclamo->listarRespondidos();
	}

	public function respuesta($respuesta, $id_reclamo){
		// wednesday 27 september 2018 12:28:03
		$fecha = date("l d F Y G:i:s");

		$this->respuesta->set("respuesta", $respuesta);
		$this->respuesta->set("fecha", $fecha);

		$this->respuesta->insertar($id_reclamo);
	}

	public function addReclamo($reclamo, $cedula){
		// wednesday 27 september 2018 12:28:03
		$fecha = date("l d F Y G:i:s");

		$this->reclamo->set("reclamo", $reclamo);
		$this->reclamo->set("fecha", $fecha);
	
		$this->reclamo->insertar($cedula);
	}

	public function referencia($id_persona, $referencia){
		$this->entregas->set("id_persona", $id_persona);
		$this->entregas->set("noreferencia", $referencia);

		$this->entregas->insertar();
	}

	public function verReferencias(){
		return $this->entregas->listar();
	}

	public function verInfoperUsu($cedula){
		$this->personas->set("cedula", $cedula);
		$var = $this->personas->informacionPersonaUsuario();

		return $var;
	}
	// public function verInfo($cedula){
	// 	$this->personas->set("cedula", $cedula);
	// 	$var = $this->personas->informacion();

	// 	return $var;
	// }

	public function infoPersonas($cedula){
		$this->personas->set("cedula", $cedula);
		$var = $this->personas->informacion();

		return $var;
	}

	public function addUser($id_persona, $clave){
		$this->usuarios->set("id_persona", $id_persona);
		$this->usuarios->set("clave", $clave);
		
		$this->usuarios->insertar();
	}

	public function addAdmin($id_usuario, $clave){
		$this->usuarios->set("clave", $clave);
		
		$this->usuarios->insertarAdmin($id_usuario);
	}

	public function cambiarClave($nuevaClave, $id_persona){
		$this->usuarios->set("id_persona", $id_persona);
		$this->usuarios->set("clave", $nuevaClave);

		$this->usuarios->cambiarClave();
	}

	public function eliminar($id_persona){
		$this->usuarios->set("id_persona", $id_persona);
		$this->usuarios->eliminar();
	}

	public function listarUsers(){
		$var = $this->usuarios->mostrar();

		return $var;
	}

	public function editar($cedula, $nombre, $apellido, $telefono, $direccion){

		$this->personas->set("cedula", $cedula);
		$this->personas->set("nombre", $nombre);
		$this->personas->set("apellido", $apellido);
		$this->personas->set("telefono", $telefono);
		$this->personas->set("direccion", $direccion);

		//$this->personas->verInfo();
		$this->personas->editar();
	}

	public function personas($nombre, $apellido, $cedula, $telefono, $direccion){

		$this->personas->set("nombre", $nombre);
		$this->personas->set("apellido", $apellido);
		$this->personas->set("cedula", $cedula);
		$this->personas->set("telefono", $telefono);
		$this->personas->set("direccion", $direccion);

		$this->personas->crear();
	}

}
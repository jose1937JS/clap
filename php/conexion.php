<?php

class Conexion {

	public $conexion;

	public function __construct(){
		$this->conexion = new mysqli('127.0.0.1', 'root', 'root', 'CLAP');
		
		if ($this->conexion->connect_errno) {
			echo "Don't Work: " . $this->conexion->connect_error . "\n";
		}		
	}

	public function consultaSimple($sql){
		$this->conexion->query($sql);
	}

	public function consultaRetorno($sql){
		$consulta = $this->conexion->query($sql);

		return $consulta;
	}
}
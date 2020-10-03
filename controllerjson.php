<?php

require_once 'modelojson.php';
/**
 *
 */
class ControllerJson
{
	#usuarios
	public function createUsuarioController($fullname, $username, $password, $secretpin, $created){

		$datosController = array("fullname"=>$fullname,
			"username"=>$username,
			"password"=>$password,
			"secretpin"=>$secretpin,
			"created"=>$created);

		$respuesta = Datos::createUsuarioModel($datosController, "usuarios");
		return $respuesta;
	}

	public function readUsuariosController(){

		$respuesta = Datos::readUsuarioModel("usuarios");
		return $respuesta;
	}

	public function updateUsuariosController($id, $password){

		$datosController = array("id"=>$id, "password"=>$password);
		$respuesta = Datos::updateUsuarioModel($datosController, "usuarios");
		return $respuesta;

	}

	public function deleteUsuariosController($id){

		$respuesta = Datos::deleteUsuarioModel($id, "usuarios");
		return $respuesta;

	}

	public function loginUsuarioController($username, $password){

		$datosController = array("username" => $username,
			"password"=>$password);

		$respuesta = Datos::loginUsuarioModel($datosController, "usuarios");
		return $respuesta;
	}
}
?>
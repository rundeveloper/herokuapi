<?php

require_once 'controllerjson.php';

//función validando todos los parametros disponibles
//pasaremos los parámetros requeridos a esta función

function isTheseParametersAvailable($params){
	//suponiendo que todos los parametros estan disponibles
	$available = true;
	$missingparams = "";

	foreach ($params as $param) {
		if(!isset($_POST[$param]) || strlen($_POST[$param]) <= 0){
			$available = false;
			$missingparams = $missingparams . ", " . $param;
		}
	}

	//si faltan parametros
	if(!$available){
		$response = array();
		$response['error'] = true;
		$response['message'] = 'Parametro: ' . substr($missingparams, 1, strlen($missingparams)) . ' vacio';

		//error de visualización
		echo json_encode($response);

		//detener la ejecición adicional
		die();
	}
}

//una matriza para mostrar las respuestas de nuestro api
$response = array();

//si se trata de una llamada api
//que significa que un parametro get llamado se establece un la URL
//y con estos parametros estamos concluyendo que es una llamada api

if(isset($_GET['apicall'])){

	//Aqui iran todos los llamados de nuestra api
	switch ($_GET['apicall']) {

		//opcion Crear Usuarios
		case 'createusuario':
			//primero haremos la verificación de parametros.
			isTheseParametersAvailable(array('fullname', 'username', 'password', 'secretpin', 'created'));
			$db = new controllerjson();
			$result = $db->createUsuarioController($_POST['fullname'],
				$_POST['username'],
				$_POST['password'],
				$_POST['secretpin'],
				$_POST['created']);

			if($result){
				//esto significa que no hay ningun error
				$response['error'] = false;
				//mensaje que se ejecuto correctamente
				$response['message'] = 'Usuario agregado correctamente';
				$response['contenido'] = $db->readUsuariosController();
			}else{
				$response['error'] = true;
				$response['message'] = 'ocurrio un error, intenta nuevamente';
			}
		break;

		case 'readusuarios':
			$db = new controllerjson();
			$response['error'] = false;
			$response['message'] = 'Solicitud completada correctamente';
			$response['contenido'] = $db->readUsuariosController();
		break;

		case 'loginusuario':
			isTheseParametersAvailable(array('username', 'password'));
			$db = new controllerjson();
			$result = $db->loginUsuarioController($_POST['username'],
				$_POST['password']);

			if(!$result){
				$response['error'] = true;
				$response['menssage'] = 'credenciales no validas';
			}else{
				$response['error'] = false;
				$response['message'] = 'Bienvenido';
				$response['contenido'] = $result;
			}
		break;
	}

}else{
	//si no es un api el que se esta invocando
	//empujar los valores apropiados en la estructura json
	$response['error'] = true;
	$response['message'] = 'Llamado Invalido del API!';
}

echo json_encode($response);

?>
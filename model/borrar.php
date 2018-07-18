<?php
	//se incluyen los archivos de modelo y controlador
	require_once("model/crud.php");
	require_once("controller/controller.php");

	//se crea la instancia del controlador
	$controller = new MVC();

	//se ejecuta el metodo borrar de la clase del controlador
	$controller->borrarController($_GET['id'],$_GET['tipo']);

?>
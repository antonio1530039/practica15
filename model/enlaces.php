<?php
//Clase de enlaces de pagina
class Enlaces{
	//metodo publico que dado un nombre de enlace, retorna el modulo que sera incluido o mostrado 
	public function enlacesPaginasModel($enlace){
		
		if($enlace== "usuarios" || $enlace == "grupos" || $enlace == "alumnos" || $enlace == "carreras" || $enlace =="sesion_cai"|| $enlace == "actividades" || $enlace == "unidades"){
			$module = "view/$enlace/$enlace.php";
		}else if($enlace == "editar_usuario" || $enlace == "registro_usuario"){
			$module = "view/usuarios/$enlace.php";
		}else if($enlace== "editar_grupo" || $enlace == "registro_grupo"){
			$module = "view/grupos/$enlace.php";
		}else if($enlace== "editar_alumno" || $enlace == "registro_alumno"){
			$module = "view/alumnos/$enlace.php";
		}else if($enlace== "editar_carrera" || $enlace == "registro_carrera"){
			$module = "view/carreras/$enlace.php";
		}else if($enlace == "editar_actividad" || $enlace == "registro_actividad"){
			$module = "view/actividades/$enlace.php";
		}else if($enlace == "editar_unidad" || $enlace == "registro_unidad"){
			$module = "view/unidades/$enlace.php";
		}else if($enlace == "login"){
			$module = "view/login.php";
		}else if($enlace == "borrar"){
			$module = "model/borrar.php";
		}else if($enlace == "logout"){
			$module = "model/logout.php";
		}else if($enlace == "reportes"){
			$module = "view/$enlace/$enlace.php";
		}
		else{
			$module = "view/sesion_cai/sesion_cai.php";
		}
		return $module;
	}
}



?>
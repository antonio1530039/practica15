<?php
//se incluye el archivo de conexion
require_once "conexion.php";
//clase modelo llamada Crud que hereda las propiedades y metodos de la clase Conexion
class Crud extends Conexion{
	
	//metodo ingresoUsuarioModel: dado un codigo de empleado y una contrasena, se realiza un select en la base de datos de usuarios y reotrna el resultado, esto para verificar si coincide con una cuenta de un usuario registrada
	public function ingresoUsuarioModel($user, $password){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE codigo = :user and password = :password"); //se prepara la conexion
		//definicion de parametros
		$stmt->bindParam(":user", $user);
		$stmt->bindParam(":password",$password);
		$stmt->execute(); //ejecucion mediante pdo
		return $stmt->fetch(); //se retorna lo asociado a la consulta
		$stmt->close();
	}

	//Obtener el total de alumnos
	public function contarAlumnosController(){
		$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM sesion_cai WHERE fecha = CURDATE() AND hora >= DATE_FORMAT(NOW(), '%k:00:00') AND hora <= DATE_FORMAT(NOW(), '%k:59:59') AND asistencia=0"); //se prepara la conexion
		//definicion de parametros
		$stmt->execute(); //ejecucion mediante pdo
		return $stmt->fetch()[0]; //se retorna lo asociado a la consulta
		$stmt->close();
	}

	//Se eliminan todas las sesiones que no sean de la sesion actual y no tengan asistencia
	public function deleteSesionesSinAsistenciaModel(){
		$stmt = Conexion::conectar()->prepare("DELETE FROM sesion_cai WHERE asistencia=0 AND ( ( hora < DATE_FORMAT(NOW(), '%k:00:00') OR hora > DATE_FORMAT(NOW(), '%k:59:59') ) OR fecha!=CURDATE())"); //se prepara la conexion
		//definicion de parametros
		if($stmt->execute())
			return "success";
		else
			return "error";
		$stmt->close();
	}

	//metodo vistaXTablaModel: dado un nombre de tabla realiza un select y retorna el contenido de la tabla, considerando solamente registros no borrados.
	public function vistaXTablaModel($table){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $table"); //preparacion de la consulta SQL 
		$stmt->execute(); //ejecucion de la consulta
		return $stmt->fetchAll(); //se retorna en un array asociativo el resultado de la consulta
		$stmt->close();

	}

	//metodo obtiene todas las sesiones de la hora y la fecha ingresada
	public function getSesionesControllerModel(){
		$stmt = Conexion::conectar()->prepare("SELECT a.id as id_alumno, a.imagen as imagen, sc.id as id, a.matricula as matricula, CONCAT(a.nombre,' ',a.apellidos) as nombre, ac.nombre as actividad, sc.hora as hora, sc.asistencia as asistencia FROM sesion_cai AS sc INNER JOIN alumnos AS a ON a.id=sc.id_alumno INNER JOIN actividades AS ac ON ac.id = sc.id_actividad WHERE fecha = CURDATE() AND hora >= DATE_FORMAT(NOW(), '%k:00:00') AND hora <= DATE_FORMAT(NOW(), '%k:59:59') AND asistencia=0"); //preparacion de la consulta SQL 
		$stmt->execute(); //ejecucion de la consulta
		return $stmt->fetchAll(); //se retorna en un array asociativo el resultado de la consulta
		$stmt->close();
	}

	public function setAsistenciaModel($id){
		$stmt = Conexion::conectar()->prepare("UPDATE sesion_cai SET asistencia = 1 WHERE id = :id");
		$stmt->bindParam(":id", $id);
		if($stmt->execute())
			return "success";
		else
			return "error";
		$stmt->close();
	}

	

	//metodo registroUsuarioModel: dado un arreglo asociativo de datos, se inserta en la tabla usuarios los datos especificados
	//los usuarios pueden ser de tipo (maestro o encargado)
	public function registroUsuarioModel($data){
		$stmt = Conexion::conectar()->prepare("INSERT INTO usuarios(codigo,nombre,apellidos, email, password, tipo) VALUES(:codigo, :nombre, :apellidos, :email, :password, :tipo)");
		//preparacion de parametros
		$stmt->bindParam(":codigo", $data['codigo']);
		$stmt->bindParam(":nombre", $data['nombre']);
		$stmt->bindParam(":apellidos", $data['apellidos']);
		$stmt->bindParam(":email", $data['email']);
		$stmt->bindParam(":password", $data['password']);
		$stmt->bindParam(":tipo", $data['tipo']);
		if($stmt->execute()) //ejecucion
			return "success"; //respuesta
		else
			return "error";
		$stmt->close();
	}

	//metodo registroAlumnoModel: dado un arreglo asociativo de datos, se inserta en la tabla alumnos los datos especificados
	public function registroAlumnoModel($data){
		$stmt = Conexion::conectar()->prepare("INSERT INTO alumnos(matricula,nombre,apellidos, id_carrera, id_grupo, imagen) VALUES(:matricula, :nombre, :apellidos, :carrera, :id_grupo, :imagen)");
		//preparacion de parametros
		$stmt->bindParam(":matricula", $data['matricula']);
		$stmt->bindParam(":nombre", $data['nombre']);
		$stmt->bindParam(":apellidos", $data['apellidos']);
		$stmt->bindParam(":carrera", $data['carrera']);
		$stmt->bindParam(":id_grupo", $data['id_grupo']);
		$stmt->bindParam(":imagen", $data['imagen']);
		if($stmt->execute()) //ejecucion
			return "success"; //respuesta
		else{
			//echo print_r($stmt->errorInfo());
			return "error";
		}
		$stmt->close();
	}

	//metodo registroGrupoModel: dado un arreglo asociativo de datos, se inserta en la tabla grupos los datos especificados
	public function registroGrupoModel($data){
		$stmt = Conexion::conectar()->prepare("INSERT INTO grupos(nombre,id_maestro) VALUES(:nombre, :id_maestro)");
		//preparacion de parametros
		$stmt->bindParam(":nombre", $data['nombre']);
		$stmt->bindParam(":id_maestro", $data['id_maestro']);
		if($stmt->execute()) //ejecucion
			return "success"; //respuesta
		else
			return "error";
		$stmt->close();
	}

	//metodo registroActividadModel: dado un arreglo asociativo de datos, se inserta en la tabla actividades los datos especificados
	public function registroActividadModel($data){
		$stmt = Conexion::conectar()->prepare("INSERT INTO actividades(nombre) VALUES(:nombre)");
		//preparacion de parametros
		$stmt->bindParam(":nombre", $data['nombre']);
		if($stmt->execute()) //ejecucion
			return "success"; //respuesta
		else
			return "error";
		$stmt->close();
	}



	//metodo registroUnidadModel: dado un arreglo asociativo de datos, se inserta en la tabla unidades los datos especificados
	public function registroUnidadModel($data){
		$stmt = Conexion::conectar()->prepare("INSERT INTO unidades(nombre, fecha_inicio, fecha_fin) VALUES(:nombre, :fecha_inicio, :fecha_fin)");
		//preparacion de parametros
		$stmt->bindParam(":nombre", $data['nombre']);
		$stmt->bindParam(":fecha_inicio", $data['fecha_inicio']);
		$stmt->bindParam(":fecha_fin", $data['fecha_fin']);
		if($stmt->execute()) //ejecucion
			return "success"; //respuesta
		else
			return "error";
		$stmt->close();
	}


	//metodo registroUnidadModel: dado un arreglo asociativo de datos, se inserta en la tabla unidades los datos especificados
	public function registroSesionCaiModel($data){
		$stmt = Conexion::conectar()->prepare("INSERT INTO sesion_cai(hora, fecha, id_unidad, id_alumno, id_encargado, id_actividad, asistencia) VALUES(DATE_FORMAT(NOW(), '%k:%i:%s'), CURDATE(), :id_unidad, :id_alumno, :id_encargado, :id_actividad, :asistencia)");
		//preparacion de parametros
		$stmt->bindParam(":id_unidad", $data['id_unidad']);
		$stmt->bindParam(":id_alumno", $data['id_alumno']);
		$stmt->bindParam(":id_encargado", $data['id_encargado']);
		$stmt->bindParam(":id_actividad", $data['id_actividad']);
		$stmt->bindParam(":asistencia", $data['asistencia']);
		if($stmt->execute()){ //ejecucion
			$stmt = Conexion::conectar()->prepare("SELECT MAX(id) AS id, DATE_FORMAT(NOW(), '%k:%i:%s') AS hora FROM sesion_cai");
			$stmt->execute();
			return json_encode($stmt->fetch()); //respuesta
		}
		else{
			return "error";
		}
		$stmt->close();
	}

	//Obtiene la hora del servidor
	public function getServerHour(){
		$stmt = Conexion::conectar()->prepare("SELECT DATE_FORMAT(NOW(), '%k:%i:%s') AS hora");
		$stmt->execute();
		return $stmt->fetch()[0]; //respuesta
	}

	//Obtiene la fecha actual del servidor
	public function getServerDate(){
		$stmt = Conexion::conectar()->prepare("SELECT CURDATE() AS fecha");
		$stmt->execute();
		return $stmt->fetch()[0]; //respuesta
	}

	//metodo registroCarreraModel: dado un arreglo asociativo de datos, se inserta en la tabla carreras los datos especificados
	public function registroCarreraModel($data){
		$stmt = Conexion::conectar()->prepare("INSERT INTO carreras(nombre) VALUES(:nombre)");
		//preparacion de parametros
		$stmt->bindParam(":nombre", $data['nombre']);
		if($stmt->execute()) //ejecucion
			return "success"; //respuesta
		else
			return "error";
		$stmt->close();
	}

	

	//metodo getRegModel: dado un id de un registro y el nombre de la tabla se retorna la informacion del id asociado
	public function getRegModel($id, $table){
		//se prepara la consulta sql
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id = :id");
		$stmt->bindParam(":id",$id); //se asocia el parametro 
		$stmt->execute(); //se ejecuta la consulta
		return $stmt->fetch(); //se retorna el resultado de la consulta
		$stmt->close();
	}


	//metodo actualizarUsuarioModel: dado un array de datos, se actualizan los datos de este con los datos mandados segun el codigo del usuario
	public function actualizarUsuarioModel($data){
		$stmt = Conexion::conectar()->prepare("UPDATE usuarios SET codigo = :codigo, nombre=:nombre, apellidos=:apellidos, email=:email, password=:password, tipo=:tipo WHERE id = :id");
		$stmt->bindParam(":codigo", $data['codigo']);
		$stmt->bindParam(":nombre", $data['nombre']);
		$stmt->bindParam(":apellidos", $data['apellidos']);
		$stmt->bindParam(":email", $data['email']);
		$stmt->bindParam(":password", $data['password']);
		$stmt->bindParam(":tipo", $data['tipo']);
		$stmt->bindParam(":id", $data['id']);
		if($stmt->execute())
			return "success";
		else
			return "error";
		$stmt->close();


	}

	//metodo actualizarAlumnoModel: dado un array de datos, se actualizan los datos de este con los datos mandados segun el codigo del alumno
	public function actualizarAlumnoModel($data){
		$stmt = Conexion::conectar()->prepare("UPDATE alumnos SET matricula=:matricula, nombre=:nombre, apellidos=:apellidos, id_carrera=:id_carrera, id_grupo=:id_grupo WHERE id = :id");
		$stmt->bindParam(":matricula", $data['matricula']);
		$stmt->bindParam(":nombre", $data['nombre']);
		$stmt->bindParam(":apellidos", $data['apellidos']);
		$stmt->bindParam(":id_carrera", $data['id_carrera']);
		$stmt->bindParam(":id_grupo", $data['id_grupo']);
		$stmt->bindParam(":id", $data['id']);
		if($stmt->execute())
			return "success";
		else
			return "error";
		$stmt->close();
	}

	//metodo actualizarGrupoModel: dado un array de datos, se actualizan los datos de este con los datos mandados segun el codigo del grupo
	public function actualizarGrupoModel($data){
		$stmt = Conexion::conectar()->prepare("UPDATE grupos SET nombre=:nombre, id_maestro = :id_maestro WHERE id=:id");
		$stmt->bindParam(":id_maestro", $data['id_maestro']);
		$stmt->bindParam(":nombre", $data['nombre']);
		$stmt->bindParam(":id", $data['id']);
		if($stmt->execute())
			return "success";
		else
			return "error";
		$stmt->close();


	}

	//metodo actualizarActividadModel: dado un array de datos, se actualizan los datos de este con los datos mandados segun el codigo del grupo
	public function actualizarActividadModel($data){
		$stmt = Conexion::conectar()->prepare("UPDATE actividades SET nombre=:nombre WHERE id=:id");
		$stmt->bindParam(":nombre", $data['nombre']);
		$stmt->bindParam(":id", $data['id']);
		if($stmt->execute())
			return "success";
		else
			return "error";
		$stmt->close();


	}

	//metodo actualizarUnidadModel: dado un array de datos, se actualizan los datos de este con los datos mandados segun el id de la unidad
	public function actualizarUnidadModel($data){
		$stmt = Conexion::conectar()->prepare("UPDATE unidades SET nombre=:nombre, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin WHERE id=:id");
		$stmt->bindParam(":nombre", $data['nombre']);
		$stmt->bindParam(":fecha_inicio", $data['fecha_inicio']);
		$stmt->bindParam(":fecha_fin", $data['fecha_fin']);
		$stmt->bindParam(":id", $data['id']);
		if($stmt->execute())
			return "success";
		else
			return "error";
		$stmt->close();


	}


	//metodo actualizarCarreraModel: dado un array de datos, se actualizan los datos de este con los datos mandados segun el codigo del grupo
	public function actualizarCarreraModel($data){
		$stmt = Conexion::conectar()->prepare("UPDATE carreras SET nombre=:nombre WHERE id=:id");
		$stmt->bindParam(":nombre", $data['nombre']);
		$stmt->bindParam(":id", $data['id']);
		if($stmt->execute())
			return "success";
		else
			return "error";
		$stmt->close();


	}

	//metodo borrarXModel: dado un id de un registro y un nombre de tabla se realiza la eliminacion del registro
	public function borrarXModel($id, $table){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $table WHERE id = $id"); //preparar consulta para eliminar el registro con el id y la tabla mandada como parametro
		if($stmt->execute()) //se ejecuta la consulta
			return "success"; //se retorna la respuesta
		else
			return "error";
		$stmt->close();
	}

	#OBTIENE SI HAY DISPONIBILIDAD DEL PRODUCTO
	#-------------------------------------
	public function checkAvailabilityOfUserCodeModel($code, $table, $nid){
		$stmt = Conexion::conectar()->prepare("SELECT EXISTS(SELECT * FROM $table WHERE $nid = :codigo) as a");
		//echo $table . " " . $code . " ".$nid;
		$stmt->bindParam(":codigo", $code);
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}

		#OBTIENE SI HAY DISPONIBILIDAD DEL PRODUCTO
	#-------------------------------------
	public function getDetailsFromAlumnoModel($code, $table){
		$stmt = Conexion::conectar()->prepare("SELECT id, CONCAT(nombre,' ',apellidos) as nombre, imagen FROM $table WHERE matricula=:matricula");
		//echo $table . " " . $code . " ".$nid;
		$stmt->bindParam(":matricula", $code);
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}

	#Traer todas las actividades registradas
	#-------------------------------------
	public function getActividades(){
		$stmt = Conexion::conectar()->prepare("SELECT id, nombre FROM actividades");
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}

	#Traer todas las actividades registradas
	#-------------------------------------
	public function getUnidadIdModel(){
		$stmt = Conexion::conectar()->prepare("SELECT id FROM `unidades` WHERE fecha_fin>=NOW() AND fecha_inicio<=NOW()");
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}

	//metodo getReporteModel: dado un arreglo asociativo de datos, se obtienen los alumnos de un grupo y se filtra el numero de horas, segun la unidad y el id de grupo enviados como parametros
	public function getReporteModel($data){
		//Consulta SQL para traer las horas de los alumnos del grupo seleccionado segun el id de la unidad
		$stmt = Conexion::conectar()->prepare("SELECT a.id as id, a.matricula as matricula, a.nombre as alumnoN, a.apellidos as alumnoA, u.nombre as unidad ,SUM(sc.asistencia) as numero_horas, g.nombre as grupo
			FROM grupos as g
			INNER JOIN alumnos as a ON g.id = a.id_grupo
			INNER JOIN sesion_cai as sc on a.id = sc.id_alumno
			INNER JOIN unidades as u on u.id = sc.id_unidad
			WHERE g.id = :id_grupo and u.id = :id_unidad and sc.asistencia = 1
			GROUP BY sc.id_alumno");
		//preparacion de parametros
		$stmt->bindParam(":id_grupo", $data['id_grupo']);
		$stmt->bindParam(":id_unidad", $data['id_unidad']);
		$stmt->execute(); //ejecucion de la consulta
		return $stmt->fetchAll(); //se retorna en un array asociativo el resultado de la consulta
		$stmt->close();
	}

	//metodo getDetalleDeReporteModel: dado un id de un alumno, y el id de una unidad, se obtienen las actividades realizadas en cada hora en esa unidad 
	public function getDetalleDeReporteModel($data){
		//Consulta SQL para traer las horas de los alumnos del grupo seleccionado segun el id de la unidad
		$stmt = Conexion::conectar()->prepare("SELECT al.matricula as matricula, al.nombre as nombre, al.apellidos as apellidos, g.nombre as nombreGrupo, u.nombre as nombreUnidad,  a.nombre as nombreActividad, sc.fecha as fecha, sc.hora as hora
FROM sesion_cai as sc INNER JOIN actividades as a ON sc.id_actividad = a.id
INNER JOIN unidades as u on u.id = sc.id_unidad
INNER JOIN alumnos as al on al.id = sc.id_alumno
INNER JOIN grupos as g on g.id = al.id_grupo
WHERE sc.id_alumno = :id_alumno and sc.id_unidad = :id_unidad and sc.asistencia = 1

			");
		//preparacion de parametros
		$stmt->bindParam(":id_alumno", $data['id_alumno']);
		$stmt->bindParam(":id_unidad", $data['id_unidad']);
		$stmt->execute(); //ejecucion de la consulta
		return $stmt->fetchAll(); //se retorna en un array asociativo el resultado de la consulta
		$stmt->close();
	}



	//metodo vistaGruposModel: dado un id de maestro se filtran los grupos del mismo y se retorna el resultado obtenido
	public function vistaGruposModel($id_usuario){
		if(empty($id_usuario)){ //verificar si esta vacio el id de usuario (maestro), se obtienen todos los grupos
			$stmt = Conexion::conectar()->prepare("SELECT * FROM grupos"); //preparacion de la consulta SQL
		}
		else{ //si no esta vacio, se filtra por el id mandado como parametro
			$stmt = Conexion::conectar()->prepare("SELECT * FROM grupos WHERE id_maestro = :id"); //preparacion de la consulta SQL
			$stmt->bindParam(":id", $id_usuario);
		}
		$stmt->execute(); //ejecucion de la consulta
		return $stmt->fetchAll(); //se retorna en un array asociativo el resultado de la consulta
		$stmt->close();

	}

}



?>
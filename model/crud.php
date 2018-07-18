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

	//metodo vistaXTablaModel: dado un nombre de tabla realiza un select y retorna el contenido de la tabla, considerando solamente registros no borrados.
	public function vistaXTablaModel($table){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $table"); //preparacion de la consulta SQL 
		$stmt->execute(); //ejecucion de la consulta
		return $stmt->fetchAll(); //se retorna en un array asociativo el resultado de la consulta
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
		$stmt = Conexion::conectar()->prepare("INSERT INTO sesion_cai(hora, fecha, id_unidad, id_alumno, id_encargado, id_actividad, asistencia) VALUES(DATE_FORMAT(NOW(), '%H'), CURDATE(), :id_unidad, :id_alumno, :id_encargado, :id_actividad, :asistencia)");
		//preparacion de parametros
		$stmt->bindParam(":id_unidad", $data['id_unidad']);
		$stmt->bindParam(":id_alumno", $data['id_alumno']);
		$stmt->bindParam(":id_encargado", $data['id_encargado']);
		$stmt->bindParam(":id_actividad", $data['id_actividad']);
		$stmt->bindParam(":asistencia", $data['asistencia']);
		if($stmt->execute()) //ejecucion
			return "success"; //respuesta
		else{
			print_r($stmt->errorInfo());
			return "error";
		}
		$stmt->close();
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

}



?>
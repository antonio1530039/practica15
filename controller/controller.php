<?php

class MVC{
  //metodo que muestra la plantilla base
	public function showTemplate(){
		session_start();
		include "view/template.php";
	}

  //metodo encargado de capturar la variable action mediante el metodo get y hace la peticion al modelo para que redireccione a las vistas correspondientes
	public function enlacePaginasController(){
		if(isset($_GET['action'])){
			$enlace = $_GET['action'];
		}else{
			$enlace = 'index';
		}

		if(isset($_SESSION["user_info"])){
			if( ($enlace!= "dashboard" || $enlace != "index" || $enlace != "sesion_cai" || $enlace !="reportes_sesiones") && $_SESSION["user_info"]["tipo"] == "encargado" && $enlace != "logout" && $enlace != "reportes"){
					$enlace = "index";
			}

			if($enlace != "reportes_sesiones" && $_SESSION["user_info"]["tipo"] == "teacher" && $enlace != "logout" && $enlace != "reportes"){
				$enlace = "reportes";
			}		
		}

		

		//peticion al modelo
		$peticion = Enlaces::enlacesPaginasModel($enlace);
    	//mostrar peticion
		include $peticion;
	}

    //metodo que verifica si usuario ha iniciado sesion, si no es asi, redireccion al login
	public function verificarLoginController(){
		//session_start();
		if(isset($_SESSION)){
			if(isset($_SESSION['login'])){
            	if(!$_SESSION['login']){
          			echo "<script>window.location='index.php?action=login';</script>";  
            	}
      }else{
        echo "<script>window.location='index.php?action=login';</script>"; 
      }
		}else{
			echo "<script>window.location='index.php?action=login';</script>";
		}
	}
  
  
  
  
  
  //metodo especifico para el archivo header.php o navegacion, el cual verifica si el usuario esta logueado, entonces muestra el menu
 public function showNav(){
    if(isset($_SESSION)){
      if(isset($_SESSION['login'])){
         if($_SESSION['login']){ //verificar que el usuario inicio sesion
         	echo "			   <!-- Navbar -->
			  <nav class='main-header navbar navbar-expand bg-white navbar-light border-bottom'>
			    <!-- Left navbar links -->
			    <ul class='navbar-nav'>
			      <li class='nav-item'>
			        <a class='nav-link' data-widget='pushmenu' href='#'><i class='fa fa-bars'></i></a>
			      </li>
			      <li class='nav-item d-none d-sm-inline-block'>
			        <a href='index.php' class='nav-link' >Home</a>
			      </li>
           
			      </ul>

            <ul class='navbar-nav ml-auto'>
            <li class='nav-item d-none d-sm-inline-block'>
            <div style='font-size: 70%' id='fecha'></div>
            
            <div style='font-size: 110%' id='hora'></div>
            </li>
            </ul>
              ";
                              
      	echo "
			    
			  </nav>
			  <!-- Main Sidebar Container -->
			  <aside class='main-sidebar sidebar-dark-primary elevation-4'>
			    <!-- Brand Logo -->
			    <a href='index.php' class='brand-link'>
			      <img src='view/dist/img/AdminLTELogo.png' alt='Logo' class='brand-image img-circle elevation-3'
			           style='opacity: .8'>
			      <span class='brand-text font-weight-light'>Sistema de CAI</span>
			    </a>

			    <!-- Sidebar -->
			    <div class='sidebar'>
			      <!-- Sidebar user panel (optional) -->
			      <div class='user-panel mt-3 pb-3 mb-3 d-flex'>
			";

         	//verificar que tipo de usuario es:si es usuario root (el que agrega y accede a la tienda que quiera) o usuario de una tienda normal
         	if($_SESSION['user_info']['tipo'] == "superadmin"){//para usuario root
         		//verificar si el usurio esta logueado se imprime el menu
	            echo "
			        <div class='info'>
			          <a href='' class='d-block'>"; $this->mostrarInicioController(); echo "<br><i class='nav-icon fa fa-wrench'></i> [ Superadmin ]</a>
			        </div>
			      </div>

			      <!-- Sidebar Menu -->
			      <nav class='mt-2'>
			        <ul class='nav nav-pills nav-sidebar flex-column' data-widget='treeview' role='menu' data-accordion='false'>
			          <!-- Add icons to the links using the .nav-icon class
			               with font-awesome or any other icon font library -->
				";
            
                echo "
                      <li class='nav-item'>
                        <a href='index.php' class='nav-link'>
                          <i class='nav-icon fa fa-hourglass-end'></i>
                          <p>Sesion de CAI</p>
                        </a>
                      </li>
                      <li class='nav-item'>
                        <a href='index.php?action=carreras' class='nav-link'>
                          <i class='nav-icon fa fa-mortar-board'></i>
                          <p>Gestion de Carreras</p>
                        </a>
                      </li>
                      <li class='nav-item'>
                        <a href='index.php?action=grupos' class='nav-link'>
                          <i class='nav-icon fa fa-circle'></i>
                          <p>Gestion de Grupos</p>
                        </a>
                      </li>
                      <li class='nav-item'>
                        <a href='index.php?action=alumnos' class='nav-link'>
                          <i class='nav-icon fa  fa-user'></i>
                          <p>Gestion de Alumnos</p>
                        </a>
                      </li>
                      <li class='nav-item'>
                        <a href='index.php?action=actividades' class='nav-link'>
                          <i class='nav-icon fa fa-smile-o'></i>
                          <p>Gestion de Actividades</p>
                        </a>
                      </li>

                      <li class='nav-item'>
                        <a href='index.php?action=unidades' class='nav-link'>
                          <i class='nav-icon fa fa-calendar-check-o'></i>
                          <p>Gestion de Unidades</p>
                        </a>
                      </li>
                      <li class='nav-item'>
                        <a href='index.php?action=usuarios' class='nav-link'>
                          <i class='nav-icon fa fa-users'></i>
                          <p>Gestion de Usuarios</p>
                        </a>
                      </li>
                      <li class='nav-item'>
                        <a href='index.php?action=reportes' class='nav-link'>
                          <i class='nav-icon fa fa-bar-chart'></i>
                          <p>Reportes de sesiones</p>
                        </a>
                      </li>
                      <li class='nav-item'>
                        <a href='' class='nav-link' onclick='confirmLogout();'>
                          <i class='nav-icon fa fa-sign-out'></i>
                          <p>Cerrar Sesión</p>
                        </a>
                      </li>
                    </ul>
                  </li>

              </nav>
              <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
          </aside>
            <!-- Content Wrapper. Contains page content -->
      <div class='content-wrapper'>
                ";
            
           
         	}else if($_SESSION['user_info']['tipo'] == "encargado"){ //usuario normal (no agrega o modifica tiendas)

         		echo "
			        <div class='info'>
			          <a href='' class='d-block'>"; $this->mostrarInicioController(); echo "<br><i class='nav-icon fa fa-wrench'></i> [ Encargado ]</a>
			        </div>
			      </div>

			      <!-- Sidebar Menu -->
			      <nav class='mt-2'>
			        <ul class='nav nav-pills nav-sidebar flex-column' data-widget='treeview' role='menu' data-accordion='false'>
			          <!-- Add icons to the links using the .nav-icon class
			               with font-awesome or any other icon font library -->
				";
            
                echo "
                      <li class='nav-item'>
                        <a href='index.php' class='nav-link'>
                          <i class='nav-icon fa fa-hourglass-end'></i>
                          <p>Sesion de CAI</p>
                        </a>
                      </li>
                      <li class='nav-item'>
                        <a href='index.php?action=reportes' class='nav-link'>
                          <i class='nav-icon fa fa-bar-chart'></i>
                          <p>Reportes de sesiones</p>
                        </a>
                      </li>
                      <li class='nav-item'>
                        <a href='' class='nav-link' onclick='confirmLogout();'>
                          <i class='nav-icon fa fa-sign-out'></i>
                          <p>Cerrar Sesión</p>
                        </a>
                      </li>
                    </ul>
                  </li>

              </nav>
              <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
          </aside>
            <!-- Content Wrapper. Contains page content -->
      <div class='content-wrapper'>
                ";

         	}else if($_SESSION['user_info']['tipo'] == "teacher"){
         		echo "
			        <div class='info'>
			          <a href='' class='d-block'>"; $this->mostrarInicioController(); echo "<br><i class='nav-icon fa fa-wrench'></i> [ Teacher ]</a>
			        </div>
			      </div>

			      <!-- Sidebar Menu -->
			      <nav class='mt-2'>
			        <ul class='nav nav-pills nav-sidebar flex-column' data-widget='treeview' role='menu' data-accordion='false'>
			          <!-- Add icons to the links using the .nav-icon class
			               with font-awesome or any other icon font library -->
				";
            
                echo "
                      <li class='nav-item'>
                        <a href='index.php?action=reportes' class='nav-link'>
                          <i class='nav-icon fa fa-bar-chart'></i>
                          <p>Reportes de sesiones</p>
                        </a>
                      </li>
                      <li class='nav-item'>
                        <a href='' class='nav-link' onclick='confirmLogout();'>
                          <i class='nav-icon fa fa-sign-out'></i>
                          <p>Cerrar Sesión</p>
                        </a>
                      </li>
                    </ul>
                  </li>

              </nav>
              <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
          </aside>
            <!-- Content Wrapper. Contains page content -->
      <div class='content-wrapper'>
                ";

         	}
         	echo "<div>";
      }
	}
  }
}

	//funcion que muestra las notificaciones de productos con stock <= 5
	public function showNotifications(){

		//peticion de productos con stock bajo (menor a 5)
		$numberOfNotifications = $this->setQueryControllerGetNumber("productos", "stock", "<=", 5);


			        $data = $this->setQueryControllerGetData("productos", "stock", "<=", 5); //obtener informacion de productos que cumplen con esa condicion

			        if(!empty($data)){
			        	echo '

			      	 <!-- Right navbar links -->
		    			<ul class="navbar-nav ml-auto">
					        <!-- Notifications Dropdown Menu -->
				      <li class="nav-item dropdown">
				        <a class="nav-link" data-toggle="dropdown" href="#">
				          <i class="fa fa-bell-o">--</i>
				          <span class="badge badge-danger navbar-badge">'.$numberOfNotifications.'</span>
				        </a>
				        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				          <span class="dropdown-item dropdown-header"> ('.$numberOfNotifications.') Productos con stock bajo</span>
				        ';
				        //por cada producto con stock bajo, imprimirlo en la tabla de notificaciones
			        	foreach ($data as $row => $item) {
						echo '
							<div class="dropdown-divider"></div>
			          <a href="index.php?action=movimiento_inventario" class="dropdown-item">
			            <i class="fa nav-icon fa fa-cube"></i> '.$item["nombre"].' | Stock: '.$item["stock"].'
			            <span class="float-right text-muted text-sm"></span>
			          </a>
						';
						}

			        }else{
			        	echo '

			      	 <!-- Right navbar links -->
		    			<ul class="navbar-nav ml-auto">
					        <!-- Notifications Dropdown Menu -->
				      <li class="nav-item dropdown">
				        <a class="nav-link" data-toggle="dropdown" href="#">
				          <i class="fa fa-bell-o"></i>
				        </a>
				        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				          <span class="dropdown-item dropdown-header">No tienes notificaciones</span>
				        ';

			        }


					echo '


			      </li>
			      </ul>';
	}

  	//funcion encargada de ingresar los valores del login e iniciar sesion
	public function ingresoUsuarioController(){
		if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['btn_add'])){

			$resultado = Crud::ingresoUsuarioModel($_POST['username'], $_POST['password']); //se ejecuta la funcion del modelo
			//se verifica que lo retornado por el modelo no este vacio
			if(!empty($resultado)){
					$_SESSION['login']=true; //iniciar la variable de sesion login
					$_SESSION['user_info']= $resultado; //guardar los datos del usuario en una sesion
					echo "<script>window.location='index.php?action=index'</script>";
			}else{
				//mostrar mensaje en caso de no existir el usuario
				echo "<script>swal('Usuario o contraseña incorrectos', 'No existe un usuario registrado con esas credenciales', 'error');</script>";
			}
		}
	}
	//funcion que imprime un mensaje en el inicio con el nombre del maestro tomado de la variable sesion
	public function mostrarInicioController(){
		if(isset($_SESSION['user_info'])){
			echo "<i class='nav-icon fa fa-user'></i> [ ".$_SESSION['user_info']['nombre']." ]";
		}
	}


  

	
	//funcion encargada de crear una tabla con los usuarios registrados en la base de datos
	public function getUsuariosController($idUser){ //parametro $idUser (el usuario actual)
		$informacion = Crud::vistaXTablaModel("usuarios");//ejecucion del metodo del modelo
		if(!empty($informacion)){
			//si el resultado no esta vacio, imprimir los datos de los usuarios
        foreach ($informacion as $row => $item) {
          if($item['id']!=$idUser){ //no mostrar el usuario actual
          echo "<tr>";
          echo "<td>".$item['codigo']."</td>";
          echo "<td>".$item['nombre']."</td>";
          echo "<td>".$item['apellidos']."</td>";
          echo "<td>".$item['email']."</td>";
          echo "<td>".strtoupper($item['tipo'])."</td>";
          echo "<td>"."<a class='btn btn-secondary fa fa-edit' href='index.php?action=editar_usuario&id=".$item['id']."'></a></td>";
             //mandar por propiedad onclick el id del elemento tag a para eleminarlo
				  echo "<td>"."<a class='btn btn-danger fa fa-trash' id='borrar_btn".$item["id"]."' onclick='b(".$item["id"].");' href='index.php?action=borrar&tipo=usuarios&id=".$item['id']."'></a></td>";  
           
            echo "</tr>";
          }
          
			}
      }
		
	}

	//funcion encargada de crear una tabla con los usuarios registrados en la base de datos
	public function getAlumnosController($idUser){ //parametro $idUser (el usuario actual)
		$informacion = Crud::vistaXTablaModel("alumnos");//ejecucion del metodo del modelo
		if(!empty($informacion)){
			//si el resultado no esta vacio, imprimir los datos de los usuarios
        foreach ($informacion as $row => $item) {
        	$grupo = Crud::getRegModel($item["id_grupo"],"grupos");
        	$carrera = Crud::getRegModel($item["id_carrera"],"carreras");
          	echo "<tr>";
          	echo "<td>".$item['matricula']."</td>";
          	echo "<td>".$item['nombre']."</td>";
          	echo "<td>".$item['apellidos']."</td>";
          	echo "<td>".$carrera['nombre']."</td>";
          	echo "<td>".$grupo['nombre']."</td>";
          	echo '<td><a href="'.$item["imagen"].'" id="ver_btn'.$item["id"].'" onclick="ver_imagen('.$item["id"].');">Ver</a></td>';
          	echo "<td>"."<a class='btn btn-secondary fa fa-edit' href='index.php?action=editar_alumno&id=".$item['id']."'></a></td>";
             //mandar por propiedad onclick el id del elemento tag a para eleminarlo
			echo "<td>"."<a class='btn btn-danger fa fa-trash' id='borrar_btn".$item["id"]."' onclick='b(".$item["id"].");' href='index.php?action=borrar&tipo=alumnos&id=".$item['id']."'></a></td>";  
           
            echo "</tr>";
          }
         
      }
		
	}

  public function getSesionesController(){
    $informacion = Crud::getSesionesControllerModel();//ejecucion del metodo del modelo
    if(!empty($informacion)){
      //si el resultado no esta vacio, imprimir los datos de los usuarios
        foreach ($informacion as $row => $item) {
            echo "<tr>";
              echo "<td>".$item['matricula']."</td>";
              echo "<td>".$item['nombre']."</td>";
              echo "<td>".$item['actividad']."</td>";
              echo "<td>".$item['hora']."</td>";
              echo '<td><a href="'.$item["imagen"].'" id="ver_btn'.$item["id_alumno"].'" onclick="ver_imagen('.$item["id_alumno"].');">Ver</a></td>';
              echo "<td><button type='button' id='borrar-".$item['id']."-".$item['matricula']."' class='btn btn-danger'><i class='fa fa-close'></i></button></td>";
              echo "<td><button type='button' id='asistencia-".$item['id']."-".$item['matricula']."' class='btn btn-warning'><i class='fa fa-close'></i></button></td>";
              //echo "<td><div class='checkbox'><label><input class='form_control' type='checkbox'></div></td>";
            echo "</tr>";
          }
         
      } 
  }


  public function getMatriculasSesionesController(){
    $informacion = Crud::getSesionesControllerModel();//ejecucion del metodo del modelo
    if(!empty($informacion)){
      //si el resultado no esta vacio, imprimir los datos de los usuarios
      for($i=0;$i<sizeof($informacion);$i++){
        if($i!=sizeof($informacion)-1)
          echo "'".$informacion[$i]['matricula']."',";
        else
          echo "'".$informacion[$i]['matricula']."'";
      }
       
   }
  }
  


	//funcion encargada de crear una tabla con los usuarios registrados en la base de datos
	public function getGruposController(){ //parametro $idUser (el usuario actual)
		$informacion = Crud::vistaXTablaModel("grupos");//ejecucion del metodo del modelo
		if(!empty($informacion)){
			//si el resultado no esta vacio, imprimir los datos de los usuarios
        foreach ($informacion as $row => $item) {
        	$encargado = Crud::getRegModel($item['id_maestro'], "usuarios");
          echo "<tr>";
          echo "<td>".$item['id']."</td>";
          echo "<td>".$item['nombre']."</td>";
          echo "<td>".$encargado['nombre']." " . $encargado["apellidos"]."</td>";
          echo "<td>"."<a class='btn btn-secondary fa fa-edit' href='index.php?action=editar_grupo&id=".$item['id']."'></a></td>";
             //mandar por propiedad onclick el id del elemento tag a para eleminarlo
				  echo "<td>"."<a class='btn btn-danger fa fa-trash' id='borrar_btn".$item["id"]."' onclick='b(".$item["id"].");' href='index.php?action=borrar&tipo=grupos&id=".$item['id']."'></a></td>";  
           
            echo "</tr>";
          

			}
      }
		
	}

  //funcion encargada de crear una tabla con las actividades registradas en la base de datos
  public function getActividadesController(){ //parametro $idUser (el usuario actual)
    $informacion = Crud::vistaXTablaModel("actividades");//ejecucion del metodo del modelo
    if(!empty($informacion)){
      //si el resultado no esta vacio, imprimir los datos de los usuarios
        foreach ($informacion as $row => $item) {
          echo "<tr>";
          echo "<td>".$item['id']."</td>";
          echo "<td>".$item['nombre']."</td>";
          echo "<td>"."<a class='btn btn-secondary fa fa-edit' href='index.php?action=editar_actividad&id=".$item['id']."'></a></td>";
             //mandar por propiedad onclick el id del elemento tag a para eleminarlo
          echo "<td>"."<a class='btn btn-danger fa fa-trash' id='borrar_btn".$item["id"]."' onclick='b(".$item["id"].");' href='index.php?action=borrar&tipo=actividades&id=".$item['id']."'></a></td>";  
           
            echo "</tr>";
          

      }
      }
    
  }

  //funcion encargada de crear una tabla con las actividades registradas en la base de datos
  public function getUnidadesController(){ //parametro $idUser (el usuario actual)
    $informacion = Crud::vistaXTablaModel("unidades");//ejecucion del metodo del modelo
    if(!empty($informacion)){
      //si el resultado no esta vacio, imprimir los datos de los usuarios
        foreach ($informacion as $row => $item) {
          echo "<tr>";
          echo "<td>".$item['id']."</td>";
          echo "<td>".$item['nombre']."</td>";
          echo "<td>".$item['fecha_inicio']."</td>";
          echo "<td>".$item['fecha_fin']."</td>";
          echo "<td>"."<a class='btn btn-secondary fa fa-edit' href='index.php?action=editar_unidad&id=".$item['id']."'></a></td>";
             //mandar por propiedad onclick el id del elemento tag a para eleminarlo
          echo "<td>"."<a class='btn btn-danger fa fa-trash' id='borrar_btn".$item["id"]."' onclick='b(".$item["id"].");' href='index.php?action=borrar&tipo=unidades&id=".$item['id']."'></a></td>";  
           
            echo "</tr>";
          

      }
      }
    
  }



	//funcion encargada de crear una tabla con las carreras registrados en la base de datos
	public function getCarrerasController(){ //parametro $idUser (el usuario actual)
		$informacion = Crud::vistaXTablaModel("carreras");//ejecucion del metodo del modelo
		if(!empty($informacion)){
			//si el resultado no esta vacio, imprimir los datos de los usuarios
        foreach ($informacion as $row => $item) {
          echo "<tr>";
          echo "<td>".$item['id']."</td>";
          echo "<td>".$item['nombre']."</td>";
          echo "<td>"."<a class='btn btn-secondary fa fa-edit' href='index.php?action=editar_carrera&id=".$item['id']."'></a></td>";
             //mandar por propiedad onclick el id del elemento tag a para eleminarlo
				  echo "<td>"."<a class='btn btn-danger fa fa-trash' id='borrar_btn".$item["id"]."' onclick='b(".$item["id"].");' href='index.php?action=borrar&tipo=carreras&id=".$item['id']."'></a></td>";  
           
            echo "</tr>";
          

			}
      }
		
	}


 
	//funcion que crea un select con los usuarios registradas dependiendo del tipo (maestro o encargado) y 
	//en caso de requerir un select con un valor al principio (al editar algo) se ingresa en $firstID
	public function getSelectForUsuarios($tipo, $firstID){
		$informacion = Crud::vistaXTablaModel("usuarios"); //se obtienen todos los usuarios de la bd mediante la conexion al modelo
		if(!empty($informacion)){
			if($firstID==""){
				foreach ($informacion as $row => $item) {
					if($item["tipo"]==$tipo){
						echo "<option value='".$item['id']."'>".$item['nombre']. " " .$item["apellidos"] ."</option>";
					}
				}
			}else{
				$reg = Crud::getRegModel($firstID, "usuarios");
				//se coloca primero la opcion del select del usuario
				echo "<option value='".$reg['id']."'>".$reg['nombre']." ".$reg["apellidos"]."</option>";
				foreach ($informacion as $row => $item) { //se imprimen los usuarios restantes
					if($item['id']!=$firstID && $item["tipo"]==$tipo)
						echo "<option value='".$item['id']."'>".$item['nombre']. " " .$item["apellidos"] ."</option>";
				}
			}
			
			
		}
	}

	

	//funcion que crea un select con los grupo registrados 
	//en caso de requerir un select con un valor al principio (al editar algo) se ingresa en $firstID
	public function getSelectForGrupos($firstID){
		$informacion = Crud::vistaXTablaModel("grupos"); //se obtienen todos los grupos de la bd mediante la conexion al modelo
		if(!empty($informacion)){
			if($firstID==""){
				foreach ($informacion as $row => $item) {
						echo "<option value='".$item['id']."'>".$item['nombre']."</option>";
				}
			}else{
				$reg = Crud::getRegModel($firstID, "grupos");
				//se coloca primero la opcion del select del grupo
				echo "<option value='".$reg['id']."'>".$reg['nombre']."</option>";
				foreach ($informacion as $row => $item) { //se imprimen los grupos restantes
					if($item['id']!=$firstID)
						echo "<option value='".$item['id']."'>".$item['nombre']."</option>";
				}
			}
			
			
		}
	}

	//funcion que crea un select con las carreras registrados 
	//en caso de requerir un select con un valor al principio (al editar algo) se ingresa en $firstID
	public function getSelectForCarreras($firstID){
		$informacion = Crud::vistaXTablaModel("carreras"); //se obtienen todos los grupos de la bd mediante la conexion al modelo
		if(!empty($informacion)){
			if($firstID==""){
				foreach ($informacion as $row => $item) {
						echo "<option value='".$item['id']."'>".$item['nombre']."</option>";
				}
			}else{
				$reg = Crud::getRegModel($firstID, "carreras");
				//se coloca primero la opcion del select del grupo
				echo "<option value='".$reg['id']."'>".$reg['nombre']."</option>";
				foreach ($informacion as $row => $item) { //se imprimen los grupos restantes
					if($item['id']!=$firstID)
						echo "<option value='".$item['id']."'>".$item['nombre']."</option>";
				}
			}
		}
	}

  //funcion retorna el id de la unidad actual
  public function getUnidadId(){
    $id_unidad = Crud::getUnidadIdModel(); //se obtienen todos los grupos de la bd mediante la conexion al modelo
    
    echo $id_unidad[0];
  }



	//funcion encargada de verificar si se presiono un boton de registro, de ser asi, se toman los datos de los controles y se ejecuta la funcion que registra en el modelo
	public function registroUsuarioController(){ //registro de usuario (maestro o encargado)
		if(isset($_POST['btn_agregar'])){//verificar clic en el boton
			//crear array con los datos a registrar tomados de los controles
			$data = array('codigo'=> $_POST['codigo'],
						'nombre'=> $_POST['nombre'],
						'apellidos'=> $_POST['apellidos'],
						'email'=> $_POST['email'],
						'password'=> $_POST['password'],
						'tipo'=> $_POST['tipo']
					);
			//peticion al modelo del reigstro del producto mandando como param la informacion de este
			$registro = Crud::registroUsuarioModel($data);
			if($registro == "success"){ //verificar la respuesta del modelo
        echo "<script>swal('Exito!','Usuario registrado!','success');
        window.location='index.php?action=usuarios';</script>";
			}else{
				echo "<script>swal('Error','El codigo ingresado ya fue usado!. Por favor, ingresa otro','error');</script>";
			}
		}
	}


  //funcion encargada de realizar el registro de una sesion de cai en lab ase de datos
  public function registroSesionCai($data_val){ //registro de sesion cai
    $data = $data_val;  //Valores mandados de la peticion POST
        
    //peticion al modelo del registro de sesion
    $registro = Crud::registroSesionCaiModel($data);
    echo $registro;
  }



	//funcion encargada de verificar si se presiono un boton de registro, de ser asi, se toman los datos de los controles y se ejecuta la funcion que registra en el modelo
	public function registroAlumnoController(){ //registroAlumno
		if(isset($_POST['btn_agregar'])){//verificar clic en el boton
			//para subir imagen de comprobante
			$target_dir = "model/uploads/"; //directorio donde se guardara
			//$realName = substr(basename($_FILES["fileToUpload"]["name"]), 0, strlen(basename($_FILES["fileToUpload"]["name"]))-4); //nombre del archivo
			$indOfp = -1;
			$rawName = basename($_FILES["fileToUpload"]["name"]);
			for($j = strlen($rawName)-1; $j > -1; $j--){
				if($rawName[$j] == "."){
					$indOfp = $j;
					break;
				}
			}
			$realName = substr(basename($_FILES["fileToUpload"]["name"]), 0, $indOfp); //
			
			$realExt = substr(basename($_FILES["fileToUpload"]["name"]), $indOfp, strlen(basename($_FILES["fileToUpload"]["name"]))); //extension
			//echo "<h1>".$realName . date("Y-m-d H:i:s")."</h1>";
			$target_file = $target_dir . md5($realName . date("Y-m-d H:i:s") . rand ( 0 , rand(1, 9999999) ) ) . $realExt; //directorio del archivo
			//echo "<h1>basename: " . basename($_FILES["fileToUpload"]["name"]) ."</h1>";
			
			//echo "<h1>basename: " .   "</h1>";
			$uploadOk = 1; //bandera para comprobar si no ocurrio un error
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); //obtener tipo de archivo
			// verificar si es una imagen el archivo
			$log = ""; //variable de log de erorres
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
			    $uploadOk = 1;
			} else {
			    $log.="El archivo no es una imagen. ";
			     $uploadOk = 0;
			  }
			// Check if file already exists
			if (file_exists($target_file)) {
			    $log.="El archivo ya existe en el directorio. ";
			    $uploadOk = 0;
			}
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 2000000) {
			    $log.="El archivo excede el tamaño minimo (1MB). ";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    $log.="Lo sentimos, solo los archivos con extension JPG, JPEG, PNG & GIF estan permitidos. ";
			    $uploadOk = 0;
			}
			// verificar si $uploadOk esta en 0 (ocurrio un error)
			if ($uploadOk == 0) {
			    echo "<script>swal('Error al subir la imagen',' ".$log."','error');</script>";
			// si todo esta bien,  intentar subir el archivo
			} else {
			    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			       //registrar el pago en laBD

					//crear array con los datos a registrar tomados de los controles
					$data = array('matricula'=> $_POST['matricula'],
								'nombre'=> $_POST['nombre'],
								'apellidos'=> $_POST['apellidos'],
								'carrera'=> $_POST['carrera'],
								'id_grupo'=> $_POST['id_grupo'],
								'imagen'=>$target_file
							);
					//peticion al modelo del reigstro del alumno mandando como param la informacion de este
					$registro = Crud::registroAlumnoModel($data);

					if($registro == "success"){ //verificar la respuesta del modelo
		        		echo "<script>swal('Exito!','Alumno registrado!','success');
		        		window.location='index.php?action=alumnos';</script>";
					}else{
						echo "<script>swal('Error','La matricula ingresada ya fue usada!. Por favor, ingresa otra.','error');</script>";
					}

			    } else {
			        echo "<script>swal('Error al subir la imagen',' ".$log."','error');</script>";
			    }
			}
		}
	}





	//funcion encargada de verificar si se presiono un boton de registro, de ser asi, se toman los datos de los controles y se ejecuta la funcion que registra en el modelo
	public function registroGrupoController(){ //registro de grupo
		if(isset($_POST['btn_agregar'])){//verificar clic en el boton
			//crear array con los datos a registrar tomados de los controles
			$data = array('nombre'=> $_POST['nombre'],
						'id_maestro'=> $_POST['id_maestro']
					);
			//peticion al modelo del reigstro del producto mandando como param la informacion de este
			$registro = Crud::registroGrupoModel($data);
			if($registro == "success"){ //verificar la respuesta del modelo
        echo "<script>swal('Exito!','Grupo registrado!','success');
        window.location='index.php?action=grupos';</script>";
			}else{
				echo "<script>swal('Error','Ocurrio un error al registrar el grupo','error');</script>";
			}
		}
	}

  //funcion encargada de verificar si se presiono un boton de registro, de ser asi, se toman los datos de los controles y se ejecuta la funcion que registra en el modelo
  public function registroActividadController(){ //registro de actividad
    if(isset($_POST['btn_agregar'])){//verificar clic en el boton
      //crear array con los datos a registrar tomados de los controles
      $data = array('nombre'=> $_POST['nombre']
          );
      //peticion al modelo del reigstro del producto mandando como param la informacion de este
      $registro = Crud::registroActividadModel($data);
      if($registro == "success"){ //verificar la respuesta del modelo
        echo "<script>swal('Exito!','Actividad registrada!','success');
        window.location='index.php?action=actividades';</script>";
      }else{
        echo "<script>swal('Error','Ocurrio un error al registrar la actividad','error');</script>";
      }
    }
  }



  //funcion encargada de verificar si se presiono un boton de registro, de ser asi, se toman los datos de los controles y se ejecuta la funcion que registra en el modelo
  public function registroUnidadController(){ //registro de unidad
    if(isset($_POST['btn_agregar'])){//verificar clic en el boton
      $fecha_inicio = date('Y-m-d', strtotime($_POST['fecha_inicio']));
      $fecha_fin = date('Y-m-d', strtotime($_POST['fecha_fin']));
      //crear array con los datos a registrar tomados de los controles
      $data = array('nombre'=> $_POST['nombre'],
        'fecha_inicio'=> $fecha_inicio,
        'fecha_fin'=> $fecha_fin
          );
      //peticion al modelo del reigstro del producto mandando como param la informacion de este
      $registro = Crud::registroUnidadModel($data);
      if($registro == "success"){ //verificar la respuesta del modelo
        echo "<script>swal('Exito!','Unidad registrada!','success');
        window.location='index.php?action=unidades';</script>";
      }else{
        echo "<script>swal('Error','Ocurrio un error al registrar la unidad','error');</script>";
      }
    }
  }

	//funcion encargada de verificar si se presiono un boton de registro, de ser asi, se toman los datos de los controles y se ejecuta la funcion que registra en el modelo
	public function registroCarreraController(){ //registro de carrera
		if(isset($_POST['btn_agregar'])){//verificar clic en el boton
			//crear array con los datos a registrar tomados de los controles
			$data = array('nombre'=> $_POST['nombre']
					);
			//peticion al modelo del reigstro del producto mandando como param la informacion de este
			$registro = Crud::registroCarreraModel($data);
			if($registro == "success"){ //verificar la respuesta del modelo
        echo "<script>swal('Exito!','Carrera registrada!','success');
        window.location='index.php?action=carreras';</script>";
			}else{
				echo "<script>swal('Error','Ocurrio un error al registrar la carrera','error');</script>";
			}
		}
	}



	//funcion encargada de, dado un id de una categoria, se obtienen los datos de la base de datos y se imprimen los controles con los datos en los valores para editarlos posteriormente
	public function getCategoriaController(){
		$id = (isset($_GET['id'])) ? $_GET['id'] : ""; //verificacion del id
		$peticion = Crud::getRegModel($id, 'categorias', $_SESSION['tienda']); //peticion al modelo del registro especificado por el id
		if(!empty($peticion)){
			echo "
				<div class='form-group'>
                    <p>
                    <label>Id</label>
                    <input type='text' class='form-control' name='id' value='".$peticion['id']."' placeholder='' required='' readonly='true'>
                  </p>
                  </div>
                  <div class='form-group'>
                    <p>
                    <label>Nombre</label>
                    <input type='text' class='form-control' name='nombre' value='".$peticion['nombre']."' placeholder='Ingresa el nombre de la categoria' required=''>
                  </p>
                  </div>
                  ";
		}
	}

	//funcion encargada de, dado un id de un usuario, se obtienen los datos de la base de datos y se imprimen los controles con los datos en los valores para editarlos posteriormente
	public function getUsuarioController(){
		$id = (isset($_GET['id'])) ? $_GET['id'] : ""; //verificacion del id
		$peticion = Crud::getRegModel($id, 'usuarios'); //peticion al modelo del registro especificado por el id
		if(!empty($peticion)){
			echo '
        <div class="form-group">
                    <p>
                    <label>Id</label>
                    <input type="text" class="form-control" name="id" value="'.$peticion["id"].'" readonly="true" required="">
                  </p>
                  </div>
				      <div class="form-group">
                    <p>
                    <label>Codigo del empleado</label>
                    <input type="text" id="codigo_empleado" class="form-control" name="codigo" value="'.$peticion["codigo"].'" required="">
                  </p>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <p>
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="'.$peticion["nombre"].'" placeholder="Ingresa el nombre" required="">
                        </p>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                      <p>
                      <label>Apellidos</label>
                      <input type="text" class="form-control" name="apellidos" value="'.$peticion["apellidos"].'" placeholder="Ingresa los apellidos" required="">
                      </p>
                      </div>
                  </div>

                </div>
                <div class="form-group">
                      <p>
                      <label>Email</label>
                      <input type="email" class="form-control" name="email" value="'.$peticion["email"].'" placeholder="Ingresa el email" required="">
                      </p>
                </div>
                <div class="form-group">
                      <p>
                      <label>Contraseña</label>
                      <input type="text" class="form-control" name="password" value="'.$peticion["password"].'" placeholder="Ingresa la contraseña" required="">
                      </p>
                </div>
                <div class="form-group">
                      <p>
                      <label>Tipo de usuario</label><br>
                      <select name="tipo" class="form-control">';
                      if($peticion["tipo"]=="teacher"){
                      	 echo '<option value="teacher">Teacher</option>
                      	 <option value="encargado">Encargado</option>';
                      }else{
                      	echo '<option value="encargado">Encargado</option>
                      	<option value="teacher">Teacher</option>
                      	 ';
                      }
                 echo ' 
                      </select>
                      </p>
                </div>';
        echo "
        <script>
          var code='".$peticion["codigo"]."';
          var flag=true;
          $('#codigo_empleado').keyup(function () {  
              if(code!=$('#codigo_empleado').val()){
                $.post('view/usuarios/editar_usuario.php',
                  {
                    codigo_a_verificar: $('#codigo_empleado').val(),
                  },
                  function(data,status){
                    console.log(data);
                    if(data==1){
                      $('#codigo_empleado').css('border-color','#ff0300');
                      flag=false;
                    }
                    else{
                      $('#codigo_empleado').css('border-color','#bab8b8');
                      flag=true;
                    }
                  });
              }
          });

          function wait(){
            if (!flag) {
              event.preventDefault();
              swal({
                      title: 'El codigo de empleado ya fue usado!',
                      text: 'Por favor ingresa un codigo diferente',
                      type: 'warning',
                      buttons: true,
                    });
                  }
            else
              c();
          }
        </script>";
     
		}else{
      		echo "<script>window.location='index.php?action=usuarios';</script>";

      	}
	}


	//funcion encargada de, dado un id de un alumno, se obtienen los datos de la base de datos y se imprimen los controles con los datos en los valores para editarlos posteriormente
	public function getAlumnoController(){
		$id = (isset($_GET['id'])) ? $_GET['id'] : ""; //verificacion del id
		$peticion = Crud::getRegModel($id, 'alumnos'); //peticion al modelo del registro especificado por el id
		if(!empty($peticion)){
			echo '
      <div class="form-group">
                    <p>
                    <label>Id</label>
                    <input type="text" class="form-control" name="id" value="'.$peticion["id"].'" required="" readonly="true">
                  </p>
                  </div>

        <div class="form-group">
                    <p>
                    <label>Matricula</label>
                    <input type="text" id="matricula" class="form-control" name="matricula" value="'.$peticion["matricula"].'" required="">
                  </p>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <p>
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="'.$peticion["nombre"].'" required="">
                        </p>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                      <p>
                      <label>Apellidos</label>
                      <input type="text" class="form-control" name="apellidos" value="'.$peticion["apellidos"].'" required="">
                      </p>
                      </div>
                  </div>
                </div>
                <div class="form-group">
                      <p>
                      <label>Carrera</label>
                      <select name="id_carrera" required="" class="select2 form-control">';
                      $this->getSelectForCarreras($peticion["id_carrera"]);
                        echo '
                      </select>
                      </p>
                </div>
                <div class="form-group">
                      <p>
                      <label>Grupo</label><br>
                      <select name="id_grupo" class="select2 form-control">';

                         $this->getSelectForGrupos($peticion["id_grupo"]);
                         echo '
                      </select>
                      </p>
                </div>';
          echo "
            <script>
              var code='".$peticion["matricula"]."';
              var flag=true;

              $('#matricula').keyup(function () {  
                  if(code!=$('#matricula').val()){
                    $.post('view/alumnos/editar_alumno.php',
                      {
                        matricula_a_verificar: $('#matricula').val(),
                      },
                      function(data,status){
                        console.log(data);
                        if(data==1){
                          $('#matricula').css('border-color','#ff0300');
                          flag=false;
                        }
                        else{
                          $('#matricula').css('border-color','#bab8b8');
                          flag=true;
                        }
                      });
                  }else{
                    $('#matricula').css('border-color','#bab8b8');
                    flag=true;
                  }
              });


              

              function wait(){
                if (!flag) {
                  event.preventDefault();
                  swal({
                          title: 'La matricula ya fue usada!',
                          text: 'Por favor ingrese una matricula diferente',
                          type: 'warning',
                          buttons: true,
                        });
              	}
            	else
                  c();
              }
            </script>";
		}else{
      		echo "<script>window.location='index.php?action=alumnos';</script>";
      	}
	}

	/*
	

	*/

	//funcion encargada de, dado un id de un grupo, se obtienen los datos de la base de datos y se imprimen los controles con los datos en los valores para editarlos posteriormente
	public function getGrupoController(){
		$id = (isset($_GET['id'])) ? $_GET['id'] : ""; //verificacion del id
		$peticion = Crud::getRegModel($id, 'grupos'); //peticion al modelo del registro especificado por el id
		if(!empty($peticion)){
			echo '
			<div class="form-group">
                    <p>
                    <label>Id</label>
                    <input type="text" class="form-control" name="id" value="'.$peticion["id"].'" readonly="true" required="">
                  </p>
                  </div>
				<div class="form-group">
                    <p>
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="'.$peticion["nombre"].'" placeholder="Ingresa el nombre del grupo" required="">
                  </p>
                  </div>
                <div class="form-group">
                    <label>Maestro a cargo</label>
                      <select name="id_maestro" required="" class="select2 form-control">';
                      $this->getSelectForUsuarios("teacher", $peticion["id_maestro"]);
                      echo '
                      </select>
                </div>

			';
		}else{
      		echo "<script>window.location='index.php?action=grupos';</script>";
      	}
	}

  //funcion encargada de, dado un id de una actividad, se obtienen los datos de la base de datos y se imprimen los controles con los datos en los valores para editarlos posteriormente
  public function getActividadController(){
    $id = (isset($_GET['id'])) ? $_GET['id'] : ""; //verificacion del id
    $peticion = Crud::getRegModel($id, 'actividades'); //peticion al modelo del registro especificado por el id
    if(!empty($peticion)){
      echo '
      <div class="form-group">
                    <p>
                    <label>Id</label>
                    <input type="text" class="form-control" name="id" value="'.$peticion["id"].'" readonly="true" required="">
                  </p>
                  </div>
        <div class="form-group">
                    <p>
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="'.$peticion["nombre"].'" placeholder="Ingresa el nombre del grupo" required="">
                  </p>
                  </div>
      ';
    }else{
          echo "<script>window.location='index.php?action=actividades';</script>";
        }
  }

   //funcion encargada de, dado un id de una unidad, se obtienen los datos de la base de datos y se imprimen los controles con los datos en los valores para editarlos posteriormente
  public function getUnidadController(){
    $id = (isset($_GET['id'])) ? $_GET['id'] : ""; //verificacion del id
    $peticion = Crud::getRegModel($id, 'unidades'); //peticion al modelo del registro especificado por el id
    if(!empty($peticion)){
      echo '
      <div class="form-group">
                    <p>
                    <label>Id</label>
                    <input type="text" class="form-control" name="id" value="'.$peticion["id"].'" readonly="true" required="">
                  </p>
                  </div>
              <div class="form-group">
                    <p>
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="'.$peticion["nombre"].'" placeholder="Ingresa el nombre del grupo" required="">
                  </p>
                  </div>

                  <div class="form-group">
                    <p>
                    <label>Fecha inicio</label>
                    <input id="fecha_inicio" type="date" class="form-control" name="fecha_inicio" value="'.$peticion["fecha_inicio"].'" required="">
                  </p>
                  </div>
                  <div class="form-group">
                    <p>
                    <label>Fecha fin</label>
                    <input id="fecha_fin" type="date" class="form-control" name="fecha_fin" value="'.$peticion["fecha_fin"].'" required="">
                  </p>
                  </div>
      ';
    }else{
          echo "<script>window.location='index.php?action=unidades';</script>";
        }
  }




	//funcion encargada de, dado un id de una carrera, se obtienen los datos de la base de datos y se imprimen los controles con los datos en los valores para editarlos posteriormente
	public function getCarreraController(){
		$id = (isset($_GET['id'])) ? $_GET['id'] : ""; //verificacion del id
		$peticion = Crud::getRegModel($id, 'carreras'); //peticion al modelo del registro especificado por el id
		if(!empty($peticion)){
			echo '
			<div class="form-group">
                    <p>
                    <label>Id</label>
                    <input type="text" class="form-control" name="id" value="'.$peticion["id"].'" readonly="true" required="">
                  </p>
                  </div>
			<div class="form-group">
                    <p>
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="'.$peticion["nombre"].'" required="">
                  </p>
                  </div>

			';
		}
	}


	//funcion que verifica si se dio clic en el boton de actualizacion y realiza la actualizacon mediante la ejecucion del metodo del modelo
	public function actualizarUsuarioController(){ //actualizacion de usuario
		if(isset($_POST['btn_actualizar'])){ //verificacion de clic en el boton
			//se toman los valores de los controles y se guardan en un array
			$data = array(
				"codigo"=>$_POST['codigo'],
				"nombre"=>$_POST['nombre'],
				"apellidos"=>$_POST['apellidos'],
				"email"=>$_POST['email'],
				"password"=>$_POST['password'],
				"tipo"=>$_POST['tipo'],
        "id"=>$_POST['id']
			);

			//se realiza la ejecucion del metodo que actualiza un alumno en el modelo, mandando los parametros correspondientes, datos y matricula
			$peticion = Crud::actualizarUsuarioModel($data);
			if($peticion == "success"){ //verificacion de la respuesta por el modelo
       			echo "<script>
       			swal('Exito!','Usuario actualizado!','success');
       			window.location='index.php?action=usuarios';</script>";
			}else{
				echo "<script>swal('Error', 'Ocurrio un error al guardar los cambios', 'error');</script>";
			}
		}
	}

	//funcion que verifica si se dio clic en el boton de actualizacion y realiza la actualizacon mediante la ejecucion del metodo del modelo
	public function actualizarAlumnoController(){ //actualizar alumno 
		if(isset($_POST['btn_actualizar'])){ //verificacion de clic en el boton
			//se toman los valores de los controles y se guardan en un array
			$data = array(
				"matricula"=>$_POST['matricula'],
				"nombre"=>$_POST['nombre'],
				"apellidos"=>$_POST['apellidos'],
				"id_carrera"=>$_POST['id_carrera'],
				"id_grupo"=>$_POST['id_grupo'],
        "id"=>$_POST['id']

			);

			//se realiza la ejecucion del metodo que actualiza un alumno en el modelo, mandando los parametros correspondientes, datos y matricula
			$peticion = Crud::actualizarAlumnoModel($data);
			if($peticion == "success"){ //verificacion de la respuesta por el modelo
       			echo "<script>
       			swal('Exito!','Alumno actualizado!','success');
       			window.location='index.php?action=alumnos';</script>";
			}else{
				echo "<script>swal('Error', 'Ocurrio un error al guardar los cambios', 'error');</script>";
			}
		}
	}


	//funcion que verifica si se dio clic en el boton de actualizacion y realiza la actualizacon mediante la ejecucion del metodo del modelo
	public function actualizarGrupoController(){ //se actualiza un grupo
		if(isset($_POST['btn_actualizar'])){ //verificacion de clic en el boton
			//se toman los valores de los controles y se guardan en un array
			$data = array(
				"nombre"=>$_POST['nombre'],
				"id_maestro"=>$_POST['id_maestro'],
				"id"=>$_POST['id']
			);

			//se realiza la ejecucion del metodo que actualiza un alumno en el modelo, mandando los parametros correspondientes, datos y matricula
			$peticion = Crud::actualizarGrupoModel($data);
			if($peticion == "success"){ //verificacion de la respuesta por el modelo
       			echo "<script>
       			swal('Exito!','Grupo actualizado!','success');
       			window.location='index.php?action=grupos';</script>";
			}else{
				echo "<script>swal('Error', 'Ocurrio un error al guardar los cambios', 'error');</script>";
			}
		}
	}

  //funcion que verifica si se dio clic en el boton de actualizacion y realiza la actualizacon mediante la ejecucion del metodo del modelo
  public function actualizarActividadController(){ //se actualiza una actividad
    if(isset($_POST['btn_actualizar'])){ //verificacion de clic en el boton
      //se toman los valores de los controles y se guardan en un array
      $data = array(
        "nombre"=>$_POST['nombre'],
        "id"=>$_POST['id']
      );

      //se realiza la ejecucion del metodo que actualiza un alumno en el modelo, mandando los parametros correspondientes, datos y matricula
      $peticion = Crud::actualizarActividadModel($data);
      if($peticion == "success"){ //verificacion de la respuesta por el modelo
            echo "<script>
            swal('Exito!','Actividad actualizada!','success');
            window.location='index.php?action=actividades';</script>";
      }else{
        echo "<script>swal('Error', 'Ocurrio un error al guardar los cambios', 'error');</script>";
      }
    }
  }


  //funcion que verifica si se dio clic en el boton de actualizacion y realiza la actualizacon mediante la ejecucion del metodo del modelo
  public function actualizarUnidadController(){ //se actualiza una unidad
    if(isset($_POST['btn_actualizar'])){ //verificacion de clic en el boton
      //se toman los valores de los controles y se guardan en un array
      $fecha_inicio = date('Y-m-d', strtotime($_POST['fecha_inicio']));
      $fecha_fin = date('Y-m-d', strtotime($_POST['fecha_fin']));
      //crear array con los datos a registrar tomados de los controles
      $data = array('nombre'=> $_POST['nombre'],
        'fecha_inicio'=> $fecha_inicio,
        'fecha_fin'=> $fecha_fin,
        "id" => $_POST["id"]
          );
      //se realiza la ejecucion del metodo que actualiza un alumno en el modelo, mandando los parametros correspondientes, datos y matricula
      $peticion = Crud::actualizarUnidadModel($data);
      if($peticion == "success"){ //verificacion de la respuesta por el modelo
            echo "<script>
            swal('Exito!','Unidad actualizada!','success');
            window.location='index.php?action=unidades';</script>";
      }else{
        echo "<script>swal('Error', 'Ocurrio un error al guardar los cambios', 'error');</script>";
      }
    }
  }


	//funcion que verifica si se dio clic en el boton de actualizacion y realiza la actualizacon mediante la ejecucion del metodo del modelo
	public function actualizarCarreraController(){ //se actualiza la carrera
		if(isset($_POST['btn_actualizar'])){ //verificacion de clic en el boton
			//se toman los valores de los controles y se guardan en un array
			$data = array(
				"nombre"=>$_POST['nombre'],
				"id"=>$_POST['id']
			);

			//se realiza la ejecucion del metodo que actualiza un alumno en el modelo, mandando los parametros correspondiente
			$peticion = Crud::actualizarCarreraModel($data);
			if($peticion == "success"){ //verificacion de la respuesta por el modelo
       			echo "<script>
       			swal('Exito!','Carrera actualizada!','success');
       			window.location='index.php?action=carreras';</script>";
			}else{
				echo "<script>swal('Error', 'Ocurrio un error al guardar los cambios', 'error');</script>";
			}
		}
	}

	/*
	//funcion que muestra el dashboard del sistema
	function showDashboard(){
		//mostrar productos sin stock
		$this->setQueryController("productos","Productos sin stock", "stock", "=",0, $_SESSION['tienda']);

		$this->setQueryController("transaccion","Transacciones realizadas hoy", "fecha", "=", date('Y-m-d'), $_SESSION['tienda']);
		
	}*/


	//Funcion que dado un id y nombre de tabla, ejecuta el metodo del modelo y borra el registro especificado en base a la tabla
	public function borrarController($id, $tabla){
		//se ejecuta el metodo borrar del modelo mandando como paremtros los explicados anteriormente
		//echo $id."<br>".$tabla;
		$peticion = Crud::borrarXModel($id, $tabla);
		if($peticion == "success"){ //verificar respuesta
			echo "<script>swal('Exito', 'Se realizo la operacion con exito!', 'success');
      		window.location='index.php?action=".$tabla."';
      		</script>";
		}else{
			echo "<script>swal('Error', 'Ocurrio un error al dar de baja el registro . ".$id." ".$tabla."', 'error');</script>";
		}
	}

  //Funcion que dado un id y nombre de tabla, ejecuta el metodo del modelo y borra el registro especificado en base a la tabla
  public function borrarSesionController($id){
    //se ejecuta el metodo borrar del modelo mandando como paremtros los explicados anteriormente
    //echo $id."<br>".$tabla;
    $peticion = Crud::borrarXModel($id,"sesion_cai");
    return $peticion;
  }


  #REVISAR DISPONIBILIDAD DE DETERMINAOD CODIGO DE PRODUCTOS
  public function checkAvailabilityOfUserCodeController($code, $table, $nid){

    $respuesta = Crud::checkAvailabilityOfUserCodeModel($code, $table, $nid);
    
    
    echo($respuesta['a']);
    
  }

  #Obtener detalles de un alumno
  public function getDetailsFromAlumno($code, $table){

    $respuesta = Crud::getDetailsFromAlumnoModel($code, $table);
    
    
    echo(json_encode($respuesta));
    
  }

  public function sesion_caiHeaderAlumnosController(){
    $total = Crud::contarAlumnosController();
    echo'
      <div style="" class="info-box bg-warning">
        <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Alumnos en Aula</span>
          <span id="alumnos_dentro" class="info-box-number">'.$total.'/30</span>

          <div class="progress">
            <div id="porcentage_dentro" class="progress-bar" style="width: '.($total*100/30).'%"></div>
          </div>
        </div>
        <!-- /.info-box-content -->
      </div>';
  }

  public function sesion_caiHeaderController(){

    echo '
          <div class="info-box mb-3 bg-success">
              <span class="info-box-icon"><i class="fa fa-heart-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Ingreso de Alumnos</span>
                <div class="row">
                  <div class="col-4">
                  <input type="text" class="form-control" placeholder="Matricula" id="matricula" name="matricula" required="">
                  </div>
                  <div class="col-4">
                  <select name="" id="actividad_sel" class="form-control select2">';
                  $this->getSelectForActividades();
    echo  '
                  </select>
                  </div>
                  <div class="col-3">
                  <button type="button" onClick="insertRow();" class="btn btn-block btn-primary">Ingresar</button>
                  </div>
                </div>
              </div>
          </div>
    ';
    echo "
            <script>
              
            </script>";
  }

    //funcion que crea un select con las carreras registrados 
  //en caso de requerir un select con un valor al principio (al editar algo) se ingresa en $firstID
  public function getSelectForActividades(){
    $informacion = Crud::vistaXTablaModel("actividades"); //se obtienen todos los grupos de la bd mediante la conexion al modelo
    if(!empty($informacion)){
      foreach ($informacion as $row => $item) {
          echo "<option value='".$item['id']."'>".$item['nombre']."</option>";
      }
    }
  }


}





?>
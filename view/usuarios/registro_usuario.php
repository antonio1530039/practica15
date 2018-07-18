<?php

  //instancia de la clase controlador
  $controller_usuarios = new MVC();
  //verificar si el usuario inicio sesion antes
  $controller_usuarios->verificarLoginController();
  //registro de usuario al presionar el boton de registrar
  $controller_usuarios->registroUsuarioController();

?>

  <head>
    <title>Registro de usuario</title>
  </head>
  <body class="hold-transition login-page">
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Registro de usuario</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item active"><a href="index.php?action=usuarios"> Gestión de Usuarios</a></li>
              <li class="breadcrumb-item active">Registro de usuario</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <form role="form" method="post">
        <div class="row">
          <div class="col-3"></div>
          <div class="col-6">

          <!-- left column -->
            <!-- general form elements -->
            <div class="card card-primary">
               <div class="card-header">
                        <h3 class="card-title">Por favor, Ingresa la información del usuario</h3>
                </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body login-card-body">
                  <div class="form-group">
                    <p>
                    <label>Codigo del empleado</label>
                    <input type="text" class="form-control" id="codigo_empleado" name="codigo" placeholder="Ingresa el codigo de empleado del usuario" required="">
                  </p>
                  </div>
                  <div class="row">

                    <div class="col-6">
                      <div class="form-group">
                        <p>
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Ingresa el nombre" required="">
                        </p>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                      <p>
                      <label>Apellidos</label>
                      <input type="text" class="form-control" name="apellidos" placeholder="Ingresa los apellidos" required="">
                      </p>
                      </div>
                  </div>

                </div>
                <div class="form-group">
                      <p>
                      <label>Email</label>
                      <input type="email" class="form-control" name="email" placeholder="Ingresa el email" required="">
                      </p>
                </div>
                <div class="form-group">
                      <p>
                      <label>Contraseña</label>
                      <input type="text" class="form-control" name="password" placeholder="Ingresa la contraseña" required="">
                      </p>
                </div>
                <div class="form-group">
                      <p>
                      <label>Tipo de usuario</label><br>
                      <select name="tipo" class="form-control">
                        <option value="teacher">Teacher</option>
                        <option value="encargado">Encargado</option>
                      </select>
                      </p>
                </div>

                   <input type="submit" onclick="wait();" name="btn_agregar" value="Registrar" onclick="wait();" class="btn btn-success" style="float: right;">
            
            </div>   
            </div>
            <!-- -->
          </div>
              </div>
       </div>
</div>
  </form>
</div>
</section>
 <script>
    var flag=true;
    console.log("xd");
    $('#codigo_empleado').keyup(function () {
        console.log("xd");
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
      }
</script>";
  </body>


  </html>



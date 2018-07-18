<?php

  //instancia de la clase controlador
  $controller_alumnos = new MVC();
  //verificar si el usuario inicio sesion antes
  $controller_alumnos->verificarLoginController();
  //registro de alumno al presionar el boton de registrar
  $controller_alumnos->registroAlumnoController();

?>

  <head>
    <title>Registro de alumno</title>
  </head>
  <body class="hold-transition login-page">
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Registro de alumno</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item active"><a href="index.php?action=alumnos"> Gestión de Alumnos</a></li>
              <li class="breadcrumb-item active">Registro de alumno</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <form role="form" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-3"></div>
          <div class="col-6">

          <!-- left column -->
            <!-- general form elements -->
            <div class="card card-primary">
               <div class="card-header">
                        <h3 class="card-title">Por favor, Ingresa la información del alumno</h3>
                </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body login-card-body">
                  <div class="form-group">
                    <p>
                    <label>Matricula</label>
                    <input type="text" id="matricula" class="form-control" name="matricula" placeholder="Ingresa la matricula" required="">
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
                      <label>Carrera</label>
                      <select name="carrera" required="" class="select2 form-control">
                        <?php $controller_alumnos->getSelectForCarreras("");  ?>
                      </select>
                      </p>
                </div>
                <div class="form-group">
                      <p>
                      <label>Grupo</label><br>
                      <select name="id_grupo" class="select2 form-control">
                        <?php $controller_alumnos->getSelectForGrupos(""); ?>
                      </select>
                      </p>
                </div>
                <div class="form-group">
                    <p>
                    <label>Foto</label><br>
                      <input type="file" name="fileToUpload" id="fileToUpload" class="form-control btn btn-info" required="">
                  </p>
                  </div>
                   <input type="submit" onclick="wait();" name="btn_agregar" value="Registrar" class="btn btn-success" style="float: right;">
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
    $('#matricula').keyup(function () {
        console.log("xd");
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
    });

    function wait(){
         
    if (!flag) {
      event.preventDefault();
    swal({
            title: 'La matrícula ya fue usada!',
            text: 'Por favor ingresa una matricula diferente',
            type: 'warning',
            buttons: true,
          });
        }
      }
</script>
  </body>

  </html>

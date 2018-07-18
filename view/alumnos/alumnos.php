<?php
  //instancia de la clase controlador
  $controller_alumnos = new MVC();
  //se verifica que se haya iniciado sesion
  $controller_alumnos->verificarLoginController();

?>
  <head>
    <title>Gestion de Alumnos</title>
  </head>
  <body>
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Gestión de Alumnos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item active">Gestión de Alumnos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <div class="form-group">
                    <input type="button" class="btn btn-primary" name="btn_back" value="Registrar alumno" onclick="window.location = 'index.php?action=registro_alumno'" style="float: right;">
                    <br><br>
                  </div>
                  <div class="form-group">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Listado de alumnos</h3>
                      </div>
                    <div class="card-body p-0">
                      <br>
                    <div class="table-responsive">
                    <table width="100%" id="example1" class="table table-bordered table-striped">
                      <thead>
                        <th>Matricula</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Carrera</th>
                        <th>Grupo</th>
                        <th>Imagen</th>
                        <th></th>
                        <th></th>
                      </thead>
                      <tbody>
                        <?php 
                        //listado de usuarios
                        $controller_alumnos->getAlumnosController($_SESSION['user_info']['id']); 
                         ?>
                      </tbody>
                    </table>
                    </div>
                  </div>
                  </div>
                </div>
              </form>
            </div>    
      <script>
      	

      </script>
    </div>
  </body>


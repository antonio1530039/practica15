<?php
  //instancia de la clase controlador
  $controller_unidades = new MVC();
  //se verifica que se haya iniciado sesion
  $controller_unidades->verificarLoginController();

?>
  <head>
    <title>Gestion de Unidades</title>
  </head>
  <body>
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Gestión de Unidades</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item active">Gestión de Unidades</li>
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
                    <input type="button" class="btn btn-primary" name="btn_back" value="Registrar unidad" onclick="window.location = 'index.php?action=registro_unidad'" style="float: right;">
                    <br><br>
                  </div>
                  <div class="form-group">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Listado de unidades</h3>
                      </div>
                    <div class="card-body p-0">
                      <br>
                    <div class="table-responsive">
                    <table width="100%" id="reporteTable" class="table table-bordered table-striped">
                      <thead>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Fecha inicio</th>
                        <th>Fecha fin</th>
                        <th></th>
                        <th></th>
                      </thead>
                      <tbody>
                        <?php 
                        //mostrar listado de unidades
                        $controller_unidades->getUnidadesController(); 
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


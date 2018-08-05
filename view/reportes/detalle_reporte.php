<?php
  //instancia de la clase controlador
  $controller_reportes = new MVC();
  //se verifica que se haya iniciado sesion
  $controller_reportes->verificarLoginController();

?>
  <head>
    <title>Detalle de reportes</title>
  </head>
  <body>
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Actividades realizadas por el alumno</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item"><a href="index.php?action=reportes">Reportes</a></li>
              <li class="breadcrumb-item active">Detalle de reporte</li>
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
              <form role="form" method="POST">
                <div class="card-body">
                
                  <div class="form-group">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Detalle de horas realizadas</h3>
                      </div>
                    <div class="card-body p-0">


                      
                      <div class="table-responsive">
                      <table width="100%" class="table table-bordered table-striped">
                      <thead>
                        <th>Alumno</th>
                        <th>Grupo</th>
                        <th>Teacher</th>
                        <th>Unidad</th>
                      </thead>
                      <tbody>
                        <td><label class="" id="info_alumno"></label></td>

                        <td><label class="" id="info_grupo"></label></td>

                        <td><label class="" id="info_teacher"></label></td>
                       
                        <td><label class="" id="info_unidad"></label></td>
                      </tbody>
                    </table>
                  </div>



                    <div class="table-responsive">
                    <table width="100%" id="reporteTable" class="table table-bordered table-striped">
                      <thead>
                        <th>Actividad realizada</th>
                        <th>Fecha</th>
                        <th>Hora de ingreso</th>
                      </thead>
                      <tbody>
                        <?php
                          //se muestra la tabla del detalle del reporte
                          $controller_reportes->getDetalleDeReporteController();
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


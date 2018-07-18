<?php
  //instancia de la clase controlador
  $controller_carreras = new MVC();

  //se verifica que se haya iniciado sesion
  
  $controller_carreras->verificarLoginController();
  //se ejecuta el metodo actualizarCarreraController para actualizar la carrera seleccionada

  $controller_carreras->actualizarCarreraController();

?>


<head>
    <title>Modificación de carrera</title>
  </head>
  <body class="hold-transition login-page">
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Modificación de carrera</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item active"><a href="index.php?action=carreras"> Gestión de Carreras</a></li>
              <li class="breadcrumb-item active">Modificación de Carreras</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="container-fluid">
        <form role="form" method="post" id="formulario">
        <div class="row">
          <!-- left column -->
          <div class="col-3"></div>
          <div class="col-6">
            <!-- general form elements -->
            <div class="card card-primary">
               <div class="card-header">
                        <h3 class="card-title">Realice los cambios correspondientes y de clic en guardar</h3>
                </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body login-card-body">
                    <?php $controller_carreras->getCarreraController(); ?>
                  <button type="submit" name="btn_actualizar" id="targ"  class="btn btn-success" onclick="c();" style="float:right;">Guardar cambios</button>
              </div>   
            </div>
            </div> 
                </div>
        </form>
              </div>
</div>
</section>
  </body>
  <script>
      </script>
  
  </html>

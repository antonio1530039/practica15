<?php

  //instancia de la clase controlador
  $controller_unidades = new MVC();
  //verificar si el usuario inicio sesion antes
  $controller_unidades->verificarLoginController();
  //registro de unidad al presionar el boton de registrar
  $controller_unidades->registroUnidadController();

?>

  <head>
    <title>Registro de unidad</title>
  </head>
  <body class="hold-transition login-page">
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Registro de unidad</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item active"><a href="index.php?action=unidades"> Gestión de Unidades</a></li>
              <li class="breadcrumb-item active">Registro de unidad</li>
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
                        <h3 class="card-title">Por favor, Ingresa la información de la unidad</h3>
                </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body login-card-body">
                  <div class="form-group">
                    <p>
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Ingresa el nombre de la actividad" required="">
                  </p>
                  </div>
                   <div class="form-group">
                    <p>
                    <label>Fecha inicio</label>
                    <input id="fecha_inicio" type="date" class="form-control" name="fecha_inicio" required="">
                  </p>
                  </div>
                   <div class="form-group">
                    <p>
                    <label>Fecha fin</label>
                    <input id="fecha_fin" type="date" class="form-control" name="fecha_fin" required="">
                  </p>
                  </div>
                   <input type="submit" name="btn_agregar" onClick="wait();" value="Registrar" class="btn btn-success" style="float: right;">
            
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
  </body>
<script>
  //Al momento de detectar un cambio en el valor de los elementos se revisa la validez de las fechas
  $("#fecha_inicio").change(function () {
    cambiarColores();
  });

  $("#fecha_fin").change(function () {
     cambiarColores();   
  });

  //Funcion que retornara verdadero en caso de que las fechas ingresadas sean validas, dicho esto
  //que la fecha de inicio sea menor que la de finalizacion
  function fechaValida(){
    if(Date.parse($("#fecha_inicio").val()) < Date.parse($("#fecha_fin").val()))
      return true;
    else
      return false;
  }

  //Se cambian los colores de los elementos para demostrar que existe un error
  function cambiarColores(){
    if(fechaValida()){
      $('#fecha_fin').css('border-color','#bab8b8');
      console.log("1");
    }else{
      $('#fecha_fin').css('border-color','#ff0300');
      console.log("2");
    }
  }

  //Se maneja el evento para que no se continue en caso de que exista un error con las fechas
  function wait(){
    if(!fechaValida()){
      event.preventDefault();
      swal({
            title: 'Las fechas ingesadas son incorrectas',
            text: 'Por favor ingrese un rango de fechas adecuado',
            type: 'warning',
            buttons: true,
          });
    }
  }

</script>
</html>

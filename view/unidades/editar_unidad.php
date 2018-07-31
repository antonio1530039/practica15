<?php
  //instancia de la clase controlador
  $controller_unidades = new MVC();
  //se verifica que se haya iniciado sesion
  $controller_unidades->verificarLoginController();
  //se ejecuta el metodo  para actualizar la unidad seleccionada
  $controller_unidades->actualizarUnidadController();

?>


<head>
    <title>Modificación de unidad</title>
  </head>
  <body class="hold-transition login-page">
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Modificación de unidad</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item active"><a href="index.php?action=unidades"> Gestión de Unidades</a></li>
              <li class="breadcrumb-item active">Modificación de unidad</li>
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
                    <?php $controller_unidades->getUnidadController(); ?>
                  <button type="submit" name="btn_actualizar" id="targ"  class="btn btn-success" onclick="wait();" style="float:right;">Guardar cambios</button>
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
  function wait(){
    if(!fechaValida()){
        event.preventDefault();
        swal({
              title: 'Las fechas ingesadas son incorrectas',
              text: 'Por favor ingrese un rango de fechas adecuado',
              type: 'warning',
              buttons: true,
            });
    }else{
      c();
    }
  }

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


</script>
  
  </html>

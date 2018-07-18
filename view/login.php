<?php

  //instancia de la clase controlador
  $ingresarUsuario = new MVC();
  //ejecucion del metodo ingresoUsuarioController para intentar iniciar sesion
  $ingresarUsuario->ingresoUsuarioController();
?>
<head>
  <title>Login</title>
</head>
<body style="background-color:orange">
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
<div class="login-box">

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <div class="login-logo">
    <b>Sistema de Control de CAI</b>
  </div>
      <p class="login-box-msg">Identificate para iniciar sesion</p>
      <form action="" method="post">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Codigo de empleado" name="username" required="">
          <span class="fa fa-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Contraseña" name="password" required="">
          <span class="fa fa-lock form-control-feedback"></span>
        </div>
          <div>
            <button type="submit" name="btn_add" class="btn btn-primary btn-block btn-flat" style="float:right">Iniciar Sesion</button>
          </div>
          <!-- /.col -->
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
</div>
</div>
</div>

</body>
<!-- /.login-box -->






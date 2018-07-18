<?php

  //Condicional para obtener detalles del alumno que se esta ingresando en relacion con su matricula
  if(isset($_POST['matricula_alumno'])){
    require_once "../../model/enlaces.php";
    require_once "../../model/crud.php";
    require_once "../../controller/controller.php";
    $verificar = new MVC();
    echo $verificar -> getDetailsFromAlumno( $_POST['matricula_alumno'] ,"alumnos");
  }else if(isset($_POST['asistencia'])){
    require_once "../../model/enlaces.php";
    require_once "../../model/crud.php";
    require_once "../../controller/controller.php";
    $verificar = new MVC();

    $data = array(
                  'id_unidad'=> $_POST['id_unidad'],
                  'id_encargado'=> $_POST['id_encargado'],
                  'id_alumno'=> $_POST['id_alumno'],
                  'id_actividad'=> $_POST['id_actividad'],
                  'asistencia'=> $_POST['asistencia']
                );

    echo $verificar -> registroSesionCai( $data);
  }else if(isset($_POST['id_unidad'])){
    require_once "../../model/enlaces.php";
    require_once "../../model/crud.php";
    require_once "../../controller/controller.php";
    $verificar = new MVC();
    echo $verificar -> getUnidadId();
  }else{
    //instancia de la clase controlador
    $controller_sesiones = new MVC();
    //se verifica que se haya iniciado sesion
    $controller_sesiones->verificarLoginController();
?>


  <head>
    <title>Sesion Cai</title>
  </head>
  <body>
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Sesion CAI</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item active">Sesiones</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div style="height:112px;" class="info-box col-sm-12">
      <div class="info-box-content">
          <?php
            $controller_sesiones->sesion_caiHeaderAlumnosController(); 
          ?>
      </div>
      <div class="col-sm-9 ">
          <?php
            $controller_sesiones->sesion_caiHeaderController(); 
          ?>
      </div>
      <!-- /.info-box-content -->
    </div>

    <div id="error_div" class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-ban"></i> Alerta</h4>
      El usuario que esta intentando agregar no existe.
    </div>
  
    
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
                <div class="form-group">
                    <div class="card">
                      <div class="card-header info-box mb-3 bg-success">
                        <h3 class="card-title ">Alumnos en sesion</h3>
                      </div>
                    <div class="card-body p-0">


                      <br>
                    <div class="table-responsive">
                    <table width="100%" id="examplex" class="table table-bordered table-striped">
                      <thead>
                        <th>Matricula</th>
                        <th>Nombre</th>
                        <th>Actividad</th>
                        <th>Hora de entrada</th>
                        <th>Asistencia</th>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                    </div>
                  </div>
                  </div>
                </div>
              </form>
            </div>    
      <script>
      	//var d = $('#examplex').DataTable();
        $("#error_div").hide();
        $('#error_div').on('close.bs.alert', function (e) {
            e.preventDefault();
            $(this).addClass('hidden');
        });
        var tbl = $('#examplex').DataTable({
            columns: [
                { data: 'Matricula' },
                { data: 'Nombre' },
                { data: 'Actividad' },
                { data: 'Hora_de_entrada' },
                { data: 'Asistencia' }
            ]    
        });
        
        var id_encargado_val= '<?php echo($_SESSION['user_info']['id']); ?>';
        var flag=true;
        var id_unidad ='';
        var alumnos_dentro = 0;
        var nombre_alumno='';

        function insertRow(){
          if(flag && $('#matricula').val()!=""){
            var now = new Date();
          
            $.post('view/sesion_cai/sesion_cai.php',
            {
              matricula_alumno: $('#matricula').val(),
            },
            function(data,status){
              console.log(data);
              var json_respArray = JSON.parse(data);

              //Obtener el id de la unidad
              $.post('view/sesion_cai/sesion_cai.php',
              {
                id_unidad: "bump",
              },
              function(data,status){
                console.log(data);
                id_unidad=data;
                //Se obtienen los resultados (id, nombre);
                nombre_alumno=json_respArray[1];                                          //Nombre
                $.post('view/sesion_cai/sesion_cai.php',
                {
                  id_unidad: id_unidad,
                  id_alumno: json_respArray[0],
                  id_actividad: $('#actividad_sel').find(":selected").val(),
                  id_encargado: id_encargado_val,
                  asistencia: 0
                },
                function(data,status){
                  console.log(data);
                  tbl.row.add({
                   'Matricula': $('#matricula').val(),
                   'Nombre': nombre_alumno,
                   'Actividad': $('#actividad_sel').find(":selected").text(),
                   'Hora_de_entrada': hora,
                   'Asistencia': '8'
                  }).draw();

              $("#error_div").hide();
                });
              });

              

              //Se realiza el agregado del registro en la dataTable
             
            });


          }else{
            $("#error_div").show();
            
          }
        }

   

        $('#matricula').keyup(function () {  
          $.post('view/alumnos/editar_alumno.php',
            {
              matricula_a_verificar: $('#matricula').val(),
            },
            function(data,status){
              console.log(data);
              if(data==0){
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
                    title: 'La matricula no existe!',
                    text: 'Por favor ingrese una matricula diferente',
                    type: 'warning',
                    buttons: true,
                  });
          }
        else
            c();
        }


      </script>
    </div>
  </body>

<?php
//Se cierra el else de la parte superior
}
?>

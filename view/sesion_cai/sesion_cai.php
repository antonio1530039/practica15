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
  }else if(isset($_POST['obtener_id_unidad'])){
    require_once "../../model/enlaces.php";
    require_once "../../model/crud.php";
    require_once "../../controller/controller.php";
    $verificar = new MVC();
    echo $verificar -> getUnidadId();
  }else if(isset($_POST['id_eliminar'])){
    require_once "../../model/enlaces.php";
    require_once "../../model/crud.php";
    require_once "../../controller/controller.php";
    $verificar = new MVC();
    echo $verificar -> borrarSesionController($_POST['id_eliminar']);
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

    <div id="error_div" class="alert alert-danger alert-dismissible" role="alert">
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
                        <h5 class="card-title ">Alumnos en sesion</h5>
                      </div>
                    <div class="card-body p-0">
                    <div class="table-responsive">
                    <table width="100%" id="examplex" class="table table-bordered table-striped">
                      <thead>
                        <th>Matricula</th>
                        <th>Nombre</th>
                        <th>Actividad</th>
                        <th>Hora de entrada</th>
                        <th>Imagen</th>
                        <th>Remover</th>
                        <th>Asistencia</th>
                      </thead>
                      <tbody>
                        <?php
                          $controller_sesiones->getSesionesController(); 
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
      	//var d = $('#examplex').DataTable();
        $("#error_div").hide();
        $('#error_div').on('close.bs.alert', function (e) {
            e.preventDefault();
            $(this).addClass('hidden');
        });

        //Representa a todas las matriculas de los alumnos que se han ingresado actualmente para no poder
        //meterlos en la misma sesion mas de una vez
        var matriculas_dentro=[<?php $controller_sesiones->getMatriculasSesionesController();  ?>];

        var tbl = $('#examplex').DataTable({
            columns: [
                { data: 'Matricula' },
                { data: 'Nombre' },
                { data: 'Actividad' },
                { data: 'Hora_de_entrada' },
                { data: 'Imagen' },
                { data: 'Remover' },
                { data: 'Asistencia' }
            ],
            "order": [[ 3, "desc" ]]   
        });
        
        //Variables globales
        var id_encargado_val= '<?php echo($_SESSION['user_info']['id']); ?>'; //Se obtiene el id del encargado de la variable global en PHP
        var flag=true;                                                        //Inicializando la bandera en que esta correcto
        //Inicializacion de variables para sus tipos
        var id_unidad ='';
        var alumnos_dentro = 0;
        var nombre_alumno='';



        //Permite la insercion de una fila o registro en la base de datos por una sesion de determinado alumno
        function insertRow(){
          console.log(matriculas_dentro.indexOf($('#matricula').val()));
          //Se verifica que no se halla agregado ya el alumno(matricula) a la hora
          if(matriculas_dentro.length==0 || matriculas_dentro.indexOf($('#matricula').val()) <= -1){
            //Revisando que la flag(bandera que representa si la matricula existe) y que el campo no este vacio
            if(flag && $('#matricula').val()!=""){
              var now = new Date(); //Fecha actual

              //Ejecucion de AJAX en la pagina
              //Se realizan las operaciones anidadas para que una se ejecute despues de que la otra termine
              //para que estas funciones de manera sincrona porque necesitan valores de las anteriores.
            
              //Obteniendo detalles
              $.post('view/sesion_cai/sesion_cai.php',
              {
                matricula_alumno: $('#matricula').val(),//Matricula del alumno a verificar
              },
              function(data,status){
                var json_respArray = JSON.parse(data);  //Se obtienen varios atributos del alumno con la matricula ingresada
                                                        // (Id, nombre y fotografia)

                //Obtener el id de la unidad
                $.post('view/sesion_cai/sesion_cai.php',
                {
                  obtener_id_unidad: "bump",  //Variable para detectar accion
                },
                function(data,status){
                  id_unidad=data;                   //Id obtenido de la consulta
                  nombre_alumno=json_respArray[1];  //Nombre

                  $.post('view/sesion_cai/sesion_cai.php',
                  {
                    id_unidad: id_unidad,
                    id_alumno: json_respArray[0],
                    id_actividad: $('#actividad_sel').find(":selected").val(),
                    id_encargado: id_encargado_val,
                    asistencia: 0
                  },
                  function(data,status){
                    var json_respInsert = JSON.parse(data);
                    tbl.row.add({
                      'Matricula': $('#matricula').val(),
                      'Nombre': nombre_alumno,
                      'Actividad': $('#actividad_sel').find(":selected").text(),
                      'Hora_de_entrada': json_respInsert[1],
                      'Imagen': '<td><a href="'+json_respArray[2]+'" id="ver_btn'+json_respInsert[0]+'" onClick="ver_imagen('+json_respInsert[0]+');">Ver</a></td>',
                      'Remover':  "<td><button type='button' id='borrar-"+json_respInsert[0]+"-"+$('#matricula').val()+"' class='btn btn-danger'><i class='fa fa-close'></i></button></td>",
                      'Asistencia': "<td><button type='button' id='asistencia-"+json_respInsert[0]+"-"+$('#matricula').val()+"' class='btn btn-warning'><i class='fa fa-close'></i></button></td>"
                    }).draw();
                    matriculas_dentro.push($('#matricula').val());
                    $("#error_div").hide();
                  });
                });
              });
            }else{
              
              $("#error_div").html('Alerta: El alumno que esta intentando con la matricula '+$('#matricula').val()+' no existe.');
              $("#error_div").show();
            }
            console.log("xddd");
          }else{
            $("#error_div").html('Alerta: El alumno con la matricula '+$('#matricula').val()+" ya esta en la sesion.");
             $("#error_div").show();
            //$("#error_div").show();
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

        $('#examplex').on("click", "button", function(){
            var split=$(this).parent().prevObject["0"].id.split("-");
            var tipo=split[0];
            var id=split[1];
            var matricula=split[2];
            var ref = $(this);
            console.log(id);
            
            if (tipo=="borrar"){
              $.post('view/sesion_cai/sesion_cai.php',
              {
                id_eliminar: id,  //Matricula del alumno a eliminar
              },
              function(data,status){
                if(data=="success"){
                  for(i=0;i<matriculas_dentro.length;i++){
                    if(matriculas_dentro[i]==matricula)
                      matriculas_dentro.splice(i, 1);
                  }
                  console.log(matriculas_dentro);
                  tbl.row(ref.parents('tr')).remove().draw(false);
                }
              });
            }else if(tipo=="asistencia"){

            }   
        });
       


      </script>
    </div>
  </body>

<?php
//Se cierra el else de la parte superior
}
?>

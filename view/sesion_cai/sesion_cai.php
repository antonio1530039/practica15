<?php

  //Condicional para obtener detalles del alumno que se esta ingresando en relacion con su matricula
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once "../../model/enlaces.php";
    require_once "../../model/crud.php";
    require_once "../../controller/controller.php";
    $verificar = new MVC();

    if(isset($_POST['matricula_alumno'])){
      echo $verificar -> getDetailsFromAlumno( $_POST['matricula_alumno'] ,"alumnos");
    }else if(isset($_POST['asistencia'])){
      $data = array(
                    'id_unidad'=> $_POST['id_unidad'],
                    'id_encargado'=> $_POST['id_encargado'],
                    'id_alumno'=> $_POST['id_alumno'],
                    'id_actividad'=> $_POST['id_actividad'],
                    'asistencia'=> $_POST['asistencia']
                  );
      echo $verificar -> registroSesionCai( $data);
    }else if(isset($_POST['obtener_id_unidad'])){
      echo $verificar -> getUnidadId();
    }else if(isset($_POST['id_eliminar'])){
      echo $verificar -> borrarSesionController($_POST['id_eliminar']);
    }else if(isset($_POST['get_alumnos'])){
      echo $verificar -> getCantidadAlumnos();
    }else if(isset($_POST['id_asistencia'])){
      echo $verificar -> setAsistenciaController($_POST['id_asistencia']);
    }else if(isset($_POST['get_date'])){
      echo $verificar -> getServerDateController();
    }else if(isset($_POST['delete_asistencias'])){
      echo $verificar -> deleteSesionesSinAsistenciaController();
    }
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
      <div id="div_main_controls" style="visibility: hidden" class="col-sm-9 ">
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
                    <div class="card card-success">
                      <div class="card-header">
                        <h5 class="card-title ">Alumnos en sesion</h5>
                      </div>
                    <div class="card-body p-0">
                    <div id="div_main_table" style="visibility: hidden" class="table-responsive">
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
          if(matriculas_dentro.length<30){
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

                    //Se realiza la insercion a la base de datos de la sesion actual
                    $.post('view/sesion_cai/sesion_cai.php',
                    {
                      id_unidad: id_unidad,
                      id_alumno: json_respArray[0],
                      id_actividad: $('#actividad_sel').find(":selected").val(),
                      id_encargado: id_encargado_val,
                      asistencia: 0
                    },
                    function(data,status){
                      var json_respInsert = JSON.parse(data); //Se obtienen de resultados el id[0] y la matricula[1]
                      //Se agrega la fila al datatable
                      tbl.row.add({
                        'Matricula': $('#matricula').val(),
                        'Nombre': nombre_alumno,
                        'Actividad': $('#actividad_sel').find(":selected").text(),
                        'Hora_de_entrada': json_respInsert[1],
                        'Imagen': '<td><a href="'+json_respArray[2]+'" id="ver_btn'+json_respInsert[0]+'" onClick="ver_imagen('+json_respInsert[0]+');">Ver</a></td>',
                        'Remover':  "<td><button type='button' id='borrar-"+json_respInsert[0]+"-"+$('#matricula').val()+"' class='btn btn-danger'><i class='fa fa-close'></i></button></td>",
                        'Asistencia': "<td><button type='button' id='asistencia-"+json_respInsert[0]+"-"+$('#matricula').val()+"' class='btn btn-warning'><i class='fa fa-close'></i></button></td>"
                      }).draw();
                      //Se agrega la matricula actual al array que contiene todas las matriculas
                      matriculas_dentro.push($('#matricula').val());
                      //Se actualiza el contador de los alumnos
                      updateAlumnos();

                      //Se prepara para nueva insercion
                      $("#matricula").val("");
                      $("#matricula").focus();
                      $("#error_div").hide();
                    });
                  });
                });
              }else{
                //Caso de error se muestra el div superior
                $("#error_div").html('Alerta: El alumno que esta intentando ingresar con la matricula '+$('#matricula').val()+' no existe.');
                $("#error_div").show();
              }
            }else{
              //Caso de error se muestra el div superior
              $("#error_div").html('Alerta: El alumno con la matricula '+$('#matricula').val()+" ya esta en la sesion.");
              $("#error_div").show();
            }
          }else{
            $("#error_div").html('Alerta: No se pudo ingresar alumno, la sesion ya esta llena (30/30).');
            $("#error_div").show();
          }
        }

        //Se detecta las teclas que se esten presionando para verificar la matricula que se esta ingresando
        //y asi mostrar que esta existe o no cambiando el borde del text input
        $('#matricula').keyup(function () {  
          $.post('view/alumnos/editar_alumno.php',
            {
              matricula_a_verificar: $('#matricula').val(),
            },
            function(data,status){
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

        //Error, matricula inexistente
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
            c();  //Se continua normalmente
        }

        //Se controla los eventos de los botones en el datatable examplex, se obtiene primero el id(sesion_cai) y la 
        //matricula que se encuentran en los id(elemento) de los mismos.
        $('#examplex').on("click", "button", function(){
            var split=$(this).parent().prevObject["0"].id.split("-"); //Detalles del objeto

            var tipo=split[0];      //Tipo (borrar, asistencia)
            var id=split[1];        //Id de la sesion
            var matricula=split[2]; //Matricula del alumno
            var ref = $(this);      //Variable que referencia al boton

            //En caso de que sea borrar
            if (tipo=="borrar"){
              swal({
                title: "Eliminando al alumno de la sesion",
                text: "¿Esta seguro de que dease eliminar al alumno con la matricula "+matricula+" de la sesion actual?.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Aceptar",
                cancelButtonText: "Cancelar",
                closeOnConfirm: true,
                closeOnCancel: true
              },
              function(isConfirm){
                if (isConfirm) {
                  //Se realiza la eliminacion
                  $.post('view/sesion_cai/sesion_cai.php',
                  {
                    id_eliminar: id,  //Matricula del alumno a eliminar
                  },
                  function(data,status){
                    if(data=="success"){
                      //Se actualiza el array que contiene las matriculas ingresadas
                      for(i=0;i<matriculas_dentro.length;i++){
                        if(matriculas_dentro[i]==matricula)
                          matriculas_dentro.splice(i, 1);
                      }
                      tbl.row(ref.parents('tr')).remove().draw(false);  //Se elimina la fila del boton
                      updateAlumnos();
                    }
                  });
                }
              });
            }else if(tipo=="asistencia"){ //Caso de asistencia
              $.post('view/sesion_cai/sesion_cai.php',
              {
                id_asistencia: id,    //Matricula del alumno a poner asistencia
              },
              function(data,status){
                if(data=="success"){
                  tbl.row(ref.parents('tr')).remove().draw(false);      //Se elimina la fila del boton
                  updateAlumnos();
                }
              });
            }   
        });

        //Permite la actualizacion del contador superior de la pagina que muestra la cantidad
        //de alumnos que se encuentran actualmente en la sesion y tambien del tope, ademas
        //de igual manera actualiza el progressbar inferior con el porcentaje correspondiente.
        function updateAlumnos(){
          $.post('view/sesion_cai/sesion_cai.php',
          {
            get_alumnos: "bump",  //Variable para definir que es
          },
          function(data,status){
            $("#alumnos_dentro").text(data+"/30");
            $("#porcentage_dentro").css("width", (data*100/30));
          });
        }
        updateAlumnos();
       
        //Variable (state) que determina en que estado se encuentra actualmente la sesion correspondiendo
        //a los minutos que s encuentra actualmente
        //  Valores:
        //        Id  Tipo      Descripcion                           Rango
        //        0   Entrada   Hora de ingresar alumnos              (mm>=00 && mm<=10)
        //        1   Dentro    Los alumnos se encuentran en clase    (mm>=10 && mm<50)
        //        2   Salida    La hora ha sido concluida (pase de    (mm>50)
        //                      lista)

        //        3   Descarto  Se descartan las asistencias          (mm>60) misma hora

        //Solo se tienen 10min (min 50 a 60) para confirmar las asistencias sino son descartadas, ocurre caso 3.
        var state=-1;  

        //Funcion que permite revisar el estado en el que debe de estar el header superior basandose en los estados
        //de la variable state y sus propiedades, se prepara tambien la interfaz para bloquear dichas interfaces
        function revisarTiempo(){
          if(min>=0 && min<=10){      
            if(state!=0){   
              if(state==2){
                matriculas_dentro=[];
                tbl.clear().draw();
              }         
              $("#div_header").attr("class","info-box mb-3 bg-success");
              $('#matricula').show();
              $("#actividad_sel").parent().parent().show();
              $('#header_insertar_btn').show();
              $("#header_texto_superior").text("Ingreso de Alumnos");
              $("#header_texto_superior").css("font-size","16px");
              tbl.column( 6 ).visible(false);
              $("#div_main_controls").css("visibility","visible");
              $("#div_main_table").css("visibility","visible");
              state=0;
              deleteAsistencias();
            }
          }else if(min>=10 && min<50){ 
            if(state!=1){
              $("#div_header").attr("class","info-box mb-3 bg-warning");
              $('#matricula').hide();
              $("#actividad_sel").parent().parent().hide();
              $('#header_insertar_btn').hide();
              $("#header_texto_superior").text("Sesion termina en: "+(50-min)+" minutos.");
              $("#header_texto_superior").css("font-size","30px");
              tbl.column( 6 ).visible(false);
              $("#div_main_controls").css("visibility","visible");
              $("#div_main_table").css("visibility","visible");
              deleteAsistencias();
              state=1;
            }else{
              $("#header_texto_superior").text("Sesion termina en: "+(50-min)+" minutos.");
            }
          }else if(min>=50){         
            if(state!=2){
              $("#div_header").attr("class","info-box mb-3 bg-danger");
              $('#matricula').hide();
              $("#actividad_sel").parent().parent().hide();
              $('#header_insertar_btn').hide();
              $("#header_texto_superior").text("Pase de lista termina en: "+(60-min)+" minutos.");
              $("#header_texto_superior").css("font-size","30px");
              tbl.column( 6 ).visible(true);
              $("#div_main_controls").css("visibility","visible");
              $("#div_main_table").css("visibility","visible");
              deleteAsistencias();
              state=2;
            }else{
              $("#header_texto_superior").text("Pase de lista termina en: "+(60-min)+" minutos.");
            }
          }
        }

        revisarTiempo();
        setInterval(revisarTiempo, 1000);
        deleteAsistencias();

        //Funcion que elimina todas las sesiones de cai que no tubieron asistencias en las horas pasadas
        function deleteAsistencias(){
          $.post('view/sesion_cai/sesion_cai.php',
          {
            delete_asistencias: "bump",  //Variable para definir que es
          },
          function(data,status){
          });
        }

        //Al presionar enter en cualquier parte de la pagina se ejecuta la insercion
        $(document).keypress(function(e) {
          if(e.which == 13 && state==0) {
            insertRow();
          }
        });


      </script>
    </div>
  </body>

<?php
//Se cierra el else de la parte superior
}
?>

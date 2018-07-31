<!doctype html>
<html>
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="view/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="view/dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="view/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="view/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="view/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="view/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="view/plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="view/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="view/plugins/datatables/dataTables.bootstrap4.css">


  <!-- jQuery -->
  <script src="view/plugins/jquery/jquery.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
  <!-- Select2 -->
  <link rel="stylesheet" href="view/plugins/select2/select2.min.css">
  <link rel="stylesheet" href="view/plugins/bootstrap/css/bootstrap.min.css">
  <!--script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script-->
  <script src="view/dist/js/plugins/sweetalert/sweetalert.js"></script>
    <!--script src="view/dist/js/plugins/sweetalert/sweetalert.min.js"></script-->
  <link rel="stylesheet" href="view/dist/js/plugins/sweetalert/sweetalert.css">

  <script src="view/plugins/bootstrap/js/bootstrap.min.js"></script>


  <!-- DataTables -->
  <script src="view/plugins/datatables/jquery.dataTables.js"></script>
  <script src="view/plugins/datatables/dataTables.bootstrap4.js"></script>
  <script src="view/plugins/datatables/dataTables.buttons.min.js"></script>
  <script src="view/plugins/datatables/buttons.flash.min.js"></script>
  <script src="view/plugins/datatables/jszip.min.js"></script>
  <script src="view/plugins/datatables/pdfmake.min.js"></script>
  <script src="view/plugins/datatables/vfs_fonts.js"></script>
  <script src="view/plugins/datatables/buttons.html5.min.js"></script>
  <script src="view/plugins/datatables/buttons.print.min.js"></script>

  <!-- daterangepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
  <script src="view/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- datepicker -->
  <script src="view/plugins/datepicker/bootstrap-datepicker.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="view/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- Slimscroll -->
  <script src="view/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="view/plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="view/dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="view/dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="view/dist/js/demo.js"></script>
  <!-- Select2 -->
  <script src="view/plugins/select2/select2.full.min.js"></script>

  <link rel=icon href=./model/images/logo.png>
</head>
<body class="hold-transition sidebar-mini">
<?php
  //se crea una instancia de la clase controlador
  $controllerT = new MVC();
?>
<script type="text/javascript">
  //Se definen las variables que contendran el tiempo en toda la aplicacion
  var start_server_time='<?php echo($controllerT->getServerHourController());?>';
  var split = start_server_time.split(":");
  var hour=parseInt(split[0]);
  var min=parseInt(split[1]);
  var sec=parseInt(split[2]);

</script>

<div class="wrapper">
  <?php
  //funcion del controlador
  $controller = new MVC();
  //mostrar div en caso de estar logueado
  $controller->showNav();

  ?>
    <?php
    //se ejecuta el metodo enlaces paginas controler que en base al valor de la variable action tomada por el metodo post, se redirecciona a una pagina especificada
    $controllerT->enlacePaginasController();
  ?>
  
  </div>
</div>
<!-- ./wrapper -->
</body>
  


<script type="text/javascript">
 
      //Retorna una cadena de texto con el formato de fecha dia, dd mes yyyy
      function getDate(){
        var str = "";
        var days = new Array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");
        var months = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

        $.post('view/sesion_cai/sesion_cai.php',
        {
          get_date: "bump",  //Variable para definir que es
        },
        function(data,status){
          var split=data.split("-");
          var now = new Date(split[1]+"-"+split[2]+"-"+split[0]);
          str += days[now.getDay()] + ", " + now.getDate() + " " + months[now.getMonth()] + " " + now.getFullYear() + " ";
          document.getElementById("fecha").innerHTML = str;
        });
      }

      //actualiza la hora en el reloj de la pagina en la parte superior, ademas actualiza los valores
      //de las variables (hour,min,sec);
      function getTime(){
        sec++;
        if(sec>59){
          sec=0;
          min++;
          if(min>59){
            min=0;
            hour++;
            if(hour>24){
              hour=0;
              getDate();
            }
          }
        }
        document.getElementById("hora").innerHTML = (hour<10?"0"+hour:hour) +":" + (min<10?"0"+min:min) + ":" + (sec<10?"0"+sec:sec);
      }

      //validar si es teacher el usuario, no mostrar la fecha y hora (solo para encargado y superadmin)
      var ps = "<?php echo $_SESSION['user_info']['tipo'] ?>";

      if(ps != "teacher"){

        //Mostrado de fecha y hora en la parte superior de la interfaz
        getDate();
        getTime();

        //Inicializacion de funcion que sera llamada cada 60seg y cada segundo para mostrar la fecha y la hora respectivamente
        setInterval(getTime, 1000);
      }
      
      //funcion de confirmacion de cierre de sesion, muestra un sweet alert
        function confirmLogout(){
            event.preventDefault();
            swal({
            title: "Cerrar sesión",
            text: "¿Seguro que deseas cerrar la sesión?",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonClass: "btn-info",
            confirmButtonText: "Si, estoy seguro",
            closeOnConfirm: false
          },
          function(){
            window.location = 'index.php?action=logout';
          });
        }
  
        //funcion encargada de mostrar un alert cuando el usuario da clic en el boton actualizar y pida la contraseña
        function c(){
         var ps = "<?php echo $_SESSION['user_info']['password'] ?>";
          event.preventDefault();

          swal({
            title: "Confirmar acción",
            text: "<p>Ingresa tu contraseña para guardar los cambios</p><br><input type='password' class='form-control' id='pass_sw' placeholder='Escribe tu contraseña aqui' autofocus><label id='err_sa' style='color:red'></label><br>",
            html: true,
            
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonText: "Confirmar",
            closeOnConfirm: false,
            inputPlaceholder: "Escribe tu contraseña aqui",
            inputValidator: (value) => {
              return !value && 'You need to write something!'
            }
          }, function () {
            var inputValue = document.getElementById("pass_sw").value;
            if (inputValue === false) return false;
            if (inputValue != ps) {
              document.getElementById("err_sa").innerHTML = "Contraseña incorrecta";
              //swal.showInputError("You need to write something!");
              //swal("Operación cancelada!", "La contraseña es incorrecta", "error");
              return false
            }
             $( "#targ" ).click();
            //swal("Exito!", "Registro modificado", "success");
          });
        }
     
        //funcion que se manda llamar al tratar de eliminar algun registro y muestra un sweet alert pidiendo la contraseña del usuario
        function b(id){
         var ps = "<?php echo $_SESSION['user_info']['password'] ?>";
          event.preventDefault();
          swal({
            title: "Confirmar baja de registro",
            text: "<p>Ingresa tu contraseña para dar de baja el registro</p><br><input type='password' class='form-control' id='pass_sw_2' placeholder='Escribe tu contraseña aqui' autofocus><label id='err_sa_2' style='color:red'></label><br>",
            html: true,
            
            type: "error",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonText: "Confirmar",
            closeOnConfirm: false,
            inputPlaceholder: "Escribe tu contraseña aqui",
          }, function () {
            var inputValue = document.getElementById("pass_sw_2").value;
            if (inputValue === false) return false;
            if (inputValue != ps) {
              document.getElementById("err_sa_2").innerHTML = "Contraseña incorrecta";
              return false
            }
            var ur = document.getElementById("borrar_btn"+id).href;
            //alert(ur);
            window.location = ur;
            //swal("Exito!", "Registro eliminado", "success");
          });
        }


        //funcion que despliega un sweet alert con la imagen del alumno
        function ver_imagen(id){
          event.preventDefault();
          swal({
            title: "Visualizacion de Imagen",
            text: "<img class='form-control' src='"+document.getElementById("ver_btn"+id).href+"'>",
            html: true,
            confirmButtonText: "Cerrar ventana",
            closeOnConfirm: true
          });
        }

        //crear datable para Historial
        $(document).ready(function() {
          $('#htable').DataTable({
            "bSort": false
          });
           $('#htable2').DataTable({
            "bSort": false
          });
        });

        $(document).ready(function() {
          $('#ventasTable').DataTable({
           "order": [[ 0, "desc" ]],
           dom: 'Bfrtip',
            buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
            ]
          });
        });

        $(document).ready(function() {
          $('#detalleVenta').DataTable({
           dom: 'Bfrtip',
            buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
            ]
          });
        });

        //funciones para cargar algunos datatables y el select2
        $(function () {
          $('.select2').select2();
          $("#example1").DataTable();
          $("#example2").DataTable();
          $("#tiendas_desactivadas").DataTable();
          
        });

         //mostrar botones para exportar el contenido del datatable de reportes de sesiones de cai
        $(document).ready(function() {
          $('#reporteTable').DataTable({
           dom: 'Bfrtip',
            buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ]
          });
        } );
      </script> 
</html>

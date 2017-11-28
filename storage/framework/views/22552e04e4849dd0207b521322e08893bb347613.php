<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- CSRF Token -->
   <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

   <title>360| login</title>

   <!-- Styles -->
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
   <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
   <meta name="viewport" content="width=device-width" />
   <!-- Bootstrap core CSS     -->
   <link href="css/bootstrap.min.css" rel="stylesheet" />
   <!--  Material Dashboard CSS    -->
   <link href="css/material-dashboard.css" rel="stylesheet" />
   <!--  CSS for Demo Purpose, don't include it in your project     -->
   <link href="css/demo.css" rel="stylesheet" />
   <!--     Fonts and icons     -->
   <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />

   <link href="<?php echo e(asset('css/animate.css')); ?>" rel="stylesheet" />
   <link href="<?php echo e(asset('css/styles.css')); ?>" rel="stylesheet" />
</head>

<body class="fundo_dourado">

   <nav class="navbar navbar-default navbar-static-top animated fadeInDownBig">
   
   </nav>

   <div class="wrapper wrapper-full-page">
      <br><br>
      <div class="full-page login-page" filter-color="black" data-image="<?php echo e(asset("/img/prefeitura.png")); ?>">
         <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
         <div class="content">
            <div class="container">
               <div class="row">
                  <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                     <form method="POST" action="<?php echo e(url("/login")); ?>">
                        
                        <?php echo e(csrf_field()); ?>


                        
                        <div id="login-municipe" class="card card-login card-hidden">
                           <div class="logo-dourado logo-pn"></div>
                           <div class="card-header text-center" data-background-color="dourado">
                              <div class="social-line"><br><br><br></div>
                           </div>
                           <div class="card-content">
                              <div class="input-group">
                                 <span class="input-group-addon">
                                    <i class="material-icons">perm_identity</i>
                                 </span>
                                 <div class="form-group label-floating has-dourado">
                                    <label class="control-label">Usuário(a)</label>
                                    <input type="email" class="form-control" name="email">
                                 </div>
                              </div>
                           <div class="input-group">
                              <span class="input-group-addon">
                                 <i class="material-icons">lock_outline</i>
                              </span>
                              <div class="form-group label-floating has-dourado">
                                 <label class="control-label">Senha</label>
                                 <input type="password" class="form-control" name="senha">
                              </div>
                           </div>
                        </div>
                        <div class="footer text-center">
                           <button type="submit" class="btn btn-dourado btn-wd btn-lg">Acessar</button>
                        </div>
                     </div> 
                  </form>
               </div>
            </div>
         </div>
      </div>

      <?php echo $__env->make('includes.layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

   </div>
</div>

 <!--   Core JS Files   -->
 <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
 <script src="js/jquery-ui.min.js" type="text/javascript"></script>
 <script src="js/bootstrap.min.js" type="text/javascript"></script>
 <script src="js/material.min.js" type="text/javascript"></script>
 <script src="js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
 <!-- Forms Validations Plugin -->
 <script src="js/jquery.validate.min.js"></script>
 <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
 <script src="js/moment.min.js"></script>
 <!--  Charts Plugin -->
 <script src="js/chartist.min.js"></script>
 <!--  Plugin for the Wizard -->
 <script src="js/jquery.bootstrap-wizard.js"></script>
 <!--  Notifications Plugin    -->
 <script src="js/bootstrap-notify.js"></script>
 <!-- DateTimePicker Plugin -->
 <script src="js/bootstrap-datetimepicker.js"></script>
 <!-- Vector Map plugin -->
 <script src="js/jquery-jvectormap.js"></script>
 <!-- Sliders Plugin -->
 <script src="js/nouislider.min.js"></script>
 <!--  Google Maps Plugin    -->
 <script src="https://maps.googleapis.com/maps/api/js"></script>
 <!-- Select Plugin -->
 <script src="js/jquery.select-bootstrap.js"></script>
 <!--  DataTables.net Plugin    -->
 <script src="js/jquery.datatables.js"></script>
 <!-- Sweet Alert 2 plugin -->
 <script src="js/sweetalert2.js"></script>
 <!--    Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
 <script src="js/jasny-bootstrap.min.js"></script>
 <!--  Full Calendar Plugin    -->
 <script src="js/fullcalendar.min.js"></script>
 <!-- TagsInput Plugin -->
 <script src="js/jquery.tagsinput.js"></script>
 <!-- Material Dashboard javascript methods -->
 <script src="js/material-dashboard.js"></script>
 <!-- Material Dashboard DEMO methods, don't include it in your project! -->
 <script src="js/demo.js"></script>

<!-- Scripts -->


<?php echo $__env->make('includes.login.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>
</html>
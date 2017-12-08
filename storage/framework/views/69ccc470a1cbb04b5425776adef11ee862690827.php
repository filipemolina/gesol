<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(asset('img/apple-icon.png')); ?>" />
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/favicon.png')); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title> <?php $__env->startSection('titulo'); ?> <?php echo $__env->yieldSection(); ?> </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="<?php echo e(asset('css/material-dashboard.css')); ?>" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
</head>

<body>
    <div class="wrapper">

        
        
        <?php echo $__env->make('includes.layouts.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="main-panel">

            
            
            <?php echo $__env->make('includes.layouts.topbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <div class="content">
                <div class="container-fluid">

                    
    
                    <?php echo $__env->yieldContent('content'); ?>

                </div>
            </div>

            

            <?php echo $__env->make('includes.layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="<?php echo e(asset('js/jquery-3.1.1.min.js')); ?>"  type="text/javascript"></script>
<script src="<?php echo e(asset('js/jquery-ui.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('js/material.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('js/perfect-scrollbar.jquery.min.js')); ?>" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="<?php echo e(asset('js/jquery.validate.min.js')); ?>"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="<?php echo e(asset('js/moment.min.js')); ?>"></script>
<!--  Charts Plugin -->
<script src="<?php echo e(asset('js/chartist.min.js')); ?>"></script>
<!--  Plugin for the Wizard -->
<script src="<?php echo e(asset('js/jquery.bootstrap-wizard.js')); ?>"></script>
<!--  Notifications Plugin    -->
<script src="<?php echo e(asset('js/bootstrap-notify.js')); ?>"></script>
<!-- DateTimePicker Plugin -->
<script src="<?php echo e(asset('js/bootstrap-datetimepicker.js')); ?>"></script>
<!-- Vector Map plugin -->
<script src="<?php echo e(asset('js/jquery-jvectormap.js')); ?>"></script>
<!-- Sliders Plugin -->
<script src="<?php echo e(asset('js/nouislider.min.js')); ?>"></script>
<!--  Google Maps Plugin    -->


<!-- Select Plugin -->
<script src="<?php echo e(asset('js/jquery.select-bootstrap.js')); ?>"></script>
<!--  DataTables.net Plugin    -->
<script src="<?php echo e(asset('js/jquery.datatables.js')); ?>"></script>
<!-- Sweet Alert 2 plugin -->
<script src="<?php echo e(asset('js/sweetalert2.js')); ?>"></script>
<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="<?php echo e(asset('js/jasny-bootstrap.min.js')); ?>"></script>
<!--  Full Calendar Plugin    -->
<script src="<?php echo e(asset('js/fullcalendar.min.js')); ?>"></script>
<!-- TagsInput Plugin -->
<script src="<?php echo e(asset('js/jquery.tagsinput.js')); ?>"></script>
<!-- Material Dashboard javascript methods -->
<script src="<?php echo e(asset('js/material-dashboard.js')); ?>"></script>


<script src="<?php echo e(asset('js/vanillaMasker.min.js')); ?>"></script>


<script src="<?php echo e(asset('js/scripts.js')); ?>"></script>

</html>
<!doctype html>
<html lang="pt-BR">

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

    <link href="<?php echo e(asset('css/jquery-ui.css')); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

    <!-- =============================================================================== -->
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?php echo e(asset('css/demo.css')); ?>" rel="stylesheet" />
    <!-- =============================================================================== -->

    <!--  Material styles CSS    -->
    <link href="<?php echo e(asset('css/styles.css')); ?>" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
    <!-- meterial fonts     -->
    <link href="<?php echo e(asset('css/materialdesignicons.min.css')); ?>" rel="stylesheet" />



    <?php echo $__env->yieldPushContent('css'); ?>
    
</head>

<body>
    <div class="wrapper">

        
        
        <?php echo $__env->make('includes.layouts.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="main-panel">

            
            
            <?php echo $__env->make('includes.layouts.topbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


            <div class="content" style="padding-top: 10px;
                                        padding-bottom: 0px;
                                        padding-left: 20px;
                                        padding-right: 20px;">

                <div class="container-fluid">

                    
    
                    <?php echo $__env->yieldContent('content'); ?>

                </div>
            </div>

            

            <?php echo $__env->make('includes.layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
        </div>
    </div>


        <script>
            
            //variáveis globais ao sistema
            let url_base       = "<?php echo e(url("/")); ?>";
            let token          = "<?php echo e(csrf_token()); ?>";
	    let nome  = "<?php echo e($funcionario_logado->nome); ?>";
	    let setor = "<?php echo e($funcionario_logado->setor->nome); ?>";
	    let sigla = "<?php echo e($funcionario_logado->setor->secretaria->sigla); ?>";
        </script>


        <script src="<?php echo e(asset('js/jquery-3.1.1.min.js')); ?>"  type="text/javascript"></script>
        <script src="<?php echo e(asset('js/jquery-ui.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('js/material.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('js/perfect-scrollbar.jquery.min.js')); ?>" type="text/javascript"></script>

        <script src="<?php echo e(asset('js/jquery.validate.min.js')); ?>"></script>

        <script src="<?php echo e(asset('js/moment.min.js')); ?>"></script>


        <script src="<?php echo e(asset('js/chartist.min.js')); ?>"></script>

        <script src="<?php echo e(asset('js/jquery.bootstrap-wizard.js')); ?>"></script>

        <script src="<?php echo e(asset('js/bootstrap-notify.js')); ?>"></script>

        <script src="<?php echo e(asset('js/bootstrap-datetimepicker.js')); ?>"></script>

        <script src="<?php echo e(asset('js/jquery-jvectormap.js')); ?>"></script>

        <script src="<?php echo e(asset('js/nouislider.min.js')); ?>"></script>

        <script src="https://maps.google.com/maps/api/js?key=AIzaSyDcdW2PsrS1fbsXKmZ6P9Ii8zub5FDu3WQ"></script>

        <script src="<?php echo e(asset('js/jquery.select-bootstrap.js')); ?>"></script>

        <script src="<?php echo e(asset('js/sweetalert2.js')); ?>"></script>

        <script src="<?php echo e(asset('js/jasny-bootstrap.min.js')); ?>"></script>

        <script src="<?php echo e(asset('js/jquery.tagsinput.js')); ?>"></script>

        <script src="<?php echo e(asset('js/material-dashboard.js')); ?>"></script>

        <script src="<?php echo e(asset('js/demo.js')); ?>"></script>

        
        <script src="<?php echo e(asset('js/vanillaMasker.min.js')); ?>"></script>

        <script src="<?php echo e(asset('js/echarts-en.min.js')); ?>"></script>


        

        <script type="text/javascript" src="<?php echo e(asset('js/jquery.datatables.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('js/dataTables.responsive.min.js')); ?>"></script>

        

        <script src="<?php echo e(asset('js/datetime-moment.js')); ?>"></script>

        <script src="<?php echo e(asset('js/fullcalendar.min.js')); ?>"></script>

        
        <script src="<?php echo e(asset('js/functions.js')); ?>"></script>

        
        <script src="<?php echo e(asset('js/scripts.js')); ?>"></script>

        <?php echo $__env->yieldPushContent('scripts'); ?>

    </body>
</html>

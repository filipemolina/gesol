<?php $__env->startSection('titulo'); ?>
   Página Principal
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header card-header-icon" data-background-color="red" style="color: #fff;">
                  <i class="material-icons">assignment</i>
               </div>
               <div class="card-content">
                  <h4 class="card-title">Solicitações aguardando Liberação</h4>
                  <div class="toolbar">
                     <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>

                  <div class="material-datatables">
                     <div id="datatables_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="col-sm-13">
                           <table id="tabela-solicitacoes-retidas" 
                                 class="table table-striped table-no-bordered table-hover dataTable dtr-inline" 
                                 cellspacing="0" width="100%" 
                                 role="grid" aria-describedby="datatables_info"
                                 style="width: 100%; font-size: 12px;" >
                        <thead>
                           <tr>
                              <th>Foto</th>
                              <th>Serviço</th>
                              <th>Conteúdo</th>
                              <!-- <th>Status</th> -->
                              <th>Abertura</th>
                              <th>Ações</th>
                           </tr>                           
                        </thead>

                                      

                     </table>
                  </div>
                  <!-- end content-->
               </div>
               <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
         </div>
         <!-- end row -->
      </div>
   </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>

   <script type="text/javascript">
      $(function(){
         
         <?php if($errors->any()): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               setTimeout(function(){demo.notificationRight("top", "right", "rose", "<?php echo e($error); ?>"); }, tempo);
               tempo += incremento;
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <?php endif; ?>
         
         //$.fn.dataTable.moment( 'DD/MM/YYYY' );

         $("#tabela-solicitacoes-retidas").DataTable({
            
            responsive : true,
            processing: true,
            serverSide: true,
            ajax      : "<?php echo e(url('/solicitacao/datatables/0')); ?>",
            columns   : [

               { data : 'foto',       name : 'foto' },
               { data : 'servico',    name : 'servico' },
               { data : 'conteudo',   name : 'conteudo' },
               { data : 'abertura',   name : 'abertura' },
               { data : 'acoes',      name : 'acoes' },
            ],

            order: [[ 3, 'asc' ]],
            
            language : 
            {
               "url":         "<?php echo e(asset('js/portugues.json')); ?>",
               "decimal":     ",",
               "thousands":   "."
            }, 

            stateSave: true,
            stateDuration: -1,
            


            columnDefs: 
            [
                  { className:   "text-center", "targets": [0] },
                  { className:   "text-center", "targets": [1] },
                  { className:   "text-center", "targets": [3] },
                  { className:   "text-center", "targets": [4] },
                  { width:       "10%",         "targets": [1] },
                  { width:       "40%",         "targets": [2] }
            ]

         });
      
      });

     
   </script>
<?php $__env->stopPush(); ?>





<?php echo $__env->make('layouts.material', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
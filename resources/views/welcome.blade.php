@extends('layouts.material')

@section('titulo')
Página Principal
@endsection

@section('content')

   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header card-header-icon" data-background-color="dourado" style="color: #000000;">
                  <i class="material-icons">assignment</i>
               </div>
               <div class="card-content">
                  <h4 class="card-title">Solicitações</h4>
                  <div class="toolbar">
                     <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>

                  <div class="material-datatables">
                     <div id="datatables_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="col-sm-13">
                           <table id="tabela-solicitacoes" 
                                 class="table table-striped table-no-bordered table-hover dataTable dtr-inline" 
                                 cellspacing="0" width="100%" 
                                 role="grid" aria-describedby="datatables_info"
                                 style="width: 100%; font-size: 12px;" >
                        <thead>
                           <tr>
                              <th>Foto</th>
                              <th>Setor</th>
                              <th>Status</th>
                              <th>Moderado</th>
                              <th>Abertura</th>
                              <th>Ações</th>
                           </tr>                           
                        </thead>

                       {{-- preenchido com datatables --}}               

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
@endsection


@push('scripts')

<script type="text/javascript">
   $(function(){
      {{-- Testar se há algum erro, e mostrar a notificação --}}
      @if ($errors->any())
         @foreach ($errors->all() as $error)
            setTimeout(function(){demo.notificationRight("top", "right", "rose", "{{ $error }}"); }, tempo);
            tempo += incremento;
         @endforeach
      @endif
      
      //$.fn.dataTable.moment( 'DD/MM/YYYY' );

      $("#tabela-solicitacoes").DataTable({
         responsive : true,
         processing: true,
         serverSide: true,
         ajax      : "{{ url('/solicitacao/datatables') }}",
         columns   : [

          { data : 'foto',       name : 'foto' },
          { data : 'setor',      name : 'setor' },
          { data : 'status',     name : 'status' },
          { data : 'moderado',   name : 'moderado' },
          { data : 'abertura',   name : 'abertura' },
          { data : 'acoes',      name : 'acoes' },

        ],
         
         language : 
         {
            "url":         "{{ asset('js/portugues.json') }}",
            "decimal":     ",",
            "thousands":   "."
         }, 

         stateSave: true,
         stateDuration: -1,


         columnDefs: 
         [
               { className: "text-center", "targets": [0] },
               { className: "text-right",  "targets": [2] },
               { className: "text-center", "targets": [1] },
               { className: "text-center", "targets": [3] },
         ]

      });
   
   });

  
</script>
@endpush





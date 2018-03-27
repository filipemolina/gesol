@extends('layouts.material')

@section('titulo')
   Solicitações {{ mostraAcesso($funcionario_logado) }}
@endsection

@section('content')
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header card-header-icon" data-background-color="green" style="color: #fff;">
                  <i class="material-icons">assignment</i>
               </div>
               <div class="card-content">
                  <h4 class="card-title">Solicitações</h4>


                     <div class="nav-tabs-navigation">
                         <div class="nav-tabs-wrapper">
               
                           <ul class="nav nav-pills" role="tablist">
                              
                              <li class="nav-item active">
                                 <a href="#ativas" data-toggle="tab">Ativas</a>
                              </li>

                              <li class="nav-item">
                                 <a href="#solucionada" data-toggle="tab">Solucionadas</a>
                              </li>

                              <li class="nav-item">
                                 <a href="#nao-liberadas" data-toggle="tab">Aguardando Liberação</a>
                              </li>

                              <li class="nav-item">
                                 <a href="#recusadas" data-toggle="tab">Recusadas</a>
                              </li>

                           </ul>
                         </div>
                     </div>

         
                  <div class="material-datatables">
                     <div id="datatables_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="col-sm-13 ">
                           <div class="tab-content">
                              {{-- ATIVAS --}}
                              <div class="tab-pane active" id="ativas">
                                 <table id="tabela-solicitacoes-ativas" 
                                       class="table table-striped table-no-bordered table-hover dataTable dtr-inline" 
                                       cellspacing="0" width="100%" 
                                       role="grid" aria-describedby="datatables_info"
                                       style="width: 100%; font-size: 12px;" >
                                    <thead>
                                       <tr>
                                          <th>Foto</th>
                                          <th>Serviço</th>
                                          <th>Conteúdo</th>
                                          <th>Solicitante</th>
                                          <th>Status</th>
                                          <th>Abertura</th>
                                          <th>Prazo</th>
                                          <th>Ações</th>
                                       </tr>                           
                                    </thead>
                                    {{-- preenchido com datatables --}}               
                                 </table>
                              </div>

                              {{-- solucionada --}}
                              <div class="tab-pane" id="solucionada">
                                 <table id="tabela-solicitacoes-solucionada" 
                                       class="table table-striped table-no-bordered table-hover dataTable dtr-inline" 
                                       cellspacing="0" width="100%" 
                                       role="grid" aria-describedby="datatables_info"
                                       style="width: 100%; font-size: 12px;" >
                                    <thead>
                                       <tr>
                                          <th>Foto</th>
                                          <th>Serviço</th>
                                          <th>Conteúdo</th>
                                          <th>Solicitante</th>
                                          <th>Abertura</th>
                                          <th>Fechamento</th>                                          
                                          <th>Ações</th>
                                       </tr>                           
                                    </thead>
                                    {{-- preenchido com datatables --}}               
                                 </table>
                              </div>

                              {{-- NÃO LIBERADAS --}}
                              <div class="tab-pane " id="nao-liberadas">
                                 <table id="tabela-solicitacoes-nao-liberadas" 
                                       class="table table-striped table-no-bordered table-hover dataTable dtr-inline" 
                                       cellspacing="0" width="100%" 
                                       role="grid" aria-describedby="datatables_info"
                                       style="width: 100%; font-size: 12px;" >
                                    <thead>
                                       <tr>
                                          <th>Foto</th>
                                          <th>Serviço</th>
                                          <th>Conteúdo</th>
                                          <th>Solicitante</th>
                                          <th>Abertura</th>
                                          <th>Prazo</th>
                                          <th>Ações</th>
                                       </tr>                           
                                    </thead>
                                    {{-- preenchido com datatables --}}               
                                 </table>
                              </div>

                              {{-- RECUSADAS --}}
                              <div class="tab-pane " id="recusadas">
                                 <table id="tabela-solicitacoes-recusadas" 
                                       class="table table-striped table-no-bordered table-hover dataTable dtr-inline" 
                                       cellspacing="0" width="100%" 
                                       role="grid" aria-describedby="datatables_info"
                                       style="width: 100%; font-size: 12px;" >
                                    <thead>
                                       <tr>
                                          <th>Foto</th>
                                          <th>Serviço</th>
                                          <th>Conteúdo</th>
                                          <th>Solicitante</th>
                                          <th>Abertura</th>
                                          <th>Recusa</th>
                                          <th>Ações</th>
                                       </tr>                           
                                    </thead>
                                    {{-- preenchido com datatables --}}               
                                 </table>
                              </div>

                           </div>
                        </div>
                     </div>

                  </div>
                  <!-- end col-md-12 -->
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection


@push('scripts')

<script type="text/javascript">

   // Variáveis que guardam as referências para as tablas com o propósito de autalizá-las programaticamente
   let tabelas = [];

   $(function(){
      {{-- Testar se há algum erro, e mostrar a notificação --}}
      @if ($errors->any())
         @foreach ($errors->all() as $error)
            setTimeout(function(){demo.notificationRight("top", "right", "rose", "{{ $error }}"); }, tempo);
            tempo += incremento;
         @endforeach
      @endif
      
      //$.fn.dataTable.moment( 'DD/MM/YYYY' );

      $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
         $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
         } );


         tabelas.push($("#tabela-solicitacoes-ativas").DataTable({
            responsive : true,
            processing: true,
            serverSide: true,
            ajax      : "{{ url('/solicitacao/datatables/2') }}",
            columns   : [

               { data : 'foto',        name : 'foto' },
               { data : 'servico',     name : 'servico' },
               { data : 'conteudo',    name : 'conteudo' },
               { data : 'solicitante', name : 'solicitante' },
               { data : 'status',      name : 'status' },
               { data : 'abertura',    name : 'abertura' },
               { data : 'prazo',       name : 'prazo' },
               { data : 'acoes',       name : 'acoes' },
            ],

            order: [[ 5, 'asc' ]],
            
            language : 
            {
               "url":         "{{ asset('js/portugues.json') }}",
               "decimal":     ",",
               "thousands":   "."
            }, 

            stateSave: true,
            //stateDuration: -1,
            columnDefs: 
            [
               // { className:   "text-center", "targets": [0] },
               // { className:   "text-center", "targets": [1] },
               // { className:   "text-center", "targets": [3] },
               // { className:   "text-center", "targets": [4] },
               // { className:   "text-center", "targets": [5] },

               /*{ type:        "date-eu",     "targets": [5] },*/

               { width:       "5%",         "targets": [0] },
               { width:       "10%",         "targets": [1] },
               { width:       "10%",         "targets": [2] },
               { width:       "10%",         "targets": [3] },
               { width:       "5%",         "targets": [4] },
               { width:       "10%",         "targets": [5] },
               { width:       "10%",         "targets": [6] },
               { width:       "5%",         "targets": [7] },

            ],
      }));

      tabelas.push($("#tabela-solicitacoes-solucionada").DataTable({
         responsive : true,
         processing: true,
         serverSide: true, 
         ajax      : "{{ url('/solicitacao/datatables/3') }}",
         columns   : [

            { data : 'foto',        name : 'foto' },
            { data : 'servico',     name : 'servico' },
            { data : 'conteudo',    name : 'conteudo' },
            { data : 'solicitante', name : 'solicitante' },
            { data : 'abertura',    name : 'abertura' },
            { data : 'atualizacao', name : 'Fechamento' },            
            { data : 'acoes',       name : 'acoes' },
         ],

         order: [[ 4, 'asc' ]],
         
         language : 
         {
            "url":         "{{ asset('js/portugues.json') }}",
            "decimal":     ",",
            "thousands":   "."
         }, 

         stateSave: true,
         //stateDuration: -1,
         columnDefs: 
         [
            { width:       "40%",         "targets": [2] },
            { width:       "10%",         "targets": [1] }
         ]
      }));


      tabelas.push($("#tabela-solicitacoes-nao-liberadas").DataTable({
         responsive : true,
         processing: true,
         serverSide: true,
         ajax      : "{{ url('/solicitacao/datatables/0') }}",
         columns   : [

            { data : 'foto',        name : 'foto' },
            { data : 'servico',     name : 'servico' },
            { data : 'conteudo',    name : 'conteudo' },
            { data : 'solicitante', name : 'solicitante' },
            { data : 'abertura',    name : 'abertura' },
            { data : 'prazo',       name : 'prazo' },
            { data : 'acoes',       name : 'acoes' },
         ],

         order: [[ 4, 'asc' ]],
         
         language : 
         {
            "url":         "{{ asset('js/portugues.json') }}",
            "decimal":     ",",
            "thousands":   "."
         }, 

         stateSave: true,
         //stateDuration: -1,
         columnDefs: 
         [
            { className:   "text-center", "targets": [0] },
            { className:   "text-center", "targets": [1] },
            { className:   "text-center", "targets": [3] },
            { className:   "text-center", "targets": [4] },
            { width:       "10%",         "targets": [1] },
            { width:       "40%",         "targets": [2] },

         ]
      }));

      tabelas.push($("#tabela-solicitacoes-recusadas").DataTable({
         responsive : true,
         processing: true,
         serverSide: true,
         ajax      : "{{ url('/solicitacao/datatables/4') }}",
         columns   : [

            { data : 'foto',        name : 'foto' },
            { data : 'servico',     name : 'servico' },
            { data : 'conteudo',    name : 'conteudo' },
            { data : 'solicitante', name : 'solicitante' },
            { data : 'abertura',    name : 'abertura' },
            { data : 'atualizacao', name : 'atualizacao' },            
            { data : 'acoes',       name : 'acoes' },
         ],

         order: [[ 4, 'asc' ]],
         
         language : 
         {
            "url":         "{{ asset('js/portugues.json') }}",
            "decimal":     ",",
            "thousands":   "."
         }, 

         stateSave: true,
         //stateDuration: -1,
         columnDefs: 
         [
            { className:   "text-center", "targets": [0] },
            { className:   "text-center", "targets": [1] },
            { className:   "text-center", "targets": [3] },
            { className:   "text-center", "targets": [4] },
            { width:       "10%",         "targets": [1] },
            { width:       "40%",         "targets": [2] },

         ]
      }));


   });

  
</script>
@endpush





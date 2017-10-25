@extends('layouts.material')

@section('titulo')
{{-- Página Principal --}}
@endsection
{{-- 
@section('nome-funcionario')
   {{ $funcionario->nome }}
@endsection --}}

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
                                 <a href="#fechadas" data-toggle="tab">Fechadas</a>
                              </li>

                              <li class="nav-item">
                                 <a href="#nao-liberadas" data-toggle="tab">Aguardando Liberação</a>
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
                                          <th>Status</th>
                                          <th>Abertura</th>
                                          <th>Prazo</th>
                                          <th>Ações</th>
                                       </tr>                           
                                    </thead>
                                    {{-- preenchido com datatables --}}               
                                 </table>
                              </div>

                              {{-- FECHADAS --}}
                              <div class="tab-pane" id="fechadas">
                                 <table id="tabela-solicitacoes-fechadas" 
                                       class="table table-striped table-no-bordered table-hover dataTable dtr-inline" 
                                       cellspacing="0" width="100%" 
                                       role="grid" aria-describedby="datatables_info"
                                       style="width: 100%; font-size: 12px;" >
                                    <thead>
                                       <tr>
                                          <th>Foto</th>
                                          <th>Serviço</th>
                                          <th>Conteúdo</th>
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
                                          <th>Abertura</th>
                                          <th>Prazo</th>
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


      $("#tabela-solicitacoes-ativas").DataTable({
         responsive : true,
         processing: true,
         serverSide: true,
         ajax      : "{{ url('/solicitacao/datatables/2') }}",
         columns   : [

            { data : 'foto',        name : 'foto' },
            { data : 'servico',     name : 'servico' },
            { data : 'conteudo',    name : 'conteudo' },
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

         stateSave: false,
         stateDuration: -1,
         columnDefs: 
         [
            { className:   "text-center", "targets": [0] },
            { className:   "text-center", "targets": [1] },
            { className:   "text-center", "targets": [3] },
            { className:   "text-center", "targets": [4] },
            { className:   "text-center", "targets": [5] },

            /*{ type:        "date-eu",     "targets": [5] },*/

            { width:       "10%",         "targets": [1] },
            { width:       "40%",         "targets": [2] },
            { width:       "10%",         "targets": [4] },

         ],

         
      });

      $("#tabela-solicitacoes-fechadas").DataTable({
         responsive : true,
         processing: true,
         serverSide: true,
         ajax      : "{{ url('/solicitacao/datatables/3') }}",
         columns   : [

            { data : 'foto',       name : 'foto' },
            { data : 'servico',    name : 'servico' },
            { data : 'conteudo',   name : 'conteudo' },
            { data : 'abertura',   name : 'abertura' },
            { data : 'atualizacao',name : 'fechamento' },            
            { data : 'acoes',      name : 'acoes' },
         ],

         order: [[ 3, 'asc' ]],
         
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
            { className:   "text-center", "targets": [0] },
            { className:   "text-center", "targets": [1] },
            /*{ className: "text-center", "targets": [2] },*/
            { className:   "text-center", "targets": [3] },
            { className:   "text-center", "targets": [4] },
            { className:   "text-center", "targets": [5] },
            { width:       "40%",         "targets": [2] },
            { width:       "10%",         "targets": [1] }
         ]
      });


      $("#tabela-solicitacoes-nao-liberadas").DataTable({
         responsive : true,
         processing: true,
         serverSide: true,
         ajax      : "{{ url('/solicitacao/datatables/0') }}",
         columns   : [

            { data : 'foto',       name : 'foto' },
            { data : 'servico',    name : 'servico' },
            { data : 'conteudo',   name : 'conteudo' },
            { data : 'abertura',   name : 'abertura' },
            { data : 'prazo',      name : 'prazo' },
            { data : 'acoes',      name : 'acoes' },
         ],

         order: [[ 4, 'asc' ]],
         
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
            { className:   "text-center", "targets": [0] },
            { className:   "text-center", "targets": [1] },
            { className:   "text-center", "targets": [3] },
            { className:   "text-center", "targets": [4] },
            { width:       "10%",         "targets": [1] },
            { width:       "40%",         "targets": [2] },

         ]
      });


   });

  
</script>
@endpush





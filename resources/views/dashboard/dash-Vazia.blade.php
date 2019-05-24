@extends('layouts.material')

@section('titulo')

  Painel

@endsection

@section('content')

   
   
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-header-icon" data-background-color="orange" style="color: #fff;">
               <i class="material-icons">dashboard</i>
            </div>

            <div class="card-content-grafico">
               <h4 class="card-title-grafico" style="width: 100% !important;">Nenhuma solicitação registrada!</h4>
            </div>

            <div class="card-chart">
               <div class="card-header" id='sol_total' style="height:350px" ></div>
            </div>
         </div>
      </div>
   </div>

  

   
@endsection


@push('scripts')
   <script type="text/javascript">



     
    
   </script>
@endpush





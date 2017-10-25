@extends('layouts.material')

@section('titulo')
<!-- Página Principal -->
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
                  <i class="material-icons">dashboard</i>
               </div>
               <div class="card-content">
                  <h4 class="card-title">Painel</h4>
            </div>
         </div>
      </div>
   </div>
@endsection


@push('scripts')

   <script type="text/javascript">
  
   </script>
@endpush





@extends('layouts.material')

@section('titulo')

Novo Relatorio {{ mostraAcesso($funcionario_logado) }}

@endsection

@section('content')

<div class="card">
	
	<div class="card-header card-header-icon" data-background-color="dourado">
		<i class="material-icons">chat bubble</i>
	</div>

	<div class="card-content">
		<h4 class="card-title">Novo Relatorio</h4>
		<form action="{{ url('/semus ') }}" method="POST" id="form_relatorio">
			{{ csrf_field() }}
  

		</form>
	</div>
</div>
@endsection

@push('scripts')

@endpush
   
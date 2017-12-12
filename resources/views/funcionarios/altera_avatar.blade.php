@extends("layouts.material")

@section('titulo')

Alteraração de Avatar

@endsection

@section('content')

<div class="col-md-12 col-md-offset-0">

	<div class="card card-singup">
		<form class="form-horizontal" id="form_edit_avatar" method="post" action="{{ url("salvaavatar") }}">
				{!! method_field('PUT') !!}
				{{ csrf_field() }}

		
			
			 <!-- Ícone título  -->
			<div class="card-header card-header-icon" data-background-color="dourado">
				<i class="material-icons">person</i>
			</div>

			 <!-- Título  -->
			<div class="card-content">
				<h4 class="card-title no-padding">Alterar avatar</h4>
			</div>			
			
			<div class="row">
				 
				 <!-- avatar  -->
				<div class="col-md-1 no-padding">
					<div class="fileinput fileinput-new text-center" data-provides="fileinput">
             		<div class="fileinput-new thumbnail img-circle">
             			@if($usuario->avatar)
                 			<img src="{{ $usuario->avatar }}"/>
                 		@else
                 			<img src=" {{ asset ('img/placeholder.jpg') }} " alt="...">
                 		@endif
                	</div>
						
						<input name="avatar" type="text" value="" style="display:none;" />
	              	<div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                    	<div >
	                    	<span class="btn btn-round btn-dourado btn-file botoes-acao">
		                    	<span class="fileinput-new botoes-acao">		
		                    		<i class="fa fa-times"></i>	ADICIONAR 	
		                    	</span>
		                    	<span class="fileinput-exists botoes-acao ">	
		                    		<i class="fa fa-times"></i>	ALTERAR		
		                    	</span>
		                    	<input name="avatar1" type="file" value=" {{ $usuario->avatar  }} "/>
		                    	
	                    	</span>
								<br/>
	                    	<span class="btn btn-danger btn-round fileinput-exists botoes-acao" data-dismiss="fileinput">
	                    		<i class="fa fa-times"></i> REMOVER 
	                    	</span>
                    	</div>
						</div>
					</div>
				</div>  <!-- FIM ROW  -->

				<div class="footer text-center">
					<button type="submit" id="btn_salvar" class="botoes-acao btn btn-round btn-success ">
	               <span class="icone-botoes-acao mdi mdi-send"></span>
	               <span class="texto-botoes-acao"> SALVAR </span>
	               <div class="ripple-container"></div>
	            </button>

		        	<button id="btn_cancelar" class="botoes-acao btn btn-round btn-primary">
	               <span class="icone-botoes-acao mdi mdi-backburger"></span>   
	               <span class="texto-botoes-acao"> CANCELAR </span>
	               <div class="ripple-container"></div>
	            </button>
				</div>
			</form>
		</div>
	</div>
@endsection

@push('scripts')

	<script type="text/javascript">
		//para adicionar a avatar do funcionario
		$("body").on("change.bs.fileinput", function(e){ 
			console.log("alterou avatar");
			var base64 = $(".fileinput-preview img").attr('src');
			$("input[name=avatar]").val(base64);

	 	});

		$("#btn_cancelar").click(function(){
	      event.preventDefault();
	      window.location.href = "{{ URL::route('home') }}";
      });



		$("#btn_salvar").click(function(){
	      event.preventDefault();

	      swal({
	         title: 'Confirma alteração?',
	         type: 'question',
	         showCancelButton: true,
	         confirmButtonColor: '#3085d6',
	         cancelButtonColor: '#d33',
	         confirmButtonText: 'Sim',
	         cancelButtonText: 'Não',
	      }).then(function () {
	      	$("#form_edit_avatar").submit();
	         swal(
	            'Avatar alterado!',
	            '',
	            'success'
	            );
            });
      });
      
	</script>

@endpush

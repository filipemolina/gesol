<script>
$(function(){
	
	// Adicionar efeito de rotação ao ícone do objeto

	$('.rodar_icone')
	.mouseover(function(){
		$(this).find('i').addClass('animated girar')
	})
	.mouseout(function(){
		$(this).find('i').removeClass('animated girar')
	});
});
</script>
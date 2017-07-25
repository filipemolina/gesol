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

	// Trocar o tipo de acesso

	$('.troca-login-municipe').click(function(){
			$('#login-municipe').fadeOut(1000)
			$('#login-servidor').fadeIn(3000)
			$('body').removeClass('fundo_roxo').addClass('fundo_dourado')
	
	});

	$('.troca-login-servidor').click(function(){
			$('#login-servidor').fadeOut(3000)
			$('#login-municipe').fadeIn(1000)
			$('body').removeClass('fundo_dourado').addClass('fundo_roxo')

	});

});
</script>
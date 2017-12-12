<script>
   $().ready(function() {
      demo.checkFullPageBackgroundImage();

      setTimeout(function() {
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
             }, 700)

      <?php if($errors->any()): ?>
         console.log('erro');
         <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            demo.notificationRight("top", "right", "rose", "<?php echo e($error); ?>");     
            demo.initFormExtendedDatetimepickers();
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
   
      demo.initFormExtendedDatetimepickers();
   });

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
			$('body').removeClass('fundo_roxo').addClass('fundo_dourado')
			$('.navbar-header a.btn-roxo').addClass('animated fadeOutUp').fadeOut()
			$('.navbar-header a.btn-dourado').removeClass('hide fadeOutUp').addClass('animated fadeInDown').fadeIn()
			$('.navbar-collapse a.btn-roxo').addClass('animated fadeOutUp').removeClass('fadeInDown')
			$('#login-municipe').removeClass('animated fadeInDown').addClass('animated fadeOutUp').fadeOut()
			$(function e() { setTimeout(function(){$('#login-servidor').fadeIn().addClass('animated fadeInDown').removeClass('fadeOutUp')}, 1000) })
		
		});

		$('.troca-login-servidor').click(function(){
			$('body').removeClass('fundo_dourado').addClass('fundo_roxo')
			$('.navbar-header a.btn-dourado').addClass('animated fadeOutUp').fadeOut()
			$('.navbar-header a.btn-roxo').removeClass('hide fadeOutUp').addClass('animated fadeInDown').fadeIn()
			$('.navbar-collapse a.btn-roxo').addClass('animated fadeInDown').removeClass('fadeOutUp')
			$('#login-servidor').removeClass('animated fadeInDown').addClass('animated fadeOutUp').fadeOut()
			$(function e() { setTimeout(function(){$('#login-municipe').fadeIn().addClass('animated fadeInDown').removeClass('fadeOutUp')}, 1000) })
		
		});

});
</script>
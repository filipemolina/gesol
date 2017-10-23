$(function(){
 VMasker ($("#cpf")).maskPattern("999.999.999-99");

});

function enviarComentario(elem, e){

	console.log("entrou enviarComentario ID: ", $(elem).data('solicitacao') );
   // Executar essa função apenas se a tecla pressionada for o Enter ou caso nenhuma tecla tenha
   // sido pressionada (click)

   if(e.keyCode == "13" || typeof e.keyCode === 'undefined'){

      let solicitacao = $(elem).data('solicitacao');
      let funcionario = $(elem).data('funcionario');

      var comentario = $(".comentario_"+solicitacao).val().trim();

      // Testar se a comentario está em branco
      if( $(".comentario_"+solicitacao).val().trim() ) 
      {

         // Enviar a comentario para o banco
         $.post(
            url_base+"/comentario",
            {
               comentario: 		comentario,
               solicitacao_id: 	solicitacao, 
               funcionario_id: 	funcionario,
               _token: token,
            }, function(resposta)
               {

                  let dados = JSON.parse(resposta);

                  // Apagar o campo de envio de comentario
                  $(".comentario_"+solicitacao).val("");

                  // Colocar o novo card de comentarios embaixo da solicitação
                  var source      = $("#comentario-template").html();
                  var template    = Handlebars.compile(source)

                  var context = { 
                     data_criacao: 			dados.data,
                     nome_funcionario:  	dados.nome_funcionario,
                     nome_setor:   			dados.nome_setor,
                     sigla: 					    dados.sigla, 
                     comentario: 			  dados.comentario, 
                  };

                  var html        = template(context);

                  $("div.comentarios").append( $(html) );

                  //posiciona a div "scrolavel" para o final
                  var objDiv = document.getElementById("div-comentarios");
                  objDiv.scrollTo(0, objDiv.scrollHeight);
            }      
            ).fail(function(erro){
               demo.notificationRight("top", "right", "rose", "Sessão do usuário expirada. Você será redirecionado a tela de Login em alguns segundos!"); 
               setTimeout(function(){window.location.reload()}, 10000);
         });
      }
   }
}



function comentarioAutomatico(sol, fun, com){

   console.log("entrou comentarioAutomatico ID: ");

   let solicitacao   = sol;
   let funcionario   = fun;
   let comentario    = com;

   // Enviar a comentario para o banco
   $.post(
      url_base+"/comentario",
      {
         comentario:       comentario,
         solicitacao_id:   solicitacao, 
         funcionario_id:   funcionario,
         _token:           token
      }
   );      
  
}

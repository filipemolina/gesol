// Initialize Firebase
var config = {
  apiKey: "AIzaSyAf8fw2qFhvj8IBucvbtYiA_9Odrwqb_-8",
  authDomain: "mesquita-360.firebaseapp.com",
  databaseURL: "https://mesquita-360.firebaseio.com",
  projectId: "mesquita-360",
  storageBucket: "mesquita-360.appspot.com",
  messagingSenderId: "22259915167"
};
firebase.initializeApp(config);

const messaging  = firebase.messaging();

// Tenta obter permissão e retorna uma promise
messaging.requestPermission()
.then(() => {
	// Permissão obtida, retorna outra promise com a token do navegador
	return messaging.getToken();
})
.then((token) => {

	// Obter os dados do navegador

	let navegador = detectaNavegador();

	//Gravar a token no Banco de dados

	$.ajax({
		url: "https://gesol.mesquita.rj.gov.br/api/tokens",
		method: "POST",
		headers: {
			'Accept'       : 'application/json',
			'Authorization': 'Bearer ' + tokenGesol
		},
		data: {
			'token'      : token,
			'navegador'  : navegador.nome,
			'versao'     : navegador.versao,
			'plataforma' : navegador.plataforma,
			'user_id'    : user_id // Variável definida em layouts/material.blade.php
		},
		success: (data, status, jqXHR) => {
			console.log("Retorno da gravação de token no banco de dados", data);
		}
	});

	console.log("Token desse navegador", token);
})
.catch(() => {
	console.log("Permissão Negadona");
	$("#btn-permissao").css("display", 'block');
});

///////////////////////////////////////////////////////////////////////////////
// Função que é executada quando uma mensagem é recebida e a página está aberta
///////////////////////////////////////////////////////////////////////////////

messaging.onMessage(function(payload){

	let url = window.location.href;
	
	// Testar os dados recebidos pela notificação
	if(payload.data.acao == "atualizar" || payload.data.operacao == "atualizar"){

		// Fazer o reload das tabelas automaticamente

		if(typeof(tabelas) !== 'undefined'){

			for(i = 0; i < tabelas.length; i++){

				tabelas[i].ajax.reload();

			}

		}

		// Atualizar o ícone das notificações

		if(payload.data.model == "comentario" && !url.includes(payload.data.solicitacao)){

			atualizarNotificacao();

		}

		if(url.includes('solicitacao') && url.includes('edit') && url.includes(payload.data.solicitacao)){
			
			// Obter os dados do comentário que acabou de chegar

			$.get("https://gesol.mesquita.rj.gov.br/comentario/" + payload.data.comentario_id, function(data){

				let comentario = JSON.parse(data);
				let solicitacao = comentario.solicitacao.id;

				incluirComentario(solicitacao, comentario);

			});

		}

	}

});

///////////////////////////////////////////////////////////////////////////////
// Função que é executada quando uma mensagem é recebida e a página está aberta
///////////////////////////////////////////////////////////////////////////////

$(function(){

	// Botão para ativar notificaçoes caso o funcionário tenha negado da primeira vez

	$("#btn-permissao").click(function(){

		console.log("Chamou o botão");

		// Retorna uma Promise
		messaging.requestPermission()
		.then(() => {
			return messaging.getToken();
		})
		.then((token) => {

			// Obter os dados do navegador

			let navegador = detectaNavegador();

			//Gravar a token no Banco de dados

			$.ajax({
				url: "https://360.mesquita.rj.gov.br/gesol/api/tokens",
				method: "POST",
				headers: {
					'Accept'       : 'application/json',
					'Authorization': 'Bearer ' + tokenGesol
				},
				data: {
					'token'      : token,
					'navegador'  : navegador.nome,
					'versao'     : navegador.versao,
					'plataforma' : navegador.plataforma,
					'user_id'    : user_id // Variável definida em layouts/material.blade.php
				},
				success: (data, status, jqXHR) => {
					console.log("Retorno da gravação de token no banco de dados", data);
				}
			});
			
			console.log("Token desse navegador", token);
			$(this).css("display", "none");
		})
		.catch(() => {
			console.log("Permissão Negada");
		});

	});

});

function atualizarNotificacao(){

	// Mostrar o número correto de notificações

    $.post("https://gesol.mesquita.rj.gov.br/naolidas/" + setor_id, { _token: token }, function(data){
      
      let dados = JSON.parse(data);

      // Atualizar o número de notificaçoes

      if(dados.qtd){
      	$("span.notification").remove();
        $("<span class='notification'>"+dados.qtd+"</span>").insertAfter('#icone-notificacoes');
      }

      // Atualizar a lista de notificações

      $("#lista-notificacoes li").remove()

      for(i=0; i < dados.links.length; i++){

        $("#lista-notificacoes").append(dados.links[i]);

      }

    });
}
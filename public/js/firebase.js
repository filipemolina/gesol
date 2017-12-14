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

// Tenta obter permissão e eretorna uma promise
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
})
.catch(() => {
	console.log("Permissão Negada");
	$("#btn-permissao").css("display", block);
});

// FUnção que é executada quando uma mensagem é recebida e a página está aberta

messaging.onMessage((payload) => {
	console.log("onMessage: ", payload);
});

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
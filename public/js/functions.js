//////////////////////////// Variáveis

// Existem algumas variáveis que estão sendo definidas no template layouts/material.blade.php
// Sâo elas:
// id_usuario
// foto_usuario
// nome_usuario
// url_base
// token

let tempo = 0;
let incremento = 500;

///////////////////////////// Funções Principais

// Mostra o mapa

function mostraMapa(latitude,longitude,solicitacao) {
   //console.log(latitude, longitude);
   if ($("#LocalMapa_"+solicitacao).css('height') == "0px")
   {
      $("#LocalMapa_"+solicitacao).css('height', "300px"); 

      // Esperar 200ms para executar o mapa (o tempo que o mapa demora para abrir)

      setTimeout(function(){

         var mapProp = {center:new google.maps.LatLng(latitude, longitude),zoom:18};
         var map     = new google.maps.Map(document.getElementById('LocalMapa_'+solicitacao),mapProp);

         let marker = new google.maps.Marker({
            map: map,
            animation: google.maps.Animation.DROP,
            position: map.getCenter()
         });

      },200);

   }else{
      $("#LocalMapa_"+solicitacao).css('height',"0");
   }
}

////////////////////////////////////// Funções para o mapa de seleção de localidade na tela de criação de solicitação


function initAutocomplete() {
  
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -22.782946, lng: -43.431588},
    zoom: 14,
    mapTypeId: 'roadmap'
  });

  // Create the search box and link it to the UI element.
  var input = document.getElementById('pac-input');
  var searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });

  var markers = [];
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      if (!place.geometry) {
        console.log("Returned place contains no geometry");
        return;
      }
      var icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      markers.push(new google.maps.Marker({
        map: map,
        icon: icon,
        title: place.name,
        position: place.geometry.location
      }));

      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
     map.fitBounds(bounds);
  });
}

// Botão de Enviar Comentário

function enviarComentario(elem, e){

   // Executar essa função apenas se a tecla pressionada for o Enter ou caso nenhuma tecla tenha
   // sido pressionada (click)

   if(e.keyCode == "13" || typeof e.keyCode === 'undefined'){

      let solicitacao = $(elem).data('solicitacao');
      let solicitante = $(elem).data('solicitante');

      var comentario = $(".comentario_"+solicitacao).val().trim();

      // Testar se a comentario está em branco
      if( $(".comentario_"+solicitacao).val().trim() ) {

          // Enviar a comentario para o banco
          $.post(
           url_base+"/comentario",
           {
            comentario: comentario,
            solicitacao_id: solicitacao, 
            _token: token,
         }, function(data){

              // Apagar o campo de envio de comentario
              $(".comentario_"+solicitacao).val("");

              // Colocar o novo card de comentarios embaixo da solicitação
              var source      = $("#comentario-template").html();
              var template    = Handlebars.compile(source)

              var context = {
		            nome_funcionario: dados.nome_funcionario,
                nome_setor:       dados.nome_setor,
                sigla:            dados.sigla,
                comentario:       dados.comentario,
                data_criacao:     dados.data_criacao,
              };


              var html        = template(context);

              $("div.comentarios").append( $(html) );

        });

       }

    }

 }

 // Enviar apoio

 function enviaApoio(solicitacao, solicitante){ 
   console.log("enviou " +solicitacao +" - " +solicitante);

   $.post(
      url_base+"/apoiar",
      {
         solicitante_id: solicitante,
         solicitacao_id: solicitacao, 
         _token: token,
      }, function(data){      

         $("span.numero_apoios_"+solicitacao).html(data);

         if(data > 0)
         {
            $(".btn_apoios_"+solicitacao).addClass('apoiar');
         }
         else
         {  
            $(".btn_apoios_"+solicitacao).removeClass('apoiar');
         }

         // Testar se o botão de apoiar dessa solicitação possui uma span com a classe apoiado
         // o que indica se o usuário já apoiou essa solicitação ou não

         let span = "button.btn-apoiar.solicitacao_"+solicitacao+" span.texto_apoio";

         if($(span).hasClass('apoiado')){

            // Caso já tenha apoiado
            $(span).removeClass('apoiado').html('Apoiar');

         } else {

            // Caso contrário
            $(span).addClass('apoiado').html('Apoiado');
         }
      }       
      );
};

// Não está sendo usada agora, será utilizada quando as páginas da pesquisa forem carregadas via AJAX

function montaCartoes(solicitacoes){

   $("div.infinite-scroll").empty();

   // TODO: Mostrar imagem de loading

   let token = token;
   
   $.post(url_base+"/batchsolicitacoes", { _token: token, solicitacoes: solicitacoes }, function(data){

      data = JSON.parse(data);

      // Colocar o novo card de comentarios embaixo da solicitação
      var source      = $("#cartao-template").html();
      var template    = Handlebars.compile(source)

      for(let i =0; i < data.length; i++){

         var context = { 
            nome:  data[i].solicitante.nome,
            texto: data[i].conteudo, 
            foto:  data[i].foto
         };

         var html = template(context);

         $("div.infinite-scroll").append( $(html) );

      }

      // TODO: Apagar imagem de Loading

   });

}

// Sweet Alert
var helper = {

    // Como usuar no html:
    // helper.showSwal1('tipo', 'titulo')
    // helper.showSwal2('tipo', 'texto1', 'texto2','texto1Sucesso', 'texto2Sucesso', 'funcaoSucesso')
    
    showSwal1: function(tipo, texto1) {
        
        if(tipo == 'basico'){
            swal({
                title: texto1,
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-roxo'
            });
        } else if (tipo == 'info') {
            swal({
                type: 'info',
                title: texto1,
                buttonsStyling: false,
                confirmButtonClass: "btn btn-info"
            });
        } else if (tipo == 'aviso') {
            swal({
                type: 'warning',
                title: texto1,
                input: 'text',
                buttonsStyling: false,
                showCancelButton: true,
                cancelButtonClass: 'btn btn-roxo',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Alterar',
                confirmButtonClass: 'btn btn-danger'
            });
        } else if (tipo == "erro") {

            swal("Atenção", texto1, 'error');

        }


    }, //Fim showSwal1

    

}; //Fim Helper

//////////////////////////////////////////////////////////////////////////////////////// GESOL

function trocaTexto(elemento, novo_texto) // javascript
{

  // obtain the object reference for the textarea>
  var txtarea = document.getElementById(elemento);
  // console.log("Elemento", txtarea);
  // obtain the index of the first selected character
  var start = document.getSelection().anchorOffset;
  // console.log("Início", start);
  // obtain the index of the last selected character
  var finish = document.getSelection().focusOffset;
  // console.log("Finício", finish);
  //obtain all Text
  var allText = txtarea.innerHTML;
  // console.log("Todo Texto", allText);

  //append te text;
  var newText=allText.substring(0, start)+novo_texto+allText.substring(finish, allText.length);
  // console.log("Novo texto", newText);

  txtarea.innerHTML=newText;
}

// Carrega select de setor na página de edição de funcionário
function carrega_select_setor_edit(secretaria_id, setor_id){

    $.get('/setor?secretaria='+secretaria_id, function(res){

    let resposta = JSON.parse(res);

    $("#setor_id option").remove();

    $("<option value=''>Selecione</option>").appendTo("#setor_id");

    // Iterar por todos os setores para incluí-los no supra-citado "select"

    for(i=0; i<resposta.length; i++){
      
      
        if( setor_id == resposta[i].id ){
            $("<option value='"+resposta[i].id+"' selected='true'>"+resposta[i].nome+"</option>").appendTo("#setor_id");
        }else{
          $("<option value='"+resposta[i].id+"'>"+resposta[i].nome+"</option>").appendTo("#setor_id");
        }
      }

      // Atualizar o Bootstrap Select

      $("#setor_id").selectpicker('refresh');
    });
}

// Carrega select de setor na página de edição de funcionário
function carrega_select_setor_create(secretaria_id, setor_id){

  $.get(url_base+'/setor?secretaria='+secretaria_id, function(res){

    let resposta = JSON.parse(res);
    console.log(resposta);     

    $("#setor_id option").remove();

    $("<option value=''>Selecione</option>").appendTo("#setor_id");

    // Iterar por todos os setores para incluí-los no supra-citado "select"
   for(i=0; i<resposta.length; i++){
        $("<option value='"+resposta[i].id+"'>"+resposta[i].nome+"</option>").appendTo("#setor_id");
    }
    // Atualizar o Bootstrap Select
    $("#setor_id").selectpicker('refresh');
  });
}


// Detectar o navegador sendo usado
function detectaNavegador(){
  var nVer = navigator.appVersion;
  var nAgt = navigator.userAgent;
  var browserName  = navigator.appName;
  var fullVersion  = ''+parseFloat(navigator.appVersion); 
  var majorVersion = parseInt(navigator.appVersion,10);
  var nameOffset,verOffset,ix;

  // In Opera 15+, the true version is after "OPR/" 
  if ((verOffset=nAgt.indexOf("OPR/"))!=-1) {
   browserName = "Opera";
   fullVersion = nAgt.substring(verOffset+4);
  }
  // In older Opera, the true version is after "Opera" or after "Version"
  else if ((verOffset=nAgt.indexOf("Opera"))!=-1) {
   browserName = "Opera";
   fullVersion = nAgt.substring(verOffset+6);
   if ((verOffset=nAgt.indexOf("Version"))!=-1) 
     fullVersion = nAgt.substring(verOffset+8);
  }
  // In MSIE, the true version is after "MSIE" in userAgent
  else if ((verOffset=nAgt.indexOf("MSIE"))!=-1) {
   browserName = "Microsoft Internet Explorer";
   fullVersion = nAgt.substring(verOffset+5);
  }
  // In Chrome, the true version is after "Chrome" 
  else if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {
   browserName = "Chrome";
   fullVersion = nAgt.substring(verOffset+7);
  }
  // In Safari, the true version is after "Safari" or after "Version" 
  else if ((verOffset=nAgt.indexOf("Safari"))!=-1) {
   browserName = "Safari";
   fullVersion = nAgt.substring(verOffset+7);
   if ((verOffset=nAgt.indexOf("Version"))!=-1) 
     fullVersion = nAgt.substring(verOffset+8);
  }
  // In Firefox, the true version is after "Firefox" 
  else if ((verOffset=nAgt.indexOf("Firefox"))!=-1) {
   browserName = "Firefox";
   fullVersion = nAgt.substring(verOffset+8);
  }
  // In most other browsers, "name/version" is at the end of userAgent 
  else if ( (nameOffset=nAgt.lastIndexOf(' ')+1) < 
            (verOffset=nAgt.lastIndexOf('/')) ) 
  {
   browserName = nAgt.substring(nameOffset,verOffset);
   fullVersion = nAgt.substring(verOffset+1);
   if (browserName.toLowerCase()==browserName.toUpperCase()) {
    browserName = navigator.appName;
   }
  }
  // trim the fullVersion string at semicolon/space if present
  if ((ix=fullVersion.indexOf(";"))!=-1)
     fullVersion=fullVersion.substring(0,ix);
  if ((ix=fullVersion.indexOf(" "))!=-1)
     fullVersion=fullVersion.substring(0,ix);

  majorVersion = parseInt(''+fullVersion,10);
  if (isNaN(majorVersion)) {
   fullVersion  = ''+parseFloat(navigator.appVersion); 
   majorVersion = parseInt(navigator.appVersion,10);
  }

  return {
    nome : browserName,
    versao: majorVersion,
    plataforma: navigator.platform,
  };
}


// Função que atualiza os dados de um gráfico que for criado usando Echarts
function atualizaGrafico(grafico, legendas, series){

  // console.log("CHamou a função atualizaGrafico");
  // console.log(grafico, legendas, series);

  grafico.setOption({

    series:{
        data: series,
    },
    legend: {
      data: legendas
    },
    xAxis : {
      type : 'category',
      data : legendas,
    },
         
  });

// Inclui um comentário enviando pelo solicitante na tela de edição da solicitação
// para que possa ser visualizado em tempo real pelo funcionário

function incluirComentario(solicitacao, comentario){

  console.log("Chamou a função de incluir comentario");

  $(".comentario_"+solicitacao).val("");

  // Colocar o novo card de comentarios embaixo da solicitação
  var source      = $("#comentario-template-solicitante").html();
  var template    = Handlebars.compile(source)

  var context = { 
     data_criacao : comentario.created_at,
     comentario   : comentario.comentario,
     nome         : comentario.solicitacao.solicitante.nome
  };

  console.log("COntexto chamado no template", context);

  var html        = template(context);

  $("div.comentarios").append( $(html) );

  //posiciona a div "scrolavel" para o final
  var objDiv = document.getElementById("div-comentarios");
  objDiv.scrollTop = objDiv.scrollHeight;

}
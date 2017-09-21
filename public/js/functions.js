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
                     nome:       nome_usuario,
                     comentario: comentario, 
                     foto:       foto_usuario,
                     id:         data,
                     token:      token,
                  };

                  var html        = template(context);

                  $("div.comentarios").append( $(html) );
                  //console.log(html);   

               }       
               );
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
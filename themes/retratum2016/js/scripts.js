// Quando a janela carrega, retira o GIF da página
$(window).load(function () {
    $(".loader").fadeOut("slow");
});


//OWN SLIDE (Carrousel) - THEMES
$(document).ready(function() {
 
  $("#owl-themes").owlCarousel({
  autoPlay: 5000000, //Set AutoPlay to 3 seconds
  items : 3,
  itemsDesktop : [1199,3],
  itemsDesktopSmall : [990,2],
  itemsTablet: [766, 1],
  itemsMobile : [479, 1],
  pagination: true
 
  });
 
});


//OWN SLIDE (Carrousel) - DEPOIMENTOS
$(document).ready(function () {
   $("#owl-depo").owlCarousel({
        //Autoplay
        stopOnHover: true,
        autoPlay: 4000, //Set AutoPlay to 3 seconds
        items : 1,
        itemsDesktop : [1199, 1],
        itemsDesktopSmall : [979, 1],
        itemsTablet: [768, 1],
        itemsMobile : [479, 1],
        pagination: false
    });
 });

//SCROLL NAV ONEPAGE

//jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 95
        }, 1000, 'easeInOutExpo');
        event.preventDefault();   
    });
});



// SCROLL UP
jQuery( document ).ready( function ( $ ) {
  var $window = $( window );
  // Scroll up
  var $scrollup = $( '.scrollup' );

  $window.scroll( function () {
    if ( $window.scrollTop() > 800 ) {
      $scrollup.addClass( 'show' );
    } else {
      $scrollup.removeClass( 'show' );
    }
  } );

  $scrollup.on( 'click', function ( evt ) {
    $( "html, body" ).animate( { scrollTop: 0 }, 800, 'easeInOutExpo');
    evt.preventDefault();
  } );
} );





// HOVER CAPTION: EFEITO AO PASSAR O MOUSE NAS IMAGENS DE PORTFOLIO
$(window).load(function () {
  $('[data-toggle=drop-panel]').hcaptions();
});


//COUNTER ANIMATION STATS
function getBaseLog(x, y) {
      return Math.log(y) / Math.log(x);
}
$('.data-counter').each(function() {
    var data_counter = $(this);
    data_counter.waypoint(function() {
        var value = data_counter.data('value');
        data_counter.find('.count').countTo({
            from: 0,
            to: value,
            speed: 1500 +  getBaseLog(10, value) * 300,
            refreshInterval: 10
        });
        this.destroy();
    }, {
        offset: 'bottom-in-view'
    });
});


//PLANS & PRICES

$(".standard-anual").addClass('novisible');
$(".premium-anual").addClass('novisible');
$(".ultimate-anual").addClass('novisible');

$( "#standard" ).change(function() {
    $( "select option:selected" ).each(function() {
        var optionVal = $(this).val();
        if (optionVal == 'standard-mensal') {
            $( ".standard-anual" ).addClass('novisible');
            $( ".standard-mensal" ).removeClass('novisible');
            $( ".standard-mensal" ).addClass('visible');
            $('a.j_linkStandard').attr('href', window.location.protocol + "//" + window.location.host + '/contrate/&p_id=1');

        } else if (optionVal == 'standard-anual') {
            $( ".standard-mensal" ).addClass('novisible');
            $( ".standard-anual" ).removeClass('novisible');
            $( ".standard-anual" ).addClass('visible');
            $('a.j_linkStandard').attr('href', window.location.protocol + "//" + window.location.host + '/contrate/&p_id=2');
        }
    });
}).change();

$( "#premium" ).change(function() {
    $( "select option:selected" ).each(function() {
        var optionVal = $(this).val();
        if (optionVal == 'premium-mensal') {
            $( ".premium-anual" ).addClass('novisible');
            $( ".premium-mensal" ).removeClass('novisible');
            $( ".premium-mensal" ).addClass('visible');
            $('a.j_linkPremium').attr('href', window.location.protocol + "//" + window.location.host + '/contrate/&p_id=3');

        } else if (optionVal == 'premium-anual') {
            $( ".premium-mensal" ).addClass('novisible');
            $( ".premium-anual" ).removeClass('novisible');
            $( ".premium-anual" ).addClass('visible');
            $('a.j_linkPremium').attr('href', window.location.protocol + "//" + window.location.host + '/contrate/&p_id=4');

        }
    });
}).change();

$( "#ultimate" ).change(function() {
    $( "select option:selected" ).each(function() {
        var optionVal = $(this).val();
        if (optionVal == 'ultimate-mensal') {
            $( ".ultimate-anual" ).addClass('novisible');
            $( ".ultimate-mensal" ).removeClass('novisible');
            $( ".ultimate-mensal" ).addClass('visible');
            $('a.j_linkUltimate').attr('href', window.location.protocol + "//" + window.location.host + '/contrate/&p_id=5');


        } else if (optionVal == 'ultimate-anual') {
            $( ".ultimate-mensal" ).addClass('novisible');
            $( ".ultimate-anual" ).removeClass('novisible');
            $( ".ultimate-anual" ).addClass('visible');
            $('a.j_linkUltimate').attr('href', window.location.protocol + "//" + window.location.host + '/contrate/&p_id=6');

        }
    });
}).change();


//REVOLUTION SLIDER
var revapi;

jQuery(document).ready(function() {

       revapi = jQuery('.tp-banner').revolution(
        {
            delay:9000,
            startwidth:1170,
            startheight:650,
            hideThumbs:10,
            fullWidth:"on",
            forceFullWidth:"on"
        });

}); //ready



//form contrate
$(function() {

    $('#no-domain').click(function() {
        $('#digite-domain').css('display', 'none');

    });

    $('#has-domain').click(function() {
        $('#digite-domain').fadeIn();
    });

});


// ALTERA A IMAGEM DO LAYOUT AO TROCAR O SELECT
function displayVals() {
    var nomeLayout = $( "#layout-escolhido option:selected" ).text();
    var pathimg = $("#imagem-layout").attr("path-img"); // pega o path da imagem
    $("#imagem-layout").attr("src", window.location.protocol + "//" + window.location.host + pathimg + nomeLayout + ".png"); // insere o src lá no html
}
$( "#layout-escolhido" ).change( displayVals ); // ao troca a Escolha do layout executa a função.
displayVals(); // já carrega a função


 $('#form-cadastro').validate({
        rules: {
            user_fullname: "required",
            user_email: "required",
            user_ddd: "required",
            user_telefone: "required",
            user_cpf_cnpj: "required",
            user_endereco: "required",
            end_numero: "required",
            end_bairro: "required",
            cep: "required",
            end_cidade: "required",
            end_estado: "required",
            user_username: "required",
            como_conheceu: "required",
            termos: "required"
        },
        messages: {
            user_fullname: "Por favor digite seu nome ou Razão Social",
            user_email: "Por favor digite seu email principal",
            user_ddd: "Você esqueceu o DDD",
            user_telefone: "Digite seu telefone ou celular",
            user_cpf_cnpj: "Digite seu CPF ou CNPJ da empresa",
            user_endereco: "Digite seu endereço",
            end_numero: "Digite o número",
            end_bairro: "Você esqueceu do bairro",
            cep: "Digite o CEP",
            end_cidade: "Digite a cidade",
            end_estado: "Qual estado?",
            user_username: "Este campo é obrigatório",
            como_conheceu: "Conte-nos como conheceu a Retratum.com!",
            termos: "É necessário concordar com os Termos de Serviço e condições de uso para contratar nossos serviços!",
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });

// CHANGE SUBMIT INPUT BUTTON STATE - LOADING
$('#myBtn').button();
$('#myBtn').on('click', function () {
    var $btn = $(this).button('loading');
    setTimeout(function() {
        $btn.button('reset');
    }, 1000);
});
// Quando a janela carrega, retira o GIF da página
$(window).load(function () {
	$(".loader").fadeOut("slow");
});

//SLIDE DA HOME (DEVRAMA SLIDER)  
$(document).ready(function () {
    $('#my-slide').DrSlider({
		width: undefined,
		height: undefined,
		userCSS: true,
		transitionSpeed: 1000,
		duration: 4000,
		showNavigation: false,
		classNavigation: undefined,
		showControl: true,
		classButtonNext: undefined,
		classButtonPrevious: undefined,
		positionControl: 'left-right',
		transition: 'fade',
		showProgress: true,
		pauseOnHover: true,
		onReady: undefined
    });
});

//Carrega o OWN SLIDE (Carrousel) - lastjobs
$(document).ready(function() {
 
  $("#owl-lastJobs").owlCarousel({
    autoPlay: 3000, //Set AutoPlay to 3 seconds
    items : 3,
    itemsDesktop : [1199,3],
    itemsDesktopSmall : [979,3],
    itemsTablet: [768, 2],
    pagination: true
 
  });
 
});

//Carrega o OWN SLIDE (Carrousel) - DEPOIMENTOS
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


// FACEBOOK LIKE BOX
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5&appId=124057441026006";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));    


//Carrega o Portfolio e Filtro
$(function () {
  var filterList = {
    init: function () {
    
      // MixItUp plugin
      // http://mixitup.io
      $('#portfoliolist').mixitup({
        targetSelector: '.portfolio',
        filterSelector: '.filter',
        effects: ['fade'],
        easing: 'snap',
        // call the hover effect
        onMixEnd: filterList.hoverEffect()
      });       
    
    },
    
    hoverEffect: function () {
    
      // Simple parallax effect
      $('.portfolio').hover(
        function () {
          $(this).find('.label').stop().animate({bottom: 0}, 200, 'easeOutQuad');
          $(this).find('img').stop().animate({top: -30}, 500, 'easeOutQuad');       
        },
        function () {
          $(this).find('.label').stop().animate({bottom: -100}, 200, 'easeInQuad');
          $(this).find('img').stop().animate({top: 0}, 300, 'easeOutQuad');               
        }   
      );        
    
    }

  };
  
  // Run the show!
  filterList.init();
  
});   


// Datepicker
$('.datepicker').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR",
    autoclose: true
});


// LOVE IT - Cadastro no banco.
$('.mask').on('click','.j_likeitbtn', function () {

  img_id      = this.getAttribute("img-id");
  album_id    = this.getAttribute("album-id");
  base_url    = this.getAttribute("url-base");
  user_ip     = this.getAttribute("user-ip");
  cliente_id  = this.getAttribute("cliente-id");

  /* troco a classe do botão e o texto */
  $(this).removeClass('btn-curtir').addClass('btn-curtido');
  $(this).html('<i class="fa fa-heart"> Você curtiu');

  $.ajax({  
    type: 'POST',
    data: {loveit_img_id:img_id, loveit_album_id:album_id, loveit_cliente_id:cliente_id, loveit_user_ip: user_ip},

    url: base_url + "/clientes/data/ajax-likebtn.php",  
    success: function(data) {
      console.log(data);
    } 
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
    $( "html, body" ).animate( { scrollTop: 0 }, 600 );
    evt.preventDefault();
  } );
} );


// HOVER CAPTION: EFEITO AO PASSAR O MOUSE NAS IMAGENS DE PORTFOLIO

$(window).load(function () {
  $('[data-toggle=drop-panel]').hcaptions();
});


//Envia email do form de contato por AJAX
$('.j_formsubmit').submit(function () {
        var form = $(this);
        var data = $(this).serialize();
        var base = $(this).attr('root-path');

         $.ajax({
            url: base + '/inc/ajax.inc.php',
            data: data,
            type: 'POST',
            beforeSend: function () {
                form.find('.form_load').fadeIn(500);          
            },
            success: function (resposta) {
                if (resposta.error) {
                    form.find('.msg-retorno').fadeIn();
                    form.find('.msg-retorno').html(resposta.error);
                } else {
                    form.find('.msg-retorno').fadeIn();
                    form.find('.msg-retorno').html(resposta);
   
                    //Limpa campos após envio!
                    $(':input','.j_formsubmit')
                      .not(':button, :submit, :reset, :hidden')
                      .val('')
                      .removeAttr('checked')
                      .removeAttr('selected');  

                    //fecha modal
                    setTimeout( function() {
                        $('#modalMessage').modal('hide');
                    }, 5000);        
                }
                form.find('.form_load').fadeOut(500);
            }
        });
        return false;
    });

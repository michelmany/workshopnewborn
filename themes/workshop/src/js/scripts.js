// Quando a janela carrega, retira o GIF da página
$(window).load(function () {
	$(".loader").fadeOut("slow");
});


//Carrega o OWN SLIDE (Carrousel) - VIDEOS
$(document).ready(function() {
 
  $(".carousel-videos").owlCarousel({
    autoPlay: 3000, //Set AutoPlay to 3 seconds
    items : 3,
    itemsDesktop : [1199,3],
    itemsDesktopSmall : [979,3],
    itemsTablet: [768, 2],
    itemsMobile : [479, 1],    
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

//Carrega o OWN SLIDE (Carrousel) - Parceiros
$(document).ready(function () {
   $(".carousel-parceiros").owlCarousel({
    //Autoplay
    stopOnHover: true,
    autoPlay: 3000, //Set AutoPlay to 3 seconds
    items : 2,
    itemsDesktop : [1199, 2],
    itemsDesktopSmall : [979, 4],
    itemsTablet: [768, 3],
    itemsMobile : [479, 2],
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
      // http://mixitup-old.kunkalabs.com/
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
          // $(this).find('img').stop().animate({top: -30}, 500, 'easeOutQuad');       
        },
        function () {
          $(this).find('.label').stop().animate({bottom: -100}, 200, 'easeInQuad');
          // $(this).find('img').stop().animate({top: 0}, 300, 'easeOutQuad');               
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

  /* troco a classe do botão e o texto */
  $(this).removeClass('btn-curtir').addClass('btn-curtido');
  $(this).html('<i class="fa fa-heart"> Você curtiu');

  $.ajax({  
    type: 'POST',
    data: {loveit_img_id:img_id, loveit_album_id:album_id, loveit_user_ip: user_ip},

    url: base_url + "/admin/data/ajax-likebtn.php",  
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


//Drew configs
;(function( $ ) {
    "use strict";

    $( document ).on( 'ready', function() {

        var $window = $( window ),
            $body = $( 'body' ),
            $document = $( document ),
            drew = {
                headerFloatingHeight : 60,
            };

        /**
         * =======================================
         * Function: Detect Mobile Device
         * =======================================
         */
        // source: http://www.abeautifulsite.net/detecting-mobile-devices-with-javascript/
        var isMobile = {
            Android: function() {
                return navigator.userAgent.match( /Android/i );
            },
            BlackBerry: function() {
                return navigator.userAgent.match( /BlackBerry/i );
            },
            iOS: function() {
                return navigator.userAgent.match( /iPhone|iPad|iPod/i );
            },
            Opera: function() {
                return navigator.userAgent.match( /Opera Mini/i );
            },
            Windows: function() {
                return navigator.userAgent.match( /IEMobile/i );
            },
            any: function() {
                return ( isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows() );
            },
        };

        /**
         * =======================================
         * Function: Resize Background
         * =======================================
         */
        var resizeBackground = function() {

            $( '.section-background-video > video, .section-background-image > img, .two-cols-description-image > img' ).each(function( i, el ) {

                var $el       = $( el ),
                    $section  = $el.parent(),
                    min_w     = 300,
                    el_w      = el.tagName == 'VIDEO' ? el.videoWidth : el.naturalWidth,
                    el_h      = el.tagName == 'VIDEO' ? el.videoHeight : el.naturalHeight,
                    section_w = $section.outerWidth(),
                    section_h = $section.outerHeight(),
                    scale_w   = section_w / el_w,
                    scale_h   = section_h / el_h,
                    scale     = scale_w > scale_h ? scale_w : scale_h,
                    new_el_w, new_el_h, offet_top, offet_left;

                if ( scale * el_w < min_w ) {
                    scale = min_w / el_w;
                };

                new_el_w = scale * el_w;
                new_el_h = scale * el_h;
                offet_left = ( new_el_w - section_w ) / 2 * -1;
                offet_top  = ( new_el_h - section_h ) / 2 * -1;

                $el.css( 'width', new_el_w );
                $el.css( 'height', new_el_h );
                $el.css( 'marginTop', offet_top );
                $el.css( 'marginLeft', offet_left );
            });

        };
        $body.on( 'pageStart', function() {
            resizeBackground();
        });

        /**
         * =======================================
         * IE9 Placeholder
         * =======================================
         */
        $( 'form' ).on( 'submit', function() {
            $( this ).find( '[placeholder]' ).each(function() {
                var $input = $( this );
                if ( $input.val() == $input.attr( 'placeholder' ) ) {
                    $input.val( '' );
                };
            });
        });

        $( '[placeholder]' ).on( 'focus', function() {
            var $input = $( this );
            if ( $input.val() == $input.attr( 'placeholder' ) ) {
                $input.val( '' );
                $input.removeClass( 'placeholder' );
            };
        }).on( 'blur', function() {
            var $input = $( this );
            if ( $input.val() == '' || $input.val() == $input.attr( 'placeholder' ) ) {
                $input.addClass( 'placeholder' );
                $input.val( $input.attr( 'placeholder' ) );
            };
        }).blur();

        /**
         * =======================================
         * Detect Mobile Device
         * =======================================
         */
        if ( isMobile.any() ) {
            // add identifier class to <body>
            $body.addClass( 'mobile-device' );
            // remove all element with class "remove-on-mobile-device"
            $( '.remove-on-mobile-device' ).remove();
        };

        /* =======================================
         * Resize Video Background
         * =======================================
         */
        $window.on( 'resize', function() {
            resizeBackground();
        });

        /* =======================================
         * Slideshow Background
         * =======================================
         */
        if ( $.fn.responsiveSlides ) {
            $body.on( 'pageStart', function() {
                $( '.section-background-slideshow' ).responsiveSlides({
                    speed : $( this ).data( 'speed' ) ? $( this ).data( 'speed' ) : 800,
                    timeout : $( this ).data( 'timeout' ) ? $( this ).data( 'timeout' ) : 4000,
                });
            });
        };

        /* =======================================
         * Testimonial Slider
         * =======================================
         */
        if ( $.fn.responsiveSlides ) {
            $body.on( 'pageStart', function() {
                $( '.testimonial-slider' ).responsiveSlides({
                    speed : $( this ).data( 'speed' ) ? $( this ).data( 'speed' ) : 800,
                    timeout : $( this ).data( 'timeout' ) ? $( this ).data( 'timeout' ) : 4000,
                    auto : $( this ).data( 'auto' ) ? $( this ).data( 'auto' ) : false,
                    pager : true,
                });
            });
        };

        /* =======================================
         * Hero Slider
         * =======================================
         */
        if ( $.fn.responsiveSlides ) {
            $body.on( 'pageStart', function() {
                $( '.section-slider' ).responsiveSlides({
                    speed : $( this ).data( 'speed' ) ? $( this ).data( 'speed' ) : 800,
                    timeout : $( this ).data( 'timeout' ) ? $( this ).data( 'timeout' ) : 4000,
                    auto : $( this ).data( 'auto' ) ? $( this ).data( 'auto' ) : true,
                    nav : true,
                });
            });
        };

        /* =======================================
         * Video Embed Async Load
         * =======================================
         */
        $body.on( 'pageStart', function() {
            $( '.video-async' ).each( function( i, el ) {
                var $el = $( el ),
                    source = $el.data( 'source' ),
                    video = $el.data( 'video' ),
                    color = $el.data( 'color' );

                if ( source == 'vimeo' ) {
                    $el.attr( 'src', '//player.vimeo.com/video/' + video + ( color ? '?color=' + color : '' ) );
                } else if ( source == 'youtube' ) {
                    $el.attr( 'src', '//www.youtube.com/embed/' + video + '?rel=0' );
                }

            });
        });
        
        /**
         * =======================================
         * Initiate Stellar JS
         * =======================================
         */
        if ( $.fn.stellar && ! isMobile.any() ) {
            $.stellar({
                responsive: true,
                horizontalScrolling: false,
                hideDistantElements: false,
                verticalOffset: 0,
                horizontalOffset: 0,
            });
        };

        /**
         * =======================================
         * Numbers (Counter Up)
         * =======================================
         */
        if ( $.fn.counterUp ) {
            $( '.counter-up' ).counterUp({
                time: 1000,
            });
        };

        /**
         * =======================================
         * Scroll Spy
         * =======================================
         */
        var toggleHeaderFloating = function() {
            // Floating Header
            if ( $window.scrollTop() > 80 ) {
                $( '.header-section' ).addClass( 'floating' );
            } else {
                $( '.header-section' ).removeClass( 'floating' );
            };
        };

        $window.on( 'scroll', toggleHeaderFloating );

        /**
         * =======================================
         * One Page Navigation
         * =======================================
         */
        if ( $.fn.onePageNav ) {
            $( '#header-nav' ).onePageNav({
                scrollSpeed : 1000,
                filter : ':not(.external)',
                begin : function() {
                    $( '#navigation' ).collapse( 'toggle' );
                },
            });
        };

        /**
         * =======================================
         * Animations
         * =======================================
         */
        if ( $body.hasClass( 'enable-animations' ) && ! isMobile.any() ) {
            var $elements = $( '*[data-animation]' );

            $elements.each( function( i, el ) {

                var $el = $( el ),
                    animationClass = $el.data( 'animation' );

                $el.addClass( animationClass );
                $el.addClass( 'animated' );
                $el.addClass( 'wait-animation' );

                $el.one( 'inview', function() {
                    $el.removeClass( 'wait-animation' );
                    $el.addClass( 'done-animation' );
                });
            });
        };

        /**
         * =======================================
         * Anchor Link
         * =======================================
         */
        $body.on( 'click', 'a.anchor-link', function( e ) {
            e.preventDefault();

            var $a = $( this ),
                $target = $( $a.attr( 'href' ) );

            if ( $target.length < 1 ) return;

            $( 'html, body' ).animate({ scrollTop: Math.max( 0, $target.offset().top - drew.headerFloatingHeight ) }, 1000 );
        });

        /**
         * =======================================
         * Google Maps
         * =======================================
         */
        if ( typeof Maplace == 'function' && $( '#gmap' ) ) {
            new Maplace( gmap_options ).Load();
        };

        /**
         * =======================================
         * Countdown
         * =======================================
         */
        if ( $.fn.countdown ) {
            $( '.countdown' ).each( function( i, el ) {
                var $el = $ ( el ),
                    date = $el.data( 'countdown' ),
                    format = $el.html();

                $el.countdown( date, function( e ) {
                    $( el ).html( e.strftime( format ) );
                });
                $el.show();
            });
        };

        /**
         * =======================================
         * Form AJAX
         * =======================================
         */
        $( 'form' ).each( function( i, el ) {

            var $el = $( this );

            if ( $el.hasClass( 'form-ajax-submit' ) ) {

                $el.on( 'submit', function( e ) {
                    e.preventDefault();

                    var $alert = $el.find( '.form-validation' ),
                        $submit = $el.find( 'button' ),
                        action = $el.attr( 'action' );

                    // button loading
                    $submit.button( 'loading' );

                    // reset alert
                    $alert.removeClass( 'alert-danger alert-success' );
                    $alert.html( '' );

                    $.ajax({
                        type     : 'POST',
                        url      : action,
                        data     : $el.serialize() + '&ajax=1',
                        dataType : 'JSON',
                        success  : function( response ) {

                            // custom callback
                            $el.trigger( 'form-ajax-response', response );
                            
                            // error
                            if ( response.error ) {
                                $alert.html( response.message );
                                $alert.addClass( 'alert-danger' ).fadeIn( 500 );
                            }
                            // success
                            else {
                                $el.trigger( 'reset' );
                                $alert.html( response.message );
                                $alert.addClass( 'alert-success' ).fadeIn( 500 );
                            }

                            // reset button
                            $submit.button( 'reset' );
                        },
                    })
                });
            };
        });

        /* =======================================
         * Preloader
         * =======================================
         */
        if ( $.fn.jpreLoader && $body.hasClass( 'enable-preloader' ) ) {

            $body.on( 'pageStart', function() {
                $body.addClass( 'done-preloader' );
            });

            $body.jpreLoader({
                showSplash : false,
                // autoClose : false,
            }, function() {
                $body.trigger( 'pageStart' );
            });

        } else {
            $body.trigger( 'pageStart' );
        };

        $window.trigger( 'resize' );
        $window.trigger( 'scroll' );

    });

})( jQuery );

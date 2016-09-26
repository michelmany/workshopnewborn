<?php
$View = new View;
$sliderhome = $View->Load('sliderhome');
$depoimentohome = $View->Load('depoimentohome');
$albunshome = $View->Load('albunshome');
$post = new Read;
?>

<div class="loader"></div>

<!-- HERO
  ================================= -->
  <section id="hero" class="hero-section hero-layout-simple hero-fullscreen hero-slider">

    <ul class="section-slider parallax">

        <?php 
        $post->ExeRead("nit_slider", "WHERE slider_status = 1 ORDER BY slider_order ASC LIMIT :limit", "limit=5");
        if ($post->getResult()):
            foreach ($post->getResult() as $slide):
                $View->Show($slide, $sliderhome);
            endforeach;
        else:
            echo '<div class="container text-center mt80">';
                WSErro('Você ainda não publicou nenhum Banner! O que está esperando?', WS_INFOR);
            echo '</div>';            
        endif;
        ?>      

    </ul>

  </section>

<section id="sobre" class="section-default section-sobre">
    <div class="container">
        <div class="title-section">
            <h3 class="title"><?php echo $user_name = (isset($user_name) && !empty($user_name) ? $user_name : 'Seu nome aqui'); ?></h3>
            <div class="tracinho"></div>
        </div>

        <div class="textSobre">
        <?php if (isset($user_about) && !empty($user_about)): ?>
            <?php echo htmlspecialchars_decode($user_about); ?>
            <button type="button" class="btn btn-custom-brand mt10" data-toggle="modal" data-target="#modalMessage">Convide Viviane Teodoro para um evento.</button>
        <?php else: ?>
            <p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.</p>
        <?php endif; ?>     
        </div>      
        
        <div class="col-sm-6">
            <!-- Video Youtube -->
            <div class="video-container mt50">
                <iframe width="900" height="506" src="https://www.youtube.com/embed/eJsf1vNCSJo?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="foto-container">
            <?php if (isset($user_foto) && !empty($user_foto)): ?>
                <img src="<?= BASE ?>/tim.php?src=uploads/<?php echo $user_foto; ?>&w=800&h=800&q=90" class="foto img-responsive img-circle center-block">
            <?php endif; ?>        
            </div>
        </div>

        <div class="clearfix"></div>
        <div>
            <a href="http://www.vivianeteodorofotografia.com.br" target="_blank" class="btn btn-custom-brand mt60">Saiba mais</a>       
        </div>
        <div class="btn-scroll">
            <a href="#workshops" class="page-scroll page-scroll-down grey"><i class="fa fa-angle-down" aria-hidden="true"></i></a> 
        </div>
    </div>
</section>

<section id="workshops" class="section-default section-workshops">
    <div class="container">
        <div class="title-section">
            <h3 class="title">Cursos</h3>
            <div class="tracinho"></div>
        </div>
        <?php #Traz os albuns do banco.
        $post->ExeRead("nit_workshops", "ORDER BY workshop_id DESC LIMIT :limit", "limit=3");
        if (!$post->getResult()):
            echo '<div class="container text-center">';
                WSErro('Você ainda não fez nenhuma postagem no Blog!', WS_INFOR);  
            echo '</div>';
        else:
        ?>

        <?php if ( $post->getRowCount() == 1 ): ?>
            <?php foreach ($post->getResult() as $posts): extract($posts); ?>
            <div class="col-xs-12">
                <div class="section-workshops-item">
                    <img src="<?php echo BASE; ?>/tim.php?src=uploads/<?php echo $workshop_capa; ?>&w=380&h=253&q=90" class="img-responsive" alt="Capa do Post">
                    <div class="section-workshops-item-content">
                        <div class="section-workshops-title mb20">
                            <a href="<?php echo HOME; ?>/workshop/<?php echo $workshop_url; ?>" class="text-title"><h5><?php echo Check::Words($workshop_nome, 9); ?></h5></a>
                        </div>
                        <p><?php echo Check::Words($workshop_msg, 20); ?></p>
                        <a href="<?= HOME ?>/workshop/<?php echo $workshop_url; ?>" class="btn btn-custom-rosa mt20">saiba mais</a>
                    </div>           
                </div>
            </div>
            <?php endforeach; ?>   
        <?php endif; ?>

        <?php if ( $post->getRowCount() == 2 ): ?>
            <?php foreach ($post->getResult() as $posts): extract($posts); ?>
            <div class="col-xs-12 col-sm-6">
                <div class="section-workshops-item">
                    <img src="<?php echo BASE; ?>/tim.php?src=uploads/<?php echo $workshop_capa; ?>&w=380&h=253&q=90" class="img-responsive" alt="Capa do Post">
                    <div class="section-workshops-item-content">
                        <div class="section-workshops-title mb20">
                            <a href="<?php echo HOME; ?>/workshop/<?php echo $workshop_url; ?>" class="text-title"><h5><?php echo Check::Words($workshop_nome, 9); ?></h5></a>
                        </div>
                        <p><?php echo Check::Words($workshop_msg, 20); ?></p>
                        <a href="<?= HOME ?>/workshop/<?php echo $workshop_url; ?>" class="btn btn-custom-rosa mt20">saiba mais</a>
                    </div>           
                </div>
            </div>
            <?php endforeach; ?>   
        <?php endif; ?>             

        <?php if ( $post->getRowCount() == 3 ): ?>
            <?php foreach ($post->getResult() as $posts): extract($posts); ?>
            <div class="col-sm-12 col-md-4">
                <div class="section-workshops-item">
                    <img src="<?php echo BASE; ?>/tim.php?src=uploads/<?php echo $workshop_capa; ?>&w=380&h=253&q=90" class="img-responsive" alt="Capa do Post">
                    <div class="section-workshops-item-content">
                        <div class="section-workshops-title mb20">
                            <a href="<?php echo HOME; ?>/workshop/<?php echo $workshop_url; ?>" class="text-title"><h5><?php echo Check::Words($workshop_nome, 9); ?></h5></a>
                        </div>
                        <p><?php echo Check::Words($workshop_msg, 20); ?></p>
                        <a href="<?= HOME ?>/workshop/<?php echo $workshop_url; ?>" class="btn btn-custom-rosa mt20">saiba mais</a>
                    </div>           
                </div>
            </div>
            <?php endforeach; ?>   
        <?php endif; ?>  

        <?php endif; ?> 

        <div class="clearfix"></div>

        <div class="btn-scroll">
            <a href="#lastjobs" class="page-scroll page-scroll-down white"><i class="fa fa-angle-down" aria-hidden="true"></i></a> 
        </div>
    </div>
</section>

<section id="lastjobs" class="section-default section-lastjobs">
    <div class="title-section">
        <h3 class="title">Galeria</h3>
        <div class="tracinho"></div>
    </div>
    <?php #Traz os albuns do banco.
    $post->ExeRead("nit_albuns", "WHERE album_status = 1 ORDER BY album_data DESC LIMIT :limit", "limit=8");
    if (!$post->getResult()):
        echo '<div class="container text-center">';
            WSErro('Você ainda não publicou nenhuma imagem na galeria!', WS_INFOR);  
        echo '</div>';
    else:
    ?>
    <div id="owl-lastJobs">
        <?php foreach ($post->getResult() as $album): ?>
            <?php $album['album_likes'] = Check::QtdImgLikes($album['album_id']); ?>
            <?php $View->Show($album, $albunshome); ?>
        <?php endforeach; ?>   
    </div>
    <?php endif; ?>  
    <div class="clearfix"></div>
    <a href="<?= HOME ?>/portfolios/" class="btn btn-custom-brand mt60">Ver últimos cursos</a>

    <div class="btn-scroll">
        <a href="#blog" class="page-scroll page-scroll-down brand"><i class="fa fa-angle-down" aria-hidden="true"></i></a> 
    </div>
</section>

<style>
/*! Lity - v2.0.0 - 2016-09-09
* http://sorgalla.com/lity/
* Copyright (c) 2015-2016 Jan Sorgalla; Licensed MIT */
.lity {
  z-index: 9990;
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  white-space: nowrap;
  background: #0b0b0b;
  background: rgba(0, 0, 0, 0.9);
  outline: none !important;
  opacity: 0;
  -webkit-transition: opacity 0.3s ease;
  -o-transition: opacity 0.3s ease;
  transition: opacity 0.3s ease;
}
.lity.lity-opened {
  opacity: 1;
}
.lity.lity-closed {
  opacity: 0;
}
.lity * {
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
}
.lity-wrap {
  z-index: 9990;
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  text-align: center;
  outline: none !important;
}
.lity-wrap:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -0.25em;
}
.lity-loader {
  z-index: 9991;
  color: #fff;
  position: absolute;
  top: 50%;
  margin-top: -0.8em;
  width: 100%;
  text-align: center;
  font-size: 14px;
  font-family: Arial, Helvetica, sans-serif;
  opacity: 0;
  -webkit-transition: opacity 0.3s ease;
  -o-transition: opacity 0.3s ease;
  transition: opacity 0.3s ease;
}
.lity-loading .lity-loader {
  opacity: 1;
}
.lity-container {
  z-index: 9992;
  position: relative;
  text-align: left;
  vertical-align: middle;
  display: inline-block;
  white-space: normal;
  max-width: 100%;
  max-height: 100%;
  outline: none !important;
}
.lity-content {
  z-index: 9993;
  width: 100%;
  -webkit-transform: scale(1);
      -ms-transform: scale(1);
       -o-transform: scale(1);
          transform: scale(1);
  -webkit-transition: -webkit-transform 0.3s ease;
  transition: -webkit-transform 0.3s ease;
  -o-transition: -o-transform 0.3s ease;
  transition: transform 0.3s ease;
  transition: transform 0.3s ease, -webkit-transform 0.3s ease, -o-transform 0.3s ease;
}
.lity-loading .lity-content,
.lity-closed .lity-content {
  -webkit-transform: scale(0.8);
      -ms-transform: scale(0.8);
       -o-transform: scale(0.8);
          transform: scale(0.8);
}
.lity-content:after {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  display: block;
  right: 0;
  width: auto;
  height: auto;
  z-index: -1;
  -webkit-box-shadow: 0 0 8px rgba(0, 0, 0, 0.6);
          box-shadow: 0 0 8px rgba(0, 0, 0, 0.6);
}
.lity-close {
  z-index: 9994;
  width: 35px;
  height: 35px;
  position: fixed;
  right: 0;
  top: 0;
  -webkit-appearance: none;
  cursor: pointer;
  text-decoration: none;
  text-align: center;
  padding: 0;
  color: #fff;
  font-style: normal;
  font-size: 35px;
  font-family: Arial, Baskerville, monospace;
  line-height: 35px;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.6);
  border: 0;
  background: none;
  outline: none;
  -webkit-box-shadow: none;
          box-shadow: none;
}
.lity-close::-moz-focus-inner {
  border: 0;
  padding: 0;
}
.lity-close:hover,
.lity-close:focus,
.lity-close:active,
.lity-close:visited {
  text-decoration: none;
  text-align: center;
  padding: 0;
  color: #fff;
  font-style: normal;
  font-size: 35px;
  font-family: Arial, Baskerville, monospace;
  line-height: 35px;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.6);
  border: 0;
  background: none;
  outline: none;
  -webkit-box-shadow: none;
          box-shadow: none;
}
.lity-close:active {
  top: 1px;
}
/* Image */
.lity-image img {
  max-width: 100%;
  display: block;
  line-height: 0;
  border: 0;
}
/* iFrame */
.lity-iframe .lity-container,
.lity-youtube .lity-container,
.lity-vimeo .lity-container,
.lity-googlemaps .lity-container {
  width: 100%;
  max-width: 964px;
}
.lity-iframe-container {
  width: 100%;
  height: 0;
  padding-top: 56.25%;
  overflow: auto;
  pointer-events: auto;
  -webkit-transform: translateZ(0);
          transform: translateZ(0);
  -webkit-overflow-scrolling: touch;
}
.lity-iframe-container iframe {
  position: absolute;
  display: block;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  -webkit-box-shadow: 0 0 8px rgba(0, 0, 0, 0.6);
          box-shadow: 0 0 8px rgba(0, 0, 0, 0.6);
  background: #000;
}
.lity-hide {
  display: none;
}    
</style>
<section id="videos" class="section-default section-videos">
<div class="container">
    <div class="title-section">
        <h3 class="title">Videos</h3>
        <div class="tracinho"></div>
    </div>
    <?php #Traz os albuns do banco.
    $post->ExeRead("nit_albuns", "WHERE album_status = 1 ORDER BY album_data DESC LIMIT :limit", "limit=8");
    if (!$post->getResult()):
        echo '<div class="container text-center">';
            WSErro('Você ainda não publicou nenhum trabalho!', WS_INFOR);  
        echo '</div>';
    else:
    ?>
    <div class="carousel-videos">
        <?php foreach ($post->getResult() as $album): extract($album);?>
            <?php $album['album_likes'] = Check::QtdImgLikes($album['album_id']); ?>


                <div class="item">
                    <div class="portfolio-wrapper"> 
                        <a href="//www.youtube.com/watch?v=XSGBVzeBUbk" data-lity><img src="<?= BASE ?>/tim.php?src=uploads/<?= $album_capa ?>&w=635&h=422&q=90" class="img-responsive" alt="Capa do Album"></a>
                    </div>          
                </div>


        <?php endforeach; ?>
    </div>
    <?php endif; ?>  
</div>
</section>

<?php #Só mostra a Seção de depoimento se houver Depoimento no Banco.
$post->ExeRead("nit_depoimentos", "ORDER BY depo_id DESC LIMIT :limit", "limit=6");
if ($post->getResult()):
?>
<section id="depoimentos" class="section-default section-depoimentos">
    <div class="title-section">
        <h3 class="title">Depoimentos</h3>
        <div class="tracinho"></div>
    </div>
    <div id="owl-depo" class="container">
        <?php 
            foreach ($post->getResult() as $depoimento):
                $View->Show($depoimento, $depoimentohome);
            endforeach;
        ?>
    </div>
</section>
<?php endif; ?>  
<?php
$View = new View;
$sliderhome = $View->Load('sliderhome');
$albunshome = $View->Load('albunshome');
$post = new Read;
?>


<!-- HERO
  ================================= -->
  <section id="hero" class="hero-section hero-layout-simple hero-slider">

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

<section id="portfolio" class="content">
    <div class="title-section internas rosa text-center">
        <h3 class="title">Galerias</h3>
        <div class="tracinho"></div>
    </div>

    <div class="mt70">
        <?php #Traz os albuns do banco.
        $post->ExeRead("nit_albuns", "WHERE album_status = 1 ORDER BY album_data DESC");
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
    </div>

    <div class="clearfix"></div>

</section>
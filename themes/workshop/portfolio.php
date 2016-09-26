<?php 
if ($Link->getData()):
    extract($Link->getData());
else:
    header('Location: ' . HOME . DIRECTORY_SEPARATOR . '404');
endif;
?>  

<?php
$View = new View;
$sliderhome = $View->Load('sliderhome');
$post = new Read;
?>

<!-- HERO
  ================================= -->
  <section id="hero" class="hero-section hero-layout-simple  hero-slider">

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

    <section id="portfolio-single" class="content">
        <div class="title-section internas text-center">
            <h3 class="title">Portfolio</h3>
            <div class="tracinho"></div>
        </div>

        <div class="container portfolioPageSingle">

             <div id="row">
                <div class="col-md-5">
                    <h6><?php echo Check::CatById($album_categoria_id); ?></h6>
                    <h3><?php echo $album_nome; ?></h3>
                    <p><?php echo $album_local; ?> - <?php echo date('d/m/Y', strtotime($album_data)); ?></p>
                    <div class="stats">
                        <span class="views"><i class="fa fa-eye" title="Visualizações"></i> <?php echo $album_views; ?></span>
                        <span class="views"><i class="fa fa-heart" title="Curtidas"></i> <?= Check::QtdImgLikes($album_id); ?></span>
                        <span class="comments"><i class="fa fa-comment" title"Comentários"></i> <span class="fb-comments-count" data-href="<?= HOME ?>/portfolio/<?= $album_url; ?>"></span></span>     
                    </div>  
                </div>
                <div class="col-md-7">
                    <div id="myInnerContainer" class="mt20">
                        <?php echo $album_desc;  ?>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <hr>

            <div class="col-lg-12"> 

            <?php # Traz as imagens do album correspondente.
            $readImages  = new Read;
            $readImages->ExeRead("nit_albuns_imgs", "WHERE album_id = :album_id ORDER BY gallery_order ASC", "album_id={$album_id}");
            ?>

            <?php if($readImages->getResult()): ?>
                <?php foreach($readImages->getResult() as $ImageAlbum): ?>
                    <?php extract($ImageAlbum); ?>
                    <div class="view view-first">
                        <img src="<?= BASE ?>/uploads/<?php echo $gallery_image; ?>">
                        <div class="mask"><br><br>
                            <h4 style="color:#fff;"><?php echo $album_nome; ?></h4>

                            <?php #Le no banco pra ver se imagem já foi curtida
                            $readLoveit = new Read;
                            $readLoveit->ExeRead('nit_loveit', "WHERE loveit_img_id = :imgid AND loveit_user_ip = :userip", "imgid={$gallery_id}&userip={$_SERVER['REMOTE_ADDR']}");
                            ?>

                            <?php if ($readLoveit->getResult()): #Se já foi curtido, mostra esse botão.?>
                                <a class="btn btn-default btn-curtido"><i class="fa fa-heart"></i> Você curtiu</a> 
                            <?php else: # Se não, mostra o botão de curtir! ?>
                                <a class="btn btn-default j_likeitbtn btn-curtir" 
                                    url-base="<?= BASE ?>" 
                                    cliente-id="<?= $UserID ?>" 
                                    img-id="<?= $gallery_id; ?>" 
                                    album-id="<?= $album_id ?>"
                                    user-ip="<?= $_SERVER['REMOTE_ADDR'] ?>">
                                    <i class="fa fa-heart-o"></i>
                                    Curtir foto
                                </a>    
                            <?php endif; ?>                         

                            <a class="btn btn-primary" onclick="return !window.open(this.href, 'Facebook', 'width=640,height=300')" href="https://www.facebook.com/sharer/sharer.php?u=<?= HOME ?>/portfolio/<?= $album_url; ?>" target="_blank"  rel="nofollow"><i class="fa fa-facebook-official"></i> Compartilhar</a>
                        </div>              
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            
            </div>

            <div class="col-lg-12">
                <div class="fb-comments" data-href="<?= HOME ?>/portfolio/<?= $album_url; ?>"  data-width="100%" data-numposts="5"></div>
            </div>
        </div>
    </section>

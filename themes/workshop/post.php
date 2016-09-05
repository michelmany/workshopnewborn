<?php 
if ($Link->getData()):
    extract($Link->getData());
else:
    header('Location: ' . HOME . DIRECTORY_SEPARATOR . '404');
endif;
?>  

    <section id="portfolio-single" class="content">
        <div class="title-section internas text-center">
            <p><?php echo date('d/m/Y', strtotime($post_data)); ?></p>            
            <h3 class="title"><?php echo $post_nome; ?></h3>
            <div class="tracinho"></div>
            <h6><?php echo Check::CatById($post_categoria_id); ?></h6>
        </div>

        <div class="container portfolioPageSingle text-center">

             <div id="row">
                <div class="col-xs-12">
                    <div class="stats">
                        <span class="views"><i class="fa fa-eye" title="Visualizações"></i> <?php echo $post_views; ?></span>
                        <span class="comments"><i class="fa fa-comment" title"Comentários"></i> <span class="fb-comments-count" data-href="<?= HOME ?>/portfolio/<?= $post_url; ?>"></span></span>     
                    </div>  
                </div>
                <div class="col-xs-12">
                    <div id="myInnerContainer" class="mt20">
                        <?php echo $post_desc;  ?>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <hr>

            <div class="col-xs-12 reset-indent"> 

            <?php # Traz as imagens do post correspondente.
            $readImages  = new Read;
            $readImages->ExeRead("nit_posts_imgs", "WHERE post_id = :post_id ORDER BY gallery_order ASC", "post_id={$post_id}");
            ?>

            <?php if($readImages->getResult()): ?>
                <?php foreach($readImages->getResult() as $ImageAlbum): ?>
                    <?php extract($ImageAlbum); ?>
                    <div class="view view-first">
                        <img src="<?= BASE ?>/uploads/<?php echo $gallery_image; ?>">
                        <div class="mask"><br><br>
                            <h4 style="color:#fff;"><?php echo $post_nome; ?></h4><br>               

                            <a class="btn btn-primary" onclick="return !window.open(this.href, 'Facebook', 'width=640,height=300')" href="https://www.facebook.com/sharer/sharer.php?u=<?= HOME ?>/posts/<?= $post_url; ?>" target="_blank"  rel="nofollow"><i class="fa fa-facebook-official"></i> Compartilhar</a>
                        </div>              
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            
            </div>

            <div class="col-lg-12">
                <div class="fb-comments" data-href="<?= HOME ?>/posts/<?= $post_url; ?>"  data-width="100%" data-numposts="5"></div>
            </div>
        </div>
    </section>

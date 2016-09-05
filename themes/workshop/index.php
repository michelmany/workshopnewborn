<?php
$View = new View;
$sliderhome = $View->Load('sliderhome');
$depoimentohome = $View->Load('depoimentohome');
$albunshome = $View->Load('albunshome');
$post = new Read;
?>

<div class="loader"></div>

<section class="slider">
    <?php 
    $post->ExeRead("nit_slider", "WHERE slider_status = 1 ORDER BY slider_order ASC LIMIT :limit", "limit=5");
    if ($post->getResult()):
        echo '<div id="my-slide">';
        foreach ($post->getResult() as $slide):
            $View->Show($slide, $sliderhome);
        endforeach;
        echo '</div>';
    else:
        echo '<div class="container text-center mt80">';
            WSErro('Você ainda não publicou nenhum Banner! O que está esperando?', WS_INFOR);
        echo '</div>';            
    endif;
    ?>  

</section>

<section id="sobre" class="sobre text-center">
    <div class="container">
        <div class="title-section">
            <h3 class="title"><?php echo $user_name = (isset($user_name) && !empty($user_name) ? $user_name : 'Seu nome aqui'); ?></h3>
            <div class="tracinho"></div>
        </div>

        <div class="textSobre">
        <?php if (isset($user_about) && !empty($user_about)): ?>
            <?php echo htmlspecialchars_decode($user_about); ?>
        <?php else: ?>
            <p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.</p>
        <?php endif; ?>     
        </div>      

        <!-- Video Youtube -->
        <div class="video-container mt50">
            <iframe width="900" height="506" src="https://www.youtube.com/embed/eJsf1vNCSJo?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
        </div>

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
            <h3 class="title">Workshops</h3>
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
                    <img src="<?php echo BASE; ?>/tim.php?src=uploads/<?php echo $post_capa; ?>&w=380&h=253&q=90" class="img-responsive" alt="Capa do Post">
                    <div class="section-workshops-item-content">
                        <div class="section-workshops-title mb20">
                            <a href="<?php echo HOME; ?>/posts/<?php echo $post_url; ?>" class="text-title"><h5><?php echo Check::Words($post_nome, 9); ?></h5></a>
                        </div>
                        <p><?php echo Check::Words($post_desc, 20); ?></p>
                        <a href="<?= HOME ?>/posts/<?php echo $post_url; ?>" class="btn btn-custom-rosa mt20">saiba mais</a>
                    </div>           
                </div>
            </div>
            <?php endforeach; ?>   
        <?php endif; ?>             

        <?php if ( $post->getRowCount() == 3 ): ?>
            <?php foreach ($post->getResult() as $posts): extract($posts); ?>
            <div class="col-sm-12 col-md-4">
                <div class="section-workshops-item">
                    <img src="<?php echo BASE; ?>/tim.php?src=uploads/<?php echo $post_capa; ?>&w=380&h=253&q=90" class="img-responsive" alt="Capa do Post">
                    <div class="section-workshops-item-content">
                        <div class="section-workshops-title mb20">
                            <a href="<?php echo HOME; ?>/posts/<?php echo $post_url; ?>" class="text-title"><h5><?php echo Check::Words($post_nome, 9); ?></h5></a>
                        </div>
                        <p><?php echo Check::Words($post_desc, 20); ?></p>
                        <a href="<?= HOME ?>/posts/<?php echo $post_url; ?>" class="btn btn-custom-rosa mt20">saiba mais</a>
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
        <h3 class="title">Últimos trabalhos</h3>
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
    <div id="owl-lastJobs">
        <?php foreach ($post->getResult() as $album): ?>
            <?php $album['album_likes'] = Check::QtdImgLikes($album['album_id']); ?>
            <?php $View->Show($album, $albunshome); ?>
        <?php endforeach; ?>   
    </div>
    <?php endif; ?>  
    <a href="<?= HOME ?>/portfolios/" class="btn btn-custom-brand mt60">Ver portfolio completo</a>

    <div class="btn-scroll">
        <a href="#blog" class="page-scroll page-scroll-down brand"><i class="fa fa-angle-down" aria-hidden="true"></i></a> 
    </div>
</section>


<section id="blog" class="section-default section-blog">
    <div class="container">
        <div class="title-section">
            <h3 class="title">Posts Recentes</h3>
            <div class="tracinho"></div>
        </div>
        <?php #Traz os albuns do banco.
        $post->ExeRead("nit_posts", "WHERE post_status = 1 ORDER BY post_id DESC LIMIT :limit", "limit=3");
        if (!$post->getResult()):
            echo '<div class="container text-center">';
                WSErro('Você ainda não fez nenhuma postagem no Blog!', WS_INFOR);  
            echo '</div>';
        else:
        ?>
            <?php if ( $post->getRowCount() == 1 ): ?>
                <?php foreach ($post->getResult() as $posts): extract($posts); ?>
                <div class="col-xs-12">
                    <div class="section-blog-item">
                        <img src="<?php echo BASE; ?>/tim.php?src=uploads/<?php echo $post_capa; ?>&w=380&h=253&q=90" class="img-responsive" alt="Capa do Post">
                        <div class="section-blog-item-content">
                            <div class="section-blog-title mb20">
                                <a href="<?php echo HOME; ?>/posts/<?php echo $post_url; ?>" class="text-title"><h5><?php echo Check::Words($post_nome, 9); ?></h5></a>
                            </div>
                            <p><?php echo Check::Words($post_desc, 20); ?></p>
                            <a href="<?= HOME ?>/posts/<?php echo $post_url; ?>" class="btn btn-custom-rosa mt20">saiba mais</a>
                        </div>           
                    </div>
                </div>
                <?php endforeach; ?> 
            <?php endif; ?>

            <?php if ( $post->getRowCount() == 2 ): ?>
                <?php foreach ($post->getResult() as $posts): extract($posts); ?>
                <div class="col-xs-12 col-sm-6">
                    <div class="section-blog-item">
                        <img src="<?php echo BASE; ?>/tim.php?src=uploads/<?php echo $post_capa; ?>&w=380&h=253&q=90" class="img-responsive" alt="Capa do Post">
                        <div class="section-blog-item-content">
                            <div class="section-blog-title mb20">
                                <a href="<?php echo HOME; ?>/posts/<?php echo $post_url; ?>" class="text-title"><h5><?php echo Check::Words($post_nome, 9); ?></h5></a>
                            </div>
                            <p><?php echo Check::Words($post_desc, 20); ?></p>
                            <a href="<?= HOME ?>/posts/<?php echo $post_url; ?>" class="btn btn-custom-rosa mt20">saiba mais</a>
                        </div>           
                    </div>
                </div>
                <?php endforeach; ?> 
            <?php endif; ?>  

            <?php if ( $post->getRowCount() == 3 ): ?>
                <?php foreach ($post->getResult() as $posts): extract($posts); ?>
                <div class="col-sm-12 col-md-4">
                    <div class="section-blog-item">
                        <img src="<?php echo BASE; ?>/tim.php?src=uploads/<?php echo $post_capa; ?>&w=380&h=253&q=90" class="img-responsive" alt="Capa do Post">
                        <div class="section-blog-item-content">
                            <div class="section-blog-title mb20">
                                <a href="<?php echo HOME; ?>/posts/<?php echo $post_url; ?>" class="text-title"><h5><?php echo Check::Words($post_nome, 9); ?></h5></a>
                            </div>
                            <p><?php echo Check::Words($post_desc, 20); ?></p>
                            <a href="<?= HOME ?>/posts/<?php echo $post_url; ?>" class="btn btn-custom-rosa mt20">saiba mais</a>
                        </div>           
                    </div>
                </div>
                <?php endforeach; ?> 
            <?php endif; ?>                            

        <?php endif; ?>  
        <div class="clearfix"></div>
        
        <a href="<?= HOME ?>/posts/" class="btn btn-custom-rosa mt60">Ir para o Blog</a>

        <div class="btn-scroll">
            <a href="#depoimentos" class="page-scroll page-scroll-down white"><i class="fa fa-angle-down" aria-hidden="true"></i></a> 
        </div>
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
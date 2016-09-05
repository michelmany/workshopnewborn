<section id="portfolio" class="content">
    <div class="title-section internas text-center">
        <h3 class="title">Blog</h3>
        <div class="tracinho"></div>
    </div>
    <div class="portfolioPage">
        <div class="container">
            <ul id="filters" class="clearfix">
            <?php 
            $getCats = new Read;
            $getCats->ExeRead('nit_posts_cats');
            if($getCats->getResult()):
                # Estou buscando apenas o category_id dos resultados e separando
                # para depois colocar dentro da data-filter "Todos".
                $cats = implode(" ", array_column($getCats->getResult(), 'category_id'));

                echo '<li><span class="filter active" data-filter="'.$cats.'">Todos</span></li>';

                foreach ($getCats->getResult() as $categoria):
                    extract($categoria);
                    echo'<li><span class="filter" data-filter="'.$category_id.'">'.$category_title.'</span></li>';
                endforeach;
            endif;      
            ?>
            </ul>   

            <section class="section-posts">
                <div class="row">
                    <?php 
                    $post = new Read;
                    $post->ExeRead("nit_posts", "WHERE post_status = 1 ORDER BY post_id DESC LIMIT :limit", "limit=6");
                    if (!$post->getResult()):
                        echo '<div class="container text-center">';
                            WSErro('Você ainda não fez nenhuma postagem no Blog!', WS_INFOR);
                        echo '</div>';
                    else:
                    ?>
                    <?php foreach ($post->getResult() as $posts): extract($posts); ?>
                        <div class="col-sm-4">
                            <div class="section-blog-item">
                                <img src="<?php echo BASE; ?>/tim.php?src=uploads/<?php echo $post_capa; ?>&w=380&h=253&q=90" class="img-responsive" alt="Capa do Post">
                                <div class="section-blog-item-content">
                                    <div class="section-blog-title mb20">
                                        <a href="<?php echo HOME; ?>/post/<?php echo $post_url; ?>" class="text-title"><h5><?php echo Check::Words($post_nome, 9); ?></h5></a>
                                    </div>
                                    <p><?php echo Check::Words($post_desc, 20); ?></p>
                                    <a href="<?= HOME ?>/post/<?php echo $post_url; ?>" class="btn btn-custom-rosa mt20">saiba mais</a>
                                </div>           
                            </div>
                        </div>
                    <?php endforeach; ?>            
                    <?php endif; ?>  
                    <div class="clearfix"></div>
                    
                    <a href="<?= HOME ?>/posts/" class="btn btn-custom-brand mt60">Carregar mais</a>

                </div>
            </section>

        </div>
    </div>
</section>
<section id="portfolio" class="content">
    <div class="title-section internas text-center">
        <h3 class="title">Galerias</h3>
        <div class="tracinho"></div>
    </div>
    <div class="portfolioPage">
        <div class="container">
            <ul id="filters" class="clearfix">
            <?php 
            $getCats = new Read;
            $getCats->ExeRead('nit_albuns_cats');
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

            <div id="portfoliolist">
                <?php
                # Busca o portfolio do cliente.
                $post = new Read;
                $post->ExeRead("nit_albuns", "WHERE album_status = 1 ORDER BY album_data DESC");
                
                if (!$post->getResult()):
                    WSErro('Nenhum álbum cadastrado!', WS_INFOR);
                else: ?>    
                
                    <?php foreach ($post->getResult() as $album): extract($album); ?>       

                        <div class="portfolio <?= $album_categoria_id ?>" data-cat="<?= $album_categoria_id ?>">
                            <div class="portfolio-wrapper">             
                                <img class="img-responsive" src="<?= BASE ?>/tim.php?src=uploads/<?= $album_capa ?>&w=385&h=236&q=90" alt="" />
                                <div class="label">
                                    <div class="label-text">
                                        <a href="<?= HOME ?>/portfolio/<?= $album_url ?>" class="text-title"><?= $album_nome ?></a>
                                        <p><i class="fa fa-heart-o"></i> <?= Check::QtdImgLikes($album_id); ?> Likes</p>
                                        <p><i class="fa fa-eye"></i> <?= $album_views ?> Views</p>
                                    </div>
                                    <div class="label-bg"></div>
                                </div>
                            </div>
                        </div>              
                        
                    <?php endforeach; ?>
                <?php endif; ?>         
            </div>

        </div>
    </div>
</section>
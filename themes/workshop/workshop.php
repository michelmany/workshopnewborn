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
            <div class="title-section internas verde text-center">        
                <h3 class="title"><?php echo $workshop_nome; ?></h3>
                <div class="tracinho"></div>
            </div>

            <div class="container portfolioPageSingle text-left mt40">

                <div id="row">

                    <div class="col-sm-5 mb30">
                        <img src="<?php echo BASE; ?>/tim.php?src=uploads/<?php echo $workshop_capa; ?>&w=450&h=290&q=90" class="img-responsive" alt="Capa do Post">
                    </div>
                    <div class="col-sm-7">
                        <div class="stats">
                            <?php $icon_vagas = ($workshop_vagas && $workshop_vagas >= 1) ? 'fa-check' : 'fa-close'; ?>
                            <span class="views">Vagas disponíveis: <i class="fa <?php echo $icon_vagas ?>" title="Vagas disponíveis"></i> <?php echo $workshop_vagas; ?></span>  
                        </div>        
                        <div class="section-workshop-content mt20">
                            <p><strong>Agenda:</strong> <?php echo date('d/m/Y', strtotime($workshop_date)); ?></p>
                            <p><strong>Local:</strong> <?php echo $workshop_local; ?></p><br>
                            <p><strong>Investimento: R$ </strong> <?php echo number_format($workshop_investimento, 2, ',', ''); ?></p><br>
                            <p><strong>Detalhes:</strong></p>
                            <?php echo htmlspecialchars_decode($workshop_msg); ?>
                        </div>             

                        <?php if ($workshop_vagas >= 1): ?>
                            <button type="button" id="btn-inscrever" class="btn btn-custom-brand mt20 mb20">Quero me inscrever!</button>
                            <?php else: ?>
                            <button type="button" class="btn btn-custom-brand mt20 mb20" disabled>Esgotado!</button>                                
                        <?php endif ?>

                    </div>

                </div>

                <div class="clearfix"></div>
                
            </div>

            <div class="form-cadastro">
                <div class="container">
                    <?php include('inc/form-cadastro.inc.php');?>                   
                </div>
            </div>           

            <div class="clearfix"></div>

            <hr>

            <div class="container">
                <div class="col-xs-12 mt30 facebook-comment">
                    <div class="fb-comments" data-href="<?= HOME ?>/workshop/<?= $workshop_url; ?>"  data-width="100%" data-numposts="5"></div>
                </div>
            </div>

            <div class="clearfix"></div>

        </div>
    </section>


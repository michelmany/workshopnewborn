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
                <h3 class="title">Confirmação da sua inscrição</h3>
                <div class="tracinho"></div>
            </div>

        <?php 

        if (!filter_input(INPUT_GET, 'ped_cod', FILTER_DEFAULT)):
            echo("Ocorreu um erro ao efetuar sua inscrição. Por favor tente Outra vez!");
        else:
            $ped_cod = filter_input(INPUT_GET, 'ped_cod', FILTER_DEFAULT);
        endif;

        $Read = new Read; #Listo o pedido efetuado
        $Read->ExeRead('nit_inscritos', "WHERE cad_cod = :cod", "cod={$ped_cod}");

        if ($Read->getResult()): extract($Read->getResult()[0]);
        ?>
        
        <?php 
        $ReadWorkshop = new Read;
        $ReadWorkshop->ExeRead('nit_workshops', "WHERE workshop_id = :wid", "wid={$workshop_id}");

        if ($ReadWorkshop->getResult()):
            extract($ReadWorkshop->getResult()[0]);
        endif;
        ?>
            <div class="form-cadastro-retorno">
                <div class="form-cadastro-retorno-message">
                    <div class="container">
                        <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                        <div class="nome-aluno"><h2>Olá <?= $cad_aluno; ?>, Obrigada por se cadastrar!</h2></div>
                        <p>Efetue o pagamento agora mesmo para confirmar sua inscrição!</p>
                    </div>

                    <div class="button-pagamento">
                        <?php include('inc/button-pagseguro.inc.php'); ?>
                    </div>
                </div>
            </div>
        <?php 
        else:
            echo "Oppsss: Este pedido não existe ou foi excluído!";  
        endif; ?> 

        </div>
    </section>

  

<?php 
if ($Link->getData()):
    extract($Link->getData());
else:
    header('Location: ' . HOME . DIRECTORY_SEPARATOR . '404');
endif;
?>  


    <section id="portfolio-single" class="content">
        <div class="title-section internas text-center">        
            <h3 class="title"><?php echo $workshop_nome; ?></h3>
            <div class="tracinho"></div>
        </div>

        <div class="container portfolioPageSingle text-left">

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
                            <p><strong>Local:</strong> <?php echo $workshop_local; ?></p>
                            <p class="mt20"><strong>Detalhes:<br></strong> <?php echo $workshop_msg; ?></p>
                        </div>             

                        <button class="btn btn-custom-brand mt20">Inscrever-se</button>     

                        <!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
                        <!-- <form action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post" onsubmit="PagSeguroLightbox(this); return false;"> -->
                        <!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
<!--                         <input type="hidden" name="code" value="BEA99D2F7F7FBA5004A8BF923973BA39" />
                        <input type="hidden" name="iot" value="button" />
                        <input type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/pagamentos/94x52-pagar-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
                        </form>
                        <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script> -->
                        <!-- FINAL FORMULARIO BOTAO PAGSEGURO -->  

                    </div>

            </div>

            <div class="clearfix"></div>

            <hr>

            <div class="col-xs-12 reset-indent"> 

            
            </div>

            <div class="col-lg-12">
                <div class="fb-comments" data-href="<?= HOME ?>/workshop/<?= $workshop_url; ?>"  data-width="100%" data-numposts="5"></div>
            </div>
        </div>
    </section>

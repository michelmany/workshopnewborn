
    <section id="instagram-section" class="section-instagram">
        <div class="section-instagram-bar">
            <div class="container">
                Instagram <i class="fa fa-instagram"></i> @<?= $user_instagram; ?>      
            </div>      
        </div>
        <div data-is
             data-is-api="<?= INCLUDE_PATH; ?>/plugins/api/"
             data-is-source="@<?php echo $user_instagram; ?>"
             data-is-width="auto"
             data-is-height="auto"
             data-is-columns="6"
             data-is-rows="1"
             data-is-direction="vertical"
             data-is-lang="pt-BR"
             data-is-popup-info=""
             data-is-color-gallery-overlay="rgba(41, 41, 41, 0.9)"
             data-is-responsive='{ 
                    "1200": { "columns": 6, "rows": 1, "gutter": 0 },
                    "991": { "columns": 4, "rows": 1, "gutter": 0 },
                    "767": { "columns": 3, "rows": 1, "gutter": 0 },
                    "480": { "columns": 1, "rows": 1, "gutter": 0 }
             }'>
        </div>    
    </section>

    
    <footer id="contato" class="footer">
        <div class="container">
            <div class="col-md-4">
                <div class="footer-widget">
                    <h5 class="title-widget">Facebook</h5>
                    <div class="tracinho traco-menor"></div>
                    <div class="content-widget">
                        <div class="face-widget">
                            <div id="fb-root"></div>
                            <div class="fb-page"
                                data-href="https://www.facebook.com/<?= $user_facebook; ?>" 
                                data-small-header="true" 
                                data-adapt-container-width="true" 
                                data-hide-cover="false" 
                                data-show-facepile="true"
                                data-show-posts="false">
                            </div> 
                        </div>             
                    </div> 
                </div>             
            </div>
            <div class="col-md-4">
                <div class="footer-widget">
                    <h5 class="title-widget">Contato</h5>
                    <div class="tracinho traco-menor"></div>
                    <div class="content-widget">
                        <ul id="social-icons-footer">
                            <?php include('social-icons.inc.php') ?>
                        </ul>

                        <!-- TELEFONE -->
                        <?php if(isset($user_telefone) && !empty($user_telefone)): ?>
                            <p><?php echo $user_telefone; ?></p>
                            <p><?php if(isset($user_telefone2)) echo $user_telefone2; ?></p>
                        <?php endif; ?>

                        <!-- EMAIL -->
                        <?php if(isset($user_email) && !empty($user_email)): ?>
                            <p><?php echo $user_email; ?></p>
                        <?php endif; ?>

                        <button type="button" class="btn btn-custom-brand mt10" data-toggle="modal" data-target="#modalMessage">Envie uma mensagem</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-widget">
                    <h5 class="title-widget">Parceiros</h5>
                    <div class="tracinho traco-menor"></div>
                    <div class="content-widget">
                         <div class="carousel-parceiros">
                        <?php 
                            $post = new Read;
                            $post->ExeRead("nit_parceiros", "WHERE slider_status = 1 ORDER BY slider_order DESC");
                            if(!$post->getResult()):
                                WSErro('Nenhuma Logo cadastrada!', WS_INFOR);
                            else:
                                foreach ($post->getResult() as $slider):
                                    extract($slider);

                                    if (!empty($slider_link)):
                                        echo '<div class="item"><a href="http://'.$slider_link.'" target="_blank"><img class="img-responsive" src="'.BASE.'/tim.php?src=uploads/'.$slider_url_img.'&w=151&h=95&q=90" title="'.$slider_title1.'"></a></div>';
                                    else:
                                        echo '<div class="item"><img class="img-responsive" src="'.BASE.'/tim.php?src=uploads/'.$slider_url_img.'&w=151&h=95&q=90" title="'.$slider_title1.'"></div>';                                                                     
                                    endif;

                                endforeach;
                            endif; 
                         ?>
                     
                 </div>
                    </div>              
                </div>
            </div>
        </div>

        <!-- Modal Message -->
        <div class="modal fade" id="modalMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Envie uma mensagem</h4>
                    </div>

                    <div class="modal-body">

                        <form name="send_email" action="" method="POST" role="form" class="j_formsubmit" root-path="<?= INCLUDE_PATH; ?>"><!-- open form -->
                            
                            <div class="msg-retorno"></div>  

                            <div class="row form-group">
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" placeholder="Nome" name="RemetenteNome" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" class="form-control" placeholder="Email" name="RemetenteEmail" required>
                                </div>                      
                            </div>

                            <div class="row form-group">
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" placeholder="Telefone" name="RemetenteTelefone" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" placeholder="Cidade" name="RemetenteCidade" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" placeholder="Assunto" name="Assunto">
                                </div>                   
                            </div>

                            <div class="row form-group">
                                <div class="col-lg-12">
                                    <textarea class="form-control" placeholder="Mensagem" name="Mensagem" rows="6" required></textarea>
                                </div>          
                            </div>                                   
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-custom" name="SendFormContato" value="Enviar mensagem" />
                                    <img class="form_load" style="display:none;" src="<?= INCLUDE_PATH; ?>/img/load.gif" alt="[CARREGANDO...]" title="CARREGANDO..."/>
                                    <input type="hidden" name="DestinoEmail" value="<?= $user_email_destino = (isset($user_email_destino) && !empty($user_email_destino) ? $user_email_destino : $user_email); ?>">
                                    <input type="hidden" name="DestinoNome" value="<?= $user_fullname = (isset($user_fullname) && !empty($user_fullname) ? $user_fullname : "Viviane Teodoro"); ?>">
                                </div>
                        </form><!-- close form -->
                    </div> <!-- / modal body -->
                </div>
            </div>
        </div>      

    </footer>

    <div class="rodape text-center">
        <div class="container">
            <p>Feito com <i class="fa fa-heart"></i> by <a href="http://retratum.com" target="_blank" title="Crie seu site Retratum também!">Nitdesign</a></p>
        </div>
    </div>

    <a class="scrollup"><i class="fa fa-angle-up"></i></a>
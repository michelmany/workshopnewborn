<section id="pedido" class="pages" style="margin-bottom:200px;">
    <div class="container">

        <h2>Cadastro</h2>

        <hr>
                        
        <div class="col-md-12">
            <div>
            <?php # MOSTRA A MENSAGEM DE SUCESSO GRAVADA NA SESSÃO #
                if(!empty($_SESSION['sucesso'])):
                    WSErro($_SESSION['sucesso'], WS_ACCEPT);
                    unset($_SESSION['sucesso']);
                endif; 
            ?>                   
            <p class="mt30 mb80">Você receberá um email de confirmação de cadastro. Qualquer dúvida entre em contato conosco.</p>

            <h5>Aproveite e curta nossa página no facebook:</h5>       

            
            <!-- FACEBOOK -->
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.5&appId=124057441026006";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

            <div class="fb-like" data-href="https://www.facebook.com/RetratumSites/" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>

            </div>
        </div>
       
    </div>
</section>
<section id="pedido" class="pages">
    <div class="container">
             
    <?php #pego o id do plano escolhido na página principal (seção planos).
    $plano_id = filter_input(INPUT_GET, 'p_id', FILTER_DEFAULT);
    ?>

    <?php
    $postcadastro = filter_input(INPUT_POST, 'SendPostForm', FILTER_DEFAULT);
    if ($postcadastro):
        $userDataSet = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        unset($userDataSet['SendPostForm']);

        $userDataGet = array_map('strip_tags', $userDataSet);
        $data = array_map('trim', $userDataGet);

        $cadastra = new Contrate;
        $cadastra->ExeCreate($data);

        #Mostra mensagens de erro de validação.
        WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
        
    endif;
    ?>

    <h2>Resumo do seu pedido <a href="javascript:history.back()" class="btn btn-primary pull-right">Voltar</a></h2>

    <hr>
                    
    <div class="col-md-8">
        <div>
            <img id="imagem-layout" class="img-responsive" src="" alt="Layout Retratum" path-img="/themes/<?= THEME; ?>/img/">
        </div>
    </div>
        
    <form id="form-cadastro" name="PostForm" role="form" method="POST" action="">
        <div class="col-md-4 col-sm-12">

            <label class="control-label">Escolha o layout:</label>

            <?php
            # Busca o temas cadastrados no banco.
            $themes = new Read;
            $themes->ExeRead("nit_themes", "ORDER BY theme_id ASC");
            
            if (!$themes->getResult()):
                WSErro('Nenhum layout disponível!', WS_INFOR);
            else: ?>    
        
           
            <select id="layout-escolhido" class="form-control input-lg" name="theme_id">
            <?php foreach ($themes->getResult() as $theme): extract($theme); ?>                               
                <option value="<?= $theme_id; ?>" <?php if (isset($data['theme_id']) && $data['theme_id'] == $theme_id): echo 'selected'; endif; ?>><?= $theme_name; ?></option>
            <?php endforeach; ?>
            </select><br>

            <?php endif; ?>

            <?php #Busco o plano cadastrado no banco.
            $buscaPlano = new Read;
            $buscaPlano->ExeRead('nit_planos', "WHERE plano_id = :id", "id={$plano_id}");

            if (!$buscaPlano->getResult()):
                WSErro('Escolha seu <a href="'. HOME .'/#prices-section">PLANO</a> primeiro.', WS_INFOR);
            else: 
                $plano = $buscaPlano->getResult()[0];
            ?>


            <!-- PLANO ESCOLHIDO -->
            <div class="mt30">
                <input type="hidden" name="plano_id" value="<?php echo $plano_id; ?>">
                <p>Plano Escolhido: <strong><?php echo $plano['plano_titulo']; ?></strong>  
                    <a href="http://retratum.com/#prices-section" class="btn btn-warning btn-xs">trocar plano</a>
                </p>

                <p>Hospedagem + Manutenção (SaaS): <strong>R$ <?php echo $plano['plano_preco']; ?>,00</strong></p>

                <?php if($plano['install_preco'] == 0): ?>
                    <p class="mt20"><strong>Não há taxa de instalação</strong></p>
                <?php else: ?>
                    <p class="mt20">Instalação: <strong>R$ <?php echo $plano['install_preco']; ?>,00</strong></p>
                <?php endif;
                 ?>
            </div>

                <hr>
                
                <!-- TOTAL A PAGAR -->
                <?php $totalapagar = Check::TotalAPagar($plano['plano_preco'], $plano['install_preco']); #calcula o valor total. ?>
                <h3>Total: <span>R$</span> <span class="total"><?php echo $totalapagar; ?></span><span>,00</span></h3>
                <input type="hidden" name="total_pagar" value="<?php echo $totalapagar; ?>,00">
            
            <?php endif;?>

            <hr>

            <p>Forma de pagamento: </p>

            <label class="radio-inline">
                <input  type="radio" 
                        name="forma_pagamento" 
                        value="boleto" 
                        checked
                        <?php if (isset($data['forma_pagamento']) && $data['forma_pagamento'] == "boleto") echo 'checked="checked"'; ?>
                >Boleto Bancário
            </label>

            <label class="radio-inline">
                <input  type="radio" 
                        name="forma_pagamento" 
                        value="creditcard"
                        <?php if (isset($data['forma_pagamento']) && $data['forma_pagamento'] == "creditcard") echo 'checked="checked"'; ?>
                >Cartão de Crédito
            </label>  

        </div>
  
        <div class="clearfix"></div>

        <h2 class="mt60">Cadastro</h2>

        <hr>

        <div class="row grupo-input">
            <div class="col-md-6 form-group">
                <label for="nome">Nome ou Razão Social</label>
                <input type="text" class="form-control input-lg" name="user_fullname" value="<?php if (isset($data['user_fullname'])) echo htmlspecialchars($data['user_fullname']); ?>"/>

            </div>
            <div class="col-md-6 form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control input-lg" name="user_email" value="<?php if (isset($data['user_email'])) echo htmlspecialchars($data['user_email']); ?>" />

            </div>
        </div>
        <div class="row grupo-input">
            <div class="form-group col-md-2">
                <label for="ddd">DDD</label>
                <input type="tel" class="form-control input-lg" maxlength="2" name="user_ddd" value="<?php if (isset($data['user_ddd'])) echo htmlspecialchars($data['user_ddd']); ?>"/>

            </div>
            <div class="form-group col-md-4">
                <label for="telefone">Telefone</label>
                <input type="tel" class="form-control input-lg" maxlength="9" name="user_telefone" value="<?php if (isset($data['user_telefone'])) echo htmlspecialchars($data['user_telefone']); ?>"/>

            </div>
            <div class="col-md-6 form-group">
                <label for="cpf">CPF ou CNPJ</label>
                <input type="text" class="form-control input-lg" maxlength="15" name="user_cpf_cnpj" value="<?php if (isset($data['user_cpf_cnpj'])) echo htmlspecialchars($data['user_cpf_cnpj']); ?>"/>

            </div>
        </div>
        <div class="row grupo-input">
            <div class="col-md-4 form-group">
                <label for="endereco">Endereço</label>
                <input type="text" class="form-control input-lg" name="user_endereco" value="<?php if (isset($data['user_endereco'])) echo htmlspecialchars($data['user_endereco']); ?>"/>

            </div>
            <div class="col-md-2 form-group">
                <label for="end_numero">Número</label>
                <input type="text" class="form-control input-lg" name="end_numero" value="<?php if (isset($data['end_numero'])) echo htmlspecialchars($data['end_numero']); ?>"/>

            </div>
            <div class="col-md-6 form-group">
                <label for="complemento">Complemento</label>
                <input type="text" class="form-control input-lg" name="end_complemento" value="<?php if (isset($data['end_complemento'])) echo htmlspecialchars($data['end_complemento']); ?>"/>

            </div>
        </div>

        <div class="row grupo-input">
            <div class="col-md-3 form-group">
                <label for="bairro">Bairro</label>
                <input type="text" class="form-control input-lg" name="end_bairro" value="<?php if (isset($data['end_bairro'])) echo htmlspecialchars($data['end_bairro']); ?>"/>

            </div>
            <div class="col-md-3 form-group">
                <label for="cep">CEP</label>
                <input type="text" class="form-control input-lg" maxlength="9" name="cep" value="<?php if (isset($data['cep'])) echo htmlspecialchars($data['cep']); ?>"/>

            </div>
            <div class="col-md-3 form-group">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control input-lg" name="end_cidade" value="<?php if (isset($data['end_cidade'])) echo htmlspecialchars($data['end_cidade']); ?>"/>

            </div>
            <div class="col-md-3 form-group">
                <label for="estado">Estado</label>
                <select class="form-control input-lg required" id="estado" name="end_estado">
                    <option value="">Selecione o Estado</option>
                    <option value="AC" <?php if (isset($data['end_estado']) && $data['end_estado'] == "AC"): echo 'selected'; endif; ?>>Acre</option>
                    <option value="AL" <?php if (isset($data['end_estado']) && $data['end_estado'] == "AL"): echo 'selected'; endif; ?>>Alagoas</option>
                    <option value="AM" <?php if (isset($data['end_estado']) && $data['end_estado'] == "AM"): echo 'selected'; endif; ?>>Amazonas</option>
                    <option value="AP" <?php if (isset($data['end_estado']) && $data['end_estado'] == "AP"): echo 'selected'; endif; ?>>Amapá</option>
                    <option value="BA" <?php if (isset($data['end_estado']) && $data['end_estado'] == "BA"): echo 'selected'; endif; ?>>Bahia</option>
                    <option value="CE" <?php if (isset($data['end_estado']) && $data['end_estado'] == "CE"): echo 'selected'; endif; ?>>Ceará</option>
                    <option value="DF" <?php if (isset($data['end_estado']) && $data['end_estado'] == "DF"): echo 'selected'; endif; ?>>Distrito Federal</option>
                    <option value="ES" <?php if (isset($data['end_estado']) && $data['end_estado'] == "ES"): echo 'selected'; endif; ?>>Espírito Santo</option>
                    <option value="GO" <?php if (isset($data['end_estado']) && $data['end_estado'] == "GO"): echo 'selected'; endif; ?>>Goiás</option>
                    <option value="MA" <?php if (isset($data['end_estado']) && $data['end_estado'] == "MA"): echo 'selected'; endif; ?>>Maranhão</option>
                    <option value="MT" <?php if (isset($data['end_estado']) && $data['end_estado'] == "MT"): echo 'selected'; endif; ?>>Mato Grosso</option>
                    <option value="MS" <?php if (isset($data['end_estado']) && $data['end_estado'] == "MS"): echo 'selected'; endif; ?>>Mato Grosso do Sul</option>
                    <option value="MG" <?php if (isset($data['end_estado']) && $data['end_estado'] == "MG"): echo 'selected'; endif; ?>>Minas Gerais</option>
                    <option value="PA" <?php if (isset($data['end_estado']) && $data['end_estado'] == "PA"): echo 'selected'; endif; ?>>Pará</option>
                    <option value="PB" <?php if (isset($data['end_estado']) && $data['end_estado'] == "PB"): echo 'selected'; endif; ?>>Paraíba</option>
                    <option value="PR" <?php if (isset($data['end_estado']) && $data['end_estado'] == "PR"): echo 'selected'; endif; ?>>Paraná</option>
                    <option value="PE" <?php if (isset($data['end_estado']) && $data['end_estado'] == "PE"): echo 'selected'; endif; ?>>Pernambuco</option>
                    <option value="PI" <?php if (isset($data['end_estado']) && $data['end_estado'] == "PI"): echo 'selected'; endif; ?>>Piauí</option>
                    <option value="RJ" <?php if (isset($data['end_estado']) && $data['end_estado'] == "RJ"): echo 'selected'; endif; ?>>Rio de Janeiro</option>
                    <option value="RN" <?php if (isset($data['end_estado']) && $data['end_estado'] == "RN"): echo 'selected'; endif; ?>>Rio Grande do Norte</option>
                    <option value="RO" <?php if (isset($data['end_estado']) && $data['end_estado'] == "RO"): echo 'selected'; endif; ?>>Rondônia</option>
                    <option value="RS" <?php if (isset($data['end_estado']) && $data['end_estado'] == "RS"): echo 'selected'; endif; ?>>Rio Grande do Sul</option>
                    <option value="RR" <?php if (isset($data['end_estado']) && $data['end_estado'] == "RR"): echo 'selected'; endif; ?>>Roraima</option>
                    <option value="SC" <?php if (isset($data['end_estado']) && $data['end_estado'] == "SC"): echo 'selected'; endif; ?>>Santa Catarina</option>
                    <option value="SE" <?php if (isset($data['end_estado']) && $data['end_estado'] == "SE"): echo 'selected'; endif; ?>>Sergipe</option>
                    <option value="SP" <?php if (isset($data['end_estado']) && $data['end_estado'] == "SP"): echo 'selected'; endif; ?>>São Paulo</option>
                    <option value="TO" <?php if (isset($data['end_estado']) && $data['end_estado'] == "TO"): echo 'selected'; endif; ?>>Tocantins</option>
                </select>
            </div>
        </div>

        <hr>

        <div class="row mt30">
            <div class="col-md-3 form-group">
                <div class="mb10">
                    <label>Você já possui um domínio?</label>
                </div>

                <label class="radio-inline">
                    <input  id="no-domain" 
                            type="radio" 
                            name="domain" 
                            value="0" 
                            checked
                            <?php if (isset($data['domain']) && $data['domain'] == "0") echo 'checked="checked"'; ?>
                    >Não
                </label>

                 <label class="radio-inline">
                    <input  id="has-domain" 
                            type="radio" 
                            name="domain" 
                            value="1"
                            <?php if (isset($data['domain']) && $data['domain'] == "1") echo 'checked="checked"'; ?>
                    >Sim
                </label>
            </div>

            <div class="col-md-5">
                <div id="escolha-subdomain" class="form-group">
                    <label for="subdominio">Escolha seu domínio provisório</label>
                    <div class="col-md-11 col-sm-12 input-group">
                        <div class="input-group-addon">http://</div>
                        <input type="text" class="form-control input-lg" placeholder="seunome" name="user_username" value="<?php if (isset($data['user_username'])) echo htmlspecialchars($data['user_username']); ?>" >
                        <div class="input-group-addon">.retratum.com</div>
                    </div>
                    <span id="resp-subdominio"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div id="digite-domain" class="form-group">
                    <label for="seu-dominio">Digite seu domínio</label>
                    <div class="col-md-12 col-sm-12 input-group">
                        <div class="input-group-addon">www.</div>
                        <input type="text" class="form-control input-lg" name="user_domain" placeholder="seunome.com.br" value="<?php if (isset($data['user_domain'])) echo htmlspecialchars($data['user_domain']); ?>" />
                    </div>
                    <span id="resp-subdominio"></span>
                </div>  
            </div>
        </div>                          

        <hr>
            
        <div class="row">
            <div class="form-group col-md-6 col-sm-12">
                <label for="onde">Como você conheceu o Retratum.com?</label>
                <select class="form-control input-lg" name="como_conheceu">
                    <option value="nao-preenchido" <?php if (isset($data['como_conheceu']) && $data['como_conheceu'] == "nao-preenchido"): echo 'selected'; endif; ?>></option>
                    <option value="google" <?php if (isset($data['como_conheceu']) && $data['como_conheceu'] == "google"): echo 'selected'; endif; ?>>Google</option>
                    <option value="facebook" <?php if (isset($data['como_conheceu']) && $data['como_conheceu'] == "facebook"): echo 'selected'; endif; ?>>Facebook</option>
                    <option value="instagram" <?php if (isset($data['como_conheceu']) && $data['como_conheceu'] == "instagram"): echo 'selected'; endif; ?>>Instagram</option>
                    <option value="nitdesign" <?php if (isset($data['como_conheceu']) && $data['como_conheceu'] == "nitdesign"): echo 'selected'; endif; ?>>Nitdesign</option>
                    <option value="email-marketing" <?php if (isset($data['como_conheceu']) && $data['como_conheceu'] == "email-marketing"): echo 'selected'; endif; ?>>E-mail marketing</option>
                    <option value="indicacao" <?php if (isset($data['como_conheceu']) && $data['como_conheceu'] == "indicacao"): echo 'selected'; endif; ?>>Indicação</option>
                    <option value="outro-fotografo" <?php if (isset($data['como_conheceu']) && $data['como_conheceu'] == "outro-fotografo"): echo 'selected'; endif; ?>>Site de outro fotógrafo</option>
                </select>
            </div>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="termos" checked> Eu li e concordo com os <a href="<?php echo HOME ?>/termos/"target="_blank">Termos de Serviço</a> e <a href="<?php echo HOME ?>/politica/"target="_blank">Políticas de privacidade</a>.
            </label>
        </div>                    

        <input type="submit" id="myBtn" data-loading-text="Cadastrando..." class="btn btn-custom mt20" name="SendPostForm" value="Finalizar Pedido" autocomplete="off"/>  

    </form>
         

    </div>
</section>
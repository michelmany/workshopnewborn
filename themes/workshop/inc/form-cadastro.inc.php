<!-- Open form inscrição-->
<div class="row">
    <div class="col-xs-12">
        <form name="send_email" action="" method="POST" role="form" class="j_form_cadastro_submit" root-path="<?= INCLUDE_PATH; ?>"><!-- open form -->

            <div class="row form-group">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Aluno" name="cad_aluno" required>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="Data Nasc." name="cad_nasc" required>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="RG" name="cad_rg">
                </div>                                                              
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="CPF" name="cad_cpf">
                </div>
            </div>

            <div class="row form-group">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Endereço" name="cad_endereco">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="Bairro" name="cad_bairro">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="Cidade" name="cad_cidade">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="Estado" name="cad_estado">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="CEP" name="cad_cep">
                </div>
            </div>

            <div class="row form-group">
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Telefone" name="cad_telefone">
                </div>
                <div class="col-md-3">
                    <input type="email" class="form-control" placeholder="Email" name="cad_email" required>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Facebook Profissional" name="cad_facebook">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Site" name="cad_site">
                </div>
            </div>

            <hr>

            <div class="row mt30">
                <div class="col-md-6 form-group">
                    <div class="mb10">
                        <label>Já fez cursos de especializações fotograficas?</label>
                    </div>
                    <div class="col-md-3 mt10 reset-indent">
                        <label class="radio-inline">
                            <input type="radio" name="cad_especializacoes" value="no" checked="">Não
                        </label>

                         <label class="radio-inline">
                            <input type="radio" name="cad_especializacoes" value="yes">Sim
                        </label>
                    </div>

                    <div class="col-md-9 reset-indent">
                        <div id="digite-domain" class="form-group">
                            <input type="text" class="form-control" placeholder="Local:" name="cad_especializacoes_local">
                        </div>  
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <div class="mb10">
                        <label>Já fez Workshop de newborn presencial?</label>
                    </div>

                    <div class="col-md-3 mt10 reset-indent">
                        <label class="radio-inline">
                            <input type="radio" name="cad_jafezpresencial" value="no" checked="">Não
                        </label>

                         <label class="radio-inline">
                            <input type="radio" name="cad_jafezpresencial" value="yes">Sim
                        </label>
                    </div>

                    <div class="col-md-9 reset-indent">
                        <div id="digite-domain" class="form-group">
                            <input type="text" class="form-control" placeholder="Qual:" name="cad_jafezpresencial_qual">
                        </div>  
                    </div>                    
                </div>
            </div>

            <div class="row form-group">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Qual seu equipamento? (corpo e lente)" name="cad_equipamento" required>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Quem são suas inspirações?" name="cad_inspiracoes" required>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <textarea class="form-control" placeholder="Qual a sua maior dificuldade?" name="cad_maiordificuldade" rows="6" required></textarea>
                </div>
                <div class="col-md-6">
                    <textarea class="form-control" placeholder="O que espera do curso?" name="cad_esperadocurso" rows="6" required></textarea>
                </div>
            </div>

            <input type="hidden" name="cad_cod" value="<?php echo md5(uniqid(time())); ?>">
            <input type="hidden" name="workshop_id" value="<?php echo $workshop_id; ?>">


            <div class="button-inscrever">
                <input type="submit" class="btn btn-custom btn-block" name="SendFormCadastra" value="Inscrever-se" />
                <img class="form_load" style="display:none;" src="<?= INCLUDE_PATH; ?>/img/load.gif" alt="[CARREGANDO...]" title="CARREGANDO..."/>
                <?php /*
                <input type="hidden" name="DestinoEmail" value="<?= $user_email_destino = (isset($user_email_destino) && !empty($user_email_destino) ? $user_email_destino : $user_email); ?>">
                <input type="hidden" name="DestinoNome" value="<?= $dados_cliente['user_fullname']; ?>">
                */ ?>
            </div>

        </form>
        <!-- close form -->                                
    </div>
</div>
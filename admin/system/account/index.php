<?php 
# Não permite o acesso direto à URL sem estar logado.
if (!class_exists('Login')) :
	header('Location: ../../painel.php');
	die;
endif;
?>

<!-- Cabeçalho -->
<div class="page-title">
	<div class="title-env">
		<h1 class="title">Minha Conta</h1>
		<p class="description">Informações gerais da sua conta Retratum</p>
	</div>
	<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1" >
			<li><a href="painel.php"><i class="fa-home"></i>Home</a></li>
			<li class="active">Minha Conta</li>
		</ol>
	</div>
</div>

		
<div class="row">
<div class=" col-md-8">				
	<div class="panel panel-default panel-tabs">
				
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#tab-1" data-toggle="tab">Minha conta</a>
			</li>
			<li>
				<a href="#tab-2" data-toggle="tab">Meu Perfil</a>
			</li>
		</ul>
		
		<div class="panel-body">
			<div class="tab-content">

				<?php 

		        //geral
				$geral = filter_input_array(INPUT_POST, FILTER_DEFAULT);
				if (isset($geral) && isset($geral['SendGeral'])):
				    $geral['user_logo'] = ( isset($_FILES['user_logo']['tmp_name']) ? $_FILES['user_logo'] : null );
				    unset($geral['SendGeral']);

				    require('_models/AdminConfig.class.php');
					$cadastraGeral = new AdminConfig;
				    $cadastraGeral->ExeUpdate($userlogin['user_id'], $geral);

				    if ($cadastraGeral->getResult()):
				        WSErro($cadastraGeral->getError()[0], $cadastraGeral->getError()[1]);
				    endif;
				endif;

				//Sobre
		        $sobre = filter_input_array(INPUT_POST, FILTER_DEFAULT);


		        if (isset($sobre) && isset($sobre['SendSobre'])):
				    $sobre['user_foto'] = ( isset($_FILES['user_foto']['tmp_name']) ? $_FILES['user_foto'] : null );

		            unset($sobre['SendSobre']); #unset nesta variavel (botão de submit) pois não precisa enviar para o banco.

		            require('_models/AdminSobre.class.php');
		            $cadastraSobre = new AdminSobre;
		            $cadastraSobre->ExeUpdate($userlogin['user_id'], $sobre);

		            if ($cadastraSobre->getResult()):
		                WSErro($cadastraSobre->getError()[0], $cadastraSobre->getError()[1]);
		            endif;
		        endif;

		        //O contato e o SEO estão salvando via Ajax (config/save-configs.php).

 				?>


				<?php /*************** /MINHA CONTA ***************/ ?>				
				<div class="tab-pane active" id="tab-1">

              <div class="row">
            
                <div class=" col-md-9 col-lg-6 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><strong>Seu plano:</strong></td>
                        <?php 
                        $plano = Check::PlanoNameById($plano_id); 
                        #separo o nome em duas partes com o explode.
                        $plano_nome = explode("_", $plano);
                        ?>
                        <td><?= ucfirst($plano_nome['0']); ?></td>
                      </tr>
                      <tr>
                        <td><strong>Ciclo de Pagamento:</strong></td>
                        <td><?= ucfirst($plano_nome['1']); ?></td>
                      </tr>                      
                      <tr>
                        <td><strong>Próximo Vencimento:</strong></td>
                        <td><?= date('d/m/Y', strtotime($user_datafim)); ?></td>
                      </tr>
                      <tr>
                        <td><strong>Layout do site:</strong></td>
                        <td><?= ucfirst(Check::ThemeById($theme_id)); ?></td>
                      </tr>
                      <tr>
                        <td><strong>Seu Status:</strong></td>
                        <?php 
                        $ativo = '<span class="label label-secondary">Ativo</span>';
                        $inativo = '<span class="label label-danger">Inativo</span>';
                         ?>
                        <td><?= $user_status = ($user_status == 1 ? $ativo : $inativo); ?></td>
                      </tr>                      
                           
                    </tbody>
                  </table>
                 
                </div>
                <div class=" col-md-9 col-lg-6 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><strong>Cliente desde:</strong></td>
                        <td><?= date('m/Y', strtotime($user_registration)); ?></td>
                      </tr>
                      <tr>
                        <td><strong>Email de cobrança:</strong></td>
                        <td><?= $user_email; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Email secundário:</strong></td>
                        <td><?= $user_email_secundario; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Site subdomínio:</strong></td>
                        <td>http://<?= $user_username ?>.retratum.com</td>
                      </tr>                      
                      <tr>
                      <?php #verifica se existe domain personalizado
                        if(isset($user_domain) || !empty($user_domain)):
                            $user_domain = $user_domain;
                        else:
                            $user_domain = '<span class="label label-warning">Registre seu domínio agora</span>';
                        endif;
                       ?>
                        <td><strong>Domínio personalizado:</strong></td>
                        <td><?= $user_domain ?></td>
                      </tr>                      
                     
                    </tbody>
                  </table>
                 
                </div>
              </div>
          
                 <div class="panel-footer text-center">
                    <!-- <a href="#" data-original-title="Solicitação por email" data-toggle="tooltip" type="button" class="btn btn-lg btn-danger"><i class="glyphicon glyphicon-barcode"></i> Solitar alteração de plano</a> -->
                    <a data-original-title="O boleto aparecerá ao lado" data-toggle="tooltip" type="button" class="btn btn-lg btn-primary"><i class="glyphicon glyphicon-envelope"></i> Solicitar reenvio de boleto</a>
                    <a data-original-title="Vencimento 20/02/2016" data-toggle="tooltip" type="button" class="btn btn-lg btn-purple"><i class="glyphicon glyphicon-barcode"></i> Boleto Bancário</a>
                </div>

							
				</div>
				
				<?php /*************** /MINHA CONTA ***************/ ?>				




				<?php /*************** PERFIL ***************/ ?>

				<div class="tab-pane" id="tab-2">

					<form name="formContato" action="" method="post" class="form-horizontal j_btn_salva_account">		

						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Email de acesso</label> 
							<div class="col-sm-9"> 
								<input type="email" class="form-control" placeholder="" autocomplete="off" name="user_email" value="<?= $user_email_contato = ( !empty($user_email) ? $user_email : $userlogin['user_email'] ); ?>"> 
							</div> 
						</div>
						<div class="form-group-separator"></div>								

                        <div class="form-group"> 
                            <label class="col-sm-3 control-label" for="field-1">Email secundário</label> 
                            <div class="col-sm-9"> 
                                <input type="text" class="form-control" placeholder="" name="user_email_secundario" value="<?php if(isset($user_email_secundario)) echo $user_email_secundario; ?>"> 
                            </div> 
                        </div>                                              

                        <div class="form-group-separator"></div>                                

						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Nova Senha</label> 
							<div class="col-sm-9"> 
                                <input style="display:none" type="password" name="fakepassword"/>
								<input type="password" class="form-control" placeholder="" name="user_password" value="" autocomplete="off"> 
                                <p class="help-block">Só digite caso queira alterar sua senha de acesso</p>
							</div> 
						</div>

						<div class="form-group-separator"></div>											

						<div class="row col-lg-9 col-md-9 text-center">				
							<input type="submit" class="btn btn-success btn-lg" value="Atualizar dados" name="SendContact">
						</div>								

					</form>
				</div>

				<?php /*************** /PERFIL ***************/ ?>


				
			</div>
		</div>

	</div>
</div>
</div>
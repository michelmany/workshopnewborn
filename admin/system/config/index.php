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
		<h1 class="title">Configurações</h1>
		<p class="description">Preencha aqui informações que aparecerão em seu site</p>
	</div>
	<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1" >
			<li><a href="painel.php"><i class="fa-home"></i>Home</a></li>
			<li class="active">Configurações</li>
		</ol>
	</div>
</div>

		
<div class="row">
<div class=" col-md-8">				
	<div class="panel panel-default panel-tabs">

		<div class="panel-heading">
			<div class="panel-options">
				
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#tab-1" data-toggle="tab">Geral</a>
					</li>
					<li>
						<a href="#tab-2" data-toggle="tab">Sobre</a>
					</li>
					<li>
						<a href="#tab-3" data-toggle="tab">Contato</a>
					</li>
					<li>
						<a href="#tab-4" data-toggle="tab">SEO</a>
					</li>					
				</ul>
				
			</div>
		</div>
		
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
							        				

				<?php 	# FAZ A LEITURA NO BANCO E FAZ O LOOP PARA MOSTRAR OS RESULTADOS #
					$read = new Read;
					$read->ExeRead("nit_site_config", "WHERE user_id = :userid", "userid= {$userlogin['user_id']}");
					if (!$read->getResult()):
						#Se não encontrar resultados no banco mostra mensagem. Se encontrar, mostra a tabela.
						WSErro("Olá, você ainda não preencheu os dados que aparecerão em seu site! ", WS_INFOR);
					else: 
						$ResultGeral = $read->getResult()[0]; # Já que tem apenas um resultado, trás esse resultado sem FOREACH. 
						extract($ResultGeral); # Função nativa do php que transforma resultados em variáveis. 
				 	endif;
				 ?>


				<?php /*************** /GERAL ***************/ ?>				
				<div class="tab-pane active" id="tab-1">
					<form name="formGeral" action="" method="post" class="form-horizontal" enctype="multipart/form-data">

						<div class="form-group"> 
							<label class="col-sm-3 control-label">Logo Principal</label> 
							<div class="col-sm-9"> 

								<?php #Se existe imagem no banco, mostra o fileinput-exists
								if(empty($user_logo)): ?>

								<div class="fileinput fileinput-new" data-provides="fileinput">
								  <div class="fileinput-new thumbnail" style="width: 200px;;">
								    <img src="http://dummyimage.com/600x400/e3e3e3/ffffff.jpg&text=Sem+imagem">
								  </div>
								  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px;"></div>
								  <div class="text-center">
								    <span class="btn btn-primary btn-file "><span class="fileinput-new">Selecionar Logo</span>
								    <span class="fileinput-exists">Trocar Logo</span>
								    <input type="file" name="user_logo"></span>
								    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remover</a>
								  </div>
								</div>		

								<?php else: ?>					

								<div class="fileinput fileinput-exists" data-provides="fileinput">
								  <div class="fileinput-new thumbnail" style="max-width: 200px;">
								   <img src="http://dummyimage.com/600x400/e3e3e3/ffffff.jpg&text=Sem+imagem">
								  </div>

								  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px;">
								  	<?php echo '<img src="../uploads/'. $user_logo .'?' .time() .'">'; ?>
								  </div>

								  <div class="text-center">
								    <span class="btn btn-primary btn-file "><span class="fileinput-new">Selecionar Logo</span>
								    <span class="fileinput-exists">Trocar Logo</span>
								    <input type="file" name="user_logo"></span>
								    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remover</a>
								  </div>
								</div>	

								<?php endif; ?>	




							</div> 
						</div>

					<div class="form-group-separator"></div>	

					<div class="form-group"> 
						<label class="col-sm-3 control-label" for="field-1">Digite seu nome</label> 
						<div class="col-sm-9">
							<input type="text" class="form-control" placeholder="" name="user_name" value="<?php if(isset($user_name)) echo $user_name; ?>"> 
							<p class="help-block">Este nome aparecerá no site na página Sobre</p>
						</div>
					</div>	

					<div class="form-group-separator"></div>								

					<div class="form-group"> 
						<label class="col-sm-3 control-label" for="field-1"><i class="fa fa-facebook-square"></i> Facebook</label> 
						<div class="col-sm-9">
						<div class="input-group">
							<span class="input-group-addon">facebook.com/</span>
							<input type="text" class="form-control" placeholder="seunomedeusuario" name="user_facebook" value="<?php if(isset($user_facebook)) echo $user_facebook; ?>"> 
						</div> 
						</div>
					</div>

					<div class="form-group-separator"></div>								

					<div class="form-group"> 
						<label class="col-sm-3 control-label" for="field-1"><i class="fa fa-twitter-square"></i> Twitter</label> 
						<div class="col-sm-9">
						<div class="input-group">
							<span class="input-group-addon">@</span>
							<input type="text" class="form-control" placeholder="seunomedeusuario" name="user_twitter" value="<?php if(isset($user_twitter)) echo $user_twitter; ?>"> 
						</div> 
						</div>
					</div>	

					<div class="form-group-separator"></div>

					<div class="form-group"> 
						<label class="col-sm-3 control-label" for="field-1"><i class="fa fa-instagram"></i> Instagram</label> 
						<div class="col-sm-9">
						<div class="input-group">
							<span class="input-group-addon">@</span>
							<input type="text" class="form-control" placeholder="seunomedeusuario" name="user_instagram" value="<?php if(isset($user_instagram)) echo $user_instagram; ?>"> 
						</div> 
						</div>
					</div>	

					<div class="form-group-separator"></div>								

					<div class="form-group"> 
						<label class="col-sm-3 control-label" for="field-1"><i class="fa fa-skype"></i> Skype</label> 
						<div class="col-sm-9">
						<div class="input-group">
							<span class="input-group-addon">@</span>
							<input type="text" class="form-control" placeholder="seunomedeusuario" name="user_skype" value="<?php if(isset($user_skype)) echo $user_skype; ?>"> 
						</div> 
						</div>
					</div>																									

					<div class="form-group-separator"></div>			

					<div class="form-group"> 
						<label class="col-sm-3 control-label" for="field-1">Email destinatário</label> 
						<div class="col-sm-9"> 
							<input type="email" class="form-control" placeholder="" name="user_email_destino" value="<?php if(isset($user_email_destino)) echo $user_email_destino; ?>"> 
							<p class="help-block">Digite aqui o endereço de email de destino para mensagens enviadas pelo site.</p>

						</div> 
					</div>	

					<div class="form-group-separator"></div>	

					<div class="row col-lg-9 col-md-9 text-center">				
						<input type="submit" class="btn btn-success btn-lg" value="Salvar dados" name="SendGeral">
					</div>		

					</form>								
				</div>
				
				<?php /*************** /GERAL ***************/ ?>				






				<?php /*************** SOBRE ***************/ ?>

				<div class="tab-pane" id="tab-2">
			
					<form name="formSobre" action="" method="post" class="form-horizontal" enctype="multipart/form-data">
		

						<div class="form-group">
							<label class="col-sm-3 control-label">Sua foto</label>
							<div class="col-sm-9">

								<?php #Se existe imagem no banco,mostra o fileinput-exists
								if(empty($user_foto)): ?>

								<div class="fileinput fileinput-new" data-provides="fileinput">
								  <div class="fileinput-new thumbnail" style="width: 300px;;">
								    <img src="http://dummyimage.com/600x400/e3e3e3/ffffff.jpg&text=Sem+imagem">
								  </div>
								  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px;"></div>
								  <div class="text-center">
								    <span class="btn btn-primary btn-file "><span class="fileinput-new">Selecionar Foto</span>
								    <span class="fileinput-exists">Trocar Logo</span>
								    <input type="file" name="user_foto"></span>
								    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remover</a>
								  </div>
								</div>		

								<?php else: ?>					

								<div class="fileinput fileinput-exists" data-provides="fileinput">
								  <div class="fileinput-new thumbnail" style="max-width: 300px;">
								   <img src="http://dummyimage.com/600x400/e3e3e3/ffffff.jpg&text=Sem+imagem">
								  </div>

								  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px;">
								  	<?php echo '<img src="../uploads/'. $user_foto .'?' .time() .'">'; ?>
								  </div>

								  <div class="text-center">
								    <span class="btn btn-primary btn-file "><span class="fileinput-new">Selecionar Foto</span>
								    <span class="fileinput-exists">Trocar Logo</span>
								    <input type="file" name="user_foto"></span>
								    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remover</a>
								  </div>
								</div>	

								<?php endif; ?>	


							</div>
						</div>

						<div class="form-group-separator"></div>

						<!-- ATIVAR FUTURAMENTE
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Video</label> 
							<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">https://vimeo.com/</span>
								<input type="text" class="form-control" placeholder="8858540" name="user_video" value="<?php if (isset($user_video)) echo $user_video; ?>"> 
							</div> 
							</div>
						</div>	
						<div class="form-group-separator"></div>			
						-->

						<!-- Descrição -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="">Texto Sobre</label> 
							<div class="col-sm-9"> 
								<textarea class="form-control ckeditor" rows="5" name="user_about"><?php if (isset($user_about)) echo htmlspecialchars_decode($user_about); ?></textarea>										
							</div> 
						</div>	
						
						<div class="form-group-separator"></div>			

						<div class="row col-lg-9 col-md-9 text-center">				
							<input type="submit" class="btn btn-success btn-lg" value="Salvar dados" name="SendSobre">
						</div>								

					</form>
				</div>
				
				<?php /*************** /SOBRE ***************/ ?>





				<?php /*************** CONTATO ***************/ ?>

				<div class="tab-pane" id="tab-3">
				
					
					<form name="formContato" action="" method="post" class="form-horizontal j_btn_salva_Configs">		

						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Email</label> 
							<div class="col-sm-9"> 
								<input type="email" class="form-control" placeholder="" name="user_email" value="<?= $user_email_contato = ( !empty($user_email) ? $user_email : $userlogin['user_email'] ); ?>"> 
							</div> 
						</div>					

						<div class="form-group-separator"></div>								

						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Telefone 1</label> 
							<div class="col-sm-9"> 
								<input type="text" class="form-control" placeholder="" name="user_telefone" value="<?php if (!empty($user_telefone)) echo $user_telefone; ?>"> 
							</div> 
						</div>

						<div class="form-group-separator"></div>								

						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Telefone 2</label> 
							<div class="col-sm-9"> 
								<input type="text" class="form-control" placeholder="" name="user_telefone2" value="<?php if (!empty($user_telefone2)) echo $user_telefone2; ?>"> 
							</div> 
						</div>		

						<div class="form-group-separator"></div>									

						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Celular</label> 
							<div class="col-sm-9"> 
								<input type="text" class="form-control" placeholder="" name="user_celular" value="<?php if (!empty($user_celular)) echo $user_celular; ?>"> 
							</div> 
						</div>														

						<div class="form-group-separator"></div>	

						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Endereço</label> 
							<div class="col-sm-9"> 
								<input type="text" class="form-control" placeholder="" name="user_endereco" value="<?php if (!empty($user_endereco)) echo $user_endereco; ?>"> 
							</div> 
						</div>	

						<div class="form-group-separator"></div>								

						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Complemento</label> 
							<div class="col-sm-9"> 
								<input type="text" class="form-control" placeholder="" name="user_comple" value="<?php if (!empty($user_comple)) echo $user_comple; ?>"> 
							</div> 
						</div>		

						<div class="form-group-separator"></div>											


						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Cidade</label> 
							<div class="col-sm-9"> 
								<input type="text" class="form-control" placeholder="" name="user_cidade" value="<?php if (!empty($user_cidade)) echo $user_cidade; ?>"> 
							</div> 
						</div>																													

						<div class="form-group-separator"></div>											
				

						<div class="row col-lg-9 col-md-9 text-center">				
							<input type="submit" class="btn btn-success btn-lg" value="Salvar dados" name="SendContact">
						</div>								

					</form>
				</div>

				<?php /*************** /CONTATO ***************/ ?>




				<?php /*************** SEO ***************/ ?>

				<div class="tab-pane" id="tab-4">
				
					
					<form name="formSeo" action="" method="post" class="form-horizontal j_btn_salva_Configs">		

						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Título da Página</label> 
							<div class="col-sm-9"> 
								<input type="text" class="form-control" placeholder="" maxlength="70" name="user_sitename" value="<?php if (isset($user_sitename)) echo ($user_sitename); ?>"> 
								<p class="help-block">Máximo de 70 caracteres.</p>
							</div>
						</div>					

						<div class="form-group-separator"></div>								

						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Descrição do site</label> 
							<div class="col-sm-9"> 
								<textarea class="form-control" rows="3" maxlength="156" name="user_sitedesc"><?php if (isset($user_sitedesc)) echo ($user_sitedesc); ?></textarea>										
								<p class="help-block">Máximo de 156 caracteres.</p>

							</div> 
						</div>

						<div class="form-group-separator"></div>								

						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Keywords (Palavras-chaves)</label> 
							<div class="col-sm-9"> 
								<textarea class="form-control" rows="3" maxlength="200" name="user_keywords"><?php if (isset($user_keywords)) echo ($user_keywords); ?></textarea>										
								<p class="help-block">Máximo de 200 caracteres.</p>

					
							</div> 
						</div>		

						<div class="form-group-separator"></div>											
				
						<div class="row col-lg-9 col-md-9 text-center">				
							<input type="submit" class="btn btn-success btn-lg" value="Salvar dados" name="SendSeo">
						</div>								

					</form>
				</div>

				<?php /*************** /SEO ***************/ ?>





				
			</div>
		</div>

	</div>
</div>
</div>
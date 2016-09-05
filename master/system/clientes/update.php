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
		<h1 class="title">Clientes</h1>
		<p class="description">Gerencie clientes no sistema</p>
	</div>

	<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1" >
			<li><a href="painel.php"><i class="fa-home"></i>Home</a></li>
			<li><a href="painel.php?exe=clientes/index">Clientes</a></li>
			<li class="active"><strong>Atualizar Cliente</strong></li>
		</ol>
	</div>
	
</div>

<section>
	<div class="row">
		<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Atualizar dados do Cliente</h3>
					<div class="panel-options">
							<a href="#" data-toggle="panel">
								<span class="collapse-icon">&ndash;</span>
								<span class="expand-icon">+</span>
							</a>
							<a href="#" data-toggle="remove">
								&times;
							</a>
					</div>
				</div>
				<div class="panel-body">

			        <?php
			        $ClienteData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
			        $editid = filter_input(INPUT_GET, 'editid', FILTER_VALIDATE_INT);

			        if ($ClienteData && $ClienteData['SendPostForm']):
			            unset($ClienteData['SendPostForm']);

			            require('_models/AdminUser.class.php');
			            $cadastra = new AdminUser;
			            $cadastra->ExeUpdate($editid, $ClienteData);

				        if ($cadastra->getResult()):
				            header('Location: painel.php?exe=clientes/update&editid='.$editid);		        				        
				        else:
				            WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
				        endif;			        	

			        else:
					 	# MOSTRA A MENSAGEM DE SUCESSO VINDO DA PÁGINA CROP-IMAGE.PHP #
				        if(!empty($_SESSION['sucesso'])):
				            WSErro($_SESSION['sucesso'], WS_ACCEPT);
				            unset($_SESSION['sucesso']);
				        endif;	

				        # Faz a leitura do banco e mostra os campos preenchidos.
			            $ReadUser = new Read;
			            $ReadUser->ExeRead("nit_users", "WHERE user_id = :userid", "userid={$editid}");
			            if (!$ReadUser->getResult()):

			            else:
			                $ClienteData = $ReadUser->getResult()[0];
			                unset($ClienteData['user_password']);
			            endif;
			        endif;
			        ?>			    				
					
					<form role="form" class="form-horizontal validate" method="post">

						<!-- Nome -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="user_fullname">Nome do Cliente</label> 
							<div class="col-sm-9"> 
								<input 
								type="text" 
								class="form-control" 
								name="user_fullname" 
								value="<?php if (!empty($ClienteData['user_fullname'])) echo $ClienteData['user_fullname']; ?>" 
								required> 
							</div> 
						</div>

						<div class="form-group-separator"></div>

						<!-- Username -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="user_username">Username</label> 
							<div class="col-sm-9"> 
								<input 
								type="text" 
								class="form-control" 
								name="user_username" 
								value="<?php if (!empty($ClienteData['user_username'])) echo $ClienteData['user_username']; ?>" 
								required> 
							</div> 
						</div>

						<div class="form-group-separator"></div>

						<!-- Email do cliente -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="user_email">Email de acesso</label> 
							<div class="col-sm-9"> 
								<input 
								type="email" 
								class="form-control" 
								name="user_email" 
								value="<?php if (!empty($ClienteData['user_email'])) echo $ClienteData['user_email']; ?>" 
								required 
								autocomplete="off"> 
							</div> 
						</div>

						<div class="form-group-separator"></div>

						<!-- Email do cliente -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="user_password">Senha de acesso</label> 
							<div class="col-sm-9"> 
								<input type="password" class="form-control" name="user_password"> 
							</div> 
						</div>

						<div class="form-group-separator"></div>

						<!-- Tema escolhido -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="theme_id">Tema</label> 
							<div class="col-sm-9"> 
								<?php
								#carrega os Temas no Banco.
								$read = new Read;
								$read->ExeRead('nit_themes');
								if($read->getResult()): 
								?>

								<select class="form-control" id="categoriaSelect" name="theme_id" required="required" required aria-required="true">

									<?php foreach ($read->getResult() as $theme): ?>						
									<?php extract($theme); ?>
										<option <?php if (!empty($ClienteData['theme_id']) && $ClienteData['theme_id'] == $theme_id) echo 'selected'; ?>
										value="<?php echo $theme_id; ?>"><?php echo $theme_name; ?></option>
									<?php endforeach; ?>						
								</select>
  								
							  	<?php endif; ?>								
							</div> 
						</div>

						<div class="form-group-separator"></div>

						<!-- Domínio personalizado -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="user_username">Domínio personalizado</label> 
							<div class="col-sm-9"> 
								<input type="text" class="form-control" name="user_domain" value="<?php if($ClienteData['user_domain']) echo $ClienteData['user_domain'] ?>"> 
							</div> 
						</div>

						<div class="form-group-separator"></div>						

						<!-- Status -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label">Status</label>
							<div class="col-sm-9"> 
								<select class="form-control" name="user_status">
                        			<option value="" selected> Selecione o status </option>
									<option <?php if (isset($ClienteData['user_status']) && $ClienteData['user_status'] == 1) echo 'selected'; ?> value="1">Ativo</option>
									<option <?php if (isset($ClienteData['user_status']) && $ClienteData['user_status'] == 0) echo 'selected'; ?> value="0">Inativo</option>										
								</select>
							</div> 
						</div>
																						
						<!-- Data de término -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label">Data de término do plano</label>
							<div class="col-sm-9"> 
								<div class="input-group"> 
									<div class="input-group-addon"> 
										<a href="#"><i class="linecons-calendar"></i></a> 
									</div> 
									<input 
									type="text" 
									class="form-control datepicker" 
									
									name="user_datafim" 
									value="<?php if (isset($ClienteData['user_datafim'])) echo date('d/m/Y', strtotime($ClienteData['user_datafim'])); ?>" 
									/> 

									<!-- PAREI CONSERTANDO ESSA PARTE DA DATA--> 

								</div>
							</div> 
						</div>

						<!-- Btn envia -->
						<div class="pull-right">				
							<input type="submit" class="btn btn-success btn-lg" value="Atualizar Cliente" name="SendPostForm">
						</div>								

					</form>
				
				</div>
			</div>
		
		</div>
	</div>
</section>


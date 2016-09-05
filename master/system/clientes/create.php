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
		<p class="description">Cadastre clientes no sistema</p>
	</div>

	<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1" >
			<li><a href="painel.php"><i class="fa-home"></i>Home</a></li>
			<li><a href="painel.php?exe=clientes/index">Clientes</a></li>
			<li class="active"><strong>Cadastrar Cliente</strong></li>
		</ol>
	</div>
	
</div>

<section>
	<div class="row">
		<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Adicionar Cliente</h3>
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
				    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
				    if (isset($form) && $form['SendPostForm']):
				        unset($form['SendPostForm']);
				        unset($form['fakepassword']);
				    	$form['user_level'] = 2; # Nível do cliente é sempre 2.
				    	$form['user_status'] = 1; # Já insere o cliente como ATIVO.

				        require('_models/AdminUser.class.php');
				        $cadastra = new AdminUser;
				        $cadastra->ExeCreate($form);

				        if ($cadastra->getResult()):
				            header('Location: painel.php?exe=clientes/index');
				        else:
				            WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
				        endif;
				    endif;
				    ?>						
					
					<form role="form" class="form-horizontal validate" method="post">

						<!-- Nome -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="user_fullname">Nome do Cliente</label> 
							<div class="col-sm-9"> 
								<input type="text" class="form-control" name="user_fullname" value="<?php if($form['user_fullname']) echo $form['user_fullname'] ?>" required> 
							</div> 
						</div>

						<div class="form-group-separator"></div>

						<!-- Username -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="user_username">Username</label> 
							<div class="col-sm-9"> 
								<input type="text" class="form-control" name="user_username" value="<?php if($form['user_username']) echo $form['user_username'] ?>" required> 
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
								value="<?php if($form['user_email']) echo $form['user_email'] ?>" 
								required 
								autocomplete="off"> 
							</div> 
						</div>

						<div class="form-group-separator"></div>

						<!-- Email do cliente -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="user_password">Senha de acesso</label> 
							<div class="col-sm-9"> 
								<input style="display:none" type="password" name="fakepassword"/>
								<input type="password" class="form-control" name="user_password" required> 
							</div> 
						</div>

						<div class="form-group-separator"></div>

			
						<!-- Btn envia -->
						<div class="pull-right">				
							<input type="submit" class="btn btn-success btn-lg" value="Cadastrar Cliente" name="SendPostForm">
						</div>								

					</form>
				
				</div>
			</div>
		
		</div>
	</div>
</section>


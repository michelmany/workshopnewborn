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
		<h1 class="title">Depoimentos</h1>
		<p class="description">Gerencie seus depoimentos</p>
	</div>

	<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1" >
			<li><a href="painel.php"><i class="fa-home"></i>Home</a></li>
			<li><a href="painel.php?exe=depoimentos/index">Depoimentos</a></li>
			<li class="active"><strong>Criar depoimento</strong></li>
		</ol>
	</div>
	
</div>

<section>
	<div class="row">
		<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Adicionar depoimento</h3>
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

				        require('_models/AdminDepoimento.class.php');
				        $cadastra = new AdminDepoimento;
				        $cadastra->ExeCreate($form);

				        if ($cadastra->getResult()):
				            header('Location: painel.php?exe=depoimentos/index');
				        else:
				            WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
				        endif;
				    endif;
				    ?>						
					
					<form role="form" class="form-horizontal validate" method="post" >

						<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

						<!-- Nome -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Nome de quem enviou</label> 
							<div class="col-sm-9"> 
								<input type="text" class="form-control" name="depo_nome" value="<?php if($form['depo_nome']) echo $form['depo_nome'] ?>" required> 
							</div> 
						</div>

						<div class="form-group-separator"></div>			

						<!-- Data -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label">Data do depoimento</label>
							<div class="col-sm-9"> 
								<div class="input-group"> 
									<div class="input-group-addon"> 
										<a href="#"><i class="linecons-calendar"></i></a> 
									</div> 
									<input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" name="depo_date" value="<?php if($form['depo_date']) echo $form['depo_date'] ?>" required> 
								</div>
							</div> 
						</div>

						<div class="form-group-separator"></div>

						<!-- Descrição -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Mensagem</label> 
							<div class="col-sm-9"> 
								<textarea class="form-control" rows="10" name="depo_msg" required><?php if($form['depo_msg']) echo $form['depo_msg'] ?></textarea>										
							</div> 
						</div>	
						
						<!-- Btn envia -->
						<div class="pull-right">				
							<input type="submit" class="btn btn-success btn-lg" value="Adicionar Depoimento" name="SendPostForm">
						</div>								

					</form>
				
				</div>
			</div>
		
		</div>
	</div>
</section>


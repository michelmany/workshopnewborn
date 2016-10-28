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
		<h1 class="title">Cursos</h1>
		<p class="description">Gerencie seus cursos</p>
	</div>

	<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1" >
			<li><a href="painel.php"><i class="fa-home"></i>Home</a></li>
			<li><a href="painel.php?exe=workshops/index">cursos</a></li>
			<li class="active"><strong>Cadastrar curso</strong></li>
		</ol>
	</div>
	
</div>

<section>
	<div class="row">
		<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Cadastrar curso</h3>
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
			            $form['workshop_capa'] = ( $_FILES['workshop_capa']['tmp_name'] ? $_FILES['workshop_capa'] : null );
			            unset($form['SendPostForm']);				    

				        require('_models/AdminWorkshop.class.php');
				        $cadastra = new AdminWorkshop;
				        $cadastra->ExeCreate($form);

				        if ($cadastra->getResult()):
				            header('Location: painel.php?exe=workshops/index');
				        else:
				            WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
				        endif;
				    endif;
				    ?>						
					
					<form role="form" class="form-horizontal validate" method="post" enctype="multipart/form-data">

						<!-- Imagem de capa -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Imagem de capa</label> 
							<div class="col-sm-9"> 
								<input type="file" class="form-control" id="field-1" name="workshop_capa" required> 
							</div> 
						</div>

						<div class="form-group-separator"></div>						

						<!-- Nome -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Título</label> 
							<div class="col-sm-9"> 
								<input type="text" class="form-control" name="workshop_nome" value="<?php if($form['workshop_nome']) echo $form['workshop_nome'] ?>" required> 
							</div> 
						</div>

						<div class="form-group-separator"></div>			

						<!-- Data -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label">Data do curso</label>
							<div class="col-sm-9"> 
								<div class="input-group"> 
									<div class="input-group-addon"> 
										<a href="#"><i class="linecons-calendar"></i></a> 
									</div> 
									<input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" name="workshop_date" value="<?php if($form['workshop_date']) echo $form['workshop_date'] ?>" required> 
								</div>
							</div> 
						</div>

						<div class="form-group-separator"></div>						

						<!-- Vagas -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Local</label> 
							<div class="col-sm-9"> 
								<input type="text" class="form-control" name="workshop_local" value="<?php if($form['workshop_local']) echo $form['workshop_local'] ?>"> 
							</div> 
						</div>						

						<div class="form-group-separator"></div>

						<!-- Vagas -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Quantidade de vagas</label> 
							<div class="col-sm-9"> 
								<input type="text" class="form-control" name="workshop_vagas" value="<?php if($form['workshop_vagas']) echo $form['workshop_vagas'] ?>" required> 
							</div> 
						</div>

						<div class="form-group-separator"></div>						

						<!-- Descrição -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Detalhes</label> 
							<div class="col-sm-9"> 
								<textarea class="form-control ckeditor" rows="10" name="workshop_msg" required>
									<?php if($form['workshop_msg']) echo $form['workshop_msg'] ?>
								</textarea>										
							</div> 
						</div>

						<div class="form-group-separator"></div>						

						<!-- Investimento -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Investimento</label> 
							<div class="col-sm-9"> 
								<textarea class="form-control" rows="5" name="workshop_investimento" required><?php if($form['workshop_investimento']) echo $form['workshop_investimento'] ?></textarea>										
							</div> 
						</div>															
						
						<!-- Btn envia -->
						<div class="pull-right">				
							<input type="submit" class="btn btn-success btn-lg" value="Cadastrar Workshop" name="SendPostForm">
						</div>								

					</form>
				
				</div>
			</div>
		
		</div>
	</div>
</section>


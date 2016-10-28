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
			<li class="active"><strong>Editar curso</strong></li>
		</ol>
	</div>
	
</div>

<section>
	<div class="row">
		<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Editar curso</h3>
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
			    	$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
				    $form 	= filter_input_array(INPUT_POST, FILTER_DEFAULT);

				    if (isset($form) && $form['SendPostForm']):
				        unset($form['SendPostForm']);

				        require('_models/AdminWorkshop.class.php');
				        $cadastra = new AdminWorkshop;
				        $cadastra->ExeUpdate($id, $form);

				        if ($cadastra->getResult()):
				            header('Location: painel.php?exe=workshops/index');
				        else:
				            WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
				        endif;
				    endif;
				    ?>					

				    <?php 
				    	# Faz leitura no banco para mostrar os campos preenchidos
				    	$read = new Read;
				    	$read->ExeRead("nit_workshops", "WHERE workshop_id = :id", "id={$id}");
				    	$row = $read->getResult()[0];

						if (!$read->getResult()):
						    header('Location: painel.php?exe=workshops/index&empty=true');
						else:
						    $row = $read->getResult()[0];
						endif;


				     ?>					    					
					
					<form role="form" class="form-horizontal validate" method="post" enctype="multipart/form-data">

						<!-- Capa do Workshop -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Capa do Álbum</label> 
							<div class="col-sm-9"> 
								<div class="fileinput fileinput-exists" data-provides="fileinput">
								  <div class="fileinput-new thumbnail" style="max-width: 360px; max-height: 240px;">
								   <img src="http://dummyimage.com/600x400/e3e3e3/ffffff.jpg&text=Sem+imagem">
								  </div>
								  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 360px; max-height: 240px;">
								  	<img src="../uploads/<?php if(isset($row['workshop_capa'])) echo $row['workshop_capa']; ?>?<?= time(); ?>"> <!-- O time é para limpar o cache -->
								  </div>
								  <div class="text-center">
								    <span class="btn btn-primary btn-file "><span class="fileinput-new">Selecionar Capa</span>
								    <span class="fileinput-exists">Trocar Capa</span>
								    <input type="file" name="workshop_capa"></span>
								    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remover</a>
								  </div>
								</div>									
							</div> 
						</div>

						<div class="form-group-separator"></div>						

						<!-- Nome -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Título</label> 
							<div class="col-sm-9"> 
								<input type="text" class="form-control" name="workshop_nome" value="<?php if (!empty($row['workshop_nome'])) echo $row['workshop_nome']; ?>" required> 
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
									<input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" name="workshop_date" value="<?php if (!empty($row['workshop_date'])) echo date('d/m/Y', strtotime($row['workshop_date'])) ?>" required> 
								</div>
							</div> 
						</div>

						<div class="form-group-separator"></div>						

						<!-- Vagas -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Local</label> 
							<div class="col-sm-9"> 
								<input type="text" class="form-control" name="workshop_local" value="<?php if (!empty($row['workshop_local'])) echo $row['workshop_local']; ?>"> 
							</div> 
						</div>						

						<div class="form-group-separator"></div>

						<!-- Vagas -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Quantidade de vagas</label> 
							<div class="col-sm-9"> 
								<input type="text" class="form-control" name="workshop_vagas" value="<?php if (!empty($row['workshop_vagas'])) echo $row['workshop_vagas']; ?>" required> 
							</div> 
						</div>

						<div class="form-group-separator"></div>						

						<!-- Descrição -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Detalhes</label> 
							<div class="col-sm-9"> 
								<textarea class="form-control ckeditor" rows="10" name="workshop_msg" required>
									<?php if (!empty($row['workshop_msg'])) echo $row['workshop_msg']; ?>
								</textarea>										
							</div> 
						</div>

						<div class="form-group-separator"></div>						

						<!-- Investimento -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Investimento</label> 
							<div class="col-sm-9"> 
								<textarea class="form-control" rows="5" name="workshop_investimento" required><?php if (!empty($row['workshop_investimento'])) echo $row['workshop_investimento']; ?></textarea>										
							</div> 
						</div>															
						
						<!-- Btn envia -->
						<div class="pull-right">				
							<input type="submit" class="btn btn-success btn-lg" value="Atualizar Workshop" name="SendPostForm">
						</div>								

					</form>
				
				</div>
			</div>
		
		</div>
	</div>
</section>


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
		<h1 class="title">Vídeos</h1>
		<p class="description">Gerencie seus vídeos</p>
	</div>

	<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1" >
			<li><a href="painel.php"><i class="fa-home"></i>Home</a></li>
			<li><a href="painel.php?exe=videos/index">Vídeos</a></li>
			<li class="active"><strong>Criar video</strong></li>
		</ol>
	</div>
	
</div>

<section>
	<div class="row">
		<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Adicionar video</h3>
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

				        require('_models/AdminVideo.class.php');
				        $cadastra = new AdminVideo;
				        $cadastra->ExeCreate($form);

				        if ($cadastra->getResult()):
				            header('Location: painel.php?exe=videos/index');
				        else:
				            WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
				        endif;
				    endif;
				    ?>						
					
					<form role="form" class="form-horizontal validate" method="post" >

						<!-- Titulo -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Titulo (opcional)</label> 
							<div class="col-sm-9"> 
								<input type="text" class="form-control" name="video_title" value="<?php if($form['video_title']) echo $form['video_title'] ?>"> 
							</div> 
						</div>

						<div class="form-group-separator"></div>			

						<!-- ID (URL) -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label">ID do Vídeo Youtube</label>
							<div class="col-sm-9"> 
								<div class="input-group"> 
									<span class="input-group-addon">https://www.youtube.com/watch?v=</span> 
									<input type="text" class="form-control" name="video_url" value="<?php if($form['video_url']) echo $form['video_url'] ?>" required> 
								</div>
									<p class="help-block">Somente o ID. Exemplo: XSGBVzeBUbk</p>
							</div> 
						</div>

						<div class="form-group-separator"></div>

					<?php /* 
						<!-- Descrição -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Mensagem</label> 
							<div class="col-sm-9"> 
								<textarea class="form-control" rows="5" name="depo_msg" required><?php if($form['depo_msg']) echo $form['depo_msg'] ?></textarea>										
							</div> 
						</div>	
					*/ ?>	
						
						<!-- Btn envia -->
						<div class="pull-right">				
							<input type="submit" class="btn btn-success btn-lg" value="Adicionar Vídeo" name="SendPostForm">
						</div>								

					</form>
				
				</div>
			</div>
		
		</div>
	</div>
</section>


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
		<p class="description">Gerencie seus videos</p>
	</div>

	<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1" >
			<li><a href="dashboard-1.html"><i class="fa-home"></i>Home</a></li>
			<li><a href="tables-basic.html">Vídeos</a></li>
			<li class="active"><strong>Atualizar video</strong></li>
		</ol>
	</div>
	
</div>

<section>
	<div class="row">
		<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Atualizar video</h3>
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
			    	$videoID = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
				    $form 	= filter_input_array(INPUT_POST, FILTER_DEFAULT);

				    if (isset($form) && $form['SendPostForm']):
				        unset($form['SendPostForm']);

				        require('_models/AdminVideo.class.php');
				        $cadastra = new AdminVideo;
				        $cadastra->ExeUpdate($videoID, $form);

				        if ($cadastra->getResult()):
				            header('Location: painel.php?exe=videos/index');
				        else:
				            WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
				        endif;
				    endif;
				    ?>					

				    <?php 
				    	# Faz leitura no banco para mostrar os campos preenchidos
				    	$read = new Read;
				    	$read->ExeRead("nit_videos", "WHERE video_id = :id", "id={$videoID}");
				    	$row = $read->getResult()[0];

						if (!$read->getResult()):
						    header('Location: painel.php?exe=videos/index&empty=true');
						else:
						    $row = $read->getResult()[0];
						endif;
				     ?>	
					
					<form role="form" class="form-horizontal validate" method="post" >

						<!-- Titulo -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Titulo (opcional)</label> 
							<div class="col-sm-9"> 
								<input type="text" class="form-control" name="video_title" value="<?php if (!empty($row['video_title'])) echo $row['video_title']; ?>"> 
							</div> 
						</div>

						<div class="form-group-separator"></div>			

						<!-- ID (URL) -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label">ID do Vídeo Youtube</label>
							<div class="col-sm-9"> 
								<div class="input-group"> 
									<span class="input-group-addon">https://www.youtube.com/watch?v=</span> 
									<input type="text" class="form-control" name="video_url" value="<?php if (!empty($row['video_url'])) echo $row['video_url']; ?>" required> 
								</div>
									<p class="help-block">Somente o ID. Exemplo: XSGBVzeBUbk</p>
							</div> 
						</div>

						<div class="form-group-separator"></div>

						
						<!-- Btn envia -->
						<div class="pull-right">				
							<input type="submit" class="btn btn-success btn-lg" value="Atualizar video" name="SendPostForm">
						</div>								

					</form>
				
				</div>
			</div>
		
		</div>
	</div>

</section>


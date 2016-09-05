<?php 
# Não permite o acesso direto à URL sem estar logado.
if (!class_exists('Login')) :
	header('Location: ../../painel.php');
	die;
endif;
?>

<!-- CABEÇALHO -->
<div class="page-title">

	<div class="title-env">
		<h1 class="title">Sliders </h1>
		<p class="description">Edite banners na Página principal</p>
	</div>

	<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1" >
			<li><a href="dashboard-1.html"><i class="fa-home"></i>Home</a></li>
			<li><a href="tables-basic.html">Sliders</a></li>
			<li class="active"><strong>Editar</strong></li>
		</ol>
	</div>
	
</div>

<!-- TABLE -->
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Editar Slide</h3>
				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">&ndash;</span>
						<span class="expand-icon">+</span>
					</a>
					<a href="#" data-toggle="remove">&times;</a>
				</div>
			</div>

			<div class="panel-body">

			<?php 
				#recebe o array com os dados via post e também o id do slider via get
				$slider 	= filter_input_array(INPUT_POST, FILTER_DEFAULT);
				$sliderid 	= filter_input(INPUT_GET, 'sliderid', FILTER_VALIDATE_INT);

				# faz verificação e executa a atualização #	
				if (isset($slider) && $slider['SendPostForm']):
				    $slider['slider_status'] = ($slider['SendPostForm'] == 'Cadastrar' ? '0' : '1' );
				    $slider['slider_url_img'] = ( $_FILES['slider_url_img']['tmp_name'] ? $_FILES['slider_url_img'] : null );
				    unset($slider['SendPostForm']);

				    require('_models/AdminSlider.class.php');
				    $cadastra = new AdminSlider;
				    $cadastra->ExeUpdate($sliderid, $slider);

				    if ($cadastra->getResult()):

				    	WSErro($cadastra->getError()[0], $cadastra->getError()[1]);

						/*
				        if (!empty($_FILES['gallery_covers']['tmp_name'])):
				            $sendGallery = new AdminSlider;
				            $sendGallery->gbSend($_FILES['gallery_covers'], $cadastra->getResult());
				        endif;
				        */

				        header('Location: painel.php?exe=slider/crop&sliderid=' . $sliderid );
				    else:
				    	WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
				    endif;
				endif;


				# Faz leitura no banco para trazer os resultados dos campos preenchidos #
				$read = new Read;
				$read->ExeRead("nit_slider", "WHERE slider_id = :id", "id={$sliderid}");
				        
				if (!$read->getResult()):
				    header('Location: painel.php?exe=slider/index&empty=true');
				else:
				    $slider = $read->getResult()[0];

					# Medida de segurança, se o id for alterado na url e o slider não pertencer ao usuário logado, redireciona pra index.
					if ($slider['user_id'] != $userlogin['user_id']):
						header('Location: painel.php?exe=slider/index&empty=true');
					endif;	

				endif;
			?>

				<form role="form" data-toggle="validator" name="PostForm" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
				
					<div class="col-lg-6 col-md-12 col-sm-12">

						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-1">Título 1</label>

							<div class="col-sm-10">
								<input type="text" name="slider_title1" value="<?php if (isset($slider['slider_title2'])) echo $slider['slider_title1']; ?>" class="form-control" placeholder="Tipo de trabalho" required>
								<p class="help-block with-errors">Ex.: Casamento</p>
							</div>
						</div>

						<div class="form-group-separator"></div>

						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-1">Título 2</label>

							<div class="col-sm-10">
								<input type="text" name="slider_title2" value="<?php if (isset($slider['slider_title2'])) echo $slider['slider_title2']; ?>" class="form-control" placeholder="Nome dos noivos ou do ensaio" required>
								<p class="help-block with-errors">Ex.: Romeu & Julieta</p>
							</div>
						</div>

						<div class="form-group-separator"></div>

						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-1">Título 3</label>

							<div class="col-sm-10">
								<input type="text" name="slider_title3" value="<?php if (isset($slider['slider_title3'])) echo $slider['slider_title3']; ?>" class="form-control" id="field-1" placeholder="Local onde foi realizado" required>
								<p class="help-block with-errors">Ex.: Niterói/RJ</p>
							</div>
						</div>
						<div class="form-group-separator"></div>																
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-1">Link</label>

							<div class="col-sm-10">
								<input type="text" name="slider_link" value="<?php if (isset($slider['slider_link'])) echo $slider['slider_link']; ?>" class="form-control" placeholder="URL do link">
								<p class="help-block">Ex.: http://seudominio.com.br/album/casamento/romeu-e-julieta</p>
							</div>
						</div>									

					</div>

					<div class="col-lg-6">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-1">Imagem</label>

							<div class="col-sm-10">
								<div class="fileinput fileinput-exists" data-provides="fileinput">
								  <div class="fileinput-new thumbnail" style="max-width: 360px; max-height: 240px;">
								   <img src="http://dummyimage.com/600x400/e3e3e3/ffffff.jpg&text=Sem+imagem">
								  </div>
								  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 360px; max-height: 240px;">
								  	<img src="../uploads/<?php echo $slider['slider_url_img']; ?>?<?= time(); ?>">
								  </div>
								  <div class="text-center">
								    <span class="btn btn-primary btn-file "><span class="fileinput-new">Selecionar imagem</span>
								    <span class="fileinput-exists">Trocar imagem</span>
								    <input type="file" name="slider_url_img"></span>
								    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remover</a>
								  </div>
								</div>	

							</div>
						</div>		

					</div>

					<div class="row col-lg-12 text-center">				
						<input type="submit" class="btn btn-white btn-lg" value="Atualizar" name="SendPostForm">
						<input type="submit" class="btn btn-success btn-lg" value="Atualizar & Publicar" name="SendPostForm">
					</div>
				</form>

			</div>
		</div>

	</div>
	
</div><!-- /row -->
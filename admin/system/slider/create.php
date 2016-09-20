<?php 
# Não permite o acesso direto à URL sem estar logado.
if (!class_exists('Login')) :
	header('Location: ../../painel.php');
	die;
endif;
?>

<div class="page-title">

	<div class="title-env">
		<h1 class="title">Sliders</h1>
		<p class="description">Adicione banners na Página principal</p>
	</div>

	<div class="breadcrumb-env">

		<ol class="breadcrumb bc-1" >
			<li>
				<a href="dashboard-1.html"><i class="fa-home"></i>Home</a>
			</li>
			<li>

				<a href="tables-basic.html">Sliders</a>
			</li>
			<li class="active">

				<strong>Adicionar</strong>
			</li>
		</ol>

	</div>
	
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Adicionar Slide</h3>
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
		    $slider = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		    if (isset($slider) && $slider['SendPostForm']):
		        $slider['slider_status'] = ($slider['SendPostForm'] == 'Cadastrar' ? '0' : '1' );
		        $slider['slider_url_img'] = ( $_FILES['slider_url_img']['tmp_name'] ? $_FILES['slider_url_img'] : null );
		        unset($slider['SendPostForm']);

		        require('_models/AdminSlider.class.php');
		        $cadastra = new AdminSlider;
		        $cadastra->ExeCreate($slider);

		        if ($cadastra->getResult()):
		            /* header('Location: painel.php?exe=slider/crop&sliderid=' . $cadastra->getResult()); */
		            header('Location: painel.php?exe=slider/index');
		        else:
		            WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
		        endif;
		    endif;
		    ?>
    	
				<form role="form" name="PostForm" action="" method="post" enctype="multipart/form-data" class="form-horizontal validate">
				
					<div class="col-lg-6 col-md-12 col-sm-12">

						<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-1">Título 1</label>
							<div class="col-sm-10">
								<input type="text" name="slider_title1" value="<?php if (isset($slider['slider_title2'])) echo $slider['slider_title1']; ?>" class="form-control" placeholder="Tipo de trabalho">
								<p class="help-block with-errors">Ex.: Casamento</p>
							</div>
						</div>

						<div class="form-group-separator"></div>

						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-1">Título 2</label>
							<div class="col-sm-10">
								<input type="text" name="slider_title2" value="<?php if (isset($slider['slider_title2'])) echo $slider['slider_title2']; ?>" class="form-control" placeholder="Nome dos noivos ou do ensaio">
								<p class="help-block">Ex.: Romeu & Julieta</p>
							</div>
						</div>

						<div class="form-group-separator"></div>

						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-1">Título 3</label>
							<div class="col-sm-10">
								<input type="text" name="slider_title3" value="<?php if (isset($slider['slider_title3'])) echo $slider['slider_title3']; ?>" class="form-control" id="field-1" placeholder="Local onde foi realizado">
								<p class="help-block">Ex.: Niterói/RJ</p>
							</div>
						</div>

						<div class="form-group-separator"></div>	

						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-1">Link</label>

							<?php 
							$buscaAlbum = new Read;
							$buscaAlbum->ExeRead('nit_albuns', "WHERE user_id = :userid", "userid={$user_id}");

							if ($buscaAlbum->getResult()): ?>

							<div class="col-sm-10">
								<select class="form-control" id="categoriaSelect" name="slider_link">
									<option value="" selected="" disabled="">Escolha o álbum que será linkado</option>
									<?php foreach ($buscaAlbum->getResult() as $album): ?>						
									<?php extract($album); ?>
										<option value="<?php echo $album_url; ?>"><?php echo $album_nome; ?></option>
									<?php endforeach; ?>
								</select>	
							</div>
							<?php
							else: 
								echo 'Nenhum album cadastrado no sistema!';							
							endif; 
							?>
						</div>									

					</div>

					<div class="col-lg-6">
						<div class="form-group">

							<div class="col-lg-12 text-right">
								<div class="fileinput fileinput-new" data-provides="fileinput">
								  <div class="fileinput-new thumbnail" style="width: 360px; height: 240px;">
								    <img src="http://dummyimage.com/600x400/e3e3e3/ffffff.jpg&text=Sem+imagem" alt="...">
								  </div>
								  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 360px; max-height: 240px;"></div>
								  <div class="text-center">
								    <span class="btn btn-primary btn-file "><span class="fileinput-new">Selecionar imagem</span><span class="fileinput-exists">Trocar</span> <input type="file" data-validate="required" data-message-required=" - Eiii.. escolha uma imagem!" name="slider_url_img"></span>
								    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remover</a>
								  </div>
								</div>	

							</div>
						</div>		

					</div>
					<div class="col-lg-12 text-center">		
						<hr>		
						<input type="submit" class="btn btn-success btn-lg" value="Cadastrar Slide" name="SendPostForm">
					</div>
				</form>

			</div>
		</div>

	</div>
	
</div><!-- /row -->
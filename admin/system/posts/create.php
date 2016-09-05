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
		<h1 class="title">Posts</h1>
		<p class="description">Gerencie seus posts do Blog</p>
	</div>

	<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1" >
			<li><a href="painel.php"><i class="fa-home"></i>Home</a></li>
			<li><a href="painel.php?exe=posts/index">Posts</a></li>
			<li class="active"><strong>Criar álbum</strong></li>
		</ol>
	</div>
	
</div>

<section class="form-create-post">
			<div class="row">
				
				
				<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
					
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Adicionar Postagem</h3>
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
					        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
					        if (isset($post) && $post['SendPostForm']):
					            $post['post_status'] = ($post['SendPostForm'] == 'Cadastrar' ? '1' : '1' );
					            $post['post_capa'] = ( $_FILES['post_capa']['tmp_name'] ? $_FILES['post_capa'] : null );
					            unset($post['SendPostForm']);

					            require('_models/AdminPost.class.php');
					            $cadastra = new AdminPost;
					            $cadastra->ExeCreate($post);

					            if ($cadastra->getResult()):

				                if (!empty($_FILES['gallery_covers']['tmp_name'])):
				                    $sendGallery = new AdminPost;
				                    $sendGallery->gbSend($_FILES['gallery_covers'], $cadastra->getResult(), $user_id);
				                endif;

					                header('Location: painel.php?exe=posts/index&postid=' . $cadastra->getResult());
					            else:
					                WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
					            endif;
					        endif;
					        ?>						
							
							<form name="PostForm" action="" method="post" class="form-horizontal" enctype="multipart/form-data">

								<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

								<!-- Nome do álbum -->
								<div class="form-group"> 
									<label class="col-sm-3 control-label" for="field-1">Capa do Post</label> 
									<div class="col-sm-9"> 
										<input type="file" class="form-control" id="field-1" name="post_capa" required> 
									</div> 
								</div>

								<div class="form-group-separator"></div>

								<!-- Nome do álbum -->
								<div class="form-group"> 
									<label class="col-sm-3 control-label" for="field-1">Nome do Post</label> 
									<div class="col-sm-9"> 
										<input type="text" class="form-control" id="field-1" placeholder="" name="post_nome" required> 
										<p class="help-block">Ex.: Maria e João</p>
									</div> 
								</div>

								<div class="form-group-separator"></div>			

								<!-- Vídeo -->
								<div class="form-group"> 
									<label class="col-sm-3 control-label" for="field-1">ID do vídeo no vimeo</label> 
									<div class="col-sm-9">
									<div class="input-group">
										<span class="input-group-addon">https://vimeo.com/</span>
										<input type="text" class="form-control" id="field-1" placeholder="81492863" name="post_video"> 
									</div> 
									</div>
								</div>	

								<div class="form-group-separator"></div>			

								<!-- Local -->
								<div class="form-group"> 
									<label class="col-sm-3 control-label" for="field-1">Local</label> 
									<div class="col-sm-9"> 
										<input type="text" class="form-control" id="field-1" placeholder="" name="post_local" required> 
										<p class="help-block">Ex.: Niterói / RJ</p>

									</div> 
								</div>	
								
								<div class="form-group-separator"></div>			

								<!-- Categoria -->
								<div class="form-group">
									<label class="col-sm-3 control-label">Categoria</label>
									<div class="col-sm-9"> 
										<?php
										#carrega as categorias do banco.
										$read = new Read;
										$read->ExeRead('nit_posts_cats', "WHERE user_id = '$userlogin[user_id]'");
										?>

										<?php if($read->getResult()): ?>
										<select class="form-control" id="categoriaSelect" name="post_categoria_id" required="required" required aria-required="true">
											<?php foreach ($read->getResult() as $categoria): ?>						
											<?php extract($categoria); ?>
												<option  value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
											<?php endforeach; ?>
										</select>

										<?php else:
										echo '<h4>Primeiro adicione uma <a href="painel.php?exe=posts/categorias" title="Adicionar categoria">categoria</a>!</h4>';
										 ?>

									  	<?php endif; ?>
									</div> 
								</div>										

								<div class="form-group-separator"></div>		

								<!-- Data -->
								<div class="form-group"> 
									<label class="col-sm-3 control-label">Data</label>
									<div class="col-sm-9"> 
										<div class="input-group"> 
											<div class="input-group-addon"> 
												<a href="#"><i class="linecons-calendar"></i></a> 
											</div> 
											<input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" name="post_data" required> 
										</div>
									</div> 
								</div>

								<div class="form-group-separator"></div>

								<!-- Agendar Publicação FICARÁ PARA PRÓXIMA ATUALIZAÇÃO-->
								<!-- <div class="form-group"> 
									<label class="col-sm-3 control-label">Agendar publicação</label>
									<div class="col-sm-9"> 
										<div class="input-group"> 
											<div class="input-group-addon"> 
												<a href="#"><i class="linecons-calendar"></i></a> 
											</div> 
											<input type="text" class="form-control datepicker" data-format="D, dd MM yyyy" name="post_data_agenda"> 
										</div>
									</div> 
								</div> -->
							
								<!-- Descrição -->
								<div class="form-group"> 
									<label class="col-sm-3 control-label" for="field-1">Descrição</label> 
									<div class="col-sm-9"> 
										<textarea class="form-control ckeditor" rows="5" name="post_desc"><?php if (isset($post['post_desc'])) echo htmlspecialchars($post['post_desc']); ?></textarea>										
									</div> 
								</div>	

								<div class="form-group-separator"></div>										

					            <div class="form-group">
									<label class="col-sm-3 control-label" for="field-1">Imagens</label> 
									<div class="col-sm-9">
					                    <input type="file" multiple name="gallery_covers[]" />
									</div> 
					            </div>		

								<div class="form-group-separator"></div>										

								<div class="row col-lg-9 col-md-9 text-center">				
									<input type="submit" class="btn btn-success btn-lg" value="Cadastrar" name="SendPostForm">
								</div>								

							</form>
						
						</div>
					</div>
				
				</div>
			</div>

</section>


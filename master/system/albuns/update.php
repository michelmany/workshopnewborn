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
		<h1 class="title">Álbuns</h1>
		<p class="description">Gerencie seus álbuns</p>
	</div>

	<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1" >
			<li><a href="painel.php"><i class="fa-home"></i>Home</a></li>
			<li><a href="painel.php?exe=albuns/index">Álbuns</a></li>
			<li class="active"><strong>Editar álbum</strong></li>
		</ol>
	</div>
	
</div>

<section class="form-create-album">
	<div class="row">
		
		<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Editar álbum</h3>
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
			        # Recebe todos os dados via post e coloca na variável $post.
			        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		        	# Recebe o ID do álbum via GET e coloca na variável $albumid			        
			        $albumid = filter_input(INPUT_GET, 'albumid', FILTER_VALIDATE_INT);

			        # Faz o Envio para o Banco (Update).
			        if (isset($post) && $post['SendPostForm']):
			            $post['album_status'] = ($post['SendPostForm'] == 'Atualizar' ? '0' : '1' );
			            $post['album_capa'] = ( $_FILES['album_capa']['tmp_name'] ? $_FILES['album_capa'] : 'null' );
			            unset($post['SendPostForm']);

			            require('_models/AdminAlbum.class.php');
			            $cadastra = new AdminAlbum;
			            $cadastra->ExeUpdate($albumid, $post);

			            WSErro($cadastra->getError()[0], $cadastra->getError()[1]);

		                if (!empty($_FILES['gallery_covers']['tmp_name'])):
		                    $sendGallery = new AdminAlbum;
		                    $sendGallery->gbSend($_FILES['gallery_covers'], $albumid);
		                endif;
			        endif;
			        ?>		

			        <?php 
		        	# Faz A leitura do Banco e mostra os dados na tela
	           		$read = new Read;
	           		$read->ExeRead("nit_albuns", "WHERE album_id = :id AND user_id", "id={$albumid}");
	           		if(!$read->getResult()):
	           			header('Location: painel.php?exe=albuns/index&empty=true');
	           		else:
	           			$post = $read->getResult()[0];

						# Medida de segurança, se o id for alterado na url e o slider não pertencer ao usuário logado, redireciona pra index.
						if ($post['user_id'] != $userlogin['user_id']):
							header('Location: painel.php?exe=albuns/index&empty=true');
						endif;	

	           		endif;
			         ?>	

		            <?php 
		            #Deleta a imagem da galeria e mostra mensagem de sucesso ou erro!
			        $delGb = filter_input(INPUT_GET, 'gbdel', FILTER_VALIDATE_INT);
			        $albumid = filter_input(INPUT_GET, 'albumid', FILTER_VALIDATE_INT);
			        if($delGb):
			        	require_once('_models/AdminAlbum.class.php');
			        	$DelGallery = new AdminAlbum;
			        	$DelGallery->gbRemove($delGb, $albumid, $userlogin['user_id']);

			            WSErro($DelGallery->getError()[0], $DelGallery->getError()[1]);
			        	
			        endif;
		             ?>				         

				
					<form name="PostForm" action="" method="post" class="form-horizontal" enctype="multipart/form-data">

						<!-- Capa do álbum -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Capa do Álbum</label> 
							<div class="col-sm-9"> 
								<div class="fileinput fileinput-exists" data-provides="fileinput">
								  <div class="fileinput-new thumbnail" style="max-width: 360px; max-height: 240px;">
								   <img src="http://dummyimage.com/600x400/e3e3e3/ffffff.jpg&text=Sem+imagem">
								  </div>
								  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 360px; max-height: 240px;">
								  	<img src="../uploads/<?php if(isset($post['album_capa'])) echo $post['album_capa']; ?>?<?= time(); ?>"> <!-- O time é para limpar o cache -->
								  </div>
								  <div class="text-center">
								    <span class="btn btn-primary btn-file "><span class="fileinput-new">Selecionar Capa</span>
								    <span class="fileinput-exists">Trocar Capa</span>
								    <input type="file" name="album_capa"></span>
								    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remover</a>
								  </div>
								</div>									
							</div> 
						</div>

						<div class="form-group-separator"></div>								

						<!-- Nome do álbum -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Nome do álbum</label> 
							<div class="col-sm-9"> 
								<input type="text" class="form-control" id="field-1" placeholder="Ex.: Maria e João" name="album_nome" value="<?php if (isset($post['album_nome'])) echo ($post['album_nome']); ?>"> 
							</div> 
						</div>

						<div class="form-group-separator"></div>			

						<!-- Vídeo -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">ID do vídeo no vimeo</label> 
							<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">https://vimeo.com/</span>
								<input type="text" class="form-control" id="field-1" placeholder="81492863" name="album_video" value="<?php if (isset($post['album_video'])) echo ($post['album_video']); ?>"> 
							</div> 
							</div>
						</div>	

						<div class="form-group-separator"></div>			

						<!-- Local -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Local</label> 
							<div class="col-sm-9"> 
								<input type="text" class="form-control" id="field-1" placeholder="Ex.: Niterói / RJ" name="album_local" value="<?php if (isset($post['album_local'])) echo ($post['album_local']); ?>"> 
							</div> 
						</div>	
						
						<div class="form-group-separator"></div>			

						<!-- Categoria -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label">Categoria</label>
							<div class="col-sm-9"> 
								<select class="form-control" id="categoriaSelect" name="album_categoria_id">
								<?php
								$read = new Read;
								$read->ExeRead('nit_albuns_cats');
								?>

								<?php if($read->getResult()): ?>
									<?php foreach ($read->getResult() as $categoria): ?>						
									<?php extract($categoria); ?>
										<option <?php if (isset($post['album_categoria_id']) && $post['album_categoria_id'] == $category_id) echo 'selected'; ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
									<?php endforeach; ?>
							  	<?php endif; ?>

								</select>
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
									<input type="text" class="form-control datepicker" data-format="dd/mm/yyyy" name="album_data" value="<?php if (isset($post['album_data'])) echo date('d/m/Y', strtotime($post['album_data'])); ?>"> 
								</div>
							</div> 
						</div>

						<div class="form-group-separator"></div>

						<!-- Agendar Publicação -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label">Agendar publicação</label>
							<div class="col-sm-9"> 
								<div class="input-group"> 
									<div class="input-group-addon"> 
										<a href="#"><i class="linecons-calendar"></i></a> 
									</div> 
									<input type="text" class="form-control datepicker" data-format="D, dd MM yyyy" name="album_data_agenda"> 
								</div>
							</div> 
						</div>

						<div class="form-group-separator"></div>										

						<!-- Descrição -->
						<div class="form-group"> 
							<label class="col-sm-3 control-label" for="field-1">Descrição</label> 
							<div class="col-sm-9"> 
								<textarea class="form-control ckeditor" rows="5" name="album_desc"><?php if (isset($post['album_desc'])) echo htmlspecialchars($post['album_desc']); ?></textarea>										
							</div> 
						</div>	

						<div class="form-group-separator"></div>										

			            <div class="form-group">
							<label class="col-sm-3 control-label" for="field-1">Enviar Imagens</label> 
							<div class="col-sm-9">
			                    <input type="file" multiple name="gallery_covers[]" />
							</div> 
			            </div>	

						<div class="form-group-separator"></div>										

						<!-- Imagens -->
			            <div class="row thumbsAlbumEdit">
			            	<label class="col-sm-3 control-label" for="field-1">Imagens</label> 
			            	<div class="col-sm-9">

								<?php  
								$Gallery = new Read;
								$Gallery->ExeRead("nit_albuns_imgs", "WHERE album_id = :album ORDER BY gallery_order ASC", "album={$albumid}");

								if($Gallery->getResult()):
									foreach ($Gallery->getResult() as $gb):
										extract($gb); 
									?>

									<div class="view view-first">

										<img src="<?= BASE ?>/tim.php?src=uploads/<?= $gallery_image; ?>&w=180&h=105&q=80">	
																			
										<div class="mask">
										     <!-- <h2>Title</h2>   -->
									     	<p><?php echo $gallery_title ?></p>  
											<a onclick="confirm_modal('painel.php?exe=albuns/update&albumid=<?= $albumid; ?>&gbdel=<?= $gallery_id; ?>')" class="btn btn-danger">
												<i class="fa-remove"></i> Excluir
											</a>
										</div>
									</div>

									<?php 
									endforeach;
								endif;
							 	?>
							 	
							</div>
						</div>
										
						<div class="form-group-separator"></div>										

						<div class="row col-lg-12 col-md-12 text-center">				
							<input type="submit" class="btn btn-primary btn-lg" value="Atualizar" name="SendPostForm">
							<input type="submit" class="btn btn-success btn-lg" value="Atualizar & Publicar" name="SendPostForm">
						
						</div>								

					</form>
				
				</div>
			</div>
		
		</div>
	</div>

</section>


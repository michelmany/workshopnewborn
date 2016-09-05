<?php 
# Não permite o acesso direto à URL sem estar logado.
if (!class_exists('Login')) :
	header('Location: ../../painel.php');
	die;
endif;
?>

<?php 
#Instancias
$read = new Read;
?>

<!-- Cabeçalho -->
<div class="page-title">

	<div class="title-env">
		<h1 class="title">Blog</h1>
		<p class="description">Gerencie seus Posts</p>
	</div>

	<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1" >
			<li><a href="painel.php"><i class="fa-home"></i>Home</a></li>
			<li class="active"><a href="painel.php?exe=posts/index">Posts</a></li>
		</ol>
	</div>
	
</div>
			
<section class="gallery-env">
	<div class="row">

		<!-- Gallery Sidebar -->
		<div class="col-sm-3 gallery-left">
			<?php 
			 	# RECEBE O EMPTY ATRAVÉS DO GET PARA MOSTRAR MENSAGEM DE ERRO #
			    $empty = filter_input(INPUT_GET, 'empty', FILTER_VALIDATE_BOOLEAN);
			    if ($empty):
			        WSErro("Oppsss: Post não existe!", WS_ALERT);
			    endif;
			 ?>
			<div class="gallery-sidebar">


				<a href="painel.php?exe=posts/create" class="btn btn-block btn-turquoise btn-icon btn-lg">
					<i class="fa-plus-square"></i>
					<span>Nova Postagem</span>
				</a>

		       	 <?php 
		        #Deleta o Post escolhido
		        $delalbumid = filter_input(INPUT_GET, 'delalbum', FILTER_VALIDATE_INT);
		        if(isset($delalbumid)):
		        	require_once('_models/AdminPost.class.php');
		        	$delAlbum = new AdminPost;
		        	$delAlbum->ExeDelete($delalbumid, $userlogin['user_id']);

		            	WSErro($delAlbum->getError()[0], $delAlbum->getError()[1]);
    	
		        endif;
		     	?>

					<?php
					#carrega as categorias do banco.
					$readCats = new Read;
					$readCats->ExeRead('nit_posts_cats', "WHERE user_id = '$user_id' ORDER BY category_title ASC");
					?>		     						

					<!-- LISTA NOMES DOS ÁLBUNS -->
					<ul id="nomesAlbuns" class="list-unstyled">


						<?php foreach($readCats->getResult() as $cats): ?>
							<?php extract($cats); ?>

							<li class="catTitle bold"><i class="fa fa-caret-right"></i> <strong>Categoria: <?php echo $category_title; ?></strong></li>

							<?php # FAZ A LEITURA NO BANCO E FAZ O LOOP PARA MOSTRAR OS RESULTADOS, NEW READ JÁ ESTÁ INSTANCIADO LÁ EM CIMA #
							$read->ExeRead("nit_posts", "WHERE user_id = :userid AND post_categoria_id = :catid ORDER BY post_data DESC", "catid={$category_id}&userid={$user_id}");
							if (!$read->getResult()):
								#Se não encontrar resultados no banco mostra mensagem. Se encontrar, mostra a tabela.
								echo "<small>Nenhuma postagem com esta categoria</small>";
							else: ?>							

								<?php #FOREACH DENTRO DE FOREACH PARA LISTAR AS CATEGORIAS E OS ÁLBUNS DAS CATEGORIAS.
								foreach($read->getResult() as $row): ?>
									<?php extract($row); ?>

									<?php #verifica se foi setado o $_GET
									$albumid = (isset($_GET['albumid'])? $_GET["albumid"] : 0 );  ?>


									<li class="<?php echo $post_id == $albumid ? "active" : ""; ?>">
										<a href="painel.php?exe=posts/index&albumid=<?php echo $post_id; ?>">
											<?php echo $post_id == $albumid ? '<i class="fa-folder-open-o"></i>' : '<i class="fa-folder-o"></i>'; ?>
										 	<?php echo $post_nome; ?>
										</a>
										
									</li>

								<?php endforeach; ?>

						<?php endif; ?>

						<?php endforeach; ?>
					</ul>



			</div>
		</div>	

		<?php #Verifica se foi setado o ID do album escolhido.
		if (isset($_GET['albumid'])):  
			 $albumID = $_GET['albumid']; 
		endif;
		?>

		<?php if (!empty($albumID)): ?>
					
		<?php $read->ExeRead("nit_posts", "WHERE post_id = '$albumID' AND user_id = '$user_id'"); ?>
		<?php if ($read->getResult()): ?>
			<?php foreach ($read->getResult() as $images): ?>
				<?php extract($images); ?>

		<!-- Gallery Album Options and Images -->
		<div class="col-sm-9 gallery-right">

			<!-- Album Header -->
			<div class="album-header">
				<div class="row">
					<div class="col-lg-12">		
						<h2><i class="fa-folder-open-o"></i> <?php echo $post_nome; ?></h2>

						<div class="j_albumOptions album-options">
		 					<a href="#" class="j_btn_detalhes btn btn-blue" data-toggle="tooltip" data-placement="left" title="Exibir detalhes"><i class="fa-info-circle"></i></a>
		 					<a href="painel.php?exe=posts/update&albumid=<?= $albumID ?>" class="btn btn-orange" data-toggle="tooltip" data-placement="left" title="Editar Post"><i class="fa-edit"></i></a>
		 					<a onclick="confirm_modal_del_album('painel.php?exe=posts/index&delalbum=<?= $albumID ?>', '<?= $post_nome; ?>')" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Excluir Post"><i class="fa-trash-o"></i></a>
						</div>
					</div>

				</div>

				<?php #Consulta quantidade de fotos desse Post
	            $read->ExeRead("nit_posts_imgs", "WHERE post_id = '$albumID'");
	            $Fotos = $read->getRowCount(); ?>

				<div class="row">
					<div class="j_barraDetalhes detalhesAlbum">
						<ul class="col-lg-12 list-unstyled text-center">
							<li class="col-lg-4"><i class="linecons-camera"></i> <b>Qtde de fotos:</b> <?php echo $Fotos ?></li>
							<li class="col-lg-4"><i class="linecons-eye"></i> <b>Visualizações:</b> <?php echo $post_views; ?></li>
							<li class="col-lg-4"><i class="linecons-thumbs-up"></i> <b>Curtidas:</b> <?php echo '0'; ?></li>
						</ul>
					</div>
				</div>

			</div>

			<!-- Album Images -->
			<div id="album-image" class="row">

				<ul id="sortablePost">
					<?php $read->ExeRead("nit_posts_imgs", "WHERE post_id='$albumID' ORDER BY gallery_order"); ?>
					<?php if ($read->getResult()): ?>
						<?php foreach ($read->getResult() as $gallery): ?>

							<?php # Função nativa do php que transforma resultados em variáveis.
							extract($gallery); ?>

							<li id="<?php echo $gallery_id; ?>" class="list-unstyled column2">
								
								<!-- Ao clicar na imagem abre o MODAL para edição do título via ajax-->
								<a href="#" class="img-thumbnail">
									<img src="<?= BASE ?>/tim.php?src=uploads/<?= $gallery_image?>&w=225&h=190&q=80" alt="Clique para editar2">
								</a>
							</li>
		

						<?php endforeach; ?>
					<?php endif; ?>
				</ul>

			</div>

			<!-- BOTÃO CARREGA MAIS IMAGENS VIA AJAX -->
			<!-- <button class="btn btn-white btn-block"><i class="fa-bars"></i>	Mostrar mais imagens</button> -->

		</div>

	


	<?php endforeach; ?>
	<?php 
	else:
		header('Location: painel.php?exe=posts/index&empty=true'); #Se não achar resultado joga de volta pro index. Medida de segurança.
	endif; ?>
	<?php endif; ?>

	</div>
</section>
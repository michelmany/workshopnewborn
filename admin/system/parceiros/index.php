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
		<h1 class="title">Parceiros</h1>
		<p class="description">Adicione logos de Parceiros</p>
	</div>

	<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1" >
			<li><a href="painel.php?exe=dashboard/index"><i class="fa-home"></i>Home</a></li>
			<li class="active">Parceiros</li>
		</ol>
	</div>
	
</div>

<!-- Table -->
<div class="row">
	<div class="col-lg-12">				

				<?php
				 	# RECEBE O EMPTY ATRAVÉS DO GET PARA MOSTRAR MENSAGEM DE ERRO #
				    $empty = filter_input(INPUT_GET, 'empty', FILTER_VALIDATE_BOOLEAN);
				    if ($empty):
				        WSErro("Oppsss: Você tentou alterar um <b>slide</b> que não existe!", WS_ALERT);
				    endif;

				    # MOSTRA A MENSAGEM DE SUCESSO VINDO DA PÁGINA CROP-IMAGE.PHP #
			        if(!empty($_SESSION['sucesso'])):
			            WSErro($_SESSION['sucesso'], WS_ACCEPT);
			            unset($_SESSION['sucesso']);
			        endif;				    

				    # VERIFICA O TIPO DE AÇÃO ESCOLHIDA E EXECUTA #
			        $action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
			        if ($action):
			            require ('_models/AdminParceiros.class.php');

			            $sliderAction = filter_input(INPUT_GET, 'slider', FILTER_VALIDATE_INT);

			
			            $sliderUpdate = new AdminParceiros;

			            switch ($action):
			                case 'active':
			                    $sliderUpdate->ExeStatus($sliderAction, '1');
			                    WSErro("O status do post foi atualizado para <b>ativo</b>. Post publicado!", WS_ACCEPT);
			                    break;

			                case 'inative':
			                    $sliderUpdate->ExeStatus($sliderAction, '0');
			                    WSErro("O status do post foi atualizado para <b>inativo</b>. Post agora é um rascunho!", WS_ALERT);
			                    break;

			                case 'delete':
			                    $sliderUpdate->ExeDelete($sliderAction, $userlogin['user_id']);
			                    WSErro($sliderUpdate->getError()[0], $sliderUpdate->getError()[1]);
			                    break;

			                default :
			                    WSErro("Ação não foi identifica pelo sistema, favor utilize os botões!", WS_ALERT);
			            endswitch;
			        endif;				    
				?>			
		<div class="panel panel-default">	
			<div class="panel-heading">
				<a href="painel.php?exe=parceiros/create" class="btn btn-turquoise btn-lg"><i class="fa-plus-square"></i> Adicionar Logo</a>
			</div>				
			<div class="panel-body">

				<div class="row">	
					<ul id="sortable">

						<?php # FAZ A LEITURA NO BANCO E FAZ O LOOP PARA MOSTRAR OS RESULTADOS #
						$readSlider = new Read;
						$readSlider->ExeRead("nit_parceiros", "WHERE user_id = '$user_id' ORDER BY slider_order ASC");?>

						<?php if ($readSlider->getResult()): ?>
							<?php foreach ($readSlider->getResult() as $slider): ?>

								<?php # Função nativa do php que transforma resultados em variáveis.
								extract($slider); ?>

									<?php  #se existe imagem na pasta uploads mostra o slide, senão mostra opção de excluir.
									$filename = '../uploads/'.$slider_url_img;
									if (file_exists($filename)): 
									?>
										<li class="view view-first sliderImg" id="<?php echo $slider_id ?>">
											<img src="<?= BASE; ?>/tim.php?src=uploads/<?= $slider_url_img; ?>&w=180&h=105&q=80">
											<div class="mask">
												<p><?php echo $slider_title2; ?></p>
												<a class="btn btn-orange" href="painel.php?exe=parceiros/update&sliderid=<?= $slider_id; ?>" title="Editar"><i class="fa-wrench"></i></a>
												<?php /* removi botao de crop
												<a class="btn btn-purple" href="painel.php?exe=parceiros/crop&sliderid=<?= $slider_id; ?>" title="Recortar Imagem"><i class="fa-scissors"></i></a> 		
												*/			
												?>	
												<a class="btn btn-danger" onclick="confirm_modal_del_slide('painel.php?exe=parceiros/index&slider=<?= $slider_id; ?>&action=delete', '<?php echo $slider_title2; ?>');" title="Excluir"><i class="fa-remove"></i></a>
											</div>	
										</li>	

									<?php else:	?>

										<li class="view view-first sliderImg" id="<?php echo $slider_id ?>">
											<img src="<?= BASE; ?>/tim.php?src=admin/assets/images/image-5.jpg&w=180&h=105&q=80">
											<div class="mask">
												<p><?php echo $slider_title2; ?> - Erro</p>
												<a class="btn btn-danger" onclick="confirm_modal_del_slide('painel.php?exe=parceiros/index&slider=<?= $slider_id; ?>&action=delete', '<?php echo $slider_title2; ?>');" title="Excluir Slide"><i class="fa-remove"></i></a>
											</div>	
										</li>

									<?php endif; ?>

				        	<?php endforeach; ?>

				        <?php 
				        else:
				            WSErro("Desculpe, nenhuma logo cadastrada!", WS_INFOR);
				        endif; ?>							
			
					</ul>
				</div>
				<div class="panel-footer">
					<em>Clique na imagem e arraste para ordenar as logos!</em>
				</div>	
			</div>
		</div>
	</div>
</div>

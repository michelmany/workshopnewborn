<?php 
# Não permite o acesso direto à URL sem estar logado.
if (!class_exists('Login')) :
	header('Location: ../../painel.php');
	die;
endif;
?>
		
		<?php #Consulta de estatísticas

		//Objeto Read
		$read = new Read;

        // Quantidade de álbuns cadastrados
        $read->ExeRead("nit_albuns");
        $Albuns = $read->getRowCount();

        // Quantidade de fotos cadastrados
        $read->ExeRead("nit_albuns_imgs");
        $Fotos = $read->getRowCount();         

		// Soma quantidade de Views em álbuns.
        $read->FullRead("SELECT SUM(album_views) AS views FROM nit_albuns");
        $viewsAlbuns = $read->getResult()[0]['views'];

		// Pega album mais visualizado
        $read->FullRead("SELECT MAX(album_views) AS mais_visualizado FROM nit_albuns");
        $viewsHoje = $read->getResult()[0]['mais_visualizado'];

        ?>		

			
			<div class="row">


				<div class="col-sm-3">
				
					<div class="xe-widget xe-counter-block xe-counter-block-purple"  data-count=".num" data-from="0" data-to="<?php echo $Albuns; ?>" data-duration="3">
						<div class="xe-upper">
							
							<div class="xe-icon">
								<i class="fa-folder-open-o"></i>
							</div>
							<div class="xe-label">
								<strong class="num">0</strong>
								<span>Álbuns cadastrados</span>
							</div>
							
						</div>
						<div class="xe-lower">
							<div class="border"></div>
							
							<span>PLANO</span>
							<strong>Ilimitado</strong>
						</div>
					</div>
					
				</div>
				
				<div class="col-sm-3">
				
					<div class="xe-widget xe-counter-block xe-counter-block-turquoise"  data-count=".num" data-from="0" data-to="<?php echo $Fotos; ?>" data-suffix="" data-duration="2">
						<div class="xe-upper">
							
							<div class="xe-icon">
								<i class="linecons-camera"></i>
							</div>
							<div class="xe-label">
								<strong class="num">0</strong>
								<span>Fotos Cadastradas</span>
							</div>
							
						</div>
						<div class="xe-lower">
							<div class="border"></div>
							
							<span>Plano</span>
							<strong>Ilimitado</strong>
						</div>
					</div>
					
				</div>
				
				
				<div class="col-sm-3">


				
					<div class="xe-widget xe-counter-block xe-counter-block-blue"  data-suffix="" data-count=".num" data-from="0" data-to="<?php echo $viewsAlbuns; ?>" data-duration="3" data-easing="true">
						<div class="xe-upper">
							
							<div class="xe-icon">
								<i class="linecons-eye"></i>
							</div>
							<div class="xe-label">
								<strong class="num">0</strong>
								<span>Views em Álbuns</span>
							</div>
							
						</div>
						<div class="xe-lower">
							<div class="border"></div>
							
							<span>Mais visualizado</span>
							<strong><?php echo $viewsHoje; ?> Views</strong>
						</div>
					</div>
					
				</div>
				
				<div class="col-sm-3">
				
					<div class="xe-widget xe-counter-block xe-counter-block-pink"  data-suffix="" data-count=".num" data-from="0" data-to="310" data-duration="2" data-easing="true">
					
						<div class="xe-upper">
							
							<div class="xe-icon">
								<i class="linecons-heart"></i>
							</div>
							<div class="xe-label">
								<strong class="num">0</strong>
								<span>Fotos curtidas</span>
							</div>
							
						</div>
						<div class="xe-lower">
							<div class="border"></div>
							
							<span>Foto mais curtida</span>
							<strong>10 Likes</strong>
						</div>
					</div>
					
				</div>						
		
				<div class="clearfix"></div>				
				
			</div> <!-- /row -->

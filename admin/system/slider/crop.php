<?php 
# Não permite o acesso direto à URL sem estar logado.
if (!class_exists('Login')) :
	header('Location: ../../painel.php');
die;
endif;
?>

<?php
$sliderid 	= filter_input(INPUT_GET, 'sliderid', FILTER_VALIDATE_INT);

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

<?php #busca o tamanho do slide do tema do usuário para depois jogar lá pro data/crop.js.
$buscathemeSize = new Read;
$buscathemeSize->ExeRead("nit_themes", "WHERE theme_id=:themeid", "themeid={$userlogin['theme_id']}");
if($buscathemeSize->getResult()):
	$themeSize = $buscathemeSize->getResult()[0];
	extract($themeSize);
endif;
?>

<script type="text/javascript" src="./data/crop.js"></script>

<!-- Cabeçalho -->
<div class="page-title">
	<div class="title-env">
		<h1 class="title">Slide de <?php echo $slider['slider_title2']; ?></h1>
		<p class="description">Recortando imagem</p>
	</div>
	<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1" >
			<li><a href="painel.php?exe=dashboard/index"><i class="fa-home"></i>Home</a></li>
			<li><a href="painel.php?exe=slider/index">Slider</a></li>
			<li class="active"><strong>Recortar</strong></li>
		</ol>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		Recorte a imagem para ajustar ao Slider da Home 
	</div>
	<div class="panel-body">

		<div class="row">
			<div class="col-md-8">
				<strong class="text-primary">Imagem Original</strong><br /><br />
				<div class="img-container">
					<img src="../uploads/<?php echo $slider['slider_url_img']; ?>?<?php echo time(); ?>" class="img-responsive" width="<?= $theme_slide_width; ?>" height="<?= $theme_slide_height; ?>" />
				</div>
				<div id="destino"></div>
			</div>
			<div class="col-md-4">
				<strong class="text-primary">Preview Imagem recortada</strong><br /><br />
				<div class="img-shade">
					<div id="img-preview" class="img-preview img-responsive"></div>
				</div>
				
				<table class="table table-bordered table-hover hidden">
					<thead>
						<tr>
							<th width="25%">X</th>
							<th width="25%">Y</th>
							<th width="25%">W</th>
							<th width="25%">H</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td id="img-1-x">0px</td>
							<td id="img-1-y">0px</td>
							<td id="img-1-w">0px</td>
							<td id="img-1-h">0px</td>
							<input type="hidden" id="sliderurl" value="<?php echo $slider['slider_url_img']; ?>"></td>
							<input type="hidden" id="sliderid" value="<?php echo $slider['slider_id']; ?>"></td>
						</tr>
					</tbody>
				</table>
				
				<input type="button" value="Cortar Imagem" id="crop-img" class="btn btn-secondary">
				<a href="painel.php?exe=slider/index" type="button" class="btn btn-white">Não quero cortar</a>
				
			</div>
		</div>
		
	</div>
</div>



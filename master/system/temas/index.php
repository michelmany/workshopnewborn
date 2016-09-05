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
		<h1 class="title">Temas</h1>
		<p class="description">Cadastro de temas disponíveis</p>
	</div>
	<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1" >
			<li><a href="painel.php"><i class="fa-home"></i>Home</a></li>
			<li class="active"><a href="painel.php?exe=clientes/index">Clientes</a></li>
		</ol>
	</div>
</div>

<div class="panel panel-default">

	<div class="panel-heading">
		<h3 class="panel-title">Adicionar Tema</h3>
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



		<form role="form" class="form-horizontal" name="PostForm" method="post" action="">
			<div class="form-group">
				<label class=" col-md-2 col-sm-2 col-xs-3 control-label" for="theme_name">Nome do Tema</label>

				<div class=" col-md-4 col-sm-4 col-xs-5">
					<input type="text" class="form-control input-lg" name="theme_name" value="" />
				</div>

				<label class=" col-md-1 col-sm-2 col-xs-3 control-label" for="">Usuário</label>

				<div class="col-md-3 col-sm-4 col-xs-5">
                            <?php
                            # Busca o temas cadastrados no banco.
                            $users = new Read;
                            $users->ExeRead("nit_users", "WHERE user_level = 2 ORDER BY user_fullname ASC");
                            
                            if (!$users->getResult()):
                                WSErro('Nenhum usuário cadastrado!', WS_INFOR);
                            else: ?>    
                           
                            <select class="form-control input-lg" name="user_id">
                            	<option value="1">Tema padrão</option>
                            <?php foreach ($users->getResult() as $user): extract($user); ?>                               
                                <option value="<?= $user_id; ?>"><?= $user_fullname; ?></option>
                            <?php endforeach; ?>
                            </select>

                            <?php endif; ?>
				</div>				

				<div class=" col-md-2 col-sm-12 col-xs-4">
					<input type="submit" class="btn btn-turquoise btn-lg" value="Adicionar Tema" name="SendPostForm" />
				</div>
			</div>
		</form>

	</div>
</div>

<?php # PEGA OS DADOS DOS INPUTS E ENVIA PRO BANCO #
	$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	if(!empty($post['SendPostForm'])):
		unset($post['SendPostForm']); //Remove o botão para não ser enviado ao banco.
		require_once('_models/AdminThemes.class.php');
		$cadastra = new AdminThemes;
		$cadastra->ExeCreate($post);
		WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
	endif;
 ?>

<?php # MOSTRA A MENSAGEM DE SUCESSO GRAVADA NA SESSÃO #
    if(!empty($_SESSION['sucesso'])):
        WSErro($_SESSION['sucesso'], WS_ACCEPT);
        unset($_SESSION['sucesso']);
    endif; ?>					

<?php # DELETA O REGISTRO ESCOLHIDO #
$delete = filter_input(INPUT_GET, 'delid', FILTER_VALIDATE_INT);
if ($delete):
	require_once('_models/AdminThemes.class.php');
    $delUser = new AdminThemes;
    $delUser->ExeDelete($delete);
    WSErro($delUser->getError()[0], $delUser->getError()[1]);
endif;
?>

<?php # FAZ A LEITURA NO BANCO E FAZ O LOOP PARA MOSTRAR OS RESULTADOS #
$read = new Read;
$read->ExeRead('nit_themes');
?>

<div class="panel panel-default">

	<div class="panel-body">		

	<?php if (!$read->getResult()):
	#Se não encontrar resultados no banco mostra mensagem. Se encontrar, mostra a tabela.
	WSErro("Olá, você ainda não cadastrou nenhum Tema no sistema! ", WS_INFOR);
	else: ?>

			<div class="table-responsive" data-pattern="priority-columns" data-sticky-table-header="true" data-add-display-all-btn="true">
				<table class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Nome</th>
							<th width="100">Ação</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($read->getResult() as $row): ?>
							<?php extract($row); # Função nativa do php que transforma resultados em variáveis. ?> 
							<tr>
								<td><?php echo $theme_name; ?></td>
								<td>
			                        <a class="btn btn-danger" onclick="confirm_modal('painel.php?exe=temas/index&delid=<?php echo $theme_id; ?>');" data-toggle="tooltip" data-placement="top" title="excluir">
			                        <i class="fa fa-remove"></i></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
	</div>
	
	<?php endif; ?>

</div>
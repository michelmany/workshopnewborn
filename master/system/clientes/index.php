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
		<h1 class="title">Clientes Ativos</h1>
		<p class="description">Gerencie clientes no sistema</p>
	</div>
	<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1" >
			<li><a href="painel.php"><i class="fa-home"></i>Home</a></li>
			<li class="active"><a href="painel.php?exe=clientes/index">Clientes</a></li>
		</ol>
	</div>
</div>


<?php # MOSTRA A MENSAGEM DE SUCESSO GRAVADA NA SESSÃO #
    if(!empty($_SESSION['sucesso'])):
        WSErro($_SESSION['sucesso'], WS_ACCEPT);
        unset($_SESSION['sucesso']);
    endif; ?>					

<?php # DELETA O REGISTRO ESCOLHIDO #
$delete = filter_input(INPUT_GET, 'delid', FILTER_VALIDATE_INT);
if ($delete):
	require_once('_models/AdminUser.class.php');
    $delUser = new AdminUser;
    $delUser->ExeDelete($delete);
    WSErro($delUser->getError()[0], $delUser->getError()[1]);
endif;
?>

<?php # BUSCO APENAS OS CLIENTES (NIVEL 2).
$read = new Read;
$read->ExeRead('nit_users', "WHERE user_level = 2 AND user_status = 1");
?>

<!-- Basic Setup -->
<div class="panel panel-default">
	<div class="panel-heading">
		<a href="painel.php?exe=clientes/create" class="btn btn-turquoise btn-lg">
			<i class="fa-plus-square"></i> Cadastrar cliente
		</a>
		
		<div class="panel-options">
			<a href="#" data-toggle="panel">
				<span class="collapse-icon">&ndash;</span>
				<span class="expand-icon">+</span>
			</a>
			<a href="#" data-toggle="remove">&times;</a>
		</div>
	</div>
	<div class="panel-body">
		
		<?php if (!$read->getResult()):
		#Se não encontrar resultados no banco mostra mensagem. Se encontrar, mostra a tabela.
		WSErro("Olá, não há clientes cadastrados no sistema! ", WS_INFOR);
		else: ?>
		
		<table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Username</th>
					<th>Email</th>

					<th width="100">Registro</th>
					<th width="100">Término</th>
					<th width="150">Ações</th>
				</tr>
			</thead>
		
			<tbody>
				<?php foreach ($read->getResult() as $row): ?>
					<?php extract($row); # Função nativa do php que transforma resultados em variáveis. ?> 
					<tr>
						<td><?php echo $user_fullname; ?></td>
						<td><?php echo $user_username; ?></td>
						<td><?php echo $user_email; ?></td>
						<td><?php echo date('d/m/Y', strtotime($user_registration)); ?></td>
						<td><?php echo $user_datafim = (!empty($user_datafim)) ? date('d/m/Y', strtotime($user_datafim)) : 'Não definido'; ?></td>
						<td>
	                        <a class="btn btn-blue" href="painel.php?exe=clientes/perfil&editid=<?= $user_id; ?>" data-toggle="tooltip" data-placement="top" title="Perfil"><i class="fa-eye"></i></a>							
							<a class="btn btn-orange" href="painel.php?exe=clientes/update&editid=<?= $user_id; ?>" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa-wrench"></i></a>
	                        <a class="btn btn-danger" onclick="confirm_modal('painel.php?exe=clientes/index&delid=<?php echo $user_id; ?>');" data-toggle="tooltip" data-placement="top" title="excluir">
	                        <i class="fa fa-remove"></i></a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php endif; ?>
	</div>
</div>
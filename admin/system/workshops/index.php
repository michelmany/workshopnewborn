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
		<h1 class="title">Cursos</h1>
		<p class="description">Gerencie seus cursos</p>
	</div>
	<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1" >
			<li><a href="painel.php"><i class="fa-home"></i>Home</a></li>
			<li class="active">Cursos</li>
		</ol>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<a href="painel.php?exe=workshops/create" class="btn btn-turquoise btn-lg"><i class="fa-plus-square"></i> Novo Curso</a>
	</div>
	<div class="panel-body">

		<?php
		 	# RECEBE O EMPTY ATRAVÉS DO GET PARA MOSTRAR MENSAGEM DE ERRO #
		    $empty = filter_input(INPUT_GET, 'empty', FILTER_VALIDATE_BOOLEAN);
		    if ($empty):
		        WSErro("Oppsss: Você tentou editar um <b>workshop</b> que não existe!", WS_ALERT);
		    endif;		

		 	# MOSTRA A MENSAGEM DE SUCESSO VINDO DA PÁGINA CROP-IMAGE.PHP #
	        if(!empty($_SESSION['sucesso'])):
	            WSErro($_SESSION['sucesso'], WS_ACCEPT);
	            unset($_SESSION['sucesso']);
	        endif; ?>					
		
	    <?php # DELETA O REGISTRO ESCOLHIDO #
	    $delete = filter_input(INPUT_GET, 'delid', FILTER_VALIDATE_INT);
	    if ($delete):
	        require('_models/AdminWorkshop.class.php');
	        $delUser = new AdminWorkshop;
	        $delUser->ExeDelete($delete);
	        WSErro($delUser->getError()[0], $delUser->getError()[1]);
	    endif;
	    ?>
		
		<?php # FAZ A LEITURA NO BANCO E FAZ O LOOP PARA MOSTRAR OS RESULTADOS #
		$read = new Read;
		$read->ExeRead("nit_workshops", "ORDER BY workshop_date DESC");
		if (!$read->getResult()):
			#Se não encontrar resultados no banco mostra mensagem. Se encontrar, mostra a tabela.
			WSErro("Olá, você ainda não cadastrou nenhum curso no sistema! ", WS_INFOR);
		else: ?>	
			<div class="table-responsive" data-pattern="priority-columns">
				<table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Título</th>
							<th>Detalhes</th>
							<th width="100">Data</th>
							<th width="100">Vagas</th>
							<th width="100">Ações</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($read->getResult() as $row): ?>
							<?php extract($row); # Função nativa do php que transforma resultados em variáveis. ?> 
							<tr>
								<td><?php echo $workshop_nome; ?></td>
								<td><?php echo Check::Words($workshop_msg, 7); ?></td>
								<td><?php echo date('d/m/Y', strtotime($workshop_date)); ?></td>
								<td><?php echo $workshop_vagas; ?></td>
								<td>
									<a class="btn btn-orange" href="painel.php?exe=workshops/update&id=<?= $workshop_id; ?>" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa-wrench"></i></a>
			                        <a class="btn btn-danger" onclick="confirm_modal('painel.php?exe=workshops/index&delid=<?php echo $workshop_id; ?>');" data-toggle="tooltip" data-placement="top" title="excluir">
			                        <i class="fa fa-remove"></i></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endif; ?>
	</div>
</div>



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
		<p class="description">Inscritos no curso</p>
	</div>
	<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1" >
			<li><a href="painel.php"><i class="fa-home"></i>Home</a></li>
			<li class="active">Inscritos</li>
		</ol>
	</div>
</div>

<div class="panel panel-default">
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

	    /*
	    $delete = filter_input(INPUT_GET, 'delid', FILTER_VALIDATE_INT);
	    if ($delete):
	        // require('_models/AdminCadastro.class.php');
	        $delUser = new Cadastro;
	        $delUser->ExeDelete($delete);
	        WSErro($delUser->getError()[0], $delUser->getError()[1]);
	    endif;
	    */

	    ?>

		
		<?php # FAZ A LEITURA NO BANCO E FAZ O LOOP PARA MOSTRAR OS RESULTADOS #
		$read = new Read;
		$read->ExeRead("nit_pedidos", "ORDER BY ped_date DESC");
		if (!$read->getResult()):
			#Se não encontrar resultados no banco mostra mensagem. Se encontrar, mostra a tabela.
			WSErro("Olá, você ainda não cadastrou nenhum curso no sistema! ", WS_INFOR);
		else: ?>	
			<div class="table-responsive" data-pattern="priority-columns">
				<table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th width="20">Pedido #</th>
							<th>Nome do Aluno</th>
							<th width="250">Email do aluno</th>
							<th width="120">Data Pedido</th>
							<th width="120">Status</th>
							<th width="100">Ações</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($read->getResult() as $row): ?>
							<?php extract($row); # Função nativa do php que transforma resultados em variáveis.

					        if ($ped_status == 'Pendente'):
					        	$classBtn = 'warning';
					        elseif ($ped_status == 'Processando'):
					        	$classBtn = 'info';
					        elseif ($ped_status == 'Em espera'):
					        	$classBtn = 'warning';
					        elseif ($ped_status == 'Completo'):
					        	$classBtn = 'success';
					        elseif ($ped_status == 'Fechado'):
					        	$classBtn = 'danger';
				        	else:
				        		$classBtn = 'default';
				        	endif;							

					        // detalhes do inscrito
					        $read->ExeRead("nit_inscritos", "WHERE cad_id = :inscrito_id", "inscrito_id={$row['inscrito_id']}");

				         		foreach ($read->getResult() as $inscrito): extract($inscrito);

							 ?> 
							<tr>
								<td><?php echo $ped_id; ?></td>
								<td><?php echo Check::Words($cad_aluno, 7); ?></td>
								<td><?php echo $cad_email; ?></td>
								<td><?php echo date('d/m/Y', strtotime($ped_date)); ?></td>
								<td class="text-center"><span class="label label-<?= $classBtn; ?>"><?php echo $ped_status; ?></span></td>
								<td>
									<a class="btn btn-orange" href="painel.php?exe=workshops/update&id=<?= $workshop_id; ?>" data-toggle="tooltip" data-placement="top" disabled title="Editar"><i class="fa-wrench"></i></a>
									<?php /* 
			                        <a class="btn btn-danger" onclick="confirm_modal('painel.php?exe=workshops/inscritos&delid=<?php echo $ped_id; ?>');" data-toggle="tooltip" data-placement="top" title="excluir">
			                        <i class="fa fa-remove"></i></a>
			                        */ ?>
								</td>
							</tr>
							<?php endforeach; ?>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endif; ?>
	</div>
</div>



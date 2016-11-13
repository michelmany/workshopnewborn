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
		<h1 class="title">Pedidos</h1>
		<p class="description">Detalhes do aluno inscrito</p>
	</div>
	<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1" >
			<li><a href="painel.php"><i class="fa-home"></i>Home</a></li>
			<li class="active">Inscritos</li>
		</ol>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading hidden-print">Detalhes do pedido</div>
	<div class="panel-body">

		<?php
		 	# RECEBE O EMPTY ATRAVÉS DO GET PARA MOSTRAR MENSAGEM DE ERRO #
		    $empty = filter_input(INPUT_GET, 'empty', FILTER_VALIDATE_BOOLEAN);
		    if ($empty):
		        WSErro("Oppsss: Você tentou editar um <b>pedido</b> que não existe!", WS_ALERT);
		    endif;		

		 	# MOSTRA A MENSAGEM DE SUCESSO VINDO DA PÁGINA CROP-IMAGE.PHP #
	        if(!empty($_SESSION['sucesso'])):
	            WSErro($_SESSION['sucesso'], WS_ACCEPT);
	            unset($_SESSION['sucesso']);
	        endif; 	

		    $ped_id = filter_input(INPUT_GET, 'ped_id');
		    if (!$ped_id):
		        WSErro("Oppsss: Você tentou editar um <b>pedido</b> que não existe!", WS_ALERT);
		    endif;		        			
		
		    ?>


			<?php # FAZ A LEITURA NO BANCO E FAZ O LOOP PARA MOSTRAR OS RESULTADOS #
			$read = new Read;
			$read->ExeRead("nit_pedidos", "WHERE ped_id = :ped_id ORDER BY ped_date DESC", "ped_id={$ped_id}");
			if (!$read->getResult()):
				#Se não encontrar resultados no banco mostra mensagem. Se encontrar, mostra a tabela.
				WSErro("Olá, você ainda não cadastrou nenhum curso no sistema! ", WS_INFOR);
			else: 	

			extract($read->getResult()[0]); 

		        if ($ped_status == 'Pendente'):
		        	$classBtn = 'orange';
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
		        $read->ExeRead("nit_inscritos", "WHERE cad_id = :cad_id", "cad_id={$inscrito_id}");
				if ($read->getResult()) extract($read->getResult()[0]);

				// detalhes do workshop
		        $read->ExeRead("nit_workshops", "WHERE workshop_id = :id", "id={$workshop_id}");
				if ($read->getResult()) extract($read->getResult()[0]);				

				 ?> 

		<section class="invoice-env">
			<div class="invoice-header">

				<div class="invoice-options hidden-print">
					<div class="form-group">
					<label for="" class="pull-right">Status do pedido</label>
						<select class="form-control j_update_status" name="ped_status" data-pedidoid="<?= $ped_id; ?>">
							<option <?php if (isset($ped_status) && $ped_status == 'Pendente') echo 'selected'; ?> value="Pendente">Pendente</option>
							<option <?php if (isset($ped_status) && $ped_status == 'Processando') echo 'selected'; ?> value="Processando">Processando</option>
							<option <?php if (isset($ped_status) && $ped_status == 'Em espera') echo 'selected'; ?> value="Em espera">Em espera</option>
							<option <?php if (isset($ped_status) && $ped_status == 'Completo') echo 'selected'; ?> value="Completo">Completo</option>
							<option <?php if (isset($ped_status) && $ped_status == 'Fechado') echo 'selected'; ?> value="Fechado">Fechado</option>
							<option <?php if (isset($ped_status) && $ped_status == 'Cancelado') echo 'selected'; ?> value="Cancelado">Cancelado</option>
						</select>
					</div>						
				</div>



				<div class="invoice-logo">
					<ul class="list-unstyled">
						<li class="upper">Pedido No. <strong><?= $ped_id ?></strong></li>
						<li class="upper">Cadastro Cod. <strong><?= $cad_cod ?></strong></li>
						<li>Data do Pedido: <?= date('d/m/Y', strtotime($ped_date)); ?></li>
					</ul>
				</div>
			</div>
				<div class="invoice-details">
					<div class="invoice-client-info">
						<strong>Dados do Aluno</strong> 
						<ul class="list-unstyled"> 
							<?php if(!empty($cad_aluno)) echo "<li>Nome: ".$cad_aluno."</li>" ?>
							<?php if(!empty($cad_endereco)) echo "<li>Endereço: ".$cad_endereco."</li>" ?>
							<?php if(!empty($cad_bairro)) echo "<li>Bairro: ".$cad_bairro."</li>" ?>
							<?php if(!empty($cad_cidade)) echo "<li>Cidade: ".$cad_cidade."</li>" ?>
							<?php if(!empty($cad_estado)) echo "<li>Estado: ".$cad_estado."</li>" ?>
							<?php if(!empty($cad_cep)) echo "<li>CEP: ".$cad_cep."</li>" ?>
							<br>
							<?php if(!empty($cad_telefone)) echo "<li>Telefone: ".$cad_telefone."</li>" ?>
							<?php if(!empty($cad_email)) echo "<li>Email: ".$cad_email."</li>" ?>
							<?php if(!empty($cad_facebook)) echo "<li>Facebook: ".$cad_facebook."</li>" ?>
							<?php if(!empty($cad_site)) echo "<li>Site: ".$cad_site."</li>" ?>
						</ul>

						</div> 
						<div class="invoice-payment-info">
							<strong>Respostas do formulário:</strong> 
							<ul class="list-unstyled">
								<?php $cad_especializacoes = ($cad_especializacoes == 'no' ? 'não' : 'sim'); ?>
								<li>Especializações: <?php echo $cad_especializacoes ?></li>
								
								<?php if(!empty($cad_especializacoes_local) && $cad_especializacoes != 'não') echo "<li>Local da Especialização: ".$cad_especializacoes_local."</li>" ?>
								
								<br>

								<?php $cad_jafezpresencial = ($cad_jafezpresencial == 'no' ? 'não' : 'sim'); ?>
								<li>Já fez curso presencial: <?php echo $cad_jafezpresencial ?></li>

								<?php if(!empty($cad_jafezpresencial_qual) && $cad_jafezpresencial != 'não') echo "<li>Qual: ".$cad_jafezpresencial_qual."</li>" ?>

								<br>

								<?php if(!empty($cad_equipamento)) echo "<li>Equipamento: ".$cad_equipamento."</li>" ?>

								<?php if(!empty($cad_inspiracoes)) echo "<li>Inspirações: ".$cad_inspiracoes."</li>" ?>

								<?php if(!empty($cad_maiordificuldade)) echo "<li>Maior dificuldade: ".$cad_jafezpresencial_qual."</li>" ?>

								<?php if(!empty($cad_esperadocurso)) echo "<li>Espera do curso: ".$cad_esperadocurso."</li>" ?>									



							</ul>
						</div>
					</div>
					<table class="table table-bordered"> 
						<thead> <tr class="no-borders">
							<th class="text-center hidden-xs">#</th> 
							<th width="60%" class="text-center">Curso</th> 
							<th class="text-center hidden-xs">Quantidade</th> 
							<th class="text-center">Valor</th> 
						</tr> 
					</thead>
					<tbody> 
						<tr>
							<td class="text-center hidden-xs"><?= $ped_id; ?></td>
							<td><?= $workshop_nome; ?></td> 
							<td class="text-center hidden-xs">1</td>
							<td class="text-right text-primary text-bold">R$ <?= $workshop_investimento ?></td>
						</tr>

					</tbody> 
				</table> 
				<?php /* ?>
				<div class="invoice-totals"> 
					<div class="invoice-subtotals-totals"> 
						<span>Sub - Total amount: <strong>$6,487</strong> </span> 
						<span>VAT: <strong>12.9%</strong> </span>
						<span>Discount: <strong>-----</strong> </span>
						<hr> 
						<span>Grand Total: 
							<strong>$7,304</strong> 
						</span> 
					</div> 
					<div class="invoice-bill-info"> 
						<address>
							795 Park Ave, Suite 120<br>
							San Francisco, CA 94107<br> 
							P: (234) 145-1810 <br>
							Full Name <br>
							<a href="#">first.last@email.com</a>
						</address>
					</div> 
				</div> 
				*/?>
			</section> 

		<?php endif; ?>
	</div>
</div>
<?php 
ob_start();
session_start();

/***************
* Recebe todos os dados do formulário via post
* e coloca em uma variável ($Post) em forma de array.
****************/
$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);

require ($_SERVER['DOCUMENT_ROOT'].'/_app/Config.inc.php');

// VERIFICA SE USUÁRIO LOGADO TEM PERMISSÃO E SETA A VARIÁVEL NA SESSÃO DO USUÁRIO ####################
$login = new Login(2);

if (!$login->CheckLogin()):
    unset($_SESSION['userlogin']);
    header('Location: index.php?exe=restrito');
else:
    $userlogin = $_SESSION['userlogin']; // Posso usar $userlogin[] para pegar o id, nome etc.
endif;

$imgid = $Post['imgid'];
unset($Post['imgid']); //Não preciso enviar o ID p/ o Banco, então dou um unset nela.

if ($Post):
	$Update = new Update;
	$Update->ExeUpdate('nit_albuns_imgs', $Post, "WHERE gallery_id = :id", "id={$imgid}");

	//Retorna o resultado em JSON (Calback)
	echo json_encode($Update->getResult());

else:
	echo '<div style="text-align:center">O que você está tentando fazer?? rs</div>';
endif;


ob_end_flush();





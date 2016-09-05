<?php 
ob_start();
session_start();

$imagemid = strip_tags($_POST['imagemid']);

require($_SERVER['DOCUMENT_ROOT'].'/_app/Config.inc.php');


// VERIFICA SE USUÁRIO LOGADO TEM PERMISSÃO E SETA A VARIÁVEL NA SESSÃO DO USUÁRIO ####################
$login = new Login(2);

if (!$login->CheckLogin()):
    unset($_SESSION['userlogin']);
    header('Location: index.php?exe=restrito');
else:
    $userlogin = $_SESSION['userlogin']; // Posso usar $userlogin[] para pegar o id, nome etc.
endif;

$Read = new Read;
$Read->FullRead("SELECT gallery_id, gallery_title, gallery_image FROM nit_posts_imgs WHERE gallery_id = :id", "id={$imagemid}");

if($Read->getResult()):
	echo json_encode($Read->getResult());
else:
	echo '<div style="text-align:center">O que você está tentando fazer?? rs</div>';
endif;

ob_end_flush();
<?php
header("Access-Control-Allow-Origin: *");

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setPost = array_map('strip_tags', $getPost);
$Contato = array_map('trim', $setPost);

if($Contato):

    unset($Contato['SendFormContato']); #unset no input submit.

    $Contato['Assunto'] = 'Mensagem enviada pelo site!';
    if (empty($Contato['DataEvento'])):
        $Contato['DataEvento'] = 'Usuário não preencheu este campo!';
    endif;
    if (empty($Contato['LocalEvento'])):
        $Contato['LocalEvento'] = 'Usuário não preencheu este campo!';
    endif;                  

    require ($_SERVER['DOCUMENT_ROOT'].'/_app/Config.inc.php');
    #Envia email.
    $SendMail = new Email;
    $SendMail->Enviar($Contato);

    if($SendMail->getError()):
        return WSErro($SendMail->getError()[0], $SendMail->getError()[1]);
    endif;
endif;


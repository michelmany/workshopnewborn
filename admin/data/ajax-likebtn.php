<?php # autoriza acesso vindo de outra página/domínio.
header("Access-Control-Allow-Origin: *");

$Data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if ($Data): #assim se acessar o arquivo direto pela url não aparece nada.

    require ($_SERVER['DOCUMENT_ROOT'].'/_app/Config.inc.php');

    $cadastra = new Loveit;
    $cadastra->ExeCreate($Data);

    if ($cadastra->getResult()): #se cadastrou mostra o ID do cadastro.
        echo json_encode($cadastra->getResult());
    endif;

else: # se acessar direto pela url vai ser redirecionado para a página da RETRATUM.
    header('Location:'.BASE);
endif;
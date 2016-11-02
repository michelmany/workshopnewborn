<?php
header("Access-Control-Allow-Origin: *");

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setPost = array_map('strip_tags', $getPost);
$Data = array_map('trim', $setPost);

if($Data):

    unset($Data['SendFormCadastra']); #unset no input submit.

    require ($_SERVER['DOCUMENT_ROOT'].'/_app/Config.inc.php');

    #Envia email.
    $Cadastra = new Cadastro;
    $Cadastra->ExeCreate($Data);

    $json = array();

    if($Cadastra->getResult()):
        // echo $Cadastra->getResult();

        $json['nome_aluno'] = $Data['cad_aluno'];
        $json['ped_cod'] = $Data['cad_cod'];

        echo json_encode($json);

        // var_dump($json);

        // $LastResult = new Read;
        // $lastSaved->ExeRead(self::Entity, "WHERE cad_id = :id", "id={$Cadastra->getResult()}");
        // if ($lastSaved->getRowCount()): extract($lastSaved);

        // endif;          
    endif;

    //com esse id vou buscar o ultimo cadastrado para poder gerar o botao do pagseguro com esses dados.


    // if($Cadastra->getError()):
    //     return WSErro($SendMail->getError()[0], $SendMail->getError()[1]);
    // endif;
endif;


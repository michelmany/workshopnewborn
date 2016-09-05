<?php

if (file_exists('_app/Library/PHPMailer/class.phpmailer.php')):
    require_once '_app/Library/PHPMailer/class.phpmailer.php';
elseif (file_exists('../../_app/Library/PHPMailer/class.phpmailer.php')):
    require_once '../_app/Library/PHPMailer/class.phpmailer.php';
else:
    require_once '../../_app/Library/PHPMailer/class.phpmailer.php';
endif;

/**
 * ContrateConfirmEmail [ MODEL ]
 * Modelo responável por configurar a PHPMailer, validar os dados e disparar e-mails do sistema!
 * 
 * @copyright (c) year, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class ContrateConfirmEmail {

    /** @var PHPMailer */
    private $Mail;

    /** EMAIL DATA */
    private $Data;

    /** CORPO DO E-MAIL */
    private $Assunto;
    private $Mensagem;

    /** REMETENTE */
    private $RemetenteNome;
    private $RemetenteEmail;

    /** DESTINO */
    private $DestinoNome;
    private $DestinoEmail;

    /** CONSTROLE */
    private $Error;
    private $Result;

    function __construct() {
        $this->Mail = new PHPMailer;
        $this->Mail->Host = MAILHOST;
        $this->Mail->Port = MAILPORT;
        $this->Mail->Username = MAILUSER;
        $this->Mail->Password = MAILPASS;
        $this->Mail->CharSet = 'UTF-8';
    }

    /**
     * <b>Enviar E-mail SMTP:</b> Envelope os dados do e-mail em um array atribuitivo para povoar o método.
     * Com isso execute este para ter toda a validação de envio do e-mail feita automaticamente.
     * 
     * <b>REQUER DADOS ESPECÍFICOS:</b> Para enviar o e-mail você deve montar um array atribuitivo com os
     * seguintes índices corretamente povoados:<br><br>
     * <i>
     * &raquo; Assunto<br>
     * &raquo; Mensagem<br>
     * &raquo; RemetenteNome<br>
     * &raquo; RemetenteEmail<br>
     * &raquo; DestinoNome<br>
     * &raquo; DestinoEmail
     * </i>
     */
    public function Enviar(array $Data) {
        $this->Data = $Data;
        $this->Clear();

        $this->setMail();
        $this->Config();
        $this->sendMail();

    }

    /**
     * <b>Verificar Envio:</b> Executando um getResult é possível verificar se foi ou não efetuado 
     * o envio do e-mail. Para mensagens execute o getError();
     * @return BOOL $Result = TRUE or FALSE
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * <b>Obter Erro:</b> Retorna um array associativo com o erro e o tipo de erro.
     * @return ARRAY $Error = Array associatico com o erro
     */
    public function getError() {
        return $this->Error;
    }

    /*
     * ***************************************
     * **********  PRIVATE METHODS  **********
     * ***************************************
     */

    //Limpa código e espaços!
    private function Clear() {
        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);
    }

    //Recupera e separa os atributos pelo Array Data.
    private function setMail() {
        $this->Assunto = "O cliente ({$this->Data['user_fullname']}) efetuou cadastro no Site!";
        $this->RemetenteNome = $this->Data['user_fullname'];
        $this->RemetenteEmail = $this->Data['user_email'];
        $this->UserDDD = $this->Data['user_ddd'];
        $this->UserTelefone = $this->Data['user_telefone'];
        $this->UserCPF = $this->Data['user_cpf_cnpj'];
        $this->UserAddress = $this->Data['user_endereco'];
        $this->UserAddressNumber = $this->Data['end_numero'];
        $this->UserAddressComp = $this->Data['end_complemento'];
        $this->UserAddressBairro = $this->Data['end_bairro'];
        $this->UserAddressCEP = $this->Data['cep'];
        $this->UserAddressCidade = $this->Data['end_cidade'];
        $this->UserAddressEstado = $this->Data['end_estado'];
        $this->UserSubDomain = $this->Data['user_username'];
        $this->UserDomain = $this->Data['user_domain'];
        $this->UserComoConheceu = $this->Data['como_conheceu'];
        $this->UserTema = $this->Data['theme_id'];
        $this->UserPlanoEscolhido = $this->Data['plano_id'];
        $this->FormaPagamento = ($this->Data['forma_pagamento'] == 'boleto' ? 'Boleto Bancário' : 'Cartão de Crédito');
        $this->UserTotalPagar = $this->Data['total_pagar'];

        $this->DestinoNome = 'Contato Retratum';
        $this->DestinoEmail = 'contato@retratum.com';


        $this->Data = null;
        $this->setMsg();
    }

    //Formatar ou Personalizar a Mensagem!
    private function setMsg() {
        $template = file_get_contents('_app/Library/EmailTemplates/contrate_confirm_email.html'); 

        //replace all the tags
        $template = preg_replace('{LOGORETRATUM}', INCLUDE_PATH.'/img/logo-light.png', $template);
        $template = preg_replace('{MAC01}', INCLUDE_PATH.'/img/mac01.png', $template);

        $template = preg_replace('{NOMECLIENTE}', $this->RemetenteNome, $template);
        $template = preg_replace('{EMAILCLIENTE}', $this->RemetenteEmail, $template);
        $template = preg_replace('{DDDCLIENTE}', $this->UserDDD, $template);
        $template = preg_replace('{TELEFONECLIENTE}', $this->UserTelefone, $template);
        $template = preg_replace('{CPFCLIENTE}', $this->UserCPF, $template);
        $template = preg_replace('{ENDCLIENTE}', $this->UserAddress, $template);
        $template = preg_replace('{NUMCLIENTE}', $this->UserAddressNumber, $template);
        $template = preg_replace('{COMPCLIENTE}', $this->UserAddressComp, $template);
        $template = preg_replace('{BAIRROCLIENTE}', $this->UserAddressBairro, $template);
        $template = preg_replace('{CEPCLIENTE}', $this->UserAddressCEP, $template);
        $template = preg_replace('{CIDADECLIENTE}', $this->UserAddressCidade, $template);
        $template = preg_replace('{ESTADOCLIENTE}', $this->UserAddressEstado, $template);
        $template = preg_replace('{SUBDOMAINCLIENTE}', $this->UserSubDomain, $template);
        $template = preg_replace('{DOMINIOCLIENTE}', $this->UserDomain, $template);
        $template = preg_replace('{COMOCONHECEU}', $this->UserComoConheceu, $template);
        $template = preg_replace('{TEMACLIENTE}', $this->UserTema, $template);
        $template = preg_replace('{PLANOCLIENTE}', $this->UserPlanoEscolhido, $template);
        $template = preg_replace('{FORMAPAGAMENTO}', $this->FormaPagamento, $template);
        $template = preg_replace('{TOTALAPAGAR}', $this->UserTotalPagar, $template);

        $this->Mensagem = $template;

    }

    //Configura o PHPMailer e valida o e-mail!
    private function Config() {
        //SMTP AUTH
        $this->Mail->IsSMTP();
        $this->Mail->SMTPAuth = true;
        $this->Mail->IsHTML();

        //REMETENTE E RETORNO
        $this->Mail->From = MAILUSER;
        $this->Mail->FromName = 'Retratum Site Pro';
        $this->Mail->AddReplyTo($this->RemetenteEmail, $this->RemetenteNome);

        //ASSUNTO, MENSAGEM E DESTINO
        $this->Mail->Subject = $this->Assunto;
        $this->Mail->Body = $this->Mensagem;
        $this->Mail->AddAddress($this->DestinoEmail, $this->DestinoNome);
    }

    //Envia o e-mail!
    private function sendMail() {
        if ($this->Mail->Send()):
            $this->Error = ['Um email de confirmação foi enviado para você!', WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Error = ["Ocorreu um erro ao enviar o email de confirmação. ( {$this->Mail->ErrorInfo} )", WS_ERROR];
            $this->Result = false;
        endif;
    }

}


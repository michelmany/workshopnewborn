<?php
/**
 * Cadastro.class [ MODEL ]
 * Responsável por cadastrar os usuários vindo do formulário de Inscrição no site.
 * 
 * @copyright (c) 2016, Michel Many NITDESIGN
 */
class Cadastro {

    private $Data;
    private $User;
    private $Error;
    private $Result;
    private $SendEmail;

    //Nome da tabela no banco de dados
    const Entity = 'nit_inscritos';

    /**
     * <b>Cadastrar Usuário:</b> Envelope os dados de um usuário em um array atribuitivo e execute esse método
     * para cadastrar o mesmo no sistema. Validações serão feitas!
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        // $this->checkEmail();

        // $this->setData();
        $this->Create();

    }

    /**
     * <b>Verificar Cadastro:</b> Retorna TRUE se o cadastro ou update for efetuado ou FALSE se não.
     * Para verificar erros execute um getError();
     * @return BOOL $Var = True or False
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * <b>Obter Erro:</b> Retorna um array associativo com um erro e um tipo.
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

    private function setData() {
        // unset($this->Data['termos']); //unset na seleção dos termos (...eu li e concordo com...)
        // $this->Data['user_registration'] = date('Y-m-d H:i:s');
        // $this->Data['user_username'] = strtolower($this->Data['user_username']); //coloca em minúsculo

        $this->Data['cad_cod'] = md5(uniqid(time()));      
    }    


    //Verifica usuário pelo e-mail, Impede cadastro duplicado!
    private function checkEmail() {
        $readUser = new Read;
        $readUser->ExeRead(self::Entity, "WHERE user_email = :email", "email={$this->Data['user_email']}");

        if ($readUser->getRowCount()):
            $this->Error = ["Oppsss: Já existe um cadastro com este email. Por favor tente com outro email. :)", WS_ERROR];
            $this->Result = false;
        else:
            $this->Result = true;
            $this->checkSubdomain();
        endif;
    }

    //Verifica se existe mesmo username (subdomain) cadastrado no banco. Impede cadastro duplicado!
    private function checkSubdomain() {
        $checkName = new Read;
        $checkName->ExeRead(self::Entity, "WHERE user_username = :title", "title={$this->Data['user_username']}");

        if ($checkName->getRowCount()):
            $this->Error = ["Oppsss: Já existe um usuário com esse domínio provisório. Por favor escolha outro. :)", WS_ALERT];  
            $this->Result = false;
        else:
            $this->Result = true;
        endif;    
    }

    //Cadastra no Banco!
    private function Create() {

        $Create = new Create;
        $Create->ExeCreate(self::Entity, $this->Data);

        if ($Create->getResult()):

            #Se usuário cadastrado com sucesso, crio ele também na tabela nit_site_config.
            $this->Result = $Create->getResult();
            // return "Olá, {$this->Data['cad_aluno']}";        


            // #seto apenas as variáveis que vão para a tabela nit_site_config.
            // $DataConfig['user_id'] = $this->Result;
            // $DataConfig['user_email'] = $this->Data['user_email'];    

            // #Cadastro na tabela nit_site_config também.
            // $CreateClientConfig = new Create;
            // $CreateClientConfig->ExeCreate('nit_site_config', $DataConfig);

            // $this->SendEmailToUs(); // Envia email de confirmação para nós mesmo.
            // $this->SendEmailToClient(); // Envia email de confirmação pro cliente   


                   
            // header('Location: ' . HOME . '/contrate-return');
            // $this->Result = $Create->getResult();
        else:
            $this->Error = ["Oppsss: Ocorreu algum erro ao tentar fazer seu cadastro, por favor tente outra vez.", WS_ERROR];
            $this->Result = false;
        endif;
    }

    private function ReturnLastSaved() {
        $lastSaved = new Read;
        $lastSaved->ExeRead(self::Entity, "WHERE cad_id = :id", "id={}");

        if ($checkName->getRowCount()):
            $this->Error = ["Oppsss: Já existe um usuário com esse domínio provisório. Por favor escolha outro. :)", WS_ALERT];  
            $this->Result = false;
        else:
            $this->Result = true;
        endif;    
    }    

    // Envia email de confirmação para nós mesmos.
    private function SendEmailToUs() {
        $SendEmailToUs = new ContrateConfirmEmail;
        $SendEmailToUs->Enviar($this->Data);

        if ($SendEmailToUs->getResult()):
            $this->Result = $SendEmailToUs->getResult();
        endif;
    }    

    // Envia email de confirmação pro cliente
    private function SendEmailToClient() {
        $SendEmailToClient = new ClientConfirmEmail;
        $SendEmailToClient->Enviar($this->Data);

        if ($SendEmailToClient->getResult()):
            $this->Result = $SendEmailToClient->getResult();
        endif;
    }

}

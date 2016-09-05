<?php

/**
 * AdminUser.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os usuários no Admin do sistema!
 * 
 * @copyright (c) 2014, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class AdminUser {

    private $Data;
    private $User;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'nit_users';

    /**
     * <b>Cadastrar Usuário:</b> Envelope os dados de um usuário em um array atribuitivo e execute esse método
     * para cadastrar o mesmo no sistema. Validações serão feitas!
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        $this->checkData();

        if ($this->Result):
            $this->Create();
        endif;
    }

    /**
     * <b>Atualizar Usuário:</b> Envelope os dados em uma array atribuitivo e informe o id de um
     * usuário para atualiza-lo no sistema!
     * @param INT $UserId = Id do usuário
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($UserId, array $Data) {
        $this->User = (int) $UserId;
        $this->Data = $Data;

        if (!$this->Data['user_password']):
            unset($this->Data['user_password']);
        endif;

        if (!$this->Data['user_domain']):
            $this->Data['user_domain'] == NULL; #Se não for setado deixa como nulo
        endif;

        if (!$this->Data['user_datafim']):
            unset($this->Data['user_datafim']);
        endif;        

        $this->checkData();

        if ($this->Result):
            $this->Update();
        endif;
    }

    /**
     * <b>Remover Usuário:</b> Informe o ID do usuário que deseja remover. Este método não permite deletar
     * o próprio perfil ou ainda remover todos os ADMIN'S do sistema!
     * @param INT $UserId = Id do usuário
     */
    public function ExeDelete($UserId) {
        $this->User = (int) $UserId;

        $readUser = new Read;
        $readUser->ExeRead(self::Entity, "WHERE user_id = :id", "id={$this->User}");

        if (!$readUser->getResult()):
            $this->Error = ['Oppsss, você tentou remover um usuário que não existe no sistema!', WS_ERROR];
            $this->Result = false;
        elseif ($this->User == $_SESSION['userlogin']['user_id']):
            $this->Error = ['Oppsss, você tentou remover seu usuário. Essa ação não é permitida!!!', WS_INFOR];
            $this->Result = false;
        else:
            if ($readUser->getResult()[0]['user_level'] == 3):

                $readAdmin = $readUser;
                $readAdmin->ExeRead(self::Entity, "WHERE user_id != :id AND user_level = :lv", "id={$this->User}&lv=3");

                if (!$readAdmin->getRowCount()):
                    $this->Error = ['Oppsss, você está tentando remover o único ADMIN do sistema. Para remover cadastre outro antes!!!', WS_ERROR];
                    $this->Result = false;
                else:
                    $this->Delete();
                endif;

            else:
                $this->Delete();
            endif;

        endif;
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

    //Verifica os dados digitados no formulário
    private function checkData() {
        if (!Check::Email($this->Data['user_email'])):
            $this->Error = ["O e-mail informado não parece ter um formato válido!", WS_ALERT];
            $this->Result = false;
        elseif (isset($this->Data['user_password']) && (strlen($this->Data['user_password']) < 6 || strlen($this->Data['user_password']) > 12)):
            $this->Error = ["A senha deve ter entre 6 e 12 caracteres!", WS_INFOR];
            $this->Result = false;
        else:
            $this->checkEmail();

            if (isset($this->Data['user_datafim'])):
                $this->Data['user_datafim'] = Check::Data($this->Data['user_datafim']);
            else:
                $this->Data['user_datafim'] = null;
            endif;

            if (isset($this->Data['user_password'])):
                $this->Data['user_password'] = md5($this->Data['user_password']);
            endif;            

    

        endif;
    }

    //Verifica usuário pelo e-mail, Impede cadastro duplicado!
    private function checkEmail() {
        $Where = ( isset($this->User) ? "user_id != {$this->User} AND" : '');

        $readUsername = new Read;
        $readUsername->ExeRead(self::Entity, "WHERE {$Where} user_username = :username", "username={$this->Data['user_username']}");  

        $readUser = new Read;
        $readUser->ExeRead(self::Entity, "WHERE {$Where} user_email = :email", "email={$this->Data['user_email']}");

        if ($readUsername->getRowCount()):
            $this->Error = ["O nome de usuário <strong><span class=\"text-yellow\">{$this->Data['user_username']}</span></strong> já existe no sistema! Informe outro Username!", WS_ERROR];
            $this->Result = false;
        elseif ($readUser->getRowCount()):
            $this->Error = ["O e-mail <strong><span class=\"text-yellow\">{$this->Data['user_email']}</span></strong> já existe no sistema! Informe outro e-mail!", WS_ERROR];
            $this->Result = false;
        else:
            $this->Result = true;
        endif;
    }

    //Cadastra Usuário!
    private function Create() {
        $this->Data['user_registration'] = date('Y-m-d H:i:s');

        $Create = new Create;
        $Create->ExeCreate(self::Entity, $this->Data);

        if ($Create->getResult()):

            #Se usuário cadastrado com sucesso, crio ele também na tabela nit_site_config.
            if($Create->getResult()):
                $this->Result = $Create->getResult();

                #seto apenas as variáveis que vão para a tabela nit_site_config.
                $DataConfig['user_id'] = $this->Result;
                $DataConfig['user_email'] = $this->Data['user_email'];    

                #Cadastro na tabela nit_site_config também.
                $CreateClientConfig = new Create;
                $CreateClientConfig->ExeCreate('nit_site_config', $DataConfig);

            endif;            

            #se usuário for criado com sucesso também na nit_site_config, mostro msg de sucesso!
            if($CreateClientConfig->getResult()):
                $this->Error = ["O usuário <b>{$this->Data['user_username']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT];
            endif;

            #envia mensagem de sucesso pela SESSION para mostrar na página de retorno.
            $_SESSION['sucesso'] = "O Cliente <b>{$this->Data['user_fullname']}</b> foi cadastrado com sucesso!";         
        endif;
    }

    //Atualiza Usuário!
    private function Update() {

        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE user_id = :id", "id={$this->User}");

        // var_dump($this->Data);
        // die();

        if ($Update->getResult()):
            #envia mensagem de sucesso pela SESSION para mostrar na página de retorno. 
            $_SESSION['sucesso'] = "O Cliente <b>{$this->Data['user_username']}</b> foi atualizado com sucesso!";         
            $this->Result = true;
        endif;
    }

    //Remove Usuário
    private function Delete() {
        $Delete = new Delete;
        $Delete->ExeDelete(self::Entity, "WHERE user_id = :id", "id={$this->User}");
        if ($Delete->getResult()):
            $this->Error = ["Usuário removido com sucesso do sistema!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }
}
<?php

/**
 * AdminUser.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os usuários no Admin do sistema!
 * 
 * @copyright (c) 2014, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class AdminDepoimento {

    private $Data;
    private $Depo;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'nit_depoimentos';

    /**
     * <b>Cadastrar Depoimento:</b> Envelope os dados de um depoimento em um array atribuitivo e execute esse método
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
     * <b>Atualizar Depoimento:</b> Envelope os dados em uma array atribuitivo e informe o id de um
     * usuário para atualiza-lo no sistema!
     * @param INT $DepoId = Id do usuário
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($DepoId, array $Data) {
        $this->Depo = (int) $DepoId;
        $this->Data = $Data;

        $this->checkData();

        if ($this->Result):
            $this->Update();
        endif;
    }

    /**
     * <b>Remover Usuário:</b> Informe o ID do usuário que deseja remover. Este método não permite deletar
     * o próprio perfil ou ainda remover todos os ADMIN'S do sistema!
     * @param INT $DepoId = Id do usuário
     */
    public function ExeDelete($DepoId) {
        $this->Depo = (int) $DepoId;

        $read = new Read;
        $read->ExeRead(self::Entity, "WHERE depo_id = :id", "id={$this->Depo}");

        if (!$read->getResult()):
            $this->Error = ['Oppsss, você tentou remover um depoimento que não existe no sistema!', WS_ERROR];
            $this->Result = false;
        else:
            $this->Delete();
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
        if (in_array('', $this->Data)):
            $this->Error = ["Existem campos em branco. Favor preencha todos os campos!", WS_ALERT];
            $this->Result = false;
        else:
            $this->Result = true;
        endif;
    }


    //Cadastra depoimento
    private function Create() {
        $Create = new Create;
        $this->Data['depo_date'] = Check::Data($this->Data['depo_date']);

        $Create->ExeCreate(self::Entity, $this->Data);

        if ($Create->getResult()):
            $this->Error = ["O depoimento de <b>{$this->Data['depo_nome']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = $Create->getResult();

            #envia mensagem de sucesso pela SESSION para mostrar na página de retorno.
            $_SESSION['sucesso'] = "Depoimento enviado com sucesso!";
        endif;
    }

    //Atualiza Depoimento
    private function Update() {
        $Update = new Update;
        $this->Data['depo_date'] = Check::Data($this->Data['depo_date']);

        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE depo_id = :id", "id={$this->Depo}");
        if ($Update->getResult()):
            //$this->Error = ["O Depoimento de <b>{$this->Data['depo_nome']}</b> foi atualizado com sucesso!", WS_ACCEPT];
            #envia mensagem de sucesso pela SESSION para mostrar na página de retorno.
            $_SESSION['sucesso'] = "O Depoimento de <b>{$this->Data['depo_nome']}</b> foi atualizado com sucesso!";
            $this->Result = true;
        endif;
    }

    //Remove depoimento
    private function Delete() {
        $Delete = new Delete;
        $Delete->ExeDelete(self::Entity, "WHERE depo_id = :id", "id={$this->Depo}");
        if ($Delete->getResult()):
            #mostra mensagem na própria tela, por isso não precisa da SESSION.
            $this->Error = ["Depoimento removido com sucesso do sistema!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

}

<?php

/**
 * AdminVideo.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os usuários no Admin do sistema!
 * 
 * @copyright (c) 2016, Michel Moraes NITDESIGN
 */
class AdminVideo {

    private $Data;
    private $Video;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'nit_videos';

    /**
     * <b>Cadastrar Video:</b> Envelope os dados de um video em um array atribuitivo e execute esse método
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
     * <b>Atualizar Video:</b> Envelope os dados em uma array atribuitivo e informe o id de um
     * usuário para atualiza-lo no sistema!
     * @param INT $VideoId = Id do usuário
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($VideoId, array $Data) {
        $this->Video = (int) $VideoId;
        $this->Data = $Data;

        $this->checkData();

        if ($this->Result):
            $this->Update();
        endif;
    }

    /**
     * <b>Remover Usuário:</b> Informe o ID do usuário que deseja remover. Este método não permite deletar
     * o próprio perfil ou ainda remover todos os ADMIN'S do sistema!
     * @param INT $VideoId = Id do usuário
     */
    public function ExeDelete($VideoId) {
        $this->Video = (int) $VideoId;

        $read = new Read;
        $read->ExeRead(self::Entity, "WHERE video_id = :id", "id={$this->Video}");

        if (!$read->getResult()):
            $this->Error = ['Oppsss, você tentou remover um video que não existe no sistema!', WS_ERROR];
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


    //Cadastra video
    private function Create() {
        $Create = new Create;
        $this->Data['video_date'] = date("Y-m-d");     

        $Create->ExeCreate(self::Entity, $this->Data);

        if ($Create->getResult()):
            $this->Error = ["O video de <b>{$this->Data['video_title']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = $Create->getResult();

            #envia mensagem de sucesso pela SESSION para mostrar na página de retorno.
            $_SESSION['sucesso'] = "Video enviado com sucesso!";
        endif;
    }

    //Atualiza Video
    private function Update() {
        $Update = new Update;
        $this->Data['video_date'] = date("Y-m-d");

        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE video_id = :id", "id={$this->Video}");
        if ($Update->getResult()):
            //$this->Error = ["O Video de <b>{$this->Data['video_title']}</b> foi atualizado com sucesso!", WS_ACCEPT];
            #envia mensagem de sucesso pela SESSION para mostrar na página de retorno.
            $_SESSION['sucesso'] = "O Video de <b>{$this->Data['video_title']}</b> foi atualizado com sucesso!";
            $this->Result = true;
        endif;
    }

    //Remove video
    private function Delete() {
        $Delete = new Delete;
        $Delete->ExeDelete(self::Entity, "WHERE video_id = :id", "id={$this->Video}");
        if ($Delete->getResult()):
            #mostra mensagem na própria tela, por isso não precisa da SESSION.
            $this->Error = ["Video removido com sucesso do sistema!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

}

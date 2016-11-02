<?php

/**
 * AdminWorkshop.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os workshops no sistema!
 * 
 * @copyright (c) 2016, Michel Moraes NITDESIGN
 */
class AdminWorkshop {

    private $Data;
    private $Depo;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'nit_workshops';

    /**
     * <b>Cadastrar Depoimento:</b> Envelope os dados de um depoimento em um array atribuitivo e execute esse método
     * para cadastrar o mesmo no sistema. Validações serão feitas!
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        $this->setData();
        $this->setName();

        if ($this->Data['workshop_capa']):
            $uplaod = new Upload;
            $uplaod->Image($this->Data['workshop_capa'], 'workshopcapa-'.$this->Data['workshop_url'], null, 'images/workshops');
        endif;

        if (isset($uplaod) && $uplaod->getResult()):
            $this->Data['workshop_capa'] = $uplaod->getResult();
            $this->Create();
        else:
            $this->Data['workshop_capa'] = null;
            $_SESSION['errCapa'] = "<br>Erro ao enviar Capa:</b> Tipo de arquivo inválido, envie imagens JPG ou PNG!";
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

        $this->Data['workshop_investimento'] = number_format( $this->Data['workshop_investimento'], 2, '.', '');

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
        $read->ExeRead(self::Entity, "WHERE workshop_id = :id", "id={$this->Depo}");

        if (!$read->getResult()):
            $this->Error = ['Oppsss, você tentou remover um workshop que não existe no sistema!', WS_ERROR];
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

    //Valida e cria os dados para realizar o cadastro
    private function setData() {
        $Cover = $this->Data['workshop_capa'];
        unset($this->Data['workshop_capa']);
        $Workshop_msg = $this->Data['workshop_msg']; //jogo para uma nova variable pra nao passar pelo strip_tags e trim.
        unset($this->Data['workshop_msg']);

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);
        $this->Data['workshop_nome'] = str_replace('&', 'e', $this->Data['workshop_nome']);
        $this->Data['workshop_url'] = Check::Name($this->Data['workshop_nome']);

        //volto com as variaveis dentro do $this->Data.
        $this->Data['workshop_capa'] = $Cover;
        $this->Data['workshop_msg'] = $Workshop_msg;
        $this->Data['workshop_investimento'] = number_format($workshop_investimento, 2, '.', '');
    }

    //Verifica o NAME post. Se existir adiciona um pós-fix -Count
    private function setName() {
        $Where = (isset($this->Post) ? "workshop_id != {$this->Post} AND" : '');
        $readName = new Read;
        $readName->ExeRead(self::Entity, "WHERE {$Where} workshop_nome = :t", "t={$this->Data['workshop_nome']}");
        if ($readName->getResult()):
            $this->Data['workshop_url'] = $this->Data['workshop_url'] . '-' . $readName->getRowCount();
        endif;
    }    

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
        $this->Data['workshop_date'] = Check::Data($this->Data['workshop_date']);

        $Create->ExeCreate(self::Entity, $this->Data);

        if ($Create->getResult()):
            $this->Error = ["O workshop <b>{$this->Data['workshop_nome']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = $Create->getResult();

            #envia mensagem de sucesso pela SESSION para mostrar na página de retorno.
            $_SESSION['sucesso'] = "Workshop cadastrado com sucesso!";
        endif;
    }

    //Atualiza Depoimento
    private function Update() {
        $Update = new Update;
        $this->Data['workshop_date'] = Check::Data($this->Data['workshop_date']);

        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE workshop_id = :id", "id={$this->Depo}");

        if ($Update->getResult()):
            //$this->Error = ["O Depoimento de <b>{$this->Data['workshop_nome']}</b> foi atualizado com sucesso!", WS_ACCEPT];
            #envia mensagem de sucesso pela SESSION para mostrar na página de retorno.
            $_SESSION['sucesso'] = "O Workshop de <b>{$this->Data['workshop_nome']}</b> foi atualizado com sucesso!";
            $this->Result = true;
        endif;
    }

    //Remove depoimento
    private function Delete() {
        $Delete = new Delete;
        $Delete->ExeDelete(self::Entity, "WHERE workshop_id = :id", "id={$this->Depo}");
        if ($Delete->getResult()):
            #mostra mensagem na própria tela, por isso não precisa da SESSION.
            $this->Error = ["Workshop removido com sucesso do sistema!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

}

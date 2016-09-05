<?php

/**
 * AdminCategory.class [ MODEL ADMIN ]
 * Responsável por gerenciar as temas do sistema no admin!
 * 
 * @copyright (c) 2014, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class AdminThemes {

    private $Data;
    private $ThemeId;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados!
    const Entity = 'nit_themes';

    /**
     * <b>Cadastrar tema:</b> Envelope titulo, descrição, data e sessão em um array atribuitivo e execute esse método
     * para cadastrar a tema. 
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Result = false;
            $this->Error = ['<b>Erro ao cadastrar:</b> Você esqueceu de inserir o nome do Tema!', WS_ALERT];
        else:
            $this->setData();
            $this->Create();
        endif;
    }

    /**
     * <b>Atualizar tema:</b> Envelope os dados em uma array atribuitivo e informe o id de uma
     * tema para atualiza-la!
     * @param INT $TemaId = Id da tema
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($TemaId, array $Data) {
        $this->ThemeId = (int) $TemaId;
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Result = false;
            $this->Error = ["<b>Erro ao atualizar:</b> Para atualizar o tema {$this->Data['theme_name']}, preencha todos os campos!", WS_ALERT];
        else:
            $this->setData();
            $this->Update();
        endif;
    }

    /**
     * <b>Deleta tema:</b> Informe o ID de uma tema para remove-la do sistema. Esse método verifica
     * o tipo de tema e se é permitido excluir de acordo com os registros do sistema!
     * @param INT $TemaId = Id da tema
     */
    public function ExeDelete($TemaId) {
        $this->ThemeId = (int) $TemaId;

        $read = new Read;
        $read->ExeRead(self::Entity, "WHERE theme_id = :delid", "delid={$this->ThemeId}");

        if (!$read->getResult()):
            $this->Result = false;
            $this->Error = ['Oppsss, você tentou remover um tema que não existe no sistema!', WS_ERROR];
        else:
            extract($read->getResult()[0]);
                $delete = new Delete;
                $delete->ExeDelete(self::Entity, "WHERE theme_id = :deletaid", "deletaid={$this->ThemeId}");
                $this->Result = true;
                $_SESSION['sucesso'] = "O <b>tema {$theme_name}</b> foi removido com sucesso do sistema!";
                header('Location: painel.php?exe=temas/index');                
        endif;
    }

    /**
     * <b>Verificar Cadastro:</b> Retorna TRUE se o cadastro ou update for efetuado ou FALSE se não. Para verificar
     * erros execute um getError();
     * @return BOOL $Var = True or False
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * <b>Obter Erro:</b> Retorna um array associativo com a mensagem e o tipo de erro!
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

    #Valida e cria os dados para realizar o cadastro
    private function setData() {

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);
        $this->Data['theme_name'] = strtolower($this->Data['theme_name']); #coloca o nome do tema em minúsculo.

    }

    #Cadastra o tema no banco!
    private function Create() {
        $Create = new Create;
        $Create->ExeCreate(self::Entity, $this->Data);
        if ($Create->getResult()):
            $this->Result = $Create->getResult();
            $this->Error = ["<b>Sucesso:</b> O tema <b>{$this->Data['theme_name']}</b> foi cadastrado no sistema!", WS_ACCEPT];
        endif;
    }

    #Atualiza tema
    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE theme_id = :themeid", "themeid={$this->ThemeId}");
        if ($Update->getResult()):
            $this->Result = true;
            $this->Error = ["<b>Sucesso:</b> O Tema {$this->Data['theme_name']} foi atualizado no sistema!", WS_ACCEPT];
        endif;
    }

}

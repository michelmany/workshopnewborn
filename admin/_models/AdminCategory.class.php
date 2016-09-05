<?php

/**
 * AdminCategory.class [ MODEL ADMIN ]
 * Responsável por gerenciar as categorias do sistema no admin!
 * 
 * @copyright (c) 2014, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class AdminCategory {

    private $Data;
    private $CatId;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados!
    const Entity = 'nit_albuns_cats';

    /**
     * <b>Cadastrar Categoria:</b> Envelope titulo, descrição, data e sessão em um array atribuitivo e execute esse método
     * para cadastrar a categoria. 
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Result = false;
            $this->Error = ['<b>Erro ao cadastrar:</b> Você esqueceu de inserir o nome da Categoria!', WS_ALERT];
        else:
            $this->setData();
            $this->Create();
        endif;
    }

    /**
     * <b>Atualizar Categoria:</b> Envelope os dados em uma array atribuitivo e informe o id de uma
     * categoria para atualiza-la!
     * @param INT $CategoryId = Id da categoria
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($CategoryId, array $Data) {
        $this->CatId = (int) $CategoryId;
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Result = false;
            $this->Error = ["<b>Erro ao atualizar:</b> Para atualizar a categoria {$this->Data['category_title']}, preencha todos os campos!", WS_ALERT];
        else:
            $this->setData();
            $this->Update();
        endif;
    }

    /**
     * <b>Deleta categoria:</b> Informe o ID de uma categoria para remove-la do sistema. Esse método verifica
     * o tipo de categoria e se é permitido excluir de acordo com os registros do sistema!
     * @param INT $CategoryId = Id da categoria
     */
    public function ExeDelete($CategoryId, $UserID) {
        $this->CatId = (int) $CategoryId;
        $this->UserID = (int) $UserID;

        $read = new Read;
        $read->ExeRead(self::Entity, "WHERE category_id = :delid AND user_id = :userid", "delid={$this->CatId}&userid={$this->UserID}");

        if (!$read->getResult()):
            $this->Result = false;
            $this->Error = ['Oppsss, você tentou remover uma categoria que não existe no sistema!', WS_ERROR];
        else:
            extract($read->getResult()[0]);
            if (!$this->checkPosts()):
                $this->Result = false;
                $this->Error = ["A categoria <b>{$category_title}</b> possui álbuns cadastrados. Para excluir, antes altere ou remova todos os álbuns desta categoria!", WS_ALERT];
            else:
                $delete = new Delete;
                $delete->ExeDelete(self::Entity, "WHERE category_id = :deletaid", "deletaid={$this->CatId}");


                $this->Result = true;
                $_SESSION['sucesso'] = "A <b>Categoria {$category_title}</b> foi removida com sucesso do sistema!";
                header('Location: painel.php?exe=albuns/categorias');                
            endif;
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

    }

    #Verifica artigos da categoria
    private function checkPosts() {
        $readPosts = new Read;
        $readPosts->ExeRead("nit_albuns", "WHERE album_categoria_id = :category", "category={$this->CatId}");
        if ($readPosts->getResult()):
            return false;
        else:
            return true;
        endif;
    }

    #Cadastra a categoria no banco!
    private function Create() {
        $Create = new Create;
        $Create->ExeCreate(self::Entity, $this->Data);
        if ($Create->getResult()):
            $this->Result = $Create->getResult();
            $this->Error = ["<b>Sucesso:</b> A categoria {$this->Data['category_title']} foi cadastrada no sistema!", WS_ACCEPT];
        endif;
    }

    #Atualiza Categoria
    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE category_id = :catid", "catid={$this->CatId}");
        if ($Update->getResult()):
            $this->Result = true;
            $this->Error = ["<b>Sucesso:</b> A Categoria {$this->Data['category_title']} foi atualizada no sistema!", WS_ACCEPT];
        endif;
    }

}

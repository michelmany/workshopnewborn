<?php

class AdminConfig {

    private $Data;
    private $Post;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'nit_site_config';

    /**
     * <b>Atualizar Post:</b> Envelope os dados em uma array atribuitivo e informe o id de um 
     * post para atualiza-lo na tabela!
     * @param INT $PostId = Id do post
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($UserId, array $Data) {
        $this->Post = (int) $UserId;
        $this->Data = $Data;

            $this->setData();

            if ($Data['user_logo'] == null) :
                $readCapa = new Read;
                $readCapa->ExeRead(self::Entity, "WHERE user_id = :userid", "userid={$this->Post}");
                $capa = '../uploads/' . $readCapa->getResult()[0]['user_logo'];
                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;          
                $this->Update();      
            else:
                $readCapa = new Read;
                $readCapa->ExeRead(self::Entity, "WHERE user_id = :userid", "userid={$this->Post}");
                $capa = '../uploads/' . $readCapa->getResult()[0]['user_logo'];
                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $uploadCapa = new Upload;
                $uploadCapa->Image($this->Data['user_logo'], 'user-logo-id'.$this->Post);                
            endif;            


            if (isset($uploadCapa) && $uploadCapa->getResult()):
                $this->Data['user_logo'] = $uploadCapa->getResult();
                $this->Update();

            else:
                unset($this->Data['user_logo']);
                if(!empty($uploadCapa) && $uploadCapa->getError()):
                    WSErro("<b>Erro ao enviar Capa:</b> " . $uploadCapa->getError(), WS_ALERT);
                endif;    
                $this->Update();
            endif;

    }

    /**
     * <b>Verificar Cadastro:</b> Retorna ID do registro se o cadastro for efetuado ou FALSE se não.
     * Para verificar erros execute um getError();
     * @return BOOL $Var = InsertID or False
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * <b>Obter Erro:</b> Retorna um array associativo com uma mensagem e o tipo de erro.
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
        $Cover = $this->Data['user_logo'];
        unset($this->Data['user_logo']);

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);
        $this->Data['user_logo'] = $Cover;

    }


    //Atualiza o post no banco!
    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE user_id = :userid", "userid={$this->Post}");
        if ($Update->getResult()):
            $this->Error = ["As Configurações <b>Gerais</b> foram atualizadas com sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

}

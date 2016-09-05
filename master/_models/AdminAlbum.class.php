<?php

class AdminAlbum {

    private $Data;
    private $Post;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'nit_albuns';

    /**
     * <b>Cadastrar o Post:</b> Envelope os dados do post em um array atribuitivo e execute esse método
     * para cadastrar o post. Envia a capa automaticamente!
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;

            $this->setData();
            $this->setName();

            if ($this->Data['album_capa']):
                $uplaod = new Upload;
                $uplaod->Image($this->Data['album_capa'], $this->Data['album_url']);
            endif;

            if (isset($uplaod) && $uplaod->getResult()):
                $this->Data['album_capa'] = $uplaod->getResult();
                $this->Create();
            else:
                $this->Data['album_capa'] = null;
                $_SESSION['errCapa'] = "<br>Erro ao enviar Capa:</b> Tipo de arquivo inválido, envie imagens JPG ou PNG!";
                $this->Create();
            endif;

    }


    /**
     * <b>Atualizar Post:</b> Envelope os dados em uma array atribuitivo e informe o id de um 
     * post para atualiza-lo na tabela!
     * @param INT $PostId = Id do post
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($PostId, array $Data) {
        $this->Post = (int) $PostId;
        $this->Data = $Data;

            $this->setData();
            $this->setName();

            if (is_array($this->Data['album_capa'])):
                $readCapa = new Read;
                $readCapa->ExeRead(self::Entity, "WHERE album_id = :post", "post={$this->Post}");
                $capa = '../uploads/' . $readCapa->getResult()[0]['album_capa'];
                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $uploadCapa = new Upload;
                $uploadCapa->Image($this->Data['album_capa'], $this->Data['album_url']);
            endif;

            if (isset($uploadCapa) && $uploadCapa->getResult()):
                $this->Data['album_capa'] = $uploadCapa->getResult();
                $this->Update();
            else:
                unset($this->Data['album_capa']);
                if(!empty($uploadCapa) && $uploadCapa->getError()):
                    WSErro("<b>Erro ao enviar Capa:</b> " . $uploadCapa->getError(), WS_ALERT);
                endif;    
                $this->Update();
            endif;

    }

    /**
     * <b>Deleta Post:</b> Informe o ID do post a ser removido para que esse método realize uma checagem de
     * pastas e galerias excluinto todos os dados nessesários!
     * @param INT $PostId = Id do post
     */
    public function ExeDelete($PostId, $UserID) {
        $this->Post = (int) $PostId;

        $ReadPost = new Read;
        $ReadPost->ExeRead(self::Entity, "WHERE album_id = :post AND user_id = :userid", "post={$this->Post}&userid={$UserID}");
        #Adicionei o $UserID por medida de segurança. O usuário não consegue deletar outro slider alterando o ID na url.

        if (!$ReadPost->getResult()):
            $this->Error = ["Este álbum que você tentou deletar não existe!", WS_ERROR];
            $this->Result = false;
        else:
            $PostDelete = $ReadPost->getResult()[0];
            if (file_exists('../uploads/' . $PostDelete['album_capa']) && !is_dir('../uploads/' . $PostDelete['album_capa'])):
                unlink('../uploads/' . $PostDelete['album_capa']);
            endif;

            $readGallery = new Read;
            $readGallery->ExeRead("nit_albuns_imgs", "WHERE album_id = :id", "id={$this->Post}");
            if ($readGallery->getResult()):
                foreach ($readGallery->getResult() as $gbdel):
                    if (file_exists('../uploads/' . $gbdel['gallery_image']) && !is_dir('../uploads/' . $gbdel['gallery_image'])):
                        unlink('../uploads/' . $gbdel['gallery_image']);
                    endif;
                endforeach;
            endif;

            $deleta = new Delete;
            $deleta->ExeDelete("nit_albuns_imgs", "WHERE album_id = :gbpost", "gbpost={$this->Post}");
            $deleta->ExeDelete(self::Entity, "WHERE album_id = :postid", "postid={$this->Post}");

            $this->Error = ["O Álbum <b>{$PostDelete['album_nome']}</b> foi removido com sucesso!", WS_ACCEPT];
            $this->Result = true;

        endif;
    }

    /**
     * <b>Ativa/Inativa Post:</b> Informe o ID do post e o status e um status sendo 1 para ativo e 0 para
     * rascunho. Esse méto ativa e inativa os posts!
     * @param INT $PostId = Id do post
     * @param STRING $PostStatus = 1 para ativo, 0 para inativo
     */
    public function ExeStatus($PostId, $PostStatus) {
        $this->Post = (int) $PostId;
        $this->Data['album_status'] = (string) $PostStatus;
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE album_id = :id", "id={$this->Post}");
    }

    /**
     * <b>Enviar Galeria:</b> Envelope um $_FILES de um input multiple e envie junto a um postID para executar
     * o upload e o cadastro de galerias do artigo!
     * @param ARRAY $Files = Envie um $_FILES multiple
     * @param INT $PostId = Informe o ID do post
     */
    public function gbSend(array $Images, $PostId) {
        $this->Post = (int) $PostId;
        $this->Data = $Images;

        $ImageName = new Read;
        $ImageName->ExeRead(self::Entity, "WHERE album_id = :id", "id={$this->Post}");

        if (!$ImageName->getResult()):
            $this->Error = ["Erro ao enviar imagens. O índice {$this->Post} não foi encontrado no banco!", WS_ERROR];
            $this->Result = false;
        else:
            $ImageName = $ImageName->getResult()[0]['album_url'];

            $gbFiles = array();
            $gbCount = count($this->Data['tmp_name']);
            $gbKeys = array_keys($this->Data);

            for ($gb = 0; $gb < $gbCount; $gb++):
                foreach ($gbKeys as $Keys):
                    $gbFiles[$gb][$Keys] = $this->Data[$Keys][$gb];
                endforeach;
            endfor;

            $gbSend = new Upload;
            $i = 0;
            $u = 0;

            foreach ($gbFiles as $gbUpload):
                $i++;
                $ImgName = "{$ImageName}-gb-{$this->Post}-" . (substr(md5(time() + $i), 0, 5));
                $gbSend->Image($gbUpload, $ImgName, 1240);

                if ($gbSend->getResult()):
                    $gbImage = $gbSend->getResult();
                    $gbCreate = ['album_id' => $this->Post, "gallery_image" => $gbImage, "gallery_date" => date('Y-m-d H:i:s')];
                    $insertGb = new Create;
                    $insertGb->ExeCreate("nit_albuns_imgs", $gbCreate);
                    $u++;
                endif;

            endforeach;

            if ($u > 1):
                $this->Error = ["Galeria Atualizada: Foram enviadas {$u} imagens para galeria deste post!", WS_ACCEPT];
                $this->Result = true;
            endif;
        endif;
    }

    /**
     * <b>Deletar Imagem da galeria:</b> Informe apenas o id da imagem na galeria para que esse método leia e remova
     * a imagem da pasta e delete o registro do banco!
     * @param INT $GbImageId = Id da imagem da galleria
     */
    public function gbRemove($GbImageId) {
        $this->Post = (int) $GbImageId;
        $readGb = new Read;
        $readGb->ExeRead("nit_albuns_imgs", "WHERE gallery_id = :gb", "gb={$this->Post}");
        if ($readGb->getResult()):

            $Imagem = '../uploads/' . $readGb->getResult()[0]['gallery_image'];

            if (file_exists($Imagem) && !is_dir($Imagem)):
                unlink($Imagem);
            endif;

            $Deleta = new Delete;
            $Deleta->ExeDelete("nit_albuns_imgs", "WHERE gallery_id = :id", "id={$this->Post}");
            if ($Deleta->getResult()):
                $this->Error = ["A imagem foi removida com sucesso da galeria!", WS_ACCEPT];
                $this->Result = true;
            endif;

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
        $Cover = $this->Data['album_capa'];
        $Content = $this->Data['album_desc'];
        unset($this->Data['album_capa'], $this->Data['album_desc']);

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['album_url'] = Check::Name($this->Data['album_nome']);
        $this->Data['album_data'] = Check::Data($this->Data['album_data']);
        //$this->Data['post_type'] = 'post';
        $this->Data['album_capa'] = $Cover;
        $this->Data['album_desc'] = $Content;
        //$this->Data['album_categoria_id'] = $this->getCatParent();
    }

    //Obtem o ID da categoria PAI
    private function getCatParent() {
        $rCat = new Read;
        $rCat->ExeRead("nit_categorias", "WHERE category_id = :id", "id={$this->Data['post_category']}");
        if ($rCat->getResult()):
            return $rCat->getResult()[0]['category_parent'];
        else:
            return null;
        endif;
    }

    //Verifica o NAME post. Se existir adiciona um pós-fix -Count
    private function setName() {
        $Where = (isset($this->Post) ? "album_id != {$this->Post} AND" : '');
        $readName = new Read;
        $readName->ExeRead(self::Entity, "WHERE {$Where} album_nome = :t", "t={$this->Data['album_nome']}");
        if ($readName->getResult()):
            $this->Data['album_url'] = $this->Data['album_url'] . '-' . $readName->getRowCount();
        endif;
    }

    //Cadastra o post no banco!
    private function Create() {
        $cadastra = new Create;
        $cadastra->ExeCreate(self::Entity, $this->Data);
        if ($cadastra->getResult()):
            $this->Error = ["O álbum {$this->Data['album_nome']} foi cadastrado com sucesso!", WS_ACCEPT];
            $this->Result = $cadastra->getResult();
        endif;
    }

    //Atualiza o post no banco!
    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE album_id = :id", "id={$this->Post}");
        if ($Update->getResult()):
            $this->Error = ["O álbum <b>{$this->Data['album_nome']}</b> foi atualizado com sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

}

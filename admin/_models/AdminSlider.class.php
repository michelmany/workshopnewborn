<?php

/**
 * AdminSlider.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os posts no Admin do sistema!
 * 
 * @copyright (c) 2014, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class AdminSlider {

    private $Data;
    private $Slider;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'nit_slider';

    /**
     * <b>Cadastrar o Slider:</b> Envelope os dados do post em um array atribuitivo e execute esse método
     * para cadastrar o post. Envia a capa automaticamente!
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        $this->UserID = (int) $Data['user_id'];

            $this->setData();
            //$this->setName();

            if ($this->Data['slider_url_img']):
                $upload = new Upload;
                $upload->Image($this->Data['slider_url_img'], 'slide-'.$this->Data['slider_title2'], 1920, 'images/user-id'.$this->UserID);
            endif;

            if (isset($upload) && $upload->getResult()):
                $this->Data['slider_url_img'] = $upload->getResult();
                $this->Create();
            else:
                $this->Data['slider_url_img'] = null;
                $_SESSION['errCapa'] = "<br>Erro ao enviar Capa:</b> Tipo de arquivo inválido, envie imagens JPG ou PNG!";
                $this->Create();
            endif;
    }

    /**
     * <b>Atualizar Slider:</b> Envelope os dados em uma array atribuitivo e informe o id de um 
     * post para atualiza-lo na tabela!
     * @param INT $SliderId = Id do post
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($SliderId, array $Data) {
        $this->Slider = (int) $SliderId;
        $this->Data = $Data;
        $this->UserID = (int) $Data['user_id'];        

            $this->setData();
            //$this->setName();

            if (is_array($this->Data['slider_url_img'])):
                $readCapa = new Read;
                $readCapa->ExeRead(self::Entity, "WHERE slider_id = :slider", "slider={$this->Slider}");
                $capa = '../uploads/' . $readCapa->getResult()[0]['slider_url_img'];
                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $uploadCapa = new Upload;
                $uploadCapa->Image($this->Data['slider_url_img'], 'slide-'.$this->Data['slider_title2'], 1920, 'images/user-id'.$this->UserID);
            endif;

            if (isset($uploadCapa) && $uploadCapa->getResult()):
                $this->Data['slider_url_img'] = $uploadCapa->getResult();
                $this->Update();
            else:
                unset($this->Data['slider_url_img']);
                if(!empty($uploadCapa) && $uploadCapa->getError()):
                    WSErro("<b>Erro ao enviar imagem do Slide:</b> " . $uploadCapa->getError(), WS_ALERT);
                endif;    
                $this->Update();
            endif;

    }

    /**
     * <b>Deleta Slider:</b> Informe o ID do slider a ser removido para que esse método realize uma checagem de
     * pastas e galerias excluinto todos os dados nessesários!
     * @param INT $SliderId = Id do post
     */
    public function ExeDelete($SliderId, $UserID)
    {
        $this->Slider = (int) $SliderId;

        $ReadSlider = new Read;
        $ReadSlider->ExeRead(self::Entity, "WHERE slider_id = :sliderid AND user_id = :userid", "sliderid={$this->Slider}&userid={$UserID}");
        #Adicionei o $UserID por medida de segurança. O usuário não consegue deletar outro slider alterando o ID na url.

        if (!$ReadSlider->getResult()):
            $this->Error = ["O Slider que você tentou deletar não existe!", WS_ERROR];
            $this->Result = false;
        else:
            $SliderDelete = $ReadSlider->getResult()[0];
            if (file_exists('../uploads/' . $SliderDelete['slider_url_img']) && !is_dir('../uploads/' . $SliderDelete['slider_url_img'])):
                unlink('../uploads/' . $SliderDelete['slider_url_img']);
            endif;

            $deleta = new Delete;
            $deleta->ExeDelete(self::Entity, "WHERE slider_id = :sliderid", "sliderid={$this->Slider}");

            $this->Error = ["O slide <b>{$SliderDelete['slider_title2']}</b> foi removido com sucesso do sistema!", WS_ACCEPT];
            $this->Result = true;

        endif;
    }

    /**
     * <b>Ativa/Inativa Slider:</b> Informe o ID do post e o status e um status sendo 1 para ativo e 0 para
     * rascunho. Esse méto ativa e inativa os posts!
     * @param INT $SliderId = Id do post
     * @param STRING $SliderStatus = 1 para ativo, 0 para inativo
     */
    public function ExeStatus($SliderId, $SliderStatus) {
        $this->Slider = (int) $SliderId;
        $this->Data['post_status'] = (string) $SliderStatus;
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE slider_id = :id", "id={$this->Slider}");
    }


    /**
     * <b>Cadastrar o Slider:</b> Envelope os dados do post em um array atribuitivo e execute esse método
     * para cadastrar o post. Envia a capa automaticamente!
     * @param ARRAY $Data = Atribuitivo
     */
    public function croppedSend(array $SliderId) {
        $this->Slider = (int) $SliderId;

            $sliderCropped = $this->Data['slider_url_img_cropped'];

            $this->setData();
            //$this->setName();

            if ($this->Data['slider_url_img']):
                $upload = new Upload;
                $upload->Image($this->Data['slider_url_img_cropped'], $this->Data['slider_title2']);
            endif;

            if (isset($upload) && $upload->getResult()):
                $this->Data['slider_url_img_cropped'] = $upload->getResult();
                $this->Create();
            else:
                $this->Data['slider_url_img_cropped'] = null;
                $_SESSION['errCapa'] = "<br>Erro ao enviar imagem Recortada:</b> Tipo de arquivo inválido, envie imagens JPG ou PNG!";
                $this->Create();
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


    # Valida e cria os dados para realizar o cadastro #
    private function setData() {
        $UrlImage       = $this->Data['slider_url_img'];
        $Title1         = $this->Data['slider_title1'];
        $Title2         = $this->Data['slider_title2'];
        $Title3         = $this->Data['slider_title3'];
        $Link           = $this->Data['slider_link'];

        unset($this->Data['slider_url_img'],
            $this->Data['slider_title1'],
            $this->Data['slider_title2'],
            $this->Data['slider_title3'],
            $this->Data['slider_link']
            );

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

        //$this->Data['post_name'] = Check::Name($this->Data['post_title']);
        //$this->Data['post_date'] = Check::Data($this->Data['post_date']);
        $this->Data['slider_url_img']           = $UrlImage;
        $this->Data['slider_title1']            = $Title1;
        $this->Data['slider_title2']            = str_replace('&', 'e', $Title2);
        $this->Data['slider_title3']            = $Title3;
        $this->Data['slider_link']              = $Link;

        //$this->Data['post_cat_parent'] = $this->getCatParent();
    }

    # Verifica o NAME post. Se existir adiciona um pós-fix -Count #
    private function setName() {
        $Where = (isset($this->Slider) ? "slider_id != {$this->Slider} AND" : '');
        $readName = new Read;
        $readName->ExeRead(self::Entity, "WHERE {$Where} slide_title = :t", "t={$this->Data['post_title']}");
        if ($readName->getResult()):
            $this->Data['slide_name'] = $this->Data['slide_name'] . '-' . $readName->getRowCount();
        endif;
    }

    # CADASTRA O POST NO BANCO #
    private function Create() {
        $cadastra = new Create;
        $cadastra->ExeCreate(self::Entity, $this->Data);
        if ($cadastra->getResult()):
            $this->Error = ["O slide {$this->Data['slide_title2']} foi cadastrado com sucesso!", WS_ACCEPT];
            $this->Result = $cadastra->getResult();
        endif;
    }

    # ATUALIZA O POST NO BANCO #
    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE slider_id = :id", "id={$this->Slider}");
        if ($Update->getResult()):
            $this->Error = ["O slide <b>{$this->Data['slide_title2']}</b> foi atualizado com sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

}

<?php

/**
 * Loveit.class [ MODEL ]
 * Classe responável manipular dados do botão de curtir imagens.
 * 
 * @copyright (c) 2015, Michel Many NITDESIGN
 */
class Loveit {

	private $Data;
    private $Error;
    private $Result;


    # Nome da tabela no banco de dados
    const Entity = 'nit_loveit';	

    /**
     * <b>Cadastrar a Curtida no banco:</b> Envelope os dados do post em um array atribuitivo e execute esse método
     * para cadastrar a Curtida.
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data){
    	$this->Data = $Data;
		$this->setData();

    	#verifico se já foi votado.
		$readLoveit = new Read;
		$readLoveit->ExeRead('nit_loveit', "WHERE loveit_img_id = :imgid AND loveit_user_ip = :userip", "imgid={$Data['loveit_img_id']}&userip={$Data['loveit_user_ip']}");

		if ($readLoveit->getResult()):
			echo 'Já votou!';
		else:
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


    # Valida e cria os dados para realizar o cadastro
    private function setData() {
        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);
    }


    # CADASTRA O POST NO BANCO #
    private function Create() {
        $cadastra = new Create;
        $cadastra->ExeCreate(self::Entity, $this->Data);
        if ($cadastra->getResult()):
            $this->Result = $cadastra->getResult();
        endif;
    }    

}

<?php

/**
 * Check.class [ HELPER ]
 * Classe responável por manipular e validade dados do sistema!
 * 
 * @copyright (c) 2014, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class Check {

    private static $Data;
    private static $Format;

    /**
     * <b>Verifica E-mail:</b> Executa validação de formato de e-mail. Se for um email válido retorna true, ou retorna false.
     * @param STRING $Email = Uma conta de e-mail
     * @return BOOL = True para um email válido, ou false
     */
    public static function Email($Email) {
        self::$Data = (string) $Email;
        self::$Format = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';

        if (preg_match(self::$Format, self::$Data)):
            return true;
        else:
            return false;
        endif;
    }

    /**
     * <b>Tranforma URL:</b> Tranforma uma string no formato de URL amigável e retorna o a string convertida!
     * @param STRING $Name = Uma string qualquer
     * @return STRING = $Data = Uma URL amigável válida
     */
    public static function Name($Name) {
        self::$Format = array();
        self::$Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        self::$Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

        self::$Data = strtr(utf8_decode($Name), utf8_decode(self::$Format['a']), self::$Format['b']);
        self::$Data = strip_tags(trim(self::$Data));
        self::$Data = str_replace(' ', '-', self::$Data);
        self::$Data = str_replace(array('-----', '----', '---', '--'), '-', self::$Data);

        return strtolower(utf8_encode(self::$Data));
    }

    /**
     * <b>Tranforma Data:</b> Transforma uma data no formato DD/MM/YY em uma data no formato TIMESTAMP!
     * @param STRING $Name = Data em (d/m/Y) ou (d/m/Y H:i:s)
     * @return STRING = $Data = Data no formato timestamp!
     */
    public static function Data($Data) {
        self::$Format = explode(' ', $Data);
        self::$Data = explode('/', self::$Format[0]);

        if (empty(self::$Format[1])):
            self::$Format[1] = date('H:i:s');
        endif;

        self::$Data = self::$Data[2] . '-' . self::$Data[1] . '-' . self::$Data[0] . ' ' . self::$Format[1];
        return self::$Data;
    }

    /**
     * <b>Limita os Palavras:</b> Limita a quantidade de palavras a serem exibidas em uma string!
     * @param STRING $String = Uma string qualquer
     * @return INT = $Limite = String limitada pelo $Limite
     */
    public static function Words($String, $Limite, $Pointer = null) {
        self::$Data = strip_tags(trim($String));
        self::$Format = (int) $Limite;

        $ArrWords = explode(' ', self::$Data);
        $NumWords = count($ArrWords);
        $NewWords = implode(' ', array_slice($ArrWords, 0, self::$Format));

        $Pointer = (empty($Pointer) ? '...' : ' ' . $Pointer );
        $Result = ( self::$Format < $NumWords ? $NewWords . $Pointer : self::$Data );
        return $Result;
    }

    /**
     * <b>Obter categoria:</b> Informe o name (url) de uma categoria para obter o ID da mesma.
     * @param STRING $category_name = URL da categoria
     * @return INT $category_id = id da categoria informada
     */
    public static function CatByName($CategoryName) {
        $read = new Read;
        $read->ExeRead('ws_categories', "WHERE category_name = :name", "name={$CategoryName}");
        if ($read->getRowCount()):
            return $read->getResult()[0]['category_id'];
        else:
            echo "A categoria {$CategoryName} não foi encontrada!";
            die;
        endif;
    }

    /**
     * <b>Obter categoria:</b> Informe o id de uma categoria para obter o Nome da mesma.
     */
    public static function CatById($CategoryId) {
        $read = new Read;
        $read->ExeRead('nit_albuns_cats', "WHERE category_id = :id", "id={$CategoryId}");
        if ($read->getRowCount()):
            return $read->getResult()[0]['category_title'];
        else:
            echo "Sem categoria";
        endif;
    }    


    /**
     * <b>Obter Nome do Tema do usuário:</b> Informa o nomedocliente e mostra o nome do tema dele.
     */
    public static function ThemeByName($username) {
        $read = new Read;
        $read->ExeRead('nit_users', "WHERE user_username = '$username'");
        if ($read->getRowCount()):
            $cliente = $read->getResult()[0];
            $themeid = $cliente['theme_id'];    
        endif;
        $read->ExeRead('nit_themes', "WHERE theme_id = '$themeid'");
        $theme = $read->getResult()[0];
        return $themeName = $theme['theme_name'];    
    } 

    /**
     * <b>Obter Nome do Tema do usuário:</b> Informa o nomedocliente e mostra o nome do tema dele.
     */
    public static function ThemeIdNyName($theme_name) {
        $read = new Read;
        $read->ExeRead('nit_themes', "WHERE theme_name = '$theme_name'");
        if ($read->getRowCount()):
            $theme = $read->getResult()[0];
        endif;
        return $theme['theme_id'];
    }     


    /**
     * <b>Obter Nome do Tema do usuário:</b> Informa o nomedocliente e mostra o nome do tema dele.
     */
    public static function ThemeById($theme_id) {
        $read = new Read;
        $read->ExeRead('nit_themes', "WHERE theme_id = '$theme_id'");
        if ($read->getResult()):
            $theme = $read->getResult()[0];
            return $theme['theme_name'];   
        else:
            return null;   
        endif;
    }  


    /**
     * <b>Obter Nome do Tema do usuário:</b> Informa o nomedocliente e mostra o nome do tema dele.
     */
    public static function PlanoNameById($plano_id) {
        $read = new Read;
        $read->ExeRead('nit_planos', "WHERE plano_id = '$plano_id'");
        if ($read->getResult()):
            $plano_id = $read->getResult()[0];
            return $plano_id['plano_name'];   
        else:
            return null;   
        endif;
    }    




    /**
     * <b>Obter Nome do Tema do usuário:</b> Informa o nomedocliente e mostra o nome do tema dele.
     */
    public static function UserIdByUsername($username) {
        $read = new Read;
        $read->ExeRead('nit_users', "WHERE user_username = '$username'");
        if ($read->getRowCount()):
            $cliente = $read->getResult()[0];
            return $cliente['user_id'];    
        endif;
    }     


    /**
     * <b>Obter Quantidade de Álbuns pela categoria:</b> Informa a quantidade de álbuns com a categoria.
     */
    public static function QtdAlbunsbyCat($category_id) {
        $read = new Read;
        $read->ExeRead('nit_albuns', "WHERE album_categoria_id = '$category_id'");
        if ($read->getRowCount() >= 1):
            return $read->getRowCount();
        else:
            return '0';
        endif;

    }

    /**
     * <b>Obter Quantidade de Posts pela categoria:</b> Informa a quantidade de posts com a categoria.
     */
    public static function QtdPostsbyCat($category_id) {
        $read = new Read;
        $read->ExeRead('nit_posts', "WHERE post_categoria_id = '$category_id'");
        if ($read->getRowCount() >= 1):
            return $read->getRowCount();
        else:
            return '0';
        endif;

    }    

    /**
     * <b>Obter Quantidade de Fotos Cadastradas:</b> Informa a soma de fotos de todos os albuns.
     */
    public static function getFotosByAlbum($user_id) {
        $totalFotos = null;
        $read = new Read;
        $read->ExeRead('nit_albuns', "WHERE user_id = '$user_id'");
        if ($read->getResult()):
            foreach($read->getResult() as $album):
            $read->ExeRead("nit_albuns_imgs", "WHERE album_id = :albumid", "albumid={$album['album_id']}");
            $Fotos = $read->getRowCount();
            $totalFotos += $Fotos;
            endforeach; 
            return $totalFotos;
        else:
            return '0';
        endif;
    }      


    /**
     * Calcula data de vencimento do plano
     */
    public static function dataFimPlano($dataFimBanco) {

        $datahoje   = new DateTime(date('Y-m-d'));
        $datafim    = new DateTime(date('Y-m-d', strtotime($dataFimBanco)));
        $interval   = $datahoje->diff($datafim);

        if ($interval->format('%R%a') > 0 ):
            $dias = ($interval->format('%R%a')) == +1 ? 'dia' : 'dias';
            return 'Seu plano vence em ' .$interval->format('%a ' . $dias);
        else:
            $datavenc = ($datafim == $datahoje) ? 'hoje' : 'no dia ' . date('d/m/Y', strtotime($dataFimBanco));
            return '<span class=""><strong>Seu plano venceu ' . $datavenc.'</strong></span>';
        endif;

    }  

    /**
     * Calcula o valor total a pagar
     */
    public static function TotalAPagar($valor1 = 0, $valor2 = 0) {
            return $valor1 + $valor2;
    }  

    public static function slugify($text)
    {
      // replace non letter or digits by -
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      // trim
      $text = trim($text, '-');

      // remove duplicate -
      $text = preg_replace('~-+~', '-', $text);

      // lowercase
      $text = strtolower($text);

      if (empty($text)) {
        return 'n-a';
      }

      return $text;
    }    
    

    /**
     * Quantidade de likes em imagens de um tederminado album.
     */
    public static function QtdImgLikes($albumid) {

        $read = new Read;
        $read->ExeRead('nit_loveit', "WHERE loveit_album_id = :albumid", "albumid={$albumid}");
        if ($read->getResult()):
            $Likes = $read->getRowCount();
            return $Likes;
        else:
            return '0';
        endif;

    }    

    

    /**
     * Quantidade total de likes em todas os albuns do cliente.
     */
    public static function QtdTotalLikes($UserID) {

        $read = new Read;
        $read->ExeRead('nit_loveit', "WHERE loveit_cliente_id = :clienteid", "clienteid={$UserID}");
        if ($read->getResult()):
            $Likes = $read->getRowCount();
            return $Likes;
        else:
            return '0';
        endif;

    }  

    /**
     * Pega a imagem mais curtida e mostra a qualidade de curtidas ela teve.
     */
    public static function MaisCurtida($UserID) {

        $read = new Read;
        $read->FullRead("SELECT loveit_img_id, COUNT(loveit_img_id) 
                            AS curtidas 
                            FROM nit_loveit 
                            WHERE loveit_cliente_id = :clienteid
                            GROUP BY loveit_img_id 
                            HAVING COUNT(loveit_img_id) > 1 
                            ORDER BY COUNT(loveit_img_id) DESC", "clienteid={$UserID}");

        if ($read->getResult()):
            $Likes = $read->getResult()[0]['curtidas']; #Pego o primeiro resultado e mostra o valor da coluna 'curtidas'.
            return $Likes;
        else:
            return '0';
        endif;
    }             
         

    /**
     * <b>Usuários Online:</b> Ao executar este HELPER, ele automaticamente deleta os usuários expirados. Logo depois
     * executa um READ para obter quantos usuários estão realmente online no momento!
     * @return INT = Qtd de usuários online
     */
    public static function UserOnline() {
        $now = date('Y-m-d H:i:s');
        $deleteUserOnline = new Delete;
        $deleteUserOnline->ExeDelete('nit_siteviews_online', "WHERE online_endview < :now", "now={$now}");

        $readUserOnline = new Read;
        $readUserOnline->ExeRead('nit_siteviews_online');
        return $readUserOnline->getRowCount();
    }

    /**
     * <b>Imagem Upload:</b> Ao executar este HELPER, ele automaticamente verifica a existencia da imagem na pasta
     * uploads. Se existir retorna a imagem redimensionada!
     * @return HTML = imagem redimencionada!
     */
    public static function Image($ImageUrl, $ImageDesc, $ImageW = null, $ImageH = null) {

        self::$Data = $ImageUrl;

        if (file_exists(self::$Data) && !is_dir(self::$Data)):
            $patch = HOME;
            $imagem = self::$Data;
            $filemod = time(); #coloco o time no final da URL para poder limpar o cache da imagem

            return "<img class=\"img-responsive\" src=\"{$patch}/tim.php?src={$patch}/{$imagem}&w={$ImageW}&h={$ImageH}?{$filemod}\" alt=\"{$ImageDesc}\" title=\"{$ImageDesc}\"/>";
        else:
            return false;
        endif;
    }

}



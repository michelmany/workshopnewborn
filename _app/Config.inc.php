<?php
// CONFIGURAÇÕES DO BANCO ####################
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', 'Km7GnZPU');
define('DBSA', 'workshop');

// DEFINE A BASE DO SITE ####################
define('BASE', 'http://workshopnewborn:8888'); //Colocar sempre sem barra '/' no final
define('HOME', 'http://workshopnewborn:8888'); //Colocar sempre sem barra '/' no final

// DEFINE SERVIDOR DE E-MAIL PADRÃO ################
define('MAILUSER', 'contato@retratum.com');
define('MAILPASS', 'Yuo5sjG1@');
define('MAILPORT', '587');
define('MAILHOST', 'mail.retratum.com');

# NOMES PADRÕES SITE PRINCIPAL.
$site_name = 'Workshop New Born | Viviane Teodoro Fotografia';
$site_desc = 'Workshop New Born';
$site_keywords = 'Fotografia';

# SE NÃO ESTIVER SETADO OS NOMES, CARREGA OS PADRÕES.
$dados_cliente['user_fullname'] = (!isset($dados_cliente['user_fullname'])) ? 'Retratrum.com' : $dados_cliente['user_fullname'];
$site_name = (isset($user_sitename)) ? $user_sitename : $site_name;
$site_desc = (isset($user_sitedesc)) ? $user_sitedesc : $site_desc;
$site_keywords = (isset($user_keywords)) ? $user_keywords : $site_keywords;

// DEFINE IDENTIDADE DO SITE ################
define('SITENAME', $site_name);
define('SITEDESC', $site_desc);
define('KEYWORDS', $site_keywords);

// DEFINE THEME DA RETRATUM ##############
define('THEME', 'workshop');

// INCLUDES E REQUIRES DO SISTEMA ##############
define('INCLUDE_PATH', BASE . DIRECTORY_SEPARATOR . 'themes' . DIRECTORY_SEPARATOR . THEME);
define('REQUIRE_PATH', 'themes' . DIRECTORY_SEPARATOR . THEME);


// AUTO LOAD DE CLASSES ####################
function __autoload($Class) {

    $cDir = ['Conn', 'Helpers', 'Models'];
    $iDir = null;

    foreach ($cDir as $dirName):
        if (!$iDir && file_exists(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.class.php') && !is_dir(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.class.php')):
            include_once (__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.class.php');
            $iDir = true;
        endif;
    endforeach;

    if (!$iDir):
        trigger_error("Não foi possível incluir {$Class}.class.php", E_USER_ERROR);
        die;
    endif;
}

// TRATAMENTO DE ERROS #####################
//CSS constantes :: Mensagens de Erro
define('WS_ACCEPT', 'success');
define('WS_INFOR', 'info');
define('WS_ALERT', 'warning');
define('WS_ERROR', 'danger');

//WSErro :: Exibe erros lançados :: Front
function WSErro($ErrMsg, $ErrNo, $ErrDie = null) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
    echo "<div class=\"alert alert-{$CssClass}\">{$ErrMsg}
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
      <span aria-hidden=\"true\">&times;</span>
    </button>
    </div>";

    if ($ErrDie):
        die;
    endif;
}

//PHPErro :: personaliza o gatilho do PHP
function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">";
    echo "<b>Erro na Linha: #{$ErrLine} ::</b> {$ErrMsg}<br>";
    echo "<small>{$ErrFile}</small>";
    echo "<span class=\"ajax_close\"></span></p>";

    if ($ErrNo == E_USER_ERROR):
        die;
    endif;
}

set_error_handler('PHPErro');
date_default_timezone_set('America/Sao_Paulo');

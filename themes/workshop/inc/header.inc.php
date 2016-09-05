<?php header("Access-Control-Allow-Origin: *"); ?>

<?php #Get User config data.
$userdata = new Read;
$userdata->ExeRead("nit_site_config");

if ( $userdata->getResult() ):
    foreach ( $userdata->getResult() as $user_config ): 
        extract($user_config);
     endforeach; 
endif;
?>  

<?php 
# Se foi setado coloca o que foi setado, senão coloca o padrão da retratum. :D
$user_facebook = (!empty($user_facebook) ? $user_facebook : 'RetratumSites'); 
$user_instagram = (!empty($user_instagram) ? $user_instagram : 'muradosmann'); 
?>

<?php #Estou verificando se a página é portfolios e então mostra o Header adequado
$data = explode('/',$_SERVER['REQUEST_URI']);
if (!empty($data[1])) {
    $pagina = $data[1];
}?>
    
<header class="header">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?= HOME ?>">
                    <?php 
                        if(!empty($user_logo)):
                            echo '<img class="logo" src="'.BASE.'/uploads/'.$user_logo.'">';
                        else:
                            echo '<img class="logo" src="'.INCLUDE_PATH.'/img/logo-workshops.png">';
                        endif;
                     ?>
                </a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Menu Principal</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <?php if( isset($pagina) && ($pagina == 'portfolios' || $pagina == 'portfolio' || $pagina == 'posts' || $pagina == 'post')): ?>
                        <li><a href="<?= HOME ?>/portfolios/" class="page-scroll">Trabalhos</a></li>
                        <li><a href="<?= HOME ?>/posts/" class="page-scroll">Blog</a></li>
                        <li><a href="javascript:window.history.go(-1)">Voltar</a></li>
                        <li class="icons-menu"><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li class="icons-menu"><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li class="icons-menu"><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li class="icons-menu"><a href="#"><i class="fa fa-skype"></i></a></li>                        
                    <?php else: ?>
                        <li><a href="<?= HOME ?>">Home</a></li>
                        <li><a href="#sobre" class="page-scroll">Sobre</a></li>
                        <li><a href="#workshops" class="page-scroll">Workshops</a></li>
                        <li><a href="#lastjobs" class="page-scroll">Trabalhos</a></li>
                        <li><a href="#blog" class="page-scroll">Blog</a></li>
                        <li><a href="#contato" class="page-scroll">Contato</a></li>
                        <?php include('social-icons.inc.php'); ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>      
</header>













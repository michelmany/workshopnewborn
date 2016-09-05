<?php header("Access-Control-Allow-Origin: *"); ?>

<?php #Estou verificando se a página é portfolios e então mostra o Header adequado
$data = explode('/',$_SERVER['REQUEST_URI']);
if (!empty($data[1])) {
    $pagina = $data[1];
    echo $pagina;
}?>

<div class="loader"></div>

<header class="header">
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Menu Principal</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= HOME ?>"><img src="<?php echo INCLUDE_PATH; ?>/img/logo-light.png" class="img-responsive" alt="Logo"></a>
            </div>


            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <?php if( isset($pagina) && ($pagina == 'contrate')): ?>
                        <li><a href="<?= BASE ?>">Home</a></li>
                        <li><a href="#blog" class="page-scroll">Blog</a></li>
                        <li><a href="#duvidas" class="page-scroll">Dúvidas?</a></li>
                     <?php else: ?>
                        <li><a href="<?= BASE ?>">Home</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Conheça <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#features-section" class="page-scroll">Recursos do site</a></li>
                                <li><a href="#about-panel" class="page-scroll">Painel de gerenciamento</a></li>
                                <li><a href="#themes-section" class="page-scroll">Layouts (Temas) disponíveis </a></li>
                            </ul>
                        </li>
                        <li><a href="#prices-section" class="page-scroll">Planos</a></li>
                        <li><a href="#blog" class="page-scroll">Blog</a></li>
                        <li><a href="#duvidas" class="page-scroll">Dúvidas?</a></li>
                     <?php endif; ?>   
                </ul>
            </div>


        </div>
    </nav>      
</header>
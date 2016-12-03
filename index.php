<?php
ob_start();
require('_app/Config.inc.php'); 
$Session = new Session;
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
  
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->         

        <?php
        $Link = new Link;
        $Link->getTags();
        ?>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Architects+Daughter" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Varela" rel="stylesheet">
        <script src="https://use.fontawesome.com/0a4a5b9272.js"></script>
        <link rel="stylesheet" type="text/css" href="<?= INCLUDE_PATH; ?>/plugins/allcss.css">
        <link rel="stylesheet" type="text/css" href="<?= INCLUDE_PATH; ?>/css/main.css">
        <link rel="icon" href="<?= INCLUDE_PATH; ?>/favicon.ico" />

    </head>
    <body>

        <?php
        require(REQUIRE_PATH . '/inc/header.inc.php');

        if (!require($Link->getPatch())):
            WSErro('Erro ao incluir arquivo de navegação!', WS_ERROR, true);
        endif;

        require(REQUIRE_PATH . '/inc/footer.inc.php');
        ?>


    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    
    <script src="<?= INCLUDE_PATH; ?>/plugins/allplugins.min.js"></script>
    <script src="<?= INCLUDE_PATH; ?>/js/scripts.min.js"></script>

    </body>
</html>
<?php
ob_end_flush();
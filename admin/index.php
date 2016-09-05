<?php
ob_start();
session_start();
require('../_app/Config.inc.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="author" content="NITDESIGN Creative Studio" />
	<title><?php echo $site_name; ?> - Painel Admin</title>
	<link rel="stylesheet" href="assets/css/fonts/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/custom-bootstrap.css">
	<link rel="stylesheet" href="assets/css/xenon-core.css">
	<link rel="stylesheet" href="assets/css/xenon-components.css">
	<link rel="stylesheet" href="assets/css/custom.css">
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body class="page-body login-page login-light">
	<div class="login-container">
		<div class="row">
			<div class="col-sm-6">
				<?php # Faz a verificação do usuário e redireciona para o painel se acesso estiver ok -->
	                $login = new Login(2);
	                if ($login->CheckLogin()):
	                    header('Location: painel.php');
	                endif;
	                $dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	                if (!empty($dataLogin['AdminLogin'])):
	                    $login->ExeLogin($dataLogin);
	                    if (!$login->getResult()):
	                        WSErro($login->getError()[0], $login->getError()[1]);
	                    else:
	                        header('Location: painel.php');
	                    endif;
	                endif;
	                $get = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
	                if (!empty($get)):
	                    if ($get == 'restrito'):
	                        WSErro('<b>Oppsss:</b> Acesso negado. Favor efetue login para acessar o painel!', WS_ALERT);
	                    elseif ($get == 'logoff'):
	                        WSErro('<b>Sucesso ao deslogar:</b> Sua sessão foi finalizada. Volte sempre!', WS_ACCEPT);
	                    endif;
	                endif;
                ?>

				<!-- Add class "fade-in-effect" for login form effect -->
				<form method="post" action="" name="AdminLoginForm" role="form" id="login" class="login-form fade-in-effect">
	
					<div class="login-header">
						<a href="http://www.retratum.com" class="logo">
							<img src="assets/images/logo-retratum-login.png" alt=""/>

						</a>
	
						<p>Olá, faça o login para acessar o Painel Admin.</p>
					</div>
	
					<div class="form-group">
						<input type="email" class="form-control" name="user" id="user" autocomplete="off" placeholder="Email" />
					</div>
	
					<div class="form-group">
						<input type="password" class="form-control" name="pass" id="pass" autocomplete="off" placeholder="Senha" />
					</div>
	
					<div class="form-group">
						<input type="submit" name="AdminLogin" value="Entrar" class="btn btn-secondary btn-block btn-lg" />
					</div>
<!-- 	
					<div class="login-footer">
						<a href="#">Esqueceu sua senha?</a>
					</div>
	 -->
				</form>
	
			</div>
	
		</div>
		<div class="credits">
			<p class="container small"><?php echo date('Y'); ?> © <a href="http://www.nitdesign.com.br">NITDESIGN</a></p>
		</div>
	
	</div>
	<!-- Bottom Scripts -->
	<script src="../_cdn/js/jquery.min.js"></script>
	<script src="../_cdn/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/TweenMax.min.js"></script>
	<script src="assets/js/xenon-api.js"></script>
	<script src="../_cdn/js/jquery.validate.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>
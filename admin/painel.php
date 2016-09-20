<?php
#Mostra todos os erros do PHP
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

ob_start();
session_start();
require('../_app/Config.inc.php');

// VERIFICA SE USUÁRIO LOGADO TEM PERMISSÃO E SETA A VARIÁVEL NA SESSÃO DO USUÁRIO ####################
$login = new Login(2);
$logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);
$getexe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);

if (!$login->CheckLogin()):
    unset($_SESSION['userlogin']);
    header('Location: index.php?exe=restrito');
else:
    $userlogin = $_SESSION['userlogin']; // Posso usar $userlogin[] para pegar o id, nome etc.
	extract($userlogin);
endif;

if ($logoff):
    unset($_SESSION['userlogin']);
    header('Location: index.php?exe=logoff');
endif;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="FotoSites" />
	<meta name="robots" content="noindex, nofollow" />

	<title><?php echo $site_name; ?> | Painel de Gerenciamento de conteúdo</title>

	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Arimo:400,700,400italic">
	<link rel="stylesheet" href="assets/css/fonts/linecons/css/linecons.css">
	<link rel="stylesheet" href="assets/css/fonts/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/custom-bootstrap.css">
	<link rel="stylesheet" href="assets/css/xenon-core.css">
	<link rel="stylesheet" href="assets/css/xenon-forms.css">
	<link rel="stylesheet" href="assets/css/xenon-components.css">
	<link rel="stylesheet" href="assets/css/xenon-skins.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/ihover.min.css">
	<link rel="stylesheet" href="assets/css/custom.css">
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<script src="../_cdn/js/jquery.min.js"></script>

</head>
<body class="page-body skin-navy">
	<div class="settings-pane">			
		<a href="#" data-toggle="settings-pane" data-animate="true">&times;</a>		
		<div class="settings-pane-inner">			
			<div class="row">				
				<div class="col-md-4">					
					<div class="user-info">						
						<div class="user-image">
							<a href="extra-profile.html">
								<img src="assets/images/user-2.png" class="img-responsive img-circle" />
							</a>
						</div>			
						
						<div class="user-details">							
							<h3>
								<a href="extra-profile.html"><?= $userlogin['user_fullname']; ?></a>
							</h3>

							<p class="user-title">Cliente desde <?= date('m/Y', strtotime($userlogin['user_registration'])); ?></p>

							<p class="user-title"><?= Check::dataFimPlano($userlogin['user_datafim']); ?></p>
							

							<div class="user-links">
								<a href="painel.php?exe=account/index" class="btn btn-info">Minha Conta</a>
							</div>			
							
						</div>
						
					</div>
					
				</div>
				
				<div class="col-md-8 link-blocks-env">
					
<!-- 					<div class="links-block left-sep">
						<h4>
							<span>Notifications</span>
						</h4>
						
						<ul class="list-unstyled">
							<li>
								<input type="checkbox" class="cbr cbr-primary" checked="checked" id="sp-chk1" />
								<label for="sp-chk1">Messages</label>
							</li>
							<li>
								<input type="checkbox" class="cbr cbr-primary" checked="checked" id="sp-chk2" />
								<label for="sp-chk2">Events</label>
							</li>
							<li>
								<input type="checkbox" class="cbr cbr-primary" checked="checked" id="sp-chk3" />
								<label for="sp-chk3">Updates</label>
							</li>
							<li>
								<input type="checkbox" class="cbr cbr-primary" checked="checked" id="sp-chk4" />
								<label for="sp-chk4">Server Uptime</label>
							</li>
						</ul>
					</div> -->
					
					<div class="links-block left-sep">
						<h4>
							<a href="#">
								<span>Help Desk</span>
							</a>
						</h4>
						
						<ul class="list-unstyled">
							<li>
								<a href="#">
									<i class="fa-angle-right"></i>
									Suporte via Chat
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fa-angle-right"></i>
									Ticket de Suporte
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fa-angle-right"></i>
									Termos de Serviços
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fa-angle-right"></i>
									Condições de uso
								</a>
							</li>							
						</ul>
					</div>
					
				</div>
				
			</div>
		
		</div>
		
	</div>
	
	<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
			
		<!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
		<!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
		<!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
		<div class="sidebar-menu toggle-others fixed">
		
			<div class="sidebar-menu-inner">
				
				<header class="logo-env">
		
					<!-- logo -->
					<div class="logo">
						<a href="painel.php?exe=dashboard/index" class="logo-expanded">
							<img src="assets/images/logo@2x.png" width="162" alt="" />
						</a>
		
						<a href="painel.php?exe=dashboard/index" class="logo-collapsed">
							<img src="assets/images/logo-collapsed@2x.png" width="40" alt="" />
						</a>
					</div>
		
					<!-- This will toggle the mobile menu and will be visible only on mobile devices -->
					<div class="mobile-menu-toggle visible-xs">
						<a href="#" data-toggle="user-info-menu">
							<i class="fa-bell-o"></i>
							<span class="badge badge-success">7</span>
						</a>
		
						<a href="#" data-toggle="mobile-menu">
							<i class="fa-bars"></i>
						</a>
					</div>
		
					<!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->
<!-- 					<div class="settings-icon">
						<a href="#" data-toggle="settings-pane" data-animate="true">
							<i class="linecons-cog"></i>
						</a>
					</div> -->
		
					
				</header>
					
						
                <?php
                    //ATIVA MENU
                    if (isset($getexe)):
                        $linkto = explode('/', $getexe);
                    else:
                        $linkto = array();
                    endif;
                ?>

				<ul id="main-menu" class="main-menu">

					<!-- add class "multiple-expanded" to allow multiple submenus to open -->
					<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
					<li class="<?php if (in_array('dashboard', $linkto)) echo 'active'; ?>">
						<a href="painel.php?exe=dashboard/index">
							<i class="linecons-desktop"></i>
							<span class="title">Painel</span>
						</a>
					</li>
					<li class="<?php if (in_array('slider', $linkto)) echo 'active'; ?>">
						<a href="painel.php?exe=slider/index">
							<i class="linecons-note"></i>
							<span class="title">Slider</span>
						</a>
					</li>				
					<?php 
					/* BLOG POSTS QUANDO NECESSARIO.
					<li class="<?php if (in_array('posts', $linkto)) echo 'active opened'; ?> auto-inherit-active-class">
						<a href="">
							<i class="fa-folder-open-o"></i>
							<span class="title">Posts (BLOG)</span>
						</a>
						<ul>
							<li>
								<a href="painel.php?exe=posts/categorias">
									<span class="title">Categorias</span>
								</a>
							</li>
							<li>
								<a href="painel.php?exe=posts/create">
									<span class="title">Criar postagem</span>
								</a>
							</li>
							<li>
								<a href="painel.php?exe=posts/index">
									<span class="title">Listar postagens</span>
								</a>
							</li>
						</ul>
					</li> 
					*/ ?>
					<li class="<?php if (in_array('workshops', $linkto)) echo 'active opened'; ?> auto-inherit-active-class">
						<a href="">
							<i class="fa-folder-open-o"></i>
							<span class="title">Cursos</span>
						</a>
						<ul>
							<li>
								<a href="painel.php?exe=workshops/create">
									<span class="title">Cadastrar Workshop</span>
								</a>
							</li>
							<li>
								<a href="painel.php?exe=workshops/index">
									<span class="title">Listar Cursos</span>
								</a>
							</li>
							<li>
								<a href="painel.php?exe=workshops/inscritos">
									<span class="title">Inscrições</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="<?php if (in_array('albuns', $linkto)) echo 'active opened'; ?> auto-inherit-active-class">
						<a href="">
							<i class="fa-folder-open-o"></i>
							<span class="title">Galeria</span>
						</a>
						<ul>
							<li>
								<a href="painel.php?exe=albuns/categorias">
									<span class="title">Categorias</span>
								</a>
							</li>
							<li>
								<a href="painel.php?exe=albuns/create">
									<span class="title">Adicionar galeria</span>
								</a>
							</li>
							<li>
								<a href="painel.php?exe=albuns/index">
									<span class="title">Listar galerias</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="<?php if (in_array('videos', $linkto)) echo 'active'; ?>">
						<a href="painel.php?exe=videos/index">
							<i class="linecons-note"></i>
							<span class="title">Videos</span>
						</a>
					</li>									
					<li class="<?php if (in_array('depoimentos', $linkto)) echo ' active'; ?>">
						<a href="painel.php?exe=depoimentos/index">
							<i class="linecons-comment"></i>
							<span class="title">Depoimentos</span>
						</a>
					</li>
					<li class="<?php if (in_array('parceiros', $linkto)) echo 'active'; ?>">
						<a href="painel.php?exe=parceiros/index">
							<i class="linecons-note"></i>
							<span class="title">Parceiros</span>
						</a>
					</li>						
					<li>
						<a href="painel.php?exe=config/index">
							<i class="linecons-params"></i>
							<span class="title">Configurações</span>
						</a>
					</li>

				<?php #verifica se existe o arquivo theme-options-menu.php e inclui
				$themeCliente = Check::ThemeById($userlogin['theme_id']);
				if ( file_exists('../themes/'. $themeCliente .'/theme-options-menu.php') ): 
					 include('../themes/'. $themeCliente .'/theme-options-menu.php');			
				endif ?>
					
				</ul>
				
			</div>
		
		</div>
	
		<div class="main-content">
					
			<nav class="navbar user-info-navbar"  role="navigation"><!-- User Info, Notifications and Menu Bar -->
			
				<!-- Left links for user info navbar -->
				<ul class="user-info-menu left-links list-inline list-unstyled">
			
					<li class="hidden-sm hidden-xs">
						<a href="#" data-toggle="sidebar">
							<i class="fa-bars"></i>
						</a>
					</li>

				</ul>
			
			
				<!-- Right links for user info navbar -->
				<ul class="user-info-menu right-links list-inline list-unstyled">

			
					<li class="dropdown user-profile">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="assets/images/user-4.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
							<span>
								<?= $userlogin['user_fullname']; ?>
								<i class="fa-angle-down"></i>
							</span>
						</a>
			

			<?php // VERIFICA SE TEM DOMÍNIO, SE NÃO TIVER TRAZ O SUBDOMINIO DO CLIENTE. 
				$SiteCliente = (isset($userlogin['user_domain']) && !empty($userlogin['user_domain'])) ? $userlogin['user_domain'] : $userlogin['user_username'].'.'.$_SERVER['SERVER_NAME'];
			 ?>



						<ul class="dropdown-menu user-profile-menu list-unstyled">
							<li>
								<a href="http://<?php echo $SiteCliente ?>" target="_blank">
									<i class="fa-eye"></i>
									Ver site
								</a>
							</li>
							<li>
								<a href="painel.php?exe=account/index">
									<i class="fa-user"></i>
									Minha conta
								</a>
							</li>
							<li class="last">
								<a href="painel.php?logoff=true">
									<i class="fa-lock"></i>
									Sair
								</a>
							</li>
						</ul>
					</li>
				
				</ul>
			
			</nav>

			<div class="painel">
	
	            <?php
	            //QUERY STRING
	            if (!empty($getexe)):
	                $includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . strip_tags(trim($getexe) . '.php');
	            else:
	                $includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . 'dashboard/index.php';
	            endif;

	            if (file_exists($includepatch)):
	                require_once($includepatch);
	            else:
	                WSErro("<b>Erro ao incluir tela:</b> Erro ao incluir o controller /{$getexe}.php!", WS_ERROR);
	            endif;
	            ?>			

			</div>

			<footer class="main-footer sticky footer-type-1">				
				<div class="footer-inner">
				
					<!-- Add your copyright text here -->
					<div class="footer-text">
						 <?php echo date('Y'); ?> &copy; <a href="http://nitdesign.com.br" target="_blank"><strong>NITDESIGN</strong></a>
					</div>
					
					<!-- Go to Top Link, just add rel="go-top" to any link to add this functionality -->
					<div class="go-up">
						<a href="#" rel="go-top">
							<i class="fa-angle-up"></i>
						</a>
					</div>
					
				</div>				
			</footer>

		</div>
				

	</div>

	
	
	<!-- Imported styles on this page -->
	<link rel="stylesheet" href="assets/css/fonts/meteocons/css/meteocons.css">
	<link rel="stylesheet" href="assets/js/cropper/cropper.min.css">
	<link rel="stylesheet" href="assets/js/datatables/dataTables.bootstrap.css">
	
	<!-- Bottom Scripts -->
	<script src="../_cdn/js/jquery-ui.min.js"></script>	
	<script src="../_cdn/js/jquery.validate.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/TweenMax.min.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/xenon-api.js"></script>
	<script src="assets/js/xenon-toggles.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
	<script src="assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
	<script src="assets/js/datepicker/bootstrap-datepicker.js"></script>
	<script src="assets/js/datepicker/bootstrap-datepicker.pt-BR.js"></script>

	<script src="assets/js/ckeditor/ckeditor.js"></script>
	<script src="assets/js/ckeditor/adapters/jquery.js"></script>


	<!-- Imported scripts on this page -->
	<script src="assets/js/xenon-widgets.js"></script>
	<script src="assets/js/cropper/cropper.min.js"></script>
	<script src="assets/js/datatables/js/jquery.dataTables.min.js"></script>
	<script src="assets/js/toastr/toastr.min.js"></script>
	<script src="assets/js/datatables/dataTables.bootstrap.js"></script>


	<!-- Carrega o modal para todas as páginas -->
	<?php require_once('data/modal.php'); ?>


	<!-- JavaScripts initializations and stuff -->
	<script src="assets/js/custom.js"></script>






</body>
</html>

<?php
ob_end_flush();

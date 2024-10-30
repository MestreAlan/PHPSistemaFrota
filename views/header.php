<!DOCTYPE html>
<?php 
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<html lang="pt-br">
	<head>
		<title>EGrupoRadar</title>
		<meta charset="utf-8">
		<meta name="EGrupoRadar" content="Plataforma diggital do Grupo Radar">
		<link rel="shortcut icon" href="img/favicon.png" sizes="32x32" type="image/png">
		<link rel="stylesheet" href="frameworks/fontawesome-free-5.15.4-web/css/all.css" >	
		
		<!--svg.filter svg.draggable-->
        <link href="css/geral/app.min.css" rel="stylesheet" type="text/css" id="app-style">

		<!--Framework fileinput início-->
		<link href="frameworks/kartik-v-bootstrap-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
		<link href="frameworks/kartik-v-bootstrap-fileinput/themes/explorer-fas/theme.css" media="all" rel="stylesheet" type="text/css"/>
		<!--Framework fileinput início-->
		<!--styles de fremeworks-->
		<link rel="stylesheet" href="frameworks/bootstrap-5.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="frameworks/bootstrap-toggle/css/bootstrap-toggle.min.css">
		<link rel="stylesheet" href="frameworks/font-awesome-4.7.0/css/font-awesome.min.css">

		<!--handsontable-->
		<link rel="stylesheet" href="frameworks/handsontable/handsontable.full.css">
		<!--<link rel="stylesheet" href="frameworks/handsontable/handsontable.css.map">-->
		<!--<link rel="stylesheet" href="frameworks/handsontable/handsontable.js.map">-->
		<!--<link rel="stylesheet" href="frameworks/handsontable/pikaday/pikaday.css">-->
		<!--<link rel="stylesheet" href="frameworks/handsontable/dompurify/purify.js.map">-->
		
		<script src="frameworks/apexcharts-bundle/dist/apexcharts.min.js"></script>
		
		<!--Próprios-->
		<link rel="stylesheet" href="css/variaveis.css">
		
		<?php
			$pagina;
			
			date_default_timezone_set('America/Sao_Paulo');
			
			if(isset($_SESSION['page'])){
				$pagina = $_SESSION['page'];
			}	

			/* Carrega a página escolhida pelo usuário */
			switch ($pagina) {
				case 'login':
					echo '<link rel="stylesheet" href="css/login.css"><!--Usada no login-->';
					echo '<link rel="stylesheet" href="css/acessStyle.css"><!--Usada quando logado-->';
					break;
				
				case 'hall':
					//echo '<link rel="stylesheet" href="css/hall.css"><!--Usada no hall-->';
					break;
					
				case 'listarColaboradoresGeral':
					echo '<link rel="stylesheet" href="frameworks/pagination-sort-filter-manager/tableManager.css"><!--Usada na visualização de planejamentos-->';
					echo '<link rel="stylesheet" href="frameworks/tableV4/main.css"><!--Usada na visualização de planejamentos-->';
					break;	
				
				case 'listarColaboradoresAtivos':
					echo '<link rel="stylesheet" href="frameworks/pagination-sort-filter-manager/tableManager.css"><!--Usada na visualização de planejamentos-->';
					echo '<link rel="stylesheet" href="frameworks/tableV4/main.css"><!--Usada na visualização de planejamentos-->';
					
					break;	
					
				case 'listarColaboradoresDesativos':
					echo '<link rel="stylesheet" href="frameworks/pagination-sort-filter-manager/tableManager.css"><!--Usada na visualização de planejamentos-->';
					echo '<link rel="stylesheet" href="frameworks/tableV4/main.css"><!--Usada na visualização de planejamentos-->';
					
					break;	
				
				case 'visualizadorColaboradorEspecifico':
                    echo '<link rel="stylesheet" href="css/cadastroModal.css"><!--Usada na visualização do colaborador-->';
					echo '<link rel="stylesheet" href="css/ajustarTabelas.css"><!--Usada na visualização do colaborador-->';
					echo '<link rel="stylesheet" href="css/tabStyle.css"><!--Usada na visualização do colaborador-->';
					break;	
				
				case 'listarClientesGeral':
					echo '<link rel="stylesheet" href="frameworks/pagination-sort-filter-manager/tableManager.css"><!--Usada na visualização de planejamentos-->';
					echo '<link rel="stylesheet" href="frameworks/tableV4/main.css"><!--Usada na visualização de planejamentos-->';
					break;
					
				case 'visualizadorClienteEspecifico':
					echo '<link rel="stylesheet" href="css/ajustarTabelas.css"><!--Usada na visualização do colaborador-->';
					break;	
				
				case 'monitoramentoFrota':
					echo '<link rel="stylesheet" href="css/ajustarTabelaFiltrada.css"><!--Usada na visualização de monotoramento de frota-->';
					break;	
					
				case 'manipularFrota':
					echo '<link rel="stylesheet" href="frameworks/pagination-sort-filter-manager/tableManager.css"><!--Usada na visualização de planejamentos-->';
					echo '<link rel="stylesheet" href="frameworks/tableV4/main.css"><!--Usada na visualização de planejamentos-->';
					
					break;	
					
				case 'visualizadorFrotaEspecifica':
					echo '<link rel="stylesheet" href="css/ajustarTabelas.css"><!--Usada na visualização do colaborador-->';
					break;
				
				case 'listarOrdensServicos':
					echo '<link rel="stylesheet" href="css/planejamentoOS.css"><!--Usada na visualização de planejamentoOS e listarOrdensServicos-->';
					break;	
				
				case 'criarPlanejamentoOS':
					echo '<link rel="stylesheet" href="css/planejamentoOS.css"><!--Usada na visualização de planejamentoOS e listarOrdensServicos-->';
					break;	
				
				case 'acessarMonitorarExecucoesOperacoes':
					echo '<link rel="stylesheet" href="css/ajustarTabelaFiltrada.css"><!--Usada na visualização de planejamentos-->';
					break;	
				
				case 'gerenciarLocalizacoes':
					echo '<link rel="stylesheet" href="frameworks/pagination-sort-filter-manager/tableManager.css"><!--Usada na visualização de planejamentos-->';
					echo '<link rel="stylesheet" href="frameworks/tableV4/main.css"><!--Usada na visualização de planejamentos-->';

					echo '<link rel="stylesheet" href="css/ajustarTabelasLocalizacao.css"><!--Usada na visualização do colaborador-->';
					break;	
				
				case 'precificarRota':
					echo '<link rel="stylesheet" href="css/planejamentoOS.css"><!--Usada na visualização de planejamentoOS e listarOrdensServicos-->';
					break;	
				
				case 'criarNota':
					echo '<link rel="stylesheet" href="css/planejamentoOS.css"><!--Usada na visualização de planejamentoOS e listarOrdensServicos-->'
					;
					break;		
				
				case 'visualizadorDashboard':
					echo '<link rel="stylesheet" href="frameworks/apexcharts-bundle/dist/apexcharts.min.css"><!--Usada na visualização do colaborador-->';
					break;
				
				default:
					
					break;
			}
			if(isset($_SESSION['logado'])){
				//echo '<link rel="stylesheet" href="css/menuLateral.css"><!--Usada quando logado-->';
				echo '<link rel="stylesheet" href="css/modalSpinner.css"><!--Usada na visualização de planejamentos-->';
			}
		?>

		<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
		<!-- Include Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- Style -->
		<style type="text/css">
			
		</style>




	</head>
	
	
	<body class="show" data-layout-color="light" data-layout-mode="fluid" data-rightbar-onstart="true" data-leftbar-theme="dark" data-new-gr-c-s-check-loaded="14.1063.0" data-gr-ext-installed="">
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            <div class="leftside-menu menuitem-active">
    
                <!-- LOGO -->
                <a id="logo" href="#" class="logo text-center logo-light">
                    <span class="logo-lg">
                        <img src="img/logo.png" alt="" height="16">
                    </span>
                    <span class="logo-sm">
                        <img src="img/logo_sm.png" alt="" height="16">
                    </span>
                </a>

                <!-- LOGO -->
                <a id="logo" href="#" class="logo text-center logo-dark">
                    <span class="logo-lg">
                        <img src="img/logo-dark.png" alt="" height="16">
                    </span>
                    <span class="logo-sm">
                        <img src="img/logo_sm_dark.png" alt="" height="16">
                    </span>
                </a>
    
                <div class="h-100 show" id="leftside-menu-container" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">

                <?php include 'views/sideMenu.php';    ?>

                </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 1668px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 234px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    <div class="navbar-custom">
                        <ul class="list-unstyled topbar-menu float-end mb-0">
                            
                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="https://coderthemes.com/hyper/saas/index.html#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="fas fa-bell noti-icon"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg">

                                    <!-- item-->
                                    <div class="dropdown-item noti-title px-3">
                                        <h5 class="m-0">
                                            <span class="float-end">
                                                <a href="javascript: void(0);" class="text-dark">
                                                    <small>Limpar</small>
                                                </a>
                                            </span>Notificações
                                        </h5>
                                    </div>

                                    <div class="px-3" style="max-height: 300px;" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px -24px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden;"><div class="simplebar-content" style="padding: 0px 24px;">

                                        <h5 class="text-muted font-13 fw-normal mt-0">Today</h5>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-2">
                                            <div class="card-body">
                                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>   
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="notify-icon bg-primary">
                                                            <i class="mdi mdi-comment-account-outline"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 text-truncate ms-2">
                                                        <h5 class="noti-item-title fw-semibold font-14">Datacorp <small class="fw-normal text-muted ms-1">1 min ago</small></h5>
                                                        <small class="noti-item-subtitle text-muted">Caleb Flakelar commented on Admin</small>
                                                    </div>
                                                  </div>
                                            </div>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-2">
                                            <div class="card-body">
                                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>   
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="notify-icon bg-info">
                                                            <i class="mdi mdi-account-plus"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 text-truncate ms-2">
                                                        <h5 class="noti-item-title fw-semibold font-14">Admin <small class="fw-normal text-muted ms-1">1 hours ago</small></h5>
                                                        <small class="noti-item-subtitle text-muted">New user registered</small>
                                                    </div>
                                                  </div>
                                            </div>
                                        </a>

                                        <h5 class="text-muted font-13 fw-normal mt-0">Yesterday</h5>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-2">
                                            <div class="card-body">
                                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>   
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="notify-icon">
                                                            <img src="Dashboard _ Hyper - Responsive Bootstrap 5 Admin Dashboard_files/avatar-1.jpg" class="img-fluid rounded-circle" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 text-truncate ms-2">
                                                        <h5 class="noti-item-title fw-semibold font-14">Cristina Pride <small class="fw-normal text-muted ms-1">1 day ago</small></h5>
                                                        <small class="noti-item-subtitle text-muted">Hi, How are you? What about our next meeting</small>
                                                    </div>
                                                  </div>
                                            </div>
                                        </a>

                                        <h5 class="text-muted font-13 fw-normal mt-0">30 Dec 2021</h5>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-2">
                                            <div class="card-body">
                                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>   
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="notify-icon bg-primary">
                                                            <i class="mdi mdi-comment-account-outline"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 text-truncate ms-2">
                                                        <h5 class="noti-item-title fw-semibold font-14">Datacorp</h5>
                                                        <small class="noti-item-subtitle text-muted">Caleb Flakelar commented on Admin</small>
                                                    </div>
                                                  </div>
                                            </div>
                                        </a>

                                         <!-- item-->
                                         <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-2">
                                            <div class="card-body">
                                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>   
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="notify-icon">
                                                            <img src="./Dashboard _ Hyper - Responsive Bootstrap 5 Admin Dashboard_files/avatar-1.jpg" class="img-fluid rounded-circle" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 text-truncate ms-2">
                                                        <h5 class="noti-item-title fw-semibold font-14">Karen Robinson</h5>
                                                        <small class="noti-item-subtitle text-muted">Wow ! this admin looks good and awesome design</small>
                                                    </div>
                                                  </div>
                                            </div>
                                        </a>

                                        <div class="text-center">
                                            <i class="mdi mdi-dots-circle mdi-spin text-muted h3 mt-0"></i>
                                        </div>
                                    </div></div></div></div><div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar" style="height: 0px; display: none;"></div></div></div>

                                    <!-- All-->
                                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                                        Ver todas
                                    </a>

                                </div>
                            </li>

                            <li class="dropdown notification-list d-none d-sm-inline-block">
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="https://coderthemes.com/hyper/saas/index.html#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="fa fa-hashtag noti-icon"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg p-0">

                                    <div class="p-2">
                                        <div class="row g-0">
                                            <div class="col">
                                                <a class="dropdown-icon-item" href="#">
                                                    <img src="./Dashboard _ Hyper - Responsive Bootstrap 5 Admin Dashboard_files/insta.png" alt="slack">
                                                    <span>Istagram</span>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a class="dropdown-icon-item" href="#">
                                                    <img src="./Dashboard _ Hyper - Responsive Bootstrap 5 Admin Dashboard_files/face.png" alt="slack">
                                                    <span>Facebook</span>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a class="dropdown-icon-item" href="#">
                                                    <img src="./Dashboard _ Hyper - Responsive Bootstrap 5 Admin Dashboard_files/what.png" alt="slack">
                                                    <span>Whatsapp</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </li>

                            <li class="notification-list">
                                <a class="nav-link end-bar-toggle" href="javascript: void(0);">
                                    <i class="fa fa-gear noti-icon"></i>
                                </a>
                            </li>

                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="https://coderthemes.com/hyper/saas/index.html#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <span class="account-user-avatar"> 
                                        <img src="./Dashboard _ Hyper - Responsive Bootstrap 5 Admin Dashboard_files/avatar-1.jpg" alt="user-image" class="rounded-circle">
                                    </span>
                                    <span>
                                        <span class="account-user-name">Administrador</span>
                                        <span class="account-position">Administrador</span>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-circle me-1"></i>
                                        <span>Minha conta</span>
                                    </a>
									
                                    <!-- item-->
                                    <a href="javascript:void(0);" id="logoutButton" class="dropdown-item notify-item">
                                        <i class="mdi mdi-logout me-1"></i>
                                        <span>Sair</span>
                                    </a>
                                </div>
                            </li>

                        </ul>
                        <button class="button-menu-mobile open-left">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="app-search dropdown d-none d-lg-block">

                            <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h5 class="text-overflow mb-2">Found <span class="text-danger">17</span> results</h5>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="uil-notes font-16 me-1"></i>
                                    <span>Analytics Report</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="uil-life-ring font-16 me-1"></i>
                                    <span>How can I help you?</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="uil-cog font-16 me-1"></i>
                                    <span>User profile settings</span>
                                </a>

                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
                                </div>

                                <div class="notification-list">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="d-flex">
                                            <img class="d-flex me-2 rounded-circle" src="./Dashboard _ Hyper - Responsive Bootstrap 5 Admin Dashboard_files/avatar-1.jpg" alt="Generic placeholder image" height="32">
                                            <div class="w-100">
                                                <h5 class="m-0 font-14">Erwin Brown</h5>
                                                <span class="font-12 mb-0">UI Designer</span>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="d-flex">
                                            <img class="d-flex me-2 rounded-circle" src="./Dashboard _ Hyper - Responsive Bootstrap 5 Admin Dashboard_files/avatar-1.jpg" alt="Generic placeholder image" height="32">
                                            <div class="w-100">
                                                <h5 class="m-0 font-14">Jacob Deo</h5>
                                                <span class="font-12 mb-0">Developer</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end Topbar -->
                    
                    <!-- Start Content-->
                    <div class="px-3 py-2 border-bottom mb-3"></div>
                    <!-- container -->

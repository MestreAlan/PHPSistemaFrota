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
		

		<!--styles de próprios-->
		<link href="css/header.css" rel="stylesheet">
		<link rel="stylesheet" href="css/resetContainer.css">
		
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
					echo '<link rel="stylesheet" href="css/hall.css"><!--Usada no hall-->';
					break;
					
				case 'listarColaboradoresGeral':
					echo '<link rel="stylesheet" href="css/ajustarInputsFichaGeral.css"><!--Usada na visualização do colaborador-->';
					break;	
				
				case 'visualizadorColaboradorEspecifico':
					echo '<link rel="stylesheet" href="css/ajustarInputsFichaColaborador.css"><!--Usada na visualização do colaborador-->';
					break;	
				
				case 'listarColaboradoresAtivos':
					echo '<link rel="stylesheet" href="css/ajustarInputsFichaGeral.css"><!--Usada na visualização do colaborador-->';
					break;	
					
				case 'listarColaboradoresDesativos':
					echo '<link rel="stylesheet" href="css/ajustarInputsFichaGeral.css"><!--Usada na visualização do colaborador-->';
					break;	
				
				case 'listarClientesGeral':
					echo '<link rel="stylesheet" href="css/ajustarInputsFichaGeral.css"><!--Usada na visualização do colaborador-->';
					break;
					
				case 'visualizadorClienteEspecifico':
					echo '<link rel="stylesheet" href="css/ajustarInputsFichaColaborador.css"><!--Usada na visualização do colaborador-->';
					break;	
				
				case 'monitoramentoFrota':
					echo '<link rel="stylesheet" href="css/ajustarTabelaFiltrada.css"><!--Usada na visualização de monotoramento de frota-->';
					break;	
					
				case 'manipularFrota':
					echo '<link rel="stylesheet" href="css/ajustarInputsFichaGeral.css"><!--Usada na visualização do colaborador-->';
					break;	
					
				case 'visualizadorFrotaEspecifica':
					echo '<link rel="stylesheet" href="css/ajustarInputsFichaColaborador.css"><!--Usada na visualização do colaborador-->';
					break;
				
				case 'listarOrdensServicos':
					//echo '<link rel="stylesheet" href="css/ajustarTabelaFiltrada.css"><!--Usada na visualização de planejamentos-->';
					break;	
				
				case 'criarPlanejamentoOS':
					echo '<link rel="stylesheet" href="css/filterDrop.css"><!--Usada na visualização de planejamentos-->';
					echo '<link rel="stylesheet" href="css/ajustarTabelaFiltrada.css"><!--Usada na visualização de planejamentos-->';
					break;	
				
				case 'acessarMonitorarExecucoesOperacoes':
					echo '<link rel="stylesheet" href="css/ajustarTabelaFiltrada.css"><!--Usada na visualização de planejamentos-->';
					break;	
				
				case 'gerenciarLocalizacoes':
					echo '<link rel="stylesheet" href="css/gerenciarLocalizacoes.css"><!--Usada em -->';
					echo '<link rel="stylesheet" href="css/ajustarTabelaFiltrada2.css"><!--Usada na visualização de planejamentos-->';
					break;	
				
				case 'precificarRota':
					echo '<link rel="stylesheet" href="css/ajustarTabelaFiltrada.css"><!--Usada na visualização de planejamentos-->';
					break;	
				
				case 'criarNota':
					echo '<link rel="stylesheet" href="css/filterDrop.css"><!--Usada na visualização de planejamentos-->';
					echo '<link rel="stylesheet" href="css/ajustarTabelaFiltrada.css"><!--Usada na visualização de planejamentos-->';
					break;		
				
				case 'acessarLocalizacaoVeiculos':
					echo '<link rel="stylesheet" href="css/ajustarInputsFichaColaborador.css"><!--Usada na visualização do colaborador-->';
					break;
				
				default:
					
					break;
			}
			if(isset($_SESSION['logado'])){
				echo '<link rel="stylesheet" href="css/menuLateral.css"><!--Usada quando logado-->';
				echo '<link rel="stylesheet" href="css/modalSpinner.css"><!--Usada na visualização de planejamentos-->';
			}
		?>

	</head>
	
	<body class="blackPiano">
		
		<header class="px-3 py-2 bg-light text-white">
			<div class="container">
				<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
					<a href="#" id="logo" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
						<div id="logo">
							<img src="img/radarlog.png">
						</div>
					</a>
					<div class="switch__container">
						<span id="styleText">Estilo</span>
						<input id="switch-shadow" class="switch switch--shadow" type="checkbox">
						<label for="switch-shadow"></label>
					</div>
					<?php 
						if(isset($_SESSION['logado'])){
							echo 
								'<div class="text-end" id="access">
								<button type="button" class="btn btn-primary" id="logoutButton">Sair</button>
								</div>';
						}else{
							echo 
								'<div class="text-end" id="access">
								<button type="button" class="btn btn-light me-2" data-toggle=".login-form">Entrar</button>
								<button type="button" class="btn btn-primary" data-toggle=".register-form">Cadastrar</button>
								</div>';
						}
					?>
				</div>
			</div>
		</header>
		
		<div class="px-3 py-2 border-bottom mb-3"></div>
		
		<?php
			// session_start inicia a sessão
			if(!isset($_SESSION)) 
			{ 
				session_start(); 
			} 
			
			$_SESSION['logado'] = 0;
			
			$_SESSION['validadorHash'] = (!isset($_SESSION['validadorHash'])) ? hash('sha512',rand(1000, 10000)) : $_SESSION['validadorHash'];
		?>
		
		<div id="login">
			<div class="login-page">
				<div class="form">
					<form class="register-form">
						<div class="inputbox">
							<input id="user_login_registro" value="" onchange="this.setAttribute('value', this.value);"  type="text" required pattern="[a-z]{1,1}[^\sA-Z]{2,14}" />
							<span>Usuario</span>
						</div>
						<div class="inputbox">
							<input id="insert_email" value="" onchange="this.setAttribute('value', this.value);"  type="text" required pattern="[^@\sA-Z]+@[^@\sA-Z]+\.[^@\sA-Z]{1,}[^@A-Z]"/>
							<span>E-mail</span>
						</div>
						<div class="inputbox">
							<input id="codigo_liberacao" value="" onchange="this.setAttribute('value', this.value);"  type="text" required pattern="[0-9]{5}"/>
							<span>Código de liberação</span>
						</div>
						<div class="input_senha inputbox">
							<input type="password" id="password_registro" value="" onchange="this.setAttribute('value', this.value);"  class="hide-password"  minlength="3" maxlength="15" required pattern="[a-zA-Z0-9~!@#$%^&*_+=?><\-]{0,15}" title="Lista de caracteres especiais liberados (~!@#$%^&*_+=?><-) "/>
							<i id="fa-eye1" class="fa fa-eye fa-2x"></i>
							<span>Senha</span>
							<div id="password-strength-status"></div>
						</div>
						<div class="input_senha inputbox">
							<input type="password" id="password_registro_validacao" value="" onchange="this.setAttribute('value', this.value);"  class="hide-password"  minlength="3" maxlength="15" required pattern="[a-zA-Z0-9~!@#$%^&*_+=?><\-]{0,15}" title="Lista de caracteres especiais liberados (~!@#$%^&*_+=?><-) "/>
							<span>Repetir Senha</span>
							<i id="fa-eye3" class="fa fa-eye fa-2x"></i>
						</div>
						<input type="hidden" id="registroValidacaoCode" name="registroValidacaoCode" value="<?php echo $_SESSION['validadorHash']; ?>" />
						<button type="submit">registrar</button>
					</form>
					<form class="login-form" method="post" action="php/controllerLogin.php" id="formlogin" name="formlogin">
						<div class="inputbox">
							<input type="text" onchange="this.setAttribute('value', this.value);" value="" onchange="this.setAttribute('value', this.value);"  required minlength="3" id="user_login" name="user"/>
							<span>Usuário</span>
						</div>
						<div class="input_senha inputbox">
							<input type="password" id="password_login" class="hide-password"  value="" onchange="this.setAttribute('value', this.value);"  required minlength="1" name="password_login"/>
							<span>Senha</span>
							<i id="fa-eye2" class="fa fa-eye fa-2x"></i>
						</div>
						<input type="hidden" id="loginValidacaoCode" name="loginValidacaoCode" value="<?php echo $_SESSION['validadorHash']; ?>" />
						<button type="submit">entrar</button>
						<p class="message">Esqueceu a senha? <a href="#" data-toggle=".recuperar-form">Recuperar</a></p>
					</form>
					<form class="recuperar-form">
						<div class="inputbox">
							<input id="cpf_recuperar_cadastro" for="cpf" class="cpf" type="text" name="cpfRecover" value="" onchange="this.setAttribute('value', this.value);"  required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" >
							<span>CPF</span>
						</div>
						<button type="submit">recuperar</button>
					</form>
				</div>
			</div>
		</div>

		<div class="px-3 py-2 border-bottom mb-3"></div>
		
		<footer class="bg-dark text-center text-white">
			<div class="container p-4">
				<section class="mb-4">
					<!-- Facebook -->
					<a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fa fa-facebook-f"></i></a>

					<!-- Twitter -->
					<a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fa fa-twitter"></i></a>

					<!-- Google -->
					<a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fa fa-google"></i></a>

					<!-- Instagram -->
					<a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fa fa-instagram"></i></a>

					<!-- Linkedin -->
					<a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fa fa-linkedin"></i></a>

					<!-- Github -->
					<a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fa fa-github"></i></a>
				</section>
			</div>

			<div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
				Powered by 
				<a class="text-white" href="#">alsantech.com</a>
				© 2021 Copyright
			</div>
			
			<script src="frameworks/jquery-3.6.0/jquery-3.6.0.min.js"></script>
			<script src="frameworks/bootstrap-5.0.0/js/bootstrap.min.js"></script>
			<script src="frameworks/bootstrap-5.0.0/js/bootstrap.bundle.min.js"></script>
			<script src="frameworks/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
			<script src="frameworks/jQuery-Mask-Plugin-master/src/jquery.mask.js"></script>
			<script src="frameworks/chart/chart-js-v3-5-1.js"></script>
			
			<!--handsontable-->
			<script src="frameworks/handsontable/handsontable.full.js"></script>
			<script src="frameworks/handsontable/numbro/languages.min.js"></script>
			<!--<script src="frameworks/handsontable/numbro/numbro.js"></script>-->
			<!--<script src="frameworks/handsontable/moment/moment.js"></script>-->
			<!--<script src="frameworks/handsontable/pikaday/pikaday.js"></script>-->
			<!--<script src="frameworks/handsontable/dompurify/purify.js"></script>-->
			
			<script src="js/controllerStyleBackground.js"></script>
			
			<!-- scripts js próprios -->
			
			<?php
				$pagina;

				if(isset($_SESSION['page'])){
					$pagina = $_SESSION['page'];
				}	
				
				/* Carrega a página escolhida pelo usuário */
				switch ($pagina) {
					case 'login':
						echo '<script src="js/loginAccessController.js"></script> <!--Usada no login-->';
						echo '<script src="js/passwordStrongController.js"></script> <!--Usada no login-->';
						echo '<script src="js/show_hide_password.js"></script> <!--Usada no login-->';
						echo '<script src="js/cadastroController.js"></script> <!--Usada no login-->';
						break;
					
					case 'hall':
						echo '<script src="js/controllerCharts.js"></script> <!--Usada no listarColaboradoresGeral-->';
						break;
					
					case 'clienteRestrito':
						echo '<script src="js/listarOrdensServicosClienteController.js"></script> <!--Usada no listarOrdensServicos-->';
						
						echo '<script src="frameworks/handsontable/handsontable.full.js"></script>';
						echo '<script type="text/javascript" src="frameworks/handsontable/languages/pt-BR.js"></script>';
						echo '<script type="text/javascript" src="frameworks/handsontable/dompurify/purify.js"></script>';
						echo '<script type="text/javascript" src="frameworks/handsontable/moment/moment.js"></script>';
						echo '<script type="text/javascript" src="frameworks/handsontable/numbro/numbro.js"></script>';
						echo '<script type="text/javascript" src="frameworks/handsontable/pikaday/pikaday.js"></script>';
						break;
					
					case 'listarColaboradoresGeral':
						echo '<script src="js/filterTableController.js"></script> <!--Usada no listarColaboradoresGeral-->';
						echo '<script src="js/listarColaboradoresGeralController.js"></script> <!--Usada no listarColaboradoresGeral-->';
						break;	
					
					case 'visualizadorColaboradorEspecifico':
						echo '<script src="js/listarColaboradoresEspecificoController.js"></script> <!--Usada no listarColaboradoresEspecifico-->';
						echo '<script src="js/controllerCEP.js"></script> <!--Usada no listarColaboradoresEspecifico-->';
						
						echo '<script src="js/controllerModalSpinner.js"></script>';
						
						//<!--Framework fileinput início-->
						echo '<script src="frameworks/kartik-v-bootstrap-fileinput/js/plugins/piexif.js" type="text/javascript"></script>';
						echo '<script src="frameworks/kartik-v-bootstrap-fileinput/js/plugins/sortable.js" type="text/javascript"></script>';
						echo '<script src="frameworks/kartik-v-bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>';
						echo '<script src="frameworks/kartik-v-bootstrap-fileinput/js/locales/pt-BR.js" type="text/javascript"></script>';
						echo '<script src="frameworks/kartik-v-bootstrap-fileinput/themes/fas/theme.js" type="text/javascript"></script>';
						echo '<script src="frameworks/kartik-v-bootstrap-fileinput/themes/explorer-fas/theme.js" type="text/javascript"></script>';
						//<!--Framework fileinput início-->
						
						break;	
					
					case 'listarColaboradoresAtivos':
						echo '<script src="js/filterTableController.js"></script> <!--Usada no listarColaboradoresGeral-->';
						echo '<script src="js/listarColaboradoresGeralController.js"></script> <!--Usada no listarColaboradoresGeral-->';
						break;	
					
					case 'listarColaboradoresDesativos':
						echo '<script src="js/filterTableController.js"></script> <!--Usada no listarColaboradoresGeral-->';
						echo '<script src="js/listarColaboradoresGeralController.js"></script> <!--Usada no listarColaboradoresGeral-->';
						break;	
					
					case 'listarClientesGeral':
						echo '<script src="js/listarClientessGeralController.js"></script> <!--Usada no listarColaboradoresGeral-->';
						break;
					
					case 'visualizadorClienteEspecifico':
						echo '<script src="js/listarClienteEspecificoController.js"></script> <!--Usada no listarColaboradoresEspecifico-->';
						echo '<script src="js/controllerCEP.js"></script> <!--Usada no listarColaboradoresEspecifico-->';
						
						echo '<script src="js/controllerModalSpinner.js"></script>';
						
						//<!--Framework fileinput início-->
						echo '<script src="frameworks/kartik-v-bootstrap-fileinput/js/plugins/piexif.js" type="text/javascript"></script>';
						echo '<script src="frameworks/kartik-v-bootstrap-fileinput/js/plugins/sortable.js" type="text/javascript"></script>';
						echo '<script src="frameworks/kartik-v-bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>';
						echo '<script src="frameworks/kartik-v-bootstrap-fileinput/js/locales/pt-BR.js" type="text/javascript"></script>';
						echo '<script src="frameworks/kartik-v-bootstrap-fileinput/themes/fas/theme.js" type="text/javascript"></script>';
						echo '<script src="frameworks/kartik-v-bootstrap-fileinput/themes/explorer-fas/theme.js" type="text/javascript"></script>';
						//<!--Framework fileinput início-->
					
					case 'monitoramentoFrota':
						echo '<script src="js/filterTableController.js"></script> <!--Usada no listarColaboradoresGeral-->';
						break;
					
					case 'manipularFrota':
						echo '<script src="js/listarFrotaEspecificaController.js"></script> <!--Usada no listarColaboradoresEspecifico-->';
						break;
					
					case 'visualizadorFrotaEspecifica':
						echo '<script src="js/visualizarFrotaEspecificaController.js"></script> <!--Usada no listarColaboradoresEspecifico-->';
						echo '<script src="js/controllerModalSpinner.js"></script>';
						
						//<!--Framework fileinput início-->
						echo '<script src="frameworks/kartik-v-bootstrap-fileinput/js/plugins/piexif.js" type="text/javascript"></script>';
						echo '<script src="frameworks/kartik-v-bootstrap-fileinput/js/plugins/sortable.js" type="text/javascript"></script>';
						echo '<script src="frameworks/kartik-v-bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>';
						echo '<script src="frameworks/kartik-v-bootstrap-fileinput/js/locales/pt-BR.js" type="text/javascript"></script>';
						echo '<script src="frameworks/kartik-v-bootstrap-fileinput/themes/fas/theme.js" type="text/javascript"></script>';
						echo '<script src="frameworks/kartik-v-bootstrap-fileinput/themes/explorer-fas/theme.js" type="text/javascript"></script>';
						//<!--Framework fileinput início-->
						break;
					
					case 'listarOrdensServicos':
						echo '<script src="js/listarOrdensServicosController.js"></script> <!--Usada no listarOrdensServicos-->';
						
						//<!--<script src="frameworks/handsontable/handsontable.full.js"></script>-->
						echo '<script src="frameworks/handsontable/handsontable.full.js"></script>';
						echo '<script type="text/javascript" src="frameworks/handsontable/languages/pt-BR.js"></script>';
						echo '<script type="text/javascript" src="frameworks/handsontable/dompurify/purify.js"></script>';
						echo '<script type="text/javascript" src="frameworks/handsontable/moment/moment.js"></script>';
						echo '<script type="text/javascript" src="frameworks/handsontable/numbro/numbro.js"></script>';
						echo '<script type="text/javascript" src="frameworks/handsontable/pikaday/pikaday.js"></script>';
						
						break;
					
					case 'criarPlanejamentoOS':
						echo '<script src="js/controllerPlanejamentoOrdemServico.js"></script> <!--Usada no listarColaboradoresGeral-->';
						
						echo '<script src="js/controllerModalSpinner.js"></script>';
						
						//<!--<script src="frameworks/handsontable/handsontable.full.js"></script>-->
						echo '<script src="frameworks/handsontable/handsontable.full.js"></script>';
						echo '<script type="text/javascript" src="frameworks/handsontable/languages/pt-BR.js"></script>';
						echo '<script type="text/javascript" src="frameworks/handsontable/dompurify/purify.js"></script>';
						echo '<script type="text/javascript" src="frameworks/handsontable/moment/moment.js"></script>';
						echo '<script type="text/javascript" src="frameworks/handsontable/numbro/numbro.js"></script>';
						echo '<script type="text/javascript" src="frameworks/handsontable/pikaday/pikaday.js"></script>';
						
						break;
					
					case 'acessarMonitorarExecucoesOperacoes':
						echo '<script src="js/filterTableController.js"></script> <!--Usada no listarColaboradoresGeral-->';
			
						break;
					
					case 'gerenciarLocalizacoes':
						echo '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoUfxLJn_BbtHZt0sI_5db-gv4-qkLcKM&callback=initMap&v=weekly" async></script>';
						echo '<script src="js/controllerLocalizacaoMapa.js"></script> <!--Usada no listarColaboradoresGeral-->';
						echo '<script src="js/filterTableController.js"></script> <!--Usada no listarColaboradoresGeral-->';
						break;
					
					case 'precificarRota':
						
						echo '<script src="js/controllerModalSpinner.js"></script>';
						
						echo '<script src="js/controllerPrecificarRota.js"></script> <!--Usada no listarColaboradoresGeral-->';
						echo '<script src="js/filterTableController.js"></script> <!--Usada no listarColaboradoresGeral-->';
						break;
					
					case 'criarNota':
						echo '<script src="js/controllerCriarNota.js"></script> <!--Usada no listarColaboradoresGeral-->';
						echo '<script src="js/controllerModalSpinner.js"></script>';
						break;
						
					case 'acessarLocalizacaoVeiculos':
						echo '<script src="js/controllerLocalizacaoVeiculosOS.js"></script>';
						echo '<script src="js/controllerModalSpinner.js"></script>';
						echo '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoUfxLJn_BbtHZt0sI_5db-gv4-qkLcKM" async></script>';
						
						break;

					default:
						
						break;
				}
				if(isset($_SESSION['logado'])){
					echo '<script src="js/logoutController.js"></script> <!--Usada no head-->';
					echo '<script src="js/menuLateralController.js"></script> <!--Usada quando logado-->';
				}
				
				if(isset($_SESSION['estilo'])){
					if($_SESSION['estilo'] == "graphite"){
						echo "
							<script>
								$('#switch-shadow').click();
								$('body').removeClass();
								$('body').addClass('graphite');
							</script>"
						;
					}
				}
			?>
			
		</footer>
	</body>
</html>


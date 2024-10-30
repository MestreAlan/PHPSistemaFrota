<?php 

	/* 
	Site: ERadaR
	Autor: Alan Santana
	Data: 11 de Agosto, 2021
	Modification: 11 de Agosto, 2021
	*/
	
	if(!isset($_SESSION)) {
		session_start(); 
	}
	
	if(isset($_SESSION['logado'])) {
		if($_SESSION['logado'] != 1){
			$_SESSION['page'] = 'login';
		}
	}
	
	/* Define a página atual pela URL */
	$pagina = 'login';

	if(isset($_SESSION['page'])){
		$pagina = $_SESSION['page'];
	}	

	/* Carrega o header.php */
	if($pagina != 'login'){
		include 'views/header.php';
	}

	/* Carrega a página escolhida pelo usuário */
	switch ($pagina) {
		case 'login':
			include 'views/login.php'; //Login direct
			break;
		
		case 'hall':
			include 'views/hall.php'; //Pos login direct
			break;
			
		case 'clienteRestrito':
			include 'views/clienteRestrito.php'; // pos login -> MENU financeiro
			break;
			
		case 'listarColaboradoresGeral':
			include 'views/listarColaboradoresGeral.php'; // pos login -> MENU rh 
			break;	
		
		case 'visualizadorColaboradorEspecifico':
			include 'views/visualizadorColaboradorEspecifico.php'; //pos login -> MENU rh -> listarColaboradoresGeral/listarColaboradoresAtivos/listarColaboradoresDesativos
			break;	

		case 'listarColaboradoresAtivos':
			include 'views/listarColaboradoresAtivos.php'; // pos login -> MENU rh 
			break;	
			
		case 'listarColaboradoresDesativos':
			include 'views/listarColaboradoresDesativos.php'; // pos login -> MENU rh 
			break;	
			
		case 'listarClientesGeral':
			include 'views/listarClientesGeral.php'; // pos login -> MENU rh 
			break;	
		
		case 'visualizadorClienteEspecifico':
			include 'views/visualizadorClienteEspecifico.php'; // pos login -> MENU rh 
			break;	
		
		case 'monitoramentoFrota':
			include 'views/monitoramentoFrota.php'; // pos login -> MENU veiculo
			break;	
		
		case 'manipularFrota':
			include 'views/manipularFrota.php'; // pos login -> MENU veiculo
			break;	
		
		case 'visualizadorFrotaEspecifica':
			include 'views/visualizadorFrotaEspecifica.php'; // pos login -> MENU veiculo
			break;	
		
		case 'listarOrdensServicos':
			include 'views/listarOrdensServicos.php'; // pos login -> MENU operacoes
			break;	
				
		case 'criarPlanejamentoOS':
			include 'views/criarPlanejamentoOS.php'; // pos login -> MENU operacoes /-> listarOrdensServicos
			break;	
		
		case 'acessarMonitorarExecucoesOperacoes':
			include 'views/acessarMonitorarExecucoesOperacoes.php'; // pos login -> MENU administrativo
			break;	
		
		case 'gerenciarLocalizacoes':
			include 'views/gerenciarLocalizacoes.php'; // pos login -> MENU sistema
			break;	
		
		case 'visualizadorDashboard.php':
			include 'views/visualizadorDashboard.php'; // pos login -> MENU sistema
			break;	
		
		case 'precificarRota':
			include 'views/precificarRota.php'; // pos login -> MENU financeiro
			break;
		
		case 'criarNota':
			include 'views/criarNota.php'; // pos login -> MENU financeiro
			break;
		
		case 'acessarLocalizacaoVeiculos':
			include 'views/listarVisualizarLocalizacaoVeiculos.php'; // pos login -> MENU financeiro
			break;
		
		default:
			session_destroy();
			$_SESSION['page'] = 'login';
			include 'views/login.php';
			break;
	}

	/* Carrega o footer.php */
	if($pagina != 'login'){
		include 'views/footer.php';
	}
	
<?php 
	// session_start inicia a sessão
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	// as variáveis login e senha recebem os dados digitados na página anterior
	/* Carrega o model */	
	include 'model.php';

	foreach($_POST as $indice => $value){
		$_POST[$indice] = addslashes($_POST[$indice]);
		$_POST[$indice] = mysqli_real_escape_string(conectarBanco(), $_POST[$indice]);
	}

	foreach($_GET as $indice => $value){
		$_GET[$indice] = addslashes($_GET[$indice]);
		$_GET[$indice] = mysqli_real_escape_string(conectarBanco(), $_GET[$indice]);
	}

	foreach($_REQUEST as $indice => $value){
		$_REQUEST[$indice] = addslashes($_REQUEST[$indice]);
		$_REQUEST[$indice] = mysqli_real_escape_string(conectarBanco(), $_REQUEST[$indice]);
	}

	$direcionador = $_POST['direcionador'];	
	$os_num = $_POST['os_num'];
	
	switch ($direcionador) {
		case 'validador':
			$OSNun = buscarOS($os_num);
			
			$teste = $OSNun->fetch_row();
			
			echo mysqli_num_rows($OSNun);
			
			break;
		case 'criarOS':
			$contrato = $_POST['contrato'];
			$frota = $_POST['frota'];
			$batedor = $_POST['batedor'];
			$execucao = $_POST['execucao'];
			$origem = $_POST['origem'];
			$origem_d_c = converterData($_POST['origem_d_c']);
			$origem_d_s = converterData($_POST['origem_d_s']);
			$origem_km = $_POST['origem_km'];
			$destino = $_POST['destino'];
			$destino_d_c = converterData($_POST['destino_d_c']);
			$destino_d_s = converterData($_POST['destino_d_s']);
			$destino_km = $_POST['destino_km'];
			$diaria = $_POST['diaria'];
			
			$empresa = $_POST['empresa'];
			$cliente = $_POST['cliente'];
			$carga = $_POST['carga'];
			$conjunto = $_POST['conjunto'];
			$motorista_conjunto = $_POST['motorista_conjunto'];
			$cte = $_POST['cte'];
			$nf = $_POST['nf'];
			$aet = $_POST['aet'];
						
			if($empresa == "" || $cliente == "" || $carga == "" || $conjunto == "" || $motorista_conjunto == ""){
				criarOSInterna($os_num, $frota, $batedor, $execucao, $origem, $origem_d_c, $origem_d_s, $origem_km, $destino, $destino_d_c, $destino_d_s, $destino_km, $diaria, $empresa );
			}else{
				criarOSServico($contrato, $os_num, $frota, $batedor, $execucao, $origem, $origem_d_c, $origem_d_s, $origem_km, $destino, $destino_d_c, $destino_d_s, $destino_km, $diaria, $empresa, $cliente, $carga, $conjunto, $motorista_conjunto, $cte, $nf, $aet );
			}
			
			break;
		
		case 'excluirOS':
		
			excluirOS($os_num);
			
			break;
		
		default:
			
			break;	
	}
	
	function converterData($valor){
		if($valor != ""){
			$data = str_replace("/", "-", $valor);
			return date('Y-m-d', strtotime($data));
		}else{
			return "";
		}
	}


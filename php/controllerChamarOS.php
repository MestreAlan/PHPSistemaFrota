<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	
	/* Carrega o model */
	include 'model.php';

	/*foreach($_POST as $indice => $value){
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
	}*/
	
	if($_POST['verificador'] == "empresa"){
		$empresas = listarEmpresas();
		$lista = array();
		while($row = $empresas->fetch_row()) {
			array_push($lista, $row);
		}
		
		echo json_encode($lista);
	}else if($_POST['verificador'] == "buscarOS"){
		$osps = listarOSPSVisual();
		$lista = array();
		while($row = $osps->fetch_row()) {
			array_push($lista, $row);
		}
		
		echo json_encode($lista);
	}else if($_POST['verificador'] == "buscarOSCliente"){
		$osps = listarOSPSCliente($_SESSION['user_logado']);
		$lista = array();
		while($row = $osps->fetch_row()) {
			array_push($lista, $row);
		}
		
		echo json_encode($lista);
	}else if($_POST['verificador'] == "buscarOSLimitada"){
		$osps = listarOSPS();
		$lista = array();
		while($row = $osps->fetch_row()) {
			array_push($lista, $row);
		}
		
		echo json_encode($lista);
	}else if($_POST['verificador'] == "frota"){
		$frota = listarFrota();
		$lista = array();
		while($row = $frota->fetch_row()) {
			array_push($lista, $row);
		}
		
		echo json_encode($lista);
	}else if($_POST['verificador'] == "motorista"){
		$motorista = listarMotoristaEscolta();
		$lista = array();
		while($row = $motorista->fetch_row()) {
			array_push($lista, $row);
		}
		
		echo json_encode($lista);
	}else if($_POST['verificador'] == "cliente"){
		$cliente = listarClientes();
		$lista = array();
		while($row = $cliente->fetch_row()) {
			array_push($lista, $row);
		}
		
		echo json_encode($lista);
	}else if($_POST['verificador'] == "carga"){
		$carga = listarCargas();
		$lista = array();
		while($row = $carga->fetch_row()) {
			array_push($lista, $row);
		}
		
		echo json_encode($lista);
	}else if($_POST['verificador'] == "execucao"){
		$execucao = listarExecucoes();
		$lista = array();
		while($row = $execucao->fetch_row()) {
			array_push($lista, $row);
		}
		
		echo json_encode($lista);
	}else if($_POST['verificador'] == "local"){
		$local = listarLocais();
		$lista = array();
		while($row = $local->fetch_row()) {
			array_push($lista, $row);
		}
		
		echo json_encode($lista);
	}else if($_POST['verificador'] == "editarOS"){
		$final = json_decode($_POST['lista']);
		
		$num_os_geral = buscarOSporDataLimitada();
		$num_os_row = mysqli_num_rows($num_os_geral)>0 ? $num_os_geral->fetch_array() : ["0000-".date("n")."-".date("y")];
		$dataPartes = explode("-",(string)$num_os_row[0]);
		$verificador = date("n") != $dataPartes[1] || date("y") != $dataPartes[2] ? 1 : 0;
		if($verificador==1){
			$dataPartes[0] = "0000";
			$dataPartes[1] = date("n");
			$dataPartes[2] = date("y");
		}
		
		$contador = 0;
		
		//foreach($final as $row){
		for($i = 0; $i<count($final); $i++){
			
			$row = $final[$i];
			
			$frotaId = buscarIdFrota($row[0][3]);
			$batedorId = buscarIdBatedor($row[0][5]);
			$execucaoId = buscarIdExecucao($row[0][8]);
			$idOrigem = buscarIdLocal($row[0][11]);
			$idDestino = buscarIdLocal($row[0][15]);
			$idEmpresa = $row[0][2]!="" ? buscarIdEmpresa($row[0][2]) : "";
			$idCliente = $row[0][6]!="" ? buscarIdClienteNome($row[0][6]) : "";
			$idCarga = $row[0][7]!="" ? buscarIdCarga($row[0][7]) : "";
			$data1 = converterData($row[0][12]);
			$data2 = converterData($row[0][13]);
			$data3 = converterData($row[0][16]);
			$data4 = converterData($row[0][17]);
			
			if($row[0][2] == "" || $row[0][6] == "" || $row[0][7] == "" || $row[0][9] == "" || $row[0][10] == ""){
				editarOSInterna($row[0][1], $frotaId, $batedorId , $execucaoId, $idOrigem, $data1, $data2, $row[0][14], $idDestino, $data3, $data4, $row[0][18], $row[0][19], $idEmpresa);
			}else{
				if(buscarPrestacaoServico($row[0][1])>0){
					editarOSServicoAtual($row[0][0], $row[0][1], $frotaId, $batedorId , $execucaoId, $idOrigem, $data1, $data2, $row[0][14], $idDestino, $data3, $data4, $row[0][18], $row[0][19], $idEmpresa, $idCliente, $idCarga, $row[0][9], $row[0][10], $row[0][21], $row[0][22], $row[0][23]);
				}else{
					editarOSServicoNovo($row[0][0], $row[0][1], $frotaId, $batedorId , $execucaoId, $idOrigem, $data1, $data2, $row[0][14], $idDestino, $data3, $data4, $row[0][18], $row[0][19], $idEmpresa, $idCliente, $idCarga, $row[0][9], $row[0][10], $row[0][21], $row[0][22], $row[0][23]);
				}
			}
			
			if($row[1]==1){
				
				for($ver = 0; $ver<count($final) ; $ver++){
					$frotaId2 = buscarIdFrota($final[$ver][0][3]);
					if($frotaId == $frotaId2){
						$final[$ver][1] = 0;
					}
				}
				$contador++;
				$os_final = (int)$dataPartes[0] + (int)$contador ."-".$dataPartes[1]."-".$dataPartes[2];
				criarOSInterna($os_final, $frotaId, $batedorId , 5, $idDestino, $data4, $data4, $row[0][18], $idDestino, "", "", "", "", $idEmpresa);
			}
		}
	}
	
	function converterData($valor){
		if($valor != ""){
			$data = str_replace("/", "-", $valor);
			return date('Y-m-d', strtotime($data));
		}else{
			return "";
		}
	}
	
<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	
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

	$redirecionador = $_POST['direcionador'];
	
	if($redirecionador == "validarPlaca"){
		$idValue = $_POST['idValue'];
		$placa = $_POST['placa'];
		$chassi = $_POST['chassi'];
		$renavan = $_POST['renavan'];
		$modelo = $_POST['modelo'];
		$cor = $_POST['cor'];
		$veiculo = $_POST['veiculo'];
		$fabricante = $_POST['fabricante'];
		$categoria = $_POST['categoria'];
		$tipo = $_POST['tipo'];
		$combustivel = $_POST['combustivel'];
		$ano = $_POST['ano'];
		$frota = $_POST['frota'];
		$imei = $_POST['imei'];
		$empresa = $_POST['empresa'];
		$funcao = $_POST['funcao'];
		$credencial = $_POST['credencial'];
		$expedicao = converterData($_POST['expedicao']);
		$validade = converterData($_POST['validade']);
		
		$img_link = "";
		if($funcao==1){
			$img_link = "img/imgEscolta/".strtolower($frota).".png";
		}else if($funcao==2){
			$img_link = "img/imgAmbulancia/".strtolower($frota).".png";
		}
		
		$validadorPlaca = buscarVeiculo($placa);
		
		//$validadorPlaca = $validadorPlaca->fetch_row();
		$retorno = array(0,0);
		if($idValue == 0){
			if(mysqli_num_rows($validadorPlaca)==0){
				criarFrota($placa, $chassi, $renavan, $modelo, $cor, $veiculo, $fabricante, $categoria, $tipo, $combustivel, $ano, $frota, $imei, $img_link, $empresa, $funcao, $credencial, $expedicao, $validade);
				$retorno[1] = buscarIdFrotaPlaca($placa);
				$_SESSION['idFrota'] = $retorno[1];
				$retorno[0] = 2;
			}else{
				$retorno[0] = 1;
			}
		}else{
			//FAZER EDITAR FROTA
				editarFrota($idValue, $placa, $chassi, $renavan, $modelo, $cor, $veiculo, $fabricante, $categoria, $tipo, $combustivel, $ano, $frota, $imei, $img_link, $empresa, $funcao, $credencial, $expedicao, $validade);
				
				$retorno[0] = 3;
		}
		
		echo json_encode($retorno);
		
	}
	
	function converterData($valor){
		if($valor != ""){
			$data = str_replace("/", "-", $valor);
			return date('Y-m-d', strtotime($data));
		}else{
			return "";
		}
	}
	
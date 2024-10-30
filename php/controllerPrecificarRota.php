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

	$diferenciador = $_POST['diferenciador'];
	
	if($diferenciador == "criar"){
		$contrato = $_POST['contrato'];
		$apelido = $_POST['apelido'];
		$valor = $_POST['valor'];
		$km = $_POST['km'];
		$transitime = $_POST['transitime'];
		$origem = $_POST['origem'];
		$destino = $_POST['destino'];
		$cliente = $_POST['cliente'];
		
		criarPrecificacao($contrato, $apelido, $valor, $km, $transitime, $origem, $destino, $cliente);
	}else if($diferenciador == "editar"){
		$idValue = $_POST['idValue'];		
		$contrato = $_POST['contrato'];
		$apelido = $_POST['apelido'];
		$valor = $_POST['valor'];
		$km = $_POST['km'];
		$transitime = $_POST['transitime'];
		$origem = $_POST['origem'];
		$destino = $_POST['destino'];
		$cliente = $_POST['cliente'];
		
		editarPrecificacao($idValue, $contrato, $apelido, $valor, $km, $transitime, $origem, $destino, $cliente);
	}else if($diferenciador == "validar"){
		$contrato = $_POST['contrato'];		
		$origem = $_POST['origem'];
		$destino = $_POST['destino'];
		$cliente = $_POST['cliente'];
		
		$retorno = validarPrecificacao($contrato, $origem, $destino, $cliente);
		$retornoFinal = mysqli_num_rows($retorno)>0 ? 1 : 0;
		echo $retornoFinal;
	}else if($diferenciador == "excluir"){
		$idValue = $_POST['idValue'];		

		excluirPrecificacao($idValue);
	}

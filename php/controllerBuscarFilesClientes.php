<?php 
	// session_start inicia a sessão
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

	$retorno = buscarArquivosCliente($_SESSION['idCliente']);
	
	$retornoVetor = array();
	
	while($row = $retorno->fetch_row()) {
		array_push($retornoVetor, $row);
	}
	
	echo json_encode($retornoVetor);

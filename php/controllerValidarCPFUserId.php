<?php 
	// session_start inicia a sessão
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	// as variáveis id user e senha recebem os dados digitados na página anterior
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

	$idValue = strtolower($_POST['idValue']);
	$cpf = strtolower($_POST['cpf']);
	
	$cpfNun = validarCPF($cpf);
	
	$userCPFNun = validarCPFUser($idValue,$cpf);
	
	echo json_encode(array(mysqli_num_rows($cpfNun), mysqli_num_rows($userCPFNun)));


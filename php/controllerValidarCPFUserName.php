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

	$login = strtolower($_POST['user_login']);
	$email = strtolower($_POST['email']);
	$codigo = strtolower($_POST['codigo']);
	
	$userNun = validarUserLogin($login);
	
	$emailRetorno = validarCriarLogin($email, $codigo); // Verifica se existe cadastro de liberação pelo email  FAZER
	
	$emailNum = mysqli_num_rows($emailRetorno) > 0 ? validarUsuarioCriado($email) : -1; // Verifica se usuário liberado já foi criado
	
	echo json_encode(array(mysqli_num_rows($userNun), $emailNum));


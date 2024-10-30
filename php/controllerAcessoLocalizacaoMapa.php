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

	$direcionador = $_POST['direcionador'];
	
	if($direcionador == "adicionar"){
		$cidade = $_POST['cidade'];
		$estado = $_POST['estado'];
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];
		$address = $_POST['address'];
		$apelido = $_POST['apelido'];
		criarLocalizacao($cidade,$estado,$lat,$lng,$address,$apelido);
		$novoIdTemp = buscarIdUltimaLocalizacaoCadastrada();
		$novoId = $novoIdTemp->fetch_row();
		echo $novoId[0];
	}else if($direcionador == "excluir"){
		$idValue = $_POST['idValue'];
		excluirLocalizacao($idValue);
	}
	
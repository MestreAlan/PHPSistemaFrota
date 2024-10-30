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

	// Pasta onde o arquivo vai ser salvo
	$_UP['pasta'] = '../uploads/';
	$_UP['pastaRef'] = 'uploads/';
	 
	// Tamanho máximo do arquivo (em Bytes)
	$_UP['tamanho'] = 1024 * 1024 * 15; // 15Mb
	 
	// Array com as extensões permitidas
	$_UP['extensoes'] = array('pdf', 'jpg', 'png', 'jpeg');
	 
	// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
	$_UP['renomeia'] = false;
	 
	// Array com os tipos de erros de upload do PHP
	$_UP['erros'][0] = 'Não houve erro';
	$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
	$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
	$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
	$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
	
	$infoImagenesSubidas = array();
	$ImagenesSubidas = array();
	
	parse_str(file_get_contents("php://input"),$dadosDELETE);
	$nomeFinal = $_UP['pasta'].$dadosDELETE['key'];
	
	if (unlink($nomeFinal)) {
		excluirDocumentoPessoa($dadosDELETE['key']);
	} else {
	// Não foi possível fazer o upload, provavelmente a pasta está incorreta
		echo "Não foi possível remover o arquivo, tente novamente";
	}
	
	$arr = array("file_id"=>0,"overwriteInitial"=>true,"initialPreviewConfig"=>$infoImagenesSubidas,
		 "initialPreview"=>$ImagenesSubidas);
	echo json_encode($arr);

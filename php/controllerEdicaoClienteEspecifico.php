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
	
	if($redirecionador == "editarDadosGerais"){
		$idValue = $_POST['idValue'];
		$razao_social = $_POST['razao_social'];
		$fantasia = $_POST['fantasia'];
		$cnpj = $_POST['cnpj'];
		$inscricao_municipal = $_POST['inscricao_municipal'];
		editarCliente($idValue, $razao_social, $fantasia, $cnpj, $inscricao_municipal);
	}else if($redirecionador == "criarDadosGerais"){
		$razao_social = $_POST['razao_social'];
		$fantasia = $_POST['fantasia'];
		$cnpj = $_POST['cnpj'];
		$inscricao_municipal = $_POST['inscricao_municipal'];
		criarCliente($razao_social, $fantasia, $cnpj, $inscricao_municipal);
		$novoIdTemp = buscarIdCliente($razao_social, $fantasia, $cnpj, $inscricao_municipal);
		$novoId = $novoIdTemp->fetch_row();
		$_SESSION['idCliente'] = $novoId[0];
		criarUsuarioCliente($cnpj, $_SESSION['idCliente']);
	}else if($redirecionador == "editarEndereco"){
		$id = $_POST['id'];
		$enderecoCEP = $_POST['enderecoCEP'];
		$enderecoCasa = $_POST['enderecoCasa']; 
		$enderecoBairro = $_POST['enderecoBairro']; 
		$estado = $_POST['estado']; 
		$enderecoCidade = $_POST['enderecoCidade']; 
		$enderecoComplemento = $_POST['enderecoComplemento']; 
		$enderecoReferencia = $_POST['enderecoReferencia']; 
		$enderecoLogradouro = $_POST['enderecoLogradouro']; 
		editarEnderecoCliente($id, $enderecoCEP, $enderecoCasa, $enderecoBairro, $estado, $enderecoCidade, $enderecoComplemento, $enderecoReferencia, $enderecoLogradouro);
	}else if($redirecionador == "criarEndereco"){
		$enderecoCEP = $_POST['enderecoCEP'];
		$enderecoCasa = $_POST['enderecoCasa']; 
		$enderecoBairro = $_POST['enderecoBairro']; 
		$estado = $_POST['estado']; 
		$enderecoCidade = $_POST['enderecoCidade']; 
		$enderecoComplemento = $_POST['enderecoComplemento']; 
		$enderecoReferencia = $_POST['enderecoReferencia']; 
		$enderecoLogradouro = $_POST['enderecoLogradouro']; 
		criarEnderecoCliente($enderecoCEP, $enderecoCasa, $enderecoBairro, $estado, $enderecoCidade, $enderecoComplemento, $enderecoReferencia, $enderecoLogradouro);
		$idEndereco = buscarIdEnderecoCliente($enderecoCEP);
		$idSelectEndereco = $idEndereco->fetch_row();
		echo $idSelectEndereco[0];
	}else if($redirecionador == "editarContato"){
		$idValue = $_POST['idValue'];
		$contatosTelefone = $_POST['contatosTelefone']; 
		$telefoneWhatsapp = $_POST['telefoneWhatsapp']; 
		$email = $_POST['email']; 
		editarTelefoneCliente($idValue,$contatosTelefone,$telefoneWhatsapp,$email);
	}else if($redirecionador == "criarContato"){
		$contatosTelefone = $_POST['contatosTelefone']; 
		$telefoneWhatsapp = $_POST['telefoneWhatsapp']; 
		$email = $_POST['email'];  
		criarTelefoneCliente($contatosTelefone,$telefoneWhatsapp,$email);
		$idContato = buscarIdContatoCliente($_SESSION['idCliente']);
		$idSelectContato = $idContato->fetch_row();
		echo $idSelectContato[0];
		
	}
	
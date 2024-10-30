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
	
	$arquivos = count(isset($_FILES['arquivo']['name'])?$_FILES['arquivo']['name']:0);
	for($i = 0; $i < $arquivos; $i++){
		
		// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
		if ($_FILES['arquivo']['error'][$i] != 0) {
			echo("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['arquivo']['error'][$i]]);
			exit; // Para a execução do script
		}
		 
		// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
		 
		// Faz a verificação da extensão do arquivo
		//$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
		
		
		$fileName = strtolower($_FILES['arquivo']['name'][$i]);
		$tmp = explode('.', $fileName);
		$extensao = end($tmp);
		
		if (array_search($extensao, $_UP['extensoes']) === false) {
			echo "Por favor, envie arquivos com as seguintes extensões: jpg, png ou jpeg";
		}
		 
		// Faz a verificação do tamanho do arquivo
		else if ($_UP['tamanho'] < $_FILES['arquivo']['size'][$i]) {
			echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
		}
		 
		// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
		else {
			// Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
			$nome_final = substr(preg_replace("/[^a-zA-Z0-9]/", "", strtolower(trim($tmp[0]))), 0, 12).'-'.time().".".$extensao;
			$nome_a_inserir = $_UP['pastaRef'] . $nome_final;
			//INSERIR COMNADO DO BD PARA INSERIR
			$tipoDocumento = strtolower($extensao) == 'pdf' ? 2 : 1;
			criarFileVeiculos($_SESSION['idFrota'], $nome_final, $nome_a_inserir, $tipoDocumento);
			 
			
			$nomeFinal = substr($nome_final,0,strlen($nome_final)-15) .''. substr($nome_final,strlen($nome_final)-4,strlen($nome_final));
			
			$type = substr($nome_final,strlen($nome_final)-3,strlen($nome_final)) == 'pdf' ? 'pdf' : 'image';
			
			$infoImagenesSubidas[$i]=array("caption"=>$nomeFinal,"downloadUrl"=>$nome_a_inserir,"key"=>$nome_final, "type"=>$type);
			$ImagenesSubidas[$i]=$nome_a_inserir;
			 
			 //checking if file exsists
			if(file_exists($nome_a_inserir)) unlink($nome_a_inserir);		 
			 
			// Depois verifica se é possível mover o arquivo para a pasta escolhida
			if (move_uploaded_file($_FILES['arquivo']['tmp_name'][$i], '../'.$nome_a_inserir)) {
				
			} else {
			// Não foi possível fazer o upload, provavelmente a pasta está incorreta
				echo "Não foi possível enviar o arquivo, tente novamente";
			}
		 
		}
	}
	
	$arr = array("file_id"=>0,"overwriteInitial"=>true,"initialPreviewConfig"=>$infoImagenesSubidas,
		 "initialPreview"=>$ImagenesSubidas);
	echo json_encode($arr);

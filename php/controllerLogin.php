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
	
	$codigo = $_POST["loginValidacaoCode"];
	
	if($codigo == $_SESSION['validadorHash']){	
	
		$login = strtolower($_POST['user']);
		$senha = sha1(md5($_POST['password_login']));
		
		$userRetornado = validarConexao($login, $senha);
		
		if(mysqli_num_rows($userRetornado) > 0)
		{
			$user = $userRetornado->fetch_row();
			$_SESSION['logado'] = 1;
			$_SESSION['user_logado'] = $user[0];
			$_SESSION['perfil_logado'] = $user[1];
			$_SESSION['perfil_nome'] = $user[2];
			$_SESSION['page'] = 'hall';
			header('location:../');
		}else{
			$clienteRetornado = validarConexaoCliente($login, $senha);
			
			if(mysqli_num_rows($clienteRetornado) > 0)
			{
				$user = $clienteRetornado->fetch_row();
				$_SESSION['logado'] = 1;
				$_SESSION['user_logado'] = $user[0];
				$_SESSION['perfil_logado'] = $user[1];
				$_SESSION['perfil_nome'] = $user[2];
				$_SESSION['page'] = 'clienteRestrito';
				header('location:../');
			}else{
				session_destroy();
				header('location:../');
			}
		}
	}

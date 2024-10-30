<?php

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

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://api.chaser.com.br/oauth/token',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>'{
		"grant_type":"password",
		"client_id":"7",
		"client_secret":"iR4VEylepml1gLKQDApmHtmNTHdpctkCCgf5y4ax",
		"username":"operacional@radarescolta.com",
		"password":"123456",
		"scope":""
	}',
	  CURLOPT_HTTPHEADER => array(
		'Content-Type: application/json'
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	$obj = json_decode($response);

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://api.chaser.com.br/api/veiculos',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'GET',
	  CURLOPT_HTTPHEADER => array(
		'Authorization: Bearer '.$obj->{'access_token'},
		'Content-Type: application/json'
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	$data = json_decode($response);
	
	if($_POST['direcionador'] = 'listarVeiculos'){
		
	}
	
	if($_POST['direcionador'] = 'listarVeiculosOS'){
	
	
		$saida = array();
		$saidaV = array();

		foreach ($data as $valor){
			$existe = in_array( $valor->{'placa'}, $saida );
			if ( !$existe ) { 
				$retorno = buscarVeiculo($valor->{'placa'});
				
				if(mysqli_num_rows($retorno) > 0){
					$veiculosDados = buscarVeiculoDados($valor->{'placa'});
						array_push($saidaV, 
							[
								$valor->{'placa'},
								$valor->{'frota'},
								$valor->{'latitude'},
								$valor->{'longitude'},
								$valor->{'ligado'},
								$veiculosDados->fetch_row()
							]
						);
					$listaOS = buscarVincularOSVeiculo($valor->{'placa'});
					if(mysqli_num_rows($listaOS)>0){
						array_push($saida, 
							[
								$valor->{'placa'},
								$valor->{'frota'},
								$valor->{'latitude'},
								$valor->{'longitude'},
								$valor->{'ligado'},
								$listaOS->fetch_row()
							]
						);				
					}
				}
			}
		}
		array_unshift($saida, $saidaV);
		/*
		Validar se carro existe na base de dados

		DA API
		placa
		Frota
		Ligado
		Longitude
		Latitude

		DO BD
		Os
		Localizacao destino longitude
		Localizacao destino latitude
		
		
		array_push($saida, 
			[$valor->{'carro_id'},
			$valor->{'placa'},
			$valor->{'chassis'},
			$valor->{'renavan'},
			$valor->{'ano_modelo'},
			$valor->{'cor'},
			$valor->{'veiculo'},
			$valor->{'carro_fabricante'},
			$valor->{'carro_categoria'},
			$valor->{'carro_tipo'},
			$valor->{'combustivel'},
			$valor->{'ano'},
			$valor->{'frota'},
			$valor->{'imei'},
			$valor->{'latitude'},
			$valor->{'longitude'},
			$valor->{'date_rastreador'},
			$valor->{'ligado'},
			$valor->{'speed'},
			$valor->{'crs'},
			$valor->{'dist'}]
		);
		*/

		echo json_encode($saida);
	}

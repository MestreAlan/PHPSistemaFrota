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
	
	$prestadora = $_POST['prestadora'];
	$tomadora = $_POST['tomadora'];
	$periodo_inicio = converterData($_POST['periodo_inicio']);
	$periodo_final = converterData($_POST['periodo_final']);
	$cte = $_POST['cte'];
	$note = $_POST['note'];
	
	if($cte == "" && $note == ""){
		$retorno = buscarDadosNota4($prestadora, $tomadora, $periodo_inicio, $periodo_final);
		/*$doc = new DOMDocument( );
		$ele = $doc->createElement( 'Root' );
		$retorno=$retorno->fetch_row();
		$ele->nodeValue = $retorno;
		$doc->appendChild( $ele );
		$doc->save('MyXmlFile.xml');
		
		$file_url = 'MyXmlFile.xml';
		readfile($file_url);
		*/
		
		$vetor = array();
		if(mysqli_num_rows($retorno)>0){
			while($row = $retorno->fetch_row()) {
				array_push($vetor, $row);
			}
		}else{
			array_push($vetor, [0,"","","","","","","","","","","","","","","","","","","","","","","","","",""]);
		}
		
		echo json_encode($vetor);
		
		
	}else if($cte == ""){
		$retorno = buscarDadosNota3($prestadora, $tomadora, $periodo_inicio, $periodo_final, $note);
		
		/*$doc = new DOMDocument( );
		$ele = $doc->createElement( 'Root' );
		$retorno=$retorno->fetch_row();
		$ele->nodeValue = $retorno;
		$doc->appendChild( $ele );
		$doc->save('MyXmlFile.xml');
		
		$file_url = 'MyXmlFile.xml';
		readfile($file_url);
		*/
		
		$vetor = array();
		if(mysqli_num_rows($retorno)>0){
			while($row = $retorno->fetch_row()) {
				array_push($vetor, $row);
			}
		}else{
			array_push($vetor, [0,"","","","","","","","","","","","","","","","","","","","","","","","","",""]);
		}
		
		echo json_encode($vetor);
		
	}else if($note == ""){
		$retorno = buscarDadosNota2($prestadora, $tomadora, $periodo_inicio, $periodo_final, $cte);
		
		/*$doc = new DOMDocument( );
		$ele = $doc->createElement( 'Root' );
		$retorno=$retorno->fetch_row();
		$ele->nodeValue = $retorno;
		$doc->appendChild( $ele );
		$doc->save('MyXmlFile.xml');
		
		$file_url = 'MyXmlFile.xml';
		readfile($file_url);
		*/
		
		$vetor = array();
		if(mysqli_num_rows($retorno)>0){
			while($row = $retorno->fetch_row()) {
				array_push($vetor, $row);
			}
		}else{
			array_push($vetorDadosPessoais, [0,"","","","","","","","","","","","","","","","","","","","","","","","","",""]);
		}
		
		echo json_encode($vetor);
	}else{
		$retorno = buscarDadosNota1($prestadora, $tomadora, $periodo_inicio, $periodo_final, $cte, $note);
		
		/*$doc = new DOMDocument( );
		$ele = $doc->createElement( 'Root' );
		$retorno=$retorno->fetch_row();
		$ele->nodeValue = $retorno;
		$doc->appendChild( $ele );
		$doc->save('MyXmlFile.xml');
		
		$file_url = 'MyXmlFile.xml';
		readfile($file_url);
		*/
		
		$vetor = array();
		if(mysqli_num_rows($retorno)>0){
			while($row = $retorno->fetch_row()) {
				array_push($vetor, $row);
			}
		}else{
			array_push($vetorDadosPessoais, [0,"","","","","","","","","","","","","","","","","","","","","","","","","",""]);
		}
		
		echo json_encode($vetor);
	}
	
	function converterData($valor){
		if($valor != ""){
			$data = str_replace("/", "-", $valor);
			return date('Y-m-d', strtotime($data));
		}else{
			return "";
		}
	}
	
	
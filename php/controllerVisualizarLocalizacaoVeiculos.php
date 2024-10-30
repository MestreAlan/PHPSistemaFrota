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
	
	function listarVeiculosLocalizacao(){
		
		$textoPush = '
			<div class="container" id="mapasCont">
				<div class="row linhaV">
					<div id="mapaV" style="width:100%; height:500px"></div>
				</div>
				<br \><br \><br \><br \><br \><br \>
				<div class="row linha0">
					<div class="col-xs col-xs col-md col-lg col-xl col-xxl coluna0">
					
						<div id="floating-panel0">
							
						</div>
						<div id="local0">
							
						</div>
						<div id="destino0">
							
						</div>
						<div id="mapa0" style="width:100%; height:250px"></div>
					</div>
				</div>
			</div>	
		';
		
		return $textoPush;
	}

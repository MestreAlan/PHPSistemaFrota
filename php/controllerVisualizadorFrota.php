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

	function chamarListarFrota(){
		$lista = listarFrota();
		
		$textoPush = '
				<div class="table100 ver3 ">
					<div class="table100-head">
						<table class="tablemanager" id="monitorarFrotaTable">
							<thead>
								<tr class="row100 head">
									<th>
										Frota
									</th>
									
									<th>
										Placa 		
									</th>
									
									<th>
										Renavan
									</th>
								
									<th>
										Dados completos
									</th>
									
								</tr>
							</thead>
							<tbody>
			';
									
		while($row = $lista->fetch_row()) {
			$textoPush = $textoPush.'
								<tr class="row100 body visualizarColaborador" >
									<td class="cell100 column1"><span class="frota" >'.$row[12].'</span></td>
									<td class="cell100 column2"><span class="placa" >'.$row[1].'</span></td>
									<td class="cell100 column3"><span class="renavan" >'.$row[3].'</span></td>
									<td><button type="button" id="'.$row[0].'" class="btn btn-primary acessarFrota">Visualizar</button></td>
								</tr>
			';
		}		
		
		$textoPush = $textoPush.'
							</tbody>
						</table>
					</div>
				</div>
		';
		
		return $textoPush;
	}

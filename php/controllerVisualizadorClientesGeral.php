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

	function chamarListarDocumentos(){
		$lista = listarClientesCompleto();
		
		$textoPush = '
				<div class="table100 ver3 ">
					<div class="table100-head">
						<table class="tablemanager">
							<thead>
								<tr class="row100 head">
									<th scope="col">CNPJ</th>
									<th scope="col">Razão social</th>
									<th scope="col">Telefone</th>
									<th scope="col">E-mail</th>
									<th scope="col">Inscrição municipal</th>
									<th scope="col">Acessar</th>
								</tr>
							</thead>
							<tbody>
			';
									
		while($row = $lista->fetch_row()) {
			$textoPush = $textoPush.'
								<tr class="row100 body visualizarColaborador" >
									<td class="cell100 column1"><span class="matricula" >'.$row[3].'</span></td>
									<td class="cell100 column2"><span class="nome" >'.$row[2].'</span></td>
									<td class="cell100 column3"><span class="date" >'.$row[8].'</span></td>
									<td class="cell100 column4"><span class="date" >'.$row[10].'</span></td>
									<td class="cell100 column5"><span class="date" >'.$row[4].'</span></td>
									<td><button type="button" id="'.$row[0].'" class="btn btn-primary acessarCliente">Visualizar</button></td>
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

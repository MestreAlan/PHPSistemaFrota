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
		$lista = listarColaboradores();
		
		$textoPush = '
				<div class="table100 ver3 ">
					<div class="table100-head">
						<table class="tablemanager" id="monitorarFrotaTable">
							<thead>
								<tr class="row100 head">
									<th class="cell100 column1">Matrícula </th>
									<th class="cell100 column2">Nome</th>
									<th class="cell100 column3">Empresa</th>
									<th class="cell100 column4">Data de admissão</th>
									<th class="cell100 column5">Cargo</th>
									<th class="cell100 column6">Estado do contrato</th>
									<th class="disableFilterBy cell100 column7">Dados completos</th>
								</tr>
							</thead>
							<tbody>
			';
									
		while($row = $lista->fetch_row()) {
			if($row[7] != 1){
				if( (is_null($row[5]) || ($row[5] != '0000-00-00' && $row[5] <= date('Y-m-d', time()))) ){
					$dateConvert = $row[3] != NULL && $row[3] != '0000-00-00' ? date('d-m-Y', strtotime($row[3])) : "";
					
					$saidaAtivo = (is_null($row[5]) || ($row[5] != '0000-00-00' && $row[5] <= date('Y-m-d', time()))) ? 'Desativo' : 'Ativo';
					
					$textoPush = $textoPush.'
								<tr class="row100 body">
									<td class="matricula cell100 column1">'.$row[2].'</td>
									<td class="nome cell100 column2">'.$row[1].'</td>
									<td class="empresa cell100 column3">'.$row[6].'</td>
									<td class="date cell100 column4">'.$dateConvert.'</td>
									<td class="cargo cell100 column5">'.$row[4].'</td>
									<td class="Contrato cell100 column6 "><label class="'.$saidaAtivo.'">'.$saidaAtivo.'</label></td>
									<td><button type="button" id="'.$row[0].'" class="btn btn-primary acessarPessoa cell100 column7">Visualizar</button></td>
								</tr>
							';
				}
			}
		}		
		
		$textoPush = $textoPush.'
							</tbody>
						</table>
					</div>
				</div>
		';
		
		return $textoPush;
	}

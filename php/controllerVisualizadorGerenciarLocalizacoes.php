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

	function inserirEstados(){
		$listaEstados = listarEstados();
		
		$selectOptions = '<select id="estadosBrasil" class="estados" name="estados-brasil" required>';

		while($estado = $listaEstados->fetch_row()){
			if($estado[2]=="RN"){
				$selectOptions = $selectOptions.'<option value="'.$estado[2].'" selected>'.$estado[2].'</option>';
			}else{
				$selectOptions = $selectOptions.'<option value="'.$estado[2].'">'.$estado[2].'</option>';
			}
		}
		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}
	
	function inserirEstado($verificador){
		$listaEstados = listarEstados();
		
		while($estado = $listaEstados->fetch_row()){
			if($estado[0]==$verificador){
				return $estado[2];
			}
		}
		
		return "";
	}
	
	function addArray($datas){
		$datasRow;
		while($rowIn = $datas->fetch_row()){array_push($datasRow,$rowIn[0]);}
		return $datasRow;
	}
	
	function addLocalizacao(){
		$estadosLista = inserirEstados();
		
		$textoPush = 
		'
			<div class="container">
				<div class="row">
					<div class="inputbox col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2"> 
						<input id="apelido" value="" placeholder="Apelido" \>
						<span>Apelido</span>
					</div>
					<div class="inputbox col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1"> 
						'.$estadosLista.'
						<span>Estado</span>
					</div>
					<div class="inputbox col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
						<input id="cidade" value="" placeholder="Nome da Cidade" \>
						<span>Cidade</span>
					</div>
					<div class="inputbox col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">		
						<input id="endereco" value=""  \>
						<span>Endereço</span>
					</div>
					<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">		
						<button type="button" id="addLocal" class="btn btn-primary">add</button>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6"> 
						<div class="map-responsive" id="mapa">
							<iframe width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6"> 
						<div class="table100 ver3 ">
							<div class="table100-head">
								<table class="tablemanager">
									<thead>
										<tr class="row100 head">
											<th>Apelido</th>
											<th>Cidade</th>
											<th>Estado</th>
											<th>Ação</th>
										</tr>
									</thead>
									<tbody class="tbodyDadosPessoais" >
		';
		$datas = listarLocais();	
		
		while($row = $datas->fetch_row()) {
			
			$estadoRow = inserirEstado($row[8]);
			
			$textoPush = $textoPush.
			'			
										<tr class="row100 body" >
											<td class="cell100 column1"><span class="date" >'.$row[4].'</span></td>
											<td class="cell100 column2"><span class="date" >'.$row[1].'</span></td>
											<td class="cell100 column3"><span class="date" >'.$estadoRow.'</span></td>
											<td><button id="'.$row[0].'" type="button" class="btn btn-primary removerLocal">Excluir</button></td>
										</tr>
			';
		}
		$textoPush = $textoPush.
			'			
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			';
		
		return $textoPush;
	}

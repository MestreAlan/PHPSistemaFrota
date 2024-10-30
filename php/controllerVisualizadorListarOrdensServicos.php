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

	function inserirEmpresas($id, $diferenciador){
		$listaEmpresas = listarEmpresas();
		
		$selectOptions = '<select id="input_empresa-'.$diferenciador.'" name="empresa" class="input_empresa" required>';
		$selectOptions = $selectOptions.'<option value="" disabled selected>Selecione uma opção</option>';
		
		while($empresa = $listaEmpresas->fetch_row()){
			if($empresa[0]==$id){
				//return $empresa[1];
				$selectOptions = $selectOptions.'<option value="'.$empresa[0].'" selected>'.$empresa[1].'</option>';
			}else{
				$selectOptions = $selectOptions.'<option value="'.$empresa[0].'">'.$empresa[1].'</option>';
			}
		}
		
		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}
	
	function inserirCliente($id, $diferenciador){
		$listaEmpresas = listarClientes();
		
		$selectOptions = '<select id="input_cliente-'.$diferenciador.'" name="empresa" class="input_cliente" required>';
		$selectOptions = $selectOptions.'<option value="" disabled selected>Selecione uma opção</option>';
		
		while($empresa = $listaEmpresas->fetch_row()){
			if($empresa[0]==$id){
				//return $empresa[1];
				$selectOptions = $selectOptions.'<option value="'.$empresa[0].'" selected>'.$empresa[1].'</option>';
			}else{
				$selectOptions = $selectOptions.'<option value="'.$empresa[0].'">'.$empresa[1].'</option>';
			}
		}
		
		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}
	
	function inserirFrota($id, $diferenciador){
		$listaEmpresas = listarFrota();
		
		$selectOptions = '<select id="input_frota-'.$diferenciador.'" name="empresa" class="input_frota" required>';
		$selectOptions = $selectOptions.'<option value="" disabled selected>Selecione uma opção</option>';
		
		while($veiculo = $listaEmpresas->fetch_row()){
			if($veiculo[0]==$id){
				//return $empresa[1];
				$selectOptions = $selectOptions.'<option placa="'.$veiculo[1].'" value="'.$veiculo[0].'" selected>'.$veiculo[2].'</option>';
			}else{
				$selectOptions = $selectOptions.'<option placa="'.$veiculo[1].'" value="'.$veiculo[0].'">'.$veiculo[2].'</option>';
			}
		}
		
		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}

	function inserirBatedor($id, $diferenciador){
		$listaMotorista = listarMotoristaEscolta();
		
		$selectOptions = '<select id="input_batedor-'.$diferenciador.'" name="empresa" class="input_batedor" required>';
		$selectOptions = $selectOptions.'<option value="" disabled selected>Selecione uma opção</option>';
		
		while($motorista = $listaMotorista->fetch_row()){
			if($motorista[0]==$id){
				//return $empresa[1];
				$selectOptions = $selectOptions.'<option value="'.$motorista[0].'" selected>'.$motorista[2].'</option>';
			}else{
				$selectOptions = $selectOptions.'<option value="'.$motorista[0].'">'.$motorista[2].'</option>';
			}
		}
		
		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}

	function inserirExecucoes($id, $diferenciador){
		$listaExecucoes = listarExecucoes();
		
		$selectOptions = '<select id="input_execucao-'.$diferenciador.'" name="empresa" class="input_execucao" required>';
		$selectOptions = $selectOptions.'<option value="" disabled selected>Selecione uma opção</option>';
		
		while($execucao = $listaExecucoes->fetch_row()){
			if($execucao[0]==$id){
				//return $empresa[1];
				$selectOptions = $selectOptions.'<option value="'.$execucao[0].'" selected>'.$execucao[1].'</option>';
			}else{
				$selectOptions = $selectOptions.'<option value="'.$execucao[0].'">'.$execucao[1].'</option>';
			}
		}
		
		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}

	function inserirLocais($id, $diferenciador){
		$listaLocais = listarLocais();
		
		$selectOptions = '<select id="input_local-'.$diferenciador.'" name="empresa" class="input_local" required>';
		$selectOptions = $selectOptions.'<option value="" disabled selected>Selecione uma opção</option>';
		
		while($local = $listaLocais->fetch_row()){
			if($local[0]==$id){
				//return $empresa[1];
				$selectOptions = $selectOptions.'<option value="'.$local[0].'" selected>'.$local[1].'</option>';
			}else{
				$selectOptions = $selectOptions.'<option value="'.$local[0].'">'.$local[1].'</option>';
			}
		}
		
		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}
	
	function inserirCarga($id, $diferenciador){
		$listaCargas = listarCargas();
		
		$selectOptions = '<select id="input_carga-'.$diferenciador.'" name="empresa" class="input_carga" required>';
		$selectOptions = $selectOptions.'<option value="" disabled selected>Selecione uma opção</option>';
		
		while($carga = $listaCargas->fetch_row()){
			if($carga[0]==$id){
				//return $empresa[1];
				$selectOptions = $selectOptions.'<option value="'.$carga[0].'" selected>'.$carga[1].'</option>';
			}else{
				$selectOptions = $selectOptions.'<option value="'.$carga[0].'">'.$carga[1].'</option>';
			}
		}
		
		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}

	function listarOrdensServicos(){
		$osValues = listarOSPS();
		
		$textoPush = 
			'
			<thead>
				<tr>
					<th>
						OS n°
					</th>
					
					<th>
						Prestadora de serviço
					</th>
					
					<th>
						Frota
					</th>
				
					<th>
						Placa
					</th>
					
					<th>
						Batedor
					</th>
					
					<th>
						Cliente
					</th>
					
					<th>
						Carga
					</th>
					
					<th>
						Tipo de execução
					</th>
					
					<th>
						Conjunto
					</th>
					
					<th>
						Motorista do conjunto
					</th>
					
					<th>
						Origem
					</th>
					
					<th>
						Origem (D. Chegada)
					</th>
					
					<th>
						Origem (D. Saída)
					</th>
					
					<th>
						Km origem
					</th>
					
					<th>
						Destino
					</th>
					
					<th>
						Destino (D. Chegada)
					</th>
					
					<th>
						Destino (D. Saída)
					</th>
					
					<th>
						Km destino
					</th>
					
					<th>
						Diárias do percurso
					</th>
					
					<th>
						Diárias pós percurso
					</th>
					
					<th>
						km percorrido
					</th>
					
					<th>
						CTE
					</th>
					
					<th>
						NF
					</th>
					
					<th>
						AET
					</th>
					
					<th>
						Valor
					</th>
					
					<th>
						Transit-time
					</th>
					
					<th>
						Km da rota
					</th>
				</tr>
			</thead>
			<tbody class="tbodyDadosPessoais" >
		';
		
		while($row = $osValues->fetch_array()){
			
			$veiculo = buscarFrota($row[14]);
			$numPlaca = empty($veiculo) ? [0,"Selecione uma frota"] : $veiculo->fetch_array();
			
			$dateODC = $row[4] != NULL && $row[4] != '0000-00-00' ? date('d-m-Y', strtotime($row[4])) : "";
			$dateODS = $row[5] != NULL && $row[5] != '0000-00-00' ? date('d-m-Y', strtotime($row[5])) : "";
			$dateDDC = $row[2] != NULL && $row[2] != '0000-00-00' ? date('d-m-Y', strtotime($row[2])) : "";
			$dateDDS = $row[3] != NULL && $row[3] != '0000-00-00' ? date('d-m-Y', strtotime($row[3])) : "";
			
			$km_total = ((int)$row[12] - (int)$row[11])." KM"; //Add diferença mais final
			
			$preco = 0;
			$kmPrec = 0;
			$transit_time = 0;
			$precValues = buscarPrecificaoOS($row[15], $row[16], $row[26]);
			
			if(mysqli_num_rows($precValues)>0){
				while($rowPrec = $precValues->fetch_array()){
					if($rowPrec[9] == $row[26]){
						$preco = $rowPrec[3];
						$kmPrec = $rowPrec[2];
						$transit_time = $rowPrec[4];
					}
				}
			}
			
			$textoPush = $textoPush.
			'
				<tr id="'.$row[1].'" >
					<td>
						<input id="input_os_num-'.$row[1].'" class="input_os_num" style="text-align:center;" type="text" value="'.$row[1].'" disabled>
					</td>
				
					<td>
						'.inserirEmpresas($row[27],$row[1]).'
					</td>
					
					<td>
						'.inserirFrota($row[14],$row[1]).'
					</td>
					
					<td>
						<input id="input_placa-'.$row[1].'" class="input_os_num" style="text-align:center;" type="text" value="'.$numPlaca[1].'" disabled>
					</td>
					
					<td>
						'.inserirBatedor($row[17],$row[1]).'
					</td>
					
					<td>
						'.inserirCliente($row[26],$row[1]).'
					</td>
					
					<td>
						'.inserirCarga($row[28],$row[1]).'
					</td>
					
					<td>
						'.inserirExecucoes($row[13],$row[1]).'
					</td>
					
					<td>
						<input id="input_conjunto-'.$row[1].'" class="input_conjunto" style="text-align:center;" type="text" value="'.$row[22].'" >
					</td>
					
					<td>
						<input id="input_motorista_conjunto-'.$row[1].'" class="input_motorista_conjunto" style="text-align:center;" type="text" value="'.$row[23].'" >
					</td>
					
					<td>
						'.inserirLocais($row[15],$row[1]).'
					</td>
					
					<td>
						<input id="input_dorigem_d_c-'.$row[1].'" class="input_dorigem_d_c date" required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" style="text-align:center;" for="date"type="text" value="'.$dateODC.'" >
					</td>
					
					<td>
						<input id="input_dorigem_d_s-'.$row[1].'" class="input_dorigem_d_s date" required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" style="text-align:center;" for="date" type="text" value="'.$dateODS.'" >
					</td>
					
					<td>
						<input id="input_km_origem-'.$row[1].'" class="input_km_origem" style="text-align:center;" type="text" value="'.$row[11].'" >
					</td>
					
					<td>
						'.inserirLocais($row[16],$row[1]).'
					</td>
					
					<td>
						<input id="input_destino_d_c-'.$row[1].'" class="input_destino_d_c date" required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" style="text-align:center;" for="date" type="text" value="'.$dateDDC.'" >
					</td>
					
					<td>
						<input id="input_destino_d_s-'.$row[1].'" class="input_destino_d_s date" required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" style="text-align:center;" for="date" type="text" value="'.$dateDDS.'" >
					</td>
					
					<td>
						<input id="input_km_destino-'.$row[1].'" class="input_km_destino" style="text-align:center;" type="text" value="'.$row[12].'" >
					</td>
					
					<td>
						<input id="input_diarias_percurso-'.$row[1].'" class="input_diarias_percurso" style="text-align:center;" type="text" value="'.$row[6].'" >
					</td>
					
					<td>
						<input id="input_diarias_pos_percurso-'.$row[1].'" class="input_diarias_pos_percurso" style="text-align:center;" type="text" value="'.$row[7].'" >
					</td>
					
					<td>
						<input id="input_km_total-'.$row[1].'" class="input_km_total" style="text-align:center;" type="text" value="'.$km_total.'" disabled>
					</td>
					
					<td>
						<input id="input_cte-'.$row[1].'" class="input_cte" style="text-align:center;" type="text" value="'.$row[19].'" >
					</td>
					
					<td>
						<input id="input_nf-'.$row[1].'" class="input_nf" style="text-align:center;" type="text" value="'.$row[24].'" >
					</td>
					
					<td>
						<input id="input_aet-'.$row[1].'" class="input_aet" style="text-align:center;" type="text" value="'.$row[25].'" >
					</td>
					
					<td>
						<input id="input_valor-'.$row[1].'" class="input_aet" style="text-align:center;" type="text" value="'.$preco.'" >
					</td>
					
					<td>
						<input id="input_tt-'.$row[1].'" class="input_aet" style="text-align:center;" type="text" value="'.$transit_time.'" >
					</td>
					
					<td>
						<input id="input_km_precificacao-'.$row[1].'" class="input_aet" style="text-align:center;" type="text" value="'.$kmPrec.'" >
					</td>
				</tr>
		
			';
		}
		$textoPush = $textoPush.'
			</tbody>	
		';
		
		return $textoPush;
	}
		
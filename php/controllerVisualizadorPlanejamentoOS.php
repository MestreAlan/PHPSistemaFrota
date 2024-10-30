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
			if($empresa[1] != "Autônomo"){
				if($empresa[0]==$id){
					//return $empresa[1];
					$selectOptions = $selectOptions.'<option value="'.$empresa[0].'" selected>'.$empresa[1].'</option>';
				}else{
					$selectOptions = $selectOptions.'<option value="'.$empresa[0].'">'.$empresa[1].'</option>';
				}
			}
		}
		
		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}
	
	function inserirCliente($id, $diferenciador){
		$listaEmpresas = listarClientes();
		
		$selectOptions = '<select id="input_cliente-'.$diferenciador.'" name="empresa" class="input_cliente" required>';
		$selectOptions = $selectOptions.'<option value="" selected></option>';
		
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
				$selectOptions = $selectOptions.'<option placa="'.$veiculo[1].'" value="'.$veiculo[0].'" selected>'.$veiculo[12].'</option>';
			}else{
				$selectOptions = $selectOptions.'<option placa="'.$veiculo[1].'" value="'.$veiculo[0].'">'.$veiculo[12].'</option>';
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

	function inserirLocais($id, $diferenciador, $local){
		$listaLocais = listarLocais();
		
		$selectOptions = '<select id="input_local-'.$local.'-'.$diferenciador.'" name="empresa" class="input_local" required>';
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
		$selectOptions = $selectOptions.'<option value="" selected></option>';
		
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

	function listarPlanejarOS(){
		$osValues = listarOSPS();
		
		$textoPush = 
			'
			<!--<p \><p \><button type="button" id="addOS" class="btn btn-primary addOS">Adicionar nova OS vinculada</button>-->
			
			'.($_SESSION['perfil_logado'] == '1' ? '<p \><p \><button type="button" id="criarOS" class="btn btn-primary criarOS">Salvar nova OS</button>' : '').'
			
			<div class="tabelaMF">
				<table class="table_format_filter monitorarFrota table table-striped">
					<thead>
						<tr>
							<th>
								Contrato
							</th>
						
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
							
							<th style="display:none;">
								Destino (D. Chegada)
							</th>
							
							<th style="display:none;">
								Destino (D. Saída)
							</th>
							
							<th style="display:none;"
								Km destino
							</th>
							
							<th>
								Diárias
							</th>
							
							<!--<th>
								Diárias pós percurso
							</th>-->
							
							<th style="display:none;">
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
						</tr>
					</thead>
		';
		
		$num_os_geral = buscarOSporDataLimitada();
		$num_os_row = mysqli_num_rows($num_os_geral)>0 ? $num_os_geral->fetch_array() : ["0000-".date("n")."-".date("y")];
		$dataPartes = explode("-",(string)$num_os_row[0]);
		$verificador = date("n") != $dataPartes[1] || date("y") != $dataPartes[2] ? 1 : 0;
		if($verificador==1){
			$dataPartes[0] = "0000";
			$dataPartes[1] = date("n");
			$dataPartes[2] = date("y");
		}
		$os_final = (int)$dataPartes[0] + 1 ."-".$dataPartes[1]."-".$dataPartes[2];
		
		$row = [0,$os_final,"", "", "", "", "", "", "",  "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""];
		
		$veiculo = buscarFrota($row[14]);
		$numPlaca = mysqli_num_rows($veiculo)==0 ? [0,"Selecione uma frota"] : $veiculo->fetch_array();
		
		$dateODC = $row[4] != NULL && $row[4] != '0000-00-00' ? date('d-m-Y', strtotime($row[4])) : "";
		$dateODS = $row[5] != NULL && $row[5] != '0000-00-00' ? date('d-m-Y', strtotime($row[5])) : "";
		$dateDDC = $row[2] != NULL && $row[2] != '0000-00-00' ? date('d-m-Y', strtotime($row[2])) : "";
		$dateDDS = $row[3] != NULL && $row[3] != '0000-00-00' ? date('d-m-Y', strtotime($row[3])) : "";
		$km_total = ((int)$row[12] - (int)$row[11])." KM"; //Add diferença mais final
		
		$textoPush = $textoPush.
					'
					<tbody class="tbodyDadosPessoais" >
						<tr id="'.$row[1].'" >
							<td>
								<input type="checkbox" id="checkedValue">
							</td>
							
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
								<input id="input_placa-'.$row[1].'" class="input_placa" style="text-align:center;" type="text" value="'.$numPlaca[1].'" disabled>
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
								'.inserirLocais($row[15],$row[1],'o').'
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
								'.inserirLocais($row[16],$row[1],'d').'
							</td>
							
							<td style="display:none;" >
								<input id="input_destino_d_c-'.$row[1].'" class="input_destino_d_c date" required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" style="text-align:center;" for="date" type="text" value="'.$dateDDC.'" >
							</td>
							
							<td style="display:none;">
								<input id="input_destino_d_s-'.$row[1].'" class="input_destino_d_s date" required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" style="text-align:center;" for="date" type="text" value="'.$dateDDS.'" >
							</td>
							
							<td style="display:none;">
								<input id="input_km_destino-'.$row[1].'" class="input_km_destino" style="text-align:center;" type="text" value="'.$row[12].'" >
							</td>
							
							<td>
								<input id="input_diarias_percurso-'.$row[1].'" class="input_diarias_percurso" style="text-align:center;" type="text" value="'.$row[6].'" >
							</td>
							
							<!--<td>
								<input id="input_diarias_pos_percurso-'.$row[1].'" class="input_diarias_pos_percurso" style="text-align:center;" type="text" value="'.$row[7].'" >
							</td>-->
							
							<td style="display:none;">
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
						</tr>
					</table>
				</div>
		';
		
		return $textoPush;
	}
	
	
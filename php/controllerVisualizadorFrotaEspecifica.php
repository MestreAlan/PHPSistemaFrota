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
	
	function inserirEmpresas($id){
		$listaEmpresas = listarEmpresas();
		
		$empresaBack = vincularEmpresa([0]);

		$selectOptions = '<select id="dadosProfissionaisEmpresa'.$id.'" empresa_atual="'.$id.'" name="empresa" class="empresaNome" required>';
		$selectOptions = $selectOptions.'<option value="" disabled selected>Selecione uma opção</option>';
		while($empresa = $listaEmpresas->fetch_row()){
			if($empresa[1] != "Autônomo"){
				if($empresa[0]==$empresaBack[0]){
					$selectOptions = $selectOptions.'<option value="'.$empresa[0].'" selected>'.$empresa[1].'</option>';
				}else{
					$selectOptions = $selectOptions.'<option value="'.$empresa[0].'">'.$empresa[1].'</option>';
				}
			}
		}

		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}
	
	function inserirFuncoes($id){
		$listaFuncoes = listarTiposVeiculos();

		$selectOptions = '<select id="dadosVeiculosEmpresa'.$id.'" funcao_atual="'.$id.'" name="funcao" class="funcaoNome" required>';
		$selectOptions = $selectOptions.'<option value="" disabled selected>Selecione uma opção</option>';
		while($funcao = $listaFuncoes->fetch_row()){
			if($funcao[0]==$id){
				$selectOptions = $selectOptions.'<option value="'.$funcao[0].'" selected>'.$funcao[1].'</option>';
			}else{
				$selectOptions = $selectOptions.'<option value="'.$funcao[0].'">'.$funcao[1].'</option>';
			}
		}

		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}
	
	function vincularEmpresa($retornoEsperado){
		$empresaResult = buscarEmpresasFrota($_SESSION['idFrota']);
		
		return mysqli_num_rows($empresaResult)>0 ? mysqli_fetch_array($empresaResult) : $retornoEsperado;
	}
	
	function chamarListarDadosFrota(){
		$listaFrota = listarFrotaCompleto();
		
		$textoPush = '';
		
		$vetorFrota = array();
		if(mysqli_num_rows($listaFrota)>0 && $_SESSION['idFrota']!=0){
			while($row = $listaFrota->fetch_row()) {
				array_push($vetorFrota, $row);
			}
		}else{
			array_push($vetorFrota, [0,"","","","","","","","","","","","","","","","",0,0,0,"","",""]);
		}
		
		foreach ($vetorFrota as $row){
			
			$empresaSelec = inserirEmpresas($row[17]);
			
			$funcoesSelec = inserirFuncoes($row[18]);
			
			if($_SESSION['idFrota']==$row[0] || 0==$_SESSION['idFrota']){
				
				$dateConvert1 = $row[21] != NULL && $row[21] != '0000-00-00' ? date('d/m/Y', strtotime($row[21])) : "";
				
				$dateConvert2 = $row[22] != NULL && $row[22] != '0000-00-00' ? date('d/m/Y', strtotime($row[22])) : "";
				
				$textoPush = $textoPush.  
					'<thead>
						<tr>
							<th scope="col">Dados da frota</th>
						</tr>
						
					</thead>
					<tbody class="tbodyDadosFrota" >
						<tr>
							<td>
								<div class="container">
									<div class="row">
										<div class="inputbox col-xs col-sm col-md col-lg col-xl">
											<input onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-z0-9]{3}[\-]{1}[A-Za-z0-9]{4}" class="placa" id="dadosFrotaPlaca" style="text-align:center;" type="text" dados_frota_placa_original="'.$row[1].'" value="'.$row[1].'">
											<span>Placa (*):  </span>
										</div>
									
										<div class="inputbox col-xs col-sm col-md col-lg col-xl">
											<input onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-z0-9]{17}" class="chassi" id="dadosFrotaChassi" style="text-align:center;" type="text" dados_frota_chassi_original="'.$row[2].'" value="'.$row[2].'">
											<span>Chassi:  </span>
										</div>
									
										<div class="inputbox col-xs col-sm col-md col-lg col-xl">
											<input onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-z0-9\-]{8,12}" class="renavan" id="dadosFrotaRenavan" style="text-align:center;" type="text" dados_frota_renavan_original="'.$row[3].'" value="'.$row[3].'">
											<span>Renavan (*):  </span>
										</div>
									</div>
									
									<div class="row">
										<div class="inputbox col-xs col-sm col-md col-lg col-xl">
											<input onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{4}" class="modelo" id="dadosFrotaModelo" style="text-align:center;" type="text" dados_frota_modelo_original="'.$row[4].'" value="'.$row[4].'">
											<span>Ano do Modelo:  </span>
										</div>
									
										<div class="inputbox col-xs col-sm col-md col-lg col-xl">
											<input onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-z]{3}[A-Za-z0-9\s]{0,17}" class="cor" id="dadosFrotaCor" style="text-align:center;" type="text" dados_frota_cor_original="'.$row[5].'" value="'.$row[5].'">
											<span>Cor:  </span>
										</div>
										
										<div class="inputbox col-xs col-sm col-md col-lg col-xl">
											<input onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-z0-9]{1}[A-Za-z0-9\s\.]{0,19}" class="veiculo" id="dadosFrotaVeiculo" style="text-align:center;" type="text" dados_frota_veiculo_original="'.$row[6].'" value="'.$row[6].'">
											<span>Veículo:  </span>
										</div>
									</div>
									
									<div class="row">
										<div class="inputbox col-xs col-sm col-md col-lg col-xl">
											<input onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-z0-9]{1}[A-Za-z0-9\s\.]{0,19}" class="fabricante" id="dadosFrotaFabricante" style="text-align:center;" type="text" dados_frota_fabricante_original="'.$row[7].'" value="'.$row[7].'">
											<span>Fabricante:  </span>
										</div>
									
										<div class="inputbox col-xs col-sm col-md col-lg col-xl">
											<input onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-z0-9\s\.]{0,19}" class="categoria" id="dadosFrotaCategoria" style="text-align:center;" type="text" dados_frota_categoria_original="'.$row[8].'" value="'.$row[8].'">
											<span>Categoria:  </span>
										</div>
										
										<div class="inputbox col-xs col-sm col-md col-lg col-xl">
											<input onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-z0-9]{1}[A-Za-z0-9\s\.]{4,44}" class="tipo" id="dadosFrotaTipo" style="text-align:center;" type="text" dados_frota_tipo_original="'.$row[9].'" value="'.$row[9].'">
											<span>Tipo de veículo:  </span>
										</div>
									</div>
									
									<div class="row">
										<div class="inputbox col-xs col-sm col-md col-lg col-xl">
											<input onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-z]{3}[A-Za-z0-9\s\.\\\/\-]{0,17}" class="combustivel" id="dadosFrotaCombustivel" style="text-align:center;" type="text" dados_frota_combustivel_original="'.$row[10].'" value="'.$row[10].'">
											<span>Tipo de combustivel:  </span>
										</div>
									
										<div class="inputbox col-xs col-sm col-md col-lg col-xl">
											<input onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{4}" class="ano" id="dadosFrotaAno" style="text-align:center;" type="text" dados_frota_ano_original="'.$row[11].'" value="'.$row[11].'">
											<span>Ano:  </span>
										</div>
									
										<div class="inputbox col-xs col-sm col-md col-lg col-xl">
											<input onchange="this.setAttribute(\'value\', this.value);"  required pattern="[a-zA-Z]{2}[\-]{1}[0-9]{3}" class="frota" id="dadosFrotaFrota" style="text-align:center;" type="text" dados_frota_frota_original="'.$row[12].'" value="'.$row[12].'">
											<span>Frota:  </span>
										</div>
									</div>
									
									<div class="row">
										<div class="inputbox col-xs col-sm col-md col-lg col-xl">
											<input onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{5,25}" class="imei" id="dadosFrotaImei" style="text-align:center;" type="text" dados_frota_imei_original="'.$row[13].'" value="'.$row[13].'">
											<span>IMEI:  </span>
										</div>
									
										<div class="inputbox col-xs col-sm col-md col-lg col-xl">
											'.$empresaSelec.'
											<span>Empresa (*):  </span>
										</div>
									
										<div class="inputbox col-xs col-sm col-md col-lg col-xl">
											'.$funcoesSelec.'
											<span>Função (*):  </span>
										</div>
									</div>
									
									<div class="row">
										<div class="inputbox col-xs col-sm col-md col-lg col-xl">
											<input onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{5}.[0-9]{6}/[0-9]{4}-[0-9]{2}" class="credencial" id="dadosFrotaCredencial" style="text-align:center;" type="text" dados_frota_credencial_original="'.$row[20].'" value="'.$row[20].'">
											<span>Credencial (*): </span>
										</div>
									
										<div class="inputbox col-xs col-sm col-md col-lg col-xl">
											<input onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" class="data expedicao" id="dadosFrotaExpedicao" style="text-align:center;" type="text" dados_frota_expedicao_original="'.$dateConvert1.'" value="'.$dateConvert1.'">
											<span>Data de expedição (*): </span>
										</div>
									
										<div class="inputbox col-xs col-sm col-md col-lg col-xl">
											<input onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" class="data validade" id="dadosFrotaValidade" style="text-align:center;" type="text" dados_frota_validade_original="'.$dateConvert2.'" value="'.$dateConvert2.'">
											<span>Data de validade (*): </span>
										</div>
									</div>
									
								</div>
								
							</td>
						</tr>
						<tr>
							<td>
								<button id="dadosFrota-'.$row[0].'" id_conctrole="'.$row[0].'" type="button" class="btn btn-primary btnSalvarDadosFrota">Salvar</button>
							</td>
						</tr>
					</tbody>'
				;
			}										
		}
		
		return $textoPush;
	}
	
	function chamarListarDocumentos(){
		
		$textoPush = '
			<thead>
				<tr>
					<th scope="col">Documentos</th>
				</tr>
			</thead>		
			'
		;
		
		return $textoPush;
	}

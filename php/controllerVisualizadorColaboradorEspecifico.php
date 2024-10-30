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
	
	function inserirImg(){
		$imgInfo = buscarArquivosPessoa($_SESSION['idDadosPessoais'],1);
		if(mysqli_num_rows($imgInfo)>0){
			$row = $imgInfo->fetch_row();
			return '<img src="'.$row[1].'" src_original="'.$row[1].'" alt="Selecione uma imagem" class="img_pessoa_photo" id="img_pessoa_photo" />';
		}else{
			return '<img src="img/avatar.png" src_original="img/avatar.png" alt="Selecione uma imagem" class="img_pessoa_photo" id="img_pessoa_photo" />';
		}
	}
	
	function inserirEstadosCivis($verificador){
		$listaEstadosCivis = listarEstadosCivis();
		
		$idEstadosRetornado = buscarIdEstadoCivil($verificador);
		$idFinal = "";
		if(mysqli_num_rows($idEstadosRetornado)>0){
			$idEstados = $idEstadosRetornado->fetch_row();
			$idFinal = $idEstados[0];
		}
		
		$selectOptions = '<select id="estadoCivil" estado_civil_original="'.$idFinal.'" class="estadoCivil" name="estadoCivil" required>';
		$selectOptions = $selectOptions.'<option verificador="" value="" disabled selected>Selecione uma opção</option>';
		while($estadosCivis = $listaEstadosCivis->fetch_row()){
			if($estadosCivis[1]==$verificador){
				$selectOptions = $selectOptions.'<option value="'.$estadosCivis[0].'" selected>'.$estadosCivis[1].'</option>';
			}else{
				$selectOptions = $selectOptions.'<option value="'.$estadosCivis[0].'">'.$estadosCivis[1].'</option>';
			}
		}
		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}
	
	function inserirSexos($verificador){
		$listaSexos = listarSexos();
		
		$idSexoRetornado = buscarIdSexo($verificador);
		$idFinal = "";
		if(mysqli_num_rows($idSexoRetornado)>0){
			$idSexo = $idSexoRetornado->fetch_row();
			$idFinal = $idSexo[0];
		}
		
		$selectOptions = '<select id="sexo" sexo_original="'.$idFinal.'" class="sexo" name="sexo" required>';
		$selectOptions = $selectOptions.'<option verificador="" value="" disabled selected>Selecione uma opção</option>';
		while($sexo = $listaSexos->fetch_row()){
			if($sexo[1]==$verificador){
				$selectOptions = $selectOptions.'<option value="'.$sexo[0].'" selected>'.$sexo[1].'</option>';
			}else{
				$selectOptions = $selectOptions.'<option value="'.$sexo[0].'">'.$sexo[1].'</option>';
			}
		}
		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}
	
	function inserirTipoSanguineo($verificador){
		$listaTiposSanguineo = listarTiposSanguineos();
		
		$idTipoSanguineoRetornado = buscarIdTipoSanguineo($verificador);
		$idFinal = "";
		if(mysqli_num_rows($idTipoSanguineoRetornado)>0){
			$idTipoSanguineo = $idTipoSanguineoRetornado->fetch_row();
			$idFinal = $idTipoSanguineo[0];
		}
		
		$selectOptions = '<select id="fatorRH" fatorRH_original="'.$idFinal.'" class="fatorRH" name="fatorRH" required>';
		$selectOptions = $selectOptions.'<option verificador="" value="" disabled selected>Sel.</option>';
		while($tiposSanguineo = $listaTiposSanguineo->fetch_row()){
			if($tiposSanguineo[1]==$verificador){
				$selectOptions = $selectOptions.'<option value="'.$tiposSanguineo[0].'" selected>'.$tiposSanguineo[1].'</option>';
			}else{
				$selectOptions = $selectOptions.'<option value="'.$tiposSanguineo[0].'">'.$tiposSanguineo[1].'</option>';
			}
		}
		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}

	function inserirEscolaridade($verificador){
		$listaEscolaridade = listarEscolaridade();
		
		$idEscolaridadeRetornado = buscarIdEscolaridade($verificador);
		$idFinal = "";
		if(mysqli_num_rows($idEscolaridadeRetornado)>0){
			$idEscolaridade = $idEscolaridadeRetornado->fetch_row();
			$idFinal = $idEscolaridade[0];	
		}
		
		$selectOptions = '<select id="escolaridade" escolaridade_orignal="'.$idFinal.'" class="escolaridade" name="escolaridade" required>';

		$selectOptions = $selectOptions.'<option verificador="" value="" disabled selected>Selecione uma opção</option>';

		while($escolaridade = $listaEscolaridade->fetch_row()){
			if($escolaridade[1]==$verificador){
				$selectOptions = $selectOptions.'<option value="'.$escolaridade[0].'" selected>'.$escolaridade[1].'</option>';
			}else{
				$selectOptions = $selectOptions.'<option value="'.$escolaridade[0].'">'.$escolaridade[1].'</option>';
			}
		}
		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}
	
	function inserirCategoriaCNH($verificador){
		$listarCNHCategorias = listarCNHCategorias();
		
		$idCNHCategoriaRetornado = buscarIdCNHCategoria($verificador);
		$idFinal = "";
		if(mysqli_num_rows($idCNHCategoriaRetornado)>0){
			$idCNHCategoria = $idCNHCategoriaRetornado->fetch_row();
			$idFinal = $idCNHCategoria[0];
		}
		
		$selectOptions = '<select id="categoriaCNH" categoriaCNH_original="'.$idFinal.'" class="categoriaCNH" name="categoriaCNH" required>';

		$selectOptions = $selectOptions.'<option verificador="" value="" disabled selected>Sel.</option>';

		while($CNHCategorias = $listarCNHCategorias->fetch_row()){
			if($CNHCategorias[1]==$verificador){
				$selectOptions = $selectOptions.'<option value="'.$CNHCategorias[0].'" selected>'.$CNHCategorias[1].'</option>';
			}else{
				$selectOptions = $selectOptions.'<option value="'.$CNHCategorias[0].'">'.$CNHCategorias[1].'</option>';
			}
		}
		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}

	function inserirEstados($verificador,$diferenciador){
		$listaEstados = listarEstados();
	
		$idEstadosRetornado = buscarIdEstado($verificador);
		$idFinal = "";
		if(mysqli_num_rows($idEstadosRetornado)>0){
			$idEstados = $idEstadosRetornado->fetch_row();
			$idFinal = $idEstados[0];
		}
		
		$selectOptions = '<select id="estadosBrasil'.$diferenciador.'" estados_original="'.$idFinal.'" class="estados" name="estados-brasil" required>';

		$selectOptions = $selectOptions.'<option verificador="" value="" disabled selected>Sel.</option>';

		while($estado = $listaEstados->fetch_row()){
			if($estado[1]==$verificador){
				$selectOptions = $selectOptions.'<option verificador="'.$estado[0].'" value="'.$estado[2].'" selected>'.$estado[2].'</option>';
			}else{
				$selectOptions = $selectOptions.'<option verificador="'.$estado[0].'" value="'.$estado[2].'">'.$estado[2].'</option>';
			}
		}
		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}

	function inserirCargos($verificador){
		$listaCargos = listarCargos();
		
		$selectOptions = '<select id="cargos" cargo_atual="'.$verificador.'" name="cargos" required>';
		$selectOptions = $selectOptions.'<option value="" disabled selected>Selecione uma opção</option>';
		while($cargos = $listaCargos->fetch_row()){
			if($cargos[0]==$verificador){
				$selectOptions = $selectOptions.'<option value="'.$cargos[0].'" selected>'.$cargos[1].'</option>';
			}else{
				if($cargos[1]!='Administrador'){
					$selectOptions = $selectOptions.'<option value="'.$cargos[0].'">'.$cargos[1].'</option>';
				}
			}
		}
		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
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
	
	function inserirCNPJ($id){
		$listaEmpresas = listarEmpresas();
		
		$empresaBack = vincularEmpresa([0]);

		$selectOptions = '<select id="dadosProfissionaisCNPJ'.$id.'" cnpj_atual="'.$id.'" name="empresa">';
		$selectOptions = $selectOptions.'<option value="" disabled selected></option>';
		while($empresa = $listaEmpresas->fetch_row()){
			if($empresa[0]==$empresaBack[0]){
				$selectOptions = $selectOptions.'<option value="'.$empresa[0].'" selected>'.$empresa[3].'</option>';
			}else{
				$selectOptions = $selectOptions.'<option value="'.$empresa[0].'">'.$empresa[3].'</option>';
			}
		}

		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}
	
	function inserirTipoContato($id, $idTipoContato){
		$listarTiposContatos = listarTiposContatos();

		$selectOptions = '<select id="tipoContato'.$id.'" class="tipoContato" name="contato">';
		$selectOptions = $selectOptions.'<option value="" disabled selected>Selecione uma opção</option>';
		while($tipoContato = $listarTiposContatos->fetch_row()){
			if($tipoContato[0]==$idTipoContato){
				$selectOptions = $selectOptions.'<option value="'.$tipoContato[0].'" selected>'.$tipoContato[1].'</option>';
			}else{
				$selectOptions = $selectOptions.'<option value="'.$tipoContato[0].'">'.$tipoContato[1].'</option>';
			}
		}

		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}
	
	function inserirTipoDependente($id, $diferenciador){
		$listarTiposDependentes = listarTiposDependentes();

		$selectOptions = '<select class="dependente_select" dependenteTipo="'.$diferenciador.'" dependente_tipo_atual="'.$id.'" id="tipoDependente'.$id.'" name="dependente">';
		$selectOptions = $selectOptions.'<option value="" disabled selected>Selecione uma opção</option>';
		while($tipoDependente = $listarTiposDependentes->fetch_row()){
			if($tipoDependente[0]==$diferenciador){
				$selectOptions = $selectOptions.'<option value="'.$tipoDependente[0].'" selected>'.$tipoDependente[1].'</option>';
			}else{
				$selectOptions = $selectOptions.'<option value="'.$tipoDependente[0].'">'.$tipoDependente[1].'</option>';
			}
		}

		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}
	
	function inserirTipoContaBanco($id, $diferenciador){
		$listarTiposContasBancos = listarTiposContasBancos();

		$selectOptions = '<select tipoContaBanco_atual="'.$diferenciador.'" id="tipoContaBanco'.$id.'" name="dependente">';
		$selectOptions = $selectOptions.'<option value="" disabled selected>Selecione uma opção</option>';
		while($tipoContaBanco = $listarTiposContasBancos->fetch_row()){
			if($tipoContaBanco[0]==$diferenciador){
				$selectOptions = $selectOptions.'<option value="'.$tipoContaBanco[0].'" selected>'.$tipoContaBanco[1].'</option>';
			}else{
				$selectOptions = $selectOptions.'<option value="'.$tipoContaBanco[0].'">'.$tipoContaBanco[1].'</option>';
			}
		}

		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}

	function inserirCargosJornada(){
		$listarCargosJornada = listarCargosJornada();
		
		$selectOptions = '<select id="cargo_jornada" name="cargo_jornada">';
		$selectOptions = $selectOptions.'<option id="cargo_jornada-0" h_semanal="" h_mensal="" m_h_extra="" domi="0" segu="0" terc="0" quar="0" quin="0" sext="0" saba="0" value="0" selected>Escolha uma opções</option>';
		while($tipoCargoJornada = $listarCargosJornada->fetch_row()){
			$selectOptions = $selectOptions.'<option id="cargo_jornada-'.$tipoCargoJornada[0].'" h_semanal="'.$tipoCargoJornada[1].'" h_mensal="'.$tipoCargoJornada[2].'" m_h_extra="'.$tipoCargoJornada[3].'" domi="'.$tipoCargoJornada[4].'" segu="'.$tipoCargoJornada[5].'" terc="'.$tipoCargoJornada[6].'" quar="'.$tipoCargoJornada[7].'" quin="'.$tipoCargoJornada[8].'" sext="'.$tipoCargoJornada[9].'" saba="'.$tipoCargoJornada[10].'" value="'.$tipoCargoJornada[0].'">'.$tipoCargoJornada[11].'</option>';
		}

		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}

	function inserirCargosSalario(){
		$listarCargosSalario = listarCargosSalario();
		
		$selectOptions = '<select id="cargo_salario" name="cargo_salario">';
		$selectOptions = $selectOptions.'<option id="cargo_salario-0" salario_base="0" nome="" value="0" selected>Escolha uma opções</option>';
		while($tipoCargoSalario = $listarCargosSalario->fetch_row()){
			$selectOptions = $selectOptions.'<option id="cargo_salario-'.$tipoCargoSalario[0].'" salario_base="'.$tipoCargoSalario[2].'" nome="'.$tipoCargoSalario[1].'" value="'.$tipoCargoSalario[2].'">'.$tipoCargoSalario[1].'</option>';
		}

		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}
	
	function vincularEmpresa($retornoEsperado){
		$empresaResult = buscarEmpresas($_SESSION['idDadosPessoais']);
		
		return mysqli_num_rows($empresaResult)>0 ? mysqli_fetch_array($empresaResult) : $retornoEsperado;
	}

	function chamarListarDadosPessoais(){
		$listaDadosPessoais = listaDadosPessoais();

		$imgSelecionada = inserirImg();
		
		$textoPush = '';
		
		$vetorDadosPessoais = array();
		if(mysqli_num_rows($listaDadosPessoais)>0){
			while($row = $listaDadosPessoais->fetch_row()) {
				array_push($vetorDadosPessoais, $row);
			}
		}else{
			array_push($vetorDadosPessoais, [0,"","","","","","","","","","","","","","","","","","","","","","","","","","","","",""]);
		}
		
		foreach ($vetorDadosPessoais as $row){
			
			if($_SESSION['idDadosPessoais']==$row[0]){
				
				$selectOptions = inserirEstados($row[4],0);
				
				$selectOptions1 = inserirEstados($row[15],2);
				
				$selectOptions2 = inserirEstados($row[21],3);
				
				$dateConvert1 = $row[5] != NULL && $row[5] != '0000-00-00' ? date('d/m/Y', strtotime($row[5])) : "";
				
				$dateConvert2 = $row[7] != NULL && $row[7] != '0000-00-00' ? date('d/m/Y', strtotime($row[7])) : "";

				$dateConvert3 = $row[19] != NULL && $row[19] != '0000-00-00' ? date('d/m/Y', strtotime($row[19])) : "";
				
				$dateConvert4 = $row[24] != NULL && $row[24] != '0000-00-00' ? date('d/m/Y', strtotime($row[24])) : "";

				$dateConvert5 = $row[29] != NULL && $row[29] != '0000-00-00' ? date('d/m/Y', strtotime($row[29])) : "";
				
				$sexos = inserirSexos($row[10]);
				
				$tiposSanguineos = inserirTipoSanguineo($row[11]);
				
				$estadosCivis = inserirEstadosCivis($row[12]);

				$escolaridade = inserirEscolaridade($row[13]);

				$categoriaCNH = inserirCategoriaCNH($row[23]);
				
				$textoPush = $textoPush.  
					'<thead>
						<tr>
							<td>
								<button id="dadosPessoais-'.$row[0].'" id_conctrole="'.$row[0].'" type="button" class="btn btn-primary btnSalvarDadosPessoais">Salvar dados pessoais</button>
								<label id="labelDadosPessoais"></label>
							</td>
						</tr>
						
					</thead>
					<tbody class="tbodyDadosPessoais" >
						<tr>
							<td>
								<div class="container">
									<div class="row">
										<div class="col-sm">
											<div class="max_img_width">
												<div class="img_pessoa_container">
													'.inserirImg().'
												</div>
											</div>
											
											<input id="uploadImagePessoa" type="file" accept="image/*" name="imagePessoa" />
										</div>
									</div>
									<div class="row">
										<div class="inputbox col-xs-7 col-sm-7 col-md-7 col-lg-7 col-xl-7">
											<input onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]{2,79}" class="texto" id="dadosPessoaisNome"  type="text" dados_pessoais_nome_original="'.$row[1].'" value="'.$row[1].'">
											<span>Nome (*):</span>
										</div>
										
										<div class="inputbox col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
											<input id="dadosPessoaisNascimento" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}"  for="date" class="date" type="text" dados_pessoais_nascimento_original="'.$dateConvert2.'" value="'.$dateConvert2.'">
											<span>Data de nascimento (*):  </span>
										</div>
										
										<div class="inputbox col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
											<input id="dadosPessoaisIdade" style="text-align:center;" type="text" value="">
											<span>Idade:  </span>
										</div>
									</div>
									<div class="row">
										<div class="inputbox col-sm">
											<input id="dadosPessoaisMae" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]{2,99}" class="texto"  type="text" dados_pessoais_mae_original="'.$row[8].'" value="'.$row[8].'">
											<span>Nome da mãe (*):  </span>
										</div>
										
										<div class="inputbox col-sm">	
											<input id="dadosPessoaisPai" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]{2,99}" class="texto"  type="text" dados_pessoais_pai_original="'.$row[9].'" value="'.$row[9].'">
											<span>Nome do pai:  </span>
										</div>
									</div>
									<div class="row">
										<div class="inputbox col-sm">	
											<input id="dadosPessoaisNaturalidade" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]{2,99}" class="texto"  type="text" dados_pessoais_naturalidade_original="'.$row[14].'" value="'.$row[14].'">
											<span>Naturalidade:  </span>
										</div>
										
										<div class="inputbox col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
											'.$selectOptions1.'
											<span>UF:  </span>
										</div>
										
										<div class="inputbox col-sm">
											'.$sexos.'
											<span>Sexo:  </span>
										</div>
										
										<div class="inputbox col-sm">
											'.$escolaridade.'
											<span>Escolaridade:  </span>
										</div>

										<div class="inputbox col-sm">
											'.$estadosCivis.'
											<span>Estado civil:  </span>
										</div>
									</div>
									<div class="row" id="dadosConjuje">
										<div class="inputbox col-sm">
											<input id="dadosPessoaisNomeConjuje" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]{2,79}" class="texto"  type="text" dados_pessoais_nome_conjuje_original="'.$row[27].'" value="'.$row[27].'">
											<span>Companheiro(a): Nome (*):  </span>
										</div>

										<div class="inputbox col-sm">	
											<input id="dadosPessoaisCPFConjuje" onchange="this.setAttribute(\'value\', this.value);"  required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"  for="cpf" class="cpf" type="text" dados_pessoais_CPF_conjuje_original="'.$row[28].'" value="'.$row[28].'">
											<span>Companheiro(a): CPF nº (*):  </span>
										</div>

										<div class="inputbox col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
											<input id="dadosPessoaisNascimentoConjuje" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}"  for="date" class="date" type="text" dados_pessoais_nascimento_conjuje_original="'.$dateConvert5.'" value="'.$dateConvert5.'">
											<span>Companheiro(a): Data de nascimento (*):  </span>
										</div>
									</div>
									<div class="row">		
										<div class="inputbox col-sm">	
											<input id="dadosPessoaisRG" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{6,14}"  for="rg" class="rg" type="text" dados_pessoais_RG_original="'.$row[3].'" value="'.$row[3].'">
											<span>RG nº:  </span>
										</div>
										
										<div class="inputbox col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
											'.$selectOptions.'
											<span>UF (RG):  </span>
										</div>
										
										<div class="inputbox col-sm">
											<input onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]{2,79}" class="texto" id="dadosPessoaisRGEmissor"  type="text" dados_pessoais_RG_emissor_original="'.$row[6].'" value="'.$row[6].'">
											<span>Órgão emissor (RG):  </span>
										</div>
										
										<div class="inputbox col-sm">
											<input id="dadosPessoaisRGEmissao" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}"  for="date" class="date" type="text" dados_pessoais_RG_emissao_original="'.$dateConvert1.'" value="'.$dateConvert1.'">
											<span>Data de expedição (RG):  </span>
										</div>
									</div>
									<div class="row">	
										<div class="inputbox col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5">
											<input id="dadosPessoaisNumCNH" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{11}" class="cnhNum"  type="text" dados_pessoais_num_CNH_original="'.$row[22].'" value="'.$row[22].'">
											<span>CNH nº:  </span>
										</div>
										
										<div class="inputbox col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">	
											'.$categoriaCNH.'
											<span>Categoria (CNH):  </span>
										</div>
										
										<div class="inputbox col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5">					
											<input id="dadosPessoaisVencimentoCNH" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}"  for="date" class="date" type="text" dados_pessoais_vencimento_CNH_original="'.$dateConvert4.'" value="'.$dateConvert4.'">
											<span>Vencimento (CNH):  </span>
										</div>
									</div>	
									<div class="row">			
										<div class="inputbox col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">			
											<input id="dadosPessoaisNumTitulo" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{11}"  type="text" class="numTitulo" dados_pessoais_num_titulo_original="'.$row[16].'" value="'.$row[16].'">
											<span>Título de eleitor nº:  </span>
										</div>
										
										<div class="inputbox col-sm">
											<input id="dadosPessoaisSecaoTitulo" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{2,5}" class="secao"  type="text" dados_pessoais_secao_titulo_original="'.$row[17].'" value="'.$row[17].'">
											<span>Seção:  </span>
										</div>
										
										<div class="inputbox col-sm">
											<input id="dadosPessoaisZonaTitulo" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{2,5}" class="zona"  type="text" dados_pessoais_zona_titulo_original="'.$row[18].'" value="'.$row[18].'">
											<span>Zona:  </span>
										</div>
										
										<div class="inputbox col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											<input id="dadosPessoaisEmissaoTitulo" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}"  for="date" class="date" type="text" dados_pessoais_emissao_titulo_original="'.$dateConvert3.'" value="'.$dateConvert3.'">
											<span>Data de emissão:  </span>
										</div>
										
										<div class="inputbox col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
											'.$selectOptions2.'
											<span>UF:  </span>
										</div>
										
										<div class="inputbox col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
											<input id="dadosPessoaisMunicipioTitulo" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]{2,99}"  class="texto" type="text" dados_pessoais_municipio_titulo_original="'.$row[20].'" value="'.$row[20].'">
											<span>Município:  </span>
										</div>
									</div>	
									<div class="row">
										<div class="inputbox col-sm">	
											<input id="dadosPessoaisCPF" onchange="this.setAttribute(\'value\', this.value);"  required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"  for="cpf" class="cpf" type="text" dados_pessoais_CPF_original="'.$row[2].'" value="'.$row[2].'">
											<span>CPF nº(*):  </span>
										</div>
										
										<div class="inputbox col-sm">
											<input id="dadosPessoaisNumReservista" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{12}" class="reservista"  type="text" dados_pessoais_num_reservista_original="'.$row[25].'" value="'.$row[25].'">
											<span>Reservista nº:  </span>
										</div>
										
										<div class="inputbox col-sm">
											<input id="dadosPessoaisSUS" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{15}" class="sus"  type="text" dados_pessoais_SUS_original="'.$row[26].'" value="'.$row[26].'">
											<span>Cartão SUS nº:  </span>
										</div>
										
										<div class="inputbox col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
											'.$tiposSanguineos.'
											<span>Tipo sanguíneo:  </span>
										</div>
									</div>
								</div>
								
							</td>
						</tr>
					</tbody>'
				;
			}										
		}
		
		return $textoPush;
	}
	
	function chamarListarDadosProfissionais(){
		$listaDadosProfissionais = listarDadosProfissionais();
		
		$textoPush = '';
		
		$vetorDadosProfissionais = array();
		if(mysqli_num_rows($listaDadosProfissionais)>0){
			while($row = $listaDadosProfissionais->fetch_row()) {
				array_push($vetorDadosProfissionais, $row);
			}
		}else{
			array_push($vetorDadosProfissionais, [0,"","","","","",0,"","","","","","","",0,"",""]);
		}
		
		foreach ($vetorDadosProfissionais as $row){
			if($_SESSION['idDadosPessoais']==$row[14] && $row[14]!=0){
				
				$selectEstados = inserirEstados($row[10],5);
				
				$selectOptions = inserirCargos($row[12]);
				
				$dateConvert = $row[3] != NULL && $row[3] != '0000-00-00' ? date('d/m/Y', strtotime($row[3])) : "";
				
				$dateConvert1 = $row[11] != NULL && $row[11] != '0000-00-00' ? date('d/m/Y', strtotime($row[11])) : "";
				
				$dateConvert2 = $row[4] != NULL && $row[4] != '0000-00-00' ? date('d/m/Y', strtotime($row[4])) : "";
				
				$dateConvert3 = $row[15] != NULL && $row[15] != '0000-00-00' ? date('d/m/Y', strtotime($row[15])) : "";
				
				$dateConvert4 = $row[16] != NULL && $row[16] != '0000-00-00' ? date('d/m/Y', strtotime($row[16])) : "";

				$empresaBack = vincularEmpresa([0,"",""]);

				$empresaSelec = inserirEmpresas($empresaBack[0]);

				$CNPJSelec = inserirCNPJ($empresaBack[0]);
				
				$gerente_enfermeiro_dados_gerais = buscarGerenteEnfermeiro($_SESSION['idDadosPessoais']);
				
				$gerente_enfermeiro_dados_row = mysqli_num_rows($gerente_enfermeiro_dados_gerais) > 0 ? $gerente_enfermeiro_dados_gerais->fetch_row() : [0,""];
				
				$motorista_escolta_dados_gerais = buscarMotoristaEscolta($_SESSION['idDadosPessoais']);
				
				$motorista_escolta_dados_row = mysqli_num_rows($motorista_escolta_dados_gerais) > 0 ? $motorista_escolta_dados_gerais->fetch_row() : [0,"",""];
				
				$dateConvert3 = $motorista_escolta_dados_row[2] != NULL && $motorista_escolta_dados_row[2] != '0000-00-00' ? date('d/m/Y', strtotime($motorista_escolta_dados_row[2])) : "";
				
				$motorista_ambulancia_dados_gerais = buscarMotoristaAmbulancia($_SESSION['idDadosPessoais']);
				
				$motorista_ambulancia_dados_row = mysqli_num_rows($motorista_ambulancia_dados_gerais) > 0 ? $motorista_ambulancia_dados_gerais->fetch_row() : [0,"",""];
				
				$dateConvert4 = $motorista_ambulancia_dados_row[2] != NULL && $motorista_ambulancia_dados_row[2] != '0000-00-00' ? date('d/m/Y', strtotime($motorista_ambulancia_dados_row[2])) : "";
				
				$enfermeiro_dados_gerais = buscarEnfermeiro($_SESSION['idDadosPessoais']);
				
				$enfermeiro_dados_row = mysqli_num_rows($enfermeiro_dados_gerais) > 0 ? $enfermeiro_dados_gerais->fetch_row() : [0,""];
				
				$dados_especiais = 
					'<div class="row" id="gerente_enfermeiro">
						<div class="inputbox col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<input id="coren_gerente" required pattern="[A-Za-z0-9]{1}[A-Za-z0-9\-]{2,24}"  for="coren_gerente" class="enfermeiro" type="text" original="'.$gerente_enfermeiro_dados_row[1].'" value="'.$gerente_enfermeiro_dados_row[1].'">
							<span>COREN nº(*):  </span>
						</div>
					</div>
					
					<div class="row" id="motorista_escolta">
						<div class="inputbox col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<input id="credencialEscolta" required pattern="\\d{5}\\.\\d{6}\\/\\d{4}-\\d{1,5}"  for="credencialEscolta" class="credencial" type="text" original="'.$motorista_escolta_dados_row[1].'" value="'.$motorista_escolta_dados_row[1].'">
							<span>Credencial nº(*):  </span>
						</div>
						<div class="inputbox col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<input id="validadeCredencialEscolta" required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}"  for="date" class="date" type="text" original="'.$motorista_escolta_dados_row[2].'" value="'.$dateConvert3.'">
							<span>Validade (*):  </span>
						</div>
					</div>
					
					<div class="row" id="motorista_ambulancia">
						<div class="inputbox col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<input id="credencialAmbulancia" required pattern="\\d{5}\\.\\d{6}\\/\\d{4}-\\d{1,5}"  for="credencialAmbulancia" class="credencial" type="text" original="'.$motorista_ambulancia_dados_row[1].'" value="'.$motorista_ambulancia_dados_row[1].'">
							<span>Credencial nº(*):  </span>
						</div>
						<div class="inputbox col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<input id="validadeCredencialAmbulancia" required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}"  for="date" class="date" type="text" original="'.$motorista_ambulancia_dados_row[2].'" value="'.$dateConvert4.'">
							<span>Validade (*):  </span>
						</div>
					</div>
					
					<div class="row" id="auxiliar_enfermagem">
						<div class="inputbox col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<input id="coren_enfermeiro" required pattern="[A-Za-z0-9]{1}[A-Za-z0-9\-]{2,24}"  for="coren_enfermeiro" class="enfermeiro" type="text" original="'.$enfermeiro_dados_row[1].'" value="'.$enfermeiro_dados_row[1].'">
							<span>COREN nº(*):  </span>
						</div>
					</div>
					
					';
					
				$ativo = $row[6]==1?'checked':'';
				$desativo = $row[6]==0?'checked':'';
				$textoPush = $textoPush.  
					'<thead>
						<tr>
							<td>
								<button id="dadosProfissionais-'.$row[0].'" type="button" class="dadosProfissionais btn btn-primary btnSalvarDadosProfissionais">Salvar dados profissionais</button>
							</td>
						</tr>
						
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="container">
									<div class="row">
										<div class="col-sm">
											<label id="validacaoAcesso" validacao_acesso_original="'.$row[6].'">Acesso ao sistema: (*) </label> 
											<input class="form-check-input" type="radio" name="radioDadosProfissionais"  value="1" '.$ativo.'>
											<label class="form-check-label" >
												Liberado
											</label>
											<input class="form-check-input" type="radio" name="radioDadosProfissionais"  value="0" '.$desativo.'>
											<label class="form-check-label" >
												Bloqueado
											</label>
										</div>
									</div>
									<p />
									<div class="row">	
										<div class="inputbox col-sm">
											<input id="dadosProfissionaisMatricula" class="matricula" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{6}"  type="text" dados_profissionais_matricula_original="'.$row[1].'" value="'.$row[1].'">
											<span>Matrícula (*):  </span>
										</div>	
										
										<div class="inputbox col-sm">
											<input id="dadosProfissionaisApelido" class="apelido" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{2,14}"  type="text" dados_profissionais_apelido_original="'.$row[2].'" value="'.$row[2].'">
											<span>Nome único no sistema" (*):  </span>
										</div>
										
										<div class="inputbox col-sm">
											'.$empresaSelec.'
											<span>Empresa (*):  </span>
										</div>
										
										<div class="inputbox col-sm">
											'.$CNPJSelec.'
											<span>CNPJ n° (automático):  </span>
										</div>
									</div>
									<div class="row">	
										<div class="inputbox col-sm">
											<input id="dadosProfissionaisExperienciaInicio"  onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}"  for="date" class="date" type="text" dados_profissionais_experiencia_inicio_original="'.$dateConvert3.'" value="'.$dateConvert3.'">
											<span>Contrato de experiência (início):  </span>
										</div>

										<div class="inputbox col-sm">
											<input id="dadosProfissionaisExperienciaFim"  onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}"  for="date" class="date" type="text" dados_profissionais_experiencia_fim_original="'.$dateConvert4.'" value="'.$dateConvert4.'">
											<span>Contrato de experiência (fim):  </span>
										</div>

										<div class="inputbox col-sm">
											<input id="dadosProfissionaisExperienciaTotal"  style="text-align:center;" type="text" value="">
											<span>Contrato de experiência (dias):  </span>
										</div>
									</div>	
									<div class="row">	
										<div class="inputbox col-sm">
											<input id="dadosProfissionaisAdmissao"  onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}"  for="date" class="date" type="text" dados_profissionais_admissao_original="'.$dateConvert.'" value="'.$dateConvert.'">
											<span>Data de admissão (*):  </span>
										</div>
										
										<div class="inputbox col-sm">
											<input id="dadosProfissionaisDemissao"  onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}"  for="date" class="date" type="text" dados_profissionais_demissao_original="'.$dateConvert2.'" value="'.$dateConvert2.'">
											<span>Data de demissão:  </span>
										</div>
										
										<div class="inputbox col-sm">
											<input id="dadosProfissionaisTempoServico" style="text-align:center;" type="text" value="">
											<span>Tempo de serviço (em meses):  </span>
										</div>
									</div>
									<div class="row">	
										<div class="inputbox col-sm">
											'.$selectOptions.'
											<span>Cargo (*):  </span>
										</div>
									
										<div class="inputbox col-sm">
											<input id="dadosProfissionaisSindicato" class="sindicato texto" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]{2,39}"  type="text" dados_profissionais_sindicato_original="'.$row[5].'" value="'.$row[5].'">
											<span>Sindicato:  </span>
										</div>
										
										<div class="inputbox col-sm">
											<input id="dadosProfissionaisPIS" class="pis"  type="text" required pattern="[0-9]{11}" dados_profissionais_PIS_original="'.$row[7].'" value="'.$row[7].'">
											<span>NIS/PIS/PASEP nº:  </span>
										</div>
									</div>
									<div class="row" id="dadosProfissionaisPadrao">									
										<div class="inputbox col-sm">
											<input id="dadosProfissionaisNumCTPS" class="numCTPS" required pattern="[0-9]{8}"  type="text" dados_profissionais_num_CTPS_original="'.$row[8].'" value="'.$row[8].'">
											<span>Carteira de trabalho (CTPS) nº:  </span>
										</div>
									
										<div class="inputbox col-sm">
											<input id="dadosProfissionaisSerieCTPS" class="serieCTPS" required pattern="[0-9]{6}"  type="text" dados_profissionais_serie_CTPS_original="'.$row[9].'" value="'.$row[9].'">
											<span>Série CTPS nº:  </span>
										</div>
									
										<div class="inputbox col-sm">
											'.$selectEstados.'
											<span>UF CTPS:  </span>
										</div>
									
										<div class="inputbox col-sm">
											<input id="dadosProfissionaisEmissaoCTPS"  onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}"  for="date" class="date" type="text" dados_profissionais_emissao_CTPS_original="'.$dateConvert1.'" value="'.$dateConvert1.'">
											<span>Data de emissão CTPS:  </span>
										</div>
									</div>
									'.$dados_especiais.'
								</div>	
							</td>
						</tr>
					</tbody>
					'
				;
			}										
		}
		
		return $textoPush;
	}

	function chamarListarJornada(){
		$listaJornada = listarJornada();
		
		$textoPush = '';
		
		$vetorJornada = array();
		if(mysqli_num_rows($listaJornada)>0){
			while($row = $listaJornada->fetch_row()) {
				array_push($vetorJornada, $row);
			}
		}else{
			array_push($vetorJornada, [0,"","","","","","","","","",""]);
		}

		foreach ($vetorJornada as $row){
				
			$selectOptions = inserirCargosJornada();

			$textoPush = $textoPush.  
				'<thead>
					<tr>
						<td>
							<button id="jornada" id_jornada="'.$row[0].'" type="button" class="jornada btn btn-primary btnSalvarJornada">Salvar Jornada</button>
						</td>
					</tr>
						
				</thead>
				<tbody>
					<tr>
						<td>
							<div class="container">
								<div class="row">
									<p><p>
									<div class="inputbox col-sm">
										'.$selectOptions.'
										<span>Usar jornada pré-definida de um cargo:  </span>
									</div>
								</div>
								<p />
								<div class="row">	
									<div class="inputbox col-sm">
										<input id="dadosHorasSemanais" class="data_hora_s_m" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{1,3}"  type="text" dados_horas_semanais_original="'.$row[1].'" value="'.$row[1].'">
										<span>Horas semanais:  </span>
									</div>	

									<div class="inputbox col-sm">
										<input id="dadosHorasMensais" class="data_hora_s_m" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{1,3}"  type="text" dados_horas_mensais_original="'.$row[2].'" value="'.$row[2].'">
										<span>Horas mensais:  </span>
									</div>	

									<div class="inputbox col-sm">
										<input id="dadosHorasExtrasMaximas" class="hora_extra_max" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{1}"  type="text" dados_horas_extras_maximas_original="'.$row[3].'" value="'.$row[3].'">
										<span>Horas extraordinárias máxima:  </span>
									</div>	

									<div>
										<span>Dias da semana:  </span>
										<ul class="semana">
											<a  ><li id="domingo" domingo_original="'.$row[4].'" valor_id_semana="'.$row[4].'" class="diaS '. ($row[4] == 0 ? 'inativo' : 'ativo') .'">Domingo</li></a>	
											<a  ><li id="segunda" segunda_original="'.$row[5].'" valor_id_semana="'.$row[5].'" class="diaS '. ($row[5] == 0 ? 'inativo' : 'ativo') .'">Segunda</li></a>
											<a  ><li id="terca" terca_original="'.$row[6].'" valor_id_semana="'.$row[6].'" class="diaS '. ($row[6] == 0 ? 'inativo' : 'ativo') .'">Terça</li></a>
											<a  ><li id="quarta" quarta_original="'.$row[7].'" valor_id_semana="'.$row[7].'" class="diaS '. ($row[7] == 0 ? 'inativo' : 'ativo') .'">Quarta</li></a>
											<a  ><li id="quinta" quinta_original="'.$row[8].'" valor_id_semana="'.$row[8].'" class="diaS '. ($row[8] == 0 ? 'inativo' : 'ativo') .'">Quinta</li></a>
											<a  ><li id="sexta" sexta_original="'.$row[9].'" valor_id_semana="'.$row[9].'" class="diaS '. ($row[9] == 0 ? 'inativo' : 'ativo') .'">Sexta</li></a>
											<a  ><li id="sabado" sabado_original="'.$row[10].'" valor_id_semana="'.$row[10].'" class="diaS '. ($row[10] == 0 ? 'inativo' : 'ativo') .'">Sábado</li></a>
										</ul>
									</div>
								</div>
							</div>	
						</td>
					</tr>
				</tbody>
				'
			;
		}
		
		return $textoPush;
	}

	function chamarListarRemudenracao(){
		$listaRemuneracao = listarRemuneracao($_SESSION['idDadosPessoais']);
		
		$textoPush = '';
		
		$vetorRemuneracao = array();
		if(mysqli_num_rows($listaRemuneracao)>0){
			while($row = $listaRemuneracao->fetch_row()) {
				array_push($vetorRemuneracao, $row);
			}
		}else{
			array_push($vetorRemuneracao, [0,"","","","","",""]);
		}

		$dateConvert1 = $vetorRemuneracao[0][2] != NULL && $vetorRemuneracao[0][2] != '0000-00-00' ? date('d/m/Y', strtotime($vetorRemuneracao[0][2])) : "";
				
		$dateConvert2 = $vetorRemuneracao[0][3] != NULL && $vetorRemuneracao[0][3] != '0000-00-00' ? date('d/m/Y', strtotime($vetorRemuneracao[0][3])) : "";

		$selectOptions = inserirCargosSalario();

		$textoPush = $textoPush.  
			'<thead>
				<tr>
					<td>
						<button id="remuneracao" id_remuneracao="'.$vetorRemuneracao[0][0].'" type="button" class="remuneracao btn btn-primary btnSalvarRemuneracao">Salvar Remuneração</button>
					</td>
				</tr>
						
			</thead>
			<tbody>
				<tr>
					<td>
						<div class="container">
							<div class="row">
								<p><p>
								<div class="inputbox col-sm">
									'.$selectOptions.'
									<span>Usar salário base pré-definida de um cargo:  </span>
								</div>
							</div>
							<p />
							<div class="row">	
								<div class="inputbox col-sm">
									<input id="dadosSalario" class="money" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{0,1}(\.){0,1}[0-9]{0,3}(\.){0,1}[0-9]{0,3}(,){0,1}[0-9]{1,2}"  type="text" dados_salario_original="'.$vetorRemuneracao[0][1].'" value="'.$vetorRemuneracao[0][1].'">
									<span>Salário base (*):  </span>
								</div>	

								<div class="inputbox col-sm">
									<input id="dadosVigenciaInicio" class="date" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}"  type="text" dados_vigencia_inicio_original="'.$dateConvert1.'" value="'.$dateConvert1.'">
									<span>Vigência (início) (*):  </span>
								</div>	

								<div class="inputbox col-sm">
									<input id="dadosVigenciaFim" class="date" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}"  type="text" dados_vigencia_fim_original="'.$dateConvert2.'" value="'.$dateConvert2.'">
									<span>Vigência (fim):  </span>
								</div>
							</div>
							<div class="row">	
								<div>
									<span>Histórico:  </span>
								</div>
								<div id="textareaId">
									<textarea id="textareaSalarios" name="w3review" rows="4" cols="50">'
		;

		if(sizeof($vetorRemuneracao) > 1){
			for($i = 1; $i < sizeof($vetorRemuneracao); $i++){

				$dateConvert3 = $vetorRemuneracao[$i][2] != NULL && $vetorRemuneracao[$i][2] != '0000-00-00' ? date('d/m/Y', strtotime($vetorRemuneracao[$i][2])) : "";
				
				$dateConvert4 = $vetorRemuneracao[$i][3] != NULL && $vetorRemuneracao[$i][3] != '0000-00-00' ? date('d/m/Y', strtotime($vetorRemuneracao[$i][3])) : "";

				$valor_formatado = number_format(floatval($vetorRemuneracao[$i][1]) / 100, 2, ',', '.');

				// Substitui o ponto por vírgula e a vírgula por ponto
				$valor_formatado = str_replace(',', '.', $valor_formatado);
				$valor_formatado = str_replace('.', ',', $valor_formatado);

				$textoPush = $textoPush.  
								'Valor: "'.$valor_formatado.'" - Vigência (início): "'.$dateConvert3.'" - Vigência (fim): "'.$dateConvert4.'" &#10'
				;
			}
		}
				
		$textoPush = $textoPush.  '</textarea>
								</div>
							</div>
						</div>	
					</td>
				</tr>
			</tbody>
			'
			;
		
		
		return $textoPush;
	}
	
	function chamarListarEndereco(){
		
		$listaEnderecos = listarEnderecos();
		
		$textoPush = '';
		
		$vetorEnderecos = array();
		if(mysqli_num_rows($listaEnderecos)>0){
			while($row = $listaEnderecos->fetch_row()) {
				array_push($vetorEnderecos, $row);
			}
		}else{
			array_push($vetorEnderecos, [0,0,"","","","","","","",""]);
		}
		
		foreach ($vetorEnderecos as $row){
				
			$selectEstados = inserirEstados($row[5],1);
			
			$textoPush = $textoPush.  
				'<thead>
					<tr>
						<td>
							<button id="endereco'.$row[1].'" type="button" class="enderecos btn btn-primary salvar">Salvar endereço</button>
						</td>
					</tr>
					
				</thead>
				<tbody>
					<tr>
						<td>
							<div class="row">									
								<div class="inputbox col-sm">
									<input id="enderecoCEP" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{5}-[0-9]{3,4}" class="cep"  type="text" endereco_CEP_original="'.$row[2].'" value="'.$row[2].'">
									<span>CEP (*):  </span>
								</div>
							</div>
							
							<div class="row">									
								<div class="inputbox col-sm">
									<input id="enderecoLogradouro" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]{2,79}" class="logradouro texto"  type="text" endereco_logradouro_original="'.$row[9].'" value="'.$row[9].'">
									<span>Logradouro (*): </span>
								</div>
								
								<div class="inputbox col-sm">
									<input id="enderecoCasa" class="numeroLogradouro" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-z0-9]{1,1}[A-Za-z0-9\s\-]{0,4}"  type="text" endereco_casa_original="'.$row[3].'" value="'.$row[3].'">
									<span>N°(*): </span>
								</div>
								
								<div class="inputbox col-sm">
									<input id="enderecoComplemento" class="numeroComplemento" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-z0-9]{1,1}[A-Za-z0-9\s\-]{0,9}"  type="text" endereco_complemento_original="'.$row[7].'" value="'.$row[7].'">
									<span>Complemento: </span>
								</div>
							</div>
							
							<div class="row">									
								<div class="inputbox col-sm">
									<input id="enderecoBairro" class="bairro texto" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]{2,79}"  type="text" endereco_bairro_original="'.$row[4].'" value="'.$row[4].'">
									<span>Bairro (*): </span>
								</div>
								
								<div class="inputbox col-sm">
									<input class="cidade texto" id="enderecoCidade" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]{2,79}" type="text" endereco_cidade_original="'.$row[6].'" value="'.$row[6].'">
									<span>Cidade (*): </span>
								</div>
								
								<div class="inputbox col-sm">
									'.$selectEstados.'
									<span>Estado (*): </span>
								</div>
							</div>
							
							<div class="row">																		
								<div class="inputbox col-sm">
									<input id="enderecoReferencia" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]{2,79}" class="texto"  type="text" endereco_referencia_original="'.$row[8].'" value="'.$row[8].'">
									<span>Ponto de referência: </span>
								</div>
							</div>
						</td>
					</tr>
				</tbody>'
			;
		}
		
		return $textoPush;
	}
	
	function chamarListarContatos(){
		
		$listaContatos = listarTelefones();
		
		$email = buscarEmail($_SESSION['idDadosPessoais']);
		
		
		$rowEmail = mysqli_num_rows($email) > 0 ? $email->fetch_row() : [0,"",""];
		
		$textoPush = 
					'
				<thead>
				</thead>
				<tbody id="email-'.$rowEmail[0].'">
					<tr>
						<td>
							<div class="row">
								<div class="inputbox col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
									<input email_id="'.$_SESSION['idDadosPessoais'].'" id="contatoEmail" onchange="this.setAttribute(\'value\', this.value);" class="email" required pattern="[^@\sA-Z]+@[^@\sA-Z]+\.[^@\sA-Z]{1,}[^@A-Z]"  type="text" email_original="'.$rowEmail[1].'" value="'.$rowEmail[1].'" >
									<span>E-mail: </span>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<button id="salvarEmail" type="button" class="btn btn-primary btnEmail">Salvar e-mail</button>
							<p \>
						</td>
					</tr>
				</tbody>
				<tbody id="contatosLista">
					<tr>
						<td>
							<button id="addContato" type="button" class="btn btn-primary">Adicionar novo telefone</button>
						</td>
					</tr>
				</boady>
		
		';
		
		while($row = $listaContatos->fetch_row()) {
			if($_SESSION['idDadosPessoais']==$row[0]){
				$ativo = $row[3]==1?'checked':'';
				$desativo = $row[3]==0?'checked':'';
				$classeTelefone = 'fixo';
				$tamanhoFaTelefone = [34,24];
				if(strlen($row[2])>14){
					$classeTelefone = 'mobile';
					$tamanhoFaTelefone[0]=24;
					$tamanhoFaTelefone[1]=34;
				}
				
				$ativarBotaoExcluir = $row[1] != '' ? '<button id="excluirContato'.$row[1].'" type="button" class="btn btn-primary btnExcluir">Excluir</button>' : '';
				
				$row[1] = $row[1] != '' ? $row[1] : 0;
				
				$textoPush = $textoPush.  
					'
				<tbody id="telefone-'.$row[1].'" class="telefoneRow">
					<tr>
						<td>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

									<i id="faPhone'.$row[1].'" class="fa fa-phone" style="font-size:'.$tamanhoFaTelefone[0].'px"></i>  
									<i id="faMobile'.$row[1].'" class="fa fa-mobile" style="font-size:'.$tamanhoFaTelefone[1].'px"></i>

									<div class="inputbox">
										<input class="telefone '.$classeTelefone.'" id="contatosTelefone'.$row[1].'" onchange="this.setAttribute(\'value\', this.value);" required pattern="\([0-9]{2}\)\s[0-9]{4}-[0-9]{4}|\([0-9]{2}\)\s[0-9]{1}\s[0-9]{4}-[0-9]{4}"   type="text" value="'.$row[2].'">
										<span>Telefone (*):  </span>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
									<label class="inputbox">    Este número é Whatsapp?:  </label>
									<input class="form-check-input" type="radio" name="radioTelefone'.$row[1].'" value="1" '.$ativo.'>
									<label class="form-check-label">
										Sim
									</label>
									<input class="form-check-input" type="radio" name="radioTelefone'.$row[1].'" value="0" '.$desativo.'>
									<label class="form-check-label">
										Não
									</label>
								</div>
							</div>
							<div class="row">
								<div class="inputbox col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
									'.inserirTipoContato($row[1],$row[5]).'
									<span>Relação (*):  </span>
								</div>
								<div class="inputbox col-xs-9 col-sm-9 col-md-9 col-lg-9 col-xl-9">
									<input id="contatoNome'.$row[1].'" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]{2,79}" class="nomeContato texto"  type="text" value="'.$row[4].'" >
									<span>Nome do contato:  </span>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<button id="salvarContato'.$row[1].'" type="button" class="btn btn-primary btnSalvar">Salvar</button>
							'.$ativarBotaoExcluir.'
							<p \>
						</td>
					</tr>
				</tbody>'
				;
			}
		}
		
		$textoPush = $textoPush.'';
		
		return $textoPush;
	}
	
	function chamarListarDependentes(){
		$listaDependentes = listarDependentes();
		
		$vetorDependentes = array();
		if(mysqli_num_rows($listaDependentes)>0){
			while($row = $listaDependentes->fetch_row()) {
				array_push($vetorDependentes, $row);
			}
		}else{
			array_push($vetorDependentes, [0,"","","",0,0,0,0]);
		}

		$dadosConjujeTemp = buscarConjuje();
		$dadosConjuje = array();

		$dadosConjuje = mysqli_num_rows($dadosConjujeTemp) > 0 ? $dadosConjujeTemp->fetch_row() : [0,"","","","","",$_SESSION['idDadosPessoais']];

		$dadosConjuje[3] = $dadosConjuje[3] != NULL && $dadosConjuje[3] != '0000-00-00' ? date('d/m/Y', strtotime($dadosConjuje[3])) : "";
		
		$textoPush = '
				<thead id="dependenteLista" id="dependente_conjuje" dp_conjuje_nome="'.$dadosConjuje[1].'" dp_conjuje_cpf="'.$dadosConjuje[2].'" dp_conjuje_nascimento="'.$dadosConjuje[3].'">
					<tr>
						<td>
							<button id="addDependente" type="button" class="btn btn-primary">Adicionar novo dependente</button>
						</td>
					</tr>
				</bhead>
		';

		foreach ($vetorDependentes as $row){
			
			if($_SESSION['idDadosPessoais']==$row[7] || 0==$row[0]){
				
				$tipoDependente = inserirTipoDependente($row[4], $row[5]);
				
				/*
				0 dp.id_dados_pessoais
				1 dp.cpf
				2 dp.nome
				3 dp.data_nascimento
				4 de.id_dependente
				5 de.tipos_dependentes_id_tipo_dependente
				6 de.dados_pessoais_id_dados_pessoais_dependente
				7 de.dados_pessoais_id_dados_pessoais_titular
				*/
				
				$dateConvert = $row[3] != NULL && $row[3] != '0000-00-00' ? date('d/m/Y', strtotime($row[3])) : "";
				
				$ativarBotaoExluir = $row[0] != 0 ? '<button id="excluirDependente'.$row[4].'" type="button" class="btn btn-primary btnExcluirDependente">Excluir dependente</button>' : '';
				
				$textoPush = $textoPush.  
				'<tbody id="tbodydependente'.$row[4].'">
					<tr>
						<td>
							<div class="container">
								<div class="dependente" id="dependente_id_'.$row[4].'" dependente_id="'.$row[4].'">
									<p><p>
									'.$ativarBotaoExluir.'
									<div class="row" id="rowToInsert'.$row[4].'">
										<div class="inputbox col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
											<input dependenteNome="'.$row[2].'" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]{2,79}" class="texto" id="dadosDependenteNome'.$row[4].'"  type="text" value="'.$row[2].'">
											<span>Nome (*):  </span>
										</div>
									</div>
									<div class="row" >
										<div class="inputbox col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
											<input dependenteCPF="'.$row[1].'" id="dadosDependentesCPF'.$row[4].'" onchange="this.setAttribute(\'value\', this.value);"  required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"  for="cpf" class="cpf" type="text" value="'.$row[1].'">
											<span>CPF nº(*):  </span>
										</div>
										<div class="inputbox col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
											<input dependenteNascimento="'.$dateConvert.'" id="dadosDependenteNascimento'.$row[4].'" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}"  for="date" class="date" type="text" value="'.$dateConvert.'">
											<span>Data de nascimento (*):  </span>
										</div>
										<div class="inputbox col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5">
											'.$tipoDependente.'
											<span>Relação (*):  </span>
										</div>
									</div>
								</div>
							</div>	
						</td>
					</tr>
					<tr>
						<td>
							<button id="salvarDependente" type="button" class="btn btn-primary btnSalvarDependente">Salvar dependentes</button>
						</td>
					</tr>
				</tbody>'
				;
			}										
		}
		
		return $textoPush;
	}
	
	function chamarListarDadosBancarios(){
		$listaDadosBancarios = listaDadosBancarios();
		
		/*
		0 ".$_SESSION['idDadosPessoais']."
		1 db.id_dados_bancarios
		2 db.nome_banco
		3 db.agencia
		4 db.conta
		5 db.fichas_colaboradores_id_ficha_colaborador
		6 db.tipos_contas_bancarias_id_tipo_conta_bancaria
		*/
		
		$textoPush = '';

		$vetorDadosBancarios = array();
		if(mysqli_num_rows($listaDadosBancarios)>0){
			while($row = $listaDadosBancarios->fetch_row()) {
				array_push($vetorDadosBancarios, $row);
			}
		}else{
			array_push($vetorDadosBancarios, [0,0,"","","",0,""]);
		}
		
		foreach ($vetorDadosBancarios as $row){
			
			if($_SESSION['idDadosPessoais'] == $row[0] || $row[0] == 0){
				
				$listaTiposBancos = inserirTipoContaBanco($row[1], $row[5]);
				
				$textoPush = $textoPush.  
				'<thead>
					
				</thead>
				<tbody class="tbodyDadosBancarios" >
					<tr>
						<td>
							<div class="container">
								<div class="row">
									<div class="inputbox col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
										<input required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]{2,24}" class="nomeBanco" dadosBancoNomeAtual="'.$row[2].'" id="dadosBancoNome"  type="text" value="'.$row[2].'">
										<span>Nome do banco:  </span>
									</div>
									
									<div class="inputbox col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
										<input dadosBancoAgenciaAtual="'.$row[3].'" id="dadosBancoAgencia" required pattern="[0-9]{1}[0-9\-]{2,5}[0-9]{1}"  class="agencia" type="text" value="'.$row[3].'">
										<span>Agência (**):  </span>
									</div>
									
									<div class="inputbox col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
										<input dadosBancoContaAtual="'.$row[4].'" id="dadosBancoConta" required pattern="[0-9]{1}[0-9\-]{1,7}[0-9]{1}" tyle="text-align:center;" type="text" class="conta" value="'.$row[4].'">
										<span>Conta (**):  </span>
									</div>
									
									<div class="inputbox col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
										'.$listaTiposBancos.'
										<span>Tipo de conta (**):  </span>
									</div>
								</div>
								<div class="row">
									<div class="inputbox col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
										<input required pattern="[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{3,30}" class="chavePix" dadosBancoChavePix_atual="'.$row[6].'" id="dadosBancoChavePix"  type="text" value="'.$row[6].'">
										<span>Chave Pix:  </span>
									</div>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<button id="dadosBancarios-'.$row[1].'" type="button" class="btn btn-primary btnSalvarDadosBancarios">Salvar dados bancarios</button>
						</td>
					</tr>
				</tbody>'
				;
			}										
		}
		
		return $textoPush;
	}

	function chamarEventos(){
		//$listaEventos = listaEventos($_SESSION['idDadosPessoais']);

		$selectOptions = 
		'<select class="eventos_select" id="eventos_select" name="eventos">
			<option value="">Selecione um evento</option>
			
			<option value="1" >Desligamento</option>
			<option value="2">Prêmios e bonificações</option>
			<option value="3">Adiantamento de salário</option>
			<option value="4">Adiantamento de 13°</option>
			<option value="5">Adiantamento de férias/option>
			<option value="6">Outros descontos</option>
		</select>';
		
		$textoPush = '';
		
		$vetorEventos = array();
		/*if(mysqli_num_rows($listaEventos)>0){
			while($row = $listaEventos->fetch_row()) {
				array_push($vetorEventos, $row);
			}
		}else{*/
			array_push($vetorEventos, [0,"",""]);
		//}

		$textoPush = $textoPush.  
			'<thead>
									
			</thead>
			<tbody>
				<tr>
					<td>
						<div class="container">
							<div class="row">
								<p><p>
								<div class="inputbox col-sm">
									'.$selectOptions.'
									<span>Criar um novo evento:  </span>
								</div>
							</div>
							<p />
							<div class="row">	
								<div>
									<span>Histórico:  </span>
								</div>
								<div id="textareaEventosId">
									<textarea id="textareaEventos" name="w3review" rows="4" cols="50">'
		;

		if(sizeof($vetorEventos) > 0){
			foreach($vetorEventos as $row){

				$dateConvert1 = $row[2] != NULL && $row[2] != '0000-00-00' ? date('d/m/Y', strtotime($row[2])) : "";
				
				$textoPush = $textoPush.  
										'Data da ocorrência (início): "'.$dateConvert1.'" - Descrição: "'.$row[1].'" &#10'
				;
			}
		}
				
		$textoPush = $textoPush.	'</textarea>
								</div>
							</div>
						</div>	
					</td>
				</tr>
			</tbody>
			'
			;
		
		
		return $textoPush;
	}

	function chamarListarBeneficios(){
		$textoPush = "<span>Em desenvolvimento</span>";
		
		
		
		return $textoPush;
	}

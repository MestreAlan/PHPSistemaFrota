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
	
	function inserirEstados($verificador,$diferenciador){
		$listaEstados = listarEstados();
		$selectOptions = '<select id="estadosBrasil'.$diferenciador.'" estados_original="'.$verificador.'" class="estados" name="estados-brasil" required>';

		$selectOptions = $selectOptions.'<option verificador="0" value="" disabled selected>Sel.</option>';

		while($estado = $listaEstados->fetch_row()){
			if($estado[0]==$verificador){
				$selectOptions = $selectOptions.'<option verificador="'.$estado[0].'" value="'.$estado[2].'" selected>'.$estado[2].'</option>';
			}else{
				$selectOptions = $selectOptions.'<option verificador="'.$estado[0].'" value="'.$estado[2].'">'.$estado[2].'</option>';
			}
		}
		$selectOptions = $selectOptions.'</select>';
		
		return $selectOptions;
	}
	
	function chamarListarDados(){
		$listaClientes = listarClientesEspecifico();

		$textoPush = '';
		
		$vetorClientes = array();
		if(mysqli_num_rows($listaClientes)>0){
			while($row = $listaClientes->fetch_row()) {
				array_push($vetorClientes, $row);
			}
		}else{
			array_push($vetorClientes, [0,"","","","","","",0,0]);
		}
		
		foreach ($vetorClientes as $row){
			
			if($_SESSION['idCliente']==$row[0] || $row[0] == 0){
				
				$textoPush = $textoPush.  
					'<thead>
						<tr>
							<th scope="col">Dados Gerais</th>
						</tr>
						
					</thead>
					<tbody class="tbodyDadosGerais" >
						<tr>
							<td>
								<div class="container">
									<div class="row">
										<div class="inputbox col-xs col-sm col-md col-lg col-xl">
											<input onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-\/]{2,79}" class="nomeTexto" id="razao_social"  type="text" razao_social_original="'.$row[1].'" value="'.$row[1].'">
											<span>Razão social (*):  </span>
										</div>
										
										<div class="inputbox col-xs col-sm col-md col-lg col-xl">
											<input id="fantasia" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-\/]{2,79}"  class="nomeTexto" type="text" fantasia_original="'.$row[2].'" value="'.$row[2].'">
											<span>Nome fantasia (*):  </span>
										</div>
									</div>
									
									<div class="row">
										<div class="inputbox col-xs col-sm col-md col-lg col-xl">   
											<input id="cnpj" class="cnpj" onchange="this.setAttribute(\'value\', this.value);" required pattern="[0-9]{2}\.[0-9]{3}[\.][0-9]{3}[\/][0-9]{4}[\-][0-9]{2}"  type="text" cnpj_original="'.$row[3].'" value="'.$row[3].'">
											<span>CNPJ (*):  </span>
										</div>
										
										<div class="inputbox col-xs col-sm col-md col-lg col-xl">
											<input class="inscricao_municipal" id="inscricao_municipal" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{11}"  type="text" inscricao_municipal_original="'.$row[4].'" value="'.$row[4].'">
											<span>Incrição municipal (*):  </span>
										</div>
									</div>
								</div>
								
							</td>
						</tr>
						<tr>
							<td>
								<button id="dadosGerais-'.$row[0].'" id_conctrole="'.$row[0].'" type="button" class="btn btn-primary btnSalvarDadosGerais">Salvar dados gerais</button>
								<label id="labelDadosGerais"></label>
							</td>
						</tr>
					</tbody>'
				;
			}										
		}
		
		return $textoPush;
	}
	
	function chamarListarEndereco(){
		
		$listaEnderecos = listarEnderecoCliente();
		
		$textoPush = '';
		
		$vetorEnderecos = array();
		if(mysqli_num_rows($listaEnderecos)>0){
			while($row = $listaEnderecos->fetch_row()) {
				array_push($vetorEnderecos, $row);
			}
		}else{
			array_push($vetorEnderecos, [0,"","","","","","","","","",0]);
		}
		
		foreach ($vetorEnderecos as $row){
				
			$selectEstados = inserirEstados($row[10],1);
			
			$textoPush = $textoPush.  
					'<thead>
						<tr>
							<th scope="col">Enderecos</th>
						</tr>
						
					</thead>
					<tbody class="tbodyEndereco" >
						<tr>
							<td>
								<div class="row">									
									<div class="inputbox col-xs col-sm col-md col-lg col-xl">
										<input id="enderecoCEP" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[0-9]{5}-[0-9]{3,4}" class="cep"  type="text" endereco_CEP_original="'.$row[1].'" value="'.$row[1].'">
										<span>CEP (*):  </span>
									</div>
								</div>
								
								<div class="row">									
									<div class="inputbox col-xs col-sm col-md col-lg col-xl">
										<input id="enderecoLogradouro" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]{2,79}" class="logradouro texto"  type="text" endereco_logradouro_original="'.$row[4].'" value="'.$row[4].'">
										<span>Logradouro (*): </span>
									</div>
									
									<div class="inputbox col-xs col-sm col-md col-lg col-xl">
										<input id="enderecoCasa" class="numeroLogradouro" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-z0-9]{1,1}[A-Za-z0-9\s\-]{0,4}"  type="text" endereco_casa_original="'.$row[2].'" value="'.$row[2].'">
										<span>N°(*): </span>
									</div>
									
									<div class="inputbox col-xs col-sm col-md col-lg col-xl">
										<input id="enderecoComplemento" class="numeroComplemento" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-z0-9]{1,1}[A-Za-z0-9\s\-]{0,29}"  type="text" endereco_complemento_original="'.$row[8].'" value="'.$row[8].'">
										<span>Complemento: </span>
									</div>
								</div>
								
								<div class="row">									
									<div class="inputbox col-xs col-sm col-md col-lg col-xl">
										<input id="enderecoBairro" class="bairro texto" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]{2,79}"  type="text" endereco_bairro_original="'.$row[3].'" value="'.$row[3].'">
										<span>Bairro (*): </span>
									</div>
									
									<div class="inputbox col-xs col-sm col-md col-lg col-xl">
										<input class="cidade texto" id="enderecoCidade" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]{2,79}"  type="text" endereco_cidade_original="'.$row[5].'" value="'.$row[5].'">
										<span>Cidade (*): </span>
									</div>
									
									<div class="inputbox col-xs col-sm col-md col-lg col-xl">
										'.$selectEstados.'
										<span>Estado (*): </span>
									</div>
								</div>
								
								<div class="row">																		
									<div class="inputbox col-sm">
										<input id="enderecoReferencia" onchange="this.setAttribute(\'value\', this.value);"  required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]{2,79}" class="texto"  type="text" endereco_referencia_original="'.$row[9].'" value="'.$row[9].'">
										<span>Ponto de referência: </span>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<button id="endereco'.$row[0].'" type="button" class="enderecos btn btn-primary salvar">Salvar endereço</button>
								<label id="labelEndereco"></label>
							</td>
						</tr>
					</tbody>'
			;
		}
		
		return $textoPush;
	}
	
	function chamarListarContatos(){
		
		$listaContatos = listarContatoCliente();
		
		$textoPush = '';
		
		$vetorContato = array();
		if(mysqli_num_rows($listaContatos)>0){
			while($row = $listaContatos->fetch_row()) {
				array_push($vetorContato, $row);
			}
		}else{
			array_push($vetorContato, [0,"",0,"",0]);
		}
		
		foreach ($vetorContato as $row){
		
			if($_SESSION['idCliente']==$row[4] || $row[4] == 0){
				$ativo = $row[2]==1?'checked':'';
				$desativo = $row[2]==0?'checked':'';
				$classeTelefone = 'fixo';
				$tamanhoFaTelefone = [34,24];
				if(strlen($row[1])>14){
					$classeTelefone = 'mobile';
					$tamanhoFaTelefone[0]=24;
					$tamanhoFaTelefone[1]=34;
				}
				
				$textoPush = $textoPush.  
					'
					<thead>
						<tr>
							<th scope="col">Contatos</th>
						</tr>
						
					</thead>
					<tbody id="contato-'.$row[0].'" class="telefoneRow">
						<tr>
							<td>
								<div class="row">
									<div class="inputbox col-sm">
										<input email_original="'.$row[3].'" id="contatoEmail" class="email" onchange="this.setAttribute(\'value\', this.value);" required pattern="[^@\sA-Z]+@[^@\sA-Z]+\.[^@\sA-Z]{1,}[^@A-Z]"  type="text" value="'.$row[3].'" >
										<span>E-mail (*): </span>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
										<i id="faPhone'.$row[0].'" class="fa fa-phone" style="font-size:'.$tamanhoFaTelefone[0].'px"></i>  
										<i id="faMobile'.$row[0].'" class="fa fa-mobile" style="font-size:'.$tamanhoFaTelefone[1].'px"></i>
										<div class="inputbox">
											<input class="telefone '.$classeTelefone.'" telofone_original="'.$row[1].'" id="contatosTelefone'.$row[0].'" onchange="this.setAttribute(\'value\', this.value);" required pattern="\([0-9]{2}\)\s[0-9]{4}-[0-9]{4}|\([0-9]{2}\)\s[0-9]{1}\s[0-9]{4}-[0-9]{4}"   type="text" value="'.$row[1].'">
											<span>Telefone (*):  </span>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
										<label class="inputbox" id="whatsapp" whatsapp_original="'.$row[2].'">    Este número é Whatsapp? (*):  </label>
										<input class="form-check-input" type="radio" name="radioTelefone'.$row[0].'" value="1" '.$ativo.'>
										<label class="form-check-label">
											Sim
										</label>
										<input class="form-check-input" type="radio" name="radioTelefone'.$row[0].'" value="0" '.$desativo.'>
										<label class="form-check-label">
											Não
										</label>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<button id="salvarContato'.$row[0].'" type="button" class="btn btn-primary btnSalvar btncontato">Salvar</button>
								<label id="labelContato"></label>
							</td>
						</tr>
					</tbody>'
				;
			}
		
		}
		
		$textoPush = $textoPush.'';
		
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

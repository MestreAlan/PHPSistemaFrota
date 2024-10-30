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

	$redirecionador = $_POST['direcionador'];
	
	if($redirecionador == "editarDadosPessoais"){
		$idValue = $_POST['idValue'];
		$nome = $_POST['nome'];
		$cpf = $_POST['cpf'];
		$rg = $_POST['rg'];
		$estadoRG = $_POST['estadoRG'];
		$nascimento = $_POST['nascimento'];
		$mae = $_POST['mae'];
		$pai = $_POST['pai'];
		$escolaridade = $_POST['escolaridade'];
		$estadoCivil = $_POST['estadoCivil'];
		$fatorRH = $_POST['fatorRH'];
		$sexo = $_POST['sexo'];
		$naturalidade = $_POST['naturalidade'];
		$naturalidadeUF = $_POST['naturalidadeUF'];
		$numCNH = $_POST['numCNH'];
		$categoriaCNH = $_POST['categoriaCNH'];
		$vencimentoCNH = $_POST['vencimentoCNH'];
		$rgEmissor = $_POST['rgEmissor'];
		$rgEmissao = $_POST['rgEmissao'];
		$numTitulo = $_POST['numTitulo'];
		$secaoTitulo = $_POST['secaoTitulo'];
		$zonaTitulo = $_POST['zonaTitulo'];
		$tituloUF = $_POST['tituloUF'];
		$municipioTitulo = $_POST['municipioTitulo'];
		$emissaoTitulo = $_POST['emissaoTitulo'];
		$numReservista = $_POST['numReservista'];
		$sus = $_POST['sus'];

		$nomeConjuje = $_POST['nomeConjuje'];
		$cpfConjuje = $_POST['cpfConjuje'];
		$nascimentoConjuje = $_POST['nascimentoConjuje'];
		$statusConjuje = $_POST['statusConjuje'];

		$nascimentoConvert = converterData($nascimento);
		$vencimentoCNHConvert = converterData($vencimentoCNH);
		$rgEmissaoConvert = converterData($rgEmissao);
		$emissaoTituloConvert = converterData($emissaoTitulo);
		$nascimentoConjujeConvert = converterData($nascimentoConjuje);
		editarDadosPessoais($idValue, $nome, $cpf, $rg, $estadoRG, $nascimentoConvert, $mae, $pai, $escolaridade, $estadoCivil, $fatorRH, $sexo, $naturalidade, $naturalidadeUF, $numCNH, $categoriaCNH, $vencimentoCNHConvert, $rgEmissor, $rgEmissaoConvert, $numTitulo, $secaoTitulo, $zonaTitulo, $emissaoTituloConvert, $tituloUF, $municipioTitulo, $numReservista, $sus);
		if($statusConjuje == 1){
			criarConjuje($idValue,$nomeConjuje,$cpfConjuje,$nascimentoConjujeConvert); //Criar
		}else if($statusConjuje == 2){
			editarConjuje($idValue,$nomeConjuje,$cpfConjuje,$nascimentoConjujeConvert); //Editar
		}else{
			excluirconjuje($idValue,$cpfConjuje); //Apagar
		}
	}else if($redirecionador == "criarDadosPessoais"){
		$nome = $_POST['nome'];
		$cpf = $_POST['cpf'];
		$rg = $_POST['rg'];
		$estadoRG = $_POST['estadoRG'];
		$nascimento = $_POST['nascimento'];
		$mae = $_POST['mae'];
		$pai = $_POST['pai'];
		$escolaridade = $_POST['escolaridade'];
		$estadoCivil = $_POST['estadoCivil'];
		$fatorRH = $_POST['fatorRH'];
		$sexo = $_POST['sexo'];
		$naturalidade = $_POST['naturalidade'];
		$naturalidadeUF = $_POST['naturalidadeUF'];
		$numCNH = $_POST['numCNH'];
		$categoriaCNH = $_POST['categoriaCNH'];
		$vencimentoCNH = $_POST['vencimentoCNH'];
		$rgEmissor = $_POST['rgEmissor'];
		$rgEmissao = $_POST['rgEmissao'];
		$numTitulo = $_POST['numTitulo'];
		$secaoTitulo = $_POST['secaoTitulo'];
		$zonaTitulo = $_POST['zonaTitulo'];
		$tituloUF = $_POST['tituloUF'];
		$municipioTitulo = $_POST['municipioTitulo'];
		$emissaoTitulo = $_POST['emissaoTitulo'];
		$numReservista = $_POST['numReservista'];
		$sus = $_POST['sus'];

		$nomeConjuje = $_POST['nomeConjuje'];
		$cpfConjuje = $_POST['cpfConjuje'];
		$nascimentoConjuje = $_POST['nascimentoConjuje'];
		$statusConjuje = $_POST['statusConjuje'];

		$nascimentoConvert = converterData($nascimento);
		$vencimentoCNHConvert = converterData($vencimentoCNH);
		$rgEmissaoConvert = converterData($rgEmissao);
		$emissaoTituloConvert = converterData($emissaoTitulo);
		$nascimentoConjujeConvert = converterData($nascimentoConjuje);
		criarDadosPessoais($cpf, $nome, $rg, $rgEmissaoConvert, $rgEmissor, $nascimentoConvert, $mae, $pai, $naturalidade, $numTitulo, $secaoTitulo, $zonaTitulo, $emissaoTituloConvert, $municipioTitulo, $numCNH, $vencimentoCNHConvert, $numReservista, $sus, $escolaridade, $categoriaCNH, $fatorRH, $sexo, $estadoCivil, $estadoRG, $naturalidadeUF, $tituloUF);
		$novoIdTemp = buscarIdDadosPessoais($cpf, $nome);
		$novoId = $novoIdTemp->fetch_row();
		$_SESSION['idDadosPessoais'] = $novoId[0];
		criarDadosProfissionais($_SESSION['idDadosPessoais']);
		if($statusConjuje == 1){
			criarConjuje($_SESSION['idDadosPessoais'],$nomeConjuje,$cpfConjuje,$nascimentoConjujeConvert); //Criar
		}
	}else if($redirecionador == "dadosProfissionais"){
		$validado = $_POST['validado'];
		$matricula = $_POST['matricula'];
		$apelido = $_POST['apelido'];
		$admissao = $_POST['admissao'];
		$demissao = $_POST['demissao'];
		$sindicato = $_POST['sindicato'];
		$cargo = $_POST['cargo'];
		$pis = $_POST['pis']; 
		$numCTPS = $_POST['numCTPS']; 
		$serieCTPS = $_POST['serieCTPS']; 
		$ufCTPS = $_POST['ufCTPS']; 
		$emissaoCTPS = $_POST['emissaoCTPS']; 
		$empresaID = $_POST['empresaID']; 
		$experienciaInicio = $_POST['experienciaInicio']; 
		$experienciaFim = $_POST['experienciaFim']; 
		$admissaoConvert = converterData($admissao);
		$demissaoConvert = converterData($demissao);
		$emissaoCTPSConvert = converterData($emissaoCTPS);
		$experienciaInicioConvert = converterData($experienciaInicio);
		$experienciaFimConvert = converterData($experienciaFim);
		editarDadosProfissionais($validado, $matricula, $apelido, $admissaoConvert, $demissaoConvert, $sindicato, $cargo, $pis, $numCTPS, $serieCTPS, $ufCTPS, $emissaoCTPSConvert, $empresaID, $experienciaInicioConvert, $experienciaFimConvert);
	}else if($redirecionador == "modificarJornada"){
		$id_jornada = $_POST['id_jornada'];
		$horaS = $_POST['horaS'];
		$horaM = $_POST['horaM'];
		$horaE = $_POST['horaE'];
		$dom = $_POST['dom'];
		$seg = $_POST['seg'];
		$ter = $_POST['ter'];
		$qua = $_POST['qua'];
		$qui = $_POST['qui'];
		$sex = $_POST['sex'];
		$sab = $_POST['sab'];
		if($id_jornada == 0){
			criarJornada($horaS, $horaM, $horaE, $dom, $seg, $ter, $qua, $qui, $sex, $sab);
		}else{
			editar_jornada($id_jornada, $horaS, $horaM, $horaE, $dom, $seg, $ter, $qua, $qui, $sex, $sab);
		}
	}else if($redirecionador == "modificarRemuneracao"){
		$id_remuneracao = $_POST['id_remuneracao'];
		$salario = $_POST['salario'];
		$vInicio = $_POST['vInicio'];
		$vInicioConvert = converterData($vInicio);
		$vFim = $_POST['vFim'];
		$vFimConvert = converterData($vFim);
		$vFim_original = $_POST['vFim_original'];
		$vFim_originalConvert = converterData($vFim_original);
		if($id_remuneracao != 0){
			editarRemuneracao($id_remuneracao, $vFim_originalConvert);	
		}
		criarRemuneracao($salario, $vInicioConvert, $vFimConvert);

		$idRemuneracao = buscarIdRemuneracao($salario, $vInicioConvert, $vFimConvert);
		$idSelectRemuneracao = $idRemuneracao->fetch_row();
		echo json_encode($idSelectRemuneracao[0]);
	}else if($redirecionador == "editarEndereco"){
		$id = $_POST['id'];
		$enderecoCEP = $_POST['enderecoCEP'];
		$enderecoCasa = $_POST['enderecoCasa']; 
		$enderecoBairro = $_POST['enderecoBairro']; 
		$estado = $_POST['estado']; 
		$enderecoCidade = $_POST['enderecoCidade']; 
		$enderecoComplemento = $_POST['enderecoComplemento']; 
		$enderecoReferencia = $_POST['enderecoReferencia']; 
		$enderecoLogradouro = $_POST['enderecoLogradouro']; 
		editarEndereco($id, $enderecoCEP, $enderecoCasa, $enderecoBairro, $estado, $enderecoCidade, $enderecoComplemento, $enderecoReferencia, $enderecoLogradouro);
	}else if($redirecionador == "criarEndereco"){
		$enderecoCEP = $_POST['enderecoCEP'];
		$enderecoCasa = $_POST['enderecoCasa']; 
		$enderecoBairro = $_POST['enderecoBairro']; 
		$estado = $_POST['estado']; 
		$enderecoCidade = $_POST['enderecoCidade']; 
		$enderecoComplemento = $_POST['enderecoComplemento']; 
		$enderecoReferencia = $_POST['enderecoReferencia']; 
		$enderecoLogradouro = $_POST['enderecoLogradouro']; 
		criarEndereco($enderecoCEP, $enderecoCasa, $enderecoBairro, $estado, $enderecoCidade, $enderecoComplemento, $enderecoReferencia, $enderecoLogradouro);
		$idEndereco = buscarIdEndereco($enderecoCEP);
		$idSelectEndereco = $idEndereco->fetch_row();
		echo $idSelectEndereco[0];
	}else if($redirecionador == "editarContato"){
		$idValue = $_POST['idValue'];
		$contatosTelefone = $_POST['contatosTelefone']; 
		$telefoneWhatsapp = $_POST['telefoneWhatsapp']; 
		$tipoContato = $_POST['tipoContato']; 
		$contatoNome = $_POST['contatoNome']; 
		editarTelefone($idValue,$contatosTelefone,$telefoneWhatsapp,$tipoContato,$contatoNome);
	}else if($redirecionador == "criarContato"){
		$contatosTelefone = $_POST['contatosTelefone']; 
		$telefoneWhatsapp = $_POST['telefoneWhatsapp']; 
		$tipoContato = $_POST['tipoContato']; 
		$contatoNome = $_POST['contatoNome']; 
		criarTelefone($contatosTelefone,$telefoneWhatsapp,$tipoContato,$contatoNome);
		$idContato = buscarUltimoContato($contatosTelefone);
		$idSelectContato = $idContato->fetch_row();
		echo $idSelectContato[0];
	}else if($redirecionador == "excluirContato"){
		$idValue = $_POST['idValue'];
		excluirTelefone($idValue);
	}else if($redirecionador == "cadastrar_email"){
		$email = $_POST['email'];
		$user = $_POST['user'];
		criarEmail($email, $user);
		$idEmail = buscarUltimoEmail();
		$idSelectEmail = $idEmail->fetch_row();
		echo $idSelectEmail[0];
	}else if($redirecionador == "editar_email"){
		$email = $_POST['email'];
		$user = $_POST['user'];
		editarEmail($email, $user);
	}else if($redirecionador == "editarDependente"){
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$cpf = $_POST['cpf'];
		$nascimento = $_POST['nascimento'];
		$tipo_dependente = $_POST['tipo_dependente'];
		$nascimentoConvert = converterData($nascimento);
		editarDependente($id, $nome, $cpf, $nascimentoConvert, $tipo_dependente);
	}else if($redirecionador == "criarDependente"){
		$nome = $_POST['nome'];
		$cpf = $_POST['cpf'];
		$nascimento = $_POST['nascimento'];
		$tipo_dependente = $_POST['tipo_dependente'];
		$nascimentoConvert = converterData($nascimento);
		criarDependente($nome, $cpf, $nascimentoConvert, $tipo_dependente);
		$idDependente = buscarIdDependente($cpf);
		$idSelectDependente = $idDependente->fetch_row();
		echo $idSelectDependente[0];
	}else if($redirecionador == "excluirDependente"){
		$id = $_POST['id'];
		echo excluirDependente($id);
	}else if($redirecionador == 'salvarGerenteEnfermeiro'){ 
		$idValue = $_POST['idValue'];
		$coren_gerente = $_POST['coren_gerente'];
		criarGerenteEnfermeiro($idValue, $coren_gerente);
	}else if($redirecionador == 'editarGerenteEnfermeiro'){ 
		$idValue = $_POST['idValue'];
		$coren_gerente = $_POST['coren_gerente'];
		editarGerenteEnfermeiro($idValue, $coren_gerente);
	}else if($redirecionador == 'excluirGerenteEnfermeiro'){ 
		$idValue = $_POST['idValue'];
		excluirGerenteEnfermeiro($idValue);
	}else if($redirecionador == "salvarMotoristaEscolta"){
		$idValue = $_POST['idValue'];
		$credencial_escolta = $_POST['credencial_escolta'];
		$validade_credencial = $_POST['validade_credencial'];
		$validade_credencialConvert = converterData($validade_credencial);
		criarMotoristaEscolta($idValue, $credencial_escolta, $validade_credencialConvert);
	}else if($redirecionador == "editarMotoristaEscolta"){
		$idValue = $_POST['idValue'];
		$credencial_escolta = $_POST['credencial_escolta'];
		$validade_credencial = $_POST['validade_credencial'];
		$validade_credencialConvert = converterData($validade_credencial);
		editarMotoristaEscolta($idValue, $credencial_escolta, $validade_credencialConvert);
	}else if($redirecionador == 'excluirMotoristaEscolta'){
		$idValue = $_POST['idValue'];
		excluirMotoristaEscolta($idValue);
	}else if($redirecionador == "salvarMotoristaAmbulancia"){
		$idValue = $_POST['idValue'];
		$credencial_ambulancia = $_POST['credencial_ambulancia'];
		$vvalidade_credencial_ambulancia = $_POST['validade_credencial_ambulancia'];
		$validade_credencialConvert = converterData($validade_credencial_ambulancia);
		criarMotoristaAmbulancia($idValue, $credencial_ambulancia, $validade_credencialConvert);
	}else if($redirecionador == "editarMotoristaAmbulancia"){
		$idValue = $_POST['idValue'];
		$credencial_ambulancia = $_POST['credencial_ambulancia'];
		$validade_credencial_ambulancia = $_POST['validade_credencial_ambulancia'];
		$validade_credencialConvert = converterData($validade_credencial_ambulancia);
		editarMotoristaAmbulancia($idValue, $credencial_ambulancia, $validade_credencialConvert);
	}else if($redirecionador == 'excluirMotoristaAmbulancia'){
		$idValue = $_POST['idValue'];
		excluirMotoristaAmbulancia($idValue);
	}else if($redirecionador == 'salvarEnfermeiro'){ 
		$idValue = $_POST['idValue'];
		$coren_enfermeiro = $_POST['coren_enfermeiro'];
		criarEnfermeiro($idValue, $coren_enfermeiro);
	}else if($redirecionador == 'editarEnfermeiro'){ 
		$idValue = $_POST['idValue'];
		$coren_enfermeiro = $_POST['coren_enfermeiro'];
		editarEnfermeiro($idValue, $coren_enfermeiro);
	}else if($redirecionador == 'excluirEnfermeiro'){ 
		$idValue = $_POST['idValue'];
		excluirEnfermeiro($idValue);
	}else if($redirecionador == 'editarDadosBancarios'){
		$idValue = $_POST['idValue'];
		$bancoNome = $_POST['bancoNome'];
		$bancoAgencia = $_POST['bancoAgencia'];
		$bancoConta = $_POST['bancoConta'];
		$tipoConta = $_POST['tipoConta'];
		$pix = $_POST['pix'];
		editarDadosBancarios($idValue, $bancoNome, $bancoAgencia, $bancoConta, $tipoConta, $pix);
	}else if($redirecionador == 'criarDadosBancarios'){
		$bancoNome = $_POST['bancoNome'];
		$bancoAgencia = $_POST['bancoAgencia'];
		$bancoConta = $_POST['bancoConta'];
		$tipoConta = $_POST['tipoConta'];
		$pix = $_POST['pix'];
		criarDadosBancarios($bancoNome, $bancoAgencia, $bancoConta, $tipoConta, $pix);
		$retorno = buscarUltimoDadosBancarios();
		$idBanco = $retorno->fetch_row();
		echo $idBanco[0];
	}

	function converterData($valor){
		if($valor != ""){
			$data = str_replace("/", "-", $valor);
			return date('Y-m-d', strtotime($data));
		}else{
			return "";
		}
	}
	
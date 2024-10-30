<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	
	/* Área de controles de acesso ao banco*/
	
	function conectarBanco() { //Pronto
		$host = "localhost";
		$db   = "eradarbd";
		$user = "root";
		$pass = "";

		// conecta ao banco de dados
		return mysqli_connect($host,$user,$pass,$db);
	}
	
	function desconectarBanco($conn) { //Pronto
		
		mysqli_close($conn);
		
	}
	
	/* Buscar */

	function buscarIdRemuneracao($salario, $vInicio, $vFim){
	
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, "SELECT id_salario FROM salarios WHERE valor = '".$salario."' AND data_inicio = '".$vInicio."' AND data_fim = '".$vFim."' ORDER BY id_salario DESC LIMIT 1");
		
		desconectarBanco($conn);
		
		return $sql;
	
	}

	function buscarTempoExperiencia(){

		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, "SELECT * FROM tempo_experiencia WHERE id_tempo_experiencia = 
			(SELECT tempo_experiencia_id_tempo_experiencia FROM fichas_colaboradores WHERE dados_pessoais_id_dados_pessoais = '".$_SESSION['idDadosPessoais']."')
		");
		
		desconectarBanco($conn);
		
		return $sql;

	}
	
	function buscarConjuje() { 
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, "SELECT * FROM conjujes WHERE dados_pessoais_id_dados_pessoais = '".$_SESSION['idDadosPessoais']."'");
		
		desconectarBanco($conn);
		
		return $sql;
		
	}

	function buscarUsuario($id) { 
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, "SELECT * FROM usuarios WHERE id_usuario = '".$id."'");
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarEmpresas($id){ //Pronto
		
		/*
		0 ep.id_empresa, 
		1 ep.nome, 
		2 ep.cnpj
		*/
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, 
			"SELECT ep.id_empresa, ep.nome, ep.cnpj
			FROM empresas AS ep
			INNER JOIN fichas_colaboradores AS fc
			ON ep.id_empresa = fc.empresas_id_empresa
			INNER JOIN dados_pessoais AS dp
			ON dp.id_dados_pessoais = fc.dados_pessoais_id_dados_pessoais
			WHERE dp.id_dados_pessoais = ".$id
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarEmpresasFrota($id){ //Pronto
		
		/*
		0 ep.id_empresa, 
		1 ep.nome, 
		2 ep.cnpj
		*/
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, 
			"SELECT ep.id_empresa, ep.nome, ep.cnpj
			FROM empresas AS ep
			INNER JOIN veiculos AS vc
			ON ep.id_empresa = vc.empresas_id_empresa
			WHERE vc.id_veiculo = ".$id
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarIdEmpresa($nome){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, 
			"SELECT ep.id_empresa
			FROM empresas AS ep
			WHERE ep.fantasia = '".$nome."'"
		);
		
		desconectarBanco($conn);
		
		$id = $sql->fetch_row();	
		return $id[0];
		
	}
	
	function buscarIdClienteNome($nome){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, 
			"SELECT cl.id_cliente
			FROM clientes AS cl
			WHERE cl.fantasia = '".$nome."'"
		);
		
		desconectarBanco($conn);
		
		$id = $sql->fetch_row();	
		return $id[0];
		
	}
	
	function buscarIdCarga($nome){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, 
			"SELECT cg.id_carga
			FROM cargas AS cg
			WHERE cg.nome = '".$nome."'"
		);
		
		desconectarBanco($conn);
		
		$id = $sql->fetch_row();	
		return $id[0];
		
	}
	
	function buscarEmail($id){ //Pronto
		
		/*
		0 em.id_email
		1 em.email
		2 em.dados_pessoais_id_dados_pessoais
		*/
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, 
			"SELECT em.id_email, em.email, em.dados_pessoais_id_dados_pessoais
			FROM dados_pessoais AS dp
			LEFT JOIN emails AS em
			ON dp.id_dados_pessoais = em.dados_pessoais_id_dados_pessoais
			WHERE dp.id_dados_pessoais = ".$id
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarOS($os_num){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, 
			"SELECT *
			FROM ordens_servicos
			WHERE num_os = '".$os_num."'"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarUltimaAtualizacaoAcaoOS ($id){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT te.nome, av.data_edicao
			FROM ordens_servicos AS os
			
			LEFT JOIN ordens_servicos_acoes_veiculos AS osav
			ON os.id_ordem_servico = osav.ordens_servicos_id_ordem_servico
			
			LEFT JOIN acoes_veiculos AS av
			ON osav.acoes_veiculos_id_acao_veiculo = av.id_acao_veiculo
			
			LEFT JOIN tipos_execucao AS te
			ON av.tipos_execucao_id_tipo_execucao = te.id_tipo_execucao
			
			WHERE os.id_ordem_servico = ".$id." AND av.situacao = 1
			ORDER BY av.data_edicao DESC LIMIT 1"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarDatasAcaoOS($id){ //Pronto
				
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"(SELECT 2,av.data_criacao
			FROM ordens_servicos AS os
			
			LEFT JOIN ordens_servicos_acoes_veiculos AS osav
			ON os.id_ordem_servico = osav.ordens_servicos_id_ordem_servico
			
			LEFT JOIN acoes_veiculos AS av
			ON osav.acoes_veiculos_id_acao_veiculo = av.id_acao_veiculo
			
			WHERE os.id_ordem_servico = ".$id."
			ORDER BY av.data_edicao ASC LIMIT 1)
			
			UNION ALL 
			
			(SELECT 3,av.data_criacao
			FROM ordens_servicos AS os
			
			LEFT JOIN ordens_servicos_acoes_veiculos AS osav
			ON os.id_ordem_servico = osav.ordens_servicos_id_ordem_servico
			
			LEFT JOIN acoes_veiculos AS av
			ON osav.acoes_veiculos_id_acao_veiculo = av.id_acao_veiculo
			
			WHERE os.id_ordem_servico = ".$id."
			ORDER BY av.data_edicao DESC LIMIT 1);"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarOSporDataLimitada(){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, 
			"SELECT os.num_os
			FROM ordens_servicos AS os
			WHERE cast(YEAR(os.data_criacao) as date) =  cast(YEAR(now()) as date) AND cast(MONTH(os.data_criacao) as date) = cast(MONTH(now()) as date)
			ORDER BY os.id_ordem_servico DESC LIMIT 1;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarIdLocal($nome){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, 
			"SELECT id_local
			FROM locais AS lo
			WHERE lo.cidade = '".$nome."'"
		);
		
		desconectarBanco($conn);
		
		$id = $sql->fetch_row();	
		return $id[0];
		
	}
	
	function buscarIdExecucao($nome){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, 
			"SELECT id_tipo_execucao
			FROM tipos_execucao AS te
			WHERE te.nome = '".$nome."'"
		);
		
		desconectarBanco($conn);
		
		$id = $sql->fetch_row();	
		return $id[0];
		
	}
	
	function buscarIdBatedor($nome){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, 
			"SELECT id_ficha_colaborador
			FROM fichas_colaboradores AS fc
			WHERE fc.apelido = '".$nome."'"
		);
		
		desconectarBanco($conn);
		
		$id = $sql->fetch_row();	
		return $id[0];
		
	}
	
	function buscarIdFrotaPlaca($placa){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, 
			"SELECT id_veiculo
			FROM veiculos AS ve
			WHERE ve.placa = '".$placa."'"
		);
		
		desconectarBanco($conn);
		
		$id = $sql->fetch_row();	
		return $id[0];
		
	}
	
	function buscarIdFrota($nome){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, 
			"SELECT id_veiculo
			FROM veiculos AS ve
			WHERE ve.frota = '".$nome."'"
		);
		
		desconectarBanco($conn);
		
		$id = $sql->fetch_row();	
		return $id[0];
		
	}
	
	function buscarFrota($id){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, 
			"SELECT *
			FROM veiculos AS ve
			WHERE ve.id_veiculo = '".$id."'"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarPrestacaoServico($os_num){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, 
			"SELECT *
			FROM prestacao_servicos AS ps
			WHERE ps.ordens_servicos_id_ordem_servico = (SELECT id_ordem_servico FROM ordens_servicos WHERE num_os = '".$os_num."');"
		);
		
		desconectarBanco($conn);
		
		return mysqli_num_rows($sql);
		
	}
	
	function buscarPrecificaoOS($origem, $destino, $cliente){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, 
			"SELECT *
			FROM locais_precificacao AS lp
			WHERE 
				locais_id_origem = ".$origem." AND
				locais_id_destino = ".$destino." AND
				(clientes_id_cliente = '".$cliente."' OR '' = '".$cliente."');"
			
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarUserEmail($login){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, 
			"SELECT *
			FROM emails AS em
			WHERE em.dados_pessoais_id_dados_pessoais= ".$login
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscargerenteEnfermeiro($id_pessoa){
		
		/*
		0 ge.id_GERENTE_ENFERMEIRO
		1 ge.coren
		*/
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, 
			"SELECT ge.id_gerente_enfermeiro, ge.coren
			FROM dados_pessoais AS dp
			INNER JOIN fichas_colaboradores AS fc
			ON fc.dados_pessoais_id_dados_pessoais = dp.id_dados_pessoais
			INNER JOIN gerentes_enfermeiros AS ge
			ON fc.id_ficha_colaborador = ge.fichas_colaboradores_id_ficha_colaborador
			WHERE dp.id_dados_pessoais = ".$id_pessoa
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarEnfermeiro($id_pessoa){
		
		/*
		0 ef.id_ENFERMEIRO
		1 ef.coren
		*/
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, 
			"SELECT ef.id_enfermeiro, ef.coren
			FROM dados_pessoais AS dp
			INNER JOIN fichas_colaboradores AS fc
			ON fc.dados_pessoais_id_dados_pessoais = dp.id_dados_pessoais
			INNER JOIN enfermeiros AS ef
			ON fc.id_ficha_colaborador = ef.fichas_colaboradores_id_ficha_colaborador
			WHERE dp.id_dados_pessoais = ".$id_pessoa
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarMotoristaEscolta($id_pessoa){
		
		/*
		0 me.id_motorista_escolta
		1 me.credencial
		2 me.validade_credencial
		*/
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, 
			"SELECT me.id_motorista_escolta, me.credencial, me.validade_credencial
			FROM dados_pessoais AS dp
			INNER JOIN fichas_colaboradores AS fc
			ON fc.dados_pessoais_id_dados_pessoais = dp.id_dados_pessoais
			INNER JOIN motoristas_escolta AS me
			ON fc.id_ficha_colaborador = me.fichas_colaboradores_id_ficha_colaborador
			WHERE dp.id_dados_pessoais = ".$id_pessoa
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarMotoristaAmbulancia($id_pessoa){
		
		/*
		0 ma.id_motorista_ambulancia
		1 ma.credencial
		2 ma.validade_credencial
		*/
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, 
			"SELECT ma.id_motorista_ambulancia, ma.credencial, ma.validade_credencial
			FROM dados_pessoais AS dp
			INNER JOIN fichas_colaboradores AS fc
			ON fc.dados_pessoais_id_dados_pessoais = dp.id_dados_pessoais
			INNER JOIN motoristas_ambulancias AS ma
			ON fc.id_ficha_colaborador = ma.fichas_colaboradores_id_ficha_colaborador
			WHERE dp.id_dados_pessoais = ".$id_pessoa
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarPessoaDependenteTitular($id_dependente){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, 
			"SELECT id_dados_pessoais
			FROM dados_pessoais AS dp
			WHERE dp.id_dados_pessoais = 
				(SELECT dados_pessoais_id_dados_pessoais_dependente FROM dependentes WHERE id_dependente = ".$id_dependente.");"
		);
		
		desconectarBanco($conn);
		
		$sql = $sql->fetch_row();
		
		return $sql;
		
	}
	
	function buscarArquivosPessoa($id,$tipo){ //Pronto
		
		/*
		0 dop.id_documento_pessoa
		1 dop.link
		2 dop.nome
		3 dop.descricao
		4 td.nome
		*/
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT dop.id_documento_pessoa, dop.link, dop.nome, dop.descricao, dop.tipagem, td.nome			
			FROM dados_pessoais AS dp
			INNER JOIN documentos_pessoas AS dop
			ON dop.dados_pessoais_id_dados_pessoais = dp.id_dados_pessoais
			INNER JOIN tipos_documentos AS td
			ON td.id_tipo_documento = dop.tipos_documentos_id_tipo_documento
			WHERE dp.id_dados_pessoais = '".$id."' AND dop.foto = '".$tipo."'
			ORDER BY dop.id_documento_pessoa DESC;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarArquivosCliente($id){ //Pronto
		
		/*
		0 dop.id_documento_pessoa
		1 dop.link
		2 dop.nome
		3 dop.descricao
		4 td.nome
		*/
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"
			SELECT dc.id_documento_clientes, dc.link, dc.nome, dc.descricao, cl.nome
			FROM clientes AS cl
			INNER JOIN documentos_clientes AS dc
			ON dc.clientes_id_cliente = cl.id_cliente
			INNER JOIN tipos_documentos AS td
			ON td.id_tipo_documento = dc.tipos_documentos_id_tipo_documento
			WHERE cl.id_cliente = '".$id."'
			ORDER BY dc.id_documento_clientes DESC;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarIdDadosPessoais($cpf, $nome){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT id_dados_pessoais
			FROM dados_pessoais AS dp
			WHERE dp.cpf = '".$cpf."' AND dp.nome = '".$nome."'
			ORDER BY dp.id_dados_pessoais DESC LIMIT 1;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarIdEndereco($enderecoCEP){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT ed.id_endereco
			FROM enderecos AS ed
			WHERE ed.cep = '".$enderecoCEP."'
			ORDER BY ed.id_endereco DESC LIMIT 1;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarIdDependente($cpf){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT de.id_dependente
			FROM dados_pessoais AS dp
			INNER JOIN dependentes AS de
			ON dp.id_dados_pessoais = de.dados_pessoais_id_dados_pessoais_dependente
			WHERE dp.cpf = '".$cpf."'
			ORDER BY de.dados_pessoais_id_dados_pessoais_dependente DESC LIMIT 1;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarIdCliente($razao_social, $fantasia, $cnpj, $inscricao_municipal){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT cl.id_cliente
			FROM clientes AS cl
			WHERE cl.nome = '".$razao_social."' AND fantasia = '".$fantasia."' AND cnpj = '".$cnpj."' AND inscricao_municipal = '".$inscricao_municipal."'
			ORDER BY cl.id_cliente DESC LIMIT 1;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarIdEnderecoCliente($enderecoCEP){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT ed.id_endereco_cliente
			FROM enderecos_clientes AS ed
			WHERE ed.cep = '".$enderecoCEP."'
			ORDER BY ed.id_endereco_cliente DESC LIMIT 1;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarDadosNota1($prestadora, $tomadora, $periodo_inicio, $periodo_final, $cte, $note){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM clientes AS cl
			LEFT JOIN enderecos_clientes AS ec
			ON ec.clientes_id_cliente = cl.id_cliente
			LEFT JOIN contatos_clientes AS cc
			ON cc. clientes_id_cliente = cl.id_cliente
			
			INNER JOIN prestacao_servicos AS ps
			ON ps.clientes_id_cliente = cl.id_cliente
			INNER JOIN ordens_servicos AS os
			ON ps.ordens_servicos_id_ordem_servico = os.id_ordem_servico
			
			INNER JOIN empresas AS em
			ON em.id_empresa = ps.empresas_id_empresa
			LEFT JOIN contatos_empresas AS ce
			ON ce.empresas_id_empresa = em.id_empresa
			LEFT JOIN enderecos_empresas AS ee
			ON ee.empresas_id_empresa = em.id_empresa
			
			LEFT JOIN locais_precificacao AS lp
			ON lp.clientes_id_cliente = cl.id_cliente
			
			WHERE cl.id_cliente = '".$tomadora."' AND em.id_empresa = '".$prestadora."' AND
			STR_TO_DATE(os.data_edicao, '%Y-%m-%d') BETWEEN date('".$periodo_inicio."') AND date('".$periodo_final."') AND
			ps.cte = '".$cte."' AND ps.nf = '".$note."'
			ORDER BY os.id_ordem_servico DESC;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarDadosNota2($prestadora, $tomadora, $periodo_inicio, $periodo_final, $cte){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM clientes AS cl
			LEFT JOIN enderecos_clientes AS ec
			ON ec.clientes_id_cliente = cl.id_cliente
			LEFT JOIN contatos_clientes AS cc
			ON cc. clientes_id_cliente = cl.id_cliente
			
			INNER JOIN prestacao_servicos AS ps
			ON ps.clientes_id_cliente = cl.id_cliente
			INNER JOIN ordens_servicos AS os
			ON ps.ordens_servicos_id_ordem_servico = os.id_ordem_servico
			
			INNER JOIN empresas AS em
			ON em.id_empresa = ps.empresas_id_empresa
			LEFT JOIN contatos_empresas AS ce
			ON ce.empresas_id_empresa = em.id_empresa
			LEFT JOIN enderecos_empresas AS ee
			ON ee.empresas_id_empresa = em.id_empresa
			
			LEFT JOIN locais_precificacao AS lp
			ON lp.clientes_id_cliente = cl.id_cliente
			
			WHERE cl.id_cliente = '".$tomadora."' AND em.id_empresa = '".$prestadora."' AND
			STR_TO_DATE(os.data_edicao, '%Y-%m-%d') BETWEEN date('".$periodo_inicio."') AND date('".$periodo_final."') AND
			ps.cte = '".$cte."'
			ORDER BY os.id_ordem_servico DESC;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarDadosNota3($prestadora, $tomadora, $periodo_inicio, $periodo_final, $note){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM clientes AS cl
			LEFT JOIN enderecos_clientes AS ec
			ON ec.clientes_id_cliente = cl.id_cliente
			LEFT JOIN contatos_clientes AS cc
			ON cc. clientes_id_cliente = cl.id_cliente
			
			INNER JOIN prestacao_servicos AS ps
			ON ps.clientes_id_cliente = cl.id_cliente
			INNER JOIN ordens_servicos AS os
			ON ps.ordens_servicos_id_ordem_servico = os.id_ordem_servico
			
			INNER JOIN empresas AS em
			ON em.id_empresa = ps.empresas_id_empresa
			LEFT JOIN contatos_empresas AS ce
			ON ce.empresas_id_empresa = em.id_empresa
			LEFT JOIN enderecos_empresas AS ee
			ON ee.empresas_id_empresa = em.id_empresa
			
			LEFT JOIN locais_precificacao AS lp
			ON lp.clientes_id_cliente = cl.id_cliente
			
			WHERE cl.id_cliente = '".$tomadora."' AND em.id_empresa = '".$prestadora."' AND
			STR_TO_DATE(os.data_edicao, '%Y-%m-%d') BETWEEN date('".$periodo_inicio."') AND date('".$periodo_final."') AND
			ps.nf = '".$note."'
			ORDER BY os.id_ordem_servico DESC;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarDadosNota4($prestadora, $tomadora, $periodo_inicio, $periodo_final){
		
		$conn = conectarBanco();
		
		/*cl.nome,
		cl.fantasia,
		cl.cnpj,
		cl.inscricao_municipal,

		ec.cep,
		ec.numero,
		ec.bairro,
		ec.logradouro,
		ec.cidade,
		ec.complemento,
		
		eb.sigla,

		cc.telefone,
		cc.email,

		ps.cte,
		ps.conjunto_placa,
		ps.motorista_cliente,
		ps.nf,
		ps.aet,
		
		cg.nome,

		os.num_os,
		os.c_data_saida,
		os.c_data_chegada,
		os.s_data_saida,
		os.s_data_chegada,
		os.diaria,
		os.nome_acao,
		os.km_inicial,
		os.km_final,

		te.nome,

		ve.placa,
		ve.frota,

		vc.credencial,

		lco.cidade,

		ebo.sigla,

		lcd.cidade,

		ebd.sigla,

		dp.nome,

		em.nome,
		em.fantasia,

		ce.telefone,
		ce.email,

		ee.cep,
		ee.numero,
		ee.bairro,
		ee.logradouro,
		ee.cidade,
		ee.complemento

		ebee.sigla,

		lp.valor*/

		$sql = mysqli_query($conn,
			"SELECT 
				cl.nome,
				cl.fantasia,
				cl.cnpj,
				cl.inscricao_municipal,

				ec.cep,
				ec.numero,
				ec.bairro,
				ec.logradouro,
				ec.cidade,
				ec.complemento,
				
				eb.sigla,

				cc.telefone,
				cc.email,

				ps.cte,
				ps.conjunto_placa,
				ps.motorista_cliente,
				ps.nf,
				ps.aet,
				
				cg.nome,

				os.num_os,
				os.c_data_saida,
				os.c_data_chegada,
				os.s_data_saida,
				os.s_data_chegada,
				os.diaria,
				os.nome_acao,
				os.km_inicial,
				os.km_final,

				te.nome,

				ve.placa,
				ve.frota,

				vc.credencial,

				lco.cidade,

				ebo.sigla,

				lcd.cidade,

				ebd.sigla,

				dp.nome,

				em.nome,
				em.fantasia,

				ce.telefone,
				ce.email,

				ee.cep,
				ee.numero,
				ee.bairro,
				ee.logradouro,
				ee.cidade,
				ee.complemento,

				ebee.sigla,

				lp.valor
			FROM clientes AS cl
			LEFT JOIN enderecos_clientes AS ec
			ON ec.clientes_id_cliente = cl.id_cliente
			LEFT JOIN contatos_clientes AS cc
			ON cc. clientes_id_cliente = cl.id_cliente
			LEFT JOIN estados_brasil AS eb
			ON eb.id_estado_brasil = ec.estados_brasil_id_estado_brasil
			
			INNER JOIN prestacao_servicos AS ps
			ON ps.clientes_id_cliente = cl.id_cliente
			INNER JOIN ordens_servicos AS os
			ON ps.ordens_servicos_id_ordem_servico = os.id_ordem_servico
			LEFT JOIN cargas AS cg
			ON cg.id_carga = ps.cargas_id_carga
			LEFT JOIN tipos_execucao AS te
			ON os.tipos_execucao_id_tipo_execucao = te.id_tipo_execucao
			LEFT JOIN veiculos AS ve
			ON ve.id_veiculo = os.veiculos_id_veiculo
			LEFT JOIN veiculos_credenciais AS vc
			ON vc.veiculos_id_veiculo = ve.id_veiculo
			LEFT JOIN locais AS lco
			ON lco.id_local = os.locais_id_origem
			LEFT JOIN estados_brasil AS ebo
			ON ebo.id_estado_brasil = lco.estados_brasil_uf_local
			LEFT JOIN locais AS lcd
			ON lcd.id_local = os.locais_id_destino
			LEFT JOIN estados_brasil AS ebd
			ON ebd.id_estado_brasil = lcd.estados_brasil_uf_local
			LEFT JOIN fichas_colaboradores AS fc
			ON fc.id_ficha_colaborador = os.fichas_colaboradores_id_ficha_colaborador
			LEFT JOIN dados_pessoais AS dp
			ON dp.id_dados_pessoais = fc.dados_pessoais_id_dados_pessoais

			INNER JOIN empresas AS em
			ON em.id_empresa = os.empresas_id_empresa
			LEFT JOIN contatos_empresas AS ce
			ON ce.empresas_id_empresa = em.id_empresa
			LEFT JOIN enderecos_empresas AS ee
			ON ee.empresas_id_empresa = em.id_empresa
			LEFT JOIN estados_brasil AS ebee
			ON ebee.id_estado_brasil = ee.estados_brasil_id_estado_brasil
			
			LEFT JOIN locais_precificacao AS lp
			ON lp.clientes_id_cliente = cl.id_cliente
			
			WHERE cl.id_cliente = '".$tomadora."' AND em.id_empresa = '".$prestadora."' AND
			STR_TO_DATE(os.data_edicao, '%Y-%m-%d') BETWEEN date('".$periodo_inicio."') AND date('".$periodo_final."')
			ORDER BY os.id_ordem_servico DESC;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarUltimoDadosBancarios(){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"SELECT id_dados_bancarios FROM dados_bancarios ORDER BY id_dados_bancarios DESC LIMIT 1;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarUltimoEmail(){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"SELECT id_email FROM emails ORDER BY id_email DESC LIMIT 1;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarUltimoContato($contatosTelefone){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"SELECT id_telefone FROM telefones WHERE '".$contatosTelefone."' = telefone ORDER BY id_telefone DESC LIMIT 1;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarVeiculo($placa){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"SELECT 1 FROM veiculos WHERE '".$placa."' = placa ORDER BY id_veiculo DESC LIMIT 1;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarVeiculoDados($placa){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"SELECT * FROM veiculos WHERE '".$placa."' = placa ORDER BY id_veiculo DESC LIMIT 1;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarVincularOSVeiculo($placa){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"SELECT os.num_os, lo.latitude, lo.longitude, lo.cidade, eb.sigla, ve.link_img
			FROM ordens_servicos AS os
			INNER JOIN veiculos AS ve
			ON ve.id_veiculo = os.veiculos_id_veiculo
			INNER JOIN locais AS lo
			ON lo.id_local = os.locais_id_destino
			INNER JOIN estados_brasil AS eb
			ON eb.id_estado_brasil = lo.estados_brasil_uf_local
			
			WHERE '".$placa."' = ve.placa 
			AND (s_data_saida IS NULL OR s_data_saida = '000-00-00')
			ORDER BY ve.id_veiculo DESC LIMIT 1;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarIdContatoCliente($idCliente){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"SELECT cc.id_contato
			FROM contatos_clientes AS cc
			WHERE 8 = cc.clientes_id_cliente
			ORDER BY cc.id_contato DESC LIMIT 1;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarIdEstado($verificador){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"SELECT eb.id_estado_brasil
			FROM estados_brasil AS eb
			WHERE eb.nome = '".$verificador."'
			ORDER BY eb.id_estado_brasil DESC LIMIT 1;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarIdEstadoCivil($verificador){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"SELECT ec.id_estado_civil
			FROM estados_civis AS ec
			WHERE ec.nome = '".$verificador."'
			ORDER BY ec.id_estado_civil DESC LIMIT 1;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarIdSexo($verificador){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"SELECT se.id_sexo
			FROM sexos AS se
			WHERE se.nome = '".$verificador."'
			ORDER BY se.id_sexo DESC LIMIT 1;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarIdTipoSanguineo($verificador){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"SELECT ts.id_tipo_sanguineo
			FROM tipos_sanguineos AS ts
			WHERE ts.nome = '".$verificador."'
			ORDER BY ts.id_tipo_sanguineo DESC LIMIT 1;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarIdEscolaridade($verificador){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"SELECT es.id_escolaridade
			FROM escolaridade AS es
			WHERE es.nome = '".$verificador."'
			ORDER BY es.id_escolaridade DESC LIMIT 1;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarIdCNHCategoria($verificador){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"SELECT cc.id_cnh_categoria
			FROM cnh_categorias	AS cc
			WHERE cc.nome = '".$verificador."'
			ORDER BY cc.id_cnh_categoria DESC LIMIT 1;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function buscarIdCargo($verificador){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"SELECT cg.id_cargo
			FROM cargos	AS cg
			WHERE cg.nome = '".$verificador."'
			ORDER BY cg.id_cargo DESC LIMIT 1;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}

	function buscarIdUltimaLocalizacaoCadastrada(){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT id_local
			FROM locais
			ORDER BY id_local DESC LIMIT 1;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	/*Validações*/
	
	function validarConexao($login, $senha) { //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, "
			SELECT us.id_usuario, pe.id_perfil, us.usuario
			FROM usuarios AS us
			INNER JOIN perfis AS pe
			ON pe.id_perfil = us.perfis_id_perfil
			WHERE us.usuario = '".$login."' AND us.senha = '".$senha."'
			ORDER BY us.id_usuario DESC LIMIT 1;"
			);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function validarConexaoCliente($login, $senha) { //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn, "
			SELECT uc.id_usuario_cliente, 4, uc.usuario
			FROM usuarios_clientes AS uc
			WHERE uc.usuario = '".$login."' AND uc.senha = '".$senha."'
			ORDER BY uc.id_usuario_cliente DESC LIMIT 1;"
			);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function validarUserLogin($user) { //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT us.usuario 
			FROM usuarios AS us
			WHERE us.usuario = '".$user."'
			ORDER BY us.id_usuario DESC;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
		function validarCPF($cpf) { //Pronto

		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT dp.cpf 
			FROM dados_pessoais AS dp
			WHERE dp.cpf = '".$cpf."'
			ORDER BY dp.cpf DESC;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function validarCPFUser($id,$cpf){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT * 
			FROM dados_pessoais AS dp
			WHERE dp.cpf = '".$cpf."' AND dp.id_dados_pessoais = ".$id."
			AND 0 = 
			(SELECT COUNT(id_dependente) FROM dependentes WHERE ".$id." = dados_pessoais_id_dados_pessoais_dependente)
			ORDER BY dp.id_dados_pessoais DESC;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	 function validarCriarLogin($email, $codigo){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM liberar_acesso
			WHERE emails_id_email = '".$email."' AND codigo = '".$codigo."'
			ORDER BY id_liberar_acesso DESC;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	 }
	 
	 function validarUsuarioCriado($email){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"DELETE FROM liberar_acesso 
			WHERE data_criacao
			NOT BETWEEN DATE_SUB(NOW(), INTERVAL 2 DAY) AND NOW();"
		);
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM emails AS em
			INNER JOIN dados_pessoais AS ap
			ON em.dados_pessoais_id_dados_pessoais = dp.id_dados_pessoais
			INNER JOIN usuarios AS us
			ON dp.id_dados_pessoais = us.dados_pessoais_id_dados_pessoais
			WHERE em.email = '".$email."'
			ORDER BY dp.id_dados_pessoais DESC;"
		);
		
		desconectarBanco($conn);
		
		return mysqli_num_rows($sql);
		
	 }
	
	function validarApelido($apelido){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM fichas_colaboradores
			WHERE apelido = '".$apelido."' AND dados_pessoais_id_dados_pessoais != '".$_SESSION['idDadosPessoais']."'
			ORDER BY id_ficha_colaborador DESC;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function validarMatricula($matricula){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM fichas_colaboradores
			WHERE matricula = '".$matricula."' AND dados_pessoais_id_dados_pessoais != '".$_SESSION['idDadosPessoais']."'
			ORDER BY id_ficha_colaborador DESC;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function contarAcoesOSRealizadas($num_os){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT SUM(av.id_acao_veiculo) 
			FROM acoes_veiculos AS av
			LEFT JOIN ordens_servicos_acoes_veiculos AS osav
			ON osav.acoes_veiculos_id_acao_veiculo = av.id_acao_veiculo
			LEFT JOIN ordens_servicos AS os
			ON os.id_ordem_servico = osav.ordens_servicos_id_ordem_servico
			WHERE av.situacao = 0 AND os.num_os = '".$num_os."'
			ORDER BY av.id_acao_veiculo ASC"
		);
		
		return $sql;
	}
	
	function validarPrecificacao($contrato, $origem, $destino, $cliente){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT 1 
			FROM locais_precificacao AS lp
			WHERE lp.contrato = '".$contrato."' AND locais_id_origem = '".$origem."' AND 
			lp.locais_id_destino = '".$destino."'AND lp.clientes_id_cliente = '".$cliente."'"
		);
		
		return $sql;
	}
	
	/*Listagens*/
	
	function listarRemuneracao($id){
		
		/*	
		SALARIOS
		0 sa.id_salario
		1 sa.valor
		2 sa.data_inicio
		3 sa.data_fim
		4 sa.data_criacao
		5 sa.data_edicao
		6 sa.financeiro_colaboradores_id_financeiro_colaborador
		*/
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT sa.id_salario, sa.valor, sa.data_inicio, sa.data_fim, sa.data_criacao, sa.data_edicao, sa.financeiro_colaboradores_id_financeiro_colaborador
			FROM salarios AS sa
			INNER JOIN financeiro_colaboradores AS fc
			ON fc.id_financeiro_colaborador = sa.financeiro_colaboradores_id_financeiro_colaborador
			INNER JOIN fichas_colaboradores AS fco
			ON fco.id_ficha_colaborador = fc.fichas_colaboradores_id_ficha_colaborador
			WHERE fco.dados_pessoais_id_dados_pessoais = '".$id."'
			ORDER BY sa.data_inicio DESC;"
		);
		
		desconectarBanco($conn);
		
		return $sql;

	}

	function listarCargosJornada() {  //Pronto
		/*	
		JORNADAS
		0 jo.id_jornada,
		1 jo.horas_semanais,
		2 jo.horas_mensais,
		3 jo.hora_extra_maxima,
		4 jo.domingo
		5 jo.segunda,
		6 jo.terca,
		7 jo.quarta,
		8 jo.quinta,
		9 jo.sexta,
		10 jo.sabadoo

		CARGOS
		11 ca.nome
		*/
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT jo.id_jornada, jo.horas_semanais, jo.horas_mensais, jo.hora_extra_maxima, jo.domingo, jo.segunda, jo.terca, jo.quarta, jo.quinta, jo.sexta, jo.sabado, ca.nome
			FROM jornadas AS jo
			INNER JOIN cargos AS ca
			ON ca.jornadas_id_jornada = jo.id_jornada
			ORDER BY jo.id_jornada DESC;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}

	function listarCargosSalario() {  //Pronto
		/*	
		CARGOS
		0 ca.id_cargo
		1 ca.nome
		2 ca.salario_base
		*/
		
		$conn = conectarBanco();

		$sql = mysqli_query($conn,
			"SELECT ca.id_cargo, ca.nome, ca.salario_base
			FROM cargos AS ca
			WHERE salario_base != ''
			ORDER BY ca.id_cargo DESC;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}

	function listarJornada() {  //Pronto
		/*	
		JORNADAS
		0 jo.id_jornada,
		1 jo.horas_semanais,
		2 jo.horas_mensais,
		3 jo.hora_extra_maxima,
		4 jo.domingo
		5 jo.segunda,
		6 jo.terca,
		7 jo.quarta,
		8 jo.quinta,
		9 jo.sexta,
		10 jo.sabadoo
		*/
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT jo.id_jornada, jo.horas_semanais, jo.horas_mensais, jo.hora_extra_maxima, jo.domingo, jo.segunda, jo.terca, jo.quarta, jo.quinta, jo.sexta, jo.sabado
			FROM jornadas AS jo
			INNER JOIN fichas_colaboradores AS fc
			ON jo.fichas_colaboradores_id_ficha_colaborador = fc.id_ficha_colaborador
			WHERE fc.dados_pessoais_id_dados_pessoais = ".$_SESSION['idDadosPessoais']."
			ORDER BY jo.id_jornada DESC LIMIT 1;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}

	function listarColaboradores() {  //Pronto
		/*	
		DADOS PESSOAIS
		0 dp.id_dados_pessoais,
		1 dp.nome,
		
		DADOS PROFISSIONAIS
		2 fc.matricula, 
		3 fc.data_admissao, 
		4 ca.nome,
		5 fc.data_demissao
		
		DADOS EMPRESA
		6 em.fantasia
		
		CARGO
		7 ca.id_cargo
		*/
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT dp.id_dados_pessoais, dp.nome, fc.matricula, fc.data_admissao, ca.nome, fc.data_demissao, em.fantasia, ca.id_cargo
			FROM dados_pessoais AS dp
			INNER JOIN fichas_colaboradores AS fc
			ON dp.id_dados_pessoais = fc.dados_pessoais_id_dados_pessoais
			LEFT JOIN cargos AS ca
			ON fc.cargos_id_cargo = ca.id_cargo
			LEFT JOIN empresas AS em
			ON em.id_empresa = fc.empresas_id_empresa
			ORDER BY fc.matricula ASC;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listaDadosPessoais() { //Pronto
	
		/*
		DADOS PESSOAIS
		0 dp.id_dados_pessoais
		1 dp.nome,
		2 dp.cpf,  
		3 dp.numero_rg, 
		4 ebrg.nome
		5 dp.emissao_rg, 
		6 dp.emissor_rg,   
		7 dp.data_nascimento, 
		8 dp.nome_mae,
		9 dp.nome_pai
	
		10 sx.nome
		11 ts.nome
		12 ec.nome
		13 es.nome
		14 dp.naturalidade
		15 ebnt.nome
		16 dp.num_titulo_eleitoral
		17 dp.secao_titulo_eleitoral
		18 dp.zona_titulo_eleitoral
		19 dp.emissao_titulo_eleitoral
		20 dp.municipio_titulo_eleitoral
		21 ebet.nome
		22 dp.num_cnh
		23 cc.nome
		24 dp.vencimento_cnh
		25 dp.num_reservista
		26 dp.num_sus
		27 cj.nome
		28 cj.cpf
		29 cj.data_nascimento
		
		*/
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT dp.id_dados_pessoais, dp.nome, dp.cpf,  dp.numero_rg, ebrg.nome, dp.emissao_rg, dp.emissor_rg, dp.data_nascimento, dp.nome_mae, dp.nome_pai, sx.nome, ts.nome, ec.nome, es.nome, dp.naturalidade, ebnt.nome, dp.num_titulo_eleitoral, dp.secao_titulo_eleitoral, dp.zona_titulo_eleitoral, dp.emissao_titulo_eleitoral, dp.municipio_titulo_eleitoral, ebet.nome, dp.num_cnh, cc.nome, dp.vencimento_cnh, dp.num_reservista, dp.num_sus, cj.nome, cj.cpf, cj.data_nascimento
			FROM dados_pessoais AS dp			
			LEFT JOIN estados_brasil AS ebrg
			ON dp.estados_brasil_estado_rg = ebrg.id_estado_brasil
			LEFT JOIN estados_brasil AS ebnt
			ON dp.estados_brasil_uf_naturalidade = ebnt.id_estado_brasil
			LEFT JOIN estados_brasil AS ebet
			ON dp.estados_brasil_uf_titulo_eleitoral = ebet.id_estado_brasil
			LEFT JOIN tipos_sanguineos AS ts
			ON dp.tipos_sanguineos_id_tipo_sanguineo = ts.id_tipo_sanguineo
			LEFT JOIN sexos AS sx
			ON dp.sexos_id_sexo = sx.id_sexo
			LEFT JOIN escolaridade AS es
			ON dp.escolaridade_id_escolaridade  = es.id_escolaridade
			LEFT JOIN cnh_categorias AS cc
			ON dp.cnh_categorias_id_cnh_categoria  = cc.id_cnh_categoria			
			LEFT JOIN estados_civis AS ec
			ON dp.estados_civis_id_estado_civil = ec.id_estado_civil
			LEFT JOIN conjujes AS cj
			ON cj.dados_pessoais_id_dados_pessoais = dp.id_dados_pessoais
			
			
			WHERE dp.id_dados_pessoais = ".$_SESSION['idDadosPessoais']."
			ORDER BY dp.nome DESC;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarDadosProfissionais() { //Pronto
		
		/*	
			
		DADOS PROFISSIONAIS
		0 fc.id_ficha_colaboradores
		1 fc.matricula, 
		2 fc.apelido
		3 fc.data_admissao, 
		4 fc.data_demissao, 
		5 fc.nome_sindicato_vinculado,
		6 fc.ativo,
		
		7 fc.pis_pasep
		8 fc.num_ctps
		9 fc.serie_ctps
		10 eb.nome
		11 fc.emissao_ctps
		 
	 	12 ca.id_cargo,
	 	13 ca.nome
		
		14 fc.dados_pessoais_id_dados_pessoais

		15 te.data_inicio
		16 te.data_fim
		*/
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT fc.id_ficha_colaborador, fc.matricula, fc.apelido, fc.data_admissao, fc.data_demissao, fc.nome_sindicato_vinculado, fc.ativo, fc.pis_pasep, fc.num_ctps, fc.serie_ctps, eb.nome, fc.emissao_ctps, ca.id_cargo, ca.nome, fc.dados_pessoais_id_dados_pessoais, te.data_inicio, te.data_fim
			FROM dados_pessoais AS dp
			RIGHT JOIN fichas_colaboradores AS fc
			ON fc.dados_pessoais_id_dados_pessoais = dp.id_dados_pessoais
			LEFT OUTER JOIN cargos AS ca
			ON ca.id_cargo = fc.cargos_id_cargo
			LEFT JOIN estados_brasil AS eb
			ON fc.estados_brasil_uf_ctps = eb.id_estado_brasil
			LEFT JOIN tempo_experiencia AS te
			ON fc.tempo_experiencia_id_tempo_experiencia = te.id_tempo_experiencia
			WHERE dp.id_dados_pessoais = '".$_SESSION['idDadosPessoais']."'
			ORDER BY fc.id_ficha_colaborador DESC;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarEnderecos() { //Pronto

		/*
		0 dp.id_dados_pessoais
		1 ed.id_endereco
		2 ed.cep
		3 ed.numero
		4 ed.bairro
		5 eb.nome
		6 ed.cidade
		7 ed.complemento
		8 ed.ponto_referencia
		9 ed.logradouro
		*/
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT dp.id_dados_pessoais, ed.id_endereco, ed.cep, ed.numero, ed.bairro, eb.nome, ed.cidade, ed.complemento, ed.ponto_referencia, ed.logradouro
			FROM enderecos AS ed
			INNER JOIN dados_pessoais AS dp
			ON ed.dados_pessoais_id_dados_pessoais= dp.id_dados_pessoais
			INNER JOIN estados_brasil AS eb
			ON ed.estados_brasil_estado = eb.id_estado_brasil
			WHERE dp.id_dados_pessoais = ".$_SESSION['idDadosPessoais']."
			ORDER BY ed.id_endereco DESC;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarTelefones() { //Pronto
		/*
		0 dp.id_dados_pessoais
		1 tf.id_telefone
		2 tf.telefone
		3 tf.whatsapp
		4 tf.nome_contato
		5 tf.tipos_contatos_id_tipo_contato
		*/
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT dp.id_dados_pessoais, tf.id_telefone, tf.telefone, tf.whatsapp, tf.nome_contato, tf.tipos_contatos_id_tipo_contato
			FROM dados_pessoais AS dp
			LEFT JOIN telefones AS tf
			ON tf.dados_pessoais_id_dados_pessoais = dp.id_dados_pessoais
			WHERE dp.id_dados_pessoais = ".$_SESSION['idDadosPessoais']."
			ORDER BY tf.id_telefone DESC;"
		);
		
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	
	function listarEstados() { //Pronto
	
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM estados_brasil;"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarCargos() { //Pronto
	
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM cargos;"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarSexos() { //Pronto
	
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM sexos;"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarEstadosCivis() { //Pronto
	
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM estados_civis;"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarTiposSanguineos() { // Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM tipos_sanguineos;"
		);
				
		desconectarBanco($conn);
		
		return $sql;
	}
	
	function listarCNHCategorias() { //Pronto
	
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM cnh_categorias;"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarEscolaridade() { //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM escolaridade;"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarEmpresas(){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM empresas;"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarOSPS (){ //Pronto (OSPS => Ordens Servicos Prestacao Servico)
		
		/*
		0 os.num_os,
		1 em.fantasia,
		2 ve.frota
		3 ve.placa
		4 fc.apelido
		5 cl.fantasia
		6 ca.nome
		7 te.nome
		8 ps.conjunto_placa
		9 ps.motorista_cliente
		10 loo.cidade
		11 os.c_data_chegada
		12 os.c_data_saida
		13 os.km_inicial
		14 lod.cidade
		15 os.s_data_chegada
		16 os.s_data_saida
		17 os.km_final
		18 os.diaria
		19 ps.cte
		20 ps.nf
		21 ps.aet
		22 ps.contrato, 
		
		23 lp.km
		24 lp.valor
		25 lp.transit_time
		*/
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT os.num_os, em.fantasia, ve.frota, ve.placa, fc.apelido, cl.fantasia, ca.nome, te.nome, ps.conjunto_placa, ps.motorista_cliente,
				loo.cidade, os.c_data_chegada, os.c_data_saida, os.km_inicial, lod.cidade, os.s_data_chegada, os.s_data_saida, os.km_final,
				os.diaria, ps.cte, ps.nf, ps.aet, ps.contrato, lp.km, lp.valor, lp.transit_time
			
			FROM ordens_servicos AS os
			LEFT JOIN prestacao_servicos AS ps
			ON os.id_ordem_servico = ps.ordens_servicos_id_ordem_servico
			LEFT JOIN empresas AS em
			ON os.empresas_id_empresa = em.id_empresa
			LEFT JOIN veiculos AS ve
			ON ve.id_veiculo = os.veiculos_id_veiculo
			LEFT JOIN fichas_colaboradores AS fc
			ON fc.id_ficha_colaborador = os.fichas_colaboradores_id_ficha_colaborador
			LEFT JOIN dados_pessoais AS dp
			ON fc.dados_pessoais_id_dados_pessoais = dp.id_dados_pessoais
			LEFT JOIN clientes AS cl
			ON cl.id_cliente = ps.clientes_id_cliente
			LEFT JOIN cargas AS ca
			ON ps.cargas_id_carga = ca.id_carga
			LEFT JOIN tipos_execucao AS te
			ON os.tipos_execucao_id_tipo_execucao = te.id_tipo_execucao
			LEFT JOIN locais AS loo
			ON os.locais_id_origem = loo.id_local
			LEFT JOIN locais AS lod
			ON os.locais_id_destino = lod.id_local
			
			LEFT JOIN locais_precificacao AS lp
			ON cl.id_cliente = lp.clientes_id_cliente AND lp.contrato = ps.contrato
			
			WHERE os.data_criacao BETWEEN DATE_SUB(NOW(), INTERVAL 31 DAY) AND NOW() OR os.s_data_saida = NULL OR os.s_data_saida = '0000-00-00'

			
			ORDER BY os.id_ordem_servico DESC;
			"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarOSPSCliente ($id){ //Pronto (OSPS => Ordens Servicos Prestacao Servico)
		
		/*
		0 os.num_os,
		1 em.fantasia,
		2 ve.frota
		3 ve.placa
		4 fc.apelido
		5 cl.fantasia
		6 ca.nome
		7 te.nome
		8 ps.conjunto_placa
		9 ps.motorista_cliente
		10 loo.cidade
		11 os.c_data_chegada
		12 os.c_data_saida
		13 os.km_inicial
		14 lod.cidade
		15 os.s_data_chegada
		16 os.s_data_saida
		17 os.km_final
		18 os.diaria
		19 ps.cte
		20 ps.nf
		21 ps.aet
		*/
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT os.num_os, em.fantasia, ve.frota, ve.placa, fc.apelido, cl.fantasia, ca.nome, te.nome, ps.conjunto_placa, ps.motorista_cliente,
				loo.cidade, os.c_data_chegada, os.c_data_saida, os.km_inicial, lod.cidade, os.s_data_chegada, os.s_data_saida, os.km_final,
				os.diaria, ps.cte, ps.nf, ps.aet
			
			FROM ordens_servicos AS os
			LEFT JOIN prestacao_servicos AS ps
			ON os.id_ordem_servico = ps.ordens_servicos_id_ordem_servico
			LEFT JOIN empresas AS em
			ON os.empresas_id_empresa = em.id_empresa
			LEFT JOIN veiculos AS ve
			ON ve.id_veiculo = os.veiculos_id_veiculo
			LEFT JOIN fichas_colaboradores AS fc
			ON fc.id_ficha_colaborador = os.fichas_colaboradores_id_ficha_colaborador
			LEFT JOIN dados_pessoais AS dp
			ON fc.dados_pessoais_id_dados_pessoais = dp.id_dados_pessoais
			LEFT JOIN clientes AS cl
			ON cl.id_cliente = ps.clientes_id_cliente
			LEFT JOIN cargas AS ca
			ON ps.cargas_id_carga = ca.id_carga
			LEFT JOIN tipos_execucao AS te
			ON os.tipos_execucao_id_tipo_execucao = te.id_tipo_execucao
			LEFT JOIN locais AS loo
			ON os.locais_id_origem = loo.id_local
			LEFT JOIN locais AS lod
			ON os.locais_id_destino = lod.id_local
			
			WHERE cl.id_cliente = ".$id."

			ORDER BY os.id_ordem_servico DESC;
			"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarOSPSVisual (){ //Pronto (OSPS => Ordens Servicos Prestacao Servico)
		
		/*
		0 os.num_os,
		1 em.fantasia,
		2 ve.frota
		3 ve.placa
		4 fc.apelido
		5 cl.fantasia
		6 ca.nome
		7 te.nome
		8 ps.conjunto_placa
		9 ps.motorista_cliente
		10 loo.cidade
		11 os.c_data_chegada
		12 os.c_data_saida
		13 os.km_inicial
		14 lod.cidade
		15 os.s_data_chegada
		16 os.s_data_saida
		17 os.km_final
		18 os.diaria
		19 ps.cte
		20 ps.nf
		21 ps.aet
		22 ps.contrato, 
		
		23 lp.km
		24 lp.valor
		25 lp.transit_time
		*/
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT os.num_os, em.fantasia, ve.frota, ve.placa, fc.apelido, cl.fantasia, ca.nome, te.nome, ps.conjunto_placa, ps.motorista_cliente,
				loo.cidade, os.c_data_chegada, os.c_data_saida, os.km_inicial, lod.cidade, os.s_data_chegada, os.s_data_saida, os.km_final,
				os.diaria, ps.cte, ps.nf, ps.aet, ps.contrato, lp.km, lp.valor, lp.transit_time
			
			FROM ordens_servicos AS os
			LEFT JOIN prestacao_servicos AS ps
			ON os.id_ordem_servico = ps.ordens_servicos_id_ordem_servico
			LEFT JOIN empresas AS em
			ON os.empresas_id_empresa = em.id_empresa
			LEFT JOIN veiculos AS ve
			ON ve.id_veiculo = os.veiculos_id_veiculo
			LEFT JOIN fichas_colaboradores AS fc
			ON fc.id_ficha_colaborador = os.fichas_colaboradores_id_ficha_colaborador
			LEFT JOIN dados_pessoais AS dp
			ON fc.dados_pessoais_id_dados_pessoais = dp.id_dados_pessoais
			LEFT JOIN clientes AS cl
			ON cl.id_cliente = ps.clientes_id_cliente
			LEFT JOIN cargas AS ca
			ON ps.cargas_id_carga = ca.id_carga
			LEFT JOIN tipos_execucao AS te
			ON os.tipos_execucao_id_tipo_execucao = te.id_tipo_execucao
			LEFT JOIN locais AS loo
			ON os.locais_id_origem = loo.id_local
			LEFT JOIN locais AS lod
			ON os.locais_id_destino = lod.id_local
			
			LEFT JOIN locais_precificacao AS lp
			ON cl.id_cliente = lp.clientes_id_cliente AND lp.contrato = ps.contrato
			
			WHERE os.data_criacao BETWEEN DATE_SUB(NOW(), INTERVAL 90 DAY) AND NOW() OR os.s_data_saida = NULL OR os.s_data_saida = '0000-00-00'

			
			ORDER BY os.id_ordem_servico DESC;
			"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarClientesCompleto(){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM clientes AS cl
			LEFT JOIN contatos_clientes AS cc
			ON cc.clientes_id_cliente = cl.id_cliente
			LEFT JOIN enderecos_clientes AS ee
			ON ee.clientes_id_cliente = cl.id_cliente
			;"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarClientes(){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM clientes"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarClientesEspecifico(){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM clientes
			WHERE id_cliente = ".$_SESSION['idCliente']
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarEnderecoCliente(){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM enderecos_clientes
			WHERE clientes_id_cliente = ".$_SESSION['idCliente']
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarContatoCliente(){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT id_contato, telefone, whatsapp, email, clientes_id_cliente
			FROM Contatos_clientes
			WHERE clientes_id_cliente = ".$_SESSION['idCliente']
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarLocais(){
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM locais
			ORDER BY cidade ASC;"
		);
				
		desconectarBanco($conn);
		
		return $sql;
	}
	
	function listarLocaisPrecificacoes(){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM locais_precificacao;"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarFrota(){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM veiculos
			ORDER BY frota ASC;"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarFrotaCompleto(){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM veiculos AS ve
			INNER JOIN veiculos_credenciais AS vc
			ON ve.id_veiculo = vc.veiculos_id_veiculo
			ORDER BY ve.frota ASC;"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarMotoristaEscolta(){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT fc.id_ficha_colaborador, fc.matricula, fc.apelido
			FROM fichas_colaboradores AS fc
			INNER JOIN motoristas_escolta AS me
			ON fc.id_ficha_colaborador = me.fichas_colaboradores_id_ficha_colaborador;"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarExecucoes(){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM tipos_execucao;"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarCargas(){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM cargas;"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarTiposContatos(){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM tipos_contatos;"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarDependentes(){
		
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
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT dp.id_dados_pessoais, dp.cpf, dp.nome, dp.data_nascimento, de.id_dependente, de.tipos_dependentes_id_tipo_dependente, de.dados_pessoais_id_dados_pessoais_dependente, de.dados_pessoais_id_dados_pessoais_titular
			FROM dados_pessoais AS dp
			INNER JOIN dependentes AS de
			ON dp.id_dados_pessoais = de.dados_pessoais_id_dados_pessoais_dependente
			WHERE de.dados_pessoais_id_dados_pessoais_titular = '".$_SESSION['idDadosPessoais']."'
			ORDER BY dp.id_dados_pessoais DESC
			;"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarTiposDependentes(){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM tipos_dependentes;"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listaDadosBancarios(){
		
		/*
		0 ".$_SESSION['idDadosPessoais']."
		1 db.id_dados_bancarios
		2 db.nome_banco
		3 db.agencia
		4 db.conta
		5 db.fichas_colaboradores_id_ficha_colaborador
		6 db.tipos_contas_bancarias_id_tipo_conta_bancaria
		7 db.pix
		*/
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT fc.dados_pessoais_id_dados_pessoais, db.id_dados_bancarios, db.nome_banco, db.agencia, db.conta, db.tipos_contas_bancarias_id_tipo_conta_bancaria, db.pix
			FROM dados_bancarios AS db
			INNER JOIN fichas_colaboradores AS fc
			ON fc.dados_bancarios_id_dados_bancarios = db.id_dados_bancarios
			WHERE ".$_SESSION['idDadosPessoais']." = fc.dados_pessoais_id_dados_pessoais;"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarTiposContasBancos(){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM tipos_contas_bancarias;"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	function listarTiposVeiculos(){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"SELECT *
			FROM tipos_veiculos;"
		);
				
		desconectarBanco($conn);
		
		return $sql;
		
	}
	
	/*Criar*/

	function criarRemuneracao($salario, $vInicio, $vFim){
	
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"INSERT INTO salarios (id_salario, valor, data_inicio, data_fim, data_criacao, data_edicao, financeiro_colaboradores_id_financeiro_colaborador) 
			VALUES (NULL,'".$salario."', '".$vInicio."', '".$vFim."', now(), now(),
				(
					SELECT fc.id_financeiro_colaborador 
					FROM financeiro_colaboradores AS fc
					INNER JOIN fichas_colaboradores AS fcc
					ON fcc.id_ficha_colaborador = fc.fichas_colaboradores_id_ficha_colaborador
					WHERE fcc.dados_pessoais_id_dados_pessoais = '".$_SESSION['idDadosPessoais']."'
					LIMIT 1
				)
			);"
		);

		desconectarBanco($conn);
	
	}

	function criarJornada($horaS, $horaM, $horaE, $dom, $seg, $ter, $qua, $qui, $sex, $sab) { //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"INSERT INTO jornadas (id_jornada, horas_semanais, horas_mensais, hora_extra_maxima, domingo, segunda, terca, quarta, quinta, sexta, sabado, data_criacao, data_edicao) 
			VALUES (NULL,'".$horaS."', '".$horaM."', '".$horaE."', '".$dom."', '".$seg."', '".$ter."', '".$qua."', '".$qui."', '".$sex."', '".$sab."', now(), now());"
		);

		desconectarBanco($conn);
		
	}

	function criarConjuje($idValue,$nomeConjuje,$cpfConjuje,$nascimentoConjujeConvert) { //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"INSERT INTO conjujes (id_conjuje, nome, cpf, data_nascimento, data_criacao, data_edicao, dados_pessoais_id_dados_pessoais) 
			VALUES (NULL,'".$nomeConjuje."','".$cpfConjuje."','".$nascimentoConjujeConvert."',now(),now(),'".$idValue."');"
		);

		desconectarBanco($conn);
		
	}	
	

	function criarUsuario($login, $email, $senha) { //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"INSERT INTO usuarios (id_usuario, usuario, senha, data_criacao, data_edicao, perfis_id_perfil, dados_pessoais_id_dados_pessoais) 
			VALUES (NULL,'".$login."','".$senha."',now(),now(),
				(SELECT perfis_id_perfil FROM liberar_acesso WHERE emails_id_email = '".$email."'),
				(SELECT email FROM emails WHERE email = '".$email."')
				
			);"
		);

		desconectarBanco($conn);
		
	}	
	
	function criarEndereco($enderecoCEP, $enderecoNumero, $enderecoBairro, $enderecoEstado, $enderecoCidade, $enderecoComplemento, $enderecoReferencia, $enderecoLogradouro){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"INSERT INTO `enderecos` (id_endereco, cep, numero, bairro, estados_brasil_estado, cidade, complemento, ponto_referencia, logradouro, dados_pessoais_id_dados_pessoais )
			VALUES (NULL, '".$enderecoCEP."', '".$enderecoNumero."', '".$enderecoBairro."', '".$enderecoEstado."'
			, '".$enderecoCidade."', '".$enderecoComplemento."', '".$enderecoReferencia."', '".$enderecoLogradouro."', ".$_SESSION['idDadosPessoais'].");"
		);
		
		desconectarBanco($conn);
		
	}
	
	function criarTelefone($contatosTelefone,$telefoneWhatsapp,$tipoContato,$contatoNome){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"INSERT INTO telefones (id_telefone, telefone, whatsapp, nome_contato, data_criacao, data_edicao, dados_pessoais_id_dados_pessoais, tipos_contatos_id_tipo_contato) 
			VALUES (NULL,'".$contatosTelefone."',0x".$telefoneWhatsapp.", '".$contatoNome."', now(), now(), ".$_SESSION['idDadosPessoais'].",".$tipoContato.");"
		);
		
		desconectarBanco($conn);

	}
	
	function criarTelefoneCliente($contatosTelefone,$telefoneWhatsapp,$email){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"INSERT INTO contatos_clientes (id_contato, telefone, whatsapp, email, data_criacao, data_edicao, clientes_id_cliente) 
			VALUES (NULL,'".$contatosTelefone."',0x".$telefoneWhatsapp.", '".$email."', now(), now(), ".$_SESSION['idCliente'].");"
		);
		
		desconectarBanco($conn);

	}
	
	function criarFilePessoa($id, $nome, $localizacao, $tipoDocumento, $tipagem, $foto){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"INSERT INTO documentos_pessoas (id_documento_pessoa, link, nome, tipagem, descricao, tipos_documentos_id_tipo_documento, data_criacao, data_edicao, dados_pessoais_id_dados_pessoais, foto) 
			VALUES (NULL, '".$localizacao."', '".$nome."', '".$tipagem."', NULL, '".$tipoDocumento."', now(),now(), '".$id."', b'".$foto."');"
		);
		
		desconectarBanco($conn);
		
	}
	
	function criarFileCliente($id, $nome, $localizacao, $tipoDocumento){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"INSERT INTO documentos_clientes (id_documento_clientes, link, nome, descricao, tipos_documentos_id_tipo_documento, data_criacao, data_edicao, clientes_id_cliente) 
			VALUES (NULL, '".$localizacao."', '".$nome."', NULL, '".$tipoDocumento."', now(),now(), '".$id."');"
		);
		
		desconectarBanco($conn);
		
	}
	
	function criarFileVeiculos($id, $nome, $localizacao, $tipoDocumento){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"INSERT INTO documentos_veiculos (id_documento_veiculo, link, nome, descricao, tipos_documentos_id_tipo_documento, data_criacao, data_edicao, veiculo_id_veiculo) 
			VALUES (NULL, '".$localizacao."', '".$nome."', NULL, '".$tipoDocumento."', now(),now(), '".$id."');"
		);
		
		desconectarBanco($conn);
		
	}
	
	function criarOSInterna($os_num, $frota, $batedor, $execucao, $origem, $origem_d_c, $origem_d_s, $origem_km, $destino, $destino_d_c, $destino_d_s, $destino_km, $diaria, $empresa ){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"INSERT INTO ordens_servicos (num_os, veiculos_id_veiculo, fichas_colaboradores_id_ficha_colaborador, tipos_execucao_id_tipo_execucao, locais_id_origem, c_data_chegada, c_data_saida, km_inicial, locais_id_destino, s_data_chegada, s_data_saida, km_final, diaria, data_criacao, data_edicao, empresas_id_empresa ) 
			VALUES ('".$os_num."', '".$frota."', '".$batedor."', '".$execucao."', '".$origem."', '".$origem_d_c."', '".$origem_d_s."', '".$origem_km."', '".$destino."', '".$destino_d_c."', '".$destino_d_s."', '".$destino_km."', '".$diaria."', now(), now(), '".$empresa."');"
		);
			
		desconectarBanco($conn);
		
	}
	
	function criarOSServico($contrato, $os_num, $frota, $batedor, $execucao, $origem, $origem_d_c, $origem_d_s, $origem_km, $destino, $destino_d_c, $destino_d_s, $destino_km, $diaria, $empresa, $cliente, $carga, $conjunto, $motorista_conjunto, $cte, $nf, $aet ){ //Pronto
		
		$conn = conectarBanco();
		
		criarOSInterna($os_num, $frota, $batedor, $execucao, $origem, $origem_d_c, $origem_d_s, $origem_km, $destino, $destino_d_c, $destino_d_s, $destino_km, $diaria, $empresa );
		
		$sql = mysqli_query($conn,
			"INSERT INTO prestacao_servicos (contrato, cte, conjunto_placa, motorista_cliente, nf, aet, clientes_id_cliente, cargas_id_carga, data_criacao, data_edicao, ordens_servicos_id_ordem_servico) 
			VALUES (0x".$contrato.", '".$cte."', '".$conjunto."', '".$motorista_conjunto."', '".$nf."', '".$aet."', '".$cliente."', '".$carga."', now(), now(), 
				(SELECT id_ordem_servico FROM ordens_servicos WHERE num_os = '".$os_num."')
			);
			"
		);
		
		desconectarBanco($conn);
		
	}
	
	function criarLocalizacao($cidade,$estado,$lat,$lng,$address,$apelido){
		
		$conn = conectarBanco();

		$sql = mysqli_query($conn,
		
			"INSERT INTO locais (id_local, apelido, cidade, endereco, latitude, longitude, data_criacao, data_edicao, estados_brasil_uf_local) 
			VALUES (NULL, '".$apelido."', '".$cidade."', '".$address."', '".$lat."', '".$lng."', now(), now(), 
				(SELECT id_estado_brasil FROM estados_brasil WHERE sigla = '".$estado."')
			)"
		);
		
		desconectarBanco($conn);
		
	}
	
	function criarPrecificacao($contrato, $apelido, $valor, $km, $transitime, $origem, $destino, $cliente){

		$conn = conectarBanco();
		
		if($cliente!=""){
			$sql = mysqli_query($conn,
			
				"INSERT INTO locais_precificacao (id_local_precificacao, contrato, apelido, valor, km, transit_time, data_criacao, data_edicao, locais_id_origem, locais_id_destino, clientes_id_cliente) 
				VALUES (NULL, 0x".$contrato.", '".$apelido."', '".$valor."', '".$km."', '".$transitime."', now(), now(), '".$origem."', '".$destino."', '".$cliente."');"
			);
		}else{
			$sql = mysqli_query($conn,
			
				"INSERT INTO locais_precificacao (id_local_precificacao, contrato, apelido, valor, km, transit_time, data_criacao, data_edicao, locais_id_origem, locais_id_destino, clientes_id_cliente) 
				VALUES (NULL, 0x".$contrato.", '".$apelido."', '".$valor."', '".$km."', '".$transitime."', now(), now(), '".$origem."', '".$destino."', NULL);"
			);

		}

		desconectarBanco($conn);

	}
	
	function criarEmail($email, $user){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"INSERT INTO emails (id_email, email, data_criacao, data_edicao, dados_pessoais_id_dados_pessoais) 
			VALUES (NULL, '".$email."', now(), now(), '".$user."');"
		);

		desconectarBanco($conn);
		
	}
	
	function criarDependente($nome, $cpf, $nascimento, $tipo_dependente){
		
		$saida = criarDadosPessoais($cpf, $nome, "", "", "", $nascimento, "", "", "", "", "", "", "", "", "", "", "", "", NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"INSERT INTO dependentes (id_dependente, data_criacao, data_edicao, dados_pessoais_id_dados_pessoais_dependente, dados_pessoais_id_dados_pessoais_titular, tipos_dependentes_id_tipo_dependente) 
			VALUES (NULL, now(), now(), 
				(SELECT id_dados_pessoais FROM dados_pessoais WHERE cpf = '".$cpf."'), 
			".$_SESSION['idDadosPessoais'].", ".$tipo_dependente.");"
		);
		
		desconectarBanco($conn);
		
	}
	
	function criarDadosPessoais($cpf, $nome, $numero_rg, $emissao_rg, $emissor_rg, $data_nascimento, $nome_mae, $nome_pai, $naturalidade, $num_titulo_eleitoral, $secao_titulo_eleitoral, $zona_titulo_eleitoral, $emissao_titulo_eleitoral, $municipio_titulo_eleitoral, $num_cnh, $vencimento_cnh, $num_reservista, $num_sus, $escolaridade_id_escolaridade, $cnh_categorias_id_cnh_categoria, $tipos_sanguineos_id_tipo_sanguineo, $sexos_id_sexo, $estados_civis_id_estado_civil, $estados_brasil_estado_rg, $estados_brasil_uf_naturalidade, $estados_brasil_uf_titulo_eleitoral){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"INSERT INTO dados_pessoais (id_dados_pessoais, data_criacao, data_edicao, cpf, nome, numero_rg, emissao_rg, emissor_rg, data_nascimento, nome_mae, nome_pai, estados_brasil_estado_rg, num_titulo_eleitoral, secao_titulo_eleitoral, zona_titulo_eleitoral, emissao_titulo_eleitoral, municipio_titulo_eleitoral, num_cnh, vencimento_cnh, num_reservista, num_sus, escolaridade_id_escolaridade, cnh_categorias_id_cnh_categoria, tipos_sanguineos_id_tipo_sanguineo, sexos_id_sexo, estados_civis_id_estado_civil, naturalidade, estados_brasil_uf_naturalidade, estados_brasil_uf_titulo_eleitoral) 
			VALUES ( NULL, now(), now(), '".$cpf."', '".$nome."', '".$numero_rg."', ".(IS_NULL($emissao_rg) || $emissao_rg == "" ? "NULL" : "'".$emissao_rg."'"  ).", '".$emissor_rg."', '".$data_nascimento."', '".$nome_mae."', '".$nome_pai."', ".(IS_NULL($estados_brasil_estado_rg) || $estados_brasil_estado_rg == "" ? "NULL" : "'".$estados_brasil_estado_rg."'"  ).", '".$num_titulo_eleitoral."', '".$secao_titulo_eleitoral."', '".$zona_titulo_eleitoral."', '".$emissao_titulo_eleitoral."', '".$municipio_titulo_eleitoral."', '".$num_cnh."', '".$vencimento_cnh."', '".$num_reservista."', '".$num_sus."', ".(IS_NULL($escolaridade_id_escolaridade) || $escolaridade_id_escolaridade == "" ? "NULL" : "'".$escolaridade_id_escolaridade."'"  ).", ".(IS_NULL($cnh_categorias_id_cnh_categoria) || $cnh_categorias_id_cnh_categoria == "" ? "NULL" : "'".$cnh_categorias_id_cnh_categoria."'"  ).", ".(IS_NULL($tipos_sanguineos_id_tipo_sanguineo) || $tipos_sanguineos_id_tipo_sanguineo == "" ? "NULL" : "'".$tipos_sanguineos_id_tipo_sanguineo."'"  ).", ".(IS_NULL($sexos_id_sexo) || $sexos_id_sexo == "" ? "NULL" : "'".$sexos_id_sexo."'"  ).", ".(IS_NULL($estados_civis_id_estado_civil) || $estados_civis_id_estado_civil == "" ? "NULL" : "'".$estados_civis_id_estado_civil."'"  ).", '".$naturalidade."', ".(IS_NULL($estados_brasil_uf_naturalidade) || $estados_brasil_uf_naturalidade == "" ? "NULL" : "'".$estados_brasil_uf_naturalidade."'"  ).", ".(IS_NULL($estados_brasil_uf_titulo_eleitoral) || $estados_brasil_uf_titulo_eleitoral == "" ? "NULL" : "'".$estados_brasil_uf_titulo_eleitoral."'"  ).");"
		);
		
		desconectarBanco($conn);
		
	}
	
	function criarMotoristaEscolta($idValue, $credencial, $validade_credencial){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"INSERT INTO motoristas_escolta (id_motorista_escolta, data_criacao, data_edicao, credencial, validade_credencial, fichas_colaboradores_id_ficha_colaborador)
			VALUES (NULL, now(), now(), '".$credencial."', '".$validade_credencial."', ".$idValue."
			);"
		);
	
		desconectarBanco($conn);
		
	}
	
	function criarMotoristaAmbulancia($idValue, $credencial, $validade_credencial){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"INSERT INTO motoristas_ambulancias (id_motorista_ambulancia, data_criacao, data_edicao, credencial, validade_credencial, fichas_colaboradores_id_ficha_colaborador)
			VALUES (NULL, now(), now(), '".$credencial."', '".$validade_credencial."', ".$idValue."
			);"
		);
	
		desconectarBanco($conn);
		
	}
	
	function criarGerenteEnfermeiro($idValue, $coren_gerente){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"INSERT INTO gerentes_enfermeiros (id_gerente_enfermeiro, coren, data_criacao, data_edicao, fichas_colaboradores_id_ficha_colaborador)
			VALUES (NULL, '".$coren_gerente."', now(), now(), ".$idValue.");"
		);
		
		desconectarBanco($conn);
		
	}
	
	function criarEnfermeiro($idValue, $coren_enfermeiro){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"INSERT INTO enfermeiros (id_enfermeiro, coren, data_criacao, data_edicao, fichas_colaboradores_id_ficha_colaborador)
			VALUES (NULL, '".$coren_enfermeiro."', now(), now(), ".$idValue.");"
		);
		
		desconectarBanco($conn);
		
	}
	
	function criarDadosBancarios($bancoNome, $bancoAgencia, $bancoConta, $tipoConta, $pix){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"INSERT INTO dados_bancarios (id_dados_bancarios, data_criacao, data_edicao, nome_banco, agencia, conta, tipos_contas_bancarias_id_tipo_conta_bancaria, pix)
			VALUES (NULL, now(), now(), '".$bancoNome."', '".$bancoAgencia."', '".$bancoConta."' , ".(IS_NULL($tipoConta) || $tipoConta == "" ? "NULL" : "'".$tipoConta."'"  ).", '".$pix."'
			);"
		);

		$sql = mysqli_query($conn,			
			"UPDATE fichas_colaboradores AS fc
			SET 
			fc.dados_bancarios_id_dados_bancarios = 
				(SELECT id_dados_bancarios FROM dados_bancarios ORDER BY id_dados_bancarios DESC LIMIT 1),
			fc.data_edicao = now()
			WHERE dados_pessoais_id_dados_pessoais = '".$_SESSION['idDadosPessoais']."' ;"
		);

		desconectarBanco($conn);
		
	}
	
	function criarTempoExperiencia($id){

		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"INSERT INTO tempo_experiencia ( id_tempo_experiencia, data_inicio, data_fim, data_criacao, data_edicao )
			VALUES (NULL, '', '', now(), now());"
		);

		$sql = mysqli_query($conn,			
			
			"UPDATE `fichas_colaboradores` AS fc
			SET fc.tempo_experiencia_id_tempo_experiencia = 
				(SELECT id_tempo_experiencia FROM tempo_experiencia ORDER BY id_tempo_experiencia DESC LIMIT 1 )
			, fc.data_edicao = now()
			WHERE fc.dados_pessoais_id_dados_pessoais = '".$id."';"

		);

		desconectarBanco($conn);

	}

	function criarDadosProfissionais($id){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"INSERT INTO fichas_colaboradores (	id_ficha_colaborador, matricula, apelido, data_admissao, data_criacao, data_edicao, dados_pessoais_id_dados_pessoais )
			VALUES (NULL, '', '', '', now(), now(), '".$id."');"
		);
		
		criarTempoExperiencia($id);

		criarFianceiroColaborador($id);

		desconectarBanco($conn);
		
	}
	
	function criarFianceiroColaborador($id){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"INSERT INTO financeiro_colaboradores (	id_financeiro_colaborador, data_criacao, data_edicao, fichas_colaboradores_id_ficha_colaborador )
			VALUES (NULL, now(), now(), 
				(SELECT id_ficha_colaborador FROM fichas_colaboradores WHERE dados_pessoais_id_dados_pessoais = '".$id."')
			);"
		);

		desconectarBanco($conn);

	}

	function criarUsuarioCliente($cnpj, $id){
		
		$conn = conectarBanco();
		
		$senha = sha1(md5('acesso'.$cnpj));
		
		$sql = mysqli_query($conn,			
			"INSERT INTO usuarios_clientes ( id_usuario_cliente, usuario, senha, data_criacao, validado, data_edicao, clientes_id_cliente )
			VALUES (NULL, '".$cnpj."', '".$senha."', now(), b'1', now(), '".$id."');"
		);
	
		desconectarBanco($conn);
		
	}
	
	function criarCliente($razao_social, $fantasia, $cnpj, $inscricao_municipal){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,			
			"INSERT INTO clientes (	id_cliente, nome, fantasia, cnpj, inscricao_municipal, data_edicao, data_criacao )
			VALUES (NULL, '".$razao_social."', '".$fantasia."', '".$cnpj."', '".$inscricao_municipal."', now(), now());"
		);
	
		desconectarBanco($conn);
		
	}
	
	function criarEnderecoCliente($enderecoCEP, $enderecoNumero, $enderecoBairro, $estado, $enderecoCidade, $enderecoComplemento, $enderecoReferencia, $enderecoLogradouro){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"INSERT INTO `enderecos_clientes` (id_endereco_cliente, cep, numero, bairro, estados_brasil_id_estado_brasil, cidade, complemento, ponto_referencia, logradouro, clientes_id_cliente )
			VALUES (NULL, '".$enderecoCEP."', '".$enderecoNumero."', '".$enderecoBairro."', 
				(SELECT id_estado_brasil FROM estados_brasil WHERE id_estado_brasil = '".$estado."')
			, '".$enderecoCidade."', '".$enderecoComplemento."', '".$enderecoReferencia."', '".$enderecoLogradouro."', ".$_SESSION['idCliente'].");"
		);
		
		desconectarBanco($conn);
		
	}
	
	function criarCredencialFrota($placa, $renavan, $credencial, $expedicao, $validade){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"INSERT INTO `veiculos_credenciais` (id_veiculo_credencial, credencial, credencial_expedicao, credencial_validade, data_criacao, data_edicao, veiculos_id_veiculo	)
			VALUES (NULL, '".$credencial."', '".$expedicao."', '".$validade."',now(), now(), 
				(SELECT id_veiculo FROM veiculos WHERE placa = '".$placa."' AND renavan = '".$renavan."' ORDER BY data_edicao DESC LIMIT 1)
			);"
		);
		
		desconectarBanco($conn);
		
	}
	
	function criarFrota($placa, $chassi, $renavan, $modelo, $cor, $veiculo, $fabricante, $categoria, $tipo, $combustivel, $ano, $frota, $imei, $link, $empresa, $tipoV, $credencial, $expedicao, $validade){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"INSERT INTO `veiculos` (id_veiculo, placa, chassis, renavan, ano_modelo, cor, veiculo, carro_fabricante, carro_categoria, carro_tipo, combustivel, ano, frota, imei, data_criacao, data_edicao, link_img, empresas_id_empresa, tipos_veiculos_id_tipo_veiculo	)
			VALUES (NULL, '".$placa."', '".$chassi."', '".$renavan."', '".$modelo."', '".$cor."', '".$veiculo."', '".$fabricante."', '".$categoria."', '".$tipo."', '".$combustivel."', '".$ano."', '".$frota."', '".$imei."', now(), now(), '".$link."','".$empresa."', '".$tipoV."')
			;"
		);
		
		criarCredencialFrota($placa, $renavan, $credencial, $expedicao, $validade);
		
		desconectarBanco($conn);
		
	}
	
	/*Editar*/
	
	function editarRemuneracao($id_remuneracao, $vFim_original){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"UPDATE salarios AS sa
			SET sa.data_fim = '".$vFim_original."', 
			sa.data_edicao = now()
			WHERE sa.id_salario = '".$id_remuneracao."';"
		);
		
		desconectarBanco($conn);

	}

	function editar_jornada($id_jornada, $horaS, $horaM, $horaE, $dom, $seg, $ter, $qua, $qui, $sex, $sab) { //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"UPDATE jornadas AS jo
			SET jo.horas_semanais = '".$horaS."', 
			jo.horas_mensais = '".$horaM."',
			jo.hora_extra_maxima = '".$horaE."',
			jo.domingo = '".$dom."',
			jo.segunda = '".$seg."',
			jo.terca = '".$ter."',
			jo.quarta = '".$qua."',
			jo.quinta = '".$qui."',
			jo.sexta = '".$sex."',
			sabado = '".$sab."',
			jo.data_edicao = now()
			WHERE jo.id_jornada = '".$id_jornada."';"
		);
		
		desconectarBanco($conn);
		
	}

	function editarConjuje($idValue,$nomeConjuje,$cpfConjuje,$nascimentoConjujeConvert) { //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"UPDATE `conjujes` AS cj
			SET cj.nome = '".$nomeConjuje."',
			cj.cpf = '".$cpfConjuje."',
			cj.data_nascimento = '".$nascimentoConjujeConvert."',
			cj.data_edicao = now()
			WHERE cj.dados_pessoais_id_dados_pessoais = '".$idValue."';"
		);
		
		desconectarBanco($conn);
		
	}

	function editarDadosPessoais($idValue, $nome, $cpf, $rg, $estado, $nascimento, $mae, $pai, $escolaridade, $estadoCivil, $fatorRH, $sexo, $naturalidade, $naturalidadeUF, $numCNH, $categoriaCNH, $vencimentoCNH, $rgEmissor, $rgEmissao, $numTitulo, $secaoTitulo, $zonaTitulo, $emissaoTitulo, $tituloUF, $municipioTitulo, $numReservista, $sus) { //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"UPDATE `dados_pessoais` AS dp 
			SET dp.nome = '".$nome."', dp.cpf = '".$cpf."', dp.numero_rg = '".$rg."', 
			dp.estados_brasil_estado_rg = ".(IS_NULL($estado) || $estado == "" ? "NULL" : "'".$estado."'"  ).",
			dp.data_nascimento = '".$nascimento."', dp.nome_mae = '".$mae."', dp.nome_pai = '".$pai."', 
			dp.escolaridade_id_escolaridade = ".(IS_NULL($escolaridade) || $escolaridade == "" ? "NULL" : "'".$escolaridade."'"  ).",
			dp.estados_civis_id_estado_civil = ".(IS_NULL($estadoCivil) || $estadoCivil == "" ? "NULL" : "'".$estadoCivil."'"  ).",
			dp.tipos_sanguineos_id_tipo_sanguineo = ".(IS_NULL($fatorRH) || $fatorRH == "" ? "NULL" : "'".$fatorRH."'"  ).",
			dp.sexos_id_sexo = ".(IS_NULL($sexo) || $sexo == "" ? "NULL" : "'".$sexo."'"  ).",
			dp.naturalidade = '".$naturalidade."', 
			dp.estados_brasil_uf_naturalidade = ".(IS_NULL($naturalidadeUF) || $naturalidadeUF == "" ? "NULL" : "'".$naturalidadeUF."'"  ).",
			dp.num_cnh = '".$numCNH."', 
			dp.cnh_categorias_id_cnh_categoria = ".(IS_NULL($categoriaCNH) || $categoriaCNH == "" ? "NULL" : "'".$categoriaCNH."'"  ).",
			dp.vencimento_cnh = '".$vencimentoCNH."', dp.emissor_rg = '".$rgEmissor."', dp.emissao_rg = '".$rgEmissao."', 
			dp.num_titulo_eleitoral = '".$numTitulo."', dp.secao_titulo_eleitoral = '".$secaoTitulo."', 
			dp.zona_titulo_eleitoral = '".$zonaTitulo."', dp.emissao_titulo_eleitoral = '".$emissaoTitulo."', 
			dp.estados_brasil_uf_titulo_eleitoral = ".(IS_NULL($tituloUF) || $tituloUF == "" ? "NULL" : "'".$tituloUF."'"  ).",
			dp.municipio_titulo_eleitoral = '".$municipioTitulo."', dp.num_reservista = '".$numReservista."', 
			dp.num_sus = '".$sus."', dp.data_edicao = now()
			WHERE dp.id_dados_pessoais = '".$idValue."';"
		);
		
		desconectarBanco($conn);
		
	}
	
	function editarTempoExperiencia($experienciaInicio, $experienciaFim){

		$conn = conectarBanco();
		
		$queryFinal= "";

		$sql = mysqli_query($conn,
			"UPDATE `tempo_experiencia` AS te 
			SET te.data_inicio = '".$experienciaInicio."', te.data_fim = '".$experienciaFim."', te.data_edicao = now()				
			WHERE te.id_tempo_experiencia = 
				(SELECT tempo_experiencia_id_tempo_experiencia FROM fichas_colaboradores WHERE dados_pessoais_id_dados_pessoais = '".$_SESSION['idDadosPessoais']."')
			;"
		);

		desconectarBanco($conn);

	}

	function editarDadosProfissionais($validado, $matricula, $apelido, $admissao, $demissao, $sindicato, $cargo, $pis, $numCTPS, $serieCTPS, $ufCTPS, $emissaoCTPS, $empresaID, $experienciaInicio, $experienciaFim){ //Pronto
		
		$conn = conectarBanco();
		
		$queryFinal= "";

		$sql = mysqli_query($conn,
			"UPDATE `fichas_colaboradores` AS fc 
			SET fc.matricula = '".$matricula."', fc.apelido = '".$apelido."', fc.data_admissao = '".$admissao."', fc.data_demissao = '".$demissao."', fc.nome_sindicato_vinculado = '".$sindicato."', fc.ativo = 0x".$validado.", fc.cargos_id_cargo = '".$cargo."', pis_pasep = '".$pis."', num_ctps = '".$numCTPS."', serie_ctps = '".$serieCTPS."', 
			estados_brasil_uf_ctps = (
				SELECT id_estado_brasil FROM estados_brasil WHERE sigla = '".$ufCTPS."'
			), emissao_ctps = '".$emissaoCTPS."', empresas_id_empresa = ".$empresaID.", fc.data_edicao = now()				
			WHERE fc.dados_pessoais_id_dados_pessoais = '".$_SESSION['idDadosPessoais']."';"
		);

		$encontrados = buscarTempoExperiencia();

		if(mysqli_num_rows($encontrados)<=0){
			criarTempoExperiencia($_SESSION['idDadosPessoais']);
		}

		editarTempoExperiencia($experienciaInicio, $experienciaFim);

		desconectarBanco($conn);
		
	}
	
	function editarEndereco($id, $enderecoCEP, $enderecoNumero, $enderecoBairro, $enderecoEstado, $enderecoCidade, $enderecoComplemento, $enderecoReferencia, $enderecoLogradouro){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"UPDATE `enderecos` AS ed 
			SET 
			ed.cep = '".$enderecoCEP."',
			ed.numero = '".$enderecoNumero."',
			ed.bairro = '".$enderecoBairro."',
			ed.estados_brasil_estado = '".$enderecoEstado."', 
			ed.cidade = '".$enderecoCidade."',
			ed.complemento = '".$enderecoComplemento."',
			ed.ponto_referencia = '".$enderecoReferencia."',
			ed.logradouro = '".$enderecoLogradouro."',
			ed.data_edicao = now()
			WHERE ed.id_endereco = '".$id."';"
		);

		desconectarBanco($conn);
		
	}
	
	function editarEnderecoCliente($id, $enderecoCEP, $enderecoNumero, $enderecoBairro, $enderecoEstado, $enderecoCidade, $enderecoComplemento, $enderecoReferencia, $enderecoLogradouro){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"UPDATE `enderecos_clientes` AS ed 
			SET 
			ed.cep = '".$enderecoCEP."',
			ed.numero = '".$enderecoNumero."',
			ed.bairro = '".$enderecoBairro."',
			ed.estados_brasil_id_estado_brasil = (
				SELECT id_estado_brasil FROM estados_brasil WHERE id_estado_brasil = '".$enderecoEstado."'
			), 
			ed.cidade = '".$enderecoCidade."',
			ed.complemento = '".$enderecoComplemento."',
			ed.ponto_referencia = '".$enderecoReferencia."',
			ed.logradouro = '".$enderecoLogradouro."',
			ed.data_edicao = now()
			WHERE ed.id_endereco_cliente = '".$id."';"
		);
	
		desconectarBanco($conn);
		
	}
	
	function editarTelefone($idValue,$contatosTelefone,$telefoneWhatsapp,$tipoContato,$contatoNome){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"UPDATE `telefones` AS tf 
			SET 
			tf.telefone = '".$contatosTelefone."',
			tf.whatsapp = ".$telefoneWhatsapp.",
			tf.nome_contato = '".$contatoNome."',
			tf.tipos_contatos_id_tipo_contato = ".$tipoContato.",
			tf.data_edicao = now()
			WHERE tf.id_telefone = ".$idValue.";"
		);
		
		desconectarBanco($conn);
		
	}
	
	function editarTelefoneCliente($idValue,$contatosTelefone,$telefoneWhatsapp,$email){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"UPDATE `contatos_clientes` AS cc
			SET 
			cc.telefone = '".$contatosTelefone."',
			cc.whatsapp = ".$telefoneWhatsapp.",
			cc.email = '".$email."',
			cc.data_edicao = now()
			WHERE cc.id_contato = ".$idValue.";"
		);
		
		desconectarBanco($conn);
		
	}
	
	function editarOSInterna($os_num, $frota, $batedor, $execucao, $origem, $origem_d_c, $origem_d_s, $origem_km, $destino, $destino_d_c, $destino_d_s, $destino_km, $diaria, $empresa ){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"UPDATE ordens_servicos
			SET veiculos_id_veiculo = '".$frota."', fichas_colaboradores_id_ficha_colaborador = '".$batedor."', tipos_execucao_id_tipo_execucao = '".$execucao."', locais_id_origem = '".$origem."', c_data_chegada = '".$origem_d_c."', c_data_saida = '".$origem_d_s."', km_inicial = '".$origem_km."', locais_id_destino = '".$destino."', s_data_chegada = '".$destino_d_c."', s_data_saida = '".$destino_d_s."', km_final = '".$destino_km."', diaria = '".$diaria."', data_edicao = now(), empresas_id_empresa = '".$empresa."'
			WHERE num_os = '".$os_num."';"
		);

		desconectarBanco($conn);
		
	}
	
	function editarOSServicoAtual($contrato, $os_num, $frota, $batedor, $execucao, $origem, $origem_d_c, $origem_d_s, $origem_km, $destino, $destino_d_c, $destino_d_s, $destino_km, $diaria, $empresa, $cliente, $carga, $conjunto, $motorista_conjunto, $cte, $nf, $aet ){ //Pronto
		
		editarOSInterna($os_num, $frota, $batedor, $execucao, $origem, $origem_d_c, $origem_d_s, $origem_km, $destino, $destino_d_c, $destino_d_s, $destino_km, $diaria, $empresa );
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"UPDATE prestacao_servicos
			SET contrato = 0x".$contrato.", clientes_id_cliente = '".$cliente."', cargas_id_carga = '".$carga."', conjunto_placa = '".$conjunto."', motorista_cliente = '".$motorista_conjunto."', cte = '".$cte."', nf = '".$nf."', aet = '".$aet."', data_edicao = now()
			WHERE ordens_servicos_id_ordem_servico = (SELECT id_ordem_servico FROM ordens_servicos WHERE num_os = '".$os_num."');"
		);
		
		desconectarBanco($conn);
		
	}
	
	function editarOSServicoNovo($contrato, $os_num, $frota, $batedor, $execucao, $origem, $origem_d_c, $origem_d_s, $origem_km, $destino, $destino_d_c, $destino_d_s, $destino_km, $diaria, $empresa, $cliente, $carga, $conjunto, $motorista_conjunto, $cte, $nf, $aet ){ //Pronto
		
		editarOSInterna($os_num, $frota, $batedor, $execucao, $origem, $origem_d_c, $origem_d_s, $origem_km, $destino, $destino_d_c, $destino_d_s, $destino_km, $diaria, $empresa );
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"INSERT INTO prestacao_servicos (contrato, cte, conjunto_placa, motorista_cliente, nf, aet, clientes_id_cliente, cargas_id_carga, data_criacao, data_edicao, ordens_servicos_id_ordem_servico) 
			VALUES (0x".$contrato.", '".$cte."', '".$conjunto."', '".$motorista_conjunto."', '".$nf."', '".$aet."', '".$cliente."', '".$carga."', now(), now(), 
				(SELECT id_ordem_servico FROM ordens_servicos WHERE num_os = '".$os_num."')
			);
			"
		);
		
		desconectarBanco($conn);
		
	}
	
	function editarPrecificacao($idValue, $contrato, $apelido, $valor, $km, $transitime, $origem, $destino, $cliente){

		$conn = conectarBanco();

		if($cliente != ""){
			$sql = mysqli_query($conn,
				"UPDATE locais_precificacao
				SET 
				contrato = 0x".$contrato.",
				apelido = '".$apelido."',
				valor = '".$valor."',
				km = '".$km."',
				transit_time = '".$transitime."',
				data_edicao = now(),
				locais_id_origem = '".$origem."',
				locais_id_destino = '".$destino."',
				clientes_id_cliente  = '".$cliente."'
				WHERE id_local_precificacao = '".$idValue."';"
			);
		}else{
			$sql = mysqli_query($conn,
				"UPDATE locais_precificacao
				SET 
				contrato = 0x".$contrato.",
				apelido = '".$apelido."',
				valor = '".$valor."',
				km = '".$km."',
				transit_time = '".$transitime."',
				data_edicao = now(),
				locais_id_origem = '".$origem."',
				locais_id_destino = '".$destino."'
				WHERE id_local_precificacao = '".$idValue."';"
			);
		}

		desconectarBanco($conn);
	
	}
	
	function editarEmail($email, $user){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"UPDATE emails
			SET 
			email = '".$email."'
			WHERE dados_pessoais_id_dados_pessoais = '".$user."';"
		);
		
		desconectarBanco($conn);
		
	}
	
	function editarDependente($id, $nome, $cpf, $nascimento, $tipo_dependente){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"UPDATE dependentes
			SET 
			data_edicao = now(),
			tipos_dependentes_id_tipo_dependente = '".$tipo_dependente."'
			WHERE id_dependente = '".$id."';
		");
		
		$sql = mysqli_query($conn,
			"UPDATE dados_pessoais AS dp
			SET 
			data_edicao = now(),
			nome = '".$nome."',
			cpf = '".$cpf."',
			data_nascimento = '".$nascimento."'
			WHERE id_dados_pessoais = 
				(SELECT dados_pessoais_id_dados_pessoais_dependente FROM dependentes WHERE id_dependente = '".$id."')
			;"
		);
		
		desconectarBanco($conn);
		
	}
	
	function editarGerenteEnfermeiro($idValue, $coren_gerente){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"UPDATE gerentes_enfermeiros AS ge
			SET 
			ge.coren = '".$coren_gerente."',
			data_edicao = now()
			WHERE ge.fichas_colaboradores_id_ficha_colaborador = ".$idValue."
			;"
		);
		
		desconectarBanco($conn);
		
	}
	
	function editarEnfermeiro($idValue, $coren){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"UPDATE enfermeiros AS ef
			SET 
			ef.coren = '".$coren."',
			ef.data_edicao = now()
			WHERE ef.fichas_colaboradores_id_ficha_colaborador = ".$idValue."
			;"
		);
		
		desconectarBanco($conn);
		
	}
	
	function editarMotoristaEscolta($idValue, $credencial, $validade_credencial){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"UPDATE motoristas_escolta AS me
			SET 
			credencial = '".$credencial."',
			validade_credencial = '".$validade_credencial."',
			data_edicao = now()
			WHERE fichas_colaboradores_id_ficha_colaborador = ".$idValue."
			;"
		);
		
		desconectarBanco($conn);
		
	}
	
	function editarMotoristaAmbulancia($idValue, $credencial, $validade_credencial){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"UPDATE motoristas_ambulancias AS ma
			SET 
			credencial = '".$credencial."',
			validade_credencial = '".$validade_credencial."',
			data_edicao = now()
			WHERE fichas_colaboradores_id_ficha_colaborador = ".$idValue."
			;"
		);
		
		desconectarBanco($conn);
		
	}
	
	function editarDadosBancarios($idValue, $bancoNome, $bancoAgencia, $bancoConta, $tipoConta, $pix){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"UPDATE dados_bancarios AS db
			SET 
			db.nome_banco = '".$bancoNome."',
			db.agencia = '".$bancoAgencia."',
			db.conta = '".$bancoConta."',
			db.tipos_contas_bancarias_id_tipo_conta_bancaria = ".(IS_NULL($tipoConta) || $tipoConta == "" ? "NULL" : "'".$tipoConta."'"  ).",
			db.pix = '".$pix."',
			db.data_edicao = now()
			WHERE id_dados_bancarios = 
				(SELECT dados_bancarios_id_dados_bancarios FROM fichas_colaboradores WHERE dados_pessoais_id_dados_pessoais = '".$_SESSION['idDadosPessoais']."')
			;"
		);
		
		desconectarBanco($conn);
		
	}
	
	function editarCliente($idValue, $razao_social, $fantasia, $cnpj, $inscricao_municipal){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"UPDATE clientes AS cl
			SET 
			cl.nome = '".$razao_social."',
			cl.fantasia = '".$fantasia."',
			cl.cnpj = '".$cnpj."',
			cl.inscricao_municipal = '".$inscricao_municipal."',
			cl.data_edicao = now()
			WHERE cl.id_cliente = ".$idValue
		);
		
		desconectarBanco($conn);
		
	}
	
	function editarFrota($idValue, $placa, $chassi, $renavan, $modelo, $cor, $veiculo, $fabricante, $categoria, $tipo, $combustivel, $ano, $frota, $imei, $link, $empresa, $tipoV, $credencial, $expedicao, $validade){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"UPDATE veiculos
			SET 
			placa = '".$placa."', 
			chassis = '".$chassi."',
			renavan = '".$renavan."',
			ano_modelo = '".$modelo."',
			cor = '".$cor."',
			veiculo = '".$veiculo."',
			carro_fabricante = '".$fabricante."',
			carro_categoria = '".$categoria."',
			carro_tipo = '".$tipo."',
			combustivel = '".$combustivel."',
			ano = '".$ano."',
			frota = '".$frota."',
			imei = '".$imei."',
			data_edicao = now(),
			link_img = '".$link."',
			empresas_id_empresa = '".$empresa."',
			tipos_veiculos_id_tipo_veiculo = '".$tipoV."'
			WHERE id_veiculo = ".$idValue
		);
		
		editarCredencialFrota($idValue, $credencial, $expedicao, $validade);
		
		desconectarBanco($conn);
		
	}
	
	function editarCredencialFrota($idValue, $credencial, $expedicao, $validade){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"UPDATE veiculos_credenciais
			SET 
			credencial = '".$credencial."', 
			credencial_expedicao = '".$expedicao."',
			credencial_validade = '".$validade."',
			data_edicao = now()
			WHERE veiculos_id_veiculo = ".$idValue
		);
		
		desconectarBanco($conn);
		
	}
	
	/*Deletar*/
	
	function excluirconjuje($idValue,$cpfConjuje){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"DELETE FROM conjujes
			WHERE dados_pessoais_id_dados_pessoais = '".$idValue."' AND cpf = '".$cpfConjuje."';"
		);
		
		desconectarBanco($conn);
		
	}

	function excluirTelefone($idValue){ //Pronto
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"DELETE FROM telefones
			WHERE id_telefone = ".$idValue.";"
		);
		
		desconectarBanco($conn);
		
	}
	
	function excluirLocalizacao($idValue){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"DELETE FROM locais
			WHERE id_local = ".$idValue.";"
		);
		
		desconectarBanco($conn);
		
	}
	
	function excluirPrecificacao($idValue){
		
		$conn = conectarBanco();

		$sql = mysqli_query($conn,
			"DELETE FROM locais_precificacao
			WHERE id_local_precificacao = ".$idValue.";"
		);
		
		desconectarBanco($conn);
		
	}
	
	function excluirOS($num_os){
		
		$conn = conectarBanco();

		$sql = mysqli_query($conn,
			"DELETE FROM prestacao_servicos
			WHERE ordens_servicos_id_ordem_servico = (SELECT id_ordem_servico FROM ordens_servicos WHERE num_os = '".$num_os."');
			"
		);
		
		$sql = mysqli_query($conn,
			"DELETE FROM ordens_servicos
			WHERE num_os = '".$num_os."';
			"
		);
		
		desconectarBanco($conn);
		
	}

	function excluirGerenteEnfermeiro($id){
		
		$conn = conectarBanco();

		$sql = mysqli_query($conn,
			"DELETE FROM gerentes_enfermeiros
			WHERE fichas_colaboradores_id_ficha_colaborador = ".$id
		);
		
		desconectarBanco($conn);
		
	}
	
	function excluirEnfermeiro($id){
		
		$conn = conectarBanco();

		$sql = mysqli_query($conn,
			"DELETE FROM enfermeiros
			WHERE fichas_colaboradores_id_ficha_colaborador = ".$id
		);
		
		desconectarBanco($conn);
		
	}

	function excluirMotoristaEscolta($id){
		
		$conn = conectarBanco();

		$sql = mysqli_query($conn,
			"DELETE FROM motoristas_escolta
			WHERE fichas_colaboradores_id_ficha_colaborador = ".$id
		);
		
		desconectarBanco($conn);
		
	}
	
	function excluirMotoristaAmbulancia($id){
		
		$conn = conectarBanco();

		$sql = mysqli_query($conn,
			"DELETE FROM motoristas_ambulancias
			WHERE fichas_colaboradores_id_ficha_colaborador = ".$id
		);
		
		desconectarBanco($conn);
		
	}
	
	function excluirDependente($id){
		
		$id_titular = buscarPessoaDependenteTitular($id);
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"DELETE FROM dependentes
			WHERE id_dependente = ".$id
		);
		
		$sql = mysqli_query($conn,
			"DELETE FROM dados_pessoais
			WHERE id_dados_pessoais = ".$id_titular[0]
		);
	
		desconectarBanco($conn);
		
	}
	
	function excluirDocumentoPessoa($nome){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"DELETE FROM documentos_pessoas
			WHERE nome = '".$nome."';"
		);
	
		desconectarBanco($conn);
		
	}
	
	function excluirDocumentoCliente($nome){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"DELETE FROM documentos_clientes
			WHERE nome = '".$nome."';"
		);
	
		desconectarBanco($conn);
		
	}
	
	function excluirDocumentoVeiculo($nome){
		
		$conn = conectarBanco();
		
		$sql = mysqli_query($conn,
			"DELETE FROM documentos_veiculos
			WHERE nome = '".$nome."';"
		);
	
		desconectarBanco($conn);
		
	}
	
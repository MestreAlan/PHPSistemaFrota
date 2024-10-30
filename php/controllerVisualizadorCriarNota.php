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
		
		$selectOptions = '<select id="input_empresa" name="empresa" class="input_empresa" required>';
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
	
	function inserirCliente($id){
		$listaEmpresas = listarClientes();
		
		$selectOptions = '<select id="input_cliente" name="empresa" class="input_cliente" required>';
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

	function addAddNota(){
		
		$textoPush = '
				<div class="tabelaMF">	
					<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">Ação</th>
								<th scope="col">Prestadora</th>
								<th scope="col">Tomadora</th>
								<th scope="col">Período início</th>
								<th scope="col">Período final</th>
								<th scope="col">CTE</th>
								<th scope="col">N° nota fiscal</th>
							</tr>
						</thead>
						<tbody>
							<tr class="visualizarAddNota" >
								<td><button type="button" id="addNota" class="btn btn-primary acessarCliente">Acessar</button></td>
								<th scope="row"><span class="prestadora" >'.inserirEmpresas(0).'</span></th>
								<td><span class="tomadora" >'.inserirCliente(0).'</span></td>
								<td><input class="periodo_inicio date" id="periodo_inicio" for="date" type="text" value="'.date("01-m-Y").'"></td>
								<td><input class="periodo_final date" id="periodo_final" for="date" type="text" value="'.date("d-m-Y").'"></td>
								<td><input class="cte" id="cte" type="text" value=""></td></td>
								<td><input class="nota" id="nota" type="text" value=""></td></td>
							</tr>
						</tbody>
					</table>
				</div>

				<table class="table able-striped edicao" id_conctrole="0" >
					<thead>
						<tr >
							<th colspan="2" scope="col" >Recibo provisório de serviço</th>
						</tr>
						<tr>
							<th scope="col" >Identificador</th>
							<th scope="col">Valor</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="container">

							<tr class="visualizarAddNota" >
								<td><span>Número: </span></td>
								<td><input class="Numero" id="Numero" type="text" value="1"></td></td>
							</tr>

							<tr class="visualizarAddNota" >
								<td><span>Código Verificador: </span></td>
								<td><input class="CodigoVerificacao" id="CodigoVerificacao" type="text" value="211006163324754"></td></td>
							</tr>

							<tr class="visualizarAddNota" >
								<td><span>Data de emissão: </span></td>
								<td><input class="DataEmissao" id="DataEmissao" type="text" value="2021-10-06T16:31:52"></td></td>
							</tr>
							<tr class="visualizarAddNota" >
								<td><span>Natureza da pperação: </span></td>
								<td><input class="NaturezaOperacao" id="NaturezaOperacao" type="text" value="1"></td></td>
							</tr>
							<tr class="visualizarAddNota" >
								<td><span>Optante pelo Simples Nacional: </span></td>
								<td><input class="OptanteSimplesNacional" id="OptanteSimplesNacional" type="text" value="2"></td></td>
							</tr>
							<tr class="visualizarAddNota" >
								<td><span>Incentivador cultural: </span></td>
								<td><input class="IncentivadorCultural" id="IncentivadorCultural" type="text" value="0"></td></td>
							</tr>
							<tr class="visualizarAddNota" >
								<td><span>Competência: </span></td>
								<td><input class="Competencia" id="Competencia" type="text" value="2021-10-06"></td></td>
							</tr>
							<tr class="visualizarAddNota" >
								<td><span>Outras informaçoões: </span></td>
								<td><input class="OutrasInformacoes" id="OutrasInformacoes" type="text" value="CONTA PARA PAGAMENTO: (Caixa econômica AG: 1953. Op. 003. Cc: 840-0). VENCIMENTO 20/10/2021."></td></td>
							</tr>
							<!--<Servico>-->
								<!--<Valores>-->
									<tr class="visualizarAddNota" >
										<td><span>Valor dos serviços: </span></td>
										<td><input class="ValorServicos" id="ValorServicos" type="text" value="7500"></td></td>
									</tr>	
									<tr class="visualizarAddNota" >
										<td><span>Valor PIS: </span></td>
										<td><input class="ValorPis" id="ValorPis" type="text" value="0"></td></td>
									</tr>
									<tr class="visualizarAddNota" >
										<td><span>Valor COFINS: </span></td>
										<td><input class="ValorCofins" id="ValorCofins" type="text" value="0"></td></td>
									</tr>
									<tr class="visualizarAddNota" >
										<td><span>Valor INSS: </span></td>
										<td><input class="ValorInss" id="ValorInss" type="text" value="0"></td></td>
									</tr>
									<tr class="visualizarAddNota" >
										<td><span>Valor IR: </span></td>
										<td><input class="ValorIr" id="ValorIr" type="text" value="0"></td></td>
									</tr>
									<tr class="visualizarAddNota" >
										<td><span>Valor CSLL: </span></td>
										<td><input class="ValorCsll" id="ValorCsll" type="text" value="0"></td></td>
									</tr>
									<tr class="visualizarAddNota" >
										<td><span>ISS Retido: </span></td>
										<td><input class="IssRetido" id="IssRetido" type="text" value="2"></td></td>
									</tr>
									<tr class="visualizarAddNota" >
										<td><span>Valor ISS: </span></td>
										<td><input class="ValorIss" id="ValorIss" type="text" value="375"></td></td>
									</tr>
									<tr class="visualizarAddNota" >
										<td><span>Base de cálculo: </span></td>
										<td><input class="BaseCalculo" id="BaseCalculo" type="text" value="7500"></td></td>
									</tr>
									<tr class="visualizarAddNota" >
										<td><span>Aliquota: </span></td>
										<td><input class="Aliquota" id="Aliquota" type="text" value="0.05"></td></td>
									</tr>
								<!--</Valores>-->
								<tr class="visualizarAddNota" >
									<td><span>Item lista de serviço: </span></td>
									<td><input class="ItemListaServico" id="ItemListaServico" type="text" value="15.03"></td></td>
								</tr>
								<tr class="visualizarAddNota" >
									<td><span>Código CNAE: </span></td>
									<td><input class="CodigoCnae" id="CodigoCnae" type="text" value="7711000"></td></td>
								</tr>
								<tr class="visualizarAddNota" >
									<td><span>Discriminação: </span></td>
									<td><input class="Discriminacao" id="Discriminacao" type="text" value="Serviço de escolta 17/09/21 a 21/09/21. Veículo. BES-1I67. Cabo/PE X Riachuelo/RN. CT-e. 70. Equip. Escoltado: FSW-6724 / FTO-5714 / BZH-3B38.|1|2500|2500
											  #Serviço de escolta 17/09/21 a 21/09/21. Veículo. BER-8B51. Cabo/PE X Riachuelo/RN. CT-e. 70. Equip. Escoltado: FSW-6724 / FTO-5714 / BZH-3B38.|1|2500|2500
											  #Serviço de escolta 19/09/21 a 21/09/21. Veículo. BER-9I08. Cabo/PE X Riachuelo/RN. CT-e. 84. Equip. Escoltado: FTS-8921 / CPM-4A21|1|2500|2500#"></td></td>
								</tr>
								<tr class="visualizarAddNota" >
									<td><span>Código do município: </span></td>
									<td><input class="CodigoMunicipio" id="CodigoMunicipio" type="text" value="2405801"></td></td>
								</tr>
							<!--</Servico>-->
							<!--<PrestadorServico>-->
								<!--<IdentificacaoPrestador>-->
									<tr class="visualizarAddNota" >
										<td><span>CNPJ: </span></td>
										<td><input class="Cnpj" id="Cnpj" type="text" value="39671031000100"></td></td>
									</tr>
									<tr class="visualizarAddNota" >
										<td><span>Inscrição municipal: </span></td>
										<td><input class="InscricaoMunicipal" id="InscricaoMunicipal" type="text" value="124112020"></td></td>
									</tr>
								<!--</IdentificacaoPrestador>-->
								<tr class="visualizarAddNota" >
									<td><span>Razão social: </span></td>
									<td><input class="RazaoSocial" id="RazaoSocial" type="text" value="RADAR LOCACAO DE MAQUINAS E EQUIPAMENTOS LTDA"></td></td>
								</tr>
								<tr class="visualizarAddNota" >
									<td><span>Nome fantasia: </span></td>
									<td><input class="NomeFantasia" id="NomeFantasia" type="text" value="RADAR LOCACOES"></td></td>
								</tr>
								<!--<Endereco>-->
									<tr class="visualizarAddNota" >
										<td><span>Endereço: </span></td>
										<td><input class="Endereco" id="Endereco" type="text" value="RUA PROFESSOR ZEQUINHA"></td></td>
									</tr>
									<tr class="visualizarAddNota" >
										<td><span>Número: </span></td>
										<td><input class="Numero" id="Numero" type="text" value="117"></td></td>
									</tr>
									<tr class="visualizarAddNota" >
										<td><span>Complemento: </span></td>
										<td><input class="Complemento" id="Complemento" type="text" value="LETRA A"></td></td>
									</tr>
									<tr class="visualizarAddNota" >
										<td><span>Bairro: </span></td>
										<td><input class="Bairro" id="Bairro" type="text" value="BELA VISTA"></td></td>
									</tr>
									<tr class="visualizarAddNota" >
										<td><span>Código municipal: </span></td>
										<td><input class="CodigoMunicipio" id="CodigoMunicipio" type="text" value="2405801"></td></td>
									</tr>
									<tr class="visualizarAddNota" >
										<td><span>UF: </span></td>
										<td><input class="Uf" id="Uf" type="text" value="RN"></td></td>
									</tr>
									<tr class="visualizarAddNota" >
										<td><span>CEP: </span></td>
										<td><input class="Cep" id="Cep" type="text" value="59550000"></td></td>
									</tr>
								<!--</Endereco>-->
								<!--<Contato>-->
									<tr class="visualizarAddNota" >
										<td><span>Telefone: </span></td>
										<td><input class="Telefone" id="Telefone" type="text" value="(84) 9460-5053"></td></td>
									</tr>
									<tr class="visualizarAddNota" >
										<td><span>E-mail: </span></td>
										<td><input class="Email" id="Email" type="text" value="locacoes.radar@gmail.com"></td></td>
									</tr>
								<!--</Contato>-->
							<!--</PrestadorServico>-->
							<!--<TomadorServico>-->
								<!--<IdentificacaoTomador>-->
									<!--<CpfCnpj>-->
										<tr class="visualizarAddNota" >
											<td><span>CNPJ: </span></td>
											<td><input class="Cnpj" id="Cnpj" type="text" value="41860516000193"></td></td>
										</tr>
									<!--</CpfCnpj>-->
								<!--</IdentificacaoTomador>-->
								<tr class="visualizarAddNota" >
									<td><span>Razão social: </span></td>
									<td><input class="RazaoSocial" id="RazaoSocial" type="text" value="TRES - TRANSPORTES RODOVIARIOS ESPECIAIS SANTIN LTDA."></td></td>
								</tr>
								<!--<Endereco>-->
									<tr class="visualizarAddNota" >
										<td><span>Endereço: </span></td>
										<td><input class="Endereco" id="Endereco" type="text" value="AV HERMINIO CHRISTOVAO"></td></td>
									</tr>
									<tr class="visualizarAddNota" >
										<td><span>Número: </span></td>
										<td><input class="Numero" id="Numero" type="text" value="120"></td></td>
									</tr>
									<tr class="visualizarAddNota" >
										<td><span>Complemento: </span></td>
										<td><input class="Complemento" id="Complemento" type="text" value=""></td></td>
									</tr>
									<tr class="visualizarAddNota" >
										<td><span>Bairro: </span></td>
										<td><input class="Bairro" id="Bairro" type="text" value="III DISTRITO INDUSTRIAL"></td></td>
									</tr>
									<tr class="visualizarAddNota" >
										<td><span>Código municipal: </span></td>
										<td><input class="CodigoMunicipio" id="CodigoMunicipio" type="text" value="3501707"></td></td>
									</tr>
									<tr class="visualizarAddNota" >
										<td><span>UF: </span></td>
										<td><input class="Uf" id="Uf" type="text" value="SP"></td></td>
									</tr>
									<tr class="visualizarAddNota" >
										<td><span>CEP: </span></td>
										<td><input class="Cep" id="Cep" type="text" value="14820862"></td></td>
									</tr>
								<!--</Endereco>-->
							<!--</TomadorServico>-->
							<!--<OrgaoGerador>-->
								<tr class="visualizarAddNota" >
									<td><span>Código municipal: </span></td>
									<td><input class="CodigoMunicipio" id="CodigoMunicipio" type="text" value="2405801"></td></td>
								</tr>
								<tr class="visualizarAddNota" >
									<td><span>UF: </span></td>
									<td><input class="Uf" id="Uf" type="text" value="RN"></td></td>
								</tr>
							<!--</OrgaoGerador>-->

						
								</div>
							</td>
						</tr>


				
					</tbody>
				</table>
		';
		
		return $textoPush;
	}

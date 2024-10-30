$(function(){
	
	$('.voltar').click(function() {
		$.post("php/controllerRedirect.php", { page : "listarColaboradoresGeral" }, function(){
			//var url = "http://localhost/eradar/";
			//$(location).attr('href',url);
			window.location.reload(true);
		});
	});
	
	$.post("php/controllerBuscarFilesPessoa.php", { verificador : "docsPessoa" }, function(retorno){
		
		var valoresEncontrados = JSON.parse(retorno);
		
		var initialPreview = [];
		var initialPreviewConfig = [];
		for(var i=0 ; i<valoresEncontrados.length ; i++){
			var caption = valoresEncontrados[i][2].substring(0,valoresEncontrados[i][2].length-15) +''+ valoresEncontrados[i][2].substring(valoresEncontrados[i][2].length-4,valoresEncontrados[i][2].length);
			var key = valoresEncontrados[i][2];
			var type = valoresEncontrados[i][2].substring(valoresEncontrados[i][2].length-3,valoresEncontrados[i][2].length) == 'pdf' ? 'pdf' : 'image';
			var downloadUrl = valoresEncontrados[i][1];
			var description = valoresEncontrados[i][3];
			var tipagem = valoresEncontrados[i][4];
			initialPreview.push(valoresEncontrados[i][1]);
			initialPreviewConfig.push({caption : caption, downloadUrl: downloadUrl, description : description, key : key, type: type, tipagem: tipagem});
		}
		
		var create_form = '<select required class="listaDocTipo" ><option value="0" disabled >Selecione uma opção</option>';

		for(var i=1; i<=2; i++){
			if(i==1){
				if(tipagem == i){
					create_form = create_form + '<option value="1" selected>RG</option>';
				}else{
					create_form = create_form + '<option value="1">RG</option>';
				}
			}else if(i==2){
				if(tipagem == i){
					create_form = create_form + '<option value="2" selected>CPF</option>';
				}else{
					create_form = create_form + '<option value="2">CPF</option>';
				}
			}
		}

		create_form = create_form + '</select>';

		var footerTemplate = 
			'<div class="file-thumbnail-footer" >\n' +
		    	'<input disabled="" class="kv-input kv-new form-control input-sm form-control-sm text-center {TAG_CSS_NEW}" value="{caption}" placeholder="Enter caption...">\n' +
		    	//'<input class="kv-input kv-init form-control input-sm form-control-sm text-center {TAG_CSS_INIT}" value="{TAG_VALUE}" placeholder="Enter caption...">\n' +
		    	create_form+
		    	'<div class="small" >{size}</div> '+
		    	'{progress}\n{indicator}\n{actions}\n' +
		    '</div>';

		$("#kv-explorer").fileinput({
			theme: 'explorer-fas',
			uploadUrl: "php/file-upload-pessoa.php",
			deleteUrl: "php/file-delete-pessoa.php",
			pdfRendererUrl: 'https://plugins.krajee.com/pdfjs/web/viewer.html',
			overwriteInitial: false,
			uploadAsync: false,
			minFileCount: 1,
			maxFileCount: 15,
			maxFileSize: 5000,
			previewFileType: "file",
			allowedFileExtensions: ["pdf", "png", "jpg", "jpeg"],
			showUpload: true, //Libera o botão upload
			showRemove: false, //Libera o botão remove all
			language: "pt-BR",
			initialPreviewAsData: true,
			initialPreviewFileType: 'image',
			initialPreview: initialPreview,
			removeFromPreviewOnError: true,
			layoutTemplates: {footer: footerTemplate},
			initialPreviewConfig: initialPreviewConfig,
			uploadExtraData: function() {
	            var out = [];
	            $('.listaDocTipo:visible option:selected').each(function() {
	                out.push( $(this).attr('value') );
	            });
	            return {"out" : out};
	        }
		}).on('filebatchpreupload', function() {
			//PEga evento externo de upload de todos os arquivos
		}).on('filepreupload', function() {
			//Pega evento interno de upload de 1 arquivo
		}).on('filepreremove', function() {
			//Pega evento interno de delete de 1 arquivo
			var abort = false;
			if (confirm("Este arquivo ainda não foi salvo. Tem certeza de que deseja apagá-lo?")) {
				abort = true;
			}
			return abort; // you can also send any data/object that you can receive on `filecustomerror` event
		}).on('filepredelete', function(event, key, jqXHR, data) {
			var abort = true;
			if (confirm("Tem certeza de que deseja apagar este arquivo da base de dados?")) {
				abort = false;
			}
			return abort; // you can also send any data/object that you can receive on `filecustomerror` event
		}).on('fileclear', function() {
			var abort = false;
			if (confirm("Tem certeza de que deseja apagar todos os arquivos")) {
				abort = true;
			}
			return abort; // you can also send any data/object that you can receive on `filecustomerror` event
		}).on('fileuploaded', function(event, previewId, index, fileId) {
			console.log('File Uploaded', 'ID: ' + fileId + ', Thumb ID: ' + previewId);
		}).on('fileuploaderror', function(event, data, msg) {
			return {
                message: "Erro detectado. Upload abortado!", // upload error message
                data:{} // any other data to send that can be referred in `filecustomerror`
            };
			console.log('File Upload Error', 'ID: ' + data.fileId + ', Thumb ID: ' + data.previewId);
		}).on('filebatchuploadcomplete', function(event, preview, config, tags, extraData) {
			//console.log('File Batch Uploaded', preview, config, tags, extraData);
		}).on('filebeforeload', function(event, file, index, reader) {
			
		});
	});
	
	$(document).on('click', '.btnSalvarDadosPessoais', function() {
		modal();
		var idValue = this.id.substr(14, this.id.length);
		
		var nome = $('#dadosPessoaisNome').val();
		var nascimento = $('#dadosPessoaisNascimento').val();
		var escolaridade = $('#escolaridade option:selected').val();
		var mae = $('#dadosPessoaisMae').val();
		var pai = $('#dadosPessoaisPai').val();
		var estadoCivil = $('#estadoCivil  option:selected').val();
		var fatorRH = $('#fatorRH  option:selected').val();
		var sexo = $('#sexo  option:selected').val();
		var naturalidade = $('#dadosPessoaisNaturalidade').val();
		var naturalidadeUF = $('#estadosBrasil2 option:selected').attr("verificador");
		var cpf = $('#dadosPessoaisCPF').val();
		var numCNH = $('#dadosPessoaisNumCNH').val();
		var categoriaCNH = $('#categoriaCNH option:selected').val();
		var vencimentoCNH = $('#dadosPessoaisVencimentoCNH').val();
		var rg = $('#dadosPessoaisRG').val();
		var estadoRG = $('#estadosBrasil0 option:selected').attr("verificador");
		var rgEmissor = $('#dadosPessoaisRGEmissor').val();
		var rgEmissao = $('#dadosPessoaisRGEmissao').val();
		var numTitulo = $('#dadosPessoaisNumTitulo').val();
		var secaoTitulo = $('#dadosPessoaisSecaoTitulo').val();
		var zonaTitulo = $('#dadosPessoaisZonaTitulo').val();
		var emissaoTitulo = $('#dadosPessoaisEmissaoTitulo').val();
		var tituloUF = $('#estadosBrasil3 option:selected').attr("verificador");
		var municipioTitulo = $('#dadosPessoaisMunicipioTitulo').val();
		var numReservista = $('#dadosPessoaisNumReservista').val();
		var sus = $('#dadosPessoaisSUS').val();

		var nomeConjuje = $('#dadosPessoaisNomeConjuje').val();
		var cpfConjuje = $('#dadosPessoaisCPFConjuje').val();
		var nascimentoConjuje = $('#dadosPessoaisNascimentoConjuje').val();	

		var statusConjuje = 0;

		if(estadoCivil != 2){
			statusConjuje = 3;//Apagar
		}else if(nomeConjuje != "" && cpfConjuje != "" && nascimentoConjuje != ""){
			if($('#dadosPessoaisNomeConjuje').attr('dados_pessoais_nome_conjuje_original') == ""){
				statusConjuje = 1;//Criar
			}else{
				statusConjuje = 2;//Modificar
			}
		}

		var vermud = [0,0];
		
		if(	$('#img_pessoa_photo').attr('src') != $('#img_pessoa_photo').attr('src_original') ){
			vermud[0]=1; 
		}
		if( nome != $('#dadosPessoaisNome').attr('dados_pessoais_nome_original') || nascimento != $('#dadosPessoaisNascimento').attr('dados_pessoais_nascimento_original') || mae != $('#dadosPessoaisMae').attr('dados_pessoais_mae_original') || pai != $('#dadosPessoaisPai').attr('dados_pessoais_pai_original') || naturalidade != $('#dadosPessoaisNaturalidade').attr('dados_pessoais_naturalidade_original') || naturalidadeUF != $('#estadosBrasil2').attr('estados_original') || sexo != $('#sexo').attr('sexo_original') || estadoCivil != $('#estadoCivil').attr('estado_civil_original') || escolaridade != $('#escolaridade').attr('escolaridade_orignal') || rg != $('#dadosPessoaisRG').attr('dados_pessoais_RG_original') || estadoRG != $('#estadosBrasil0').attr('estados_original') || rgEmissor != $('#dadosPessoaisRGEmissor').attr('dados_pessoais_RG_emissor_original') || rgEmissao != $('#dadosPessoaisRGEmissao').attr('dados_pessoais_RG_emissao_original') || numCNH != $('#dadosPessoaisNumCNH').attr('dados_pessoais_num_CNH_original') || categoriaCNH != $('#categoriaCNH').attr('categoriaCNH_original') || vencimentoCNH != $('#dadosPessoaisVencimentoCNH').attr('dados_pessoais_vencimento_CNH_original') || numTitulo != $('#dadosPessoaisNumTitulo').attr('dados_pessoais_num_titulo_original') || secaoTitulo != $('#dadosPessoaisSecaoTitulo').attr('dados_pessoais_secao_titulo_original') || zonaTitulo != $('#dadosPessoaisZonaTitulo').attr('dados_pessoais_zona_titulo_original') || emissaoTitulo != $('#dadosPessoaisEmissaoTitulo').attr('dados_pessoais_emissao_titulo_original') || tituloUF != $('#estadosBrasil3').attr('estados_original') || municipioTitulo != $('#dadosPessoaisMunicipioTitulo').attr('dados_pessoais_municipio_titulo_original') || cpf != $('#dadosPessoaisCPF').attr('dados_pessoais_CPF_original') || numReservista != $('#dadosPessoaisNumReservista').attr('dados_pessoais_num_reservista_original') || sus != $('#dadosPessoaisSUS').attr('dados_pessoais_SUS_original') || fatorRH != $('#fatorRH').attr('fatorRH_original') || (nomeConjuje != $('#dadosPessoaisNomeConjuje').attr('dados_pessoais_nome_conjuje_original') && estadoCivil == 2) || (cpfConjuje != $('#dadosPessoaisCPFConjuje').attr('dados_pessoais_CPF_conjuje_original') && estadoCivil == 2) || (nascimentoConjuje != $('#dadosPessoaisNascimentoConjuje').attr('dados_pessoais_nascimento_conjuje_original') && estadoCivil == 2) ){ 
			vermud[1]=1;
		}
		
		if(vermud[0]==1||vermud[1]==1){
			$('#dadosPessoaisCPF')[0].setCustomValidity("");
			if(nome == "" || cpf == "" || nascimento == "" || mae == "" || (nomeConjuje == "" && estadoCivil == 2) || (cpfConjuje == "" && estadoCivil == 2) || (nascimentoConjuje == "" && estadoCivil == 2)){
				alert("Dados Pessoais: Parece que alguns campos obrigatório (*) estão vazios");
				modalOut();			
			}else if(($("#dadosPessoaisNome")[0].checkValidity() == false) || $('#dadosPessoaisNascimento')[0].checkValidity() == false || $("#dadosPessoaisCPF")[0].checkValidity() == false || ($("#dadosPessoaisRG")[0].checkValidity() == false && rg != "") || $("#dadosPessoaisMae")[0].checkValidity() == false || ($("#dadosPessoaisPai")[0].checkValidity() == false && pai != "" ) || ($("#dadosPessoaisNaturalidade")[0].checkValidity() == false && naturalidade != "" ) || ($("#dadosPessoaisNumCNH")[0].checkValidity() == false && numCNH != "" ) || ($("#dadosPessoaisVencimentoCNH")[0].checkValidity() == false && vencimentoCNH != "" )  || ($("#dadosPessoaisRGEmissor")[0].checkValidity() == false && rgEmissor != "" ) || ($('#dadosPessoaisRGEmissao')[0].checkValidity() == false && rgEmissao != "" ) || ($('#dadosPessoaisNumTitulo')[0].checkValidity() == false && numTitulo != "" ) || ($('#dadosPessoaisSecaoTitulo')[0].checkValidity() == false && secaoTitulo != "" ) || ($('#dadosPessoaisZonaTitulo')[0].checkValidity() == false && zonaTitulo != "" ) || ($('#dadosPessoaisEmissaoTitulo')[0].checkValidity() == false && emissaoTitulo != "" ) || ($('#dadosPessoaisMunicipioTitulo')[0].checkValidity() == false && municipioTitulo != "" ) || ($('#dadosPessoaisNumReservista')[0].checkValidity() == false && numReservista != "" ) || ($('#dadosPessoaisSUS')[0].checkValidity() == false && sus != "" ) || ($("#dadosPessoaisNomeConjuje")[0].checkValidity() == false && estadoCivil == 2) || ($("#dadosPessoaisCPFConjuje")[0].checkValidity() == false && estadoCivil == 2) || ($("#dadosPessoaisNascimentoConjuje")[0].checkValidity() == false && estadoCivil == 2) ){
				alert("Dados Pessoais: Alguns dados não estão corretos. Revise os dados com campos em vermelho");
				modalOut();			
			}else{	
				$.post("php/controllerValidarCPFUserId.php", { idValue : idValue, cpf : cpf }, function(resposta){
					var valoresEncontrados = JSON.parse(resposta);
					if(valoresEncontrados[0] > 0 && valoresEncontrados[1] == 0 ){
						$('#dadosPessoaisCPF')[0].setCustomValidity("CPF invalido!");
						alert("Dados Pessoais: O CPF inserido é invalido! ");
						modalOut();			
					}else{
						var file_data = $('#uploadImagePessoa').prop('files')[0];   
						if(file_data != null && vermud[0]==1){
							var form_data = new FormData();                  
							form_data.append('arquivo', file_data);                          
							$.ajax({
								url: 'php/uploadImg.php', // <-- point to server-side PHP script 
								dataType: 'text',  // <-- what to expect back from the PHP script, if anything
								cache: false,
								contentType: false,
								processData: false,
								data: form_data,                         
								type: 'post',
								success: function(php_script_response){
									if(php_script_response != ""){
										alert(php_script_response); // <-- display response from the PHP script, if any
									}
									$('#img_pessoa_photo').attr('src_original', $('#img_pessoa_photo').attr('src'));
									modalOut();	
								}
							});	
						}

						if(vermud[1]==1){
							if(idValue != 0){
								$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "editarDadosPessoais", idValue: idValue, nome : nome, cpf : cpf, rg : rg, estadoRG : estadoRG, nascimento : nascimento, mae : mae, pai : pai, escolaridade : escolaridade, estadoCivil : estadoCivil, fatorRH : fatorRH, sexo : sexo, naturalidade : naturalidade, naturalidadeUF : naturalidadeUF, numCNH : numCNH, categoriaCNH : categoriaCNH, vencimentoCNH : vencimentoCNH, rgEmissor : rgEmissor, rgEmissao : rgEmissao, numTitulo : numTitulo, secaoTitulo : secaoTitulo, zonaTitulo : zonaTitulo, emissaoTitulo : emissaoTitulo, tituloUF : tituloUF, municipioTitulo : municipioTitulo, numReservista : numReservista, sus : sus, nomeConjuje: nomeConjuje, cpfConjuje : cpfConjuje, nascimentoConjuje : nascimentoConjuje, statusConjuje : statusConjuje }, function(e){
									//alert("Edição realizada com sucesso!");
									
									$('#dadosPessoaisNome').attr('dados_pessoais_nome_original', nome);
									$('#dadosPessoaisNascimento').attr('dados_pessoais_nascimento_original', nascimento);
									$('#dadosPessoaisMae').attr('dados_pessoais_mae_original', mae);
									$('#dadosPessoaisPai').attr('dados_pessoais_pai_original', pai);
									$('#dadosPessoaisNaturalidade').attr('dados_pessoais_naturalidade_original', naturalidade);
									$('#estadosBrasil2').attr('estados_original', naturalidadeUF);
									$('#sexo').attr('sexo_original', sexo);
									$('#estadoCivil').attr('estado_civil_original', estadoCivil);
									$('#escolaridade').attr('escolaridade_orignal', escolaridade);
									$('#dadosPessoaisRG').attr('dados_pessoais_RG_original', rg);
									$('#estadosBrasil0').attr('estados_original', estadoRG);
									$('#dadosPessoaisRGEmissor').attr('dados_pessoais_RG_emissor_original', rgEmissor);
									$('#dadosPessoaisRGEmissao').attr('dados_pessoais_RG_emissao_original', rgEmissao);
									$('#dadosPessoaisNumCNH').attr('dados_pessoais_num_CNH_original', numCNH);
									$('#categoriaCNH').attr('categoriaCNH_original', categoriaCNH);
									$('#dadosPessoaisVencimentoCNH').attr('dados_pessoais_vencimento_CNH_original', vencimentoCNH);
									$('#dadosPessoaisNumTitulo').attr('dados_pessoais_num_titulo_original', numTitulo);
									$('#dadosPessoaisSecaoTitulo').attr('dados_pessoais_secao_titulo_original', secaoTitulo);
									$('#dadosPessoaisZonaTitulo').attr('dados_pessoais_zona_titulo_original', zonaTitulo);
									$('#dadosPessoaisEmissaoTitulo').attr('dados_pessoais_emissao_titulo_original', emissaoTitulo);
									$('#estadosBrasil3').attr('estados_original', tituloUF);
									$('#dadosPessoaisMunicipioTitulo').attr('dados_pessoais_municipio_titulo_original', municipioTitulo);
									$('#dadosPessoaisCPF').attr('dados_pessoais_CPF_original', cpf);
									$('#dadosPessoaisNumReservista').attr('dados_pessoais_num_reservista_original', numReservista);
									$('#dadosPessoaisSUS').attr('dados_pessoais_SUS_original', sus);
									$('#fatorRH').attr('fatorRH_original', fatorRH);

									$('#dadosPessoaisNomeConjuje').attr('dados_pessoais_nome_conjuje_original', nomeConjuje);
									$('#dadosPessoaisCPFConjuje').attr('dados_pessoais_CPF_conjuje_original', cpfConjuje);
									$('#dadosPessoaisNascimentoConjuje').attr('dados_pessoais_nascimento_conjuje_original', nascimentoConjuje);

									//Atualização dos atributos em dependente
									$("#dependenteLista").attr("dp_conjuje_nome", nomeConjuje);
									$("#dependenteLista").attr("dp_conjuje_cpf", cpfConjuje);
									$("#dependenteLista").attr("dp_conjuje_nascimento", nascimentoConjuje);
									
									modalOut();
								});
							}else{
								modal();
								$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "criarDadosPessoais", nome : nome, cpf : cpf, rg : rg, estadoRG : estadoRG, nascimento : nascimento, mae : mae, pai : pai, escolaridade : escolaridade, estadoCivil : estadoCivil, fatorRH : fatorRH, sexo : sexo, naturalidade : naturalidade, naturalidadeUF : naturalidadeUF, numCNH : numCNH, categoriaCNH : categoriaCNH, vencimentoCNH : vencimentoCNH, rgEmissor : rgEmissor, rgEmissao : rgEmissao, numTitulo : numTitulo, secaoTitulo : secaoTitulo, zonaTitulo : zonaTitulo, emissaoTitulo : emissaoTitulo, tituloUF : tituloUF, municipioTitulo : municipioTitulo, numReservista : numReservista, sus : sus, nomeConjuje: nomeConjuje, cpfConjuje : cpfConjuje, nascimentoConjuje : nascimentoConjuje, statusConjuje : statusConjuje }, function(e){
									
									window.setTimeout( document.location.reload(true), 2000 ); // 5 seconds
								});
							}
						}
						
						var id = $(".btnSalvarDadosPessoais").attr("id");
						$("#"+id).removeClass();
						$("#"+id).addClass('btn btn-primary btnSalvarDadosPessoais');
						$('#labelDadosPessoais').text("");
						
					}
				});	
			}
		}else{
			//alert("Dados Pessoais: Parece que nenhum dado foi alterado!");
			
			var id = $(".btnSalvarDadosPessoais").attr("id");
			$("#"+id).removeClass();
			$("#"+id).addClass('btn btn-primary btnSalvarDadosPessoais');
			$('#labelDadosPessoais').text("");
			
			modalOut();
		}
	});
	
	$(document).on('change', '.tbodyDadosPessoais', function() {
		
		var idOriginal = $(".btnSalvarDadosPessoais").attr("id");
		
		var idValue = idOriginal.substr(14, idOriginal.length);
		
		if($('#img_pessoa_photo').attr('src') == $('#img_pessoa_photo').attr('src_original') && $('#dadosPessoaisNome').val() == $('#dadosPessoaisNome').attr('dados_pessoais_nome_original') && $('#dadosPessoaisNascimento').val() == $('#dadosPessoaisNascimento').attr('dados_pessoais_nascimento_original') && $('#dadosPessoaisMae').val() == $('#dadosPessoaisMae').attr('dados_pessoais_mae_original') && $('#dadosPessoaisPai').val() == $('#dadosPessoaisPai').attr('dados_pessoais_pai_original') && $('#dadosPessoaisNaturalidade').val() == $('#dadosPessoaisNaturalidade').attr('dados_pessoais_naturalidade_original') && $('#estadosBrasil2 option:selected').attr("verificador") == $('#estadosBrasil2').attr('estados_original') && $('#sexo  option:selected').val() == $('#sexo').attr('sexo_original') && $('#estadoCivil  option:selected').val() == $('#estadoCivil').attr('estado_civil_original') && $('#escolaridade option:selected').val() == $('#escolaridade').attr('escolaridade_orignal') && $('#dadosPessoaisRG').val() == $('#dadosPessoaisRG').attr('dados_pessoais_RG_original') && $('#estadosBrasil0 option:selected').attr("verificador") == $('#estadosBrasil0').attr('estados_original') && $('#dadosPessoaisRGEmissor').val() == $('#dadosPessoaisRGEmissor').attr('dados_pessoais_RG_emissor_original') && $('#dadosPessoaisRGEmissao').val() == $('#dadosPessoaisRGEmissao').attr('dados_pessoais_RG_emissao_original') && $('#dadosPessoaisNumCNH').val() == $('#dadosPessoaisNumCNH').attr('dados_pessoais_num_CNH_original') && $('#categoriaCNH option:selected').val() == $('#categoriaCNH').attr('categoriaCNH_original') && $('#dadosPessoaisVencimentoCNH').val() == $('#dadosPessoaisVencimentoCNH').attr('dados_pessoais_vencimento_CNH_original') && $('#dadosPessoaisNumTitulo').val() == $('#dadosPessoaisNumTitulo').attr('dados_pessoais_num_titulo_original') && $('#dadosPessoaisSecaoTitulo').val() == $('#dadosPessoaisSecaoTitulo').attr('dados_pessoais_secao_titulo_original') && $('#dadosPessoaisZonaTitulo').val() == $('#dadosPessoaisZonaTitulo').attr('dados_pessoais_zona_titulo_original') && $('#dadosPessoaisEmissaoTitulo').val() == $('#dadosPessoaisEmissaoTitulo').attr('dados_pessoais_emissao_titulo_original') && $('#estadosBrasil3 option:selected').attr("verificador") == $('#estadosBrasil3').attr('estados_original') && $('#dadosPessoaisMunicipioTitulo').val() == $('#dadosPessoaisMunicipioTitulo').attr('dados_pessoais_municipio_titulo_original') && $('#dadosPessoaisCPF').val() == $('#dadosPessoaisCPF').attr('dados_pessoais_CPF_original') && $('#dadosPessoaisNumReservista').val() == $('#dadosPessoaisNumReservista').attr('dados_pessoais_num_reservista_original') && $('#dadosPessoaisSUS').val() == $('#dadosPessoaisSUS').attr('dados_pessoais_SUS_original') && $('#fatorRH  option:selected').val() == $('#fatorRH').attr('fatorRH_original')){
			var id = $(".btnSalvarDadosPessoais").attr("id");
			$("#"+id).removeClass();
			$("#"+id).addClass('btn btn-primary btnSalvarDadosPessoais verde');
			$('#labelDadosPessoais').text("");
		}else{
			var id = $(".btnSalvarDadosPessoais").attr("id");
			$("#"+id).removeClass();
			$("#"+id).addClass('btn btn-primary btnSalvarDadosPessoais vermelho');
			$('#labelDadosPessoais').text("Não salvo");
		}		
	});
	
	$(document).on('change', 'input[type=radio][name=radioDadosProfissionais]', function (){
		var validado = $("input[name='radioDadosProfissionais']:checked").val();
		if(validado==1){
			alert("No futuro este botão criará a liberação de usuário para este colaborador");
		}else{
			
		}
	});
	
	$(document).on('click', '.btnSalvarDadosProfissionais', function() {
		modal();
		
		var idValue = this.id.substr(19, this.id.length);
		var validado = $("input[name='radioDadosProfissionais']:checked").val();
		var matricula = $('#dadosProfissionaisMatricula').val();
		var apelido = $('#dadosProfissionaisApelido').val();
		var admissao = $('#dadosProfissionaisAdmissao').val(); 
		var demissao = $('#dadosProfissionaisDemissao').val(); 
		var sindicato = $('#dadosProfissionaisSindicato').val(); 
		var cargo = $('#cargos option:selected').val(); 
		var pis = $('#dadosProfissionaisPIS').val(); 
		var numCTPS = $('#dadosProfissionaisNumCTPS').val(); 
		var serieCTPS = $('#dadosProfissionaisSerieCTPS').val(); 
		var ufCTPS = $('#estadosBrasil5 option:selected').val(); 
		var emissaoCTPS = $('#dadosProfissionaisEmissaoCTPS').val(); 
		var idValueEmpresa = $('.empresaNome').prop('id').substr(25, $('.empresaNome').prop('id').length);		
		var empresaID = $('#dadosProfissionaisEmpresa'+idValueEmpresa+' option:selected').val();
		var experienciaInicio = $('#dadosProfissionaisExperienciaInicio').val(); 
		var experienciaFim = $('#dadosProfissionaisExperienciaFim').val(); 
		
		var coren_gerente = $('#coren_gerente').val();
		
		var credencial_escolta = $('#credencialEscolta').val();
		var validade_credencial = $('#validadeCredencialEscolta').val();
		
		var credencial_ambulancia = $('#credencialAmbulancia').val();
		var validade_credencial_ambulancia = $('#validadeCredencialAmbulancia').val();
		
		var coren_enfermeiro = $('#coren_enfermeiro').val();
		
		var varmud = [0, 0];

		if( validado != $("#validacaoAcesso").attr('validacao_acesso_original') || apelido != $("#dadosProfissionaisApelido").attr('dados_profissionais_apelido_original') || empresaID != $("#dadosProfissionaisEmpresa"+idValueEmpresa).attr('empresa_atual') || matricula != $("#dadosProfissionaisMatricula").attr('dados_profissionais_matricula_original') || admissao != $("#dadosProfissionaisAdmissao").attr('dados_profissionais_admissao_original') || demissao != $("#dadosProfissionaisDemissao").attr('dados_profissionais_demissao_original') || cargo != $("#cargos").attr('cargo_atual') || sindicato != $("#dadosProfissionaisSindicato").attr('dados_profissionais_sindicato_original') || pis != $("#dadosProfissionaisPIS").attr('dados_profissionais_PIS_original') || numCTPS != $("#dadosProfissionaisNumCTPS").attr('dados_profissionais_num_CTPS_original') || serieCTPS != $("#dadosProfissionaisSerieCTPS").attr('dados_profissionais_serie_CTPS_original') || ufCTPS != $("#estadosBrasil5").attr('estados_original') || emissaoCTPS != $("#dadosProfissionaisEmissaoCTPS").attr('dados_profissionais_emissao_CTPS_original') || experienciaInicio != $('#dadosProfissionaisExperienciaInicio').attr('dados_profissionais_experiencia_inicio_original') || experienciaFim != $('#dadosProfissionaisExperienciaFim').attr('dados_profissionais_experiencia_fim_original') ){
			varmud[0]=1;
		}
		if(
			( coren_gerente != $("#coren_gerente").attr('original') ) 
			&& cargo == 3
		){
			varmud[1]=1;
		}else if(
			( credencial_escolta != $("#credencialEscolta").attr('original') || validade_credencial != $("#validadeCredencialEscolta").attr('original') )
			&& cargo == 4
		){
			varmud[1]=2;
		}else if(
			( credencial_ambulancia != $("#credencialAmbulancia").attr('original') || validade_credencial_ambulancia != $("#validadeCredencialAmbulancia").attr('original') )
			&& cargo == 5
		){
			varmud[1]=3;
		}else if(
			( coren_enfermeiro != $("#coren_enfermeiro").attr('original')
				&& cargo == 6
			)
			&& cargo == 5
		){
			varmud[1]=4;
		}
		
		if(varmud[0]==1 || varmud[1]!=0){
			var cargo_atual = $("#cargos").attr('cargo_atual');
			
			if(matricula == "" || admissao == "" || cargo == "" || empresaID == "" || apelido == ""){
				alert("Dados Profissionais: Parece que alguns campos obrigatório (*) estão vazios");
				modalOut();
			}else if( $("#dadosProfissionaisMatricula")[0].checkValidity() == false || $("#dadosProfissionaisAdmissao")[0].checkValidity() == false || ($("#dadosProfissionaisDemissao")[0].checkValidity() == false && demissao != "") || ($("#dadosProfissionaisSindicato")[0].checkValidity() == false && sindicato != "") || ($("#dadosProfissionaisSerieCTPS")[0].checkValidity() == false && serieCTPS != "") || ($("#dadosProfissionaisNumCTPS")[0].checkValidity() == false && numCTPS != "") || ($("#dadosProfissionaisPIS")[0].checkValidity() == false && pis != "") || ($("#dadosProfissionaisEmissaoCTPS")[0].checkValidity() == false && emissaoCTPS != "") || $('#dadosProfissionaisApelido')[0].checkValidity() == false || ($("#dadosProfissionaisExperienciaInicio")[0].checkValidity() == false && experienciaInicio != "") || ($("#dadosProfissionaisExperienciaFim")[0].checkValidity() == false && experienciaFim != "")){
				alert("Dados Profissionais: Alguns dados não estão corretos. Revise os dados com campos em vermelho");
				modalOut();
			}else{	
				$.post("php/controllerValidarNomeUnicoMatricula.php", { apelido : apelido, matricula : matricula }, function(resposta){
					var valoresEncontrados = JSON.parse(resposta);
					if(valoresEncontrados[0] > 0 && valoresEncontrados[1] == 0 ){
						$('#dadosProfissionaisApelido')[0].setCustomValidity("Nome único invalido!");
						alert("Dados Profissionais: O nome único inserido é invalido! ");
						modalOut();
					}else if(valoresEncontrados[0] == 0 && valoresEncontrados[1] > 0 ){
						$('#dadosProfissionaisMatricula')[0].setCustomValidity("Matricula invalido!");
						alert("Dados Profissionais: A matricula inserida é invalido! ");
						modalOut();
					}else if(valoresEncontrados[0] > 0 && valoresEncontrados[1] > 0 ){
						$('#dadosProfissionaisApelido')[0].setCustomValidity("Nome único invalido!");
						$('#dadosProfissionaisMatricula')[0].setCustomValidity("Matricula invalido!");
						alert("Dados Profissionais: A matricula e nome único inseridos são invalidos! ");
						modalOut();
					}else{
						var validador = 0;
						
						if(cargo == 3){
							if(coren_gerente == ""){
								alert("Dados Profissionais: Parece que alguns campos obrigatório (*) estão vazios");
								validador = 1;
							}else if( $('#coren_gerente')[0].checkValidity() == false ){
								alert("Dados Profissionais: Alguns dados não estão corretos. Revise os dados com campos em vermelho");
								validador = 1;
							}else if("" == $('#coren_gerente').attr('original')){
								$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "salvarGerenteEnfermeiro", idValue: idValue, coren_gerente: coren_gerente }, function(){
									$('#coren_gerente').attr('original', coren_gerente);
									modalOut();
								});
							}else if(coren_gerente != $('#coren_gerente').attr('original')){
								$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "editarGerenteEnfermeiro", idValue: idValue, coren_gerente: coren_gerente }, function(){
									$('#coren_gerente').attr('original', coren_gerente);
									modalOut();
								});
							}				
						}else if(cargo != 3 && cargo_atual == 3){
							$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "excluirGerenteEnfermeiro", idValue: idValue }, function(){
								$('#coren_gerente').attr('original', '');
								$('#coren_gerente').val("");
								modalOut();
							});	
						}
						if(cargo == 4){					
							credencial_escolta = $('#credencialEscolta').val();
							validade_credencial = $('#validadeCredencialEscolta').val();
							if(credencial_escolta == "" || validade_credencial == ""){
								alert("Dados Profissionais: Parece que alguns campos obrigatório (*) estão vazios");
								validador = 1;
							}else if( $('#credencialEscolta')[0].checkValidity() == false || $('#validadeCredencialEscolta')[0].checkValidity() == false ){
								alert("Dados Profissionais: Alguns dados não estão corretos. Revise os dados com campos em vermelho");
								validador = 1;
							}else if("" == $('#credencialEscolta').attr('original') && "" == $('#validadeCredencialEscolta').attr('original')){
								$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "salvarMotoristaEscolta", idValue: idValue, credencial_escolta: credencial_escolta, validade_credencial: validade_credencial }, function(){
									$("#credencialEscolta").attr('original', credencial_escolta);
									$("#validadeCredencialEscolta").attr('original', validade_credencial);
									modalOut();
								});
							}else if(credencial_escolta != $('#credencialEscolta').attr('original') || validade_credencial != $('#validadeCredencialEscolta').attr('original')){
								$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "editarMotoristaEscolta", idValue: idValue, credencial_escolta: credencial_escolta, validade_credencial: validade_credencial }, function(){
									;$("#credencialEscolta").attr('original', credencial_escolta);
									$("#validadeCredencialEscolta").attr('original', validade_credencial);
									modalOut();
								});
							}				
						}else if(cargo != 4 && cargo_atual == 4){
							$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "excluirMotoristaEscolta", idValue: idValue }, function(){
								$("#credencialEscolta").attr('original', '');
								$("#validadeCredencialEscolta").attr('original', '');
								$("#credencialEscolta").val("");
								$("#validadeCredencialEscolta").val("");
								modalOut();
							});	
						}
						if(cargo == 5){					
							credencial_ambulancia = $('#credencialAmbulancia').val();
							validade_credencial_ambulancia = $('#validadeCredencialAmbulancia').val();
							if(credencial_ambulancia == "" || validade_credencial_ambulancia == ""){
								alert("Dados Profissionais: Parece que alguns campos obrigatório (*) estão vazios");
								validador = 1;
							}else if( $('#credencialAmbulancia')[0].checkValidity() == false || $('#validadeCredencialAmbulancia')[0].checkValidity() == false ){
								alert("Dados Profissionais: Alguns dados não estão corretos. Revise os dados com campos em vermelho");
								validador = 1;
							}else if("" == $('#credencialAmbulancia').attr('original') && "" == $('#validadeCredencialAmbulancia').attr('original')){
								$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "salvarMotoristaAmbulancia", idValue: idValue, credencial_ambulancia: credencial_ambulancia, validade_credencial_ambulancia: validade_credencial_ambulancia }, function(){
									$("#credencialAmbulancia").attr('original', credencial_ambulancia);
									$("#validadeCredencialAmbulancia").attr('original', validade_credencial_ambulancia);
									modalOut();
								});
							}else if(credencial_ambulancia != $('#credencialAmbulancia').attr('original') || validade_credencial_ambulancia != $('#validadeCredencialAmbulancia').attr('original')){
								$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "editarMotoristaAmbulancia", idValue: idValue, credencial_ambulancia: credencial_ambulancia, validade_credencial_ambulancia: validade_credencial_ambulancia }, function(){
									;$("#credencialAmbulancia").attr('original', credencial_ambulancia);
									$("#validadeCredencialAmbulancia").attr('original', validade_credencial_ambulancia);
									modalOut();
								});
							}				
						}else if(cargo != 5 && cargo_atual == 5){
							$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "excluirMotoristaAmbulancia", idValue: idValue }, function(){
								$("#credencialAmbulancia").attr('original', '');
								$("#validadeCredencialAmbulancia").attr('original', '');
								$("#credencialAmbulancia").val("");
								$("#validadeCredencialAmbulancia").val("");
								modalOut();
							});	
						}
						
						if(cargo == 6){
							if(coren_enfermeiro == ""){
								alert("Dados Profissionais: Parece que alguns campos obrigatório (*) estão vazios");
								validador = 1;
							}else if( $('#coren_enfermeiro')[0].checkValidity() == false ){
								alert("Dados Profissionais: Alguns dados não estão corretos. Revise os dados com campos em vermelho");
								validador = 1;
							}else if("" == $('#coren_enfermeiro').attr('original')){
								$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "salvarEnfermeiro", idValue: idValue, coren_enfermeiro: coren_enfermeiro }, function(){
									$('#coren_enfermeiro').attr('original', coren_enfermeiro);
									modalOut();
								});
							}else if(coren_enfermeiro != $('#coren_enfermeiro').attr('original')){
								$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "editarEnfermeiro", idValue: idValue, coren_enfermeiro: coren_enfermeiro }, function(){
									$('#coren_enfermeiro').attr('original', coren_enfermeiro);
									modalOut();
								});
							}				
						}else if(cargo != 6 && cargo_atual == 6){
							$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "excluirEnfermeiro", idValue: idValue }, function(){
								$('#coren_enfermeiro').attr('original', '');
								$('#coren_enfermeiro').val("");
								modalOut();
							});	
						}
						
						if(validador == 0 && varmud[0] == 1){
							$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "dadosProfissionais", validado : validado, matricula : matricula, apelido : apelido, admissao : admissao, demissao : demissao, sindicato : sindicato, cargo : cargo, pis : pis, numCTPS : numCTPS, serieCTPS : serieCTPS, ufCTPS : ufCTPS, emissaoCTPS : emissaoCTPS, empresaID : empresaID, experienciaInicio : experienciaInicio, experienciaFim : experienciaFim }, function(){
								
								$("#validacaoAcesso").attr('validacao_acesso_original', validado);
								$("#dadosProfissionaisApelido").attr('dados_profissionais_apelido_original', apelido);
								$("#dadosProfissionaisEmpresa"+idValueEmpresa).attr('empresa_atual', empresaID);
								$("#dadosProfissionaisMatricula").attr('dados_profissionais_matricula_original', matricula);
								$("#dadosProfissionaisAdmissao").attr('dados_profissionais_admissao_original', admissao)
								$("#dadosProfissionaisDemissao").attr('dados_profissionais_demissao_original', demissao);
								$("#cargos").attr('cargo_atual', cargo);
								$("#dadosProfissionaisSindicato").attr('dados_profissionais_sindicato_original', sindicato);
								$("#dadosProfissionaisPIS").attr('dados_profissionais_PIS_original', pis);
								$("#dadosProfissionaisNumCTPS").attr('dados_profissionais_num_CTPS_original', numCTPS);
								$("#dadosProfissionaisSerieCTPS").attr('dados_profissionais_serie_CTPS_original', serieCTPS);
								$("#estadosBrasil5").attr('estados_original', ufCTPS);
								$("#dadosProfissionaisEmissaoCTPS").attr('dados_profissionais_emissao_CTPS_original', emissaoCTPS);
								$('#dadosProfissionaisExperienciaInicio').attr('dados_profissionais_experiencia_inicio_original', experienciaInicio);
								$('#dadosProfissionaisExperienciaFim').attr('dados_profissionais_experiencia_fim_original', experienciaFim);

								
								//alert("Edição realizada com sucesso!");
								modalOut();
							});
						}else{
							//alert("Edição realizada com sucesso!");
							modalOut();
						}				
					}
				});
			}
		}else{
			//alert("Dados Profissionais: Parece que nenhum dado foi alterado!");
			modalOut();
		}
	});
	
	$(document).on('click', '.btnSalvarJornada', function() {
		modal();
		
		var id_jornada = $('#jornada').attr('id_jornada');

		var horaS = $('#dadosHorasSemanais').val();
		var horaM = $('#dadosHorasMensais').val();
		var horaE = $('#dadosHorasExtrasMaximas').val();
		var dom = $('#domingo').attr('valor_id_semana');
		var seg = $('#segunda').attr('valor_id_semana');
		var ter = $('#terca').attr('valor_id_semana');
		var qua = $('#quarta').attr('valor_id_semana');
		var qui = $('#quinta').attr('valor_id_semana');
		var sex = $('#sexta').attr('valor_id_semana');
		var sab = $('#sabado').attr('valor_id_semana');

		var horaS_original = $('#dadosHorasSemanais').attr('dados_horas_semanais_original');
		var horaM_original = $('#dadosHorasMensais').attr('dados_horas_mensais_original');
		var horaE_original = $('#dadosHorasExtrasMaximas').attr('dados_horas_extras_maximas_original');
		var dom_original = $('#domingo').attr('domingo_original');
		var seg_original = $('#segunda').attr('segunda_original');
		var ter_original = $('#terca').attr('terca_original');
		var qua_original = $('#quarta').attr('quarta_original');
		var qui_original = $('#quinta').attr('quinta_origi');
		var sex_original = $('#sexta').attr('sexta_original');
		var sab_original = $('#sabado').attr('sabado_original');

		var varmud = 0;
		
		if( horaS != horaS_original || horaM != horaM_original || horaE != horaE_original || dom != dom_original || seg != seg_original || ter != ter_original || qua != qua_original || qui != qui_original || sex != sex_original || sab != sab_original ){
			varmud=1;
		}
		
		if(varmud==1){
			if( ($('#dadosHorasSemanais')[0].checkValidity() == false && $('#dadosHorasSemanais').val() != "") || ($('#dadosHorasMensais')[0].checkValidity() == false && $('#dadosHorasMensais').val() != "") || ($('#dadosHorasExtrasMaximas')[0].checkValidity() == false && $('#dadosHorasExtrasMaximas').val() != "") ){
				alert("Jornada: Alguns dados não estão corretos. Revise os dados com campos em vermelho");
				modalOut();			
			}else{	
				$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "modificarJornada", id_jornada : id_jornada, horaS : horaS, horaM : horaM, horaE : horaE, dom : dom, seg : seg, ter : ter, qua : qua, qui : qui, sex : sex, sab : sab }, function(e){
					
					$('#dadosHorasSemanais').attr('dados_horas_semanais_original', horaS);
					$('#dadosHorasMensais').attr('dados_horas_mensais_original', horaM);
					$('#dadosHorasExtrasMaximas').attr('dados_horas_extras_maximas_original', horaE);
					$('#domingo').attr('domingo_original', dom);
					$('#segunda').attr('segunda_original', seg);
					$('#terca').attr('terca_original', ter);
					$('#quarta').attr('quarta_original', qua);
					$('#quinta').attr('quinta_origi', qui);
					$('#sexta').attr('sexta_original', sex);
					$('#sabado').attr('sabado_original', sab);
					
					modalOut();
				});
			}
		}else{
			//alert("Dados Profissionais: Parece que nenhum dado foi alterado!");
			modalOut();
		}
	});

	$(document).on('click', '.btnSalvarRemuneracao', function() {
		modal();
		
		var id_remuneracao = $('#remuneracao').attr('id_remuneracao');
		
		var salario = $('#dadosSalario').val().replace(/[.,]/g, "");
		var vInicio = $('#dadosVigenciaInicio').val();
		var vFim = $('#dadosVigenciaFim').val();
		
		var salario_original = $('#dadosSalario').attr('dados_salario_original');
		var vInicio_original = $('#dadosVigenciaInicio').attr('dados_vigencia_inicio_original');
		var vFim_original = $('#dadosVigenciaFim').attr('dados_vigencia_fim_original') != "" ? $('#dadosVigenciaFim').attr('dados_vigencia_fim_original') : vInicio;

		var varmud = 0;
		
		if( salario != salario_original || vInicio != vInicio_original || vFim != vFim_original ){
			varmud=1;
		}

		if(varmud==1){
			if( $('#dadosSalario')[0].checkValidity() == false || $('#dadosVigenciaInicio')[0].checkValidity() == false || ( $('#dadosVigenciaFim')[0].checkValidity() == false && $('#dadosVigenciaFim').val() != '' ) ){
				alert("Remuneração: Alguns dados não estão corretos. Revise os dados com campos em vermelho");
				modalOut();			
			}else{	
				
				$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "modificarRemuneracao", id_remuneracao : id_remuneracao, salario : salario, vInicio : vInicio, vFim : vFim, vFim_original : vFim_original }, function(resposta){
					var validador = JSON.parse(resposta);
					
					if(id_remuneracao != 0){
						salario_original = parseFloat((salario_original/100)).toFixed(2);
						let result = (new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(salario_original));

						$('#textareaSalarios').prepend('Valor: "'+result +'" - Vigência (início): "'+vInicio_original+'" - Vigência (fim): "'+vFim_original+'"  \n'); 
					}	
					$('#remuneracao').attr('id_remuneracao', validador);
					$('#dadosSalario').attr('dados_salario_original', salario);
					$('#dadosVigenciaInicio').attr('dados_vigencia_inicio_original', vInicio);
					$('#dadosVigenciaFim').attr('dados_vigencia_fim_original', vFim);
				
					modalOut();
				});
			}
		}else{
			//alert("Dados Profissionais: Parece que nenhum dado foi alterado!");
			modalOut();
		}
	});

	$(document).on('click', '.enderecos', function() {
		modal();
		
		var id = this.id.substr(8, this.id.length);
		var enderecoCEP = $('#enderecoCEP').val(); 
		var enderecoCasa = $('#enderecoCasa').val(); 
		var enderecoBairro = $('#enderecoBairro').val(); 
		var estado = $('#estadosBrasil1 option:selected').attr('verificador'); 
		var enderecoCidade = $('#enderecoCidade').val(); 
		var enderecoComplemento = $('#enderecoComplemento').val(); 
		var enderecoReferencia = $('#enderecoReferencia').val(); 
		var enderecoLogradouro = $('#enderecoLogradouro').val(); 
		
		if( enderecoCEP != $("#enderecoCEP").attr('endereco_CEP_original') || enderecoLogradouro != $("#enderecoLogradouro").attr('endereco_logradouro_original') || enderecoCasa != $("#enderecoCasa").attr('endereco_casa_original') || enderecoComplemento != $("#enderecoComplemento").attr('endereco_complemento_original') || enderecoBairro != $("#enderecoBairro").attr('endereco_bairro_original') || enderecoCidade != $("#enderecoCidade").attr('endereco_cidade_original') || estado != $("#estadosBrasil1").attr('estados_original') || enderecoReferencia != $("#enderecoReferencia").attr('endereco_referencia_original') ){
		
			if(enderecoCEP == "" || enderecoCasa == "" || enderecoBairro == "" || estado == "" || enderecoCidade == "" || enderecoLogradouro == ""){
				alert("Endereço: Parece que alguns campos obrigatório (*) estão vazios");
				modalOut();
			}else if( $("#enderecoCEP")[0].checkValidity() == false || $("#enderecoCasa")[0].checkValidity() == false || $("#enderecoBairro")[0].checkValidity() == false || $("#estadosBrasil1")[0].checkValidity() == false || $("#enderecoCidade")[0].checkValidity() == false || ($("#enderecoComplemento")[0].checkValidity() == false && enderecoComplemento != "") || ($("#enderecoReferencia")[0].checkValidity() == false && enderecoReferencia != "") || $("#enderecoLogradouro")[0].checkValidity() == false ){
				alert("Endereço: Alguns dados não estão corretos. Revise os dados com campos em vermelho");
				modalOut();
			}else{
				if(id>0){		
					$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "editarEndereco", id: id, enderecoCEP : enderecoCEP, enderecoCasa : enderecoCasa, enderecoBairro : enderecoBairro, estado : estado, enderecoCidade : enderecoCidade, enderecoComplemento : enderecoComplemento, enderecoReferencia : enderecoReferencia, enderecoLogradouro : enderecoLogradouro }, function(){
						
						$("#enderecoCEP").attr('endereco_CEP_original', enderecoCEP);
						$("#enderecoLogradouro").attr('endereco_logradouro_original', enderecoLogradouro);
						$("#enderecoCasa").attr('endereco_casa_original', enderecoCasa);
						$("#enderecoComplemento").attr('endereco_complemento_original', enderecoComplemento);
						$("#enderecoBairro").attr('endereco_bairro_original', enderecoBairro);
						$("#enderecoCidade").attr('endereco_cidade_original', enderecoCidade);
						$("#estadosBrasil1").attr('estados_original', estado);
						$("#enderecoReferencia").attr('endereco_referencia_original', enderecoReferencia);
						
						//alert("Edição realizada com sucesso!");
						
						modalOut();
					});
				}else{
					$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "criarEndereco", enderecoCEP : enderecoCEP, enderecoCasa : enderecoCasa, enderecoBairro : enderecoBairro, estado : estado, enderecoCidade : enderecoCidade, enderecoComplemento : enderecoComplemento, enderecoReferencia : enderecoReferencia, enderecoLogradouro : enderecoLogradouro }, function(retorno){
						
						$(this).attr('id', "endereco"+retorno);
						
						$("#enderecoCEP").attr('endereco_CEP_original', enderecoCEP);
						$("#enderecoLogradouro").attr('endereco_logradouro_original', enderecoLogradouro);
						$("#enderecoCasa").attr('endereco_casa_original', enderecoCasa);
						$("#enderecoComplemento").attr('endereco_complemento_original', enderecoComplemento);
						$("#enderecoBairro").attr('endereco_bairro_original', enderecoBairro);
						$("#enderecoCidade").attr('endereco_cidade_original', enderecoCidade);
						$("#estadosBrasil1").attr('estados_original', estado);
						$("#enderecoReferencia").attr('endereco_referencia_original', enderecoReferencia);
						
						//alert("Edição realizada com sucesso!");
						
						modalOut();
					});
				}
			}
		}else{
			alert("Endereço: Parece que nenhum dado foi alterado!");
			modalOut();
		}
	});
	
	$(document).on('click', '#salvarDependente', function() {
		modal();
		var count = $('.container .dependente').each(function(index){}).length;
		$('.dependente').each(function(index) { 
			var id = $(this).attr('dependente_id');
			var dependenteSelec = $(this);
			
			var nome = $('#dadosDependenteNome'+id).val();
			var cpf = $('#dadosDependentesCPF'+id).val();
			var nascimento = $('#dadosDependenteNascimento'+id).val();
			var tipo_dependente = $('#tipoDependente'+id+' option:selected').val(); 
			
			var dependenteNome = $('#dadosDependenteNome'+id).attr('dependenteNome');
			var dependenteCPF = $('#dadosDependentesCPF'+id).attr('dependenteCPF');
			var dependenteNascimento = $('#dadosDependenteNascimento'+id).attr('dependenteNascimento');
			var dependenteTipo = $('#tipoDependente'+id).attr('dependenteTipo');
				
			if((nome == "" || cpf == "" || nascimento == "" || tipo_dependente == "") && (id == 0 && (nome != "" || cpf != "" || nascimento != "" || tipo_dependente != ""))){
				alert("Dependentes: Parece que alguns campos obrigatório (*) estão vazios");
				modalOut();
			}else if( ($("#dadosDependenteNome"+id)[0].checkValidity() == false || $("#dadosDependentesCPF"+id)[0].checkValidity() == false || $("#dadosDependenteNascimento"+id)[0].checkValidity() == false) && (id == 0 && ($("#dadosDependenteNome"+id)[0].checkValidity() == true || $("#dadosDependentesCPF"+id)[0].checkValidity() == true || $("#dadosDependenteNascimento"+id)[0].checkValidity() == true))){
				alert("Dependentes: Alguns dados não estão corretos. Revise os dados com campos em vermelho");
				modalOut();
			}else{
				
				if(dependenteNome != nome || dependenteCPF != cpf || dependenteNascimento != nascimento || dependenteTipo != tipo_dependente){
				
					if(id>0){		
						$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "editarDependente", id: id, nome: nome, cpf: cpf, nascimento: nascimento, tipo_dependente: tipo_dependente }, function(e){
							
							$('#dadosDependenteNome'+id).attr('dependenteNome', nome);
							$('#dadosDependentesCPF'+id).attr('dependenteCPF', cpf);
							$('#dadosDependenteNascimento'+id).attr('dependenteNascimento', nascimento);
							$('#tipoDependente'+id).attr('dependenteTipo', tipo_dependente);
							
							modalOut();
							
						});
					}else{
						$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "criarDependente", nome: nome, cpf: cpf, nascimento: nascimento, tipo_dependente: tipo_dependente }, function(retorno){
							
							
							$('#tbodydependente'+id).attr('id', "tbodydependente"+retorno);
							
							dependenteSelec.attr('dependente_id', retorno);
							
							$('#dadosDependenteNome'+id).attr('dependenteNome', nome);
							$('#dadosDependentesCPF'+id).attr('dependenteCPF', cpf);
							$('#dadosDependenteNascimento'+id).attr('dependenteNascimento', nascimento);
							$('#tipoDependente'+id).attr('dependenteTipo', tipo_dependente);
							
							$('<button id="excluirDependente'+retorno+'" type="button" class="btn btn-primary btnExcluirDependente">Excluir dependente</button>').insertBefore("#rowToInsert"+id);			
							
							$('#rowToInsert'+id).attr('id', 'rowToInsert'+retorno);
							
							$('#dadosDependenteNome'+id).attr('id', 'dadosDependenteNome'+retorno);
							$('#dadosDependentesCPF'+id).attr('id', 'dadosDependentesCPF'+retorno);
							$('#dadosDependenteNascimento'+id).attr('id', 'dadosDependenteNascimento'+retorno);
							$('#tipoDependente'+id).attr('id', 'tipoDependente'+retorno);
							
							modalOut();
							
						});
					}	
				}
				
				if (index === (count-1)) {
					
					//alert("Operação realizada com sucesso!");

					modalOut();
				}
			}
		});
	});

	$(document).on('change', '.dependente_select', function() {
		var id = $(this).attr('id');
		var id_objeto = id.substr(14, id.length);
		if($('#'+id+' option:selected').val() == 1){
			$("#dadosDependenteNome"+id_objeto).val($("#dependenteLista").attr("dp_conjuje_nome"));
			$("#dadosDependentesCPF"+id_objeto).val($("#dependenteLista").attr("dp_conjuje_cpf"));
			$("#dadosDependenteNascimento"+id_objeto).val($("#dependenteLista").attr("dp_conjuje_nascimento"));
		}else{
			$("#dadosDependenteNome"+id_objeto).val("");
			$("#dadosDependentesCPF"+id_objeto).val("");
			$("#dadosDependenteNascimento"+id_objeto).val("");
		}
	});
	
	$(document).on('click', '.btnExcluirDependente', function() {		
		var id = this.id.substr(17, this.id.length);
		
		if(id>0){		
		
			modal();
			
			$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "excluirDependente", id: id }, function(e){
				
				$('#tbodydependente'+id).remove();
				//alert("Dependente removido com sucesso!");
				modalOut();
			});
		}
	});
	
	$(document).on('click', '.btnSalvarDadosBancarios', function() {
		var idValue = this.id.substr(15, this.id.length);
	
		var bancoNome = $('#dadosBancoNome').val();
		var bancoAgencia = $('#dadosBancoAgencia').val();
		var bancoConta = $('#dadosBancoConta').val();
		var tipoConta = $('#tipoContaBanco'+idValue+' option:selected').val();
		var pix = $('#dadosBancoChavePix').val();
		
		var nome_atual = $('#dadosBancoNome').attr('dadosBancoNomeAtual');
		var agencia_atual = $('#dadosBancoAgencia').attr('dadosBancoAgenciaAtual');
		var conta_atual = $('#dadosBancoConta').attr('dadosBancoContaAtual');
		var tipo_conta_atual = $("#tipoContaBanco"+idValue).attr('tipoContaBanco_atual');
		var pix_atual = $("#dadosBancoChavePix").attr('dadosBancoChavePix_atual');
		
		if(bancoNome != "" && (bancoAgencia == "" || bancoConta == "" || tipoConta == "") ){
			alert("Dados bancários: Parece que alguns campos obrigatório ligados a banco (**) estão vazios");
		}else if( ( bancoNome != "" && ( $('#dadosBancoNome')[0].checkValidity() == false || $('#dadosBancoAgencia')[0].checkValidity() == false || $('#dadosBancoConta')[0].checkValidity() == false )	) || $('#dadosBancoChavePix')[0].checkValidity() == false && $('#dadosBancoChavePix').val() != "" ){
			alert("Dados bancários: Alguns dados não estão corretos. Revise os dados com campos em vermelho");
		}else{
			
			modal();
			if(idValue>0){	
				if(bancoNome != nome_atual || bancoAgencia != agencia_atual || bancoConta != conta_atual || tipoConta != tipo_conta_atual || pix != pix_atual){
					$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "editarDadosBancarios", idValue: idValue, bancoNome: bancoNome, bancoAgencia: bancoAgencia, bancoConta: bancoConta, tipoConta: tipoConta, pix: pix }, function(e){
						//alert("Dados alterados com sucesso!");
						
						$('#dadosBancoNome').attr('dadosBancoNomeAtual', bancoNome);
						$('#dadosBancoAgencia').attr('dadosBancoAgenciaAtual', bancoAgencia);
						$('#dadosBancoConta').attr('dadosBancoContaAtual', bancoConta);
						$("#tipoContaBanco"+idValue).attr('tipoContaBanco_atual', tipoConta);
						$("#dadosBancoChavePix").attr('dadosBancoChavePix_atual', pix);
						
						modalOut();
					});
				}else{
					//alert("Dados bancários: Parece que nenhum dado foi alterado!");
					modalOut();
				}
			}else{
				$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "criarDadosBancarios", bancoNome: bancoNome, bancoAgencia: bancoAgencia, bancoConta: bancoConta, tipoConta: tipoConta, pix: pix }, function(e){
					//alert("Dados criados com sucesso!");
					
					$('.btnSalvarDadosBancarios').attr('id', "dadosBancarios-"+e);
					
					$('#dadosBancoNome').attr('dadosBancoNomeAtual', bancoNome);
					$('#dadosBancoAgencia').attr('dadosBancoAgenciaAtual', bancoAgencia);
					$('#dadosBancoConta').attr('dadosBancoContaAtual', bancoConta);
					$("#tipoContaBanco"+idValue).attr('tipoContaBanco_atual', tipoConta);
					$("#dadosBancoChavePix").attr('dadosBancoChavePix_atual', pix);
					
					modalOut();
				});
			}
		}
	});
	
	$(document).on('click', '.btnEmail', function() {
		var email = $('#contatoEmail').val();
		var id_pessoa = $("#contatoEmail").attr('email_id');

		var email_original = $("#contatoEmail").attr('email_original');
		
		if(email != email_original){
		
			$('#contatoEmail')[0].setCustomValidity("");
			
			if(email == ""){
				alert("E-mail: O campo e-mail está vazio");
			}else if($('#contatoEmail')[0].checkValidity() == false){
				alert("E-mail: Os dados inseridos em e-mail não estão corretos. Por favor, revise estes dados antes de continuar!");
			}else{
				
				modal();
				
				$.post("php/controllerValidarEmailPessoa.php", { user: id_pessoa }, function(resposta){0
					var validador = JSON.parse(resposta);
					
					if(validador == 0){
						$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "cadastrar_email", email: email, user: id_pessoa }, function(e){
							//alert("e-mail inserido com sucesso");
							//window.location.reload(true);
							$('#contatoEmail').attr('email_id', e);
							$("#contatoEmail").attr('email_original', email);
							
							modalOut();
						});
					}else{
						$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "editar_email", email: email, user: id_pessoa }, function(){
							//alert("e-mail alterado com sucesso");
							//window.location.reload(true);
							$("#contatoEmail").attr('email_original', email);
							
							modalOut();
						});
					}
				});
			}
		}else{
			alert('E-mail: Parece que o e-mail não foi alterado');
		}
	});

	$(document).on('click', '.btnSalvar', function() {
		var idValue = this.id.substr(13, this.id.length);
		var contatosTelefone = $("#contatosTelefone"+idValue).val();
		var telefoneWhatsapp = $("input[name='radioTelefone"+idValue+"']:checked").val();
		var tipoContato = $('#tipoContato'+idValue+' option:selected').val(); 
		var contatoNome = $('#contatoNome'+idValue).val(); 
		
		if(contatosTelefone == "" || tipoContato == ""){
			alert("Campo com * vazio!");
		}else if($("#contatosTelefone"+idValue)[0].checkValidity() == false || $("#contatoNome"+idValue)[0].checkValidity() == false){
			alert("Telefones: Formato inválido! Ajustes os dados com campos em vermelho.");
		}else if(idValue!=0){
			modal();
			$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "editarContato", idValue : idValue, contatosTelefone : contatosTelefone, telefoneWhatsapp : telefoneWhatsapp, tipoContato: tipoContato, contatoNome: contatoNome }, function(){
				//alert("Edição realizada com sucesso!");
				//window.location.reload(true);
				modalOut();
			});
		}else{
			modal();
			$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "criarContato", contatosTelefone : contatosTelefone, telefoneWhatsapp : telefoneWhatsapp, tipoContato: tipoContato, contatoNome: contatoNome }, function(e){
				//alert("Adição realizada com sucesso!");
				//window.location.reload(true);
				$("#telefone-0").attr('id', 'telefone-'+e);
				$("#salvarContato0").attr('id', 'salvarContato'+e);
				$("#contatosTelefone0").attr('id', 'contatosTelefone'+e);
				$("input[name='radioTelefone"+idValue+"']").attr('name', 'radioTelefone'+e);
				
				modalOut();
			});
		}
	});
	
	$(document).on('click', '.btnExcluir', function() {
		var idValue = this.id.substr(14, this.id.length);
		modal();
		if(idValue!=0){
			$.post("php/controllerEdicaoColaboradorEspecifico.php", { direcionador : "excluirContato", idValue : idValue }, function(){
				//alert("Exclusão realizada com sucesso!");
				//window.location.reload(true);
				$('#telefone-'+idValue).remove();
				//alert("Dependente removido com sucesso!");
				modalOut();
				
				modalOut();
			});
		}else{
			//alert("Operação realizada com sucesso!");
			//window.location.reload(true);
			modalOut();
		}
	});
	
	$(document).on('click', '#addContato', function() {
		var verificador = document.getElementById("contatosTelefone0");
		if(verificador == null){
		
			var tbody = ''+
				'<tbody id="telefone-0" class="telefoneRow">'+
					'<tr>'+
						'<td>'+
							'<div class="row">'+
								'<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">'+
									'<i id="faPhone0" class="fa fa-phone" style="font-size:24px"></i>'+
									'<i id="faMobile0" class="fa fa-mobile" style="font-size:34px"></i>'+
									'<div class="inputbox">'+
										'<input class="telefone mobile" id="contatosTelefone0" required pattern="\\([0-9]{2}\\)\\s[0-9]{4}-[0-9]{4}|\\([0-9]{2}\\)\\s[0-9]{1}\\s[0-9]{4}-[0-9]{4}" type="text" value="">'+
										'<span>Telefone(*): </span>'+
									'</div>'+
								'</div>'+
							'</div>'+
							'<div class="row">'+
								'<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">'+
									'<label class="inputbox">    Este número é Whatsapp?:  </label>'+
									'<input class="form-check-input" type="radio" name="radioTelefone0" value="1">'+
									'<label class="form-check-label">'+
											' Sim '+
									'</label>'+
									'<input class="form-check-input" type="radio" name="radioTelefone0" value="0" checked>'+
									'<label class="form-check-label">'+
										' Não '+
									'</label>'+
								'</div>'+
							'</div>'+	
							'<div class="row">'+
								'<div class="inputbox col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">'+
									'<select id="tipoContato0" class="tipoContato" name="contato"><option value="" disabled selected="">Selecione uma opção</option><option value="1">Próprio</option><option value="2">Esposo(a)</option><option value="3">Pais/Mãe</option><option value="4">Irmão/Irmão</option><option value="5">Tio(a)</option><option value="6">Avô(ó)</option><option value="7">Filho(a)</option><option value="8">Vizinho(a)</option><option value="9">Amigo(a)</option><option value="10">Outros</option></select>'+
									'<span>Relação (*):  </span>'+
								'</div>'+
								'<div class="inputbox col-xs-9 col-sm-9 col-md-9 col-lg-9 col-xl-9">'+
									'<input class="texto nomeContato" id="contatoNome0" required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\\s\\-]{2,79}" type="text" value="">'+
									'<span>Nome do contato (*):  </span>'+
								'</div>'+
							'</div>'+
						'</td>'+
					'</tr>'+
					'<tr>'+
						'<td>'+
							'<button id="salvarContato0" type="button" class="btn btn-primary btnSalvar">Salvar</button>'+
							'<p \>'+
						'</td>'+
					'</tr>'+
				'</tbody>'
			;
			$("#contatosLista").after(tbody);
		}
	});
	
	$(document).on('click', '#addDependente', function(event) {
		var cond = 0;
		var id = 0;
		$('.dependente').each(function(index){ if($(this).attr('dependente_id')==0){ cond = 1; }else { id = $(this).attr('dependente_id') } });
		if (cond == 0) { 
			var tbody = ''+
				'<tbody id="tbodydependente0">'+
					'<tr>'+
						'<td>'+
							'<div class="container">'+
								'<div class="dependente" id="dependente_id_0" dependente_id="0">'+
									'<div class="row" id="rowToInsert0">'+
										'<div class="inputbox col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">'+
											'<input dependenteNome="" required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\\s\\-]{2,79}" class="texto" id="dadosDependenteNome0" type="text" value="">'+
											'<span>Nome (*):  </span>'+
										'</div>'+
									'</div>'+
									'<div class="row" >'+
										'<div class="inputbox col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">'+
											'<input dependenteCPF="" id="dadosDependentesCPF0" required pattern="\\d{3}\\.\\d{3}\\.\\d{3}-\\d{2}" for="cpf" class="cpf" type="text" value="">'+
											'<span>CPF nº(*):  </span>'+
										'</div>'+
										'<div class="inputbox col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">'+
											'<input dependenteNascimento="" id="dadosDependenteNascimento0" required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" for="date" class="date" type="text" value="">'+
											'<span>Data de nascimento (*):  </span>'+
										'</div>'+
										'<div class="inputbox col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5">'+
											'<select class="dependente_select" dependenteTipo="" id="tipoDependente0" name="dependente"><option value="" disabled selected="">Selecione uma opção</option><option value="1" >Companheiro(a)</option><option value="2">Filho(a) ou enteado(a) até 21 anos</option><option value="3">Filho(a) ou enteado(a) até 24 anos</option><option value="4">Irmão(ã), neto(a) ou bisneto(a) - guarda judicial</option><option value="5">Irmão(ã), neto(a) ou bisneto(a) até 24 anos</option><option value="6">Pais, avós e bisavós</option><option value="7">Menor pobre até 21 anos</option><option value="8">Pessoa absolutamente incapaz</option></select>'+
											'<span>Relação (*):  </span>'+	
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</td>'+
					'</tr>'+
				'</tbody>'
			;
			$("#dependenteLista").after(tbody);
		}
	});
	
	if($('#cargos option:selected').val()!=3){
		$('#gerente_enfermeiro').fadeOut(1);
	}
	
	if($('#cargos option:selected').val()!=4){
		$('#motorista_escolta').fadeOut(1);
	}
	
	if($('#cargos option:selected').val()!=5){
		$('#motorista_ambulancia').fadeOut(1);
	}
	
	if($('#cargos option:selected').val()!=6){
		$('#auxiliar_enfermagem').fadeOut(1);
	}
	
	if($(".btnSalvarDadosPessoais").attr('id_conctrole')==0){
		$('.complementoCorpo').fadeOut(1);
	}
	
	$(document).on('keyup', '#dadosPessoaisCPF', function() {
		if($('#dadosPessoaisCPF').val() != ""){
			$('#dadosPessoaisCPF')[0].setCustomValidity("");
		}
	});
	
	/*$('.estados').each(function(index) {
		var idValue = this.id.substr(13, this.id.length);
		$('#'+this.id).attr('estados_original', $('#'+this.id+' option:selected').val());
	});*/
	
	$(document).on('change', '#cargos', function(event) {
		var cargo = $('#cargos option:selected').val();
		if (cargo == 3) { 
			$('#gerente_enfermeiro').fadeIn('slow');
		}else{
			$('#gerente_enfermeiro').fadeOut('slow');
		}
		
		if (cargo == 4) { 
			$('#motorista_escolta').fadeIn('slow');
		}else{
			$('#motorista_escolta').fadeOut('slow');
		}
		
		if (cargo == 5) { 
			$('#motorista_ambulancia').fadeIn('slow');
		}else{
			$('#motorista_ambulancia').fadeOut('slow');
		}
		
		if (cargo == 6) { 
			$('#auxiliar_enfermagem').fadeIn('slow');
		}else{
			$('#auxiliar_enfermagem').fadeOut('slow');
		}
	});

	if($('#estadoCivil option:selected').val()!=2){
		$('#dadosConjuje').fadeOut(1);
	}

	$(document).on('change', '#estadoCivil', function(event) {
		var estado = $('#estadoCivil option:selected').val();
		if (estado == 2) { 
			$('#dadosConjuje').fadeIn('slow');
		}else{
			$('#dadosConjuje').fadeOut('slow');
		}
	});
	
	$(document).on('keyup', 'input', function(event) {
		var id = $(this).parent().parent().parent().parent().attr('id');
		if (event.which == 13) {
			var generico = $("#"+id).find('input:visible');
			var indice = generico.index(event.target) + 1;
			var seletor = $(generico[indice]).focus();

			if (seletor.length == 0) {
				event.target.focus();
			}
		}
	});
	
	$(document).on('change', '#uploadImagePessoa', function(event) {
		var reader  = new FileReader();
		
		reader.onload = () => {
			$('#img_pessoa_photo').attr('src', reader.result);
		}

		reader.readAsDataURL($('#uploadImagePessoa').prop('files')[0]);
	});
	
	
	$(document).on('click', '#img_pessoa_photo', function() {
		$('#uploadImagePessoa').click();
	});
	
	$(".fixo").mask("(00) 0000-0000");
	$(".mobile").mask("(00) 0 0000-0000");
	
	$(document).on('click focus onKeyPress', '.telefone', function() {
		$(".mobile").mask("(00) 0 0000-0000");
		$(".fixo").mask("(00) 0000-0000");
	});
	
	$('.date').mask('00/00/0000');
	
	$('.enfermeiro').mask('AZZZZZZZZZZZZZZ', {
		translation: {
			Z: {
				pattern: /[A-Za-z0-9\-]/
			},
			A: {
				pattern: /[A-Za-z0-9]/
			}
		}
	});
	
	$('.credencial').mask('00000.000000/0000-00000');
	
	
	$(document).on('click focus onKeyPress', '.date', function() {
		$('.date').mask('00/00/0000');
	});
	
	$(document).on('click', '.fa-mobile', function() {
		var idValue = this.id.substr(8, this.id.length);
		var contatosTelefone = $("#contatosTelefone"+idValue).val();
		$("#contatosTelefone"+idValue).removeClass();
		$("#contatosTelefone"+idValue).addClass('telefone');
		$("#contatosTelefone"+idValue).addClass('mobile');
		$(".mobile").mask("(00) 0 0000-0000");
		$('#faPhone'+idValue).css('font-size', '24px');
		$('#faMobile'+idValue).css('font-size', '34px');
	});
	
	$(document).on('click', '.fa-phone', function() {
		var idValue = this.id.substr(7, this.id.length);
		var contatosTelefone = $("#contatosTelefone"+idValue).val();
		$("#contatosTelefone"+idValue).removeClass();
		$("#contatosTelefone"+idValue).addClass('telefone');
		$("#contatosTelefone"+idValue).addClass('fixo');
		$(".fixo").mask("(00) 0000-0000");
		$('#faPhone'+idValue).css('font-size', '34px');
		$('#faMobile'+idValue).css('font-size', '24px');
	});
	
	$('.cpf').mask('000.000.000-00');
	
	$(document).on('click focus onKeyPress', '.cpf', function() {
		$('.cpf').mask('000.000.000-00', {reverse: true});
	});
	
	$('.rg').mask('00000000000000', {reverse: true});

	$('.matricula').mask('000000');
	
	$('.texto').mask('AZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZ', {
		translation: {
			Z: {
				pattern: /[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]/
			},
			A: {
				pattern: /[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]/
			}
		}
	});
	
	$(document).on('click', '.texto', function() {
		$('.texto').mask('AZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZ', {
			translation: {
				Z: {
					pattern: /[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]/
				},
				A: {
					pattern: /[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]/
				}
			}
		});
	});
	
	$('.apelido').mask('AZZZZZZZZZZZZZZZZZZZZZZZZZZZZZ', {
		translation: {
			Z: {
				pattern: /[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\-]/
			},
			A: {
				pattern: /[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]/
			}
		}
	});
	
	$('.sindicato').mask('AZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZ', {
		translation: {
			Z: {
				pattern: /[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]/
			},
			A: {
				pattern: /[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]/
			}
		}
	});
	
	$('.nomeBanco').mask('AZZZZZZZZZZZZZZZZZZZZZZZZ', {
		translation: {
			Z: {
				pattern: /[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-]/
			},
			A: {
				pattern: /[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]/
			}
		}
	});
	
	$('.cnhNum').mask('00000000000');
	
	$('.numTitulo').mask('00000000000');
	
	$('.zona, .secao').mask('00000');
	
	$('.reservista').mask('000000000000');
	
	$('.sus').mask('000000000000000');

	$('.pis').mask('00000000000');
	
	$('.numCTPS').mask('00000000');
	
	$('.serieCTPS').mask('000000');
	
	$('.cep').mask('00000-0000');

	$(".money").mask("0.000.000,00", {
		reverse: true,
		translation: {
			".": "",
		"	,": ".",
		},
	});

	$('.numeroLogradouro').mask('AZZZZ', {
		translation: {
			Z: {
				pattern: /[A-Za-z0-9\s\-]/
			},
			A: {
				pattern: /[A-Za-z0-9]/
			}
		}
	});
	
	$('.numeroComplemento').mask('AZZZZZZZZZ', {
		translation: {
			Z: {
				pattern: /[A-Za-z0-9\s\-]/
			},
			A: {
				pattern: /[A-Za-z0-9]/
			}
		}
	});
	
	$('.email').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {
		translation: {
			A: {
				pattern: /[@A-Za-z0-9\-\_\.]/
			}
		}
	});
	
	$('.agencia').mask('0AAAAA0', {
		translation: {
			A: {
				pattern: /[0-9\-]/
			}
		}
	});
	
	$('.conta').mask('0AAAAAAA0', {
		translation: {
			A: {
				pattern: /[0-9\-]/
			}
		}
	});

	$('.data_hora_s_m').mask('000');

	$('.hora_extra_max').mask('0');
	
	if($(".btnSalvarDadosPessoais").attr('id_conctrole')==0){
		
	}else{
		calcularData("dadosPessoaisNascimento", "", "dadosPessoaisIdade", "ano");
		calcularData("dadosProfissionaisAdmissao", "dadosProfissionaisDemissao", "dadosProfissionaisTempoServico", "mes");
		calcularData("dadosProfissionaisExperienciaInicio", "dadosProfissionaisExperienciaFim", "dadosProfissionaisExperienciaTotal", "dia");
	}
	
	$(document).on('change', "#dadosPessoaisNascimento, #dadosProfissionaisAdmissao, #dadosProfissionaisDemissao, #dadosProfissionaisExperienciaInicio, #dadosProfissionaisExperienciaFim", function(){
		calcularData("dadosPessoaisNascimento", "", "dadosPessoaisIdade", "ano");
		calcularData("dadosProfissionaisAdmissao", "dadosProfissionaisDemissao", "dadosProfissionaisTempoServico", "mes");
		calcularData("dadosProfissionaisExperienciaInicio", "dadosProfissionaisExperienciaFim", "dadosProfissionaisExperienciaTotal", "dia");
	});

	function calcularData(id_data_ini, id_data_fim, id_saida, tipo_data){
		if($("#"+id_data_ini)[0].checkValidity() == true && $("#"+id_data_ini).val() != ""){
			
			var dataIni = $("#"+id_data_ini).val();
			var data_fim = $("#"+id_data_fim).val() != "" && $("#"+id_data_fim).val() != null ? $("#"+id_data_fim).val() : moment();
			
			dataIni = moment(dataIni, 'DD/MM/YYYY');
			data_fim = moment(data_fim, 'DD/MM/YYYY');

			// Defina a data atual
			const dataAtual = moment();

			// Calcule a diferença em dias
			const totalDias = data_fim.diff(dataIni, 'days');
			const totalMeses = data_fim.diff(dataIni, 'months');
			const totalAnos = data_fim.diff(dataIni, 'years');

			if(tipo_data=="ano"){
				$('#'+id_saida).attr('value', totalAnos);
			}else if(tipo_data=="mes"){
				$('#'+id_saida).attr('value', totalMeses);
			}else{
				$('#'+id_saida).attr('value', totalDias);
			}
			
		}
	}

	$(document).on('change', '.empresaNome', function(event) {
		var idValue = this.id.substr(25, this.id.length);
		var valor = $('#dadosProfissionaisEmpresa'+idValue).val();
		$('#dadosProfissionaisCNPJ'+idValue).val(valor);
	});
	
	$(document).on('change', '.tipoContato', function(event) {
		var idValue = this.id.substr(11, this.id.length);
		var valor = $('#tipoContato'+idValue+'  option:selected').val();
		var nome = $('#dadosPessoaisNome').val();
		if(valor == 1){
			$('#contatoNome'+idValue).val(nome);
		}else if(nome == $('#contatoNome'+idValue).val()){
			$('#contatoNome'+idValue).val("");
		}
	});

	$(document).on('click', '.diaS', function() {
		var idValue = this.id;
		var valor_id_semana = $("#"+idValue).attr("valor_id_semana");

		$("#"+idValue).removeClass();
		
		if(valor_id_semana == 1){
			$("#"+idValue).addClass('diaS inativo');
			$("#"+idValue).attr("valor_id_semana",0);
		}else{
			$("#"+idValue).addClass('diaS ativo');
			$("#"+idValue).attr("valor_id_semana",1);
		}
	});

	$(document).on('change', '#cargo_jornada', function(event) {
		
		var id_option = $('#'+this.id+' option:selected').attr("id");
		if(id_option != "cargo_jornada-0"){
			$("#dadosHorasSemanais").val($("#"+id_option).attr("h_semanal")); 

			$("#dadosHorasMensais").val($("#"+id_option).attr("h_mensal")); 
			$("#dadosHorasExtrasMaximas").val($("#"+id_option).attr("m_h_extra")); 

			alterSemanaDiaOnOff(this.id, $("#"+id_option).attr("domi"), "domingo");
			alterSemanaDiaOnOff(this.id, $("#"+id_option).attr("segu"), "segunda");
			alterSemanaDiaOnOff(this.id, $("#"+id_option).attr("terc"), "terca");
			alterSemanaDiaOnOff(this.id, $("#"+id_option).attr("quar"), "quarta");
			alterSemanaDiaOnOff(this.id, $("#"+id_option).attr("quin"), "quinta");
			alterSemanaDiaOnOff(this.id, $("#"+id_option).attr("sext"), "sexta");
			alterSemanaDiaOnOff(this.id, $("#"+id_option).attr("saba"), "sabado");

			$("#"+this.id).val(0).change();
		}
	});

	$(document).on('change', '#cargo_salario', function(event) {
		
		var id_option = $('#'+this.id+' option:selected').attr("id");
		if(id_option != "cargo_salario-0"){
			$("#dadosSalario").val($("#"+id_option).attr("salario_base")).trigger('change'); 

			$("#dadosVigenciaInicio").val(getDateNow()); 

			$("#"+this.id).val(0).change();
		}
	});

	function getDateNow(){
		const today = new Date();
		let yyyy = today.getFullYear();
		let mm = ("0" + (today.getMonth() + 1)).slice(-2); // Months start at 0!
		let dd = today.getDate();

		return dd+"/"+mm+"/"+yyyy;
	}

	$(document).on('change click focus onKeyPress', '#dadosSalario', function(event) {
		$(".money").mask("###.###.###.###.###,00", {
			reverse: true,
			translation: {
				".": "",
			"	,": ".",
			},
			onKeyPress: function (value, event) {
				// Ajusta o valor do campo de acordo com os limites definidos
				var input = $(event.currentTarget);
				var floatValue = parseFloat(value.replace(",", "."));
				var maxValue = 9999999.99;
				var minValue = 0.01;
				if (floatValue > maxValue || floatValue < minValue) {
					input.addClass("error"); // adiciona uma classe de erro para o estilo CSS
				} else {
					input.removeClass("error");
				}
			},
		});
	});

	function alterSemanaDiaOnOff(id_principal, semana_select, id_semana_object){

		if(semana_select==1){
			$("#"+id_semana_object).removeClass();
			$("#"+id_semana_object).addClass('diaS ativo');
			$("#"+id_semana_object).attr("valor_id_semana",1);
		}else{
			$("#"+id_semana_object).removeClass();
			$("#"+id_semana_object).addClass('diaS inativo');
			$("#"+id_semana_object).attr("valor_id_semana",0);
		}
	}

	$(document).on('change', '#eventos_select', function(event) {
		if( $('#eventos_select option:selected').val() == 1 ){
			document.getElementById("myModal").style.display = "block";
		}	
	});

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if (event.target == document.getElementById("myModal")) {
			document.getElementById("myModal").style.display = "none";
		}
	}
});

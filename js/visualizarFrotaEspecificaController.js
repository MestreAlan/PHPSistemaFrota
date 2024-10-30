$(function(){
	
	$('.voltar').click(function() {
		$.post("php/controllerRedirect.php", { page : "manipularFrota" }, function(){
			window.location.reload(true);
		});
	});
	
	$.post("php/controllerBuscarFilesFrota.php", { verificador : "docsPessoa" }, function(retorno){
		
		var valoresEncontrados = JSON.parse(retorno);
		
		var initialPreview = [];
		var initialPreviewConfig = [];
		for(var i=0 ; i<valoresEncontrados.length ; i++){
			var caption = valoresEncontrados[i][2].substring(0,valoresEncontrados[i][2].length-15) +''+ valoresEncontrados[i][2].substring(valoresEncontrados[i][2].length-4,valoresEncontrados[i][2].length);
			var key = valoresEncontrados[i][2];
			var type = valoresEncontrados[i][2].substring(valoresEncontrados[i][2].length-3,valoresEncontrados[i][2].length) == 'pdf' ? 'pdf' : 'image';
			var downloadUrl = valoresEncontrados[i][1];
			var description = valoresEncontrados[i][3];
			initialPreview.push(valoresEncontrados[i][1]);
			initialPreviewConfig.push({caption : caption, downloadUrl: downloadUrl, description : description, key : key, type: type});
		}
		
		$("#kv-explorer").fileinput({
			theme: 'explorer-fas',
			uploadUrl: "php/file-upload-frota.php",
			deleteUrl: "php/file-delete-frota.php",
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
			initialPreview: initialPreview,
			removeFromPreviewOnError: true,
			initialPreviewConfig: initialPreviewConfig,
			fileActionSettings: {
				showZoom: function(config) {
					config.caption = config.caption.toLowerCase();
				}
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
	
	$(document).on('click', '.btnSalvarDadosFrota', function() {
		modal();
		var idValue = this.id.substr(11, this.id.length);
		
		var placa = $('#dadosFrotaPlaca').val();
		var chassi = $('#dadosFrotaChassi').val();
		var renavan = $('#dadosFrotaRenavan').val();
		var modelo = $('#dadosFrotaModelo').val();
		var cor = $('#dadosFrotaCor').val();
		var veiculo = $('#dadosFrotaVeiculo').val();
		var fabricante = $('#dadosFrotaFabricante').val();
		var categoria = $('#dadosFrotaCategoria').val();
		var tipo = $('#dadosFrotaTipo').val();
		var combustivel = $('#dadosFrotaCombustivel').val();
		var ano = $('#dadosFrotaAno').val();
		var frota = $('#dadosFrotaFrota').val();
		var imei = $('#dadosFrotaImei').val();
		var empresa = $('.empresaNome option:selected').val();
		var funcao = $('.funcaoNome option:selected').val();
		var credencial = $('#dadosFrotaCredencial').val();
		var expedicao = $('#dadosFrotaExpedicao').val();
		var validade = $('#dadosFrotaValidade').val();
		
		var placaAtual = $('#dadosFrotaPlaca').attr("dados_frota_placa_original");
		var chassiAtual = $('#dadosFrotaChassi').attr("dados_frota_chassi_original");
		var renavanAtual = $('#dadosFrotaRenavan').attr("dados_frota_renavan_original");
		var modeloAtual = $('#dadosFrotaModelo').attr("dados_frota_modelo_original");
		var corAtual = $('#dadosFrotaCor').attr("dados_frota_cor_original");
		var veiculoAtual = $('#dadosFrotaVeiculo').attr("dados_frota_veiculo_original");
		var fabricanteAtual = $('#dadosFrotaFabricante').attr("dados_frota_fabricante_original");
		var categoriaAtual = $('#dadosFrotaCategoria').attr("dados_frota_categoria_original");
		var tipoAtual = $('#dadosFrotaTipo').attr("dados_frota_tipo_original");
		var combustivelAtual = $('#dadosFrotaCombustivel').attr("dados_frota_combustivel_original");
		var anoAtual = $('#dadosFrotaAno').attr("dados_frota_ano_original");
		var frotaAtual = $('#dadosFrotaFrota').attr("dados_frota_frota_original");
		var imeiAtual = $('#dadosFrotaImei').attr("dados_frota_imei_original");
		var empresaAtual = $(".empresaNome").attr("empresa_atual");
		var funcaoAtual = $(".funcaoNome").attr("funcao_atual");
		var credencialAtual = $("#dadosFrotaCredencial").attr("dados_frota_credencial_original");
		var expedicaoAtual = $("#dadosFrotaExpedicao").attr("dados_frota_expedicao_original");
		var validadeAtual = $("#dadosFrotaValidade").attr("dados_frota_validade_original");
		
		if( placa != placaAtual || chassi != chassiAtual || renavan != renavanAtual || modelo != modeloAtual || cor != corAtual || veiculo != veiculoAtual || fabricante != fabricanteAtual || categoria != categoriaAtual || tipo != tipoAtual || combustivel != combustivelAtual || ano != anoAtual || frota != frotaAtual || imei != imeiAtual || empresa != empresaAtual || funcao != funcaoAtual || credencial != credencialAtual || expedicao != expedicaoAtual || validade != validadeAtual ){ 
			if(placa == "" || renavan == "" || empresa == ""){
				alert("Parece que alguns campos obrigatório (*) estão vazios");
				modalOut();			
			}else if( $('#dadosFrotaPlaca')[0].checkValidity() == false || ($('#dadosFrotaChassi')[0].checkValidity() == false && chassi != "") || $('#dadosFrotaRenavan')[0].checkValidity() == false || ($('#dadosFrotaModelo')[0].checkValidity() == false && modelo != "") || ($('#dadosFrotaCor')[0].checkValidity() == false && cor != "") || ($('#dadosFrotaVeiculo')[0].checkValidity() == false && veiculo != "") || ($('#dadosFrotaFabricante')[0].checkValidity() == false && fabricante != "") || ($('#dadosFrotaCategoria')[0].checkValidity() == false && categoria != "") || ($('#dadosFrotaTipo')[0].checkValidity() == false && tipo != "") || ($('#dadosFrotaCombustivel')[0].checkValidity() == false && combustivel != "") || ($('#dadosFrotaAno')[0].checkValidity() == false && ano != "") || ($('#dadosFrotaFrota')[0].checkValidity() == false && frota != "") || ($('#dadosFrotaImei')[0].checkValidity() == false && imei != "" || $('#dadosFrotaCredencial')[0].checkValidity() == false || $('#dadosFrotaExpedicao')[0].checkValidity() == false || $('#dadosFrotaValidade')[0].checkValidity() == false) ){
				alert("Alguns dados não estão corretos. Revise os dados com campos em vermelho");
				modalOut();			
			}else{	
				$.post("php/controllerEdicaoFrotaEspecifica.php", { direcionador : "validarPlaca", idValue : idValue, placa : placa, chassi : chassi, renavan : renavan, modelo : modelo, cor : cor, veiculo : veiculo, fabricante : fabricante, categoria : categoria, tipo : tipo, combustivel : combustivel, ano : ano, frota : frota, imei : imei, empresa : empresa, funcao : funcao, credencial : credencial, expedicao : expedicao, validade : validade }, function(resposta){
					
					var valoresEncontrados = JSON.parse(resposta);
					
					if(valoresEncontrados[0] == 1){
						alert("Placa já cadastrada");
					}else{
						$('#dadosFrotaPlaca').attr("dados_frota_placa_original", placa);
						$('#dadosFrotaChassi').attr("dados_frota_chassi_original", chassi);
						$('#dadosFrotaRenavan').attr("dados_frota_renavan_original", renavan);
						$('#dadosFrotaModelo').attr("dados_frota_modelo_original", modelo);
						$('#dadosFrotaCor').attr("dados_frota_cor_original", cor);
						$('#dadosFrotaVeiculo').attr("dados_frota_veiculo_original", veiculo);
						$('#dadosFrotaFabricante').attr("dados_frota_fabricante_original", fabricante);
						$('#dadosFrotaCategoria').attr("dados_frota_categoria_original", categoria);
						$('#dadosFrotaTipo').attr("dados_frota_tipo_original", tipo);
						$('#dadosFrotaCombustivel').attr("dados_frota_combustivel_original", combustivel);
						$('#dadosFrotaAno').attr("dados_frota_ano_original", ano);
						$('#dadosFrotaFrota').attr("dados_frota_frota_original", frota);
						$('#dadosFrotaImei').attr("dados_frota_imei_original", imei);
						$(".empresaNome").attr("empresa_atual", empresa);
						$(".funcaoNome").attr("funcao_atual", funcao);
						$("#dadosFrotaCredencial").attr("dados_frota_credencial_original", credencial);
						$("#dadosFrotaExpedicao").attr("dados_frota_expedicao_original", expedicao);
						$("#dadosFrotaValidade").attr("dados_frota_validade_original", validade);
			
						
						if(valoresEncontrados[0] == 3){
							$('.btnSalvarDadosFrota').attr("dadosFrota-"+idValue , "dadosFrota-"+valoresEncontrados[1]);
						}else{
							window.location.reload(true);
						}
					}
					modalOut();
				});	
					
			}
		}else{
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
							'<div class="container">'+
								'<div class="row">'+
									'<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">'+
										'<label>Telefone(*): &nbsp; </label>'+
										'<i id="faPhone0" class="fa fa-phone" style="font-size:24px"></i> &nbsp; '+
										'<i id="faMobile0" class="fa fa-mobile" style="font-size:34px"></i>'+
										'<input class="telefone mobile" id="contatosTelefone0" required pattern="\\([0-9]{2}\\)\\s[0-9]{4}-[0-9]{4}|\\([0-9]{2}\\)\\s[0-9]{1}\\s[0-9]{4}-[0-9]{4}" style="text-align:center;" type="text" value="">'+
									
										'<label>O número a cima é Whatsapp?: &nbsp; </label>'+
										'<input class="form-check-input" type="radio" name="radioTelefone0" value="1">'+
										'<label class="form-check-label">'+
												'Sim'+
										'</label>'+
										'<input class="form-check-input" type="radio" name="radioTelefone0" value="0" checked>'+
										'<label class="form-check-label">'+
											'Não'+
										'</label>'+
									'</div>'+
								'</div>'+	
								'<div class="row">'+
									'<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">'+
										'<label>Relação (*):  </label>'+
										'<select id="tipoContato0" class="tipoContato" name="contato"><option value="" disabled selected="">Selecione uma opção</option><option value="1">Próprio</option><option value="2">Esposo(a)</option><option value="3">Pais/Mãe</option><option value="4">Irmão/Irmão</option><option value="5">Tio(a)</option><option value="6">Avô(ó)</option><option value="7">Filho(a)</option><option value="8">Vizinho(a)</option><option value="9">Amigo(a)</option><option value="10">Outros</option></select>'+
									'</div>'+
									'<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 col-xl-9">'+
										'<label>Nome do contato (*):  </label>'+						
										'<input class="texto nomeContato" id="contatoNome0" required pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]{1,1}[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\\s\\-]{2,79}" style="text-align:center;" type="text" value="">'+
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
	
	$('.placa').mask('XXX-XXXX', {
		translation: {
			X: {
				pattern: /[A-Za-z0-9]/
			}
		}
	});
	
	$('.chassi').mask('XXXXXXXXXXXXXXXXX', {
		translation: {
			X: {
				pattern: /[A-Za-z0-9]/
			}
		}
	});
	
	$('.renavan').mask('XXXXXXXXXX-X', {
		translation: {
			X: {
				pattern: /[A-Za-z0-9]/
			}
		}
	});
	
	$('.modelo, .ano').mask('0000');
	
	$('.cor').mask('AAAXXXXXXXXXXXXXXXXX', {
		translation: {
			X: {
				pattern: /[A-Za-z0-9\s]/
			},
			A: {
				pattern: /[A-Za-z]/
			}
		}
	});
	
	$('.veiculo, .fabricante, .categoria').mask('AXXXXXXXXXXXXXXXXXXX', {
		translation: {
			X: {
				pattern: /[A-Za-z0-9\s\.]/
			},
			A: {
				pattern: /[A-Za-z0-9]/
			}
		}
	});
	
	$('.tipo').mask('AXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX', {
		translation: {
			X: {
				pattern: /[A-Za-z0-9\s\.]/
			},
			A: {
				pattern: /[A-Za-z0-9]/
			}
		}
	});
	
	$('.combustivel').mask('AXXXXXXXXXXXXXXXXXXX', {
		translation: {
			X: {
				pattern: /[A-Za-z0-9\s\.\\\/\-]/
			},
			A: {
				pattern: /[A-Za-z0-9]/
			}
		}
	});
	
	$('.frota').mask('FT-XXX', {
		translation: {
			X: {
				pattern: /[0-9]/
			},
			A: {
				pattern: /[A-Za-z]/
			}
		}
	});
	
	$('.credencial').mask('00000.000000/0000-00');
	
	$('.data').mask('00/00/0000');
	
});

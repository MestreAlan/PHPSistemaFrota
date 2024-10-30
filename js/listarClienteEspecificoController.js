$(function(){
	
	$('.voltar').click(function() {
		$.post("php/controllerRedirect.php", { page : "listarClientesGeral" }, function(){
			//var url = "http://localhost/eradar/";
			//$(location).attr('href',url);
			window.location.reload(true);
		});
	});
	
	$.post("php/controllerBuscarFilesClientes.php", { verificador : "docsPessoa" }, function(retorno){
		
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
			uploadUrl: "php/file-upload-cliente.php",
			deleteUrl: "php/file-delete-cliente.php",
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
	
	$(document).on('click', '.btnSalvarDadosGerais', function() {
		modal();
		var idValue = this.id.substr(12, this.id.length);
		
		var razao_social = $('#razao_social').val();
		var fantasia = $('#fantasia').val();
		var cnpj = $('#cnpj').val();
		var inscricao_municipal = $('#inscricao_municipal').val();
		
		var vermud = 0;
		
		if( razao_social != $('#razao_social').attr('razao_social_original') || fantasia != $('#fantasia').attr('fantasia_original') || cnpj != $('#cnpj').attr('cnpj_original') || inscricao_municipal != $('#inscricao_municipal').attr('inscricao_municipal_original') ){ 
			vermud=1; 
		}
		
		if(vermud==1){
			
			if(razao_social == "" || fantasia == "" || cnpj == "" || inscricao_municipal == ""){
				alert("Dados gerais: Parece que alguns campos obrigatório (*) estão vazios");
				modalOut();			
			}else if($("#razao_social")[0].checkValidity() == false || $('#fantasia')[0].checkValidity() == false || $("#cnpj")[0].checkValidity() == false || $("#inscricao_municipal")[0].checkValidity() == false){
				alert("Dados gerais: Alguns dados não estão corretos. Revise os dados com campos em vermelho");
				modalOut();			
			}else{		
				if(idValue != 0){
					
					$.post("php/controllerEdicaoClienteEspecifico.php", { direcionador : "editarDadosGerais", idValue: idValue, razao_social: razao_social, fantasia: fantasia, cnpj: cnpj, inscricao_municipal: inscricao_municipal }, function(){
						//alert("Edição realizada com sucesso!");
						
						$('#razao_social').attr('razao_social_original', razao_social);
						$('#fantasia').attr('fantasia_original', fantasia);
						$('#cnpj').attr('cnpj_original', cnpj);
						$('#inscricao_municipal').attr('inscricao_municipal_original', inscricao_municipal);
						
						var id = $(".btnSalvarDadosGerais").attr("id");
						$("#"+id).removeClass();
						$("#"+id).addClass('btn btn-primary btnSalvarDadosGerais');
						$('#labelDadosGerais').text("");
						
						modalOut();
					});
				}else{
					modal();
					$.post("php/controllerEdicaoClienteEspecifico.php", { direcionador : "criarDadosGerais", razao_social: razao_social, fantasia: fantasia, cnpj: cnpj, inscricao_municipal: inscricao_municipal }, function(){
						//alert("Colaborador cadastrado com sucesso!");
						document.location.reload(true);
					});
				}
			}
		}else{
			//alert("Parece que nenhum dado foi alterado!");
			
			$("#contatosTelefone"+idValue).removeClass();
			$("#contatosTelefone"+idValue).addClass('btn btn-primary btnSalvarDadosGerais');
			$('#labelDadosGerais').text("");
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
					$.post("php/controllerEdicaoClienteEspecifico.php", { direcionador : "editarEndereco", id: id, enderecoCEP : enderecoCEP, enderecoCasa : enderecoCasa, enderecoBairro : enderecoBairro, estado : estado, enderecoCidade : enderecoCidade, enderecoComplemento : enderecoComplemento, enderecoReferencia : enderecoReferencia, enderecoLogradouro : enderecoLogradouro }, function(){
						
						$("#enderecoCEP").attr('endereco_CEP_original', enderecoCEP);
						$("#enderecoLogradouro").attr('endereco_logradouro_original', enderecoLogradouro);
						$("#enderecoCasa").attr('endereco_casa_original', enderecoCasa);
						$("#enderecoComplemento").attr('endereco_complemento_original', enderecoComplemento);
						$("#enderecoBairro").attr('endereco_bairro_original', enderecoBairro);
						$("#enderecoCidade").attr('endereco_cidade_original', enderecoCidade);
						$("#estadosBrasil1").attr('estados_original', estado);
						$("#enderecoReferencia").attr('endereco_referencia_original', enderecoReferencia);
						
						//alert("Edição realizada com sucesso!");
						
						var id = $(".enderecos").attr("id");
						$("#"+id).removeClass();
						$("#"+id).addClass('enderecos btn btn-primary salvar');
						$('#labelEndereco').text("");
						
						modalOut();
					});
				}else{
					$.post("php/controllerEdicaoClienteEspecifico.php", { direcionador : "criarEndereco", enderecoCEP : enderecoCEP, enderecoCasa : enderecoCasa, enderecoBairro : enderecoBairro, estado : estado, enderecoCidade : enderecoCidade, enderecoComplemento : enderecoComplemento, enderecoReferencia : enderecoReferencia, enderecoLogradouro : enderecoLogradouro }, function(retorno){
						
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
						
						var id = $(".enderecos").attr("id");
						$("#"+id).removeClass();
						$("#"+id).addClass('enderecos btn btn-primary salvar');
						$('#labelEndereco').text("");
						
						modalOut();
					});
				}
			}
		}else{
			//alert("Parece que nenhum dado foi alterado!");
			var id = $(".enderecos").attr("id");
			$("#"+id).removeClass();
			$("#"+id).addClass('enderecos btn btn-primary salvar');
			$('#labelEndereco').text("");
			modalOut();
		}
	});
	
	$(document).on('click', '.btnSalvar', function() {
		
		modal();
		
		var idValue = this.id.substr(13, this.id.length);
		var contatosTelefone = $("#contatosTelefone"+idValue).val();
		var telefoneWhatsapp = $("input[name='radioTelefone"+idValue+"']:checked").val();
		
		var email = $("#contatoEmail").val();
		
		var email_original = $("#contatoEmail").attr("email_original");
		var telefone_original = $("#contatosTelefone"+idValue).attr("telofone_original");
		var wahtsapp_original = $("#whatsapp").attr("whatsapp_original");
		
		if(contatosTelefone != telefone_original || telefoneWhatsapp != wahtsapp_original || email != email_original){
			if(contatosTelefone == "" || email == ""){
				alert("Contato: Campo com * vazio!");
				modalOut();
			}else if($("#contatosTelefone"+idValue)[0].checkValidity() == false || $("#contatoEmail")[0].checkValidity() == false){
				alert("Contato: Formato inválido! Ajustes os dados com campos em vermelho.");
				modalOut();
			}else if(idValue!=0){
				
				$.post("php/controllerEdicaoClienteEspecifico.php", { direcionador : "editarContato", idValue : idValue, contatosTelefone : contatosTelefone, telefoneWhatsapp : telefoneWhatsapp, email : email }, function(){
					//alert("Edição realizada com sucesso!");
					$("#contatoEmail").attr("email_original", email);
					$("#contatosTelefone"+idValue).attr("telofone_original", contatosTelefone);
					$("#whatsapp").attr("whatsapp_original", telefoneWhatsapp);
					
					
					var id = $(".btncontato").attr("id");
					$("#"+id).removeClass();
					$("#"+id).addClass('btn btn-primary btnSalvar btncontato');
					$('#labelContato').text("");
					modalOut();
				});
			}else{
				$.post("php/controllerEdicaoClienteEspecifico.php", { direcionador : "criarContato", contatosTelefone : contatosTelefone, telefoneWhatsapp : telefoneWhatsapp, email : email }, function(retornoId){
					//alert("Adição realizada com sucesso!");
					$("#salvarContato0").attr("id", "salvarContato"+retornoId);
					$("#contatosTelefone0").attr("id", "contatosTelefone"+retornoId);
					
					$(".form-check-input").attr("name", "radioTelefone"+retornoId);
					
					$("#faPhone0").attr("id", "faPhone"+retornoId);
					$("#faMobile0").attr("id", "faMobile"+retornoId);
					
					$("#contatoEmail").attr("email_original", email);
					$("#contatosTelefone"+idValue).attr("telofone_original", contatosTelefone);
					$("#whatsapp").attr("whatsapp_original", telefoneWhatsapp);
					
					var id = $(".btncontato").attr("id");
					$("#"+id).removeClass();
					$("#"+id).addClass('btn btn-primary btnSalvar btncontato');
					$('#labelContato').text("");
					modalOut();
				});
			}
		}else{
			//alert("Parece que nehum dado foi alterado!");
			
			var id = $(".btncontato").attr("id");
			$("#"+id).removeClass();
			$("#"+id).addClass('btn btn-primary btnSalvar btncontato');
			$('#labelContato').text("");
			modalOut();
		}
	});
	
	//////////////////
	
	$(document).on('change', '.tbodyDadosGerais', function() {
		if($('#razao_social').val() == $('#razao_social').attr('razao_social_original') && $('#fantasia').val() == $('#fantasia').attr('fantasia_original') && $('#cnpj').val() == $('#cnpj').attr('cnpj_original') && $('#inscricao_municipal').val() == $('#inscricao_municipal').attr('inscricao_municipal_original')){
			var id = $(".btnSalvarDadosGerais").attr("id");
			$("#"+id).removeClass();
			$("#"+id).addClass('btn btn-primary btnSalvarDadosGerais verde');
			$('#labelDadosGerais').text("");
		}else{
			var id = $(".btnSalvarDadosGerais").attr("id");
			$("#"+id).removeClass();
			$("#"+id).addClass('btn btn-primary btnSalvarDadosGerais vermelho');
			$('#labelDadosGerais').text("Não salvo");
		}
	});	
	
	$(document).on('change', '.tbodyEndereco', function() {
		if($('#enderecoCEP').val() == $("#enderecoCEP").attr('endereco_CEP_original') && $('#enderecoCasa').val()== $("#enderecoCasa").attr('endereco_casa_original') && $('#enderecoBairro').val() == $("#enderecoBairro").attr('endereco_bairro_original') && $('#estadosBrasil1 option:selected').attr('verificador') == $("#estadosBrasil1").attr('estados_original') && $('#enderecoCidade').val() == $("#enderecoCidade").attr('endereco_cidade_original') && $('#enderecoComplemento').val() == $("#enderecoComplemento").attr('endereco_complemento_original') && $('#enderecoReferencia').val() == $("#enderecoReferencia").attr('endereco_referencia_original') && $('#enderecoLogradouro').val() == $("#enderecoLogradouro").attr('endereco_logradouro_original')){
			var id = $(".enderecos").attr("id");
			$("#"+id).removeClass();
			$("#"+id).addClass('enderecos btn btn-primary salvar verde');
			$('#labelEndereco').text("");
		}else{
			var id = $(".enderecos").attr("id");
			$("#"+id).removeClass();
			$("#"+id).addClass('enderecos btn btn-primary salvar vermelho');
			$('#labelEndereco').text("Não salvo");
		}
	});	
	
	$(document).on('change', '.telefoneRow', function() {
		var idValue = this.id.substr(8, this.id.length);		
		if($("#contatoEmail").val() == $("#contatoEmail").attr("email_original") && $("#contatosTelefone"+idValue).val() == $("#contatosTelefone"+idValue).attr("telofone_original") && $("input[name='radioTelefone"+idValue+"']:checked").val() == $("#whatsapp").attr("whatsapp_original")){
			var id = $(".btncontato").attr("id");
			$("#"+id).removeClass();
			$("#"+id).addClass('btn btn-primary btnSalvar btncontato verde');
			$('#labelContato').text("");
		}else{
			var id = $(".btncontato").attr("id");
			$("#"+id).removeClass();
			$("#"+id).addClass('btn btn-primary btnSalvar btncontato vermelho');
			$('#labelContato').text("Não salvo");
		}		
	});
	/////////////////
	
	$(document).on('click', '.btnSalvarTudo', function() {
		$('.btnSalvarDadosGerais').click();
		$('.salvar').click();
		$('.btncontato').click();
	});
	
	if($(".btnSalvarDadosGerais").attr('id_conctrole')==0){
		$('#complementoCorpo').fadeOut(1);
	}
	
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
	
	$(".fixo").mask("(00) 0000-0000");
	$(".mobile").mask("(00) 0 0000-0000");
	
	$(document).on('click focus onKeyPress', '.telefone', function() {
		$(".mobile").mask("(00) 0 0000-0000");
		$(".fixo").mask("(00) 0000-0000");
	});
	
	$(document).on('click focus onKeyPress', '.telefone', function() {
		var idValue = this.id.substr(16, this.id.length);
		var contatosTelefone = $("#contatosTelefone"+idValue).val();
		$("#contatosTelefone"+idValue).removeClass();
		$("#contatosTelefone"+idValue).addClass('telefone');	
		if(contatosTelefone.length > 14){
			$("#contatosTelefone"+idValue).addClass('mobile');	
			$(".mobile").mask("(00) 0 0000-0000");
		}else{
			$("#contatosTelefone"+idValue).addClass('fixo');	
			$(".fixo").mask("(00) 0000-0000");
		}
	});
	
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
	
	$('.inscricao_municipal').mask('00000000000');
	
	$('.cnpj').mask('00.000.000/0000-00');
	
	$(document).on('click focus onKeyPress', '.cnpj', function() {
		$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
	});
	
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
	
	$('.nomeTexto').mask('AZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZ', {
		translation: {
			Z: {
				pattern: /[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s\-\/]/
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
	
	$('.cep').mask('00000-0000');
	
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
	
	$('.numeroComplemento').mask('AZZZZZZZZZZZZZZZZZZZZZZZZZZZZZ', {
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
	
});

$(function(){
	$(document).on('click', '.btn-salvar', function() {
		modal();
		var idValue = this.id.substr(7, this.id.length);
		var contrato = $('#checked-'+idValue).prop('checked') == true ? 1 : 0;
		var apelido = $('#apelido-'+idValue).val();
		var valor = $('#valor-'+idValue).val();
		var km = $('#km-'+idValue).val();
		var transitime = $('#transitime-'+idValue).val();
		var origem = $('#input_locais-o-'+idValue+' option:selected').val();
		var destino = $('#input_locais-d-'+idValue+' option:selected').val();
		var cliente = $('#input_cliente-'+idValue+' option:selected').val();
		
		
		$.post("php/controllerPrecificarRota.php", { diferenciador : "validar", contrato : contrato, origem : origem, destino : destino, cliente : cliente }, function(resposta){ 
			if(resposta == 0){
				if(idValue == 0){
							$.post("php/controllerPrecificarRota.php", { diferenciador : "criar", contrato : contrato, apelido : apelido, valor: valor, km : km, transitime : transitime, origem : origem, destino : destino, cliente : cliente }, function(resposta){ 
								modalOut();
								document.location.reload(true);
							});
				}else{
					$.post("php/controllerPrecificarRota.php", { diferenciador : "editar", contrato : contrato, idValue : idValue, apelido : apelido, valor : valor, km : km, transitime : transitime, origem : origem, destino : destino, cliente : cliente }, function(resposta){ 
						modalOut();
						//document.location.reload(true);
					});
				}
			}else{
				alert("Os dados inseridos já estão presentes em outra precificação. Ação cancelada!");
				document.location.reload(true);
				modalOut();
			}
		});
	});
	
	$('.money').mask('#.##0,00', {reverse: true});
	
	$(document).on('click', '.btn-excluir', function() {
		modal();
		var idValue = this.id.substr(8, this.id.length);
		
		$.post("php/controllerPrecificarRota.php", { diferenciador : "excluir", idValue : idValue }, function(resposta){
			modalOut();
			$("#"+idValue).remove();
			//document.location.reload(true);
		});
	});
});

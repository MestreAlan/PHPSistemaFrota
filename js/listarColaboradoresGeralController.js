$(function(){
	$(document).on('click', '.acessarPessoa', function() {
		
		var idValue = this.id;

		$.post("php/controllerColaboradoresGeral.php", { idDadosPessoais : idValue }, function(){
			$.post("php/controllerRedirect.php", { page : "visualizadorColaboradorEspecifico" }, function(){
				window.location.reload(true);
			});
		});
	});	
	
	$('.date').mask('00/00/0000');
	
	/*=============================================================
				Filtro
  =============================================================*/
	var matricula = [];
	$("#monitorarFrotaTable .matricula").each(function(){
		var valor = this.innerHTML;
		
		if (!(matricula.includes(valor))) {
			var linha = '<li><input class="liDropMenu" name="locationthemes" value="'+valor+'" checked type="checkbox" />&nbsp;'+valor+'</li>';
		
			$("#filtro-matricula .form-check").append(linha);
			matricula.push(valor);
		}
	});
	
	var nome = [];
	$("#monitorarFrotaTable .nome").each(function(){
		var valor = this.innerHTML;
		
		if (!(nome.includes(valor))) {
			var linha = '<li><input class="liDropMenu" name="locationthemes" value="'+valor+'" checked type="checkbox" />&nbsp;'+valor+'</li>';
		
			$("#filtro-nome .form-check").append(linha);
			nome.push(valor);
		}
		
		
	});
	
	var empresa = [];
	$("#monitorarFrotaTable .empresa").each(function(){
		var valor = this.innerHTML;
		
		if (!(empresa.includes(valor))) {
			var linha = '<li><input class="liDropMenu" name="locationthemes" value="'+valor+'" checked type="checkbox" />&nbsp;'+valor+'</li>';
		
			$("#filtro-empresa .form-check").append(linha);

			empresa.push(valor);
		}
	});
	
	var admissao = [];
	$("#monitorarFrotaTable .date").each(function(){
		var valor = this.innerHTML;
		
		if (!(admissao.includes(valor))) {
			var linha = '<li><input class="liDropMenu" name="locationthemes" value="'+valor+'" checked type="checkbox" />&nbsp;'+valor+'</li>';
		
			$("#filtro-data_admicao .form-check").append(linha);
			
			admissao.push(valor);
		}
	});
	
	var cargo = [];
	$("#monitorarFrotaTable .cargo").each(function(){
		var valor = this.innerHTML;
		
		if (!(cargo.includes(valor))) {
			var linha = '<li><input class="liDropMenu" name="locationthemes" value="'+valor+'" checked type="checkbox" />&nbsp;'+valor+'</li>';
		
			$("#filtro-cargo .form-check").append(linha);
			
			cargo.push(valor);
		}
	});
	
	var contrato = [];
	$("#monitorarFrotaTable .Contrato").each(function(){
		var valor = this.innerHTML;
		
		if (!(contrato.includes(valor))) {
			var linha = '<li><input class="liDropMenu" name="locationthemes" value="'+valor+'" checked type="checkbox" />&nbsp;'+valor+'</li>';
		
			$("#filtro-estado_contrato .form-check").append(linha);
			
			contrato.push(valor);
		}
	});
/*=============================================================
				Final
  =============================================================*/	
	
});
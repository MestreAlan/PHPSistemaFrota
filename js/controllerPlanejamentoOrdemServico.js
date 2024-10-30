$(function(){	
	
	$(document).on('change', '.date', function() {
		var data = $(this).val();
		var idValue = this.id;		
		var d = new Date();
		var dataCompleta = d.toISOString().substring(0, 10);
		var ano = dataCompleta.substring(0, 4);
		var mes = dataCompleta.substring(6, 7);
		var dia = dataCompleta.substring(9, 10);
		
		
		if(data.length==1){
			mes = ajustarDataMesAno(mes);
			$("#"+idValue).val("0"+data+"/"+mes+"/"+ano);
		}else if(data.length==2){
			mes = ajustarDataMesAno(mes);
			$("#"+idValue).val(data+"/"+mes+"/"+ano);
		}else if(data.length==3){
			mes = ajustarDataMesAno(mes);
			$("#"+idValue).val(data+""+mes+"/"+ano);
		}else if(data.length==4){
			$("#"+idValue).val(data.substring(0, 3)+"0"+data.substring(3, 4)+"/"+ano);
		}else if(data.length==5){
			$("#"+idValue).val(data+"/"+ano);
		}else if(data.length==6){
			$("#"+idValue).val(data+""+ano);
		}else if(data.length==7){
			$("#"+idValue).val(data.substring(0, 6)+""+ano.substring(0, 3)+""+data.substring(6, 7));
		}else if(data.length==8){
			$("#"+idValue).val(data.substring(0, 6)+""+ano.substring(0, 2)+""+data.substring(6, 8));
		}else if(data.length==9){
			$("#"+idValue).val(data.substring(0, 6)+""+ano.substring(0, 1)+""+data.substring(6, 9));
		}else if(data.length==10){
			$("#"+idValue).val(data.substring(0, 6)+""+data.substring(6, 10));
		}
	});
	
	function ajustarDataMesAno(valor){
		if(valor.length == 1){
			valor = "0"+valor;
		}
		return valor;
	}
	
	$("#monitorarFrotaTable .input_os_num").each(function(){
		var valor = this.value;
		
		var linha = '<li><input class="liDropMenu" name="locationthemes" value="'+valor+'" type="checkbox" />&nbsp;'+valor+'</a></li>';
		
		$("#filtro-os_num .form-check").append(linha);
	});

	$("#monitorarFrotaTable .input_placa").each(function(){
		var valor = this.value;
		
		var linha = '<li><input class="liDropMenu" name="locationthemes" value="'+valor+'" type="checkbox" />&nbsp;'+valor+'</a></li>';
		
		$("#filtro-placa .form-check").append(linha);
	});
	
	$('.voltar').click(function() {
		$.post("php/controllerRedirect.php", { page : "listarOrdensServicos" }, function(){
			//var url = "http://localhost/eradar/";
			//$(location).attr('href',url);
			window.location.reload(true);
		});
	});
	
	$('.excluirOS').click(function() {
		
		modal();
		
		var idValue = this.id.substr(10, this.id.length);
		var os_num = $('#input_os_num-'+idValue).val(); 
		
		alert("Botão desativado");
		
		//Excluir
		/*$.post("php/controllerValidarOrdemServico.php", { direcionador : "excluirOS", os_num : os_num }, function(e){
			document.location.reload(true);
		});*/
	});
	
	$(document).on('click', '.criarOS', function() {
		
		modal();
		
		$('.monitorarFrota > tbody  > tr').each(function(index, tr) { 
			var idValue = this.id;
			
			var contrato = $('#checkedValue').prop('checked') == true ? 1 : 0;
			var os_num = $('#input_os_num-'+idValue).val(); 
			var empresa = $('#input_empresa-'+idValue+' option:selected').val();
			var frota = $('#input_frota-'+idValue+' option:selected').val();
			var batedor = $('#input_batedor-'+idValue+' option:selected').val();
			var cliente = $('#input_cliente-'+idValue+' option:selected').val();
			var carga = $('#input_carga-'+idValue+' option:selected').val(); 
			var execucao = $('#input_execucao-'+idValue+' option:selected').val();
			var conjunto = $('#input_conjunto-'+idValue).val(); 
			var motorista_conjunto = $('#input_motorista_conjunto-'+idValue).val(); 
			var origem = $('#input_local-o-'+idValue+' option:selected').val();
			var origem_d_c = $('#input_dorigem_d_c-'+idValue).val(); 
			var origem_d_s = $('#input_dorigem_d_s-'+idValue).val(); 
			var origem_km = $('#input_km_origem-'+idValue).val(); 
			var destino = $('#input_local-d-'+idValue+' option:selected').val();
			var destino_d_c = $('#input_destino_d_c-'+idValue).val(); 
			var destino_d_s = $('#input_destino_d_s-'+idValue).val(); 
			var destino_km = $('#input_km_destino-'+idValue).val(); 
			var diaria = $('#input_diarias_percurso-'+idValue).val(); 
			var cte = $('#input_cte-'+idValue).val(); 
			var nf = $('#input_nf-'+idValue).val(); 
			var aet = $('#input_aet-'+idValue).val(); 
			
			var verificadorErros = 1;
			
			if(cliente != "" || carga != "" || conjunto != "" || motorista_conjunto != ""){
				if(cliente == "" || carga == "" || conjunto == "" || motorista_conjunto == ""){
					alert("Parece que você está tentando cadastrar uma OS de prestação de serviço mas alguns dados não foram preenchidos. Cliente, Conjunto, Carga e Motorista do conjunto");
					
				}else{
					verificadorErros = 0;
				}
			}
			
			if(empresa != "" || frota != "" || batedor != "" || execucao != "" || origem != "" || destino != ""){
				verificadorErros = 0;
				if(empresa == "" || frota == "" || batedor == "" || execucao == "" || origem == "" || destino == ""){
					alert("Parece que você está tentando cadastrar uma OS mas alguns dados não foram preenchidos. Empresa, Frota, Batedor, Execução, Origem e Destino");
					verificadorErros = 1;
				}
			}
			
			if(verificadorErros == 0){
			
				var validadorOS = 0;
				
				$.post("php/controllerValidarOrdemServico.php", { direcionador : "validador", os_num : os_num }, function(resposta){
					validadorOS = resposta == 0 ? 0 : 1;	
					if(validadorOS == 0){
						//Criar
						$.post("php/controllerValidarOrdemServico.php", { direcionador : "criarOS", contrato: contrato, os_num : os_num, empresa : empresa, frota : frota, batedor : batedor, cliente : cliente, carga : carga, execucao : execucao, conjunto : conjunto,	motorista_conjunto : motorista_conjunto, origem : origem, origem_d_c : origem_d_c, origem_d_s : origem_d_s, origem_km : origem_km, destino : destino, destino_d_c : destino_d_c, destino_d_s : destino_d_s, destino_km : destino_km, diaria : diaria, cte : cte, nf : nf, aet : aet }, function(e){
							document.location.reload(true);
						});
					}
					modalOut();
				});
			}else{
				modalOut();
			}
		});
	});
	$(document).on('change', '.input_frota', function() {
		var idValue = this.id.substr(12, this.id.length);
		$("#input_placa-"+idValue).val($('option:selected', this).attr('placa'));
	});

	$(document).on('blur', '.input_km_origem, .input_km_destino', function() {
		var idValue;
		if($(this).attr('class') == "input_km_destino"){
			idValue = this.id.substr(17, this.id.length);
		}else{
			idValue = this.id.substr(16, this.id.length);
		}
		if($("#input_km_destino-"+idValue).val() != "" && $("#input_km_origem-"+idValue).val() != ""){
			var soma = parseInt($("#input_km_origem-"+idValue).val()) + parseInt($("#input_km_destino-"+idValue).val());
			$("#input_km_total-"+idValue).val(soma);
		}
		
	});
	
	$('.date').mask('00/00/0000');

	const container = document.getElementById('visualTable');

const triggerBtn = document.querySelector('#expander');
const sliceElem = container.parentElement;

	const data = [];
	const dataOriginal = [];
	const empresa = [];
	const frota = [];
	const placa = [];
	const motorista = [];
	const cliente = [];
	const carga = [];
	const execucao = [];
	const local = [];
	//var hot;
	
	
		/*
		0 os.num_os,
		1 em.nome,
		2 ve.frota
		3 ve.placa
		4 dp.nome
		5 cl.nome
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
		21 ps.nf
		22 ps.aet
		23 lp.km
		24 lp.valor
		25 lp.transit_time
		*/
		
		
	$.ajax({
		url: 'php/controllerChamarOS.php',
		type: 'POST',
		async:false,
		data: jQuery.param({ verificador : "buscarOS" }) ,
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		success: function (response) {
			
			var nome = JSON.parse(response);
			for(var i=0; i<nome.length; i++){
				nome[i][17] = $.isNumeric(nome[i][17]) ? nome[i][17] : 0;
				nome[i][13] = $.isNumeric(nome[i][13]) ? nome[i][13] : 0;
				var km_final = parseInt(nome[i][17]) - parseInt(nome[i][13]);
				km_final = km_final<0 ? 0 : km_final;
				
				nome[i][11] = nome[i][11] == '0000-00-00' ? null : nome[i][11];
				nome[i][12] = nome[i][12] == '0000-00-00' ? null : nome[i][12];
				nome[i][15] = nome[i][15] == '0000-00-00' ? null : nome[i][15];
				nome[i][16] = nome[i][16] == '0000-00-00' ? null : nome[i][16];

				data.push(
					[
						nome[i][22], nome[i][0], nome[i][1], nome[i][2], nome[i][3], nome[i][4], nome[i][5], nome[i][6], nome[i][7], nome[i][8], nome[i][9], nome[i][10], nome[i][11], nome[i][12], nome[i][13], nome[i][14], nome[i][15], nome[i][16], nome[i][17], nome[i][18], km_final, nome[i][19], nome[i][20], nome[i][21]
					]
				);
				dataOriginal.push(
					[
						nome[i][22], nome[i][0], nome[i][1], nome[i][2], nome[i][3], nome[i][4], nome[i][5], nome[i][6], nome[i][7], nome[i][8], nome[i][9], nome[i][10], nome[i][11], nome[i][12], nome[i][13], nome[i][14], nome[i][15], nome[i][16], nome[i][17], nome[i][18], km_final, nome[i][19], nome[i][20], nome[i][21]
					]
				);
			}
		},
		error: function () {
			alert("error");
		}
	}); 
	
	dataOriginal.push(data);
	
	$.ajax({
		url: 'php/controllerChamarOS.php',
		type: 'POST',
		async:false,
		data: jQuery.param({ verificador : "empresa" }) ,
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		success: function (response) {
			
			var nome = JSON.parse(response);
			
			for(var i=0; i<nome.length; i++){
				empresa.push(
					nome[i][2]
				);
			}
		},
		error: function () {
			alert("error");
		}
	}); 
	
	$.ajax({
		url: 'php/controllerChamarOS.php',
		type: 'POST',
		async:false,
		data: jQuery.param({ verificador : "frota" }) ,
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		success: function (response) {
			
			var nome = JSON.parse(response);
			
			for(var i=0; i<nome.length; i++){
				frota.push(
					nome[i][12]
				);
				placa.push(
					nome[i][1]
				);
			}
		},
		error: function () {
			alert("error");
		}
	}); 
	
	$.ajax({
		url: 'php/controllerChamarOS.php',
		type: 'POST',
		async:false,
		data: jQuery.param({ verificador : "motorista" }) ,
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		success: function (response) {
			
			var nome = JSON.parse(response);
			
			for(var i=0; i<nome.length; i++){
				motorista.push(
					nome[i][2]
				);
			}
		},
		error: function () {
			alert("error");
		}
	}); 
	
	$.ajax({
		url: 'php/controllerChamarOS.php',
		type: 'POST',
		async:false,
		data: jQuery.param({ verificador : "cliente" }) ,
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		success: function (response) {
			
			var nome = JSON.parse(response);
			
			for(var i=0; i<nome.length; i++){
				cliente.push(
					nome[i][2]
				);
			}
		},
		error: function () {
			alert("error");
		}
	}); 
	
	$.ajax({
		url: 'php/controllerChamarOS.php',
		type: 'POST',
		async:false,
		data: jQuery.param({ verificador : "carga" }) ,
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		success: function (response) {
			
			var nome = JSON.parse(response);
			
			for(var i=0; i<nome.length; i++){
				carga.push(
					nome[i][1]
				);
			}
		},
		error: function () {
			alert("error");
		}
	});
	
	$.ajax({
		url: 'php/controllerChamarOS.php',
		type: 'POST',
		async:false,
		data: jQuery.param({ verificador : "execucao" }) ,
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		success: function (response) {
			
			var nome = JSON.parse(response);
			
			for(var i=0; i<nome.length; i++){
				execucao.push(
					nome[i][1]
				);
			}
		},
		error: function () {
			alert("error");
		}
	});
	
	$.ajax({
		url: 'php/controllerChamarOS.php',
		type: 'POST',
		async:false,
		data: jQuery.param({ verificador : "local" }) ,
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		success: function (response) {
			
			var nome = JSON.parse(response);
			
			for(var i=0; i<nome.length; i++){
				local.push(
					nome[i][1]
				);
			}
		},
		error: function () {
			alert("error");
		}
	});
	
	const hot = new Handsontable(container, {
		data: data,
		//minSpareRows: 1,
		//startRows: 4,
		//startCols: 4,
		//colWidths: 100,
			//width: '100%',
		language: 'pt-BR',
		//colWidths: [150, 150, 150, 150, 150],
		colHeaders: [
			"Contrato",
			"Os n°",
			"Prestadora de serviço",
			"Frota",
			"Placa",
			"Batedor",
			"Cliente",
			"Carga",
			"Tipo de execução",
			"Conjunto",
			"Motorista do conjunto",
			"Origem",
			"Origem (Chegada)",
			"Origem (Saída)",
			"Km origem",
			"Destino",
			"Destino (Chegada)",
			"Destino (Saída)",
			"Km destino",
			"Diárias",
			"km percorrido",
			"CTE",
			"NF",
			"AET"
		],
		columns: [
			{ data: 0, type: 'checkbox', className: 'contrato', editor: false, checkedTemplate: 1, uncheckedTemplate: 0 },
			{ data: 1, type: "text", className: 'os_num', editor: false },
			{ data: 2, className: 'empresa', type: 'dropdown', source: empresa },
			{ data: 3, className: 'frota', type: 'dropdown', source: frota },
			{ data: 4, className: 'placa', type: 'dropdown', source: placa, editor: false },
			{ data: 5, className: 'batedor', type: 'dropdown', source: motorista  },
			{ data: 6, className: 'cliente', type: 'dropdown', source: cliente  },
			{ data: 7, className: 'carga', type: 'dropdown', source: carga  },
			{ data: 8, className: 'execucao', type: 'dropdown', source: execucao  },
			{ data: 9, type: "text", className: 'conjunto' },
			{ data: 10, type: "text", className: 'motorista' },
			{ data: 11, className: 'origem', type: 'dropdown', source: local },
			{ data: 12, 
				type: 'date',
				className: 'origemC',
				dateFormat: 'DD/MM/YYYY',
				correctFormat: true 
			},
			{ data: 13, 
				type: 'date',
				className: 'origemS',
				dateFormat: 'DD/MM/YYYY',
				correctFormat: true    
			},
			{ data: 14, type: "numeric", className: 'kmOrigem' },
			{ data: 15, className: 'destino', type: 'dropdown', source: local },
			
			{ data: 16, type: 'date',
				className: 'destinoC',
				dateFormat: 'DD/MM/YYYY',
				correctFormat: true 
			},
			{ data: 17, type: 'date',
				className: 'destinoS',
				dateFormat: 'DD/MM/YYYY',
				correctFormat: true
			},
			{ data: 18, type: "numeric", className: 'kmdestino' },
			{ data: 19, type: "numeric", className: 'diaria' },
			{ data: 20, type: "numeric", className: 'kmtotal', editor: false  },
			{ data: 21, type: "text", className: 'cte' },
			{ data: 22, type: "text", className: 'nf' },
			{ data: 23, type: "text", className: 'aet' }
		],
		afterValidate: function(isValid, value, row, prop){
			if(isValid){
				hot.getCellMeta(row, prop).className = '';
			}else{
				hot.getCellMeta(row, prop).className = 'htInvalid';
			}
		},
			//autoColumnSize: true,
		//formulas: true,
		//columnSorting : true,
		//manualColumnMove: true,
		dropdownMenu: true,
			//hiddenColumns: { indicators: true },
			//contextMenu: true,
			//multiColumnSorting: true,
		filters: true,
			//rowHeaders: true,
		//colHeaders: true,
		preventOverflow: 'horizontal',
		//manualRowMove: true,
		licenseKey: '51082-04017-49524-49250-12023',
		
		afterGetColHeader: function(col, TH) {
			var TR = TH.parentNode;
			var THEAD = TR.parentNode;
			var headerLevel = (-1) * THEAD.childNodes.length + Array.prototype.indexOf.call(THEAD.childNodes, TR);

			function applyClass(elem, className) {
				if (!Handsontable.dom.hasClass(elem, className)) {
					Handsontable.dom.addClass(elem, className);
				}
			}

			applyClass(TH, 'color1');
		}
	});
	
	hot.addHook('afterRender', function(index, element) {
		hot.validateCells();
	});
	
	const filtersPlugin = hot.getPlugin('filters');

	filtersPlugin.addCondition(17, 'empty', '');
	filtersPlugin.filter();
	
	//alert(hot.getDataAtCell(0, 0)); FAZER SALVAR DADOS
	//alert(data[0][0]);
	
	//USAR PARA ALTERAR DROPDOWN MENU
	/*var cellProperties = hot.getCellMeta(index[0][0], 3);
	cellProperties.type = 'dropdown';
	cellProperties.source = local;
	hot.render();*/

	$(".wtHolder").bind("DOMSubtreeModified", function(e) {
    	var tamanhoTabela = 40 + (24.5 * hot.countRows());
		$(".ht_master > .wtHolder").css('height', tamanhoTabela+'px');
		sliceElem.style.height = $('.ht_master .wtHider').height();
	});

	 hot.addHook('afterChange', function(index, element) {
	 	
		 if(index[0][1]==3){
			 for(var i = 0 ; i<frota.length ; i++){
				if(frota[i] == index[0][3]){
					hot.setDataAtCell(index[0][0],4, placa[i]); // Inseri valor na row
					hot.render();
				}
			 }
		 }
		 if(index[0][1]==14 || index[0][1]==18){
			var finalKM = data[index[0][0]][18] - data[index[0][0]][14];
			if(finalKM < 0){
				finalKM = finalKM * -1;
			}
			hot.setDataAtCell(index[0][0],20, finalKM); // Inseri valor na row
			hot.render();
		 }
	 });
	  
	hot.render();
	$(document).on("click",".restaurarTabela",function(){
		window.location.reload(true);
	});
	
	$(document).on("click",".addOS",function(){
		//hot.setDataAtCell(1,1, "Mexico"); // Inseri valor na row
		//alert(hot.getDataAtCell(1,1)); // Pega valor da row
		//hot.alter('insert_row'); //Cria nova row
		//hot.setSourceDataAtCell(1, 1, "id", "10");
		//hot.alter('insert_row', hot.countRows(), 1);
	});
	
	function convertData(dataOriginal){
		var data = dataOriginal;
		if(dataOriginal == "0000-00-00" || dataOriginal == ""){
			data = null;
		}
		
		return data;
	}
	
	$(document).on('click', '#editarOS', function() {
		
		modal();
		
		var lista_final = [];
		var num_rows = hot.countRows();
		var num_cols = hot.countCols();
		for(var i=0 ; i<num_rows ; i++){
			var verificador = [0,0];
			var lista_temp = [];
			var error_iden = 0;
			for(var j=0 ; j<num_cols ; j++){
				
				error_iden = hot.getCellMeta(i, j).className == 'htInvalid' ? 1 : error_iden;
				
				if((j==12 || j==13 || j==16 || j==17) && dataOriginal[i][j] != null){
					var temp = dataOriginal[i][j].split("-");
					if(temp.length>1){
						dataOriginal[i][j] = temp[2]+"/"+temp[1]+"/"+temp[0];
					}
				}
				if(dataOriginal[i][j] != hot.getDataAtCell(i,j)){
					if(j==17){
						
						if((dataOriginal[i][j] == null || dataOriginal[i][j] == "") && (hot.getDataAtCell(i,j) != null || hot.getDataAtCell(i,j) != "")){
							verificador[1] = 1;
						}
					}
					verificador[0] = 1;
				}
				lista_temp.push(
					hot.getDataAtCell(i,j)
				);
			}
			if(error_iden == 0){
				if(verificador[0] == 1){
					lista_final.push([lista_temp, verificador[1]]);
					
					if(lista_final[lista_final.length-1][1] == 1){
						for(var k=0 ; k<num_rows ; k++){
							if(lista_final[lista_final.length-1][0][4] == hot.getDataAtCell(k,4) && k != lista_final.length-1){
								alert("jj"+lista_final[lista_final.length-1][0][1]+">"+hot.getDataAtCell(k,1));
								lista_final[lista_final.length-1][1] = 0;
								k = num_rows;
							}
						}
					}					
				}
			}else{
				alert("A OS "+hot.getDataAtCell(i,0)+" contem erros e não foi salva!");
			}
		}
		if(lista_final.length != 0){
			var lista = JSON.stringify(lista_final);
			$.post("php/controllerChamarOS.php", { verificador : "editarOS", lista : lista }, function(e){
				document.location.reload(true);
			});
		}		
		modalOut();
	});
});


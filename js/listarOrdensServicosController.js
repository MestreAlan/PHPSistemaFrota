$(function(){
	$(document).on('click', '.criarOS', function() {
		var idValue = this.id.substr(2, this.id.length);
		$.post("php/controllerVincularOS.php", { idOS : idValue }, function(){
			$.post("php/controllerRedirect.php", { page : "criarPlanejamentoOS" }, function(){
				window.location.reload(true);
			});
		});
	});
	
	$('.date').mask('00/00/0000');

	const container = document.getElementById('visualTable');
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
	
	$.ajax({
		url: 'php/controllerChamarOS.php',
		type: 'POST',
		async:false,
		data: jQuery.param({ verificador : "buscarOSLimitada" }) ,
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
						nome[i][22], nome[i][0], nome[i][1], nome[i][2], nome[i][3], nome[i][4], nome[i][5], nome[i][6], nome[i][7], nome[i][8], nome[i][9], nome[i][10], nome[i][11], nome[i][12], nome[i][13], nome[i][14], nome[i][15], nome[i][16], nome[i][17], nome[i][18], km_final, nome[i][19], nome[i][20], nome[i][21], nome[i][23], nome[i][24], nome[i][25]
					]
				);
				dataOriginal.push(
					[
						nome[i][22], nome[i][0], nome[i][1], nome[i][2], nome[i][3], nome[i][4], nome[i][5], nome[i][6], nome[i][7], nome[i][8], nome[i][9], nome[i][10], nome[i][11], nome[i][12], nome[i][13], nome[i][14], nome[i][15], nome[i][16], nome[i][17], nome[i][18], km_final, nome[i][19], nome[i][20], nome[i][21], nome[i][23], nome[i][24], nome[i][25]
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
		startRows: 4,
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
			"AET",
			"Km",
			"Valor",
			"Transit_time"
		],
		columns: [
			{ data: 0, type: 'checkbox', className: 'contrato', editor: false, checkedTemplate: 1, uncheckedTemplate: 0 },
			{ data: 1, type: "text", className: 'os_num', editor: false },
			{ data: 2, className: 'empresa', type: 'dropdown', source: empresa, editor: false },
			{ data: 3, className: 'frota', type: 'dropdown', source: frota, editor: false },
			{ data: 4, className: 'placa', type: 'dropdown', source: placa, editor: false },
			{ data: 5, className: 'batedor', type: 'dropdown', source: motorista, editor: false },
			{ data: 6, className: 'cliente', type: 'dropdown', source: cliente, editor: false },
			{ data: 7, className: 'carga', type: 'dropdown', source: carga, editor: false },
			{ data: 8, className: 'execucao', type: 'dropdown', source: execucao, editor: false },
			{ data: 9, type: "text", className: 'conjunto', editor: false },
			{ data: 10, type: "text", className: 'motorista', editor: false },
			{ data: 11, className: 'origem', type: 'dropdown', source: local, editor: false },
			{ data: 12, 
				type: 'date',
				className: 'origemC',
				dateFormat: 'DD/MM/YYYY',
				correctFormat: true, editor: false
			},
			{ data: 13, 
				type: 'date',
				className: 'origemS',
				dateFormat: 'DD/MM/YYYY',
				correctFormat: true, editor: false    
			},
			{ data: 14, type: "numeric", className: 'kmOrigem', editor: false },
			{ data: 15, className: 'destino', type: 'dropdown', source: local, editor: false },
			
			{ data: 16, type: 'date',
				className: 'destinoC',
				dateFormat: 'DD/MM/YYYY',
				correctFormat: true, editor: false 
			},
			{ data: 17, type: 'date',
				className: 'destinoS',
				dateFormat: 'DD/MM/YYYY',
				correctFormat: true, editor: false
			},
			{ data: 18, type: "numeric", className: 'kmdestino', editor: false },
			{ data: 19, type: "numeric", className: 'diaria', editor: false },
			{ data: 20, type: "numeric", className: 'kmtotal', editor: false  },
			{ data: 21, type: "text", className: 'cte', editor: false },
			{ data: 22, type: "text", className: 'nf', editor: false },
			{ data: 23, type: "text", className: 'aet', editor: false },
			
			{ data: 24, type: "text", className: 'kmPref', editor: false },
			{ data: 25, type: "text", className: 'valor', editor: false },
			{ data: 26, type: "text", className: 'transitTime', editor: false }
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

	//filtersPlugin.addCondition(17, 'empty', '');
	//filtersPlugin.filter();
	
	 hot.addHook('afterChange', function(index, element) {
		 if(index[0][1]==2){
			 for(var i = 0 ; i<frota.length ; i++){
				 if(frota[i] == index[0][3]){
					 hot.setDataAtCell(index[0][0],3, placa[i]); // Inseri valor na row
					 hot.render();
				 }
			 }
		 }
	 });
	  
	hot.render();
	$(document).on("click",".restaurarTabela",function(){
		window.location.reload(true);
	});
	
	function convertData(dataOriginal){
		var data = dataOriginal;
		if(dataOriginal == "0000-00-00" || dataOriginal == ""){
			data = null;
		}
		
		return data;
	}

});
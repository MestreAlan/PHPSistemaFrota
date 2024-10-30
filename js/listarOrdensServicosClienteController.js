$(function(){
	
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
		data: jQuery.param({ verificador : "buscarOSCliente" }) ,
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		success: function (response) {
			
			var nome = JSON.parse(response);
			for(var i=0; i<nome.length; i++){
				nome[i][17] = $.isNumeric(nome[i][17]) ? nome[i][17] : 0;
				nome[i][13] = $.isNumeric(nome[i][13]) ? nome[i][13] : 0;
				var km_final = parseInt(nome[i][17]) - parseInt(nome[i][13]);
				km_final = km_final<0 ? 0 : km_final;
				
				nome[i][11] = nome[i][11] == '0000-00-00' ? null : formataStringData(nome[i][11]);
				nome[i][12] = nome[i][12] == '0000-00-00' ? null : formataStringData(nome[i][12]);
				nome[i][15] = nome[i][15] == '0000-00-00' ? null : formataStringData(nome[i][15]);
				nome[i][16] = nome[i][16] == '0000-00-00' ? null : formataStringData(nome[i][16]);

				data.push(
					[
						nome[i][0], nome[i][1], nome[i][2], nome[i][3], nome[i][4], nome[i][5], nome[i][6], nome[i][7], nome[i][8], nome[i][9], nome[i][10], nome[i][11], nome[i][12], nome[i][13], nome[i][14], nome[i][15], nome[i][16], nome[i][17], nome[i][18], km_final, nome[i][19], nome[i][20], nome[i][21]
					]
				);
				dataOriginal.push(
					[
						nome[i][0], nome[i][1], nome[i][2], nome[i][3], nome[i][4], nome[i][5], nome[i][6], nome[i][7], nome[i][8], nome[i][9], nome[i][10], nome[i][11], nome[i][12], nome[i][13], nome[i][14], nome[i][15], nome[i][16], nome[i][17], nome[i][18], km_final, nome[i][19], nome[i][20], nome[i][21]
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
		language: 'pt-BR',
		colHeaders: [
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
			"Origem (D. Chegada)",
			"Origem (D. Saída)",
			"Km origem",
			"Destino",
			"Destino (D. Chegada)",
			"Destino (D. Saída)",
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
			{ data: 0, type: "text", className: 'os_num', editor: false },
			{ data: 1, className: 'empresa', type: 'dropdown', source: empresa, editor: false },
			{ data: 2, className: 'frota', type: 'dropdown', source: frota, editor: false },
			{ data: 3, className: 'placa', type: 'dropdown', source: placa, editor: false },
			{ data: 4, className: 'batedor', type: 'dropdown', source: motorista, editor: false },
			{ data: 5, className: 'cliente', type: 'dropdown', source: cliente, editor: false },
			{ data: 6, className: 'carga', type: 'dropdown', source: carga, editor: false },
			{ data: 7, className: 'execucao', type: 'dropdown', source: execucao, editor: false },
			{ data: 8, type: "text", className: 'conjunto', editor: false },
			{ data: 9, type: "text", className: 'motorista', editor: false },
			{ data: 10, className: 'origem', type: 'dropdown', source: local, editor: false },
			{ data: 11, 
				type: 'date',
				className: 'origemC',
				dateFormat: 'DD/MM/YYYY',
				correctFormat: true, editor: false
			},
			{ data: 12, 
				type: 'date',
				className: 'origemS',
				dateFormat: 'DD/MM/YYYY',
				correctFormat: true, editor: false    
			},
			{ data: 13, type: "numeric", className: 'kmOrigem', editor: false },
			{ data: 14, className: 'destino', type: 'dropdown', source: local, editor: false },
			
			{ data: 15, type: 'date',
				className: 'destinoC',
				dateFormat: 'DD/MM/YYYY',
				correctFormat: true, editor: false 
			},
			{ data: 16, type: 'date',
				className: 'destinoS',
				dateFormat: 'DD/MM/YYYY',editor: false
			},
			{ data: 17, type: "numeric", className: 'kmdestino', editor: false },
			{ data: 18, type: "numeric", className: 'diaria', editor: false },
			{ data: 19, type: "numeric", className: 'kmtotal', editor: false  },
			{ data: 20, type: "text", className: 'cte', editor: false },
			{ data: 21, type: "text", className: 'nf', editor: false },
			{ data: 22, type: "text", className: 'aet', editor: false }
		],
		dropdownMenu: true,
		filters: true,
		preventOverflow: 'horizontal',
		licenseKey: '51082-04017-49524-49250-12023'
	});
	
	hot.addHook('afterRender', function(index, element) {
		
		hot.validateCells();
	});
	
	function convertDate(inputFormat) {
		function pad(s) { return (s < 10) ? '0' + s : s; }
		var d = new Date(inputFormat)
		return [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('/')
	}

	var date = new Date();

	var dateAnterior = convertDate(new Date(date.setDate(date.getDate() - 2)));
	var dateAtual = convertDate(new Date());
	
	hot.getPlugin('filters').addCondition(16, 'between', [dateAnterior, dateAtual], 'disjunction');
	hot.getPlugin('filters').addCondition(16, 'empty', '', 'disjunction');
	hot.getPlugin('filters').filter();
	
	hot.render();
	$(document).on("click",".restaurarTabela",function(){
		window.location.reload(true);
	});

	function formataStringData(data) {
		var ano  = data.split("-")[0];
		var mes  = data.split("-")[1];
		var dia  = data.split("-")[2];

		return dia + '/' + mes + '/' + ano;
	}
});

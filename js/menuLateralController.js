$(function(){
	/*$(document).on("click", ".side-menu > ul > li", function(e){
		if($(this).find('.sub-menu').length>0){
			e.preventDefault();
			e.stopPropagation();
			$(this).toggleClass('active');
			$(this).find('.sub-menu').stop().slideToggle();
		} 
	});
	
	var myCollapse = document.getElementById('meunuCollapse');
	var bsCollapse = new bootstrap.Collapse(myCollapse, {
		toggle: true
	});
	
	$(".navbar-toggler").click(function(){
		var getTroggleValue = $('#meunuCollapse').toggle();
		if ($("#meunuCollapse").is(":visible")) {
			$("#responsividadeEsquerda").attr('class', 'col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3');
			$("#responsividadeDireita").attr('class', 'col-xs-9 col-sm-9 col-md-9 col-lg-9 col-xl-9');
			
			$("#responsividadeInternaEsquerda").attr('class', "col-xs-2 col-xs-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2");
			$("#responsividadeInternaDireita").attr('class', "col-xs-7 col-xs-7 col-md-7 col-lg-7 col-xl-7 col-xxl-7");
			
		} else {
			$("#responsividadeEsquerda").attr('class', 'col-xs-0 col-sm-0 col-md-0 col-lg-0 col-xl-0');
			$("#responsividadeDireita").attr('class', 'col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12');
			
			$("#responsividadeInternaEsquerda").attr('class', "col-xs-2 col-xs-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2");
			$("#responsividadeInternaDireita").attr('class', "col-xs-10 col-xs-10 col-md-10 col-lg-10 col-xl-10 col-xxl-10");
		}
	});*/
	
	$("#logo").click(function(){
		$.post("php/controllerRedirect.php", { page : "hall" }, function(){
			window.location.reload(true);
		});
	});
	
	$("#acessoClienteRestrito").click(function(){
		$.post("php/controllerRedirect.php", { page : "clienteRestrito" }, function(){
			window.location.reload(true);
		});
	});
	
	$("#acessoListaColaboradores").click(function(){
		$.post("php/controllerRedirect.php", { page : "listarColaboradoresGeral" }, function(){
			window.location.reload(true);
		});
	});
	
	$("#acessoListaColaboradoresAtivos").click(function(){
		$.post("php/controllerRedirect.php", { page : "listarColaboradoresAtivos" }, function(){
			window.location.reload(true);
		});
	});
	
	$("#acessoListaColaboradoresDesativos").click(function(){
		$.post("php/controllerRedirect.php", { page : "listarColaboradoresDesativos" }, function(){
			window.location.reload(true);
		});
	});
	
	$("#acessoCriarColaborador").click(function(){
		$.post("php/controllerColaboradoresGeral.php", { idDadosPessoais : 0 }, function(){
			$.post("php/controllerRedirect.php", { page : "visualizadorColaboradorEspecifico" }, function(){
				window.location.reload(true);
			});
		});
	});
	
	$("#acessoListarClientesGeral").click(function(){
		$.post("php/controllerRedirect.php", { page : "listarClientesGeral" }, function(){
			window.location.reload(true);
		});
	});
	
	$("#acessoCriarCliente").click(function(){
		$.post("php/controllerClienteGeral.php", { idCliente : 0 }, function(){
			$.post("php/controllerRedirect.php", { page : "visualizadorClienteEspecifico" }, function(){
				window.location.reload(true);
			});
		});
	});
	
	$("#acessoMonitoramentoFrota").click(function(){
		$.post("php/controllerRedirect.php", { page : "monitoramentoFrota" }, function(){
			window.location.reload(true);
		});
	});
	
	$("#acessoManipularFrota").click(function(){
		$.post("php/controllerRedirect.php", { page : "manipularFrota" }, function(){
			window.location.reload(true);
		});
	});
	
	$("#acessoAdicionarFrota").click(function(){
		$.post("php/controllerFrotaGeral.php", { idFrota : 0 }, function(){
			$.post("php/controllerRedirect.php", { page : "visualizadorFrotaEspecifica" }, function(){
				window.location.reload(true);
			});
		});
	});
	
	$("#acessoCriarPlanejamentoOS").click(function(){
		$.post("php/controllerVincularOS.php", { idOS : 0 }, function(){
			$.post("php/controllerRedirect.php", { page : "criarPlanejamentoOS" }, function(){
				window.location.reload(true);
			});
		});
	});
	
	$("#acessoListarOrdensServicos").click(function(){
		$.post("php/controllerRedirect.php", { page : "listarOrdensServicos" }, function(){
			window.location.reload(true);
		});
	});
	
	$("#acessoMonitorarExecucoesOperacoes").click(function(){
		$.post("php/controllerRedirect.php", { page : "acessarMonitorarExecucoesOperacoes" }, function(){
			window.location.reload(true);
		});
	});
	
	$("#acessoGerenciarLocalizacoes").click(function(){
		$.post("php/controllerRedirect.php", { page : "gerenciarLocalizacoes" }, function(){
			window.location.reload(true);
		});
	});
	
	$("#acessoPrecificarRota").click(function(){
		$.post("php/controllerRedirect.php", { page : "precificarRota" }, function(){
			window.location.reload(true);
		});
	});

	$("#acessoCriarNota").click(function(){
		$.post("php/controllerRedirect.php", { page : "criarNota" }, function(){
			window.location.reload(true);
		});
	});
	
	$("#acessoVisualizarLocalizacaoVeiculos").click(function(){
		$.post("php/controllerRedirect.php", { page : "acessarLocalizacaoVeiculos" }, function(){
			window.location.reload(true);
		});
	});
	
	$("#acessoDashboard").click(function(){
		$.post("php/controllerRedirect.php", { page : "visualizadorDashboard.php" }, function(){
			window.location.reload(true);
		});
	});
	
	$(document).on('mouseout', '.btn', function(event) {
		this.blur();
	});

	//REMOVER COMENTÁRIO EM PRODUÇÃO
	/*
	if (document.addEventListener) {
		document.addEventListener("contextmenu", function(e) {
			e.preventDefault();
			return false;
		});
	} else { //Versões antigas do IE
		document.attachEvent("oncontextmenu", function(e) {
			e = e || window.event;
			e.returnValue = false;
			return false;
		});
	}
	*/
});
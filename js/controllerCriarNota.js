$(function(){
	$('.date').mask('00/00/0000');

	$(document).on('click', '#addNota', function() {
		
		modal();
		
		var prestadora = $("#input_empresa option:selected").val(); 
 		var tomadora = $("#input_cliente option:selected").val();
		var periodo_inicio = $("#periodo_inicio").val();
		var periodo_final = $("#periodo_final").val();
		var cte = $("#cte").val();
		var note = $("#nota").val();

		if(prestadora != "" || tomadora != "" || periodo_inicio != "" || periodo_final != "" || cte != "" || note != ""){
			
			$.post("php/controllerListarDadosNota.php", { prestadora : prestadora, tomadora : tomadora, periodo_inicio : periodo_inicio, periodo_final : periodo_final, cte : cte, note : note }, function(retorno){
				var valoresEncontrados = JSON.parse(retorno);
				
				modalOut();
				$(".edicao").attr('id_conctrole', 1);
				$('.edicao').fadeIn(1);
			});
			
			
			
			
		}else{
			alert("parece que nehum dado foi alterado!");
			modalOut();
		}
	});

	if($(".edicao").attr('id_conctrole')==0){
		$('.edicao').fadeOut(1);
	}
});

$(function(){
	$(document).on('click', '.acessarFrota', function() {
		
		var idValue = this.id;

		$.post("php/controllerFrotaGeral.php", { idFrota : idValue }, function(){
			$.post("php/controllerRedirect.php", { page : "visualizadorFrotaEspecifica" }, function(){
				window.location.reload(true);
			});
		});
	});	
	
});
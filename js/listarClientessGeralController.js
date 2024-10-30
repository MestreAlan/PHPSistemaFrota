$(function(){
	$(document).on('click', '.acessarCliente', function() {
		
		var idValue = this.id;
		$.post("php/controllerClienteGeral.php", { idCliente : idValue }, function(){
			$.post("php/controllerRedirect.php", { page : "visualizadorClienteEspecifico" }, function(){
				window.location.reload(true);
			});
		});
	});	
});
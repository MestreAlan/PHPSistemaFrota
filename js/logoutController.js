$(function(){
	$("#logoutButton").click(function(){
		$.post("php/controllerLogout.php", function(){
			window.location.reload(true);
		});
	});
});
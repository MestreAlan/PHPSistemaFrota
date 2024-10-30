$(function(){

	$("#fa-eye1, #fa-eye2, #fa-eye3").on('click', function() {
		
		var id_password = $(this).attr("id") == 'fa-eye1' ? '#password_registro' : $(this).attr("id") == 'fa-eye2' ? '#password_login' : '#password_registro_validacao';

		var passwordId = $(id_password).parents('li:first').find('input').attr('id');
		
		if ($(id_password).hasClass('hide-password')) {
			$(id_password).removeClass();
			$(id_password).addClass('show-password');
			$(id_password).attr("type", "text");
		} else {
			$(id_password).removeClass();
			$(id_password).addClass('hide-password');
			$(id_password).attr("type", "password");
		}
		
		var id = "#"+$(this).attr("id");

		if ($(id).hasClass('fa-eye')) {
			$(id).removeClass();
			$(id).addClass('fa fa-eye-slash fa-2x');
		} else {
			$(id).removeClass();
			$(id).addClass('fa fa-eye fa-2x');
		}
	});

});
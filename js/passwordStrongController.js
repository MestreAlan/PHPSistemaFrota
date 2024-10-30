$(function(){
	$('#password_registro').on('keyup', function () {
		var number = /([0-9])/;
		var alphabets = /([a-zA-Z])/;
		var special_characters = /([~,!,@,#,$,%,^,&,_,+,=,?,>,<,\-])/;
		var repicoes = /([a-zA-Z,0-9,~,!,@,#,$,%,^,&,_,+,=,?,>,<,\-]{1,7})\1/g;
		var proibidos = /([",',¨,\(,\),\,,°,º,ª,*,§,\s,,\\,\[,\]])/;
		
		
		if($('#password_registro').val().match(proibidos)){
			$('#password-strength-status').removeClass();
			$('#password-strength-status').addClass('weak-password');
			$('#password-strength-status').html("Caractere invalído inserido. \n São permitidos apenas letras, números e os seguintes caracteres: \n ~,!,@,#,$,%,^,&,*,_,+,=,?,>,<");
		} else if ($('#password_registro').val().length < 6) {
			$('#password-strength-status').removeClass();
			$('#password-strength-status').addClass('weak-password');
			$('#password-strength-status').html("Senha fraca");
		} else {
			if($('#password_registro').val().match(repicoes)) {
				$('#password-strength-status').removeClass();
				$('#password-strength-status').addClass('medium-password');
				$('#password-strength-status').html("Senha intermediária");
			} else if($('#password_registro').val().match(number) && $('#password_registro').val().match(alphabets) && $('#password_registro').val().match(special_characters) && $('#password_registro').val().length >= 10) {
				$('#password-strength-status').removeClass();
				$('#password-strength-status').addClass('very-strong-password');
				$('#password-strength-status').html("Senha extrema");
			} else if ($('#password_registro').val().match(number) && $('#password_registro').val().match(alphabets) && $('#password_registro').val().match(special_characters)) {
				$('#password-strength-status').removeClass();
				$('#password-strength-status').addClass('strong-password');
				$('#password-strength-status').html("Senha forte");
			} else if ($('#password_registro').val().length >= 15) {
				$('#password-strength-status').removeClass();
				$('#password-strength-status').addClass('strong-password');
				$('#password-strength-status').html("Senha forte");
			} else {
				$('#password-strength-status').removeClass();
				$('#password-strength-status').addClass('medium-password');
				$('#password-strength-status').html("Senha intermediária");
			}
		}
	});
});
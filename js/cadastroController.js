$(function(){
	$(".register-form").on('keyup', function () {
		var user_login = $('#user_login_registro').val();
		var email = $('#insert_email').val();
		var senha = $('#password_registro').val();
		var confirm_senha = $('#password_registro_validacao').val();
		var codigo = $('#codigo_liberacao').val();
		
		$("#insert_email")[0].setCustomValidity("");
		if($("#insert_email")[0].checkValidity() == false){
			$("#insert_email")[0].setCustomValidity('O formato inserido do e-mail não é válido!');
		}
		
		$('#password_registro_validacao')[0].setCustomValidity("");
		if (senha != confirm_senha) {
			$('#password_registro_validacao')[0].setCustomValidity("Senhas diferentes");
		}
		
		$('#user_login_registro')[0].setCustomValidity("");
		$('#insert_email')[0].setCustomValidity("");
		if(user_login != "" && email != "" && codigo != ""){			
			$.post("php/controllerValidarCPFUserName.php", { user_login : user_login, email : email, codigo : codigo },function(resposta){
				var valoresEncontrados = JSON.parse(resposta);
				
				if(valoresEncontrados[0] > 0){
					$('#user_login_registro')[0].setCustomValidity("Usuário já cadastrado");
				}else{
					$('#user_login_registro')[0].setCustomValidity("");
				}
				
				if(valoresEncontrados[1] == -1){
					$('#insert_email')[0].setCustomValidity("Cadastro negado. Não foi liberado acesso para o e-mail solicitado");
				}else if(valoresEncontrados[1] == 1){
					$('#insert_email')[0].setCustomValidity("Cadastro negado. Usuário de e-mail já cadastrado");
				}else{
					$('#insert_email')[0].setCustomValidity("");
				}
			});	
		}			
		
	});
	
	$(document).on('click', ".register-form > button", function () {	
		var user_login = $('#user_login_registro').val();
		var email = $('#insert_email').val();
		var senha = $('#password_registro').val();
		
		var confirm_senha = $('#password_registro_validacao').val();
		
		if($("#user_login_registro")[0].checkValidity() == true && $("#insert_email")[0].checkValidity() == true && $("#password_registro")[0].checkValidity() == true && $("#password_registro_validacao")[0].checkValidity() == true){
			if(user_login != "" && email != "" && senha != "" && confirm_senha != ""){
				$.post("php/controllerCadastro.php", { user_login : user_login, email : email, senha : senha },function(){
					alert("Usuário cadastrado com sucesso!");
				});	
			}
		}
	});
	
	$('#codigo_liberacao').mask('00000');
});
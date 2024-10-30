$(document).ready(function() {
	$('#switch-shadow').click(function() {
		var estilo = 'blackPiano';
		if($('body').attr('class') == 'blackPiano'){
			$('body').removeClass();
			$('body').addClass('graphite');
			estilo = 'graphite';
		}else{
			$('body').removeClass();
			$('body').addClass('blackPiano');
			estilo = 'blackPiano';
		}
		
		$.post("php/controllerStyleBackground.php", { estilo : estilo },function(){
			
		});	
		
	});
});

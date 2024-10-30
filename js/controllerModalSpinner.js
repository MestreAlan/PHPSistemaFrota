function modal(){
	$('.modalSpinner').modal('show');
	$('.modalSpinner').modal({backdrop: 'static', keyboard: false});
}

function modalOut(){
	setTimeout(function(){ 
		$('.modalSpinner').modal({backdrop: '', keyboard: true});
		$('.modalSpinner').modal('hide');
	
	}, 500);
}

$(function(){
	 $(".modalSpinner").modal({
        show: false,
        backdrop: 'static'
    });
});
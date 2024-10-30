$(function(){

	$(document).click(function(e){
		var id = e.target.id != "" ? e.target.id : "0A" ;
		var valueDrop = $("#"+id).attr("idDropMenu");
		if(valueDrop != ''){
			$("[style*='display: block']").each(function(){
				if(this.id != valueDrop && !($(e.target).parent().attr('class') == "form-check" || $(e.target).attr('class') == "liDropMenu" || $(e.target).attr('class') == "form-check")){
					$("#"+this.id).toggle();
				}
			});
		}
	});

	$(".btn-dropdown-filtro").click(function(){
		$("#"+$(this).attr("idDropMenu")).toggle();
	});
	
	$(document).on("click", ".btn-filtro", function() {
		var vetorCheked = [];
		var valorLocal = $(this).attr("cond");
		$('input:checkbox[name="locationthemes"]:checked').each(function() 
		{
			vetorCheked.push($(this).val().toUpperCase());
		});
		
		var table, tr, td, i;
		table = document.getElementById("monitorarFrotaTable");
		tr = table.getElementsByTagName("tbody")[0].rows;
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("input")[valorLocal];
			if (td) {
				if (vetorCheked.includes(td.value.toUpperCase().trim())) {
					var somatorioVerificador = 0;
					$(td).attr("verificador",0);
					$(tr[i].getElementsByTagName("td")).each(function(){
						somatorioVerificador = somatorioVerificador + ( isNaN($(this).attr("verificador")) ? 0 : parseInt($(this).attr("verificador")));
					});
					if(somatorioVerificador==0){
						tr[i].style.display = "";
					}
				} else {
					$(td).attr("verificador",1);
					tr[i].style.display = "none";
				}
			}       
		}
		
	});
	
	$(document).on("click", ".btn-filtro-span", function() {
		var vetorCheked = [];
		var valorLocal = $(this).attr("cond");
		$('input:checkbox[name="locationthemes"]:checked').each(function(index) 
		{
			vetorCheked.push($(this).val().toUpperCase().trim());
		});
		
		var table, tr, td, i;
		tr = $("#monitorarFrotaTable").find("tbody>tr");
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("span")[valorLocal];
			if (td) {
				var endValue = td.innerHTML.replace("&amp;", "&");
				if (vetorCheked.includes(endValue.toUpperCase().trim())) {
					var somatorioVerificador = 0;
					$(td).attr("verificador",0);
					$(tr[i].getElementsByTagName("span")).each(function(){
						somatorioVerificador = somatorioVerificador + ( isNaN($(this).attr("verificador")) ? 0 : parseInt($(this).attr("verificador")));
					});
					if(somatorioVerificador==0){
						tr[i].style.display = "";
					}
				} else {
					$(td).attr("verificador",1);
					tr[i].style.display = "none";
				}
			}       
		}
		
	});
});

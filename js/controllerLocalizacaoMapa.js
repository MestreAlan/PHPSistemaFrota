var posi1 = 12;
function alterMark(map, latlng){
	const marker = new google.maps.Marker({
        position:latlng,
        map:map,
        draggable:true
    });

	// Create the initial InfoWindow.
	let infoWindow = new google.maps.InfoWindow({
		//content: "Click the map to get Lat/Lng!",
		//position: latlng,
	});

	infoWindow.open(map);

	// Configure the click listener.
	map.addListener("click", (mapsMouseEvent) => {
		// Close the current InfoWindow.
		//infoWindow.close();

		// Create a new InfoWindow.
		//infoWindow = new google.maps.InfoWindow({
			//position: mapsMouseEvent.latLng,
		//});
		marker.setPosition(mapsMouseEvent.latLng);

		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({'location': mapsMouseEvent.latLng}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var lat = results[0].geometry.location.lat();
				var lng = results[0].geometry.location.lng();
				getLocationInfo(results[0]);
				$('#endereco').val(results[0].formatted_address);
			}
		});

		//alert(mapsMouseEvent.latLng.lat());
		//infoWindow.setContent(JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2));
		//infoWindow.open(map);
	});
}

function initMap() {
	var latlng = new google.maps.LatLng(-5.8631457, -35.2130275);

	var options = {
		zoom: 13,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	
	var map = new google.maps.Map(document.getElementById("mapa"), options);

	alterMark(map, latlng);

	var geocoder = new google.maps.Geocoder();
	geocoder.geocode({'location': latlng}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			var lat = results[0].geometry.location.lat();
			var lng = results[0].geometry.location.lng();
			getLocationInfo(results[0]);
			$('#endereco').val(results[0].formatted_address);
		}
	});
}

function getLocationInfo(resultado){
	var cidadeC = "";
	var cidadeL = "";
	var estadoC = "";
	var estadoL = "";
	for(var i = 0; i < resultado.address_components.length; i++){
		if(resultado.address_components[i].types[0] == "administrative_area_level_2"){
			cidadeL = resultado.address_components[i].long_name;
			cidadeC = resultado.address_components[i].short_name;
		}
		if(resultado.address_components[i].types[0] == "administrative_area_level_1"){
			estadoL = resultado.address_components[i].long_name;
			estadoC = resultado.address_components[i].short_name;
		}
	}
	$('#cidade').val(cidadeC);
	$('#estadosBrasil').val(estadoC);
}

$(function(){

	$(document).on('click', '#addLocal', function(){
		
		var cidade = $('#cidade').val();
		var estado = $('#estadosBrasil option:selected').val();
		var address = $('#endereco').val().replace(/,/g, ".").replace(/\./g, "");
		var apelido = $('#apelido').val();

		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var lat = results[0].geometry.location.lat();
				var lng = results[0].geometry.location.lng();
				
				$.post("php/controllerAcessoLocalizacaoMapa.php", { direcionador : "adicionar", cidade : cidade, estado : estado, apelido : apelido, address : address, lat : lat, lng : lng }, function(id){
					
					
					$('.tbodyDadosPessoais tr:last').after('<tr style=""><td class="cell100 column1"><span class="date">'+apelido+'</span></td><td class="cell100 column2"><span class="date">'+cidade+'</span></td><td class="cell100 column3"><span class="date">'+estado+'</span></td><td><button id="'+id+'" type="button" class="btn btn-primary removerLocal">Excluir</button></td></tr>');

					//document.location.reload(true);
				});
				
			} else {
				alert("Local não encontrado! ");
			}
		});
	});

	$(document).on('blur', '#cidade', function(){

		var cidade = $('#cidade').val();
		var estado = $('#estadosBrasil option:selected').val();
		
		var address = cidade+", "+estado;

		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var lat = results[0].geometry.location.lat();
				var lng = results[0].geometry.location.lng();
				var myOptions = {
					zoom: 13,
					center: new google.maps.LatLng(lat, lng)
				};
				var map = new google.maps.Map(
					document.getElementById("mapa"), myOptions
				);

				alterMark(map,  new google.maps.LatLng(lat, lng));
				getLocationInfo(results[0]);
				$('#endereco').val(results[0].formatted_address);
			}
		});
	});

	$(document).on('click', '.removerLocal', function(){
		
		var idValue = this.id;
		var elemento = this;
		
		$.post("php/controllerAcessoLocalizacaoMapa.php", { direcionador : "excluir", idValue : idValue }, function(){
			$(elemento).closest('tr').remove();
			alert("Exclusão realizado com sucesso!");
		});		
	});

	initMap();
});


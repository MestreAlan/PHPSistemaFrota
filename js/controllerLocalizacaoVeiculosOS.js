$(function(){
	modal();
	
	function initMapV(listaV){
		var mapV = new google.maps.Map(document.getElementById("mapaV"), {
			zoom: 4,
			center: { lat: parseFloat(-5.7841695), lng: parseFloat(-35.1999708) },
			disableDefaultUI: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		});
		
		for(var i=0;i<listaV.length;i++){
			addMark(mapV, listaV[i][0], listaV[i][1], listaV[i][2]);
			
			//alert(listaV);
		}
	}
	
	function addMark(map, lat, lon, img){
		var icon = {
			url: img,
			scaledSize: new google.maps.Size(30, 50),
			zIndex: 0
			
		};
		
		var beachMarker = new google.maps.Marker({
			position: { lat: parseFloat(lat), lng: parseFloat(lon) },
			map: map,
			icon: icon
		});
		
		beachMarker.setZIndex(1001);
	}
	
	function initMap(latAtual, lngAtual, id, latFinal, lngFinal, i, img) {
		var directionsRenderer = new google.maps.DirectionsRenderer();
		var directionsService = new google.maps.DirectionsService();
		
		var map = new google.maps.Map(document.getElementById(id), {
			zoom: 14,
			center: { lat: parseFloat(latAtual), lng: parseFloat(lngAtual) },
			disableDefaultUI: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		});
		
		addMark(map, latAtual, lngAtual, img);
		
		
		
		var iconFim = {
			url: 'img/end.png',
			scaledSize: new google.maps.Size(30, 50),
			zIndex: 0
		};
		
		var beachMarkerFim = new google.maps.Marker({
			position: { lat: parseFloat(latFinal), lng: parseFloat(lngFinal) },
			map: map,
			icon: iconFim
		});
		
		beachMarkerFim.setZIndex(101);
		
		buscarLocal(latAtual, lngAtual, "#local"+i, "Localização: ");
		
		directionsRenderer.setMap(map);
		calculateAndDisplayRoute(directionsService, directionsRenderer, latAtual, lngAtual, id, latFinal, lngFinal, map);
		
	}
	
	function buscarLocal(lat, lng, local, texto){
		var address = "<p />Localização: Não encontrada";
		
		var latlng = new google.maps.LatLng(lat, lng);
		// This is making the Geocode request
		var geocoder = new google.maps.Geocoder();
		
		geocoder.geocode({ 'latLng': latlng }, function (results, status) {
			
			if (status !== google.maps.GeocoderStatus.OK) {
				$(local).html(texto+"Não encontrado");
			}
		// This is checking to see if the Geoeode Status is OK before proceeding
			if (status == google.maps.GeocoderStatus.OK) {
				//address = results[0].address_components[2].short_name +","+results[0].address_components[3].short_name;
				address = results[0].formatted_address;
				$(local).html(texto+address);
				
			}
		});
		//return address;
	}

	function calculateAndDisplayRoute(directionsService, directionsRenderer, latAtual, lngAtual, id, latFinal, lngFinal) {
		directionsService
		.route({
			origin: { lat: parseFloat(latAtual), lng: parseFloat(lngAtual) },
			destination: { lat: parseFloat(latFinal), lng: parseFloat(lngFinal) },
			travelMode: google.maps.TravelMode["DRIVING"],
		})
		.then((response) => {
			directionsRenderer.setDirections(response);
		});
		//.catch((e) => window.alert("Directions request failed due to " + status));
	}
		
	function rodar(){
		modal();
		
		
			
		$.post("php/controllerLocalizacaoVeiculosOS.php", { listarVeiculosOS:"listarVeiculosOS" }, function(retorno){
			
			var valoresEncontrados = JSON.parse(retorno);
			var lista = [];
			var listaV = [];
			if(valoresEncontrados.length > 0){
				
				if(valoresEncontrados[0].length > 0){
					
					var i;
					for(i=0;i<valoresEncontrados[0].length;i++){
						listaV.push( [ valoresEncontrados[0][i][2], valoresEncontrados[0][i][3], valoresEncontrados[0][i][5][16] ] );
					}
					
					initMapV(listaV);
				}
				
				for(var i=1;i<valoresEncontrados.length;i++){
					var latitudeValue = Math.abs(parseFloat(Math.abs(parseFloat(valoresEncontrados[i][5][1]))-Math.abs(parseFloat(valoresEncontrados[i][2])))).toFixed(5);
					var longitudeValue = Math.abs(parseFloat(Math.abs(parseFloat(valoresEncontrados[i][5][2]))-Math.abs(parseFloat(valoresEncontrados[i][3])))).toFixed(5);
					var distancia = Math.abs(parseFloat(parseFloat(latitudeValue) + parseFloat(longitudeValue))).toFixed(5);
					lista.push([valoresEncontrados[i][0], valoresEncontrados[i][1], valoresEncontrados[i][2], valoresEncontrados[i][3], valoresEncontrados[i][4], valoresEncontrados[i][5][0], valoresEncontrados[i][5][1], valoresEncontrados[i][5][2], latitudeValue, longitudeValue, distancia, valoresEncontrados[i][5][3], valoresEncontrados[i][5][4], valoresEncontrados[i][5][5]]);
				}
				/*
				0	placa
				1	frota
				2	latitude
				3	longitude
				4	ligado
				5	os
				6	latitude os
				7	longitude os
				8	latitude distancia
				9	longitude distancia
				10	cidade
				11	sigla
				12	link
				*/
				
				lista.sort(function (a, b) {
					if (a[10] > b[10]) {
						return 1;
					}
					if (a[10] < b[10]) {
						return -1;
					}
					
					return 0;
				});
				
				for(var i=0;i<lista.length;i++){
					var ligado = lista[i][1] == 1 ? "Ligado" : "Desligado";
					var texto = "<p /> OS: "+lista[i][5]+" Frota: "+lista[i][1]+" Motor: "+ligado ;
					
					$("#floating-panel"+i).html(texto);
					$("#destino"+i).html("Destino: "+lista[i][11]+","+lista[i][12]);
					var numeroV = (parseInt(i)+1);
					var numeroVV = (parseInt(i)+2);
					var numeroVVV = (parseInt(i)-1);
					if($('.coluna'+numeroV).length==0){
						
						
						
						
						if( i%2==1 && i!=0 ){
							$( '<div class="row linha'+numeroV+'"> <div class="col-xs col-xs col-md col-lg col-xl col-xxl coluna'+numeroV+'"> <div id="floating-panel'+numeroV+'"> </div> <div id="local'+numeroV+'"> </div> <div id="destino'+numeroV+'"> </div> <div id="mapa'+numeroV+'" style="width:100%; height:250px"></div> </div> </div >"' ).insertAfter( $( ".linha"+numeroVVV ) );
						}else{
							$( '<div class="col-xs col-xs col-md col-lg col-xl col-xxl coluna'+numeroV+'"> <div id="floating-panel'+numeroV+'"> </div> <div id="local'+numeroV+'"> </div> <div id="destino'+numeroV+'"> </div> <div id="mapa'+numeroV+'" style="width:100%; height:250px"></div> </div> ' ).insertAfter( $( ".coluna"+i ) );
							
						}
					}
					initMap(lista[i][2], lista[i][3], "mapa"+i, lista[i][6], lista[i][7], i, lista[i][13]);
				}
			}
			modalOut();		
		});
	}
	
	rodar();
	timeInterval = setInterval(function() {
        rodar();
    }, 30000);
});


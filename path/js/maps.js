var map;
var markers;
var myloc;
var data_pasar;
var poly = '';

var initialize = function() {
	/* setup map */
	var mapOptions = {
		zoom: 12,
		center: new google.maps.LatLng(-7.7918791, 110.4086587)
	};


	// TODO: peta.php : setup peta
	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	console.log("tes"+map);
	/* create marker and line by click */
	google.maps.event.addListener(map, 'click', function(event)
	{
		var location = event.latLng;
	});

	// handle click and dblclick same time
	google.maps.event.addListener(this.map, 'dblclick', function(event) {

	});
	new getAllPath();
}

google.maps.event.addDomListener(window, 'load', initialize);

	var allpasarCallback = function(result){
		if(markers != undefined){
			markers.setMapOnAll(null);
			console.log("ikii");
		}
		markers = new marker(map);
		for(var a=0;a<result.length;a++){
			var loc = JSON.parse('{"lat": '+result[a].lat+', "lng": '+result[a].lng+'}');
			markers.addMarker(loc, result[a].id+" ~ "+result[a].simpul_awal+" - "+result[a].simpul_tujuan, "", "0");
		}
		markers.setMapOnAll(map);
	}

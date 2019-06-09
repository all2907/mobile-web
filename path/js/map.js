var map;
var markers;
var myloc;
var data_pasar;
var poly = '';
var polyEnd = '';
var atmloc = [];

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
	new getAllPasar();
}

google.maps.event.addDomListener(window, 'load', initialize);
	var allpasarCallback = function(result){
		if(poly != '') poly.setMap(null);
		if(polyEnd != '') polyEnd.setMap(null);
		if(markers != undefined){
			markers.setMapOnAll(null);
			console.log("ikii");
		}
		markers = new marker(map);
		for(var a=0;a<result.result.length;a++){
			var loc = JSON.parse('{"lat": '+result.result[a].lat_pasar+', "lng": '+result.result[a].lng_pasar+'}');
			markers.addMarker(loc, result.result[a].nama_pasar, "", result.result[a].id_pasar);
		}
		markers.setMapOnAll(map);
	}

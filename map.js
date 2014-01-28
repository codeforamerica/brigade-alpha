$(function(){
  $('#map').css("height", ($(window).height() - 75));
  var map = L.mapbox.map('map', 'codeforamerica.map-hhckoiuj', 
  	{
  		scrollWheelZoom:false
  	}
  	).setView([35, -100], 3)
  ;
  map.zoomControl.setPosition('bottomright');

  var lat_lngs = [];
  $.getJSON("http://brigade.codeforamerica.org/brigades.json", function(data){
  	for(d in data){
		var brigade = data[d]
		if(brigade.location){
			if(brigade.location.latitude && brigade.location.longitude){
				var lat = brigade.location.latitude;
				var lng = brigade.location.longitude;
				lat_lngs.push([lat,lng])
				marker = L.marker(new L.LatLng(lat,lng), {
				  icon: L.mapbox.marker.icon({'marker-symbol': 'town-hall'})
				})
				var html = "<a href="+brigade.group_url+"><button>Visit "+brigade.name+"</button></a>";
				// html += "<button id='join'>Join "+brigade.name+"</button>";
				$("#brigade_id").html("<option value="+brigade.id+"></option>");
				html += $("#signin-form").html();
				marker.bindPopup(html);
				map.addLayer(marker);
			}
		} 
	}

	// Get rid of the prototype form after its been copied to each popup.
	$("#signin-form").remove();

	// Hide join button when clicked, show form
	// $("#join").click(function(){
	// 	$("#new_user").html();
	// 	$("#join").hide();
	// })

  });
});
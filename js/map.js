$(function(){

  $('#map').css("height", ($(window).height() - 150));

  var map = L.mapbox.map('map', 'codeforamerica.map-hhckoiuj', 
  	{
  		scrollWheelZoom:false
  	}
  	).setView([35, -100], 3);

  map.zoomControl.setPosition('bottomright');

  cfapi = "http://civic-tech-movement.codeforamerica.org/api/organizations"
  // cfapi = "http://localhost:5000/api/organizations"

  var lat_lngs = [];
  $.getJSON(cfapi, function(data){
  	data = data.objects;
  	for(d in data){
		var brigade = data[d]
		console.log(brigade);
		if (brigade.type == "Brigade"){
			if (brigade.latitude && brigade.longitude){
				var lat = brigade.latitude,
						lng = brigade.longitude;

				lat_lngs.push([lat,lng])
				marker = L.marker(new L.LatLng(lat,lng), {
			  	icon: L.mapbox.marker.icon({'marker-symbol': 'town-hall'})
				});

				// go through each item and create an appropriate overlay
				var html = "<a href="+brigade.website+"><button>"+brigade.name+"</button></a><input type='hidden' value='"+brigade.id+"' />";
				html += $(".brigade-pin-overlay").html();
				marker.bindPopup(html);
				createOverlay(brigade.id, brigade.name);
				map.addLayer(marker);
			
			};
		}
			marker.on('click',function(e) {
				showOverlay($(".leaflet-container input").val());
			});
		} 
  }).done( function() {
	// This uses the HTML5 geolocation API, which is available on
	// most mobile browsers and modern browsers, but not in Internet Explorer
	//
	// See this chart of compatibility for details:
	// http://caniuse.com/#feat=geolocation
	if (!navigator.geolocation) {
	    console.log('geolocation is not available');
	} else {
		map.locate({setView:true, maxZoom:4});
	}
  });

	createOverlay = function(id, name){

		var content = $(".brigade-overlay-content").html();
		var overlayHTML = "<div class='"+id+" brigade-overlay slab-red'><a class='close-overlay' href='#'>Close</a><div class='badge-heading'><h2>"+name+"</h2></div>"+content+"</div>";
		$("body").append(overlayHTML);
		$(".close-overlay").on("click", function(){ hideOverlay(); return false; })

	};

	showOverlay = function(id){
		hideOverlay();
		$("."+id).toggle();
	};

	hideOverlay = function(){
		$(".brigade-overlay").css("display", "none");
	};

});
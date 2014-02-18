$(function(){


  $('#map').css("height", ($(window).height() - 150));

  var map = L.mapbox.map('map', 'codeforamerica.map-hhckoiuj', 
  	{
  		scrollWheelZoom:false
  	}
  	).setView([35, -100], 3);

  map.zoomControl.setPosition('bottomright');


  var lat_lngs = [];
  $.getJSON("http://brigade.codeforamerica.org/brigades.json", function(data){
  	for(d in data){
			var brigade = data[d]
			if(brigade.location){
				if(brigade.location.latitude && brigade.location.longitude){
					var lat = brigade.location.latitude,
							lng = brigade.location.longitude;

					lat_lngs.push([lat,lng])
					marker = L.marker(new L.LatLng(lat,lng), {
				  	icon: L.mapbox.marker.icon({'marker-symbol': 'town-hall'})
					});
					
					/*var html = "<a href="+brigade.group_url+"><button>Visit "+brigade.name+"</button></a>";
					// html += "<button class='join'>Join "+brigade.name+"</button>";
					$("#brigade_id").html("<option value="+brigade.id+"></option>");
					html += $("#brigade-overlay").html();
					//marker.bindPopup(html);*/

					// go through each item and create an appropriate overlay
					var html = "<a href="+brigade.group_url+"><button>"+brigade.name+"</button></a><input type='hidden' value='"+brigade.id+"' />";
					html += $(".brigade-pin-overlay").html();
					marker.bindPopup(html);
					createOverlay(brigade.id, brigade.name);
					map.addLayer(marker);
				
			};

			marker.on('click',function(e) {
				showOverlay($(".leaflet-container input").val());
			});
		} 

	}

	
	

	// Hide join button when clicked, show form
	// $("#join").click(function(){
	// 	$("#new_user").html();
	// 	$("#join").hide();
	// })

  });

/*
	init = function(){
		setup();
	};

	setup = function(){
		$(".brigade-overlay").css("display", "none");
	};

	cleanup = function(){
		// Get rid of the prototype form after its been copied to each popup.
		$("#signin-form").remove();
	};
*/
	createOverlay = function(id, name){

		var content = $(".brigade-overlay-content").html();
		var overlayHTML = "<div class='"+id+" brigade-overlay slab-red'><a class='close-overlay' href='#'>Close</a><div class='badge-heading'><h2>"+name+"</h2></div>"+content+"</div>";
		$("body").append(overlayHTML);

	};

	showOverlay = function(id){
		$(".brigade-overlay").css("display", "none");
		$("."+id).toggle();
	};

});
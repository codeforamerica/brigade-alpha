$(function(){

  // Leave some room for the header and footer
  $('#map').css("height", ($(window).height() - 180));
  $('#overlay').css("height", ($(window).height() - 243));

  var map = L.mapbox.map('map', 'codeforamerica.map-hhckoiuj', 
    {
      scrollWheelZoom:false
    }
    ).setView([35, -100], 3);

  map.zoomControl.setPosition('bottomright');

  cfapi = "http://civic-tech-movement.codeforamerica.org/api/organizations"
  // cfapi = "http://localhost:5000/api/organizations"


  // Custom marker type with space for Brigade data
  var BrigadeMarker = L.Marker.extend({
    options: {
      brigade : {}
    }
  });

  $.getJSON(cfapi, function(data){
    var brigades = data.objects;

    $.each(brigades, function(i, brigade){
      console.log(brigade);

      if (brigade.type == "Brigade"){
        if (brigade.latitude && brigade.longitude){
          var lat = brigade.latitude, lng = brigade.longitude;

          var marker = new BrigadeMarker(new L.LatLng(lat,lng), {
            icon: L.mapbox.marker.icon({'marker-symbol': 'town-hall'}),
            brigade: brigade // Add Brigade data to marker
          });

          map.addLayer(marker);

          // On click, show the Brigade data on the overlay
          marker.on('click',function(e) {
            updateOverlay(e.target.options.brigade);
          });

        }
      }
    });
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

  function updateOverlay(brigade){
    $("#brigade-name").text(brigade.name);
    $("#brigade-url").text(brigade.website).attr("href",brigade.website).show();
    $("#program-info").hide();

    for (list in [brigade.stories, brigade.projects, brigade.events]){
      console.log(list);
    }

    if (brigade.stories) {
      $("#stories").show();
      $.each(brigade.stories, function(i, story){
        html = "<li><a href="+story.link+">"+story.title+"</li>"
        $("#stories ul").append(html);
      })
    } else {
      $("#stories").hide();
    }

    if (brigade.projects) {
      $("#projects").show();
      $.each(brigade.projects, function(i, project){
        html = "<li><a href="+project.link+">"+project.title+"</li>"
        $("#projects ul").append(html);
      })
    } else {
      $("#projects").hide();
    }

    if (brigade.events) {
      $("#events").show();
      $.each(brigade.events, function(i, event){
        html = "<li><a href="+event.link+">"+event.title+"</li>"
        $("#events ul").append(html);
      })
    } else {
      $("#events").hide();
    }
    
  }

});
$(function(){

  // Leave some room for the header and footer
  $('#map').css("height", ($(window).height() - 200));
  $('#overlay').css("height", ($(window).height() - 264));

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

      if (brigade.type == "Brigade"){
        if (brigade.latitude && brigade.longitude){
          var lat = brigade.latitude, lng = brigade.longitude;

          var marker = new BrigadeMarker(new L.LatLng(lat,lng), {
            icon: L.mapbox.marker.icon({'marker-symbol': 'town-hall'}),
            title: brigade.name,
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
    $("#overlay-reset").show();
    $("#brigade-name").text(brigade.name);
    $("#brigade-url").text(brigade.website).attr("href",brigade.website).show();
    $("#program-info").hide();
    $("#join-form").hide();

    // Show two stories
    if (brigade.stories.length != 0) {
      $("#stories ul").empty();
      for (var i = 0; i < 2; i++) {
        story = brigade.stories[i];
        html = "<li><a href='"+story.link+"'>"+story.title+"</a></li>"
        $("#stories ul").append(html);
      }
      $("#stories").show();
    } else {
      $("#stories").hide();
    }

    // Show two events
    if (brigade.events){
      if (brigade.events.length != 0) {
        $("#events ul").empty();
        for (var i = 0; i < 2; i++) {
          event = brigade.events[i];
          html = "<li><a href="+event.link+">"+event.name+"</li>"
          $("#events ul").append(html);
        }
        $("#events").show();
      } else {
        $("#events").hide();
      }
    }

    // Show two projects
    if (brigade.projects.length != 0) {
      $("#projects ul").empty();
      for (var i = 0; i < 3; i++) {
        project = brigade.projects[i];
        html = "<li><a href="+project.link_url+">"+project.name+"</a>";
        html += "<p>"+project.description+"</p></li>";
        $("#projects ul").append(html);
      };
      $("#projects").show();
    } else {
      $("#projects").hide();
    }
    
  }

  // Reset overlay
  map.on('click', function(e){
    resetOverlay();
  })

  function resetOverlay(){
    $("#overlay-reset").hide();
    $("#brigade-name").text("The Code for America Brigade");
    $("#brigade-url").hide();
    $("#program-info").show();
    $("#stories").hide();
    $("#projects").hide();
    $("#events").hide();
    $("#join-form").show();
  }

});
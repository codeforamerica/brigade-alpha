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
  
  function brigadePageURL(brigade)
  {
    return document.location.brigade_base_url+'/index/'+escape(brigade.name);
  }
  
  function brigadeAjaxURL(brigade)
  {
    return document.location.brigade_base_url+'/brigade/'+escape(brigade.name);
  }
  
  function indexPageURL()
  {
    return document.location.brigade_base_url+'/';
  }
  
  function indexAjaxURL()
  {
    return document.location.brigade_base_url+'/index-sidebar';
  }
  
  function iWantToGoToThere(url)
  {
    if(history.pushState)
    {
        history.pushState({}, '', url);
    }
  }
  
  function updateOverlay(brigade){
  
    $.ajax(brigadeAjaxURL(brigade), {
        success: function(html)
        {
            $('#overlay').html(html);
            iWantToGoToThere(brigadePageURL(brigade));
        }
        });
  }

  // Reset overlay
  map.on('click', function(e){
    resetOverlay();
  })

  function resetOverlay(){
  
    $.ajax(indexAjaxURL(), {
        success: function(html)
        {
            $('#overlay').html(html);
            iWantToGoToThere(indexPageURL());
        }
        });
  }

});
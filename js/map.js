$(function(){

  // Leave some room for the header and footer
  $('#map').css("height", ($(window).height() - 200));
  $('#overlay').css("height", ($(window).height() - 264));

  var map = L.mapbox.map('map', 'codeforamerica.map-hhckoiuj', 
    {
      scrollWheelZoom:false
    }
    );

  map.zoomControl.setPosition('bottomright');
  formEvents();
  cfapi = "http://civic-tech-movement.codeforamerica.org/api/organizations.geojson"
  // cfapi = "http://localhost:5000/api/organizations"

  // Custom marker type with space for Brigade data
  var BrigadeMarker = L.Marker.extend({
    options: {
      brigade : {}
    }
  });
  
  var geolocate = true, latlon = [35, -100], zoom = 3;
  
  /*
   * Brigade names and locations are in a hidden list called #brigades-list.
   *
   * <li data-lat="37.8044" data-lon="-122.2711">
   *    <a href="Open%20Oakland">Open Oakland</a>
   * </li>
   */
  $('#brigades-list li').each(function(index, _item) {
  
    var item = $(_item),
        active = parseInt(item.data('on')),
        lat = parseFloat(item.data('lat')),
        lon = parseFloat(item.data('lon')),
        anchor = item.find('a'),
        name = anchor.text(),
        href = anchor.attr('href');
        
    var brigade = {name: name, href: href};
    
    var marker = new BrigadeMarker(new L.LatLng(lat, lon), {
      icon: L.mapbox.marker.icon({'marker-symbol': 'town-hall'}),
      title: name,
      brigade: brigade // Add Brigade data to marker
    });
    
    if(active)
    {
        geolocate = false;
        latlon = [lat, lon]
        zoom = 8;
    }

    map.addLayer(marker);

    // On click, show the Brigade data on the overlay
    marker.on('click',function(e) {
      updateOverlay(e.target.options.brigade);
    });

  });
  
  if(geolocate && !navigator.geolocation) {
    // Use the default latlon if the browser won't help.
    console.log('geolocation is not available');
    map.setView(latlon, zoom);

  } else if(geolocate) {
    // This uses the HTML5 geolocation API, which is available on most
    // mobile browsers and modern browsers, but not in Internet Explorer.
    //
    // See this chart of compatibility for details:
    // http://caniuse.com/#feat=geolocation
    map.locate({setView:true, maxZoom:4});
  
  } else {
    map.setView(latlon, zoom);
  }
  
  function brigadePageURL(brigade)
  {
    return brigade.href;
  }
  
  function brigadeAjaxURL(brigade)
  {
    return document.location.brigade_base_url+'/overlay-brigade/'+escape(brigade.name);
  }
  
  function indexPageURL()
  {
    return document.location.brigade_base_url+'/';
  }
  
  function indexAjaxURL()
  {
    return document.location.brigade_base_url+'/overlay-home';
  }
  
  function iWantToGoToThere(url)
  {
    if(history.pushState)
    {
        history.pushState({}, '', url);
    }
  }
  
  function updateOverlay(brigade)
  {
    $('#overlay').html('<a href="#" class="button-prominent button-progress"></a>');
    $('#overlay a').text('Loading ' + brigade.name + '...');
    iWantToGoToThere(brigadePageURL(brigade));

    $.ajax(brigadeAjaxURL(brigade), {
        success: function(html)
        {
            $('#overlay').html(html);
            formEvents();
        }
        });
  }

  // Reset overlay
  map.on('click', function(e){
    resetOverlay();
  })

  function formEvents(){
    $("#brigade-signup-form").css("display", "none");
    $("#join-brigade").on("click", function(){
      $("#item-lists").css("display", "none");
      $("#brigade-signup-form").css("display", "block");
    })
  };

  function resetOverlay()
  {
    $('#overlay').html('<a href="#" class="button-prominent button-progress">Loading...</a>');
    iWantToGoToThere(indexPageURL());

    $.ajax(indexAjaxURL(), {
        success: function(html)
        {
            $('#overlay').html(html);
            formEvents();
        }
        });
  }

});
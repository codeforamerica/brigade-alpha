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

  cfapi = "http://civic-tech-movement.codeforamerica.org/api/organizations.geojson"
  // cfapi = "http://localhost:5000/api/organizations"

  // Custom marker type with space for Brigade data
  var BrigadeMarker = L.Marker.extend({
    options: {
      brigade : {}
    }
  });
  
  /*
   * Brigade names and locations are in a hidden list called #brigades-list.
   *
   * <li data-lat="37.8044" data-lon="-122.2711">
   *    <a href="Open%20Oakland">Open Oakland</a>
   * </li>
   */
  $('#brigades-list li').each(function(index, _item) {
  
    var item = $(_item),
        lat = parseFloat(item.data('lat')),
        lon = parseFloat(item.data('lon')),
        anchor = item.find('a'),
        name = anchor.text(),
        href = anchor.attr('href');
        
    var brigade = {name: name};
    
    var marker = new BrigadeMarker(new L.LatLng(lat, lon), {
      icon: L.mapbox.marker.icon({'marker-symbol': 'town-hall'}),
      title: name,
      brigade: brigade // Add Brigade data to marker
    });

    map.addLayer(marker);

    // On click, show the Brigade data on the overlay
    marker.on('click',function(e) {
      updateOverlay(e.target.options.brigade);
    });

  });
  
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
  
  function brigadePageURL(brigade)
  {
    return document.location.brigade_base_url+'/index.php/'+escape(brigade.name);
  }
  
  function brigadeAjaxURL(brigade)
  {
    return document.location.brigade_base_url+'/brigade.php/'+escape(brigade.name);
  }
  
  function indexPageURL()
  {
    return document.location.brigade_base_url+'/index.php';
  }
  
  function indexAjaxURL()
  {
    return document.location.brigade_base_url+'/index-sidebar.php';
  }
  
  function iWantToGoToThere(url)
  {
    if(history.pushState)
    {
        history.pushState({}, '', url);
    }
  }
  
  function updateOverlay(brigade){
  
    $('#overlay').html('<a href="#" class="button-prominent button-progress"></a>');
    $('#overlay a').text('Loading ' + brigade.name + '...');

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
  
    $('#overlay').html('<a href="#" class="button-prominent button-progress">Loading...</a>');

    $.ajax(indexAjaxURL(), {
        success: function(html)
        {
            $('#overlay').html(html);
            iWantToGoToThere(indexPageURL());
        }
        });
  }

});
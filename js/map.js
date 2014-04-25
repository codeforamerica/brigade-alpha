function showBrigadeSignupForm(button)
{
    document.getElementById('brigade-signup-form').style.display = 'block';
    document.getElementById('brigade-item-lists').style.display = 'none';
    button.style.display = 'none';
}

function brigadeAjaxURL(id)
{
  return document.location.brigade_base_url+'/overlay-brigade/'+escape(id);
}

function indexPageURL(brigade_base_url)
{
  return brigade_base_url+'/';
}

function indexAjaxURL(brigade_base_url)
{
  return brigade_base_url+'/overlay-home';
}

function iWantToGoToThere(url)
{
  if(history.pushState)
  {
      history.pushState({}, '', url);
  }
}

if(window.getComputedStyle(document.getElementById('map')).display == 'none')
{
  // If the map display is none, we are probably starting with
  // a narrow screen. Change the body class name to reflect it.
  document.body.className = document.body.className.replace(/\bunknown-width\b/, ' narrow-screen ');
  
} else {
  // Otherwise, we are probably starting with a wide screen.
  // Change the body class name to reflect it.
  document.body.className = document.body.className.replace(/\bunknown-width\b/, ' wide-screen ');

  // Leave some room for the header and footer
  $('#map').css("height", ($(window).height() - 200));
  $('#overlay').css("height", ($(window).height() - 264));

  var map = L.mapbox.map('map', 'codeforamerica.map-hhckoiuj', 
    {
      scrollWheelZoom:false
    }
    );

  map.zoomControl.setPosition('bottomright');

  cfapi = "http://codeforamerica.org/api/organizations.geojson"
  // cfapi = "http://localhost:5000/api/organizations"

  // Custom marker type with space for Brigade data
  var BrigadeMarker = L.Marker.extend({
    options: {
      brigade : {}
    }
  });
  
  var geolocate = true, latlon = [35, -100], zoom = 3;
  
  /*
   * Brigade names and locations are in a hidden list called #brigades-list-mobile.
   *
   * <li data-lat="37.8044" data-lon="-122.2711">
   *    <a href="Open%20Oakland">Open Oakland</a>
   * </li>
   */
  $('#brigades-list-mobile li.organization').each(function(index, _item) {
  
    var item = $(_item),
        active = parseInt(item.data('on')),
        lat = parseFloat(item.data('lat')),
        lon = parseFloat(item.data('lon')),
        id = item.data('id'),
        anchor = item.find('a'),
        name = item.data('name'),
        href = anchor.attr('href');
        
    var brigade = {
        name: name,
        page_href: href,
        ajax_href: brigadeAjaxURL(id)
        };
    
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
  
  function updateOverlay(brigade)
  {
    $('#overlay').html('<a href="#" class="button-prominent button-progress"></a>');
    $('#overlay a').text('Loading ' + brigade.name + '...');
    iWantToGoToThere(brigade.page_href);

    $.ajax(brigade.ajax_href, {
        success: function(html)
        {
            $('#overlay').html(html);
        }
        });
  }

  // Reset overlay
  map.on('click', function(e) {
    var brigade_base_url = document.location.brigade_base_url;
    resetOverlay(brigade_base_url);
  })

  function resetOverlay(brigade_base_url)
  {
    $('#overlay').html('<a href="#" class="button-prominent button-progress">Loading...</a>');
    iWantToGoToThere(indexPageURL(brigade_base_url));

    $.ajax(indexAjaxURL(brigade_base_url), {
        success: function(html)
        {
            $('#overlay').html(html);
        }
        });
  }
  
}

function showBrigadeSignupForm(button)
{
    document.getElementById('brigade-signup-form').style.display = 'block';
    document.getElementById('brigade-item-lists').style.display = 'none';
    button.style.display = 'none';
}

$(function(){

  $('#map').css("height", ($(window).height() - 89));
  $('#overlay').css("height", ($(window).height() - 139));

  var map = L.mapbox.map('map', 'codeforamerica.map-hhckoiuj',
    {
      scrollWheelZoom:false
    }
    );

  map.zoomControl.setPosition('bottomright');

  var latlon = [27, -85], zoom = 2;

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
        active = parseInt(item.data('on')),
        lat = parseFloat(item.data('lat')),
        lon = parseFloat(item.data('lon')),
        id = item.data('id'),
        anchor = item.find('a'),
        name = anchor.text(),
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
        latlon = [lat, lon]
        zoom = 7;
    }

    map.addLayer(marker);

    // On click, show the Brigade data on the overlay
    marker.on('click',function(e) {
      updateOverlay(e.target.options.brigade);
    });

    map.setView(latlon, zoom);

  });

  function brigadeAjaxURL(id)
  {
    return document.location.brigade_base_url+'/overlay-brigade/'+id;
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

});

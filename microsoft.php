<? include('top.php'); ?>

<section id="msft">
  <div class="layout-semibreve">
    <h1>Hello Microsoft</h1>

    <h2>Here are three easy ways for you to help out with civic tech projects.</h2>

    <div class="badge-heading badge-rocket badge-red">
      <h2>Explore our volunteer civic hacker groups across the country</h2>
      <p>Visit their sites and see what local projects they are working on.</p>

      <div id="msftmap"></div>

      <script>
      var map = L.mapbox.map('msftmap', 'codeforamerica.map-hhckoiuj', { scrollWheelZoom:false});

      $.getJSON('http://codeforamerica.org/api/organizations.geojson', function(response){
        $.each(response.features, function(i, org){
          org.properties.title = org.properties.name;
          org.properties['marker-color'] = '#cf1b41';
          org.properties['marker-symbol'] = 'rocket';
        })
        map.featureLayer.setGeoJSON(response.features);
        map.featureLayer.setStyle({color: 'red'});
      })

      map.featureLayer.on('click', function(e) {
          window.open(e.layer.feature.properties.website);
      });

      map.featureLayer.on('mouseover', function(e) {
          e.layer.openPopup(e.layer.feature.properties.name);
      });
      map.featureLayer.on('mouseout', function(e) {
          e.layer.closePopup();
      });

      </script>

      <style>
        #msftmap {
          height:500px;
        }
      </style>

    </div>

    <div class="badge-heading badge-glasses badge-teal">
      <h2>Get involved in a civic tech project</h2>
      <p>Here are three active projects from our volunteer groups. If one interests you, send them a message to get involved.</p>

      <div id="projects"></div>

      <script>

          $.getJSON('http://codeforamerica.org/api/projects?organization_type=Brigade&per_page=3', function(response){

            projects = response.objects;

            // Tell the story
            $.each(projects, function(i, project){

              html = "<div class='block-gray'>"
              html += "<h3>"+project.name+"</h3>";
              html += "<p>"+project.description+"</p>";
              html += "<p>By: "+project.organization.name+"</p>";
              if (project.link_url) {
                html += "<p><a href="+project.link_url+" class='icon-rocket'>"+project.link_url+"</a></p>";
              }
              if (project.code_url) {
                html += "<p><a href="+project.code_url+" class='icon-github2'>"+project.code_url+"</a></p>";
              }
              html += "</div>"
              html += "<br/>";

              $("#projects").append(html);
            });

          });

      </script>
    </div>

    <div class="badge-heading badge-github badge-blue">
      <h2>Code for America Right Now</h2>
      <p>These are open GitHub Issues
        from across the civic technology movement that have the help wanted label. Powered by the
        <a href="http://codeforamerica.org/geeks/civicissues">Civic Tech Issue Finder</a>. </p>
    </div>
    <iframe id="widget" src="http://codeforamerica.org/geeks/civicissues/widget?org_type=Brigade&number=6" width="100%" height="500px" frameBorder="0" onLoad="resize();"> </iframe>

    <script>
    // Resize iframe to fit content
    function resize() {
      var newheight = document.getElementById("widget").contentWindow.document.body.scrollHeight;
      document.getElementById("widget").height = newheight + "px";
    }
    </script>
  </div>
</section>

<? include('bottom.php'); ?>

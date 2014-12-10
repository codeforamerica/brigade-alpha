<?

    include('top.php');

    $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

?>
<section>

  <div class="layout-semibreve">

    <h1>Projects</h1>
    <form>
      <select id="orgs">
        <option>Choose your weapon</option>
      </select>
    </form>

    <br />

    <div id='projects'>
      <img id="loading" src="http://style.codeforamerica.org/2/style/images/loading-circle.gif">
    </div>

    <script>
    $(document).ready(function() {

        function compare(a,b) {
         if (a.properties.name < b.properties.name)
            return -1;
         if (a.properties.name > b.properties.name)
           return 1;
         return 0;
        }

        $.getJSON('http://codeforamerica.org/api/organizations.geojson', function(response){
          orgs = response.features;
          orgs.sort(compare);
          $.each(orgs, function(i, org){
            id = org.properties.name.replace(/\s+/g, "-");
            alert(id);
            html = "<option value="+id+">";
            html += org.properties.name
            html += "</option>";
            $("#orgs").append(html);
          })
        })

        function showProjects(url) {

          $.getJSON(url, function(response){

            projects = response.objects;

            // Tell the story
            $.each(projects, function(i, project){
              
              html = "<div>"
              html += "<h2>"+project.name+"</h2>";
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

            $("#loading").remove();

          });

        }

        var id = window.location.pathname.split("/").reverse()[0];
        if (id != "projects" && id){

          showProjects('http://codeforamerica.org/api/organizations/'+id+'/projects');

        } else {

          showProjects('http://codeforamerica.org/api/projects');

        }

        $("#orgs").change(function () {
            var id = $( "#orgs option:selected" ).val();
            window.location.href = id
        });

    });
    </script>

  </div>

</section>

<? include('bottom.php') ?>

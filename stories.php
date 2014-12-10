<?

    include('top.php');

    $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

?>
<section>

  <div class="layout-semibreve">

    <h1>Stories</h1>

    <div id='stories'></div>

    <script>
    $(document).ready(function() {

        $.getJSON('http://codeforamerica.org/api/stories', function(response){

          stories = response.objects;

          // Tell the story
          $.each(stories, function(i, story){
            html = "<blockquote>";
            html += "<a href='"+story.link+"'>"+story.title+"</a><br/>";
            html += 'By: '+story.organization.name
            html += "</blockquote><br/>";

            $("#stories").append(html);
          });

        });

    });
    </script>

  </div>

</section>

<? include('bottom.php') ?>

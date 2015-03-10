<?php

    $ctm_api_base = 'http://codeforamerica.org/api';
    // $ctm_api_base = 'http://localhost:5000/api';
    $brigades_url = "{$ctm_api_base}/organizations.geojson";
    $geojson = json_decode(file_get_contents($brigades_url), true);
    // Sort the geojson alphabetically
    function alphabet_sort($a, $b)
      {
        return strcmp($a['properties']['city'], $b['properties']['city']);
      }
    usort($geojson['features'], "alphabet_sort");

    if(!function_exists('h'))
    {
        function h($s)
        {
            return htmlspecialchars($s);
        }
    }

    $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

?>
<ul id="brigades-list" style="display: none">
    <? foreach($geojson['features'] as $feature) {
            if (strpos($feature['properties']['type'], "Brigade") !== false) {
                $id = $feature['id'];
                $p = $feature['properties'];
                if (strpos($feature['properties']['type'], "Official") !== false) {
                  $color = "#aa1c3a";
                } else {
                  $color = "#6D6E71";
                }
                $c = $feature['geometry']['coordinates'];
                $on = ($id == $brigade_slug) ? 1 : 0;
                ?>
                <li data-lat="<?= h($c[1]) ?>" data-lon="<?= h($c[0]) ?>" data-on="<?= h($on) ?>" data-id="<?= $id ?>" data-color="<?= h($color) ?>">
                    <a href="<?= $base_url.'/index/'.$id ?>"><?= h($p['name']) ?></a>
                </li>
                <?
            }

        } ?>
</ul>

<ul class="list-no-bullets layout-breve" id="brigades-list-mobile">

  <h4 id="brigade-info-mobile">The Code for America Brigade program is an international network of people committed
  to using their voices and hands, in collaboration with local governments, to make their cities better.</h4>

  <div id="join-form-mobile">

    <button id="show-form-mobile">Want to get connected?</button>

    <form accept-charset="UTF-8" id="new_user_mobile" style="display: none;" action="<?= $base_url ?>/signup" method="POST">
      <ul class="list-form">
        <li class="form-field">
            <label for="user_full_name">Full name</label>
            <input id="user_full_name_mobile" name="name" type="text" placeholder="Ben Franklin" required>
        </li>
        <li class="form-field">
            <label for="user_email">Email</label>
            <input id="user_email_mobile" name="email" type="text" placeholder="benfranklin@codeforamerica.org" required>
        </li>
        <li class="form-field">
            <label for="user_work_in_geovernment_mobile"><input id="user_work_in_government" name="work_in_government" type="checkbox" value="1">I work in government</label>
        </li>
        <li class="form-field">
            <label>
              <input id="user_willing_to_organize_true" name="source" type="checkbox" value="organizer" />
              I want to lead a Brigade in my community!
            </label>
        </li>
        <select id="user_location_id_mobile" name="user[location_id]" style="display:none;">
          <option value></option>
        </select>

      </ul>
      <input id="user_human_check_mobile" name="user[human_check]" size="50" type="hidden">
      <input name="utf8" type="hidden" value="✓">
      <button id="join-button-mobile" style="display: none;">Join</button>
    </form>
  </div>

  <script>
    $("#show-form-mobile").click(function(e){
      $("#new_user_mobile").show();
      $("#join-button-mobile").show();
      $("#show-form").hide();
    })
  </script>

  <br />

  <? foreach($geojson['features'] as $feature) {
          if (strpos($feature['properties']['type'], "Brigade") !== false) {
              $p = $feature['properties'];
              ?>
              <li class="billboard">
                  <a href="<?= h($p['website']) ?>"><?= h($p['name']) ?></a>
                  <strong class="billboard-label"><?= h($p['city']) ?></strong>
              </li>
              <?
          }

      } ?>

</ul>

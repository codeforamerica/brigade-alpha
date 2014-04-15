<?php

    $ctm_api_base = 'http://codeforamerica.org/api';
    $brigades_url = "{$ctm_api_base}/organizations.geojson";
    $geojson = json_decode(file_get_contents($brigades_url), true);
    
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
            if ($feature['properties']['type'] == "Brigade") {
                $id = $feature['id'];
                $p = $feature['properties'];
                $c = $feature['geometry']['coordinates'];
                $on = ($id == $brigade_slug) ? 1 : 0;
                ?>
                <li data-lat="<?= h($c[1]) ?>" data-lon="<?= h($c[0]) ?>" data-on="<?= h($on) ?>" data-id="<?= h($id) ?>">
                    <a href="<?= $base_url.'/index/'.rawurlencode($id) ?>"><?= h($p['name']) ?></a>
                </li>
                <?
            }

        } ?>
</ul>

<ul class="list-no-bullets layout-breve" id="brigades-list-mobile">

  <h4>The Code for America Brigade program is an international network of people committed
  to using their voices and hands, in collaboration with local governments, to make their cities better.</h4>

  <? foreach($geojson['features'] as $feature) {
          if ($feature['properties']['type'] == "Brigade") {
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

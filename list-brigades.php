<?php

    $ctm_api_base = 'http://civic-tech-movement.codeforamerica.org/api';
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
        $p = $feature['properties'];
        $c = $feature['geometry']['coordinates'];
        $on = ($p['name'] == $brigade_name) ? 1 : 0;
        ?>
        <li data-lat="<?= h($c[1]) ?>" data-lon="<?= h($c[0]) ?>" data-on="<?= h($on) ?>">
            <a href="<?= $base_url.'/brigade.php/'.rawurlencode($p['name']) ?>"><?= h($p['name']) ?></a>
        </li>
    <? } ?>
</ul>

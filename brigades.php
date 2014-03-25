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
    <? foreach($geojson['features'] as $feature) { ?>
        <li data-lat="<?= h($feature['geometry']['coordinates'][1]) ?>"
            data-lon="<?= h($feature['geometry']['coordinates'][0]) ?>" >
            <a href="<?= $base_url.'/brigade.php/'.rawurlencode($feature['properties']['name']) ?>"><?= h($feature['properties']['name']) ?></a>
        </li>
    <? } ?>
</ul>

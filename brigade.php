<?php

    $ctm_api_base = 'http://civic-tech-movement.codeforamerica.org/api';
    $brigade_name = rawurlencode(ltrim($_SERVER['PATH_INFO'], '/'));
    $brigade_url = "{$ctm_api_base}/organizations/{$brigade_name}";
    $info = json_decode(file_get_contents($brigade_url), true);
    
    header('Content-Type: text/html');
    
    function h($s) 
    {
        return htmlspecialchars($s);
    }

?>
<div id="brigade-info">
	<h2 id="brigade-name"><?= h($info['name']); ?></h2>
	<p>
        <a id="brigade-url" href="<?= h($info['website']); ?>" style="display: inline;"><?= h($info['website']); ?></a>
	</p>
	<!--
	<p id="program-info">
		The Brigade program helps local volunteer groups partner with government in an effort to enhance their communities. Brigades hold regular hack nights, events, advocate for open data, and deploy apps.
	</p>
	-->
    <? if($info['stories']) { ?>
        <div id="stories">
            <b>Recent Stories</b>
            <ul>
                <? foreach(array_slice($info['stories'], 0, 2) as $s) { ?>
                    <li><a href="<?= h($s['link']) ?>"><?= h($s['title']) ?></a></li>
                <? } ?>
            </ul>
        </div>
    <? } ?>
    <? if($info['stories']) { ?>
        <div id="events">
            <b>Events</b>
            <ul>
                <? foreach(array_slice($info['events'], 0, 2) as $e) { ?>
                    <li><a href="<?= h($e['event_url']) ?>"><?= h($e['name']) ?></a></li>
                <? } ?>
            </ul>
        </div>
    <? } ?>
    <? if($info['stories']) { ?>
        <div id="projects">
            <b>Recent Projects</b>
            <ul>
                <? foreach(array_slice($info['projects'], 0, 2) as $p) { ?>
                    <li>
                        <a href="<?= h($p['link_url']) ?>"><?= h($p['name']) ?></a>
                        <br><?= h($p['description']) ?>
                    </li>
                <? } ?>
            </ul>
        </div>
    <? } ?>
</div>

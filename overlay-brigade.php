<?php

    $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    
    date_default_timezone_set('UTC');

    if(empty($brigade_slug))
    {
        $brigade_slug = ltrim($_SERVER['PATH_INFO'], '/');
    }

    $ctm_api_base = 'http://codeforamerica.org/api';
    $brigade_path = rawurlencode($brigade_slug);
    $brigade_url = "{$ctm_api_base}/organizations/{$brigade_path}";
    $info = json_decode(file_get_contents($brigade_url), true);

    if(!function_exists('h'))
    {
        function h($s)
        {
            return htmlspecialchars($s);
        }
    }

?>
<div id="brigade-info">
    <a class="button" id="join-brigade" href="#join">Join</a>
	<h2 id="brigade-name"><?= h($info['name']); ?></h2>
	<p>
        <a id="brigade-url" href="<?= h($info['website']); ?>" style="display: inline;"><?= h($info['website']); ?></a>
	</p>

    <!--
	<p id="program-info">
		The Brigade program helps local volunteer groups partner with government in an effort to enhance their communities. Brigades hold regular hack nights, events, advocate for open data, and deploy apps.
	</p>
	-->
	<div id="item-lists">
        <? if($info['current_stories']) { ?>
            <h5>Current Stories</h4>
            <ul class="list-no-bullets list-icons">
                <? foreach($info['current_stories'] as $s) { ?>
                    <li class="icon-bullhorn"><a href="<?= h($s['link']) ?>"><?= h($s['title']) ?></a></li>
                <? } ?>
            </ul>
        <? } ?>
        <? if($info['current_events']) { ?>
            <h5>Current Events</h5>
            <ul class="list-no-bullets list-icons">
                <? foreach($info['current_events'] as $e) { ?>
                    <li class="icon-calendar">
                        <a href="<?= h($e['event_url']) ?>"><?= h($e['name']) ?></a>
                        <br><? $dt = new DateTime($e['start_time']); echo $dt->format('D, M j Y g:ia <!--O-->') ?>
                    </li>
                <? } ?>
            </ul>
        <? } ?>
        <? if($info['current_projects']) { ?>
            <h5>Current Projects</h5>
            <ul class="list-no-bullets list-icons">
                <? foreach($info['current_projects'] as $p) { ?>
                    <li class="icon-star">
                        <a href="<?= h($p['link_url'] ? $p['link_url'] : $p['code_url']) ?>"><?= h($p['name']) ?></a>
                        <br><?= h($p['description']) ?>
                    </li>
                <? } ?>
            </ul>
        <? } ?>
    </div>
    <div id="brigade-signup-form">
        <form id="new_user" novalidate="novalidate" action="<?= $base_url ?>/signup" method="POST">
            <ul class="list-form">
                <li class="form-field">
                    <label for="user_full_name">Your full name</label>
                        <input id="user_full_name" class="input" type="text" name="name" placeholder="Ben Franklin">
                    </li>
                    
                    <li class="form-field">
                        <label for="user_email">Your email</label>
                        <input id="user_email" class="input" type="email" name="email" placeholder="benfranklin@codeforamerica.org" />
                    </li>
            <label for="user_work_in_government"><input class="boolean optional" id="user_work_in_government" name="work_in_government" type="checkbox" value="1">I work in government</label>
            <select id="user_location_id" name="user[location_id]" style="display:none;">
              <option value></option>
            </select>
            <input type="hidden" name="brigade_url" value="<?= h($brigade_url) ?>" />
        </form>
        <button id="button">Join</button>
    </div>
</div>

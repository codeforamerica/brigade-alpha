<?php

    if(empty($brigade_name))
    {
        $brigade_name = ltrim($_SERVER['PATH_INFO'], '/');
    }

    $ctm_api_base = 'http://civic-tech-movement.codeforamerica.org/api';
    $brigade_path = rawurlencode($brigade_name);
    $brigade_url = "{$ctm_api_base}/organizations/{$brigade_path}";
    $info = json_decode(file_get_contents($brigade_url), true);
    
    //
    // We're looking for numeric IDs from the old site for the Join form.
    // To do: don't do this.
    //
    $old_brigade_id = -1;
    $old_brigades_url = 'http://brigade.codeforamerica.org/brigades.json';
    $old_brigades = json_decode(file_get_contents($old_brigades_url), true);
    
    foreach($old_brigades as $old)
    {
        if($old['name'] == $info['name'])
            $old_brigade_id = $old['id'];
    }

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
    <? if($info['stories']) { ?>
        <div id="stories">
            <b>Recent Stories</b>
            <ul>
                <? foreach(array_slice($info['stories'], 0, 2) as $s) { ?>
                    <li class="icon-bullhorn"><a href="<?= h($s['link']) ?>"><?= h($s['title']) ?></a></li>
                <? } ?>
            </ul>
        </div>
    <? } ?>
    <? if($info['events']) { ?>
        <div id="events">
            <b>Events</b>
            <ul>
                <? foreach(array_slice($info['events'], 0, 2) as $e) { ?>
                    <li class="icon-calendar"><a href="<?= h($e['event_url']) ?>"><?= h($e['name']) ?></a></li>
                <? } ?>
            </ul>
        </div>
    <? } ?>
    <? if($info['projects']) { ?>
        <div id="projects">
            <b>Recent Projects</b>
            <ul>
                <? foreach(array_slice($info['projects'], 0, 2) as $p) { ?>
                    <li class="icon-star">
                        <a href="<?= h($p['link_url']) ?>"><?= h($p['name']) ?></a>
                        <br><?= h($p['description']) ?>
                    </li>
                <? } ?>
            </ul>
        </div>
    <? } ?>
    <div id="brigade-signup-form">
        <form action="/members">
            <ul class="list-form">
                <li class="form-field">
                    <label for="user_full_name">Your full name</label>
                        <input id="user_full_name" class="input" type="text" name="user[full_name]" placeholder="Mike Migurski">
                    </li>
                    
                    <li class="form-field">
                        <label for="user_email">Your email</label>
                        <input id="user_email" class="input" type="email" name="user[email]" placeholder="your@email.com" />
                    </li>
            <label class="boolean optional checkbox checkbox" for="user_work_in_government"><input class="boolean optional" id="user_work_in_government" name="user[work_in_government]" type="checkbox" value="1">I work in government</label>
            <input type="hidden" id="<?= h($old_brigade_id) ?>" />
            <button href="#" class="button" type="submit" value="Join now" />
        </form>
    </div>
</div>


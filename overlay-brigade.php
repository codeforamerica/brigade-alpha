<?php

    date_default_timezone_set('America/Los_Angeles');

    if(empty($brigade_slug))
    {
        $brigade_slug = ltrim($_SERVER['PATH_INFO'], '/');
    }

    $ctm_api_base = 'http://civic-tech-movement.codeforamerica.org/api';
    $brigade_path = rawurlencode($brigade_slug);
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
	<div id="item-lists">
        <? if($info['recent_stories']) { ?>
            <h5>Recent Stories</h4>
            <ul class="list-no-bullets list-icons">
                <? foreach($info['recent_stories'] as $s) { ?>
                    <li class="icon-bullhorn"><a href="<?= h($s['link']) ?>"><?= h($s['title']) ?></a></li>
                <? } ?>
            </ul>
        <? } ?>
        <? if($info['recent_events']) { ?>
            <h5>Events</h5>
            <ul class="list-no-bullets list-icons">
                <? foreach($info['recent_events'] as $e) { ?>
                    <li class="icon-calendar">
                        <a href="<?= h($e['event_url']) ?>"><?= h($e['name']) ?></a>
                        <br><?= h(date('D, M j Y g:ia T', strtotime($e['start_time']))) ?>
                    </li>
                <? } ?>
            </ul>
        <? } ?>
        <? if($info['recent_projects']) { ?>
            <h5>Recent Projects</h5>
            <ul class="list-no-bullets list-icons">
                <? foreach($info['recent_projects'] as $p) { ?>
                    <li class="icon-star">
                        <a href="<?= h($p['link_url']) ?>"><?= h($p['name']) ?></a>
                        <br><?= h($p['description']) ?>
                    </li>
                <? } ?>
            </ul>
        <? } ?>
    </div>
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
            <button class="button" type="submit">Join now</button>
        </form>
    </div>
</div>


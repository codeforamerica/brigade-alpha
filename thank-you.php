<?php

    //
    // What kind of request is this?
    //
    $is_specific_brigade = ($_GET['source'] == 'brigade' && $_GET['brigade_url']) ? true : false;
    $is_organizer = (!$is_specific_brigade && $_GET['source'] == 'organizer') ? true : false;
    $is_generic = (!$is_specific_brigade && !$is_organizer) ? true : false;

    //
    // Get information about the selected brigade, if there is one.
    //
    if($is_specific_brigade) {
        $brigade_info = json_decode(file_get_contents($_GET['brigade_url']), true);
    
    } else {
        $brigade_info = null;
    }

    include('top.php');
    $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

?>

<div class="layout-semibreve">

<? if($is_specific_brigade) { ?>

  <div id="brigade_text">
    <p><b>Thanks for signing up for <?= $brigade_info['name'] ?>.</b></p>
    <p><a href="<?= $brigade_info['events_url'] ?>"><?= $brigade_info['website'] ?></a></p>
    <p>You should join <?= $brigade_info['name'] ?>’s Meetup and check out their upcoming events:</p>
    <p><a href="<?= $brigade_info['events_url'] ?>"><?= $brigade_info['events_url'] ?></a></p>
    <p>Thanks again and see you soon.</p>
    <br>
    <p><i>Brielle Plump - Communities Coordinator</i></p>
    <p><a href='mailto:brielle@codeforamerica.org'>brielle@codeforamerica.org</a></p>
  </div>

<? } elseif($is_organizer) { ?>

  <div id="organizer_text">
    <p><b>Thanks for signing up to organize in your community.</b></p>
    <p>Currently, we are hosting a Brigade Organizers hangout outlining your next steps. We hope you will join.</p>

   <p>Wednesday, September 17th, from 10:30 AM to 11:30 AM PDT <a href='
https://www.eventbrite.com/e/september-17-2014-how-to-start-a-code-for-america-brigade-530pm-pst-tickets-12153213589'>RSVP</a></p>
    <p>If you are writing us from abroad and can't make this time please contact us.</p>
    <p>In the meantime, we have put together some materials for you to start looking through.</p>
    <p><a href='http://codeforamerica.org/brigade/tools'>http://codeforamerica.org/brigade/tools</a></p>
    <p>Thanks again and see you soon.</p>
    <br>
    <p><i>Brielle Plump - Communities Coordinator</i></p>
    <p><a href='mailto:brielle@codeforamerica.org'>brielle@codeforamerica.org</a></p>
  </div>

<? } else { ?>

  <div id="no_brigade_text">
    <p><b>Thanks for your interest in a Code for America Brigade in your community.</b></p>
    <p>In the meantime, we’ll keep in touch about opportunities to participate in activities at the national level.</p>
    <p>Remember, if you change your mind, you can always come back to sign up to be an organizer and take a more proactive role.</p>
    <p>Good luck and we'll be in touch.</p>
    <br>
    <p><i>Brielle Plump - Communities Coordinator</i></p>
    <p><a href='mailto:brielle@codeforamerica.org'>brielle@codeforamerica.org</a></p>
  </div>

<? } ?>

</div>

<? include('bottom.php') ?>

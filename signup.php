<?php

    //
    // What kind of request is this?
    //
    $is_specific_brigade = ($_POST['source'] == 'brigade' && $_POST['brigade_url']) ? true : false;
    $is_organizer = (!$is_specific_brigade && $_POST['source'] == 'organizer') ? true : false;
    $is_generic = (!$is_specific_brigade && !$is_organizer) ? true : false;

    //
    // Get information about the selected brigade, if there is one.
    //
    if($is_specific_brigade) {
        $brigade_info = json_decode(file_get_contents($_POST['brigade_url']), true);
    
    } else {
        $brigade_info = null;
    }

    //
    // Construct a POST request to the old Brigade site.
    //
    $posted = array(
        // Source is one of "organizer", "brigade", or "no_brigade".
        'source' => ($_POST['source'] ? $_POST['source'] : 'no_brigade'),

        // Brigade ID is the numeric identifier for the old site.
        'brigade_id' => $_POST['brigade_id'],

        // User information.
        'user' => array(
            'email' => $_POST['user']['email'],
            'full_name' => $_POST['user']['full_name'],
            'location_id' => $_POST['user']['location_id'],
            'work_in_government' => $_POST['user']['work_in_government']
            )
        );

    //
    // Send POST request to the old Brigade site.
    //
    $opts = array('http' =>
                  array(
                      'method'  => 'POST',
                      'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
                      'content' => http_build_query($posted),
                      'timeout' => 5
                      )
                  );
    
    $context  = stream_context_create($opts);
    $url = 'http://old-brigade.codeforamerica.org/members';
    $response = file_get_contents($url, false, $context, -1, 40000);
    
    /*
    header('Content-Type: text/plain');
    print_r(compact('is_specific_brigade', 'is_organizer' , 'is_generic'));
    echo "Got this:\n";
    print_r($_POST);
    echo "Posted to old-brigade:\n";
    print_r($posted);
    */

?>

<?

    include('_layouts/top.php');
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
    <p><i>Brigade Support Team</i></p>
    <p><a href='mailto:brigade-info@codeforamerica.org'>brigade-info@codeforamerica.org</a></p>
  </div>

<? } elseif($is_organizer) { ?>

  <div id="organizer_text">
    <p><b>Thanks for signing up to organize in your community.</b></p>
    <p>Currently, we are hosting a Brigade Organizers hangout outlining your next steps. We hope you will join.</p>
    <p>Tuesday, May 6th, from 5:00 PM to 6:00 PM PDT <a href='https://www.eventbrite.com/e/code-for-america-brigade-leaders-orientation-may-2014-tickets-11305730745'>RSVP</a>
    <p>If you are writing us from abroad and can't make this time please contact our International Programs Manager at <a href="mailto:lynn@codeforamerica.org">lynn@codeforamerica.org</a>.</p>
    <p>In the meantime, we have put together some materials for you to start looking through.</p>
    <p><a href='http://codeforamerica.org/brigade/tools'>http://codeforamerica.org/brigade/tools</a></p>
    <p>Thanks again and see you soon.</p>
    <br>
    <p><i>Brigade Support Team</i></p>
    <p><a href='mailto:brigade-info@codeforamerica.org'>brigade-info@codeforamerica.org</a></p>
  </div>

<? } else { ?>

  <div id="no_brigade_text">
    <p><b>Thanks for your interest in a Code for America Brigade in your community.</b></p>
    <p>In the meantime, we’ll keep in touch about opportunities to participate in activities at the national level.</p>
    <p>Remember, if you change your mind, you can always come back to sign up to be an organizer and take a more proactive role.</p>
    <p>Good luck and we'll be in touch.</p>
    <br>
    <p><i>Brigade Support Team</i></p>
    <p><a href='mailto:brigade-info@codeforamerica.org'>brigade-info@codeforamerica.org</a></p>
  </div>

<? } ?>

</div>

<? include('_layouts/bottom.php') ?>

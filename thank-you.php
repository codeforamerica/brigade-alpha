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
    <p>Thank you for signing up to start a Brigade! We’re excited to help you organize in your community.</p>

    <p>Code for America Brigades organize through the four Ps: people, plans, partnerships, and participation. </p>

    <p>What to do next</p>

    <p>Your first step in starting a Brigade is to get your people together! This includes:</p>
    <ul>
        <li>Organizing a <a href="https://docs.google.com/a/codeforamerica.org/document/d/1oEB1CuzCHldxP_bzcvmcrmK0yAE1BzV2AGhtwtYKZVY/edit">core leadership team</a></li>
        <li>Putting up a website that includes a <a href="https://www.google.com/url?q=https%3A%2F%2Fgithub.com%2Fcodeforamerica%2Fcodeofconduct&sa=D&sntz=1&usg=AFQjCNHLV1eOOQEJLnypprXD_lXHMlg58g">Code of Conduct</a></li>
        <li>Hosting three consistent <a href="https://docs.google.com/a/codeforamerica.org/document/d/1ukivPQNeIH2GcJHcZ50yjzh1uQj70FlilFQcUKOH49k/edit">hack nights</a></li>
    </ul>
    <p>
    Once you've done that, we will invite you to participate in the Brigade Network channels where you can connect with Brigades around the world to learn and to share your experiences with them.
    </p>

    <p>Want access to funding and additional resources?</p>
    <ul>
        <li>Writing a strategic plan that maps to the Code for America Principles</li>
        <li>Building partnerships with community groups and local government</li>
    </ul>


    <p>If you are joining from outside the United States, you can participate in the Brigade network, too. Find out more at <a href="code-for-all.github.io/codeforall.org">codeforall.org</a>.</p>

    <p>Questions? Hit us up at brigade-info@codeforamerica.org</p>

    <p>Thank you for volunteering to make your community stronger,
    Hannah, Brielle, Preston, Andrew, and Catherine
    Code for America Communities Team</p>


<? } else { ?>

  <div id="no_brigade_text">
    <p><b>Thanks for your interest in the Code for America Brigade community.</b></p>
    <p>We will add you to our mailing list so you can keep stay up to date with both local opportunities and national events.</p>
    <p>If you want to reconsider leading a Brigade in your city,  
    <p><a href='https://www.youtube.com/watch?v=f1oBpGQbdmg'>Click here to view the "How to start a Brigade" video.</a></p>
    <p>Good luck and we'll be in touch.</p>
    <br>
    <p><i>Brielle Plump - Communities Coordinator</i></p>
    <p><a href='mailto:brielle@codeforamerica.org'>brielle@codeforamerica.org</a></p>
  </div>

<? } ?>

</div>

<? include('bottom.php') ?>

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

    <p>Code for America Brigades organize through the four Ps: <b> people, plans, partnerships, and participation. </b> </p>

    <p>What to do next</p>

    <p>Your first step in starting a Brigade is to get your <b>people </b>together! This includes:</p>
    <ul>
        <li>Organizing a <a href="https://docs.google.com/a/codeforamerica.org/document/d/1oEB1CuzCHldxP_bzcvmcrmK0yAE1BzV2AGhtwtYKZVY/edit">core leadership team</a></li>
        <li>Putting up a website that includes a <a href="https://www.google.com/url?q=https%3A%2F%2Fgithub.com%2Fcodeforamerica%2Fcodeofconduct&sa=D&sntz=1&usg=AFQjCNHLV1eOOQEJLnypprXD_lXHMlg58g">Code of Conduct</a></li>
        <li>Hosting three consistent <a href="https://docs.google.com/a/codeforamerica.org/document/d/1ukivPQNeIH2GcJHcZ50yjzh1uQj70FlilFQcUKOH49k/edit">hack nights</a></li>
    </ul>
    <p>
    Once you've done that, <a href="https://docs.google.com/a/codeforamerica.org/forms/d/1UIcMpqI4eGeFizGaViPC6odaGGIe59pvOtWhToA6xtY/viewform">fill out this form</a> and we'll set up some time to chat and invite you to <b> participate </b> as a <b> Brigade Network Member </b>. You'll be able to connect with other Brigades around the world through our various digitial channels to learn how they work and to share your experiences with them.
    </p>

    <p>Want access to funding and additional resources? Whenever you are ready you can join us an <b> Official Brigade Chapter </b>by making <b> plans </b> and <b> partnerships </b>. I.E. You can join as an Official Brigade Chapter after you have participated as a Brigade Network Member for a while, or moving straight through that step towards an Official Chapter in one swoop). </p>
    <ul>
        <li>Writing a <a href="https://docs.google.com/a/codeforamerica.org/document/d/16GO5lnwEBKMFhhvewhKiNUcvVbTw5NtunVxhmCS6vw0/edit">strategic plan</a> that maps to the <a href="http://www.codeforamerica.org/governments/principles/">Code for America Principles</a></li>
        <li>Building partnerships with other community groups and local government</li>
    </ul>
    
     <p>
    Once you've done that, <a href="https://docs.google.com/a/codeforamerica.org/forms/d/1odKnV_eFA2F7gix-AQXuTUhhIYrG0R6P1QYRoXw2EL8/viewform">fill out this form</a> and we'll set up some time to chat and invite you to <b> participate </b> as an <b> Official Brigade Chapter</b>. 
    </p>
    
    <p>If you are joining from outside the United States, you can participate in the Brigade network as an Brigade Network Member. If your Brigade grows, we may want to consider becoming a <b> Code for All </b> member, which is the support route interntaional Brigades take instead of becoming Official Brigade Chapters.   Find out more at <a href="code-for-all.github.io/codeforall.org">codeforall.org</a>.</p>

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

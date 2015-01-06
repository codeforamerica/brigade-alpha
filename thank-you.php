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

    <p><h3>What to do next</h3></p>

    <p>Your first step in starting a Brigade is to get your people together! This includes:</p>
    <ul>
        <li>Organizing a <a href="https://docs.google.com/a/codeforamerica.org/document/d/1oEB1CuzCHldxP_bzcvmcrmK0yAE1BzV2AGhtwtYKZVY/edit">core leadership team</a></li>
        <li>Putting up a website that includes a <a href="https://www.google.com/url?q=https%3A%2F%2Fgithub.com%2Fcodeforamerica%2Fcodeofconduct&sa=D&sntz=1&usg=AFQjCNHLV1eOOQEJLnypprXD_lXHMlg58g">Code of Conduct</a></li>
        <li>Hosting three consistent <a href="https://docs.google.com/a/codeforamerica.org/document/d/1ukivPQNeIH2GcJHcZ50yjzh1uQj70FlilFQcUKOH49k/edit">hack nights</a></li>
    </ul>
    <p>
    Once you've done that, <a href="https://docs.google.com/a/codeforamerica.org/forms/d/1UIcMpqI4eGeFizGaViPC6odaGGIe59pvOtWhToA6xtY/viewform">fill out this form</a> and we'll set up some time to chat and invite you to participate as a <b> Brigade Network Member </b>. You'll be able to connect with other Brigades around the world through our various digitial channels to learn how they work and to share your experiences with them.
    </p>

    <p>Want access to funding and additional resources? Whenever you are ready you can add plans and partnerships to your Brigade and join as an Official Chapter.  This includes: </p>
    <ul>
        <li>Writing a <a href="https://docs.google.com/a/codeforamerica.org/document/d/16GO5lnwEBKMFhhvewhKiNUcvVbTw5NtunVxhmCS6vw0/edit">strategic plan</a> that maps to the <a href="http://www.codeforamerica.org/governments/principles/">Code for America Principles</a></li>
        <li>Building partnerships with other community groups and local government, (<a href="http://www.codeforamerica.org/blog/2014/10/13/want-to-take-your-brigade-to-the-next-level-develop-it/">click here</a> to read about a community partner relationship with Code for Philly, and <a href="http://code4sac.org/were-coding-for-california/">click here</a> to learn how Code for Sacramento is working with one of their local government partners.</li>
    </ul>
    
     <p>
    Once you've done that, <a href="https://docs.google.com/a/codeforamerica.org/forms/d/1odKnV_eFA2F7gix-AQXuTUhhIYrG0R6P1QYRoXw2EL8/viewform">fill out this form</a> and we'll set up some time to chat and invite you to participate as an <b> Official Brigade Chapter</b>. I.E. You can join as an Official Brigade Chapter after you have participated as a Brigade Network Member for a while, or in one swoop by submitting to the Official Brigade Chapter form once you have completed all four Ps). 
    </p>
    
    <p><b>If you are joining from outside the United States</b>, you can participate in the Brigade network as an Brigade Network Member. If your Brigade grows, we may want to consider becoming a Code for All member, which is the support route interntaional Brigades take instead of becoming Official Brigade Chapters.   Find out more at <a href="codeforall.org">codeforall.org</a>.</p>

    <p>Questions? Check out this <a href="https://docs.google.com/a/codeforamerica.org/document/d/1b4pxoRxm8RMDfPhkqBHk9TT9uRHJ-jPDbJpBSW9nvz0/edit">FAQ doc</a>. You can sign up for Google Hangout office hours from the FAQ, or reach out to Communities Coordinator, Brielle Plump, at brielle@codeforamerica.org.</p>

    <p><h3>Thank you for volunteering to make your community stronger!</h3> <br><br>
    Hannah, Brielle, Preston, Andrew, and Catherine <br>
    Code for America Communities Team</p>

  </div>


<? } else { ?>

  <div id="no_brigade_text">
    <p><b><h3>Thank you for your interest in the Code for America Brigade community!</h3></b></p>
    <p>We will add you to our mailing list so you can keep stay up to date with both local opportunities and national events.</p>
    <p>If you want to reconsider leading a Brigade in your city,<a href='https://www.youtube.com/watch?v=f1oBpGQbdmg'>click here to view the "How to start a Brigade" video</a>, then re-submit your name into the form on <a href="codeforamerica.org/brigade">on our website </a> and click "I want to lead a Brigade in my community."</a></p>
    <p>We'll be in touch, but feel free to reach out with your ideas and questions anytime.</p>
    <p>Sincerley,<br>
    Brielle Plump - Communities Coordinator<br>
    <a href='mailto:brielle@codeforamerica.org'>brielle@codeforamerica.org</a></p>
  </div>

<? } ?>

</div>

<? include('bottom.php') ?>

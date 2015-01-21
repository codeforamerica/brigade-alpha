<? include('top.php'); ?>

<section class="slab-black">
    <div class="layout-semibreve layout-centered">
      <figure>
        <iframe width="560" height="315" style="padding:1px;border:1px solid black;" src="//www.youtube.com/embed/_9-E7CLQX48?list=PL65XgbSILalW_PV2Cgmz7gOWY3YLwC87M" frameborder="0" allowfullscreen></iframe>
      </figure> 
    </div>
</section>

<section class="slab-gray">

  <div class="layout-semibreve">

    <div class="layout-centered">
        <h2 class="isolate">Want to Organize a Brigade?</h2>
        <p>That's fantastic!  We are so excited you and your 
          team are interested in joining this awesome network 
          of developers, designers, community organizers, 
          storytellers, government partners, and caring residents.</p>
        <p>Your first step if to fill out the form below and be sure to click the "I want to lead a Brigade in my community" box.  Once you have filled out the form we will send you an email with complete organizing instructions.</p>  
        <p>If you do not click the box - perhaps you are not ready to start organizing, or maybe there is already a Brigade in your city (<a href="http://www.codeforamerica.org/brigade">click here to double check)</a> - we will add you to our mailing list so you can stay up to date with what is happening in the network.</p> 
    </div>

    <form action="<?= $base_url ?>/signup" method="POST" accept-charset="UTF-8">
      <ul class="list-form">
        <li class="form-field">
            <label for="name">Full name</label>
            <input name="name" type="text" placeholder="Ben Franklin" required>
        </li>
        <li class="form-field">
            <label for="email">Email</label>
            <input name="email" type="text" placeholder="benfranklin@codeforamerica.org" required>
        </li>
        <li class="form-field">
            <label for="location">City</label>
            <input name="location" type="text" placeholder="Tulsa, OK">
        </li>
        <li class="form-field">
            <label>
              <input name="source" type="checkbox" value="organizer" checked/>
              I want to lead a Brigade in my community!
            </label>
        </li>
        <li class="form-field">
            <input type="hidden" name="user[location_id]" value="" /><!-- why is this here? -->
            <button>Join</button>
        </li>
        <p> Joining from outside the United States? Learn more about the international civic-tech network by visiting <a href="codeforall.org">codeforall.org</a>.</p>
        <p> Are you employed by your city or state?  Be sure to check out our <a href="http://www.codeforamerica.org/governments/">Government resources</a>.</p>
      </ul>
    </form>

  </div>

</section>

<section class="layout-semibreve">
    
    <h2 class="layout-centered">Ready to Get Started?</h2>
    <p>A group can join the Code for America Brigade network as a <b>Brigade Network Member</b> or an <b>Official Brigade Chapter</b>.  Brigades organize and build around the four Ps: <b>people, plans, partnerships,</b> and <b>participation</b></p>
    
    <h3>People & Participation</h3>
    <p>Your first step will be to get your people together. This includes:</p>
    <ul>
      <li>Organizing a core leadership team</li>
      <li>Putting up a website that includes a <a href="https://github.com/codeforamerica/codeofconduct">Code of Conduct</a></li>
      <li>Hosting three consistent hack nights</li>
    </ul>
    <p>
      Once you've done that, we'll invite you to participate as a 
      <b>Brigade Network Member</b>. You'll be able to connect with 
      other Brigades around the world through our various digitial channels to learn how they work and to 
      share your experiences with them.
    </p>
    
    <h3>Plans & Partners</h3>
    <p>To receive funding and additional resource and support, you'll need get your people in order, participate in the network, AND establish a plan and partners. This includes:</p>
    <ul>
      <li>Writing a strategic plan that maps to the <a href="http://www.codeforamerica.org/governments/principles/">Code for America Principles for 21st Century Government</a></li>
      <li>Building partnerships with community groups and local government</li>
    </ul>
     <p>Once you've done that, we'll invite you to join us as an 
      <b>Official Brigade Chapter</b>. You'll be able to connect with 
      other Brigades just as a Network Member does, plus recieve financial and organizing resources.</p>

    <p>*To get full instructions on becoming either a Brigade Network Member or an Official Brigade Chapter fill out the above form, click "I want to lead a Brigade in my community" and we will send you all the details!</p>

    <p><b>Joining from outside the United States?</b> Learn how you can participate as a Brigade Network Member by visiting 
      <a href="http://codeforall.org/about">codeforall.org/about</a>.</p>

</section>

<? include('bottom.php') ?>

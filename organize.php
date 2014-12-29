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
        <h2 class="isolate">Want to organize a Brigade?</h2>
        <p>
          That's fantastic!  We are so excited you and your 
          team are interested in joining this awesome network 
          of developers, designers, community organizers, 
          storytellers, government partners, and caring residents.
        </p>
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
      </ul>
    </form>
  </div>
</section>

<section class="layout-semibreve">
    <h2 class="layout-centered">Ready to Get Started?</h2>
    <!-- <p>A group can join the Code for America Brigade network as a Brigade Network Member or an Official Brigade Chapter.</p> -->
    <!-- <p>Code for America Brigades organize through the four Ps:</p> -->
    <!-- <h4>people, plans, partnerships, and participation</h4> -->
    A group can join the Code for America Brigade network as a <b>Brigade Network Member</b> or an <b>Official Brigade Chapter</b>. 
    <h3>People & Participation</h3>
    <p>Your first step will be to get your <b>people</b> together. This includes:</p>
    <ul>
      <li>Organizing a core leadership team</li>
      <li>Putting up a website that includes a Code of Conduct</li>
      <li>Hosting three consistent hack nights</li>
    </ul>
    <p>
      Once you've done that, we'll invite you to <b>participate</b> as a 
      <b>Brigade Network Member</b>. You'll be able to connect with 
      other Brigades around the world through our various digitial channels to learn how they work and to 
      share your experiences with them.
    </p>
    <h3>Plans & Partners</h3>
    <p>To receive funding and additional resource and support, you'll need get your people in order, participate in the network, AND establish a <b>plan</b> and <b>partners</b>. This includes:</p>
    <ul>
      <li>Writing a strategic plan that maps to the Code for America <a href="http://www.codeforamerica.org/governments/principles/">Principles</a></li>
      <li>Building partnerships with community groups and local government</li>
    </ul>
     <p>
      Once you've done that, we'll invite you to join us as an 
      <b>Official Brigade Chapter</b>. You'll be able to connect with 
      other Brigades just as a Network Member does, plus recieve fincial and organizing resources.  
    </p>
    <p>
    <b>To learn more about becoming either a Brigade Network Member or an Official Brigade Chapter fill out the above form and we will send you all the details!</b>
    </p>
    <p>
     <b> Joining from outside the United States?</b> Find out more at 
      <a href="http://code-for-all.github.io/codeforall.org/">codeforall.org</a>.
    </p>
</section>

<? include('bottom.php') ?>

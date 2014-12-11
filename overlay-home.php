<?php

    $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

?>

  <div id="brigade-info">
    <p id="program-info">The Code for America Brigade program is an international network of people committed to using their voices and hands, in collaboration with local governments, to make their cities better.</p>
  </div>

  <h4>Want to join a Brigade?</h4>
  <p>Find your local Brigade on the map.</p>

  <h4>Want to start a new Brigade?</h4>
  <p>Check out our <a href="<?= $base_url ?>/organize">Organize</a> page.</p>

  <div id="join-form">
    <h4>Want to get connected?</h4>
    <p>We'll add you to our mailing list</p>
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
            <input type="hidden" name="user[location_id]" value="" /><!-- why is this here? -->
            <button>Join</button>
        </li>
      </ul>
    </form>

    <p>If you are a member of government, join our <a href="https://codeforamerica.wufoo.com/forms/welcome-to-the-code-for-america-government-network/">Peer Network</a>.</p>
  </div>

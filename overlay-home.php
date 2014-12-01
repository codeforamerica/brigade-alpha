<?php

    $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

?>    
  <div id="brigade-info">
    <h2 id="brigade-name">The Code for America Brigade</h2>
    <p id="program-info">The Code for America Brigade program is an international network of people committed to using their voices and hands, in collaboration with local governments, to make their cities better.</p>
  </div>

  <div id="join-form">
    <h4>Want to get connected?</h4>
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
              <input name="work_in_government" type="checkbox" value="1">
              I work in government
            </label>
        </li>
        <li class="form-field">
            <label>
              <input name="source" type="checkbox" value="organizer" />
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

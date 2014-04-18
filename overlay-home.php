<?php

    $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

?>    
  <div id="brigade-info">
    <h2 id="brigade-name">The Code for America Brigade</h2>
    <p id="program-info">The Code for America Brigade program is an international network of people committed to using their voices and hands, in collaboration with local governments, to make their cities better.</p>
  </div>

  <div id="join-form">
    <h4>Want to get connected?</h4>
    <form accept-charset="UTF-8" id="new_user" novalidate="novalidate" action="<?= $base_url ?>/signup" method="POST">
      <ul class="list-form">
        <li class="form-field">
            <label for="user_full_name">Full name</label>
            <input id="user_full_name" name="name" type="text" placeholder="Ben Franklin">
        </li>
        <li class="form-field">
            <label for="user_email">Email</label>
            <input id="user_email" name="email" type="text" placeholder="benfranklin@codeforamerica.org">
        </li>
        <li class="form-field">
            <label for="user_work_in_geovernment">
              <input id="user_work_in_government" name="work_in_government" type="checkbox" value="1">
              I work in government
            </label>
        </li>
        <li class="form-field">
            <label>
              <input id="user_willing_to_organize_true" name="source" type="checkbox" value="organizer" />
              I want to lead a Brigade in my community!
            </label>
        </li>
        <select id="user_location_id" name="user[location_id]" style="display:none;">
          <option value></option>
        </select>

      </ul>
      <input id="user_human_check" name="user[human_check]" size="50" type="hidden">
      <input name="utf8" type="hidden" value="✓">
      <button id="join-button">Join</button>
    </form>
  </div>

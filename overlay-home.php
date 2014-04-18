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
            <input id="user_full_name" name="user[full_name]" type="text" placeholder="Ben Franklin">
        </li>
        <li class="form-field">
            <label for="user_email">Email</label>
            <input id="user_email" name="user[email]" type="text" placeholder="benfranklin@codeforamerica.org">
        </li>
        <li class="form-field">
            <label for="user_work_in_geovernment"><input id="user_work_in_government" name="user[work_in_government]" type="checkbox" value="1">I work in government</label>
        </li>
        <li class="form-field">
            <label for="source"><input name="source" id="organizer" value="organizer" type="checkbox">I want to lead a Brigade in my community!</label>
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

  <script>
    /*
    $("#join-button").click(function(e){
      e.preventDefault();

      // Check that the form is filled out
      if ($("#user_full_name").val() && $("#user_email").val()) {

        // Post form data to old Brigade site
        data = $("#new_user").serialize();
        $.post("<?= $base_url ?>/signup", data);

        // If no Brigade selected, show appropriate thanks
        if ($("#no_brigade").attr("name")){
          $("#no_brigade_text").show();
        }

        // If Organizing, show appropriate thanks
        if ($("#organizer").attr("name")){
          $("#organizer_text").show();
        }

        $("#brigade-info").hide()
        $("#join-form").hide()
        $("#join-button").hide()

      } else {
        console.log("FILL OUT THE FORM")
      }


    });

    $('#organizer').bind('change', function(){
      if ($('#organizer').is(':checked')) {
        $("#no_brigade").attr("name",null);
        $("#organizer").attr("name","source");
      } else {
        $("#no_brigade").attr("name","source");
        $("#organizer").attr("name",null);
      }
    });
    */

  </script>

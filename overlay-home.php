  <div id="brigade-info">
    <h2 id="brigade-name">The Code for America Brigade</h2>
    <p id="program-info">The Brigade program helps local volunteer groups partner with government in an effort to enhance their communities. Brigades hold regular hack nights, events, advocate for open data, and deploy apps.</p>
  </div>

  <div id="join-form">
    <h4>Want to get connected?</h4>
    <form accept-charset="UTF-8" id="new_user" novalidate="novalidate">
      <input id="no_brigade" type="hidden" name="source" value="no_brigade">
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
            <label for="source"><input id="organizer" value="organizer" type="checkbox">I want to Organize!</label>
        </li>
        <select id="user_location_id" name="user[location_id]" style="display:none;">
          <option value></option>
        </select>

      </ul>
      <input id="user_human_check" name="user[human_check]" size="50" type="hidden">
      <input name="utf8" type="hidden" value="✓">
    </form>
    <button id="button">Join</button>
  </div>

  <div id="no_brigade_text" style="display:none;">
    <p><b>Thanks for your interest in a Code for America Brigade in your community.</b></p>
    <p>We’ll let you know if things start picking up in your area.</p>
    <p>In the meantime, we’ll keep in touch about opportunities to participate in activities at the national level.</p>
    <p>Remember, if you change your mind, you can always come back to sign up to be an organizer and take a more proactive role.</p>
    <p>Good luck and we'll be in touch.</p>
    <br>
    <p><i>Brigade Support Team</i></p>
    <p><a href='mailto:brigade-info@codeforamerica.org'>brigade-info@codeforamerica.org</a></p>
  </div>

  <div id="organizer_text" style="display:none;">
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

  <script>
    $("#button").click(function(e){
      e.preventDefault();

      data = $("#new_user").serialize();
      $.post("http://old-brigade.codeforamerica.org/members", data);

      if ($("#no_brigade").is('[name]')){
        $("#no_brigade_text").show();
      }
      if ($("#organizer").is('[name]')) {
        $("#organizer_text").show();
      }
      $("#brigade-info").hide()
      $("#join-form").hide()
      $("#button").hide()
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

  </script>

  <div id="brigade-info">
    <h2 id="brigade-name">The Code for America Brigade</h2>
    <p id="program-info">The Brigade program helps local volunteer groups partner with government in an effort to enhance their communities. Brigades hold regular hack nights, events, advocate for open data, and deploy apps.</p>
  </div>

  <div id="join-form">
    <form accept-charset="UTF-8" action="http://brigade.codeforamerica.org/members" id="new_user" method="post" novalidate="novalidate">
      <input id="no_brigade" type="hidden" name="source" value="no_brigade">
      <h3>Want to get connected?</h3>
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
      <input name="commit" type="submit" value="Submit">
    </form>
  </div>

  <script>
    $('#organizer').bind('change', function(){
      if ($('#organizer').is(':checked')) {
        $("#no_brigade").attr("name",null);
        $("#organizer").attr("name","source");
      } else {
        $("#no_brigade").attr("name","source");
        $("#organizer").attr("name",null);
      }
      // console.log("WHAT");
    });
  </script>

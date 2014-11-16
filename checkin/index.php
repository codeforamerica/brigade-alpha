<? 
// 
// Allow people to checkin at a Code for America event.
// 
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  
  // Get params from url
  $brigade = $_GET["brigade"];
  $event = $_GET["event"];

  include('../top.php');

?>

      <section>
        <div class="layout-semibreve">   
          <div class="layout-gutter">
            <div class="layout-minim">
              <h1>Welcome</h1>
              <form method="POST" id="attendance-form">
                <ul class="list-form">
                  <li class="form-field"> 
                    <label>Name</label><input autofocus type="text" placeholder="Ben Franklin" name="name" />
                  </li>
                  <li class="form-field">
                    <label>Email</labal><input type="email" placeholder="benfranklin@codeforamerica.org" name="email" />
                  </li>
                  <li class="form-field">
                    <label>Event</label><input type="text" name="event" placeholder="Hack Night" value="<?echo htmlspecialchars($event);?>" />
                  </li>
                  <li class="form-field">
                    <label>Brigade</label><input type="text" name="brigade" placeholder="Code for San Francisco" value="<?echo htmlspecialchars($brigade);?>" />
                  </li>
                </ul>
                <button type="submit" class="button-l">Check In</button>
              </form>
            </div>
          </div>
        </div>
      </section>

<? 
    include('../bottom.php');
}

// Accept a POST request for a checkin at a Code for America event.
// Add the secret key and post it to the people-app.
// We do this because we want to give people an endpoint they can start
// sending checkins too, yet we want to be able to change
// the actual endpoint on our end.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $posted = array(
        'SECRET_KEY' => getenv('SECRET_KEY'),
        "name" => $_POST["name"],
        "email" => $_POST["email"],
        "event" => $_POST["event"],
        "date" => gmdate('Y-m-d'),
        "brigade" => $_POST["brigade"]
        );

    $opts = array(
        'http' => array(
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => http_build_query($posted),
            'timeout' => 5
            )
        );

    //
    // Send POST to the People app.
    //
    $context  = stream_context_create($opts);
    $url = 'https://people.codeforamerica.org/checkin';
    $response = file_get_contents($url, false, $context, -1, 40000);

    if ($http_response_header[0] == "HTTP/1.0 200 OK"){

      $query = array("event" => $_POST["event"], "brigade" => $_POST["brigade"]);
      $redirect = sprintf("?%s", http_build_query($query));

    include('../top.php');

    ?>

      <section>
        <div class="layout-semibreve">   
          <div class="layout-gutter">
            <div class="layout-minim">
              <h1>Thanks</h1>
                <a href="<?= $redirect ?>" class="button-l">New Check In</a>
            </div>
          </div>
        </div>
      </section>

<? 
    include('../bottom.php');
}

}

?>
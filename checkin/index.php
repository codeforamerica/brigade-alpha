<? 
// 
// Allow people to checkin at a Code for America event.
// 
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // Required to set a timezone, but what about international?
  date_default_timezone_set("America/Los_Angeles");

  // Get params from url
  $brigade = $_GET["brigade"];
  $event = $_GET["event"];

?>

<!DOCTYPE html>
<html lang="en-us">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Code for America - Check In</title>
    <link rel="stylesheet" href="http://style.codeforamerica.org/style/css/main.css">
    <link rel="stylesheet" href="http://style.codeforamerica.org/style/css/layout.css" media="all and (min-width: 40em)">

    <!-- Need to use full link for hosting on gh-pages -->
    <link rel="stylesheet" href="../css/style.css">

    <link rel="apple-touch-icon-precomposed" href="/style/favicons/60x60/flag-red.png"/>

  </head>
  <body>
  <div class="js-container">

    <nav class="nav-global-primary">
    </nav>

      <div class="global-header">
        <a href="<?= $base_url ?>/" class="global-header-logo">
            <img src="../images/logo.png" />
        </a>
        <p class="skip-to-nav"><a href="#global-footer">Menu</a></p>

        <nav class="nav-global-secondary">
          <ul>
            <li><a href="http://www.codeforamerica.org/about/brigade/">About</a></li>
            <li><a href="<?= $base_url ?>/tools">Tools</a></li>
            <!-- <li><a href="<?= $base_url ?>/events">Events</a></li> -->
            <li><a href="http://codeforamerica.tumblr.com">Tumblr</a></li>
            <li><a href="http://codeforamerica.org/donate" class="button">Donate</a></li>
          </ul>
        </nav>
      </div>

    <main role="main">


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
                <input type=hidden name="date" placeholder=<? echo date('Y-m-d') ?> />
                <button class="button-prominent button-l">Check In</button></li>
                <p id="flag" style="float:right;display:none;">Thanks for checking in!</p>
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
        "date" => $_POST["date"],
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
    $url = 'http://127.0.0.1:5000/checkin';
    $response = file_get_contents($url, false, $context, -1, 40000);

    if ($http_response_header[0] == "HTTP/1.0 200 OK"){

      $query = array("event" => $_POST["event"], "brigade" => $_POST["brigade"]);
      $redirect = sprintf("?%s", http_build_query($query));
      
      header('HTTP/1.1 303 See Other');
      header("Location: {$redirect}");
    }

}

?>
<? 
// 
// Allow people to checkin at a Code for America event.
// 
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    include('../top.php');

?>


<section>
    <div class="layout-semibreve">   
        <div class="layout-gutter">
            <div class="layout-minim">
                <p>Attendee register</p>
                <form action="<?= $base_url ?>/checkin" method="POST" id="attendance-form">
                    <ul class="list-form">
                        <li class="form-field"> 
                            <label>Name</label><input autofocus type="text" placeholder="Ben Franklin" name="name" />
                        </li>
                        <li class="form-field">
                            <label>Email</labal><input type="email" placeholder="benfranklin@codeforamerica.org" name="email" />
                        </li>
                        <li class="form-field">
                            <label>Event</label><input type="text" name="event_name" placeholder="Hack Night" />
                        </li>
                        <li class="form-field">
                            <label>Brigade</label><input type="text" name="cfapi_org_id" placeholder="Code-for-San-Francisco" />
                        </li>
                    </ul>
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
        "event_name" => $_POST["event_name"],
        "date" => $_POST["date"],
        "cfapi_org_id" => $_POST["cfapi_org_id"]
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

}

?>
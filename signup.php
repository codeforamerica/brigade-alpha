<?php

    //
    // What kind of request is this?
    //
    $is_specific_brigade = ($_POST['source'] == 'brigade' && $_POST['brigade_url']) ? true : false;
    $is_organizer = (!$is_specific_brigade && $_POST['source'] == 'organizer') ? true : false;
    $is_generic = (!$is_specific_brigade && !$is_organizer) ? true : false;

    //
    // Construct a POST request to the old Brigade site.
    //
    $posted = array(
        // Source is one of "organizer", "brigade", or "no_brigade".
        'source' => ($_POST['source'] ? $_POST['source'] : 'no_brigade'),

        // Brigade ID is the numeric identifier for the old site.
        'brigade_id' => $_POST['brigade_id'],

        // User information.
        'user' => array(
            'email' => $_POST['user']['email'],
            'full_name' => $_POST['user']['full_name'],
            'location_id' => $_POST['user']['location_id'],
            'work_in_government' => $_POST['user']['work_in_government']
            )
        );

    //
    // Send POST request to the old Brigade site.
    //
    $opts = array('http' =>
                  array(
                      'method'  => 'POST',
                      'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
                      'content' => http_build_query($posted),
                      'timeout' => 5
                      )
                  );
    
    $context  = stream_context_create($opts);
    $url = 'http://old-brigade.codeforamerica.org/members';
    $response = file_get_contents($url, false, $context, -1, 40000);
    
    /*
    header('Content-Type: text/plain');
    print_r(compact('is_specific_brigade', 'is_organizer' , 'is_generic'));
    echo "Got this:\n";
    print_r($_POST);
    echo "Posted to old-brigade:\n";
    print_r($posted);
    */
    
    $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    $query = array('source' => $_POST['source'], 'brigade_url' => $_POST['brigade_url']);
    $redirect = sprintf('%s/thank-you?%s', $base_url, http_build_query($query));
    
    header('HTTP/1.1 303 See Other');
    header("Location: {$redirect}");

?>

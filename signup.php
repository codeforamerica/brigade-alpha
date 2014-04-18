<?php

    $post = array(
        'source' => ($_POST['source'] ? $_POST['source'] : 'no_brigade'),
        'brigade_id' => $_POST['brigade_id'],
        'user' => array(
            'email' => $_POST['user']['email'],
            'full_name' => $_POST['user']['full_name'],
            'location_id' => $_POST['user']['location_id'],
            'work_in_government' => $_POST['user']['work_in_government']
            )
        );

    $opts = array('http' =>
                  array(
                      'method'  => 'POST',
                      'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
                      'content' => http_build_query($post),
                      'timeout' => 5
                      )
                  );
    
    $context  = stream_context_create($opts);
    $url = 'http://old-brigade.codeforamerica.org/members';
    $response = file_get_contents($url, false, $context, -1, 40000);
    
    header('Content-Type: text/plain');
    echo "Got this:\n";
    print_r($_POST);
    echo "Posted to old-brigade:\n";
    print_r($post);
    
    // If Brigade selected, show appropriate thanks from overlay-brigade.php
    
    // If no Brigade selected, show appropriate thanks from overlay-home.php or list-brigades.php
    
    // If Organizing, show appropriate thanks from overlay-home.php or list-brigades.php

?>

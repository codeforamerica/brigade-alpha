<?php

    $post = array(
        'source' => $_POST['source'],
        'brigade_id' => $_POST['brigade_id'],
        'user' => array(
            'email' => $_POST['user']['email'],
            'full_name' => $_POST['user']['full_name'],
            'location_id' => $_POST['user']['location_id']
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
    print_r($post);
    print_r($_POST);

?>

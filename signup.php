<?php

    $opts = array('http' =>
                  array(
                      'method'  => 'POST',
                      'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
                      'content' => http_build_query($_POST),
                      'timeout' => 5
                      )
                  );
    
    $context  = stream_context_create($opts);
    $url = 'http://old-brigade.codeforamerica.org/members';
    $response = file_get_contents($url, false, $context, -1, 40000);
    
    echo $response;

?>

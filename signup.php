<?php

    //
    // What kind of request is this?
    //
    $is_specific_brigade = ($_POST['brigade_url']) ? true : false;
    $is_organizer = (!$is_specific_brigade && $_POST['source'] == 'organizer') ? true : false;
    $is_generic = (!$is_specific_brigade && !$is_organizer) ? true : false;
    $works_in_gov = ($_POST['works_in_gov']) ? true : false;

    //
    // We're looking for numeric IDs from the old site for the Join form.
    //
    $old_brigade_id = null;
    $brigade_url = null;

    if($is_specific_brigade)
    {
        $old_brigade_id = -1;
        $old_brigades_url = 'http://old-brigade.codeforamerica.org/brigades.json';
        $old_brigades = json_decode(file_get_contents($old_brigades_url), true);

        $brigade_url = $_POST['brigade_url'];
        $brigade_info = json_decode(file_get_contents($brigade_url), true);

        foreach($old_brigades as $old)
        {
            if($old['name'] == $brigade_info['name'])
                $old_brigade_id = $old['id'];
        }
    }

    //
    // Construct a POST request to the old Brigade site.
    //
    if($is_specific_brigade) {
        $source = 'brigade';
    
    } elseif($is_organizer) {
        $source = 'organizer';
    
    } else {
        $source = 'no_brigade';
    }
    
    $posted = array(
        // SECRET KEY
        'SECRET_KEY' => getenv('SECRET_KEY'),

        // Source is one of "organizer", "brigade", or "no_brigade".
        'source' => $source,

        // Brigade ID is the numeric identifier for the old site.
        'brigade_id' => $old_brigade_id,

        // User information.
        'user' => array(
            'email' => $_POST['email'],
            'full_name' => $_POST['name'],
            'location_id' => $_POST['user']['location_id'],
            'work_in_government' => $_POST['work_in_government'],
            'willing_to_organize' => ($is_organizer ? 'true' : ''),
            ),
        'location' => $_POST['location'],
        'cfapi_brigade_id' => array_pop(explode("/", $_POST['brigade_url']))
        );

    $opts = array('http' =>
                  array(
                      'method'  => 'POST',
                      'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
                      'content' => http_build_query($posted),
                      'timeout' => 5
                      )
                  );

    //
    // Send POST request to the old Brigade site.
    //
    $context  = stream_context_create($opts);
    $url = 'http://old-brigade.codeforamerica.org/members';
    $response = file_get_contents($url, false, $context, -1, 40000);

    //
    // Send POST request to the peopledb.
    //
    $url = 'https://people.codeforamerica.org/brigade/sign-up';
    error_log(json_encode($posted));
    error_log(json_encode($opts));
    $peopledb_response = file_get_contents($url, false, $context, -1, 40000);
    
    $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    $query = array('source' => $posted['source'], 'brigade_url' => $brigade_url);
    $redirect = sprintf('%s/thank-you?%s', $base_url, http_build_query($query));
    
    header('HTTP/1.1 303 See Other');
    header("Location: {$redirect}");

?>

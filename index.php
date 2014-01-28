<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Brigade — Code for America</title>
    <!-- <link rel="stylesheet" href="normalize.css"> -->
    <link rel="stylesheet" type="text/css" href="//cloud.typography.com/6435252/678502/css/fonts.css" />
    <link rel="stylesheet" href="http://alpha.codeforamerica.org//style/css/main.css">
    <link rel="stylesheet" href="http://alpha.codeforamerica.org//style/css/layout.css" media="all and (min-width: 40em)">
    <link rel="stylesheet" href="style.css">
    <link rel="apple-touch-icon-precomposed" href="/style/favicons/60x60/flag-red.png"/>

    <script src='//code.jquery.com/jquery-2.1.0.min.js'></script>
    <link href='//api.tiles.mapbox.com/mapbox.js/v1.6.1/mapbox.css' rel='stylesheet' />
    <script src='//api.tiles.mapbox.com/mapbox.js/v1.6.1/mapbox.js'></script>
    <script src='//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.21.0/L.Control.Locate.js'></script>
    <link href='//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.21.0/L.Control.Locate.css' rel='stylesheet' />
    
<body>
    <header>
        <div id="top">
            <img src="http://brigade.codeforamerica.org/assets/logo.png">
            <p>People just like you building helpful technology for their cities.</p>
        </div>
    </header>
    <div id="map"></div>
    <!-- <footer>
        <div id="bottom">
            <img src="http://alpha.codeforamerica.org/style/images/badge-rocket-red.svg" width="50px">
            <p>Stories!!!</p>
        </div>
    </footer> -->

    <!-- Hidden signin form for map popups -->
    <div id="signin-form">
        <form accept-charset="UTF-8" action="http://brigade.codeforamerica.org/members" id="new_user" method="post" novalidate="novalidate">
    <h2>
        Want to get connected?
    </h2>
        
    <p>
        <label for="user_full_name">Full name</label>
        <input id="user_full_name" name="user[full_name]" type="text" value="Ben Franklin">
    </p>
    <p>
        <label for="user_email">Email</label>
        <input id="user_email" name="user[email]" type="text" value="benfranklin@codeforamerica.org">
    </p>
    <p>
        <select id="brigade_id" name="brigade_id" style="display:none;">
        </select>
    </p>

    <p>
        <input name="user[work_in_government]" type="hidden" value="0">
    
        <label for="user_work_in_government">
            <input id="user_work_in_government" name="user[work_in_government]" type="checkbox" value="1">
            I work in government
        </label>
    </p>
    
    <input id="user_human_check" name="user[human_check]" size="50" type="hidden">
    <input type="hidden" name="source" value="brigade">
    <input name="utf8" type="hidden" value="✓">
    <input name="commit" type="submit" value="Submit">
</form>
    </div>
</body>
<script src="./map.js"></script>
</html>
<?

    $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

?>
<!DOCTYPE html>
<html lang="en-us">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Code for America - Brigade</title>
    <link rel="stylesheet" type="text/css" href="//cloud.webtype.com/css/944a7551-9b08-4f0a-8767-e0f83db4a16b.css" />
    <link rel="stylesheet" href="http://style.codeforamerica.org/style/css/main.css">
    <link rel="stylesheet" href="http://style.codeforamerica.org/style/css/layout.css" media="all and (min-width: 40em)">

    <!-- Need to use full link for hosting on gh-pages -->
    <link rel="stylesheet" href="http://www.codeforamerica.org/brigade/css/style.css">

    <link rel="apple-touch-icon-precomposed" href="/style/favicons/60x60/flag-red.png"/>

    <script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
    
    <link href='//api.tiles.mapbox.com/mapbox.js/v1.6.2/mapbox.css' rel='stylesheet' />
    <script src='//api.tiles.mapbox.com/mapbox.js/v1.6.2/mapbox.js'></script>

    <script type="text/javascript">

        document.location.brigade_base_url = <?= json_encode($base_url) ?>;

    </script>

  </head>


   <body>
    <div class="js-container">

      <? include('nav.html') ?>

      <main role="main">

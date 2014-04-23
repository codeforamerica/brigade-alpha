<?

    $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

?>
<!DOCTYPE html>
<html lang="en-us">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Code for America - Brigade</title>
    <link rel="stylesheet" type="text/css" href="//cloud.typography.com/6435252/678502/css/fonts.css" />
    <link rel="stylesheet" href="http://style.codeforamerica.org/style/css/main.css">
    <link rel="stylesheet" href="http://style.codeforamerica.org/style/css/layout.css" media="all and (min-width: 40em)">

    <!-- Need to use full link for hosting on gh-pages -->
    <link rel="stylesheet" href="<?= $base_url ?>/css/style.css">

    <link rel="apple-touch-icon-precomposed" href="/style/favicons/60x60/flag-red.png"/>


    <script src='//code.jquery.com/jquery-2.1.0.min.js'></script>
    <link href='//api.tiles.mapbox.com/mapbox.js/v1.6.2/mapbox.css' rel='stylesheet' />
    <script src='//api.tiles.mapbox.com/mapbox.js/v1.6.2/mapbox.js'></script>

    <script type="text/javascript">

        document.location.brigade_base_url = <?= json_encode($base_url) ?>;

    </script>

  </head>


   <body class="unknown-width">
    <div class="js-container">

      <? include('nav.html') ?>

      <main role="main">

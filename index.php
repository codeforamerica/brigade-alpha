<?

    include('top.php');

    $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

    $brigade_slug = preg_match('#^/(.+)#', $_SERVER['PATH_INFO'])
        ? ltrim($_SERVER['PATH_INFO'], '/')
        : false;

?>

<? include('list-brigades.php') ?>

<div id="map"></div>

<div id="overlay" class="slab-red">
    <? if($brigade_slug) {

      include('overlay-brigade.php');

    } else {

      include('overlay-home.php');

    } ?>
</div>

<div id="sponsors" class="layout-semibreve">
    <h4>Funders</h4>
    <p><a href="https://www.rallydev.com/about/rally-for-impact"><img src="http://www.codeforamerica.org/brigade/images/rally.png" height="100px"></a></p>
</div>

<script src="<?= $base_url ?>/js/map.js"></script>
<? include('bottom.php') ?>

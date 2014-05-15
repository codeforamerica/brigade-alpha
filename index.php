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
    <h4>Brigade Sponsors</h4>
    <a href="http://www.accela.com"><img src="<?= $base_url ?>/images/accela.gif" width="200" valign="middle"></a>
    <a href="http://www.sap.com"><img src="<?= $base_url ?>/images/SAP.jpg" width="120" valign="middle"></a>
</div>

<script src="<?= $base_url ?>/js/map.js"></script>
<? include('bottom.php') ?>

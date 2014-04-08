<?

    include('_layouts/top.php');
    
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
    <img src="<?= $base_url ?>/images/accela.gif" width="200">
</div>

<script src="<?= $base_url ?>/js/map.js"></script>
<? include('_layouts/bottom.php') ?>

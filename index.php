<?

    include('_layouts/top.php');
    
    $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    
    if(preg_match('#^/(.+)#', $_SERVER['PATH_INFO']))
    {
        $brigade_slug = ltrim($_SERVER['PATH_INFO'], '/');
    }

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
    <img src="http://codeforamerica.org/media/images/sponsorlogos/accela.gif" width="200">
</div>

<script src="<?= $base_url ?>/js/map.js"></script>
<? include('_layouts/bottom.php') ?>

<?

    include('_layouts/top.php');
    
    $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    
    if(preg_match('#^/(.+)#', $_SERVER['PATH_INFO']))
    {
        $brigade_name = ltrim($_SERVER['PATH_INFO'], '/');
    }

?>

<? include('brigades.php') ?>
<div id="map"></div>
<div id="overlay" class="slab-red">
    <? if($brigade_name) {

      include('brigade.php');
      
    } else {

      include('index-sidebar.php');
    
    } ?>
</div>

<div id="sponsors" class="layout-semibreve">
    <h4>Brigade Sponsors</h4>
    <img src="http://codeforamerica.org/media/images/sponsorlogos/accela.gif" width="200">
</div>
        
<? include('_layouts/bottom.php') ?>

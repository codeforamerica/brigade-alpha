<?

    $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    
    if(preg_match('#^/(.+)#', $_SERVER['PATH_INFO']))
    {
        $brigade_name = ltrim($_SERVER['PATH_INFO'], '/');
    }

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
    <link rel="stylesheet" href="http://codeforamerica.github.io/brigade-alpha/css/style.css">

    <link rel="apple-touch-icon-precomposed" href="/style/favicons/60x60/flag-red.png"/>

    
    <script src='//code.jquery.com/jquery-2.1.0.min.js'></script>
    <link href='//api.tiles.mapbox.com/mapbox.js/v1.6.2/mapbox.css' rel='stylesheet' />
    <script src='//api.tiles.mapbox.com/mapbox.js/v1.6.2/mapbox.js'></script>

    <script type="text/javascript">
    
        document.location.brigade_base_url = <?= json_encode($base_url) ?>;

    </script>    

  </head>


   <body>
    <div class="js-container">
      <nav class="nav-global-primary">
  <ul class="layout-breve layout-tight">
    <li><a href="/blog">Blog</a></li>
    <li><a href="/library">Library</a></li>
    <li>
      <form class="search-global" id="search-global" action="https://www.google.com/search" method="get" role="search">
          <input type="search" id="search-global-input" class="search-global-input" autocomplete="off" placeholder="Search" name="q" />
          <!-- consider applying autofocus="autofocus" to input -->
          <button class="search-global-submit" id="search-global-submit" value="www.codeforamerica.org" type="submit" name="as_sitesearch">Search</button>
      </form>
    </li>
  </ul>
</nav>

<div class="global-header">  
  <a href="http://codeforamerica.github.io/brigade-alpha/" class="global-header-logo">
      <img src="http://brigade.codeforamerica.org/assets/logo.png" />
  </a>
  <p class="skip-to-nav"><a href="#global-footer">Menu</a></p>

  <nav class="nav-global-secondary">
    <ul>
      <li class="nav-tier1 nav-has-children">
        <a href="/about">About</a>
      </li>
      <li class="nav-tier1 nav-has-children">
        <a href="/cities">Governments</a>
      </li>
      <li class="nav-tier1 nav-has-children">
        <a href="/geeks">Citizens</a>  
        <ul class="nav-tier2">
          <li><a href="/brigade-alpha/activities">Activities</a></li>
          <li><a href="/brigade-alpha/connect">Connections</a></li>
          <li><a href="/brigade-alpha/events">Events</a></li>
          <li><a href="/brigade-alpha/tools">Tools</a></li>
          <li><a href="/brigade-alpha/about">About</a></li>
          <li><a href="http://codeforamerica.tumblr.com">Tumblr</a></li>
        </ul>
      </li>
      <li class="nav-tier1">
        <a href="/apps">Apps</a>
      </li>
      <li><a href="/support-us" class="button">Donate</a></li>
    </ul>
  </nav>    
</div>

      <main role="main">
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

<!-- <div>
  <footer class="layout-semibreve">
    <blockquote>
      <p id="story">Fetching stories...</p>
    </blockquote>
  </footer>
</div> -->
        
        <div class="global-footer" id="global-footer">
  
  <div class="layout-breve layout-tight">
  
    <form class="search-global" action="https://www.google.com/search" method="get">
        <input type="search" autocomplete="off" placeholder="Search" name="q" />
        <input name="as_sitesearch" value="www.codeforamerica.org" type="hidden" />
    </form>
  
    <nav class="nav-footer" role="navigation">
      <ul>
        <li class="nav-tier1"><a class="nav-heading" href="/">Home</a></li>
        <li class="nav-tier1"><a class="nav-heading" href="/about/">About</a>
          <ul class="nav-tier2">
            <li><a href="/about/fellowship/">Fellowship</a></li>
            <li><a href="/about/brigade/">Brigade</a></li>
            <li><a href="/about/startups/">Civic Startups</a></li>
            <li><a href="/about/peernetwork/">Peer Network</a></li>
            <li><a href="/about/international/">International</a></li>
            <li><a href="/about/team/">Team</a></li>
            <li><a href="/supporters/">Supporters</a></li>
            <li><a href="/press/">Press</a></li>
            <li><a href="/jobs/">Jobs</a></li>
            <li><a href="/contact/">Contact</a></li>
          </ul>
        </li>
      
        <li class="nav-tier1"><a class="nav-heading" href="/cities/">Governments</a>
          <ul class="nav-tier2">
            <li><a href="/cities/atlanta/">Atlanta, GA</a></li>
            <li><a href="/cities/charlotte/">Charlotte, NC</a></li>
            <li><a href="/cities/chattanooga/">Chattanooga, TN</a></li>
            <li><a href="/cities/denver/">Denver, CO</a></li>
            <li><a href="/cities/lexington/">Lexington, KY</a></li>
            <li><a href="/cities/longbeach/">Long Beach, CA</a></li>
            <li><a href="/cities/mesa/">Mesa, AZ</a></li>
            <li><a href="/cities/rhodeisland/">Rhode Island</a></li>
            <li><a href="/cities/sanantonio/">San Antonio, TX</a></li>
            <li><a href="/cities/sanjuan/">San Juan, PR</a></li>
            <li><a href="/cities/alumni/">Alumni Partners</a></li>
            <li><a href="/about/peernetwork/">Peer Network</a></li>
            <li><a href="/cities/data-standards-faq/">Data Standards</a></li>
          </ul>
        </li>
          <li class="nav-tier1"><a class="nav-heading" href="/geeks/">Citizens</a>
          <ul class="nav-tier2">
            <li><a href="/geeks/our-geeks/">Our Geeks</a></li>
            <li><a href="https://github.com/codeforamerica">Our Code</a></li>
            <li><a href="/geeks/our-startups/">Our Startups</a></li>
            <li><a href="/events/">Events</a></li>
            <li><a href="https://github.com/codeforamerica/hack-requests">Requests</a></li>
          </ul>
        </li>
           </li>
          <li class="nav-tier1"><a class="nav-heading" href="/apps/">Apps</a>
          <ul class="nav-tier2">
            <li><a href="/apps/local-service.html#nav-tabs">Local Service</a></li>
            <li><a href="/apps/citizen-engagement.html#nav-tabs">Citizen Engagement</a></li>
            <li><a href="/apps/free.html#nav-tabs">Free Apps</a></li>
            <li><a href="/apps/paid.html#nav-tabs">Paid Apps</a></li>
          </ul>
        </li>
        <li class="nav-tier1"><a class="nav-heading" href="/support-us/">Donate</a>
          <ul class="nav-tier2">
            <li><a href="/supporters/">Supporters</a></li>
            <li><a href="/donate/">Donate Now</a></li>
          </ul>
        </li>
        <li class="nav-tier1"><a class="nav-heading">Social</a>
          <ul class="nav-tier2">
            <li><a href="https://www.facebook.com/codeforamerica" class="icon-facebook">Facebook</a></li>
            <li><a href="https://twitter.com/codeforamerica" class="icon-twitter">Twitter</a></li>
            <li><a href="http://www.youtube.com/user/CodeforAmerica" class="icon-youtube">YouTube</a></li>
            <li><a href="https://github.com/codeforamerica" class="icon-github2">GitHub</a></li>
            <li><a href="http://codeforamerica.tumblr.com/" class="icon-tumblr">Tumblr</a></li>
            <li><a href="http://www.flickr.com/photos/codeforamerica" class="icon-flickr">Flickr</a></li>
            <li><a href="http://www.codeforamerica.org/feed/" class="icon-feed">RSS</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>

<div class="global-foot" role="contentinfo">
  <div class="layout-tight layout-breve">
    <div class="global-foot-content">
      <img class="global-foot-logo" src="/assets/logo-inversed.png" />
      <small>Code for America Labs, Inc is a non-partisan, non-political 501(c)(3) organization. Content is licensed through Creative Commons.</small>
    </div>
  </div>
</div>

      </main>
    </div>
    <script src="/script/global.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-20825280-1']);
  _gaq.push(['_setDomainName', 'none']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

  </body>


  
  <script src="<?= $base_url ?>/js/map.js"></script>
  <!-- <script src="<?= $base_url ?>/js/tabletop.js"></script>
  <script src="<?= $base_url ?>/js/stories.js"></script> -->
  

</html>
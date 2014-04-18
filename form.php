<?php

    if(empty($brigade_slug))
    {
        $brigade_slug = ltrim($_SERVER['PATH_INFO'], '/');
    }

    $ctm_api_base = 'http://codeforamerica.org/api';
    $brigade_path = rawurlencode($brigade_slug);
    $brigade_url = "{$ctm_api_base}/organizations/{$brigade_path}";
    $info = json_decode(file_get_contents($brigade_url), true);

    if(!function_exists('h'))
    {
        function h($s) 
        {
            return htmlspecialchars($s);
        }
    }

    $post_url = "http://{$_SERVER['SERVER_NAME']}".rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    
    include('_layouts/top.php');

?>

<div class="layout-semibreve">

<textarea style="width: 100%; height: 20em;">
&lt;form method="POST" action="<?= $post_url ?>/signup"&gt;

    &lt;label&gt;
    Your full name
    &lt;input name="name" placeholder="Ben Franklin" type="text"&gt;
    &lt;/label&gt;

    &lt;label&gt;
    Your email
    &lt;input name="email" placeholder="benfranklin@codeforamerica.org" type="email"&gt;
    &lt;/label&gt;

    &lt;label&gt;
    I work in government
    &lt;input name="work_in_government" value="1" type="checkbox"&gt;
    &lt;/label&gt;
    
    &lt;input name="brigade_url" type="hidden" value="<?= h($brigade_url) ?>" /&gt;
    &lt;input type="hidden" name="source" value="brigade" /&gt;
    &lt;button&gt;Join <?= h($info['name']) ?>&lt;/button&gt;

&lt;/form&gt;
</textarea>

</div>

<? include('_layouts/bottom.php') ?>

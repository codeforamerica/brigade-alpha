<?

    include('top.php');

    $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

?>
<section>
  <div class="layout-breve">
    <ul>
    <?php
      $events_api = 'http://localhost:5000/api/events/upcoming_events';
      $events = json_decode(file_get_contents($events_api), true);
    ?>

    <? foreach($events['objects'] as $event) {
      $organization_name = $event['organization_name'];
      $name = $event['name'];
      $url = $event['event_url'];
      $time = $event['start_time'];
    ?>
      <li style="padding-bottom:25px;">
        <?= $organization_name ?>
        <br/>
        <?= $name ?>
        <br/>
        <a href="<?= $url ?>"><?= $url ?></a>
        <br/>
        <?= $time ?>
      </li>
    <? } ?>
    </ul>
  </div>
</section>
<? include('bottom.php') ?>

<?

    include('top.php');

    $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

?>
<section>
  <div class="layout-breve">

    <!-- scripts for calendar -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.7.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.0.2/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.0.2/fullcalendar.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.0.2/fullcalendar.print.css">
    
    <div id='calendar'></div>

    <script>
    $(document).ready(function() {

        // Call the /events api
        $.getJSON('http://codeforamerica.org/api/events/upcoming_events', function(response){
          
          events = response.objects;
          
          // Set up the fields that fullcalendarjs expects
          $.each(events, function(i, event){
            event.title = event.name;
            event.start = event.start_time;
            event.end = event.end_time;
            event.url = event.event_url;
          })
        
          $('#calendar').fullCalendar({
              events: events,
              // Add the org name
              eventRender: function(event, element) {
                  element.prepend(event.organization_name);
              }
          })

        })

    });
    </script>
  </div>
</section>

<? include('bottom.php') ?>

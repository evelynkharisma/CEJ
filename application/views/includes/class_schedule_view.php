<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Schedule</small></h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_content">

                        <div id='calendar'></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->


<!-- FullCalendar -->
<script src="<?php echo base_url() ?>assets/js/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/fullcalendar.min.js"></script>

<script>
    $(document).ready(function() {

        var date = new Date(),
            d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear(),
            started,
            categoryClass;

        var events_array = [
            {
                title:"New Event",
                start: '10:00', // a start time (10am in this example)
                end: '14:00', // an end time (6pm in this example)
                tip: 'this repeating',
                dow: [ 1, 4 ] // Repeat monday and thursday
            }
        ];

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            selectable: true,
            events: events_array,
            eventRender: function(event, element) {
                element.attr('title', event.tip);
            }
        });
    });
</script>



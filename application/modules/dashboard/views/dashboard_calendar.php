<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>public/avant/assets/plugins/fullcalendar/fullcalendar.css' />


<div class="col-md-6">
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4>Calendar</h4>
            <div class="options">
                <a href="javascript:;" class="panel-collapse"><i class="icon-chevron-down"></i></a>
            </div>
        </div>
        <div class="panel-body collapse in">
            <div id='calendar-drag'></div>
        </div>
    </div>
</div>

<script language="JavaScript">

    $(document).ready(function() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        var calendar = $('#calendar-drag').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            selectable: false, //true,
            selectHelper: true,
            eventLimit: true,
            select: function(start, end, allDay) {
                var title = prompt('Event Title:');
                if (title) {
                    calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                        true // make the event "stick"
                    );
                }
                calendar.fullCalendar('unselect');
            },
            editable: false, //true,
            events: [
                <?php
                    $current_year = date('Y');
                    
                    if($info){
                        foreach($info as $item){
                            //$bd2 = date("-m-d", date("-m-d",strtotime($item["birthday"]));
                            $day = date("d", strtotime($item["birthday"]));
                            $month = date("m", strtotime($item["birthday"]));

                            echo "
                             {                                            
                            allDay: true,
                            start: '".$current_year."-".$month."-".$day."',
                            title: '".$item['name']." - Birthday',
                            backgroundColor: '#F39C12'
                            },{
                            allDay: true,
                            start: '".($current_year + 1)."-".$month."-".$day."',
                            title: '".$item['name']." - Birthday',
                            backgroundColor: '#F39C12'
                            },";
                        }
                    }


                ?>
                
            ],

            buttonText: {
                    prev: '<i class="icon-angle-left"></i>',
                    next: '<i class="icon-angle-right"></i>',
                    prevYear: '<i class="icon-double-angle-left"></i>',  // <<
                    nextYear: '<i class="icon-double-angle-right"></i>',  // >>
                    today:    'Today',
                    month:    'Month',
                    week:     'Week',
                    day:      'Day'
            },
            eventMouseover: function(calEvent, jsEvent) {
                var description = $("#des_"+calEvent.id).text();
                if(description != '')
                    var tooltip = '<div class="tooltipevent" style="color: #fff; background: #4f5259; width:200px; height:auto; position:absolute; z-index:10001; padding: 5px; text-align: justify; border-radius: 2px;">'+description+'</div>';
                else
                    var tooltip = '';
                $("body").append(tooltip);
                $(this).mouseover(function(e) {
                    $(this).css('z-index', 10000);
                    $('.tooltipevent').fadeIn('500');
                    $('.tooltipevent').fadeTo('10', 1.9);
                }).mousemove(function(e) {
                    $('.tooltipevent').css('top', e.pageY + 10);
                    $('.tooltipevent').css('left', e.pageX + 20);
                });
            },

            eventMouseout: function(calEvent, jsEvent) {
                $(this).css('z-index', 8);
                $('.tooltipevent').remove();
            },
        });
    });
</script>
<script type='text/javascript' src='<?php echo base_url();?>public/avant/assets/plugins/fullcalendar/fullcalendar.min.js'></script>
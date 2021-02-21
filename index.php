<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='node_modules/fullcalendar/main.css' rel='stylesheet' />
    <script src='node_modules/fullcalendar/main.js'></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src='https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.4.0/fullcalendar.js"></script>
    <link rel="stylesheet" href="style.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                initialDate: '2021-02-12',
                timeZone: 'UTC',
                editable: true,
                headerToolbar: {
                    left: 'dayGridMonth,listWeek',
                    center: 'title',
                    right: 'custom1, custom2, custom3, prevYear,prev,next,nextYear'
                },
                
                views: {
                    dayGridMonth: {
                        buttonText: 'timeline'
                    },
                    listWeek: {
                        buttonText: 'timeGrid'
                    }
                },
                customButtons: {
                    custom1: {
                        text: 'custom 1',
                        click: function() {
                            calendar.batchRendering(function() {
                                for (let i = 0; i < events.length; i++) {
                                    let event = events[i]
                                    if (!event.allDay) {
                                        event.setProp('display', 'none')
                                    }
                                }
                            })
                        }
                    },
                    custom2: {
                        text: 'custom 2',
                        click: function() {
                            alert('clicked custom button 2!');
                        }
                    },
                    custom3: {
                        text: 'custom 3',
                        click: function() {
                            alert('clicked custom button 3!');
                        }
                    }
                },
                eventDidMount: function(arg) {
                    var cs = document.querySelectorAll(".cs");
                    cs.forEach(function(v) {
                        if (v.checked) {
                            if (arg.event.extendedProps.cid === v.value) {
                                arg.el.style.display = "block";
                            }
                        } else {
                            if (arg.event.extendedProps.cid === v.value) {
                                arg.el.style.display = "none";
                            }
                        }
                    });
                    var tooltip = new Tooltip(arg.el, {
                        title: arg.event.extendedProps.description,
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                },
                // eventDidMount: function(calEvent, element, view) {
                //     if (calEvent.risk == "normal") {
                //         console.log('fgd');
                //         element.css('background-color', '#99FF99');
                //     }
                //     if (calEvent.risk == "event") {
                //         element.css('background-color', '#415eec');
                //     }
                //     if (calEvent.risk == "whisper") {
                //         element.css('background-color', '#D7CDD5');
                //     }
                //     return filter(calEvent); // Only show if appropriate checkbox is checked
                // },
                eventSources: [

                    // your event source
                    {
                        url: '/calendar/data.php',
                        type: 'POST',
                        data: {
                            custom_param1: 'something',
                            custom_param2: 'somethingelse'
                        },
                        error: function() {
                            alert('there was an error while fetching events!');
                        },
                        color: 'yellow', // a non-ajax option
                        textColor: 'black' // a non-ajax option
                    }

                    // any other sources...

                ],

                // select: function(start, end, allDay) {
                //     var check = $.fullCalendar.formatDate(start, 'yyyy-MM-dd');
                //     var today = $.fullCalendar.formatDate(new Date(), 'yyyy-MM-dd');
                //     if (check < today) {
                //         // eventClick: function(info) {
                //         //     info.jsEvent.preventDefault(); // don't let the browser navigate
                //         // },
                //         // Previous Day. show message if you want otherwise do nothing.
                //         // So it will be unselectable
                //     } else {
                //         alert('clicked custom button 3!');
                //         // Its a right date
                //         // Do something
                //     }
                // },
                // dayRender: function(date, cell) {

                //     if (date > maxDate) {
                //         $(cell).addClass('disabled');
                //     }
                // },
                // eventClick: function(info) {
                //     var check = $.fullCalendar.formatDate(start, 'yyyy-MM-dd');
                // var today = $.fullCalendar.formatDate(new Date(), 'yyyy-MM-dd');
                //     info.jsEvent.preventDefault(); // don't let the browser navigate
                // },
                // events: function(fetchInfo, successCallback, failureCallback) {
                //     successCallback([{
                //             id: "1",
                //             title: "event1",
                //             start: "2021-02-22 19:30",
                //             backgroundColor: "#39CCCC",
                //             cid: "1"
                //         },
                //         {
                //             id: "2",
                //             title: "event2",
                //             start: "2021-02-23 19:30",
                //             backgroundColor: "#F012BE",
                //             cid: "2"
                //         }
                //     ]);
                // },
                events: [{
                        start: '2021-02-07',
                        title: 'Normal',
                        cid: "1"
                    }, {
                        start: '2021-02-07',
                        title: 'Event',
                        cid: "2"
                    }, {
                        start: '2021-02-07',
                        title: 'Whisper',
                        risk: 'whisper'
                    },
                    {
                        title: 'All Day Event',
                        description: 'description for All Day Event',
                        url: 'http://google.com/',
                        risk: 'normal',
                        start: '2021-02-01'

                    },
                    {
                        title: 'Long Event',
                        description: 'description for Long Event',
                        start: '2021-02-07',
                        end: '2021-02-10'
                    },
                    {
                        groupId: '999',
                        title: 'Repeating Event',
                        description: 'description for Repeating Event',
                        start: '2021-02-09T16:00:00'
                    },
                    {
                        groupId: '999',
                        title: 'Repeating Event',
                        description: 'description for Repeating Event',
                        start: '2021-02-16T16:00:00'
                    },
                    {
                        title: 'Conference',
                        description: 'description for Conference',
                        start: '2021-02-11',
                        end: '2021-02-13'
                    },
                    {
                        title: 'Meeting',
                        description: 'description for Meeting',
                        start: '2021-02-12T10:30:00',
                        end: '2021-02-12T12:30:00'
                    },
                    {
                        title: 'Lunch',
                        description: 'description for Lunch',
                        start: '2021-02-12T12:00:00'
                    },
                    {
                        title: 'Meeting',
                        description: 'description for Meeting',
                        start: '2021-02-12T14:30:00'
                    },
                    {
                        title: 'Birthday Party',
                        description: 'description for Birthday Party',
                        start: '2021-02-13T07:00:00'
                    },
                    {
                        title: 'Click for Google',
                        description: 'description for Click for Google',
                        url: 'http://google.com/',
                        start: '2021-02-28'
                    }
                ],

            });
            /* When a checkbox changes, re-render events */
            // $('input:checkbox.calFilter').on('change', function() {
            //     $('#calendar').fullCalendar('rerenderEvents');
            // });

            // function filter(calEvent) {
            //     var vals = [];
            //     $('input:checkbox.calFilter:checked').each(function() {
            //         vals.push($(this).val());
            //     });
            //     return vals.indexOf(calEvent.risk) !== -1;

            // }
            calendar.render();
            var csx = document.querySelectorAll(".cs");
            csx.forEach(function(el) {
                el.addEventListener("change", function() {
                    calendar.refetchEvents();
                    console.log(el);
                });
            });
        });
    </script>
</head>

<body>
    <input class="cs" value="1" type="checkbox" checked>Calendar1<br>
    <input class="cs" value="2" type="checkbox" checked>Calendar2
    <div id='calendar'></div>
    <div id='calendar'></div>
</body>

</html>
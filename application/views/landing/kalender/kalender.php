<div id="calendar"></div>

<script>
$(document).ready(function() {
    var currentYear = new Date().getFullYear();
    var calendar = $('#calendar').calendar({
        style: 'custom',
        customDataSourceRenderer: function(element, date, event) {
            // This will override the background-color to the event's color
            $(element).css('background-color', 'red');
            // $(element).css('border-radius', '15px');
        },
        mouseOnDay: function(e) {
            if (e.events.length > 0) {
                var content = '';

                for (var i in e.events) {
                    content += '<div class="event-tooltip-content">' +
                                    '<div class="event-name" style="color:' + e.events[i].color + '">' + e
                                    .events[i].name + '</div>' +
                                    // '<div class="event-location">' + e.events[i].location + '</div>' +
                                '</div>';
                }

                $(e.element).popover({
                    trigger: 'manual',
                    container: 'body',
                    html: true,
                    content: content
                });

                $(e.element).popover('show');
            }
        },
        mouseOutDay: function(e) {
            if (e.events.length > 0) {
                $(e.element).popover('hide');
            }
        },
    });

    $(document).on('click', '.calendar-header', function() {
        // setTimeout(() => {
            getyear($('#calendar').data('calendar').getYear());
        // }, 300);
    })


    // var currentYear = new Date().getFullYear();

    function getyear(year) {
        $.ajax({
            url: __base_url + "api/data/kalenderjson/" + year,
            method: 'POST',
            success: function(data) {
                var kalender = [];
                $.each(data, function(i, value) {
                    kalender.push({
                        id: i,
                        name: value.keterangan,
                        location: value.keterangan,
                        startDate: moment(value.tanggal),
                        endDate: moment(value.tanggal),
                    })
                })
                console.log(kalender);


                $('#calendar').data('calendar').setDataSource(kalender);
            }
        });
    }

    getyear(new Date().getFullYear());


})

// $(function() {
//     var currentYear = new Date().getFullYear();

//     $('#calendar').calendar({ 
//         enableContextMenu: true,
//         enableRangeSelection: true,
//         contextMenuItems:[
//             {
//                 text: 'Update',
//                 click: editEvent
//             },
//             {
//                 text: 'Delete',
//                 click: deleteEvent
//             }
//         ],
//         selectRange: function(e) {
//             editEvent({ startDate: e.startDate, endDate: e.endDate });
//         },
//         mouseOnDay: function(e) {
//             if(e.events.length > 0) {
//                 var content = '';

//                 for(var i in e.events) {
//                     content += '<div class="event-tooltip-content">'
//                                     + '<div class="event-name" style="color:' + e.events[i].color + '">' + e.events[i].name + '</div>'
//                                     + '<div class="event-location">' + e.events[i].location + '</div>'
//                                 + '</div>';
//                 }

//                 $(e.element).popover({ 
//                     trigger: 'manual',
//                     container: 'body',
//                     html:true,
//                     content: content
//                 });

//                 $(e.element).popover('show');
//             }
//         },
//         mouseOutDay: function(e) {
//             if(e.events.length > 0) {
//                 $(e.element).popover('hide');
//             }
//         },
//         dayContextMenu: function(e) {
//             $(e.element).popover('hide');
//         },
//         dataSource: [
//             {
//                 id: 0,
//                 name: 'Google I/O',
//                 location: 'San Francisco, CA',
//                 startDate: new Date(currentYear, 4, 28),
//                 endDate: new Date(currentYear, 4, 29)
//             },
//             {
//                 id: 1,
//                 name: 'Microsoft Convergence',
//                 location: 'New Orleans, LA',
//                 startDate: new Date(currentYear, 2, 16),
//                 endDate: new Date(currentYear, 2, 19)
//             },
//             {
//                 id: 2,
//                 name: 'Microsoft Build Developer Conference',
//                 location: 'San Francisco, CA',
//                 startDate: new Date(currentYear, 3, 29),
//                 endDate: new Date(currentYear, 4, 1)
//             },
//             {
//                 id: 3,
//                 name: 'Apple Special Event',
//                 location: 'San Francisco, CA',
//                 startDate: new Date(currentYear, 8, 1),
//                 endDate: new Date(currentYear, 8, 1)
//             },
//             {
//                 id: 4,
//                 name: 'Apple Keynote',
//                 location: 'San Francisco, CA',
//                 startDate: new Date(currentYear, 8, 9),
//                 endDate: new Date(currentYear, 8, 9)
//             },
//             {
//                 id: 5,
//                 name: 'Chrome Developer Summit',
//                 location: 'Mountain View, CA',
//                 startDate: new Date(currentYear, 10, 17),
//                 endDate: new Date(currentYear, 10, 18)
//             },
//             {
//                 id: 6,
//                 name: 'F8 2015',
//                 location: 'San Francisco, CA',
//                 startDate: new Date(currentYear, 2, 25),
//                 endDate: new Date(currentYear, 2, 26)
//             },
//             {
//                 id: 7,
//                 name: 'Yahoo Mobile Developer Conference',
//                 location: 'New York',
//                 startDate: new Date(currentYear, 7, 25),
//                 endDate: new Date(currentYear, 7, 26)
//             },
//             {
//                 id: 8,
//                 name: 'Android Developer Conference',
//                 location: 'Santa Clara, CA',
//                 startDate: new Date(currentYear, 11, 1),
//                 endDate: new Date(currentYear, 11, 4)
//             },
//             {
//                 id: 9,
//                 name: 'LA Tech Summit',
//                 location: 'Los Angeles, CA',
//                 startDate: new Date(currentYear, 10, 17),
//                 endDate: new Date(currentYear, 10, 17)
//             }
//         ]
//     });

//     $('#save-event').click(function() {
//         saveEvent();
//     });
// });
</script>
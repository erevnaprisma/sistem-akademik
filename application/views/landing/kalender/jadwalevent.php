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
            url: __base_url + "api/data/kalendereventjson/" + year,
            method:'POST',
            success: function(data) {
                var kalender = [];
                $.each(data, function(i, value) {
                    kalender.push({
                        id: i,
                        name: value.kegiatan,
                        location: value.lokasi,
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
</script>
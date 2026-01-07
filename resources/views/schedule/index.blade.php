<div class="container mt-5">
    <div class="row">
        <h1>Laravel 12 Schedule Calendar | Fullcalendar</h1>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Search events">
                <div class="input-group-append">
                    <button id="searchButton" class="btn btn-primary">Search</button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            Color : <input type="color" id="myColor" class='form-control' name="colorpicker" onchange="myFunction()" />
            <p id="demo"></p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div id="calendar" style="width: 100%;height:100vh"></div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>
<!--fullcalendar.io/docs/initialize-globals-->

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var calendarEl = document.getElementById('calendar');
    var events = [];
    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialView: 'dayGridMonth',
        events: '/events',
        editable: true,
        selectable: true,
        select: function (info) {
            var title = prompt('Event Title:');
            var color = prompt("Color", "#0d6efd");
            if (title && color) {
                //alert('selected ' + info.startStr + ' to ' + info.endStr);
                $.ajax({
                    url: "/create-schedule",
                    data: 'title=' + title + '&start=' + info.startStr + '&end=' + info.endStr + '&color=' + color + '&_token=' + "{{ csrf_token() }}",
                    type: "post",
                    success: function (data) {
                        alert("Added Successfully");
                        calendar.refetchEvents(); // Refresh events
                    }
                });

            }
        },
        // Drag And Drop
        eventDrop: function (info) {
            var eventId = info.event.id;
            var newStartDate = info.event.start;
            var newEndDate = info.event.end || newStartDate;
            var newStartDateUTC = newStartDate.toISOString().slice(0, 10);
            var newEndDateUTC = newEndDate.toISOString().slice(0, 10);

            $.ajax({
                method: 'post',
                url: `/schedule/${eventId}`,
                data: {
                    '_token': "{{ csrf_token() }}",
                    start_date: newStartDateUTC,
                    end_date: newEndDateUTC,
                },
                success: function (response) {
                    alert(response.message);
                    console.log(newStartDateUTC, newEndDateUTC);
                    console.log('Event moved successfully.');
                },
                error: function (error) {
                    console.error('Error moving event:', error);
                }
            });
        },
        // Deleting The Event
        eventContent: function (info) {
            var eventTitle = info.event.title;
            var eventElement = document.createElement('div');
            eventElement.innerHTML = '<span style="cursor: pointer;">❌</span> ' + eventTitle;

            eventElement.querySelector('span').addEventListener('click', function () {
                if (confirm("Are you sure you want to delete this event?")) {
                    var eventId = info.event.id;
                    $.ajax({
                        method: 'get',
                        url: '/schedule/delete/' + eventId,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            alert(response.message);
                            console.log('Event deleted successfully.');
                            calendar.refetchEvents(); // Refresh events after deletion
                        },
                        error: function (error) {
                            console.error('Error deleting event:', error);
                        }
                    });
                }
            });
            return {
                domNodes: [eventElement]
            };
        },
    });
    calendar.render();

    function myFunction() {
        var x = document.getElementById("myColor").value;
        document.getElementById("demo").innerHTML = x;
    }
</script>
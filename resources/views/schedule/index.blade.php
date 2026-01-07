<x-layouts.anonyme :title="__('Calendrier des réservations')">
    <div class="container">
<div class="row">
    <h1 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 mb-2">
        Calendrier des réservations
    </h1>

    <div class="my-2 col-md-6">
        <h2 class="text-base sm:text-lg font-bold text-gray-900 mb-1">
            Color picker
        </h2>

        <div class="flex items-center gap-2 sm:gap-3">
            <input
                type="color"
                id="myColor"
                class="h-8 w-8 sm:h-10 sm:w-10 rounded-md shadow-inner"
                name="colorpicker"
                onchange="myFunction()"
            />

            <input type="text" id="myInput" class="hidden" />

            <button
                onclick="copyToClipboard()"
                class="text-sm sm:text-base bg-blue-500 hover:bg-blue-700 text-white font-semibold py-1.5 px-3 sm:py-2 sm:px-4 rounded"
            >
                <span id="myTooltip">Copier la couleur</span>
            </button>
        </div>
    </div>
</div>


        <div class="relative flex flex-col min-w-0 break-words bg-white">
            <div class="flex-1 lg:p-10 p-2">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
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
                left: '',
                center: 'title prev,next today',
                right: ''
            },
            initialView: 'dayGridMonth',
            locale: 'fr',
            height: '70vh',
            longPressDelay: 1000,
            events: '/events',
            editable: true,
            selectable: true,
            select: function (info) {
                var title = prompt('Event Title:');
                var color = prompt("Color", "#0d6efd");
                if (title && color) {
var startDate = new Date(info.startStr);
startDate.setMinutes(startDate.getMinutes() - startDate.getTimezoneOffset());
var startStr = startDate.toISOString().slice(0, 19).replace('T', ' ');

$.ajax({
    url: "/create-schedule",
    type: "POST",
    data: {
        title: title,
        start: startStr,
        end: info.endStr,
        color: color,
        _token: "{{ csrf_token() }}"
    },
    success: function(data) {
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
                newStartDate.setMinutes(newStartDate.getMinutes()-newStartDate.getTimezoneOffset());
                newEndDate.setMinutes(newEndDate.getMinutes()-newEndDate.getTimezoneOffset());
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
        //color picker
        function myFunction() {
            var x = document.getElementById("myColor").value;
            document.getElementById("myInput").value = x;
        }
        //clipboard
        function copyToClipboard() {
            // Get the text field
            var copyText = document.getElementById("myInput");

            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);


            var tooltip = document.getElementById("myTooltip");
            tooltip.innerHTML = "Copié: " + copyText.value;
        }

    </script>
</x-layouts.anonyme>
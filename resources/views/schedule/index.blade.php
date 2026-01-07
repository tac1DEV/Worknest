<x-layouts.anonyme :title="__('Calendrier des réservations')">
    <div class="container mt-5">
        <div class="row">
            <h1 class="text-3xl font-bold text-gray-900">Calendrier des réservations</h1>
            <div class="my-4 col-md-6">
            <h2 class="text-xl font-bold text-gray-900">Color picker</h2>
            <div class="flex gap-4 items-center">
                <input type="color" id="myColor" class='h-12 w-12 rounded-lg shadow-inner' name="colorpicker"
                    onchange="myFunction()" />
                <!-- The text field -->
                <input type="text" id="myInput" class="hidden" />

                <!-- The button used to copy the text -->
                <button onclick="copyToClipboard()" onmouseout="outFunc()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">

                    <span class="tooltiptext" id="myTooltip">Copier la couleur</span>
                </button>
            </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div id="calendar" style="width: 100%;height:100vh"></div>
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

        function outFunc() {
            var tooltip = document.getElementById("myTooltip");
            tooltip.innerHTML = "Copier la couleur";
        }

    </script>
</x-layouts.anonyme>
<x-layouts.app :title="'Calendrier - ' . $espace->nom">
    <div class="min-h-screen">
        <div>
            <div class="mb-6">
                <a href="{{ route('espaces.show', $espace->id) }}"
                    class="inline-flex items-center text-cyan-500 hover:underline mb-3">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Retour
                </a>
                <h2 class="text-2xl font-bold text-cyan-500">{{ $espace->nom }}</h2>
                <p class="text-gray-600 mt-1">Calendrier des réservations</p>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Personnaliser la couleur</h3>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-3">
                        <label for="myColor" class="text-sm text-gray-600">Couleur:</label>
                        <input type="color" id="myColor"
                            class="h-12 w-12 rounded-lg border-2 border-gray-200 cursor-pointer hover:border-cyan-500 transition-colors"
                            name="colorpicker" onchange="myFunction()" />
                    </div>
                    <input type="text" id="myInput" class="hidden" />
                    <button onclick="copyToClipboard()"
                        class="px-4 py-2 bg-cyan-500 text-white rounded-lg font-medium hover:bg-cyan-600 transition-colors">
                        <span id="myTooltip">Copier la couleur</span>
                    </button>
                </div>
            </div>

            <div>
                <div class="p-4 lg:p-6">
                    <div id="calendar"></div>
                </div>
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
        var espaceId = @json($espace->id);
        var currentUserId = @json(Auth::id());
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
            events: `/events?espace_id=${espaceId}`,
            editable: true,
            selectable: true,
            select: function (info) {
                var title = prompt('Titre de la réservation:');
                var color = prompt("Choisissez une couleur", "#0d6efd");
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
                            espace_id: espaceId,
                            user_id: currentUserId,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (data) {
                            console.log(data);
                            //URL DEGUEU
                            // const params = new URLSearchParams({ result: JSON.stringify(data) }).toString();
                            // window.location.replace(`/stripe?${params}`);
                            sessionStorage.setItem('stripeData', JSON.stringify(data));
                            window.location.replace('/stripe');
                        },
                        error: function (error, data) {
                            console.error('Erreur lors de la création de la réservation:', data);
                        }
                    });


                }
            },
            // Drag And Drop
            eventDrop: function (info) {
                var eventId = info.event.id;
                var newStartDate = info.event.start;
                var newEndDate = info.event.end || newStartDate;
                newStartDate.setMinutes(newStartDate.getMinutes() - newStartDate.getTimezoneOffset());
                newEndDate.setMinutes(newEndDate.getMinutes() - newEndDate.getTimezoneOffset());
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
                        console.log('La réservation a été modifiée.');
                    },
                    error: function (error) {
                        console.error('Erreur lors de la modification de la réservation:', error);
                    }
                });
            },
            // Deleting The Event
            eventContent: function (info) {
                var eventUserId = info.event.extendedProps.user_id;
                if (eventUserId !== currentUserId) {
                    return {
                        domNodes: [document.createTextNode(info.event.title)]
                    };
                }
                var eventTitle = info.event.title;
                var eventElement = document.createElement('div');
                eventElement.innerHTML = '<span style="cursor: pointer;">❌</span> ' + eventTitle;

                eventElement.querySelector('span').addEventListener('click', function () {
                    if (confirm("Voulez-vous vraiment supprimer cette réservation ?")) {
                        var eventId = info.event.id;
                        $.ajax({
                            method: 'get',
                            url: '/schedule/delete/' + eventId,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                alert(response.message);
                                console.log('Réservation supprimée.');
                                calendar.refetchEvents(); // Refresh events after deletion
                            },
                            error: function (error) {
                                console.error('Erreur lors de la suppression de la réservation:', error);
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
</x-layouts.app>
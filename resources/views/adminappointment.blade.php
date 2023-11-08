@extends('layouts.adminlayout')

@section('')
    <script>
        function confirmAcceptAppointment(appointmentId) {
            if (confirm('Are you sure you want to accept this appointment?')) {
                document.getElementById('accept-form-' + appointmentId).submit();
            } else {
                // Prevent form submission if the user cancels
                event.preventDefault(); // Add this line to prevent the default form submission
            }
        }

        function confirmReason(appointmentId) {
            if (confirm('Are you sure you want to decline this appointment?')) {
                document.getElementById('decline-form-' + appointmentId).submit();
            } else {
                // Prevent form submission if the user cancels
                event.preventDefault(); // Add this line to prevent the default form submission
            }
        }

        function declineAppointment(appointmentId) {
            var modal = document.getElementById("declineReason");
            modal.classList.toggle("hidden"); // Toggle the 'hidden' class to show/hide the modal
        }


        function fadeOutAlert(alertId) {
            setTimeout(function() {
                var alert = document.getElementById(alertId);
                if (alert) {
                    alert.style.transition = "opacity 1s";
                    alert.style.opacity = 0;
                    setTimeout(function() {
                        alert.style.display = "none";
                    }, 1000);
                }
            }, 2500);
        }
        fadeOutAlert("alert");

        function markAsDone(appointmentId) {
            if (confirm('Are you sure you want to mark as done this appointment?')) {
                document.getElementById('markAsDone-form-' + appointmentId).submit();
            } else {
                // Prevent form submission if the user cancels
                event.preventDefault(); // Add this line to prevent the default form submission
            }
        }
    </script>
    <div class="flex justify-center items-center h-full space-x-20 relative">

        <div class="absolute top-2 w-96 text-center">
            @if (session()->has('success'))
                <div id="alert" class="bg-green-300 p-3 rounded-lg text-green-700 font-semibold shadow-md">
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('decline'))
                <div id="alert" class="bg-red-300 p-3 rounded-lg text-red-700 font-semibold shadow-md">
                    {{ session('decline') }}
                </div>
            @endif

            @if (session()->has('delete'))
                <div id="alert" class="bg-green-300 p-3 rounded-lg text-green-700 font-semibold shadow-md">
                    {{ session('delete') }}
                </div>
            @endif
        </div>

        <!-- Left Column: Pending Appointments -->
        <div class="w-2/6 p-6 bg-white rounded shadow-md h-[700px] overflow-y-auto">
            <div class="border-b-2 border-black pb-4 mb-6">
                <h2 class="text-3xl font-bold text-black text-center">Waiting For Approval</h2>
            </div>
            @foreach ($appointments as $appointment)
                <!-- The declineReason modal -->
                <div id="declineReason"
                    class="fixed flex justify-center items-center top-0 left-0 h-screen w-screen bg-opacity-50 bg-gray-600 z-50 hidden">
                    <div class="bg-white p-4 rounded-lg shadow-lg w-11/12 md:w-1/2">
                        <div class="flex justify-end">
                            <button class="text-gray-600 hover:text-gray-800 text-2xl"
                                onclick="declineAppointment()">&times;</button>

                        </div>
                        <h2 class="text-2xl font-semibold mb-4">Reason for Declining</h2>
                        <form id="decline-form-{{ $appointment->id }}" action="/decline-appointment/{{ $appointment->id }}"
                            method="POST" class="mb-4">
                            @csrf
                            @method('PATCH')
                            <select id="reasonSelect" name="reason" class="w-full bg-gray-100 p-2 rounded-md">
                                <option value="Not available">Not available</option>
                                <option value="Conflict of Schedule">Conflict of Schedule</option>
                                <option value="Other">Other</option>
                            </select>
                            <button type="button" onclick="confirmReason('{{ $appointment->id }}')"
                                class="bg-blue-500 text-white px-4 py-2 rounded-md mt-4 hover:bg-blue-600">Submit</button>

                        </form>
                    </div>
                </div>

                @if ($appointment->status === 'waiting for approval')
                    <div class="mb-4 p-4 bg-gray-100 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold">{{ $appointment->reason }}</h3>
                        <p class="text-gray-600">Student: {{ $appointment->user->name }}</p>
                        <p class="text-gray-600">Date: {{ \Carbon\Carbon::parse($appointment->date)->format('F j, Y') }}</p>
                        <p class="text-gray-600">Time: {{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}</p>
                        <p class="text-gray-600">Type: {{ $appointment->type }}</p>
                        <p class="text-gray-600">Status: {{ $appointment->status }}</p>

                        <div class="flex justify-between mt-4">
                            <form id="accept-form-{{ $appointment->id }}"
                                action="/accept-appointment/{{ $appointment->id }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button onclick="confirmAcceptAppointment('{{ $appointment->id }}')" type="submit"
                                    class="bg-green-500 text-white px-4 py-2 rounded-full">Accept</button>
                            </form>


                            <button onclick="declineAppointment('{{ $appointment->id }}')" type="submit"
                                class="bg-red-500 text-white px-4 py-2 rounded-full">Decline</button>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>



        <!-- Right Column: Appointments -->
        <div class="w-1/3 p-6 bg-accent rounded shadow-md h-[700px] overflow-y-auto">
            <div class="border-b-2 border-black pb-4 mb-6">
                <h2 class="text-3xl font-bold text-black text-center">Appointments</h2>
            </div>
            @foreach ($acceptedAppointments as $acceptedAppointment)
                @php
                    $currentDateTime = \Carbon\Carbon::now();
                    $meetingDateTime = \Carbon\Carbon::parse($acceptedAppointment->appointment->date . ' ' . $acceptedAppointment->appointment->time);
                    $timeDiff = $currentDateTime->diff($meetingDateTime);
                    $daysLeft = $timeDiff->days;
                    $hoursLeft = $timeDiff->h;
                    $minutesLeft = $timeDiff->i;
                    $secondsLeft = $timeDiff->s;
                    $daysLabel = $daysLeft === 1 ? 'day' : 'days';
                    $hoursLabel = $hoursLeft === 1 ? 'hour' : 'hours';
                    $minutesLabel = $minutesLeft === 1 ? 'minute' : 'minutes';
                    $secondsLabel = $secondsLeft === 1 ? 'second' : 'seconds';

                @endphp
                <div class="mt-5 p-4 bg-white border border-gray-300 rounded shadow-md">
                    <h3 class="text-lg font-semibold">{{ $acceptedAppointment->appointment->reason }}</h3>
                    <p class="text-gray-600">Student: {{ $acceptedAppointment->appointment->user->name }}</p>
                    <p class="text-gray-600">Date:
                        {{ \Carbon\Carbon::parse($acceptedAppointment->appointment->date)->format('F j, Y') }}</p>
                    <p class="text-gray-600">Time:
                        {{ \Carbon\Carbon::parse($acceptedAppointment->appointment->time)->format('h:i A') }}</p>
                    <p class="text-gray-600">Type: {{ $acceptedAppointment->appointment->type }}</p>
                    @if ($daysLeft > 0 || $hoursLeft > 0 || $minutesLeft > 0 || $secondsLeft > 0)
                        @if ($currentDateTime < $meetingDateTime)
                            <p class="text-gray-600">
                                Meeting starts in
                                @if ($daysLeft > 0)
                                    {{ $daysLeft }} {{ $daysLabel }},
                                @endif
                                @if ($hoursLeft > 0)
                                    {{ $hoursLeft }} {{ $hoursLabel }},
                                @endif
                                @if ($minutesLeft > 0)
                                    {{ $minutesLeft }} {{ $minutesLabel }},
                                @endif
                                @if ($secondsLeft > 0)
                                    {{ $secondsLeft }} {{ $secondsLabel }}
                                @endif
                            </p>
                        @else
                            <p class="text-gray-600 font-bold">Meeting should start now</p>
                            <button
                                class="text-amber-600 bg-amber-200 px-4 py-2 rounded-xl hover:bg-amber-300 font-semibold hover:text-white hover:no-underline mt-2 w-full">
                                Contact Student
                            </button>
                        @endif
                    @endif

                    @php
                        $minutesAfterAppointment = $meetingDateTime->addMinutes(30);
                        $isButtonDisabled = $currentDateTime < $minutesAfterAppointment;
                    @endphp



                    <form action="/markAsDone/{{ $acceptedAppointment->appointment_id }}" method="POST"
                        id="markAsDone-form-{{ $acceptedAppointment->id }}">
                        @csrf
                        @method('DELETE')
                        <button
                            @if ($isButtonDisabled) disabled
                            class="text-gray-600 bg-gray-300 px-4 py-2 rounded-xl font-semibold w-full mt-3"
                                title="Mark as Done button will be available 30 minutes after the appointment time."
                                @else
                                class="text-green-600 bg-green-200 px-4 py-2 rounded-xl hover:bg-green-300 font-semibold hover:text-white hover:no-underline w-full mt-3"
                                 onclick="markAsDone('{{ $acceptedAppointment->appointment_id }}')" @endif>
                            Mark as Done
                        </button>
                    </form>



                </div>
            @endforeach
        </div>


    </div>
@endsection

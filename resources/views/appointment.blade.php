@extends('layouts.layout')

@section('content')
    <script>
        function confirmDeletePost(appointmentId) {
            if (confirm('Are you sure you want to cancel this appointment?')) {
                document.getElementById('delete-form-' + appointmentId).submit();
            } else {
                // Prevent form submission if the user cancels
                event.preventDefault(); // Add this line to prevent the default form submission
            }
        }

        function confirmUnderstand(appointmentId) {
            if (confirm('We encourage you to choose another suitable time.')) {
                document.getElementById('understand-form-' + appointmentId).submit();
            } else {
                // Prevent form submission if the user cancels
                event.preventDefault(); // Add this line to prevent the default form submission
            }
        }

        function fadeOutAlert(alertId) {
            setTimeout(function() {
                var alert = document.getElementById(alertId);
                if (alert) {
                    alert.style.transition = "opacity 1s";
                    alert.style.opacity = 0;
                    setTimeout(function() {
                        alert.style.visibility = "hidden";
                    }, 1000);
                }
            }, 3000);
        }
        fadeOutAlert("alert");
    </script>


    <div class="flex justify-center items-center h-full relative ">

        <div
            class="flex flex-col md:flex-row sm:space-x-0 md:space-x-10 lg:space-x-10 w-full justify-center items-center h-full pb-10 pt-10">
            <!-- Alert Message -->
            <div class="absolute top-2 left-1/2 transform -translate-x-1/2 text-center">
                @if (session()->has('success'))
                    <div id="alert" class="bg-green-300 p-3 rounded-lg text-green-700 font-semibold shadow-md">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session()->has('delete'))
                    <div id="alert" class="bg-red-300 p-3 rounded-lg text-red-700 font-semibold shadow-md">
                        {{ session('delete') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div id="alert" class="bg-red-300 p-3 rounded-lg text-red-700 font-semibold shadow-md">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session()->has('understand'))
                    <div id="alert" class="bg-green-300 p-3 rounded-lg text-green-700 font-semibold shadow-md">
                        {{ session('understand') }}
                    </div>
                @endif

                @if (session()->has('one'))
                    <div id="alert" class="bg-red-300 p-3 rounded-lg text-red-700 font-semibold shadow-md">
                        {{ session('one') }}
                    </div>
                @endif
            </div>


            <!-- Left Column: Booking Form -->
            <div
                class="w-[80%] sm:w-[65%] md:w-[40%] lg:w-[35%] p-4 md:p-6 bg-white rounded shadow-md h-[500px] md:h-full lg:h-full self-center">
                <div class="border-b-2 border-black pb-4 mb-6">
                    <h2 class="text-3xl font-bold text-black text-center">Book Your Appointment</h2>
                </div>
                <form action="/book-appointment" method="POST" class="space-y-4">
                    @csrf

                    <div class="mb-4">
                        <label for="appointment_date" class="block text-gray-600">Appointment Date:</label>
                        <input type="date" name="appointment_date" id="appointment_date" min="<?php echo date('Y-m-d'); ?>"
                            class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:border-blue-500"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="appointment_time" class="block text-gray-600">Appointment Time:</label>
                        <input type="time" name="appointment_time" id="appointment_time"
                            class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:border-blue-500"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-600">Select Appointment Type:</label>
                        <div>
                            <label for="online" class="flex items-center">
                                <input type="radio" name="appointment_type" id="online" value="Online" class="mr-2"
                                    required>
                                Online
                            </label>
                            <label for="onsite" class="flex items-center">
                                <input type="radio" name="appointment_type" id="onsite" value="Onsite" class="mr-2"
                                    required>
                                Onsite
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="appointment_reason" class="block text-gray-600">Reason:</label>
                        <div>
                            <select name="appointment_reason" id="appointment_reason"
                                class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:border-blue-500"
                                required>
                                <option value="" disabled selected>Select a reason</option>
                                <option value="Emotional Support">Emotional Support</option>
                                <option value="Academic Advising">Academic Advising</option>
                                <option value="Special Needs and Accommodations">Special Needs and Accommodations</option>
                                <option value="Extracurricular Activities">Extracurricular Activities</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">
                        Book
                    </button>
                </form>
            </div>

            <!-- Right Column: Pending Appointments -->
            <div
                class="w-[80%] sm:w-[65%] md:w-[40%] lg:w-[35%] p-4 bg-accent rounded shadow-md h-[50%] md:h-[50%] lg:h-[50%] lg:overflow-y-auto mt-8 md:mt-0 md:self-start lg:self-start">
                <div class="border-b-2 border-black pb-4 mb-6">
                    <h2 class="text-3xl font-bold text-black text-center">Appointment</h2>
                </div>
                <ul>
                    @foreach ($appointments as $appointment)
                        @auth
                            @if (auth()->user()->id === $appointment->user->id)
                                @php
                                    $currentDateTime = \Carbon\Carbon::now();
                                    $meetingDateTime = \Carbon\Carbon::parse($appointment->date . ' ' . $appointment->time);
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

                                <div class="mb-2 bg-gray-100 border border-gray-300 rounded p-4">
                                    <h3 class="text-lg font-semibold">{{ $appointment->reason }}</h3>
                                    @if ($currentDateTime > $meetingDateTime && $appointment->status === 'approved')
                                        <p class="text-gray-600 font-bold">Meeting should start now</p>
                                        <button
                                            class="text-amber-600 bg-amber-200 px-4 py-2 rounded-xl hover:bg-amber-300 font-semibold hover:text-white hover:no-underline mt-2 w-full">
                                            Contact Counselor
                                        </button>
                                    @else
                                        <p class="text-gray-600">Date:
                                            {{ \Carbon\Carbon::parse($appointment->date)->format('F j, Y') }}</p>
                                        <p class="text-gray-600">Time:
                                            {{ \Carbon\Carbon::parse($appointment->time)->format('h:i:s A') }}</p>
                                        <p class="text-gray-600">Type: {{ $appointment->type }}</p>

                                        <p class="text-gray-600">Counselor:
                                            @if ($appointment->counselor)
                                                {{ $appointment->counselor->name }}
                                            @else
                                                Not yet assigned
                                            @endif
                                        </p>



                                        @if ($appointment->status === 'waiting for approval')
                                            <p class="text-gray-600">
                                                <span class="text-gray-600">Status:</span>
                                                <span style="color: orange">
                                                    {{ $appointment->status }}
                                                </span>
                                            </p>
                                        @elseif ($appointment->status === 'approved')
                                            <p class="text-gray-600">
                                                <span class="text-gray-600">Status:</span>
                                                <span style="color: green">
                                                    {{ $appointment->status }}
                                                </span>
                                            </p>
                                        @else
                                            <p class="text-gray-600">
                                                <span class="text-gray-600">Status:</span>
                                                <span style="color: red">
                                                    {{ $appointment->status }}
                                                </span>
                                            </p>

                                            <button onclick="confirmUnderstand('{{ $appointment->id }}')"
                                                class="text-amber-700 px-4 py-2 rounded-xl bg-amber-100 hover:bg-amber-200 font-semibold hover:text-white hover:no-underline mt-2 w-full">
                                                I understand
                                            </button>
                                            <form id="understand-form-{{ $appointment->id }}"
                                                action="/understand-appointment/{{ $appointment->id }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif

                                        @if ($appointment->status === 'approved')
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
                                        @endif
                                        @if ($appointment->status === 'waiting for approval')
                                            <button onclick="confirmDeletePost('{{ $appointment->id }}')"
                                                class="text-red-700 px-4 py-2 rounded-xl bg-red-100 hover:bg-red-200 font-semibold hover:text-white hover:no-underline mt-2 w-full">
                                                Cancel
                                            </button>
                                            <form id="delete-form-{{ $appointment->id }}"
                                                action="/cancel-appointment/{{ $appointment->id }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            @endif
                        @endauth
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

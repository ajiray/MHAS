@extends('layouts.adminlayout')

@section('content')
    <div
        class="flex justify-center items-center h-full w-full flex-col space-y-10 pb-10 xl:pb-0 xl:space-y-0 xl:space-x-32 xl:flex-row relative">

        @if (session()->has('success'))
            <div class="absolute top-5 left-10 flex items-center justify-center w-full p-4 md:w-96 md:p-6">
                <div class="bg-green-300 rounded-lg text-green-700 font-semibold shadow-md p-2 md:p-4 md:text-base">
                    {{ session('success') }}
                </div>
            </div>
        @endif


        <!-- Registration Form -->
        <form action="/registerGuidance" method="post"
            class="bg-white shadow-md rounded-lg w-[80%] p-5 mt-5 xl:mt-0 xl:p-6 xl:w-[40%]">
            @csrf
            <h2 class="text-3xl font-bold mb-6 text-center">User Registration</h2>

            <div class="mb-4">
                <label for="fullname" class="block text-gray-700 font-bold mb-2">Full Name</label>
                <input type="text" name="fullname" id="fullname"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" required
                    autocomplete="off">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" required
                    autocomplete="off">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <!-- Hidden input for the value of 2 -->
            <input type="hidden" name="userType" value="2">

            <button type="submit"
                class="bg-adminPrimary text-white px-4 py-2 rounded-md hover:bg-sky-700 focus:outline-none focus:shadow-outline-blue active:bg-green-800 w-full mt-2">
                Register
            </button>
        </form>


        <div
            class="bg-gradient-to-b from-adminPrimary to-gradientBlue w-[80%] h-80 p-5 mt-5 xl:mt-0 xl:h-[85%] xl:p-8 xl:w-[40%] overflow-y-auto rounded-xl">
            <h2 class="text-2xl font-bold text-white mb-4 text-center">Pending Student Registrations</h2>

            @foreach ($pendingUsers as $user)
                <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                    <p class="text-lg font-bold mb-2">Name: {{ $user->name }}</p>
                    <p>Email: {{ $user->email }}</p>
                    <p>Student Number: {{ $user->student_number }}</p>
                    <p>Course: {{ $user->course }}</p>
                    <p>Age: {{ $user->age }}</p>
                    <p>Birthday: {{ $user->birthday }}</p>
                    <div class="flex mt-3">
                        <form method="post" action="{{ route('admin.approve-user', $user->id) }}"
                            onsubmit="return confirm('Are you sure you want to approve this user?');">
                            @csrf
                            <button type="submit"
                                class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:shadow-outline-green active:bg-green-800 mr-2">Approve</button>
                        </form>
                        <form method="post" action="{{ route('admin.decline-user', $user->id) }}"
                            onsubmit="return confirm('Are you sure you want to decline this user?');">
                            @csrf
                            <button type="submit"
                                class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-red active:bg-red-800">Decline</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <script>
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
            }, 2500); // 2500 milliseconds (2.5 seconds)
        }

        // Call the fadeOutAlert function for each alert message
        fadeOutAlert("alert");
    </script>
@endsection

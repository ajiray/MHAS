@extends('layouts.app')

@section('content')
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>


    <div class="flex w-screen h-screen items-center justify-center">

        <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl">
            <div class="sm:w-3/5 px-16 relative">
                <a href="/"
                    class="flex items-center text-gray-700 hover:text-blue-500 transition duration-300 ease-in-out absolute left-2 top-5">
                    <i class="fas fa-chevron-left fa-lg mr-1"></i>
                    <span class="text-sm">Back</span>
                </a>
                <h1 class="font-bold text-maroon text-center text-xl mt-3">SIGN UP</h1>

                <form method="POST" action="{{ route('register') }}" class="flex flex-col">
                    @csrf
                    <input id="name" type="text"
                        class="@error('name') is-invalid @enderror ml-[5px] p-2 px-2 rounded-xl border mt-1" name="name"
                        value="{{ old('name') }}" required autofocus placeholder="Full Name" autocomplete="off">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <input id="email" type="email"
                        class="@error('email') is-invalid @enderror ml-[5px] p-2 rounded-xl border" name="email"
                        value="{{ old('email') }}" required autocomplete="off" placeholder="Email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <input id="student_number" type="text" class="ml-[5px] p-2 rounded-xl border" name="student_number"
                        required autocomplete="off" placeholder="Student Number">
                    <br>
                    <input id="course" type="text" class="ml-[5px] p-2 rounded-xl border" name="course" required
                        autocomplete="off" placeholder="Course">
                    <br>
                    <input id="age" type="number" class="ml-[5px] p-2 rounded-xl border" name="age" required
                        autocomplete="off" placeholder="Age">
                    <br>
                    <label for="birthday" class="ml-2">Birthday</label>
                    <input id="birthday" type="date" class="ml-[5px] p-2 rounded-xl border" name="birthday" required
                        autocomplete="off">


                    <br>
                    <button class="border bg-maroon rounded-full text-white font-medium text-md w-full p-2"
                        type="submit">{{ __('Register') }}</button><br>
                </form>
            </div>
            <div
                class="sm:block hidden bg-gradient-to-b from-maroon via-maroon to-yellow w-[480px] h-[500px] rounded-2xl relative">
                <i class="fa-solid fa-circle-info fa-lg absolute right-3 top-5 text-white cursor-pointer"
                    onclick="toggleInfo()"></i>
                <div class="mt-10 text-center flex items-center justify-center">
                    <span class="text-white text-4xl font-bold" style="text-shadow: 0 0 10px #ffffff;">Mind</span>
                    <span class="text-yellow text-4xl font-bold" style="text-shadow: 0 0 10px #ecb222;">Scape</span>
                </div>
                <h1 class="text-center text-yellow font-bold text-xl mt-[130px]">University of Perpetual Help
                    System Dalta Las Pinas</h1>
                <h1 class="text-center text-maroon font-bold text-xl mt-[130px]">Mental Health Awareness System</h1>
            </div>

            <div class="w-96 p-8 bg-maroon rounded-lg shadow-md hidden absolute right-24 animate__animated" id="info">
                <button class="material-symbols-outlined absolute top-4 right-4 text-gray-600" onclick="closeInfo()">
                    <i class="fa-solid fa-x fa-lg text-white"></i>
                </button>

                <h1 class="text-3xl font-bold text-white mb-4">Instructions</h1>

                <ol class="list-decimal pl-4 text-white">
                    <li class="mb-2">Sign up by filling in all your details.</li>
                    <li class="mb-2">Wait for the counselor to review and accept your registration.</li>
                    <li class="mb-2">The counselor will email you a temporary password.</li>
                    <li>Log in using the temporary password and change it once logged in.</li>
                </ol>

            </div>
        </div>



    </div>
    <script>
        function toggleInfo(event) {

            var mobileInfo = document.getElementById("info");
            mobileInfo.classList.toggle("hidden");
            mobileInfo.classList.add("animate__fadeInUp");
        }

        function closeInfo(event) {
            var mobileInfo = document.getElementById("info");

            // Add the slide-out animation class
            mobileInfo.classList.add("animate__fadeOutDown");

            // Remove the slide-in animation class
            mobileInfo.classList.remove("animate__fadeInUp");

            // After the animation is complete, hide the options and reset classes
            setTimeout(function() {
                mobileInfo.classList.add("hidden");
                mobileInfo.classList.remove("animate__fadeOutDown");
            }, 800); // Adjust the timeout based on your animation duration

            // Stop event propagation

        }
    </script>
@endsection

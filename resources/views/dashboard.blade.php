@extends('layouts.layout')

@section('content')
    <div class="flex justify-center h-20 items-center mt-5 relative">

        <x-woym />

        @if (session()->has('success'))
            <div class="absolute top-0 left-0 mt-5 ml-10 sm:ml-20 md:ml-32" id="alert">
                <div class="bg-green-300 p-3 rounded-lg text-green-700 font-semibold shadow-md">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session()->has('delete'))
            <div class="absolute top-0 right-0 mt-5 mr-10 sm:mr-20 md:mr-32" id="alert">
                <div class="bg-red-300 p-3 rounded-lg text-red-700 font-semibold shadow-md">
                    {{ session('delete') }}
                </div>
            </div>
        @endif

        @if (session()->has('comment'))
            <div class="absolute top-0 left-0 mt-5 ml-10 sm:ml-20 md:ml-32" id="alert">
                <div class="bg-green-300 p-3 rounded-lg text-green-700 font-semibold shadow-md">
                    {{ session('comment') }}
                </div>
            </div>
        @endif


    </div>

    <div class="flex flex-row flex-wrap justify-center gap-24 mb-20">
        <x-feed :posts="$posts" :comments="$comments" />

    </div>

    <script>
        // Function to automatically fade out alert messages after 3 seconds
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

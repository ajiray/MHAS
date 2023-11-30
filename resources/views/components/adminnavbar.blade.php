<!-- resources/views/navbar.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>

<body>
    <nav
        class="bg-adminPrimary xl:bg-adminPrimary flex justify-between items-center xl:flex-col xl:w-[250px] xl:rounded-tl-[50px] xl:rounded-bl-[50px] xl:shadow-menu">

        <!-- Logo (xl) -->
        <div class="mt-10 text-center xl:flex flex-col hidden">
            <span class="text-white text-4xl font-bold" style="text-shadow: 0 0 10px #ffffff;">Mind</span>
            <span class="text-yellow text-4xl font-bold" style="text-shadow: 0 0 10px #ecb222;">Scape</span>
        </div>

        <!-- xl Menu -->
        <div class="hidden xl:block justify-center items-center h-full">
            <div class="flex h-full items-center justify-center">
                <div class="flex flex-col gap-y-24 items-start">
                    <a href="/admindashboard">
                        <div class="flex gap-2 items-center">
                            <i class="fa-solid fa-house fa-md text-accent"></i>
                            <p class="text-accent text-sm">Home</p>
                        </div>
                    </a>
                    <a href="/adminwall">
                        <div class="flex gap-2 items-center">
                            <i class="fa-solid fa-newspaper fa-md text-accent"></i>
                            <p class="text-accent text-sm">Freedom Wall</p>
                        </div>
                    </a>
                    <a href="/adminappointment">
                        <div class="flex gap-2 items-center">
                            <i class="fa-solid fa-calendar-check fa-md text-accent"></i>
                            <p class="text-accent text-sm">Appointment</p>
                        </div>
                    </a>
                    <a href="/adminmessage">
                        <div class="flex gap-2 items-center">
                            <i class="fa-solid fa-envelope fa-md text-accent"></i>
                            <p class="text-accent text-sm">Message</p>
                        </div>
                    </a>
                    <a href="/adminresources">
                        <div class="flex gap-2 items-center">
                            <i class="fa-solid fa-download fa-md text-accent"></i>
                            <p class="text-accent text-sm">Resources</p>
                        </div>
                    </a>

                    <a href="/videocall">
                        <div class="flex gap-2 items-center">
                            <i class="fa-solid fa-video fa-md text-accent"></i>
                            <p class="text-accent text-sm">Video Call</p>
                        </div>
                    </a>

                </div>

            </div>


        </div>
        <div class="hidden xl:block w-full">
            <button
                class="text-lg text-adminPrimary bg-adminSecondary hover:bg-gray-400 px-4 py-2 transition duration-300 ease-in-out transform w-full font-bold rounded-bl-[50px] shadow-menu"
                href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </button>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>


        <!-- Burger Menu -->
        <x-adminburger />

        <!-- Logo (mobile) -->
        <img src="./images/logo_mobile.svg" width="150" height="100" alt="logo" class="xl:hidden" />

        <!-- Settings Icon (mobile) -->
        <i class="material-icons text-white mr-3 xl:hidden" onclick="toggleSettings()"><span
                class="material-symbols-outlined">
                settings
            </span></i>



        <div id="settings"
            class="hidden fixed top-4 right-4 w-48 h-32 bg-white border border-gray-300 rounded-lg shadow-md z-50">
            <button class="material-symbols-outlined absolute top-4 right-4 text-gray-600" onclick="toggleSettings()">
                Close
            </button>
            <button class="mx-4 my-2 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600"
                href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>


    </nav>

    <script>
        function toggleSettings() {

            var mobileMenu = document.getElementById("settings");
            mobileMenu.classList.toggle("hidden");
        }
    </script>

</body>

</html>

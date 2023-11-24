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
        class="bg-adminPrimary desktop:bg-adminPrimary flex justify-between items-center desktop:flex-col desktop:w-[250px] desktop:rounded-tl-[50px] desktop:rounded-bl-[50px] desktop:shadow-menu">

        <!-- Logo (desktop) -->
        <img src="./images/logo_mobile.svg" width="150" height="100" alt="logo"
            class="mt-10 m-auto hidden desktop:block" />

        <!-- Desktop Menu -->
        <div class="hidden desktop:block justify-center items-center h-full">
            <div class="flex h-full items-center justify-center">
                <div class="flex flex-col gap-y-24 items-start">
                    <a href="/admindashboard">
                        <div class="flex gap-2 items-center">
                            <span class="material-symbols-outlined text-accent">
                                feed
                            </span>
                            <p class="text-accent">Feed</p>
                        </div>
                    </a>
                    <a href="/adminappointment">
                        <div class="flex gap-2 items-center">
                            <span class="material-symbols-outlined text-white">
                                calendar_month
                            </span>
                            <p class="text-white">Appointment</p>
                        </div>
                    </a>
                    <a href="/adminmessage">
                        <div class="flex gap-2 items-center">
                            <span class="material-symbols-outlined text-white">
                                forum
                            </span>
                            <p class="text-white">Message</p>
                        </div>
                    </a>
                    <a href="/adminresources">
                        <div class="flex gap-2 items-center">
                            <span class="material-symbols-outlined text-white">
                                cloud_download
                            </span>
                            <p class="text-white">Resources</p>
                        </div>
                    </a>



                </div>

            </div>


        </div>
        <div class="hidden desktop:block w-full">
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
        <img src="./images/logo_mobile.svg" width="150" height="100" alt="logo" class="desktop:hidden" />

        <!-- Settings Icon (mobile) -->
        <i class="material-icons text-white mr-3 desktop:hidden" onclick="toggleSettings()"><span
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

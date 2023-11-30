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

    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .active p {
            display: none;
        }

        .active i {
            font-size: 2em;
            animation: float 2s ease-in-out infinite;
            box-shadow: 0 40px 15px rgba(0, 0, 0, 0.4);
            background: linear-gradient(to top right, #e6e6e6, #ecb222);
            -webkit-background-clip: text;
            color: transparent;
        }

        .active {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;

        }
    </style>
</head>

<body>
    <nav
        class="bg-maroon flex justify-between items-center xl:flex-col xl:w-[250px] xl:bg-maroon xl:rounded-tl-[50px] xl:rounded-bl-[50px] xl:shadow-menu">

        <!-- Logo (xl) -->
        <img src="./images/logo_mobile.svg" width="150" height="100" alt="logo"
            class="mt-10 m-auto hidden xl:block" />

        <!-- xl Menu -->
        <div class="hidden xl:block justify-center items-center h-full w-full">
            <div class="flex h-full items-center justify-center">
                <div class="flex flex-col gap-y-16 items-start">
                    <div id="home" class="@if (request()->is('dashboard')) active @endif">
                        <a href="/dashboard">
                            <div class="flex gap-2 items-center">
                                <i class="fa-solid fa-house fa-md text-accent"></i>
                                <p class="text-accent text-sm">Home</p>
                            </div>
                        </a>
                    </div>

                    <div id="wall" class="@if (request()->is('wall')) active @endif">
                        <a href="/wall">
                            <div class="flex gap-2 items-center">
                                <i class="fa-solid fa-newspaper fa-md text-accent"></i>
                                <p class="text-accent text-sm">FreedomWall</p>
                            </div>
                        </a>
                    </div>
                    <div id="appointment" class="@if (request()->is('appointment')) active @endif">
                        <a href="/appointment">
                            <div class="flex gap-2 items-center">
                                <i class="fa-solid fa-calendar-check fa-md text-accent"></i>
                                <p class="text-accent text-sm">Appointment</p>
                            </div>
                        </a>
                    </div>

                    <div id="message" class="@if (request()->is('messageOption')) active @endif">
                        <a href="/messageOption">
                            <div class="flex gap-2 items-center">
                                <i class="fa-solid fa-envelope fa-md text-accent"></i>
                                <p class="text-accent text-sm">Chat</p>
                            </div>
                        </a>
                    </div>

                    <div id="profile" class="@if (request()->is('profile')) active @endif">
                        <a href="/profile">
                            <div class="flex gap-2 items-center">
                                <i class="fa-solid fa-id-card fa-md text-accent"></i>
                                <p class="text-accent text-sm">Profile</p>
                            </div>
                        </a>
                    </div>

                    <div id="resources" class="@if (request()->is('resources')) active @endif">
                        <a href="/resources">
                            <div class="flex gap-2 items-center">
                                <i class="fa-solid fa-download fa-md text-accent"></i>
                                <p class="text-accent text-sm">Resources</p>
                            </div>
                        </a>
                    </div>

                    <div id="videocall" class="@if (request()->is('videocall')) active @endif">
                        <a href="/videocall">
                            <div class="flex gap-2 items-center">
                                <i class="fa-solid fa-video fa-md text-accent"></i>
                                <p class="text-accent text-sm">Video Call</p>
                            </div>
                        </a>
                    </div>


                </div>


            </div>

        </div>

        <div class="hidden xl:block w-full">
            <button
                class="text-lg text-maroon bg-yellow hover:bg-amber-300 px-4 py-2 transition duration-300 ease-in-out transform w-full font-bold rounded-bl-[50px] shadow-menu"
                href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </button>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>





        <!-- Burger Menu -->
        <x-burger />

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

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
        class="bg-maroon flex justify-between items-center desktop:flex-col desktop:w-[250px] desktop:bg-maroon desktop:rounded-tl-[50px] desktop:rounded-bl-[50px] desktop:shadow-menu">

        <!-- Logo (desktop) -->
        <img src="./images/logo_mobile.svg" width="150" height="100" alt="logo"
            class="mt-10 m-auto hidden desktop:block" />

        <!-- Desktop Menu -->
        <div class="hidden desktop:block mb-56">
            <div class="flex h-full items-center justify-center mt-8">
                <div class="flex flex-col gap-y-16 items-start">
                    <a href="/dashboard">
                        <div class="flex gap-2 items-center">
                            <span class="material-symbols-outlined text-accent">
                                feed
                            </span>
                            <p class="text-accent">Feed</p>
                        </div>
                    </a>
                    <a href="/appointment">
                        <div class="flex gap-2 items-center">
                            <span class="material-symbols-outlined text-accent">
                                calendar_month
                            </span>
                            <p class="text-accent">Appointment</p>
                        </div>
                    </a>
                    <a href="/message">
                        <div class="flex gap-2 items-center">
                            <span class="material-symbols-outlined text-accent">
                                forum
                            </span>
                            <p class="text-accent">Message</p>
                        </div>
                    </a>
                    <a href="/profile">
                        <div class="flex gap-2 items-center">
                            <span class="material-symbols-outlined text-accent">
                                account_box
                            </span>
                            <p class="text-accent">Profile</p>
                        </div>
                    </a>
                    <a href="/resources">
                        <div class="flex gap-2 items-center">
                            <span class="material-symbols-outlined text-accent">
                                cloud_download
                            </span>
                            <p class="text-accent">Resources</p>
                        </div>
                    </a>



                </div>

            </div>


        </div>
        <div class="justify-center hidden desktop:block">
            <button
                class="hidden desktop:block text-lg text-maroon bg-yellow hover:bg-amber-300 px-4 py-2 transition duration-300 ease-in-out transform w-[199px] font-bold rounded-bl-[50px] shadow-menu"
                href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </button>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>



        <!-- Burger Menu -->
        <x-burger />

        <!-- Logo (mobile) -->
        <img src="./images/logo_mobile.svg" width="150" height="100" alt="logo" class="desktop:hidden" />

        <!-- Settings Icon (mobile) -->
        <i class="material-icons text-white mr-3 desktop:hidden"><span class="material-symbols-outlined">
                settings
            </span></i>



    </nav>

</body>

</html>

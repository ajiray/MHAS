<!DOCTYPE html>
<html class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="overflow-x-hidden">
    <!--Header-->
    <header>
        <nav class="container flex items-center py-4 mt-4 sm:mt-12 relative">
            <div class="py-1"><img src="./images/logo.png" alt="" class="w-[150px] h-[130px]"></div>
            <ul class="hidden sm:flex flex-1 justify-end items-center gap-12 text-maroon uppercase text-xs"
                id="menuList">
                <li class="cursor-pointer"><a href="#features">Features</a></li>
                <li class="cursor-pointer"><a href="#about">About</a></li>
                <li class="cursor-pointer"><a href="#contact">Contact</a></li>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="font-semibold bg-maroon text-white rounded-md px-7 py-3 uppercase">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class=" bg-maroon text-white rounded-md px-5 py-3 ml-[-25px] font-semibold hover:text-gray-900 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                @endif
            </ul>
            <div class="flex sm:hidden flex-1 justify-end relative">
                <div class="flex items-center" id="menuIcon" onclick="toggleMenu()">
                    <!-- Use the Font Awesome icon for the menu -->
                    <i class="text-2xl fas fa-bars cursor-pointer"></i>
                </div>
                <ul class="hidden absolute top-6 left-35 bg-maroon text-white rounded-md border border-gray-200 mt-1 p-2 z-50"
                    id="mobileMenu">
                    <!-- Menu items for mobile -->
                    <li
                        class="cursor-pointer font-semibold bg-white text-maroon rounded-md px-4 py-1 uppercase text-center">
                        Features</li>
                    <li
                        class="cursor-pointer font-semibold bg-white text-maroon rounded-md px-4 py-1 uppercase mt-2 text-center">
                        About</li>
                    <li
                        class="cursor-pointer font-semibold bg-white text-maroon rounded-md px-4 py-1 uppercase mt-2 text-center">
                        Contact</li><br>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}"
                                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="font-semibold bg-white text-maroon mt-4 rounded-md px-4 py-1 uppercase">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class=" bg-white mt-2 text-maroon rounded-md px-4 py-1 uppercase font-semibold">Register</a>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </nav>
    </header>

    <script>
        function toggleMenu() {
            var mobileMenu = document.getElementById("mobileMenu");
            mobileMenu.classList.toggle("hidden"); // Toggle the 'hidden' class to show/hide the menu
        }
    </script>
    <!-- Hero -->
    <section class="relative">
        <div class="container flex flex-col-reverse lg:flex-row items-center gap-12 mt-14 lg:mt-28">
            <!-- Content -->
            <div class="flex flex-1 flex-col items-center lg:items-start">
                <h2 class="text-maroon text-3xl md:text-4 lg:text-5xl text-center lg:text-left mb-6">
                    MindScape
                </h2>
                <p class="text-black text-lg text-center lg:text-left mb-6">
                    A Mental Health Awareness System for the students of the University of Perpetual Help System Dalta
                    Las Pinas Campus
                </p>
                <div class="flex justify-center flex-wrap gap-6">
                    <button type="button" class="btn btn-Red hover:bg-blue hover:text-white">Facebook</button>
                    <button type="button" class="btn btn-yellow hover:bg-ig hover:text-white">Instagram</button>
                </div>
            </div>
            <!-- Image -->
            <div class="flex justify-center flex-1 mb-10 md:mb-16 lg:mb-0 z-10">
                <img class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-[1300px] md:h-full rounded-md" src="./images/mental.png"
                    alt="">
            </div>
        </div>
        <!--Rounded Rectangle-->
        <div
            class="hidden md:block overflow:hidden bg-maroon rounded-l-full absolute h-80 w-2/4 top-8 right-0 lg: -bottom-28 lg:-right-36">
        </div>
    </section>
    <!-- Features -->
    <section class="bg-gray py-20 mt-20 lg:mt-60" id="features">
        <!-- Heading -->
        <div class="sm:3/4 lg:w-5/12 mx-auto px-2">
            <h1 class="text-3xl text-center text-maroon">Features</h1>
            <p class="text-center text-black mt-4">
                Mindscape is an online platform for the University of Perpetual Help System Dalta Las Pinas Campus
                College Students to help them be aware of their
                mental health. And it offers a lot of features that will surely help the college students.
            </p>
        </div>
        <!-- Feature 1 -->
        <div class="relative mt-20 lg:mt-24">
            <div class="container flex flex-col lg:flex-row items-center justify-center gap-x-24">
                <!-- Image -->
                <div class="flex flex-1 justify-center z-10 mb-10- lg:mb-0">
                    <img class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-[1300px] md:h-full rounded-md"
                        src="./images/videocall.jpg" alt="">
                </div>
                <!-- Content -->
                <div class="flex flex-1 flex-col items-center lg:items-start">
                    <h1 class="text-3xl text-maroon">Video Call</h1>
                    <p class="text-black my-4 text-center lg:text-left sm:w-3/4 lg:w-full">
                        Have a one on one session with the schools psychologist/counselor to help you with your mental
                        health issues.
                    </p>
                </div>
            </div>
            <!-- Rounded Rectangle -->
            <div
                class="hidden lg:block overflow:hidden bg-maroon rounded-r-full absolute h-80 w-2/4  -bottom-24 -left-36">
            </div>
        </div>
        <!-- Feature 2 -->
        <div class="relative mt-20 lg:mt-52">
            <div class="container flex flex-col lg:flex-row-reverse items-center justify-center gap-x-24">
                <!-- Image -->
                <div class="flex flex-1 justify-center z-10 mb-10- lg:mb-0">
                    <img class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-[1300px] md:h-full rounded-md"
                        src="./images/appointment.jpg" alt="">
                </div>
                <!-- Content -->
                <div class="flex flex-1 flex-col items-center lg:items-start">
                    <h1 class="text-3xl text-maroon">Book Appointments</h1>
                    <p class="text-black my-4 text-center lg:text-left sm:w-3/4 lg:w-full">
                        Easily book an appointment with the available psychologist/counselor.
                    </p>
                </div>
            </div>
            <!-- Rounded Rectangle -->
            <div
                class="hidden lg:block overflow:hidden bg-maroon rounded-l-full absolute h-80 w-2/4  -bottom-24 -right-36">
            </div>
        </div>
        <!-- Feature 3 -->
        <div class="relative mt-20 lg:mt-52">
            <div class="container flex flex-col lg:flex-row items-center justify-center gap-x-24">
                <!-- Image -->
                <div class="flex flex-1 justify-center z-10 mb-10- lg:mb-0">
                    <img class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-[1300px] md:h-full rounded-md"
                        src="./images/chatbot.jpg" alt="">
                </div>
                <!-- Content -->
                <div class="flex flex-1 flex-col items-center lg:items-start">
                    <h1 class="text-3xl text-maroon">AI Chatbot</h1>
                    <p class="text-black my-4 text-center lg:text-left sm:w-3/4 lg:w-full">
                        If the psychologist/counselor is not available, you can ask our AI Chatbot about concerns in
                        mental health.
                    </p>
                </div>
            </div>
            <!-- Rounded Rectangle -->
            <div
                class="hidden lg:block overflow:hidden bg-maroon rounded-r-full absolute h-80 w-2/4  -bottom-24 -left-36">
            </div>
        </div>
    </section>
    <!-- About -->
    <section class="py-20 mt-20" id="about">
        <!-- Heading -->
        <div class="sm:3/4 lg:w-5/12 mx-auto px-2">
            <h1 class="text-3xl text-center text-maroon">About MindScape</h1>
            <p class="text-center text-black mt-4">
                Mindscape is an online platform for the University of Perpetual Help System Dalta Las Pinas Campus
                College Students to help them be aware of their
                mental health.
        </div>
    </section>
    <section class="bg-maroon text-white py-20" id="contact">
        <div class="container">
            <div class="sm:w-3/4 lg:w-2/4 mx-auto">
                <p class="font-semibold  text-center mb-8 text-3xl">Contact Us</p>
                <p class="font-light text-center  text-1xl">mhas@perpetual.edu.ph</p>
                <p class="font-light uppercase text-center  text-1xl">09156831148</p>
                <p class="font-light uppercase text-center  text-1xl">801-04-06</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark py-8">
        <div class="container flex flex-col md:flex-row items-center">
            <div class="flex flex-1 flex-wrap items-center justify-center md:justify-start gap-12">
                <img class="w-[90px] h-[70px] " src="./images/logo.png" alt="">
                <div>
                    <p class="text-customYellow text-2xl ml-[-50px] ">MindScape</p>
                </div>
                <ul class="flex text-white uppercase gap-12 text-xs">
                    <li class="cursor-pointer"><a href="#features">Features</a></li>
                    <li class="cursor-pointer"><a href="#about">About</a></li>
                    <li class="cursor-pointer"><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="flex gap-10 mt-12 md:mt-0">
                <a link href="https://www.facebook.com/xdhumol"><i
                        class="text-2xl text-white fa-brands fa-square-facebook cursor-pointer"></a></i>
                <a link href="https://twitter.com/Vermaiii"><i
                        class="text-2xl text-white fa-brands fa-square-twitter cursor-pointer"></a></i>
            </div>
        </div>
    </footer>
</body>

</html>

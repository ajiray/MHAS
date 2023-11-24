<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    @vite('resources/css/app.css')
</head>


<body>
    <button class="material-symbols-outlined text-white ml-2 desktop:hidden" onclick="toggleMenu()">
        menu
    </button>

    <div id="mobileMenu"
        class="fixed flex justify-center items-center top-0 left-0 h-screen w-screen bg-white z-50 transition hidden">

        <button class="material-symbols-outlined absolute top-4 right-4 text-gray-600" onclick="toggleMenu()">
            Close
        </button>

        <div class="flex flex-col gap-y-16 text-2xl md:text-3xl md:gap-y-20">
            <a href="/admindashboard">
                <div class="flex gap-2 items-center">
                    <span class="material-symbols-outlined text-maroon text-2xl md:text-3xl">
                        feed
                    </span>
                    <p class="text-maroon">Feed</p>
                </div>
            </a>
            <a href="/adminappointment">
                <div class="flex gap-2 items-center">
                    <span class="material-symbols-outlined text-maroon text-2xl md:text-3xl">
                        calendar_month
                    </span>
                    <p class="text-maroon">Appointment</p>
                </div>
            </a>
            <a href="/message">
                <div class="flex gap-2 items-center">
                    <span class="material-symbols-outlined text-maroon text-2xl md:text-3xl">
                        forum
                    </span>
                    <p class="text-maroon">Message</p>
                </div>
            </a>
            <a href="/adminresources">
                <div class="flex gap-2 items-center">
                    <span class="material-symbols-outlined text-maroon text-2xl md:text-3xl">
                        cloud_download
                    </span>
                    <p class="text-maroon">Resources</p>
                </div>
            </a>
        </div>
    </div>

    <script>
        function toggleMenu() {

            var mobileMenu = document.getElementById("mobileMenu");
            mobileMenu.classList.toggle("hidden"); // Toggle the 'hidden' class to show/hide the menu
        }
    </script>
</body>

</html>

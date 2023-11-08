<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    @vite('resources/css/app.css')

</head>

<body>

    <div class='desktop:h-screen desktop:justify-center desktop:flex desktop:items-center'>
        <div
            class='desktop:flex desktop:w-[90%] desktop:h-[90%] desktop:rounded-tl-[50px] desktop:rounded-bl-[50px] desktop:shadow-lg'>
            <x-adminnavbar />

            <div
                class="w-screen h-screen desktop:rounded-tr-[50px] desktop:rounded-br-[50px] desktop:h-full overflow-y-auto">

                @yield('content')
            </div>


        </div>

    </div>




</body>

</html>

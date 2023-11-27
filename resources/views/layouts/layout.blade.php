<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

</head>

<body class="overflow-x-hidden">

    <div class='desktop:h-screen desktop:justify-center desktop:flex desktop:items-center'>
        <div
            class='desktop:flex desktop:w-[90%] desktop:h-[90%] desktop:rounded-tl-[50px] desktop:rounded-bl-[50px] desktop:shadow-lg'>
            <x-navbar />

            <div class="w-screen h-screen desktop:h-full overflow-y-auto">
                @yield('content')
            </div>


        </div>

    </div>




</body>

</html>

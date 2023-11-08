<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body>
    <div
        class="p-3 desktop:p-4 rounded-lg shadow-lg hidden tablet:block desktop:block border-2 border-gray-300 bg-white">
        <form action="/create-post" method="POST">
            @csrf
            <div class="flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-3 items-center">
                <input type="text" name="body" id="body" placeholder="What's on your mind?" maxlength="200"
                    autocomplete="off" required
                    class="py-2 px-3 md:w-96 desktop:w-96 rounded-lg font-semibold border-2 border-gray-300 focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="px-4 py-2 rounded-lg bg-blue-500 text-white hover:bg-blue-600">
                    POST
                </button>
            </div>
        </form>
    </div>

</body>

</html>

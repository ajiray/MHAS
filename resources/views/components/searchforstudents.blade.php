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
        class="w-[400px]  md:ml-auto md:mr-auto lg:ml-auto lg:mr-auto mt-10 sm:mt-20 md:mt-10 lg:w-[700px] desktop:mt-5 px-3 py-3 sm:px-5 sm:py-5 md:px-5 md:py-5 desktop:px-5 desktop:py-5 rounded-lg shadow-lg border-2 border-gray-300 bg-white relative">
        <form action="{{ route('counseling-records.search') }}" method="POST">
            @csrf
            <div class="flex flex-col sm:flex-row sm:space-x-3 md:flex-row md:space-x-3 items-center">
                <input type="text" name="search" id="search" placeholder="Search for Student Number"
                    autocomplete="off" required
                    class="py-1 px-2 sm:py-2 sm:px-3 w-64 sm:w-80 md:w-96 lg:w-[700px] rounded-lg font-semibold border-2 border-gray-300 focus:ring-2 focus:ring-amber-500">
                <button type="submit"
                    class="w-[50%] py-2 sm:py-2 sm:w-[30%] md:py-2 md:w-[20%] desktop:py-2 desktop:w-[20%] mt-3 sm:mt-0 md:mt-0 desktop:mt-0 rounded-lg bg-yellow hover:bg-amber-300 text-maroon font-semibold">
                    Search
                </button>
            </div>
        </form>
</body>

</html>

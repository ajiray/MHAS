@extends('layouts.layout')
<!DOCTYPE html>
<html lang="en" data-csrf="{{ csrf_token() }}">

<head>
    <title></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/resources.js') }}" defer></script>
</head>

<body>

    @section('content')
        <div class="justify-center w-full flex">
            <div class="flex justify-between items-center bg-maroon h-16 w-fit mt-10 p-6 rounded-lg shadow-md">
                <button id="pdfButton" class="bg-maroon-light text-gray-500 px-4 py-2 rounded-md font-bold" data-category="pdf"
                    onclick="filterClicked('white', 'black', this, 'line1', 'PDF')">PDF</button>
                <div class="flex">
                    <div class="line1 relative h-1 w-32 bg-gray-500"></div>
                    <div class="line2 relative h-1 w-32 bg-gray-500"></div>
                </div>
                <button id="videoButton" class="bg-maroon-light text-gray-500 px-4 py-2 rounded-md font-bold"
                    data-category="video" onclick="filterClicked('white', 'black', this, 'line2', 'Videos')">Videos</button>
                <div class="flex">
                    <div class="line2 relative h-1 w-32 bg-gray-500"></div>
                    <div class="line3 relative h-1 w-32 bg-gray-500"></div>
                </div>
                <button id="infoButton" class="bg-maroon-light text-gray-500 px-4 py-2 rounded-md font-bold"
                    data-category="infographic"
                    onclick="filterClicked('white', 'black', this, 'line3', 'Info')">Infographics</button>
                <div class="flex">
                    <div class="line3 relative h-1 w-32 bg-gray-500"></div>
                    <div class="line4 relative h-1 w-32 bg-gray-500"></div>
                </div>
                <button id="eBookButton" class="bg-maroon-light text-gray-500 px-4 py-2 rounded-md font-bold"
                    data-category="ebook" onclick="filterClicked('white', 'black', this, 'line4', 'book')">Ebooks</button>
            </div>

        </div>

        <div id="resourceContent" class="mt-5 ml-10">

        </div>
    @endsection

</body>

</html>

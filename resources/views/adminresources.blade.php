@extends('layouts.adminlayout')

@section('content')
    <script>
        function fadeOutAlert(alertId) {
            setTimeout(function() {
                var alert = document.getElementById(alertId);
                if (alert) {
                    alert.style.transition = "opacity 1s";
                    alert.style.opacity = 0;
                    setTimeout(function() {
                        alert.style.display = "none";
                    }, 1000);
                }
            }, 2500);
        }
        fadeOutAlert("alert");
    </script>
    <script src="{{ asset('js/resources.js') }}" defer></script>

    <div class="absolute top-2 w-96 text-center">
        @if (session()->has('success'))
            <div id="alert" class="bg-green-300 p-3 rounded-lg text-green-700 font-semibold shadow-md">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div id="alert" class="bg-red-300 p-3 rounded-lg text-red-700 font-semibold shadow-md">
                {{ session('error') }}
            </div>
        @endif

        @if (session()->has('tooLarge'))
            <div id="alert" class="bg-red-300 p-3 rounded-lg text-red-700 font-semibold shadow-md">
                {{ session('tooLarge') }}
            </div>
        @endif
    </div>
    <div class="flex flex-col items-center h-full justify-center">
        <h1 class="text-3xl font-semibold mb-4">UPLOAD RESOURCES HERE</h1>

        <form action="{{ route('store-resource') }}" method="POST" id="resource-form"
            class="flex flex-col space-y-4 w-96 p-8 bg-gray-100 rounded-md shadow-md" enctype="multipart/form-data">
            @csrf
            <select name="category" id="category" class="border p-2" onchange="toggleInputs()">
                <option value="" disabled selected>Select Category</option>
                <option value="pdf">PDF</option>
                <option value="video">VIDEO</option>
                <option value="infographic">INFOGRAPHIC</option>
                <option value="ebook">E-BOOK</option>
            </select>

            <label for="title" class="text-sm font-medium hidden" id="title-label">Title</label>
            <input type="text" name="title" id="title" class="border p-2 hidden">

            <label for="description" class="text-sm font-medium hidden" id="description-label">Description</label>
            <input type="text" name="description" id="description" class="border p-2 hidden">

            <label for="file_content" class="text-sm font-medium hidden" id="pdf-label">PDF</label>
            <input type="file" name="file_content" id="file_content" accept=".pdf" class="border p-2 hidden">

            <label for="file_cover" class="text-sm font-medium hidden" id="cover-photo-label">Cover Photo</label>
            <input type="file" name="file_cover" id="file_cover" accept="image/*" class="border p-2 hidden">

            <label for="youtube_link" class="text-sm font-medium hidden" id="youtube-link-label">YouTube Video Link</label>
            <input type="text" name="youtube_link" id="youtube_link" class="border p-2 hidden">

            <label for="infographic" class="text-sm font-medium hidden" id="infographic-label">Infographic</label>
            <input type="file" name="infographic" id="infographic" accept="image/*" class="border p-2 hidden">

            <label for="ebook" class="text-sm font-medium hidden" id="ebook-label">E-Book</label>
            <input type="file" name="ebook" id="ebook" accept=".pdf, .epub, .mobi" class="border p-2 hidden">

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700 hidden"
                id="submitRes">Add
                Resource</button>
        </form>
    </div>
@endsection

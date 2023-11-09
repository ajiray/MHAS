@extends('layouts.adminlayout')

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


@section('content')
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

    </div>

    <div class="flex justify-center items-center h-full">
        <div class="bg-white rounded-lg p-6 shadow-md w-full sm:w-96">
            <h1 class="text-2xl font-semibold mb-4 text-center">Upload Resources Here</h1>

            <form action="/store-resource" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Resource Title</label>
                    <input type="text" name="title" id="title" class="border border-black" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" class="border border-black" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                    <input type="text" name="author" id="author" class="border border-black" required>
                </div>

                <div class="mb-4">
                    <label for="publication_date" class="block text-sm font-medium text-gray-700">Publication Date</label>
                    <input type="date" name="publication_date" id="publication_date" class="border border-black"
                        required>
                </div>

                <div class="mb-4">
                    <label for="file" class="block text-sm font-medium text-gray-700">Upload Resource</label>
                    <input type="file" name="file_path" accept="*/*" required>
                </div>

                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category" id="category" class="form-select" required>
                        <option value="Video">Video</option>
                        <option value="PDF">PDF</option>
                        <option value="Infographic">Infographic</option>
                        <option value="Ebook">Ebook</option>
                    </select>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full w-full hover:bg-blue-700">
                    Add Resource
                </button>
            </form>
        </div>
    </div>
@endsection

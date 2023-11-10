@extends('layouts.layout')

@section('content')
    <div class="w-full flex h-full justify-center items-center">
        <div class="w-3/4 bg-white h-3/5 border-2 border-gray-300 rounded-lg overflow-y-auto">
            <h1 class="text-3xl font-bold text-gray-800 bg-blue-500 text-white p-4 rounded-t-lg">RESOURCES</h1>

            @forelse ($resources as $resource)
                <div class="mt-4 p-4 border-b border-gray-300 flex items-center">
                    @if ($resource->file_cover)
                        <img src="{{ asset('storage/covers/' . $resource->file_cover) }}" alt="{{ $resource->title }}"
                            class="mr-4 rounded-md w-20 h-20 object-cover">
                    @endif

                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">{{ $resource->title }}</h2>
                        <p class="text-gray-700">{{ $resource->description }}</p>

                        <div class="mt-2">
                            @if ($resource->category == 'PDF')
                                <a href="{{ asset('storage/resources/' . $resource->file_content) }}"
                                    class="text-blue-500 hover:underline" target="_blank">Download PDF</a>
                            @elseif ($resource->category == 'Video')
                                <a href="{{ asset('storage/resources/' . $resource->file_content) }}"
                                    class="text-blue-500 hover:underline" target="_blank">Watch Video</a>
                            @else
                                <!-- Handle other categories -->
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-4 text-center text-gray-600">No resources available.</div>
            @endforelse
        </div>
    </div>
@endsection

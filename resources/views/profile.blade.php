@extends('layouts.layout')


@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile</title>
        @vite('resources/css/app.css')
        <script>
            function confirmDeletePost(postId) {
                if (confirm('Are you sure you want to delete this post?')) {
                    document.getElementById('delete-form-' + postId).submit();
                }
            }
        </script>
    </head>

    <body>
        <section class="relative">
            <!-- Whole Screen -->
            <div class="w-full md:h-auto bg-white">
                <!-- Red Above -->
                <div class="w-full h-72 absolute bg-red-900 flex items-center justify-center">
                    <div>
                        <span class="text-white text-4xl font-bold">Mind</span><span
                            class="text-yellow text-4xl font-bold">Scape </span>
                        <span class="text-white text-4xl font-bold">Profile</span>
                    </div>
                </div>
                <!-- Profile Picture -->
                <div
                    class="w-[200px] h-[200px] bg-lightpink rounded-full flex items-center justify-center absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 mt-72">
                    <img src="images/{{ Auth::user()->avatar }}" alt="User Image"
                        class="w-[200px] h-[200px] rounded-full" />
                </div>

                <div
                    class="absolute flex items-center justify-center top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 mt-[410px] text-xl md:text-2xl font-bold">
                    {{ Auth::user()->name }}
                </div>
                <!-- Change Photo Button -->
                <div
                    class="absolute mt-[460px] flex items-center justify-center top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <div class="inputBox">
                        <a href="{{ url('/update-profile-photo') }}"><button type="button"
                                class="bg-lightpink hover:bg-customRed text-white py-2 px-4 rounded-md cursor-pointer transition duration-300">Change
                                photo</button></a>
                    </div>
                </div>
                <!-- Second Red Div -->

                <div
                    class="w-80 md:w-180 border-2 border-black h-96 md:h-auto rounded-2xl absolute mt-[700px] md:mt-[700px] items-center justify-center top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <div class="flex">
                        <h1 class="text-3xl font-bold px-4">About Me</h1>
                        <a href="{{ url('/editaboutme') }}" class="underline decoration-1 px-4 ml-[60px] text-xl">Edit</a>
                    </div>
                    <div class="px-6 text-center text-black text-2xl">
                        <h1>{{ Auth::user()->aboutme }}</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="relative mt-[1000px] mx-auto">
            <h1 class="text-center text-4xl font-bold ">Posts</h1>
            @foreach ($posts->sortByDesc('id') as $post)
                <div
                    class="w-180 h-70 mt-3 flex flex-col rounded-tl-3xl rounded-tr-3xl rounded-br-3xl rounded-bl-3xl border-2 border-black sm:mt-7 sm:ml-10 desktop:mt-7 desktop:ml-10">
                    <!-- Author info -->
                    <div class="flex justify-between items-center space-x-2 mt-3 ml-3 mr-3">
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('images/' . $post->user->avatar) }}" width="40" height="40"
                                alt="author profile" class="rounded-full border-2 border-blue-500">
                            <h1>{{ $post->user->name }}</h1>
                            <p class="text-gray-500 text-sm">created at {{ $post->created_at->format('M d, Y \a\t H:i A') }}
                            </p>
                        </div>
                        <div class="flex items-center space-x-2">
                            @auth
                                @if (auth()->user()->id === $post->user->id)
                                    <button onclick="confirmDeletePost('{{ $post->id }}')"
                                        class="material-symbols-outlined text-red-600">
                                        delete
                                    </button>
                                    <form id="delete-form-{{ $post->id }}"
                                        action="/delete-post-profile/{{ $post->id }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                    <!-- Caption -->
                    <div class="mt-[40px] h-[100px] flex items-center">
                        <p class="text-center text-sm break-words w-full p-5 mt-5 ">
                            {{ $post->body }}
                        </p>
                    </div>
                </div>
            @endforeach
            <div
                class="w-180 h-70 mt-3 flex flex-col rounded-tl-3xl rounded-tr-3xl rounded-br-3xl rounded-bl-3xl border-2 border-black sm:mt-7 sm:ml-10 desktop:mt-7 desktop:ml-10">
                <h1 class="text-center text-4xl text-customRed">No more Posts!</h1>
            </div>
            </div>
        </section>
    </body>


    </html>
@endsection

<!DOCTYPE html>
<html lang="en" data-csrf="{{ csrf_token() }}">

<head>
    <title></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite('resources/css/app.css')
    <script src="{{ asset('js/reaction.js') }}" defer></script>
</head>

<body>

    @foreach ($posts->sortByDesc('id') as $post)
        <div class="relative">
            <!-- Comment section modal -->
            <div id="commentSection-{{ $post->id }}"
                class="fixed inset-0 flex justify-center items-center bg-opacity-50 bg-gray-600 z-50 hidden">
                <div class="bg-white p-4 rounded-lg shadow-lg w-full md:w-1/2">
                    <div class="flex justify-between items-center">
                        <h2 class="text-lg font-semibold">Comments</h2>
                        <button class="text-gray-600 hover:text-gray-800 text-2xl"
                            onclick="showCommentPopup('{{ $post->id }}')">&times;</button>
                    </div>

                    <div class="mt-4">
                        <!-- Display existing comments -->
                        @foreach ($post->comments as $comment)
                            <div class="mb-2">
                                <strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}

                                @if (auth()->check() && $comment->user_id == auth()->id())
                                    <button onclick="confirmDeleteComment('{{ $comment->id }}')"
                                        class="material-symbols-outlined text-red-600">
                                        Delete
                                    </button>
                                    <form id="delete-form-comment-{{ $comment->id }}"
                                        action="/delete-comment/{{ $comment->id }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>


                    <div class="mt-4">
                        <!-- Form for adding a new comment -->
                        <form method="POST" action="/submitComment/{{ $post->id }}">
                            @csrf
                            <input type="text" name="content" class="w-full p-2 mb-2 border rounded resize-y"
                                placeholder="Add your comment..." required>
                            <button type="submit"
                                class="bg-green-500 text-white p-2 rounded cursor-pointer">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div
                class="w-80 h-72 mt-10 flex flex-col rounded-lg border-2 border-gray-300 shadow-md desktop:mt-7 desktop:ml-10 bg-white">
                <!-- Author info -->
                <div class="flex justify-between items-center space-x-2 mt-3 ml-3 mr-3 border-b-2 border-black pb-3">
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/' . $post->user->avatar) }}" width="40" height="40"
                            alt="author profile" class="rounded-full">
                        <h1 class="text-lg font-semibold text-blue-500">{{ $post->user->name }}</h1>
                    </div>
                    <div class="flex items-center space-x-2">
                        @auth
                            @if (auth()->user()->id === $post->user->id)
                                <button onclick="confirmDeletePost('{{ $post->id }}')"
                                    class="material-symbols-outlined text-red-600">
                                    Delete
                                </button>
                                <form id="delete-form-{{ $post->id }}" action="/delete-post/{{ $post->id }}"
                                    method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
                <!-- Caption -->
                <div class="h-3/5 flex items-center">
                    <p class="text-center text-sm break-words w-full p-4 text-gray-700">
                        {{ $post->body }}
                    </p>
                </div>

                <!-- Reaction and Comment Section -->
                <div class="absolute bottom-0 bg-gray-100 w-[317px] p-1 rounded-bl-lg rounded-br-lg">
                    <div class="flex space-x-36 items-center">
                        <div class="flex space-x-5 items-center">
                            @php
                                $hasReactedWithHeart = $post
                                    ->reactions()
                                    ->where('user_id', auth()->id())
                                    ->where('type', 'heart')
                                    ->exists();

                                $hasReactedWithLike = $post
                                    ->reactions()
                                    ->where('user_id', auth()->id())
                                    ->where('type', 'like')
                                    ->exists();
                                $hasReactedWithHaha = $post
                                    ->reactions()
                                    ->where('user_id', auth()->id())
                                    ->where('type', 'haha')
                                    ->exists();
                                $hasReactedWithFrown = $post
                                    ->reactions()
                                    ->where('user_id', auth()->id())
                                    ->where('type', 'sad')
                                    ->exists();
                            @endphp

                            <div class="flex flex-col justify-center items-center">
                                <p id="reaction-count-heart-{{ $post->id }}" class="text-xs">
                                    {{ $post->reactions()->where('type', 'heart')->count() }}</p>
                                <button
                                    class="reaction-icon text-{{ $hasReactedWithHeart ? 'maroon' : 'gray-500' }} hover-text-gray-700 text-lg"
                                    onclick="react('{{ $post->id }}', 'heart', '{{ $hasReactedWithHeart ? 'gray-500' : 'maroon' }}', this)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>

                            <div class="flex flex-col justify-center items-center">
                                <p id="reaction-count-like-{{ $post->id }}" class="text-xs">
                                    {{ $post->reactions()->where('type', 'like')->count() }}</p>
                                <button
                                    class="reaction-icon text-{{ $hasReactedWithLike ? 'maroon' : 'gray-500' }} hover-text-gray-700 text-lg"
                                    onclick="react('{{ $post->id }}', 'like', '{{ $hasReactedWithLike ? 'gray-500' : 'maroon' }}', this)">
                                    <i class="fas fa-thumbs-up"></i>
                                </button>
                            </div>

                            <div class="flex flex-col justify-center items-center">
                                <p id="reaction-count-haha-{{ $post->id }}" class="text-xs">
                                    {{ $post->reactions()->where('type', 'haha')->count() }}</p>
                                <button
                                    class="reaction-icon text-{{ $hasReactedWithHaha ? 'maroon' : 'gray-500' }} hover-text-gray-700 text-lg"
                                    onclick="react('{{ $post->id }}', 'haha', '{{ $hasReactedWithHaha ? 'gray-500' : 'maroon' }}', this)">
                                    <i class="fas fa-grin-beam"></i>
                                </button>
                            </div>

                            <div class="flex flex-col justify-center items-center">
                                <p id="reaction-count-sad-{{ $post->id }}" class="text-xs">
                                    {{ $post->reactions()->where('type', 'sad')->count() }}</p>
                                <button
                                    class="reaction-icon text-{{ $hasReactedWithFrown ? 'maroon' : 'gray-500' }} hover-text-gray-700 text-lg"
                                    onclick="react('{{ $post->id }}', 'sad', '{{ $hasReactedWithFrown ? 'gray-500' : 'maroon' }}', this)">
                                    <i class="fas fa-frown"></i>
                                </button>
                            </div>


                        </div>
                        <div class="">
                            <button class="comment-icon text-gray-500 hover:text-gray-700 text-lg"
                                onclick="showCommentPopup('{{ $post->id }}')">
                                <i class="fas fa-comment"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endforeach


</body>

</html>

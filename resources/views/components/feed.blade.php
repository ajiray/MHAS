<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite('resources/css/app.css')
    <script>
        function confirmDeletePost(postId) {
            if (confirm('Are you sure you want to delete this post?')) {
                document.getElementById('delete-form-' + postId).submit();
            }
        }

        function react(postId, reactionType, color, button) {
            // Update the button's color immediately
            if ($(button).hasClass('text-gray-500')) {
                $(button).removeClass('text-gray-500').addClass('text-' + color); // Change to the active color
            } else {
                $(button).removeClass('text-' + color).addClass('text-gray-500'); // Change back to the inactive color
            }

            // Send an AJAX request to the respective reaction route
            $.ajax({
                url: "/" + reactionType + "React/" + postId,
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    // Handle any success response here (if needed)
                    console.log(response);
                },
                error: function(error) {
                    // Handle any errors here (if needed)
                    console.error(error);
                    // Revert the button's color if there was an error
                    $(button).removeClass('text-' + color).addClass('text-gray-500');
                }
            });
        }
    </script>
</head>

<body>

    @foreach ($posts->sortByDesc('id') as $post)
        <div class="relative">
            <div
                class="w-80 h-72 mt-10 flex flex-col rounded-lg border-2 border-gray-300 shadow-md desktop:mt-7 desktop:ml-10 bg-white">
                <!-- Author info -->
                <div class="flex justify-between items-center space-x-2 mt-3 ml-3 mr-3 border-b-2 border-black pb-3">
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/' . $post->user->profile_image) }}" width="40" height="40"
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

                                $hasReactedWithThumbUp = $post
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

                            <div>
                                <p class="text-xs">0</p>
                                <button
                                    class="reaction-icon text-{{ $hasReactedWithHeart ? 'blue' : 'gray' }}-500 hover-text-gray-700 text-lg"
                                    onclick="react('{{ $post->id }}', 'heart', '{{ $hasReactedWithHeart ? 'gray' : 'blue' }}-500', this)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>

                            <div>
                                <p class="text-xs">0</p>
                                <button
                                    class="reaction-icon text-{{ $hasReactedWithThumbUp ? 'blue' : 'gray' }}-500 hover-text-gray-700 text-lg"
                                    onclick="react('{{ $post->id }}', 'thumb', '{{ $hasReactedWithThumbUp ? 'gray' : 'blue' }}-500', this)">
                                    <i class="fas fa-thumbs-up"></i>
                                </button>
                            </div>

                            <div>
                                <p class="text-xs">0</p>
                                <button
                                    class="reaction-icon text-{{ $hasReactedWithHaha ? 'blue' : 'gray' }}-500 hover-text-gray-700 text-lg"
                                    onclick="react('{{ $post->id }}', 'haha', '{{ $hasReactedWithHaha ? 'gray' : 'blue' }}-500', this)">
                                    <i class="fas fa-grin-beam"></i>
                                </button>
                            </div>

                            <div>
                                <p class="text-xs">0</p>
                                <button
                                    class="reaction-icon text-{{ $hasReactedWithFrown ? 'blue' : 'gray' }}-500 hover-text-gray-700 text-lg"
                                    onclick="react('{{ $post->id }}', 'sad', '{{ $hasReactedWithFrown ? 'gray' : 'blue' }}-500', this)">
                                    <i class="fas fa-frown"></i>
                                </button>
                            </div>


                        </div>
                        <div class="">
                            <a href="/addComment" class="comment-icon text-slate-500 hover:text-slate-700 text-lg ">
                                <i class="fas fa-comment"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endforeach

</body>

</html>

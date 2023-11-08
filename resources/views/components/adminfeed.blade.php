<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
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

    @foreach ($posts->sortByDesc('id') as $post)
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

                    <button onclick="confirmDeletePost('{{ $post->id }}')"
                        class="material-symbols-outlined text-red-600">
                        Delete
                    </button>
                    <form id="delete-form-{{ $post->id }}" action="/delete-post-admin/{{ $post->id }}"
                        method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>

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

</body>

</html>

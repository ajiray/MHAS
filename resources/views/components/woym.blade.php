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
        class="mt-10 sm:mt-20 md:mt-10 desktop:mt-5 px-3 py-3 sm:px-5 sm:py-5 md:px-5 md:py-5 desktop:px-5 desktop:py-5 rounded-lg shadow-lg border-2 border-gray-300 bg-white relative">
        <form action="/create-post" method="POST">
            @csrf
            <div class="flex flex-col sm:flex-row sm:space-x-3 md:flex-row md:space-x-3 items-center">
                <input type="text" name="body" id="body" placeholder="What's on your mind?" maxlength="200"
                    autocomplete="off" required
                    class="py-1 px-2 sm:py-2 sm:px-3 w-64 sm:w-80 md:w-96 lg:w-[700px] rounded-lg font-semibold border-2 border-gray-300 focus:ring-2 focus:ring-amber-500">

                <!-- Add the checkbox for anonymous posting -->
                <div id="optionPost"
                    class="absolute bottom-0 right-0 hidden bg-white border border-gray-300 p-4 shadow-lg rounded-lg">
                    <button onclick="postAnonymously()"
                        class="py-2 px-4 bg-yellow hover:bg-amber-300 text-maroon font-semibold rounded-full mb-2 md:mb-0 md:mr-2">POST
                        ANONYMOUSLY</button>
                    <button onclick="postNormally()"
                        class="py-2 px-4 bg-yellow hover:bg-amber-300 text-maroon font-semibold rounded-full">POST
                        NORMALLY</button>
                </div>

                <div class="flex items-center mt-3 sm:mt-0 md:mt-0 desktop:mt-0 hidden">
                    <input type="checkbox" name="anonymous" id="anonymous" class="mr-2">
                    <label for="anonymous">Post anonymously</label>
                </div>

                <button type="button" onclick="toggleOptions()"
                    class="w-[50%] py-2 sm:py-2 sm:w-[30%] md:py-2 md:w-[20%] desktop:py-2 desktop:w-[20%] mt-3 sm:mt-0 md:mt-0 desktop:mt-0 rounded-lg bg-yellow hover:bg-amber-300 text-maroon font-semibold">
                    <i class="fa-solid fa-paper-plane fa-lg"></i>
                </button>
            </div>
        </form>
    </div>
    <script>
        function toggleOptions() {
            var optionPost = document.getElementById("optionPost");
            var inputField = document.getElementById("body");

            // Check if the input field is empty
            if (inputField.value.trim() === "") {
                // Don't show the pop-up if the input is empty
                return;
            }

            // Toggle the visibility of the pop-up
            optionPost.classList.toggle("hidden");
        }

        function postAnonymously() {
            document.getElementById("anonymous").checked = true;
            document.forms[0].submit();
        }

        function postNormally() {
            document.getElementById("anonymous").checked = false;
            document.forms[0].submit();
        }
    </script>
</body>

</html>

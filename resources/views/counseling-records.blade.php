@extends(Auth::user()->is_admin == 1 ? 'layouts.adminlayout' : 'layouts.guidancelayout')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <style>
            .card {
                width: 900px;
                height: 800px;
                margin: 0 auto;
                border-radius: 8px;
                z-index: 1;
                margin-top: 20px;
                margin-left: auto;
                margin-right: auto;
            }

            .tools {
                display: flex;
                align-items: center;
                padding: 9px;
            }

            .circle {
                padding: 0 4px;
            }

            .box {
                display: inline-block;
                align-items: center;
                width: 10px;
                height: 10px;
                padding: 1px;
                border-radius: 50%;
            }

            .red {
                background-color: #ff605c;
            }

            .yellow {
                background-color: #ffbd44;
            }

            .green {
                background-color: #00ca4e;
            }
        </style>
    </head>

    <body>
        <div
            class="card bg-gradient-to-b {{ Auth::user()->is_admin == 1 ? 'from-adminPrimary to-gradientBlue' : (Auth::user()->is_admin == 2 ? 'from-guidancePrimary to-orange-950' : '') }}">

            <div class="tools">
                <div class="circle">
                    <span class="red box"></span>
                </div>
                <div class="circle">
                    <span class="yellow box"></span>
                </div>
                <div class="circle">
                    <span class="green box"></span>
                </div>
            </div>
            <div class="ml-auto mr-auto">
                <h1 class="font-bold text-white p-4 font-serif text-xl md:text-2xl md:ml-auto md:mr-auto text-center">
                    Guidance
                    Counseling Records</h1>
            </div>
            <x-searchforstudents />
            @if (session()->has('error'))
                <div class=" top-0 left-0 mt-4" id="errorAlert">
                    <div class="bg-red-300 p-3 rounded-lg text-white font-semibold shadow-md text-center">
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @if (session()->has('success'))
                <div class=" top-0 left-0 mt-2 " id="successAlert">
                    <div class="bg-green-300 p-3 rounded-lg text-green-700 font-semibold shadow-md text-center">
                        {{ session('success') }}
                    </div>
                </div>
                <script>
                    // Close the pop-up window after 3 seconds (3000 milliseconds)
                    setTimeout(function() {
                        window.close();
                    }, 3000);
                </script>
            @endif

            <script>
                // Set timeout for error alert
                setTimeout(function() {
                    var errorAlert = document.getElementById('errorAlert');
                    if (errorAlert) {
                        errorAlert.style.display = 'none';
                    }
                }, 3000); // 3000 milliseconds (3 seconds)
            </script>


            @if (isset($user))
                <div class="mt-4">
                    <h2 class="text-lg font-semibold">Counseling Records for Student: {{ $studentNumber }}</h2>
                    <div class="border p-4 mt-2">
                        <!-- Additional details about the student -->
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                        <p><strong>Course:</strong> {{ $user->course }}</p>
                        <p><strong>Age:</strong> {{ $user->age }}</p>
                        <p><strong>Birthday:</strong> {{ $user->birthday }}</p>
                        <!-- Add other fields as needed -->
                    </div>
                    @if (isset($counselingRecords) && !$counselingRecords->isEmpty())
                        <div class="mt-4">
                            <h2 class="text-lg font-semibold">Previous Records</h2>
                            <ul>
                                @foreach ($counselingRecords as $record)
                                    <li>
                                        <!-- Make the date a link to view the record details -->
                                        <a href="javascript:void(0);"
                                            onclick="showRecordDetails('{{ $record->id }}', '{{ $record->user->name }}')">
                                            Counseling Session {{ $loop->iteration }} - {{ $record->updated_at }}
                                        </a>
                                        <!-- Add a hidden div to display the record details -->
                                        <div id="recordDetails{{ $record->id }}" style="display: none;">
                                            <p><strong>Counseled by:</strong> {{ $record->counseled_by }}</p>
                                            <p><strong>Findings:</strong> {{ $record->findings }}</p>
                                            <p><strong>Present Conditions:</strong> {{ $record->present_conditions }}</p>
                                            <p><strong>Conclusions:</strong> {{ $record->conclusions }}</p>
                                            <p><strong>Recommendations:</strong> {{ $record->recommendations }}</p>
                                            <p><strong>Difficulties:</strong> {{ $record->difficulties }}</p>
                                            <p><strong>Background of the Study:</strong> {{ $record->background_of_study }}
                                            </p>
                                            <!-- Add other details as needed -->
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <p>No Counseling Records Found for {{ $user->name }} </p>
                    @endif
                </div>
                <div class="mt-4">
                    <button onclick="showAddRecordForm('{{ $studentNumber }}')"
                        class="border bg-adminPrimary rounded-3xl w-[125px] text-white mx-2">Add a Record</button>
                </div>

                <script>
                    function showRecordDetails(recordId, name) {
                        // Open a new window with the record details
                        const detailsWindow = window.open('', 'Record Details', 'width=600,height=400');
                        detailsWindow.document.write(`<html><head><title>Record Details</title></head><body>`);
                        detailsWindow.document.write(`<h1>Counseling Record of: ${name}</h1>`);
                        detailsWindow.document.write(document.getElementById(`recordDetails${recordId}`).innerHTML);
                        detailsWindow.document.write(`</body></html>`);
                        detailsWindow.document.close();
                    }

                    function showAddRecordForm(studentId) {
                        // Open a new window with the form for adding a new record
                        const newRecordWindow = window.open('', 'Add New Record', 'width=1280,height=720');
                        newRecordWindow.document.write('<html><head><title>Add New Record</title>');

                        // Include styles directly in the HTML
                        newRecordWindow.document.write(`
        <style>
            body {
                font-family: 'Arial', sans-serif;
                padding: 20px;
            }
            label {
                display: block;
                margin-bottom: 8px;
            }
            textarea, input {
                width: 100%;
                border: 1px solid #ccc;
                padding: 8px;
                border-radius: 4px;
                margin-bottom: 12px;
            }
            button {
                border: 1px solid #333;
                background-color: #555;
                color: white;
                padding: 8px 16px;
                border-radius: 4px;
                cursor: pointer;
            }
            h1{
                font-size:20px;
            }
        </style>
    `);

                        newRecordWindow.document.write('</head><body>');

                        // Add the form for adding a new record
                        newRecordWindow.document.write(`
        <form action="{{ route('counseling-records.create') }}?studentId=${studentId}" method="GET">
            @csrf
            <input type="hidden" name="student_id" value="{{ $user->id }}">
            <div class="mt-4">
                <h1>Records For : {{ $user->name }}</h1>
            </div>
            <div class="mt-4">
                <label for="newFindings">Findings:</label>
                <textarea id="newFindings" name="findings" class="w-full border p-2 rounded-2xl" placeholder="Enter new findings..."></textarea>
            </div>

            <div class="mt-4">
                <label for="newPresentConditions">Present Conditions:</label>
                <textarea id="newPresentConditions" name="presentconditions" class="w-full border p-2 rounded-xl" placeholder="Enter Present Conditions..."></textarea>
            </div>

            <div class="mt-4">
                <label for="newConclusions">Conclusions:</label>
                <textarea id="newConclusions" name="conclusions" class="w-full border p-2 rounded-xl" placeholder="Enter Conclusions..."></textarea>
            </div>

            <div class="mt-4">
                <label for="newRecommendations">Recommendations:</label>
                <textarea id="newRecommendations" name="recommendations" class="w-full border p-2 rounded-xl" placeholder="Enter Recommendations..."></textarea>
            </div>

            <div class="mt-4">
                <label for="newDifficulties">Difficulties:</label>
                <textarea id="newDifficulties" name="difficulties" class="w-full border p-2 rounded-xl" placeholder="Enter Difficulties..."></textarea>
            </div>

            <div class="mt-4">
                <label for="newBackground">Background of the Study:</label>
                <textarea id="newBackground" name="backgroundOfStudy" class="w-full border p-2 rounded-xl" placeholder="Enter Background of the Study..."></textarea>
            </div>

            <!-- Add other input fields as needed -->

            <div class="mt-4">
                <button type="submit" class="border bg-adminPrimary rounded-3xl w-[75px] text-white mx-2">Save</button>
                <button type="button" onclick="window.close()" class="border bg-adminPrimary rounded-3xl w-[75px] text-white mx-2">Cancel</button>
            </div>
        </form>
    `);

                        newRecordWindow.document.write('</body></html>');
                        newRecordWindow.document.close();
                    }
                </script>
            @else
                <p></p>
            @endif
        </div>
        </div>
    </body>

    </html>

@endsection

@extends('layouts.layout')


@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Update Profile</title>
        @vite('resources/css/app.css')
        <style>
            .card .small {
    font-size: 20px;
    margin-left:auto;
    margin-right:auto;
  }
  .card p{
   font-size: 12px;
  }
  .go-corner {
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    width: 32px;
    height: 32px;
    overflow: hidden;
    top: 0;
    right: 0;
    background-color: #E2A3A3;
    border-radius: 0 4px 0 32px;
  }
  
  .card1 {
    display: block;
    position: relative;
    max-width: 700px;
    background-color: #f2f8f9;
    border-radius: 20px;
    padding: 50px 24px;
    margin: 12px;
    text-decoration: none;
    z-index: 0;
    overflow: hidden;
    margin-left:auto;
    margin-right:auto;
  }
  
  .card1:before {
    content: "";
    position: absolute;
    z-index: -1;
    top: -16px;
    right: -16px;
    background: #E2A3A3;
    height: 32px;
    width: 32px;
    border-radius: 32px;
    transform: scale(1);
    transform-origin:center;
    transition: transform 0.25s ease-out;
  }
  
  .card1:hover:before {
    transform: scale(50);
  }
  
  .card1:hover p {
    transition: all 0.3s ease-out;
    color: rgba(255, 255, 255, 0.8);
  }
  
  .card1:hover h3 {
    transition: all 0.3s ease-out;
    color: #fff;
  }
  .card1:hover h1 {
    transition: all 0.3s ease-out;
    color: #fff;
  }
  .card1:hover button{
    transition: all 0.3s ease-out;
    color: #fff;
}
.card1:hover .small {
    transition: all 0.3s ease-out;
    color: #fff;
  }
  .card1 .small {
    margin-left:50px;
  }
  .card {
    animation: floating 2s ease-in-out infinite; /* Adjust the duration and timing function as needed */
    background-color: #f2f8f9;
    max-width:700px;
    margin-left: auto;
    margin-top:300px;

    margin-right:auto;
    border-radius:20px;
  }
  @keyframes floating {
  0% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(10px);
  }
  100% {
    transform: translateY(0);
  }
}
        </style>
    </head>

    <body>
        <form method="POST" action="{{ route('update_profile') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="flex ">
                    <div class="inputBox mt-4 p-6 px-2 py-2">
                        <span style="font-weight: bold;">UPDATE YOUR PICTURE:</span>
                        <input type="file" name="avatar" id="avatarName" accept="image/jpg, image/jpeg, image/png"
                            class="box">
                    </div>
                    <button type="submit"
                        class=" bg-lightpink hover:bg-customRed w-[200px] gap-[10px] text-white py-2 p-4 px-4 mr-26 rounded-md cursor-pointer transition duration-300 mt-7">Update
                        Profile</button>
                    <a href="/profile"
                        class="bg-lightpink hover:bg-customRed w-[200px] gap-[10px] text-center p-4 text-white   rounded-md mr-20 cursor-pointer transition duration-300 mt-7">Go
                        Back</a><br>
                </div>
            </div>
        </form>
        
    </body>

    </html>
@endsection

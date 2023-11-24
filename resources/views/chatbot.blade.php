<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        ::-webkit-scrollbar {
            width: 5px;
        }
        ::-webkit-scrollbar-track {
            background: #89201a;
        }
        ::-webkit-scrollbar-thumb {
            background: #89201a;
        }
    </style>
</head>
<body>
<div class="container-fluid p-0 d-flex flex-column" style="min-height: 90vh; background:#5c211d;">
    <div class="d-flex align-items-center p-2" style="background: #5c211d;">
        <div class="pl-2" style="width: 40px; height: 50px; font-size: 180%;">
            <i class="fa fa-angle-double-left text-white mt-2"></i>
        </div>
        <div style="width: 50px; height: 50px;">
            <img src="./images/avatar.jpg" width="100%" height="100%" style="border-radius: 50px; width:100%; height:100%;">
        </div>
        <div class="text-white font-weight-bold ml-2 mt-2">
            MindScape ChatBot
        </div>
    </div>
    <div style="background: white; height: 2px;"></div>
    <div id="content-box" class="flex-grow-1 p-2" style="overflow-y: scroll;">
        <!-- Content goes here -->
    </div>
    
    <div class="d-flex p-2" style="background: #5c211d;">
        <div class="mr-2 flex-grow-1 pr-2" style="background: #ffffff1c; border-radius: 5px;">
            <input id="input" class="text-white w-100" type="text" name="input" style="background: none; border: 0; outline: none;">
        </div>
        <div id="button-submit" class="d-flex align-items-center justify-content-center" style="background: #89201a; border-radius: 5px; width: 50px;">
            <i class="fa fa-paper-plane text-white" aria-hidden="true"></i>
        </div>
    </div>
</div>
</body>
<!-- Move the JavaScript here -->
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#button-submit').on('click', function () {
        var $value = $('#input').val();

        $('#content-box').append(`  <div class="mb-2">
            <div class="float-right px-3 py-2 mt-2" style="width: 270px; background: white; border-radius: 10px; float: right; font-size: 85%">
                ` + $value + `
            </div>
            <div style="clear: both;"></div>
        </div>`);

        $('#input').val(''); // Clear the input field

        $.ajax({
            type: 'post',
            url: '{{url('send')}}',
            data: {
                'input': $value
            },
            success: function (data) {
                $('#content-box').append(` <div class="d-flex mb-2">
                    <div class="mr-2" style="width: 45px; height: 45px;">
                        <img src="https://cdn.iconscout.com/icon/free/png-256/free-avatar-370-456322.png?f=webp" width="100%" height="100%" style="border-radius: 50px;">
                    </div>
                    <div class="text-white px-3 py-2" style="width: 270px; background: #13254b; border-radius: 10px; font-size: 85%">
                        ` + data + `
                    </div>
                </div>`);

                $('#input').val(''); // Clear the input field
            }
        });
    });
</script>
</html>

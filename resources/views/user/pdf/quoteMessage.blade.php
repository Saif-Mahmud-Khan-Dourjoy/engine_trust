<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <style>
        .quote-msg-div {
            position: fixed;

            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2;
            cursor: pointer;
        }

        #msg {
            position: absolute;
            top: 50%;
            left: 50%;
            font-weight: bold;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
           
        }
    </style>
    <title>Quote Message</title>
</head>

<body>
    <div class="login">
        <div class="login-main-div">
            <div class="login-logo-img ">
                <img src="{{ asset('image/login_logo.svg') }}" style="margin-left: 20px" alt="">
            </div>
            <div class="quote-msg-div" >

                <div id="msg" style="font-size: 30px !important" class="text-{{$color}}">{{$msg}}</div>

            </div>

        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify Link</title>
</head>

<body>

    <p>Dear {{ $name }},</p>
    <h4 style="margin: 10px 0px">Please cLick the link and verify your email.</h4>

    <div style="margin:20px 0px ">
        <a href="{{ $base . '/email-verify/' . $id }}" style="text-decoration: none;cursor: pointer;"><button
                style="color:white;padding:10px;border:none;background:green;border-radius:5px">Verify</button></a>
    </div>
    <p>Regards,</p>
    <p>V6 Autocentre</p>
</body>

</html>

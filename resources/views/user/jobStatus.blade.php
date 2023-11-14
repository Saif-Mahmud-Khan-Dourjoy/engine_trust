<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Status</title>
</head>
<body>
    <img src="{{ $base . '/job-mail-status?id=' . $id }}"  style="height: 1px; width:1px"/>
    <p >Dear {{$name}},</p>
   <h4 style="margin: 10px 0px">The present status of your Car is: <span style="font-size:18px; color:darkcyan"> {{$status}}</span> </h4> 
   
</body>
</html>
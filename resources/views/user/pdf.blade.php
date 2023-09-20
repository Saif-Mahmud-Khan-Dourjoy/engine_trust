<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quotation</title>
</head>
<body>
    <p >Dear {{$name}},</p>
   <h4 style="margin: 10px 0px">Here is the quotation for you enquiry. Please take a look.</h4> 
   <div style="margin-bottom:20px ">
    <a href="{{$base.'/quote-accept/'.$id}}" style="text-decoration: none"><button style="color:white;padding:10px;border:none;background:green;border-radius:5px">Accept</button></a>  <a href="{{$base.'/quote-decline/'.$id}}" style="text-decoration: none"><button style="color:white;padding:10px;border:none;background:red;border-radius:5px">Decline</button></a>
   </div> 
    <p>Regards,</p>
    <p>{{$company_name}}</p>
</body>
</html>
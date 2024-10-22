<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quotation</title>
    <style>

    </style>
</head>

<body>
    <div style="padding: 10px">
        <div style="text-align:center">
            @if (is_null($logo))
                <img src="{{ asset('image/pdf_logo.png') }}" alt="" style="height: 60px; width:70px">
            @else
                <img src="{{ $logo }}" alt="" style="height: 60px; width:70px">
            @endif
        </div>
        <div style="margin-top: 30px;text-align:center">
            <span
                style="color: rgba(10, 10, 15, 0.70);
             font-family: Montserrat;
             font-size: 24px;
             font-style: normal;
             font-weight: 600;
             line-height: normal;">{{ $business_name }}</span>
        </div>
        <div style="text-align:center;margin-top:20px">
            <div
                style="color: rgba(10, 10, 15, 0.70);
            font-family: Montserrat;
            font-size: 16px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
            padding:0px 100px">

                <div style="display: inline-block;">
                    <span
                        style="height: 7px;
                        width: 7px;
                        background-color: #69BF70;
                        border-radius: 50%;
                        display: inline-block; margin-right:5px"></span><span>
                        Date: </span> <span> {{ $quote_date }}</span>
                </div>
            </div>

        </div>
        <div style="margin-top: 30px; width:100%;text-align:center">
            <div>
                <div
                    style="height: 6px; background-color: #69BF70;
            border-radius: 10px;
            display: inline-block;width:200px">

                </div>
                <div style="width: 150px;text-align:center;display: inline-block">
                    <span
                        style="color: rgba(10, 10, 15, 0.70);
                font-family: Montserrat;
                font-size: 20px;
                font-style: normal;
                font-weight: 600;
                line-height: normal;">Quotation</span>
                </div>
                <div
                    style="height: 6px; background-color: #69BF70;
            border-radius: 10px;
            display: inline-block;width:200px">

                </div>
            </div>
        </div>
        <div style="margin-top: 30px; text-align:center">
            <div style="display:inline-block;text-align:start; vertical-align: top;">
                <div
                    style="color: rgba(10, 10, 15, 0.80);
               font-family: Montserrat;
               font-size: 16px;
               font-style: normal;
               font-weight: 700;
               line-height: normal;">
                    Customer Details:
                </div>
                <div
                    style="color: #000;
               font-family: Montserrat;
               font-size: 16px;
               font-style: normal;
               font-weight: 500;
               line-height: normal;
               margin-top:20px
               ">
                    <span>Name:</span> <span> {{ $query_person_name }}</span>
                </div>
                <div
                    style="color: #000;
               font-family: Montserrat;
               font-size: 16px;
               font-style: normal;
               font-weight: 500;
               line-height: normal;
               margin-top:20px">
                    <span>Phone:</span> <span> {{ $query_person_phone }}</span>
                </div>
                <div
                    style="color: #000;
               font-family: Montserrat;
               font-size: 16px;
               font-style: normal;
               font-weight: 500;
               line-height: normal;
               margin-top:20px">
                    <span>Postcode:</span> <span> {{ $query_person_postCode }}</span>
                </div>
                <div
                    style="padding: 10px 15px;display:inline-block;background:#FFC700;border-radius:10px;text-align:center;margin-top:20px">
                    <span
                        style="color: #000;
                font-family: Montserrat;
                font-size: 16px;
                font-style: normal;
                font-weight: 600;
                line-height: normal;
                ">{{ $reg_num }}</span>
                </div>
                <div
                    style="color: #000;
               font-family: Montserrat;
               font-size: 14px;
               font-style: normal;
               font-weight: 500;
               line-height: normal;
               margin-top:20px">
                    <span>{{ $carMakeModel }} </span>
                </div>
                <div
                    style="color: #000;
           font-family: Montserrat;
           font-size: 14px;
           font-style: normal;
           font-weight: 500;
           line-height: normal;
           margin-top:20px">
                    <span>{{ $engineSize . ' ' . $fuelType . ' ' . $year }} </span>
                </div>
                <div
                    style="color: #000;
               font-family: Montserrat;
               font-size: 14px;
               font-style: normal;
               font-weight: 500;
               line-height: normal;
               margin-top:20px">
                    <span>Engine Size:</span> <span> {{ $engineSize }} </span>
                </div>

            </div>

            <div style="display:inline-block;text-align:end;vertical-align: top;margin-left:30px">
                <div
                    style="color: rgba(10, 10, 15, 0.80);
                font-family: Montserrat;
                font-size: 18px;
                font-style: normal;
                font-weight: 700;
                line-height: normal;">
                    Company Details:
                </div>
                <div
                    style="color: #000;
                font-family: Montserrat;
                font-size: 16px;
                font-style: normal;
                font-weight: 500;
                line-height: normal;
                margin-top:20px">
                    <span>Contact:</span> <span>{{ $contact }}</span>
                </div>
                <div
                    style="color: #000;
                font-family: Montserrat;
                font-size: 16px;
                font-style: normal;
                font-weight: 500;
                line-height: normal;
                margin-top:20px">
                    <span>Phone:</span> <span> {{ $phone }}</span>
                </div>
                <div
                    style="color: #000;
                font-family: Montserrat;
                font-size: 16px;
                font-style: normal;
                font-weight: 500;
                line-height: normal;
                margin-top:20px">
                    <span>Email:</span> <span> {{ $email }}</span>
                </div>

                <div
                    style="color: #000;
                font-family: Montserrat;
                font-size: 16px;
                font-style: normal;
                font-weight: 500;
                line-height: normal;
                margin-top:20px">
                    <span>Address:</span> <span> {{ $address }}</span>
                </div>

            </div>
        </div>
        <div style="margin-top: 30px; width:100%;text-align:center">
            <div>
                <div
                    style="height: 6px; background-color: #69BF70;
            border-radius: 10px;
            display: inline-block;width:150px">

                </div>
                <div style="width: 300px;text-align:center;display: inline-block">
                    <span
                        style="color: rgba(10, 10, 15, 0.70);
                font-family: Montserrat;
                font-size: 20px;
                font-style: normal;
                font-weight: 600;
                line-height: normal;">Price
                        Quotation Description</span>
                </div>
                <div
                    style="height: 6px; background-color: #69BF70;
            border-radius: 10px;
            display: inline-block;width:150px">

                </div>
            </div>
        </div>


        <div style="margin-top:30px">
            @foreach ($price_arr as $price)
                <div
                    style=" line-height: 50px;
                width: 600px;
                margin: 0 auto;
                background-color: #ECF8F2;
                padding: 0px 20px;
                height: 50px;
                border-radius: 5px;
                margin-bottom:5px
                                       ">
                    <div
                        style="float: left;color: rgba(0, 0, 0, 0.70);
                        font-family: Montserrat;
                        font-size: 16px;
                        font-style: normal;
                        font-weight: 500;
               ">
                        {{ $price['name'] }}
                    </div>
                    <div
                        style="float:right;color: rgba(0, 0, 0, 0.70);
                            font-family: Montserrat;
                            font-size: 16px;
                            font-style: normal;
                            font-weight: 700;
               ">
                        {{ $price['cost'] }}
                    </div>
                </div>
            @endforeach

        </div>

        <div style="margin-top: 20px; width:100%;text-align:center">
            <div>
                <div style="display: inline-block;width:200px;vertical-align: top">
                    <div
                        style="color: #000;
                                font-family: Montserrat;
                                font-size: 16px;
                                font-style: normal;
                                text-align:start">
                        <span style="font-weight: 600;">Mileage:</span> <span style="font-weight: 500;">
                            {{ $mileage }}</span>
                    </div>
                    <div
                        style="color: #000;
                                font-family: Montserrat;
                                font-size: 16px;
                                font-style: normal;
                                text-align:start;
                                margin:15px 0px">
                        <span style="font-weight: 600;">Condition:</span> <span style="font-weight: 500;">
                            {{ $condition }}</span>
                    </div>
                    <div
                        style="color: #000;
                                font-family: Montserrat;
                                font-size: 16px;
                                font-style: normal;
                                text-align:start">
                        <span style="font-weight: 600;">Warranty:</span> <span style="font-weight: 500;">
                            {{ $warranty }}</span>
                    </div>

                </div>
                <div style="display: inline-block;width:350px;vertical-align: top">

                    <div
                        style=" line-height: 50px;
                            width: 350px;
                            background-color: #ECF8F2;
                            padding: 0px 20px;
                            height: 50px;
                            border-radius: 5px;
                            margin-bottom:5px
                                                ">
                        <div
                            style="float: left;color: rgba(0, 0, 0, 0.70);
                                font-family: Montserrat;
                                font-size: 16px;
                                font-style: normal;
                                font-weight: 500;
                             ">
                            Sub Total
                        </div>
                        <div
                            style="float:right;color: rgba(0, 0, 0, 0.70);
                                        font-family: Montserrat;
                                        font-size: 16px;
                                        font-style: normal;
                                        font-weight: 700;
                        ">
                            {{ $subTotal }}
                        </div>
                    </div>
                    <div
                        style=" line-height: 50px;
                            width: 350px;
                            background-color: #ECF8F2;
                            padding: 0px 20px;
                            height: 50px;
                            border-radius: 5px;
                            margin-bottom:5px
                                                ">
                        <div
                            style="float: left;color: rgba(0, 0, 0, 0.70);
                                font-family: Montserrat;
                                font-size: 16px;
                                font-style: normal;
                                font-weight: 500;
                             ">
                            Vat
                        </div>
                        <div
                            style="float:right;color: rgba(0, 0, 0, 0.70);
                                        font-family: Montserrat;
                                        font-size: 16px;
                                        font-style: normal;
                                        font-weight: 700;
                        ">
                            {{ $vat_price }}
                        </div>
                    </div>
                    <div
                        style=" line-height: 50px;
                            width: 350px;
                            background-color: #ECF8F2;
                            padding: 0px 20px;
                            height: 50px;
                            border-radius: 5px;
                            margin-bottom:5px
                                                ">
                        <div
                            style="float: left;color: rgba(0, 0, 0, 0.70);
                                font-family: Montserrat;
                                font-size: 16px;
                                font-style: normal;
                                font-weight: 500;
                             ">
                            Total
                        </div>
                        <div
                            style="float:right;color: rgba(0, 0, 0, 0.70);
                                        font-family: Montserrat;
                                        font-size: 16px;
                                        font-style: normal;
                                        font-weight: 700;
                        ">
                            {{ $total }}
                        </div>
                    </div>
                </div>

            </div>
        </div>



        <div style="margin-top: 15px; text-align:center">
            <div style="height:3px; width:700px;background:#69BF70;border-radius:10px;display:inline-block">

            </div>
        </div>
        <div style="margin-top:20px; ">
            <div style="margin:0 auto;width:700px">
                <div style="">
                    {!! $selling_point !!}
                </div>
                <div style="margin-top:20px;">
                    {!! $terms_condition !!}
                </div>
            </div>

        </div>


    </div>


</body>

</html>

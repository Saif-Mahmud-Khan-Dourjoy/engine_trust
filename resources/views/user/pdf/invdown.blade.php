<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
</head>

<body>
    <div style="width:95%; padding: 10px;border: 1px solid black">
        <div style="width: 650px; margin: 0 auto; display: block">
            <div style="text-align:center;margin-bottom:10px">
                <img src="image/pdf_logo.png" alt="" style="height: 60px; width:70px">
            </div>
            <div style="width: fit-content;margin: 0 auto; text-align:center;margin-bottom:5px">
                <span style="font-size:24px; font-weight:bold">Invoice</span>
            </div>

            <div
                style="width: fit-content;margin: 0 auto; font-size:20px;font-weight:bold; text-align:center;margin-bottom:2px">
                <span style="">{{ $business_name ?? 'N/A' }}</span>
            </div>
            {{-- <div style="width: fit-content;margin: 0 auto;">
                <img style="height:50px;width:50px" src="{{ asset('image/login_logo.svg') }}" alt="">
            </div> --}}

            <div style="width: fit-content;margin: 0 auto; text-align:center;margin-bottom:2px">
                <span style="">Address : &nbsp; {{ $address ?? 'N/A' }}</span>
            </div>
            <div style="width: fit-content;margin: 0 auto; text-align:center;margin-bottom:2px">
                <span style="">Email : &nbsp; {{ $email ?? 'N/A' }}</span>
            </div>
            <div style="width: fit-content;margin: 0 auto; text-align:center;margin-bottom:2px">
                <span style="">Phone : &nbsp; {{ $phone ?? 'N/A' }}</span>
            </div>





        </div>
        <div style="width: 650px; margin: 0 auto;margin-top:10px">
            <hr>
        </div>
        <div style="width: 650px; margin: 0 auto;margin-top:10px;display: block;">

            <div style="float: left;display:inline-block">
                <div style="margin-bottom:10px">
                    <div style="margin-bottom: 5px; color: grey">Billed to :</div>
                    <div style="font-size: 16px;">{{ $query_person_name ?? 'N/A' }}</div>

                </div>
                <div style="margin-bottom:10px">
                    <div style="margin-bottom: 5px; color: grey">Address :</div>
                    <div style="font-size: 16px;">{{ $query_person_address ?? 'N/A' }}</div>

                </div>
                <div style="margin-bottom:10px">
                    <div style="margin-bottom: 5px; color: grey">Phone number :</div>
                    <div style="font-size: 16px;">{{ $query_person_phone ?? 'N/A' }}</div>

                </div>
            </div>
            <div style="float: right;text-align:right;display:inline-block">
                <div style="margin-bottom:10px">
                    <div style="margin-bottom: 5px; color: grey">Referance no :</div>
                    <div style="font-size: 16px;">{{ $ref ?? 'N/A' }}</div>
                </div>
                <div style="margin-bottom:10px">
                    <div style="margin-bottom: 5px; color: grey">Invoice no :</div>
                    <div style="font-size: 16px;">{{ $invoice_no ?? 'N/A' }}</div>
                </div>
                <div style="margin-bottom:10px">
                    <div style="margin-bottom: 5px; color: grey">Date :</div>
                    <div style="font-size: 16px;">{{ $invoice_date ?? 'N/A' }}</div>
                </div>
                <div style="margin-bottom:10px">
                    <div style="margin-bottom: 5px; color: grey">Vehicle Make :</div>
                    <div style="font-size: 16px;">{{ $vehicle_make ?? 'N/A' }}</div>
                </div>
                <div style="margin-bottom:10px">
                    <div style="margin-bottom: 5px; color: grey">Reg. No :</div>
                    <div style="font-size: 16px;">{{ $vehicle_reg_num ?? 'N/A' }}</div>
                </div>


                <div style="margin-bottom:10px">
                    <div style="margin-bottom: 5px; color: grey">Vehicle Model :</div>
                    <div style="font-size: 16px;">{{ $vehicle_model ?? 'N/A' }}</div>
                </div>
                <div style="margin-bottom:10px">
                    <div style="margin-bottom: 5px; color: grey">Current Mileage :</div>
                    <div style="font-size: 16px;">{{ $mileage ?? 'N/A' }}</div>
                </div>
            </div>
            <div style="clear: both;"></div>


        </div>
        <div style="width: 650px; margin: 0 auto;margin-top:10px">
            <hr>
        </div>
        <div style="width: 650px; margin: 0 auto;margin-top:10px">
            <div style="float: left;display:inline-block">
                <div style="">
                    <div style=" color: grey;font-size: 18px">Description :</div>

                </div>
            </div>
            <div style="float: right;display:inline-block">
                <div style="text-align:right">
                    <div style=" color: grey;font-size: 18px">Amount :</div>

                </div>
            </div>
            <div style="clear: both"></div>

        </div>
        @foreach ($price_arr as $price)
            <div style="width: 650px; margin: 0 auto;margin-top:10px">
                <div style="float: left;display:inline-block">
                    <div style="">
                        <div style=" color: grey">{{ $price['name'] }}</div>

                    </div>
                </div>
                <div style="float: right;display:inline-block">
                    <div style="text-align:right">
                        <div style=" color: grey">{{ $price['cost'] }}</div>

                    </div>
                </div>
                <div style="clear: both"></div>

            </div>
        @endforeach

        <div style="width: 650px; margin: 0 auto;margin-top:5px">
            <hr>
        </div>

        <div style="width: 650px; margin: 0 auto;margin-top:5px;text-align:right">
            <div style="margin-bottom: 5px"><span style=" color: grey">SubTotal :</span> &nbsp; <span
                    style="font-weight: bold;font-size:18px"> {{ $sub_total ?? 'N/A' }}</span> </div>
            <div style="margin-bottom: 5px"><span style=" color: grey">Vat :</span> &nbsp; <span
                    style="font-weight: bold;font-size:18px"> {{ $vat ?? 'N/A' }} %</span> </div>
            <div style="margin-bottom: 5px"><span style=" color: grey">Invoice Total :</span> &nbsp; <span
                    style="font-weight: bold;font-size:18px;color:darkgreen">{{ $total ?? 'N/A' }}</span> </div>
            <div style="margin-bottom: 5px"><span style=" color: grey">Total Paid Amount :</span> &nbsp; <span
                    style="font-weight: bold;font-size:18px;color:rgb(71, 130, 136)">{{ $paid ?? 'N/A' }}</span>
            </div>
            <div style="margin-bottom: 5px"><span style=" color: grey">Paybale Amount Now :</span> &nbsp; <span
                    style="font-weight: bold;font-size:18px;color:rgb(71, 130, 136)">{{ $payable_amount ?? 'N/A' }}</span>
            </div>
            <div style=""><span style=" color: grey">Due Amount :</span> &nbsp; <span
                    style="font-weight: bold;font-size:18px;color:rgb(237, 20, 20)">{{ $due ?? 'N/A' }}</span> </div>
        </div>





    </div>


</body>



</html>

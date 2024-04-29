<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
</head>

<body>
    <div style="width:95%; padding: 20px;border: 1px solid black">
        <div style="width: 700px; margin: 0 auto; display: table;">
            <div style="display: table-row;">
                <div style="display: table-cell; vertical-align: middle; ">
                    <span style="font-size:24px; font-weight:bold">Invoice</span>
                </div>
                <div style="display: table-cell; vertical-align: middle;float: right;">
                    <div style="display: table;">
                        <div style="display: table-row;">
                            <div style="display: table-cell; vertical-align: middle; font-size:20px;font-weight:bold">
                                {{$business_name}}
                            </div>
                            <div style="display: table-cell; vertical-align: middle; padding-left:10px">
                                <img style="height:50px;width:50px" src="{{ asset('image/login_logo.svg') }}"
                                    alt="">
                            </div>
                        </div>
                    </div>
                    <div
                        style="display: table-cell; vertical-align: middle;float: right;font-family: Montserrat, sans-serif; color:gray;">
                        <div style="display: table; margin-top:5px;">
                            <div style="display: table-row;width:100%;">
                                <div style="display: table-cell; vertical-align: middle;">
                                    Address :
                                </div>
                                <div style="display: table-cell; vertical-align: middle;">
                                    &nbsp; {{$address}}
                                </div>
                            </div>
                        </div>
                        <div style="display: table; margin-top:5px;">
                            <div style="display: table-row;width:100%;margin-top:5px">
                                <div style="display: table-cell; vertical-align: middle;">
                                    Email :
                                </div>
                                <div style="display: table-cell; vertical-align: middle;">
                                    &nbsp; {{$email}}
                                </div>
                            </div>
                        </div>
                        <div style="display: table; margin-top:5px;">
                            <div style="display: table-row;width:100%;margin-top:5px">
                                <div style="display: table-cell; vertical-align: middle;">
                                    Phone :
                                </div>
                                <div style="display: table-cell; vertical-align: middle;">
                                    &nbsp;  {{$phone}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div style="width: 700px; margin: 0 auto;margin-top:30px">
            <hr>
        </div>
        <div style="width: 700px; margin: 0 auto;margin-top:40px;display: block;">
           
                <div style="float: left;display:inline-block">
                    <div style="margin-bottom:20px">
                        <div style="margin-bottom: 5px; color: grey">Billed to :</div>
                        <div style="font-size: 18px;">{{$query_person_name}}</div>
    
                    </div>
                    <div style="margin-bottom:20px">
                        <div style="margin-bottom: 5px; color: grey">Address :</div>
                        <div style="font-size: 18px;">{{$query_person_address}}</div>
    
                    </div>
                    <div style="margin-bottom:20px">
                        <div style="margin-bottom: 5px; color: grey">Phone number :</div>
                        <div style="font-size: 18px;">{{$query_person_phone}}</div>
    
                    </div>
                </div>
                <div style="float: right;text-align:right;display:inline-block">
                    <div style="margin-bottom:20px">
                        <div style="margin-bottom: 5px; color: grey">Referance no :</div>
                        <div style="font-size: 18px;">{{$ref}}</div>
                    </div>
                    <div style="margin-bottom:20px">
                        <div style="margin-bottom: 5px; color: grey">Invoice no :</div>
                        <div style="font-size: 18px;">{{$invoice_no}}</div>
                    </div>
                    <div style="margin-bottom:20px">
                        <div style="margin-bottom: 5px; color: grey">Date :</div>
                        <div style="font-size: 18px;">{{$invoice_date}}</div>
                    </div>
                    <div style="margin-bottom:20px">
                        <div style="margin-bottom: 5px; color: grey">Vehicle Make :</div>
                        <div style="font-size: 18px;">{{$vehicle_make}}</div>
                    </div>
                    <div style="margin-bottom:20px">
                        <div style="margin-bottom: 5px; color: grey">Vehicle Model :</div>
                        <div style="font-size: 18px;">{{$vehicle_model}}</div>
                    </div>
                    <div style="margin-bottom:20px">
                        <div style="margin-bottom: 5px; color: grey">Current Mileage :</div>
                        <div style="font-size: 18px;">{{$mileage}}</div>
                    </div>
                </div>
                <div style="clear: both;"></div>
            

        </div>

        <div style="width: 700px; margin: 0 auto;margin-top:20px">
            <hr>
        </div>
        <div style="width: 700px; margin: 0 auto;margin-top:20px">
            <div style="float: left;display:inline-block">
                <div style="">
                    <div style=" color: grey">Description :</div>
                    <div style="font-size: 18px;">{{$description}} </div>
                </div>
             </div>
             <div style="float: right;display:inline-block">
                <div style="text-align:right">
                    <div style=" color: grey">Paybale Amount Now :</div>
                    <div style="font-size: 18px;">{{$payable_amount}}</div>
                </div>
            </div>
            <div style="clear: both"></div>

        </div>
        <div style="width: 700px; margin: 0 auto;margin-top:20px">
            <hr>
        </div>

        <div style="width: 700px; margin: 0 auto;margin-top:20px;text-align:right">
             <div style="margin-bottom: 10px"><span style=" color: grey">SubTotal :</span> &nbsp; <span style="font-weight: bold;font-size:20px"> {{$sub_total}}</span> </div>
             <div style="margin-bottom: 10px"><span style=" color: grey">Vat :</span> &nbsp; <span style="font-weight: bold;font-size:20px"> {{$vat}} %</span> </div>
             <div style="margin-bottom: 10px"><span style=" color: grey">Invoice Total :</span> &nbsp; <span style="font-weight: bold;font-size:20px;color:darkgreen">{{$total}}</span> </div>
             <div style="margin-bottom: 10px"><span style=" color: grey">Total Paid Amount :</span> &nbsp; <span style="font-weight: bold;font-size:20px;color:rgb(71, 130, 136)">{{$paid}}</span> </div>
             <div style=""><span style=" color: grey">Due Amount :</span> &nbsp; <span style="font-weight: bold;font-size:20px;color:rgb(237, 20, 20)">{{$due}}</span> </div>
        </div>
       
        

        

    </div>
    

</body>



</html>

<div id='loader loader2'>

</div>

<div class="modal fade" id="customQuoteModal" tabindex="-1" aria-labelledby="customQuoteLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content quote-modal-content">
            <div class="modal-body">
                <div class="modal-cross btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span>
                        <i class="fa-solid fa-xmark modal-cancle-btn"></i>
                    </span>
                </div>
                <div class="modal-content-div">
                    <div class="modal-content-top-div">
                        <div class="">

                        </div>
                        <div class="modal-title-div">
                            <span class="modal-title">Enter your quotation</span>
                        </div>
                        <div class="modal-top-right-div">

                        </div>
                    </div>
                    <div class="modal-content-main-div" style="padding-top: 40px; padding-bottom:40px">
                        <div class="row" style="display: flex;align-items:center">

                            <div class="col-8">
                                <label style="margin-bottom:15px;color:darkgreen" for="">Car Reg Number</label>

                                <input class="form-control reg_num" type="text" name="reg_num" id="reg_num"
                                    placeholder="Reg Num">
                            </div>

                            <div class="col-4">
                                <button class="btn btn-outline-success" onclick="submitAndGetFullInfo()">Submit</button>
                            </div>

                        </div>
                        <div class="car-info-div">


                        </div>

                    </div>
                    <form method="GET" action="{{ route('user.print') }}">
                        <div class="modal-content-main-div">
                            <div class="modal_content_info-div">
                                <div class="name">
                                    <label for="">Full Name</label> <br />
                                    <input type="text" class="form-control info-input " placeholder="Enter name here"
                                        id="enquiry_person_full_name_custom" name="enquiry_person_full_name" />

                                </div>
                                <div class="phone">
                                    <label for="">Phone Number</label> <br />
                                    <input type="text" class="form-control info-input"
                                        placeholder="Enter number here" id="enquiry_person_number_custom"
                                        name="enquiry_person_number_custom" />
                                </div>
                                <div class="email">
                                    <label for="">Email</label><br />
                                    <input type="email" class="form-control info-input" placeholder="Enter email here"
                                        id="enquiry_person_email_custom" name="enquiry_person_email" />
                                </div>
                                <div class="address">
                                    <label for="">Post Code</label><br />
                                    <input type="text" class="form-control info-input"
                                        placeholder="Enter post code here" id="post_code" name="post_code" />
                                </div>
                            </div>
                            <div class="type-charge-div">
                                <div class="type-charge-header-div">
                                    <div class="type">Type</div>
                                    <div class="charge">Charge</div>
                                </div>
                                <div class="type-charge-main-content">
                                    <div class="single-type-charge">
                                        <div class="type">
                                            <span>Engines</span>
                                        </div>
                                        <div class="charge">
                                            <input type="text" name="engines"
                                                class="form-control charge-input engine-cost_custom" value=0
                                                onfocus="inputFocus(event)" oninput="chargeOnInputCustom(event)" />
                                        </div>
                                    </div>
                                    <div class="single-type-charge">
                                        <div class="type">
                                            <span>Exchange Surcharge (Refundable)</span>
                                        </div>
                                        <div class="charge">
                                            <input type="text" name="exchange_surcharge"
                                                class="form-control charge-input exchange-surcharge-cost_custom" value=0
                                                oninput="chargeOnInputCustom(event)" onfocus="inputFocus(event)" />
                                        </div>
                                    </div>
                                    <div class="single-type-charge">
                                        <div class="type">
                                            <span>Delivery Charges</span>
                                        </div>
                                        <div class="charge">
                                            <input type="text" name="delivery_charges"
                                                class="form-control charge-input delivery-cost_custom" value=0
                                                oninput="chargeOnInputCustom(event)" onfocus="inputFocus(event)" />
                                        </div>
                                    </div>
                                    <div class="single-type-charge">
                                        <div class="type">
                                            <span>Recovery</span> &nbsp;
                                            <input type="checkbox" class="tbc-confirm"
                                                onchange="recoveryTBCCustom(event)" style="cursor:pointer" />
                                            <span class="tbc-text">TBC</span>
                                        </div>
                                        <div class="charge">
                                            <input type="text" name="recovery"
                                                class="form-control charge-input recovery-cost_custom" value=0
                                                oninput="chargeOnInputCustom(event)" onfocus="inputFocus(event)" />
                                        </div>
                                    </div>
                                    <div class="single-type-charge">
                                        <div class="type">
                                            <span>Fitting</span>
                                        </div>
                                        <div class="charge">
                                            <input type="text" name="fitting"
                                                class="form-control charge-input fitting-cost_custom" value=0
                                                oninput="chargeOnInputCustom(event)" onfocus="inputFocus(event)" />
                                        </div>
                                    </div>
                                    <div class="single-type-charge">
                                        <div class="type">
                                            <span>VAT</span> &nbsp; <input type="checkbox" class="vat-confirm"
                                                onchange="vatTBCCustom(event)" style="cursor:pointer" />
                                            <span class="tbc-text">TBC</span>
                                        </div>
                                        <div class="charge" style="display: flex;align-items:center">
                                            <input type="text" name="vat"
                                                class="form-control charge-input vat-cost_custom" value=0
                                                oninput="chargeOnInputCustom(event)"
                                                style="margin-right:10px; width:175px" onfocus="inputFocus(event)" />
                                            <span style="font-weight: bold"> % </span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="total-amount-div">
                                <div class="total-amount-select-div">
                                    <div class="Warranty-div common-amount-type-div">
                                        <div class="warranty-left-div">Warranty</div>
                                        <div class="total-amount-select">

                                            <input type="text" name="warranty"
                                                class=" type-select-total-amount warranty-value-select_custom">
                                        </div>
                                    </div>

                                    <div class="condition-div common-amount-type-div">
                                        <div class="condition-left-div">Condition</div>
                                        <div class="condition-select">

                                            <input type="text" name="condition"
                                                class="type-select-total-amount condition-value-select_custom">
                                        </div>
                                    </div>
                                    <div class="mileage-div common-amount-type-div">
                                        <div class="mileage-left-div">Mileage</div>
                                        <div class="mileage-select">

                                            <input type="text" name="mileage"
                                                class="type-select-total-amount mileage-value-select_custom">
                                        </div>
                                    </div>
                                    <div class="total-number">
                                        <span>Total Amount:</span> <span class="total_price price-color">0</span>
                                    </div>
                                </div>

                            </div>
                            @php
                                use App\Models\CompanyQuoteCustomization;
                                if (Auth::guard('web')->check()) {
                                    $userId = Auth::guard('web')->user()->id;
                                    $id = null;
                                    $business_profile = Auth::guard('web')->user()->business_profile;
                                    $name = $business_profile->quoting_person_name;
                                    $subscribed_till = $business_profile->subscribed_till;
                                    $subscribed_at = $business_profile->subscribed_at;
                                    $businessPostCode = Auth::guard('web')->user()->business_profile->post_code;
                                } else {
                                    $userId = Auth::guard('businessUser')->user()->user_id;
                                    $id = Auth::guard('businessUser')->user()->id;
                                    $business_profile = Auth::guard('businessUser')->user()->business->business_profile;
                                    $name = Auth::guard('businessUser')->user()->user_name;
                                    $subscribed_till = $business_profile->subscribed_till;
                                    $subscribed_at = $business_profile->subscribed_at;
                                    $businessPostCode = Auth::guard('businessUser')->user()->business->business_profile
                                        ->post_code;
                                }

                                $quoteCustomization = CompanyQuoteCustomization::where('user_id', $userId)->first();

                            @endphp

                            <div class="quotes-notes-div">
                                <div class="quotes-notes-header">
                                    <span> Other Notes for the Quote </span>
                                </div>
                                <div class="quotes-notes-input-div">
                                    <textarea class="form-control" id="quote_notes_custom" name="quote_notes" rows="4"
                                        placeholder="type notes here"></textarea>
                                </div>
                            </div>
                            <div class="terms-condition-div">
                                <div class="terms-condition-header">
                                    <span> Terms & Conditions </span>
                                </div>
                                <div class="terms-condition-input-div">
                                    <!-- <input class="form-control" type="text" name="selling_point_title" id="selling_point_title" placeholder="Enter Selling point title"> -->
                                    <textarea name="terms_condition" class="form-control summernote" id="terms_condition_custom" rows="4"
                                        placeholder="type terms & Conditions here"> {{ $quoteCustomization ? $quoteCustomization->terms_condition_description : '' }}</textarea>
                                </div>
                            </div>
                            <div class="recovery-error mt-2 text-danger" style="text-align: center">
                                Recover amount must be greater than or equal 50
                            </div>
                            <div class="quotes-send-button-div">
                                {{-- <div class="send-email common-btn-style" style="cursor: pointer">
                                    <span>Send Email</span>
                                </div>
                                <div class="send-sms common-btn-style" style="cursor: pointer">
                                    <span>Send SMS</span>
                                </div> --}}
                                <div class="send-quotes common-btn-style" style="cursor: pointer">
                                    <span class="send-quote-btn" onclick="sendQuoteCustom()">Send Quote</span>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="print-div">
                            <button type="submit" class="print-content">
                                <i class="fa-solid fa-print"></i>
                                <span style="cursor: pointer">Print</span>
                            </button>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content invoice-modal-content">
            <div class="modal-body">
                <div class="modal-cross btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span>
                        <i class="fa-solid fa-xmark modal-cancle-btn"></i>
                    </span>
                </div>
                <div class="invoice-main-content-div">
                    <div class="upper-div">
                        <div class="title-div">
                            <span>Invoice</span>
                        </div>
                        <div class="info-div">
                            <div class="name-logo-div">
                                <div class="name">V6 Auto Centre</div>
                                <div class="invoice-logo">
                                    <img src="{{ asset('image/logo.png') }}" alt="" />
                                </div>
                            </div>
                            <div class="general-info">
                                <div class="address">
                                    <span>Address: </span><span>Unit 5 Meadow laneNottinghamNG23HD</span>
                                </div>
                                <div class="email">
                                    <span>Email: </span><span>adam@v6autocentre.co.uk</span>
                                </div>
                                <div class="phone">
                                    <span>Phone number: </span><span>01158880303</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="color: rgba(0, 0, 0, 0.2)" />
                    <div class="invoice-input-div">
                        <div class="invoice-input-left-div">
                            <div class="billed-to">
                                <label for="">Billed to</label>
                                <input type="text" name="billed_to" id="billed_to" class="form-control" />
                            </div>
                            <div class="Address">
                                <label for="">Address</label>
                                <textarea class="form-control" id="invoice-address" rows="5"></textarea>
                            </div>
                            <div class="phone-number">
                                <label for="">Phone number</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control" />
                            </div>
                        </div>
                        <div class="invoice-input-right-div">
                            <div class="ref-no">
                                <label for="">Referance no</label>
                                <input type="text" name="invoice_referance_no" id="invoice_referance_no"
                                    class="form-control" />
                            </div>
                            <div class="invoice-no">
                                <label for="">Invoice no</label>
                                <input type="text" name="invoice_no" id="invoice_no" class="form-control" />
                            </div>
                            <div class="date">
                                <label for="">Date</label>
                                <input type="date" name="invoice_date" id="invoice_date" class="form-control" />
                            </div>
                            <div class="vehicle-make">
                                <label for="">Vehicle Make</label>
                                <input type="text" name="vehicle_make" id="vehicle_make" class="form-control" />
                            </div>
                            <div class="vehicle-model">
                                <label for="">Vehicle Model</label>
                                <input type="text" name="vehicle_model" id="vehicle_model"
                                    class="form-control" />
                            </div>
                            <div class="vehicle-number">
                                <label for="">Vehicle Number</label>
                                <input type="text" name="vehicle_number" id="vehicle_number"
                                    class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="fetch-button-div">
                        <div class="fetch-enquiry-details fetch-button-common-style">
                            <span>Fetch Enquiry Details</span>
                        </div>
                        <div class="fetch-car-details fetch-button-common-style">
                            <span>Fetch Car Details</span>
                        </div>
                    </div>
                    <hr class="green-horizontal-line" />
                    <div class="cost-amount-div">
                        <div class="cost-amount-header-div">
                            <div class="cost-amount-header-description cost-amount-header-common-style">
                                Description
                            </div>
                            <div class="cost-amount-header-unit-cost cost-amount-header-common-style">
                                Unit Cost
                            </div>
                            <div class="cost-amount-header-amount cost-amount-header-common-style">
                                Amount
                            </div>
                            <div class="cost-amount-header-action cost-amount-header-common-style">
                                Action
                            </div>
                        </div>
                        <div class="cost-amount-main-div">
                            <div class="cost-amount-single-div">
                                <div class="description-value">Engines</div>
                                <div class="unit-cost">10</div>
                                <div class="amount">10</div>
                                <div class="action">
                                    <i class="fa-regular fa-trash-can"></i>
                                    <i class="fa-solid fa-pencil"></i>
                                </div>
                            </div>
                            <div class="cost-amount-single-div">
                                <div class="description-value">Exchange surcharge</div>
                                <div class="unit-cost">10</div>
                                <div class="amount">10</div>
                                <div class="action">
                                    <i class="fa-regular fa-trash-can"></i>
                                    <i class="fa-solid fa-pencil"></i>
                                </div>
                            </div>
                            <div class="cost-amount-single-div">
                                <div class="description-value">Delivery Charge</div>
                                <div class="unit-cost">10</div>
                                <div class="amount">10</div>
                                <div class="action">
                                    <i class="fa-regular fa-trash-can"></i>
                                    <i class="fa-solid fa-pencil"></i>
                                </div>
                            </div>
                            <div class="cost-amount-single-div">
                                <div class="description-value">Fitting</div>
                                <div class="unit-cost">10</div>
                                <div class="amount">10</div>
                                <div class="action">
                                    <i class="fa-regular fa-trash-can"></i>
                                    <i class="fa-solid fa-pencil"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-calculation-div">
                        <div class="main-calculation-content-div">
                            <div class="sub-total-div">
                                <span>SubTotal</span>
                                <strong> <span>40.00</span></strong>
                            </div>
                            <div class="vat-div">
                                <span>Vat</span> <strong><span>00.00</span></strong>
                            </div>
                            <hr class="green-horizontal-line .small" />
                            <div class="invoice-total-header">Invoice Total</div>
                        </div>
                    </div>
                    <div class="bank-info-with-cost-div">
                        <div class="bank-info">
                            <div class="bank-name-div">
                                <div class="bank-name-title bank-info-common-style">
                                    <span>Bank Name: </span> <span>Commercial Bank</span>
                                </div>
                            </div>
                            <div class="bank-account-name-div">
                                <div class="bank-account-name-title bank-info-common-style">
                                    <span>Bank Account Name: </span>
                                    <span>Ariful Islam Shanto</span>
                                </div>
                            </div>
                            <div class="bank-account-number-div">
                                <div class="bank-account-number-title bank-info-common-style">
                                    <span>Account Number: </span>
                                    <span class="account-number">435524472</span>
                                </div>
                            </div>
                        </div>
                        <div class="cost-amount-right">
                            <div class="invoice-total-amount">40.00</div>
                            <div class="paid-amount">
                                <span>Paid Amount</span>
                                <strong>10.00</strong>
                            </div>
                            <div class="account-payable">
                                <span>Account Payable</span>
                                <strong>30.00</strong>
                            </div>
                        </div>
                    </div>
                    <div class="message-invoice-div">
                        <label for="">Write your message</label>
                        <textarea class="form-control" id="invoice_message" name="invoice_message" rows="3"></textarea>
                    </div>
                    <div class="term-condition-div">
                        <label for="">Terms & Conditions</label>
                        <div contenteditable="true" id="invoice_term_condition">By placing an order with V6 AUTO
                            CENTRE, You confirm that You received, read, understood, and accepted the Terms and
                            Conditions in whole and You agree to be bound by the T&C set below.....</div>

                    </div>
                    <div class="generate-invoice-div">
                        <button class="btn">Generate Invoice</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="header-div">
    <div class="left-div">
        @if (Auth::guard('web')->check())
            @php
                $business_profile = Auth::guard('web')->user()->business_profile;
                $subscribed_till = $business_profile->subscribed_till;
            @endphp
        @else
            @php
                $business_profile = Auth::guard('businessUser')->user()->business->business_profile;
                $subscribed_till = $business_profile->subscribed_till;
            @endphp
        @endif
        @php

            use Carbon\Carbon;
            $s_t_t = Carbon::parse($subscribed_till)->getTimestampMs();
            $c_t_t = Carbon::now()->getTimestampMs();

        @endphp

        @if ($s_t_t > $c_t_t)
            <div class="create-own-quote header-common-style " style="cursor: pointer">
                <button class="btn btn-success light plus-btn">
                    <i class="fa-solid fa-plus"></i>
                </button>
                <span>Create your own quote</span>
            </div>
        @else
            <div class="header-common-style " style="pointer-events:none">
                <button class="btn btn-success light plus-btn">
                    <i class="fa-solid fa-plus"></i>
                </button>
                <span>Create your own quote</span>
            </div>
        @endif
        {{-- <div
              class="generate-customer-invoice header-common-style header-no-background"
            >
              <button class="btn btn-success light plus-btn">
                <i class="fa-solid fa-plus"></i>
              </button>
              <span>Generate Customer Invoice</span>
            </div> --}}
        @if (Auth::guard('web')->check())
            @php
                $business_profile = Auth::guard('web')->user()->business_profile;
                $name = $business_profile->quoting_person_name;
                $image = $business_profile->logo;

                // dd($image)

            @endphp

            <div class="my-account header-common-style header-no-background">
                <a href="{{ route('user.account.profile') }}" style="text-decoration:none;color:black"><img
                        style="height: 35px;width:35px"
                        src="{{ $image ? asset('image/user/companyLogo/' . $image) : asset('image/avatar.png') }}" />
                    <span>My Account</span></a>
            </div>
        @else
            @php
                $business_profile = Auth::guard('businessUser')->user()->business->business_profile;
                $name = Auth::guard('businessUser')->user()->user_name;
                $image = Auth::guard('businessUser')->user()->img;
            @endphp
            <div class="my-account header-common-style header-no-background">
                <a href="{{ route('user.account.profile') }}" style="text-decoration:none;color:black"><img
                        style="height: 35px;width:35px"
                        src="{{ $image ? asset('image/user/companyUser/' . $image) : asset('image/avatar.png') }}" />
                    <span>My Account</span></a>
            </div>
        @endif


    </div>
    <div class="right-div">
        <div class="greetings">
            <span>Hi, {{ $name }}</span>
        </div>
        <div class="since-days">
            <span class="since-days-span" style="font-weight:500">(0 days)</span>
        </div>
        <div class="time-div">13.12.13</div>
    </div>
</div>


<script>
    function submitAndGetFullInfo() {

        $.ajax({
            url: `/carFullInfo`,
            method: 'GET',
            dataType: 'json',
            data: {
                'reg_num': $('.reg_num').val()
            },
            success: data => {

                $('#loader').show();
                //   console.log(data.data.Response.DataItems.SmmtDetails.Series)
                var output = "";
                if (data.data.Response.StatusCode == "Success") {
                    output = `  <div class="car-info-inner" style="margin:20px 0px 0px 0px">
                                <div class="row gy-4">
                                    <div class="col-lg-6 col-12">
                                        <div style="color:darkgreen;"> Car Name </div>
                                        <input name="car_make" disabled class="mt-2 form-control car_make_quote" value="${data.data.Response.DataItems.VehicleRegistration.Make}" />
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div style="color:darkgreen;"> Car Model </div>
                                        <input name="car_model" disabled class="mt-2 form-control car_model_quote" value="${data.data.Response.DataItems.VehicleRegistration.Model}" />
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div style="color:darkgreen;"> Car Series </div>
                                        <input name="car_series" disabled class="mt-2 form-control car_series_quote" value="${data.data.Response.DataItems.SmmtDetails.Series}" />
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div style="color:darkgreen;"> Manu. Year </div>
                                        <input name="car_reg_year" disabled class="mt-2 form-control car_reg_year_quote" value="${data.data.Response.DataItems.VehicleRegistration.YearOfManufacture}" />
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div style="color:darkgreen;"> Engine Code </div>
                                        <input name="engine_code" disabled class="mt-2 form-control engine_code_quote" value="${data.data.Response.DataItems.TechnicalDetails.General.Engine.Code.CodeList[0].EngineCode}" />
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div style="color:darkgreen;"> Problem with Engine </div>
                                        <input name="problem_with_engine"  class="mt-2 form-control problem_with_engine_quote"  />
                                    </div>
                                    
                                </div>
                            </div>`;
                    $('#loader').hide();
                } else {
                    output = ` <div class="car-info-inner" style="margin:20px 0px 0px 0px">
                               <div class="text-danger text-center" style="text-weight:bold">
                                No Record Found
                                </div>
                            </div>`;

                    $('#loader').hide();
                }

                $('.car-info-div').html(output)


            },
            error: error => {

            }
        });




    }



    function chargeOnInputCustom(event) {


        if (event.target.name == "recovery") {
            if (event.target.value >= 50) {
                $('.recovery-error').css({
                    'display': 'none'
                });
            }
            // else {
            //     $('.recovery-error').css({
            //         'display': 'block'
            //     });
            // }
        }

        let engine_cost = $('.engine-cost_custom').val();
        let exchange_surcharge_cost = $('.exchange-surcharge-cost_custom').val();
        let delivery_cost = $('.delivery-cost_custom').val();
        let recovery_cost = $('.recovery-cost_custom').val();
        let fitting_cost = $('.fitting-cost_custom').val();
        let vat_cost = $('.vat-cost_custom').val();

        let total_price_before_vat = Number(engine_cost) + Number(exchange_surcharge_cost) + Number(
            delivery_cost) + Number(
            recovery_cost) + Number(fitting_cost);
        let total_price_after_vat = total_price_before_vat + (total_price_before_vat * Number(vat_cost)) / 100;
        $('.total_price').html(Number(total_price_after_vat.toFixed(2)));


    }

    function recoveryTBCCustom(e) {
        var businessPostCode = "<?php echo $businessPostCode; ?>";
        var clientPostCode = $("#post_code").val();

        if (e.target.checked) {
            $('#loader').show();


            geoLocationCoordinateCustom(businessPostCode);
            geoLocationCoordinateCustom(clientPostCode)

            //    console.lo


        } else {
            $('#loader').hide();
            $('.recovery-cost_custom').val(0);
            let engine_cost = $('.engine-cost_custom').val();
            let exchange_surcharge_cost = $('.exchange-surcharge-cost_custom').val();
            let delivery_cost = $('.delivery-cost_custom').val();
            let recovery_cost = $('.recovery-cost_custom').val();
            let fitting_cost = $('.fitting-cost_custom').val();
            let vat_cost = $('.vat-cost_custom').val();

            let total_price_before_vat = Number(engine_cost) + Number(exchange_surcharge_cost) + Number(
                delivery_cost) + Number(
                recovery_cost) + Number(fitting_cost);
            let total_price_after_vat = total_price_before_vat + (total_price_before_vat * Number(vat_cost)) / 100;
            $('.total_price').html(Number(total_price_after_vat.toFixed(2)));

        }
    }

    function vatTBCCustom(e) {

        let total_price_after_vat;
        if (e.target.checked) {
            $('.vat-cost_custom').val(20);
            let engine_cost = $('.engine-cost_custom').val();
            let exchange_surcharge_cost = $('.exchange-surcharge-cost_custom').val();
            let delivery_cost = $('.delivery-cost_custom').val();
            let recovery_cost = $('.recovery-cost_custom').val();
            let fitting_cost = $('.fitting-cost_custom').val();
            let vat_cost = $('.vat-cost_custom').val();

            let total_price_before_vat = Number(engine_cost) + Number(exchange_surcharge_cost) + Number(
                delivery_cost) + Number(
                recovery_cost) + Number(fitting_cost);
            total_price_after_vat = total_price_before_vat + (total_price_before_vat * Number(vat_cost)) / 100;
            $('.total_price').html(Number(total_price_after_vat.toFixed(2)));
        } else {
            $('.vat-cost_custom').val(0);
            let engine_cost = $('.engine-cost_custom').val();
            let exchange_surcharge_cost = $('.exchange-surcharge-cost_custom').val();
            let delivery_cost = $('.delivery-cost_custom').val();
            let recovery_cost = $('.recovery-cost_custom').val();
            let fitting_cost = $('.fitting-cost_custom').val();
            let vat_cost = $('.vat-cost_custom').val();

            let total_price_before_vat = Number(engine_cost) + Number(exchange_surcharge_cost) + Number(
                delivery_cost) + Number(
                recovery_cost) + Number(fitting_cost);
            total_price_after_vat = total_price_before_vat + (total_price_before_vat * Number(vat_cost)) / 100;
            $('.total_price').html(Number(total_price_after_vat.toFixed(2)));
        }

    }

    function geoLocationCoordinateCustom(postCode) {

        $.ajax({
            url: `/user/geoLocationCoordinate`,
            method: 'GET',
            dataType: 'json',
            data: {
                'postCode': postCode
            },
            success: data => {

                allCoordinates.push({
                    lat: data.data.result[0].geometry.location.lat,
                    lng: data.data.result[0].geometry.location.lng
                })

                if (allCoordinates.length === 2) {
                    geoLocationDistanceCustome(allCoordinates[0].lat, allCoordinates[0].lng, allCoordinates[
                            1].lat,
                        allCoordinates[1].lng)
                }


            },
            error: error => {
                console.log(error)
            }

        });
    }

    function geoLocationDistanceCustome(lat1, lng1, lat2, lng2) {

        $.ajax({
            url: `/user/geoLocationDistance`,
            method: 'GET',
            dataType: 'json',
            data: {
                'lat1': lat1,
                'lng1': lng1,
                'lat2': lat2,
                'lng2': lng2
            },
            success: data => {

                var distanceInMile = data.data.rows[0].elements[0].distance.value * 0.000621371

                if ((distanceInMile * 2) < 50) {
                    $('.recovery-cost_custom').val(50);
                } else {
                    $('.recovery-cost_custom').val((distanceInMile * 2).toFixed(2))
                }


                allCoordinates = []

                let engine_cost = $('.engine-cost_custom').val();
                let exchange_surcharge_cost = $('.exchange-surcharge-cost_custom').val();
                let delivery_cost = $('.delivery-cost_custom').val();
                let recovery_cost = $('.recovery-cost_custom').val();
                let fitting_cost = $('.fitting-cost_custom').val();
                let vat_cost = $('.vat-cost_custom').val();


                let total_price_before_vat = Number(engine_cost) + Number(exchange_surcharge_cost) + Number(
                    delivery_cost) + Number(
                    recovery_cost) + Number(fitting_cost);
                let total_price_after_vat = total_price_before_vat + (total_price_before_vat * Number(
                    vat_cost)) / 100;
                $('.total_price').html(Number(total_price_after_vat.toFixed(2)));
                $('#loader').hide();



            },
            error: error => {
                console.log(error)
            }

        });
    }


    function sendQuoteCustom() {


        // if (Number($('.recovery-cost_custom').val()) >= 50) {
        $('#loader').show();
        $('.send-quote-btn').html('Sending Quote...Please wait')
        let warranty = $('.warranty-value-select_custom').val();
        let condition = $('.condition-value-select_custom').val();
        let terms_condition = $('#terms_condition_custom').val();

        let mileage = $('.mileage-value-select_custom').val();

        let quoted_by = '<?php echo $id; ?>'
        let quoted_company_by = '<?php echo $userId; ?>'
        let other_note = $('#quote_notes_custom').val();
        let engines = Number($('.engine-cost_custom').val());
        let exchange_surcharge = Number($('.exchange-surcharge-cost_custom').val());
        let delivery_charges = Number($('.delivery-cost_custom').val());
        let recovery = Number($('.recovery-cost_custom').val());
        let fitting = Number($('.fitting-cost_custom').val());
        let vat = Number($('.vat-cost_custom').val());
        // invoice //
        let total_price = Number($('.total_price').html());


        $.ajax({
            url: `/user/quote-post-custom`,
            method: 'post',
            dataType: 'json',
            data: {
                car_make: $('.car_make_quote').val(),
                car_series: $('.car_series_quote').val(),
                car_model: $('.car_model_quote').val(),
                car_reg_year: $('.car_reg_year_quote').val(),
                engine_code: $('.engine_code_quote').val(),
                request_part: 'Engine',
                reg_num: $('.reg_num').val(),
                post_code: $("#post_code").val(),
                query_user_email: $('#enquiry_person_email_custom').val(),
                query_user_fullname: $('#enquiry_person_full_name_custom').val(),
                query_user_phone: $('#enquiry_person_number_custom').val(),
                problem_with_engine: $('.problem_with_engine_quote').val(),
                warranty: warranty,
                condition: condition,
                mileage: mileage,
                quoted_by: quoted_by,
                quoted_company_by: quoted_company_by,
                other_note: other_note,
                engines: engines,
                exchange_surcharge: exchange_surcharge,
                delivery_charges: delivery_charges,
                recovery: recovery,
                fitting: fitting,
                vat: vat,
                total_price: total_price,
                terms_condition: terms_condition

            },
            success: data => {


                $('#loader').hide();

                $("#customQuoteModal").modal("hide");
                window.location.reload();

            },
            error: error => {
                console.log(error)
            }

        });


        // } else {
        //     $('.recovery-error').css({
        //         'display': 'block'
        //     });
        // }


    }
</script>

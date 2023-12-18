<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/filter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chart.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/circle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/count.css') }}">
    <link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/headerModal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/common_enquiry.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/job.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/employee.css') }}">
    <link rel="stylesheet" href="{{ asset('css/carInfo.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/moderator/signedCompany.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    @yield('style')
    <style>
        .modal-content.quote-modal-content {
            width: 85% !important;
        }

        #loader {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.75) url("/image/loader.gif") no-repeat center center;
            z-index: 99999;
        }

        .update-quote-btn {
            display: none
        }
        .recovery-error{
            display: none
        }
    </style>
    <title>@yield('title')</title>
</head>

<body>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    {{-- <div class="modal fade" id="recoveryError" tabindex="-1" aria-labelledby="recoveryErrorLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Recovery Must be greater than or equal 50</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="modal fade" id="quoteModal" tabindex="-1" aria-labelledby="quoteModalLabel" aria-hidden="true">
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
                            <div class="ref-div">
                                <span>Ref # : <span class="ref_num"></span></span>
                            </div>
                            <div class="modal-title-div">
                                <span class="modal-title">Enter your quotation</span>
                            </div>
                            <div class="modal-top-right-div">
                                <span class="name-badge auto-generated-id"></span>
                            </div>
                        </div>
                        <form method="GET" action="{{ route('user.print') }}">
                            <div class="modal-content-main-div">
                                <div class="modal_content_info-div">
                                    <div class="name">
                                        <label for="">Full Name</label> <br />
                                        <input type="text" class="form-control info-input "
                                            placeholder="Enter your name here" id="enquiry_person_full_name"
                                            name="enquiry_person_full_name" disabled />
                                        <input type="hidden" class="form-control info-input " name="enquiry_id"
                                            id="enquiry_id" />
                                        <input type="hidden" class="form-control info-input " id="quote_id" />
                                    </div>
                                    <div class="phone">
                                        <label for="">Phone Number</label> <br />
                                        <input type="text" class="form-control info-input"
                                            placeholder="Enter your number here" id="enquiry_person_number"
                                            name="enquiry_person_number" disabled />
                                    </div>
                                    <div class="email">
                                        <label for="">Email</label><br />
                                        <input type="email" class="form-control info-input"
                                            placeholder="Enter email here" id="enquiry_person_email"
                                            name="enquiry_person_email" disabled />
                                    </div>
                                    <div class="address">
                                        <label for="">Address</label><br />
                                        <input type="text" class="form-control info-input"
                                            placeholder="Enter address here" id="enquiry_person_address"
                                            name="enquiry_person_address" disabled />
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
                                                    class="form-control charge-input engine-cost" value=0
                                                    onfocus="inputFocus(event)" oninput="chargeOnInput(event)" />
                                            </div>
                                        </div>
                                        <div class="single-type-charge">
                                            <div class="type">
                                                <span>Exchange Surcharge (Refundable)</span>
                                            </div>
                                            <div class="charge">
                                                <input type="text" name="exchange_surcharge"
                                                    class="form-control charge-input exchange-surcharge-cost" value=0
                                                    oninput="chargeOnInput(event)" onfocus="inputFocus(event)" />
                                            </div>
                                        </div>
                                        <div class="single-type-charge">
                                            <div class="type">
                                                <span>Delivery Charges</span>
                                            </div>
                                            <div class="charge">
                                                <input type="text" name="delivery_charges"
                                                    class="form-control charge-input delivery-cost" value=0
                                                    oninput="chargeOnInput(event)" onfocus="inputFocus(event)" />
                                            </div>
                                        </div>
                                        <div class="single-type-charge">
                                            <div class="type">
                                                <span>Recovery</span> &nbsp;
                                                <input type="checkbox" class="tbc-confirm"
                                                    onchange="recoveryTBC(event)" style="cursor:pointer" />
                                                <span class="tbc-text">TBC</span>
                                            </div>
                                            <div class="charge">
                                                <input type="text" name="recovery"
                                                    class="form-control charge-input recovery-cost" value=0
                                                    oninput="chargeOnInput(event)" onfocus="inputFocus(event)" />
                                            </div>
                                        </div>
                                        <div class="single-type-charge">
                                            <div class="type">
                                                <span>Fitting</span>
                                            </div>
                                            <div class="charge">
                                                <input type="text" name="fitting"
                                                    class="form-control charge-input fitting-cost" value=0
                                                    oninput="chargeOnInput(event)" onfocus="inputFocus(event)" />
                                            </div>
                                        </div>
                                        <div class="single-type-charge">
                                            <div class="type">
                                                <span>VAT</span> &nbsp; <input type="checkbox" class="vat-confirm"
                                                    onchange="vatTBC(event)" style="cursor:pointer" />
                                                <span class="tbc-text">TBC</span>
                                            </div>
                                            <div class="charge" style="display: flex;align-items:center">
                                                <input type="text" name="vat"
                                                    class="form-control charge-input vat-cost" value=0
                                                    oninput="chargeOnInput(event)" style="margin-right:10px; width:175px"
                                                    onfocus="inputFocus(event)" />
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
                                                {{-- <select class="form-select type-select-total-amount warranty-value-select"
                                                aria-label="Default select example">
                                                <option selected value="12 Months">12 Months</option>
                                                <option value="11 Months">11 Months</option>
                                                <option value="10 Months">10 Months</option>
                                                <option value="9 Months">9 Months</option>
                                            </select> --}}
                                                <input type="text" name="warranty"
                                                    class=" type-select-total-amount warranty-value-select">
                                            </div>
                                        </div>

                                        <div class="condition-div common-amount-type-div">
                                            <div class="condition-left-div">Condition</div>
                                            <div class="condition-select">
                                                {{-- <select class="form-select type-select-total-amount condition-value-select"
                                                aria-label="Default select example">
                                                <option selected value="Reconditioned">Reconditioned</option>
                                                <option value="New">New</option>

                                            </select> --}}
                                                <input type="text" name="condition"
                                                    class="type-select-total-amount condition-value-select">
                                            </div>
                                        </div>
                                        <div class="mileage-div common-amount-type-div">
                                            <div class="mileage-left-div">Mileage</div>
                                            <div class="mileage-select">
                                                {{-- <select class="form-select type-select-total-amount mileage-value-select"
                                                aria-label="Default select example">
                                                <option selected value="40 km">40 km</option>
                                                <option value="30 km">30 km</option>
                                                <option value="20 km">20 km</option>
                                                <option value="10 km">10 km</option>
                                            </select> --}}
                                                <input type="text" name="mileage"
                                                    class="type-select-total-amount mileage-value-select">
                                            </div>
                                        </div>
                                        <div class="total-number">
                                            <span>Total Amount:</span> <span class="total_price price-color">0</span>
                                        </div>
                                    </div>
                                    <div class="type-status-div">
                                        <div class="average-price common-price">
                                            <div class="color-div"></div>
                                            <i class="fa-solid fa-circle"></i>
                                            <span>Average Price</span>
                                        </div>
                                        <div class="higher-price common-price">
                                            <div class="color-div"></div>
                                            <i class="fa-solid fa-circle"></i>
                                            <span>Higher Price </span>
                                        </div>
                                        <div class="lower-price common-price">
                                            <div class="color-div"></div>
                                            <i class="fa-solid fa-circle"></i>
                                            <span>Lower Price</span>
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
                                    } else {
                                        $userId = Auth::guard('businessUser')->user()->user_id;
                                        $id = Auth::guard('businessUser')->user()->id;
                                        $business_profile = Auth::guard('businessUser')->user()->business->business_profile;
                                        $name = Auth::guard('businessUser')->user()->user_name;
                                        $subscribed_till = $business_profile->subscribed_till;
                                        $subscribed_at = $business_profile->subscribed_at;
                                    }

                                    $quoteCustomization = CompanyQuoteCustomization::where('user_id', $userId)->first();

                                @endphp

                                <div class="selling-point-div">
                                    <div class="selling-point-header">
                                        <span> Selling Point Title </span>
                                    </div>
                                    <div class="selling-point-title-div">
                                        <input class="form-control" type="text"
                                            value="{{ $quoteCustomization ? $quoteCustomization->selling_point_title : '' }}"
                                            name="selling_point_title" id="selling_point_title"
                                            placeholder="Enter Selling point title" />
                                    </div>
                                </div>
                                <div class="quotes-notes-div">
                                    <div class="quotes-notes-header">
                                        <span> Other Notes for the Quote </span>
                                    </div>
                                    <div class="quotes-notes-input-div">
                                        <textarea class="form-control" id="quote_notes" name="quote_notes" rows="4" placeholder="type notes here"></textarea>
                                    </div>
                                </div>
                                <div class="terms-condition-div">
                                    <div class="terms-condition-header">
                                        <span> Terms & Conditions </span>
                                    </div>
                                    <div class="terms-condition-input-div">
                                        <!-- <input class="form-control" type="text" name="selling_point_title" id="selling_point_title" placeholder="Enter Selling point title"> -->
                                        <textarea class="form-control" id="terms_condition" rows="4" placeholder="type terms & Conditions here"> {{ $quoteCustomization ? strip_tags($quoteCustomization->terms_condition_description) : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="recovery-error mt-2 text-danger" style="text-align: center">
                                     Recover amount must be greater than or equal 50
                                </div>
                                <div class="quotes-send-button-div">
                                    <div class="send-email common-btn-style" style="cursor: pointer">
                                        <span>Send Email</span>
                                    </div>
                                    <div class="send-sms common-btn-style" style="cursor: pointer">
                                        <span>Send SMS</span>
                                    </div>
                                    <div class="send-quotes common-btn-style" style="cursor: pointer">
                                        <span class="send-quote-btn" onclick="sendQuote()">Send Quote</span>
                                        <span class="update-quote-btn" onclick="recreateQuote()">Recreate Quote</span>
                                    </div>
                                </div>
                            </div>
                            <div class="print-div">
                                <button type="submit" class="print-content">
                                    <i class="fa-solid fa-print"></i>
                                    <span style="cursor: pointer">Print</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel"
        aria-hidden="true">
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
                            @php
                                if (Auth::guard('web')->check()) {
                                    $business_info = Auth::guard('web')->user()->business_profile;
                                    $business_email = Auth::guard('web')->user()->email;
                                } else {
                                    $business_info = Auth::guard('businessUser')->user()->business->business_profile;
                                    $business_email = Auth::guard('businessUser')->user()->business->email;
                                }
                                
                            @endphp
                            <div class="info-div">
                                <div class="name-logo-div">
                                    <div class="name">{{ $business_info->business_name }}</div>
                                    <div class="invoice-logo">
                                        <img src="{{ $business_info->logo ? asset('image/user/companylogo/' . $business_info->logo) : asset('image/logo.png') }}"
                                            alt="" />
                                    </div>
                                </div>
                                <div class="general-info">
                                    <div class="address">
                                        <span>Address: </span><span>{{ $business_info->address }}</span>
                                    </div>
                                    <div class="email">
                                        <span>Email: </span><span>{{ $business_email }}</span>
                                    </div>
                                    <div class="phone">
                                        <span>Phone number: </span><span>{{ $business_info->primary_phone }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr style="color: rgba(0, 0, 0, 0.2)" />
                        <div class="invoice-input-div">
                            <div class="invoice-input-left-div">
                                <div class="billed-to">
                                    <label for="">Billed to</label>
                                    <input type="text" name="billed_to" id="billed_to" disabled
                                        class="form-control" />
                                    <input type="hidden" name="quote_id" id="quote_id" class="form-control" />
                                </div>
                                <div class="Address">
                                    <label for="">Address</label>
                                    <textarea class="form-control" id="invoice-address" disabled rows="5"></textarea>
                                </div>
                                <div class="phone-number">
                                    <label for="">Phone number</label>
                                    <input type="text" name="phone_number" disabled id="phone_number"
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="invoice-input-right-div">
                                <div class="ref-no">
                                    <label for="">Referance no</label>
                                    <input type="text" name="invoice_referance_no" disabled
                                        id="invoice_referance_no" class="form-control" />
                                </div>
                                <div class="invoice-no">
                                    <label for="">Invoice no</label>
                                    <input type="text" name="invoice_no" id="invoice_no" disabled
                                        class="form-control" />
                                </div>
                                <div class="date">
                                    <label for="">Date</label>
                                    <input type="text" name="invoice_date" disabled id="invoice_date"
                                        class="form-control" />
                                </div>
                                <div class="vehicle-make">
                                    <label for="">Vehicle Make</label>
                                    <input type="text" name="vehicle_make" disabled id="vehicle_make"
                                        class="form-control" />
                                </div>
                                <div class="vehicle-model">
                                    <label for="">Vehicle Model</label>
                                    <input type="text" name="vehicle_model" disabled id="vehicle_model"
                                        class="form-control" />
                                </div>
                                <div class="vehicle-number">
                                    <label for="">Vehicle Number</label>
                                    <input type="text" name="vehicle_number" id="vehicle_number"
                                        class="form-control" />
                                </div>
                                <div class="vehicle-mileage">
                                    <label for="">Current Mileage</label>
                                    <input type="text" name="vehicle_mileage" disabled id="vehicle_mileage"
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

                            </div>
                        </div>
                        <div class="main-calculation-div">
                            <div class="main-calculation-content-div">
                                <div class="sub-total-div">
                                    <span>SubTotal</span>
                                    <strong> <span class="sub-total"></span></strong>
                                </div>
                                <div class="vat-div">
                                    <span>Vat</span> <strong><span class="vat-cost-sub"></span></strong>
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
                                <div class="invoice-total-amount"></div>
                                <div class="paid-amount">
                                    <span>Paid Amount</span>
                                    <strong>0</strong>
                                </div>
                                <div class="account-payable">
                                    <span>Account Payable</span>
                                    <strong class="payable-amount"></strong>
                                </div>
                            </div>
                        </div>
                        <div class="message-invoice-div">
                            <label for="">Write your message</label>
                            <textarea class="form-control" id="invoice_message" name="invoice_message" rows="3"></textarea>
                        </div>
                        <div class="term-condition-div">
                            <label for="">Terms & Conditions</label>

                            <textarea class="form-control" id="terms_condition" rows="4" placeholder="type terms & Conditions here"> {{ $quoteCustomization ? $quoteCustomization->terms_condition_description : '' }}</textarea>
                            <div class="generate-invoice-div">
                                <button class="btn invoice-btn" onclick="generateInvoice()">Generate Invoice</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    {{-- for just showing invoice --}}
    <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel"
        aria-hidden="true">
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
                            @php
                                if (Auth::guard('web')->check()) {
                                    $business_info = Auth::guard('web')->user()->business_profile;
                                    $business_email = Auth::guard('web')->user()->email;
                                } else {
                                    $business_info = Auth::guard('businessUser')->user()->business->business_profile;
                                    $business_email = Auth::guard('businessUser')->user()->business->email;
                                }

                            @endphp
                            <div class="info-div">
                                <div class="name-logo-div">
                                    <div class="name">{{ $business_info->business_name }}</div>
                                    <div class="invoice-logo">
                                        {{-- <img src="{{ $business_info->logo ? asset('image/user/companylogo/' . $business_info->logo) : asset('image/logo.png') }}"
                                            alt="" /> --}}
                                        <img src="{{ asset('image/login_logo.svg') }}" alt="" />
                                    </div>
                                </div>
                                <div class="general-info">
                                    <div class="address">
                                        <span>Address: </span><span>{{ $business_info->address }}</span>
                                    </div>
                                    <div class="email">
                                        <span>Email: </span><span>{{ $business_email }}</span>
                                    </div>
                                    <div class="phone">
                                        <span>Phone number: </span><span>{{ $business_info->primary_phone }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr style="color: rgba(0, 0, 0, 0.2)" />
                        <div class="invoice-input-div">
                            <div class="invoice-input-left-div">
                                <div class="billed-to">
                                    <label for="">Billed to</label>
                                    <input type="text" name="billed_to" id="billed_to" disabled
                                        class="form-control" />
                                    {{-- <input type="hidden" name="quote_id" id="quote_id" class="form-control" /> --}}
                                </div>
                                <div class="Address">
                                    <label for="">Address</label>
                                    <textarea class="form-control" id="invoice-address" disabled rows="5"></textarea>
                                </div>
                                <div class="phone-number">
                                    <label for="">Phone number</label>
                                    <input type="text" name="phone_number" disabled id="phone_number"
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="invoice-input-right-div">
                                <div class="ref-no">
                                    <label for="">Referance no</label>
                                    <input type="text" name="invoice_referance_no" disabled
                                        id="invoice_referance_no" class="form-control" />
                                </div>
                                <div class="invoice-no">
                                    <label for="">Invoice no</label>
                                    <input type="text" name="invoice_no" id="invoice_no" disabled
                                        class="form-control" />
                                </div>
                                <div class="date">
                                    <label for="">Date</label>
                                    <input type="text" name="invoice_date" disabled id="invoice_date"
                                        class="form-control" />
                                </div>
                                <div class="vehicle-make">
                                    <label for="">Vehicle Make</label>
                                    <input type="text" name="vehicle_make" disabled id="vehicle_make"
                                        class="form-control" />
                                </div>
                                <div class="vehicle-model">
                                    <label for="">Vehicle Model</label>
                                    <input type="text" name="vehicle_model" disabled id="vehicle_model"
                                        class="form-control" />
                                </div>
                                {{-- <div class="vehicle-number">
                                    <label for="">Vehicle Number</label>
                                    <input type="text" name="vehicle_number" id="vehicle_number"
                                        class="form-control" />
                                </div> --}}
                                <div class="vehicle-mileage">
                                    <label for="">Current Mileage</label>
                                    <input type="text" name="vehicle_mileage" disabled id="vehicle_mileage"
                                        class="form-control" />
                                </div>
                            </div>
                        </div>
                        {{-- <div class="fetch-button-div">
                            <div class="fetch-enquiry-details fetch-button-common-style">
                                <span>Fetch Enquiry Details</span>
                            </div>
                            <div class="fetch-car-details fetch-button-common-style">
                                <span>Fetch Car Details</span>
                            </div>
                        </div> --}}
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
                                {{-- <div class="cost-amount-header-action cost-amount-header-common-style">
                                    Action
                                </div> --}}
                            </div>
                            <div class="cost-amount-main-div">

                            </div>
                        </div>
                        <div class="main-calculation-div">
                            <div class="main-calculation-content-div">
                                <div class="sub-total-div">
                                    <span>SubTotal</span>
                                    <strong> <span class="sub-total"></span></strong>
                                </div>
                                <div class="vat-div">
                                    <span>Vat</span> <strong><span class="vat-cost-sub"></span></strong>
                                </div>
                                <hr class="green-horizontal-line .small" />
                                <div class="invoice-total-header">Invoice Total</div>
                            </div>
                        </div>
                        <div class="bank-info-with-cost-div">
                            <div class="bank-info">
                                {{-- <div class="bank-name-div">
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
                                </div> --}}
                            </div>
                            <div class="cost-amount-right">
                                <div class="invoice-total-amount"></div>
                                <div class="paid-amount">
                                    <span>Paid Amount</span>
                                    <strong>0</strong>
                                </div>
                                <div class="account-payable">
                                    <span>Account Payable</span>
                                    <strong class="payable-amount"></strong>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="message-invoice-div">
                            <label for="">Write your message</label>
                            <textarea class="form-control" id="invoice_message" name="invoice_message" rows="3"></textarea>
                        </div>
                        <div class="term-condition-div">
                            <label for="">Terms & Conditions</label>

                            <textarea class="form-control" id="terms_condition" rows="4" placeholder="type terms & Conditions here"> {{ $quoteCustomization ? $quoteCustomization->terms_condition_description : '' }}</textarea>
                            <div class="generate-invoice-div">
                                <button class="btn invoice-btn" onclick="generateInvoice()">Generate Invoice</button>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="main_content">
        @include('partials.user.sidebar')
        <div class="content">
            @include('partials.user.header')
            <div id='loader'>
                {{-- <img src="{{ asset('image/loader.gif') }}" alt=""> --}}
            </div>
            @yield('data_layout')
        </div>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.plot.ly/plotly-2.24.1.min.js"></script>
    <script src="{{ asset('js/user/barChart.js') }}"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
    <script src="{{ asset('js/action.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(function() {

            $('input[name="daterange"]').daterangepicker({
                autoUpdateInput: false,
                opens: 'right',
                // locale: {
                //     cancelLabel: 'Clear'
                // }
            }, function(start, end, label) {
                $('.dateRange').val(`${start.format('YY-MM-DD')} - ${end.format('YY-MM-DD')}`)
                $('#datePickerStartTime').val(start.format('YYYY-MM-DD'))
                $('#datePickerEndTime').val(end.format('YYYY-MM-DD'))
                if (window.location.pathname.includes('/user/enquiry') || window.location.pathname.includes(
                        '/user/quotes') || window.location.pathname.includes('/user/hidden')) {
                    getData(0, start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
                }

                if (window.location.pathname == '/user/job') {
                    getJobData(0, start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'), $('#status_val')
                        .val())
                }

                // console.log(start.format('YYYY-MM-DD'))
            });
        });
    </script>
    <script>
        function changeStausValue() {
            let status = $('#status_val').val();
            let startTime = $('#datePickerStartTime').val();
            let endTime = $('#datePickerEndTime').val();
            getJobData(0, startTime, endTime, $('#status_val').val())

        }
    </script>
    <script>
        function deleteAllQuery() {
            $(".enquiry_checkbox:checkbox").prop("checked", true);
            var val = [];
            $('input[type=checkbox]:checked').each(function(i) {
                val[i] = $(this).val();
            });
            $.ajax({
                url: `/user/delete-enquery`,
                method: 'GET',
                dataType: 'json',
                data: {
                    'id': val,

                },
                success: data => {
                    if (data.success) {
                        toastr.success(data.msg);
                        window.location.reload();
                    }


                },
                error: error => {
                    console.log(error)
                }

            });
        }

        function deleteSelectedQuery() {
            var val = [];
            $('input[type=checkbox]:checked').each(function(i) {
                val[i] = $(this).val();
            });

            $.ajax({
                url: `/user/delete-enquery`,
                method: 'GET',
                dataType: 'json',
                data: {
                    'id': val,

                },
                success: data => {
                    if (data.success) {

                        window.location.reload();
                        toastr.success(data.msg);
                    }


                },
                error: error => {
                    console.log(error)
                }

            });
        }

        function deleteAllQuotes() {
            $(".quote_checkbox:checkbox").prop("checked", true);
            var val = [];
            $('input[type=checkbox]:checked').each(function(i) {
                val[i] = $(this).val();
            });
            $.ajax({
                url: `/user/delete-quote`,
                method: 'GET',
                dataType: 'json',
                data: {
                    'id': val,

                },
                success: data => {
                    if (data.success) {

                        window.location.reload();
                        toastr.success(data.msg);
                    }


                },
                error: error => {
                    console.log(error)
                }

            });
        }

        function deleteSelectedQuotes() {
            var val = [];
            $('input[type=checkbox]:checked').each(function(i) {
                val[i] = $(this).val();
            });
            $.ajax({
                url: `/user/delete-quote`,
                method: 'GET',
                dataType: 'json',
                data: {
                    'id': val,

                },
                success: data => {
                    if (data.success) {

                        window.location.reload();
                        toastr.success(data.msg);
                    }


                },
                error: error => {
                    console.log(error)
                }

            });
        }

        function deleteAllHidden() {
            $(".hidden_checkbox:checkbox").prop("checked", true);
            var val = [];
            $('input[type=checkbox]:checked').each(function(i) {
                val[i] = $(this).val();
            });
            $.ajax({
                url: `/user/delete-quote`,
                method: 'GET',
                dataType: 'json',
                data: {
                    'id': val,

                },
                success: data => {
                    if (data.success) {

                        window.location.reload();
                        toastr.success(data.msg);
                    }


                },
                error: error => {
                    console.log(error)
                }

            });
        }

        function deleteSelectedHidden() {
            var val = [];
            $('input[type=checkbox]:checked').each(function(i) {
                val[i] = $(this).val();
            });
            $.ajax({
                url: `/user/delete-quote`,
                method: 'GET',
                dataType: 'json',
                data: {
                    'id': val,

                },
                success: data => {
                    if (data.success) {

                        window.location.reload();
                        toastr.success(data.msg);
                    }


                },
                error: error => {
                    console.log(error)
                }

            });
        }
    </script>

    @yield('script')

    @if (Session::has('success'))
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
            toastr.success("{{ Session::get('success') }}");
        </script>
        @php
            Session::forget('success');
        @endphp
    @endif


    @if (Session::has('info'))
        <script>
            toastr.info("{{ Session::get('info') }}");
        </script>
        @php
            Session::forget('info');
        @endphp
    @endif


    @if (Session::has('warning'))
        <script>
            toastr.warning("{{ Session::get('warning') }}");
        </script>
        @php
            Session::forget('warning');
        @endphp
    @endif


    @if (Session::has('error'))
        <script>
            toastr.error("{{ Session::get('error') }}");
        </script>
        @php
            Session::forget('error');
        @endphp
    @endif

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function openQuoteModal(id) {
            $.ajax({
                url: `/user/single-enquiry`,
                method: 'GET',
                dataType: 'json',
                data: {
                    'id': id,

                },
                success: data => {
                    console.log(data)
                    $('#enquiry_person_full_name').val(data.data.query_user_fullname)
                    $('#enquiry_person_number').val(data.data.query_user_phone)
                    $('#enquiry_person_email').val(data.data.query_user_email)
                    $('#enquiry_person_address').val(data.data.address)
                    $('#enquiry_id').val(data.data.id)
                    $('.ref_num').html(data.data.ref_no)
                    $('.auto-generated-id').html(data.data.reg_num)

                    //for invoice//
                    $('#billed_to').val(data.data.query_user_fullname)
                    $('#phone_number').val(data.data.query_user_phone)
                    $('#invoice-address').val(data.data.address)
                    $('#invoice_referance_no').val(data.data.ref_no)
                    $('#vehicle_make').val(data.data.car_make)
                    $('#vehicle_model').val(data.data.car_model)






                },
                error: error => {
                    console.log(error)
                }

            });

            $('#quoteModal').modal('show')



        }

        function chargeOnInput(event) {
            if(event.target.name=="recovery"){
                if(event.target.value>=50){
                    $('.recovery-error').css({'display':'none'});
                }
            }
            let query_id = $('#enquiry_id').val();
            // let engine_cost = $('.engine-cost').val();
            // let exchange_surcharge_cost = $('.exchange-surcharge-cost').val();
            // let delivery_cost = $('.delivery-cost').val();
            // let recovery_cost = $('.recovery-cost').val();
            // let fitting_cost = $('.fitting-cost').val();
            // let vat_cost = $('.vat-cost').val();

            // let total_price = Number(engine_cost) + Number(exchange_surcharge_cost) + Number(delivery_cost) + Number(
            //     recovery_cost) + Number(fitting_cost) + Number(vat_cost);
            // $('.total_price').html(total_price.toFixed(2));

            let engine_cost = $('.engine-cost').val();
            let exchange_surcharge_cost = $('.exchange-surcharge-cost').val();
            let delivery_cost = $('.delivery-cost').val();
            let recovery_cost = $('.recovery-cost').val();
            let fitting_cost = $('.fitting-cost').val();
            let vat_cost = $('.vat-cost').val();

            let total_price_before_vat = Number(engine_cost) + Number(exchange_surcharge_cost) + Number(
                delivery_cost) + Number(
                recovery_cost) + Number(fitting_cost);
            let total_price_after_vat = total_price_before_vat + (total_price_before_vat * Number(vat_cost)) / 100;
            $('.total_price').html(Number(total_price_after_vat.toFixed(2)));
            $.ajax({
                url: `/user/get-quote-price`,
                method: 'GET',
                dataType: 'json',
                data: {
                    'enquiry_id': Number(query_id),

                },
                success: data => {
                    console.log(data);
                    if (data.data.length <= 0) {
                        $('.price-color').css("color", "#60BC71");
                    } else {
                        let price = 0;
                        for (let i = 0; i < data.data.length; i++) {
                            let cost = Number(data.data[i].invoice.total_price);
                            price += cost;

                        }
                        let avg_price = price / data.data.length;
                        if (total_price_after_vat > avg_price + 10) {
                            $('.price-color').css("color", "#FFC700");

                        } else if (total_price_after_vat < avg_price - 10) {
                            $('.price-color').css("color", "#FF4444");

                        } else {
                            $('.price-color').css("color", "#60BC71");

                        }
                    }



                },
                error: error => {
                    console.log(error)
                }

            });

        }

        function sendQuote() {
            if (Number($('.recovery-cost').val()) >= 50) {
                $('#loader').show();
                $('.send-quote-btn').html('Sending Quote...Please wait')
                let enquiry_id = Number($('#enquiry_id').val());
                let warranty = $('.warranty-value-select').val();
                let condition = $('.condition-value-select').val();
                let selling_point_title = $('#selling_point_title').val();
                let terms_condition = $('#terms_condition').val();

                let mileage = $('.mileage-value-select').val();

                let quoted_by = '<?php echo $id; ?>'
                let quoted_company_by = '<?php echo $userId; ?>'
                let other_note = $('#quote_notes').val();
                let engines = Number($('.engine-cost').val());
                let exchange_surcharge = Number($('.exchange-surcharge-cost').val());
                let delivery_charges = Number($('.delivery-cost').val());
                let recovery = Number($('.recovery-cost').val());
                let fitting = Number($('.fitting-cost').val());
                let vat = Number($('.vat-cost').val());
                // invoice //
                let total_price = Number($('.total_price').html());


                $.ajax({
                    url: `/user/quote-post`,
                    method: 'post',
                    dataType: 'json',
                    data: {
                        enquiry_id: enquiry_id,
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
                        selling_point_title: selling_point_title,
                        terms_condition: terms_condition

                    },
                    success: data => {

                        // console.log(data);
                        // $('#quote_id').val(data.quote.id);
                        // $('#invoice_no').val(data.invoice.generated_invoice_no);
                        // $('#vehicle_mileage').val(data.quote.mileage)

                        // var inputDateString = data.invoice.created_at;

                        // // Parse the input date string into a JavaScript Date object
                        // var date = new Date(inputDateString);

                        // // Get the day, month, and year components
                        // var day = String(date.getDate()).padStart(2, '0');
                        // var month = String(date.getMonth() + 1).padStart(2, '0'); // Month is zero-based
                        // var year = String(date.getFullYear()).slice(-2); // Get the last two digits of the year

                        // // Create the formatted date string in the "DD/MM/YY" format
                        // var formattedDate = day + '/' + month + '/' + year;

                        // $('#invoice_date').val(formattedDate);
                        // $("#quoteModal").modal("hide");
                        // $("#invoiceModal").modal("show");

                        // let price_arr = [];

                        // let engines_price = Number(data.quote.engines)
                        // let exchange_surcharge_price = Number(data.quote.exchange_surcharge)
                        // let delivery_charges_price = Number(data.quote.delivery_charges)
                        // let recovery_price = Number(data.quote.recovery)
                        // let fitting_price = Number(data.quote.fitting)
                        // let vat_price = Number(data.quote.vat)

                        // if (engines_price != 0) {
                        //     price_arr.push({
                        //         'name': 'Engines',
                        //         'cost': engines_price
                        //     })
                        // }
                        // if (exchange_surcharge_price != 0) {
                        //     price_arr.push({
                        //         'name': 'Exchange Surcharge',
                        //         'cost': exchange_surcharge_price
                        //     })
                        // }
                        // if (delivery_charges_price != 0) {
                        //     price_arr.push({
                        //         'name': 'Delivery',
                        //         'cost': delivery_charges_price
                        //     })
                        // }
                        // if (recovery_price != 0) {
                        //     price_arr.push({
                        //         'name': 'Recovery',
                        //         'cost': recovery_price
                        //     })
                        // }
                        // if (fitting_price != 0) {
                        //     price_arr.push({
                        //         'name': 'Fitting',
                        //         'cost': fitting_price
                        //     })
                        // }
                        // if (vat_price != 0) {
                        //     price_arr.push({
                        //         'name': 'Vat',
                        //         'cost': vat_price
                        //     })
                        // }

                        // console.log(price_arr)

                        // $('.vat-cost-sub').html(vat_price);
                        // let sub_total_without_vat = 0;
                        // for (let j = 0; j < price_arr.length; j++) {
                        //     if (price_arr[j].name != 'Vat') {
                        //         let data = `<div class="cost-amount-single-div">
                    //                 <div class="description-value">${price_arr[j].name}</div>
                    //                 <div class="unit-cost">${price_arr[j].cost}</div>
                    //                 <div class="amount">${price_arr[j].cost}</div>
                    //                 <div class="action">
                    //                     <i class="fa-regular fa-trash-can"></i>
                    //                     <i class="fa-solid fa-pencil"></i>
                    //                 </div>
                    //             </div>`;

                        //         $('.cost-amount-main-div').append(data);
                        //         sub_total_without_vat += price_arr[j].cost;
                        //     }

                        // }

                        // $('.sub-total').html(sub_total_without_vat);
                        // $('.invoice-total-amount').html(Number(sub_total_without_vat) + Number(vat_price))
                        // $('.payable-amount').html(Number(sub_total_without_vat) + Number(vat_price))
                        $('#loader').hide();
                        $("#quoteModal").modal("hide");
                        window.location.reload();

                    },
                    error: error => {
                        console.log(error)
                    }

                });


            } else {
                $('.recovery-error').css({'display':'block'});
            }


        }

        // function print() {

        //     let enquiry_id = Number($('#enquiry_id').val());
        //     let warranty = $('.warranty-value-select').val();
        //     let condition = $('.condition-value-select').val();
        //     let mileage = $('.mileage-value-select').val();
        //     let other_note = $('#quote_notes').val();
        //     let engines = Number($('.engine-cost').val());
        //     let exchange_surcharge = Number($('.exchange-surcharge-cost').val());
        //     let delivery_charges = Number($('.delivery-cost').val());
        //     let recovery = Number($('.recovery-cost').val());
        //     let fitting = Number($('.fitting-cost').val());
        //     let vat = Number($('.vat-cost').val());
        //     // invoice //
        //     let total_price = Number($('.total_price').html());
        //     $.ajax({
        //         url: `/user/print`,
        //         method: 'get',
        //         dataType: 'json',
        //         data: {
        //             enquiry_id: enquiry_id,
        //             warranty: warranty,
        //             condition: condition,
        //             mileage: mileage,
        //             other_note: other_note,
        //             engines: engines,
        //             exchange_surcharge: exchange_surcharge,
        //             delivery_charges: delivery_charges,
        //             recovery: recovery,
        //             fitting: fitting,
        //             vat: vat,
        //             total_price: total_price

        //         },
        //         success: data => {

        //            console.log(data)
        //             var newWindow = window.open();
        //             newWindow.document.write(data);

        //         },
        //         error: error => {
        //             console.log(error)
        //         }

        //     });


        // }

        function recreateQuote() {
            if (Number($('.recovery-cost').val()) >= 50) {
                $('#loader').show();
                $('.update-quote-btn').html('Sending Quote...Please wait')
            let enquiry_id = Number($('#enquiry_id').val());
            let quote_id = Number($('#quote_id').val());
            let warranty = $('.warranty-value-select').val();
            let condition = $('.condition-value-select').val();
            let mileage = $('.mileage-value-select').val();
            let selling_point_title = $('#selling_point_title').val();
            let terms_condition = $('#terms_condition').val();
            let quoted_by = '<?php echo $id; ?>'
            let quoted_company_by = '<?php echo $userId; ?>'
            let other_note = $('#quote_notes').val();
            let engines = Number($('.engine-cost').val());
            let exchange_surcharge = Number($('.exchange-surcharge-cost').val());
            let delivery_charges = Number($('.delivery-cost').val());
            let recovery = Number($('.recovery-cost').val());
            let fitting = Number($('.fitting-cost').val());
            let vat = Number($('.vat-cost').val());
            // invoice //
            let total_price = Number($('.total_price').html());


            $.ajax({
                url: `/user/quote-recreate`,
                method: 'post',
                dataType: 'json',
                data: {
                    enquiry_id: enquiry_id,
                    quote_id: quote_id,
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
                    selling_point_title: selling_point_title,
                    terms_condition: terms_condition

                },
                success: data => {

                    // console.log(data);
                    // $('#quote_id').val(data.quote.id);
                    // $('#invoice_no').val(data.invoice.generated_invoice_no);
                    // $('#vehicle_mileage').val(data.quote.mileage)

                    // var inputDateString = data.invoice.created_at;

                    // // Parse the input date string into a JavaScript Date object
                    // var date = new Date(inputDateString);

                    // // Get the day, month, and year components
                    // var day = String(date.getDate()).padStart(2, '0');
                    // var month = String(date.getMonth() + 1).padStart(2, '0'); // Month is zero-based
                    // var year = String(date.getFullYear()).slice(-2); // Get the last two digits of the year

                    // // Create the formatted date string in the "DD/MM/YY" format
                    // var formattedDate = day + '/' + month + '/' + year;

                    // $('#invoice_date').val(formattedDate);
                    // $("#quoteModal").modal("hide");
                    // $("#invoiceModal").modal("show");

                    // let price_arr = [];

                    // let engines_price = Number(data.quote.engines)
                    // let exchange_surcharge_price = Number(data.quote.exchange_surcharge)
                    // let delivery_charges_price = Number(data.quote.delivery_charges)
                    // let recovery_price = Number(data.quote.recovery)
                    // let fitting_price = Number(data.quote.fitting)
                    // let vat_price = Number(data.quote.vat)

                    // if (engines_price != 0) {
                    //     price_arr.push({
                    //         'name': 'Engines',
                    //         'cost': engines_price
                    //     })
                    // }
                    // if (exchange_surcharge_price != 0) {
                    //     price_arr.push({
                    //         'name': 'Exchange Surcharge',
                    //         'cost': exchange_surcharge_price
                    //     })
                    // }
                    // if (delivery_charges_price != 0) {
                    //     price_arr.push({
                    //         'name': 'Delivery',
                    //         'cost': delivery_charges_price
                    //     })
                    // }
                    // if (recovery_price != 0) {
                    //     price_arr.push({
                    //         'name': 'Recovery',
                    //         'cost': recovery_price
                    //     })
                    // }
                    // if (fitting_price != 0) {
                    //     price_arr.push({
                    //         'name': 'Fitting',
                    //         'cost': fitting_price
                    //     })
                    // }
                    // if (vat_price != 0) {
                    //     price_arr.push({
                    //         'name': 'Vat',
                    //         'cost': vat_price
                    //     })
                    // }

                    // console.log(price_arr)

                    // $('.vat-cost-sub').html(vat_price);
                    // let sub_total_without_vat = 0;
                    // for (let j = 0; j < price_arr.length; j++) {
                    //     if (price_arr[j].name != 'Vat') {
                    //         let data = `<div class="cost-amount-single-div">
                //                 <div class="description-value">${price_arr[j].name}</div>
                //                 <div class="unit-cost">${price_arr[j].cost}</div>
                //                 <div class="amount">${price_arr[j].cost}</div>
                //                 <div class="action">
                //                     <i class="fa-regular fa-trash-can"></i>
                //                     <i class="fa-solid fa-pencil"></i>
                //                 </div>
                //             </div>`;

                    //         $('.cost-amount-main-div').append(data);
                    //         sub_total_without_vat += price_arr[j].cost;
                    //     }

                    // }

                    // $('.sub-total').html(sub_total_without_vat);
                    // $('.invoice-total-amount').html(Number(sub_total_without_vat) + Number(vat_price))
                    // $('.payable-amount').html(Number(sub_total_without_vat) + Number(vat_price))
                    $('#loader').hide();
                    $("#quoteModal").modal("hide");
                    window.location.reload();

                },
                error: error => {
                    console.log(error)
                }

            });

            }else{
                $('.recovery-error').css({'display':'block'});
            }
            

        }

        function generateInvoice() {
            //invoice-price-may-change
            $('.invoice-btn').html("Generating...Please Wait")
            $.ajax({
                url: `/user/updateQuoteWithEmail`,
                method: 'post',
                dataType: 'json',
                data: {
                    'quote_id': Number($('#quote_id').val()),
                    'vn': $('#vehicle_number').val(),
                    'message': $('#invoice_message').val()

                },
                success: data => {

                    $("#invoiceModal").modal("hide");
                    window.location.reload();

                },
                error: error => {
                    console.log(error)
                }

            });
        }
    </script>
    <script>
        window.onload = function() {


            chart();


            updateCountdown();

            setInterval(updateCountdown, 1000);




        };
        //countdown function
        function updateCountdown() {
            let subscribed_till = "<?= $subscribed_till ?>"

            let targetDate = new Date(subscribed_till).getTime();

            let currentDateBD = new Date().toLocaleString('en-US', {
                timeZone: 'Asia/Dhaka'
            });

            // Convert the current date string to a Date object
            let currentDate = new Date(currentDateBD).getTime();


            const timeDifference = targetDate - currentDate;

            if (timeDifference > 0) {

                const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);
                console.log(days)
                $('.since-days-span').html(`(${days} days)`);
                $('.time-div').html(hours + "." + minutes + "." + seconds);

            } else {
                $('.since-days-span').html(`(0 days)`);
                $('.time-div').html(`0.0.0`);
            }
        }

        function chart() {
            $.ajax({
                url: `/user/bar-chart-data`,
                method: 'get',
                dataType: 'json',
                success: data => {
                    console.log(data)
                    var trace1 = {
                        x: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                            'Dec'
                        ],
                        y: data.allQuoteVal,
                        width: [0.2, 0.2, 0.2, 0.2, 0.2, 0.2, 0.2, 0.2, 0.2, 0.2, 0.2, 0.2],
                        type: 'bar',
                        name: 'Quote Value',
                        marker: {
                            color: 'rgb(2,160,252)',
                            opacity: 1,
                        }
                    };

                    var trace2 = {
                        x: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                            'Dec'
                        ],
                        y: data.allJobVal,
                        width: [0.2, 0.2, 0.2, 0.2, 0.2, 0.2, 0.2, 0.2, 0.2, 0.2, 0.2, 0.2],
                        type: 'bar',
                        name: 'Job Value',
                        marker: {
                            color: 'rgb(0,128,0)',
                            opacity: 0.5,
                        }
                    };

                    var data = [trace1, trace2];

                    var layout = {

                        xaxis: {
                            tickfont: {
                                size: 14,
                                color: 'rgb(107, 107, 107)'
                            }
                        },
                        yaxis: {

                            titlefont: {
                                size: 16,
                                color: 'rgb(107, 107, 107)'
                            },
                            tickfont: {
                                size: 14,
                                color: 'rgb(107, 107, 107)'
                            }
                        },

                        // barmode: 'group',
                        // bargap: 0.15,
                        // bargroupgap: 0.1
                    };


                    Plotly.newPlot('myDiv', data, layout);

                },
                error: error => {
                    console.log(error)
                }

            });

        }

        function vatTBC(e) {
            let query_id = $('#enquiry_id').val();
            let total_price_after_vat;
            if (e.target.checked) {
                $('.vat-cost').val(20);
                let engine_cost = $('.engine-cost').val();
                let exchange_surcharge_cost = $('.exchange-surcharge-cost').val();
                let delivery_cost = $('.delivery-cost').val();
                let recovery_cost = $('.recovery-cost').val();
                let fitting_cost = $('.fitting-cost').val();
                let vat_cost = $('.vat-cost').val();

                let total_price_before_vat = Number(engine_cost) + Number(exchange_surcharge_cost) + Number(
                    delivery_cost) + Number(
                    recovery_cost) + Number(fitting_cost);
                total_price_after_vat = total_price_before_vat + (total_price_before_vat * Number(vat_cost)) / 100;
                $('.total_price').html(Number(total_price_after_vat.toFixed(2)));
            } else {
                $('.vat-cost').val(0);
                let engine_cost = $('.engine-cost').val();
                let exchange_surcharge_cost = $('.exchange-surcharge-cost').val();
                let delivery_cost = $('.delivery-cost').val();
                let recovery_cost = $('.recovery-cost').val();
                let fitting_cost = $('.fitting-cost').val();
                let vat_cost = $('.vat-cost').val();

                let total_price_before_vat = Number(engine_cost) + Number(exchange_surcharge_cost) + Number(
                    delivery_cost) + Number(
                    recovery_cost) + Number(fitting_cost);
                total_price_after_vat = total_price_before_vat + (total_price_before_vat * Number(vat_cost)) / 100;
                $('.total_price').html(Number(total_price_after_vat.toFixed(2)));
            }

            $.ajax({
                url: `/user/get-quote-price`,
                method: 'GET',
                dataType: 'json',
                data: {
                    'enquiry_id': Number(query_id),

                },
                success: data => {
                    console.log(data);
                    if (data.data.length <= 0) {
                        $('.price-color').css("color", "#60BC71");
                    } else {
                        let price = 0;
                        for (let i = 0; i < data.data.length; i++) {
                            let cost = Number(data.data[i].invoice.total_price);
                            price += cost;

                        }
                        let avg_price = price / data.data.length;
                        if (total_price_after_vat > avg_price + 10) {
                            $('.price-color').css("color", "#FFC700");

                        } else if (total_price_after_vat < avg_price - 10) {
                            $('.price-color').css("color", "#FF4444");

                        } else {
                            $('.price-color').css("color", "#60BC71");

                        }
                    }



                },
                error: error => {
                    console.log(error)
                }

            });
        }

        function recoveryTBC(e) {
            if (e.target.checked) {
                $('#loader').show();
                $.ajax({
                    url: `/user/recovery-info`,
                    method: 'get',
                    dataType: 'json',
                    data: {
                        'enquiry_id': Number($('#enquiry_id').val()),
                    },
                    success: data => {

                        geoLocationCoordinate(data.businessPostCode);
                        geoLocationCoordinate(data.clientPostCode)

                        //    console.lo

                    },
                    error: error => {
                        console.log(error)
                    }

                });
            } else {
                $('#loader').hide();
                $('.recovery-cost').val(0);
                let query_id = $('#enquiry_id').val();
                let engine_cost = $('.engine-cost').val();
                let exchange_surcharge_cost = $('.exchange-surcharge-cost').val();
                let delivery_cost = $('.delivery-cost').val();
                let recovery_cost = $('.recovery-cost').val();
                let fitting_cost = $('.fitting-cost').val();
                let vat_cost = $('.vat-cost').val();

                let total_price_before_vat = Number(engine_cost) + Number(exchange_surcharge_cost) + Number(
                    delivery_cost) + Number(
                    recovery_cost) + Number(fitting_cost);
                let total_price_after_vat = total_price_before_vat + (total_price_before_vat * Number(vat_cost)) / 100;
                $('.total_price').html(Number(total_price_after_vat.toFixed(2)));
                $.ajax({
                    url: `/user/get-quote-price`,
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        'enquiry_id': Number(query_id),

                    },
                    success: data => {
                        console.log(data);
                        if (data.data.length <= 0) {
                            $('.price-color').css("color", "#60BC71");
                        } else {
                            let price = 0;
                            for (let i = 0; i < data.data.length; i++) {
                                let cost = Number(data.data[i].invoice.total_price);
                                price += cost;

                            }
                            let avg_price = price / data.data.length;
                            if (total_price_after_vat > avg_price + 10) {
                                $('.price-color').css("color", "#FFC700");

                            } else if (total_price_after_vat < avg_price - 10) {
                                $('.price-color').css("color", "#FF4444");

                            } else {
                                $('.price-color').css("color", "#60BC71");

                            }
                        }



                    },
                    error: error => {
                        console.log(error)
                    }

                });
            }


        }

        let allCoordinates = [];

        function geoLocationCoordinate(postCode) {

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
                        geoLocationDistance(allCoordinates[0].lat, allCoordinates[0].lng, allCoordinates[1].lat,
                            allCoordinates[1].lng)
                    }


                },
                error: error => {
                    console.log(error)
                }

            });
        }

        function geoLocationDistance(lat1, lng1, lat2, lng2) {

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
                        $('.recovery-cost').val(50);
                    } else {
                        $('.recovery-cost').val((distanceInMile * 2).toFixed(2))
                    }


                    allCoordinates = []
                    let query_id = $('#enquiry_id').val();
                    let engine_cost = $('.engine-cost').val();
                    let exchange_surcharge_cost = $('.exchange-surcharge-cost').val();
                    let delivery_cost = $('.delivery-cost').val();
                    let recovery_cost = $('.recovery-cost').val();
                    let fitting_cost = $('.fitting-cost').val();
                    let vat_cost = $('.vat-cost').val();

                    let total_price_before_vat = Number(engine_cost) + Number(exchange_surcharge_cost) + Number(
                        delivery_cost) + Number(
                        recovery_cost) + Number(fitting_cost);
                    let total_price_after_vat = total_price_before_vat + (total_price_before_vat * Number(
                        vat_cost)) / 100;
                    $('.total_price').html(Number(total_price_after_vat.toFixed(2)));
                    $.ajax({
                        url: `/user/get-quote-price`,
                        method: 'GET',
                        dataType: 'json',
                        data: {
                            'enquiry_id': Number(query_id),

                        },
                        success: data => {
                            console.log(data);
                            if (data.data.length <= 0) {
                                $('.price-color').css("color", "#60BC71");
                            } else {
                                let price = 0;
                                for (let i = 0; i < data.data.length; i++) {
                                    let cost = Number(data.data[i].invoice.total_price);
                                    price += cost;

                                }
                                let avg_price = price / data.data.length;
                                if (total_price_after_vat > avg_price + 10) {
                                    $('.price-color').css("color", "#FFC700");

                                } else if (total_price_after_vat < avg_price - 10) {
                                    $('.price-color').css("color", "#FF4444");

                                } else {
                                    $('.price-color').css("color", "#60BC71");

                                }
                            }



                        },
                        error: error => {
                            console.log(error)
                        }

                    });
                    $('#loader').hide();



                },
                error: error => {
                    console.log(error)
                }

            });
        }

        function inputFocus(event) {
            // console.log(typeof(event.target.value))
            if (event.target.value === "0") {
                var className = event.target.className.split(" ").slice(-1)[0];
                $(`.${className}`).val(" ");
            }

        }
    </script>
</body>

</html>
{{-- // learn --}}
{{-- function recoveryTBC(e) {
    if (e.target.checked) {

        $.ajax({
            url: `/user/recovery-info`,
            method: 'get',
            dataType: 'json',
            data: {
                'enquiry_id': Number($('#enquiry_id').val()),
            },
            success: data => {

                geoLocationCoordinate(data.businessPostCode).then((response) => {
                    console.log(response)
                    
                })
                geoLocationCoordinate(data.clientPostCode)
            

                //    console.lo

            },
            error: error => {
                console.log(error)
            }

        });
    } else {
        $('.recovery-cost').val(0);
    }


}

let allCoordinates = [];
async function geoLocationCoordinate(postCode) {


    const response = await new Promise((resolve, reject) => {
        $.ajax({
            url: '/user/geoLocationCoordinate',
            method: 'GET',
            dataType: 'json',
            data: {
                postCode: postCode,
            },
            success: data => {
                resolve(data?.data);
            },
            error: error => {
                reject(error);
            },
        });
    });

    return response;
} --}}

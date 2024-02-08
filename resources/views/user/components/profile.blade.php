<div class="account-common-component">
    <div class="content">
        Quotes ALL your customers the ones outside of V6 Auto Centre network by clicking Create Your Own Quote and send
        them Invoices from Generate Customer Invoice For any questions, suggestions or inquiries, please contact
        via email: app@v6autocentre.co.uk.
    </div>
</div>



@if (count($errors) > 0)
    <div class="alert alert-danger my-3">
        <strong>Whoops!</strong> There were some problems with your input.
    </div>
@endif

<div class="account-section-tab">
    <nav>
        <div class="nav nav-tabs mb-3 " id="nav-tab" role="tablist">
            <button class="nav-link" id="nav-account-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
                role="tab" aria-controls="nav-home" aria-selected="true">Edit account</button>
            <button class="nav-link" id="nav-payment-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Manage Payment</button>
            <button class="nav-link active" id="nav-quote-customization-tab" data-bs-toggle="tab"
                data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact"
                aria-selected="false">Quote
                Customization</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">

        <div class="tab-pane fade account-personal-info" id="nav-home" role="tabpanel"
            aria-labelledby="nav-account-tab">
            <form method="POST" action="{{ route('user.account.update') }}" enctype="multipart/form-data">
                @csrf
                @if (Auth::guard('businessUser')->check())
                    @php
                        $auth = Auth::guard('businessUser')->user();
                    @endphp
                    <div class="personal-info-div">
                        <div class="personal-info-header">
                            Personal Information
                        </div>
                        <div class="row personal-info-input gy-2">
                            <div class="col-md-4">
                                <label for="">User Name</label>
                                <input type="text" class="form-control" value="{{ $auth->user_name }}"
                                    name="user_name" id="">
                            </div>
                            <div class="col-md-4">
                                <label for="">Password</label>
                                <input type="text" class="form-control" placeholder="Your Password" name="password"
                                    id="">
                            </div>
                            <div class="col-md-4">
                                <label for="">Email</label>
                                <input type="email" class="form-control" value="{{ $auth->email }}" name="email"
                                    id="">
                            </div>
                            <div class="col-md-4">
                                <label for="">First Name</label>
                                <input type="text" class="form-control" name="first_name"
                                    value="{{ $auth->first_name }}" id="">
                            </div>
                            <div class="col-md-4">
                                <label for="">Last Name</label>
                                <input type="text" class="form-control" name="last_name"
                                    value="{{ $auth->last_name }}" id="">
                            </div>
                            <div class="col-md-4">
                                <label for="">Image</label>
                                <input type="file" class="form-control" name="img" id="">
                            </div>
                        </div>
                    </div>
                @endif
                @if (Auth::guard('businessUser')->check())
                    @php
                        $user_id = Auth::guard('businessUser')->user()->user_id;
                    @endphp
                @else
                    @php
                        $user_id = Auth::guard('web')->user()->id;
                    @endphp
                @endif
                @php
                    use App\Models\User;
                    $business = User::with('business_profile')->find($user_id);

                @endphp
                <div class="business-info-div">
                    <div class="business-info-header">
                        Business Information
                    </div>
                    <div class="row business-info-input gy-2">
                        <div class="col-md-4">
                            <label for="">Business Name</label>
                            <input type="text" class="form-control" name="business_name"
                                value="{{ $business->business_profile->business_name }}" id="">
                        </div>
                        <div class="col-md-4">
                            <label for="">Trade Name</label>
                            <input type="text" class="form-control"
                                value="{{ $business->business_profile->trade_name }}" name="trade_name" id="">
                        </div>
                        <div class="col-md-4">
                            <label for="">Business Type</label>
                            <select class="form-select" name="business_type">

                                <option value="Retail"
                                    {{ $business->business_profile->business_type == 'Retail' ? 'selected' : '' }}>
                                    Retail
                                </option>
                                <option value="Wholesale"
                                    {{ $business->business_profile->business_type == 'Wholesale' ? 'selected' : '' }}>
                                    Wholesale</option>
                                <option value="Government"
                                    {{ $business->business_profile->business_type == 'Government' ? 'selected' : '' }}>
                                    Government</option>
                                <option value="International"
                                    {{ $business->business_profile->business_type == 'International' ? 'selected' : '' }}>
                                    International</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Website Url</label>
                            <input type="text" class="form-control"
                                value="{{ $business->business_profile->website }}" name="website" id="">
                        </div>
                        <div class="col-md-4">
                            <label for="">Address 1*</label>
                            <input type="text" class="form-control" name="address"
                                value="{{ $business->business_profile->address }}" id="">
                        </div>
                        <div class="col-md-4">
                            <label for="">City*</label>
                            <input type="text" class="form-control" name="city"
                                value="{{ $business->business_profile->city }}" id="">
                        </div>
                        <div class="col-md-4">
                            <label for="">Post Code*</label>
                            <input type="text" class="form-control" name="post_code" oninput="removeSpaces2()"
                                value="{{ $business->business_profile->post_code }}" id="post_code">
                        </div>
                        <div class="col-md-4">
                            <label for="">Country</label>
                            <select class="form-select" name="country">

                                <option value="Bangladesh"
                                    {{ $business->business_profile->country == 'Bangladesh' ? 'selected' : '' }}>
                                    Bangladesh
                                </option>
                                <option value="India"
                                    {{ $business->business_profile->country == 'India' ? 'selected' : '' }}>India
                                </option>
                                <option value="USA"
                                    {{ $business->business_profile->country == 'USA' ? 'selected' : '' }}>USA</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">VAT No</label>
                            <input type="text" class="form-control"
                                value="{{ $business->business_profile->vat_no }}" name="vat_no" id="">
                        </div>
                        <div class="col-md-4">
                            <label for="">Phone Primary* <span>(Only 11-12 digits)</span></label>
                            <input type="text" class="form-control" name="primary_phone"
                                value="{{ $business->business_profile->primary_phone }}" id="">
                        </div>
                        <div class="col-md-4">
                            <label for="">Phone Secondary <span>(Only 11-12 digits)</label>
                            <input type="text" class="form-control" name="alternative_phone"
                                value="{{ $business->business_profile->alternative_phone }}" id="">
                        </div>
                        <div class="col-md-4">
                            <label for="">Phone Other <span>(Only 11-12 digits)</label>
                            <input type="text" class="form-control" name="other_phone"
                                value="{{ $business->business_profile->other_phone }}" id="">
                        </div>
                        <div class="col-md-4">
                            <label for="">Status</label>
                            <select class="form-select" name="status">

                                <option value="1"
                                    {{ $business->business_profile->status == 1 ? 'selected' : '' }}>
                                    Active</option>
                                <option value="0"
                                    {{ $business->business_profile->status == 0 ? 'selected' : '' }}>
                                    Inactive</option>

                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Logo <span>(Only Jpeg, png, gif)</span></label>
                            <input style="border: 1px solid #3EB075;border-radius: 8px;" type="file"
                                class="form-control" name="logo" id="">
                        </div>
                        <div class="col-md-4">
                            <label for="">Rating</label>
                            {{-- <select class="form-select" name="rating">

                                <option value="1"
                                    {{ $business->business_profile->rating == 1 ? 'selected' : '' }}>S
                                </option>
                                <option value="2"
                                    {{ $business->business_profile->rating == 2 ? 'selected' : '' }}>M
                                </option>
                                <option value="3"
                                    {{ $business->business_profile->rating == 3 ? 'selected' : '' }}>L
                                </option>
                            </select> --}}
                            <input type="text" class="form-control"
                                style="color: inherit; border: 1px solid #3EB075;border-radius: 8px;" name="rating"
                                value="{{ $business->business_profile->rating }}" id="">
                        </div>
                        <div class="col-md-4">
                            <label for="">Expiry Date</label>
                            <input type="date" class="form-control"
                                style="color: inherit; border: 1px solid #3EB075;border-radius: 8px;"
                                name="expiry_date" value="{{ $business->business_profile->expiry_date }}"
                                id="">
                        </div>
                        <div class="col-md-4 checkbox-input">

                            <input type="checkbox" class="" name="marketing_email" id=""
                                {{ $business->business_profile->marketing_email == 1 ? 'checked' : null }}> <label
                                for="">Receive marketing email</label>

                        </div>
                        <div class="col-md-4 checkbox-input">

                            <input type="checkbox" class="" name="enquiry_email" id=""
                                {{ $business->business_profile->enquiry_email == 1 ? 'checked' : null }}> <label
                                for="">Receive enquiry email</label>
                        </div>
                        <div class="col-md-4">
                            <label for="">Warranty</label>
                            {{-- <select class="form-select" name="warranty">

                                <option value="12 months"
                                    {{ $business->business_profile->warranty == '12 months' ? 'selected' : '' }}>12
                                    months
                                </option>
                                <option value="10 months"
                                    {{ $business->business_profile->warranty == '10 months' ? 'selected' : '' }}>10
                                    months
                                </option>
                                <option value="1 month"
                                    {{ $business->business_profile->warranty == '1 month' ? 'selected' : '' }}>1 month
                                </option>
                            </select> --}}
                            <input type="text" class="form-control"
                                style="color: inherit; border: 1px solid #3EB075;border-radius: 8px;" name="warranty"
                                value="{{ $business->business_profile->warranty }}" id="">
                        </div>
                        <div class="col-md-4">
                            <label for="">Recovery Rate/mi</label>
                            <input type="text" class="form-control" name="recovery_rate" id=""
                                value="{{ $business->business_profile->recovery_rate }}">
                        </div>
                        <div class="col-md-4">
                            <label for="">Default Condition</label>
                            {{-- <select class="form-select" name="default_condition">

                                <option value="Reconditioned"
                                    {{ $business->business_profile->default_condition == 'Reconditioned' ? 'selected' : '' }}>
                                    Reconditioned</option>
                                <option value="New"
                                    {{ $business->business_profile->default_condition == 'New' ? 'selected' : '' }}>New
                                </option>

                            </select> --}}
                            <input type="text" class="form-control"
                                style="color: inherit; border: 1px solid #3EB075;border-radius: 8px;"
                                name="default_condition" value="{{ $business->business_profile->default_condition }}"
                                id="">
                        </div>

                    </div>
                </div>

                <div class="update-account-info-button">
                    <button type="submit" class="btn">Update</button>
                </div>
            </form>
        </div>

        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-payment-tab">
            <div class="expire-time-div">
                <p>Your V6 Auto Centre quote access has expired on <span>2023-07-07</span> .</p>
                <span>To Purchase a further 30 days access to the app@v6autocentre.co.uk system please click the pay now
                    button below.</span>
            </div>
            <div class="renewal-div">
                <div>
                    Renewal Amount:
                </div>
                <button class="btn">
                    £599.00
                </button>
            </div>
            <div class="terms-condition-div">
                <input type="checkbox" name="" id="">
                <p>I accept the <span>Term & conditions</span> and <span>Refund Policy</span> for this transaction.</p>
            </div>
            <div class="pay-now-div">
                <div>
                    Payment is being made to Auto Online Marketing Ltd (UK)
                </div>
                <div class="pay-now-via">
                    <img src="{{ asset('image/image_10.svg') }}" style="width: 150px; margin-right:30px"
                        alt="">
                    <img src="{{ asset('image/image_11.svg') }}" style="width: 150px" alt="">
                </div>
            </div>
            <div class="other-bank-logo">
                <img src="{{ asset('image/image_13.svg') }}" style="width: 285px;height: 56px; margin-right:30px"
                    alt="">
                <img src="{{ asset('image/image_12.svg') }}" style="width: 139px;height: 56px;" alt="">
            </div>

        </div>

        <div class="modal fade" id="socialMediaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header"
                        style="display: flex;justify-content:center;align-items:center;height: 40px; width:40px">
                        <button type="button" style="position: relative;left:-4px;color:white" class="btn-close"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class=" social-link-content modal-body">
                        <div class="social-link-title">
                            Add your social link
                        </div>
                        <form action="{{ route('user.account.addSocialLink') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="social-name-div">
                                <label for="">Name</label>
                                <input type="text" class="common-input-style form-control" name="name"
                                    placeholder="Enter name">
                            </div>
                            <div class="social-image-div">
                                <label for="">Image</label>
                                <input type="file" class="form-control" name="image" id="">
                            </div>
                            <div class="url-div-social">
                                <p>URL* <span>(PayPal Email in case you select PayPal)</span></p>
                                <textarea placeholder="Enter url" style="resize: none" name="url_email" id=""
                                    class="common-input-style form-control"rows="5"></textarea>
                            </div>
                            <div class="social-link-btn">
                                <button type="submit" class="btn">Save</button>
                                <button class="btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                        </form>


                    </div>

                </div>
            </div>
        </div>

        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="viewEmail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="viewEmailLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewEmailLabel">Sample Quatation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">



                        <div style="padding: 10px;margin-top:20px">
                            <div style="text-align:center">
                                <img src="{{ asset('image/pdf_logo.png') }}" alt=""
                                    style="height: 60px; width:70px">
                            </div>
                            <div style="margin-top: 30px;text-align:center">
                                <span
                                    style="color: rgba(10, 10, 15, 0.70);
                 font-family: Montserrat;
                 font-size: 24px;
                 font-style: normal;
                 font-weight: 600;
                 line-height: normal;">V6
                                    Auto Centre</span>
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
                                    <div style="display: inline-block; margin-right:30px">
                                        <span
                                            style="height: 7px;
                                    width: 7px;
                                    background-color: #69BF70;
                                    border-radius: 50%;
                                    display: inline-block; margin-right:5px"></span><span>Quote
                                            Ref: </span> <span> ET-409-97342</span>
                                    </div>
                                    <div style="display: inline-block;">
                                        <span
                                            style="height: 7px;
                            width: 7px;
                            background-color: #69BF70;
                            border-radius: 50%;
                            display: inline-block; margin-right:5px"></span><span>Quote
                                            Date: </span> <span> 2023-06-23</span>
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
                                        Your Details:
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
                                        <span>Name:</span> <span> James Pateman</span>
                                    </div>
                                    <div
                                        style="color: #000;
                   font-family: Montserrat;
                   font-size: 16px;
                   font-style: normal;
                   font-weight: 500;
                   line-height: normal;
                   margin-top:20px">
                                        <span>Phone:</span> <span> 09238427249</span>
                                    </div>
                                    <div
                                        style="color: #000;
                   font-family: Montserrat;
                   font-size: 16px;
                   font-style: normal;
                   font-weight: 500;
                   line-height: normal;
                   margin-top:20px">
                                        <span>Postcode:</span> <span> EN1139BN</span>
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
                    ">92398239</span>
                                    </div>
                                    <div
                                        style="color: #000;
                   font-family: Montserrat;
                   font-size: 14px;
                   font-style: normal;
                   font-weight: 500;
                   line-height: normal;
                   margin-top:20px">
                                        <span>JAGUAR XE PORTFOLIO D AWD AUTO </span>
                                    </div>
                                    <div
                                        style="color: #000;
               font-family: Montserrat;
               font-size: 14px;
               font-style: normal;
               font-weight: 500;
               line-height: normal;
               margin-top:20px">
                                        <span>1999 cc Diesel 2016 </span>
                                    </div>
                                    <div
                                        style="color: #000;
                   font-family: Montserrat;
                   font-size: 14px;
                   font-style: normal;
                   font-weight: 500;
                   line-height: normal;
                   margin-top:20px">
                                        <span>Engine Size:</span> <span> 1999 cc </span>
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
                                        Your Details:
                                    </div>
                                    <div
                                        style="color: #000;
                    font-family: Montserrat;
                    font-size: 16px;
                    font-style: normal;
                    font-weight: 500;
                    line-height: normal;
                    margin-top:20px">
                                        <span>Contact:</span> <span>Adam</span>
                                    </div>
                                    <div
                                        style="color: #000;
                    font-family: Montserrat;
                    font-size: 16px;
                    font-style: normal;
                    font-weight: 500;
                    line-height: normal;
                    margin-top:20px">
                                        <span>Phone:</span> <span> 09238427249</span>
                                    </div>
                                    <div
                                        style="color: #000;
                    font-family: Montserrat;
                    font-size: 16px;
                    font-style: normal;
                    font-weight: 500;
                    line-height: normal;
                    margin-top:20px">
                                        <span>Email:</span> <span> adam@v6autocentre.co.uk</span>
                                    </div>

                                    <div
                                        style="color: #000;
                    font-family: Montserrat;
                    font-size: 16px;
                    font-style: normal;
                    font-weight: 500;
                    line-height: normal;
                    margin-top:20px">
                                        <span>Address:</span> <span> Unit 5 Meadow lane Nottingham
                                            NG23HD</span>
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
                                        Array
                                    </div>
                                    <div
                                        style="float:right;color: rgba(0, 0, 0, 0.70);
                                font-family: Montserrat;
                                font-size: 16px;
                                font-style: normal;
                                font-weight: 700;
                   ">
                                        £2250.00
                                    </div>
                                </div>


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
                                        Fitting
                                    </div>
                                    <div
                                        style="float:right;color: rgba(0, 0, 0, 0.70);
                            font-family: Montserrat;
                            font-size: 16px;
                            font-style: normal;
                            font-weight: 700;
               ">
                                        £550.00
                                    </div>
                                </div>


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
                                            <span style="font-weight: 600;">Mileage:</span> <span
                                                style="font-weight: 500;">
                                                0</span>
                                        </div>
                                        <div
                                            style="color: #000;
                                    font-family: Montserrat;
                                    font-size: 16px;
                                    font-style: normal;
                                    text-align:start;
                                    margin:15px 0px">
                                            <span style="font-weight: 600;">Condition:</span> <span
                                                style="font-weight: 500;">
                                                Reconditioned</span>
                                        </div>
                                        <div
                                            style="color: #000;
                                    font-family: Montserrat;
                                    font-size: 16px;
                                    font-style: normal;
                                    text-align:start">
                                            <span style="font-weight: 600;">Warranty:</span> <span
                                                style="font-weight: 500;">
                                                12 Months</span>
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
                                                £2250.00
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
                                                £0.00
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
                                                £2250.00
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div style="margin-top:80px;text-align:center; ">
                                <div
                                    style="display:inline-block;width:700px;padding:20px;border-radius: 10px;
                            border: 1px solid #F44;
                            background: rgba(255, 68, 68, 0.20);
                            color: rgba(0, 0, 0, 0.80);
                            font-family: Montserrat;
                            font-size: 16px;
                            font-style: normal;
                            font-weight: 500;
                            line-height: normal;">
                                    This is an estimated, no-obligation price quote for completing the job as described
                                    above
                                </div>

                            </div>
                            <div style="margin-top: 15px; text-align:center">
                                <div
                                    style="height:3px; width:700px;background:#69BF70;border-radius:10px;display:inline-block">

                                </div>
                            </div>
                            <div style="margin-top:20px; ">
                                <div style="margin:0 auto;width:700px">
                                    <div style="">
                                        <span style="color:#3EB075">V6 AUTO CENTRE V6 AUTO CENTRE</span> based in
                                        Nottingham City. We offer complete Engine
                                        Replacement Or Reconditioned job supply and fit for customer requirement. All
                                        engines fitted in our own workshops
                                        What does the Re-condition consist of?(1) The Engine is stripped to component
                                        level and put into a high pressure parts cleanser at high temperature with
                                        abrasive chemicals removing all carbon deposits and debris from previous
                                        failures returning the components to a “NEW” metal condition.(2) The Cylinder
                                        Block is re-honed and or re-bored.(3) Pistons and or Rings are replaced.(4)
                                        Connecting Rods are re-honed.(5) The Crankshaft is polished and/or reground.(6)
                                        The main and big end bearings are replaced.(7) Oil Pump is reconditioned or
                                        replaced for new.(8) The Cylinder Head is then stripped down and checked for
                                        wear, cracks and for trueness then pressure tested and resurfaced as
                                        necessary.(9) Valve guides are checked for wear and replaced as necessary, valve
                                        seats are cut.(10) New/re-faced valves are lapped into the Cylinder-head and
                                        vacuum tested.(11) The Crankmshaft is checked for wear and re-polished if
                                        required.(12) Timing Chain Kit / Timing belt kit are replaced completely.(13)
                                        The
                                        engine is then reassembled with new gaskets and seals.


                                    </div>
                                    <div style="margin-top:20px;">
                                        <div style="color:red;margin-bottom:10px">
                                            Terms and Conditions
                                        </div>
                                        <div>
                                            Terms and Conditions
                                            By placing an order with V6 AUTO CENTRE, You confirm that You received,
                                            read, understood, and accepted the Terms and Conditions in whole and You
                                            agree to be bound by the T&C set below.
                                            All New/Reconditioned engines MUST be serviced after 300 miles have been
                                            covered or 4 weeks, once the vehicle has been collected from our workshop.
                                            The engine should be serviced by a qualified mechanic ensuring engine oil,
                                            oil filter(s), coolant inspected/replaced where necessary.
                                            Regular servicing should be carried out at an interval of no more than 3000
                                            miles or 6 months during the length of the warranty.
                                            proof of servicing MUST be provided via original receipt/invoice from the
                                            mechanic/workshop inclusive of company and/or VAT numbers. Any paperwork
                                            fails to meet the requirement may void your warranty.
                                            Quotations
                                            -Are for a limited period only, please see Quote for a period time.-Initial
                                            Quote is an estimate, more detailed estimate is made, with more information,
                                            which may include inspection and evaluation of the Engine first.
                                            Pickup and Delivery of Vehicle
                                            -All deliveries and Pickups are charged to the Customer. This may be
                                            included in initial Quote..
                                            Work Carried Out
                                            -Timing Belts or Chains are replaced, unless replacing them is too
                                            difficult, due to extra parts required, which are outside the Bare Engine.
                                            You will be informed if this is the case.-The oil pump is changed if
                                            necessary for reconditioned or new.-Items outside the Bare engine are not
                                            covered, like turbos, injectors, or connecting pipes, manifolds. Etc.-When
                                            Reconditioning customer's own engine, the engine must be serviceable. The
                                            main components must be intact and not damaged, this includes the Engine
                                            Block, Cylinder Head, Crankshaft, and Camshafts. Additional Surcharge will
                                            be applied if we have to acquire replacements for these.-Also, if the engine
                                            needs Line Boring, this will be considered as an additional cost.
                                            Additional Work at Extra Charge-Replacement Engine Block-Replacement
                                            Cylinder Head-Replacement Crankshaft-Replacement Camshafts-Replacement
                                            Sump-Line Boring of the Engine Block-Additional Work can also be made on
                                            request, by the customer.-All Additional Work carried out is made with
                                            authorization from the customer before the work or parts are acquired and
                                            fitted. Sometimes, this will require the customer making a payment for this
                                            additional work before the work is started.
                                            Warranty
                                            -Parts Warranty for 6 Months unlimited Miles or 12 months 12,000 miles
                                            (Whichever comes first).-Warranty is subject to servicing being carried out
                                            at the correct time, as stated in our invoice provided.-Servicing of the
                                            vehicle is the responsibility of the customer. Copy of the Service must be
                                            sent to us.-Initial Mileage must be written down on the Invoice itself when
                                            the Engine is fitted back into the vehicle. Copy of which must be sent to
                                            us.-Warranty is subject to no tampering with the engine.
                                            -Correct Engine Oil must be used within the engine. Please see Manufacturers
                                            details for the correct oil grade to be used.-Breakdowns and Labour Work
                                            carried out, are the responsibility of the Customer-This is a Back to Base
                                            Warranty. You are responsible for the transporting of the VEHICLE to
                                            us.-Warranty does not cover claims for any loss and damage including any
                                            consequential loss or damage and the Company must not be held responsible
                                            for any, from whatever reason arising, whether claimed under the warranty or
                                            not.-Ancillaries are not covered under this warranty.-Common faults occur
                                            within vehicles of a particular type and manufacturer. Please read our FAQ
                                            for Common Faults. Any problem arising outside the engine that affects the
                                            engine is not covered under this Warranty. (ELCTRIC, ELECTRONICS, FUEL)-If
                                            the repair has been carried out on the engine and the same problem occurs
                                            again, this will be viewed as a fault occurring outside the engine and
                                            therefore void the warranty.
                                            Payments and Surcharges
                                            Payment must be paid before work commences.-Additional work payment must be
                                            paid before the Engine is released when sending it to the
                                            customer.-Additional work may require additional parts, depending upon the
                                            parts, payment must be made before the part is ordered for fitting.
                                            Supply and Fit
                                            - Please note upon agreeing to have your vehicle collected, a deposit of 50%
                                            is required to be paid once it arrives at our location.
                                            Support
                                            -If any problems arise with engine, please Email or telephone us with a
                                            description of the problem. This may require pictures or a video to be taken
                                            and sent to our Support Team. Our Support Team will guide you through our
                                            procedures. Please have your Invoice to hand and any Service paper work that
                                            may have been carried out.-If, for any reason, you wish to have the engine
                                            checked by an independent specialist, then we must be informed, in writing,
                                            prior to any work being conducted. This is your right and we accept no
                                            burden of cost, in this.-Exceptional circumstances can always arise. We will
                                            try to be as flexible as possible to help, please do not hesitate to raise
                                            any query you may have.
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div
                                style="margin-top:40px;color: #69BF70;
                        font-family: Montserrat;
                        font-size: 25px;
                        font-style: normal;
                        font-weight: 700;
                        line-height: normal;
                        text-align:center
                        ">
                                <div style="width:700px;display:inline-block">
                                    Download V6 Auto Centre App To Get Instant Price Quotes
                                </div>

                            </div>

                            <div style="margin-top:20px">
                                <div
                                    style="color: rgba(0, 0, 0, 0.70);
                        font-family: Montserrat;
                        font-size: 18px;
                        font-style: normal;
                        font-weight: 500;
                        margin: 0 auto;
                        width:700px;">
                                    <div style="">
                                        Please Download "V6 Auto Centre" App to view all your quote activity on your
                                        phone. Get advantage of
                                        selecting
                                        garages in the app by accepting the price quotes and contacting the sellers at
                                        one place. Save your
                                        time
                                        and
                                        efforts of logging into your email inbox again and again.
                                    </div>

                                </div>
                            </div>

                            <div style="margin-top: 20px;">
                                <div style="width:700px;margin: 0 auto">
                                    <div
                                        style="
                                font-family: Montserrat;
                                font-size: 16px;
                                font-style: normal;">
                                        <span style="color: #000;font-weight: 500;"></span> Social Link: <span
                                            style="font-weight: 700;color:#69BF70">Facebook</span> <span
                                            style="color:blue;
                                        font-family: Montserrat;
                                        font-size: 18px;
                                        font-style: normal;
                                        font-weight: 500;
                                        line-height: 165.4%;
                                        text-decoration-line: underline;margin-left:30px">www.facebook.com</span>
                                    </div>
                                </div>


                            </div>
                            <div style="margin-top: 20px;">
                                <div style="width:700px;margin: 0 auto">
                                    <div
                                        style="
                                font-family: Montserrat;
                                font-size: 16px;
                                font-style: normal;">
                                        <span style="color: #000;font-weight: 500;">Powered By</span> <span
                                            style="font-weight: 700;color:#69BF70">V6 Auto Centre</span> <span
                                            style="color: #F44;
                                        font-family: Montserrat;
                                        font-size: 18px;
                                        font-style: normal;
                                        font-weight: 500;
                                        line-height: 165.4%;
                                        text-decoration-line: underline;margin-left:30px">Unsubscribe</span>
                                    </div>
                                </div>


                            </div>


                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade quote-customization active show" id="nav-contact" role="tabpanel"
            aria-labelledby="nav-quote-customization-tab">
            <div class="social-media-account-div">
                <button class="btn" style="margin-right:10px;cursor: pointer;" data-bs-toggle="modal"
                    data-bs-target="#socialMediaModal">Add your social link</button>
                <button class="btn" style="cursor: pointer;" data-bs-toggle="modal"
                    data-bs-target="#viewEmail">View Quote Email</button>
            </div>


            <form action="{{ route('user.account.quoteCustomization') }}" method="POST">
                @csrf
                <div class="selling-point-div">
                    <label for="">Selling Point Title</label> <br>
                    <input name="selling_point_title" type="text" class="form-control"
                        value="{{ $customization ? $customization->selling_point_title : '' }}"
                        placeholder="Enter selling point title"> <br>

                    <textarea name="selling_point_description" class="summernote" id=""
                        placeholder="Enter selling point description">{{ $customization ? $customization->selling_point_description : '' }}</textarea>
                </div>
                <div class="quote-terms-condition-div">
                    <label for="">Term’s & Conditions</label> <br>
                    <input type="text" class="form-control" name="terms_condition_title" id=""
                        placeholder="Enter Term’s & Conditions title"
                        value="{{ $customization ? $customization->terms_condition_title : '' }}">
                    <label class="url-input-label" for="">Term’s & Conditions URL</label> <br>
                    <input type="text" class="form-control" name="terms_condition_url" id=""
                        placeholder="Enter URL for Term’s & Conditions"
                        value="{{ $customization ? $customization->terms_condition_url : '' }}">
                    <div class="quote-terms-condition-textarea ">

                        <textarea name="terms_condition_description" placeholder="Enter terms and condition description" class="summernote"
                            id="">{{ $customization ? $customization->terms_condition_description : '' }}</textarea>
                    </div>

                </div>



                <div class="update-quote-btn_main">
                    <button class="btn">{{ $customization ? 'Update Quote' : 'Create Quote' }} </button>
                </div>

            </form>

        </div>
    </div>
</div>

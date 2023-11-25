<div class="account-common-component">
    <div class="content">
        Quotes ALL your customers the ones outside of Engine Trust network by clicking Create Your Own Quote and send
        them Invoices from Generate Customer Invoice For any questions, suggestions or inquiries, please contact "Mo"
        via Whatsapp @ 07742854560 or email: mo@enginetrust.co.uk.
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
            <button class="nav-link active" id="nav-account-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                type="button" role="tab" aria-controls="nav-home" aria-selected="true">Edit account</button>
            <button class="nav-link" id="nav-payment-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Manage Payment</button>
            <button class="nav-link" id="nav-quote-customization-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Quote
                Customization</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">

        <div class="tab-pane fade active show account-personal-info" id="nav-home" role="tabpanel"
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
                            <input type="text" class="form-control" name="post_code"
                                value="{{ $business->business_profile->post_code }}" id="">
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
                            <select class="form-select" name="rating">

                                <option value="1"
                                    {{ $business->business_profile->rating == 1 ? 'selected' : '' }}>S
                                </option>
                                <option value="2"
                                    {{ $business->business_profile->rating == 2 ? 'selected' : '' }}>M
                                </option>
                                <option value="3"
                                    {{ $business->business_profile->rating == 3 ? 'selected' : '' }}>L
                                </option>
                            </select>
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
                            <select class="form-select" name="warranty">

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
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Recovery Rate/mi</label>
                            <input type="text" class="form-control" name="recovery_rate" id=""
                                value="{{ $business->business_profile->recovery_rate }}">
                        </div>
                        <div class="col-md-4">
                            <label for="">Default Condition</label>
                            <select class="form-select" name="default_condition">

                                <option value="Reconditioned"
                                    {{ $business->business_profile->default_condition == 'Reconditioned' ? 'selected' : '' }}>
                                    Reconditioned</option>
                                <option value="New"
                                    {{ $business->business_profile->default_condition == 'New' ? 'selected' : '' }}>New
                                </option>

                            </select>
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
                <p>Your Engine Trust quote access has expired on <span>2023-07-07</span> .</p>
                <span>To Purchase a further 30 days access to the Enginetrust.co.uk system please click the pay now
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

        <div class="tab-pane fade quote-customization" id="nav-contact" role="tabpanel"
            aria-labelledby="nav-quote-customization-tab">
            <div class="social-media-account-div">
                <button class="btn" style="margin-right:10px" data-bs-toggle="modal"
                    data-bs-target="#socialMediaModal">Add your social link</button>
                <button class="btn">View Quote Email</button>
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
                    <button class="btn">Update Quote</button>
                </div>

            </form>

        </div>
    </div>
</div>

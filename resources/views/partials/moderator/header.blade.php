


<div class="modal fade" id="companyAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content company-add-modal">
            <div class="modal-header">
                <i class="fa-solid fa-xmark cross-btn-add-company" onclick="modalClose()"></i>
            </div>
            <div class="modal-body">
                <div class="company-modal-main-content">
                    <div class="company-modal-title-div">Add new Company</div>
                   <form action="{{route('moderator.createCompany')}}" method="POST" autocomplete="off">
                    @csrf
                    <div class="company-modal-input-div">
                        <div class="main-input-div">
                            <div>
                                <div>
                                    {{-- <label for="">Business Name</label> <br> --}}
                                    <input placeholder="Business Name" name="business_name" type="text"
                                        name="business_name" id="" value="{{ old('business_name') }}"> <br>
                                    <span class="text-danger">
                                        @error('business_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div>
                                    {{-- <label for="">Business Type</label> <br> --}}
                                    <input placeholder="Business Type" name="business_type" type="text"
                                        name="business_type" id="" value="{{ old('business_type') }}"> <br>
                                    <span class="text-danger">
                                        @error('business_type')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div>
                                <div>
                                    {{-- <label for="">Email Address</label> <br> --}}
                                    <input placeholder="Email Address" name="email" type="email" name="email"
                                        id="" value="{{ old('email') }}"> <br>
                                    <span class="text-danger">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>

                                </div>
                                <div>
                                    {{-- <label for="">Street Address</label> <br> --}}
                                    <input placeholder="Street Address" name="address" type="text" name=""
                                        id="" value="{{ old('address') }}"> <br>
                                    <span class="text-danger">
                                        @error('address')
                                            {{ $message }}
                                        @enderror
                                    </span>

                                </div>
                            </div>
                            <div>
                                <div>
                                    {{-- <label for="">Password</label> <br> --}}
                                    <input placeholder="Password" name="password" type="password" name="password"
                                        id="" value="{{ old('password') }}"> <br>
                                    <span class="text-danger">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span>

                                </div>
                                <div>
                                    {{-- <label for="">Town/City</label> <br> --}}

                                    <input placeholder="Town/City" name="city" type="text" name=""
                                        id="" value="{{ old('city') }}"> <br>
                                    <span class="text-danger"> @error('city')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div>
                                <div>
                                    {{-- <label for="">Phone Primary</label> <br> --}}
                                    <input placeholder="Phone Primary" name="primary_phone" type="text"
                                        name="" id="" value="{{ old('primary_phone') }}"> <br>
                                    <span class="text-danger">
                                        @error('primary_phone')
                                            {{ $message }}
                                        @enderror
                                    </span>

                                </div>
                                <div>
                                    {{-- <label for="">Post Code</label> <br> --}}
                                    <input placeholder="Post Code" name="post_code" type="text" name=""
                                        id="" value="{{ old('post_code') }}"> <br>
                                    <span class="text-danger"> @error('post_code')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div>
                                <div>
                                    {{-- <label for="">Phone Alternate</label> <br> --}}
                                    <input placeholder="Phone Alternate" name="alternative_phone" type="text"
                                        name="" id="" value="{{ old('alternative_phone') }}"> <br>
                                    <span class="text-danger"> @error('alternative_phone')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div>
                                    {{-- <label for="">Country</label> <br> --}}
                                    <input placeholder="Country" name="country" type="text" name=""
                                        id="" value="{{ old('country') }}"> <br>
                                    <span class="text-danger"> @error('country')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div>
                                <div>
                                    {{-- <label for="">Your Default Warrenty</label> <br> --}}
                                    <input placeholder="Your Default Warranty" name="warranty" type="text"
                                        name="" id="" value="{{ old('warranty') }}"> <br>
                                    <span class="text-danger"> @error('warranty')
                                            {{ $message }}
                                        @enderror
                                    </span>

                                </div>
                                <div>
                                    {{-- <label for="">Quoting Person Name</label> <br> --}}
                                    <input placeholder="Quoting Person Name" name="quoting_person_name" type="text"
                                        name="" id="" value="{{ old('quoting_person_name') }}"> <br>
                                    <span class="text-danger">
                                        @error('quoting_person_name')
                                            {{ $message }}
                                        @enderror
                                    </span>

                                </div>
                            </div>
                            <div>
                                <div>
                                    {{-- <label for="">Vat Number</label> <br> --}}
                                    <input placeholder="Vat Number" name="vat_no" type="text" name=""
                                        id="" value="{{ old('vat_no') }}"> <br>
                                    <span class="text-danger">
                                        @error('vat_no')
                                            {{ $message }}
                                        @enderror
                                    </span>

                                </div>
                                <div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="save-btn">
                        <button type="submit" class="btn save">Confirm</button>
                    </div>
                  </form>  
                </div>
            </div>
        </div>
    </div>
</div>

<div class="header-div">
    <div class="left-div">
        <div class="create-own-quote header-common-style" style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#companyAddModal">
            <button class="btn btn-success light plus-btn">
                <i class="fa-solid fa-plus btn-plus-icon"></i>
            </button>
            <span>Add new company</span>
        </div>
        {{-- <div
          class="generate-customer-invoice header-common-style header-no-background"
        >
          <button class="btn btn-success light plus-btn">
            <i class="fa-solid fa-plus btn-plus-icon"></i>
          </button>
          <span>Generate Customer Invoice</span>
        </div> --}}
        <div class="my-account header-common-style header-no-background">
            <a href="{{ route('moderator.account') }}" style="text-decoration: none;color:black">
                <img src="{{ Auth::guard('moderator')->user()->moderator_profile->img ? asset('image/moderator/'.Auth::guard('moderator')->user()->moderator_profile->img) : asset('image/avatar.png')}}" class="header-image" alt="" />
                <span>My Account</span>
            </a>

        </div>
    </div>
    <div class="right-div">
        <div class="greetings">
            <span>Hi, {{Auth::guard('moderator')->user()->moderator_profile->user_name}}</span>
        </div>
        {{-- <div class="since-days">
            <span>(25 Days)</span>
        </div>
        <div class="time-div">13.12.13</div> --}}
    </div>
</div>

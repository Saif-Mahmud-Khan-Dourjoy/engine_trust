<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
    <title>Engine Trust Registration</title>
</head>

<body>
    <div class="register">
        <div class="register-main-div">
            <div class="register-logo-img ">
                <img src="{{ asset('image/login_logo.svg') }}" style="margin-left: 20px" alt="">
            </div>
            <div class="register-main-content">
                <div class="register-left-div">
                    <span>Welcome To</span> <br>
                    <span class="welcome-header">V6 Auto Centre</span>
                </div>
                <div class="register-right-div">
                    @if (Session::get('success'))
                      <div class="alert alert-success">
                          {{Session::get('success')}}
                      </div>
                        
                    @endif
                    @if (Session::get('error'))
                      <div class="alert alert-danger">
                          {{Session::get('error')}}
                      </div>
                        
                    @endif
                    <div class="right-div-header">

                        <span>Sign Up Today & Get your first month at discounted price</span>
                    </div>
                    <div class="register-input-div">
                      <form action="{{route('user.create')}}" method="POST">
                        @csrf
                        <div class="main-input-div">
                            <div>
                                <div>
                                    {{-- <label for="">Business Name</label> <br> --}}
                                    <input placeholder="Business Name" name="business_name" type="text" name="" id="" value="{{old('business_name')}}"> <br>
                                    <span class="text-danger">@error('business_name')
                                      {{$message}}   
                                    @enderror</span> 
                                </div>
                                <div>
                                    {{-- <label for="">Business Type</label> <br> --}}
                                    <input placeholder="Business Type" name="business_type" type="text" name="" id="" value="{{old('business_type')}}"> <br>
                                    <span class="text-danger">@error('business_type')
                                      {{$message}}   
                                    @enderror</span> 
                                </div>
                            </div>
                            <div>
                                <div>
                                    {{-- <label for="">Email Address</label> <br> --}}
                                    <input placeholder="Email Address" name="email" type="email" name="" id="" value="{{old('email')}}"> <br>
                                    <span class="text-danger">@error('email')
                                      {{$message}}   
                                    @enderror</span>
                                    
                                </div>
                                <div>
                                    {{-- <label for="">Street Address</label> <br> --}}
                                    <input placeholder="Street Address" name="address" type="text" name="" id="" value="{{old('address')}}"> <br>
                                    <span class="text-danger">@error('address')
                                      {{$message}}   
                                    @enderror</span>
                                    
                                </div>
                            </div>
                            <div>
                                <div>
                                    {{-- <label for="">Password</label> <br> --}}
                                    <input placeholder="Password" name="password" type="password" name="" id="" value="{{old('password')}}"> <br>
                                    <span class="text-danger">@error('password')
                                      {{$message}}   
                                    @enderror</span>
                                    
                                </div>
                                <div>
                                    {{-- <label for="">Town/City</label> <br> --}}
                                    
                                    <input placeholder="Town/City" name="city" type="text" name="" id="" value="{{old('city')}}"> <br>
                                    <span class="text-danger"> @error('city')
                                      {{$message}}   
                                    @enderror</span>
                                   
                                </div>
                            </div>
                            <div>
                                <div>
                                    {{-- <label for="">Phone Primary</label> <br> --}}
                                    <input placeholder="Phone Primary" name="primary_phone" type="text" name="" id="" value="{{old('primary_phone')}}"> <br>
                                    <span class="text-danger">@error('primary_phone')
                                      {{$message}}   
                                    @enderror</span>
                                    
                                </div>
                                <div>
                                    {{-- <label for="">Post Code</label> <br> --}}
                                    <input placeholder="Post Code" name="post_code" type="text" name="" id="" value="{{old('post_code')}}"> <br>
                                    <span class="text-danger"> @error('post_code')
                                      {{$message}}   
                                    @enderror</span>
                                   
                                </div>
                            </div>
                            <div>
                                <div>
                                    {{-- <label for="">Phone Alternate</label> <br> --}}
                                    <input placeholder="Phone Alternate" name="alternative_phone" type="text" name="" id="" value="{{old('alternative_phone')}}"> <br>
                                    <span class="text-danger"> @error('alternative_phone')
                                      {{$message}}   
                                    @enderror</span>
                                   
                                </div>
                                <div>
                                    {{-- <label for="">Country</label> <br> --}}
                                    <input placeholder="Country" name="country" type="text" name="" id="" value="{{old('country')}}"> <br>
                                    <span class="text-danger"> @error('country')
                                      {{$message}}   
                                    @enderror</span>
                                   
                                </div>
                            </div>
                            <div>
                                <div>
                                    {{-- <label for="">Your Default Warrenty</label> <br> --}}
                                    <input placeholder="Your Default Warranty" name="warranty" type="text" name="" id="" value="{{old('warranty')}}"> <br>
                                    <span class="text-danger">  @error('warranty')
                                      {{$message}}   
                                    @enderror</span>
                                  
                                </div>
                                <div>
                                    {{-- <label for="">Quoting Person Name</label> <br> --}}
                                    <input placeholder="Quoting Person Name" name="quoting_person_name" type="text" name="" id="" value="{{old('quoting_person_name')}}"> <br>
                                    <span class="text-danger">@error('quoting_person_name')
                                      {{$message}}   
                                    @enderror</span>
                                    
                                </div>
                            </div>
                            <div>
                                <div>
                                    {{-- <label for="">Vat Number</label> <br> --}}
                                    <input placeholder="Vat Number" name="vat_no" type="text" name="" id="" value="{{old('vat_no')}}"> <br>
                                    <span class="text-danger">@error('vat_no')
                                      {{$message}}   
                                    @enderror</span>
                                    
                                </div>
                                <div>

                                </div>
                            </div>
                        </div>

                        <div class="submit-button-div">
                            <button type="submit" class="btn"> Sign Up </button>
                        </div>
                      </form>  
                        <div class="login-div">
                            <span>Already a member?</span><span><a style="text-decoration: none; color:inherit" href="{{route('user.login')}}">Login</a></span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>

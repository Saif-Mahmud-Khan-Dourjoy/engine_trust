<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::get('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <div class="right-div-header">

                        <span>Sign Up Today & Get your first month at discounted price</span>
                    </div>
                    <div class="register-input-div">
                        <form action="{{ route('user.create') }}" method="POST">
                            @csrf
                            <div class="main-input-div">
                                <div>
                                    <div>
                                        {{-- <label for="">Business Name</label> <br> --}}
                                        <input placeholder="Business Name" name="business_name" type="text"
                                            name="" id="" value="{{ old('business_name') }}"> <br>
                                        <span class="text-danger">
                                            @error('business_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div>
                                        {{-- <label for="">Business Type</label> <br> --}}
                                        <input placeholder="Business Type" name="business_type" type="text"
                                            name="" id="" value="{{ old('business_type') }}"> <br>
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
                                        <input placeholder="Email Address" name="email" type="email" name=""
                                            id="email" value="{{ old('email') }}" oninput="checkEmail(event)"> <br>
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
                                        <input placeholder="Password" name="password" type="password" name=""
                                            id="password" value="{{ old('password') }}" oninput="validatePassword(event)"> <br>
                                        <span class="text-danger">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                        <span class="text-danger" style="font-size: 8px;width:200px;display:inline-block" id="passwordMessage"></span>

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
                                            name="" id="primary_phone" value="{{ old('primary_phone') }}"
                                            oninput="checkPrimaryPhone(event)"> <br>
                                        <span class="text-danger">
                                            @error('primary_phone')
                                                {{ $message }}
                                            @enderror
                                        </span>

                                    </div>
                                    <div>
                                        {{-- <label for="">Post Code</label> <br> --}}
                                        <input placeholder="Post Code" name="post_code" type="text" name=""
                                            id="post_code" value="{{ old('post_code') }}" oninput="removeSpaces()"> <br>
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
                                            name="" id="alternative_phone" value="{{ old('alternative_phone') }}"
                                            oninput="checkAlternativePhone(event)"> <br>
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
                                        <input placeholder="Quoting Person Name" name="quoting_person_name"
                                            type="text" name="" id=""
                                            value="{{ old('quoting_person_name') }}"> <br>
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

                            <div class="submit-button-div" style="cursor: pointer;">
                                <button type="submit"  class="btn submit-button"> Sign Up </button>
                            </div>

                        </form>
                        <div class="login-div">
                            <span>Already a member?</span><span><a style="text-decoration: none; color:inherit"
                                    href="{{ route('user.login') }}">Login</a></span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
           
            $(".submit-button").attr("disabled", true);
        });
    </script>
    <script>
         var emailValid;
         var primaryPhoneValid;
         var alternativePhoneValid=true;
         var passwordvalid;
         if($("#email").val().length >0){
            emailValid=true
         }else{
            emailValid=false
         }
         if($("#primary_phone").val().length >0){
            primaryPhoneValid=true
         }else{
            primaryPhoneValid=false
         }
         if($("#password").val().length >0){
            passwordvalid=true
         }else{
            passwordvalid=false
         }
         
        function checkEmail(event) {
            console.log(event.target.value);
            var emailValidRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
           
            if (event.target.value.match(emailValidRegex)) {
                emailValid = true;

            } else {
                emailValid = false;

            }
           if(!emailValid){
              $('#email').css('border-bottom','1px solid red')
           }else{
            $('#email').css('border-bottom','1px solid white')
           }

           if(emailValid && primaryPhoneValid && alternativePhoneValid && passwordvalid){
            $(".submit-button").attr("disabled", false);
           }else{
            $(".submit-button").attr("disabled", true);
           }

        }

        function checkAlternativePhone(event) {
            var phoneValidRegex = /^\d{0,12}$/;
          if(event.target.value.length>0){
            if (event.target.value.match(phoneValidRegex)) {
                alternativePhoneValid = true;

            } else {
                alternativePhoneValid = false;

            }
           
          }else{
            alternativePhoneValid = true;
          }
            if(!alternativePhoneValid){
              $('#alternative_phone').css('border-bottom','1px solid red')
           }else{
            $('#alternative_phone').css('border-bottom','1px solid white')
           }
            if(emailValid && primaryPhoneValid && alternativePhoneValid && passwordvalid){
            $(".submit-button").attr("disabled", false);
           }else{
            $(".submit-button").attr("disabled", true);
            }
         
            
        }
        function checkPrimaryPhone(event) {
            var phoneValidRegex = /^\d{0,12}$/;
           
            if (event.target.value.match(phoneValidRegex)) {
                primaryPhoneValid = true;

            } else {
                primaryPhoneValid = false;

            }
            if(!primaryPhoneValid){
              $('#primary_phone').css('border-bottom','1px solid red')
           }else{
            $('#primary_phone').css('border-bottom','1px solid white')
           }
            if(emailValid && primaryPhoneValid && alternativePhoneValid && passwordvalid){
            $(".submit-button").attr("disabled", false);
           }else{
            $(".submit-button").attr("disabled", true);
           }
        }

        function validatePassword(event) {
           
            var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

            if (passwordPattern.test(event.target.value)) {
                passwordvalid=true
                document.getElementById("passwordMessage").innerHTML = "";
            } else {
                passwordvalid=false
                document.getElementById("passwordMessage").innerHTML = "Password must contain at least 8 char, 1 num, 1 uppercase and 1 lowercase letter.";
            }
            if(!passwordvalid){
              $('#password').css('border-bottom','1px solid red')
           }else{
            $('#password').css('border-bottom','1px solid white')
           }
            if(emailValid && primaryPhoneValid && alternativePhoneValid && passwordvalid){
            $(".submit-button").attr("disabled", false);
           }else{
            $(".submit-button").attr("disabled", true);
           }

        }

        function removeSpaces() {
    var inputValue = $('#post_code').val();
    var trimmedValue = inputValue.replace(/\s/g, ''); // Removes all spaces

    // Update the input field value without spaces
    $('#post_code').val(trimmedValue);
}
    </script>
</body>

</html>

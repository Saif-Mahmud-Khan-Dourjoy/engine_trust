<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>V6 Autocentre Login</title>
  </head>
  <body>
   <div class="login">
    <div class="login-main-div">
      <div class="login-logo-img ">
        <img src="{{asset('image/login_logo.svg')}}" style="margin-left: 20px" alt="">
      </div>
      <div class="login-main-content">

           <div class="login-left-div">
              <span>Welcome To</span> <br>
              <span class="welcome-header">V6 Auto Centre</span>
           </div>
           <div class="login-right-div">
            @if (Session::get('error'))
            <div class="alert alert-danger">
                {{Session::get('error')}}
            </div>
              
          @endif
               <div class="right-div-header">
                <span>Login to account</span> <br>
                <span>Enter your credentials to access your account</span>
               </div>
               <div class="login-input-div">
                <form action="{{route('superAdmin.check')}}" method="POST">
                  @csrf
                <div class="email-div">
                  {{-- <label for="">Enter email</label> <br> --}}
                  <input placeholder="Enter email" type="email" name="email" id="email" oninput="checkEmail(event)" value="{{old('email')}}">
                  <span class="text-danger">@error('email')
                    {{$message}}   
                  @enderror</span>
                </div>
                <div class="password-div">
                  {{-- <label for="">Enter password</label> <br> --}}
                  <input placeholder="Enter password" type="password" name="password" id="" value="{{old('password')}}">
                  <span class="text-danger">@error('password')
                    {{$message}}   
                  @enderror</span> 
                </div>
                <div class="remember-forgot-div">
                  <div class="remember-me-input-div">
                    <input type="checkbox" style="cursor: pointer" name="remember_me" id="">&nbsp;<span class="remember-me-text"> Remember for 30 days</span>
                  </div>
                  <div>
                    <a href="{{route('superAdmin.forgot.form')}}" style="color: inherit;text-decoration:none">  <span class="forgot-password" style="cursor: pointer">Forgot Password</span></a>
                  </div>  
                </div>
                <div class="submit-button-div" style="cursor: pointer">
                  <button type="submit" class="btn submit-button"> Login </button>
               </div>
              </form>
                {{-- <div class="register-div">
                   <span>Not a member?</span><span>Create account</span>
                </div> --}}
               </div>
           </div>
      </div>

   </div>
    </div> 
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
      $(document).ready(function() {
         
          $(".submit-button").attr("disabled", true);
      });
  </script>
    <script>
       function checkEmail(event) {
            var emailValidRegex =/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            var emailValid=false;
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

           if(emailValid ){
            $(".submit-button").attr("disabled", false);
           }else{
            $(".submit-button").attr("disabled", true);
           }

        }
    </script>
  </body>
</html>
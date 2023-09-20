

    <div class="header-div">
      <div class="left-div">
        {{-- <div class="create-own-quote header-common-style " >
          <button class="btn btn-success light plus-btn">
            <i class="fa-solid fa-plus btn-plus-icon"></i>
          </button>
          <span>Add new company</span>
        </div> --}}
        {{-- <div
          class="generate-customer-invoice header-common-style header-no-background"
        >
          <button class="btn btn-success light plus-btn">
            <i class="fa-solid fa-plus btn-plus-icon"></i>
          </button>
          <span>Generate Customer Invoice</span>
        </div> --}}
        <div class="my-account header-common-style header-no-background">
         <a href="{{route('superAdmin.account')}}" style="color: black;text-decoration:none">
          <img src="{{Auth::guard('superAdmin')->user()->superAdmin_profile->img? asset('image/superAdmin/'.Auth::guard('superAdmin')->user()->superAdmin_profile->img) : asset('image/profileAvater.svg')}}" class="header-image" alt="" />
          <span>My Account</span>
        </a> 
          
        </div>
      </div>
      <div class="right-div">
        <div class="greetings">
          <span>Hi, {{Auth::guard('superAdmin')->user()->superAdmin_profile->user_name}}</span>
        </div>
        {{-- <div class="since-days">
          <span>(25 Days)</span>
        </div>
        <div class="time-div">13.12.13</div> --}}
      </div>
    </div>


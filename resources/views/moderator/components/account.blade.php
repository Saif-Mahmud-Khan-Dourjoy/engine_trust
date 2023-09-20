<div class="account-div">
    <div class="account-header-div">
        Personal Information
    </div>

    {{-- {{Auth::guard('moderator')->user()->moderator_profile}} --}}
   <form action="{{route('moderator.profile.update')}}" method="POST" enctype="multipart/form-data" >
    @csrf
    <div class="personal-info-input-div">
        <div class="personal-info-common-input">
            <label for="">User Name</label>
            <input type="text" name="user_name" value="{{Auth::guard('moderator')->user()->moderator_profile->user_name}}" class="form-control common-moderator-info-input">
        </div>
        <div class="personal-info-common-input">
            <label for="">Password</label>
            <input type="password" name="password" placeholder="Your Password" class="form-control common-moderator-info-input">
        </div>
        <div class="personal-info-common-input">
            <label for="">Email</label>
            <input type="email" name="email" value="{{Auth::guard('moderator')->user()->email}}" class="form-control common-moderator-info-input">
        </div>
        <div class="personal-info-common-input">
            <label for="">First Name</label>
            <input type="text" name="first_name" value="{{Auth::guard('moderator')->user()->moderator_profile->first_name}}" class="form-control common-moderator-info-input">
        </div>
        <div class="personal-info-common-input">
            <label for="">Last Name</label>
            <input type="text" name="last_name" value="{{Auth::guard('moderator')->user()->moderator_profile->last_name}}" class="form-control common-moderator-info-input">
        </div>
        <div class="personal-info-common-input">
            <label for="">Image</label>
            <input type="file" name="img" class="form-control">
        </div>
    </div>
    <div >
        <button type="submit" class="btn  update-button mt-5"
        style="padding:10px 30px;border-radius: 10px;
    background: var(--linear-green, linear-gradient(180deg, #3EB075 0%, #69BF70 100%)); color:white; font-weight:bold">Save</button>
    
    </div>
</form> 

</div>

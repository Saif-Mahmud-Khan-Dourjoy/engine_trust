@extends('superAdmin.layout.app')
@section('style')



@endsection
@section('data_layout')

<div class="modal fade" id="moderatorEditModal" tabindex="-1" aria-labelledby="moderatorEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content moderator-add-modal">
            <div class="modal-header">
                <i class="fa-solid fa-xmark cross-btn-add-moderator" onclick="modalCloseEdit()"></i>
            </div>
            <div class="modal-body">
                <div class="moderator-modal-main-content">
                    <div class="moderator-modal-title-div" >Update Moderator</div>
                    <form action="{{route('superAdmin.updateModerator')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="moderator-modal-input-div">
                        
                        <div class="row">
                            <div class="col-sm-6 moderator-input-col">
                                <label for="">First Name</label>
                                <input type="text"  class="form-control"
                                    placeholder="Enter Name" name="first_name" id="firstName"/>
                                <input type="hidden" id="moderatorId" name="moderator_id"/>    

                            </div>
                            <div class="col-sm-6 moderator-input-col">
                                <label for="">Last Name</label>
                                <input type="text"  class="form-control"
                                    placeholder="Enter Name"  name="last_name" id="lastName" />
                            </div>
                            <div class="col-sm-6 moderator-input-col">
                                <label for="">User name</label>
                                <input type="text"  class="form-control"
                                    placeholder="Enter User Name" name="user_name" id="userName" />
                            </div>
                            <div class="col-sm-6 moderator-input-col">
                                <label for="">Email</label>
                                <input type="email"  class="form-control email-update-valid"
                                    placeholder="Enter Email" name="email" id="moderatorEmail" oninput="checkUpdateEmail(event)" />
                            </div>
                            <div class="col-sm-6 moderator-input-col">
                                <label for="">Phone Number</label>
                                <input type="text"  class="form-control phone-update-valid"
                                    placeholder="Enter Phone" name="phone" id="moderatorPhone" oninput="checkUpdatePhone(event)" />
                            </div>
                            <div class="col-sm-6 moderator-input-col">
                                <label for="">Joining Date</label>
                                <input type="date"  class="form-control"
                                    placeholder="Email Joining Date" name="joining_date" id="joiningDate" />
                            </div>
                            <div class="col-sm-6">
                                <label for="">Image</label>
                                <input type="file"  class="form-control" name="img"
                                  />
                            </div>
                            <div class="col-12 moderator-input-col">
                                <label for="">Address</label>
                                <textarea name="address" id="address" style="resize: none" class="form-control" rows="3" id="address"></textarea>
                                
                            </div>
                          
                        </div>
                    
                    </div>
                    <div class="save-btn">
                        <button type="submit" class="btn save update-btn-status">Update</button>
                    </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>

@include('superAdmin.components.moderators')

@include('partials.footer')



    
@endsection

@section('script')

<script>
    function openEditModalModerator(id,first_name,last_name,user_name,email,phone,joining_date,address){
        $('#moderatorId').val(id);
        $('#userName').val(user_name);
        $('#firstName').val(first_name);
        $('#lastName').val(last_name);
        $('#moderatorEmail').val(email);
        $('#joiningDate').val(joining_date);
        $('#moderatorPhone').val(phone);
        $('#address').val(address);

        $("#moderatorEditModal").modal("show");
      }

      function modalCloseEdit(){
        $("#moderatorEditModal").modal("hide");
      }
</script>
<script>
    $(document).ready(function() {
       
        $(".save-btn-status").attr("disabled", true);
    });
</script>
<script>
     var emailValid = false;
     var phoneValid=true;
    
    function checkEmail(event) {
        var emailValidRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
       
        if (event.target.value.match(emailValidRegex)) {
            emailValid = true;

        } else {
            emailValid = false;

        }
       if(!emailValid){
          $('.email-valid').css('border','1px solid red')
       }else{
        $('.email-valid').css('border','1px solid #cdc8d4')
       }

       if(emailValid && phoneValid ){
        $(".save-btn-status").attr("disabled", false);
       }else{
        $(".save-btn-status").attr("disabled", true);
       }

    }

    function checkPhone(event) {
        var phoneValidRegex = /^\d{0,12}$/;
      if(event.target.value.length>0){
        if (event.target.value.match(phoneValidRegex)) {
            phoneValid = true;

        } else {
            phoneValid = false;

        }
       
      }else{
        phoneValid = true;
      }
        if(!phoneValid){
          $('.phone-valid').css('border','1px solid red')
       }else{
        $('.phone-valid').css('border','1px solid #cdc8d4')
       }
        if(emailValid && phoneValid ){
        $(".save-btn-status").attr("disabled", false);
       }else{
        $(".save-btn-status").attr("disabled", true);
        }
     
      
    }

     var emailUpdateValid = true;
     var phoneUpdateValid=true;
  
    function checkUpdateEmail(event) {
        var emailValidRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
       
        if (event.target.value.match(emailValidRegex)) {
            emailUpdateValid = true;

        } else {
            emailUpdateValid = false;

        }
       if(!emailUpdateValid){
          $('.email-update-valid').css('border','1px solid red')
       }else{
        $('.email-update-valid').css('border','1px solid #cdc8d4')
       }

       if(emailUpdateValid && phoneUpdateValid){
        $(".update-btn-status").attr("disabled", false);
       }else{
        $(".update-btn-status").attr("disabled", true);
       }

    }

    function checkUpdatePhone(event) {
        
        var phoneValidRegex = /^\d{0,12}$/;
      if(event.target.value.length>0){
        if (event.target.value.match(phoneValidRegex)) {
            phoneUpdateValid = true;
           

        } else {
            phoneUpdateValid = false;
           

        }
       
      }else{
        phoneUpdateValid = true;
      }
      if(!phoneUpdateValid){
          $('.phone-update-valid').css('border','1px solid red')
       }else{
        $('.phone-update-valid').css('border','1px solid #cdc8d4')
       }

       if(emailUpdateValid && phoneUpdateValid){
        $(".update-btn-status").attr("disabled", false);
       }else{
        $(".update-btn-status").attr("disabled", true);
       }
     
      
    }
   

</script>


    
@endsection

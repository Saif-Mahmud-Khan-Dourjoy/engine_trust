@extends('user.layout.app')
@section('style')


@endsection

@section('data_layout')
<div class="modal fade" id="employeeUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content employee-add-modal">
          <div class="modal-header">
              <i class="fa-solid fa-xmark cross-btn-add-employee" onclick="UpdateEmployeeModalClose()"></i>
          </div>
          <div class="modal-body">
              <div class="employee-modal-main-content">
                  <div class="employee-modal-title-div">Edit Employee</div>
                  <form action="{{route('user.updateEmployee')}}" method="POST">
                   @csrf
                   @method('PUT')
                  <div class="employee-modal-input-div">
                      <div class="row">
                          <div class="col-sm-6 employee-input-col">
                              <label for="">User Name</label>
                              <input type="text" id="userName" class="form-control"
                                  placeholder="At least 6 character long" name="user_name" />
                               <input type="hidden" name="id" id="userId">   
                          </div>
                          {{-- <div class="col-sm-6 employee-input-col">
                              <label for="">Password</label>
                              <input type="password" id="userPassword" class="form-control"
                                  placeholder="Enter a strong password" name="password" />
                          </div> --}}
                          <div class="col-sm-6 employee-input-col">
                              <label for="">First Name</label>
                              <input type="text" id="firstName" class="form-control"
                                  placeholder="Enter first name" name="first_name" />
                          </div>
                          <div class="col-sm-6 employee-input-col">
                              <label for="">Last Name</label>
                              <input type="text" id="lastName" class="form-control"
                                  placeholder="Enter last name" name="last_name" />
                          </div>
                          <div class="col-sm-6 employee-input-col">
                              <label for="">Email</label>
                              <input type="text" id="userEmail" class="form-control email-update-valid"
                                  oninput="checkUpdateEmail(event)" placeholder="Email address here" name="email" />
                          </div>
                          <div class="col-sm-6 employee-input-col">
                              <label for="">Designation</label>
                              <select class="form-select" name="designation" id="userDesignation">
                                  <option value="Sales">Sales</option>
                                  <option value="HR">HR</option>
                                  <option value="Engineer">Engineer</option>
                              </select>
                          </div>
                          <div class="col-sm-6 employee-input-col">
                              <label for="">Phone Number</label>
                              <input type="text" id="userPhone" class="form-control phone-update-valid" oninput="checkUpdatePhone(event)"
                                  placeholder="Phone Number here" name="phone" />
                          </div>
                          <div class="col-sm-6 employee-input-col">
                              <label for="">Status</label>
                              <select class="form-select" name="status" id="userStatus">
                                  <option value="1">Active</option>
                                  <option value="0">Inactive</option>
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="save-btn" style="cursor: pointer">
                      <button type="submit" class="btn save update-btn-status">Update</button>
                  </div>

              </form>
              </div>
          </div>
      </div>
  </div>
</div>

@include('user.components.employee')

@include('partials.footer')
  
@endsection

@section('script')


    <script>
      function modalClose() {
        $("#employeeAddModal").modal("hide");
      }
      function UpdateEmployeeModalClose(){
        $("#employeeUpdateModal").modal("hide");
      }
    </script>
    <script>
      $(document).ready(function () {
        const toggleButtons = document.querySelectorAll('.employee-action-button');
        toggleButtons.forEach(button => {
            button.addEventListener('click', function () {
                // $(this).next().toggleClass('display-toggle');
                var actionDiv = $(this).closest(".single-employee-div").find(".action-employee-div");
                actionDiv.toggleClass("display-toggle"); 
            });
        });
      })

      function openEditModalEmployee(id,first_name,last_name,user_name,email,password,phone,designation,status){
        $('#userId').val(id);
        $('#userName').val(user_name);
        // $('#userPassword').val(password);
        $('#firstName').val(first_name);
        $('#lastName').val(last_name);
        $('#userEmail').val(email);
        $('#userDesignation').val(designation);
        $('#userPhone').val(phone);
        $('#userStatus').val(status);

        $("#employeeUpdateModal").modal("show");
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
     var passwordvalid=false;
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

       if(emailValid && phoneValid && passwordvalid){
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
        if(emailValid && phoneValid && passwordvalid){
        $(".save-btn-status").attr("disabled", false);
       }else{
        $(".save-btn-status").attr("disabled", true);
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
          $('.password-valid').css('border','1px solid red')
       }else{
        $('.password-valid').css('border','1px solid #cdc8d4')
       }
        if(emailValid && phoneValid && passwordvalid){
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

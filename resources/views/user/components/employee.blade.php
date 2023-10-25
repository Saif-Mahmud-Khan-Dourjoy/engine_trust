<div class="modal fade" id="employeeAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content employee-add-modal">
            <div class="modal-header">
                <i class="fa-solid fa-xmark cross-btn-add-employee" onclick="modalClose()"></i>
            </div>
            <div class="modal-body">
                <div class="employee-modal-main-content">
                    <div class="employee-modal-title-div">Add Employee</div>
                    <form action="{{route('user.createEmployee')}}" method="POST">
                     @csrf
                   
                    <div class="employee-modal-input-div">
                        <div class="row">
                            <div class="col-sm-6 employee-input-col">
                                <label for="">User Name</label>
                                <input type="text" id="userName" class="form-control"
                                    placeholder="At least 6 character long" name="user_name" />
                            </div>
                            <div class="col-sm-6 employee-input-col">
                                <label for="">Password</label>
                                <input type="text" id="userPassword" class="form-control password-valid"
                                    placeholder="Enter a strong password" name="password"  oninput="validatePassword(event)" />
                                    <span class="text-danger" style="font-size: 8px;width:200px;display:inline-block" id="passwordMessage"></span>
                            </div>
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
                                <input type="text" id="userEmail" class="form-control email-valid"
                                    placeholder="Email address here" name="email"  oninput="checkEmail(event)" />
                            </div>
                            <div class="col-sm-6 employee-input-col">
                                <label for="">Designation</label>
                                <select class="form-select" name="designation" id="userDesignation">
                                    <option value="Sales" selected>Sales</option>
                                    <option value="HR">HR</option>
                                    <option value="Engineer">Engineer</option>
                                </select>
                            </div>
                            <div class="col-sm-6 employee-input-col">
                                <label for="">Phone Number</label>
                                <input type="text" id="userPhone" class="form-control phone-valid"
                                    placeholder="Phone Number here" name="phone"  oninput="checkPhone(event)" />
                            </div>
                            <div class="col-sm-6 employee-input-col">
                                <label for="">Status</label>
                                <select class="form-select" name="status" id="userStatus">
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="save-btn" style="cursor: pointer">
                        <button type="submit" class="btn save save-btn-status">Save</button>
                    </div>

                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="employee-div">
    <div class="employee-header">
        <div class="employee-header-text">Employee</div>
        <div style="cursor: pointer" class="employee-header-right" data-bs-toggle="modal" data-bs-target="#employeeAddModal" >
            <i class="fa-solid fa-plus"></i>
            <span>Add Employee</span>
        </div>
    </div>
    <div class="employee-main-content">
       @php  
        if(Auth::guard('web')->check()) {
            $employee=\App\Models\BusinessUser::where('user_id',Auth::guard('web')->user()->id)->get();
            
        }else{
            $employee=\App\Models\BusinessUser::where('user_id',Auth::guard('businessUser')->user()->user_id)->where('id','!=',Auth::guard('businessUser')->user()->id)->get();
            
        }
      
       @endphp 
        @foreach ($employee as $employee)
            
       
        <div class="single-employee-div">
            <div class="dot-div">
                <i class="fa-solid fa-ellipsis-vertical employee-action-button" style="cursor: pointer" ></i>
                
            </div>
            <div class="action-employee-div display-toggle" style="text-align:center;width:100px;position: absolute; right:20px;top:10px;padding:10px;box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;border-radius:5px">
                 <div style="cursor: pointer" onclick="openEditModalEmployee('<?php echo $employee->id ?>','<?php echo $employee->first_name ?>','<?php echo $employee->last_name ?>','<?php echo $employee->user_name ?>','<?php echo $employee->email ?>','<?php echo $employee->password ?>','<?php echo $employee->phone ?>','<?php echo $employee->designation ?>','<?php echo $employee->status ?>')">
                    Update
                 </div>
                 <div style="width: 100%;height:1px;background:gray;margin: 5px 0px"></div>
                 <div style="cursor: pointer">
                   <a style="text-decoration: none ; color:initial" href="{{route('user.deleteEmployee',$employee->id)}}">Delete</a> 
                 </div>
            </div>
            <div class="image-div">
                <div>
                    <img class="employee-image" src="{{$employee->img ? asset('image/user/companyUser/'.$employee->img) : asset('image/Photo.svg') }}" alt="" />
                </div>
                <i class="fa-solid fa-circle status-type-circle"></i>
            </div>
            <div class="name-div mt-3">
                <span>{{$employee->first_name.' '.$employee->last_name}}</span>
            </div>
            <div class="username-div mt-3">
                <span>Username: </span> <span>{{$employee->user_name}}</span>
            </div>
            <div class="info-div mt-3">
                <span>Type: </span> <span>{{$employee->designation}}</span> <br />
                <span>Trade Name: </span> <span>{{$employee->business->business_profile->trade_name}}</span> <br />
                <span- style="word-break: break-all">Email: </span><span>{{$employee->email}}</span> <br />
                <span>Phone: </span><span>{{$employee->phone}}</span> <br />
                <span>End Date: </span><span>{{date("d/m/Y",strtotime($employee->business->business_profile->expiry_date))}}</span>
            </div>
        </div>
        @endforeach
       
    </div>
</div>

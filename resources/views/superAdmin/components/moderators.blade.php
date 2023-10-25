<div class="modal fade" id="moderatorModal" tabindex="-1" aria-labelledby="moderatorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content moderator-add-modal">
            <div class="modal-header">
                <i class="fa-solid fa-xmark cross-btn-add-moderator" onclick="modalClose()"></i>
            </div>
            <div class="modal-body">
                <div class="moderator-modal-main-content">
                    <div class="moderator-modal-title-div" >Add New Moderator</div>
                    {{-- @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        </div>
                        <h3 class="title-2">&nbsp;</h3>
                    @endif --}}
                    <form action="{{route('superAdmin.createModerator')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="moderator-modal-input-div">
                        
                        <div class="row">
                            <div class="col-sm-6 moderator-input-col">
                                <label for="">First Name</label>
                                <input type="text"  class="form-control"
                                    placeholder="Enter Name" name="first_name" />
                            </div>
                            <div class="col-sm-6 moderator-input-col">
                                <label for="">Last Name</label>
                                <input type="text"  class="form-control"
                                    placeholder="Enter Name" name="last_name" />
                            </div>
                            <div class="col-sm-6 moderator-input-col">
                                <label for="">User name</label>
                                <input type="text"  class="form-control"
                                    placeholder="Enter User Name" name="user_name" />
                            </div>
                            <div class="col-sm-6 moderator-input-col">
                                <label for="">Email</label>
                                <input type="email"  class="form-control email-valid"
                                    placeholder="Enter Email" name="email" oninput="checkEmail(event)" />
                            </div>
                            <div class="col-sm-6 moderator-input-col">
                                <label for="">Phone Number</label>
                                <input type="text"  class="form-control phone-valid"
                                    placeholder="Enter Phone" name="phone"   oninput="checkPhone(event)" />
                            </div>
                            <div class="col-sm-6 moderator-input-col">
                                <label for="">Joining Date</label>
                                <input type="date"  class="form-control"
                                    placeholder="Email Joining Date" name="joining_date" />
                            </div>
                            <div class="col-sm-6">
                                <label for="">Image</label>
                                <input type="file"  class="form-control" name="img"
                                  />
                            </div>
                            <div class="col-12 moderator-input-col">
                                <label for="">Address</label>
                                <textarea name="address" id="" style="resize: none" class="form-control" rows="3"></textarea>
                                
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








<div class="moderator-div">
    <div class="moderator-header">
        <div class="moderator-header-left-div">
            Moderators
        </div>
        <div class="moderator-header-right-div" style="cursor: pointer">
            <i class="fa-solid fa-plus"></i>
            <span>Add Moderator</span>
        </div>
    </div>
    <div class="moderator-info-div">
        @php 
        use App\Models\Moderator;
         
         $moderators= Moderator::whereHas('moderator_profile')->get();
         
       @endphp
      @foreach ($moderators as $moderator)
          
      
        <div class="moderator-info-content"- style="position: relative">
            <div class="moderator-image-div moderator-common-flex-design">
                <img class="moderator-img" src="{{$moderator->moderator_profile->img? asset('image/moderator/'.$moderator->moderator_profile->img) : asset('image/avatar.png') }}" alt="">
            </div>
            <div class="name-div moderator-common-flex-design">
                {{$moderator->moderator_profile->user_name}}
            </div>
            <div class="designation-div moderator-common-flex-design">
                Moderator
            </div>
            <div class="email-div moderator-common">
                <span class="moderator-common-caption">Email :</span><span class="moderator-common-value" style="overflow-wrap: break-word">
                    {{$moderator->email}}</span>
            </div>
            <div class="phone-div moderator-common">
                <span class="moderator-common-caption">Phone :</span><span class="moderator-common-value">
                    {{$moderator->moderator_profile->phone}}</span>
            </div>
            <div class="address-div moderator-common">
                <span class="moderator-common-caption">Address :</span><span class="moderator-common-value"> {{$moderator->moderator_profile->address}}</span>
            </div>
            <div class="joined-div moderator-common" style="margin-bottom: 50px">
                <span class="moderator-common-caption">Joined from : </span><span class="moderator-common-value"> {{date("F d, Y",strtotime($moderator->moderator_profile->joining_date))}}</span>
            </div>
            <div class="moderator-btn-div" style="position: absolute; bottom:10px">
                <a style="text-decoration: none ; color:initial" href="{{route('superAdmin.deleteModerator',$moderator->id)}}"> <button class="btn btn-outline-danger" style="cursor: pointer">Remove</button> </a>
                <button class="btn btn-outline-success" style="cursor: pointer" onclick="openEditModalModerator('<?php echo $moderator->id ?>','<?php echo $moderator->moderator_profile->first_name ?>','<?php echo $moderator->moderator_profile->last_name ?>','<?php echo $moderator->moderator_profile->user_name ?>','<?php echo $moderator->email ?>','<?php echo $moderator->moderator_profile->phone ?>','<?php echo $moderator->moderator_profile->joining_date ?>','<?php echo $moderator->moderator_profile->address ?>')">Edit</button>
            </div>
        </div>

        @endforeach 
        

    </div>
</div>

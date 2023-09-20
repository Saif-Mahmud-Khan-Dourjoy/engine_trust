

<div class="enquiry">
    <div class="enquiry-header">
        <div class="enquiry-header-div">
            <h4>Recent Enquires</h4>
        </div>
        <div class="see-more-div" style="cursor: pointer">
           <a href="{{route('superAdmin.enquiry')}}" style="color:inherit;text-decoration:none"><span class="see-more-text">See more</span>
            <i class="fa-solid fa-arrow-right-long"></i></a> 
        </div>
    </div>

    <div class="table-header">
        <div class="name">
            Name
        </div>
        <div class="date_time">
            Date & Time
        </div>
        <div class="ref">
            Ref No.
        </div>
        <div class="request_details">
            Request Details
        </div>
        <div class="engine_code">
            Engine Code
        </div>
        <div class="location">
            Location
        </div>

    </div>
    @php 
    use App\Models\Enquiry;
     
     $enquiry= Enquiry::orderBy('id','DESC')->take(4)->get();
  
     
   @endphp
   @foreach($enquiry as $item)
    <div class="table-value">
        <div class="name table-single-value">
            <span>{{$item->car_model." ".$item->car_reg_year}}</span>
            <span style="cursor:pointer" class="badge bg-warning badge-style " onclick="getFullInfo('<?php echo $item->reg_num; ?>')">{{$item->reg_num}}</span>
        </div>
        <div class="date_time table-single-value">
            <span>{{date('M d, Y \a\t h:i A',strtotime($item->created_at))}}</span>
        </div>
        <div class="ref table-single-value">
            <span>{{$item->ref_no}}</span>
        </div>
        <div class="request_details table-single-value">
            <span>{{$item->request_part}}</span>
        </div>
        <div class="engine_code table-single-value">
            <span>{{$item->engine_code}}</span>
        </div>
        <div class="location table-single-value">
            <span>{{$item->address}}</span>
        </div>
    
    </div>
    @endforeach
   


</div>

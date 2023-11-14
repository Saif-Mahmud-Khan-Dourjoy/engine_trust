<div class="common-user-enquiry table-value">
    <div class="name table-single-value common-user-enquiry-name">
        <input type="checkbox" id="enquiry_checkbox-{{$item->id}}" class="enquiry_checkbox" value="{{$item->id}}" name="enquery[]" />
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
    <div class="action table-single-value">
        <button class="btn btn-success" onclick="openQuoteModal('<?php echo $item->id; ?>')">Send Quote</button>
        <i style="cursor: pointer;" class="fa-solid fa-ellipsis-vertical action-main-button-to-click enquiry-action-button" onclick="toggleActionEnquiry(event)"></i>
        <div class="action-btn-div display-toggle-enquiry">
            <div class="action-btn-element">
                <div style="cursor: pointer" class="edit" onclick="hideEnquiry('<?php echo $item->id; ?>')">Hide</div>
                <div style="cursor: pointer" class="delete" onclick="deleteEnquiry('<?php echo $item->id; ?>')">Delete</div>
            </div>
        </div>
    </div>
</div>

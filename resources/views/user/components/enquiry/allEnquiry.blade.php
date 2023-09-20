<div class="common-user-enquiry table-value">
    <div class="name table-single-value common-user-enquiry-name">
        <input type="checkbox" id="name_checkbox1" name="name_checkbox_value[]" />
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
        <i class="fa-solid fa-ellipsis-vertical action-main-button-to-click"></i>
        <div class="action-btn-div">
            <div class="action-btn-element">
                <div class="edit">Hide</div>
                <div class="delete">Delete</div>
            </div>
        </div>
    </div>
</div>

<div class="table-value common-quote">
    <div class="name table-single-value">
        <input type="checkbox" id="quote_checkbox-{{ $item->id }}" name="quote[]" class="quote_checkbox"
            value="{{ $item->id }}" />
        <span>{{ $item->enquiry->car_model . ' ' . $item->enquiry->car_reg_year }}</span>
        <span style="cursor:pointer" class="badge bg-warning badge-style "
            onclick="getFullInfo('<?php echo $item->enquiry->reg_num; ?>')">{{ $item->enquiry->reg_num }}</span>
    </div>
    <div class="date_time table-single-value" style="padding-left:5px">
        <span>{{ date('M d, Y \a\t h:i A', strtotime($item->enquiry->created_at)) }}</span>
    </div>
    <div class="ref table-single-value">
        <span>{{ $item->enquiry->ref_no }}</span>
    </div>
    <div class="request_details table-single-value">
        <span>{{ $item->enquiry->request_part }}</span>
    </div>
    <div class="engine_code table-single-value">
        <span>{{ $item->enquiry->engine_code }}</span>
    </div>
    <div class="location table-single-value">
        <span>{{ $item->enquiry->address }}</span>
    </div>
    <div class="action table-single-value">
        <i style="cursor: pointer;" class="fa-solid fa-ellipsis-vertical action-main-button-to-click quote-action-button"
            onclick="toggleActionQuote(event)"></i>
        <div class="action-btn-div display-toggle-common">
            <div class="action-btn-element">
                <div style="cursor: pointer" class="edit" onclick="viewQuote('<?php echo $item->id; ?>')">View Quotes</div>
                <div style="cursor: pointer" class="delete" onclick="invoiceQuote('<?php echo $item->id; ?>')">Invoice</div>
                <div style="cursor: pointer" class="delete">{{$item->email_status===1? "Email opened" : "Email not opened" }} </div>
                <div style="cursor: pointer" class="edit" onclick="hideQuote('<?php echo $item->id; ?>')">Hide</div>
                <div style="cursor: pointer" class="issue" onclick="issue('<?php echo $item->enquiry->id; ?>')">Car Issue</div>
            </div>
        </div>
    </div>
</div>



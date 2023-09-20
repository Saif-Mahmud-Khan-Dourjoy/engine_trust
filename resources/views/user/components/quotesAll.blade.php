<div class="table-value common-quote">
    <div class="name table-single-value">
      <input
        type="checkbox"
        id="name_checkbox1"
        name="name_checkbox_value[]"
      />
      <span>{{$item->enquiry->car_model." ".$item->enquiry->car_reg_year}}</span>
    </div>
    <div class="date_time table-single-value">
      <span>{{date('M d, Y \a\t h:i A',strtotime($item->enquiry->created_at))}}</span>
    </div>
    <div class="ref table-single-value">
      <span>{{$item->enquiry->ref_no}}</span>
    </div>
    <div class="request_details table-single-value">
      <span>{{$item->enquiry->request_part}}</span>
    </div>
    <div class="engine_code table-single-value">
      <span>{{$item->enquiry->engine_code}}</span>
    </div>
    <div class="location table-single-value">
      <span>{{$item->enquiry->address}}</span>
    </div>
    <div class="action table-single-value">
      <i class="fa-solid fa-ellipsis-vertical action-main-button-to-click"></i>
      <div class="action-btn-div" style="width: 150px !important; right: 45px !important;">
        <div class="action-btn-element">
          <div class="edit">View Quote</div>
          <div class="delete">Invoice</div>
          <div class="edit">Email opened</div>
          <div class="delete">Hide</div>
        </div>
      </div>
    </div>
  </div>
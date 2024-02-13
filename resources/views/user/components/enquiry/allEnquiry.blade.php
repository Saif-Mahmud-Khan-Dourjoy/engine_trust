<div class="common-user-enquiry table-value">
    <div class="name table-single-value common-user-enquiry-name">
        <input type="checkbox" id="enquiry_checkbox-{{ $item->id }}" class="enquiry_checkbox"
            value="{{ $item->id }}" name="enquery[]" />
        <span>{{ $item->car_model . ' ' . $item->car_reg_year }}</span>
        <span style="cursor:pointer" class="badge bg-warning badge-style "
            onclick="getFullInfo('<?php echo $item->reg_num; ?>')">{{ $item->reg_num }}</span>
    </div>
    <div class="date_time table-single-value">
        <span>{{ date('M d, Y \a\t h:i A', strtotime($item->created_at)) }}</span>
    </div>
    <div class="ref table-single-value">
        <span>{{ $item->ref_no }}</span>
    </div>
    <div class="request_details table-single-value">
        <span>{{ $item->request_part }}</span>
    </div>
    <div class="engine_code table-single-value">
        <span>{{ $item->engine_code }}</span>
    </div>
    <div class="location table-single-value">
        <span>{{ $item->address }}</span>
    </div>
    @if (Auth::guard('web')->check())
        @php
            $business_profile = Auth::guard('web')->user()->business_profile;
            $subscribed_till = $business_profile->subscribed_till;
        @endphp
    @else
        @php
            $business_profile = Auth::guard('businessUser')->user()->business->business_profile;
            $subscribed_till = $business_profile->subscribed_till;
        @endphp
    @endif
    @php

        use Carbon\Carbon;
        $s_t_t = Carbon::parse($subscribed_till)->getTimestampMs();
        $c_t_t = Carbon::now()->getTimestampMs();

    @endphp

    @if ($s_t_t > $c_t_t)
        <div class="action table-single-value">
            <button class="btn btn-success" onclick="openQuoteModal('<?php echo $item->id; ?>')">Send Quote</button>
            <i style="cursor: pointer;margin-left: 10px"
                class="fa-solid fa-ellipsis-vertical action-main-button-to-click enquiry-action-button"
                onclick="toggleActionEnquiry(event)"></i>
            <div class="action-btn-div display-toggle-common" style="">
                <div class="action-btn-element">
                    <div style="cursor: pointer" class="edit" onclick="hideEnquiry('<?php echo $item->id; ?>')">Hide</div>
                    <div style="cursor: pointer" class="delete" onclick="deleteEnquiry('<?php echo $item->id; ?>')">Delete
                    </div>
                    <div style="cursor: pointer" class="issye" onclick="issue('<?php echo $item->id; ?>')">Car Issue</div>

                </div>
            </div>
        </div>
   @else
   <div class="action table-single-value" >
    <button class="btn btn-success" disabled>Send Quote</button>
</div> 
   @endif     
</div>

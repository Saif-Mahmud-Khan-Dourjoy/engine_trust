
<div class="table-value hidden-common">
    <div class="name table-single-value">
        <span>{{ $item->business_profile['business_name'] }}</span>
    </div>
    <div class="date_time table-single-value">
        <span>{{ $item->business_profile['business_type'] }}</span>
    </div>
    <div class="ref table-single-value">
        <span>{{ \Illuminate\Support\Str::limit($item['email'], 20) }}</span>
    </div>
    <div class="request_details table-single-value">
        <span>{{ $item->business_profile['vat_no'] }}</span>
    </div>
    <div class="engine_code table-single-value">

        <span>45</span>
    </div>
    <div class="location table-single-value">
        <span>{{ $item->business_profile['city'] }}</span>
    </div>

    <div class="action table-single-value" style="margin-right:5px">
        <i style="cursor: pointer;" class="fa-solid fa-ellipsis-vertical action-main-button-to-click job-action-button"
            onclick="toggleActionJob(event)"></i>
        <div class="invoice-action action-btn-div display-toggle-common">
            <div class="action-btn-element">

                <div style="cursor: pointer" class="delete" onclick="companyDetails('<?php echo $item->business_profile->id; ?>','invoice')">
                    Details
                </div>

            </div>
        </div>
    </div>
</div>
{{-- <div class="table-value hidden-common">
    <div class="name table-single-value">
        <span>a</span>
      </div>
      <div class="date_time table-single-value">
        <span>v</span>
      </div>
      <div class="ref table-single-value">
        <span>c</span>
      </div>
      <div class="request_details table-single-value">
        <span>t</span>
      </div>
      <div class="engine_code table-single-value">
      
        <span>45</span>
      </div>
      <div class="location table-single-value">
        <span>y</span>
      </div>
      <div class="action table-single-value">
        <i class="fa-solid fa-ellipsis-vertical"></i>
      </div>
    </div> --}}

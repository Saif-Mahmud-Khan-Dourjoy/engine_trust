{{-- {{ $item }} --}}
<div class="table-value">

    <div class="name table-single-value">

        <span>{{ $item->quote->enquiry->car_model }}</span>
    </div>
    <div class="date_time table-single-value">
        {{ $item->description }}
    </div>
    <div class="ref table-single-value">
        <span>{{ $item->generated_invoice_no }}</span>
    </div>
    <div class="request_details table-single-value">
        <span>{{ $item->total_price }}</span>
    </div>
    <div class="status table-single-value">
        <span>{{ $item->paid_amount }}</span>
    </div>

    <div class="action table-single-value">
        <span>{{ $item->due_amount }}</span>
    </div>
    <div class="action table-single-value" style="margin-right:5px">
        <i style="cursor: pointer;" class="fa-solid fa-ellipsis-vertical action-main-button-to-click job-action-button"
            onclick="toggleActionJob(event)"></i>
        <div class="invoice-action action-btn-div display-toggle-common">
            <div class="action-btn-element">

                <div style="cursor: pointer" class="delete" onclick="invoiceDownload('<?php echo $item->id; ?>')">
                    Invoice
                </div>

            </div>
        </div>
    </div>
</div>

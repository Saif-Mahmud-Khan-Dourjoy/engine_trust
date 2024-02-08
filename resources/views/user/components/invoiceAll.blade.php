

  <div class="table-value">

      <div class="name table-single-value">
         
          <span>{{ $item->quote->enquiry->car_model}}</span>
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
      <div class="status table-single-value" >
        <span>{{ $item->paid_amount }}</span>
      </div>

      <div class="action table-single-value">
        <span>{{ $item->due_amount }}</span>
      </div>
  </div>

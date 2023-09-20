<div class="company-details-div">
      <div class="header">
         Company details
      </div>
      <div class="company-info">
        <p>Business name: <span>{{$company_details->business_profile->business_name}} </span></p>
        <p>Business type: <span>{{$company_details->business_profile->business_type}} </span></p>
        <p>Email Address: <span>{{$company_details->email}}</span></p>
        <p>Street Address: <span>{{$company_details->business_profile->address}}</span></p>
        <p>Phone Number: <span>{{$company_details->business_profile->primary_phone}} </span></p>
        <p>VAT number: <span>{{$company_details->business_profile->vat_no}} </span></p>
        <p>Quoting person name: <span>{{$company_details->business_profile->quoting_person_name}}</span></p>
        <p>Sent Quotes: <span>{{$quote_sent}} </span></p>
        <p>Rejected Quotes: <span class="text-danger">{{$quote_rejected}}</span></p>
        <p>Subscription date: <span>{{date('n/j/y',strtotime($company_details->business_profile->subscribed_at))}} </span></p>
        <p class="text-danger">Expiry date: <span class="text-danger">{{date('n/j/y',strtotime($company_details->business_profile->expiry_date))}}</span></p>
      </div>
</div>
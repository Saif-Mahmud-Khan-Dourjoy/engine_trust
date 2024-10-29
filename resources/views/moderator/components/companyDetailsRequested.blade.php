<div class="company-details-div" style="padding: 15px ; margin-top:20px">
    <div class="header" style="font-size: 20px; font-weight: bold; ">
        Company details
    </div>
    <div class="company-info" style="margin-top: 10px">
        <p>Business name: <span>{{ $company_details->business_profile->business_name }} </span></p>
        <p>Business type: <span>{{ $company_details->business_profile->business_type }} </span></p>
        <p>Email Address: <span>{{ $company_details->email }}</span></p>
        <p>Street Address: <span>{{ $company_details->business_profile->address }}</span></p>
        <p>Phone Number: <span>{{ $company_details->business_profile->primary_phone }} </span></p>
        <p>VAT number: <span>{{ $company_details->business_profile->vat_no }} </span></p>
        <p>Quoting person name: <span>{{ $company_details->business_profile->quoting_person_name }}</span></p>
        <p>Subscription date:
            <span>{{ $company_details->business_profile->subscribed_at ? date('n/j/y', strtotime($company_details->business_profile->subscribed_at)) : 'Not Subscribed Yet' }}
            </span>
        </p>
        <p class="text-danger">Expiry date: <span
                class="text-danger">{{ $company_details->business_profile->expiry_date ? date('n/j/y', strtotime($company_details->business_profile->expiry_date)) : 'Not Subscribed Yet' }}</span>
        </p>
    </div>
</div>

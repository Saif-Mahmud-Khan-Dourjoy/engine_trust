<div class="company-details-div">
    <div class="header">
        Company details
    </div>

    <div class="company-info">
        <p>Business name: <span>{{ $company_details->business_profile->business_name }} </span></p>
        <p>Business type: <span>{{ $company_details->business_profile->business_type }} </span></p>
        <p>Email Address: <span>{{ $company_details->email }}</span></p>
        <p>Street Address: <span>{{ $company_details->business_profile->address }}</span></p>
        <p>Phone Number: <span>{{ $company_details->business_profile->primary_phone }} </span></p>
        <p>VAT number: <span>{{ $company_details->business_profile->vat_no }} </span></p>
        <p>Quoting person name: <span>{{ $company_details->business_profile->quoting_person_name }}</span></p>
        <p>Sent Quotes: <span>{{ $quote_sent }} </span></p>
        <p>Rejected Quotes: <span class="text-danger">{{ $quote_rejected }}</span></p>
        <p>Subscription date: <span>{{ date('n/j/y', strtotime($company_details->business_profile->subscribed_at)) }}
            </span></p>
        <p class="text-danger">Expiry date: <span
                class="text-danger">{{ date('n/j/y', strtotime($company_details->business_profile->expiry_date)) }}</span>
        </p>
    </div>
    <div style="margin-top: 20px"> <a class="btn btn-info text-white" style="cursor: pointer; font-weight:bold"
            href="{{ route('superAdmin.impersonate', ['guard' => 'web', 'id' => $company_details->id]) }}"> Take
            access of this user </a> </div>
    <div style="margin-top: 20px">
        <div style="font-weight:600; font-size:18px;margin-bottom:10px">Update Membership</div>
        <form id="" action="{{ route('superAdmin.updateMembership') }}" method="POST">
            @csrf
            <div>
                <label for="" style="font-size: 16px; font-weight: 500;margin-bottom: 5px">Write Remark</label>
                <textarea type="text" rows="4" placeholder="Remark" name="remark" class="form-control"
                    style="border: 1px solid green; width:310px"></textarea>
            </div>
            <div style="display: flex; gap:10px; align-items:center ; margin-top: 10px">

                <div>
                    <input style="border: 1px solid green" name="day" class="form-control" type="text"
                        placeholder="write days">
                    <input name="id" value={{ $company_details->business_profile->id }} class="form-control"
                        type="hidden" placeholder="write days">
                </div>
                <div>
                    <button class="btn btn-outline-success" type="submit">Update</button>
                </div>


            </div>
        </form>
    </div>
</div>

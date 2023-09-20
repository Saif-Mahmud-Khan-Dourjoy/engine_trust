@php
    use Illuminate\Support\Str;
@endphp
<div class="table-value hidden-common">
  
    <div class="name table-single-value">
      <span>{{$item->business_profile['business_name']}}</span>
    </div>
    <div class="date_time table-single-value">
      <span>{{$item->business_profile['business_type']}}</span>
    </div>
    <div class="ref table-single-value">
      <span>{{ \Illuminate\Support\Str::limit($item['email'], 20 ) }}</span>
    </div>
    <div class="request_details table-single-value">
      <span>{{$item->business_profile['vat_no']}}</span>
    </div>
    <div class="location table-single-value">
      <span>{{$item->business_profile['city']}}</span>
    </div>
    <div class="action table-single-value">
      <a href="{{route('moderator.company.decline',$item->business_profile->id)}}" style="text-decoration: none; color:inherit"><button class="btn btn-outline-danger">Decline</button></a> 
      <a href="{{route('moderator.company.approve',$item->business_profile->id)}}" style="text-decoration: none; color:inherit"> <button class="btn btn-outline-success">Approve</button></a>
    </div>
</div> 
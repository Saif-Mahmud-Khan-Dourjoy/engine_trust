<a href="{{route('superAdmin.companyDetails',$item->id)}}" style="color: inherit;text-decoration:none"> <div class="table-value hidden-common">
    <div class="name table-single-value">
      <span class="text-success">{{$item->business_profile['business_name']}}</span>
    </div>
    
    <div class="type table-single-value">
      <span>{{$item->business_profile['business_type']}}</span>
    </div>
    <div class="email table-single-value">
      <span>{{ \Illuminate\Support\Str::limit($item['email'], 15) }}</span>
    </div>
    <div class="engine_code table-single-value">
    
      <span>{{$quote}}</span>
    </div>
    <div class="location table-single-value">
      <span>{{$item->business_profile['city']}}</span>
    </div>
    <div class="subscribed table-single-value">
      <span>{{date('n/j/y',strtotime($item->business_profile['subscribed_at']))}}</span>
    </div>
    <div class="expiry table-single-value">
      <span class="text-danger">{{date('n/j/y',strtotime($item->business_profile['subscribed_till']))}}</span>
    </div>
    <div class="accepted_by table-single-value">
      <span>{{$moderator_user_name}}</span>
    </div>
    <div class="action table-single-value">
      <i class="fa-solid fa-ellipsis-vertical"></i>
    </div>
</div> 
</a>

   
  

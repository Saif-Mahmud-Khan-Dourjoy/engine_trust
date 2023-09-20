<div class="timeline-count-parent">
  <div class="timeline-count">
    
      @foreach ($loginTime as $key => $item)
          <div class="monday-div timeline-day-common-style">
              <div class="name_number-div timeline-name-number-common-style">
                  <div>{{ count($item) }}</div>
                  <div>{{ date('l', strtotime($key)) }}</div>
              </div>
            @if(count($item)>0)
             @foreach ($item as $time)
                 
             
              <div class="timeline-time-div">
                  <div class="exect-time">{{date("h:i A", strtotime($time))}}</div>
                  <div class="action">
                      <span>Action:</span> <span class="action_type">Login</span>
                  </div>
              </div>
              @endforeach
            @endif  
              
          </div>
      @endforeach
     
  </div>
</div>

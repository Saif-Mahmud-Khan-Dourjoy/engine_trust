<div class="timeline-div">
<div class="timeline-header-div">
  <div class="timeline-header-left-div">
    <h4>Login Timeline</h4>
  </div>
  <div class="timeline-header-middle-div">
    <i class="fa-solid fa-arrow-left"></i>
    <span class="today">Today</span>
    <i class="fa-solid fa-arrow-right"></i>
  </div>
  <div class="timeline-header-right-div">
    @php
    $count=0;
    foreach ($loginTime as $key => $value) {
      // Check if the element is an array
      if (is_array($value)) {
          // If it's an array, add its count to the total count
          $count += count($value);
      } 
  }
  
  
  @endphp
    <span>Total Login Count:</span> <span>{{$count}}</span>
  </div>
</div>
 @include('moderator.components.loginTimeline')
</div>
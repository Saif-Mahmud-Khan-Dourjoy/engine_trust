<div class="table-value">
    <div class="name table-single-value">
        <span>{{$item->car_model." ".$item->car_reg_year}}</span>
        <span style="cursor:pointer" class="badge bg-warning badge-style " onclick="getFullInfo('<?php echo $item->reg_num; ?>')">{{$item->reg_num}}</span>
    </div>
    <div class="date_time table-single-value">
        <span>{{date('M d, Y \a\t h:i A',strtotime($item->created_at))}}</span>
    </div>
    <div class="ref table-single-value">
        <span>{{$item->ref_no}}</span>
    </div>
    <div class="request_details table-single-value">
        <span>{{$item->request_part}}</span>
    </div>
    <div class="engine_code table-single-value">
        <span>{{$item->engine_code}}</span>
    </div>
    <div class="location table-single-value">
        <span>{{$item->address}}</span>
    </div>

</div>
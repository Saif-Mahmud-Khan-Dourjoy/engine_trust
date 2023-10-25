@php
    use App\Models\Quote;
    use App\Models\User;
    use Carbon\Carbon;
    
    $currentYear = Carbon::now()->year;
    
    $quoteDetails = Quote::whereYear('created_at', $currentYear)
        ->whereMonth('created_at', '>=', now()->subMonths(1))
        ->selectRaw('DATE_FORMAT(created_at, "%M") as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->toArray();
    
    $companyDetails = User::whereYear('created_at', $currentYear)
        ->whereMonth('created_at', '>=', now()->subMonths(1))
        ->selectRaw('DATE_FORMAT(created_at, "%M") as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->toArray();
    
    $lastTwoMonths = [];
    $currentMonth = Carbon::now();
    $lastTwoMonths[] = $currentMonth->format('F');
    $currentMonth->subMonth();
    $lastTwoMonths[] = $currentMonth->format('F');
    
    $lastTwoMonthWithCount = [];
    foreach ($lastTwoMonths as $key => $val) {
        $lastTwoMonthWithCount[$val]['quoteCount'] = 0;
        $lastTwoMonthWithCount[$val]['companyCount'] = 0;
    }
    
    foreach ($quoteDetails as $key => $val) {
        $lastTwoMonthWithCount[$val['month']]['quoteCount'] = $val['count'];
    }
    foreach ($companyDetails as $key => $val) {
        $lastTwoMonthWithCount[$val['month']]['companyCount'] = $val['count'];
    }
    
    // dd($lastTwoMonthWithCount);
    
@endphp
<div class="total-count-div">
    @foreach ($lastTwoMonthWithCount as $key => $val)
        
            <div class="single-count-div">
                <span> Total Quotes for {{substr($key, 0, 3)}} </span>
                <span>{{ $val['quoteCount']}}  </span>
            </div>
            <div class="single-count-div">
                <span> New companies for {{substr($key, 0, 3)}} </span>
                <span> {{ $val['companyCount']}}</span>
            </div>
        
    @endforeach
    {{-- <div class="single-count-div">
      <span> Total Quotes for June </span>
      <span> 10 </span>
    </div>
    <div class="single-count-div">
      <span> New companies for June</span>
      <span> 100 </span>
    </div> --}}
</div>

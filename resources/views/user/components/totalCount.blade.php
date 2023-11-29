@php
    use App\Models\Quote;
    use Carbon\Carbon;
    if (Auth::guard('web')->check()) {
        $userId = Auth::guard('web')->user()->id;
    }
    if (Auth::guard('businessUser')->check()) {
        $userId = Auth::guard('businessUser')->user()->user_id;
    }
    $currentYear = Carbon::now()->year;
    
    $quotationsWithInvoiceSum = Quote::leftJoin('invoices', 'quotes.id', '=', 'invoices.quote_id')
        ->whereYear('quotes.created_at', $currentYear)
        ->where('quoted_company_by', $userId)
        ->whereMonth('quotes.created_at', '>=', now()->subMonths(1))
        ->selectRaw('DATE_FORMAT(quotes.created_at, "%M") as month, COUNT(*) as count, SUM(invoices.total_price) as total')
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->toArray();
    
    $quotationsWithInvoiceSumForJob = Quote::leftJoin('invoices', 'quotes.id', '=', 'invoices.quote_id')
        ->whereYear('quotes.created_at', $currentYear)
        ->where('quoted_company_by', $userId)
        ->where('quotes.job', 1)
        ->whereMonth('quotes.created_at', '>=', now()->subMonths(1))
        ->selectRaw('DATE_FORMAT(quotes.created_at, "%M") as month, COUNT(*) as count, SUM(invoices.total_price) as total')
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->toArray();
    
    $lastTwoMonths = [];
    $currentMonth = Carbon::now();
    $lastTwoMonths[] = $currentMonth->format('F');
    $currentMonth->subMonth();
    $lastTwoMonths[] = $currentMonth->format('F');

    $lastTwoMonthWithQuote=[];
    foreach($lastTwoMonths as $key=>$val){
      $lastTwoMonthWithQuote[$val]['count']=0;
      $lastTwoMonthWithQuote[$val]['total']=0;
    };

    $lastTwoMonthWithJob=[];
    foreach($lastTwoMonths as $key=>$val){
      $lastTwoMonthWithJob[$val]['count']=0;
      $lastTwoMonthWithJob[$val]['total']=0;
    };

    foreach($quotationsWithInvoiceSum as $key => $val){
      $lastTwoMonthWithQuote[$val['month']]['count']=$val['count'];
      $lastTwoMonthWithQuote[$val['month']]['total']=$val['total'];
    }
    foreach($quotationsWithInvoiceSumForJob as $key => $val){
      $lastTwoMonthWithJob[$val['month']]['count']=$val['count'];
      $lastTwoMonthWithJob[$val['month']]['total']=$val['total'];
    }
    
    // dd($lastTwoMonthWithJob);
    
@endphp

<div class="total-count-div-two">
    <div class="quote-value-count">
      @foreach($lastTwoMonthWithQuote as $key => $val)
        <div class="quote-value-single-div">
            <div class="single-count-div-two">
                <span> Total Quotes for {{substr($key, 0, 3)}} </span>
                <span> {{$val['count']}} </span>
            </div>
            <div class="single-count-div-two">
                <span> Quoted value for {{substr($key, 0, 3)}} </span>
                <span> {{$val['total']}} </span>
            </div>
        </div>
        @endforeach
        {{-- <div class="quote-value-single-div">
            <div class="single-count-div-two count-active">
                <span> Total Quotes for May </span>
                <span> 10 </span>
            </div>
            <div class="single-count-div-two">
                <span> Quoted value for May </span>
                <span> 10 </span>
            </div>
        </div> --}}
    </div>
    <div class="quote-value-count">
      @foreach($lastTwoMonthWithJob as $key => $val)
        <div class="quote-value-single-div">
            <div class="single-count-div-two">
                <span> Total Quotes for {{substr($key, 0, 3)}} </span>
                <span> {{$val['count']}} </span>
            </div>
            <div class="single-count-div-two">
                <span> Quoted value for {{substr($key, 0, 3)}} </span>
                <span> {{$val['total']}} </span>
            </div>
        </div>
        @endforeach
        {{-- <div class="quote-value-single-div">
            <div class="single-count-div-two count-active">
                <span> Total Quotes for May </span>
                <span> 10 </span>
            </div>
            <div class="single-count-div-two">
                <span> Quoted value for May </span>
                <span> 10 </span>
            </div>
        </div> --}}
    </div>
    {{-- <div class="quote-value-count">
    <div class="">
     <div class="single-count-div count-active">
       <span> Total Quotes for May </span>
       <span> 10 </span>
     </div>
     <div class="single-count-div">
       <span> Quoted value for May </span>
       <span> 10 </span>
     </div>
    </div>
    <div>
     <div class="single-count-div count-active">
       <span> Total Quotes for May </span>
       <span> 10 </span>
     </div>
     <div class="single-count-div">
       <span> Quoted value for May </span>
       <span> 10 </span>
     </div>
    </div>
  </div> --}}

    {{-- <div class="single-count-div">
      <span> Total Quotes for June </span>
      <span> 10 </span>
    </div>
    <div class="single-count-div">
      <span> Quoted value for June</span>
      <span> 100 </span>
    </div>
    <div class="single-count-div count-active">
      <span> My Jobs for September </span>
      <span> 10 </span>
    </div>
    <div class="single-count-div">
      <span> My Jobs value for September </span>
      <span> 10 </span>
    </div>
    <div class="single-count-div">
      <span> My Jobs for October </span>
      <span> 10 </span>
    </div>
    <div class="single-count-div">
      <span> My Jobs value for October</span>
      <span> 100 </span>
    </div> --}}
</div>

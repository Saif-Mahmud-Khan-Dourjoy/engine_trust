@php
use App\Models\Quote;
use Carbon\Carbon;
if (Auth::guard('web')->check()) {
            $userId = Auth::guard('web')->user()->id;
        }  
        if (Auth::guard('businessUser')->check()) { 
            $userId = Auth::guard('businessUser')->user()->user_id;
        }
$quotationsWithInvoiceSum = quote::leftJoin('invoices', 'quotes.id', '=', 'invoices.quote_id')
    ->whereYear('quotes.created_at', Carbon::now()->year)
    ->whereMonth('quotes.created_at', Carbon::now()->month) // Filter by the current month
    ->where('quoted_company_by', $userId)
    ->selectRaw('DATE_FORMAT(quotes.created_at, "%M") as month, COUNT(quotes.id) as count, SUM(invoices.total_price) as total')
    ->groupBy('month')
    ->orderBy('month')
    ->get()->toArray();

// dd($quotationsWithInvoiceSum)
@endphp


<div class="donut-chart-div">
    <div class="donut-chart-parent">
      <div class="donut-chart">
        <div class="single-chart">
          <svg viewBox="0 0 36 36" class="circular-chart green">
            <path
              class="circle-bg"
              d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831"
            />
            <path
              class="circle"
              stroke-dasharray="30, 100"
              d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831"
            />
            <text x="18" y="20.35" class="percentage">{{!empty($quotationsWithInvoiceSum) ? $quotationsWithInvoiceSum[0]['total']:0 }}</text>
          </svg>
        </div>
      </div>
      <div class="donut-chart-text">
        <div class="chart-text-upper">
          <span class="dot"></span>
          <span class="chart-text-total">Total Quotes for {{Carbon::now()->format('F')}}</span>
        </div>
        <div class="chart-text-number">{{!empty($quotationsWithInvoiceSum) ? $quotationsWithInvoiceSum[0]['count']:0}}</div>
        <div class="chart-text-bottom">
          <span class="empty-div"></span>
          <span class="chart-text-value">Quote value for {{Carbon::now()->format('F')}}</span>
        </div>
      </div>
    </div>
  </div>
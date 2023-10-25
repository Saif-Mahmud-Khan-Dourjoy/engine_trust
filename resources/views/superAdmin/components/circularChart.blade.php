@php
use App\Models\User;
use Carbon\Carbon;

$companyCount = User::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->month) // Filter by the current month
    ->groupBy('created_at')
    ->orderBy('created_at')
    ->count();

// dd($companyCount)
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
            <text x="18" y="20.35" class="percentage">{{$companyCount>0?$companyCount:0}}</text>
          </svg>
        </div>
      </div>
      <div class="donut-chart-text">
        <div class="chart-text-upper">
          <span class="dot"></span>
          <span class="chart-text-total">New Companies for {{Carbon::now()->format('F')}}</span>
        </div>
        <div class="chart-text-number">{{$companyCount>0?$companyCount:0}}</div>
        <div class="chart-text-bottom">
          <span class="empty-div"></span>
          <span class="chart-text-value">New companies for {{strtolower(Carbon::now()->format('F'))}}</span>
        </div>
      </div>
    </div>
  </div>
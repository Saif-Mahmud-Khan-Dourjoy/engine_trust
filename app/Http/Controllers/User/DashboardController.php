<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\AllLoginTimeline;
use App\Models\Quote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (Auth::guard('web')->check()) {
            $UserId = Auth::guard('web')->user()->id;
            $loginTimeline = AllLoginTimeline::where('user_id', $UserId)
                ->whereDate('created_at', '>=', now()->subDays(6))
                ->orderBy('created_at')
                ->get();

            $groupedLoginTimeline = $loginTimeline->groupBy(function ($loginTimeline) {
                return $loginTimeline->created_at->format('Y-m-d'); // Group by date
            });
            $dateTime = [];
            foreach ($groupedLoginTimeline as $d => $loginTimeline) {
                // echo "Date: $date\n";
                $date = $d;
                $i = 0;
                foreach ($loginTimeline as $loginTimeline) {
                    $dateTime[$date][$i] = $loginTimeline->created_at->format('H:i');
                    $i++;
                }
            }

            $numberOfDays = 7;
            $dates = array();

            for ($i = 0; $i < $numberOfDays; $i++) {
                $date = date('Y-m-d', strtotime("-$i days"));
                $dates[] = $date;
            }

            $loginTime = [];

            foreach ($dates as $d) {
                if (isset($dateTime[$d])) {
                    $loginTime[$d] = $dateTime[$d];
                } else {
                    $loginTime[$d] = []; // If no time values are available for a date
                }
            }
            // dd($loginTime);
        }
        if (Auth::guard('businessUser')->check()) {
            $businessUserId = Auth::user()->id;
            $userId = Auth::guard('businessUser')->user()->user_id;
            $loginTimeline = AllLoginTimeline::where(function ($query) use ($businessUserId, $userId) {
                $query->where('business_user_id', $businessUserId)->orWhere('user_id', $userId);
            })->whereDate('created_at', '>=', now()->subDays(6))
                ->orderBy('created_at')
                ->get();

            $groupedLoginTimeline = $loginTimeline->groupBy(function ($loginTimeline) {
                return $loginTimeline->created_at->format('Y-m-d'); // Group by date
            });
            $dateTime = [];
            foreach ($groupedLoginTimeline as $d => $loginTimeline) {
                // echo "Date: $date\n";
                $date = $d;
                $i = 0;
                foreach ($loginTimeline as $loginTimeline) {
                    $dateTime[$date][$i] = $loginTimeline->created_at->format('H:i');
                    $i++;
                }
            }

            $numberOfDays = 7;
            $dates = array();

            for ($i = 0; $i < $numberOfDays; $i++) {
                $date = date('Y-m-d', strtotime("-$i days"));
                $dates[] = $date;
            }

            $loginTime = [];

            foreach ($dates as $d) {
                if (isset($dateTime[$d])) {
                    $loginTime[$d] = $dateTime[$d];
                } else {
                    $loginTime[$d] = []; // If no time values are available for a date
                }
            }
            // dd($loginTime);
        }
        return view('user.pages.dashboard', compact('loginTime'));
    }
    function barChart()
    {
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
            ->selectRaw('DATE_FORMAT(quotes.created_at, "%b") as month, COUNT(*) as count, SUM(invoices.total_price) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
         $quotationsWithInvoiceSumOfJob = Quote::leftJoin('invoices', 'quotes.id', '=', 'invoices.quote_id')
            ->whereYear('quotes.created_at', $currentYear)
            ->where('quoted_company_by', $userId)
            ->where('job',1)
            ->selectRaw('DATE_FORMAT(quotes.created_at, "%b") as month, COUNT(*) as count, SUM(invoices.total_price) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();    



        $totalQuote = ["Jan" => 0, "Feb" => 0, "Mar" => 0, "Apr" => 0, "May" => 0, "Jun" => 0, "Jul" => 0, "Aug" => 0, "Sep" => 0, "Oct" => 0, "Nov" => 0, "Dec" => 0];
        $totalJob = ["Jan" => 0, "Feb" => 0, "Mar" => 0, "Apr" => 0, "May" => 0, "Jun" => 0, "Jul" => 0, "Aug" => 0, "Sep" => 0, "Oct" => 0, "Nov" => 0, "Dec" => 0];

        foreach ($quotationsWithInvoiceSum as  $val) {
            $month = $val['month'];
            $totalQuote[$month] = $val['total'];    
        }
        foreach ($quotationsWithInvoiceSumOfJob as  $val) {
            $month = $val['month'];
            $totalJob[$month] = $val['total'];    
        }
        $allQuoteVal = [];
        $allJobVal = [];
        $i = 0;
        $j = 0;
        foreach ($totalQuote as $key => $val) {
            $allQuoteVal[$i] = $val;
            $i++;
        }
        foreach ($totalJob as $key => $val) {
            $allJobVal[$j] = $val;
            $j++;
        }

       return response()->json(['allQuoteVal'=>$allQuoteVal,'allJobVal'=>$allJobVal]); 
    }
}

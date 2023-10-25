<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\AllLoginTimeline;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard(){
        
           
            $loginTimeline = AllLoginTimeline::whereIn('user_type', [1,2])
                ->whereDate('created_at', '>=', now()->subDays(6))
                ->orderBy('created_at')
                ->get();
            
            $groupedLoginTimeline = $loginTimeline->groupBy(function ($loginTimeline) {
                return $loginTimeline->created_at->format('Y-m-d'); // Group by date
            });
            $dateTime=[];
            foreach ($groupedLoginTimeline as $d => $loginTimeline) {
                // echo "Date: $date\n";
                $date=$d;
                $i=0;
                foreach ($loginTimeline as $loginTimeline) {
                    $dateTime[$date][$i]=$loginTimeline->created_at->format('H:i');
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
            // dd($dateTime);
      
    
        return view('superAdmin.pages.dashboard',compact('loginTime'));
    }
    function barChart()
{
   
    $currentYear = Carbon::now()->year;

   
     $companyMonthWise = User::whereYear('created_at', $currentYear)
        ->selectRaw('DATE_FORMAT(created_at, "%b") as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month')
        ->get();    



   
    $totalCompany = ["Jan" => 0, "Feb" => 0, "Mar" => 0, "Apr" => 0, "May" => 0, "Jun" => 0, "Jul" => 0, "Aug" => 0, "Sep" => 0, "Oct" => 0, "Nov" => 0, "Dec" => 0];

   
    foreach ($companyMonthWise as  $val) {
        $month = $val['month'];
        $totalCompany[$month] = $val['count'];    
    }
   
    $companyCount = [];
    $i = 0;
    $j = 0;
   
    foreach ($totalCompany as $key => $val) {
        $companyCount[$j] = $val;
        $j++;
    }

   return response()->json(['companyCount'=>$companyCount]); 
}
}

<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Models\AllLoginTimeline;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        
           
        $loginTimeline = AllLoginTimeline::where('user_type',2)
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
  

    return view('moderator.pages.dashboard',compact('loginTime'));
}
}

<?php

namespace App\Http\Controllers;

use App\Models\BusinessProfile;
use App\Models\BusinessUser;
use App\Models\Moderator;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CompanyController extends Controller
{

    // where approved status 1
    public function signedCompany(Request $request)
    {
        $skippedVal = $request->clicked * 10;
        $showingData = $skippedVal + 10;
        $moreData = User::whereHas('business_profile', function ($query) {
            $query->where('approved_status', 1)->where('status', 1);
        });
        if ($request->start_time != null || $request->end_time != null) {
            $moreData = $moreData->whereBetween('created_at', [$request->start_time, $request->end_time]);
        }
        if ($request->email != null) {
            $moreData = $moreData->where('email', 'like', '%' . $request->email . '%');
        }
        $totalData = $moreData->count();
        $moreData = $moreData->skip($skippedVal)
            ->take(10)
            ->get();
        // $totalData = User::whereHas('business_profile', function ($query) {
        //     $query->where('approved_status', 1)->where('status', 1);
        // })->count();

        if ($showingData < $totalData) {
            $showingDataNum = $showingData;
        } else {
            $showingDataNum = $totalData;
        }
        $html = '';
        foreach ($moreData as $item) {
            // Render the HTML for each item using a Blade view
            $html .= View::make('moderator.components.registeredCompany', ['item' => $item])->render();
        }

        return response()->json(['html' => $html, 'showingData' => $showingDataNum, 'totalData' => $totalData]);
    }

    // where approved status 0
    public function requestedCompany(Request $request)
    {
        $skippedVal = $request->clicked * 10;
        $showingData = $skippedVal + 10;
        $moreData = User::with(['business_profile' => function ($query) {
            $query->where(function ($q1) {
                $q1->where('approved_status', 0)->orWhere('approved_status', NULL);
            })->where('status', 1);
        }])->whereHas('business_profile', function ($query) {
            $query->where(function ($q1) {
                $q1->where('approved_status', 0)->orWhere('approved_status', NULL);
            })->where('status', 1);
        });

        if ($request->start_time != null || $request->end_time != null) {
            $moreData = $moreData->whereBetween('created_at', [$request->start_time, $request->end_time]);
        }
        if ($request->email != null) {
            $moreData = $moreData->where('email', 'like', '%' . $request->email . '%');
        }
        $totalData = $moreData->count();
        $moreData = $moreData->skip($skippedVal)
            ->take(10)
            ->get();

        // $totalData = User::with(['business_profile' => function ($query) {
        //     $query->where(function($q1){
        //     $q1->where('approved_status', 0)->orWhere('approved_status', NULL);
        //     })->where('status',1);
        // }])->whereHas('business_profile', function ($query) {
        //     $query->where(function($q1){
        //         $q1->where('approved_status', 0)->orWhere('approved_status', NULL);
        //         })->where('status',1);
        // })->count();
        if ($showingData < $totalData) {
            $showingDataNum = $showingData;
        } else {
            $showingDataNum = $totalData;
        }
        $html = '';
        foreach ($moreData as $item) {
            // Render the HTML for each item using a Blade view
            $html .= View::make('moderator.components.requestedCompany', ['item' => $item])->render();
        }

        return response()->json(['html' => $html, 'showingData' => $showingDataNum, 'totalData' => $totalData]);
    }

    // where approved status 1
    public function superAdminSignedCompany(Request $request)
    {
        $skippedVal = $request->clicked * 10;
        $showingData = $skippedVal + 10;
        $moreData = User::whereHas('business_profile', function ($query) {
            $query->where('approved_status', 1)->where('status', 1);
        });
        if ($request->start_time != null || $request->end_time != null) {
            $moreData = $moreData->whereBetween('created_at', [$request->start_time, $request->end_time]);
        }
        $totalData = $moreData->count();
        $moreData = $moreData->skip($skippedVal)
            ->take(10)
            ->get();
        // $totalData = User::whereHas('business_profile', function ($query) {
        //     $query->where('approved_status', 1)->where('status', 1);
        // })->count();
        if ($showingData < $totalData) {
            $showingDataNum = $showingData;
        } else {
            $showingDataNum = $totalData;
        }
        $html = '';
        foreach ($moreData as $item) {
            // Render the HTML for each item using a Blade view
            $user = User::with('business_profile')->where('id', $item->id)->first();
            $accepted_by = $user->business_profile->accepted_by;
            $moderator = Moderator::with('moderator_profile')->where('id', $accepted_by)->first();
            $moderator_user_name = $moderator->moderator_profile->user_name;
            $quote = Quote::where('quoted_company_by', $item->id)->count();
            $html .= View::make('superAdmin.components.registeredCompany', ['item' => $item, 'moderator_user_name' => $moderator_user_name, 'quote' => $quote])->render();
        }

        return response()->json(['html' => $html, 'showingData' => $showingDataNum, 'totalData' => $totalData]);
    }

    public function companyDetails($id)
    {

        $company_details = User::with('business_profile')->where('id', $id)->first();

        $quote_sent = Quote::where('quoted_company_by', $id)->count();
        $quote_rejected = Quote::where('quoted_company_by', $id)->where('hidden', 1)->count();

        return view('superAdmin.pages.companyDetails', compact('company_details', 'quote_sent', 'quote_rejected'));
    }
    public function companyDetailsModerator(Request $request)
    {

        $companyInfo = BusinessProfile::where('id', $request->id)->first();

        return response()->json(['data' => $companyInfo]);
    }
}
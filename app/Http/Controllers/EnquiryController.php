<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class EnquiryController extends Controller
{
    public function superAdminEnquiry(Request $request)
    {
        $skippedVal = $request->clicked * 10;
        $showingData = $skippedVal + 10;
        if($request->start_time != null || $request->end_time != null){
            $moreData = Enquiry::whereBetween('created_at', [$request->start_time, $request->end_time])->skip($skippedVal)
            ->take(10)
            ->orderBy('id', 'DESC')
            ->get();
            $totalData = Enquiry::count();
          } 
        else{
            $moreData = Enquiry::skip($skippedVal)
            ->take(10)
            ->orderBy('id', 'DESC')
            ->get();
            $totalData = Enquiry::count();
        }  
        

        if ($showingData < $totalData) {
            $showingDataNum = $showingData;
        } else {
            $showingDataNum = $totalData;
        }
        $html = '';
        foreach ($moreData as $item) {
            // Render the HTML for each item using a Blade view
            $html .= View::make('superAdmin.components.allEnquiry', ['item' => $item])->render();
        }

        return response()->json(['html' => $html, 'showingData' => $showingDataNum, 'totalData' => $totalData]);
    }

    public function userEnquiry(Request $request)
    {  
        if (Auth::guard('web')->check()) {
            $loggedInUserId = Auth::guard('web')->user()->id;      
        } else {
            $loggedInUserId = Auth::guard('businessUser')->user()->user_id;
        }
        $skippedVal = $request->clicked * 10;
        $showingData = $skippedVal + 10;
        if ($request->request_part == "Engine" || $request->request_part == "Gearbox") {
            $moreData = Enquiry::whereDoesntHave('quotes', function ($query) use ($loggedInUserId) {
                $query->where('quoted_company_by', $loggedInUserId);
              })->where('request_part', $request->request_part);

              if($request->start_time != null || $request->end_time != null){
                $moreData = $moreData->whereBetween('created_at', [$request->start_time, $request->end_time]);
              } 
              $totalData= $moreData->count();
              $moreData =$moreData->skip($skippedVal)
                ->take(10)
                ->orderBy('id', 'DESC')
                ->get();
            // $totalData = Enquiry::whereDoesntHave('quotes', function ($query) use ($loggedInUserId) {
            //     $query->where('quoted_company_by', $loggedInUserId);
            //   })->where('request_part', $request->request_part)->count();
        }else{
            $moreData = Enquiry::whereDoesntHave('quotes', function ($query) use ($loggedInUserId) {
                $query->where('quoted_company_by', $loggedInUserId);
              })->whereNotIn('request_part',['Engine', 'Gearbox']);
              if($request->start_time != null || $request->end_time != null){
                $moreData = $moreData->whereBetween('created_at', [$request->start_time, $request->end_time]);
              }                
            $totalData= $moreData->count(); 
            $moreData =$moreData->skip($skippedVal)
            ->take(10)
            ->orderBy('id', 'DESC')
            ->get();
        // $totalData = Enquiry::whereDoesntHave('quotes', function ($query) use ($loggedInUserId) {
        //     $query->where('quoted_company_by', $loggedInUserId);
        //   })->whereNotIn('request_part',['Engine', 'Gearbox'])->count();
        }

        if ($showingData < $totalData) {
            $showingDataNum = $showingData;
        } else {
            $showingDataNum = $totalData;
        }
        $html = '';
        foreach ($moreData as $item) {
            // Render the HTML for each item using a Blade view
            $html .= View::make('user.components.enquiry.allEnquiry', ['item' => $item])->render();
        }

        return response()->json(['html' => $html, 'showingData' => $showingDataNum, 'totalData' => $totalData]);
    }

    function singleEnquiry(Request $request){
        $enquiry=Enquiry::find($request->id);
        return response()->json(['success'=>true,'data'=>$enquiry]);
    }

    function enquiry_store(Request $request){
        $enquiry=new Enquiry();
        $enquiry->auto_generated_id=$request->auto_generated_id;
        $enquiry->car_make=$request->car_make;
        $enquiry->car_series=$request->car_series;
        $enquiry->car_model=$request->car_model;
        $enquiry->car_reg_year=$request->car_reg_year;
        $enquiry->request_part=$request->request_part;
        $enquiry->ref_no=$request->ref_no;
        $enquiry->engine_code=$request->engine_code;
        $enquiry->reg_num=$request->reg_num;
        $enquiry->address=$request->address;
        $enquiry->post_code=$request->post_code;
        $enquiry->query_user_email=$request->query_user_email;
        $enquiry->query_user_fullname=$request->query_user_fullname;
        $enquiry->query_user_phone=$request->query_user_phone;
        $enquiry->problem_with_engine=$request->problem_with_engine;
        $enquiry->save();
        if($enquiry){
            return response()->json(['success'=>true]);
       }else{
            return response()->json(['success'=>false]);
       }
    }

   
}

<?php

namespace App\Http\Controllers;

use App\Mail\QuoteMail;
use App\Models\CompanyQuoteCustomization;
use App\Models\Invoice;
use App\Models\JobStatus;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use  \Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\View;

class QuoteController extends Controller
{
    function priceQuote(Request $request){
        $quotePrice=Quote::with(['invoice'])->where('enquiry_id',$request->enquiry_id)->get();
        return response()->json(['data'=>$quotePrice]);
    }
    function quotePost(Request $request){
      $quote=new Quote();
      $quote->enquiry_id=$request->enquiry_id;
      $quote->warranty=$request->warranty;
      $quote->condition=$request->condition;
      $quote->mileage=$request->mileage;
      $quote->quoted_by=$request->quoted_by;
      $quote->quoted_company_by=$request->quoted_company_by;
      $quote->other_note=$request->other_note;
      $quote->engines=$request->engines;
      $quote->exchange_surcharge=$request->exchange_surcharge;
      $quote->delivery_charges=$request->delivery_charges;
      $quote->recovery=$request->recovery;
      $quote->fitting=$request->fitting;
      $quote->vat=$request->vat;
      $quote->ref="ET-".strtotime(date('m/d/Y h:i:s'));
      $quote->save();
      
      $invoice= new Invoice();
      $invoice->quote_id=$quote->id;
      $invoice->generated_invoice_no =strtotime(date('m/d/Y h:i:s'));
      $invoice->total_price=$request->total_price;
      $invoice->save();

      $quote_data = Quote::with(['enquiry', 'invoice'])->find($quote->id);

        if (Auth::guard('web')->check()) {
              $business_profile = Auth::guard('web')->user()->business_profile;
              $business_name = $business_profile->business_name;
              $logo = $business_profile->logo;
              $contact = $business_profile->quoting_person_name;
              $phone = $business_profile->primary_phone;
              $email = Auth::guard('web')->user()->email;
              $address = $business_profile->address;
              $user_id=$business_profile->user_id;
        } else {
              $business_profile = Auth::guard('businessUser')->user()->business->business_profile;
              $business_name = $business_profile->business_name;
              $logo = $business_profile->logo;
              $contact = Auth::guard('businessUser')->user()->user_name;
              $phone = $business_profile->primary_phone;
              $email = Auth::guard('businessUser')->user()->business->email;
              $address = $business_profile->address;
              $user_id=$business_profile->user_id;
        }
        

        $query_person_name = $quote_data->enquiry->query_user_fullname;
        $query_person_phone = $quote_data->enquiry->query_user_phone;
        $query_person_postCode = $quote_data->enquiry->post_code;
        $query_person_email = $quote_data->enquiry->query_user_email;
        $reg_num = $quote_data->enquiry->reg_num;


     

        $ApiKey = 'E10D7CDF-307F-4BA1-8501-4544E7125269';

        $url = "https://uk1.ukvehicledata.co.uk/api/datapackage/%s?v=2&api_nullitems=1&key_vrm=%s&auth_apikey=%s";
        $url = sprintf($url, "VehicleData", $reg_num, $ApiKey);



        $curl = curl_init();

        curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

    //    return response()->json(json_decode($response, true));
    //    exit();
        $car_info=json_decode($response, true);
        $carMakeModel=$car_info['Response']['DataItems']['VehicleRegistration']['MakeModel'];
        $engineSize=$car_info['Response']['DataItems']['VehicleRegistration']['EngineCapacity'];
        $fuelType=$car_info['Response']['DataItems']['VehicleRegistration']['FuelType'];
        $year=$car_info['Response']['DataItems']['VehicleRegistration']['YearOfManufacture'];

        $quote_customization=CompanyQuoteCustomization::where('user_id',$user_id)->first();
        $selling_point=$quote_customization->selling_point_description;
        $terms_condition=$quote_customization->terms_condition_description;
       
       
        $price_arr = [];

          $engines_price = (float)$quote_data->engines;
          $exchange_surcharge_price = (float)$quote_data->exchange_surcharge;
          $delivery_charges_price = (float)$quote_data->delivery_charges;
          $recovery_price = (float)$quote_data->recovery;
          $fitting_price = (float)$quote_data->fitting;
          $vat_price = (float)$quote_data->vat;

          if ($engines_price != 0 ) {
             $price_arr[]=["name"=>"Engines","cost"=> $engines_price];
          }
          if ($exchange_surcharge_price != 0 ) {
              $price_arr[]=["name"=>"Exchange Surcharge","cost"=> $exchange_surcharge_price];
             
          }
          if ($delivery_charges_price != 0 ) {
              $price_arr[]=["name"=>"Delivery","cost"=> $delivery_charges_price];
             
          }
          if ($recovery_price != 0 ) {
              $price_arr[]=["name"=>"Recovery","cost"=> $recovery_price];
              
          }
          if ($fitting_price != 0 ) {
              $price_arr[]=["name"=>"Fitting","cost"=> $fitting_price];
             
          }
        

        $mileage=$quote_data->mileage;
        $condition=$quote_data->condition;
        $warranty=$quote_data->warranty;
        $quote_ref_num=$quote_data->ref;
        $quote_date=date("Y-m-d", strtotime($quote_data->created_at));

        $subTotal=$engines_price+$exchange_surcharge_price+$delivery_charges_price+$recovery_price+$fitting_price;
        $total= $subTotal+$vat_price;

        $base=url('/');

     
        $mainArr= ["business_name"=>$business_name,"logo"=>$logo,"contact"=>$contact,"phone"=>$phone,"email"=>$email,"address"=>$address,"query_person_name"=>$query_person_name,"query_person_phone"=>$query_person_phone,"query_person_postCode"=>$query_person_postCode,"reg_num"=>$reg_num,"carMakeModel"=>$carMakeModel,"engineSize"=>$engineSize,"fuelType"=>$fuelType,"year"=>$year,"selling_point"=>$selling_point,"terms_condition"=>$terms_condition,"price_arr"=>$price_arr,"mileage"=>$mileage,"condition"=>$condition,"warranty"=>$warranty,"subTotal"=>$subTotal,"total"=>$total,"quote_ref_num"=>$quote_ref_num,"quote_date"=>$quote_date,"base"=>$base,"vat_price"=>$vat_price];

       

        $pdf = PDF::loadView('user.pdf.quote', $mainArr);
        $needed_id=[
            "id"=>$quote_data->id,
            "base"=>$base,
            "name"=>$query_person_name,
            "company_name"=>$business_name,
        ];

        // $data=[
        //     "mainArr"=>$mainArr
        // ]
        
        // Mail::to($query_person_email)->send(new QuoteMail($mainArr,$pdf));
        Mail::send('user.pdf',  $needed_id, function ($message) use ($pdf,$query_person_email) {
            $message->to($query_person_email)
                ->subject("Quotation of your enquiry")
                ->attachData($pdf->output(), "quote.pdf");
        });



      return response()->json(['success'=>true,'quote'=>$quote,'invoice'=>$invoice]);




    }

    public function quoteUpdate(Request $request){
        $quote=Quote::find($request->quote_id);
        $quote->vn=$request->vn;
        $quote->message=$request->message;
        $quote->update();

        $quote_data = Quote::with(['enquiry', 'invoice'])->find($request->quote_id);

        if (Auth::guard('web')->check()) {
              $business_profile = Auth::guard('web')->user()->business_profile;
              $business_name = $business_profile->business_name;
              $logo = $business_profile->logo;
              $contact = $business_profile->quoting_person_name;
              $phone = $business_profile->primary_phone;
              $email = Auth::guard('web')->user()->email;
              $address = $business_profile->address;
              $user_id=$business_profile->user_id;
        } else {
              $business_profile = Auth::guard('businessUser')->user()->business->business_profile;
              $business_name = $business_profile->business_name;
              $logo = $business_profile->logo;
              $contact = Auth::guard('businessUser')->user()->user_name;
              $phone = $business_profile->primary_phone;
              $email = Auth::guard('businessUser')->user()->business->email;
              $address = $business_profile->address;
              $user_id=$business_profile->user_id;
        }
        

        $query_person_name = $quote_data->enquiry->query_user_fullname;
        $query_person_phone = $quote_data->enquiry->query_user_phone;
        $query_person_postCode = $quote_data->enquiry->post_code;
        $query_person_email = $quote_data->enquiry->query_user_email;
        $reg_num = $quote_data->enquiry->reg_num;


     

        $ApiKey = 'E10D7CDF-307F-4BA1-8501-4544E7125269';

        $url = "https://uk1.ukvehicledata.co.uk/api/datapackage/%s?v=2&api_nullitems=1&key_vrm=%s&auth_apikey=%s";
        $url = sprintf($url, "VehicleData", $reg_num, $ApiKey);



        $curl = curl_init();

        curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

    //    return response()->json(json_decode($response, true));
    //    exit();
        $car_info=json_decode($response, true);
        $carMakeModel=$car_info['Response']['DataItems']['VehicleRegistration']['MakeModel'];
        $engineSize=$car_info['Response']['DataItems']['VehicleRegistration']['EngineCapacity'];
        $fuelType=$car_info['Response']['DataItems']['VehicleRegistration']['FuelType'];
        $year=$car_info['Response']['DataItems']['VehicleRegistration']['YearOfManufacture'];

        $quote_customization=CompanyQuoteCustomization::where('user_id',$user_id)->first();
        $selling_point=$quote_customization->selling_point_description;
        $terms_condition=$quote_customization->terms_condition_description;
       
       
        $price_arr = [];

          $engines_price = (float)$quote_data->engines;
          $exchange_surcharge_price = (float)$quote_data->exchange_surcharge;
          $delivery_charges_price = (float)$quote_data->delivery_charges;
          $recovery_price = (float)$quote_data->recovery;
          $fitting_price = (float)$quote_data->fitting;
          $vat_price = (float)$quote_data->vat;

          if ($engines_price != 0 ) {
             $price_arr[]=["name"=>"Engines","cost"=> $engines_price];
          }
          if ($exchange_surcharge_price != 0 ) {
              $price_arr[]=["name"=>"Exchange Surcharge","cost"=> $exchange_surcharge_price];
             
          }
          if ($delivery_charges_price != 0 ) {
              $price_arr[]=["name"=>"Delivery","cost"=> $delivery_charges_price];
             
          }
          if ($recovery_price != 0 ) {
              $price_arr[]=["name"=>"Recovery","cost"=> $recovery_price];
              
          }
          if ($fitting_price != 0 ) {
              $price_arr[]=["name"=>"Fitting","cost"=> $fitting_price];
             
          }
        

        $mileage=$quote_data->mileage;
        $condition=$quote_data->condition;
        $warranty=$quote_data->warranty;
        $quote_ref_num=$quote_data->ref;
        $quote_date=date("Y-m-d", strtotime($quote_data->created_at));

        $subTotal=$engines_price+$exchange_surcharge_price+$delivery_charges_price+$recovery_price+$fitting_price;
        $total= $subTotal+$vat_price;

        $base=url('/');

     
        $mainArr= ["business_name"=>$business_name,"logo"=>$logo,"contact"=>$contact,"phone"=>$phone,"email"=>$email,"address"=>$address,"query_person_name"=>$query_person_name,"query_person_phone"=>$query_person_phone,"query_person_postCode"=>$query_person_postCode,"reg_num"=>$reg_num,"carMakeModel"=>$carMakeModel,"engineSize"=>$engineSize,"fuelType"=>$fuelType,"year"=>$year,"selling_point"=>$selling_point,"terms_condition"=>$terms_condition,"price_arr"=>$price_arr,"mileage"=>$mileage,"condition"=>$condition,"warranty"=>$warranty,"subTotal"=>$subTotal,"total"=>$total,"quote_ref_num"=>$quote_ref_num,"quote_date"=>$quote_date,"base"=>$base,"vat_price"=>$vat_price];

       

        $pdf = PDF::loadView('user.pdf.quote', $mainArr);
        $needed_id=[
            "id"=>$quote_data->id,
            "base"=>$base,
            "name"=>$query_person_name,
            "company_name"=>$business_name,
        ];

        // $data=[
        //     "mainArr"=>$mainArr
        // ]
        
        // Mail::to($query_person_email)->send(new QuoteMail($mainArr,$pdf));
        Mail::send('user.pdf',  $needed_id, function ($message) use ($pdf,$query_person_email) {
            $message->to($query_person_email)
                ->subject("Quotation of your enquiry")
                ->attachData($pdf->output(), "quote.pdf");
        });
        
        return response()->json(['success'=>true]);
    }



    public function sent(){
        $quote_data = Quote::with(['enquiry', 'invoice'])->find(10);

        if (Auth::guard('web')->check()) {
              $business_profile = Auth::guard('web')->user()->business_profile;
              $business_name = $business_profile->business_name;
              $logo = $business_profile->logo;
              $contact = $business_profile->quoting_person_name;
              $phone = $business_profile->primary_phone;
              $email = Auth::guard('web')->user()->email;
              $address = $business_profile->address;
              $user_id=$business_profile->user_id;
        } else {
              $business_profile = Auth::guard('businessUser')->user()->business->business_profile;
              $business_name = $business_profile->business_name;
              $logo = $business_profile->logo;
              $contact = Auth::guard('businessUser')->user()->user_name;
              $phone = $business_profile->primary_phone;
              $email = Auth::guard('businessUser')->user()->business->email;
              $address = $business_profile->address;
              $user_id=$business_profile->user_id;
        }
        

        $query_person_name = $quote_data->enquiry->query_user_fullname;
        $query_person_phone = $quote_data->enquiry->query_user_phone;
        $query_person_postCode = $quote_data->enquiry->post_code;
        $reg_num = $quote_data->enquiry->reg_num;


     

        $ApiKey = 'E10D7CDF-307F-4BA1-8501-4544E7125269';

        $url = "https://uk1.ukvehicledata.co.uk/api/datapackage/%s?v=2&api_nullitems=1&key_vrm=%s&auth_apikey=%s";
        $url = sprintf($url, "VehicleData", $reg_num, $ApiKey);



        $curl = curl_init();

        curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

       
        $car_info=json_decode($response, true);
        $carMakeModel=$car_info['Response']['DataItems']['VehicleRegistration']['MakeModel'];
        $engineSize=$car_info['Response']['DataItems']['VehicleRegistration']['EngineCapacity'];
        $fuelType=$car_info['Response']['DataItems']['VehicleRegistration']['FuelType'];
        $year=$car_info['Response']['DataItems']['VehicleRegistration']['YearOfManufacture'];

        $quote_customization=CompanyQuoteCustomization::where('user_id',$user_id)->first();
        $selling_point=$quote_customization->selling_point_description;
        $terms_condition=$quote_customization->terms_condition_description;
       
       
        $price_arr = [];

          $engines_price = (int)$quote_data->engines;
          $exchange_surcharge_price = (int)$quote_data->exchange_surcharge;
          $delivery_charges_price = (int)$quote_data->delivery_charges;
          $recovery_price = (int)$quote_data->recovery;
          $fitting_price = (int)$quote_data->fitting;
          $vat_price = (int)$quote_data->vat;

          if ($engines_price != 0 ) {
             $price_arr[]=["name"=>"Engines","cost"=> $engines_price];
          }
          if ($exchange_surcharge_price != 0 ) {
              $price_arr[]=["name"=>"Exchange Surcharge","cost"=> $exchange_surcharge_price];
             
          }
          if ($delivery_charges_price != 0 ) {
              $price_arr[]=["name"=>"Delivery","cost"=> $delivery_charges_price];
             
          }
          if ($recovery_price != 0 ) {
              $price_arr[]=["name"=>"Recovery","cost"=> $recovery_price];
              
          }
          if ($fitting_price != 0 ) {
              $price_arr[]=["name"=>"Fitting","cost"=> $fitting_price];
             
          }
        

        $mileage=$quote_data->mileage;
        $condition=$quote_data->condition;
        $warranty=$quote_data->warranty;
        $quote_ref_num=$quote_data->ref;
        $quote_date=date("Y-m-d", strtotime($quote_data->created_at));

        $subTotal=$engines_price+$exchange_surcharge_price+$delivery_charges_price+$recovery_price+$fitting_price;
        $total= $subTotal+$vat_price;

        $base=url('/');
          
        
     
        $mainArr= ["business_name"=>$business_name,"logo"=>$logo,"contact"=>$contact,"phone"=>$phone,"email"=>$email,"address"=>$address,"query_person_name"=>$query_person_name,"query_person_phone"=>$query_person_phone,"query_person_postCode"=>$query_person_postCode,"reg_num"=>$reg_num,"carMakeModel"=>$carMakeModel,"engineSize"=>$engineSize,"fuelType"=>$fuelType,"year"=>$year,"selling_point"=>$selling_point,"terms_condition"=>$terms_condition,"price_arr"=>$price_arr,"mileage"=>$mileage,"condition"=>$condition,"warranty"=>$warranty,"subTotal"=>$subTotal,"total"=>$total,"quote_ref_num"=>$quote_ref_num,"quote_date"=>$quote_date,"base"=>$base,"vat_price"=>$vat_price];
        $needed_id=[
            "id"=>$quote_data->id,
            "base"=>$base,
        ];
       

        $pdf = PDF::loadView('user.pdf.quote', $mainArr);
        
        Mail::send('user.pdf', $needed_id  , function ($message) use ($pdf) {
            $message->to("dourjoykhan@gmail.com")
                ->subject("Quotation of your enquiry")
                ->attachData($pdf->output(), "quote.pdf");
        });

       

        // $pdf = PDF::loadView('user.pdf.quote', $mainArr)->save(public_path('pdf/quote.pdf'));

        // $attach= public_path('pdf/quote.pdf');
       
        // $arr=[
        //     "attach"=>$attach,
        //     "mainArr"=>$mainArr
        // ];
        
        // Mail::to("dourjoykhan@gmail.com")->send(new QuoteMail($arr));
        // Mail::send('user.pdf.quote',  $mainArr, function ($message) use ($pdf) {
        //     $message->to("dourjoykhan@gmail.com")
        //         ->subject("Quotation of your enquiry")
        //         ->attachData($pdf->output(), "quote.pdf");
        // });
      
    }

    public function accept(Request $request, $id){

      $quote=Quote::find($id); 
      if($quote->hidden==1){
        return view("user.pdf.quoteMessage",["msg"=>"You have Already Declined this Quote","color"=>"danger"]);  
      }
      if($quote->job==1){
        return view("user.pdf.quoteMessage",["msg"=>"You have Already Accepted this Quote","color"=>"info"]);  
      }
      $quote->job=1;
      $quote->update();
      $job_status=new JobStatus();
      $job_status->quote_id=$id;
      $job_status->status="Work Started";
      $job_status->save();

      return view("user.pdf.quoteMessage",["msg"=>"You have Accepted the Quote","color"=>"success"]);
    }
    public function decline(Request $request, $id){
        $quote=Quote::find($id); 
        if($quote->job==1){
            return view("user.pdf.quoteMessage",["msg"=>"You have Already Accepted this Quote","color"=>"info"]);  
          }
          if($quote->hidden==1){
            return view("user.pdf.quoteMessage",["msg"=>"You have Already Declined this Quote","color"=>"danger"]);  
          }   
        $quote->hidden=1;
        $quote->update();
        return view("user.pdf.quoteMessage",["msg"=>"You have Declined the Quote","color"=>"danger"]);
      }
    public function userQuotes(Request $request){
        if (Auth::guard('web')->check()) {
            $loggedInUserId = Auth::guard('web')->user()->id;      
        } else {
            $loggedInUserId = Auth::guard('businessUser')->user()->user_id;
        }
        $skippedVal = $request->clicked * 10;
        $showingData = $skippedVal + 10;
      
            $moreData =Quote::with(['enquiry','invoice'])->where('quoted_company_by', $loggedInUserId)->skip($skippedVal)
                ->take(10)
                ->orderBy('id', 'DESC')
                ->get();
            $totalData = Quote::with(['enquiry','invoice'])->where('quoted_company_by', $loggedInUserId)->count();
        

        if ($showingData < $totalData) {
            $showingDataNum = $showingData;
        } else {
            $showingDataNum = $totalData;
        }
        $html = '';
        foreach ($moreData as $item) {
            // Render the HTML for each item using a Blade view
            $html .= View::make('user.components.quotesAll', ['item' => $item])->render();
        }

        return response()->json(['html' => $html, 'showingData' => $showingDataNum, 'totalData' => $totalData]);
    }  
    public function userJobs(Request $request){
        if (Auth::guard('web')->check()) {
            $loggedInUserId = Auth::guard('web')->user()->id;      
        } else {
            $loggedInUserId = Auth::guard('businessUser')->user()->user_id;
        }
        $skippedVal = $request->clicked * 10;
        $showingData = $skippedVal + 10;
      
            $moreData =Quote::with(['enquiry','invoice','job_status'])->where('quoted_company_by', $loggedInUserId)->where('job',1)->skip($skippedVal)
                ->take(10)
                ->orderBy('id', 'DESC')
                ->get();
            $totalData = Quote::with(['enquiry','invoice','job_status'])->where('quoted_company_by', $loggedInUserId)->where('job',1)->count();
        

        if ($showingData < $totalData) {
            $showingDataNum = $showingData;
        } else {
            $showingDataNum = $totalData;
        }
        $html = '';
        foreach ($moreData as $item) {
            // Render the HTML for each item using a Blade view
            $html .= View::make('user.components.jobAll', ['item' => $item])->render();
        }

        return response()->json(['html' => $html, 'showingData' => $showingDataNum, 'totalData' => $totalData]);
    } 

    
    public function userHidden(Request $request){
        if (Auth::guard('web')->check()) {
            $loggedInUserId = Auth::guard('web')->user()->id;      
        } else {
            $loggedInUserId = Auth::guard('businessUser')->user()->user_id;
        }
        $skippedVal = $request->clicked * 10;
        $showingData = $skippedVal + 10;
        if ($request->request_part == "Engine" || $request->request_part == "Gearbox") {
            $moreData=Quote::whereHas('enquiry', function ($query) use ($request) {
                $query->where('request_part', $request->request_part);
              })->with(['invoice','enquiry'])->where('hidden',1)->where('quoted_company_by',$loggedInUserId)->skip($skippedVal)
                ->take(10)
                ->orderBy('id', 'DESC')
                ->get();
            $totalData = Quote::whereHas('enquiry', function ($query) use ($request) {
                $query->where('request_part', $request->request_part);
              })->with(['invoice','enquiry'])->where('hidden',1)->where('quoted_company_by',$loggedInUserId)->count();
        }else{
            $moreData = Quote::whereHas('enquiry', function ($query) use ($request) {
                $query->whereNotIn('request_part',['Engine', 'Gearbox']);
              })->with(['invoice','enquiry'])->where('hidden',1)->where('quoted_company_by',$loggedInUserId)->skip($skippedVal)
            ->take(10)
            ->orderBy('id', 'DESC')
            ->get();
        $totalData = Quote::whereHas('enquiry', function ($query) use ($request) {
            $query->whereNotIn('request_part',['Engine', 'Gearbox']);
          })->with(['invoice','enquiry'])->where('hidden',1)->where('quoted_company_by',$loggedInUserId)->count();
        }

        if ($showingData < $totalData) {
            $showingDataNum = $showingData;
        } else {
            $showingDataNum = $totalData;
        }
        $html = '';
        foreach ($moreData as $item) {
            // Render the HTML for each item using a Blade view
            $html .= View::make('user.components.hidden.allHidden', ['item' => $item])->render();
        }

        return response()->json(['html' => $html, 'showingData' => $showingDataNum, 'totalData' => $totalData]);
    } 

    public function statusChange(Request $request){
        // $type_array=['jpeg','png','jpg','gif'];
        // $this->validate($request, [
          
        //     'status' => 'required',
        //     'image' => 'image|mimes:jpeg,png,jpg,gif',
           
        // ]);
       
      
       
        
       if($request->status){
        $imageName=null;
        if($request->image){
         $imageName = time() . '.' . $request->image->extension();
         $request->image->move(public_path('image/user/job/status'), $imageName);
        }

        $jobStatus= new  JobStatus();
        $jobStatus->quote_id=$request->quote_id;
        $jobStatus->status=$request->status;
        $jobStatus->image=$imageName;
        $jobStatus->comments=$request->comments;
        $jobStatus->save();

       
        $quote=Quote::with('enquiry')->where('id',$request->quote_id)->first();
        $arr=[
            "name"=>$quote->enquiry->query_user_fullname,
            "status"=>$request->status
       ];
        Mail::send('user.jobStatus', $arr  , function ($message) use ($quote) {
            $message->to($quote->enquiry->query_user_email)
                ->subject("Status of Your Car");
        });
       

        return redirect()->back()
                ->with('success', ' Status Updated successfully');

       }else{
        return redirect()->back()
                ->with('error', 'Something wrong with Input');
       }
        
    }
    
}

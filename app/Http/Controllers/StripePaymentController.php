<?php

namespace App\Http\Controllers;

use App\Models\BusinessProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;

class StripePaymentController extends Controller
{
    public function stripe(Request $request)
    { 
        $value= $request->value_for_payment;
        $id= $request->user_id_for_payment;
        return view('user.stripe',compact('value','id'));
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    { 

        
         
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $request->bill * 100,
                "currency" => "gbp",
                "source" => $request->stripeToken,
                "description" => "Payment for renewal" 
        ]);

        $currentTimestamp=Carbon::now()->toDateTimeString();
        $currentDate = Carbon::parse($currentTimestamp);
        $date_after_30=$currentDate->addDays(30)->toDateTimeString();
    
        $business_profile =BusinessProfile::where('user_id',$request->user_id)->first();
        $business_profile->subscribed_at=$currentTimestamp;
        $business_profile->subscribed_till= $date_after_30;
        $business_profile->expiry_date= $date_after_30;
        $business_profile->save();

      
        Session::flash('success', 'Payment successful!');
              
        return redirect()->route('user.home');
    }
}

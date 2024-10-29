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
        $value = $request->value_for_payment;
        $id = $request->user_id_for_payment;
        $time = $request->subscription_month;
        return view('user.stripe', compact('value', 'id', 'time'));
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {



        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $request->bill * 100,
            "currency" => "gbp",
            "source" => $request->stripeToken,
            "description" => "Payment for renewal"
        ]);
        $business_profile = BusinessProfile::where('user_id', $request->user_id)->first();
        $expiry_date = $business_profile->expiry_date;

        $parseExpiry_date = Carbon::parse($expiry_date);


        $currentTimestamp = Carbon::now()->toDateTimeString();
        $currentDate = Carbon::parse($currentTimestamp);



        if ($expiry_date !== NULL) {
            $DateFromAdd = "";

            if ($currentDate->gt($parseExpiry_date)) {
                $DateFromAdd = $currentDate;
            } elseif ($currentDate->lt($parseExpiry_date)) {
                $DateFromAdd = $parseExpiry_date;
            } else {
                $DateFromAdd = $parseExpiry_date;
            }
            $till_subscribed = $DateFromAdd->addDays($request->time * 30)->toDateTimeString();
        } else {
            $till_subscribed = $currentDate->addDays($request->time * 30)->toDateTimeString();
        }




        $business_profile->subscribed_at = $currentTimestamp;
        $business_profile->subscribed_till = $till_subscribed;
        $business_profile->expiry_date = $till_subscribed;
        $business_profile->fixed_subscription_time = 1;
        $business_profile->fixed_subscription_amount = null;
        $business_profile->save();


        Session::flash('success', 'Payment successful!');

        return redirect()->route('user.home');
    }
}

<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Mail\ApproveMail;
use App\Mail\CompanyMail;
use App\Models\AllLoginTimeline;
use App\Models\BusinessProfile;
use App\Models\Moderator;
use App\Models\ModeratorProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ModeratorController extends Controller
{
    public function check(Request $request)
    {
        $this->validate($request, [

            'email' => 'required|exists:moderators,email',
            'password' => 'required',

        ], [

            'email.exists' => 'Not exist',
            'password.required' => 'Required field',
            // 'password.min' => 'Minimum 8 characters',
        ]);

        $creds = $request->only('email', 'password');
        if (Auth::guard('moderator')->attempt($creds)) {
            $login_timeline = new AllLoginTimeline();
            $login_timeline->moderator_id = Auth::guard('moderator')->user()->id;
            $login_timeline->user_type = 2;
            $login_timeline->save();
            return redirect()->route('moderator.home');
        } else {
            return redirect()->back()->with('error', 'Credentials not correct');
        }
    }

    public function create_company(Request $request)
    {
        DB::beginTransaction();

        try {
            if (!$request->email || !$request->password || !$request->business_name || !$request->business_type || !$request->address || !$request->city || !$request->post_code || !$request->country || !$request->primary_phone) {
                Session::put('warning', 'Required Field Need to be filled');
                throw new \Exception('Something wrong');
            } 


            $exists = User::where('email', $request->email)->exists();

            if ($exists) {
                Session::put('warning', 'Email is not Unique');
                throw new \Exception('Something wrong');
            }


            $user = new User();
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();


            if (count($user->toArray()) <= 0) {
                throw new \Exception('Something wrong');
            } else {

                Mail::to($request->email)->send(new CompanyMail($request->password));
            }



            $profile = new BusinessProfile();
            $profile->business_name = $request->business_name;
            $profile->business_type = $request->business_type;
            $profile->address = $request->address;
            $profile->user_id = $user->id;
            $profile->city = $request->city;
            $profile->post_code = $request->post_code;
            $profile->primary_phone = $request->primary_phone;
            $profile->alternative_phone = $request->alternative_phone;
            $profile->country = $request->country;
            $profile->warranty = $request->warranty;
            $profile->quoting_person_name = $request->quoting_person_name;
            $profile->vat_no = $request->vat_no;
            $profile->status = 1;
            $profile->approved_status = 1;
            $profile->save();




            DB::commit();
            return redirect()->back()
                ->with('success', 'Company created successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Company creation failed');
        }
    }
    
    public function update_account(Request $request){
       
        $moderator_id=Auth::guard('moderator')->user()->id;
        $this->validate($request,[
         'email'=>'required|unique:moderators,email,'.$moderator_id,
        ]);

    

     $moderator=Moderator::find($moderator_id);

     if($request->password){
        $password=Hash::make($request->password);
        $moderator->password=$password;
     }
     $moderator->email=$request->email;
     $moderator->update();

     $imgName=null;
     if($request->img){
         $imgName = time() . '.' . $request->img->extension();
        
         $request->img->move(public_path('image/moderator'), $imgName);
     }

     

     $moderator_profile=ModeratorProfile::where('moderator_id',$moderator_id)->first();
     $moderator_profile->user_name=$request->user_name;
     $moderator_profile->first_name=$request->first_name;
     $moderator_profile->last_name=$request->last_name;
     $moderator_profile->img=$imgName;
     $moderator_profile->update();

     return redirect()->back()
                ->with('success', 'Updated successfully');

    }
    
    public function company_decline($id){
      $company=BusinessProfile::find($id);
      $company->status=0;
      $company->update();
      return redirect()->back()
      ->with('success', 'Declined successfully');
    }
    public function company_approve($id){ 
        
        $company=BusinessProfile::find($id);
        $company->approved_status=1;
        $company->accepted_by=Auth::guard('moderator')->user()->id;
        // $company->subscribed_till=Carbon::now()->addDays(30)->format('Y-m-d h:i:s');
        // $company->subscribed_at=Carbon::now()->format('Y-m-d h:i:s');
        // $company->expiry_date = Carbon::now()->format('Y-m-d h:i:s');
        $company->update();
        if($company){
            Mail::to($company->business->email)->send(new ApproveMail());
        }
        return redirect()->back()
        ->with('success', 'Approved successfully');  
        
    }

    public function logout()
    {

        Auth::guard('moderator')->logout();
        return redirect()->route('moderator.login');
    }

    public function forgotForm(){
        return view('moderator.pages.forgotForm');
    }

    public function resetLink(Request $request){
        $this->validate($request, [
            'email' => 'required|email|exists:moderators,email',
        ]);

        
            $token=Str::random(64);
            
                DB::table('password_resets')->insert([
                    'email'=>$request->email,
                    'token'=>$token,
                    'created_at'=>Carbon::now(),
                    'guard'=>'moderator',
                ]);  
       
            $email=$request->email;
            $action_link=route('moderator.reset.password.form',['token'=>$token,'email'=>$email]);
            $body='We have received a request to reset your password.You can reset your password by clicking the link below';
            Mail::send('moderator.forgot_password',['action_link'=>$action_link,'body'=>$body], function ($message) use ($request) {
                $message->to($request->email)
                    ->subject("Reset Your Password");
            });


            return back()->with('success',' We have sent you a reset link');

       
    }
    public function resetForm(Request $request, $token=null){
        return view('moderator.pages.resetForm',['token'=>$token,'email'=>$request->email]);
    }
    public function resetPassword(Request $request){
        $this->validate($request, [
          
            'email' => 'required',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required'
           
        ]);

        $checkToken=DB::table('password_resets')->where(['email'=>$request->email,'token'=>$request->token])->first();
        if(!$checkToken){
            return back()->with('error','Invalid Token')->withInput();
        }
        else{
           
                Moderator::where('email',$request->email)->update([
                    'password'=>Hash::make($request->password)
                 ]);
            

            DB::table('password_resets')->where(['email'=>$request->email])->delete();
        }
    return redirect()->route('moderator.login')->with('success','Your Password Successfully Changed');

    }

   public function update_subscription(Request $request){

        $validator = Validator::make($request->all(), [
            'subscription_duration_val' => 'required',
            'subscription_amount_val' => 'required',
           
        ]);

        

        if ($validator->fails()) {
            session()->flash('error', 'Something went wrong!');
            // If validation fails, return back with errors and old input
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
           $business_profile= BusinessProfile::find((int)$request->business_profile_id);
           $business_profile->fixed_subscription_time=$request->subscription_duration_val;
           $business_profile->fixed_subscription_amount = $request->subscription_amount_val;
           $business_profile->update();
            session()->flash('success', 'Successfully Added!');
            return redirect()->back();
        }

       
    }

    public function email_subscription(Request $request){
        Mail::send('moderator.components.subscriptionEmail', ['name' => $request->name], function ($message) use ($request) {
            $message->to($request->email)
                ->subject("Renew your subscription");
        });

        session()->flash('success', 'Successfully Sent!');
        return redirect()->back();
        
    }
}
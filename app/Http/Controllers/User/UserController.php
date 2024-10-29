<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\EmployeeMail;
use App\Models\AllLoginTimeline;
use App\Models\BusinessProfile;
use App\Models\BusinessUser;
use App\Models\CompanyQuoteCustomization;
use App\Models\SocialLink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'business_name' => 'required',
            'business_type' => 'required',
            'address' => 'required',
            'city' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'primary_phone' => 'required',
            'post_code' => 'required',
            'country' => 'required',
            'quoting_person_name' => 'required',
            'vat_no' => 'required',
            'warranty' => 'required'

        ], [
            'business_name.required' => 'Required field',
            'business_type.required' => 'Required field',
            'address.required' => 'Required field',
            'city.required' => 'Required field',
            'email.required' => 'Required field',
            'password.required' => 'Required field',
            'password.min' => 'Minimum 8 characters',
            'primary_phone.required' => 'Required field',
            'post_code.required' => 'Required field',
            'country.required' => 'Required field',
            'quoting_person_name.required' => 'Required field',
            'vat_no.required' => 'Required field',
            'warranty.required' => 'Required field',
        ]);

        DB::beginTransaction();

        try {

            $token = Str::random(32);


            $id = DB::table('users')->insertGetId([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'remember_token' => $token,
                'created_at' => Carbon::now()->format('Y-m-d h:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d h:i:s'),
            ]);

            if (!$id) {
                throw new \Exception('Something wrong');
            }

            DB::table('business_profiles')->insert([
                'business_name' => $request->business_name,
                'business_type' => $request->business_type,
                'address' => $request->address,
                'city' => $request->city,
                'user_id' => $id,
                'primary_phone' => $request->primary_phone,
                'post_code' => $request->post_code,
                'country' => $request->country,
                'quoting_person_name' => $request->quoting_person_name,
                'vat_no' => $request->vat_no,
                'warranty' => $request->warranty,
                'alternative_phone' => $request->alternative_phone,
                //test
                'subscribed_till' => Carbon::now()->addDays(30)->format('Y-m-d h:i:s'),
                'created_at' => Carbon::now()->format('Y-m-d h:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d h:i:s'),
            ]);


            DB::commit();



            Mail::send('user.verify_link', ['id' => $id, 'token' => $token, 'email' => $request->email, 'password' => $request->password, 'base' => url('/'), 'name' => $request->quoting_person_name], function ($message) use ($request) {
                $message->to($request->email)
                    ->subject("Verify your mail");
            });

            return redirect('/user/login')->with('success', 'Created successfully. Please check your mail');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Creation failed');
        }
    }

    public function verify(Request $request, $token)
    {

        $user = User::where('remember_token', $token)->first();
        $currentTimestamp = Carbon::now()->toDateTimeString();
        $currentDate = Carbon::parse($currentTimestamp);
        $user->email_verified_at = $currentDate;
        $user->remember_token = null;
        $user->update();

        return view("user.pdf.quoteMessage", ["msg" => "Your Email is Verified.Wait for Approval", "color" => "success"]);
    }

    public function check(Request $request)
    {
        $this->validate($request, [

            'email' => 'required',
            'password' => 'required',

        ], [

            'email.required' => 'Required field',
            'password.required' => 'Required field',
            // 'password.min'=>'Minimum 8 characters',
        ]);

        $creds = $request->only('email', 'password');
        if (Auth::guard('web')->attempt($creds)) {
            if (Auth::guard('web')->user()->business_profile->approved_status == 1) {

                $login_timeline = new AllLoginTimeline();
                $login_timeline->user_id = Auth::user()->id;
                $login_timeline->user_type = 3;
                $login_timeline->created_at = Carbon::now()->format('Y-m-d h:i:s');
                $login_timeline->updated_at = Carbon::now()->format('Y-m-d h:i:s');
                $login_timeline->save();

                $quote_customization = DB::table('company_quote_customizations')->where('user_id', Auth::user()->id)->count();
                if ($quote_customization > 0) {
                    return redirect()->route('user.home');
                } else {
                    $quote_customization = new CompanyQuoteCustomization();
                    $quote_customization->user_id = Auth::user()->id;
                    $quote_customization->selling_point_title = "Demo Selling Point Title";
                    $quote_customization->selling_point_description = "Demo Selling Point Description";
                    $quote_customization->terms_condition_title = "Demo Terms and Condition Title";
                    $quote_customization->terms_condition_url = "www.demo.com";
                    $quote_customization->terms_condition_description = "Demo Terms and Condition Description";
                    $quote_customization->save();
                    // return redirect()->route('user.account.profile');   
                    return redirect()->route('user.home');
                }
            } else {
                return redirect()->route('user.login')->with('error', 'Not Approved Yet');
            }
        }

        if (Auth::guard('businessUser')->attempt($creds)) {
            if (Auth::guard('businessUser')->user()->business->business_profile->approved_status == 1) {
                $login_timeline = new AllLoginTimeline();
                $login_timeline->user_id = Auth::guard('businessUser')->user()->user_id;
                $login_timeline->business_user_id = Auth::guard('businessUser')->user()->id;
                $login_timeline->user_company_id = Auth::guard('businessUser')->user()->user_id;
                $login_timeline->user_type = 4;
                $login_timeline->created_at = Carbon::now()->format('Y-m-d h:i:s');
                $login_timeline->updated_at = Carbon::now()->format('Y-m-d h:i:s');
                $login_timeline->save();

                $quote_customization = DB::table('company_quote_customizations')->where('user_id', Auth::guard('businessUser')->user()->user_id)->count();
                if ($quote_customization > 0) {
                    return redirect()->route('user.home');
                } else {
                    $quote_customization = new CompanyQuoteCustomization();
                    $quote_customization->user_id = Auth::guard('businessUser')->user()->user_id;
                    $quote_customization->selling_point_title = "Demo Selling Point Title";
                    $quote_customization->selling_point_description = "Demo Selling Point Description";
                    $quote_customization->terms_condition_title = "Demo Terms and Condition Title";
                    $quote_customization->terms_condition_url = "www.demo.com";
                    $quote_customization->terms_condition_description = "Demo Terms and Condition Description";
                    $quote_customization->save();
                    // return redirect()->route('user.account.profile');   
                    return redirect()->route('user.home');
                }
            } else {
                return redirect()->route('user.login')->with('error', 'Not Approved Yet');
            }
        }


        return redirect()->back()->with('error', 'Credentials not correct');
    }

    public function create_employee(Request $request)
    {



        DB::beginTransaction();

        try {
            if (!$request->email || !$request->password || !$request->first_name) {
                Session::put('warning', 'Required Field Need to be filled');
                throw new \Exception('Something wrong');
            }


            $exists = BusinessUser::where('email', $request->email)->exists();

            if ($exists) {
                Session::put('warning', 'Email is not Unique');
                throw new \Exception('Something wrong');
            }


            if (Auth::guard('web')->check()) {
                $user_id = Auth::guard('web')->user()->id;
            }

            if (Auth::guard('businessUser')->check()) {
                $user_id = Auth::guard('businessUser')->user()->user_id;
            }

            $businessUser = new BusinessUser();
            $businessUser->email = $request->email;
            $businessUser->password = Hash::make($request->password);
            $businessUser->first_name = $request->first_name;
            $businessUser->last_name = $request->last_name;
            $businessUser->user_id = $user_id;
            $businessUser->user_name = $request->user_name;
            $businessUser->phone = $request->phone;
            $businessUser->status = $request->status;
            $businessUser->designation = $request->designation;
            $businessUser->created_at =  Carbon::now()->format('Y-m-d h:i:s');;
            $businessUser->updated_at =  Carbon::now()->format('Y-m-d h:i:s');;
            $businessUser->save();

            if ($businessUser) {
                Mail::to($request->email)->send(new EmployeeMail($request->password));
            }


            DB::commit();
            return redirect()->back()
                ->with('success', 'Employee created successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Employee creation failed');
        }
    }

    public function update_employee(Request $request)
    {
        DB::beginTransaction();

        try {
            if (!$request->email || !$request->first_name) {
                Session::put('warning', 'Required Field Need to be filled');
                throw new \Exception('Something wrong');
            }


            $exists = BusinessUser::where('id', '!=', $request->id)->where('email', $request->email)->exists();

            if ($exists) {
                Session::put('warning', 'Email is not Unique');
                throw new \Exception('Something wrong');
            }



            $businessUser = BusinessUser::find($request->id);
            $businessUser->email = $request->email;
            $businessUser->first_name = $request->first_name;
            $businessUser->last_name = $request->last_name;
            $businessUser->user_name = $request->user_name;
            $businessUser->phone = $request->phone;
            $businessUser->status = $request->status;
            $businessUser->designation = $request->designation;
            $businessUser->updated_at = Carbon::now()->format('Y-m-d h:i:s');
            $businessUser->update();


            DB::commit();
            return redirect()->back()
                ->with('success', 'Employee Updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Employee Updations failed');
        }
    }
    public function delete_employee($id)
    {
        $businessUser = BusinessUser::find($id);
        $businessUser->delete();
        return redirect()->back()
            ->with('success', 'Employee Deleted successfully');
    }

    public function profilePage()
    {
        if (Auth::guard('web')->check()) {
            $company_id = Auth::guard('web')->user()->id;
        } else {
            $company_id = Auth::guard('businessUser')->user()->user_id;
        }
        $customization = CompanyQuoteCustomization::where('user_id', $company_id)->first();
        return view('user.pages.profile', compact('customization'));
    }

    public function add_social_link(Request $request)
    {

        DB::beginTransaction();

        try {
            if (!$request->url_email) {
                Session::put('warning', 'Required Field Need to be filled');
                throw new \Exception('Something wrong');
            }

            $user_id = null;
            $business_user_id = null;
            if (Auth::guard('web')->check()) {
                $user_id = Auth::guard('web')->user()->id;
            }

            if (Auth::guard('businessUser')->check()) {
                $user_id = Auth::guard('businessUser')->user()->user_id;
                $business_user_id = Auth::guard('businessUser')->user()->id;
            }
            $imageName = null;
            if ($request->image) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('image/user/socialLink'), $imageName);
            }

            $socialLink = new SocialLink();
            $socialLink->name = $request->name;
            $socialLink->image = $imageName;
            $socialLink->url_email = $request->url_email;
            $socialLink->user_id = $user_id;
            $socialLink->business_user_id = $business_user_id;
            $socialLink->created_at = Carbon::now()->format('Y-m-d h:i:s');
            $socialLink->updated_at = Carbon::now()->format('Y-m-d h:i:s');
            $socialLink->save();


            DB::commit();
            return redirect()->back()
                ->with('success', 'Social Link  added successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Social Link creation failed');
        }
    }

    public function quote_customization(Request $request)
    {

        $this->validate($request, [

            'selling_point_title' => 'required',
            'selling_point_description' => 'required',
            'terms_condition_title' => 'required',
            'terms_condition_url' => 'required',
            'terms_condition_description' => 'required',
        ]);

        if (Auth::guard('web')->check()) {
            $company_id = Auth::guard('web')->user()->id;
        } else {
            $company_id = Auth::guard('businessUser')->user()->user_id;
        }

        $customization = CompanyQuoteCustomization::where('user_id', $company_id)->first();


        if (!$customization) {
            $new_customization = new CompanyQuoteCustomization();
            $new_customization->selling_point_title = $request->selling_point_title;
            $new_customization->selling_point_description = $request->selling_point_description;
            $new_customization->terms_condition_title = $request->terms_condition_title;
            $new_customization->terms_condition_url = $request->terms_condition_url;
            $new_customization->terms_condition_description = $request->terms_condition_description;
            $new_customization->user_id = $company_id;
            $new_customization->created_at = Carbon::now()->format('Y-m-d h:i:s');
            $new_customization->updated_at = Carbon::now()->format('Y-m-d h:i:s');
            $new_customization->save();
            return redirect()->back()
                ->with('success', 'Quote Customization added successfully');
        } else {
            $customization->selling_point_title = $request->selling_point_title;
            $customization->selling_point_description = $request->selling_point_description;
            $customization->terms_condition_title = $request->terms_condition_title;
            $customization->terms_condition_url = $request->terms_condition_url;
            $customization->terms_condition_description = $request->terms_condition_description;
            $customization->user_id = $company_id;
            $customization->updated_at = Carbon::now()->format('Y-m-d h:i:s');
            $customization->update();
            return redirect()->back()
                ->with('success', 'Quote Customization updated successfully');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function update_profile(Request $request)
    {


        if (Auth::guard('web')->check()) {

            $user_id = Auth::guard('web')->user()->id;
            $this->validate($request, [
                'business_name' => 'required',
                'business_type' => 'required',
                'address' => 'required',
                'city' => 'required',
                'post_code' => 'required',
                'country' => 'required',
                'primary_phone' => 'required',
            ]);
        } else {
            $user_id = Auth::guard('businessUser')->user()->user_id;
            $id = Auth::guard('businessUser')->user()->id;
            $this->validate($request, [
                'business_name' => 'required',
                'business_type' => 'required',
                'address' => 'required',
                'city' => 'required',
                'post_code' => 'required',
                'country' => 'required',
                'primary_phone' => 'required',
                'first_name' => 'required',
                'email' => 'required|unique:business_users,email,' . $id,
            ]);
        }

        $company_profile = BusinessProfile::where('user_id', $user_id)->first();
        $logoName = null;
        if ($request->logo) {
            $logoName = time() . '.' . $request->logo->extension();

            $request->logo->move(public_path('image/user/companylogo'), $logoName);
        }

        if (!$request->marketing_email) {
            $marketing_email = 0;
        } else {
            $marketing_email = 1;
        }

        if (!$request->enquiry_email) {
            $enquiry_email = 0;
        } else {
            $enquiry_email = 1;
        }

        $company_profile->business_name = $request->business_name;
        $company_profile->trade_name = $request->trade_name;
        $company_profile->business_type = $request->business_type;
        $company_profile->website = $request->website;
        $company_profile->address = $request->address;
        $company_profile->city = $request->city;
        $company_profile->post_code = $request->post_code;
        $company_profile->country = $request->country;
        $company_profile->vat_no = $request->vat_no;
        $company_profile->primary_phone = $request->primary_phone;
        $company_profile->alternative_phone = $request->alternative_phone;
        $company_profile->other_phone = $request->other_phone;
        $company_profile->status = $request->status;
        $company_profile->logo = $logoName;
        $company_profile->rating = $request->rating;
        $company_profile->expiry_date = $request->expiry_date;
        $company_profile->marketing_email = $marketing_email;
        $company_profile->enquiry_email = $enquiry_email;
        $company_profile->warranty = $request->warranty;
        $company_profile->recovery_rate = $request->recovery_rate;
        $company_profile->default_condition = $request->default_condition;
        $company_profile->updated_at = Carbon::now()->format('Y-m-d h:i:s');
        $company_profile->update();

        if (Auth::guard('businessUser')->check()) {
            $business_user = BusinessUser::where('id', $id)->where('user_id', $user_id)->first();
            // dd($business_user);
            if ($request->password) {
                $password = Hash::make($request->password);
                $business_user->password = $password;
            }

            $imgName = null;
            if ($request->img) {
                $imgName = time() . '.' . $request->img->extension();

                $request->img->move(public_path('image/user/companyUser'), $imgName);
            }

            $business_user->user_name = $request->user_name;
            $business_user->email = $request->email;
            $business_user->first_name = $request->first_name;
            $business_user->last_name = $request->last_name;
            $business_user->img = $imgName;
            $business_user->updated_at = Carbon::now()->format('Y-m-d h:i:s');
            $business_user->update();
        }

        return redirect()->back()
            ->with('success', 'Updated successfully');
    }

    public function logout(Request $request)
    {

        Auth::logout();
        return redirect()->route('user.login');
    }

    public function forgotForm()
    {
        return view('user.pages.forgotForm');
    }

    public function resetLink(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
        ]);

        $businessExists = DB::table('users')->where('email', $request->email)->exists();


        $businessUserExists = DB::table('business_users')->where('email', $request->email)->exists();

        if ($businessExists == false && $businessUserExists == false) {
            return back()->with('error', 'Email is not Exist')->withInput();
        } else {
            $token = Str::random(64);

            if ($businessExists == true) {
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                    'guard' => 'web',

                ]);
            }
            if ($businessUserExists == true) {
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                    'guard' => 'businessUser',
                ]);
            }
            $email = $request->email;
            $action_link = route('user.reset.password.form', ['token' => $token, 'email' => $email]);
            $body = 'We have received a request to reset your password.You can reset your password by clicking the link below';
            Mail::send('user.forgot_password', ['action_link' => $action_link, 'body' => $body], function ($message) use ($request) {
                $message->to($request->email)
                    ->subject("Reset Your Password");
            });


            return back()->with('success', ' We have sent you a reset link');
        }
    }
    public function resetForm(Request $request, $token = null)
    {
        return view('user.pages.resetForm', ['token' => $token, 'email' => $request->email]);
    }
    public function resetPassword(Request $request)
    {
        $this->validate($request, [

            'email' => 'required',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required'

        ]);

        $checkToken = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();
        if (!$checkToken) {
            return back()->with('error', 'Invalid Token')->withInput();
        } else {
            $guard = $checkToken->guard;
            if ($guard == 'web') {
                User::where('email', $request->email)->update([
                    'password' => Hash::make($request->password)
                ]);
            } else {
                BusinessUser::where('email', $request->email)->update([
                    'password' => Hash::make($request->password)
                ]);
            }

            DB::table('password_resets')->where(['email' => $request->email])->delete();
        }
        return redirect()->route('user.login')->with('success', 'Your Password Successfully Changed');
    }
}
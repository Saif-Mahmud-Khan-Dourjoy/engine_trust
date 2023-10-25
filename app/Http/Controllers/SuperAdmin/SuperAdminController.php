<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Mail\moderatorMail;
use App\Models\AllLoginTimeline;
use App\Models\Moderator;
use App\Models\ModeratorProfile;
use App\Models\SuperAdmin;
use App\Models\SuperAdminProfile;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class SuperAdminController extends Controller
{
    public function check(Request $request){
        $this->validate($request, [
          
            'email' => 'required|exists:super_admins,email',
            'password' => 'required|min:8',
           
        ],[
           
            'email.exists'=>'Not exist',
            'password.required'=>'Required field', 
            'password.min'=>'Minimum 8 characters',
        ]);

        $creds= $request->only('email','password');
        if(Auth::guard('superAdmin')->attempt($creds)){
            $login_timeline= new AllLoginTimeline();
            $login_timeline->super_admin_id=Auth::guard('superAdmin')->user()->id;
            $login_timeline->user_type=1;
            $login_timeline->save();
            return redirect()->route('superAdmin.home');
        }else{
            return redirect()->back()->with('error','Credentials not correct');  
        }
    }

    public function create_moderator(Request $request){
       

        $random_password= Str::random(10);
        
        $email=$request->email;
        
        $imageName=null;
        if($request->img){
           
            
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('image/moderator'), $imageName);
    
            }

        DB::beginTransaction();

        try{
            if(!$email && !$request->user_name){
                Session::put('warning','Email and User Name is Required');
                throw new \Exception('Something wrong');
            }elseif(!$email && $request->user_name){
                Session::put('warning','Email is Required');
                throw new \Exception('Something wrong');
            }elseif($email && !$request->user_name){
                Session::put('warning','User Name is Required');
                throw new \Exception('Something wrong');
            }
           

           $exists= Moderator::where('email', $email)->exists();

           if($exists){
            Session::put('warning','Email is not Unique');
            throw new \Exception('Something wrong');
           }

         
            $moderator= new Moderator();
            $moderator->email=$email;
            $moderator->password=Hash::make($random_password);
            $moderator->save();


            if(count($moderator->toArray())<=0){
                throw new \Exception('Something wrong');
            }else{
              
                Mail::to($email)->send(new moderatorMail($random_password));
            }

          

            $profile= new ModeratorProfile();
            $profile->first_name=$request->first_name;
            $profile->last_name=$request->last_name;
            $profile->phone=$request->phone;  
            $profile->address=$request->address;
            $profile->moderator_id=$moderator->id;
            $profile->user_name=$request->user_name;
            $profile->joining_date=$request->joining_date;
            $profile->img=$imageName;
            $profile->save();

            

           
            DB::commit();
            return redirect()->back()
                ->with('success','Moderator created successfully');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error','Moderator creation failed');
        }



    }

    public function update_moderator(Request $request){
       
        $moderator=Moderator::with('moderator_profile')->find($request->moderator_id);
        
       
        $email=$request->email;
        
        $imageName=$moderator->moderator_profile->img;
        if($request->img){
           
            
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('image/moderator'), $imageName);
    
            }

        DB::beginTransaction();

        try{
            if(!$email && !$request->user_name){
                Session::put('warning','Email and User Name is Required');
                throw new \Exception('Something wrong');
            }elseif(!$email && $request->user_name){
                Session::put('warning','Email is Required');
                throw new \Exception('Something wrong');
            }elseif($email && !$request->user_name){
                Session::put('warning','User Name is Required');
                throw new \Exception('Something wrong');
            }
           

            $moderator->email=$email;
            $moderator->update();



            $profile= ModeratorProfile::where('moderator_id',$request->moderator_id)->first();
            $profile->first_name=$request->first_name;
            $profile->last_name=$request->last_name;
            $profile->phone=$request->phone;  
            $profile->address=$request->address;
            $profile->user_name=$request->user_name;
            $profile->joining_date=$request->joining_date;
            $profile->img=$imageName;
            $profile->update();

            

           
            DB::commit();
            return redirect()->back()
                ->with('success','Moderator Updated successfully');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error','Moderator Updation failed');
        }



    }

    public function delete_moderator($id){
        $moderator = Moderator::find($id);
        $moderator->delete();
        return redirect()->back()
        ->with('success', 'Moderator Deleted successfully');
    }

    public function update_account(Request $request){
       
        $superAdmin_id=Auth::guard('superAdmin')->user()->id;
        $this->validate($request,[
         'email'=>'required|unique:super_admins,email,'.$superAdmin_id,
        ]);

    

     $superAdmin=SuperAdmin::find($superAdmin_id);

     if($request->password){
        $password=Hash::make($request->password);
        $superAdmin->password=$password;
     }
     $superAdmin->email=$request->email;
     $superAdmin->update();

     $imgName=null;
     if($request->img){
         $imgName = time() . '.' . $request->img->extension();
        
         $request->img->move(public_path('image/superAdmin'), $imgName);
     }

     

     $superAdmin_profile=SuperAdminProfile::where('super_admin_id',$superAdmin_id)->first();
     $superAdmin_profile->user_name=$request->user_name;
     $superAdmin_profile->first_name=$request->first_name;
     $superAdmin_profile->last_name=$request->last_name;
     $superAdmin_profile->img=$imgName;
     $superAdmin_profile->update();

     return redirect()->back()
                ->with('success', 'Updated successfully');

    }

    public function logout()
    {
        
        Auth::guard('superAdmin')->logout();
        return redirect()->route('superAdmin.login');
    }
    public function forgotForm(){
        return view('superAdmin.pages.forgotForm');
    }

    public function resetLink(Request $request){
        $this->validate($request, [
            'email' => 'required|email|exists:super_admins,email',
        ]);

        
            $token=Str::random(64);
            
                DB::table('password_resets')->insert([
                    'email'=>$request->email,
                    'token'=>$token,
                    'created_at'=>Carbon::now(),
                    'guard'=>'superAdmin',
                ]);  
       
            $email=$request->email;
            $action_link=route('superAdmin.reset.password.form',['token'=>$token,'email'=>$email]);
            $body='We have received a request to reset your password.You can reset your password by clicking the link below';
            Mail::send('superAdmin.forgot_password',['action_link'=>$action_link,'body'=>$body], function ($message) use ($request) {
                $message->to($request->email)
                    ->subject("Reset Your Password");
            });


            return back()->with('success',' We have sent you a reset link');

       
    }
    public function resetForm(Request $request, $token=null){
        return view('superAdmin.pages.resetForm',['token'=>$token,'email'=>$request->email]);
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
           
                SuperAdmin::where('email',$request->email)->update([
                    'password'=>Hash::make($request->password)
                 ]);
            

            DB::table('password_resets')->where(['email'=>$request->email])->delete();
        }
    return redirect()->route('superAdmin.login')->with('success','Your Password Successfully Changed');

    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Models\User;
class Phoneverification extends Controller
{
     public function phone_verification(Request $request){ 
        if (Auth::user()->phone_verified_at != null) {
           return redirect('/user/dashboard');
         }
        if ($request->isMethod('POST')) {
            if ($request->session()->get('register_otp') != $request->otp) {
                Session::flash('message',__('Oops the otp is not valid'));
                return redirect()->route('phone.verification.view');
            }else{
                $user_store = User::findOrFail(Auth::user()->id);
                $user_store->phone_verified_at = date('Y-m-d H:i:s');
                $user_store->save();
                // Auth::login($user_store);
               return redirect('/user/dashboard');
            }  
        } 
        return view('user.phone_verification');
    }
  

    public function phone_verification_resend(Request $request){
       
         if (Auth::user()->phone_verified_at != null) {
           return redirect('/user/dashboard');
         }
        $this->otp_generate();
        Session::flash('message',__('We have sent a new OTP to your phone.'));
        return redirect()->route('phone.verification.view');
    }


    public function otp_view(Request $request){
         if (Auth::user()->phone_verified_at != null) {
           return redirect('/user/dashboard');
         }
        if (!$request->session()->get('register_otp')) {
            $this->otp_generate();
        }
        return view('user.phone_verification');   
    }

 

    public function otp_generate(){
        $register_otp = rand(1000,9999);
        $phone =  Auth::user()->phone;
        $twilio = get_option('twilio_info',true);
      
        Session::put('register_otp', $register_otp);
        phone_verify($twilio->message. $register_otp, $phone );
    }
}

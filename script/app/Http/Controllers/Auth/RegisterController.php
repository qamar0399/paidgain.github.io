<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'max:15','min:9', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $plan = Plan::where('id',1)->first();

        $user = User::create([
            'name' => $data['name'],
            'plan_id' => $plan->id ?? null,
            'plan_data' => json_encode([
                'ad_limit'=>$plan->ad_limit ?? 0,
                'commission'=>$plan->commission_rate ?? 0,
            ]),
            'username' => $this->usernameGenerate($data['email']),
            'country' => $data['country'],
            'email' => $data['email'],
            'phone' => str_replace(' ','',$data['phone_code'].$data['phone']),
            'role' => 'user',
            'user_id' => Session::get('ref_id'),
            'will_expire'=> will_expire($plan),
            'email_verified_at' => env('AUTO_EMAIL_VERIFICATION') == true ? date('Y-m-d H:i:s') : null,
            'phone_verified_at' => env('AUTO_PHONE_VERIFICATION') == true ? date('Y-m-d H:i:s') : null,
            'password' => Hash::make($data['password']),
        ]);

        // Auto Generate Subscription Log
        $subscription = new Subscription();
        $subscription->user_id = $user->id;
        $subscription->plan_id = $plan->id;
        $subscription->amount = $plan->price;
        $subscription->will_expire = will_expire($plan);
        $subscription->save();

        if (env('AUTO_PHONE_VERIFICATION') == false) {
            Session::put('user_phone_number', $data['phone_code'].$data['phone']);
            Session::put('user_id', $user->id);
            $this->otp_generate();
            Session::put('message','Check your phone for otp');
            return redirect()->route('phone.verification');
        }

        return $user;
    }

    public function usernameGenerate($email)
    {
        $explodeEmail=explode('@', $email);
        $username=$explodeEmail[0];
        $count_username=User::where('username',$username)->count();
        if ($count_username > 0) {
           $username=$username.$count_username+1;
        }


        return $username;
    }

    public function phone_verification(Request $request){
        if ($request->isMethod('POST')) {
            if ($request->session()->get('register_otp') != $request->otp) {
                Session::put('message','OTP Not matched');
                return redirect()->route('phone.verification.view');
            }else{
                $user_store = User::findOrFail($request->session()->get('user_id') ?? Auth::user()->id);
                $user_store->phone_verified_at = date('Y-m-d H:i:s');
                $user_store->save();
                // Auth::login($user_store);
                return redirect('/user/dashboard');
            }
        }
        return view('user.phone_verification');
    }


    public function phone_verification_resend(Request $request){
        $this->otp_generate();
        Session::put('message','Check your phone for new otp');
        return redirect()->route('phone.verification.view');
    }


    public function otp_view(Request $request){
        if (!$request->session()->get('register_otp')) {
            $this->otp_generate();
        }
        return view('user.phone_verification');
    }

    public function otp_generate(){
        $register_otp = rand(1000,9999);
        $phone = Session::get('user_phone_number') ?? Auth::user()->phone;
        $twilio =get_option('twilio_info',true);

        Session::put('register_otp', $register_otp);
        phone_verify($twilio->message. $register_otp, $phone );
    }

    /**
     * Override Registration Response
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        if (request()->ajax()){
            return response()->json([
                'redirect' => $request->has('redirect_to') ? $request->get('redirect_to') : $this->redirectPath(),
                'message' => __('Registration Successfully Completed')
            ]);
        }

        if ($request->has('redirect_to')){
            return redirect($request->get('redirect_to'));
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    /**
     * Override for json redirect
     *
     * @return string
     */
    public function redirectPath()
    {
        if (Auth::user()->role == 'admin') {
            return $this->redirectTo = route('admin.dashboard');
        }
        elseif (Auth::user()->role == 'user') {
            return $this->redirectTo = route('user.dashboard');
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }
}

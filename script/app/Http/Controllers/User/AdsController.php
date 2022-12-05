<?php

namespace App\Http\Controllers\User;

use Auth;
use Carbon\Carbon;
use App\Models\Ptc;
use App\Models\Plan;
use App\Models\Option;
use App\Models\PTCUser;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdsController extends Controller
{
    public function index()
    {
        $ades = Ptc::where('status',1)->paginate(50);
        $currency_data = Option::where('key','currency_info')->first();
        $currency = json_decode($currency_data->value);
        return view('user.ads.index',compact('ades','currency'));
    }

    public function show($id)
    {
        $ads_id = decrypt($id);
        $ads = Ptc::with('meta')->findOrFail($ads_id);

        $ptcuser_limit = PTCUser::where([
            ['user_id',Auth::id()]
        ])->whereDate('created_at',Carbon::today())->count();

        $plan = Plan::find(Auth::User()->plan_id);

        if($ptcuser_limit <= $plan->ad_limit)
        {
            return view('user.ads.show',compact('ads'));
        }else{
            return back()->with('message',__('Your Ads Daily limit has been exceeded!'));
        }
    }

    public function confirm(Request $request)
    {
        if (request()->getMethod() == 'POST') {
            $rules = ['captcha' => 'required|captcha'];
            $validator = validator()->make(request()->all(), $rules);
            if ($validator->fails()) {
                $errors['errors']['error']='Invalid Captcha!';
                return response()->json($errors,401);
            } else {
                $user = Auth::User();
                $ptc = Ptc::findOrFail($request->ptc_id);
                $user->ptcads()->attach($request->ptc_id, ['earning' => $ptc->amount]);

                $user->balance = $user->balance + $ptc->amount;
                $user->save();

                $transaction = new Transaction();
                $transaction->trx_id = Str::random(10);
                $transaction->user_id = Auth::User()->id;
                $transaction->amount = $ptc->amount;
                $transaction->charge = 0;
                $transaction->data = 'Earn From Ads';
                $transaction->save();

                return response()->json('Successfully Completed');
            }
        }
    }

    public function ads_show()
    {
        $user = Auth::User();
        $ades = $user->ptcads()->paginate(20);
        return view('user.ads.click',compact('ades'));
    }

}

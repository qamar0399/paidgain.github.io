<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Plan;
use App\Models\Referral;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommonController extends Controller
{
    public function subscribe(Request $request)
    {
        $plan = Plan::findOrFail($request->input('plan'));

        // Check user quotation
        if (auth()->user()->balance < $plan->price){
            return response()->json([
                'status' => 'warning',
                'message' => __("You've no sufficient balance")
            ]);
        }

        DB::beginTransaction();
        try {
            $will_expire = will_expire($plan);
            $user = auth()->user();

            // Update user table
            $user->update([
                'plan_id' => $plan->id,
                'balance' => ($user->balance - $plan->price),
                'will_expire' => $will_expire,
                'plan_data' => json_encode([
                    'ad_limit' => $plan->ad_limit,
                    'commission' => $plan->commission_rate ?? 0,
                ])
            ]);

            // Generate Transaction
            $transaction = new Transaction();
            $transaction->trx_id = uniqid();
            $transaction->user_id = $user->id;
            $transaction->amount = $plan->price;
            $transaction->charge = 0;
            $transaction->save();

            // Generate Subscription
            $subscription = new Subscription();
            $subscription->user_id = auth()->id();
            $subscription->plan_id = $plan->id;
            $subscription->amount = $plan->price;
            $subscription->will_expire = $will_expire;
            $subscription->save();


            // Generate Referral Commission
            if (auth()->user()->user_id != null) {
                $bonus = Category::where([
                    'type' => 'ReferralCommissionConfig',
                    'name' => 'membership_upgrade',
                    'status' => 1
                ])->first();

                $referredBy = auth()->user()->referredBy;

                if ($bonus && $referredBy && $referredBy->plan_data !== null) {
                    // Get commission value
                    $plan_data = json_decode($referredBy->plan_data);
                    $commission = ($plan->price / 100) * ($plan_data->commission ?? 0);

                    // Add Commission to referredBy user balance
                    $referredBy->balance = $referredBy->balance + $commission;
                    $referredBy->save();

                    $referral = new Referral();
                    $referral->user_id = auth()->id();
                    $referral->ref_id = $referredBy->id;
                    $referral->amount = $commission;
                    $referral->type = 'subscription';
                    $referral->save();
                }
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => __("Congratulations! You've successfully subscribed to ". ucwords($plan->name) ." plan")
            ]);
        }catch (\Throwable $exception){
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage()
            ], 302);
        }

    }
}

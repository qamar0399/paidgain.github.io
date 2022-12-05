<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\SocialAccount;
use App\Models\User;
use Auth;
use Exception;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $social_user = Socialite::driver($provider)->user();

            // First Find Social Account
            $account = SocialAccount::where([
                'provider_name' => $provider,
                'provider_id' => $social_user->getId()
            ])->first();

            // If Social Account Exist then Find User and Login
            if ($account) {
                Auth::login($account->user);

                if (Auth::user()->role == 'admin') {
                    return to_route('admin.dashboard');
                } else {
                    return to_route('user.dashboard');
                }
            }

            // Find User
            $user = User::where([
                'email' => $social_user->getEmail()
            ])->first();

            // If User not get then create new user
            if (!$user) {
                $plan = Plan::where('id', 1)->first();

                $user = User::create([
                    'email' => $social_user->getEmail(),
                    'name' => $social_user->getName(),

                    'plan_id' => $plan->id ?? null,
                    'plan_data' => json_encode([
                        'ad_limit' => $plan->ad_limit ?? 0,
                        'commission'=>$plan->commission_rate ?? 0,
                    ]),
                    'username' => $this->usernameGenerate($social_user->getEmail()),
                    'user_id' => Session::get('ref_id'),
                    'role' => 'user',
                    'will_expire' => will_expire($plan),
                    'email_verified_at' => env('AUTO_EMAIL_VERIFICATION') == true ? date('Y-m-d H:i:s') : null,
                    'phone_verified_at' => env('AUTO_PHONE_VERIFICATION') == true ? date('Y-m-d H:i:s') : null,
                ]);
            }

            // Create Social Accounts
            $user->socialAccounts()->create([
                'provider_id' => $social_user->getId(),
                'provider_name' => $provider
            ]);

            // Login
            Auth::login($user);
            if (Auth::user()->role == 'admin') {
                return to_route('admin.dashboard');
            } else {
                return to_route('user.dashboard');
            }

        } catch (Exception $e) {
            if (request()->ajax()) {
                return response()->json($e->getMessage(), 500);
            }
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function usernameGenerate($email)
    {
        $explodeEmail = explode('@', $email);
        $username = $explodeEmail[0];
        $count_username = User::where('username', $username)->count();
        if ($count_username > 0) {
            $username = $username . $count_username + 1;
        }

        return $username;
    }
}

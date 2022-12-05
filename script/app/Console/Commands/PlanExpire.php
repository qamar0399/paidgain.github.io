<?php

namespace App\Console\Commands;

use App\Jobs\SendPlanRenewJob;
use App\Mail\PlanRenew;
use App\Models\Option;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class PlanExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plan:expire {--type=?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->option('type') == 'before'){
            $option = Option::where('key', 'cron_option')->first();
            $this->info($option);
            $cron = json_decode($option);
            $users = User::where('will_expire', '>', today()->addDays($cron->days ?? 0))->with('plan')->get();

            $expirable_users = [];

            foreach ($users as $user) {
                if (!empty($user->plan)){
                    $data['name'] = $user->name;
                    $data['email'] = $user->email;
                    $data['plan'] = $user->plan->name;
                    $data['plan_id'] = $user->plan_id;
                    $data['will_expire'] = $user->will_expire;
                    $data['price'] = $user->plan->price;
                    $expirable_users[] = $data;
                }
            }

            $this->sendExpirableNotification($expirable_users, $cron->expirable_message ?? __('Your subscription will expire soon!'));


        }elseif($this->option('type') == 'after'){
            $option = Option::where('key', 'cron_option')->first();
            $cron = json_decode($option);
            $users = User::where('will_expire', '<=', today())->with('plan')->get();

            $trial_users = [];
            $expired_users = [];

            foreach ($users as $user) {
                if (!empty($user->plan) && $user->plan->days != '-1'){
                    if ($user->plan->is_trial){
                        $data['name'] = $user->name;
                        $data['email'] = $user->email;
                        $data['plan'] = $user->plan->name;
                        $data['plan_id'] = $user->plan_id;
                        $data['will_expire'] = formatted_date($user->will_expire);
                        $trial_users[] = $data;
                    } else{
                        $data['name'] = $user->name;
                        $data['email'] = $user->email;
                        $data['plan'] = $user->plan->name;
                        $data['plan_id'] = $user->plan_id;
                        $data['will_expire'] = formatted_date($user->will_expire);
                        $data['price'] = $user->plan->price;
                        $expired_users[] = $data;
                    }
                }
            }

            $this->sendExpiredNotification($trial_users, $cron->trial_expired_message ?? __('Your free trial is expired!'));
            $this->sendExpiredNotification($expired_users, $cron->expired_message ?? __('Your plan is expired!'));
        }
    }

    private function sendExpiredNotification($users, $message){
        foreach ($users ?? [] as $user) {
            $mailable = [
                'type' => 'expired',
                'name' => $user['name'],
                'email' => $user['email'],
                'subject' => strtoupper(config('app.name')) . ' - '. __('Your subscription has been expired!'),
                'message' => $message,
                'plan' => $user['plan'],
                'will_expire' => $user['will_expire']
            ];
            try {
                if (env('QUEUE_MAIL', false)) {
                    dispatch(new SendPlanRenewJob($mailable));
                }else{
                    Mail::to($user['email'])->send(new PlanRenew($mailable));
                }

                $this->info('Notification has been sent successfully');
            }catch (\Throwable $e){
                $this->error($e->getMessage());
            }
        }
    }

    private function sendExpirableNotification($users, $message){
        foreach ($users ?? []  as $user) {
            $mailable = [
                'type' => 'expirable',
                'name' => $user['name'],
                'email' => $user['email'],
                'subject' => strtoupper(config('app.name')) . ' - '. __('Your subscription will expire soon!'),
                'message' => $message,
                'plan' => $user['plan'],
                'will_expire' => $user['will_expire']
            ];
            try {
                if (env('QUEUE_MAIL', false)) {
                    dispatch(new SendPlanRenewJob($mailable));
                }else{
                    Mail::to($user['email'])->send(new PlanRenew($mailable));
                }

                $this->info('Notification has been sent successfully');
            }catch (\Throwable $e){
                // $this->error($e->getMessage());
            }
        }
    }
}

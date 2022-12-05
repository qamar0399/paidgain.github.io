<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\CronMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CronController extends Controller
{
    public function data()
    {
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays(3);
        $user_expire = User::whereBetween('will_expire',[$startDate, $endDate])->where('will_expire','!=','0000-00-00')->get();

        

        foreach($user_expire as $user)
        {
            $data = [
                'name' => $user->name,
                'email' => $user->email,
                'will_expire' => $user->will_expire
            ];
            Mail::to($user->email)->send(new CronMail($data));
        }

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendNewUserMail;
use App\Mail\SendUserMail;
use App\Models\User;
use App\Models\Usermeta;
use App\Notifications\SendUserEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Notification;

class UserController extends Controller
{
    public function __construct()
    {
        // Check user permission using spatie middleware
        $this->middleware('permission:user.list')->only('all', 'detail', 'active', 'emailVerified', 'sendEmail', 'smsVerified', 'withBalance');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $user = $this->userCrud($request, new User());

        //Send Email to new user
        if (env('QUEUE_MAIL')){
            Mail::to($user)->queue(new SendNewUserMail($user, 'Welcome to ' . env('APP_NAME'), $request->get('password')));
        } else {
            Mail::to($user)->send(new SendNewUserMail($user, 'Welcome to ' . env('APP_NAME'), $request->get('password')));
        }

        return response()->json(__('User Created Successfully'));
    }

    /**
     * To edit a user information
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        $meta = Usermeta::whereUserId($user->id)
           
            ->select(['value'])
            ->withCasts(['value' => 'array'])
            ->first();
        abort_if($user->role == 'admin',404);
        return view('admin.users.edit', compact('user', 'meta'));
    }

    /**
     * Update User Information
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, User $user)
    {
        $this->userCrud($request, $user, true);

        return response()->json(__('User Updated Successfully'));
    }

    /**
     * This function is used for new user creation and updating. To avoid code duplication.
     * @param Request $request
     * @param User $user
     * @param bool $is_update
     * @return User
     */
    private function userCrud(Request $request, User $user, bool $is_update = false)
    {
        // Validate the input request
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string', $is_update ? Rule::unique('users')->ignore($user) : Rule::unique('users')],
            'password' => [$is_update ? 'nullable' : 'required', 'string'],
            'username' => [$is_update ? 'nullable' : 'required', 'string', $is_update ? Rule::unique('users')->ignore($user) : Rule::unique('users')],
            'phone' => ['required', 'string'],
            'balance' => ['required', 'numeric'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'state' => ['nullable', 'string'],
            'zip' => ['nullable', 'string'],
            'country' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
            'email_verification' => ['nullable', 'string'],
            'sms_verification' => ['nullable', 'string'],
        ]);

        DB::beginTransaction();
        try {

            //Store data to database
            $user->role = 'user';
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->balance = $request->input('balance');
            $user->status = $request->has('status');
            $user->email_verified_at = $request->has('email_verification') ? now() : null;
            $user->phone_verified_at = $request->has('sms_verification') ? now() : null;
            $user->username = $request->input('username');
            if ($request->input('password')) {
                $user->password = Hash::make($request->input('password'));

            }

            $user->saveOrFail();

            Usermeta::updateOrCreate([
                'user_id' => $user->id,
                'key' => 'info',
            ], [
                'value' => json_encode([
                    'address'   =>  $request->input('address'),
                    'city'      =>  $request->input('city'),
                    'state'     =>  $request->input('state'),
                    'zip'       =>  $request->input('zip'),
                    'country'   =>  $request->input('country'),
                ])
            ]);

            DB::commit();

            return $user;
        }catch (\Throwable $e){
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Check if the username is available
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkUsername(Request $request)
    {
        $user = User::whereUsername($request->input('username'))->exists();

        if ($user) {
            return response()->json(__('This username is already taken'), 422);
        } else {
            return response()->json(__('Username is available'));
        }
    }

    /**
     * Display a list all of the users.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function all(Request $request)
    {
        $keyword = $request->get('src');
        $users = User::query()
            ->where('role', '=', 'user')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('username', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('email', 'LIKE', '%' . $keyword . '%');
            })
            ->leftJoin('usermetas', function ($join){
                $join->on('users.id', '=', 'usermetas.user_id');
            })
            ->select([
                'users.*',
                'usermetas.value as info'
            ])
            ->withCasts([
                'info' => 'array'
            ])
            ->latest()
            ->paginate();

        return $this->getList(__('All Users'), $users);
    }

    /**
     * Show only active users.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function active(Request $request)
    {
        $keyword = $request->get('src');
        $users = User::where('role', '=', 'user')
            ->where('status', '=', '1')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('username', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('email', 'LIKE', '%' . $keyword . '%');
            })
            ->leftJoin('usermetas', function ($join){
                $join->on('users.id', '=', 'usermetas.user_id');
            })
            ->select([
                'users.*',
                'usermetas.value as info'
            ])
            ->withCasts([
                'info' => 'array'
            ])
            ->latest()
            ->paginate();

        return $this->getList(__('Active User'), $users);
    }

    /**
     * Show only email verified users.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function emailVerified(Request $request)
    {
        $keyword = $request->get('src');
        $users = User::where('role', '=', 'user')
            ->whereNotNull('email_verified_at')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('username', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('email', 'LIKE', '%' . $keyword . '%');
            })
            ->leftJoin('usermetas', function ($join){
                $join->on('users.id', '=', 'usermetas.user_id');
            })
            ->select([
                'users.*',
                'usermetas.value as info'
            ])
            ->withCasts([
                'info' => 'array'
            ])
            ->latest()
            ->paginate();

        return $this->getList(__('Email Verified Users'), $users);
    }

    /**
     * Show only sms verified users.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function smsVerified(Request $request)
    {
        $keyword = $request->get('src');
        $users = User::where('role', '=', 'user')
            ->whereNotNull('phone_verified_at')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('username', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('email', 'LIKE', '%' . $keyword . '%');
            })
            ->leftJoin('usermetas', function ($join){
                $join->on('users.id', '=', 'usermetas.user_id');
            })
            ->select([
                'users.*',
                'usermetas.value as info'
            ])
            ->withCasts([
                'info' => 'array'
            ])
            ->latest()
            ->paginate();

        return $this->getList(__('SMS Verified Users'), $users);
    }

    /**
     * Show only users who have a minimum 1 balance.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function withBalance(Request $request)
    {
        $keyword = $request->get('src');
        $users = User::where('role', '=', 'user')
            ->where('balance', '>', '0')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('username', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('email', 'LIKE', '%' . $keyword . '%');
            })
            ->leftJoin('usermetas', function ($join){
                $join->on('users.id', '=', 'usermetas.user_id');
            })
            ->select([
                'users.*',
                'usermetas.value as info'
            ])
            ->withCasts([
                'info' => 'array'
            ])
            ->latest()
            ->paginate();

        return $this->getList(__('Users With Balance'), $users);
    }

    /**
     * To avoid multiple blade files such as all.blade.php, active.blade.php, etc
     * @param $title
     * @param $users
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    private function getList($title, $users)
    {
        return view('admin.users.list', compact('users', 'title'));
    }

    /**
     * Display specific user information.
     * @param $id_or_username
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function detail($id_or_username)
    {
        $user = User::where('id', '=', $id_or_username)
            ->orWhere('username', '=', $id_or_username)
            ->withSum('deposits', 'amount')
            ->withSum('withdraws', 'amount')
            ->withSum('transactions', 'amount')
            ->withCount('viewedPtc')
            ->firstOrFail();

        $deposits = $user->deposits()->with('getway')->paginate(5, ['*'], 'deposits');
        $withdraws = $user->withdraws()->with('method')->paginate(5, ['*'], 'withdraws');
        $transactions = $user->transactions()->paginate(5, ['*'], 'transactions');

        $deposits_chart = $user->deposits()
            ->select(DB::raw('sum(amount) as amount'), DB::raw("MONTHNAME(created_at) as month"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->pluck('amount', 'month');

        $withdraws_chart = $user->withdraws()
            ->select(DB::raw('sum(amount) as amount'), DB::raw("MONTHNAME(created_at) as month"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->pluck('amount', 'month');

        $transactions_chart = $user->transactions()
            ->select(DB::raw('sum(amount) as amount'), DB::raw("MONTHNAME(created_at) as month"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->pluck('amount', 'month');

        $labels = [];
        foreach ($deposits_chart->keys() as $index => $key) {
            $labels[$key] = $key;
        }

        foreach ($withdraws_chart->keys() as $index => $key) {
            $labels[$key] = $key;
        }

        foreach ($transactions_chart->keys() as $index => $key) {
            $labels[$key] = $key;
        }


        $labels = collect($labels)->keys();
        $deposit_data = $deposits_chart->values();
        $withdraw_data = $withdraws_chart->values();
        $transaction_data = $transactions_chart->values();

        return view('admin.users.detail', compact('user', 'deposits', 'withdraws', 'transactions', 'labels', 'deposit_data', 'withdraw_data', 'transaction_data'));
    }

    /**
     * Return a view called send email to all users.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function sendEmail()
    {
        return view('admin.users.sendEmail');
    }

    /**
     * The function is used to send emails to all users
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function queue(Request $request)
    {
        try {
            User::whereRole('user')
                ->chunk(100, function ($users) use ($request) {
                    foreach ($users as $user) {
                        Mail::to($user)
                            ->queue(new SendUserMail($user, $request->input('subject'), $request->input('body')));
                    }
                });

            return response()->json(__('Email sent to users'));
        }catch (\Throwable $e){
            return response()->json(__('Please Configure SMTP Connection'), 406);
        }
    }

    /**
     * Send a email to specific User
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendEmailToUser(Request $request, User $user)
    {
        $request->validate([
            'subject' => ['required', 'string'],
            'body' => ['required', 'string']
        ]);

        Notification::send($user, (new SendUserEmailNotification($request->get('subject'), $request->get('body'))));

        return response()->json(__('Email Sent'));
    }

    /**
     * Display the email log for specific user
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function emailLog(Request $request, User $user)
    {
        $notifications = $user
            ->notifications()
            ->when($request->get('src'), function ($query) use ($request) {
                $query->where('data', 'LIKE', '%"subject":"'.$request->get('src').'"%');
            })
            ->paginate();
        return view('admin.users.emaillog', compact('user', 'notifications'));
    }

    public function loginAsUser(User $user)
    {
        \Auth::login($user);

        return to_route('user.dashboard');
    }
}

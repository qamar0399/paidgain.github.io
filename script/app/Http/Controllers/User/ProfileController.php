<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index()
    {
        return view('user.profile.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('users')->ignore(auth()->id())],
            'phone' => ['required', 'string'],
            'country' => ['required', 'string']
        ]);

        auth()->user()->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'country' => $request->input('country'),
        ]);

        return response()->json(__('Profile Updated Successfully'));
    }

    public function password()
    {
        return view('user.profile.password');
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => [Rule::requiredIf(function (){
                return Auth::user()->password != null;
            }), Password::default()],
            'password' => ['required', 'string', 'confirmed', 'different:current_password'],
        ], [
            'password.different' => __('The current password and <br> the new password cannot be the same')
        ]);

        $user = Auth::user();

        if ($user->password != null){
            if (\Hash::check($request->input('current_password'), $user->password)){
                $user->update([
                    'password' => bcrypt($request->input('password'))
                ]);

                return response()->json(__('Password Changed Successfully'));
            }else{
                return response()->json(__("Oops! The current password doesn't match"), 401);
            }
        }else{
            $user->update([
                'password' => bcrypt($request->input('password'))
            ]);

            return response()->json(__('Password Changed Successfully'));
        }
    }
}

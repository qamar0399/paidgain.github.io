<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'username',
        'plan_id',
        'plan_data',
        'user_id',
        'balance',
        'email_verified_at',
        'phone',
        'phone_verified_at',
        'country',
        'will_expire',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'role',
        'plan_id',
        'plan_data',
        'user_id',
        'balance',
        'email_verified_at',
        'phone_verified_at',
        'will_expire',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    public static function getpermissionGroups()
    {
        $permission_groups = DB::table('permissions')
        ->select('group_name as name')
        ->groupBy('group_name')
        ->get();
        return $permission_groups;
    }

    public static function getPermissionGroup()
    {
        return $permission_groups = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
    }

    public static function getpermissionsByGroupName($group_name)
    {
        $permissions = DB::table('permissions')
        ->select('name', 'id')
        ->where('group_name', $group_name)
        ->get();
        return $permissions;
    }

    public static function roleHasPermissions($role, $permissions)
    {
        $hasPermission = true;
        foreach ($permissions as $permission) {
            if (!$role->hasPermissionTo($permission->name)) {
                $hasPermission = false;
                return $hasPermission;
            }
        }
        return $hasPermission;
    }

    public function referredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function referralUsers(): HasMany
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }

    public function referrals(): HasMany
    {
        return $this->hasMany(Referral::class, 'ref_id', 'id');
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function viewedPtc(): HasMany
    {
        return $this->hasMany(PTCUser::class, 'user_id', 'id');
    }

    public function metas(): HasMany
    {
        return $this->hasMany(Usermeta::class, 'user_id', 'id');
    }

    public function usermeta(): HasOne
    {
        return $this->hasOne(Usermeta::class);
    }

    public function meta($key)
    {
        return optional($this->hasOne(Usermeta::class, 'user_id', 'id')
            ->where('key', '=', $key)->first())->value;
    }

    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class);
    }

    public function withdraws(): HasMany
    {
        return $this->hasMany(Withdraw::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function ptcads()
    {
        return $this->belongsToMany('App\Models\Ptc','ptc_user','user_id','ptc_id')->withTimestamps();
    }

    public function socialAccounts(): HasMany
    {
        return $this->hasMany(socialAccount::class);
    }
}

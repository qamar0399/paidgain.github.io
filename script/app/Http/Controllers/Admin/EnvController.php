<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;
class EnvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth()->user()->can('system.settings'))
        {
            abort(401);
        }
        $countries= base_path('resources/lang/langlist.json');
        $countries= json_decode(file_get_contents($countries),true);

        return view('admin.settings.env',compact('countries'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth()->user()->can('system.settings'))
        {
            abort(401);
        }

        $validated = $request->validate([
            'service_account_credentials' => 'mimes:json,txt|max:100',
        ]);

        if ($request->hasFile('service_account_credentials')) {
            $file      = $request->file('service_account_credentials');
            $name = 'service-account-credentials.json';
            $path = 'uploads/';
            $file->move($path, $name);
        }

        $timezone=$request->TIMEZONE ?? 'UTC';
        $lang=$request->DEFAULT_LANG ?? 'en';
        $log=$request->LOG_LEVEL ?? 'debug';

        $APP_URL_WITHOUT_WWW=str_replace('www.','', url('/'));
         $APP_NAME = Str::slug($request->APP_NAME);
$txt ="APP_NAME=".$APP_NAME."
APP_DEBUG=".$request->APP_DEBUG."
APP_KEY=".env('APP_KEY')."
APP_ENV=local
APP_URL=".$request->APP_URL."
SITE_KEY=".env('SITE_KEY')."
AUTHORIZED_KEY=".env('AUTHORIZED_KEY')."

CONTENT_EDITOR=".$request->CONTENT_EDITOR."
ANALYTICS_VIEW_ID=".$request->ANALYTICS_VIEW_ID."

DB_CONNECTION=".env("DB_CONNECTION")."
DB_HOST=".env("DB_HOST")."
DB_PORT=".env("DB_PORT")."
DB_DATABASE=".env("DB_DATABASE")."
DB_USERNAME=".env("DB_USERNAME")."
DB_PASSWORD=".env("DB_PASSWORD")."

QUEUE_MAIL=".$request->QUEUE_MAIL."


".$request->MAIL_DRIVER_TYPE."=".$request->MAIL_DRIVER."
MAIL_DRIVER_TYPE=".$request->MAIL_DRIVER_TYPE."
MAIL_HOST=".$request->MAIL_HOST."
MAIL_PORT=".$request->MAIL_PORT."
MAIL_USERNAME=".$request->MAIL_USERNAME."
MAIL_PASSWORD=".$request->MAIL_PASSWORD."
MAIL_ENCRYPTION=".$request->MAIL_ENCRYPTION."
MAIL_FROM_ADDRESS=".$request->MAIL_FROM_ADDRESS."
MAIL_TO_ADDRESS=".$request->MAIL_TO."
MAIL_FROM_NAME='".$request->MAIL_FROM_NAME."'


BROADCAST_DRIVER=".$request->BROADCAST_DRIVER."
CACHE_DRIVER=".$request->CACHE_DRIVER."
QUEUE_CONNECTION=".$request->QUEUE_CONNECTION."

SESSION_DRIVER=".$request->SESSION_DRIVER."
SESSION_LIFETIME=".$request->SESSION_LIFETIME."

MEMCACHED_HOST=".$request->MEMCACHED_HOST."
MEMCACHED_PORT=".$request->MEMCACHED_PORT."
MEMCACHED_PERSISTENT_ID=".$request->MEMCACHED_PERSISTENT_ID."
MEMCACHED_USERNAME=".$request->MEMCACHED_USERNAME."
MEMCACHED_PASSWORD=".$request->MEMCACHED_PASSWORD."

REDIS_HOST=".$request->REDIS_HOST."
REDIS_PORT=".$request->REDIS_PORT."

REDIS_PASSWORD=".$request->REDIS_PASSWORD."

STORAGE_TYPE=".$request->STORAGE_TYPE."

AWS_ACCESS_KEY_ID=".$request->AWS_ACCESS_KEY_ID."
AWS_SECRET_ACCESS_KEY=".$request->AWS_SECRET_ACCESS_KEY."
AWS_DEFAULT_REGION=".$request->AWS_DEFAULT_REGION."
AWS_BUCKET=".$request->AWS_BUCKET."

WAS_ACCESS_KEY_ID=".$request->WAS_ACCESS_KEY_ID."
WAS_SECRET_ACCESS_KEY=".$request->WAS_SECRET_ACCESS_KEY."
WAS_DEFAULT_REGION=".$request->WAS_DEFAULT_REGION."
WAS_BUCKET=".$request->WAS_BUCKET."
WAS_ENDPOINT=".$request->WAS_ENDPOINT."


DISCUSS_COMMENT_KEY=".$request->DISCUSS_COMMENT_KEY."

AUTO_EMAIL_VERIFICATION=".$request->AUTO_EMAIL_VERIFICATION."
AUTO_PHONE_VERIFICATION=".$request->AUTO_PHONE_VERIFICATION."
WITHDRAW_PREFIX=".$request->WITHDRAW_PREFIX."

GOOGLE_CLIENT_ID=".$request->GOOGLE_CLIENT_ID."
GOOGLE_CLIENT_SECRET=".$request->GOOGLE_CLIENT_SECRET."

FACEBOOK_CLIENT_ID=".$request->FACEBOOK_CLIENT_ID."
FACEBOOK_CLIENT_SECRET=".$request->FACEBOOK_CLIENT_SECRET."

LOG_CHANNEL=".$request->LOG_CHANNEL."
LOG_LEVEL=".$log."
TIMEZONE=".$timezone."
DEFAULT_LANG=".$lang."
";

  File::put(base_path('.env'),$txt);
       return response()->json("System Updated");
    }


}

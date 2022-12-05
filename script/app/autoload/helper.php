<?php

use App\Models\Category;
use App\Models\Menu;
use App\Models\Option;
use Twilio\Rest\Client;

function ImageSize($url, $name)
{
    $img_arr = explode('.', $url);
    $ext = '.' . end($img_arr);
    $newName = str_replace($ext, $name . $ext, $url);
    return $newName;
}

function disquscomment()
{
    return view('components.disquss');
}

function get_option($key, $decode = false, $lang = null)
{
    $row = Cache::remember($key, 420, function () use ($key, $lang) {
        $option = Option::where('key', $key)
            ->when($lang, function ($q) use ($lang){
                $q->where('lang', $lang);
            })
            ->first();
        return $option->value ?? '';
    });

    return $decode == true ? json_decode($row) : $row;

}


function load_header()
{
    return view('components.load_header');
}

function load_footer()
{
    return view('components.load_footer');
}

function getautoloadquery()
{
    if (env('CACHE_DRIVER') == 'memcached' || env('CACHE_DRIVER') == 'redis') {
        return Cache::remember('autoload', 420, function () {
            $queries = Option::where('autoload', 1)->get();

            foreach ($queries as $key => $row) {
                $data[$row->key] = $row->value;
            }

            return $data ?? [];
        });
    } else {
        $queries = Option::where('autoload', 1)->get();

        foreach ($queries as $key => $row) {
            $data[$row->key] = $row->value;
        }

        return $data ?? [];
    }


}


function imageSizes()
{
    $sizes = '[{"key":"small","height":"80","width":"80"}]';
    return $sizes;
}


function NastedCategoryList($type, $selected = [], $ignore_id = null)
{
    $categories = Category::where('type', $type)
        ->whereNull('category_id')
        ->select('id', 'name', 'category_id')
        ->where('type', $type)
        ->with('childrenCategories')
        ->latest()
        ->get();

    return parentCategory($categories, $selected, $ignore_id);

}

function parentCategory($categories, $selected = [], $ignore_id = null)
{
    $i = 0;
    foreach ($categories as $key => $category) {

        $disabled = $ignore_id == $category->id ? "disabled" : '';
        $confirm = '';
        if (is_array($selected)) {
            if (in_array($category->id, $selected)) {
                $confirm = "selected";
            }
        } elseif (!is_array($selected)) {
            if ($category->id == $selected) {
                $confirm = "selected";
            }
        }

        echo "<option " . $confirm . " value=" . $category->id . " " . $disabled . ">" . $category->name . "</option>";
        if (!empty($category->childrenCategories)) {
            foreach ($category->childrenCategories as $childCategory) {
                echo childCategory($childCategory, $selected, $i, $ignore_id);
            }

        }
    }
}

function childCategory($child_category, $select = [], $i = 0, $ignore_id = null)
{
    $i++;

    $confirm = '';
    if (is_array($select)) {
        if (in_array($child_category->id, $select)) {
            $confirm = "selected";
        }
    } elseif (!is_array($select)) {
        if ($child_category->id == $select) {
            $confirm = "selected";
        }
    }
    $nbsp = '';
    for ($j = 0; $j < $i; $j++) {
        $nbsp .= '¦– ';
    }

    $disabled = $ignore_id == $child_category->id ? "disabled" : '';


    echo $html = "<option " . $disabled . " " . $confirm . " value=" . $child_category->id . " > " . $nbsp . "
    " . $child_category->name . "</option>";

    if ($child_category->categories) {
        foreach ($child_category->categories as $key => $childCategory) {
            return childCategory($childCategory, $select, $i, $ignore_id);
        }
    }


}


function mediasection($array = [], $blade_name = "flatmedia")
{
    $title = $array['title'] ?? 'Image';
    $preview_class = $array['preview_class'] ?? 'input_preview';
    $preview = $array['preview'] ?? 'admin/img/img/placeholder.png';
    $input_id = $array['input_id'] ?? 'preview';
    $input_class = $array['input_class'] ?? 'input_image';
    $input_name = $array['input_name'] ?? 'preview';
    $value = $array['value'] ?? '';
    return view('components.media.' . $blade_name, compact('title', 'preview_class', 'preview', 'input_id', 'input_class', 'input_name', 'value'));
}

function mediasectionmulti($array = [], $blade_name = "multimediasection1")
{
    $title = $array['title'] ?? 'Image';
    $preview_id = $array['preview_id'] ?? 'preview';
    $preview = $array['preview'] ?? 'admin/img/img/placeholder.png';
    $input_id = $array['input_id'] ?? 'preview_input';
    $input_class = $array['input_class'] ?? 'input_image';
    $input_name = $array['input_name'] ?? 'preview';
    $area_id = $array['area_id'] ?? 'gallary-img';
    $value = $array['value'] ?? [];
    $preview_class = $array['preview_class'] ?? 'multi_gallery';
    return view('components.media.' . $blade_name, compact('title', 'preview_class', 'preview_id', 'preview', 'input_id', 'input_class', 'input_name', 'value', 'area_id'));
}

function mediasingle()
{
    return view('components.media.mediamodal');
}


function content_format($data)
{
    return view('components.content', compact('data'));
}


function id()
{
    return "38248491";
}


function currency_format($amount,$type="icon")
{
    $format = get_option('currency_info',true);
    $currency_position=$format->currency_position ?? 'left';
    $currency_name=$format->currency_name ?? 'USD';
    $currency_icon=$format->currency_icon ?? '$';
    $number=number_format($amount,2);
    if ($type == "icon") {

        if ($currency_position=="right") {

            return $number.$currency_icon;

        }
        else{

            return $currency_icon.$number;
        }
    }
    else{

        if ($currency_position=="right") {
            return $currency_name.' '.$number;
        }
        else{
            return $currency_name.' '.$number;
        }
    }
}

function RenderMenu($position, $path = 'components.menu')
{
    $locale = Session::get('locale');

    $menus = cache()->remember($position . $locale, 300, function () use ($position, $locale) {

        $menus = Menu::where([
            'position' => $position,
            'lang' => $locale,
            'status' => 1
        ])->first();

        $data['data'] = json_decode($menus->data ?? '');
        $data['name'] = $menus->name ?? '';
        return $data;
    });


    return view($path . '.parent', compact('menus'));
}

if (!function_exists('formatted_date')) {
    /**
     * Format the Date or Custom object
     * @param $date
     * @return string
     */
    function formatted_date($date, $format = 'd M, Y'): string
    {
        return Date::parse($date)->format($format);
    }
}

if (!function_exists('defaultcurrency')) {
    /**
     * Get default currency
     * @return object|string|integer
     */
    function defaultcurrency($key = null)
    {
        $currency = (object)[
            'currency' => 'USD',
            'rate' => 1
        ];

        if ($key) {
            return $currency->$key;
        }

        return $currency;
    }
}

if (!function_exists('getcurrencyrate')) {
    /**
     * Get Default Currency Rate based on Base currency rate
     * @param $rate
     * @return float|int
     */
    function getcurrencyrate($rate): float|int
    {
        return (defaultcurrency()->rate * $rate);
    }
}


if (!function_exists('remember_cache')){
    /**
     * This function will remember the cache
     * @param string $key
     * @param callable $callback
     * @param integer $ttl
     * @return mixed
     */
    function remember_cache($key, $callback, $ttl = null){
        return cache()->remember($key, $ttl ?? env('CACHE_LIFETIME') ?? 1800, $callback);
    }
}

if(!function_exists('current_locale')){
    /**
     * Return current locale|lang
     * @return string
     */
    function current_locale(): string
    {
        return app()->getLocale();
    }
}

if (!function_exists('will_expire')){
    function will_expire(App\Models\Plan $plan){
        if (empty($plan)) {
            return \Illuminate\Support\Carbon::now()->addDays(9999)->toDateString();
        }
        elseif ($plan->days == -1) {
            return \Illuminate\Support\Carbon::now()->addDays(9999)->toDateString();
        }
        else{
            return \Illuminate\Support\Carbon::now()->addDays($plan->days)->toDateString();
        }
    }
}

if (!function_exists('get_yt_thumbnail')){
    /**
     * Get YouTube video thumbnail from YouTube video URl
     * @param string $link
     * @return string
     */
    function get_yt_thumbnail(string $link, $size = 'low'): string
    {
        $size = match ($size){
            'low', 'default' => 'sddefault',
            'medium' => 'mqdefault',
            'high' => 'hqdefault',
            'max' => 'maxresdefault'
        };

        $video_id = explode("?v=", $link);
        $video_id = $video_id[1];
        return "https://img.youtube.com/vi/".$video_id."/".$size.".jpg";
    }
}

if (!function_exists('get_gravatar')) {

    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d Default imageset to use [ 404 | mp | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param boolean $img True to return a complete IMG tag False for just the URL
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source https://gravatar.com/site/implement/images/php/
     **/
    function get_gravatar($email, $s = 80, $d = 'mp', $r = 'g', $img = false, $atts = array()): string
    {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r";
        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($atts as $key => $val)
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }
}


if (!function_exists('getmoney')) {
    function getmoney($amount, $rate)
    {
        return number_format($amount * getcurrencyrate($rate), 2);
    }
}

if (!function_exists('phoneCodes')) {
    function phoneCodes()
    {
        $codes=file_get_contents(base_path('phonecode.json'));
        $codes=json_decode($codes);

        return $codes;
    }
}
if (!function_exists('countries')) {
    function countries()
    {
        $codes=file_get_contents(base_path('countries.json'));
        $codes=json_decode($codes);

        return $codes;
    }
}

if (!function_exists('phone_verify')) {
    function phone_verify($message, $recipient)
    {
        $twilio_creds = Option::where('key','twilio_info')->first();
        $twilio_creds = json_decode($twilio_creds->value);
        $account_sid = $twilio_creds->twilio_sid;
        $auth_token = $twilio_creds->twilio_auth_token;
        $twilio_number = $twilio_creds->twilio_number;
        $client = new Client($account_sid, $auth_token);

        $client->messages->create(
            // Where to send a text message (your cell phone?)
            $recipient,
            array(
                'from' => $twilio_number,
                'body' => $message
            )
        );

    }
}

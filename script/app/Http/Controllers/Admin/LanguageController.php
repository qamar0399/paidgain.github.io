<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use App\Models\Option;
use Auth;
use App\Category;
use App\Categorymeta;
use Cache;

class LanguageController extends Controller
{
    public function __construct()
    {
        // Check user permission using spatie middleware
        $this->middleware('permission:language.index')->only('index', 'show');
        $this->middleware('permission:language.create')->only('create', 'store', 'add_key');
        $this->middleware('permission:language.edit')->only('edit', 'update', 'setActiveLanguage');
        $this->middleware('permission:language.delete')->only('destroy');
    }

    public function index()
    {
        $posts = Option::where('key', 'languages')->first();
        $posts = json_decode($posts->value ?? '');
        $actives = Option::where('key', 'active_languages')->first();
        if (!empty($actives)) {
            $actives = json_decode($actives->value);
            $data = [];
            foreach ($actives as $key => $value) {
                array_push($data, $key);
            }
            $actives = $data;
        } else {
            $actives = [];
        }
        return view('admin.language.index', compact('posts', 'actives'));

    }

    public function create(Request $request)
    {
        if (!Auth()->user()->can('language.create')) {
            return abort(401);
        }

        $countries = base_path('resources/lang/langlist.json');
        $countries = json_decode(file_get_contents($countries), true);

        return view('admin.language.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $file = base_path('resources/lang/default.json');
        $file = file_get_contents($file);
        \File::put(base_path('resources/lang/' . $request->language_code . '.json'), $file);

        $arr = [];

        $langlist = Option::where('key', 'languages')->first();
        if (!empty($langlist)) {
            $langs = json_decode($langlist->value);
            foreach ($langs as $key => $value) {
                $arr[$key] = $value;
            }
        }

        $arr[$request->language_code] = $request->name;

        if (empty($langlist)) {
            $langlist = new Option;
            $langlist->key = 'languages';
        }
        $langlist->value = json_encode($arr);
        $langlist->save();

        return response()->json(__('Language Created'));
    }

    public function add_key(Request $request)
    {
        $file = base_path('resources/lang/' . $request->id . '.json');
        $posts = file_get_contents($file);
        $posts = json_decode($posts);
        foreach ($posts ?? [] as $key => $row) {
            $data[$key] = $row;
        }
        $data[$request->key] = $request->value;

        \File::put(base_path('resources/lang/' . $request->id . '.json'), json_encode($data, JSON_PRETTY_PRINT));
        return response()->json(__('Key Added'));
    }

    public function show($id)
    {
        if (!Auth()->user()->can('language.edit')) {
            return abort(401);
        }

        $file = base_path('resources/lang/' . $id . '.json');
        $posts = file_get_contents($file);
        $posts = json_decode($posts);
        return view('admin.language.edit', compact('posts', 'id'));
    }

    public function update(Request $request, $id)
    {
        $data = [];
        foreach ($request->values as $key => $row) {
            $data[$key] = $row;
        }
        $file = json_encode($data, JSON_PRETTY_PRINT);
        \File::put(base_path('resources/lang/' . $id . '.json'), $file);

        return response()->json(__('Changes Saved'));
    }

    public function setActiveLanguage(Request $request)
    {
        $posts = Option::where('key', 'active_languages')->first();
        $actives = json_decode($posts->value ?? '');
        $active_languages = [];

        foreach ($request->ids as $key => $value) {

            foreach ($value as $k => $row) {
                $active_languages[$row] = $k;
            }
        }
        if (empty($posts)) {
            $posts = new Option;
            $posts->key = 'active_languages';
        }
        $posts->value = json_encode($active_languages);
        $posts->save();

        Cache::forget('active_languages');
        return response()->json(__('Language Activated'));
    }

    public function destroy($id)
    {
        $posts = Option::where('key', 'languages')->first();
        $actives_lang = Option::where('key', 'active_languages')->first();


        $post = json_decode($posts->value ?? []);
        $actives = json_decode($actives_lang->value ?? '');

        $data = [];
        foreach ($post as $key => $row) {
            if ($id != $key) {
                $data[$key] = $row;
            }
        }

        $posts->value = json_encode($data);
        $posts->save();

        if (file_exists(base_path('resources/lang/' . $id . '.json'))) {
            unlink(base_path('resources/lang/' . $id . '.json'));
        }

        return redirect()->back()->with('success', __('Language Successfully Deleted'));
    }
}

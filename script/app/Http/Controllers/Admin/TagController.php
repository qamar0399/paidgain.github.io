<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Str;
use Auth;

class TagController extends Controller
{
    public function __construct()
    {
        // Check user permission using spatie middleware
        $this->middleware('permission:tag.list')->only('index', 'show');
        $this->middleware('permission:tag.create')->only('create', 'store', 'makeSlug');
        $this->middleware('permission:tag.edit')->only('edit', 'update');
        $this->middleware('permission:tag.delete')->only('destroy');
    }

    public function index(Request $request)
    {
        $posts = Category::where('type', 'tag')->latest();

        if (isset($request->src)) {
            $posts = $posts->where('name', 'LIKE', '%' . $request->src . '%');
        }

        $posts = $posts->paginate(20);

        return view("admin.tag.index", compact('posts', 'request'));
    }

    public function create()
    {
        return view("admin.tag.create");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
        ]);

        $tag = new Category;
        $tag->name = $request->name;
        $tag->slug = $this->makeSlug($request->name, 'tag');
        $tag->type = 'tag';
        $tag->featured = $request->featured;
        $tag->status = $request->status;
        $tag->lang = $request->lang ?? 'en';
        $tag->save();

        return response()->json(__('Tag Created Successfully'));
    }

    public function show($id)
    {
        return view("admin.tag.show");
    }

    public function edit($id)
    {
        $info = Category::where('type', 'tag')->findorFail($id);
        return view("admin.tag.edit", compact('info'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
        ]);

        $tag = Category::where('type', 'tag')->findorFail($id);
        $tag->name = $request->name;
        $tag->slug = $request->slug;
        $tag->featured = $request->featured;
        $tag->status = $request->status ?? 0;
        $tag->lang = $request->lang ?? 'en';
        $tag->save();

        return response()->json(__('Tag Updated Successfully'));
    }

    public function destroy($id)
    {
        $tag = Category::destroy($id);
        return redirect()->back()->with('success', __('Tag Successfully Deleted'));
    }

    public function makeSlug($title, $type)
    {
        $slug_gen = Str::slug($title);
        $slug = Category::where('type', $type)->where('slug', $slug_gen)->count();
        if ($slug > 0) {
            $slug_count = $slug + 1;
            $slug = $slug_gen . $slug_count;
            return $this->makeSlug($slug, $type);
        }
        return $slug_gen;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blogs\StoreBlogRequest;
use App\Http\Requests\Blogs\UpdateBlogRequest;
use App\Models\Term;
use App\Models\Termmeta;
use Illuminate\Http\Request;
use Illuminate\Support\str;
use Storage;
use DB;
use Auth;
use Cache;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $posts = Term::query();
        if (!empty($request->src)) {
            $posts = $posts->where('title', 'LIKE', '%' . $request->src . '%');
        }
        $posts = $posts->with('preview')->where('type', 'blog')->latest()->paginate(20);
        return view('admin.blog.index', compact('posts', 'request'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(StoreBlogRequest $request)
    {
        DB::beginTransaction();
        try {
            // Term Data Store
            $post = new Term();
            $post->user_id = auth()->id();
            $post->title = $request->name;
            $post->slug = Str::slug($request->name);
            $post->type = 'blog';
            $post->status = $request->status;
            $post->featured = $request->featured;
            $post->lang = $request->lang ?? 'en';
            $post->comment_status = $request->comment_status ?? 0;
            $post->save();

            $post->meta()->create([
                'key' => 'excerpt',
                'value' => $request->excerpt
            ]);

            if (isset($request->preview)) {
                $post->meta()->create([
                    'key' => 'preview',
                    'value' => $request->preview
                ]);
            }

            $post->meta()->create([
                'key' => 'description',
                'value' => $request->description
            ]);

            if ($request->categories) {
                $post->categories()->attach($request->categories);
            }

            cache()->forget('website.blog_'.current_locale());

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $errors['errors']['error'] = __('Oops something wrong');
            return response()->json($errors, 401);
        }
        Cache::forget('blog' . $request->lang);

        return response()->json(__('Blog Added Successfully'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $info = Term::query()->with('tags', 'excerpt', 'description', 'termcategories', 'preview')->findOrFail($id);
        $selected_categories = [];

        foreach ($info->termcategories as $key => $value) {
            array_push($selected_categories, $value->category_id);
        }
        return view('admin.blog.edit', compact('info', 'selected_categories'));
    }

    public function update(UpdateBlogRequest $request, $id)
    {
        // Term Data Update
        DB::beginTransaction();
        try {
            $term = Term::where('type', 'blog')->with('excerpt', 'description', 'termcategories')->findorFail($id);
            $term->title = $request->name;
            $term->slug = $request->slug;
            $term->status = $request->status;
            $term->featured = $request->featured;
            $term->lang = $request->lang ?? 'en';
            $term->comment_status = $request->comment_status ?? 0;
            $term->save();

            if ($request->excerpt) {
                if (empty($term->excerpt)) {
                    $term->excerpt()->create(['key' => 'excerpt', 'value' => $request->excerpt]);
                } else {
                    $term->excerpt()->update(['value' => $request->excerpt]);
                }
            } else {
                if (!empty($term->excerpt)) {
                    $term->excerpt()->delete();
                }
            }

            if ($request->description) {
                if (empty($term->description)) {
                    $term->description()->create(['key' => 'description', 'value' => $request->description]);
                } else {
                    $term->description()->update(['value' => $request->description]);
                }
            } else {
                if (!empty($term->description)) {
                    $term->description()->delete();
                }
            }

            if ($request->preview) {
                if (empty($term->preview)) {
                    $term->preview()->create(['key' => 'preview', 'value' => $request->preview]);
                } else {
                    $term->preview()->update(['value' => $request->preview]);
                }
            } else {
                if (!empty($term->preview)) {
                    $term->preview()->delete();
                }
            }

            $cats = [];
            foreach ($request->categories ?? [] as $r) {
                if (!empty($r)) {
                    array_push($cats, $r);
                }
            }

            !empty($term->categories) ? $term->categories()->sync($cats) : $term->categories()->attach($cats);

            cache()->forget('website.blog_'.current_locale());

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollback();
            $errors['errors']['error'] = __('Oops something wrong');
            return response()->json($errors, 401);
        }

        return response()->json('Blog Updated Successfully');
    }

    public function destroy(Term $blog)
    {
        $blog->delete();
        cache()->forget('website.blog_'.current_locale());
        return redirect()->back()->with('success', __('Blog Deleted Successfully'));
    }
}

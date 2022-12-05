<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        // Check user permission using spatie middleware
        $this->middleware('permission:category.list')->only('index', 'show');
        $this->middleware('permission:category.create')->only('create', 'store');
        $this->middleware('permission:category.update')->only('edit', 'update');
        $this->middleware('permission:category.delete')->only('destroy');
    }

    public function index(Request $request)
    {
        $posts = Category::where('type', 'blog_category')->with('preview');

        if (isset($request->src)) {
            $posts = $posts->where('name', 'LIKE', '%' . $request->src . '%');
        }
        $posts = $posts->latest()->paginate(20);
        return view("admin.category.index", compact('posts', 'request'));
    }

    public function create()
    {
        return view("admin.category.create");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'description' => 'max:250'
        ]);

        DB::beginTransaction();
        try {
            $category = new Category;
            if (isset($request->slug)) {
                $slug = $request->slug;
            } else {
                $slug = $category->makeSlug($request->name, $request->type);
            }

            $category->name = $request->name;
            $category->type = $request->type ?? 'blog_category';
            $category->slug = $slug;
            $category->featured = $request->featured ?? 0;
            $category->menu_status = $request->menu_status ?? 0;
            $category->lang = $request->lang ?? 'en';
            if (isset($request->category_id)) {
                $category->category_id = $request->category_id;
            }
            $category->save();

            if ($request->description) {
                $category->meta()->create(['type' => 'description', 'value' => $request->description]);
            }

            if ($request->preview) {
                $category->meta()->create(['type' => 'preview', 'value' => $request->preview]);
            }

            if ($request->icon) {
                $category->meta()->create(['type' => 'icon', 'value' => $request->icon]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $errors['errors']['error'] = 'Opps something wrong';
            return response()->json($errors, 401);
        }

        $type = ucfirst(str_replace('_', ' ', $request->type));

        return response()->json($type . ' Created Successfully...!!!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        abort_if(!Auth()->user()->can('category.edit'), 401);
        $info = Category::with('description', 'preview')->where('type', 'blog_category')->findorFail($id);
        return view("admin.category.edit", compact('info'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'description' => 'max:250'
        ]);

        DB::beginTransaction();
        try {
            $category = Category::findorFail($id);
            $slug = $request->slug;

            $category->name = $request->name;
            $category->slug = $slug;
            $category->category_id = $request->category_id ?? null;
            $category->featured = $request->featured ?? 0;
            $category->menu_status = $request->menu_status ?? 0;
            $category->lang = $request->lang ?? 'en';
            $category->save();

            if ($request->description) {
                if (empty($category->description)) {
                    $category->description()->create(['type' => 'description', 'value' => $request->description]);
                } else {
                    $category->description()->update(['value' => $request->description]);
                }
            } else {
                if (!empty($category->description)) {
                    $category->description()->delete();
                }
            }

            if ($request->preview) {
                if (empty($category->preview)) {
                    $category->preview()->create(['type' => 'preview', 'value' => $request->preview]);
                } else {
                    $category->preview()->update(['value' => $request->preview]);
                }
            } else {
                if (!empty($category->preview)) {
                    $category->preview()->delete();
                }
            }

            if ($request->icon) {
                if (empty($category->icon)) {
                    $category->icon()->create(['type' => 'icon', 'value' => $request->icon]);
                } else {
                    $category->icon()->update(['value' => $request->icon]);
                }
            } else {
                if (!empty($category->preview)) {
                    $category->icon()->delete();
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $errors['errors']['error'] = __('Oops something wrong');
            return response()->json($errors, 401);
        }

        $type = ucfirst(str_replace('_', ' ', $request->type));

        return response()->json($type .  __('Category Updated Successfully'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', __('Category Deleted Successfully'));
    }
}

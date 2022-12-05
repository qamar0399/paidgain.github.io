<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Category;
use Cache;

class ReviewController extends Controller
{
        public function index(Request $request)
    {
        $posts = Category::where('type', 'review')->with('preview');

        if (isset($request->src)) {
            $posts = $posts->where('name', 'LIKE', '%' . $request->src . '%');
        }
        $posts = $posts->latest()->paginate(20);
        return view("admin.review.index", compact('posts', 'request'));
    }

    public function create()
    {
        return view("admin.review.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'rating' => 'required|numeric|gt:0|lt:6',
        ]);

        DB::beginTransaction();
        try {
            $review = new Category;

            $review->name = $request->name;
            $review->type = $request->type ?? 'review';
            $review->slug = $request->rating;
            $review->featured = $request->featured ?? 0;
            $review->menu_status = $request->menu_status ?? 0;

            $review->save();

            if ($request->description) {
                $review->meta()->create(['type' => 'description', 'value' => $request->description]);
            }

            if ($request->preview) {
                $review->meta()->create(['type' => 'preview', 'value' => $request->preview]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
            $errors['errors']['error'] = 'Oops something wrong';
            return response()->json($errors, 401);
        }

        $type = ucfirst(str_replace('_', ' ', $request->type));

        Cache::forget('featured_reviews');

        return response()->json($type . ' Created Successfully...!!!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $info = Category::with('description', 'preview')->where('type', 'review')->findorFail($id);
        return view("admin.review.edit", compact('info'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
        ]);

        DB::beginTransaction();
        try {
            $review = Category::findorFail($id);
            $slug = $request->slug;

            $review->name = $request->name;
            $review->slug = $slug;
            $review->status = $request->status;
            $review->save();

            if ($request->description) {
                if (empty($review->description)) {
                    $review->description()->create(['type' => 'description', 'value' => $request->description]);
                } else {
                    $review->description()->update(['value' => $request->description]);
                }

            } else {
                if (!empty($review->description)) {
                    $review->description()->delete();
                }
            }

            if ($request->preview) {
                if (empty($review->preview)) {
                    $review->preview()->create(['type' => 'preview', 'value' => $request->preview]);
                } else {
                    $review->preview()->update(['value' => $request->preview]);
                }

            } else {
                if (!empty($review->preview)) {
                    $review->preview()->delete();
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
            $errors['errors']['error'] = 'Opps something wrong';
            return response()->json($errors, 401);
        }

        $type = ucfirst(str_replace('_', ' ', $request->type));
        Cache::forget('featured_reviews');
        return response()->json($type . ' Updated...!!!');
    }

    public function destroy($id)
    {
        $review = Category::destroy($id);
        Cache::forget('featured_reviews');
        return back();
    }
}

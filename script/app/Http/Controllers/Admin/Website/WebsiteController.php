<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Categorymeta;
use App\Models\Option;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    // Top Investors
    public function topInvestors()
    {
        $top_investors = Category::whereIn('categories.type', [
            'top_investors',
        ])
            ->leftJoin('categorymetas', 'categories.id', '=', 'categorymetas.category_id')
            ->select([
                'categories.*',
                'categorymetas.value as info'
            ])
            ->withCasts([
                'info' => 'array'
            ])
            ->get();

        return view('admin.website.topinvestors.index', compact('top_investors'));
    }

    public function addTopInvestor()
    {
        return view('admin.website.topinvestors.add');
    }

    public function storeTopInvestor(Request $request)
    {
        $this->topInvestorsCrud($request, new Category());

        return response()->json(__('Top Investor Created Successfully'));
    }

    public function editTopInvestor(Category $investor)
    {
        $meta = Categorymeta::whereCategoryId($investor->id)->withCasts(['value' => 'array'])->first();

        return view('admin.website.topinvestors.edit', compact('investor','meta'));
    }

    public function updateTopInvestor(Request $request, Category $investor)
    {
        $this->topInvestorsCrud($request, $investor);
        return response()->json(__('Top Investor Updated Successfully'));
    }

    private function topInvestorsCrud(Request $request, Category $category){
        $request->validate([
            'name' => ['required', 'string'],
            'total_invest' => ['required', 'string'],
            'photo' => ['required', 'string'],
            'featured' => ['nullable', 'string']
        ]);

        $category->type = 'top_investors';
        $category->name = $request->name;
        $category->other = $request->total_invest;
        $category->featured = $request->has('featured');
        $category->save();

        Categorymeta::set($category->id, 'info', json_encode([
            'photo' => $request->photo
        ]));

        cache()->forget('website.top_investors_'.current_locale());

       return $category;
    }

    public function deleteTopInvestor(Category $investor)
    {
        $investor->delete();
        cache()->forget('website.top_investors_'.current_locale());
        return redirect()->back()->with('success', __('Top Investor Deleted Successfully'));
    }

    // Top Investors
    public function faq()
    {
        $languages = Option::where('key', '=', 'languages')
            ->withCasts(['value' => 'array'])
            ->select(['value'])
            ->first();

        $categories = Category::whereType('faq')->get();

        $faqs = [];
        foreach ($categories as $category) {
            $faqs[$category->lang][] = $category;
        }

        return view('admin.website.faq.index', compact('languages', 'faqs'));
    }

    public function addFaq()
    {
        $languages = Option::where('key', '=', 'languages')
            ->withCasts(['value' => 'array'])
            ->select(['value'])
            ->first();

        return view('admin.website.faq.add', compact('languages'));
    }

    public function storeFaq(Request $request)
    {
        $this->faqCrudAction($request, new Category());
        return response()->json(__('FAQ Created Successfully'));
    }

    public function editFaq(Category $faq)
    {
        $languages = Option::where('key', '=', 'languages')
            ->withCasts(['value' => 'array'])
            ->select(['value'])
            ->first();

        return view('admin.website.faq.edit', compact('languages', 'faq'));
    }

    public function updateFaq(Request $request, Category $faq)
    {
        $this->faqCrudAction($request, $faq);
        return response()->json(__('FAQ Updated Successfully'));
    }

    private function faqCrudAction(Request $request, Category $category){
        $request->validate([
            'lang' => ['required', 'string'],
            'question' => ['required', 'string'],
            'answer' => ['required', 'string'],
        ]);

        $category->type = 'faq';
        $category->lang = $request->lang;
        $category->name = $request->question;
        $category->other = $request->answer;
        $category->save();

        cache()->forget('website.faqs_'.current_locale());

        return $category;
    }

    public function deleteFaq(Category $faq)
    {
        $faq->delete();
        return redirect()->back()->with('success', __('FAQ Deleted Successfully'));
    }
}

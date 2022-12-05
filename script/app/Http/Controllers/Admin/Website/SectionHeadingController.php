<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Categorymeta;
use App\Models\Option;
use DB;
use Illuminate\Http\Request;
use Throwable;

class SectionHeadingController extends Controller
{
    public function index()
    {
        $languages = Option::where('key', '=', 'languages')
            ->withCasts(['value' => 'array'])
            ->select(['value'])
            ->first();

        $categories = Category::whereIn('categories.type', [
            'heading.welcome',
            'heading.features',
            'heading.member_benefits',
            'heading.member_info',
            'heading.advertise_benefits',
            'heading.payouts',
            'heading.join_us',
            'heading.our_team',
            'heading.top_investor',
            'heading.client_review',
            'heading.blog_news',
            'heading.contact',
            'heading.earn_money',
            'heading.price_plan',
            'heading.faq',
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

        $data = [];

        foreach ($categories as $index => $category) {
            $data[$category->type][$category->lang] = $category;
        }

        $tableData = [];
        $categories = Category::whereIn('categories.type', [
            'features',
            'member_benefits',
            'advertise_benefits',
            'team_members'
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
        foreach ($categories as $index => $category) {
            $tableData[$category->type][$category->lang][] = $category;
        }

        return view('admin.website.heading', compact('languages', 'data', 'tableData'));
    }

    public function updateWelcome(Request $request)
    {
        $request->validate([
            'lang' => ['required', 'string'],
            'welcome_text' => ['required', 'string'],
            'welcome_description' => ['required', 'string'],
            'button_text' => ['required', 'string'],
            'button_url' => ['required', 'url'],
            'background_image' => ['nullable'],
            'shape_image' => ['nullable'],
            'thumb_image' => ['nullable'],
        ]);

        DB::beginTransaction();
        try {
            $category = Category::firstOrNew([
                'lang' => $request->input('lang'),
                'type' => 'heading.welcome',
            ]);

            $category->type = 'heading.welcome';
            $category->lang = $request->input('lang');
            $category->name = $request->input('welcome_text');
            $category->other = $request->input('welcome_description');
            $category->save();

            Categorymeta::set($category->id, 'info', json_encode([
                'button_text' => $request->button_text,
                'button_url' => $request->button_url,
                'welcome_description' => $request->welcome_description,
                'background_image' => $request->background_image,
                'shape_image' => $request->shape_image,
                'thumb_image' => $request->thumb_image
            ]));

            DB::commit();

            cache()->forget('website.home_' . current_locale());

            return response()->json(__('Welcome Section Updated Successfully'));
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateFeatures(Request $request)
    {
        $request->validate([
            'lang' => ['required', 'string'],
            'feature_title' => ['required', 'string'],
            'feature_description' => ['required', 'string'],
        ]);

        $category = Category::firstOrNew([
            'type' => 'heading.features',
            'lang' => $request->input('lang'),
        ]);
        $category->name = $request->input('feature_title');
        $category->other = $request->input('feature_description');
        $category->save();

        cache()->forget('website.home_' . current_locale());

        return response()->json(__('Features Section Updated Successfully'));
    }

    public function updateMemberBenefits(Request $request)
    {
        $request->validate([
            'lang' => ['required', 'string'],
            'member_benefit_title' => ['required', 'string'],
            'member_benefit_description' => ['required', 'string'],
        ]);

        $category = Category::firstOrNew([
            'type' => 'heading.member_benefits',
            'lang' => $request->input('lang'),
        ]);
        $category->name = $request->input('member_benefit_title');
        $category->other = $request->input('member_benefit_description');
        $category->save();

        Categorymeta::set($category->id, 'info', json_encode($request->meta ?? ''));

        cache()->forget('website.home_' . current_locale());

        return response()->json(__('Member Benefits Section Updated Successfully'));
    }

    public function updateMemberInfo(Request $request)
    {
        $request->validate([
            'lang' => ['required', 'string'],
            'member_info_title' => ['required', 'string'],
            'member_info_description' => ['required', 'string'],
        ]);

        $category = Category::firstOrNew([
            'type' => 'heading.member_info',
            'lang' => $request->input('lang'),
        ]);
        $category->name = $request->input('member_info_title');
        $category->other = $request->input('member_info_description');
        $category->save();

        cache()->forget('website.home_' . current_locale());

        return response()->json(__('Member Info Section Updated Successfully'));
    }

    public function updateAdvertiseBenefits(Request $request)
    {
        $request->validate([
            'lang' => ['required', 'string'],
            'advertise_benefit_title' => ['required', 'string'],
            'advertise_benefit_description' => ['required', 'string'],
        ]);

        $category = Category::firstOrNew([
            'type' => 'heading.advertise_benefits',
            'lang' => $request->input('lang'),
        ]);
        $category->name = $request->input('advertise_benefit_title');
        $category->other = $request->input('advertise_benefit_description');
        $category->save();

        cache()->forget('website.home_' . current_locale());

        return response()->json(__('Advertise Benefits Section Updated Successfully'));
    }

    public function updatePayouts(Request $request)
    {
        $request->validate([
            'lang' => ['required', 'string'],
            'top_payout_title' => ['required', 'string'],
            'top_payout_description' => ['required', 'string'],
            'image' => ['required']
        ]);

        $category = Category::firstOrNew([
            'type' => 'heading.payouts',
            'lang' => $request->input('lang'),
        ]);
        $category->name = $request->input('top_payout_title');
        $category->other = $request->input('top_payout_description');
        $category->save();

        Categorymeta::set($category->id, 'info', json_encode([
            'image' => $request->image
        ]));

        cache()->forget('website.home_' . current_locale());

        return response()->json(__('To Payout Section Updated Successfully'));
    }

    public function updateJoinUs(Request $request)
    {
        $request->validate([
            'lang' => ['required', 'string'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        $category = Category::firstOrNew([
            'type' => 'heading.join_us',
            'lang' => $request->input('lang'),
        ]);
        $category->name = $request->input('title');
        $category->other = $request->input('description');
        $category->save();

        cache()->forget('website.home_' . current_locale());

        return response()->json(__('Join Us Section Updated Successfully'));
    }

    public function updateOurTeam(Request $request)
    {
        $request->validate([
            'lang' => ['required', 'string'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        $category = Category::firstOrNew([
            'type' => 'heading.our_team',
            'lang' => $request->input('lang'),
        ]);
        $category->name = $request->input('title');
        $category->other = $request->input('description');
        $category->save();

        cache()->forget('website.home_' . current_locale());
        cache()->forget('website.about_'.current_locale());

        return response()->json(__('Our Team Section Updated Successfully'));
    }

    public function updateTopInvestor(Request $request)
    {
        $request->validate([
            'lang' => ['required', 'string'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        $category = Category::firstOrNew([
            'type' => 'heading.top_investor',
            'lang' => $request->input('lang'),
        ]);
        $category->name = $request->input('title');
        $category->other = $request->input('description');
        $category->save();

        cache()->forget('website.home_' . current_locale());
        cache()->forget('website.top_investors_' . current_locale());

        return response()->json(__('Top Investor Section Updated Successfully'));
    }

    public function updateClientReview(Request $request)
    {
        $request->validate([
            'lang' => ['required', 'string'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        $category = Category::firstOrNew([
            'type' => 'heading.client_review',
            'lang' => $request->input('lang'),
        ]);
        $category->name = $request->input('title');
        $category->other = $request->input('description');
        $category->save();

        cache()->forget('website.home_' . current_locale());

        return response()->json(__('Client Review Section Updated Successfully'));
    }

    public function updateBlogNews(Request $request)
    {
        $request->validate([
            'lang' => ['required', 'string'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        $category = Category::firstOrNew([
            'type' => 'heading.blog_news',
            'lang' => $request->input('lang'),
        ]);
        $category->name = $request->input('title');
        $category->other = $request->input('description');
        $category->save();

        cache()->forget('website.home_' . current_locale());

        return response()->json(__('Blog News Section Updated Successfully'));
    }

    public function updateContact(Request $request)
    {
        $request->validate([
            'lang' => ['required', 'string'],
            'contact_text' => ['required', 'string'],
            'contact_description' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string'],
            'address' => ['required', 'string'],
            'code' => ['nullable', 'string'],
        ]);

        $category = Category::firstOrNew([
            'type' => 'heading.contact',
            'lang' => $request->input('lang'),
        ]);
        $category->name = $request->input('contact_text');
        $category->other = $request->input('contact_description');
        $category->save();

        Categorymeta::set($category->id, 'info', json_encode([
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'code' => $request->input('code'),
        ]));
        cache()->forget('website.contact_' . current_locale());

        return response()->json(__('Contact Section Updated Successfully'));
    }

    public function updateEarnMoney(Request $request)
    {
        $request->validate([
            'lang' => ['required', 'string'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        $category = Category::firstOrNew([
            'type' => 'heading.earn_money',
            'lang' => $request->input('lang'),
        ]);
        $category->name = $request->input('title');
        $category->other = $request->input('description');
        $category->save();

        cache()->forget('website.home_' . current_locale());
        cache()->forget('website.earn_money_' . current_locale());

        return response()->json(__('Earn Money Section Updated Successfully'));
    }

    public function updatePricePlan(Request $request)
    {
        $request->validate([
            'lang' => ['required', 'string'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        $category = Category::firstOrNew([
            'type' => 'heading.price_plan',
            'lang' => $request->input('lang'),
        ]);
        $category->name = $request->input('title');
        $category->other = $request->input('description');
        $category->save();

        cache()->forget('website.home_' . current_locale());
        cache()->forget('website.priceplans_'.current_locale());

        return response()->json(__('Price Plan Section Updated Successfully'));
    }

    public function updateFaq(Request $request)
    {
        $request->validate([
            'lang' => ['required', 'string'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        $category = Category::firstOrNew([
            'type' => 'heading.faq',
            'lang' => $request->input('lang'),
        ]);
        $category->name = $request->input('title');
        $category->other = $request->input('description');
        $category->save();

        cache()->forget('website.home_' . current_locale());
        cache()->forget('website.faq_'.current_locale());
        cache()->forget('website.faqs_'.current_locale());


        return response()->json(__('Faq Section Updated Successfully'));
    }



    public function addFeature()
    {
        $languages = Option::where('key', '=', 'languages')
            ->withCasts(['value' => 'array'])
            ->select(['value'])
            ->first();

        return view('admin.website.features.addfeature', compact('languages'));
    }

    public function storeFeature(Request $request)
    {
        $this->featureCrud($request, new Category());

        return response()->json(__('Feature Created Successfully'));
    }

    private function featureCrud(Request $request, Category $category)
    {
        $request->validate([
            'lang' => ['required', 'string'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image_' . $request->lang => ['required'],
            'featured' => ['nullable', 'string']
        ]);

        DB::beginTransaction();
        try {
            $category->type = 'features';
            $category->lang = $request->lang;
            $category->name = $request->title;
            $category->other = $request->description;
            $category->featured = $request->has('featured');
            $category->save();

            Categorymeta::set($category->id, 'info', json_encode([
                'image' => $request->input('image_' . $request->lang)
            ]));

            DB::commit();

            cache()->forget('website.home_' . current_locale());
        } catch (Throwable $e) {
            throw $e;
        }
    }

    public function editFeature(Category $feature)
    {
        $languages = Option::where('key', '=', 'languages')
            ->withCasts(['value' => 'array'])
            ->select(['value'])
            ->first();

        $meta = Categorymeta::whereCategoryId($feature->id)->withCasts(['value' => 'array'])->first();

        return view('admin.website.features.editfeature', compact('languages', 'feature', 'meta'));
    }

    public function updateFeature(Request $request, Category $feature)
    {
        $this->featureCrud($request, $feature);

        return response()->json(__('Feature Updated Successfully'));
    }

    public function deleteFeature(Category $feature)
    {
        $feature->delete();

        cache()->forget('website.home_' . current_locale());

        return redirect()->back()->with('success', __('Feature Deleted Successfully'));
    }


    // Members Benefit

    public function addMemberBenefit()
    {
        $languages = Option::where('key', '=', 'languages')
            ->withCasts(['value' => 'array'])
            ->select(['value'])
            ->first();

        return view('admin.website.memberbenefits.addbenefit', compact('languages'));
    }

    public function storeMemberBenefit(Request $request)
    {
        $this->memberBenefitCrud($request, new Category());
        return response()->json(__('Member Benefit Created Successfully'));
    }

    private function memberBenefitCrud(Request $request, Category $category)
    {
        $request->validate([
            'lang' => ['required', 'string'],
            'title' => ['required', 'string'],
            'featured' => ['nullable', 'string']
        ]);

        $category->type = 'member_benefits';
        $category->lang = $request->lang;
        $category->name = $request->title;
        $category->featured = $request->has('featured');
        $category->save();

        cache()->forget('website.home_' . current_locale());
    }

    public function editMemberBenefit(Category $benefit)
    {
        $languages = Option::where('key', '=', 'languages')
            ->withCasts(['value' => 'array'])
            ->select(['value'])
            ->first();

        $meta = Categorymeta::whereCategoryId($benefit->id)->withCasts(['value' => 'array'])->first();

        return view('admin.website.memberbenefits.editbenefit', compact('languages', 'benefit', 'meta'));
    }

    public function updateMemberBenefit(Request $request, Category $benefit)
    {
        $this->memberBenefitCrud($request, $benefit);
        return response()->json(__('Member Benefit Updated Successfully'));
    }

    public function deleteMemberBenefit(Category $benefit)
    {
        $benefit->delete();
        return redirect()->back()->with('success', __('Member Benefit Deleted Successfully'));
    }

    // Advertise Benefit

    public function addAdvertiseBenefit()
    {
        $languages = Option::where('key', '=', 'languages')
            ->withCasts(['value' => 'array'])
            ->select(['value'])
            ->first();

        return view('admin.website.advertisebenefits.addbenefit', compact('languages'));
    }

    public function storeAdvertiseBenefit(Request $request)
    {
        $this->advertiseBenefitCrud($request, new Category());
        return response()->json(__('Advertise Benefit Created Successfully'));
    }

    private function advertiseBenefitCrud(Request $request, Category $category)
    {
        $request->validate([
            'lang' => ['required', 'string'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image_' . $request->lang => ['required'],
            'featured' => ['nullable', 'string']
        ]);

        DB::beginTransaction();
        try {
            $category->type = 'advertise_benefits';
            $category->lang = $request->lang;
            $category->name = $request->title;
            $category->other = $request->description;
            $category->featured = $request->has('featured');
            $category->save();

            Categorymeta::set($category->id, 'info', json_encode([
                'image' => $request->input('image_' . $request->lang)
            ]));

            DB::commit();

            cache()->forget('website.home_' . current_locale());
        } catch (Throwable $e) {
            throw $e;
        }
    }

    public function editAdvertiseBenefit(Category $benefit)
    {
        $languages = Option::where('key', '=', 'languages')
            ->withCasts(['value' => 'array'])
            ->select(['value'])
            ->first();

        $meta = Categorymeta::whereCategoryId($benefit->id)->withCasts(['value' => 'array'])->first();

        return view('admin.website.advertisebenefits.editbenefit', compact('languages', 'benefit', 'meta'));
    }

    public function updateAdvertiseBenefit(Request $request, Category $benefit)
    {
        $this->advertiseBenefitCrud($request, $benefit);
        return response()->json(__('Advertise Benefit Updated Successfully'));
    }

    public function deleteAdvertiseBenefit(Category $benefit)
    {
        $benefit->delete();
        cache()->forget('website.home_' . current_locale());
        return redirect()->back()->with('success', __('Advertise Deleted Successfully'));
    }
}

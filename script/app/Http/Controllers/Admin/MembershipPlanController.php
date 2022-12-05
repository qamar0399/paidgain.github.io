<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MembershipPlans\StoreMembershipPlanRequest;
use App\Http\Requests\MembershipPlans\UpdateMembershipPlanRequest;
use App\Models\Category;
use App\Models\Plan;
use Illuminate\Http\Request;

class MembershipPlanController extends Controller
{
    public function __construct()
    {
        // Check user permission using spatie middleware
        $this->middleware('permission:membership_plan.index')->only('index', 'show');
        $this->middleware('permission:membership_plan.create')->only('create', 'store');
        $this->middleware('permission:membership_plan.edit')->only('edit', 'update');
        $this->middleware('permission:membership_plan.delete')->only('destroy');
    }

    /**
     * Display the list of advertisements
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $membershipPlans = Plan::query()
            ->withCount('users')
            ->when($request->get('src'), function ($query) use ($request){
                $query->where('name', 'LIKE', '%'. $request->get('src') .'%');
            })
            ->paginate(10);

        return view('admin.membershipplans.index', compact('request', 'membershipPlans'));
    }

    /**
     * To create a membership plan
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $referralCommissions = Category::where('type', 'ReferralCommission')
            ->select([
                \DB::raw('CONCAT(name," (",other,"-",slug,")") as commission'),
                'id'
            ])
            ->pluck('commission', 'id');
        return view('admin.membershipplans.create', compact('referralCommissions'));
    }

    /**
     * To store a membership plan to database
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->planCrud($request, new Plan());

        return response()->json(__('Membership Plan Created Successfully'));
    }

    /**
     * To edit a membership plan
     * @param Plan $membershipPlan
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Plan $membershipPlan)
    {
        $referralCommissions = Category::where('type', 'ReferralCommission')
            ->select([
                \DB::raw('CONCAT(name," (",other,"-",slug,")") as commission'),
                'id'
            ])
            ->pluck('commission', 'id');

        return view('admin.membershipplans.edit', compact('membershipPlan', 'referralCommissions'));
    }


    /**
     * To update a membership plan
     * @param Request $request
     * @param Plan $membershipPlan
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Plan $membershipPlan)
    {
        $this->planCrud($request, $membershipPlan);

        return response()->json(__('Membership Plan Updated Successfully'));
    }

    /**
     * To delete a membership plan from data
     * @param Plan $membershipPlan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {   
        if (count($request->id) > 0) {
           Plan::whereIn('id',$request->id)->delete();
        }
      
        cache()->forget('user.plans');
        cache()->forget('website.faqs_'.current_locale());
        return redirect()->back()->with('success', __('Membership Plan Deleted Successfully'));
    }


    /**
     * This function is used for new membership plans creation and updating. To avoid code duplication.
     * @param $request
     * @param $plan
     * @return void
     */
    private function planCrud(Request $request, Plan $plan)
    {
        $request->validate([
            'commission_rate' => ['required'],
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'ad_limit' => ['required', 'integer'],
            'status' => ['required', 'integer'],
            'days' => ['required', 'integer'],
            'is_trial' => ['required', 'integer'],
           
        ]);

        $plan->commission_rate = $request->input('commission_rate');
        $plan->name = $request->input('name');
        $plan->price = $request->input('price');
        $plan->ad_limit = $request->input('ad_limit');
        $plan->status = $request->input('status');
        $plan->days = $request->input('days');
        $plan->is_trial = $request->input('is_trial');
       // $plan->user_can_post = $request->input('user_can_post');

        $plan->saveOrFail();

        cache()->forget('user.plans');
        cache()->forget('website.faqs_'.current_locale());
    }
}

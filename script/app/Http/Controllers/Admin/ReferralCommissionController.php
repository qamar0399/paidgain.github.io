<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Categorymeta;
use Illuminate\Http\Request;

class ReferralCommissionController extends Controller
{
    public function __construct()
    {
        // Check user permission using spatie middleware
        $this->middleware('permission:referral_commission.index')->only('index', 'show');
        $this->middleware('permission:referral_commission.create')->only('create', 'store');
        $this->middleware('permission:referral_commission.edit')->only('edit', 'update');
        $this->middleware('permission:referral_commission.delete')->only('destroy');
    }

    /**
     * Display the list of referral commission
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $referralCommissions = Category::where('categories.type', '=', 'ReferralCommission')
            ->when($request->get('src'), function ($query) use ($request){
                $query->where('name', 'LIKE', '%'.$request->get('src').'%');
            })
           
            ->latest()
            ->paginate();
        $referralCommissionConfig = Category::where('type', '=', 'ReferralCommissionConfig')->pluck('status', 'name');

        return view('admin.referralcommission.index', compact('referralCommissions', 'referralCommissionConfig'));
    }

    /**
     * Create a new advertisement
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.referralcommission.create');
    }

    /**
     * Store referral commission information in the database
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->referralCrud($request, new Category());

        return response()->json(__('Referral Commission Created Successfully'));
    }

    /**
     * To edit a referral commission
     * @param Category $referralCommission
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Category $referralCommission)
    {
       
        return view('admin.referralcommission.edit', compact('referralCommission'));
    }

    /**
     * To Update a referral commission
     * @param Request $request
     * @param Category $referralCommission
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Category $referralCommission)
    {
        $this->referralCrud($request, $referralCommission);

        return response()->json(__('Referral Commission Updated Successfully'));
    }

    /**
     * To delete a referral commission
     * @param Category $referralCommission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $referralCommission)
    {
        $referralCommission->delete();

        return redirect()->back()->with('success', __('Referral Commission Deleted Successfully'));
    }

    /**
     * Update the referral commission configuration
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateConfig(Request $request)
    {

        // Update deposit config
        $config = Category::query()
            ->where('type', 'ReferralCommissionConfig')
            ->where('name', 'deposit')
            ->first();

        
            $config->status = $request->deposit ?? 0;
            $config->save();
        

        // Update deposit config
        $config = Category::query()
            ->where('type', 'ReferralCommissionConfig')
            ->where('name', 'membership_upgrade')
            ->first();

       
            $config->status = $request->membership_upgrade ?? 0;
            $config->save();
        

       

        return response()->json(__('Referral Commission Config Updated Successfully'));
    }

    /**
     * This function is used for new referral commission creation and updating. To avoid code duplication.
     * @param Request $request
     * @param $referralCommission
     * @return void
     */
    private function referralCrud(Request $request, $referralCommission)
    {
        $request->validate([
            'title' => 'required|string',
            'commission_type' => 'required|string',
            'commission' => 'required|numeric',
            
        ]);

        $referralCommission->type = 'ReferralCommission';
        $referralCommission->name = $request->input('title');
        $referralCommission->slug = $request->input('commission_type');
        $referralCommission->other = $request->input('commission'); ;

        $referralCommission->saveOrFail();

       
    }

    public function delete(Request $request)
    {
        foreach($request->id as $id){
           $category = Category::find($id);
           $category->delete();
        }

        return response()->json('Successfully Deleted!');
    }

    public function settings()
    {
        $referralCommissionConfig = Category::where('type', '=', 'ReferralCommissionConfig')->pluck('status', 'name');
        return view('admin.referralcommission.settings',compact('referralCommissionConfig'));
    }

}

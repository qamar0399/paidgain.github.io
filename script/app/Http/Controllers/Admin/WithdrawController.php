<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['total_withdraws'] = Withdraw::count();
        $data['total_approved'] = Withdraw::where('status', 'approved')->count();
        $data['total_rejected'] = Withdraw::where('status', 'rejected')->count();
        $data['total_pending'] = Withdraw::where('status', 'pending')->count();
        $data['withdraws'] = Withdraw::latest()
                    ->when(request('status') == 'approved', function($q) {
                        $q->where('status', 'approved');
                    })
                    ->when(request('status') == 'rejected', function($q) {
                        $q->where('status', 'rejected');
                    })
                    ->when(request('status') == 'pending', function($q) {
                        $q->where('status', 'pending');
                    })
                    ->whereHas('method')
                    ->whereHas('user')
                    ->with('method','user')
                    ->paginate(50)->withQueryString();
        return view('admin.withdraw.index', $data);
    }

   public function show($id)
   {
       $info = Withdraw::query()
                    ->whereHas('method')
                    ->whereHas('user')
                    ->with('method','user')
                    ->findorFail($id);
       return view('admin.withdraw.show', compact('info'));
   }

   public function update(Request $request,$id)
   {
       $info = Withdraw::where('id',$id)->update(['status'=>$request->status]);

       return response()->json(__('Request Updated Successfully'));
   }

   public function deleteAll(Request $request)
   {
      if ($request->method == 'delete') {
          if (count($request->ids) > 0) {
             Withdraw::whereIn('id',$request->ids)->delete();
          }
      }

       return response()->json(__('Request Deleted Successfully'));
   }

    


}

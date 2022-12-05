<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Support;
use App\Models\Supportmeta;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;
class SupportController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supports = Support::with('meta')->where('user_id',Auth::id())->latest()->paginate();
        return view('user.support.index', compact('supports'))->with('i',1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.support.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|max:100',
            'comment' => 'required|max:250',
        ]);

         DB::beginTransaction();
        try {  
        $support = new Support();
        $support->title = $request->title;
        $support->user_id = Auth::id();
        $support->save();

        $supportmeta = new Supportmeta();
        $supportmeta->support_id = $support->id;
        $supportmeta->comment = $request->comment;
        $supportmeta->save();

         DB::commit();

        } catch (\Throwable $th) {
          DB::rollback();
         
          return $th;
        }

        return response()->json('Support request created successfully..!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $support = Support::with('user')->with('meta')->where('user_id',Auth::id())->findorFail($id);
      
        return view('user.support.view', compact('support'));
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $count = Support::where('id', $id)->where('user_id', Auth::id())->count();

        if ($count == 0) {
            return response()->json('Not authorized!'); 
        }
     
        
        $supportmeta = new Supportmeta();
        $supportmeta->support_id = $id; 
        $supportmeta->comment = $request->comment;
        $supportmeta->type = 1; //for admin
        $supportmeta->save();

        return response()->json('Reply send successfully!'); 
    }


}

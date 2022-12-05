<?php

namespace App\Http\Controllers\Admin;

use App\Models\Getway;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Storage;
class PaymentGatewayController extends Controller
{
    public function __construct()
    {
        // Check user permission using spatie middleware
        $this->middleware('permission:getway.list')->only('index', 'show');
        $this->middleware('permission:getway.create')->only('create', 'store');
        $this->middleware('permission:getway.edit')->only('edit', 'update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $gateways = Getway::latest()->get();
        return view('admin.gateway.index', compact('gateways'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('admin.gateway.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required|unique:getways,name',
            'logo'            => 'nullable|mimes:jpeg,png,jpg,svg,gif|max:100',
            'rate'            => 'required',
            'charge'          => 'required',
            'currency_name'   => 'required',
        ]);

        $gateway = new Getway;
        $gateway->logo=$request->preview;
        $gateway->name = $request->name;
        $gateway->rate = $request->rate;
        $gateway->charge = $request->charge;
        $gateway->namespace = 'App\Lib\CustomGetway';
        $gateway->currency_name = $request->currency_name;
        $gateway->is_auto = 0;
        $gateway->status= $request->status;
        $gateway->data= $request->instruction;
        $gateway->max_amount= $request->max_amount;
        $gateway->min_amount= $request->min_amount;
        $gateway->image_accept= $request->image_accept;
        
        $gateway->save();

        return response()->json('Successfully Created!');
    }




    /**
     * Display the specified resource.
     *
     * @param PaymentGateway $paymentGateway
     * @return Response
     */
    public function show(PaymentGateway $paymentGateway): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $gateway = Getway::findOrFail($id);
        return view('admin.gateway.edit', compact('gateway'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'            => 'required|unique:getways,name,' . $id,
            'logo'            => 'nullable|image|max:100',
            'rate'            => 'required',
            'charge'          => 'required',
            'namespace'       => 'nullable',
            'currency_name'   => 'required',
        ]);

        $gateway = Getway::findOrFail($id);
        if ($gateway->is_auto == 0) {
             $request->validate([
                'payment_instruction'   => 'required',
             ]);
             $gateway->data = $request->payment_instruction;
        }
        else{
            $gateway->data = $request->data ? json_encode($request->data) : '';
        }

        $gateway->logo=$request->preview;
        $gateway->name = $request->name;
        $gateway->rate = $request->rate;
        $gateway->charge = $request->charge;
        $gateway->currency_name = strtoupper($request->currency_name);
        $gateway->test_mode = $request->test_mode;
        $gateway->status= $request->status;
        $gateway->max_amount= $request->max_amount;
        $gateway->min_amount= $request->min_amount;
        $gateway->image_accept= $request->image_accept;
        
        $gateway->save();

        return response()->json('Successfully Updated!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ptc;
use App\Models\Ptcmeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PTCAdsController extends Controller
{
    public function __construct()
    {
        // Check user permission
        $this->middleware('permission:ptc_ad.index')->only('index', 'show');
        $this->middleware('permission:ptc_ad.create')->only('create', 'store');
        $this->middleware('permission:ptc_ad.edit')->only('edit', 'update');
        $this->middleware('permission:ptc_ad.delete')->only('destroy');
    }

    public function index(Request $request)
    {
        $ads = Ptc::when($request->get('src'), function ($query) use ($request){
                $query->where('title', 'LIKE', '%'. $request->get('src'). '%');
            })
            ->latest()
            ->paginate();

        return view('admin.ptcads.index', compact('ads'));
    }

    public function create()
    {
        return view('admin.ptcads.create');
    }

    public function store(Request $request)
    {
        $this->crudAction($request, new Ptc());

        return response()->json(__('PTC Ads Created Successfully'));
    }

    public function edit(Ptc $ptcAd)
    {
        return view('admin.ptcads.edit', compact('ptcAd'));
    }

    public function update(Request $request, Ptc $ptcAd)
    {
        $this->crudAction($request, $ptcAd, true);

        return response()->json(__('PTC Ads Updated Successfully'));
    }

    public function destroy(Ptc $ptcAd)
    {
        $ptcAd->delete();
        cache()->forget('website.earn_money_'.current_locale());
        cache()->forget('website.home_'.app()->getLocale());
        return redirect()->back()->with('success', __('PTC Ads Deleted Successfully'));
    }

    private function crudAction(Request $request, Ptc $ptc, bool $is_update = false){
       // dd($request->)
        $request->validate([
            'title'         => ['required', 'string'],
            'ads_type'      => ['required', 'string'],
            'amount'        => ['required', 'numeric'],
            'duration'      => ['required', 'integer'],
            'max_limit'     => ['required', 'integer'],
            'is_clickable'  => ['required', 'integer'],
            'status'        => ['required', 'integer'],
            'image'        => ['required'],
        ], [
            'image.required_if' => __('Please Upload or Select Image')
        ]);

        \DB::beginTransaction();
        try {
            $ptc->user_id = auth()->id();
            $ptc->title = $request->input('title');
            $ptc->ads_type = $request->input('ads_type');
            $ptc->slug = str($request->input('title').'-'.now())->slug();
            $ptc->amount = $request->input('amount');
            $ptc->duration = $request->input('duration');
            $ptc->max_limit = $request->input('max_limit');
            $ptc->is_clickable = $request->input('is_clickable');
            $ptc->status = $request->input('status');
            $ptc->ads_body = $request->input('ads_body') ?? $request->input('image');
            $ptc->save();

            if (empty($ptc->meta)) {
               $ptc->preview()->create(['ptc_id'=>$ptc->id,'key'=>'image', 'value'=>$request->image]);
            }
            else{
              $ptc->preview()->update(['key'=>'image', 'value'=>$request->image]);
            }
            
            

            \DB::commit();

            cache()->forget('website.earn_money_'.current_locale());
            cache()->forget('website.home_'.app()->getLocale());
        }catch (\Throwable $e){
            \DB::rollBack();
            throw $e;
        }
    }

    public function uploader(Request $request, $inputKey)
    {
        if ($request->hasFile($inputKey)){
            $driver = env('STORAGE_TYPE', 'local');
            $image = $request->file($inputKey);
            $name = uniqid() . date('dmy') . time() . "." . strtolower($image->getClientOriginalExtension());
            $path = 'uploads/ads/' . auth()->id() . date('/y') . '/' . date('m') . '/';
            $filename = $path . $name;
            Storage::disk($driver)->put($filename, file_get_contents($image));

            return $filename;
        }
    }

    public function massDestroy(Request $request)
    {
        
        if ($request->has('id')) {
            if ($request->input('status') == 'delete') {
               
                if (!empty($request->input('id'))) {
                   $ptc = Ptc::whereIn('id',$request->input('id'))->delete();
                }
               

                cache()->forget('website.earn_money_'.current_locale());
                cache()->forget('website.home_'.app()->getLocale());

                return response()->json('Selected ads has been deleted.');
            } else {
                $errors['errors']['error'] = __('Oops! Please select Any Status.');
                return response()->json($errors, 401);
            }
        } else {
            $errors['errors']['error'] = __('Oops! Please select Any Status.Please select any checkbox.');
            return response()->json($errors, 401);
        }
    }
}

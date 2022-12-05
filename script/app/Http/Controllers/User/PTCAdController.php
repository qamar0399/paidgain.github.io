<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ptc;
use App\Models\Ptcmeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PTCAdController extends Controller
{
    public function index()
    {
        $ads = Ptc::with('meta')->latest()->paginate();

        return view('user.ptcads.index', compact('ads'));
    }

    public function create()
    {
        return view('user.ptcads.create');
    }

    public function store(Request $request)
    {
        $this->crudAction($request, new Ptc());

        return redirect()->back()->with('success', __('PTC Ads Created Successfully'));
    }

    public function edit(Ptc $ptcAd)
    {
        return view('user.ptcads.edit', compact('ptcAd'));
    }

    public function update(Request $request, Ptc $ptcAd)
    {
        $this->crudAction($request, $ptcAd, true);

        return redirect()->back()->with('success', __('PTC Ads Updated Successfully'));
    }

    public function destroy(Ptc $ptcAd)
    {
        $ptcAd->delete();
        cache()->forget('website.earn_money_'.current_locale());
        return redirect()->back()->with('success', __('PTC Ads Deleted Successfully'));
    }

    private function crudAction(Request $request, $ptc, bool $is_update = false){
        $request->validate([
            'title'         => ['required', 'string'],
            'ads_type'      => ['required', 'string'],
            'ads_body'      => [$is_update ? 'nullable' : 'required', $request->hasFile('ads_body') ? 'image' : 'string'],
            'amount'        => ['required', 'numeric'],
            'duration'      => ['required', 'integer'],
            'max_limit'     => ['required', 'integer'],
            'is_clickable'  => ['required', 'integer'],
            'status'        => ['required', 'integer'],
            'clickable_image' => [$is_update ? 'nullable' : 'required_if:ads_type,==,clickable_image', 'image']
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

            if ($request->input('ads_type') == 'banner_image' && $request->hasFile('ads_body')) {
                $ptc->ads_body = $this->uploader($request, 'ads_body');
            }else {
                if (!$is_update){
                    $ptc->ads_body = $request->input('ads_body');
                }
            }

            $ptc->saveOrFail();

            if ($request->has('clickable_image')){
                $filename = $this->uploader($request, 'clickable_image');

                Ptcmeta::set($ptc->id, 'image', $filename);
            }

            \DB::commit();

            cache()->forget('website.earn_money_'.current_locale());
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
}

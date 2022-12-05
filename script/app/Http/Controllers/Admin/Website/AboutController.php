<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Term;
use App\Models\Termmeta;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $aboutTerms = Term::whereType('about')->with('description', 'preview')->get();

        $about = [];
        foreach ($aboutTerms as $aboutTerm) {
            $about[$aboutTerm->lang] = $aboutTerm;
        }

        $languages = Option::where('key', '=', 'languages')
            ->withCasts(['value' => 'array'])
            ->select(['value'])
            ->first();

        return view('admin.website.about.index', compact('languages', 'about'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'lang' => ['required', 'string'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => ['required', 'string']
        ]);

        $about = Term::firstOrNew([
            'type' => 'about',
            'lang' => $request->input('lang'),
        ]);
        $about->user_id = auth()->id();
        $about->title = $request->input('title');
        $about->save();

        Termmeta::set($about->id, 'description', $request->input('description'));
        Termmeta::set($about->id, 'preview', $request->input('image'));

        cache()->forget('website.about_'.current_locale());

        return response()->json(__('About Page Updated Successfully'));
    }
}

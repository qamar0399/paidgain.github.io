<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendSubscribersEmail;
use App\Mail\SendSubscriberMail;
use App\Models\Subscriber;
use App\Notifications\SendSubscribersEmailNotification;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function __construct()
    {
        // Check user permission using spatie middleware
        $this->middleware('permission:subscriber.list')->only('index', 'search');
        $this->middleware('permission:subscriber.delete')->only('destroy');
        $this->middleware('permission:subscriber.send')->only('send', 'queue');
    }

    public function index(Request $request)
    {
        $subscribers = Subscriber::query()
            ->when($request->get('src'), function ($query) use ($request){
                $query->where('email', 'LIKE', '%'.$request->get('src').'%');
            })
            ->latest()
            ->paginate();

        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return redirect()->back()->with('success', __('Subscriber removed successfully'));
    }

    public function send()
    {
        return view('admin.subscribers.send');
    }

    public function search(Request $request)
    {
        $search = trim($request->get('search'));
        $subscribers = Subscriber::query()
            ->when($search, function ($query) use ($search){
                $query->where('email', 'LIKE', '%'.$search.'%');
            })
            ->select([
                'id',
                \DB::raw('email as text')
            ])
            ->simplePaginate(10);


        $morePages = true;
        if (empty($subscribers->nextPageUrl())) {
            $morePages = false;
        }
        $results = array(
            "data" => $subscribers->items(),
            "pagination" => array(
                "more" => $morePages
            )
        );

        return response()->json($results);
    }

    public function queue(Request $request)
    {
        Subscriber::query()
            ->when($request->has('to'), function ($query) use($request){
                $query->whereIn('id', $request->get('to'));
            })
            ->chunk(100, function ($subscribers) use ($request){
                foreach ($subscribers as $subscriber) {
                    \Mail::to($subscriber)
                        ->queue(new SendSubscriberMail($subscriber, $request->input('subject'), $request->input('body')));
                }
            });

        return response()->json(__('Subscribers is email sending'));
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App;
use Cache;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Plan;
use App\Models\Term;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Google\Service\Blogger\Blog;
use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Withdraw;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
use DB;

class FrontendController extends Controller
{
    public function index()
    {

        try {
            DB::connection()->getPdo();
            if(DB::connection()->getDatabaseName()){
                $data = remember_cache('website.home_'.app()->getLocale(), function (){
                    // Home Single Data
                    $categories = Category::whereLang(App::getLocale())
                        ->whereIn('categories.type', [
                            'heading.welcome',
                            'heading.features',
                            'heading.member_benefits',
                            'heading.member_info',
                            'heading.advertise_benefits',
                            'heading.payouts',
                            'heading.join_us',
                            'heading.our_team',
                            'heading.blog_news',
                            'heading.earn_money',
                        ])
                        ->leftJoin('categorymetas', 'categories.id', '=', 'categorymetas.category_id')
                        ->select([
                            'categories.*',
                            'categorymetas.value as info'
                        ])
                        ->withCasts(['info' => 'array'])
                        ->where('lang', current_locale())
                        ->get();
        
                    $data = [];
                    foreach ($categories as $category) {
                        $data[$category->type] = $category;
                    }
        
                    // Home Bulk Data
                    $categories = Category::whereLang(App::getLocale())
                        ->whereIn('categories.type', [
                            'features',
                            'member_benefits',
                            'advertise_benefits',
                            'advertise_benefits',
                            'team_members',
                        ])
                        ->leftJoin('categorymetas', 'categories.id', '=', 'categorymetas.category_id')
                        ->select([
                            'categories.*',
                            'categorymetas.value as info'
                        ])
                        ->withCasts(['info' => 'array'])
                        ->where('lang', current_locale())
                        ->get();
        
                    $dataCollection = [];
                    foreach ($categories as $category) {
                        $dataCollection[$category->type][] = $category;
                    }
        
                    // Others data
                    $totalMembers = App\Models\User::whereRole('user')->count();
                    $totalDeposit = App\Models\Deposit::sum('amount');
        
                    $ads = App\Models\Ptc::with('meta')->latest()->limit(10)->get();
                    $blogs = Term::where('type', 'blog')->with(['user', 'preview', 'description'])->latest()->limit(3)->get();
                    $top_payouts = App\Models\Withdraw::with('user')->orderBy('amount', 'desc')->limit(10)->get();
                    $total_withdraw = App\Models\Withdraw::sum('amount');
        
                    return [
                        'data' => $data,
                        'blogs' => $blogs,
                        'ads' => $ads,
                        'top_payouts' => $top_payouts,
                        'dataCollection' => $dataCollection,
                        'totalMembers' => $totalMembers,
                        'totalDeposit' => $totalDeposit,
                        'total_withdraw' => $total_withdraw
                    ];
                });
        
                $seo=get_option('seo_home',true);
        
                JsonLdMulti::setTitle($seo->site_name ?? env('APP_NAME'));
                JsonLdMulti::setDescription($seo->matadescription ?? null);
                JsonLdMulti::addImage(asset($seo->preview ?? null));
        
                SEOMeta::setTitle($seo->site_name ?? env('APP_NAME'));
                SEOMeta::setDescription($seo->matadescription ?? null);
                SEOMeta::addKeyword($seo->tags ?? null);
        
                SEOTools::setTitle($seo->site_name ?? env('APP_NAME'));
                SEOTools::setDescription($seo->matadescription ?? null);
              
                SEOTools::opengraph()->addProperty('keywords', $seo->matatag ?? null);
                SEOTools::opengraph()->addProperty('image', asset($seo->preview ?? null));
                SEOTools::twitter()->setTitle($seo->site_name ?? env('APP_NAME'));
                SEOTools::twitter()->setSite($seo->twitter_site_title ?? null);
                SEOTools::jsonLd()->addImage(asset($seo->preview ?? null));
        
                return view('frontend.index', compact('data'));
            }else{
              return redirect('/install');
            }
          } catch (\Exception $e) {
            return redirect('/install');
          }

       
    }

    public function about()
    {
        $data = remember_cache('website.about_'.current_locale(), function (){
            $about = App\Models\Term::where([
                'type' => 'about',
                'lang' => current_locale()
            ])->with('preview', 'description')->first();

            $members = Category::where([
                'type' => 'team_members'
            ])->with('meta')->get();

            $our_team = Category::where([
                'type' => 'heading.our_team',
                'lang' => current_locale()
            ])->first();

            return ['about' => $about, 'members' => $members, 'our_team' => $our_team];
        });

        $seo=get_option('seo_about',true);

        JsonLdMulti::setTitle($seo->site_name ?? env('APP_NAME'));
        JsonLdMulti::setDescription($seo->matadescription ?? null);
        JsonLdMulti::addImage(asset($seo->preview ?? null));

        SEOMeta::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOMeta::setDescription($seo->matadescription ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::setDescription($seo->matadescription ?? null);
      
        SEOTools::opengraph()->addProperty('keywords', $seo->matatag ?? null);
        SEOTools::opengraph()->addProperty('image', asset($seo->preview ?? null));
        SEOTools::twitter()->setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::twitter()->setSite($seo->twitter_site_title ?? null);
        SEOTools::jsonLd()->addImage(asset($seo->preview ?? null));

        return view('frontend.about', compact('data'));
    }

    public function earnMoney()
    {
        $data = remember_cache('website.earn_money_'.current_locale(), function (){
            $earn_money = Category::where([
                'type' => 'heading.earn_money',
                'lang' => current_locale()
            ])->first();

            $advertisements = App\Models\Ptc::whereStatus(1)->with('meta')->get();

            return [
                'earn_money' => $earn_money,
                'advertisements' => $advertisements
            ];
        });

        $seo=get_option('seo_earn-money',true);

        JsonLdMulti::setTitle($seo->site_name ?? env('APP_NAME'));
        JsonLdMulti::setDescription($seo->matadescription ?? null);
        JsonLdMulti::addImage(asset($seo->preview ?? null));

        SEOMeta::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOMeta::setDescription($seo->matadescription ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::setDescription($seo->matadescription ?? null);
      
        SEOTools::opengraph()->addProperty('keywords', $seo->matatag ?? null);
        SEOTools::opengraph()->addProperty('image', asset($seo->preview ?? null));
        SEOTools::twitter()->setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::twitter()->setSite($seo->twitter_site_title ?? null);
        SEOTools::jsonLd()->addImage(asset($seo->preview ?? null));

        return view('frontend.earnmoney', compact('data'));
    }

    public function topInvestors()
    {
        $data = remember_cache('website.top_investors_'.current_locale(), function (){
            $top_investor = Category::where([
                'type' => 'heading.top_investor',
                'lang' => current_locale()
            ])->first();

            $top_investors = Category::where([
                'type' => 'top_investors',
                'lang' => current_locale()
            ])->with('meta')->get();

            return [
                'top_investor' => $top_investor,
                'top_investors' => $top_investors,
            ];
        });

        $seo=get_option('seo_top-investors',true);

        JsonLdMulti::setTitle($seo->site_name ?? env('APP_NAME'));
        JsonLdMulti::setDescription($seo->matadescription ?? null);
        JsonLdMulti::addImage(asset($seo->preview ?? null));

        SEOMeta::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOMeta::setDescription($seo->matadescription ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::setDescription($seo->matadescription ?? null);
      
        SEOTools::opengraph()->addProperty('keywords', $seo->matatag ?? null);
        SEOTools::opengraph()->addProperty('image', asset($seo->preview ?? null));
        SEOTools::twitter()->setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::twitter()->setSite($seo->twitter_site_title ?? null);
        SEOTools::jsonLd()->addImage(asset($seo->preview ?? null));

        return view('frontend.topinverstors', compact('data'));
    }

    public function pricePlans()
    {
        $data = remember_cache('website.priceplans_'.current_locale(), function (){
            $price_plan = Category::where([
                'type' => 'heading.price_plan',
                'lang' => current_locale()
            ])->first();

            $plans = Plan::where('status', Plan::ACTIVE)->with('commission')->get();
            return [
                'plans' => $plans,
                'price_plan' => $price_plan
            ];
        });

        $seo=get_option('seo_pricing',true);

        JsonLdMulti::setTitle($seo->site_name ?? env('APP_NAME'));
        JsonLdMulti::setDescription($seo->matadescription ?? null);
        JsonLdMulti::addImage(asset($seo->preview ?? null));

        SEOMeta::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOMeta::setDescription($seo->matadescription ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::setDescription($seo->matadescription ?? null);
      
        SEOTools::opengraph()->addProperty('keywords', $seo->matatag ?? null);
        SEOTools::opengraph()->addProperty('image', asset($seo->preview ?? null));
        SEOTools::twitter()->setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::twitter()->setSite($seo->twitter_site_title ?? null);
        SEOTools::jsonLd()->addImage(asset($seo->preview ?? null));

        return view('frontend.priceplans', compact('data'));
    }

    public function faq()
    {
        $data = remember_cache('website.faqs_'.current_locale(), function (){
            $faq = Category::where([
                'type' => 'heading.faq',
                'lang' => current_locale()
            ])->first();

            $faqs = Category::whereType('faq')->get();

            // Single Data
            $member_info = Category::whereLang(App::getLocale())
                ->whereType('heading.member_info')
                ->first();

            // Others data
            $totalMembers = App\Models\User::whereRole('user')->count();
            $totalDeposit = Deposit::sum('amount');
            $totalWithdraw = Withdraw::sum('amount');

            return [
                'faq' => $faq,
                'faqs' => $faqs,
                'member_info' => $member_info,
                'totalMembers' => $totalMembers,
                'totalDeposit' => $totalDeposit,
                'totalWithdraw' => $totalWithdraw,
            ];
        });

        $seo=get_option('seo_faq',true);

        JsonLdMulti::setTitle($seo->site_name ?? env('APP_NAME'));
        JsonLdMulti::setDescription($seo->matadescription ?? null);
        JsonLdMulti::addImage(asset($seo->preview ?? null));

        SEOMeta::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOMeta::setDescription($seo->matadescription ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::setDescription($seo->matadescription ?? null);
      
        SEOTools::opengraph()->addProperty('keywords', $seo->matatag ?? null);
        SEOTools::opengraph()->addProperty('image', asset($seo->preview ?? null));
        SEOTools::twitter()->setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::twitter()->setSite($seo->twitter_site_title ?? null);
        SEOTools::jsonLd()->addImage(asset($seo->preview ?? null));

        return view('frontend.faq', compact('data'));
    }

    public function clients()
    {
        $heading = Category::where([
            'type' => 'heading.client_review',
            'lang' => current_locale()
        ])->first();

        $reviews = Category::where('type', 'review')->with(['preview', 'description'])->latest()->paginate(5);

        $seo=get_option('seo_clients',true);

        JsonLdMulti::setTitle($seo->site_name ?? env('APP_NAME'));
        JsonLdMulti::setDescription($seo->matadescription ?? null);
        JsonLdMulti::addImage(asset($seo->preview ?? null));

        SEOMeta::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOMeta::setDescription($seo->matadescription ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::setDescription($seo->matadescription ?? null);
      
        SEOTools::opengraph()->addProperty('keywords', $seo->matatag ?? null);
        SEOTools::opengraph()->addProperty('image', asset($seo->preview ?? null));
        SEOTools::twitter()->setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::twitter()->setSite($seo->twitter_site_title ?? null);
        SEOTools::jsonLd()->addImage(asset($seo->preview ?? null));

        return view('frontend.clients', compact('reviews', 'heading'));
    }

    public function page(Term $page)
    {

        abort_if(empty($page),404);
        abort_unless($page->status, 404);
        
        $info = json_decode($page->page->value);

        JsonLdMulti::setTitle($page->title ?? '');
        JsonLdMulti::setDescription($meta->page_excerpt ?? null);
       

        SEOMeta::setTitle($page->title ?? '');
        SEOMeta::setDescription($meta->page_excerpt ?? null);
     
        SEOTools::setTitle($page->title ?? '');
        SEOTools::setDescription($meta->page_excerpt ?? null);
     
      
        SEOTools::twitter()->setTitle($page->title ?? '');
        SEOTools::twitter()->setSite($page->title ?? '');
        
        return view('frontend.page', compact('page','info'));
    }

    public function blog()
    {
        $blog_news = Category::where([
            'type' => 'heading.blog_news',
            'lang' => current_locale()
        ])->first();

        $posts = Term::whereType('blog')->with(['preview', 'description', 'user'])->where('status',1)->latest()->paginate(8);
        

        

        $seo=get_option('seo_blog',true);

        JsonLdMulti::setTitle($seo->site_name ?? env('APP_NAME'));
        JsonLdMulti::setDescription($seo->matadescription ?? null);
        JsonLdMulti::addImage(asset($seo->preview ?? null));

        SEOMeta::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOMeta::setDescription($seo->matadescription ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::setDescription($seo->matadescription ?? null);
      
        SEOTools::opengraph()->addProperty('keywords', $seo->matatag ?? null);
        SEOTools::opengraph()->addProperty('image', asset($seo->preview ?? null));
        SEOTools::twitter()->setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::twitter()->setSite($seo->twitter_site_title ?? null);
        SEOTools::jsonLd()->addImage(asset($seo->preview ?? null));
        return view('frontend.blog', compact('blog_news', 'posts'));
    }

    public function blogPost($slug)
    {
        $post=Term::where('slug',$slug)->where('type','blog')->where('status',1)->with('preview','description','excerpt')->first();
        abort_if(empty($post),404);
       
        $data = remember_cache('website.post_'.current_locale(), function (){
            $recent = Term::whereType('blog')->limit(5)->with('preview')->get();
            $latest = Term::whereType('blog')->limit(3)->with('preview')->get();

            return ['recent' => $recent, 'latest' => $latest];
        });

        $blog=$post;
        JsonLdMulti::setTitle($blog->title ?? env('APP_NAME'));
        JsonLdMulti::setDescription($blog->excerpt->value ?? null);
        JsonLdMulti::addImage(asset($blog->preview->value ?? ''));

        SEOMeta::setTitle($blog->title ?? env('APP_NAME'));
        SEOMeta::setDescription($blog->excerpt->value ?? null);
      

        SEOTools::setTitle($blog->title ?? env('APP_NAME'));
        SEOTools::setDescription($blog->excerpt->value ?? null);
        SEOTools::setCanonical(url()->current());

        SEOTools::opengraph()->addProperty('image', asset($blog->preview->value ?? ''));
        SEOTools::twitter()->setTitle($blog->title ?? env('APP_NAME'));
     
        SEOTools::jsonLd()->addImage(asset($blog->preview->value ?? ''));
        

        return view('frontend.blogpost', compact('post', 'data'));
    }

    public function contact()
    {
        $contact = remember_cache('website.contact_'.current_locale(), function (){
            return Category::where(['type' => 'heading.contact', 'lang' => current_locale()])->with('meta')->first();
        });

        $seo=get_option('seo_contract',true);

        JsonLdMulti::setTitle($seo->site_name ?? env('APP_NAME'));
        JsonLdMulti::setDescription($seo->matadescription ?? null);
        JsonLdMulti::addImage(asset($seo->preview ?? null));

        SEOMeta::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOMeta::setDescription($seo->matadescription ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::setDescription($seo->matadescription ?? null);
      
        SEOTools::opengraph()->addProperty('keywords', $seo->matatag ?? null);
        SEOTools::opengraph()->addProperty('image', asset($seo->preview ?? null));
        SEOTools::twitter()->setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::twitter()->setSite($seo->twitter_site_title ?? null);
        SEOTools::jsonLd()->addImage(asset($seo->preview ?? null));

        return view('frontend.contact', compact('contact'));
    }

    public function switchLanguage($locale)
    {
        app()->setLocale($locale);
        session()->put('locale', $locale);

        return redirect()->back()->with('success', __('Language Switched Successfully'));
    }

    public function referral(User $user)
    {
        if(Auth::check()){
            return view('frontend.referral', compact('user'));
        } else{
            Session::put('ref_id',$user->id);
            return to_route('frontend.index', ['redirect_to' => route('frontend.referral.index', $user->id), 'target_modal' => 'register']);
        }
    }

    public function referralConfirm(Request $request)
    {
        $request->validate([
            'ref' => ['required', 'exists:users,id']
        ]);

        $referralUser = User::findOrFail($request->input('ref'));

        if (Auth::user()->referredBy){
            return response()->json([
                'message' => __('You already referred by another user.'),
                'redirect' => route('user.dashboard')
            ]);
        }else {
            if (Auth::id() == $referralUser->id){
                return response()->json([
                    'message' => __('You cannot referred your self.'),
                    'redirect' => route('user.dashboard')
                ], 403);
            }

            Auth::user()->update([
                'user_id' => $referralUser->id
            ]);

            return response()->json([
                'message' => __('Referral ID Successfully Applied'),
                'redirect' => route('user.dashboard')
            ]);
        }
    }
}

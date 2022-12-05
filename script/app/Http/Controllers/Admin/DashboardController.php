<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Domain;
use App\Models\Deposit;
use Spatie\Analytics;
use Spatie\Analytics\Period;

class DashboardController extends Controller
{

    public function staticData()
    {
        $year = Carbon::parse(date('Y'))->year;
        $total_customers = User::whereRole('user')->count();
        $total_deposits = Deposit::sum('amount');
        $withdrawals = Withdraw::select(['amount', 'rate'])->get();
        $total_withdraws = 0;
        foreach ($withdrawals as $withdraw) {
            $total_withdraws += $withdraw->amount / $withdraw->rate;
        }
        $total_subscriptions = Subscription::sum('amount');
        $total_withdrawals = Withdraw::count();
        $total_deposits_of_this_year = Deposit::where('status', '!=', 0)
            ->whereYear('created_at', '=', $year)
            ->sum('amount');

        $deposits = Deposit::whereYear('created_at', '=', $year)
            ->where('status', '!=', 0)
            ->orderBy('created_at')
            ->selectRaw('year(created_at) year, monthname(created_at) month, sum(amount) total')
            ->groupBy('year', 'month')->get()->map(function ($q) {
                $data['year'] = $q->year;
                $data['month'] = $q->month;
                $data['total'] = (float)number_format($q->total, 2);

                return $data;
            });

        $withdrawals = Withdraw::whereYear('created_at', '=', $year)
            ->with('user','method')
            ->orderBy('created_at')
            ->select(['amount', 'rate'])->get();

        $total_withdraws_of_this_year = 0;
        foreach ($withdrawals as $withdraw) {
            $total_withdraws_of_this_year += $withdraw->amount / $withdraw->rate;
        }

        $withdraws = Withdraw::whereYear('created_at', '=', $year)
            ->orderBy('created_at')
            ->selectRaw('year(created_at) year, monthname(created_at) month, sum(amount) total')
            ->groupBy('year', 'month')->get()->map(function ($q) {
                $data['year'] = $q->year;
                $data['month'] = $q->month;
                $data['total'] = (float)number_format($q->total, 2);

                return $data;
            });

        return response()->json([
            'total_customers' => $total_customers,
            'total_deposits'=> currency_format($total_deposits),
            'total_withdraws' => currency_format($total_withdraws),
            'total_subscriptions' => currency_format($total_subscriptions),
            'total_withdrawals' => $total_withdrawals,
            'total_deposits_of_this_year' => currency_format($total_deposits_of_this_year),
            'deposits' => $deposits,
            'total_withdraws_of_this_year' => currency_format($total_withdraws_of_this_year),
            'withdraws' => $withdraws,
        ]);
    }

    public function deposit_performance($period)
    {
        if ($period != 365) {
            $deposits = Deposit::whereDate('created_at', '>', Carbon::now()->subDays($period))
                ->where('status', '!=', 'canceled')
                ->orderBy('created_at')
                ->selectRaw('year(created_at) year, date(created_at) date, sum(amount) total')
                ->groupBy('year', 'date')
                ->get();
        } else {
            $deposits = Deposit::whereDate('created_at', '>', Carbon::now()->subDays($period))
                ->where('status', '!=', 'canceled')
                ->orderBy('created_at')
                ->selectRaw('year(created_at) year, monthname(created_at) month, sum(amount) total')
                ->groupBy('year', 'month')
                ->get();
        }

        return response()->json($deposits);
    }

    public function withdraw_performance($period)
    {
        if ($period != 365) {
            $withdraws = Withdraw::whereDate('created_at', '>', Carbon::now()->subDays($period))
                ->where('status', '!=', 'canceled')
                ->orderBy('created_at')
                ->selectRaw('year(created_at) year, date(created_at) date, sum(amount) total')
                ->groupBy('year', 'date')
                ->get();
        } else {
            $withdraws = Withdraw::whereDate('created_at', '>', Carbon::now()->subDays($period))
                ->where('status', '!=', 'canceled')
                ->orderBy('created_at')
                ->selectRaw('year(created_at) year, monthname(created_at) month, sum(amount) total')
                ->groupBy('year', 'month')
                ->get();
        }

        return response()->json($withdraws);
    }


    public function transaction_performance($period)
    {
        if ($period != 365) {
            $transactions = Transaction::whereDate('created_at', '>', Carbon::now()->subDays($period))
                ->orderBy('created_at')
                ->selectRaw('year(created_at) year, date(created_at) date, sum(amount) total')
                ->groupBy('year', 'date')
                ->get();
        } else {
            $transactions = Withdraw::whereDate('created_at', '>', Carbon::now()->subDays($period))
                ->orderBy('created_at')
                ->selectRaw('year(created_at) year, monthname(created_at) month, sum(amount) total')
                ->groupBy('year', 'month')
                ->get();
        }

        return response()->json($transactions);
    }

    public function withdraw_statistics($month)
    {
        $month = Carbon::parse($month)->month;
        $year = Carbon::parse(date('Y'))->year;

        $total_withdraws = Withdraw::whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $month)
            ->count();
        $total_pending = Withdraw::whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $month)
            ->whereStatus('pending')
            ->count();
        $total_approved = Withdraw::whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $month)
            ->whereStatus('approved')
            ->count();
        $total_expired = Withdraw::whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $month)
            ->whereStatus('expired')
            ->count();

        return response()->json([
            'total_withdraws' => number_format($total_withdraws),
            'total_pending' => number_format($total_pending),
            'total_approved' => number_format($total_approved),
            'total_expired' => number_format($total_expired),
        ]);
    }

    public function order_statics($month)
    {
        $month = Carbon::parse($month)->month;
        $year = Carbon::parse(date('Y'))->year;

        $total_orders = Order::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->count();

        $total_pending = Order::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->where('status', 2)->count();

        $total_completed = Order::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->where('status', 1)->count();

        $total_expired = Order::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->where('status', 3)->count();

        $data['total_orders'] = number_format($total_orders);
        $data['total_pending'] = number_format($total_pending);
        $data['total_completed'] = number_format($total_completed);
        $data['total_processing'] = number_format($total_expired);

        return response()->json($data);
    }


    public function google_analytics($days)
    {
        if (file_exists('uploads/service-account-credentials.json')) {
            $data['TotalVisitorsAndPageViews'] = $this->fetchTotalVisitorsAndPageViews($days);
            $data['MostVisitedPages'] = $this->fetchMostVisitedPages($days);
            $data['Referrers'] = $this->fetchTopReferrers($days);
            $data['fetchUserTypes'] = $this->fetchUserTypes($days);
            $data['TopBrowsers'] = $this->fetchTopBrowsers($days);
        } else {
            $data['TotalVisitorsAndPageViews'] = [];
            $data['MostVisitedPages'] = [];
            $data['Referrers'] = [];
            $data['fetchUserTypes'] = [];
            $data['TopBrowsers'] = [];
        }

        return response()->json($data);
    }

    public function pageanalytics(Request $request)
    {
        $analyticsData = \Analytics::performQuery(
            Period::days(14),
            'ga:pageviews',
            [
                'metrics' => 'ga:pageviews',
                'dimensions' => 'ga:date',
                'filters' => 'ga:pagePath==/' . $request->path
            ]

        );

        return $result = collect($analyticsData['rows'] ?? [])->map(function (array $dateRow) {
            return [
                'date' => Carbon::createFromFormat('Ymd', $dateRow[0])->format('m-d-Y'),
                'views' => (int)$dateRow[1],
            ];
        });
    }

    public function fetchTotalVisitorsAndPageViews($period)
    {
        return \Analytics::fetchTotalVisitorsAndPageViews(Period::days($period))->map(function ($data) {
            $row['date'] = $data['date']->format('Y-m-d');
            $row['visitors'] = $data['visitors'];
            $row['pageViews'] = $data['pageViews'];
            return $row;
        });
    }

    public function fetchMostVisitedPages($period)
    {
        return \Analytics::fetchMostVisitedPages(Period::days($period));
    }

    public function fetchVisitorsAndPageViews($period)
    {
        return \Analytics::fetchVisitorsAndPageViews(Period::days($period));
    }

    public function fetchTopReferrers($period)
    {
        return \Analytics::fetchTopReferrers(Period::days($period));
    }

    public function fetchUserTypes($period)
    {
        return \Analytics::fetchUserTypes(Period::days($period));
    }

    public function fetchTopBrowsers($period)
    {
        return \Analytics::fetchTopBrowsers(Period::days($period));
    }
}

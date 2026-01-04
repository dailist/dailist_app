<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use App\Models\Subscription;
use App\Models\Task;
use App\Models\Visit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Check if user is admin
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        if (! $user || ! $user->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        // Statistics
        $stats = [
            'total_users' => User::count(),
            'free_users' => User::whereHas('subscription', function($q) {
                $q->where('plan_type', 'free');
            })->orWhereDoesntHave('subscription')->count(),
            'premium_users' => User::whereHas('subscription', function($q) {
                $q->where('plan_type', 'premium')
                  ->where('status', 'active');
            })->count(),
            'total_tasks' => Task::count(),
            'total_revenue' => Transaction::where('status', 'success')->sum('amount'),
            'monthly_revenue' => Transaction::where('status', 'success')
                ->whereMonth('created_at', now()->month)
                ->sum('amount'),
        ];

        // Recent transactions
        $recentTransactions = Transaction::with('user')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // User list with pagination
        $users = User::with('subscription')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        // Visitor stats for last 14 days
        $visitRows = Visit::where('created_at', '>=', now()->subDays(14))
            ->selectRaw("DATE(created_at) as date, count(*) as count")
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date')
            ->toArray();

        // Build labels and data for the last 14 days
        $labels = [];
        $data = [];
        for ($i = 13; $i >= 0; $i--) {
            $day = now()->subDays($i)->toDateString();
            $labels[] = date('M d', strtotime($day));
            $data[] = $visitRows[$day] ?? 0;
        }

        return view('admin.dashboard', compact('stats', 'recentTransactions', 'users', 'labels', 'data'));
    }

    public function users(Request $request)
    {
        // Check if user is admin
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        if (! $user || ! $user->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $query = User::with(['subscription', 'tasks']);

        // Filter by subscription type
        if ($request->has('plan') && $request->plan !== 'all') {
            if ($request->plan === 'free') {
                $query->whereHas('subscription', function($q) {
                    $q->where('plan_type', 'free');
                })->orWhereDoesntHave('subscription');
            } else {
                $query->whereHas('subscription', function($q) use ($request) {
                    $q->where('plan_type', $request->plan);
                });
            }
        }

        // Search by name or email
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.users', compact('users'));
    }

    public function transactions(Request $request)
    {
        // Check if user is admin
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        if (! $user || ! $user->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $query = Transaction::with('user');

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $transactions = $query->orderBy('created_at', 'desc')->paginate(20);

        $totalRevenue = Transaction::where('status', 'success')->sum('amount');

        return view('admin.transactions', compact('transactions', 'totalRevenue'));
    }

    /**
     * Return visitor labels and data for the last 14 days as JSON.
     */
    public function visitsData(Request $request)
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        if (! $user || ! $user->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // metric: total | unique_ip | unique_user
        $metric = $request->query('metric', 'unique_ip');

        if ($metric === 'total') {
            $select = "DATE(created_at) as date, count(*) as count";
        } elseif ($metric === 'unique_user') {
            // count distinct user_id (only counts logged-in users)
            $select = "DATE(created_at) as date, COUNT(DISTINCT user_id) as count";
        } else {
            // default: unique by ip (counts anonymous visitors by IP)
            $select = "DATE(created_at) as date, COUNT(DISTINCT ip) as count";
        }

        $visitRows = Visit::where('created_at', '>=', now()->subDays(14))
            ->selectRaw($select)
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date')
            ->toArray();

        $labels = [];
        $data = [];
        for ($i = 13; $i >= 0; $i--) {
            $day = now()->subDays($i)->toDateString();
            $labels[] = date('M d', strtotime($day));
            $data[] = $visitRows[$day] ?? 0;
        }

        return response()->json(['labels' => $labels, 'data' => $data]);
    }
}

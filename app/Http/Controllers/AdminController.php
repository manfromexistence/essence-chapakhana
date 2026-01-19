<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return Inertia::render('Admin/Login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            if (Auth::user()->is_admin) {
                $request->session()->regenerate();

                return redirect()->route('admin.dashboard')->with('success', 'Welcome to Admin Dashboard!');
            } else {
                Auth::logout();

                return back()->withErrors([
                    'email' => 'You do not have admin privileges.',
                ])->onlyInput('email');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function dashboard()
    {
        // Get current month data
        $currentMonth = now()->month;
        $currentYear = now()->year;
        
        // Calculate stats
        $stats = [
            'totalOrders' => Order::count(),
            'totalProducts' => Product::count(),
            'totalCategories' => Category::count(),
            'totalRevenue' => Order::sum('total'),
            'recentOrders' => Order::with('items')
                ->latest()
                ->take(5)
                ->get()
                ->map(function ($order) {
                    return [
                        'id' => $order->id,
                        'customer_name' => $order->shipping_name,
                        'total_amount' => $order->total,
                        'status' => $order->status ?? 'pending',
                    ];
                }),
        ];

        // Generate chart data for the last 30 days
        $chartData = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dateStr = $date->format('Y-m-d');
            
            // Get orders for this day
            $dayOrders = Order::whereDate('created_at', $date)->get();
            $revenue = $dayOrders->sum('total');
            $orderCount = $dayOrders->count();
            
            $chartData[] = [
                'date' => $dateStr,
                'revenue' => (float) $revenue,
                'orders' => $orderCount,
            ];
        }

        // Get top selling categories
        $topCategories = Category::withCount('products')
            ->orderBy('products_count', 'desc')
            ->take(5)
            ->get()
            ->map(function ($category) {
                return [
                    'name' => $category->name,
                    'count' => $category->products_count,
                ];
            });

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
            'chartData' => $chartData,
            'topCategories' => $topCategories,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'You have been logged out successfully.');
    }
}

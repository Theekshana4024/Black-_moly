<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Get total vehicles count
        $totalVehicles = Vehicle::count();

        // Get sold vehicles count
        $soldVehicles = Vehicle::where('status', 'sold')->count();

        // Get total users
        $totalUsers = User::count();

        // Get recent transactions (last 5)
        $recentTransactions = Transaction::with(['buyer', 'vehicle'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get recent vehicles (last 5)
        $recentVehicles = Vehicle::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get vehicles count by status
        $vehiclesByStatus = Vehicle::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status')
            ->toArray();

        return view('dashboard', compact(
            'totalVehicles',
            'soldVehicles',
            'totalUsers',
            'recentTransactions',
            'recentVehicles',
            'vehiclesByStatus'
        ));
    }
}

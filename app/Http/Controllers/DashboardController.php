<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalUsers = User::count();
        $totalDpToday = Transaksi::whereDate('created_at', now()->toDateString())->sum('dp');
        $totalPelunasanToday = Transaksi::whereDate('created_at', now()->toDateString())->sum('sisaPelunasan');
        $totalPendapatanToday = $totalDpToday + $totalPelunasanToday;

        $months = [];
        $pendapatanBulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $month = now()->startOfYear()->addMonths($i - 1)->format('F');
            $months[] = $month;
            $pendapatan = Transaksi::whereMonth('created_at', $i)
                ->whereYear('created_at', now()->year)
                ->sum(DB::raw('dp + sisaPelunasan'));
            $pendapatanBulanan[] = $pendapatan;
        }

        return view('dashboard', compact('totalUsers', 'totalDpToday', 'totalPelunasanToday', 'totalPendapatanToday', 'months', 'pendapatanBulanan'));
    }

    public function filter(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $totalUsers = User::count();
        $totalDpToday = Transaksi::whereBetween('created_at', [$startDate, $endDate])->sum('dp');
        $totalPelunasanToday = Transaksi::whereBetween('created_at', [$startDate, $endDate])->sum('sisaPelunasan');
        $totalPendapatanToday = $totalDpToday + $totalPelunasanToday;

        $months = [];
        $pendapatanBulanan = [];
        $start = \Carbon\Carbon::parse($startDate)->startOfMonth();
        $end = \Carbon\Carbon::parse($endDate)->endOfMonth();
        while ($start->lessThanOrEqualTo($end)) {
            $month = $start->format('F');
            $months[] = $month;
            $pendapatan = Transaksi::whereMonth('created_at', $start->month)
                ->whereYear('created_at', $start->year)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum(DB::raw('dp + sisaPelunasan'));
            $pendapatanBulanan[] = $pendapatan;
            $start->addMonth();
        }

        return view('dashboard', compact('totalUsers', 'totalDpToday', 'totalPelunasanToday', 'totalPendapatanToday', 'months', 'pendapatanBulanan'))
            ->with('startDate', $startDate)
            ->with('endDate', $endDate);
    }
}

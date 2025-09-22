<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motor;
use App\Models\Booking;
use Illuminate\Support\Facades\Schema; // TAMBAHIN INI

class AdminReportController extends Controller
{
    public function dashboard()
    {
        $totalMotors = Motor::count();
        $rentedMotors = Motor::where('status', 'rented')->count();

        // FIX: PAKAI CONDITIONAL CHECK UNTUK HINDARI ERROR
        $ownerShare = 0;
        $adminShare = 0;
        
        // CEK DULU KOLOMNYA ADA ATAU ENGGA
        if (Schema::hasColumn('bookings', 'status') && 
            Schema::hasColumn('bookings', 'owner_fee') && 
            Schema::hasColumn('bookings', 'admin_fee')) {
            
            $ownerShare = Booking::where('status', 'completed')->sum('owner_fee');
            $adminShare = Booking::where('status', 'completed')->sum('admin_fee');
        }

        // FIX: PERBAIKI TYPO 'WOMTH' MENJADI 'MONTH'
        $bookingsPerMonth = Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        return view('admin.reports.dashboard', compact(
            'totalMotors', 'rentedMotors', 'ownerShare', 'adminShare', 'bookingsPerMonth'
        ));
    }
}
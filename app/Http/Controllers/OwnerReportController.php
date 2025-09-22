<?php

namespace App\Http\Controllers;

use App\Models\RevenueSharing;

class OwnerReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:pemilik']);
    }

    public function revenue()
    {
        $ownerId = auth()->id();
        $revenues = RevenueSharing::whereHas('booking.motor', function($q) use ($ownerId) {
            $q->where('owner_id', $ownerId);
        })->with('booking.motor')->paginate(10);

        $total = $revenues->sum('owner_share');

        return view('owner.revenue', compact('revenues', 'total'));
    }
}

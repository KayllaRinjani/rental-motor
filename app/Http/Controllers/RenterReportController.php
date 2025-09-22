<?php

namespace App\Http\Controllers;

class RenterReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:penyewa']);
    }

    public function history()
    {
        $bookings = auth()->user()->bookings()->with('motor','payment')->latest()->paginate(10);
        return view('renter.history', compact('bookings'));
    }
}

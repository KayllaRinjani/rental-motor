<?php
namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Motor;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller {
    public function __construct(){ $this->middleware(['auth','role:penyewa']); }

    public function store(Request $r){
        $r->validate([
            'motor_id'=>'required|exists:motors,id',
            'start_date'=>'required|date',
            'end_date'=>'required|date|after_or_equal:start_date',
            'duration_type'=>'required|in:daily,weekly,monthly'
        ]);
        $motor = Motor::with('rentalRate')->findOrFail($r->motor_id);
        $price = $this->calculatePrice($motor, $r->duration_type, $r->start_date, $r->end_date);
        $booking = Booking::create([
            'renter_id'=>auth()->id(),
            'motor_id'=>$motor->id,
            'start_date'=>$r->start_date,
            'end_date'=>$r->end_date,
            'duration_type'=>$r->duration_type,
            'price'=>$price,
            'status'=>'pending',
        ]);
        Payment::create(['booking_id'=>$booking->id,'amount'=>$price,'method'=>'transfer','status'=>'pending']);
        return redirect()->route('bookings.show', $booking->id)->with('success','Booking dibuat. Silakan unggah bukti transfer di halaman booking.');
    }

    private function calculatePrice($motor, $durationType, $start, $end){
        $rates = $motor->rentalRate;
        $days = Carbon::parse($start)->diffInDays(Carbon::parse($end)) + 1;
        if(!$rates) abort(422, 'Harga belum diset oleh admin.');
        if($durationType === 'daily'){
            return $days * $rates->daily_rate;
        } elseif($durationType === 'weekly'){
            $weeks = ceil($days / 7);
            return $weeks * $rates->weekly_rate;
        } else {
            $months = ceil($days / 30);
            return $months * $rates->monthly_rate;
        }
    }

    public function show(Booking $booking){
        $this->authorize('view', $booking); // optional
        $booking->load('motor','payment');
        return view('bookings.show', compact('booking'));
    }

    public function history(){
        $bookings = auth()->user()->bookings()->with('motor','payment')->latest()->paginate(10);
        return view('bookings.history', compact('bookings'));
    }
}

<?php
namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\RevenueSharing;
use Illuminate\Http\Request;

class PaymentController extends Controller {
    public function __construct(){ $this->middleware('auth'); }

    // penyewa upload bukti
    public function uploadProof(Request $r, Payment $payment){
        $this->authorize('update', $payment); // optional
        $r->validate(['proof'=>'required|image|max:3072']);
        $payment->proof = $r->file('proof')->store('payments','public');
        $payment->status = 'pending';
        $payment->save();
        return back()->with('success','Bukti transfer diunggah. Menunggu verifikasi admin.');
    }

    // admin konfirmasi pembayaran
    public function confirm(Payment $payment){
        $this->authorize('adminAction'); // atau middleware role:admin
        $payment->status = 'paid';
        $payment->paid_at = now();
        $payment->save();

        $booking = $payment->booking;
        $booking->status = 'confirmed';
        $booking->save();

        // hitung bagi hasil: contoh owner 70%, admin 30% (bisa simpan di config)
        $ownerPercent = 70;
        $ownerShare = ($payment->amount * $ownerPercent) / 100;
        $adminShare = $payment->amount - $ownerShare;
        RevenueSharing::create([
            'booking_id'=>$booking->id,
            'owner_share'=>$ownerShare,
            'admin_share'=>$adminShare,
            'settled_at'=>now()
        ]);

        // ubah status motor
        $motor = $booking->motor;
        $motor->status = 'disewa';
        $motor->save();

        return back()->with('success','Pembayaran dikonfirmasi, booking terkonfirmasi.');
    }

    // admin tolak bukti
    public function reject(Payment $payment){
        $this->authorize('adminAction');
        $payment->status = 'rejected';
        $payment->save();
        return back()->with('success','Pembayaran ditolak. Minta penyewa unggah ulang bukti.');
    }
}

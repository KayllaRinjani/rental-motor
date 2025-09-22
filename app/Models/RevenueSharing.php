<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RevenueSharing extends Model {
    protected $fillable = ['booking_id','owner_share','admin_share','settled_at'];
    protected $dates = ['settled_at'];
    public function booking() { return $this->belongsTo(Booking::class); }
}

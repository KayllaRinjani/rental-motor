<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model {
    protected $fillable = ['booking_id','amount','method','proof','status','paid_at'];
    protected $dates = ['paid_at'];
    public function booking() { return $this->belongsTo(Booking::class); }
}

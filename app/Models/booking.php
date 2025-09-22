<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model {
    protected $fillable = ['renter_id','motor_id','start_date','end_date','duration_type','price','status'];
    protected $dates = ['start_date','end_date'];
    public function renter() { return $this->belongsTo(User::class,'renter_id'); }
    public function motor() { return $this->belongsTo(Motor::class); }
    public function payment() { return $this->hasOne(Payment::class); }
}

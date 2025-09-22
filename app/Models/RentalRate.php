<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RentalRate extends Model {
    protected $fillable = ['motor_id','daily_rate','weekly_rate','monthly_rate'];
    public function motor() { return $this->belongsTo(Motor::class); }
}

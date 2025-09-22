<?php
namespace App\Http\Controllers;
use App\Models\Motor;
use App\Models\RentalRate;
use Illuminate\Http\Request;

class AdminMotorController extends Controller {
    public function __construct(){ $this->middleware(['auth','role:admin']); }

    public function index(){
        $motors = Motor::with('owner','rentalRate')->latest()->paginate(15);
        return view('admin.motors.index', compact('motors'));
    }

    public function verify(Request $r, Motor $motor){
        $r->validate([
            'daily_rate'=>'nullable|numeric',
            'weekly_rate'=>'nullable|numeric',
            'monthly_rate'=>'nullable|numeric',
        ]);
        $motor->update(['status'=>'available']);
        RentalRate::updateOrCreate(
            ['motor_id'=>$motor->id],
            ['daily_rate'=>$r->daily_rate,'weekly_rate'=>$r->weekly_rate,'monthly_rate'=>$r->monthly_rate]
        );
        return back()->with('success','Motor diverifikasi & harga diset.');
    }
}

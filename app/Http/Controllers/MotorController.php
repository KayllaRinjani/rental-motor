<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;

class MotorController extends Controller
{
    // tampilkan semua motor yang available
    public function index()
    {
        $motors = Motor::where('status','available')->with('owner','rentalRate')->paginate(10);
        return view('motors.index', compact('motors'));
    }

    // detail motor tertentu
    public function show(Motor $motor)
    {
        $motor->load('owner','rentalRate');
        return view('motors.show', compact('motor'));
    }
}

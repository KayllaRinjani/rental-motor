<?php
namespace App\Http\Controllers;
use App\Models\Motor;
use Illuminate\Http\Request;

class OwnerMotorController extends Controller {
    public function __construct(){ $this->middleware(['auth','role:pemilik']); }

    public function index(){
        $motors = auth()->user()->motors()->latest()->paginate(10);
        return view('owner.motors.index', compact('motors'));
    }

    public function create(){ return view('owner.motors.create'); }

    public function store(Request $r){
        $r->validate([
            'brand'=>'required|string',
            'plate_number'=>'required|string|unique:motors,plate_number',
            'photo'=>'nullable|image|max:2048'
        ]);
        $path = $r->file('photo') ? $r->file('photo')->store('motors','public') : null;
        Motor::create([
            'owner_id' => auth()->id(),
            'brand' => $r->brand,
            'model' => $r->model,
            'type_cc' => $r->type_cc,
            'plate_number' => $r->plate_number,
            'photo' => $path,
            'status' => 'draft',
        ]);
        return redirect()->route('owner.motors.index')->with('success','Motor ditambahkan, tunggu verifikasi admin.');
    }

    public function edit(Motor $motor){
        $this->authorize('update', $motor); // optional policy
        return view('owner.motors.edit', compact('motor'));
    }

    public function update(Request $r, Motor $motor){
        $this->authorize('update',$motor);
        $r->validate(['brand'=>'required','plate_number'=>'required|unique:motors,plate_number,'.$motor->id,'photo'=>'nullable|image|max:2048']);
        if($r->hasFile('photo')){ $motor->photo = $r->file('photo')->store('motors','public'); }
        $motor->update($r->only(['brand','model','type_cc','plate_number']));
        return back()->with('success','Motor diperbarui.');
    }

    public function destroy(Motor $motor){
        $this->authorize('delete',$motor);
        $motor->delete();
        return back()->with('success','Motor dihapus.');
    }
}

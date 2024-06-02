<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timeshift;

class ShiftController extends Controller
{

    public function index()
    {
        $timeshifts = Timeshift::all();
        return view('pages.setting.time-setting', compact('timeshifts'));
    }


    public function create()
    {
        return view('pages.setting.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'presensi_mulai' => 'required',
            'presensi_selesai' => 'required',
            'shift' => 'required',
        ]);

        // Check if the shift already exists
        $existingShift = Timeshift::where('shift', $request->shift)->first();

        if ($existingShift) {
            return redirect()->route('timeshifts.index')->with('success-delete', 'Shift already exists. You cannot input the same shift.');
        }

        // If the shift does not exist, proceed to save it
        $timeshift = new Timeshift();
        $timeshift->presensi_mulai = $request->presensi_mulai;
        $timeshift->presensi_selesai = $request->presensi_selesai;
        $timeshift->shift = $request->shift;
        $timeshift->save();

        return redirect()->route('timeshifts.index')->with('success', 'Shift created successfully.');
    }

    public function edit($id)
    {
        $timeshift = Timeshift::find($id);
        return view('pages.setting.edit', compact('timeshift'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'presensi_mulai' => 'required',
            'presensi_selesai' => 'required',
        ]);

        $shift = Timeshift::find($id);
        $shift->presensi_mulai = $request->presensi_mulai;
        $shift->presensi_selesai = $request->presensi_selesai;

        $shift->save();
        return redirect()->route('timeshifts.index')->with('success', 'Shift updated successfully.');
    }

    public function destroy($id)
    {
        
    }
}

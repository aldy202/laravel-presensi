<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Presensi;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PresensiExport;
use App\Http\Controllers\Controller;
use App\Models\Timeshift;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today();

        // Check if user has already submitted attendance today
        $alreadyPresensi = Presensi::where('idpegawai', $user->idpegawai)
            ->whereDate('tgl_absen', $today)
            ->exists();

        $timeshifts = Timeshift::all();

        return view('pages.karyawan.presensi', compact('alreadyPresensi', 'timeshifts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'kondisi' => 'required',
        'keterangan' => 'required',
        'shift' => 'required',
        'jobdesk' => 'required',
    ]);

    $user = Auth::user();
    $today = Carbon::today();

    // Check if user has already submitted attendance today
    $alreadyPresensi = Presensi::where('idpegawai', $user->idpegawai)
        ->whereDate('tgl_absen', $today)
        ->exists();

    if ($alreadyPresensi) {
        return back()->withErrors(['shift' => 'You have already submitted attendance today.']);
    }

    // Fetch the shift timings from the timeshift table
    $shiftId = $request->shift;
    $timeshift = Timeshift::find($shiftId);

    if (!$timeshift) {
        return back()->withErrors(['shift' => 'Invalid shift selected.']);
    }

    $currentTime = Carbon::now();
    $shiftStart = Carbon::createFromTimeString($timeshift->presensi_mulai);
    $shiftEnd = Carbon::createFromTimeString($timeshift->presensi_selesai);

    // Adjust dates if shift spans across midnight
    if ($shiftEnd->lessThan($shiftStart)) {
        $shiftEnd->addDay();
    }

    // Log detailed time information
    Log::info("Current Time: {$currentTime->format('Y-m-d H:i:s')}");
    Log::info("Shift Start: {$shiftStart->format('Y-m-d H:i:s')}");
    Log::info("Shift End: {$shiftEnd->format('Y-m-d H:i:s')}");

    if (!$currentTime->between($shiftStart, $shiftEnd)) {
        Log::info("Shift $shiftId  presensi gagal: waktu tidak sesuai. Current Time: {$currentTime->format('Y-m-d H:i:s')}, Shift Start: {$shiftStart->format('Y-m-d H:i:s')}, Shift End: {$shiftEnd->format('Y-m-d H:i:s')}");
        return back()->withErrors(['shift' => "Presensi Masuk Shift $shiftId  hanya bisa dilakukan antara jam {$shiftStart->format('H:i')} - {$shiftEnd->format('H:i')}"]);
    }

    // Save attendance data
    Presensi::create([
        'idpegawai' => $user->idpegawai,
        'masuk' => $currentTime->toTimeString(),
        'tgl_absen' => $today->toDateString(),
        'kondisi' => $request->kondisi,
        'keterangan' => $request->keterangan,
        'shift' => $shiftId , // Assign the shift name directly
        'jobdesk' => $request->jobdesk,
    ]);

    // Redirect back with success message
    return redirect()->back()->with('success', 'Attendance submitted successfully.');
}






    public function history(Request $request)
    {
        $user = Auth::user();
        $query = Presensi::where('idpegawai', $user->idpegawai);

        // If a date is provided, filter the history based on the date
        if ($request->has('date') && !empty($request->date)) {
            $query->whereDate('tgl_absen', $request->date);
        }

        $presensiHistory = $query->orderBy('tgl_absen', 'desc')->get();

        return view('pages.karyawan.history-presensi', compact('presensiHistory'));
    }

    public function historyAll(Request $request)
    {
        $query = Presensi::with('user', 'timeshift');

        // If a date is provided, filter the history based on the date
        if ($request->has('date') && !empty($request->date)) {
            $query->whereDate('tgl_absen', $request->date);
        }

        $presensiHistory = $query->orderBy('tgl_absen', 'desc')->get();

        return view('pages.leader.history-all', compact('presensiHistory'));
    }


    public function export()
    {
        return Excel::download(new PresensiExport, 'presensi.xlsx');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the attendance record by ID
        $presensi = Presensi::where('id_absen', $id)->first();

        if ($presensi) {
            $presensi->delete();
            return redirect()->back()->with('success-delete', 'Attendance record deleted successfully.');
        }

        return redirect()->back()->withErrors(['error' => 'Attendance record not found.']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Presensi;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Count the total number of leaders and karyawans
        $totalLeaders = User::where('role', 'leader')->count();
        $totalKaryawans = User::where('role', 'karyawan')->count();

        // Get the user IDs of those who have performed presensi
        $presensiUserIds = Presensi::distinct()->pluck('idpegawai');

        // Count the leaders who have performed presensi
        $leadersWithPresensi = User::whereIn('idpegawai', $presensiUserIds)
            ->where('role', 'leader')
            ->count();

        // Count the karyawans who have performed presensi
        $karyawansWithPresensi = User::whereIn('idpegawai', $presensiUserIds)
            ->where('role', 'karyawan')
            ->count();

        return view('pages.admin.dashboard', compact(
            'totalLeaders',
            'totalKaryawans',
            'leadersWithPresensi',
            'karyawansWithPresensi'
        ));
    }
}

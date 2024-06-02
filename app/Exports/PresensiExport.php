<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Presensi;
use App\Models\User;

class PresensiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        $presensiRecords = Presensi::all();

        // Transform the data to include employee names instead of IDs
        $presensiData = $presensiRecords->map(function ($presensi) {
            $employeeName = User::find($presensi->idpegawai)->name; // Assuming the foreign key is `idpegawai` and the employee name is in the `name` field
            return [
                'Employee Name' => $employeeName,
                'Check-in Time' => $presensi->masuk,
                'Date' => $presensi->tgl_absen,
                'Shift' => $presensi->shift,
                'Condition' => $presensi->kondisi,
                'Description' => $presensi->keterangan,
                'Job Description' => $presensi->jobdesk,
            ];
        });

        return $presensiData;
    }
}

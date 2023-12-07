<?php

namespace App\Imports;

use App\Models\Alumni;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AlumniImport implements ToModel, WithHeadingRow
{
    
    public function model(array $row)
    {
        $data = [
            'nama'                 => $row['nama'],
            'nim'                  => $row['nim'],
            'angkatan'             => $row['angkatan'],
            'tahun_lulus'          => $row['tahun_lulus'],
            'asal_daerah'          => $row['asal_daerah'],
            'tempat_lahir'         => $row['tempat_lahir'],
            'tanggal_lahir'        => convertTanggalImport($row['tanggal_lahir']),
            'alamat'               => $row['alamat'],
            'pekerjaan'            => $row['pekerjaan'],
            'no_hp'                => $row['no_hp'],
            'email'                => $row['email'],
        ];

        return new Alumni($data);
    }
}

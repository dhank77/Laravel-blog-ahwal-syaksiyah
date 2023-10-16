<?php

namespace App\Imports;

use App\Models\DataDetail;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SuratImport implements ToModel, WithHeadingRow, WithValidation
{
    
    public function model(array $row)
    {
        $data = [
            'data_id'              => $row['data_id'],
            'nama'                 => $row['nama'],
            'nim'                  => $row['nim'],
            'param1'               => $row['param1'],
            'param2'               => $row['param2'],
            'param3'               => $row['param3'],
            'param4'               => $row['param4'],
            'param5'               => $row['param5'],
            'param6'               => $row['param6'],
            'param7'               => $row['param7'],
            'param8'               => $row['param8'],
            'param9'               => $row['param9'],
        ];

        return new DataDetail($data);
    }

    public function rules(): array
    {
        return [
            'data_id' => Rule::exists('data', 'id'),
        ];
    }

    public function customValidationMessages()
    {
        return [
            'data_id.exists' => 'Pastikan Data ID Benar!'
        ];
    }
}

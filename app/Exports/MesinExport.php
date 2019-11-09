<?php

namespace App\Exports;

use App\Mesin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MesinExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Nama',
            'kategori_id',
        ];
    }
    public function collection()
    {
        return Mesin::query()->get(['nama', 'kategori_id']);
    }
}

<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
        	'NIK',
            'Nama',
            'Role',
            'Email',
            'Password',
        ];
    }
    public function collection()
    {
        return User::query()->get(['nik','name', 'role_id', 'email', 'password']);
    }
}

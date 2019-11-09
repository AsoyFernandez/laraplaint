<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; //TAMBAHKAN CODE INI
use Maatwebsite\Excel\Concerns\WithChunkReading; //IMPORT CHUNK READING

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
class UserImport implements ToModel, WithHeadingRow, WithChunkReading, WithValidation
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return User::firstOrNew([
            'name'=>$row['nama'],
            'nik'=>$row['nik'],
            'role_id'=>$row['role'],
            'email'=>$row['email'],
            'password'=> Hash::make($row['password'])

        ]);
    }

    public function rules(): array
    {
        return [
            'nik' => 'required|unique:users,nik',
            'email' => 'required|unique:users,email',
            'nama' => 'required|unique:users,name',
            'password' => 'required',
            'role' => 'required|exists:roles,id',
        ];
    }

        //LIMIT CHUNKSIZE
    public function chunkSize(): int
    {
        return 1000; //ANGKA TERSEBUT PERTANDA JUMLAH BARIS YANG AKAN DIEKSEKUSI
    }
}
